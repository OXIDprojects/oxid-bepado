<?php

require_once __DIR__.'/../BaseTestCase.php';

use Bepado\SDK\Struct as Struct;

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@gmx.de>
 */
class mf_sdk_converterTest extends BaseTestCase
{
    /**
     * @var mf_sdk_converter
     */
    protected $converter;
    protected $oxShop;

    protected $productValues = array(
        'sourceId'         => 'some-id',
        'ean'              => 'test-ean',
        'url'              => 'http://www.oxid-test.dev/index.php?cl=details&amp;anid=some-id',
        'title'            => 'test-title',
        'shortDescription' => 'test short description',
        'longDescription'  => 'test long description',
        'vendor'           => 'test-vendor',
        'vat'              => 0.19,      # should come from the shop directly
        'price'            => 1.67,
        'purchasePrice'    => 1.50,
        'fixedPrice'       => false,   # won't skip this in usual shops
        'currency'         => 'EUR',
        'freeDelivery'     => false,
        'deliveryDate'     => null,
        'availability'     => 10,
        'images'           => array(),
        'categories'       => array(),
        'tags'             => array(),
        'relevance'        => 0,
        'attributes'       => array(
            Struct\Product::ATTRIBUTE_WEIGHT => 11,
            Struct\Product::ATTRIBUTE_VOLUME => '2184',
            Struct\Product::ATTRIBUTE_DIMENSION => '13x12x14',
            Struct\Product::ATTRIBUTE_REFERENCE_QUANTITY => 1,
            Struct\Product::ATTRIBUTE_QUANTITY => 10,
            Struct\Product::ATTRIBUTE_UNIT => 'g'
        ),
        'deliveryWorkDays' => null,
    );

    protected $articleValues = array(
        'oxarticles__oxid'           => 'some-id',
        'oxarticles__oxean'          => 'test-ean',
        'oxarticles__oxtitle'        => 'test-title',
        'oxarticles__oxshortdesc'    => 'test short description',
        'oxarticles__oxprice'        => 1.99,
        'oxarticles__oxaprice'       => 1.50,
        'oxarticles__oxstock'        => 10,
        'oxarticles__oxweight'       => 11,
        'oxarticles__oxwidth'        => 12,
        'oxarticles__oxlength'       => 13,
        'oxarticles__oxheight'       => 14,
        'oxarticles__oxunitquantity' => 10,
        'oxarticles__oxunitname'     => '_UNIT_G'
    );

    public function setUp()
    {
        $this->prepareVersionLayerWithConfig();

        $this->converter = new mf_sdk_converter();
        $this->converter->setVersionLayer($this->versionLayer);

        // oxid objects
        $this->oxShop = $this->getMockBuilder('oxShop')->disableOriginalConstructor()->getMock();

        // expected method with its values to return
        $currencyItem = new \stdClass();
        $currencyItem->rate = '1.00';
        $currencyItem->name = 'EUR';
        $this->oxidConfig
            ->expects($this->once())
            ->method('getCurrencyArray')
            ->will($this->returnValue(array($currencyItem)));
    }

    /**
     * @dataProvider provideProductValues
     */
    public function testConvertToSDKProduct($productProperty, $productValue, $testable = true)
    {
        /** @var oxArticle $oxArticle */
        $oxArticle = oxNew('oxarticle');
        $oxArticle->assign($this->articleValues);

        $product = $this->converter->toBepadoProduct($oxArticle);

        if ($testable) {
            $this->assertEquals($productValue, $product->$productProperty);
        } else {
            $this->markTestIncomplete('Can not test for Property: '.$productProperty);
        }
    }

    public function provideProductValues()
    {
        $values = array();

        foreach ($this->productValues as $property => $value) {
            $testable = in_array($property, array('vendor', 'longDescription')) ? false : true;
            $values[] = array($property, $value, $testable);
        }

        return $values;
    }

    /**
     * @dataProvider provideArticleValues
     */
    public function testConvertFromSDKProduct($field, $fieldValue, $testable)
    {
        $product = new Struct\Product();
        foreach ($this->productValues as $property => $propertyValue) {
            $product->$property = $propertyValue;
        }

        $oxArticle = $this->converter->toShopProduct($product);

        if ($testable) {
            $actualValue = $oxArticle->getFieldData($field);
            if ('oxarticles__oxid' !== $field) {
                $this->assertEquals($fieldValue, $actualValue);
            } else {
                $this->assertNull($actualValue, 'We do not want to set the oxid from a sdk product at that point.');
            }

        } else {
            $this->markTestIncomplete('Can not test for field: '.$field);
        }
    }

    public function provideArticleValues()
    {
        $values = array();
        foreach ($this->articleValues as $field => $value) {
            $testable = in_array($field, array()) ? false : true;
            if ('oxarticles__oxprice' === $field) {
                $value = '1.6699999999999999';
            }
            $values[] = array($field, $value, $testable);
        }

        return $values;
    }

    protected function getObjectMapping()
    {
        return array(
            'oxshop' => $this->oxShop,
        );
    }
}
 
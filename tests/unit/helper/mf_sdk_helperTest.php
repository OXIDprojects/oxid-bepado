<?php

require_once __DIR__ . '/../BaseTestCase.php';

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@gmx.de>
 */
class mf_sdk_helperTest extends BaseTestCase
{
    protected $oxGroups;
    protected $oxDelivery;
    protected $oxDeliverySet;
    protected $oxBase;
    protected $oxDb;
    protected $logger;
    /**
     * @var mf_sdk_helper
     */
    private $helper;

    public function setUp()
    {
        $this->prepareVersionLayerWithConfig();

        $this->helper = new mf_sdk_helper();
        $this->helper->setVersionLayer($this->versionLayer);

        $this->oxGroups = $this->getMockBuilder('oxGroups')->disableOriginalConstructor()->getMock();
        $this->oxDelivery = $this->getMockBuilder('oxDelivery')->disableOriginalConstructor()->getMock();
        $this->oxDeliverySet = $this->getMockBuilder('oxDeliverySet')->disableOriginalConstructor()->getMock();
        $this->oxBase = $this->getMockBuilder('oxBase')->disableOriginalConstructor()->getMock();
        $this->oxDb = $this->getMockBuilder('oxLegacyDb')->disableOriginalConstructor()->getMock();
        $this->versionLayer->expects($this->any())->method('getDb')->will($this->returnValue($this->oxDb));
        $this->logger = $this->getMockBuilder('mf_sdk_logger_helper')->disableOriginalConstructor()->getMock();
    }

    /**
     * As i wanna check the real values delivered by the config, we need to do an extra action
     * instead of the the default value of the base test case.
     */
    public function testConfigCreation()
    {
        $oxConfig = $this->getMock('oxConfig');
        $versionLayer = $this->getMock('VersionLayerInterface');
        $versionLayer->expects($this->once())->method('getConfig')->will($this->returnValue($oxConfig));
        $versionLayer->expects($this->once())->method('createNewObject')->will($this->returnValue(new SDKConfig()));
        $this->helper->setVersionLayer($versionLayer);
        $oxConfig->expects($this->at(0))
            ->method('getConfigParam')
            ->with($this->equalTo('sBepadoLocalEndpoint'))
            ->will($this->returnValue('test-endpoint'));
        $oxConfig->expects($this->at(1))
            ->method('getConfigParam')
            ->with($this->equalTo('sBepadoApiKey'))
            ->will($this->returnValue('test-key'));

        $oxConfig->expects($this->at(2))
            ->method('getConfigParam')
            ->with($this->equalTo('sandboxMode'))
            ->will($this->returnValue(true));
        $sdConfig = $this->helper->createSdkConfigFromOxid();

        $this->assertEquals('test-endpoint', $sdConfig->getApiEndpointUrl());
        $this->assertEquals('test-key', $sdConfig->getApiKey());
        $this->assertTrue($sdConfig->getSandboxMode());
        $this->assertNotNull($sdConfig->getSocialnetworkHost());
        $this->assertNotNull($sdConfig->getTransactionHost());
        $this->assertNotNull($sdConfig->getSearchHost());
    }

    public function testConfigCreationInProductMode()
    {
        $oxConfig = $this->getMock('oxConfig');
        $versionLayer = $this->getMock('VersionLayerInterface');
        $versionLayer->expects($this->once())->method('getConfig')->will($this->returnValue($oxConfig));
        $versionLayer->expects($this->once())->method('createNewObject')->will($this->returnValue(new SDKConfig()));
        $this->helper->setVersionLayer($versionLayer);
        $oxConfig->expects($this->at(0))
            ->method('getConfigParam')
            ->with($this->equalTo('sBepadoLocalEndpoint'))
            ->will($this->returnValue('test-endpoint'));
        $oxConfig->expects($this->at(1))
            ->method('getConfigParam')
            ->with($this->equalTo('sBepadoApiKey'))
            ->will($this->returnValue('test-key'));

        $oxConfig->expects($this->at(2))
            ->method('getConfigParam')
            ->with($this->equalTo('sandboxMode'))
            ->will($this->returnValue(false));
        $sdConfig = $this->helper->createSdkConfigFromOxid();

        $this->assertEquals('test-endpoint', $sdConfig->getApiEndpointUrl());
        $this->assertEquals('test-key', $sdConfig->getApiKey());
        $this->assertFalse($sdConfig->getSandboxMode());
        $this->assertNull($sdConfig->getSocialnetworkHost());
        $this->assertNull($sdConfig->getTransactionHost());
        $this->assertNull($sdConfig->getSearchHost());
    }

    public function testImageCreation()
    {
        $this->oxidConfig
            ->expects($this->any())
            ->method('getMasterPictureDir')
            ->will($this->returnValue(__DIR__.'/../testdata/'));
        list($fieldName, $fieldValue) = $this->helper
            ->createOxidImageFromPath('https://media-cdn.tripadvisor.com/media/photo-s/05/03/17/b3/aviarios-del-caribe-sloth.jpg', 1);

        $this->assertEquals('oxarticles__oxpic1', $fieldName);
        $this->assertEquals('aviarios-del-caribe-sloth.jpg', $fieldValue);

        // clean up
        $filePath = __DIR__.'/../testdata/product/1/aviarios-del-caribe-sloth.jpg';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    /**
     * @expectedException \Exception
     */
    public function testImageCreateWithNonExistingFile()
    {
        $this->helper->createOxidImageFromPath('some-path', 1);
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No bepado user group found.
     */
    public function testOnModuleActivationGroupNotFound()
    {
        $this->oxDb->expects($this->any())->method('execute');
        $this->oxGroups->expects($this->once())->method('load')->with($this->equalTo('bepadoshopgroup'));
        $this->oxGroups->expects($this->once())->method('isLoaded')->will($this->returnValue(false));
        $this->logger->expects($this->once())->method('writeBepadoLog')->with($this->equalTo('No bepado user group found.'));

        $this->helper->onModuleActivation();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No bepado shipping found
     */
    public function testOnModuleActivationShippingRuleNotFound()
    {
        $this->oxDb->expects($this->any())->method('execute');
        $this->oxGroups->expects($this->once())->method('load');
        $this->oxGroups->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxDelivery->expects($this->once())->method('load')->with($this->equalTo('bepadoshippingrule'));
        $this->oxDelivery->expects($this->once())->method('isLoaded')->will($this->returnValue(false));
        $this->logger->expects($this->once())->method('writeBepadoLog')->with($this->equalTo('No bepado shipping found.'));

        $this->helper->onModuleActivation();
    }

    /**
     * @expectedException \Exception
     * @expectedExceptionMessage No bepado shipping rule found
     */
    public function testOnModuleActivationShippingNotFound()
    {
        $this->oxDb->expects($this->any())->method('execute');
        $this->oxGroups->expects($this->once())->method('load');
        $this->oxGroups->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxDelivery->expects($this->once())->method('load');
        $this->oxDelivery->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxDeliverySet->expects($this->once())->method('load')->with($this->equalTo('bepadoshipping'));
        $this->oxDeliverySet->expects($this->once())->method('isLoaded')->will($this->returnValue(false));
        $this->logger->expects($this->once())->method('writeBepadoLog')->with($this->equalTo('No bepado shipping rule found.'));

        $this->helper->onModuleActivation();
    }

    public function testOnModuleActivationSuccess()
    {
        $this->oxDb->expects($this->any())->method('execute');
        $this->oxGroups->expects($this->once())->method('load');
        $this->oxGroups->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxDelivery->expects($this->once())->method('load');
        $this->oxDelivery->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxDeliverySet->expects($this->once())->method('load');
        $this->oxDeliverySet->expects($this->once())->method('isLoaded')->will($this->returnValue(true));

        $this->oxBase->expects($this->at(0))->method('oxobject2delivery');
        $this->oxBase->expects($this->at(1))->method('oxobject2delivery');

        $this->helper->onModuleActivation();
    }

    protected function getObjectMapping()
    {
        return array(
            'SDKConfig'             => new SDKConfig(),
            'oxgroups'              => $this->oxGroups,
            'oxdelivery'            => $this->oxDelivery,
            'oxdeliveryset'         => $this->oxDeliverySet,
            'oxbase'                => $this->oxBase,
            'mf_sdk_logger_helper'  => $this->logger,
        );
    }
}

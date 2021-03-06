<?php

/**
 * @author Maximilian Berghoff <Maximilian.Berghoff@gmx.de>
 */
abstract class BaseTestCase extends OxidTestCase
{

    /**
     * @var VersionLayerInterface
     */
    protected $versionLayer;

    /**
     * @var oxConfig
     */
    protected $oxidConfig;

    protected function prepareVersionLayerWithConfig()
    {
        $this->versionLayer = $this->getMock('VersionLayerInterface');
        $this->oxidConfig = $this->getMock('oxConfig');
        $this->versionLayer->expects($this->any())->method('getConfig')->will($this->returnValue($this->oxidConfig));
        $this->versionLayer->expects($this->any())->method('createNewObject')->will($this->returnCallback(array($this, 'createNewObject')));
        $this->oxidConfig
            ->expects($this->any())
            ->method('getConfigParam')
            ->will($this->returnCallback(array($this, 'createConfigReturnValue')))
        ;
        $this->oxidConfig
            ->expects($this->any())
            ->method('getShopId')
            ->will($this->returnValue('shop-id'))
        ;
    }

    /**
     * Based on the Object mapping this method returns the object for the
     * createNewObject() method on the the version layer.
     *
     * @return object
     */
    public function createNewObject()
    {
        $mappedObjects = $this->getObjectMapping();
        $args = func_get_args();

        return $mappedObjects[$args[0]];
    }

    public function createConfigReturnValue()
    {
        $mappedAnswers = $this->getConfigMapping();
        $args = func_get_args();

        return isset($mappedAnswers[$args[0]]) ? $mappedAnswers[$args[0]] : 'test-value';
    }

    /**
     * When you want to.
     *
     * @return array
     */
    protected function getConfigMapping()
    {
        return array();
    }

    abstract protected function getObjectMapping();
}

<?php

namespace Craft;

/**
 * Zip Assets Test.
 *
 * Unit test for zip assets.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@nerds.company>
 * @copyright Copyright (c) 2016, Bob Olde Hampsink
 *
 * @link      http://github.com/boboldehampsink
 *
 * @coversDefaultClass Craft\ZipAssetsService
 * @covers ::<!public>
 */
class ZipAssetsTest extends BaseTest
{
    /**
     * {@inheritdoc}
     */
    public static function setUpBeforeClass()
    {
        // Set up parent
        parent::setUpBeforeClass();

        // Require dependencies
        require_once __DIR__.'/../services/ZipAssetsService.php';

        // Create test file
        @touch(__DIR__.'/test.jpg');
    }

    public static function tearDownAfterClass()
    {
        // Remove test file
        @unlink(__DIR__.'/test.jpg');

        // Tear down parent
        parent::tearDownAfterClass();
    }

    /**
     * Test download.
     *
     * @covers ::download
     */
    public function testDownload()
    {
        $this->setMockElementsService();

        $files = array(1);
        $filename = 'test';

        $service = new ZipAssetsService();
        $zipfile = $service->download($files, $filename);

        // check if we got a zip
        $this->assertFileExists($zipfile);
    }

    /**
     * Test download failure.
     *
     * @expectedException Craft\Exception
     * @covers ::download
     */
    public function testDownloadFail()
    {
        $this->setMockElementsService();

        $files = array(1);
        $filename = str_repeat('longfilename', 256);

        $service = new ZipAssetsService();
        $zipfile = $service->download($files, $filename);

        // check if we got a zip
        $this->assertFileExists($zipfile);
    }

    /**
     * Mock ElementsService.
     */
    private function setMockElementsService()
    {
        $mock = $this->getMockBuilder('Craft\ElementsService')
            ->disableOriginalConstructor()
            ->setMethods(array('getCriteria'))
            ->getMock();

        $criteria = $this->getMockElementCriteriaModel();

        $mock->expects($this->any())->method('getCriteria')->willReturn($criteria);

        $this->setComponent(craft(), 'elements', $mock);
    }

    /**
     * Mock ElementCriteriaModel.
     *
     * @return ElementCriteriaModel
     */
    private function getMockElementCriteriaModel()
    {
        $mock = $this->getMockBuilder('Craft\ElementCriteriaModel')
            ->disableOriginalConstructor()
            ->setMethods(array('__set', 'find'))
            ->getMock();

        $asset = $this->getMockAssetFileModel();
        $elements = array($asset);

        $mock->expects($this->any())->method('__set')->willReturn(true);
        $mock->expects($this->any())->method('find')->willReturn($elements);

        return $mock;
    }

    /**
     * Mock AssetFileModel.
     *
     * @return AssetFileModel
     */
    private function getMockAssetFileModel()
    {
        $mock = $this->getMockBuilder('Craft\AssetFileModel')
            ->disableOriginalConstructor()
            ->getMock();

        $source = $this->getMockAssetSourceModel();

        $mock->expects($this->any())->method('getSource')->willReturn($source);

        return $mock;
    }

    /**
     * Mock AssetSourceModel.
     *
     * @return AssetSourceModel
     */
    private function getMockAssetSourceModel()
    {
        $mock = $this->getMockBuilder('Craft\AssetSourceModel')
            ->disableOriginalConstructor()
            ->getMock();

        $sourceType = $this->getMockLocalAssetSourceType();

        $mock->expects($this->any())->method('getSourceType')->willReturn($sourceType);

        return $mock;
    }

    /**
     * Mock LocalAssetSourceType.
     *
     * @return AssetSourceModel
     */
    private function getMockLocalAssetSourceType()
    {
        $mock = $this->getMockBuilder('Craft\LocalAssetSourceType')
            ->disableOriginalConstructor()
            ->getMock();

        $mock->expects($this->any())->method('getLocalCopy')->willReturn(__DIR__.'/test.jpg');

        return $mock;
    }
}

<?php
namespace Craft;

class ZipAssetsTest extends BaseTest 
{
    
    public function setUp()
    {
    
        // PHPUnit complains about not settings this
        date_default_timezone_set('UTC');
    
        // Get dependencies
        $dir = __DIR__;
        $map = array(
            '\\Craft\\ZipAssetsService' => '/../services/ZipAssetsService.php'
        );

        // Inject them
        foreach($map as $classPath => $filePath) {
            if(!class_exists($classPath, false)) {
                require_once($dir . $filePath);
            }
        }
    
        // Set components we're going to use
        $this->setComponent(craft(), 'zipAssets', new ZipAssetsService);
    
    } 
    
    public function testActionDownload() 
    {
    
        // fetch random assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->limit = 2;
        
        // send asset ids and generate zip
        $zipfile = craft()->zipAssets->download($criteria->ids(), 'testzip');
        
        // check if we got a zip
        $this->assertFileExists($zipfile);
        
    }
    
}
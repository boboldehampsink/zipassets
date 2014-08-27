<?php
namespace Craft;

class ZipAssetsTest extends BaseTest 
{

    protected $zipAssetsService;
    
    public function setUp()
    {
    
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
    
        // Construct
        $this->zipAssetsService = new ZipAssetsService;
    
    } 
    
    public function testActionDownload() 
    {
    
        // fetch random assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->limit = 2;
        
        // send asset ids and generate zip
        $zipfile = $this->zipAssetsService->download($criteria->ids(), 'testzip');
        
        // check if we got a zip
        $this->assertTrue(file_exists($zipfile));
        
    }
    
}
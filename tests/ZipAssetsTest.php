<?php
namespace Craft;

class ZipAssetsTest extends \WebTestCase 
{
    
    function testActionDownload() 
    {
    
        // fetch random assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->limit = 2;
        
        // post asset id and download zip
        $result = $this->get(
            str_replace('https', 'ssl', str_replace('admin/', '', UrlHelper::getActionUrl('zipAssets/download'))),
            array(
                'filename' => 'testzip',
                'files' => $criteria->ids()
            )
        );
        
        // check if we got a zip
        $this->assertMime(array('application/zip; charset=utf-8'));
        
    }
    
}
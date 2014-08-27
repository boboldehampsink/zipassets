<?php
namespace Craft;

class ZipAssetsService extends BaseApplicationComponent 
{

    public function download($files, $filename)
    {

        // Get assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->id = $files;
        $criteria->limit = null;
        $assets = $criteria->find();
        
        // Set destination zip
        $destZip = craft()->path->getTempPath() . $filename . '_' . time() . '.zip';
        
        // Create the zipfile
        IOHelper::createFile($destZip);
        
        // Loop through assets
        foreach($assets as $asset) {
        
            // Get asset path
            $source = craft()->assetSources->getSourceById($asset->sourceId);
            
            // Add to zip
            Zip::add($destZip, $source->settings['path'].$asset->filename, $source->settings['path']);
        
        }
            
        // Return zip destination
        return $destZip;
    
    }
    
}
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
        
            // Get asset source
            $source = craft()->assetSources->getSourceById($asset->sourceId);
            
            // Get asset path
            $path = craft()->templates->renderObjectTemplate($source->settings['path'], $asset);
            
            // Add to zip
            Zip::add($destZip, $path.$asset->filename, $path);
        
        }
            
        // Return zip destination
        return $destZip;
    
    }
    
}
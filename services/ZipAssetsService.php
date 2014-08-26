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
        
        // Create zip
        $zip = new \ZipArchive;
        $zipfile = craft()->path->getTempPath() . $filename . '_' . time() . '.zip';
        
        // Open zip
        if($zip->open($zipfile, $zip::CREATE) === true) {
        
            // Loop through assets
            foreach($assets as $asset) {
            
                // Get asset path
                $source = craft()->assetSources->getSourceById($asset->sourceId);
                       
                // Add asset to zip         
                $zip->addFile($source->settings['path'].$asset->filename, $asset->filename);
            
            }
            
            // Close zip
            $zip->close();
            
            // Download zip
            return $zipfile;
        
        }
    
        // If not redirected, something went wrong
        throw new Exception(Craft::t('Failed to generate the zipfile'));
    
    }
    
}
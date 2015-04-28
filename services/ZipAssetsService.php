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
        
            $source = $asset->getSource();
            switch ($source->type) {
                case 'Local':
                    // Get asset folder
                    $folder = $asset->getFolder();
                    // Get asset path
                    $path = craft()->config->parseEnvironmentString($source->settings['path']) . $folder['path'];
                    
                    // Add to zip
                    Zip::add($destZip, $path.$asset->filename, $path);
                    break;
                case 'S3':
                    try{
                        $ch = curl_init();
                        curl_setopt($ch, CURLOPT_URL, $asset->getUrl());
                        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                        $newImageData = curl_exec($ch);
                        curl_close($ch);
                        $tempPath = craft()->path->getTempPath();
                        IOHelper::writeToFile($tempPath.$asset->filename, $newImageData);
                        // Add to zip
                        Zip::add($destZip, $tempPath.$asset->filename, $tempPath);
                        // Remove file from temp folder
                        IOHelper::deleteFile($tempPath.$asset->filename, true);
                    } 
					catch (Exception $e) {
                        Craft::log("Failed to get asset ID ".$asset->id." from url ".$asset->getUrl().". Caught exception: ".$e->getMessage(), LogLevel::Error);
                    }
                    break;
                default:
                    Craft::log("Tried to add asset ID ".$asset->id." to a zip for downloading but file type ".$asset->getSource()->type." is not supported", LogLevel::Error);
                }
        }
        // Return zip destination
        return $destZip;
    }
}

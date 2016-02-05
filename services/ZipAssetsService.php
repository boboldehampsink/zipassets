<?php

namespace Craft;

/**
 * Zip Assets Service.
 *
 * Contains plugin logics.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@nerds.company>
 * @copyright Copyright (c) 2016, Bob Olde Hampsink
 *
 * @link      http://github.com/boboldehampsink
 */
class ZipAssetsService extends BaseApplicationComponent
{
    /**
     * Download zipfile.
     *
     * @param array  $files
     * @param string $filename
     *
     * @return string
     */
    public function download($files, $filename)
    {
        // Get assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->id = $files;
        $criteria->limit = null;
        $assets = $criteria->find();

        // Set destination zip
        $destZip = craft()->path->getTempPath().$filename.'_'.time().'.zip';

        // Create zip
        $zip = new \ZipArchive();

        // Open zip
        if ($zip->open($destZip, $zip::CREATE) === true) {

            // Loop through assets
            foreach ($assets as $asset) {

                // Get asset source
                $source = $asset->getSource();

                 // Get asset source type
                $sourceType = $source->getSourceType();

                // Get asset file
                $file = $sourceType->getLocalCopy($asset);

                // Add to zip
                $zip->addFromString($asset->filename, IOHelper::getFileContents($file));

                // Remove the file
                IOHelper::deleteFile($file);
            }

            // Close zip
            $zip->close();

            // Return zip destination
            return $destZip;
        }

        // Something went wrong
        throw new Exception(Craft::t('Failed to generate the zipfile'));
    }
}

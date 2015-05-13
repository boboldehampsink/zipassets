<?php

namespace Craft;

/**
 * Zip Assets Service.
 *
 * Contains plugin logics.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, author
 * @license   http://buildwithcraft.com/license Craft License Agreement
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

        // Create the zipfile
        IOHelper::createFile($destZip);

        // Loop through assets
        foreach ($assets as $asset) {

            // Get asset source
            $source = $asset->getSource();

            // Get asset folder
            $folder = $asset->getFolder();

            // Get asset path
            $path = craft()->config->parseEnvironmentString($source->settings['path']).$folder['path'];

            // Add to zip
            Zip::add($destZip, $path.$asset->filename, $path);
        }

        // Return zip destination
        return $destZip;
    }
}

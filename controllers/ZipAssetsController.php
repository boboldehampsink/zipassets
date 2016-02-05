<?php

namespace Craft;

/**
 * Zip Assets Controller.
 *
 * Route to download is here.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@nerds.company>
 * @copyright Copyright (c) 2016, Bob Olde Hampsink
 *
 * @link      http://github.com/boboldehampsink
 */
class ZipAssetsController extends BaseController
{
    /**
     * Allow anonymous access to controller.
     *
     * @var bool
     */
    protected $allowAnonymous = true;

    /**
     * Download zip.
     */
    public function actionDownload()
    {
       // Get wanted filename
        $filename = craft()->request->getRequiredParam('filename');

        // Get file id's
        $files = craft()->request->getRequiredParam('files');

        // Generate zipfile
        $zipfile = craft()->zipAssets->download($files, $filename);

        // Get zip filename
        $zipname = IOHelper::getFileName($zipfile);

        // Get zip filecontents
        $zip = IOHelper::getFileContents($zipfile);

        // Delete zipfile
        IOHelper::deleteFile($zipfile);

        // Download it
        craft()->request->sendFile($zipname, $zip, array('forceDownload' => true));
    }
}

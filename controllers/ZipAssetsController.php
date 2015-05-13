<?php

namespace Craft;

/**
 * Zip Assets Controller.
 *
 * Route to download is here.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, author
 * @license   http://buildwithcraft.com/license Craft License Agreement
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

        // Download it
        craft()->request->sendFile(IOHelper::getFileName($zipfile), IOHelper::getFileContents($zipfile), array('forceDownload' => true));
    }
}

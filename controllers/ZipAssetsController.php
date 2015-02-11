<?php

namespace Craft;

class ZipAssetsController extends BaseController
{

    protected $allowAnonymous = true;

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

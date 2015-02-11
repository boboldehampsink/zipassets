<?php
namespace Craft;

class ZipAssetsPlugin extends BasePlugin
{
    public function getName()
    {
        return Craft::t('Zip Assets');
    }

    public function getVersion()
    {
        return '1.3.0';
    }

    public function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }

    public function getDeveloperUrl()
    {
        return 'http://www.itmundi.nl';
    }
}

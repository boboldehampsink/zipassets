<?php
namespace Craft;

class ZipAssetsPlugin extends BasePlugin
{
    function getName()
    {
        return Craft::t('Zip Assets');
    }

    function getVersion()
    {
        return '1.2.1';
    }

    function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }

    function getDeveloperUrl()
    {
        return 'http://www.itmundi.nl';
    }
    
}
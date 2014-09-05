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
        return '1.1.0';
    }

    function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }

    function getDeveloperUrl()
    {
        return 'http://www.itmundi.nl';
    }
    
    function registerUnitTest() 
    {
    
        // Import the test
        Craft::import('plugins.zipassets.tests.ZipAssetsTest');
        
        // Return the test
        return new ZipAssetsTest();
    
    }
}
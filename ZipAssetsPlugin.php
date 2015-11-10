<?php

namespace Craft;

/**
 * Zip Assets Plugin.
 *
 * Zips up given assets for download.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@itmundi.nl>
 * @copyright Copyright (c) 2015, author
 * @license   http://buildwithcraft.com/license Craft License Agreement
 *
 * @link      http://github.com/boboldehampsink
 */
class ZipAssetsPlugin extends BasePlugin
{
    /**
     * Get plugin name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Zip Assets');
    }

    /**
     * Get plugin version.
     *
     * @return string
     */
    public function getVersion()
    {
        return '1.5.0';
    }

    /**
     * Get plugin developer.
     *
     * @return string
     */
    public function getDeveloper()
    {
        return 'Bob Olde Hampsink';
    }

    /**
     * Get plugin developer url.
     *
     * @return string
     */
    public function getDeveloperUrl()
    {
        return 'http://www.itmundi.nl';
    }

	function init() {
		if (craft()->request->isCpRequest() && craft()->userSession->isLoggedIn()) {
			craft()->templates->includeJsResource("zipassets/js/zipassets.js");
			craft()->templates->includeCssResource("zipassets/css/zipassets.css");
		}
	}
}

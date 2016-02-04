<?php

namespace Craft;

/**
 * Zip Assets Test.
 *
 * Unit test for zip assets.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@nerds.company>
 * @copyright Copyright (c) 2016, Bob Olde Hampsink
 *
 * @link      http://github.com/boboldehampsink
 */
class ZipAssetsTest extends BaseTest
{
    /**
     * Set up test.
     */
    public function setUp()
    {
        // Load plugins
        $pluginsService = craft()->getComponent('plugins');
        $pluginsService->loadPlugins();
    }

    /**
     * Test download action.
     */
    public function testActionDownload()
    {
        // fetch random assets
        $criteria = craft()->elements->getCriteria(ElementType::Asset);
        $criteria->limit = 2;

        // send asset ids and generate zip
        $zipfile = craft()->zipAssets->download($criteria->ids(), 'testzip');

        // check if we got a zip
        $this->assertFileExists($zipfile);
    }
}

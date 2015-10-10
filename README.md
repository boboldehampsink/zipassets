Zip Assets plugin for Craft CMS
=================

Plugin that downloads a zipfile with a selection of assets.

Important:
The plugin's folder should be named "zipassets"

Example
=================
```html
<form method="post" target="_blank">
	{{ getCsrfInput() }}
    <input type="hidden" name="action" value="zipAssets/download">
    <input type="hidden" name="filename" value="your-zipfile">

    <input type="checkbox" name="files[]" value="123"><!-- asset id -->
    <input type="checkbox" name="files[]" value="234"><!-- asset id -->

    <input type="submit" value="Download!">
</form>
```

Via url:
/actions/zipAssets/download?filename=your-zipfile&files[]=123&files[]=234

Roadmap
=================
 - Support for Asset Element Actions in Craft 2.3

Changelog
=================
###1.5.0###
 - Use original filenames in zip

###1.4.2###
 - Remove temporary zip after download

###1.4.1###
 - Remove temporary zip assets

###1.4.0###
 - Added support for all asset source types, so cloud files are now also supported
 - Added a MIT license

###1.3.0###
 - Added support for assets in subfolders

###1.2.1###
 - Fixed a bug where the asset path was parsed with the wrong variables

###1.2.0###
 - Now supports source paths with objects (i.e. "{path}/assets")

###1.1.0###
 - Now also callable as a service
 - Now uses Craft's interal zip system
 - Added unit tests

###1.0.1###
 - You can now also download assets via GET

###1.0###
 - Initial release

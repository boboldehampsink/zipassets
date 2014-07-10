Zip Assets plugin for Craft CMS
=================

Plugin that downloads a zipfile with a selection of assets.


Example
=================
```html
<form method="post" target="_blank">
    <input type="hidden" name="action" value="zipAssets/download">
    <input type="hidden" name="filename" value="your-zipfile">
    
    <input type="checkbox" name="files[]" value="123"><!-- asset id -->
    <input type="checkbox" name="files[]" value="234"><!-- asset id -->
    
    <input type="submit" value="Download!">
</form>
```

Changelog
=================
###1.0###
 - Initial release
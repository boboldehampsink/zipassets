<?php

namespace Craft;

/**
 * Zip Assets Element Action.
 *
 * @author    Bob Olde Hampsink <b.oldehampsink@nerds.company>
 * @copyright Copyright (c) 2016, Bob Olde Hampsink
 *
 * @link      http://github.com/boboldehampsink
 */
class ZipAssets_DownloadFilesElementAction extends BaseElementAction
{
    /**
     * Get element action name.
     *
     * @return string
     */
    public function getName()
    {
        return Craft::t('Download files');
    }

    /**
     * Get element action trigger html.
     *
     * @return string|null
     */
    public function getTriggerHtml()
    {
        $js = <<<EOT
(function() {
    var trigger = new Craft.ElementActionTrigger({
        handle: 'ZipAssets_DownloadFiles',
        batch: true,
        validateSelection: function(\$selectedItems) {
            return \$selectedItems.length > 1;
        },
        activate: function(\$selectedItems) {
            var elementIds = Craft.elementIndex.getSelectedElementIds();
            var fileInputs = '';

            for (var i = 0; i < elementIds.length; ++i) {
                fileInputs += '<input type="hidden" name="files[]" value="'+elementIds[i]+'">';
            }

            var form = $('<form method="post" target="_blank">' +
            '<input type="hidden" name="action" value="zipAssets/download">' +
            '<input type="hidden" name="filename" value="assets">' +
            fileInputs +
            '<input type="hidden" name="{csrfName}" value="{csrfValue}" />' +
            '<input type="submit" value="Submit">' +
            '</form>');

            form.appendTo('body');
            form.submit();
            form.remove();
        }
    });
})();
EOT;

        $js = str_replace("{csrfName}", craft()->config->get('csrfTokenName'), $js);
        $js = str_replace("{csrfValue}", craft()->request->getCsrfToken(), $js);

        craft()->templates->includeJs($js);
    }
}

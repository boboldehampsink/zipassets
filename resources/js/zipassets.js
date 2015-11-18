$(function(){
    $(".elementselect").each(function(){
        var $assetwrapper = $(this);
        var foundasset = false;
        var data = {"filename": Craft.t("assets.zip") };
        var files = [];
                
        $assetwrapper.find(".element.linked").each(function(){
            var $assetitem = $(this);           
            files.push($assetitem.attr('data-id'));
            foundasset = true;
        })
        
        data["files"] = files;
        if (foundasset) {
            var $a = $("<a class=''>" + Craft.t("Download All") + "</a>")
                .attr("href", Craft.getActionUrl('zipAssets/download', data))
                .attr("title", Craft.t("Download"))
                .addClass("btn")
                .addClass("dashed")
                .addClass("sharebtn")
                .addClass("icon")
                .appendTo($assetwrapper)
            $assetwrapper
                .append($a);
        }
    })
});
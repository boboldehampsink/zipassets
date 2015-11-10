$(function(){
	$(".elementselect").each(function(){
		var $assetwrapper = $(this);
		var linkurl = "/actions/zipAssets/download?filename=assets.zip";
		var foundasset = false;
		
		$assetwrapper.find(".element.linked").each(function(){
			var $assetitem = $(this);			
			linkurl = linkurl + "&files[]=" + $assetitem.attr('data-id');
			foundasset = true;
		})
		
		if (foundasset) {
			var $a = $("<a class=''>Download All</a>")
				.attr("href", linkurl)
				.attr("target", "_blank")
				.attr("title", "Download")
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
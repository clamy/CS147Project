// montage.js
// ----------
// This script builds a montage of photos.

site.montage = function(lat,lng,target_element) {
    var images, places, that;

    // We save a reference to this function.
    that = this;
	
    this.addThumbnail = function (width_percent, height_percent) {
		 var anchor_tag, image_tag;
		 anchor_tag = $("<a class=\"serentripity-place-anchor\"  data-ajax=\"false\">");
		 image_tag = $("<img class=\"serentripity-place-image\" width=\""
			 + width_percent
			 + "%\" height=\""
			 + height_percent
			 + "%\" />");
		  return anchor_tag.append(image_tag);
	};
	
	this.getSoloBlock = function () {
		console.log("Adding solo block to the list.");
		var anchor_tag = this.addThumbnail("100", "100");
		var new_block = $("<div class=\"ui-grid-solo\"></div>")
			.append($("<div class=\"ui-block-a\"></div>").append('<p class="serentripity-place-distance"></p>').append(anchor_tag));
		return new_block;
	};
	
	this.generateBlocks = function (num_blocks) {
		
		while (num_blocks--) {
			target_element.append( this.getSoloBlock());
			
		}
	};
	
	this.fillPlaceInfo = function (places) {
		
			
			$("a.serentripity-place-anchor").each(function(i, obj){
				$(obj).attr("href", 'info_page.php?id='+places[i].id);
			});
			$("p.serentripity-place-distance").each(function(i,obj){
				
				var distance = parseFloat(places[i].distance);
				distance = distance.toFixed(1);
				console.log(distance);
				$(obj).append(distance+" miles");
			});
			
			
		
	};
	this.fillPlaceImages = function (places){
		$("img.serentripity-place-image").each(function(i,obj){
			
			site.getImages(places[i].id, function( images){
				console.log(images);
				console.log(obj);
				$(obj).attr("src",'img/places/'+images[0].file);
			});
		});
	};
	
	this.getMultiBlockCode = function (places, wide_images, tall_images) {
		var left_column, right_column_start, right_column;
		left_column = "<div class=\"ui-grid-a\"><div class=\"ui-block-a\" >";
		right_column = "</div><div class=\"ui-block-b\">";
		 if (places.length == 3) {
			 left_column = left_column + getThumbnailCode(places[0],
					 tall_images[0], "50", "100");
			 right_column = right_column
				 + getThumbnailCode(places[1], tall_images[1], "50", "50")
				 + getThumbnailCode(places[2], tall_images[2], "50", "50");
		 } else {
			 left_column = left_column
				 + getThumbnailCode(places[0], tall_images[0], "50", "50")
				 + getThumbnailCode(places[1], tall_images[1], "50", "50");
			 right_column = right_column
				 + getThumbnailCode(places[2], tall_images[2], "50", "50")
				 + getThumbnailCode(places[3], tall_images[3], "50", "50");
		 }
		 return left_column + right_column + "</div></div>";
	};
	
    this.buildMontage = function(places) {
        console.log("Building the montage.");
		this.generateBlocks(places.length);
        this.fillPlaceInfo(places);
		this.fillPlaceImages(places);
    };

    site.getPlaces(lat,lng,function (data) { that.buildMontage(data); });
};
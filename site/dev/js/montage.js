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
		 if (
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
		
	this.getMultiBlock = function (places, wide_images, tall_images, num_images) {
		console.log("Adding multi block to the list.");
		var grid, left_column, right_column_start, right_column;
		grid = $("<div class=\"ui-grid-a\"></div>");
		left_column = $("<div class=\"ui-block-a\"></div>");
		right_column = "<div class=\"ui-block-b\"></div>";
		if (num_images > 2) {
			right_column.append(this.addThumbnail("50", "50"));
			right_column.append(this.addThumbnail("50", "50"));
			if (num_images > 3) {
				left_column.append(this.addThumbnail("50", "50"));
				left_column.append(this.addThumbnail("50", "50"));
			} else {
				left_column.append(this.addThumbnail("50", "100"));
			}
		} else {
			left_column.append(this.addThumbnail("50", "100"));
			right_column.append(this.addThumbnail("50", "100"));
		}
		return grid.append(left_column).append(right_column);
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
	
    this.buildMontage = function(places) {
        console.log("Building the montage.");
		this.generateBlocks(places.length);
        this.fillPlaceInfo(places);
		this.fillPlaceImages(places);
    };

    site.getPlaces(lat,lng,function (data) { that.buildMontage(data); });
};
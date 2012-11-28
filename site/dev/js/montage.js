// montage.js
// ----------
// This script builds a montage of photos.

site.montage = function(lat,lng,target_element) {
    var images, places, that;

    // We save a reference to this function.
    that = this;
	
	function flipCoin() {
		return Math.random() > 0.5 ;
	}
	
    this.addThumbnail = function (tall) {
		var anchor_tag, image_tag;
		anchor_tag = $("<a class=\"serentripity-place-anchor\" data-ajax=\"false\">");
		if (tall) {
		    anchor_tag.addClass("serentripity-place-image-tall");
		} else {
		    anchor_tag.addClass("serentripity-place-image-wide");
		}
		anchor_tag.addClass("serentripity-place-distance");
		return anchor_tag;
	};
	
	this.getSoloBlock = function () {
		console.log("Adding solo block to the list.");
		var anchor_tag = this.addThumbnail(false);
		var new_block = $("<div class=\"ui-grid-solo\"></div>")
			.append($("<div class=\"ui-block-a\"></div>")
			.append(anchor_tag));
		return new_block;
	};

	this.getMultiBlock = function (num_images) {
		console.log("Adding multi block to the list.");
		var grid, left_column, right_column_start, right_column;
		grid = $("<div class=\"ui-grid-a\"></div>");
		left_column = $("<div class=\"ui-block-a\"></div>");
		right_column = $("<div class=\"ui-block-b\"></div>");
		if (num_images == 2) {
			left_column.append(this.addThumbnail(true));
			right_column.append(this.addThumbnail(true));
		} else if (num_images == 3) {
			left_column.append(this.addThumbnail(true));
			right_column.append(this.addThumbnail(false));
			right_column.append(this.addThumbnail(false));
		}
		return grid.append(left_column).append(right_column);
	};

	this.generateBlocks = function (places) {
		console.log("Generating the blocks.");
		var places_added = 0;
		for (var i = 0; i < places.length; i += places_added) {
			if (i + 2 < places.length 
				&& (places[i].score * 0.95 <= places[i + 2].score)) {
				places_added = 2 + flipCoin();
			} else {
				places_added = 1;
			}
			console.log("Decided to add " + places_added + " place(s).");
			if (places_added == 1) {
				target_element.append(this.getSoloBlock());
			} else {
				target_element.append(this.getMultiBlock(places_added));
			}
		}
	};
	
	this.fillPlaceInfo = function (places) {
		$(".serentripity-place-anchor").each(function(i, obj) {
			$(obj).attr("href", 'info_page.php?id='+places[i].id);
		});
		$(".serentripity-place-distance").each(function(i,obj){
			var distance = parseFloat(places[i].distance);
			distance = distance.toFixed(1);
			$(obj).append(distance + " miles");
		});
	};

	this.fillPlaceImages = function (places) {
	    $(".serentripity-place-anchor").each(function(i, obj) {
	        console.log("Filling image " + i);
            var image_mode;
			image_mode = $(obj).hasClass("serentripity-place-image-tall") ? "h" : "w";
			site.getImagesByMode(places[i].id, image_mode, function (images) {
			    console.log("Fetched images: ");
		        console.log(images);
				// TODO(all): make sure there are enough images for each monument!
		        console.log("Choosing image mode " + image_mode);
	            var image_path;
				image_path = "img/places/" + images[0].file;
	            $(obj).css("background-image", "url('" + image_path + "')");
				//$(obj).css("background-size", "100% auto");
			});
		});
	};

    this.buildMontage = function(places) {
        console.log("Building the montage.");
		this.generateBlocks(places);
        this.fillPlaceInfo(places);
		this.fillPlaceImages(places);
    };

    site.getPlaces(lat,lng,function (data) { that.buildMontage(data); });
};

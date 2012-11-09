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
	
	// TODO(yacinem): width_percent, height_percent don't do anything, investigate this
	// and maybe remove them.
    this.addThumbnail = function (width_percent, height_percent, tall) {
		 var anchor_tag, image_tag;
		 anchor_tag = $("<a class=\"serentripity-place-anchor\"  data-ajax=\"false\">");
		 image_tag = $("<img class=\"serentripity-place-image\" width=\""
			 + width_percent
			 + "%\" height=\""
			 + height_percent
			 + "%\" />");
		 if (tall) {
			 image_tag.addClass("serentripity-place-image-tall");
		 } else {
			 image_tag.addClass("serentripity-place-image-wide");
		 }
		 return anchor_tag.append(image_tag);
	};
	
	this.getSoloBlock = function () {
		console.log("Adding solo block to the list.");
		var anchor_tag = this.addThumbnail("100", "100", false);
		var new_block = $("<div class=\"ui-grid-solo\"></div>")
			.append($("<div class=\"ui-block-a\"></div>")
			.append('<p class="serentripity-place-distance"></p>')
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
			left_column.append(this.addThumbnail("100", "100", true));
			right_column.append(this.addThumbnail("100", "100", true));
		} else if (num_images == 3) {
			left_column.append(this.addThumbnail("100", "100", true));
			right_column.append(this.addThumbnail("100", "50", false));
			right_column.append(this.addThumbnail("100", "50", false));
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
			$("a.serentripity-place-anchor").each(function(i, obj){
				$(obj).attr("href", 'info_page.php?id='+places[i].id);
			});
			$("p.serentripity-place-distance").each(function(i,obj){
				var distance = parseFloat(places[i].distance);
				distance = distance.toFixed(1);
				$(obj).append(distance + " miles");
			});
	};

	this.fillPlaceImages = function (places) {
		$("img.serentripity-place-image").each(function(i, obj){
			var aspect_ratio, image_mode;
			/*
			// Select a wide or tall image depending on the aspect ratio.
			aspect_ratio = $(obj).width() / $(obj).height();
			console.log("Aspect ratio " + aspect_ratio);
		 	image_index =  aspect_ratio >= 1 ? 0 : 1;
			*/
			image_mode = $(obj).hasClass("serentripity-place-image-tall") ? "h" : "w";
			site.getImagesByMode(places[i].id, image_mode, function(images) {
				console.log("Fetched images: ");
				console.log(images);
				// TODO(all): make sure there are enough images for each monument!
				console.log("Choosing image mode " + image_mode);
				$(obj).attr("src", "img/places/" + images[0].file);
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

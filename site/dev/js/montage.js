// montage.js
// ----------
// This script builds a montage of photos.

site.montage = function(target_element) {
    var images, places, that;

    // We save a reference to this function.
    that = this;

    this.getThumbnailCode = function (
        place, width_percent, height_percent, wide, callback) {
		 // We first create the elements.
		 var anchor_tag, image_tag;
		 anchor_tag = $("<a href=\"info_page.php?place="
			 + place.id
			 + "\">");
		 image_tag = $("<img width=\""
			 + width_percent
			 + "%\" height=\""
			 + height_percent
			 + "%\" />");
	     // Now we set up an AJAX call that will set up the source of the image when
		 // it has been fetched from the database.
	     var that = this;
		 function addImageUrl(images) {
			 console.log(images);
			 var url;
	         if (wide) {
				 url = images[0].file;
			 } else {
				 url = images[1].file;
			 }
			 url = "img/places/" + url;
			 console.log("adding image url " + url);
		 	 image_tag.attr("src", url);
			 anchor_tag.append(image_tag);
			 callback(anchor_tag);
		 }
 		 site.getImages(place.id, addImageUrl);
	};
	
	this.getSoloBlockCode = function (place, wide_image, callback) {
       	this.getThumbnailCode(place, "100", "100", true, function (anchor_tag) {
			var new_block = $("<div class=\"ui-grid-solo\"></div>")
				.append($("<div class=\"ui-block-a\"></div>").append(anchor_tag));
			new_block.append("");
			callback(new_block);
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
		//target_element.collapsibleset();
        for (var i = 0; i < places.length; ++i) {
            site.getImages(places[0].id, function (images) {
				function callback(new_block) {
					target_element.append(new_block);

				}
				that.getSoloBlockCode(places[0], images[0], callback);
            });
        }
    };

    site.getPlaces(function (data) { that.buildMontage(data); });
};
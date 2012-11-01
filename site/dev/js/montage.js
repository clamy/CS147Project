// montage.js
// ----------
// This script builds a montage of photos.

site.montage = {};
site.montage.getThumbnailCode = function (
        place, image, width_percent, height_percent) {
     var anchor_tag, anchor_tag_close, image_tag;
     anchor_tag = "<a href=\"info_page?place="
         + place.id
         + "\" data-icon=\"arrow-l\">";
     image_tag = "<img src=\"img/places/"
         + wide_image
         + "\" width=\""
         + width
         + "%\" height=\""
         + height
         + "%\"/>";
     anchor_tag_close = "</a>";
     return anchor_tag + image_tag + anchor_tag_close;
};

site.montage.getSoloBlockCode = function (place, wide_image) {
    return "<div class=\"ui-grid-solo\"><div class=\"ui-block-a\">"
        + getThumbnailCode(place, wide_image, "100", "100")
        + "</div></div>";
};

site.montage.getMultiBlockCode = function (places, wide_images,
        tall_images) {
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
   
site.montage.buildMontage = function (montage_settings) {
    var montage_element;
    montage_element =  $("#serentripity-montage");

    start_index = 0;
	while (start_index < montage_settings.places.length) {
        start_index += num_images_in_block;
    }
};

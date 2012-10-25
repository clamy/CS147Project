// montage.js
// ----------
// This script builds a montage of photos.

site.montage = function (montage_settings) {
    var get_block, montage_list, start_index;
    montage_list =  $("ol#serentripity-montage");

    get_block = function (places, start_index, num_images) {
        console.log("Getting a new block of list elements.");
        var new_block = $("<ol />").appendTo(montage_list);
        for (var i = start_index; i < start_index + num_images; ++i) {
            console.log("Distance (miles): " + places[i].distance_miles);
            var new_li = $("<li />");
            var new_block_element = $("<a />")
                .append(places[i].distance_miles + " mi");
            new_block_element.attr("href", places[i].page_url);
            new_li.css("background-image",
                       "url(\"" + places[i].image_url + "\")")
            new_block_element.appendTo(new_li);
            new_li.appendTo(new_block);
        }
        console.log(new_block);
        return new_block;
    }

    start_index = 0;
	while (start_index < montage_settings.places.length) {
        var block, num_images_in_block;
        num_images_in_block =
            Math.min(3, montage_settings.places.length - start_index);
        block = get_block(montage_settings.places, start_index,
                          num_images_in_block).appendTo(montage_list);
        start_index += num_images_in_block;
    }
};
site.getPlaces = function (lat,lng,callback) {
    function success(places) {
        console.log("Successfully fetched places: ");
        console.log(places);
        callback(places);
    }
	
	
    var ajax_request = $.getJSON(
        "php/get_places.php",
        {longitude: lng, latitude: lat},
        success);
};

site.getImages = function (place_id, callback) {
    function success(data) {
        callback(data);
    }
    var ajax_request = $.getJSON(
        "php/get_pictures.php",
        {place_id: place_id},
        success);
};

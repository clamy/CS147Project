site.getPlaces = function (callback) {
    function success(places) {
        console.log("Successfully fetched places: ");
        console.log(places);
        callback(places);
    }
    var ajax_request = $.getJSON(
        "php/get_places.php",
        {longitude: 0, latitude: 0},
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

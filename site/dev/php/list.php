<div data-role="page">
<div id="header" data-role="header">
<a id="serentripity-back-button" href="<?php echo $last_page ?>">Back</a>

<h1>Serentripity</h1>
<form id="serentripity-logout-form" action="index.php" method="post">
	<input type="hidden" name="logout" value="1" />
</form>
<a id="serentripity-logout-button">Logout</a>
<a id="serentripity-help-button">Help</a>
</div><!-- /header -->

<div data-role="content">
<h2>Welcome <?php echo $username; ?>. Places near you:</h2>
<ol id="serentripity-montage">
</ol>
<script>
var page = {}; 
page.montage_settings = {
    places: [
        {
            image_url: "img/places/main_quad.png",
            distance_miles: 0,
            importance_score: 1,
            page_url: "main_quad.htm"
        },
        {
            image_url: "img/places/memchu.jpg",
            distance_miles: 0.11,
            importance_score: 0.8,
            page_url: "memchu.htm"
        },
        {
            image_url: "img/places/burghers.jpg",
            distance_miles: 0.11,
            importance_score: 0.8,
            page_url: "burghers.htm"
        },
        {
            image_url: "img/places/oval.jpg",
            distance_miles: 0.11,
            importance_score: 0.7,
            page_url: "oval.htm"
        },
        {
            image_url: "img/places/hoover.jpg",
            distance_miles: 0.15,
            importance_score: 1,
            page_url: "hoover.htm"
        },
        {
            image_url: "img/places/totem.jpg",
            distance_miles: 0.17,
            importance_score: 0.4,
            page_url: "totem.htm"
        },
        {
            image_url: "img/places/rodin.jpg",
            distance_miles: 1.4,
            importance_score: 0.6,
            page_url: "rodin.htm"
        },
    ]
};
site.montage(page.montage_settings);

$('#serentripity-logout-button').bind('click', function() {
	$('#serentripity-logout-form').submit();
});
</script>
</div><!-- /content -->
</div><!-- /page -->


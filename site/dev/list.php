<?php
require("../lib/session.php");
require("php/header.php");
?>
<div data-role="page" data-add-back-btn="true">

	<div data-role="header" data-theme="a">
    	<a href="loading.php" data-icon="arrow-l">Back</a>
		<h1>Serentripity</h1>
        <a href="#popupHelp" data-rel="popup" data-position-to="window" data-transition="fade" data-icon="info">Help</a>
	</div><!-- /header -->

	<div data-role="content" data-theme="a">
        <!-- Username <?php echo $username ?> -->
    	<div id="serentripity-montage">
   			<h3>Less than 0.5 miles away</h3>
    	</div>
    	<div data-role="popup" id="popupHelp" data-theme="a" class="ui-corner-all">
    		<a href="#" data-rel="back" data-role="button" data-theme="a" data-icon="delete" data-iconpos="notext" class="ui-btn-right">Close</a>
    		<p>This is the help page</p>
    	</div>
    </div>
</div>

<script>
var montage_element;
montage_element =  $("#serentripity-montage");
site.montage(montage_element);
</script>


<?php
require("php/footer.php");
?>

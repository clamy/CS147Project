<div data-role="page">
	<div data-role="content" data-theme="a">
   <?php
		// This is a hack. You should connect to a database here.
		if ($_POST["username"] == "test" && $_POST["password"] == "test") {
			
		}
		
	?>
    	<div class="ui-grid-solo">
			<div class="ui-block-a">
        		<img width="100%" src="img/logo_loading.png" />
    			<form action="list.php" method="post" data-ajax="false">
                    <label for="user">Username:</label>
                    <input type="text" name="username" id="user">
                    <label for="pass">Password:</label>
                    <input type="password" name="password" id="pass">
                    <input type="submit" value="Login">
				</form>
    		</div>
    	</div>
    </div>
</div>

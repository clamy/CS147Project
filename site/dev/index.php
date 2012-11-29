<?php
// TODO(yacinem): fix bug where this page is not refreshed and the login information is not displayed.
// This happens when using the back button.
// Update: I *think* I've fixed this - yacinem

session_start();
if ($_POST["logout"]) {
    echo "<!-- logging out -->";
    $_SESSION = array();
    session_destroy();
}
if ($_POST["username"] && !$_POST["logout"]) {
    $_SESSION["username"] = $_POST["username"];
    $_SESSION["token"] = $_POST["token"];
    die();
}

require("php/header.php");
?>

<div data-role="page" class="serentripity-page">
	<div data-role="content" data-theme="a">
        <img width="100%" src="img/logo_loading.png" />
        <p id="serentripity-intro">Serentripity is a tourism app that lets you explore monuments and places of interest around you.</p>
        <p id="serentripity-login-message"></p>
        <a id="serentripity-explore-button" data-role="button" href="list.php" data-ajax="false">Find places around me</a>
        <a id="serentripity-login-button" data-role="button" href="#" data-ajax="false">Login or Register</a>
        <form id="serentripity-login-form" action="" data-ajax="false" method="post">
            <input id="serentripity-login-username" type="text" name="username" placeholder="Username" data-mini="true" />
            <input id="serentripity-login-password" type="password" name="password" placeholder="Password" data-mini="true"/>
            <div id="serentripity-login-submit">
                <input name="submit-option" type="submit" value="Login" data-mini="true" />
                <input name="submit-option" type="submit" value="Register" data-mini="true" />
            </div>
            <p id="serentripity-login-error"></p>
        </form>
        <form id="serentripity-logout-form" action="index.php" data-ajax="false" method="post">
            <input type="hidden" name="logout" value="true"/>
            <input type="submit" id="serentripity-logout-button" value="Logout" />
        </form>
    </div>
    <script>
    // This function creates a message that acknowledges login.
    function fillLoggedInMessage() {
        $("#serentripity-login-message").append("Logged in as " + session_data.username);
    }

    // This function makes the login form disappear and replaces it with the logout
    // button and the login message.
    function fadeToLoggedInPage() {
        fillLoggedInMessage();
        $("#serentripity-login-form").fadeOut(function () {
            $("#serentripity-login-message").fadeIn();
            $("#serentripity-logout-form").fadeIn();
        });
    }

    // This function handles the response from the AJAX call that is made upon
    // submission of the login / register form.
    function handleFormResponse(response) {
        console.log(response);
        if (response.login_error) {
            console.log("Got a wrong login");
            $("#serentripity-login-error").text(response.login_error);
            $("#serentripity-login-error").fadeIn();
        } else if (response.register_error) {
            console.log("Got a registration error");
            $("#serentripity-login-error").text(response.register_error);
            $("#serentripity-login-error").fadeIn();
        } else {
            console.log("Got good login");
            $.extend(session_data, response);
            fadeToLoggedInPage();
            $.ajax({
                type: "post",
                data: response,
                url: "index.php"
            });
        }
    }

    // We bind a function to the "submit" event for the login form.
    $("#serentripity-login-form").submit(function (e) {
        console.log("Login form submitted");
        // Prevent the default behavior from firing.
        e.preventDefault();
        var login_data = $("#serentripity-login-form").serializeArray();
        $.ajax({
            type: "post",
            url: "php/login_or_register.php",
            data: login_data,
            dataType: "JSON",
            success: handleFormResponse
        });
    });
	
	// We make the login / register form appear when the login / register button is pressed.
	$("#serentripity-login-button").click(function (e) {
		console.log("Displaying login form");
		$("#serentripity-login-button").fadeOut(function () {
			$("#serentripity-login-form").fadeIn();
		});
	});

    // Once the document is ready, we should display the appropriate elements
    // depending on the user's session status.
    $(document).ready(function () {
    //$(".serentripity-page").bind("pagebeforeshow", function () {
        console.log("document is ready");
        if (session_data.username) {
            fillLoggedInMessage();
            $("#serentripity-login-message").show();
            $("#serentripity-logout-form").show();
        } else {
            $("#serentripity-login-button").css("display", "block");
        }
    });
    </script>
</div>



<?php
require("php/footer.php");
?>

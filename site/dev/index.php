<?php
require("php/header.php");
?>

<div data-role="page">
	<div data-role="content" data-theme="a">
        <img width="100%" src="img/logo_loading.png" />
        <a id="serentripity-explore-button" data-role="button" href="list.php">Find places around me</a>
        <form id="serentripity-login-form" action="" data-ajax="false" method="post">
            <input id="serentripity-login-username" type="text" name="username" placeholder="Username" data-mini="true" />
            <input id="serentripity-login-password" type="password" name="password" placeholder="Password" data-mini="true"/>
            <div id="serentripity-login-submit">
                <input name="submit-option" type="submit" value="Login" data-mini="true" />
                <input name="submit-option" type="submit" value="Register" data-mini="true" />
            </div>
            <p id="serentripity-login-error"></p>
        </form>
        <p id="serentripity-login-message"></p>
    </div>
</div>

<script>
//var user_info = <?php json_encode(user_info); ?>;

function fadeToLoggedInPage(login_response) {
    $("#serentripity-login-form").fadeOut(function () {
        $("#serentripity-login-message").fadeIn();
    });
    $("#serentripity-login-message").append("Logged in as " + login_response.username);
}

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
        fadeToLoggedInPage(response);
    }
}
$(document).ready(function () {
    console.log("document is ready");
    $("#serentripity-login-form").show();
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
    /*
    // Check if the user is logged.
    if (user_info.wrong_login || !user_info.token) {
        console.log("No valid username found.");
        $("#serentripity-login-form").show();
    } else {
        $("#serentripity-login-message").show();
    }
    // If the user did an unsuccessful login attempt, display an error message.
    if (user.info.wrong_login) {
        $("#serentripity-login-error").show();
    }
    */
});
</script>

<?php
require("php/footer.php");
?>

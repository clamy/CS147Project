<div data-role="page">
  <div data-role="content" class="ui-content">
    <p>
      <img width="200" src="img/logo_loading.png" />
    </p>
    <h4>
      Login to find places near you.
    </h4>
    <p>
      <form action="index.php" method="post" data-ajax="false">
        <fieldset>
          <div data-role="field-contain">
            <label for="username">Username:</label>
            <input type="text" name="username" id="username" />
          </div>
          <div data-role="field-contain">
            <label for="password">Password:</label>
            <input type="password" name="password" id="password" />
            <input type="submit" value="Login" />
          </div>
        </fieldset>
      </form>
      <a href="list.php" data-role="button">Continue without login</a>
    </p>
  </div>
</div>

<?php
$title = 'Register';
require('shared/header.php');
?>
<h2>User Registration</h2>
  <h5>Passwords must be a minimum of 8 characters,
    including 1 digit, 1 upper-case letter, and 1 lower-case letter.
  </h5>
  <?php
  if (!empty($_GET['duplicate'])) {
    echo '<h4 class="err">Username already exists</h4>';
  }
  ?>
  <form method="post" action="save-registration.php">
    <fieldset>
      <label for="username">Username: *</label>
      <input name="username" id="username" required type="email" placeholder="email@email.com" />
    </fieldset>
    <fieldset>
      <label for="password">Password: *</label>
      <input type="password" name="password" id="password" required
          pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /><img id="showHide" src="img/show.png" alt="Show/Hide"
            onclick="togglePassword();" />
    </fieldset>
    <fieldset>
      <label for="confirm">Confirm Password: *</label>
      <input type="password" name="confirm" id="confirm" required 
        onkeyup="return comparePasswords();"
        pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" /><span id="pwErr"></span>
    </fieldset>
    <button class="offset-button" onclick="return comparePasswords();">Register</button>
  </form>
</main>
</body>
</html>

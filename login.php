<?php
include_once 'header.php';
?>

<section class="signup-form">
  <h2>Log In</h2>
  <form action="includes/login.inc.php" method="post">
    <div class="signup-form-form">

      <input type="text" name="name" placeholder="Username/Email...">
      <input type="password" name="pwd" placeholder="Password...">

      <button type="submit" name="submit">Log In</button>

    </div>
  </form>
</section>

<?php
include_once 'footer.php';
?>
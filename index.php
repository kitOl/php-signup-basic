<?php

include_once 'header.php';

?>

<section class="index-intro">
  <?php if (isset($_SESSION['useruid'])) : ?>
    <p>Hello there <?= $_SESSION['useruid'] ?></p>
  <?php endif; ?>
  <h1>This is An Introduction</h1>
  <p>Here is an important paragraph that explains the purpose of the werbsite</p>
</section>

<section class="index-categories">
  <h2>Some Basic Categories</h2>
  <div class="index-categories-list">
    <div>
      <h3>Fun Stuff</h3>
    </div>
    <div>
      <h3>Serious Stuff</h3>
    </div>
    <div>
      <h3>Exciting Stuff</h3>
    </div>
    <div>
      <h3>Boring Stuff</h3>
    </div>
  </div>

</section>

<?php

include_once 'footer.php';

?>
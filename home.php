<?php
declare(strict_types=1);
require __DIR__.'/views/header.php';
require __DIR__.'/navbar.php';
require __DIR__.'/views/footer.php';
require __DIR__.'/footer.php';
?>

<h1>home</h1>
<?php $posts = getPosts($pdo)?>

<div class="posts-container">

</div>
<script type="text/javascript" src="assets/js/home.js">

</script>

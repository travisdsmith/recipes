<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><i class="fas fa-folder"></i> Categories</h1>
</div>
<?= output_message($message) ?>

<?php
$categories = Category::find_all();
foreach ($categories as $category) {
    echo "<br/>" . PHP_EOL;
    echo "<a class=\"btn btn-dark btn-lg btn-block\" type=\"button\" href=\"category_view.php?id={$category->id}\">" . PHP_EOL;
    echo "<i class=\"fas fa-folder\"></i> {$category->name}" . PHP_EOL;
    echo "</a>" . PHP_EOL;
}
?>

<?php
require_once(LAYOUT_PATH . DS . "footer.php");

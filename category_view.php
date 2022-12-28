<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");
?>

<?php
if (filter_input(INPUT_GET, "id") && $category = Category::find_by_id(filter_input(INPUT_GET, "id"))) {
    ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1><i class="fas fa-folder"></i> <?= $category->name ?></h1>
    </div>
    <?= output_message($message) ?>

    <?php
    $recipes = Recipe::find_by_category_id($category->id);
    if ($recipes) {
        echo "<div class=\"table-responsive\">" . PHP_EOL;
        echo "<table class=\"table table-striped table-lg\">" . PHP_EOL;
        echo "<thead><tr><th>Name</th><th></th></tr></thead><tbody>" . PHP_EOL;
        foreach ($recipes as $recipe) {
            $recipe = Recipe::find_by_id($recipe->id);
            echo "<tr>" . PHP_EOL;
            echo "<td>{$recipe->title}</td>" . PHP_EOL;
            echo "<td><a href=\"recipe_view.php?id={$recipe->id}\" type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"tooltip\" title=\"View Recipe\"><i class=\"fas fa-eye\"></i> View</a></td>" . PHP_EOL;
            echo "</tr>" . PHP_EOL;
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p>There is nothing in this category.</p>";
    }
} else {
    echo "<br/><br/><div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times-circle\"></i> ERROR: Category not found.</div>";
}
?>

<?php
require_once(LAYOUT_PATH . DS . "footer.php");

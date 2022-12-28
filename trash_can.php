<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><i class="fas fa-trash-alt"></i> Trash Can</h1>
</div>
<?= output_message($message) ?>

<?php
$recipes = Recipe::find_recipes_in_trash();
if ($recipes) {
    echo "<button type=\"button\" class=\"btn btn-danger btn-sm btn-block\"  data-toggle=\"modal\" data-target=\"#trashDialog\"><i class=\"fas fa-trash\"></i> Empty Trash</button>" . PHP_EOL;
    echo "<div class=\"table-responsive\">" . PHP_EOL;
    echo "<table class=\"table table-striped table-lg\">" . PHP_EOL;
    echo "<thead><tr><th>Name</th><th></th></tr></thead><tbody>" . PHP_EOL;
    foreach ($recipes as $recipe) {
        $recipe = Recipe::find_by_id($recipe->id);
        echo "<tr>" . PHP_EOL;
        echo "<td>{$recipe->title}</td>" . PHP_EOL;
        echo "<td><a href=\"recipe_view.php?id={$recipe->id}\" type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"tooltip\" title=\"View Recipe\"><i class=\"fas fa-eye\"></i> VIEW</a></td>" . PHP_EOL;
        echo "</tr>" . PHP_EOL;
    }
    echo "</tbody></table></div>";
} else {
    echo "<p>There is nothing in the trash</p>";
}
?>

<!-- Trash Modal -->
<div class="modal fade" id="trashDialog" tabindex="-1" role="dialog" aria-labelledby="Are you sure?" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Are you sure?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                You're about to empty the trash. Do you want to continue?
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-secondary" href="trash_empty.php" >Yes</a>
                <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
            </div>
        </div>
    </div>
</div>

<?php
require_once(LAYOUT_PATH . DS . "footer.php");

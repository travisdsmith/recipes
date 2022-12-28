<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");
?>

<?php
if (filter_input(INPUT_GET, "id") && $recipe = Recipe::find_by_id(filter_input(INPUT_GET, "id"))) {
    ?>

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1><i class="fas fa-folder"></i> <?= $recipe->title ?></h1>
    </div>
    <?= output_message($message) ?>
    <?php
    if ($recipe->trash == 0) {
        ?>
        <div class="row" id="recipeToolbar">
            <div class="col">
                <button type="button" class="btn btn-primary btn-sm btn-block"  data-toggle="modal" data-target="#noteDialog"><i class="fas fa-edit"></i> Add a Note</button>
            </div>
            <div class="col">
                <button onclick="window.print()" type="button" class="btn btn-info btn-sm btn-block"><i class="fas fa-print"></i> Print</button>
            </div>
            <?php
            $favorite = Favorite::find_favorite($session->user_id->id, $recipe->id);
            if ($favorite) {
                echo "<div class=\"col\">" . PHP_EOL;
                echo "<a href=\"favorite_remove.php?id={$favorite->id}\" type=\"button\" class=\"btn btn-warning btn-sm btn-block\"><i class=\"fas fa-minus-square\"></i> Remove from Favorites</a>" . PHP_EOL;
                echo "</div>" . PHP_EOL;
            } else {
                echo "<div class=\"col\">" . PHP_EOL;
                echo "<a href=\"favorite_add.php?recipe={$recipe->id}&user={$session->user_id->id}\" type=\"button\" class=\"btn btn-success btn-sm btn-block\"><i class=\"fas fa-star\"></i> Favorite</a>" . PHP_EOL;
                echo "</div>" . PHP_EOL;
            }
            ?>
            <div class="col">
                <button type="button" class="btn btn-danger btn-sm btn-block"  data-toggle="modal" data-target="#trashDialog"><i class="fas fa-trash"></i> Delete</button>
            </div>
        </div>

        <?php
    } else {
        ?>
        <a href="recipe_restore.php?id=<?= $recipe->id ?>" type="button" class="btn btn-primary btn-lg btn-block"> Restore Recipe</a>
        <?php
    }
    ?>
    <br/>
    <h2 class="h3"><?= Category::find_by_id($recipe->category_id)->name ?></h2>
    <p><?= str_replace("  ", "&nbsp;&nbsp;", nlnl2br($recipe->content)) ?></p>
    <?php
    $notes = Note::find_by_recipe_id($recipe->id);
    if ($notes) {
        echo "<h2>Notes</h2>" . PHP_EOL;
        foreach ($notes as $note){
            echo "<p>(<a href=\"note_remove.php?id={$note->id}\">delete</a>) " . User::find_by_id($note->user_id)->username . ": {$note->content}</p>";
            echo "<hr/>";
        }
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
                    You're about to send this recipe to the trash. Do you want to continue?
                </div>
                <div class="modal-footer">
                    <a type="button" class="btn btn-secondary" href="recipe_trash.php?id=<?= $recipe->id ?>" >Yes</a>
                    <button type="button" class="btn btn-primary" data-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Note Modal -->
    <form role="form" action="note_add.php" method="POST">
        <div class="modal fade" id="noteDialog" tabindex="-1" role="dialog" aria-labelledby="Add a Note" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add a Note</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <label for="note">Note</label>
                        <textarea class="form-control" name="content" id="content" rows="2"></textarea>
                        <input type="hidden" id="recipe_id" name="recipe_id" value="<?= $recipe->id ?>">

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                        <input class="btn btn-primary" href="note_add.php" type="submit" name="submit" value="Add" />
                    </div>
                </div>
            </div>
        </div>
    </form>

    <?php
} else {
    echo "<br/><br/><div class=\"alert alert-danger\" role=\"alert\"><i class=\"fa fa-times-circle\"></i> ERROR: Recipe not found.</div>";
}

require_once(LAYOUT_PATH . DS . "footer.php");

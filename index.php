<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><i class="fas fa-home"></i> Home</h1>
</div>
<?= output_message($message) ?>
<h2>Quick Actions</h2>
<div class="row">
    <div class="col">
        <a href="recipe_add.php" type="button" class="btn btn-dark btn-lg btn-block"><i class="fas fa-folder-plus"></i> Add a Recipe</a>
    </div>
    <div class="col">
        <a href="search.php" type="button" class="btn btn-secondary btn-lg btn-block"><i class="fas fa-search"></i> Search for Recipes</a>
    </div>
</div>
<br/>
<h2>Favorite Recipes</h2>
<?php
$favorites = Favorite::find_by_user_id($session->user_id->id);
if($favorites){
     echo "<div class=\"table-responsive\">" . PHP_EOL;
     echo "<table class=\"table table-striped table-lg\">" . PHP_EOL;
     echo "<thead><tr><th>Name</th><th></th></tr></thead><tbody>" . PHP_EOL;
     foreach ($favorites as $favorite){
         echo "<tr>" . PHP_EOL;
         echo "<td>" . Recipe::find_by_id($favorite->recipe_id)->title . "</td>" . PHP_EOL;
         echo "<td><a href=\"recipe_view.php?id={$favorite->recipe_id}\" type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"tooltip\" title=\"View Recipe\"><i class=\"fas fa-eye\"></i> View</a>&nbsp;" . PHP_EOL;
         echo "<a href=\"favorite_remove.php?id={$favorite->id}\" type=\"button\" class=\"btn btn-sm btn-warning\" data-toggle=\"tooltip\" title=\"Remove from Favorites\"><i class=\"fas fa-minus-square\"></i></a></td>" . PHP_EOL;
         echo "</tr>" . PHP_EOL;
     }
     echo "</tbody></table></div>";
     
} else {
    echo "<p>You don't have any favorites yet.</p>";
}
?>
<?php
require_once(LAYOUT_PATH . DS . "footer.php");

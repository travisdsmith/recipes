<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");
require_once(LAYOUT_PATH . DS . "header.php");

if (filter_input(INPUT_POST, 'submit')) {
    $terms = filter_input(INPUT_POST, 'terms');
    $title_only = filter_input(INPUT_POST, 'titleOnly');
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1><i class="fas fa-search"></i> Search</h1>
    </div>
    <?= output_message($message) ?>

    <h2>Results</h2>
    <?php
    $results = Recipe::search($terms, $title_only);
    if ($results) {
        echo "<div class=\"table-responsive\">" . PHP_EOL;
        echo "<table class=\"table table-striped table-lg\">" . PHP_EOL;
        echo "<thead><tr><th>Name</th><th></th></tr></thead><tbody>" . PHP_EOL;
        foreach ($results as $recipe) {
            $recipe = Recipe::find_by_id($recipe->id);
            echo "<tr>" . PHP_EOL;
            echo "<td>{$recipe->title}</td>" . PHP_EOL;
            echo "<td><a href=\"recipe_view.php?id={$recipe->id}\" type=\"button\" class=\"btn btn-sm btn-primary\" data-toggle=\"tooltip\" title=\"View Recipe\"><i class=\"fas fa-eye\"></i> VIEW</a></td>" . PHP_EOL;
            echo "</tr>" . PHP_EOL;
        }
        echo "</tbody></table></div>";
    } else {
        echo "<p>No results found.</p>";
    }
    ?>
    <?php
} else {
    ?>
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1><i class="fas fa-search"></i> Search</h1>
    </div>
    <?= output_message($message) ?>

    <h2>Criteria</h2>
    <form role="form" action="search.php" method="POST">
        <div class="form-group">
            <label for="terms">What do you want to search for?</label>
            <input type="text" class="form-control" id="terms" name="terms" placeholder="Enter Text Here...">
        </div>
        <div class="form-check form-check-inline">
            <label class="form-check-label">Where do you want to search?</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="titleOnly" id="title" value="1" checked>
            <label class="form-check-label" for="title">Just the title</label>
        </div>
        <div class="form-check form-check-inline">
            <input class="form-check-input" type="radio" name="titleOnly" id="entire" value="0">
            <label class="form-check-label" for="entire">The entire recipe</label>
        </div>
        <input type="submit" class="btn btn-primary" name="submit" value="Search" />
    </form>
    <?php
}

require_once(LAYOUT_PATH . DS . "footer.php");

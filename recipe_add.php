<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

if (filter_input(INPUT_POST, 'submit')) { // Form has been submitted.
    $title = trim(filter_input(INPUT_POST, 'title'));
    $content = trim(filter_input(INPUT_POST, 'content'));
    $category_id = trim(filter_input(INPUT_POST, 'category'));

    $recipe = new Recipe();
    $recipe->title = $title;
    $recipe->content = $content;
    $recipe->trash = 0;

    $category = new Category();
    if (!$category->find_by_id($category_id)) {
        $category->name = $category_id;
        if ($category->create()) {
            $recipe->category_id = $db->insert_id();
            if ($recipe->create()) {
                $session->message("success|Recipe successfully created with a new category.");
                redirect_to("recipe_view.php?id=" . $db->insert_id());
            } else {
                $message = "danger|Could not add category or recipe.";
            }
        } else {
            $message = "danger|Category added, but could not add recipe.";
        }
    } else {
        $recipe->category_id = $category_id;
        if ($recipe->create()) {
            $session->message("success|Recipe successfully created.");
            redirect_to("recipe_view.php?id=" . $db->insert_id());
        } else {
            $message = "danger|Could not add recipe.";
        }
    }
} else { // Form has not been submitted.
    $title = "";
    $content = "";
    $category_id = "";
}

require_once(LAYOUT_PATH . DS . "header.php");
?>

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><i class="fas fa-folder-plus"></i> Add Recipe</h1>
</div>
<?= output_message($message) ?>

<form role="form" action="recipe_add.php" method="POST">
    <div class="form-group">
        <label for="category">Category</label>
        <select class="form-control" name="category" id="category" required>
<?php
$categories = Category::find_all();
foreach ($categories as $item) {
    echo "<option value=\"$item->id\" " . ($category == $item->id ? "selected" : "") . ">{$item->name}</option>" . PHP_EOL;
}
?>
        </select>
    </div>
    <div class="form-group">
        <label for="title">Title</label>
        <input type="text" class="form-control" id="title" name="title" maxlength="255" placeholder="Type your title..." value="<?= $title ?>" required>
    </div>
    <div class="form-group">
        <label for="content">Recipe</label>
        <textarea class="form-control" id="content" name="content" rows="10" placeholder="Type your recipe..." required><?= $content ?></textarea>
    </div>
    <div class="form-group">
        <input type="submit" name="submit" class="btn btn-primary" value="Add Recipe"></input>
    </div>
</form>

<?php
require_once(LAYOUT_PATH . DS . "footer.php");

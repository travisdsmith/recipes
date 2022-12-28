<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="/assets/favicon.ico">

        <!-- Bootstrap CSS -->
        <link media="screen" rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link media="screen" rel="stylesheet" href="css/site.css">
        <link media="print" rel="stylesheet" href="css/print.css">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

        <title>Recipes</title>
    </head>
    <nav class="navbar navbar-dark fixed-top bg-dark flex-md-nowrap p-0 shadow">
        <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="index.php">Recipe Catalog</a>
        <ul class="navbar-nav px-3 d-none d-sm-block">
            <li class="nav-item text-nowrap">
                <a class="nav-link" href="logout.php"><i class="fas fa-sign-out-alt"></i> Log out</a>
            </li>
        </ul>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <nav class="col-md-2 d-none d-md-block bg-light sidebar">
                <div class="sidebar-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link" href="index.php">
                                <i class="fas fa-home"></i> Home
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="search.php">
                                <i class="fas fa-search"></i> Search
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="recipe_add.php">
                                <i class="fas fa-folder-plus"></i> Add Recipe
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="trash_can.php">
                                <i class="fas fa-trash-alt"></i> Trash Can
                            </a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="password.php">
                                <i class="fas fa-key"></i> Change Password
                            </a>
                        </li>
                    </ul>

                    <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
                        <span>Categories</span>
                    </h6>
                    <ul class="nav flex-column mb-2">
                        <?php
                        $categories = Category::find_all();
                        foreach ($categories as $category) {
                            echo "<li class=\"nav-item\">" . PHP_EOL;
                            echo "<a class=\"nav-link\" href=\"category_view.php?id={$category->id}\">" . PHP_EOL;
                            echo "<i class=\"fas fa-folder\"></i> {$category->name}" . PHP_EOL;
                            echo "</a></li>" . PHP_EOL;
                        }
                        ?>
                    </ul>
                </div>
            </nav>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
                <div class="d-none d-xs-block d-sm-block d-md-none" id="sDropdownMenu">
                    <br/>
                    <div class="dropdown">
                        <button class="btn btn-primary btn-lg btn-block dropdown-toggle" type="button" id="sDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i> MENU
                        </button>
                        <div class="dropdown-menu" aria-labelledby="sDropdownMenuButton">
                            <a class="dropdown-item" href="index.php"><i class="fas fa-home"></i> Home</a>
                            <a class="dropdown-item" href="categories.php"><i class="fas fa-folder"></i> Categories</a>
                            <a class="dropdown-item" href="search.php"><i class="fas fa-search"></i> Search</a>
                            <a class="dropdown-item" href="recipe_add.php"><i class="fas fa-folder-plus"></i> Add Recipe</a>
                            <a class="dropdown-item" href="trash_can.php"><i class="fas fa-trash-alt"></i> Trash Can</a>
                            <a class="dropdown-item" href="help.php"><i class="fas fa-question"></i> Help</a>
                        </div>
                    </div>
                </div>
                <div class="d-block d-sm-none"  id="xsDropdownMenu">
                    <br/>
                    <div class="dropdown">
                        <button class="btn btn-primary btn-lg btn-block dropdown-toggle" type="button" id="xsDropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-bars"></i> MENU
                        </button>
                        <div class="dropdown-menu" aria-labelledby="xsDropdownMenuButton">
                            <a class="dropdown-item" href="index.php"><i class="fas fa-home"></i> Home</a>
                            <a class="dropdown-item" href="categories.php"><i class="fas fa-folder"></i> Categories</a>
                            <a class="dropdown-item" href="search.php"><i class="fas fa-search"></i> Search</a>
                            <a class="dropdown-item" href="recipe_add.php"><i class="fas fa-folder-plus"></i> Add Recipe</a>
                            <a class="dropdown-item" href="trash_can.php"><i class="fas fa-trash-alt"></i> Trash Can</a>
                            <a class="dropdown-item" href="help.php"><i class="fas fa-question"></i> Help</a>
                            <a class="dropdown-item" href="logout.php"><i class="fas fa-sign-out-alt"></i> SIGN OUT</a>
                        </div>
                    </div>
                </div>
<?php
require_once("includes/initialize.php");

if (WHITELIST) {
    if (!in_array(filter_input(INPUT_SERVER, 'REMOTE_ADDR'), WHITELIST)) {
        redirect_to("access_denied.php");
    }
}

if ($session->is_logged_in()) {
    redirect_to("index.php");
}

// Remember to give your form's submit tag a name="submit" attribute!

if (filter_input(INPUT_POST, 'submit')) { // Form has been submitted.
    $username = trim(filter_input(INPUT_POST, 'inputUsername'));
    $password = trim(filter_input(INPUT_POST, 'inputPassword'));
    $redirect_to = trim(filter_input(INPUT_POST, 'redirect_to'));

    // Check database to see if username/password exist.
    $found_user = User::authenticate($username, $password);

    if ($found_user) {
        $session->login($found_user);

        if ($redirect_to != "") {
            redirect_to($redirect_to);
        } else {
            redirect_to("index.php");
        }
    } else {
        // username/password combo was not found in the database
        $message = "danger|Your credentials were inauthentic.";
    }
} else { // Form has not been submitted.
    $username = "";
    $password = "";
}

if (filter_input(INPUT_GET, "logout") == "true") {
    $message = "info|You have successfully logged out.";
}
?>

<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="description" content="">
        <meta name="author" content="">
        <link rel="icon" href="assets/favicon.ico">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
        <link rel="stylesheet" href="css/login.css">

        <title>Please log on</title>
    </head>
    <body class="text-center">
        <form class="form-signin" role="form" action="login.php" method="POST">
            <h1 class="h3 mb-3 font-weight-normal">Please log on</h1>
            <?= output_message($message) ?>
            <label for="inputUsername" class="sr-only">User Name</label>
            <input type="text" name="inputUsername" id="inputUsername" class="form-control" placeholder="User Name" value="<?= $username ?>" required autofocus>
            <label for="inputPassword" class="sr-only">Password</label>
            <input type="password" name="inputPassword" id="inputPassword" class="form-control" placeholder="Password" required>
            <input class="btn btn-lg btn-primary btn-block" type="submit" name="submit" value="Sign In" />
            <p class="mt-5 mb-3 text-muted">&copy; <?= date("Y") ?> <a href="http://www.travisdsmith.com">Travis D. Smith</a></p>
        </form>

        <!-- Optional JavaScript -->
        <!-- jQuery first, then Bootstrap JS Bundle with Popper.js -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
        <script defer src="https://use.fontawesome.com/releases/v5.6.1/js/all.js" integrity="sha384-R5JkiUweZpJjELPWqttAYmYM1P3SNEJRM6ecTQF05pFFtxmCO+Y1CiUhvuDzgSVZ" crossorigin="anonymous"></script>
    </body>
</html>
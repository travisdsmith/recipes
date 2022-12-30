<?php
$admin_page = 0;
require_once("includes/initialize.php");
require_once("includes/check_login.php");

if(!IS_DEMO){
    if (filter_input(INPUT_POST, 'submit')) {
        $current = trim(filter_input(INPUT_POST, 'current'));
        $new = trim(filter_input(INPUT_POST, 'new'));
        $confirm = trim(filter_input(INPUT_POST, 'confirm'));

        $user = User::authenticate(User::find_by_id($session->user_id->id)->username, $current);

        if ($user) {
            if($new===$confirm){
                $user->password = password_hash($new, PASSWORD_BCRYPT);
                if($user->update()){
                    $message = "success|Password updated successfully.";
                } else {
                    $message = "danger|Your password could not be updated.";
                }
            } else {
                $message = "danger|Make sure your new passwords match.";
            }
        } else {
            // username/password combo was not found in the database
            $message = "danger|Your credentials were inauthentic.";
        }
    }
}

require_once(LAYOUT_PATH . DS . "header.php")
?>
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1><i class="fas fa-key"></i> Change Password</h1>
</div>
<?= output_message($message) ?>

<?php if(IS_DEMO){
    echo "<p>Sorry, but you cannot change the password in the demo environment.</p>";
} else {?>

<form class="form-horizontal" role="form" action="password.php" method="POST">
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Current Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="current" name="current" placeholder="Current Password">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">New Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="new" name="new" placeholder="New Password">
        </div>
    </div>
    <div class="form-group">
        <label class="control-label col-sm-2" for="email">Confirm Password:</label>
        <div class="col-sm-10">
            <input type="password" class="form-control" id="confirm" name="confirm" placeholder="Confirm Password">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <input class="btn btn-primary btn-lg" type="submit" name="submit" value="Continue" />
        </div>
    </div>
</form>
<?php
        }
require_once(LAYOUT_PATH . DS . "footer.php");
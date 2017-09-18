<?php require_once('../private/initialize.php'); ?>

<?php
// If the user is already logged in simply redirect them to dashboard
if (is_logged_in()) {
    redirect_to(url_for('dashboard.php'));
}


// Perform the login
$errors = [];
$username = '';
$password = '';

if (is_post_request()) {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    // Validations
    if (is_blank($username)) {
        $errors[] = "Username cannot be blank.";
    }
    if (is_blank($password)) {
        $errors[] = "Password cannot be blank.";
    }

    // if there were no errors, try to login
    if (empty($errors)) {
        // Using one variable ensures that msg is the same
        $login_failure_msg = "Log in was unsuccessful.";

        $admin = find_admin_by_username($username);
        if ($admin) {

            if (password_verify($password, $admin['hashed_password'])) {
                // password matches
                log_in_admin($admin);
                redirect_to(url_for('dashboard.php'));
            } else {
                // username found, but password does not match
                $errors[] = $login_failure_msg;
            }

        } else {
            // no username found
            $errors[] = $login_failure_msg;
        }

    }

}


?>

<!DOCTYPE html>
<html>
<head>
    <meta name="author" content="">
    <meta name="description" content="">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mero Music</title>
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/vendor.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/flat-admin.css'); ?>">

    <!-- Theme -->
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/theme/blue.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/theme/blue-sky.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/theme/red.css'); ?>">
    <link rel="stylesheet" type="text/css" href="<?php echo url_for('/stylesheets/theme/yellow.css'); ?>">

    <script src="<?php echo url_for('/js/login.js'); ?>" type="text/javascript"></script>

</head>
<body>
<div class="app app-default">
    <div class="app-container app-login">
        <div class="flex-center">
            <div class="app-body">
                <div class="app-block">
                    <div class="app-form login-form">
                        <div class="form-header">
                            <div class="app-brand">Mero Music</div>
                        </div>
                        <div class="login_title_lineitem">
                            <div class="line_1"></div>
                            <div class="flipInX-1 blind icon">
					 <span class="icon">
						 <i class="fa fa-gg"></i>&nbsp;
						 <i class="fa fa-gg"></i>&nbsp;
						 <i class="fa fa-gg"></i>
				   </span>
                            </div>
                            <div class="line_2"></div>
                        </div>
                        <div class="clearfix"></div>
                        <form action="mp3_index.php" method="post">
                            <div class="input-group" style="border:0px;">
                                <?php echo display_my_errors($errors); ?>
                            </div>
                            <div class="input-group"><span class="input-group-addon" id="basic-addon1"> <i
                                            class="fa fa-user" aria-hidden="true"></i></span>
                                <input type="text" name="username" id="username" class="form-control"
                                       placeholder="Username" aria-describedby="basic-addon1">
                            </div>
                            <div class="input-group"><span class="input-group-addon" id="basic-addon2"> <i
                                            class="fa fa-key" aria-hidden="true"></i></span>
                                <input type="password" name="password" id="password" class="form-control"
                                       placeholder="Password" aria-describedby="basic-addon2">
                            </div>
                            <div class="text-center">
                                <input type="submit" class="btn btn-success btn-submit" value="Login">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</body>
</html>
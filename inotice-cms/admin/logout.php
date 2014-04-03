<?php
require_once('includes/app.inc.php');

//Unlink all deleted files when user visit here
unlink_all_delete_files();

if(isset($_SESSION['user'])) {
    if($_SESSION['user']['is_login']) {
        $_SESSION['user']['is_login'] = false;
        $_SESSION['user']['checkout_time'] = Now();
        AdminUser_update($_SESSION['user']);
		Save_err_msg("");
    }
}
foreach($_SESSION as $k => $v) {
    unset($_SESSION[$k]);
}
Redirect('login.php');
?>

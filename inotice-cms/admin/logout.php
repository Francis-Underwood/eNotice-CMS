<?php
require_once('app.php');
if(isset($_SESSION['user'])) {
    if($_SESSION['user']['is_login']) {
        $_SESSION['user']['is_login'] = false;
        $_SESSION['user']['checkout_time'] = Now();
        AdminUser_update($_SESSION['user']);
    }
}
foreach($_SESSION as $k => $v) {
    unset($_SESSION[$k]);
}
Redirect('login.php');
?>

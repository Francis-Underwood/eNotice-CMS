<?php
require_once('includes/app.inc.php');

if(isset($_SESSION['user'])) 
{
    Redirect('main.php');
}

$RenderParams = array();
$a = (isset($_POST['username']) ? trim($_POST['username']) : '');
$b = (isset($_POST['password']) ? trim($_POST['password']) : '');
if(($a != '') && ($b != '')) 
{
    $x = AdminUser_getUser($a, $b);
    if (!($x == null))
	{
        //$_SESSION['user'] = $x[0];
		$_SESSION['user']['loginname'] = $x['loginname'];
		$_SESSION['user']['display_name'] = $x['display_name'];
		
        if($_SESSION['user']['is_login']) 
			{
            $_SESSION['user']['checkout_time'] = Now();;
			}
			$_SESSION['user']['is_login'] = true;
			AdminUser_update($_SESSION['user']);
			Redirect('main.php');
    } 
	else 
	{
		Redirect('login.php?msg=err');
		ErrText('登陸失敗。');
    }
}
else
{
	Redirect('login.php?msg=err');
	ErrText('登陸失敗。');
}
//Render('login', $RenderParams, 'ON SYSTEM CMS2 - Login');
?>
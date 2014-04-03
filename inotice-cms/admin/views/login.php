<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
<link type="text/css" href="style.css" rel="stylesheet" media="screen" />
<link type="text/css" href="css/login.css" rel="stylesheet" />

<!--<script src="jquery-ui-1.8.10.custom/js/jquery-ui-1.8.10.cu2222stom.min.js"></script>
<link href="jquery-ui-1.8.10.custom/css/ui-lightness/jquery-ui-1.8.10.cust2222om.css" rel="stylesheet" type="text/css"/>

<script type="text/javascript" src="js/jque2222ry-1.5.1.js"></script>
<script type="text/javascript"  src="js/jqu2222ery.blockUI.js"></script> -->
<script type="text/javascript"  src="js/utility.js"></script>


<title>ON SYSTEM CONTROL PANEL</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript">
</script>

</head>
	<body onload="setFocus();">
			<div id="logo">
				<img src="logo.png" alt="logopng"></img>
			</div>
			<div class="box">
			<div class="welcome" id="welcometitle">Welcome to IDS Manager, Please Login: </div>
			<?php If (isset($_REQUEST['msg'])) 
					{
					switch ($_REQUEST['msg']) {
					case "err":
						?>
						<div><font color="RED"><strong>Login failed!!</strong></font></div>
					<?php
						break;
					default:
						echo "";
					 }
					}
			?>
		  <div id="fields"> 
			<form id="loginForm" action="login2.php" onSubmit="" method="post">
				<table width="333">
				  <tr>
					<td width="79" height="35"><span class="login">USERNAME</span></td>
					<td width="244" height="35">
						<input name="username" type="text" class="fields" id="name" size="30" /> 
					</td>
				  </tr>
				  <tr>
					<td height="35"><span class="login">PASSWORD</span></td>
					<td height="35">
						<input name="password" type="password" class="fields" id="pass" size="30" />
					</td> 
				  </tr>
				  <tr>
					<td height="65">&nbsp;</td>
					<td height="65" valign="middle"><label>
					  <input name="button" type="submit" class="button" id="button" value="LOGIN" />
					</label></td>
				  </tr>
				  <div id="msg"></div>
				</table>
			</form> 
		  </div>
		  <div class="copyright" id="lostpassword"><?php echo $Config['Version']; ?></div>
		  <div class="login" id="lostpassword"><!--<a href="#">Lost Password?</a>--></div>
		  <div class="copyright" id="copyright">Copyright &copy; On System 2012.</div>
		</div>
	</body>
</html>
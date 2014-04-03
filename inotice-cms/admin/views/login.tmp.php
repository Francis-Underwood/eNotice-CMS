<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

<script type="text/javascript"  src="js/utility.js"></script>

<!-- Required Stylesheets -->
<link rel="stylesheet" type="text/css" href="mws-admin/css/reset.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/css/text.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/css/fonts/ptsans/stylesheet.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/css/fluid.css" media="screen" />

<link rel="stylesheet" type="text/css" href="mws-admin/css/mws.style.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/css/icons/icons.css" media="screen" />

<!-- Demo and Plugin Stylesheets -->
<link rel="stylesheet" type="text/css" href="mws-admin/css/demo.css" media="screen" />

<link rel="stylesheet" type="text/css" href="mws-admin/plugins/colorpicker/colorpicker.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/plugins/jimgareaselect/css/imgareaselect-default.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/plugins/tipsy/tipsy.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/plugins/sourcerer/Sourcerer-1.2.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/plugins/jgrowl/jquery.jgrowl.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/plugins/spinner/spinner.css" media="screen" />
<link rel="stylesheet" type="text/css" href="mws-admin/css/jui/jquery.ui.css" media="screen" />

<!-- Theme Stylesheet -->
<link rel="stylesheet" type="text/css" href="mws-admin/css/mws.theme.css" media="screen" />

<!-- JavaScript Plugins -->
<script type="text/javascript" src="mws-admin/js/jquery-1.7.1.min.js"></script>

<script type="text/javascript" src="mws-admin/plugins/jimgareaselect/jquery.imgareaselect.min.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.dualListBox-1.3.min.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jgrowl/jquery.jgrowl.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.filestyle.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.dataTables.js"></script>

<script type="text/javascript" src="mws-admin/plugins/colorpicker/colorpicker.js"></script>
<script type="text/javascript" src="mws-admin/plugins/tipsy/jquery.tipsy.js"></script>
<script type="text/javascript" src="mws-admin/plugins/sourcerer/Sourcerer-1.2.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.placeholder.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.validate.js"></script>
<script type="text/javascript" src="mws-admin/plugins/jquery.mousewheel.js"></script>
<script type="text/javascript" src="mws-admin/plugins/spinner/ui.spinner.js"></script>
<script type="text/javascript" src="mws-admin/js/jquery-ui.js"></script>

<script type="text/javascript" src="mws-admin/js/mws.js"></script>
<script type="text/javascript" src="mws-admin/js/demo.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		$("div#mws-login .mws-login-back").mouseover(function(event) {
			$(this).find("a").animate({'left':0})
		}).mouseout(function(event) {
			$(this).find("a").animate({'left':70})
		});
	});
</script>

<title>inotice CMS <?php echo $Config['Version']; ?>- Login Page</title>

</head>

<body onload="idsquare.wilson.setFocus();">
	<div id="mws-login">
    	<h1>Login</h1>
        <div class="mws-login-lock"><img src="mws-admin/css/icons/24/locked-2.png" alt="" /></div>
    	<div id="mws-login-form">
			<?php If (isset($_REQUEST['msg'])) 
					{
					switch ($_REQUEST['msg']) {
					case "err":
						?>
						<div class="mws-form-message error">Login failed!!</div>
					<?php
						break;
					default:
						echo "";
					 }
					}
			?>
        	<form class="mws-form" action="login2.php" onSubmit="" method="post">
                <div class="mws-form-row">
                	<div class="mws-form-item large">
                    	<input name="username" type="text" class="mws-login-username mws-textinput" placeholder="username" maxlength="30"/>
                    </div>
                </div>
                <div class="mws-form-row">
                	<div class="mws-form-item large">
                    	<input name="password" type="password" class="mws-login-password mws-textinput" placeholder="password" maxlength="30"/>
                    </div>
                </div>
                <div class="mws-form-row">
                	<input type="submit" value="LOGIN" class="mws-button green mws-login-button"/>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
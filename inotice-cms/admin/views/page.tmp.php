	<!-- Header Wrapper -->
	<div id="mws-header" class="clearfix">
	
		<!-- Logo Wrapper -->
		<div id="mws-logo-container">
			<div id="mws-logo-wrap">
				<img src="mws-admin/images/i-notice-cms-logo.png" alt="mws admin" />
			</div>
		</div>
		
		<!-- User Area Wrapper -->
		<div id="mws-user-tools" class="clearfix">
		
			<!-- User Notifications -->
			<div id="mws-user-notif" class="mws-dropdown-menu">
				<a href="../preview.html" target="PREVIEW"  class="mws-i-24 i-preview mws-dropdown-trigger">Notifications</a>
			</div>
			
			<!-- User Functions -->
			<div id="mws-user-info" class="mws-inset">
				<div id="mws-user-photo">
					<img src="mws-admin/example/profile.jpg" alt="User Photo" />
				</div>
				<div id="mws-user-functions">
					<div id="mws-username">
						Hello, <?php echo $Config['display_name']; ?>, <?php echo $Config['Version']; ?>
					</div>
					<ul>
						<li><a href="main.php?page=acc_management">Account</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
			<!-- End User Functions -->
			
		</div>
	</div>
	
	<!-- Main Wrapper -->
	<div id="mws-wrapper">
		<!-- Necessary markup, do not remove -->
		<div id="mws-sidebar-stitch"></div>
		<div id="mws-sidebar-bg"></div>
		
		<!-- Sidebar Wrapper -->
		<div id="mws-sidebar">
			
			
			<!-- Main Navigation -->
			<div id="mws-navigation">
				<ul>
					<!--<li class="active"><a href="main.php?page=setting_main" class="mws-i-24 i-settings-2">Setting</a></li>-->
					<li <?php echo (!(strpos($page, "setting") === false))?("class=\"active\""):("");?>><a href="main.php?page=setting_main" class="mws-i-24 i-settings-2">Setting</a></li>
					<li <?php echo (!(strpos($page, "_banner") === false))?("class=\"active\""):("");?>>
						<a href="#" class="mws-i-24 i-monitor">Banner</a>
						<ul>
							<li><a href="main.php?page=control_banner_img_list">Image</a></li>
							<li><a href="main.php?page=control_banner_video_list">Video</a></li>
						</ul>
					</li>
					<li <?php echo (!(strpos($page, "_casting") === false))?("class=\"active\""):("");?>><a href="main.php?page=control_casting" class="mws-i-24 i-megaphone">Narrowcasting</a></li>
					<li <?php echo (!(strpos($page, "_about_us") === false))?("class=\"active\""):("");?>><a href="main.php?page=control_about_us" class="mws-i-24 i-info-about">About</a></li>
					<li <?php echo (!(strpos($page, "l_gallery") === false))?("class=\"active\""):("");?>><a href="main.php?page=control_gallery_list" class="mws-i-24 i-image">Gallery</a></li>
					<li <?php echo (!(strpos($page, "l_movie_gallery") === false))?("class=\"active\""):("");?>><a href="main.php?page=control_movie_gallery_list" class="mws-i-24 i-film-2">Movie Gallery</a></li>
					<li <?php echo (!(strpos($page, "_news") === false))?("class=\"active\""):("");?>><a href="main.php?page=control_news_list" class="mws-i-24 i-list-images">News</a></li>
				</ul>
			</div>
			<!-- End Navigation -->
			
		</div>
		
		
		<!-- Container Wrapper -->
		<div id="mws-container" class="clearfix">
		
			<!-- Main Container -->
<?php
	/* system vars */
	$Config['SystemName'] = 'eNotice System';
	$Config['Version'] = '2.0.1';
	$Config['display_name'] = $_SESSION['user']['display_name'];
	//$Config['display_name'] = 'ADMINISTRATOR';


	
	/* temporary folder for uploading */
	$Config['TemporaryUploadPath'] = 'upload/';
	
	/* data&files paths */
	$Config['SyncRoot'] = 'daily/';
	$Config['nonSyncRoot'] = 'local/';
	
	$Config['Subpath.Media'] = 'MediaFiles/';
	$Config['Subpath.FloorPlan'] = 'assets/floorplan/';
	$Config['Subpath.Background'] = 'assets/background/';
	//$Config['Subpath.CompanyLogo'] = 'assets/logo/';
	$Config['Subpath.Theme'] = $Config['SyncRoot'];
	
	$Config['AdvImagesPath'] = $Config['nonSyncRoot'] . $Config['Subpath.Media'];
	$Config['AdvVideosPath'] = $Config['SyncRoot'] . $Config['Subpath.Media'];
	$Config['FloorPlanPath'] = $Config['SyncRoot'] . $Config['Subpath.FloorPlan'];
	$Config['BackgroundPath'] = $Config['SyncRoot'] . $Config['Subpath.Background'];
	$Config['ThemePath'] = $Config['Subpath.Theme'];

	/* image dimensions 
	$Config['View']['CompanyLogoWidth'] = 120;
	$Config['View']['CompanyLogoHeight'] = 120;
	$Config['View']['AdvImageWidth'] = 320;
	$Config['View']['AdvImageHeight'] = 240;     */

	error_reporting(E_ERROR);	
?>
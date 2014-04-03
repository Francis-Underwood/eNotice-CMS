<?php

//include mysql connection information
require_once('connect.php');

//add entry
if ($_POST[title]) {

	mysql_query("INSERT INTO entries (entry_title, entry_description, entry_email) VALUES
	
		(
			'".addslashes(strip_tags($_POST['title']))."',
			'".addslashes(strip_tags($_POST['description']))."',
			'".addslashes(strip_tags($_POST['email']))."'
		)
	
	");
	$mid = mysql_insert_id(); //get id of entry that was just added

	//associate the images that were just uploaded to the entry that was added
	mysql_query("UPDATE images SET image_entry = '".$mid."' WHERE image_code = '".addslashes($_POST[eid])."'");

	//redirect to entry that was just added
	header('Location: index.php?id='.$mid); die;
}
///////////////


//show entry that was just added
if (!empty($_GET[id])) {

	//get entry
	record_set('entry',"SELECT * FROM entries WHERE entry_id = $_GET[id]");
	
	//get images associated with this entry
	record_set('images',"SELECT * FROM images WHERE image_entry = $_GET[id]");

}
//

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Add Entry</title>

    <link href="style.css" rel="stylesheet" type="text/css" />

<!--include uploadify files-->
    <link href="uploadify/uploadify.css" type="text/css" rel="stylesheet" />
    <script type="text/javascript" src="uploadify/jquery-1.4.2.min.js"></script>
	<script type="text/javascript" src="jquery.validate.js"></script> 
    <script type="text/javascript" src="uploadify/swfobject.js"></script>
    <script type="text/javascript" src="uploadify/jquery.uploadify.v2.1.4.js"></script>
<!--end include uploadify files-->


	<script type="text/javascript">
	$(document).ready(function() {

		//uploadify
		  $('#file_upload').uploadify({
			'uploader'  : 'uploadify/uploadify.swf',
			'script'    : 'upload_images.php?id=' + $("#eid").val(), //script to upload our images
			'cancelImg' : 'uploadify/cancel.png',
			'buttonImg' : 'uploadify/upload.png',
			'folder'    : 'images',
  			'queueSizeLimit' : 5,
			'fileExt'     : '*.jpg;*.gif;*.png', //only upload these file types
			'fileDesc'    : 'Image Files',
			'multi'    : true,
			'auto'      : false,
			'sizeLimit'   : 5102400,
	
			//update hidden field to indicate a file has been selected
			'onSelect': function(event,ID,fileObj) {
				$("#selected").val('Yes');
			},
			//

			//submit form ONLY after all files have been uploaded.
			'onAllComplete' : function(event,data) {
				$(".submit").focus().click();
			}
			//

		  });
		/////

		//function to use when submitting the form
		function validate_form() {
			$("#form1").validate({
				submitHandler: function() {
		
					//if a file has been selected
						if ($("#selected").val() == 'Yes') {
							$("#file_upload").uploadifyUpload();
						}
				
					//if a file hasn't been selected
						if ($("#selected").val() == 'No') {
							$(form).submit();
						}
					//
				}
		
			}); 
		}
		//

		//in case user tries submitting the form by hitting enter
		$('input').keypress(function(e) {
			if(e.which == 13) {
				$(this).blur();
				validate_form();
			}
		});
		//

		//validate, then submit the form
		$(".submit").click(function() {
			validate_form();
		});

	});
	</script>


</head>

<body>

<!--show entry-->
<?php if ($totalRows_entry) { ?>
<table width="650" border="0" align="center" cellpadding="5" cellspacing="1" class="entry_table">
  <tr>
    <td colspan="2" align="left" valign="top" bgcolor="#FFFFFF"><a href="index.php"><strong>Go Back </strong></a></td>
  </tr>
  <tr>
    <td width="107" align="left" valign="top" bgcolor="#EBEBEB"><strong>Title</strong></td>
    <td width="523" align="left" valign="top"><strong><?php echo $row_entry[entry_title]; ?></strong></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#EBEBEB"><strong>Description</strong></td>
    <td align="left" valign="top"><?php echo nl2br($row_entry[entry_description]); ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#EBEBEB"><strong>Email</strong></td>
    <td align="left" valign="top"><?php echo $row_entry[entry_email]; ?></td>
  </tr>
  <tr>
    <td align="left" valign="top" bgcolor="#EBEBEB"><strong>Images</strong></td>
    <td align="left" valign="top">
	<?php if ($totalRows_images) { ?>
	
	  <?php do { ?>
			<img src="images/<?php echo $row_images[image_file]; ?>" width="550" /><br />
      <?php } while ($row_images = mysql_fetch_assoc($images)); ?>
	  
      <?php } else { echo "<br><b>No images were uploaded...</b>"; } ?></td>
  </tr>
</table>
<?php } ?>
<!--end-->


<!--form-->
<?php if (!$totalRows_entry) { ?>

<div id="entry">
   <h3>Add Entry</h3>
	<br />
  <form id="form1" name="form1" method="post" action="" enctype="multipart/form-data">
		Title
	<br />
		<input name="title" type="text" id="title" class="required" size="45" />
	<br />
	<br />
		Description
	<br />
		<textarea name="description" cols="40" rows="8" class="required" id="description"></textarea>
	<br />
		Email
	<br />
		<input name="email" type="text" id="email" class="email required" size="45" />
	<br />
		<input type="file" name="file_upload" id="file_upload"/>
	<br />
		<input name="Submit" type="submit" class="submit_button submit" value="Add Entry"/>
		<input name="selected" type="hidden" id="selected" value="No" />
		<input name="eid" type="hidden" id="eid" value="<?php echo time(); ?>" />
  </form>
  
  <!--<a href="/blog/using-uploadify-in-a-web-application-with-multiple-fields-and-validation"><br />Back to Tutorial </a></div>-->
  <a href="http://www.johnboy.com/blog/how-to-upload-multiple-files-in-a-web-application-with-progress-bar-multiple-fields-and-form-validation-using-jquery-php--uploadify"><br />Back to Tutorial </a></div>
<?php } ?>
<!--end form-->


</body>
</html>

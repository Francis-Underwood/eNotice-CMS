<?phprequire_once('../includes/app.inc.php');RequireLogin();  ?><?phpob_start(); //echo $_POST['album-order'];$aid = (isset($_POST['aid']))?($_POST['aid']):(0);$subject = $_POST['subject'];$sorted_id_str = $_POST['custom-order'];$sorted_id_array = explode(",", $sorted_id_str);//echo $subject;//echo "count(sorted_id_array)".count($sorted_id_array);if (( count($sorted_id_array) > 0) && ($subject != "") )  {	if (Save_sorted_items($subject, $sorted_id_array))  {		switch ($subject) {			case "banner_image":					redirect("../main.php?page=control_banner_img_sort&msg=succ");				break;				case "banner_video":					redirect("../main.php?page=control_banner_video_sort&msg=succ");				break;								case "gallery":					redirect("../main.php?page=control_gallery_img_sort&aid=$aid&msg=succ");				break;				case "gallery_album":					redirect("../main.php?page=control_gallery_sort&msg=succ");				break;			case "movie_gallery":					redirect("../main.php?page=control_movie_gallery_sort&msg=succ");				break;		}	}}?> 
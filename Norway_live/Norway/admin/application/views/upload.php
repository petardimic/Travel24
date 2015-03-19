<?php

//include "index.php";
//include("../../includes/database.php");
//process $_FILES['upload']
//print_r($_FILES);
//store uploaded images URL in $uploadedImageURL

 $url = $_SERVER['HTTP_HOST']."/staykey/admin/";
if(isset($_FILES)){
	$fileName = @$_FILES['upload']['name'];
	$tmpName  = @$_FILES['upload']['tmp_name'];
	$fileSize = @$_FILES['upload']['size'];
	$fileType = @$_FILES['upload']['type'];
	//echo $tmpName;
 $uploadedImageURL = '../../static_images/'.$fileName;
	 $uploadedPath =  '../../static_images/'.$fileName;
	// echo $uploadedImageURL;exit;
	if(move_uploaded_file($tmpName, $uploadedPath)){?>
		<script type="text/javascript">
		window.parent.CKEDITOR.tools.callFunction( <?php echo $_GET['CKEditorFuncNum']?>, '<?php echo "$uploadedImageURL"?>' );
		</script>
	<?php }
}
?>

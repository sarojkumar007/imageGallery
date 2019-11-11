<?php
include('session.php');
if(!isset($_SESSION['login_user'])){
  header("location: index.php"); // Redirecting To Home Page
}

$masterid =array();
$masterid['id'] = 0;
$img_list = "";
$container = "";
$msg = "";
$success_msg = "";
$add_msg = "";
$message="";
$titleNew1="";
//code
include('dbConfig.php');
if (isset($_GET['search'])){
	if($_GET['search']){$message = "<p class='msg'>TITLE:".$titleNew1."</p>";
}}	
if (isset($_GET['files'])) {
    if ($_GET['files']) {
        $success_msg = "<p class='msg'>Selected Files Deleted.</p>";
    }else {
        $success_msg = "<p class='err'>You have selected no Image.</p>";
    }
}
if (isset($_GET['inserts'])) {
    if ($_GET['inserts']) {
        $add_msg = "<p class='msg'>".$_GET['inserts']." Files Inserted.</p>";
    }else {
        $add_msg = "<p class='err'>You have selected no Image.</p>";
    }
}

if(isset($_GET['search'])){
    $titleNew = $_GET['search'];
    $titleNew1 = $titleNew ; 
	$img_counter = 0;
	echo $titleNew;
    $fetch_id = "SELECT id FROM mastertab WHERE title = '".$titleNew."'";
    $masterid = mysqli_fetch_array(mysqli_query($db,$fetch_id));
    $fecthImg = "SELECT filename,image FROM imgtab WHERE masterid =".$masterid['id'];
    $image_list = mysqli_query($db, $fecthImg);
    while ($images = mysqli_fetch_array($image_list)) {
        $img_list .= "<div class='list-item'><img style = 'width: 100px;height:100px;' src='".$images['image']."' ><input type='checkbox' name='file_for_op[]' class='input-checkbox' value='".$images['filename']."'/></div>";
        $img_counter++;
    }
    $addimg_container = "<div class='addimg'><p class='msg' style='color:#fff;'>".$msg."</p><form action='' method='post' enctype='multipart/form-data'><input type='hidden' name='hid_title' value='".$masterid['id']."' /><input type='hidden' name='img_count' value='".$img_counter."' /><label for='add-img' class='add-head'>Add image to your gallery</h2><input type='file' name='files[]' id='add-img' multiple accept='image/*' style='outline: 2px solid #ddd;margin: 30px 0;' required/><br><input type='submit' class='btn' value='Upload' name='addimg' /></form></div>";

    $delete_container = "<section class='list-container'><form action='' method='post'>".$img_list."<div class='form-gruop modify-group'><input type='hidden' name='hid_title'id='hid_title' value='".$masterid['id']."' /><input type='submit' name='modify' value='Delete' class='btn' id='modify-btn'><input type='reset' value='Cancel' class='btn' /></div></form></section>";
    $container = "<div class='form-group'>".$addimg_container.$delete_container."</div>";
}

if(isset($_POST['submit']) || isset($_POST['submit'])&&isset($_GET['selected-id'])){
    $titleNew = $_POST['title-list'];
    if (isset($_GET['selected-id'])) {
        header('Location: modify.php?search='.$_POST['title-list']);
    }
    $img_counter = 0;
    $fetch_id = "SELECT id FROM mastertab WHERE title = '".$titleNew."'";
    $masterid = mysqli_fetch_array(mysqli_query($db,$fetch_id));
    $fecthImg = "SELECT filename,image FROM imgtab WHERE masterid =".$masterid['id'];
    $image_list = mysqli_query($db, $fecthImg);
    while ($images = mysqli_fetch_array($image_list)) {
        $img_list .= "<div class='list-item'><img style = 'width: 100px;height:100px;' src='".$images['image']."' ><input type='checkbox' name='file_for_op[]' class='input-checkbox' value='".$images['filename']."'/></div>";
        $img_counter++;
    }
    $addimg_container = "<div class='addimg'><p class='msg' style='color:#fff;'>".$msg."</p><form action='' method='post' enctype='multipart/form-data'><input type='hidden' name='hid_title' value='".$masterid['id']."' /><input type='hidden' name='img_count' value='".$img_counter."' /><label for='add-img' class='add-head'>Add image to your gallery</h2><input type='file' name='addimages[]' id='add-img' multiple accept='image/*' style='outline: 2px solid #ddd;margin: 30px 0;' required/><br><input type='submit' class='btn' value='Upload' name='addimg' /></form></div>";

    $delete_container = "<section class='list-container'><form action='' method='post'>".$img_list."<div class='form-gruop modify-group'><input type='hidden' name='hid_title'id='hid_title' value='".$masterid['id']."' /><input type='submit' name='modify' value='Delete' class='btn' id='modify-btn'><input type='reset' value='Reset' class='btn' /></div></form></section>";
    $container = "<div class='form-group'>".$addimg_container.$delete_container."</div>";

}

if(isset($_GET['selected-id'])){
    $img_counter = 0;
    $fecthImg = "SELECT filename,image FROM imgtab WHERE masterid =".$_GET['selected-id'];
    $image_list = mysqli_query($db, $fecthImg);
    while ($images = mysqli_fetch_array($image_list)) {
        $img_list .= "<div class='list-item'><img style ='width: 100px;height:100px;' src='".$images['image']."' ><input type='checkbox' name='file_for_op[]' class='input-checkbox' value='".$images['filename']."'/></div>";
        $img_counter++;
    }
    $addimg_container = "<div class='addimg'><p class='msg' style='color:#fff;'>".$msg."</p><form action='' method='post' enctype='multipart/form-data'><input type='hidden' name='hid_title' value='".$_GET['selected-id']."' /><input type='hidden' name='img_count' value='".$img_counter."' /><label for='add-img' class='add-head'>Add image to your gallery</h2><input type='file' name='files[]' id='add-img' multiple accept='images/*' style='outline: 2px solid #ddd;margin: 30px 0;' required/><br><input type='submit' class='btn' value='Upload' name='addimg' /></form></div>";

    $delete_container = "<section class='list-container'><form action='' method='post'>".$img_list."<div class='form-gruop modify-group'><input type='hidden' name='hid_title'id='hid_title' value='".$_GET['selected-id']."' /><input type='submit' name='modify' value='Delete' class='btn' id='modify-btn'><input type='reset' value='Reset' class='btn' /></div></form></section>";
    $container = "<div class='form-group'>".$addimg_container.$delete_container."</div>";
}



    if(isset($_POST['modify'])){//to run PHP script on submit
        $count = 0;
        if(!empty($_POST['file_for_op'])){
        // Loop to store and display values of individual checked checkbox.
            foreach($_POST['file_for_op'] as $selected){
                // $get_masterid = "SELECT masterid FROM imgtab WHERE filename='".$selected."'";
                // $id_arr = mysqli_query($db,$get_masterid);
                // $masterid = mysqli_fetch_array($id_arr);
                $del_img = "DELETE FROM imgtab WHERE masterid=".$_POST['hid_title']." AND filename='".$selected."'";
                // echo $del_img;
                if(mysqli_query($db, $del_img)){
                    $count++; $msg = $count." file(s) deleted.";
                }
                else echo "Failed Delete";
            }
        }
        // echo "<script>alert('".$msg."');</script>";
        header('Location: modify.php?files='.$count.'&selected-id='.$_POST['hid_title']);
    }
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Modify | Image Gallery</title>
	<link rel="stylesheet" href="css/index_style.css">
</head>
<body class="body">
    <a class="btn back-btn" href="index.php">
        <img src="images/arrow-left2.svg" alt="back Btn" class="back-img">
    </a>
	<header class="header">
		<div class="top-bar"></div>
		<h1 class="heading">Modify your Image Gallery</h1>
	</header>
	<main class="container">
     <form action="" method="post" class="modify-form">
        <div class="form-group">
            <select name="title-list" id="title-list" class="input-text input-select" required>
                <?php
                if (isset($_GET['selected-id'])) {
                    $fetch_title = "SELECT title FROM mastertab WHERE status= 1 AND id=".$_GET['selected-id'];
                    $res = mysqli_query($db,$fetch_title);
                    $title = mysqli_fetch_array($res);
                    echo "<option value='".$title['title']."' selected>".$title['title']."</option>";
                }
                ?>
                <option value="">SELECT TITLE</option>
                <?php
                    // echo "<option value='".$_POST['title-list']."' selected></option>";
                    $fetchTitle = "SELECT title FROM mastertab WHERE status = 1";
                    $res = mysqli_query($db, $fetchTitle);
                    if($res){
                        while($row = mysqli_fetch_array($res)){
                            echo "<option value='".$row['title']."'>".$row['title']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" name="submit" value="Search" class="btn" id="search" />
        
		</div>
        <?php echo $success_msg; ?>
        <?php echo $add_msg; ?>
     </form>
     <?php
        if (isset($_POST['addimg'])) {
				$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
				//Image insertion to path
				$gettitle="SELECT title from mastertab WHERE id=".$_POST['hid_title'];
				$title_list_master=mysqli_query($db,$gettitle);
				while($titles = mysqli_fetch_array($title_list_master)){
					$targetDir="uploads/".$titles['title']."/";
					$allowTypes=array('jpg','png','jpeg','gif');	
					if(!empty(array_filter($_FILES['files']['name']))){
					$count = ++$_POST['img_count'];
					foreach($_FILES['files']['name'] as $key=>$val){
						// File upload path
						$fileName = basename($_FILES['files']['name'][$key]);
						$targetFilePath = $targetDir . $fileName;
						// Check whether file type is valid
						$fileType = pathinfo($targetFilePath,PATHINFO_EXTENSION);
						if(in_array($fileType, $allowTypes)){
						// Upload file to server
						if(move_uploaded_file($_FILES["files"]["tmp_name"][$key], $targetFilePath)){
							// Image db insert sql
							$insertValuesSQL .= "('".$fileName."', NOW()),";
								if(!empty($insertValuesSQL)){
									$insertValuesSQL = trim($insertValuesSQL,',');
									// Insert image file name into database
									$file_ins_q = "INSERT  INTO imgtab VALUES('',".$_POST['hid_title'].",".$count.",'".$fileName."','".$targetFilePath."')";
									if(mysqli_query($db,$file_ins_q)){ $msg = $count." file(s) inserted";$count++;}
									else echo "failed ins";
									$errorUpload?'Upload Error: '.$errorUpload:'';
									$errorUploadType = !empty($errorUploadType)?'File Type Error: '.$errorUploadType:'';
									$errorMsg = !empty($errorUpload)?'<br/>'.$errorUpload.'<br/>'.$errorUploadType:'<br/>'.$errorUploadType;
									$statusMsg = "Files are uploaded successfully.".$errorMsg;
								}else{
								$statusMsg = "Sorry, there was an error uploading your file.";
								}
						}
					}
				}}
	header('Location: modify.php?inserts='.($count-$_POST['img_count']).'&selected-id='.$_POST['hid_title']);}

					}
					
     ?>
    <?php echo $container; ?>
    </main>
</body>
</html>

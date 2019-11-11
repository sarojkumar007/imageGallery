<?php
$err = "";
$msg = "";
// Database configuration
$status = 1;
include('dbConfig.php');
//////////////////////////////////

////////////////////////////////
if (isset($_POST['submit'])){
	$title = $_POST['title'];
	$desc = $_POST['desc'];
	$date = $_POST['date'];
	$directory="uploads/".$title;
	mkdir($directory,0777, true);
	$targetDir = $directory."/";
    $allowTypes = array('jpg','png','jpeg','gif');
	$statusMsg = $errorMsg = $insertValuesSQL = $errorUpload = $errorUploadType = '';
	//////////////////////////////////
	$q = "INSERT INTO mastertab VALUES('','".mysqli_real_escape_string($db,$title)."','".mysqli_real_escape_string($db,$desc)."','".mysqli_real_escape_string($db,$date)."',".$status.",".$status.")";
	//query for master table
	if(mysqli_query($db, $q)) {
		//$createTab = "CREATE TABLE `drdoproject`.`".$title."` ( `filename` VARCHAR(255) NOT NULL , `image` LONGBLOB NOT NULL , PRIMARY KEY (`filename`));";
			$getId = "SELECT id FROM mastertab WHERE title='".$title."'";
			$res = mysqli_query($db, $getId);
			if($res){
				$id = mysqli_fetch_array($res);
				$id = $id['id'];
			}else echo "Id fetch Error";
			///////////////////////////
			//Image insertion to path
			if(!empty(array_filter($_FILES['files']['name']))){
				$count = 1;
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
									$file_ins_q = "INSERT  INTO imgtab VALUES('',".$id.",".$count.",'".$fileName."','".$targetFilePath."')";
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
	else $err .= "<p class='err'>Title exists , Enter different one</p>";
					}
					}

?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Image Gallery</title>
	<link rel="stylesheet" href="css/index_style.css">
</head>
<body class="body">
	<a class="btn back-btn" href="index.php">
        <img src="images/arrow-left2.svg" alt="back Btn" class="back-img">
    </a>
	<header class="header">
		<div class="top-bar"></div>
		<h1 class="heading">Create New Image Gallery</h1>
	</header>
	<div class="container">
		<p class="msg" style=""><?php echo $msg; ?></p>
		<form action="" method="post" class="new-upload" enctype="multipart/form-data">
			<input type="text" name="title" placeholder="Title" class="input-text" spellcheck="false" required /><br>
			<?php echo $err; ?>
			<textarea name="desc" placeholder="Description" cols="40" rows="10" spellcheck="false" required ></textarea><br>
			<input type="date" name="date" class="input-text" required /><br>
			<input type="file" name="files[]" multiple accept="image/*" style="width: 100%;" required /><br>
			<p style="font-size:18px; color:purple;">You Can Select Multiple Files</p>
			<input type="submit" name="submit" value="Upload" class="btn" />
			<input type="reset" name="cancel" value="Reset" class="btn" />
		</form>
    </div>
</body>
</html>

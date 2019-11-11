<?php
include('session.php'); 
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>
<?php
    $archive_msg = "";
    $backup_msg = "";
    //
    include('dbConfig.php');
	
    if (isset($_POST['delete'])) {
		$delete_bool= 0 ;
        $get_id="SELECT id FROM mastertab WHERE title='".$_POST['title-list']."' and status=1";
        $found_id = mysqli_query($db,$get_id);
        $id = mysqli_fetch_array($found_id);
			$delete_q = "DELETE FROM imgtab WHERE masterid = ".$id['id'];
			if (mysqli_query($db,$delete_q)) {
				$archive_msg .= "<p class='msg'>Delete Successful</p>";
				$querry="UPDATE mastertab SET status= 0 , deletestatus= 0 WHERE id = ".$id['id'];
				if(mysqli_query($db,$querry)){
				}
			}else $archive_msg .= "<p class='err'>Delete Error</p>";
	}
?>

<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Delete | Image Gallery</title>
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body class="body">
    <a class="btn back-btn" href="index.php">
        <img src="images/arrow-left2.svg" alt="back Btn" class="back-img">
    </a>
    <header class="header">
        <div class="top-bar"></div>
        <h1 class="heading">Delete your Image Gallery</h1>
    </header>
    <main class="container">
     <form action="" method="post" class="modify-form">
        <div class="form-group">
            <select name="title-list" id="title-list" class="input-text input-select" required>
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
            <input type="submit" name="delete" value="delete" class="btn" id="search" />
        </div>
        <? echo $archive_msg; ?>
     </form>
 </main>
</body>
</html>

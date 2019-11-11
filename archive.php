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

if (isset($_POST['archive-event'])) {
    $archive_q = "UPDATE mastertab SET status = 0 WHERE title = '".$_POST['title-archive']."' LIMIT 1";
    if (mysqli_query($db,$archive_q)) {
        $archive_msg .= "<p class='msg'>Archive Successful</p>";
    }else $archive_msg .= "<p class='err'>Archive Error</p>";
}
if (isset($_POST['backup-event'])) {
    $backup_q = "UPDATE mastertab SET status = 1 WHERE title = '".$_POST['title-backup']."' LIMIT 1";
    if (mysqli_query($db,$backup_q)) {
        $backup_msg .= "<p class='msg'>Backup Successful</p>";
    }else $backup_msg .= "<p class='err'>Backup Error</p>";
}
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Archive | Image Gallery</title>
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body class="body">
    <a class="btn back-btn" href="index.php">
        <img src="images/arrow-left2.svg" alt="back Btn" class="back-img">
    </a>
    <header class="header">
        <div class="top-bar"></div>
        <h1 class="heading">Archive your titles | Image Gallery</h1>
    </header>
    <main class="container">
     <form action="" method="post" class="archive-form">
        <legend class="head-2">Archive your Title</legend>
        <div class="form-group">
            <select name="title-archive" id="title-archive" class="input-text input-select" required>
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
            <input type="submit" name="archive-event" value="Archive" class="btn" id="archive" />
        </div>
            <?php echo $archive_msg; ?>
     </form>
     <!--#################################-->
     <form action="" method="post" class="backup-form">
        <legend class="head-2">REPUBLISH your Title</legend>
        <div class="form-group">
            <select name="title-backup" id="title-backup" class="input-text input-select" required>
                <option value="">SELECT TITLE</option>
                <?php
                    // echo "<option value='".$_POST['title-list']."' selected></option>";
                    $fetchTitle = "SELECT title FROM mastertab WHERE status = 0 AND deletestatus = 1";
                    $res = mysqli_query($db, $fetchTitle);
                    if($res){
                        while($row = mysqli_fetch_array($res)){
                            echo "<option value='".$row['title']."'>".$row['title']."</option>";
                        }
                    }
                ?>
            </select>
            <input type="submit" name="backup-event" value="REPUBLISH" class="btn" id="backup" />
        </div>
            <?php echo $backup_msg; ?>
     </form>
 </main>
 </body>
 </html>

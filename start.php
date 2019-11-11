<?php
include('session.php'); 
if(!isset($_SESSION['login_user'])){ 
  header("location: index.php"); // Redirecting To Home Page 
}
?>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Image Gallery</title>
	<link rel="stylesheet" href="css/index_style.css">
</head>
<body>
	<header class="header">
		<div class="top-bar"></div>
		<h1 class="heading">Image Gallery | Admin</h1>
	</header>
	<a href="user.php" style="margin-right:80%" class="btn" >USER PAGE</a>
	<main class="main">
		<h2 class="head">Actions</h2>
		<div class="action-container">
		<a href="new.php">New</a>
		<a href="modify.php">Modify</a>
		<a href="archive.php">Archieve</a>
		<a href="delete.php">Delete</a>
		</div>
	</main>
<a href="Logout.php" >Logout</a>
</body>
</html>

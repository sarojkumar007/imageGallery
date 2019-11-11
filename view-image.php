<?php
    include 'dbConfig.php';
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>View Images | Image Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
	<link rel="stylesheet" href="css/user_style.css">
	<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
</head>
<body>
    <header class="header">
        <div class="top-bar"></div>
        <h1 class="heading">View Images | Image Gallery</h1>
    </header>
    <main class="img-gallery">
	<div class="w3-container">
	 <button onclick="document.getElementById('id01').style.display='block'" class=" btn w3-button w3-black" Title="Click Here for Description	"><img src="images/i.svg" style="width:20px;"></button>
  <div id="id01" class="w3-modal">
    <div class="w3-modal-content">
      <div class="w3-container">
        <span onclick="document.getElementById('id01').style.display='none'" class="w3-button w3-display-topright">&times;</span>
        <?php
		$desc_querry="SELECT description FROM mastertab WHERE id=".$_GET['title-id'];
		$desc_get= mysqli_query($db,$desc_querry);
		$desc=mysqli_fetch_array($desc_get);
		echo "<p>".$desc['description']."</p>";
		?>
      </div>
    </div>
  </div>
 
 <?php
        if (isset($_GET['title-id'])) {
            $fetch_title = "SELECT title FROM mastertab WHERE id=".$_GET['title-id'];
            $titleRes = mysqli_query($db,$fetch_title);
            $title = mysqli_fetch_array($titleRes);
            echo "<h2 class='head-2'  style='font-size:25px;'>Title : ".$title['title']."</h2>";
        }
        ?>
 
</div>
        <section class="view-img-container">
            <div class="card-container">
                <?php
                $querry = "SELECT image FROM imgtab WHERE masterid=".$_GET['title-id'];
                $get_image = mysqli_query($db,$querry);
                while($image = mysqli_fetch_array($get_image)){
                    echo "<div class='card' '><div class='card-image' ><a href='View-Image-Big.php?title-id=".$_GET['title-id']."'><img src='".$image['image']."'  alt='Gallery Image' class='image'  id='myImg' /></a></div><div class='card-download'><a href='".$image['image']."' class='download-btn' download>Download</a></div></div>";
				}
                ?>
        </div>
        </section>
    </main>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

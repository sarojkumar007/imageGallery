
<?php
include('dbConfig.php');
?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>User | Image Gallery</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <link rel="stylesheet" href="css/user_style.css">
</head>
<body>
    <header class="header">
        <div class="top-bar"></div>
        <h1 class="heading">Image Gallery | User</h1>
    </header>
    <main class="main">
        <nav class="nav">
            <?php
			if($_POST['frm-date'] === $_POST['to-date'])
					$get_titles  = "SELECT id,title FROM mastertab WHERE status = 1 AND date ='".$_POST['frm-date']."'";
				else $get_titles  = "SELECT id,title FROM mastertab WHERE status = 1 AND date BETWEEN '".$_POST['frm-date']."' AND '".$_POST['to-date']."'";
			$res = mysqli_query($db,$get_titles);
            while($titles = mysqli_fetch_array($res)){
                echo "<div class='link_list'><a href='view-image.php?title-id=".$titles['id']."' class='link' />".$titles['title']."</a></div>";
            }
            ?>
        </nav>
        <section class="section-image-show">
            <div class="navbar navbar-danger bg-danger text-light menu-bar">
              <a href="#" class="">Home</a>
            </div>
            <div id="exampleCarousel" class="carousel slide" data-ride="carousel">
              <div class="carousel-inner" style="height: 400px;">
                <?php
                $c = 1;
				if($_POST['frm-date'] === $_POST['to-date'])
					$fetch_img = "SELECT id,title FROM mastertab WHERE status = 1 AND date ='".$_POST['frm-date']."'";
				else $fetch_img = "SELECT id,title FROM mastertab WHERE status = 1 AND date BETWEEN '".$_POST['frm-date']."' AND '".$_POST['to-date']."'";
                $titles = mysqli_query($db,$fetch_img);
                while($title = mysqli_fetch_array($titles)){
                  $show_first_img = "SELECT image FROM imgtab WHERE masterid=".$title['id']." LIMIT 1";
                  $image = mysqli_query($db,$show_first_img);
                  $img  = mysqli_fetch_array($image);
                    if($c === 1){
                      echo "<div class='carousel-item active'><img class='d-block w-100' src='".$img['image']."' alt='slide image'><div class='carousel-caption d-none d-md-block'><h5 class='title-c'>".$title['title']."</h5><a href='view-image.php?title-id=".$title['id']."' class='btn btn-primary'>View Gallery</a></div></div>";
                      $c = 0;
                    }else{
                      echo "<div class='carousel-item'><img class='d-block w-100' src='".$img['image']."' alt='slide image'><div class='carousel-caption d-none d-md-block'><h5 class='title-c'>".$title['title']."</h5><a href='view-image.php?title-id=".$title['id']."' class='btn btn-primary'>View Gallery</a></div></div>";
                    }
                }
                ?>
              </div>
              <a class="carousel-control-prev" href="#exampleCarousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              </a>
              <a class="carousel-control-next" href="#exampleCarousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
              </a>
            </div>
        </section>
        <div class="side-div"></div>
    </main>

  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>
</html>

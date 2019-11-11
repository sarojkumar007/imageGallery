<?php
//index.php
include('dbConfig.php');
if(isset($_GET['title-id'])){
$connect = mysqli_connect("localhost", "root", "", "drdoproject");
function make_query($connect)
{
 $query = "SELECT image FROM imgtab WHERE masterid=".$_GET['title-id'];
 $result = mysqli_query($connect, $query);
 return $result;
}

function make_slide_indicators($connect)
{
 $output = ''; 
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'" class="active"></li>
   ';
  }
  else
  {
   $output .= '
   <li data-target="#dynamic_slide_show" data-slide-to="'.$count.'"></li>
   ';
  }
  $count = $count + 1;
 }
 return $output;
}
function make_slides($connect)
{
 $output = '';
 $count = 0;
 $result = make_query($connect);
 while($row = mysqli_fetch_array($result))
 {
  if($count == 0)
  {
   $output .= '<div class="item active">';
  }
  else
  {
   $output .= '<div class="item">';
  }
  $output .= '
   <img src="'.$row["image"].'"/>
   <div class="carousel-caption">
   </div>
  </div>
  ';
  $count = $count + 1;
 }
 return $output;
}
}
?>
<!DOCTYPE html>
<html>
 <head>
	<?php
		$querry="SELECT title from mastertab WHERE id=".$_GET['title-id'];
		$title_name = mysqli_query($db,$querry);
        $t_name= mysqli_fetch_array($title_name);
		echo "<title>".$t_name['title']."</title>";
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
 </head>
 <body style="background-image:linear-gradient(to bottom,white,purple">
  <br />
  <div class="container">
  <?php
		$querry="SELECT title from mastertab WHERE id=".$_GET['title-id'];
		$title_name = mysqli_query($db,$querry);
        $t_name= mysqli_fetch_array($title_name);
		echo "<h2 align='center' style='color:purple;' >TITLE:".$t_name['title']."</h2>";
		
	?>
   
   
   <br />
   
 
	<div id="dynamic_slide_show" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
    <?php echo make_slide_indicators($connect); ?>
    </ol>

    <div class="carousel-inner">
     <?php echo make_slides($connect); ?>
    </div>
    <a class="left carousel-control" href="#dynamic_slide_show" data-slide="prev">
     <span class="glyphicon glyphicon-chevron-left"></span>
     <span class="sr-only">Previous</span>
    </a>

    <a class="right carousel-control" href="#dynamic_slide_show" data-slide="next">
     <span class="glyphicon glyphicon-chevron-right"></span>
     <span class="sr-only">Next</span>
    </a>

   </div>
  </div>
 </body>
</html>
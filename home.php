<?php
session_start();
  if (!isset($_SESSION['user_id'])) {
      header('Location:login.php');
  } else {
      $user_id = $_SESSION['user_id'];
  }


  require_once("system/data.php");
  require_once("system/security.php");
  ?>



<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="author" content="Kim Schläpfer, Luca Toneatti, Fabio Follador">

    <title>Tourismusbilder</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/main.css" type="text/css">
  </head>
  <body>

    <header>
      <h1 class="logo">Tourismusbilder</h1>
      <button id="plus-btn" class="btn btn-lg btn-circle btn-primary"><span class="glyphicon glyphicon-plus"></span></button>
</header>
<div id="map"></div>




<!-- Like -->
<?php

$strSQL_Result  = mysqli_query($connection,"SELECT `like_id` FROM `like` WHERE id=1");
$row            = mysqli_fetch_array($strSQL_Result);

$like       = $row['like_id'];
if($_POST)
{
    if(isset($_COOKIE["572825_4_1"]))
    {
        echo "-1";
        exit;
    }
    setcookie("572825_4_1", "liked", time()+3600*24, "/like-unlike-in-php-mysql/", ".demo.phpgang.com");
    if(mysqli_real_escape_string($connection,$_POST['op']) == 'like')
    {
        $update = "`like`=`like_id`+1";
    }

    mysqli_query($connection,"UPDATE `like` SET $update WHERE `id`=1");
    echo 1;
    exit;
}
?>
<div class="grid">
<span id="status"></span><br>
<input type="button" value="<?php echo $like; ?>" class="button_like" id="linkeBtn" />
</div>

<!-- Like -->


<script>
function initMap() {
  // Create a map object and specify the DOM element for display.
  var map = new google.maps.Map(document.getElementById('map'), {
    center: {lat: 46.731, lng: 9.424},
    zoom: 10,
    streetViewControl: false,
    mapTypeControl: true,
    zoomControl: true,
    zoomControlOptions: {
        position: google.maps.ControlPosition.RIGHT_BOTTOM
    },

    mapTypeControlOptions: {
        style: google.maps.MapTypeControlStyle.DROPDOWN_MENU,
        position: google.maps.ControlPosition.LEFT_BOTTOM
}


  });
}
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script async defer
      src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBKuRJfjZTU3bHDh8xdLsCGjY5zO7hdGXI&callback=initMap">
    </script>
<script src="assets/js/main.js"></script>

  </body>
</html>
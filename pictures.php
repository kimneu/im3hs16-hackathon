<?php
  session_start();
  if (!isset($_SESSION['user_id'])) {
      header('Location:login.php');
  } else {
      $user_id = $_SESSION['user_id'];
  }

  require_once('system/data.php');
  require_once('system/security.php');

  $picture_list = get_pictures();

          if(isset($_POST['picture-edit-submit'])){

          $title = filter_data($_POST['title']);
          $description = filter_data($_POST['description']);
          $alt = filter_data($_POST['alt']);
          $long = filter_data($_POST['long']);

//          if(isset($_POST['public'])){
//          }

//          if(isset($_POST['delete'])){
//        }

          $result = update_picture($picture_id, $title, $description, $alt, $long);
        }



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


    <div class="container">
      <div class="row">

        <h1>Alle Fotos</h1>

          <?php

          while ($picture = mysqli_fetch_assoc($picture_list)) {
            echo $picture['title'];
            //$upload_date = date_parse($picture['datetime_upload']);
    ?>
          <div class="col-lg-3 col-sm-4 col-xs-6"><a title="<?php echo $picture['title']?>" href="#"><img class="thumbnail img-responsive" style="height:300px;width:auto;" src="###"></a></div>

          <div tabindex="-1" class="modal fade" id="myModal" role="dialog">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button class="close" type="button" data-dismiss="modal">×</button>
                  <h3 class="modal-title"><?php echo $picture['title'] ?></h3>
                <!--  <p><?php echo $upload_date ?></p> -->
                </div>
            <div class="modal-body">
            </div>
            <div class="modal-footer">

              <form id="picture-form" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post" role="form">
                <div class="form-group row">
                  <div class="col-sm-5 col-xs-6">
                    <input  type="text" class="form-control form-control-sm"
                            id="title" placeholder="Titel"
                            name="title" value="<?php echo $picture['title']; ?>">
                    <input  type="text" class="form-control form-control-sm"
                          id="description" placeholder="Beschreibung"
                          name="description" value="<?php echo $picture['description']; ?>">
                    <input  type="text" class="form-control form-control-sm"
                            id="alt" placeholder="latitude"
                            name="alt" value="<?php echo $picture['alt']; ?>">
                    <input  type="text" class="form-control form-control-sm"
                          id="long" placeholder="longitude"
                          name="long" value="<?php echo $picture['long']; ?>">
                    <span class="button-checkbox">
                        <button type="button" class="btn btn-default" data-color="success">Public</button>
                        <input type="checkbox" name="public" class="hidden"/>
                    </span>
                      <span class="button-checkbox">
                        <button type="button" class="btn btn-default" data-color="danger">DELETE</button>
                        <input type="checkbox" name="delete" class="hidden"/>
                      </span>
                  <button type="submit" name="picture-edit-submit" class="btn btn-primary">Save</button>
                </div>
              </div>
            </form>

          </div>
              </div>
            </div>
          </div>
    <?php } ?>
  </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
<script src="assets/js/main.js"></script>
  </body>
</html>

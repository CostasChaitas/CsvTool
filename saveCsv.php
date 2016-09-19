<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Bootstrap 101 Template</title>

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css" />

  </head>
  <body>

    <div class="container">
      <div class="col-md-offset-3 col-md-6">
        <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" method="post" enctype="multipart/form-data">
          <input type="file" name="file" id="file" />
          <input type="submit" name="submit" />
        </form>
      </div>
    </div>


    <?php

if ( isset($_POST["submit"]) ) {

   if ( isset($_FILES["file"])) {
            //if there was an error uploading the file
        if ($_FILES["file"]["error"] > 0) {
            echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
        }
        else {
                 //Print file details
             echo "Upload: " . $_FILES["file"]["name"] . "<br />";
             echo "Type: " . $_FILES["file"]["type"] . "<br />";
             echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
             echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
                 //if file already exists
             if (file_exists("upload/" . $_FILES["file"]["name"])) {
               echo $_FILES["file"]["name"] . " already exists. ";
             }
             else {
                    //Store file in directory "upload" with the name of "uploaded_file.txt"
                      $my_folder = "./upload/";

                      if (move_uploaded_file($_FILES['file']['tmp_name'], $my_folder . $_FILES['file']['name'])) {
                          echo 'Received file' . $_FILES['file']['name'] . ' with size ' . $_FILES['file']['size'];
                      } else {
                          echo 'Upload failed!';

                          var_dump($_FILES['file']['error']);
                      }
            }
        }
     } else {
             echo "No file selected <br />";
     }
}

     ?>

    <?php

    $csv = array_map('str_getcsv', file($_FILES["file"]["name"]));
    $data = $csv[0][0];
    $pieces = explode(";", $data);

    foreach($pieces as $val){
      echo"<div class='col-md-offset-3 col-md-6'>";
      echo"<input type='type' class='form-control inpt' placeholder='$val' value='$val'> ";
      echo"</div>";
    }
  ?>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>

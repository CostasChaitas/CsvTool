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

<?php
session_start();




if ( isset($_POST["submit"]) ) {

if ( isset($_FILES["file"])) {
        //if there was an error uploading the file
    if ($_FILES["file"]["error"] > 0) {
        echo "There is an Error Uploading the file" . "<br/>" ;
        echo "Return Code: " . $_FILES["file"]["error"] . "<br />";
    }
    else {
             //Print file details
         echo "<div class='col-md-offset-3 col-md-6'>";
         echo "<h4>File Details</h4>";
         echo "Upload: " . $_FILES["file"]["name"] . "<br />";
         echo "Type: " . $_FILES["file"]["type"] . "<br />";
         echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br />";
         echo "Temp file: " . $_FILES["file"]["tmp_name"] . "<br />";
         echo "Separator: " . $_POST["separator"] . "<br />" . "<br />";
         echo "</div>";
             //if file already exists
         if (file_exists("upload/" . $_FILES["file"]["name"])) {
           echo $_FILES["file"]["name"] . " already exists. ";
         }
         else {

           $rest = [];
           $row = 1;
           ini_set('auto_detect_line_endings',TRUE);
            if (($handle = fopen($_FILES["file"]["name"], "r")) !== FALSE) {
              echo "<form action='exportCsv.php' method='post'>";
              if($_POST["separator"]=="comma"){
                echo "<div class='col-md-4'>";
                if (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $num = count($data);
                     //echo "<p> $num fields in line $row: <br /></p>\n";
                     echo "<h4 class='text-center'>CSV Titles</h4>";
                       for ($c=0; $c < $num; $c++) {
                           echo"<div class='col-md-offset-3 col-md-6'>";
                           echo"<input type='type' class='form-control' name='$data[$c]' value='$data[$c]'> ";
                           echo"</div>";
                       }
                     echo"<div class='col-md-offset-3 col-md-6'>";
                     echo "<input type='submit' name='submit' class='btn btn-success' value='Submit Button'>";
                     echo "</div>";

                }
                echo "</div>";
                echo "<div class='col-md-8'>";
                echo "<h4 class='text-center'>CSV Values</h4>";
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                  array_push($rest,$data);
                   $num = count($data);
                     echo "<div class='col-md-10'>";

                       for ($c=0; $c < $num; $c++) {
                         echo "<tr>";
                                echo "<td>" . htmlspecialchars($data[$c]) . "</td>";
                          echo "</tr>\n";
                       }
                     echo "</div>";
                }
                echo "</div>";
              }elseif($_POST["separator"]=="questionMark"){
                echo "<div class='col-md-4'>";
                if (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                     $num = count($data);
                     //echo "<p> $num fields in line $row: <br /></p>\n";
                     echo "<h4 class='text-center'>CSV Titles</h4>";
                       for ($c=0; $c < $num; $c++) {
                           echo"<div class='col-md-offset-3 col-md-6'>";
                           echo"<input type='type' class='form-control' name='$data[$c]' value='$data[$c]'> ";
                           echo"</div>";
                       }
                     echo"<div class='col-md-offset-3 col-md-6'>";
                     echo "<input type='submit' name='submit' class='btn btn-success' value='Submit Button'>";
                     echo"</div>";
                     echo "</div>";

                }
                echo "</div>";
                echo "<div class='col-md-8'>";
                echo "<h4 class='text-center'>CSV Values</h4>";
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                  array_push($rest,$data);
                   $num = count($data);
                     echo "<div class='col-md-12'>";
                       for ($c=0; $c < $num; $c++) {
                         echo "<tr>";
                                echo "<td>" . htmlspecialchars($data[$c]) . "</td>";
                          echo "</tr>\n";
                       }
                     echo "</div>";
                }
                echo "</div>";
              }

              ini_set('auto_detect_line_endings',FALSE);
              fclose($handle);
              echo "</form>";

            }

            $_SESSION['rest']=$rest;
            $_SESSION['item'] = $_FILES["file"]["name"];

        }

    }
 } else {
         echo "No file selected <br />";
 }
}

?>








    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>

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
    $rest = $_SESSION["rest"];
    $item = $_SESSION['item'];

    unset($_POST['submit']);

    $arr= $_POST;

    array_unshift($rest, $arr);


    $fp = fopen($item, 'w');

    foreach ($rest as $fields) {
        fputcsv($fp, $fields);
    }

    fclose($fp);

     ?>

     <div class="container">
       <h4 class="text-center">Export your CSV file</h4>
       <div class="col-md-offset-3 col-md-6">
         <a href="<?php echo $item;?>">Download</a>
         <p>
           <?php echo $item;?>
         </p>
       </div>
     </div>






    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
  </body>
</html>

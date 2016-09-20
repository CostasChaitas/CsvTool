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


           $titles = [];
           $rest = [];
           $row = 1;


           ini_set('auto_detect_line_endings',TRUE);
            if (($handle = fopen($_FILES["file"]["name"], "r")) !== FALSE) {

              if($_POST["separator"]=="comma"){
                if (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                     $num = count($data);
                     //echo "<p> $num fields in line $row: <br /></p>\n";
                       for ($c=0; $c < $num; $c++) {
                           array_push($titles,$data[$c]);
                       }
                }
                while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                   array_push($rest,$data);
                   $num = count($data);
                   $row++;
                }
              }elseif($_POST["separator"]=="questionMark"){
                if (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                     $num = count($data);
                       for ($c=0; $c < $num; $c++) {
                         array_push($titles,$data[$c]);
                       }
                }
                while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
                   array_push($rest,$data);
                   $num = count($data);
                   $row++;

                }
              }

              array_unshift($rest, $titles);

              $suwag = Array(
                      'zip_code',
                      'rate_name',
                      'valid_since',
                      'source_rate_id',
                      'consumption_from',
                      'consumption_until',
                      'monthly_base_price',
                      'working_price',
                      'is_business_rate',
                      'bonus1_amount',
                      'bonus1_external_ID',
                      'bonus1_type',
                      'bonus2_amount',
                      'bonus2_external_ID',
                      'bonus2_type',
                      'price_guarantee_type',
                      'price_guarantee_until_date',
                      'price_guarantee_number_of_months',
                      'payment_period_number_of_months',
                      'initial_contract_period',
                      'notice_period',
                      'contract_extension',
                      'is_online_communication_only',
                      'is_eco',
                      'rate_seal_ids',
                      'energy_mix_eco_percentage',
                      'energy_mix_nuclear',
                      'energy_mix_coal',
                      'energy_mix_natural_gas',
                      'energy_mix_other_fossile_energy_sources',
                      'energy_mix_renewable_energies_according_eeg',
                      'energy_mix_renewable_energies',
                      'energy_mix_co2_emission',
                      'energy_mix_nuclear_waste',
                      'energy_mix_year',
                      'energy_mix_natural_gas_percentage',
                      'energy_mix_bio_gas_percentage',
                      'rating_initial_contract_duration',
                      'rating_extension_of_contract_duration',
                      'rating_notice_period',
                      'rating_duration_price_guarantee',
                      'rating_quality_price_guarantee',
                      'rating_bonus_payment',
                      'rating_deduction',
                      'time_periods_from',
                      'time_periods_until'
            );

            array_splice($rest[0], -4);
            foreach ($rest as $k => $v) {
               if ($k < 1) continue;
               array_splice($rest[$k], -4);
            }

            $union = array_diff($suwag, $rest[0]);

            foreach($union as $key=>$value){
              array_splice($rest[0], $key, 0, $value);
              foreach ($rest as $k => $v) {
                 if ($k < 1) continue;
                 array_splice($rest[$k], $key, 0, "Empty Value");
              }
            }

            echo "<form action='exportCsv.php' method='post'>";
            echo "<div class='col-md-10'>";
            echo "<table class='table table-bordered'>";
            echo"<thead><tr>";
            foreach($rest[0] as $values){
              echo "<th>$values</th>";
            }
            echo"</tr></thead>";
            echo"<tbody>";
            foreach ($rest as $k => $v) {
               if ($k < 1) continue;
                 echo "<tr>";

                 if(mb_strlen($v[0])){
                   $v[0]=str_pad($v[0], 5, "0", STR_PAD_LEFT);
                 }
                 if(!empty($v[11])){
                   $v[11] = "https://docs.google.com/spreadsheets/d/1Jrp3I1x-Lawq_gchQy0NKGg9fkH5kC4eOEtiHPUplxA/edit#gid=0";
                 };
                 if(!empty($v[14])){
                   $v[14] = "https://docs.google.com/spreadsheets/d/1Jrp3I1x-Lawq_gchQy0NKGg9fkH5kC4eOEtiHPUplxA/edit#gid=0";
                 };

                 for($i=0; $i<$v; $i++){
                   echo $v[$i];
                 }

                 foreach($v as $values){
                   echo "<th><input type='text' value='$values'></th>";
                 }
               echo "</tr>";
            }
            echo "</tr></tbody></table>";
            echo "</form>";


              ini_set('auto_detect_line_endings',FALSE);
              fclose($handle);
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

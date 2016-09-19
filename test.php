$row = 1;
ini_set('auto_detect_line_endings',TRUE);
 if (($handle = fopen($_FILES["file"]["name"], "r")) !== FALSE) {
 while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
    $num = count($data);
    echo "<p> $num fields in line $row: <br /></p>\n";
    $row++;
    for ($c=0; $c < $num; $c++) {
        echo $data[$c] . "<br />\n";
    }
 }
 ini_set('auto_detect_line_endings',FALSE);
 fclose($handle);
 }

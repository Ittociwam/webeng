<?php
$myfile = fopen("results.json", "w") or die("Unable to open file!");
echo fwrite($myfile, $_POST['myData']);

echo $_POST['myData'];
fclose($myfile);
?>

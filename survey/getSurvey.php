
<?php

$results = fopen("results.json", "r") or die("Unable to open file");
echo fread($results, filesize("results.json"));
fclose($results);
?>





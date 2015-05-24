<?php

$dbuser = 'ironmanSelect';
$dbPass = '';
$dbHost = '127.8.145.130';
$dbName = 'ironman';

$semester = $_POST['semester'];
$fname = $_POST["fname"];
$lname = $_POST["lname"];

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbuser, $dbPass);
    #$db.setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $query = " select * from entries e
 inner join contestants c
 on e.fk_contestants = c.pk_contestants_id
 inner join events ev
 on e.fk_events = ev.pk_events_id
 inner join mode m
 on e.fk_mode = m.pk_mode_id
 WHERE c.fname= '".$fname."'
 AND c.lname = '". $lname."'
 AND ev.semester = '".$semester."'";
   $rows = array();
    foreach ($db->query($query) as $row) {
        $rows[] = $row;
   }
    echo json_encode($rows);
} catch (PDOEXCEPTION $ex) {
    echo "something bad!";
}
?>

<?php

$dbuser = 'aNewUser';
$dbPass = 'password';
$dbHost = '127.0.0.1';
$dbName = 'ironman';

$semester = $_POST['semester'];
//$semester = $_GET["semester"];
//$event = $_GET["event"];

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbuser, $dbPass);
    #$db.setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

//    $query = "SELECT * from registration r
// INNER JOIN contestants c
// ON r.fk_contestants = c.pk_contestants_id
// INNER JOIN events e
// ON r.fk_events = e.pk_events_id
// WHERE e.semester = '" . $semester . "'";
    
    
        $query = " SELECT c.fname, c.lname, c.email, (sum(en.distance) / 223) as percentage
 FROM entries en
 INNER JOIN events e
 ON en.fk_events = e.pk_events_id
 INNER JOIN contestants c
 ON c.pk_contestants_id = en.fk_contestants
 WHERE e.semester = '".$semester."'
 AND en.fk_events = (SELECT pk_events_id from events where semester = '".$semester."')
 group by c.lname, c.fname, c.email;";
    
    $rows = array();
    foreach ($db->query($query) as $row) {
        $rows[] = $row;
    }
    echo json_encode($rows);
} catch (PDOEXCEPTION $ex) {
    echo "something bad!";
}
?>
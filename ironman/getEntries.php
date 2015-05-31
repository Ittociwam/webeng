<?php

if (getenv('OPENSHIFT_MYSQL_DB_HOST')) { // openshift
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $dbuser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $dbPass = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
} else { // localhost
    $dbuser = 'aNewUser';
    $dbPass = 'password';
    $dbHost = '127.0.0.1';
}
$dbName = 'iron_man';

$semester = $_POST['semester'];
$id = $_POST["id"];

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbuser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = "select * from entries e
 inner join contestants c
 on e.fk_contestants = c.pk_contestants_id
 inner join events ev
 on e.fk_events = ev.pk_events_id
 inner join mode m
 on e.fk_mode = m.pk_mode_id
 WHERE c.pk_contestants_id= '" . $id . "'
 AND ev.semester = '" . $semester . "'";
    $stmt = $db->query($query);
    $rows = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
    {
        $rows[] = $row;
    }

    echo json_encode($rows);
} catch (PDOEXCEPTION $ex) {
    echo "something bad!";
}
?>
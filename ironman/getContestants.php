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

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbuser, $dbPass);
     $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


    $query = "SELECT c.u_name, c.register_date, (sum(en.distance) / 223) as percentage
 FROM entries en
 INNER JOIN events e
 ON en.fk_events = e.pk_events_id
 INNER JOIN contestants c
 ON c.pk_contestants_id = en.fk_contestants
 WHERE e.semester = '" . $semester . "'
 AND en.fk_events = (SELECT pk_events_id from events where semester = '" . $semester . "')
 group by c.u_name, c.register_date;";

    $stmt = $db->query($query);
    $rows = array();

    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
        $rows[] = $row;
    }

    echo json_encode($rows);
} catch (PDOEXCEPTION $ex) {
    echo "something bad!";
}
?>
<?php

/*
 * This file will be called when a the user is not found in the system. Javascript will take care of
 * storing the users id number on their system so that each user is recognized by their device.
 */

if (getenv('OPENSHIFT_MYSQL_DB_HOST')) { // openshift
    echo "openshift";
    $dbHost = getenv('OPENSHIFT_MYSQL_DB_HOST');
    $dbPort = getenv('OPENSHIFT_MYSQL_DB_PORT');
    $dbuser = getenv('OPENSHIFT_MYSQL_DB_USERNAME');
    $dbPass = getenv('OPENSHIFT_MYSQL_DB_PASSWORD');
} else { // localhost
    $dbuser = 'insertIronman';
    $dbPass = 'password';
    $dbHost = '127.0.0.1';
}
$dbname = 'iron_man';
$username = null;


if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

try {
    $db = new PDO("mysql:host=$dbHost;dbname=$dbname", $dbuser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if (!isset($username)) {
        $query = "INSERT INTO contestants (date)
 VALUES(CURDATE());";
    } 
    
    else {
        $query = "INSERT INTO contestants (date, u_name)
 VALUES(CURDATE(), :username);";
    }

    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();

    echo $db->lastInsertId();
} catch (PDOEXCEPTION $ex) {
    echo $ex;
}
?>

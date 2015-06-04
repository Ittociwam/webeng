<?php

/*
 * This file will be called when a the user is not found in the system. Javascript will take care of
 * storing the users id number on their system so that each user is recognized by their device.
 */

require 'connectfile.php';


if (isset($_GET['username'])) {
    $username = $_GET['username'];
}

try {

    //determine if the user has specified a display name or not
    if (!isset($username)) {
        $query = "INSERT INTO contestants (register_date)
 VALUES(CURDATE());";
    } else {
        $query = "INSERT INTO contestants (register_date, u_name)
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

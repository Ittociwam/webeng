<?php

/*
 * This file will be called when a the user is not found in the system. Javascript will take care of
 * storing the users id number on their system so that each user is recognized by their device.
 */

// checks to see if a username is a duplicate in contestants table
function isDuplicate($username, $semester) {
        require 'connectfile.php';
    $dup = $db->prepare("SELECT u_name FROM contestants WHERE u_name ='" . $username . "'");
    
    $dup->execute();

    if ($dup->rowCount() > 0) {
        return true;
    }
    return false;
}

//sends the information to the database
function runInsert($query, $username, $update = null) {
    require 'connectfile.php';
    $statement = $db->prepare($query);
    $statement->bindValue(':username', $username);
    $statement->execute();

    echo $db->lastInsertId();
    
    // this was a little hack I had to do to insert the user id as the contestants
    // username if they
    if (isset($update)) {

        $stmt = $db->prepare($update);
        $stmt->bindValue(':lastInsertId1', $db->lastInsertId());
        $stmt->bindValue(':lastInsertId2', $db->lastInsertId());
        $stmt->execute();
    }
}

require 'connectfile.php';
require 'getSemester.php';

$semester = getSemester(date('Y-m-d'));
if (isJson($semester)) { // first off we check to see if there is even an event going on right now.
    echo -1; // do nothing becasue there is not an iron man going on right now. This will be taken care of in newEntry.php
} else {
    $username = $_GET['username'];

    try {
        //determine if the user has specified a display name or not
        if ($username == 'null') {
            $query = "INSERT INTO contestants (register_date)
 VALUES(CURDATE());";
            $update = "UPDATE contestants "
                    . "SET u_name = :lastInsertId1 "
                    . "WHERE pk_contestants_id = :lastInsertId2 ";
            runInsert($query, $username, $update);
        } else if (isDuplicate($username, $semester['semester'])) {
            echo "duplicate";
        } else {

            $query = "INSERT INTO contestants (register_date, u_name)
 VALUES(CURDATE(), :username);";
            runInsert($query, $username);
        }
    } catch (PDOEXCEPTION $ex) {
        echo $ex;
    }
}


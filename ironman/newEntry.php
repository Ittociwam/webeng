<?php

/*
 * This file will handle a new iron man entry.
 * 
 */

require 'connectfile.php';
require 'getSemester.php';

function isJson($string) {
    return ((is_string($string) &&
            (is_object(json_decode($string)) ||
            is_array(json_decode($string))))) ? true : false;
}

try {
    $mode = $_GET['mode'];
    $distance = $_GET['distance'];
    $date = $_GET['date'];
    $user = $_GET['user'];

    $semester = @getSemester($date);
    if(isJson($semester))
    {
        echo $semester;
    }
    // here i want to check if the user has passed any distance limits I will probably call getEntries.php to do this
    else {

        $pk_events_id = $semester['pk_events_id'];

        // check if the user has a registration for the event they are submitting for
        $checkRegistration = "SELECT * from registration"
                . " WHERE fk_contestants = $user"
                . " AND fk_events = $pk_events_id;";

        $checkRegistrationStatement = $db->query($checkRegistration);
        $checkRegistrationStatement->setFetchMode(PDO::FETCH_ASSOC);
        $registration = $checkRegistrationStatement->fetch();

        // if they don't, register them for it!
        if ($registration == null) {
            $insertRegistration = "INSERT INTO registration(fk_contestants, fk_events)"
                    . "VALUES(:user, :event)";
            $regStatement = $db->prepare($insertRegistration);
            $regStatement->bindValue(':user', $user);
            $regStatement->bindValue(':event', $pk_events_id);

            $regStatement->execute();
        }

        // get the correct mode id for the mode they entered
        // move this to javascript when you get time
        $modeNum = 0;
        switch ($mode) {
            case "Bike":
                $modeNum = 1;
                break;
            case "Run":
                $modeNum = 2;
                break;
            case "Swim":
                $modeNum = 3;
                break;
        }

        //finally if all else is ok, go ahead and bulid the query
        $query = "INSERT INTO entries (entry_date, distance, fk_events, fk_contestants, fk_mode)
 VALUES(:date, :distance, :semester, :user, :modeNum);";


        $statement = $db->prepare($query);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':distance', $distance);
        $statement->bindValue(':semester', $semester['pk_events_id']);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':modeNum', $modeNum);
        $message = "";
        // and execute it!
        if ($statement->execute()) {
            print '{"code" : 0, "message": "Good Job! You are well on your way to being an ironman champion!"}';
        }
    }
} catch (PDOEXCEPTION $ex) {
    echo '{"code":1, "message": "There was an error in the database: "' . $ex . '"';
}
?>

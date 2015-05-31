<?php

/*
 * This file will handle a new iron man entry.
 * 
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
try {
    $mode = $_GET['mode'];
    $distance = $_GET['distance'];
    $date = $_GET['date'];
    $user = $_GET['user'];

    $db = new PDO("mysql:host=$dbHost;dbname=$dbname", $dbuser, $dbPass);
    $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $getSemester = "SELECT * FROM events "
            . "WHERE CURDATE() BETWEEN start_date AND end_date;";
    $getSemesterStatement = $db->query($getSemester);
    $getSemesterStatement->setFetchMode(PDO::FETCH_ASSOC);
    $semester = $getSemesterStatement->fetch();

    if ($semester == null) {
        echo '{"code":1, "message": "Currently there is no ironman competition in progress. '
        . 'Check with the activities office to find out when the next one starts!"}';
    } else if ($date < $semester['start_date'] && $date > $semester['end_date']) {
        echo '{"code":1, "message": "Your entry date is invalid for ' . $semester['semester'] . '."}';
    } else {

        $pk_events_id = $semester['pk_events_id'];
        $checkRegistration = "SELECT * from registration"
                . " WHERE fk_contestants = $user"
                . " AND fk_events = $pk_events_id;";

        $checkRegistrationStatement = $db->query($checkRegistration);
        $checkRegistrationStatement->setFetchMode(PDO::FETCH_ASSOC);
        $registration = $checkRegistrationStatement->fetch();

        if ($registration == null) {
            $insertRegistration = "INSERT INTO registration(fk_contestants, fk_events)"
                    . "VALUES(:user, :event)";
            $regStatement = $db->prepare($insertRegistration);
            $regStatement->bindValue(':user', $user);
            $regStatement->bindValue(':event', $pk_events_id);

            $regStatement->execute();
        }

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

        $query = "INSERT INTO entries (date, distance, fk_events, fk_contestants, fk_mode)
 VALUES(:date, :distance, :semester, :user, :modeNum);";


        $statement = $db->prepare($query);
        $statement->bindValue(':date', $date);
        $statement->bindValue(':distance', $distance);
        $statement->bindValue(':semester', $semester['pk_events_id']);
        $statement->bindValue(':user', $user);
        $statement->bindValue(':modeNum', $modeNum);
        $message = "";
        if ($statement->execute()) {
            print '{"code" : 0, "message": "Good Job! You are well on your way to being an ironman champion!"}';
        }
    }
} catch (PDOEXCEPTION $ex) {
    echo '{"code":1, "message": "There was an error in the database: "' . $ex .'"';
}
?>

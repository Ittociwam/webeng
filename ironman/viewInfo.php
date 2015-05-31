<!DOCTYPE html>
<html>
    <head>
        <title>DB access</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <?php
        if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
            echo '<script type="text/javascript" src="/tablesorter-master/js/jquery.tablesorter.js"></script> 
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css"/>
        <script src="/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>
        <link rel="stylesheet" href="/tablesorter-master/css/theme.blue.css"/>
        <script type="text/javascript" src="/bootstrap/js/bootstrap.js"></script>';
        } else {
            echo '<script type="text/javascript" src="/webengii/webengii/tablesorter-master/js/jquery.tablesorter.js"></script> 
        <link rel="stylesheet" type="text/css" href="/webengii/webengii/bootstrap/css/bootstrap.min.css"/>
        <script src="/webengii/webengii/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>
        <link rel="stylesheet" href="/webengii/webengii/tablesorter-master/css/theme.blue.css"/>
        <script type="text/javascript" src="/webengii/webengii/bootstrap/js/bootstrap.js"></script>';
        }
        try {
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
            $db = new PDO("mysql:host=$dbHost;dbname=$dbName", $dbuser, $dbPass);
            $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $query = "SELECT semester FROM events"
                    . " ORDER BY RIGHT(semester, 2)";
        } catch (PDOException $ex) {
            echo "Error: " . $ex->getMessage();
            die();
        }
        ?>

        <script src="viewInfo.js"></script>

    </head>

    <body>

        <div class="well row">
            <h2> Get all contestants for a specific semester and event </h2>
            <form role="from">
                <div class=" form-group col-md-6">
                    <label for="semester"> Semester: </label>

                    <select class="form-control" id="semester">
                        <?php
                        foreach ($db->query($query) as $row) {
                            $semester = $row["semester"];
                            print "<option value = '$semester'>$semester</option>";
                        }
                        ?>
                    </select>
                </div>
                <div class = "col-md-6">
                    <button class = "btn btn-primary" type = "button" onclick = "getContestants()" > Go </button>
                    <button class = "btn btn-info" type = "button" data-toggle = "collapse"
                            data-target = "#results1" > Hide/Show Results </button>
                </div>
            </form>
        </div>

        <div class = "collapse panel-collapse in" id = "results1">
            <div id = "contestantResults" class = "well">
                Results will go here
            </div>
        </div>
        <div class = "well row">
            <h2> Get your entries and progress level for any semester</h2>

            <form role = "form">
                <div class = " form-group">
                    <label for = "semester"> Semester: </label>
                    <select class = "form-control" id = "semester1">
                        <?php
                        foreach ($db->query($query) as $row) {
                            $semester = $row["semester"];
                            print "<option value = '$semester'>$semester</option>";
                        }
                        ?>
                    </select>
                </div>
                <button class = "btn btn-primary" onclick = "getEntries()" type = "button"> Go </button>
                <button class = "btn btn-info" type = "button" data-toggle = "collapse"
                        data-target = "#results2" > Hide/Show Results </button>
            </form>
        </div>
        <div class = "collapse panel-collapse in" id = "results2">
            <div id = "entryResults" class = "well">
                Results will go here
            </div>
        </div>
        <div class='row'>
            <div class='col-lg-2 col-lg-offset-10'>
                <a href="index.php"> <button class='btn btn-primary'>Return Home</button> </a>
            </div>
        </div>
    </body>
</html>

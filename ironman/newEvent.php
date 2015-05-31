

<!DOCTYPE html>
<html>
    <head>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <script>
            $(document).ready(function () {
                $('#start_date').datepicker({
                    format: "yyyy/mm/dd"
                });

                $('#end_date').datepicker({
                    format: "yyyy/mm/dd"
                });
            });
        </script>
        <?php
        if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
            echo '<script type="text/javascript" src="/tablesorter-master/js/jquery.tablesorter.js"></script> 
        <link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css"/>
        <script src="/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>
        <link rel="stylesheet" href="/tablesorter-master/css/theme.blue.css"/>
        <script type="text/javascript" src="/bootstrap/js/bootstrap.js"></script>        <script type="text/javascript" src="/bootstrap/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="/bootstrap/css/datepicker.css"/>';
        } else {
            echo '<script type="text/javascript" src="/webengii/webengii/tablesorter-master/js/jquery.tablesorter.js"></script> 
        <link rel="stylesheet" type="text/css" href="/webengii/webengii/bootstrap/css/bootstrap.min.css"/>
        <script src="/webengii/webengii/tablesorter-master/js/jquery.tablesorter.widgets.js"></script>
        <link rel="stylesheet" href="/webengii/webengii/tablesorter-master/css/theme.blue.css"/>
        <script type="text/javascript" src="/webengii/webengii/bootstrap/js/bootstrap.js"></script>
        <script type="text/javascript" src="/webengii/webengii/bootstrap/js/bootstrap-datepicker.js"></script>
        <link rel="stylesheet" href="/webengii/webengii/bootstrap/css/datepicker.css"/>';
        }
        ?>
    </head>
    <body>
        <div class='well row'>
            <form action="insertNewEvent.php" method="GET" role="from">
                <div class=" form-group col-lg-12">
                    <label for="semester"> Semester: </label>
                    <div id="semester">
                        <select class="form-control" name="season" id="season">
                            <option value="FALL">Fall</option>
                            <option value="WINTER">Winter</option>
                            <option value="SPRING">Spring</option>
                        </select>
                        <select class="form-control" name="year" id="year">
                            <?php
                            foreach (range(date('Y'), 2010) as $x) {
                                print '<option value="' . $x . ' "' . ($x === date('Y') ? 'selected="selected"' : '') . '>' . $x . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class=" form-group col-lg-12">
                        <label for="start_date"> Start Date: </label>
                        <input type="text" required="required" placeholder="Click to choose a date" class="form-control" name="start_date" id="start_date">
                    </div>
                    <div class=" form-group col-lg-12">
                        <label for="end_date"> End Date: </label>
                        <input type="text" required="required" placeholder="Click to choose a date" class="form-control" name="end_date" id="end_date">
                    </div>
                    <div class="col-md-6">
                        <button class="btn btn-primary" type="submit" > Send </button>
                    </div>
            </form>
            <div class='row'>
                <div class='col-lg-2 col-lg-offset-10'>
                    <a href="index.php"> <button type='button' class='btn btn-primary'>Return Home</button> </a>
                </div>
            </div>
        </div>
    </body>

</html>


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
        <script src="insertInfo.js"></script>

    </head>
    <body>
        <div class="well row">
            <h2> Put in an entry! </h2>
            <form role="from">
                <div class=" form-group col-lg-12">
                    <label for="mode"> Semester: </label>
                    <select class="form-control" id="mode">
                        <option value="Bike">Bike</option>
                        <option value="Swim">Swim</option>
                        <option value="Run">Run</option>
                    </select>
                </div>
                <div class=" form-group col-lg-12">
                    <label for="distance"> Distance(mi.): </label>
                    <input type="text" class="form-control" id="distance">
                </div>
                <div class=" form-group col-lg-12">
                    <label for="date"> Date: </label>
                    <input type="text" placeholder="Click to choose a date" class="form-control" id="entryDate">
                </div>
                <div class="col-md-6">
                    <button class="btn btn-primary" type="button" onclick="sendEntry()"  > Send </button>
                </div>
            </form>
            <div id="unameModal" class="modal fade">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4 class="modal-title">Your device is not in our system! Would you like a Username?</h4>
                        </div>
                        <div class="modal-body">
                            <div class=" form-group col-lg-12">
                                <input id='userName' type="text" placeholder='Enter a Username here.' class="form-control" >
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">I'm OK with being just a number</button>
                            <button type="button" onclick='createNewUser()' data-dismiss="modal" class="btn btn-primary">Sure</button>
                        </div>
                    </div><!-- /.modal-content -->
                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->
    </body>
</html>



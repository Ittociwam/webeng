<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor. I am in a new branch????????
-->
<html>
    <head>
        <script src="//code.jquery.com/jquery-1.11.3.min.js"></script>
        <script src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
        <?php
        if (getenv('OPENSHIFT_MYSQL_DB_HOST')) {
            echo '<link rel="stylesheet" type="text/css" href="/bootstrap/css/bootstrap.min.css"/>
                <script type="text/javascript" src="/bootstrap/js/bootstrap.js"></script>';
        } else {
            echo '<link rel="stylesheet" type="text/css" href="/webengii/webengii/bootstrap/css/bootstrap.min.css"/>
        <script type="text/javascript" src="/webengii/webengii/bootstrap/js/bootstrap.js"></script>';
        }
        ?>
        <link type="text/css" rel="stylesheet" href="ironman.css"/>
    </head>
    <body>
        <div class="container">
            <div class="row vertical-center-row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6"><button onclick="parent.location = 'viewInfo.php'" type="button" class="btn btn-primary btn-lg"> Show info form database </button></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-md-offset-3 col-md-6"><button onclick="parent.location = 'insertInfo.php'" type="button" class="btn btn-primary btn-lg"> Insert info into database </button></div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>

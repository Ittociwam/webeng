<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>Thank You</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://bit.ly/owj6Fv"></script> 
        <script type="text/javascript" src="http://bit.ly/oJARsF"></script> 
        <script src="survey.js"></script>
    </head>
    <body>
            <?php 
            include($_SERVER['DOCUMENT_ROOT'] . "modules/header.php"); //path for openshift
            include($_SERVER['DOCUMENT_ROOT'] . "webengii/webengII/modules/header.php"); //path for localhost
            ?>  
        
        <div class = "white" id="results"></div>
        <h3 class="white" >Thank you for completing our survey!</h3>
        <a href="http://php-biset.rhcloud.com/">Return Home</a>
    </body>
</html>

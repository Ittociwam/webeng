<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <script type="text/javascript" src="http://bit.ly/owj6Fv"></script> 
        <script type="text/javascript" src="http://bit.ly/oJARsF"></script> 
        <script src="survey.js"></script>
    </head>
    <body>
                <header>
            <?php 
            include($_SERVER['DOCUMENT_ROOT'] . "modules/header.php"); //path for openshift
            include($_SERVER['DOCUMENT_ROOT'] . "webengii/webengII/modules/header.php"); //path for localhost
            ?>  
        </header>
        <h1 class="white">New Science/Technology Building Survey</h1>
        <br/>
        <form class="white">
            How many <a href="http://www.amazon.com/LG-Electronics-34-Inch-LED-Lit-34UC97-S/dp/B00OKSEWL6">  34 inch curved LED-backlit LCD monitors </a> should be set up at each linux lab station? <br/>
           2 <input type="radio" value ="2" name="monitors"/><br/>
           3 <input type="radio" value ="3" name="monitors"/><br/>
           4 <input type="radio" value ="4" name="monitors"/><br/>
           5 <input type="radio" value ="5" name="monitors"/><br/>
            <br/>
            What beverages should come out of the drinking fountain? <br/>
           Pina Colada <input type="radio" value ="Pina Colada" name="drinks"/><br/>
           Dr. Pepper <input type="radio" value ="Dr. Pepper" name="drinks"/><br/>
           Blue Dew <input type="radio" value ="Blue Dew" name="drinks"/><br/>
           Chocolate Milk <input type="radio" value ="Chocolate Milk" name="drinks"/><br/>
            <br/>
           What should come around on the complementary Linux-Lab snack cart every day at 3PM? <br/>
           Pizza <input type="radio" value ="Pizza" name="snacks"/><br/>
           Doughnuts <input type="radio" value ="Doughnuts" name="snacks"/><br/>
           Jimmy Johns <input type="radio" value ="Jimmy Johns" name="snacks"/><br/>
           Chalupas <input type="radio" value ="Chalupas" name="snacks"/><br/>
            <br/>
           How should we get around in the new science/technology building? <br/>
            Moving Sidewalks <input type="radio" value ="Moving Sidewalks" name="transport"/> <br/>
            Razor Scooters <input type="radio" value ="Razor Scooters" name="transport"/> <br/>
            Segways <input type="radio" value ="Segways" name="transport"/> <br/>
            Google Self-Driving Cars <input type="radio" value ="Google Self-Driving Cars" name="transport"/><br/>
            <button id="driver" type="button"> submit </button> 
            <button id="display" type="button"> Display Survey Results </button>
        </form>
        
        
        <div class="white" id="results"></div>
    </body>
</html>

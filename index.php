<!DOCTYPE html>
<html>
    <head>
        <link rel="stylesheet" type="text/css" href="css/main.css"/>
        <title>Robbie's HomePage</title>
    </head>
    <body>

        <h1> My Portfolio Home Page </h1>

                <header>
             <?php include(dirname(__FILE__) . "/modules/header.php");?>  
        </header>
        <p> Welcome to my portfolio. Check out some of my project 
            links below.</p>
        <div id = "container">
            <div class="third">
                <a href="tutorialvids.php" class="projectlink">
                    <img alt="Screenshot of inheritance videos" src="media/inheritancevideos.JPG"/>
                    <div class="black-overlay"><span class="hidden"> Inheritance Educational Videos</span></div>
                </a>
            </div>
            <div class="third">
                <a href="https://github.com/Ittociwam/Catstroids" class="projectlink">
                    <img alt="Screenshot of catstroids game" src="media/asteroids.JPG"/>
               <div class="black-overlay"> <span class="hidden"> C++ "CAT"steroids </span></div>
                </a>
            </div>
            <div class="third">
                <a href="https://github.com/Ittociwam/Skeet" class="projectlink">
                    <img alt="Screenshot of skeet game" src="media/skeet.JPG"/>
                    <div class="black-overlay"><span class="hidden"> C++ Skeet </span></div>
                </a>
            </div>
        </div>
        
                <div id = "container">
            <div class="third">
                <a href="BYOHC/index.php" class="projectlink">
                    <img alt="Screenshot of wellness coaching site" src="media/hero.JPG"/>
                    <div class="black-overlay"><span class="hidden"> Wellness Coaching WebSite </span></div>
                </a>
            </div>
            <div class="third">
                <a href="SRA/index.php" class="projectlink"><img alt="Screenshot of mock business site" src="media/salmon.JPG"/>
               <div class="black-overlay"> <span class="hidden"> Mock River Rafting Website </span></div>
                </a>
            </div>
            <div class="third">
                <a href="web-eng/index.html" class="projectlink"><img alt="Screenshot of a mortgage calculator" src="media/loan.JPG"/>
                    <div class="black-overlay"><span class="hidden"> Projects from my Web Engineering Class </span></div>
                </a>
            </div>
        </div>
        
                        <div id = "container">
            <div class="third">
                <a href="https://github.com/Ittociwam/Bise-Joseph-Team" class="projectlink">
                    <img alt="Title for text-game" src="media/tqotpt.jpg"/>
                    <div class="black-overlay"><span class="hidden"> Java Text Based Zombie Game </span></div>
                </a>
            </div>
                            <!--
            <div class="third">
                <a href="tutorialvids.php" class="projectlink"><img alt="Screenshot of inheritance videos" src="media/inheritancevideos.JPG"/>
               <div class="black-overlay"> <span class="hidden"> Title2 </span></div>
                </a>
            </div>
            <div class="third">
                <a href="tutorialvids.php" class="projectlink"><img alt="Screenshot of inheritance videos" src="media/inheritancevideos.JPG"/>
                    <div class="black-overlay"><span class="hidden"> Title3 </span></div>
                </a>
            </div>
                            -->
        </div>

    </body>
</html>

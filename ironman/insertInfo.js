/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

//jquery stuff
$(document).ready(function () {
    //initialize date picker
    $('#entryDate').datepicker({
        format: "yyyy-mm-dd" //mysql format
    });

    //initilize modal to not shown
    $('#unameModal').modal({show: false});
    $('#finishedModal').modal({show: false});

    //change the text of the distance label as needed
    $('#mode').change(function () {

        if ($('#mode').val() == "Swim")
        {
            $('#distLabel').text("Distance (laps):");
        }
        else
        {
            $('#distLabel').text("Distance (miles):");
        }
    });
    
    // when the user clicks the ok button on the final notification, we need to clear the form
    $("#endButton").click(function(){
        console.log("clearing the form?");
        $('#entryForm').trigger("reset");
    });
    

});

//builds the url and sends it with ajax to my newEntry.php file
function submitEntry() {
    var url = "newEntry.php?";
    url += "mode=" + $('#mode').val();
    url += "&distance=" + $('#distance').val();
    console.log("date from form is: " + $('#entryDate').val());
    url += "&date=" + $('#entryDate').val();
    url += "&user=" + localStorage.getItem("user");
    console.log("newEntry url = " + url);

    jQuery.get(url, function (data) {
        var parsedData = JSON.parse(data);
        console.log("pasred json from submit entry" + parsedData.message);
        $('#finishedModal').modal('show');
        // if the return code is  0 everything is ok. 
        if (parsedData.code != 0)
        {
            $('#finishedTitle').text("Something went wrong...");
            $('#finishedBody').text(parsedData.message);
        }
        //otherwise we get a user friendly message of what the issue was. 
        else
        {
            $('#finishedTitle').text("Your entry was successful!");
            $('#finishedBody').text(parsedData.message);
        }

    });
}

// check if the user already is in our system.
function validateUser() {
    // if browser finds no local storage for user
    if (!localStorage.getItem("user"))
    {
        // prompt for a user name
        console.log("didn't find a user in validateUser");
        $('#unameModal').modal('show');
    }
    else {
        console.log("found a user in validate user submitting entry...");
        submitEntry();
    }


}

// if a user is not found in the system, this function gets called by an onclick event
//from the modal that promps for a username.
function createNewUser(username) {
    console.log("create new user called.");
    console.log("username in createNewUser(): " + document.getElementById('userName').value);
    // url to newUser.php
    var url = "newUser.php?username=" + username;
    console.log("url: " + url);
    // query string has a uname if user specified
    // 
    // ajax call to newUser.php 
    jQuery.get(url, function (data) {
        if (!isNaN(data))
        {
            console.log("succesfully created new user: " + data);
            localStorage.setItem("user", data);
            submitEntry(); // we don't want this called until after localStorage has done it's thing
        }
        else
        {
            console.log(" error: data in create new user " + data);
            return false;
        }
    });




}
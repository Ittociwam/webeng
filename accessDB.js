/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */



function getEntries() {
    var xmlhttp = new XMLHttpRequest();
    var url = "getEntries.php";
    var postData = "semester=" + document.getElementById("semester").value
            + "&fname=" + document.getElementById("fname").value + "&lname=" +
            document.getElementById("lname").value +
            "&email=" + document.getElementById("email").value;


    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var data = JSON.parse(xmlhttp.responseText);
            displayEntries(data);
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//xmlhttp.setRequestHeader("Content-length", postData.length);
//xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(postData);
}


function getContestants() {

    var xmlhttp = new XMLHttpRequest();
    var url = "getContestants.php";
    var postData = "semester=" + document.getElementById("semester").value;

    xmlhttp.onreadystatechange = function () {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
            var data = JSON.parse(xmlhttp.responseText);
            displayContestants(data);
        }
    };
    xmlhttp.open("POST", url, true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
//xmlhttp.setRequestHeader("Content-length", postData.length);
//xmlhttp.setRequestHeader("Connection", "close");
    xmlhttp.send(postData);


}

function displayContestants(data) {
    var out = "No Contestants";
    if (data.length != 0) {
        var semester = getSemester(document.getElementById("semester").value);
        out = "<h2>Students registered for the Lazy Man Iron Man </br> <small> " + semester + "</small></h2>";
        console.log(data.length);
        out += "<table id='table1' class='tablesorter table table-striped'><thead>\n\
               <tr> <th> First Name </th> <th> Last Name </th> <th> Email </th> <th> Percentage Complete </th> \n\
               </tr> </thead> <tbody>";
        for (var i = 0; i < data.length; i++) {
            out += "<tr> <td>" +
                    data[i].fname + "</td>" +
                    "<td>" + data[i].lname + "</td>"
                    + "<td>" + data[i].email + "</td>\n\
    <td>" + Math.floor(data[i].percentage * 100) + "%</td></tr>";
        }
        out + "</tbody></table>";

    }

    document.getElementById("contestantResults").innerHTML = out;
    $("#table1").tablesorter({
        theme: 'blue',
        sortList: [[1, 0], [2, 0], [3, 0]],
        // header layout template; {icon} needed for some themes
        headerTemplate: '{content}{icon}',
        // initialize column styling of the table
        widgets: ["columns"],
        widgetOptions: {
            // change the default column class names
            // primary is the first column sorted, secondary is the second, etc
            columns: ["primary", "secondary", "tertiary"]
        }
    });
}

function displayEntries(data) {
    var out = "No Entries"
    if (data.length != 0) {
        var semester = getSemester(data[0].semester);
        out = "<h2>Entries For " + data[0].lname + ", " + data[0].fname + "</h2>";
        out += "<table id='table2' class='tablesorter table table-striped'><thead>\n\
               <tr> <th> Name </th> <th> Date  </th> <th> Action </th> \n\
               </tr> </thead> <tbody>";
        for (var i = 0; i < data.length; i++) {
            date = new Date(data[i].date);
            out += "<tr> <td>" + data[i].fname + " " + data[i].lname + "</td>" +
                    "<td>" + date.toLocaleDateString() + "</td>"
                    + "<td>" + getAction(data[i]) + "</td></tr>";
        }
        out + "</tbody></table>";

    }
    document.getElementById("entryResults").innerHTML = out;
    $("#table2").tablesorter(
            {
                theme: 'blue',
                sortList: [[1, 0], [2, 0], [3, 0]],
                // header layout template; {icon} needed for some themes
                headerTemplate: '{content}{icon}',
                // initialize column styling of the table
                widgets: ["columns"],
                widgetOptions: {
                    // change the default column class names
                    // primary is the first column sorted, secondary is the second, etc
                    columns: ["primary", "secondary", "tertiary"]
                }
            });
}

function getAction(data) {
    var action = "";
    switch (data.mode) {
        case "Bike":
            action = "Biked ";
            break;
        case "Swim":
            action = "Swam ";
            break;
        case "Run":
            action = "Ran ";
            break;
    }
    action += data.distance + " " + data.units;
    return action;
}

function getSemester(semester) {
    var year = semester.replace(/\D/g, "");
    var sem = semester.replace(/[^a-z]/gi, "");

    // title case word?
    for (var i = 1; i < sem.length; i++) {

        sem[i] = sem[i].toLowerCase();
    }
    return sem + " " + year;
}


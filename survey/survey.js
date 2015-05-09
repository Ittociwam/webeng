/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

function SurveyResponse(monitors, drinks, snacks, transport) {
    this.monitors = monitors;
    this.drinks = drinks;
    this.snacks = snacks;
    this.transport = transport;
}



$(document).ready(function () {
    if (localStorage["survey"] === "taken")
    {
        sayThankYou();
    }
    $("#driver").click(function () {
        var m = $("input[name=monitors]:checked").val();
        var d = $("input[name=drinks]:checked").val();
        var s = $("input[name=snacks]:checked").val();
        var t = $("input[name=transport]:checked").val();
        var surveyResponse = new SurveyResponse(m, d, s, t);

        url = "getSurvey.php";
        var jsonString;
        $.ajax({
            url: url,
            dataType: 'json',
            contentType: 'application/json; charset=UTF-8',
            type: 'POST',
            success: function (json) {

                updateQuiz(json, surveyResponse);
                jsonString = JSON.stringify(json);
                saveQuiz(jsonString);
            }
        });


    });

    $("#display").click(function () {
        
        if($(this).hasClass('displaying'))
        {
         $("#results").html("");
        $("#display").html('Display Survey Results');
        $(this).removeClass('displaying');
        console.log(this);
        }
        else
        {
        displayResults();
        $("#display").html('Hide Results');
        $(this).addClass('displaying');
        console.log(this);
        }

    });

});

function updateQuiz(results, response) {
    var quizName = results.name;

    results.questions.forEach(function (question) {
        var responses = question.responses;
        switch (question.topic)
        {
            case "monitors":
                incrementVote(responses, response.monitors);
                break;
            case "drinks":
                incrementVote(responses, response.drinks);
                break;
            case "snacks":
                incrementVote(responses, response.snacks);
                break;
            case "transport":
                incrementVote(responses, response.transport);
                break;
            default:
                console.log("error!!!!!");
        }
    });

}

function incrementVote(responses, vote)
{

    responses.forEach(function (resp) {
        if (vote == resp.title)
        {
            resp.numVotes++;
        }
    });
}

function saveQuiz(quizString) {
    url = "saveSurvey.php";
    $.ajax({
        url: url,
        data: {"myData": quizString},
        type: 'POST',
        success: function (response) {
            console.log("success in saveQuiz");
            localStorage.setItem("survey", "taken");
            JSON.stringify(response);
            window.alert("here");
            sayThankYou(quizString);

        }
    });
}

function sayThankYou() {

    if (getCurrentPage() !== "thanks.html")
        window.location.replace('thanks.html');

    displayResults();
}

function displayResults() {
    var url = "getSurvey.php";
    var resultsString;
    $.ajax({
        url: url,
        dataType: 'json',
        contentType: 'application/json; charset=UTF-8',
        type: 'POST',
        success: function (json) {

            resultsString = getDisplayQuiz(json);
            $("#results").html(resultsString);
        }
    });

}

function getDisplayQuiz(results) {
    var quizString = "<h1> " + results.name + " Results </h1>";

    results.questions.forEach(function (question) {
        switch (question.topic)
        {
            case "monitors":
                quizString += displayVotes(question, "Number of Monitors");
                break;
            case "drinks":
                quizString += displayVotes(question, "Type of Drinks");
                break;
            case "snacks":
                quizString += displayVotes(question, "Type of Snacks");
                break;
            case "transport":
                quizString += displayVotes(question, "Type of Transport");
                break;
            default:
                console.log("error!!!!!");
        }
    });
    return quizString;
}

function displayVotes(question, title, quizString)
{
    var questionString = "<h2>" + title + "</h2>";
    responses = question.responses;
    responses.forEach(function (resp) {
        questionString += resp.title + ": " + resp.numVotes + "<br/>";
    });
    return questionString;
}

function getCurrentPage() {
    var path = window.location.pathname;
    var page = path.split("/").pop();
    return page;
}




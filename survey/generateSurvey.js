/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


function Response(title, numVotes){
    this.title = title;
    this.numVotes = numVotes;
}

var mresponses = new Array();
mresponses[0] = new Response(2, 0);
mresponses[1] = new Response(3, 0);
mresponses[2] = new Response(4, 0);
mresponses[3] = new Response(5, 0);

var dresponses = new Array();
dresponses[0] = new Response("Pina Colada", 0);
dresponses[1] = new Response("Dr. Pepper", 0);
dresponses[2] = new Response("Blue Dew", 0);
dresponses[3] = new Response("Chocolate Milk", 0);

var sresponses = new Array();
sresponses[0] = new Response("Pizza", 0);
sresponses[1] = new Response("Doughnuts", 0);
sresponses[2] = new Response("Jimmy Johns", 0);
sresponses[3] = new Response("Chalupas", 0);

var tresponses = new Array();
tresponses[0] = new Response("Moving Sidewalks", 0);
tresponses[1] = new Response("Razor Scooters", 0);
tresponses[2] = new Response("Segways", 0);
tresponses[3] = new Response("Google Self-Driving Cars", 0);

function Question(topic, responses){
    this.topic = topic;
    this.responses = responses;
}

var questionsArray = new Array();;

questionsArray[0] = new Question("monitors", mresponses);
questionsArray[1] = new Question("drinks", dresponses);
questionsArray[2] = new Question("snacks", sresponses);
questionsArray[3] = new Question("transport", tresponses);

function Survey(name, questions){
    this.name = name;
    this.questions = questions;
}

var survey;

survey = new Survey("New Science/Technology Building Survey", questionsArray);

document.write(JSON.stringify(survey));
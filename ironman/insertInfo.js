/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */


$(document).ready(function () {

    $('#entryDate').datepicker({
        format: "dd/mm/yyyy"
    });

$('#unameModal').modal({ show: false});
});

function sendEntry(){
    if(!localStorage.getItem("user"))
    {
        $('#unameModal').modal('show');
    }
    else
    {
        console.log("found a user id!")
    }
        
}

function createNewUser(){
    console.log("create new user called.");
    console.log("username: " + document.getElementById('userName').value);
    
}
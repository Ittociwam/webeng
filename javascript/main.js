$(document).ready(function () {
    window.setInterval(function () {
        $("#myImage").animate({backgroundColor: "#4f4c4c"}, 1000);
        $("#myImage").animate({backgroundColor: "#8af228"}, 2500);
    }, 0);
});

$(document).ready(function () {
    $("#assignments").hover(function () {
        $("#assignments").animate({
            fontSize: "2.5em"},
        2000);
    }, function () {
        $(this).stop().animate({fontSize: '2em'});
    });
});



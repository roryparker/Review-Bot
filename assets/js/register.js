$(document).ready(function() {

    // Will only work when page loads.
    // On click sign up, hide login and show registration form

    $("#signin").click(function() {
        $("#second").slideUp("slow", function() {
            $("#first").slideDown("slow");
        });
    });

    // On click sign up, hide registration and show login form

    $("#signup").click(function() {
        $("#first").slideUp("slow", function() {
            $("#second").slideDown("slow");
        });
    });


});
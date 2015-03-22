$(document).ready(function() {
    //Create 8*8 grid with default color settings
    createGrid(8);
    defaultSketch();
});
//Holds the amount of squares chosen by user
function numberSquares() {
    x = prompt("Squares per side ? (1-14)");
    if (x <= 0 || x > 14) {
        x = prompt("The number must be < 0 and => 14!");
        return numberSquares();
    }
    //Removes previous grid
    $(".square").remove();
    return x;
}
//Called when page loads to prevent blank page
function defaultSketch() {
    $(".square").hover(function() {
        $(this).css('background-color', 'grey');
    });
}
//Called upon click of sketch button
function greySketch() {
    x = numberSquares();
    createGrid(x);
    defaultSketch();
}
//Called upon click of gradient button
function gradSketch() {
    x = numberSquares();
    createGrid(x);
    $(".square").mouseover(function() {
        newOpacity = parseFloat($(this).css("opacity")) - 0.05;
        $(this).css("opacity", newOpacity);
    });
}
//Called upon click of trail button
function trailSketch() {
    x = numberSquares();
    createGrid(x);
    $(".square").hover(function () {
        $(this).css('opacity', 0);
    },

    function () {
        $(this).fadeTo('fast',1);
    });

}
//Called upon click of colors button
function colorSketch() {
    x = numberSquares();
    createGrid(x);
    $(".square").hover(function() {
        $(this).css({
            "background-color": '#' + Math.random().toString(16).substring(2, 8)
        });
    });
}
//Called upon document ready and passed value from onclick
function createGrid(size) {
    var square_size = $("#box").width() / size - 2; //-2 for borders
    //Create the size x size grid.
    for (var i = 0; i < size; i++) {
        for (var j = 0; j < size; j++) {
            //Adds the squares too DOM
            $("#box").append("<div class='square'></div>");
        }
    }
    //Adjust the square size based on input.
    $(".square").css('width', square_size);
    $(".square").css('height', square_size);
}
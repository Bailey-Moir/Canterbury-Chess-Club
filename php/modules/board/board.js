//TODO: add capability to have multiple boards without interfering.
$(document).ready(function(){
    // Toggling square selection for note taking
    $(".square, .piece").bind("contextmenu", e => {
        let target = $(e.target);
        if (target.hasClass("piece")) target = target.parent();

        target.hasClass("selected") ? target.removeClass("selected") : target.addClass("selected");
        return false;
    });

    // Clearing all notes
    $(".square").mousedown(e => e.which == 1 && $(".square").removeClass("selected"));
}); 
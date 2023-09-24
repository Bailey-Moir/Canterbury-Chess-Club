$(document).ready(() => {
    let white = $('input[name="whiteCheck"]');
    let black = $('input[name="blackCheck"]');
    let draw = $('input[name="drawCheck"]');

    white.change(() => {
        if (!white.is(":checked")) return;
        black.prop("checked", false);
        draw.prop("checked", false);
    });
    
    black.change(() => {
        if (!black.is(":checked")) return;
        white.prop("checked", false);
        draw.prop("checked", false);
    });
    
    draw.change(() => {
        if (!draw.is(":checked")) return;
        white.prop("checked", false);
        black.prop("checked", false);
    });

        
    // Data Picker Initialization
    $('.datepicker').datepicker({
        inline: true
    });
    
});
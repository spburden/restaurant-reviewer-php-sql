$(function() {
    $('#slider').on("mousemove", function() {
        $('#sliderValue').html($('#slider').val());
    });
});

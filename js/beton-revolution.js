jQuery(document).ready(function ($) {
    console.log('beton-revolution.js loaded');

    //Calculate Cubic Meters
    $('#bpc-kuub-result-calc-btn').on('click', function () {
        const length = $('#bpc-kuub-length-input').val();
        const width = $('#bpc-kuub-width-input').val();
        const height = $('#bpc-kuub-height-input').val();
        const result = length * width * height;
        $('#bpc-kuub-result-value').text(result);
    });
});
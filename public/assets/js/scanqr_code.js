$(document).ready(function () {
    //onInit
    $('.display-preview-camera').hide();


    $('.close').click(function (e) { 
        e.preventDefault();
        $('.display-preview-camera').hide();
    });

    $('#btn_send_scanqr').click(function (e) { 
        e.preventDefault();
        $('.display-preview-camera').show();
    });

});

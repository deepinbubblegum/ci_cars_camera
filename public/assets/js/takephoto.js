$(function () {
    $('.image_souce').click(function (e) { 
        e.preventDefault();
        let imgs = $(this)[0];
        let expandImg = $('#expandedImg')[0];
        let imgText = $('#imgtext')[0];
        expandImg.src = imgs.src;
        imgText.innerHTML = imgs.alt;
        expandImg.parentElement.style.display = "block";
    });

    $('#confirm-btn').click(function (e) {
        $('#confirm-box').modal('show');
    });

    $('#confirm-btn-save').click(function (e) {
        $('#confirm-box-save').modal('show');
    });
});
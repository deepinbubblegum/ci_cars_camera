$(document).ready(function () {
    $('#sign_in').submit(function (e) { 
        e.preventDefault();
        let form_data = $('#sign_in').serialize();

        $.ajax({
            type: "POST",
            url: "./welcome/sign_in",
            data: form_data,
            dataType: "json",
            success: function (response) {
                console.log(response);
                if(!response){
                    alert('Username or Password don\'t match');
                }else{
                    location.reload();
                }
            }
        });
    });
});
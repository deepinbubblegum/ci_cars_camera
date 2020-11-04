$(document).ready(function () {

	$('#register-btn').click(function (e) {
		e.preventDefault();
		let username = $('#username').val();
		let password = $('#password-register').val();
		let confirmpassword = $('#confirm-password').val();

		if (username * 1 == 0) {
			return false;
		}

		if (password * 1 == 0) {
			return false;
		}

		if (confirmpassword * 1 == 0) {
			return false;
		}

		if (password !== confirmpassword) {
			alert('Password is not match')
			$('#confirm-password').val('');
			$('#password-register').val('');
			return false;
		}

		$.ajax({
			type: "POST",
			url: "./admin/register",
			data: {
				username: username,
				password: password,
			},
			dataType: "json",
			success: function (response) {
				console.log(response);
				location.reload();
			}
		});
	});

	getUsershowindisplay();

	function getUsershowindisplay() {
		$.ajax({
			type: "get",
			url: "./admin/getUser",
			dataType: "json",
			success: function (response) {
				console.log(response);
				htmlString = '';
				for (let index = 0; index < response.messages.length; index++) {
					htmlString += `<tr>
                    <th scope="row">${response.messages[index]['u_id']}</th>
                    <td>${response.messages[index]['username']}</td>
                    <td style="align-items: center;"><button value="${response.messages[index]['u_id']}" type="button" class="btn btn-danger mx-auto delete-user"><i class="fas fa-trash-alt"></i></button></td>
                    </tr>`;
				}
                $('#tr-display').html(htmlString);
                initbtndel();
			}
		});
    }

    function initbtndel(){
        $('.delete-user').click(function (e) { 
            e.preventDefault();
            let value_id = $(this).attr('value');
            if (confirm(`Press a confirm delect user id: ${value_id}`)){
                $.ajax({
                    type: "POST",
                    url: "./admin/delect_user",
                    data: {
                        userid:value_id
                    },
                    dataType: "json",
                    success: function (response) {
                        console.log(response);
                        location.reload();
                    }
                });
            }
        });
    }
    
});

$(function () {
	var have_img = false;
	let url_img = '../../showImage_on_display';
	let url_path = window.location.pathname;
	let path_name = url_path.split("/");
	console.log(path_name);
    $('#btn_take_a_photo').hide();
    $('#btn_group_ag').hide();
	function image_souce() {
		$('.image_souce').click(function (e) {
			e.preventDefault();
			let imgs = $(this)[0];
			let expandImg = $('#expandedImg')[0];
			let imgText = $('#imgtext')[0];
			expandImg.src = imgs.src;
			imgText.innerHTML = imgs.alt;
			expandImg.parentElement.style.display = "block";
		});
	}

	$('#confirm-btn').click(function (e) {
		$('#confirm-box').modal('show');
	});

	$('#confirm-btn-save').click(function (e) {
		$('#confirm-box-save').modal('show');
	});
	fristTime();

	function fristTime() {
		$.ajax({
			type: "POST",
			url: '../../get_all_filename',
			data: {
				qr_id: path_name[4],
			},
			dataType: "json",
			success: function (response) {
				htmlString = '';
				if (response.messages != null) {
					have_img = true;
					for (let index = 0; index < response.messages.length; index++) {
						htmlString += `<div class="column image-preview">
                        <img class="image_souce" src="${url_img}/${path_name[4]}/${response.messages[index]}" alt="${response.messages[index]}" style="width:100%">
                        </div>`;
					}
				} else {
					have_img = false;
				}
				setTimeout(() => {
					hidebtn();
				}, 1500);
				$('#rowshow_img').html(htmlString);
				image_souce();
			}
		});
	}

	function hidebtn() {
		if (have_img) {
			$('#btn_take_a_photo').hide();
			$('#btn_group_ag').show();
		} else {
			$('#btn_group_ag').hide();
			$('#btn_take_a_photo').show();
		}
	}

	$('#btn_take_a_photo').click(function (e) {
		e.preventDefault();
        take_a_photo_udp();
	});

	$('#Take_again').click(function (e) {
		e.preventDefault();
		take_a_photo_udp();
	});

	function take_a_photo_udp() {
		$.ajax({
			url: "../../take_a_photo_udp",
			dataType: "json",
			success: function (response) {
				if (response.mesagess) {
                    process_image();
				} else {
					alert('Error can\'t send data on udp protocall')
				}
			}
		});
	}

	function process_image() {
		$.ajax({
			type: "POST",
			url: "../../process_image",
			data: {
				qr_id: path_name[4],
				option_resize: path_name[5]
			},
			dataType: "json",
			success: function (response) {
				console.log(response)
				if (!response.messages) {
					alert('Error');
				} else {
					setTimeout(() => {
						fristTime();
						hidebtn();
						$('#confirm-box').modal('hide');
					}, 1500);
				}
			}
		});
    }
    
    $('#next_page').click(function (e) { 
        e.preventDefault();
        next_page();
    });

    function next_page() {
        window.location.href = '../../success';
    }

    $('#add-image-manual').click(function (e) { 
        e.preventDefault();
        $('#input_image').trigger('click');
    });

    $('#input_image').change(function (e) { 
        e.preventDefault();
        var imagefile = $('#input_image')[0].files[0];
        var formData = new FormData();
        formData.append('file', imagefile);
        formData.append('path_image', path_name[4]);
        formData.append('option_resize', path_name[5]);
        $.ajax({
            type: "POST",
            url: "../../add_image_manual",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
            success: function (response) {
                console.log(response);
                setTimeout(() => {
                    fristTime();
                }, 100);
            }
        });
    });
});

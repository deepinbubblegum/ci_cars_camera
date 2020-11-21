$(document).ready(function () {
	//onInit
	$('.display-preview-camera').hide();

    var video = document.createElement("video");
	var canvasElement = document.getElementById("canvas");
	var canvas = canvasElement.getContext("2d");
	var loadingMessage = document.getElementById("loadingMessage");
	var outputContainer = document.getElementById("output");
	var outputMessage = document.getElementById("outputMessage");
	var outputData = document.getElementById("outputData");
	var beepsound = document.getElementById("beepsound");
    var outputQrcode = document.getElementById('outputqrcode');
	var TLR, TRR, BRL, BLL;
	var code;
    var waiting;
    var localstream;
    var resize_small;

	function drawLine(begin, end, color) {
		canvas.beginPath();
		canvas.moveTo(begin.x, begin.y);
		canvas.lineTo(end.x, end.y);
		canvas.lineWidth = 4;
		canvas.strokeStyle = color;
		canvas.stroke();
		return true;
	}

    $('.close').click(function (e) {
		e.preventDefault();
        localstream.getTracks()[0].stop();
        $('.display-preview-camera').hide();
    });


	function tick() {
		loadingMessage.innerText = "⏳ Loading video..."
		if (video.readyState === video.HAVE_ENOUGH_DATA) {
			loadingMessage.hidden = true;
			canvasElement.hidden = false;
			outputContainer.hidden = false;

			canvasElement.height = video.videoHeight;
			canvasElement.width = video.videoWidth;
			canvas.drawImage(video, 0, 0, canvasElement.width, canvasElement.height);
			if (!video.paused) {
				var imageData = canvas.getImageData(0, 0, canvasElement.width, canvasElement.height);
				code = jsQR(imageData.data, imageData.width, imageData.height, {
					inversionAttempts: "dontInvert",
				});
			}
			if (code) {
				TLR = drawLine(code.location.topLeftCorner, code.location.topRightCorner, "#FF3B58");
				TRR = drawLine(code.location.topRightCorner, code.location.bottomRightCorner, "#FF3B58");
				BRL = drawLine(code.location.bottomRightCorner, code.location.bottomLeftCorner, "#FF3B58");
				BLL = drawLine(code.location.bottomLeftCorner, code.location.topLeftCorner, "#FF3B58");
				outputMessage.hidden = true;
				outputData.parentElement.hidden = false;
				outputData.innerText = code.data;
				if (code.data != "" && !waiting && TLR == true && TRR == true && BRL == true && BLL == true) {
                    console.log(code.data);
					code.data = parseInt(code.data);
					code.data = code.data.toString();
					resize_small = encodeURI(resize_small);
					// console.log();
                    window.location.href = `./scanqr/takephoto/${code.data.padStart(6, "0")}/${resize_small}`;
					video.pause();
					beepsound.play();
					beepsound.onended = function () {
						beepsound.muted = true;
					};
					// ให้เริ่มเล่นวิดีโอก่อนล็กน้อย เพื่อล้างค่ารูป qrcod ล่าสุด เป็นการใช้รูปจากกล้องแทน
					setTimeout(function () {
						video.play();
					}, 4500);
					// ให้รอ 5 วินาทีสำหรับการ สแกนในครั้งจ่อไป
					waiting = setTimeout(function () {
						TLR,
						TRR,
						BRL,
						BLL = null;
						beepsound.muted = false;
						if (waiting) {
							clearTimeout(waiting);
							waiting = null;
						}
					}, 5000);
				}
			} else {
				outputMessage.hidden = false;
				outputData.parentElement.hidden = true;
			}
		}
		requestAnimationFrame(tick);
	}

	$('#btn_send_scanqr').click(function (e) {
		e.preventDefault();
        $('.display-preview-camera').show();
        
        if ($('#Swicth-option-size-img').is(":checked"))
        {
            resize_small = true;
        }else{
            resize_small = false;
        }

		// Use facingMode: environment to attemt to get the front camera on phones
		navigator.mediaDevices.getUserMedia({
			video: {
                facingMode: "environment",
                frameRate: {min:1,ideal: 30,max: 60}
			}
		}).then(function (stream) {
            localstream = stream;
			video.srcObject = stream;
			video.setAttribute("playsinline", true); // required to tell iOS safari we don't want fullscreen
			video.play();
			requestAnimationFrame(tick);
		});

	});
	
	$('#Swicth-option-mode').change(function (e) { 
		e.preventDefault();
		if($('#Swicth-option-mode').is(":checked")){
			$('.Manual_Mode_option_elm').prop('disabled', false);
			$('.Manual_Mode_option_scan').prop('disabled', true);
			
		}else{
			$('.Manual_Mode_option_elm').prop('disabled', true);
			$('.Manual_Mode_option_scan').prop('disabled', false);
		}
	});

	$('#manual_code_btn').click(function (e) { 
		e.preventDefault();
		var manual_val = $('.input-Manual_Mode_option_elm').val();
		if(manual_val *1 == 0){
			alert('Please enter data in a Create a directory manual box');
			return false;
		}

		if ($('#Swicth-option-size-img').is(":checked"))
        {
            resize_small = true;
        }else{
            resize_small = false;
        }

		window.location.href = `./scanqr/takephoto/${manual_val.padStart(6, "0")}/${resize_small}`;
	});

});

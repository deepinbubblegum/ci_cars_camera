<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ScanQR Code</title>
    <link rel="stylesheet" href="./public/assets/css/style_scanqr.css">
</head>

<body>
    <div class="container-fluid">
        <div class="display-box">
            <h3 class="text-title-heard">ScanQR Code</h3>
            <div class="img-icon-preview">
                <img class="image_qr_show" src="./public/assets/img/example.png" alt="">
            </div>
            <button class="btn-scan-qr" id="btn_send_scanqr">SCAN</button>
        </div>
        <div class="display-preview-camera">
            <div class="modal-content">
                <div class="close" id="close_model"></div>
                <div class="dispaly-scan">
                    <p class="error"></p>
                    <p class="decode-result">
                    </p>
                    <!-- <qrcode-stream class="qrcode-stream"></qrcode-stream> -->
                </div>
            </div>
        </div>
    </div>

    <script src="./public/assets/js/scanqr_code.js"></script>
</body>

</html>
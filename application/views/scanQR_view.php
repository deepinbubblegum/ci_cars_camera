<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ScanQR Code</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style_scanqr.css');?>">
</head>

<body>
    <div class="container-fluid">
        <div class="display-box">
            <h3 class="text-title-heard">ScanQR Code</h3>
            <div class="img-icon-preview">
                <img class="image_qr_show" id="example" src="<?= base_url('public/assets/img/example.png')?>" alt="example">
            </div>
            <div class="custom-control custom-switch m-2">
                <input type="checkbox" class="custom-control-input" id="Swicth-option-size-img">
                <label class="custom-control-label" for="Swicth-option-size-img">Resize Pictures small</label>
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

    <script src="<?=base_url('public/assets/js/scanqr_code.js')?>"></script>
</body>

</html>
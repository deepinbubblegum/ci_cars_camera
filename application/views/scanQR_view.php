<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>ScanQR Code</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style_scanqr.css'); ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/fontawesome/css/all.css') ?> " rel="stylesheet">
    <script type="text/javascript" src="<?= base_url('public/assets/qrcode/jsQR.js') ?>"></script>

</head>

<body>
    <div class="container-fluid">
        <div class="display-box">
            <nav class="navbar navbar-light bg-light justify-content-between">
                <a class="navbar-brand"><img src="<?= base_url('public/assets/img/example.png') ?>" width="32px"></a>
                <form class="form-inline">
                    <div class="dropdown">
                        <button class="btn btn-info my-2 my-sm-0 dropdown-toggle text-uppercase" type="button" id="user_dropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <i class="fas fa-user-circle mr-2"></i> <?= $this->session->username; ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="user_dropdown">
                            <a class="dropdown-item" href="<?= base_url('signout') ?>"><i class="fas fa-sign-out-alt"></i>SIGN OUT</a>
                        </div>
                    </div>
                </form>
            </nav>
            <h3 class="text-title-heard">ScanQR Code</h3>
            <div class="img-icon-preview">
                <img class="image_qr_show" id="example" src="<?= base_url('public/assets/img/example.png') ?>" alt="example">
            </div>
            <div class="custom-control custom-switch m-2" hidden>
                <input type="checkbox" class="custom-control-input" id="Swicth-option-size-img" checked>
                <label class="custom-control-label" for="Swicth-option-size-img">Resize Pictures to small size</label>
            </div>
            <button class="btn-scan-qr" id="btn_send_scanqr"><i class="fas fa-qrcode mr-2"></i> SCAN</button>
        </div>
        <div class="display-preview-camera">
            <div class="modal-content">
                <div class="close" id="close_model"></div>
                <div class="wrap-qrcode-scanner">
                    <h2>QRCode Scanner</h2>
                    <div id="loadingMessage">🎥 Unable to access video stream (please make sure you have a webcam enabled)</div>
                    <canvas id="canvas" hidden></canvas>
                    <video id="video-preview"></video>
                    <div id="output" hidden>
                        <div id="outputMessage">No QR code detected.</div>
                        <div hidden><b>Data:</b> <span id="outputData"></span></div>
                    </div>
                    <audio id="beepsound" hidden controls>
                        <source src="<?= base_url('public/assets/qrcode/sound/scanner-beeps-barcode.mp3'); ?>" type="audio/mpeg">
                        Your browser does not support the audio tag.
                    </audio>
                    <img id="outputqrcode">
                    <canvas id="canvas2" hidden></canvas>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?= base_url('public/assets/js/scanqr_code.js') ?>"></script>
</body>

</html>
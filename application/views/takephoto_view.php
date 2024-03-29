<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Take a Photo</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/takephoto.css') ?>">
    <link rel="stylesheet" href="<?= base_url('public/assets/fontawesome/css/all.css') ?> " rel="stylesheet">
    <script src="<?= base_url('public/assets/js/takephoto.js') ?>"></script>
</head>

<body>
    <div style="text-align:center">
        <h3>Gallery ID</h3>
        <p class="carid_id"><?= $carid_id ?></p>
        <p class="size_small" hidden><?= $size_small ?></p>
    </div>
    <div class="container-image-preview">
        <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
        <img id="expandedImg" style="width:100%">
        <div id="imgtext"></div>
    </div>
    <div class="container-fluid mb-5">
        <div class="row" id="rowshow_img">

        </div>
    </div>
    <button class="btn btn-block fixed-bottom btn-my-sty" id="btn_take_a_photo">Take a Photo</button>
    <div class="btn-group fixed-bottom" id="btn_group_ag" role="group" aria-label="Basic example">
        <button type="button" id="confirm-btn" class="btn btn-my-sty border">New</button>
        <button type="button" id="add-image-manual" class="btn btn-my-sty border">Takephoto manual</button>
        <button type="button" id="confirm-btn-save" class="btn btn-my-sty border">Next</button>
    </div>
    <input type="file" id="input_image" accept="image/*" capture=camera" style="display: none;">
    <div class="modal" id="confirm-box" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plass confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="Take_again">Take again</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirm-box-save" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plass confirm</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" id="next_page">Next</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="loadingModal" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-dialog-centered justify-content-center" role="document">
            <span class="fa fa-spinner fa-spin fa-3x"></span>
        </div>
    </div>


</body>


</html>
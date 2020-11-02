<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Take a Photo</title>
    <link rel="stylesheet" href="<?= base_url('public/assets/css/takephoto.css') ?>">
    <script src="<?= base_url('public/assets/js/takephoto.js') ?>"></script>
</head>

<body>
    <div style="text-align:center">
        <h3>Gallery</h3>
        <p>ID:</p>
    </div>
    <div class="container-image-preview">
        <span onclick="this.parentElement.style.display='none'" class="closebtn">&times;</span>
        <img id="expandedImg" style="width:100%">
        <div id="imgtext"></div>
    </div>
    <div class="container-fluid mb-5">
        <div class="row">
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_nature.jpg" alt="Nature" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_snow.jpg" alt="Snow" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_mountains.jpg" alt="Mountains" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_lights.jpg" alt="Lights" style="width:100%">
            </div>

            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_nature.jpg" alt="Nature" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_snow.jpg" alt="Snow" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_mountains.jpg" alt="Mountains" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_lights.jpg" alt="Lights" style="width:100%">
            </div>

            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_nature.jpg" alt="Nature" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_snow.jpg" alt="Snow" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_mountains.jpg" alt="Mountains" style="width:100%">
            </div>
            <div class="column image-preview">
                <img class="image_souce" src="https://www.w3schools.com/howto/img_lights.jpg" alt="Lights" style="width:100%">
            </div>
        </div>
    </div>
    <button class="btn btn-block fixed-bottom btn-my-sty" hidden>Take a Photo</button>
    <div class="btn-group fixed-bottom" role="group" aria-label="Basic example">
        <button type="button" id="confirm-btn" class="btn btn-my-sty border">New</button>
        <button type="button" id="confirm-btn-save" class="btn btn-my-sty border">Save</button>
    </div>

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
                    <button type="button" class="btn btn-primary">Take again</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal" id="confirm-box-save" tabindex="-1" role="dialog">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Plass confirm for save Image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

</body>


</html>
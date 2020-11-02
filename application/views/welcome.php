<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="<?= base_url('public/assets/css/style_login.css') ?>">
    <title>SING IN</title>
</head>

<body>

    <div class="container">
        <div class="box-sign_in">
            <!-- <h3 class="tittle-box">SING IN</h3> -->
            <div class="box-image-avata">
                <img src="<?= base_url('public/assets/img/user_avata.png');?>" alt="">
                <h2 class="tittle-box">SING IN</h2>
            </div>
            <form class="form-box" id="sign_in">
                <input class="input-sign-in" type="username" name="username" placeholder="Username" id="username">
                <input class="input-sign-in" type="password" name="password" placeholder="Password" id="password">

                <button class="button-submit" type="submit">LOG IN</button>
                <div class="hr"></div>
            </form>
        </div>
    </div>
    <script src="<?= base_url('public/assets/js/user_sign_in.js');?>"></script>
</body>

</html>
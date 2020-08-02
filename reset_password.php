<?php session_start(); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>أسترجاع كلمة المرور - COPETS</title>
    <link rel="shortcut icon" href="assets/img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body dir="rtl">
    <div class="login-dark" style="background-image: url(assets/img/splash.png);">
        <img class="cat" src="assets/img/cat_splash.png" alt="">
        <form method="post" action="assets/req_files/reset_req.php">
            <h2 class="text-center" style="margin-bottom: 23px;font-family: Tajawal, sans-serif;">أسترجاع كلمة المرور</h2>
            <?php
                if(!isset($_SESSION['res_err'])){}  
                elseif(isset($_SESSION['res_err']))
                { echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['res_err']."</div>";}
                unset($_SESSION['res_err']);
                session_destroy(); ?>
                
            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="text" name="email" placeholder="البريد الالكتروني" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-envelope"></i></span>
                  </div>
            </div>
            <div class="form-group"><button class="btn btn-lg btn-block" name="reset_pwd" type="submit">أسترجاع</button></div>
            <div class="form-group"><small class="form-text text-lowercase text-justify"><i class="fas fa-exclamation-circle" style="color:#fccac9;"></i> سيتم إرسال بريد إلكتروني إليك مع تعليمات حول كيفية إعادة تعيين كلمة المرور الخاصة بك</small></div>
            
            <div class="text-center"><p class="d-inline-block" style="margin-bottom: 0px;width: 143px;font-family: Tajawal, sans-serif;">هل لديك حساب؟&nbsp;</p><a class="d-inline-block" href="login.php" style="color: #FA9592;font-family: Tajawal, sans-serif;">تسجيل دخول</a></div>
            </form>
    </div>
    <script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>

</body>

</html>
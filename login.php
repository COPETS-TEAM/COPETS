<?php session_start();
include('assets/req_files/alogin.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>تسجيل دخول - COPETS</title>
    <link rel="shortcut icon" href="assets/img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfeXqwZAAAAAOMGg387jT1MftPNplGa0miPFFzg"></script>
</head>

<body dir="rtl">
    <div class="login-dark" style="background-image: url(assets/img/splash.png);">
        <img class="cat" src="assets/img/cat_splash.png" alt="">
        <form method="post" action="login.php">
            <h2 class="text-center" style="margin-bottom: 23px;font-family: Tajawal, sans-serif;">تسجيل الدخول</h2>
<?php

if(!isset($_SESSION['err'])){}  
elseif(isset($_SESSION['err']))
{ echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['err']."</div>";}
unset($_SESSION['err']);

    ?>
            <input type="hidden" id="g-token" name="g-token">

            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="text" name="username" placeholder="اسم المستخدم" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-user"></i></span>
                  </div>
            </div>
            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="password" style="background-color: #ffffff;color: #3A3A6D;font-family: Tajawal, sans-serif;" name="password" placeholder="كلمة المرور" minlength="3" required="">
                    <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-key"></i></span>
                  </div>
            </div>

            <a class="text-right forgot" href="reset_password.php" style="color: #ffffff;font-size: 18px;font-family: Tajawal, sans-serif;"><span>هل نسيت كلمة المرور ؟</span></a>
            <div class="form-group"><button class="btn btn-lg btn-block" name="signin" type="submit">دخول</button></div>
            <div class="text-center"><p class="d-inline-block" style="margin-bottom: 0px;width: 143px;font-family: Tajawal, sans-serif;">ليس لديك حساب؟&nbsp;</p><a class="d-inline-block" href="registration.php" style="color: #FA9592;font-family: Tajawal, sans-serif;">انشاء حساب</a></div>

            </form>
    </div>
    <script>
        grecaptcha.ready(function() {
          grecaptcha.execute('6LfeXqwZAAAAAOMGg387jT1MftPNplGa0miPFFzg', {action: 'homepage'}).then(function(token) {
            document.getElementById("g-token").value = token;
          });
        });
  </script>
    <script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>

</body>

</html>
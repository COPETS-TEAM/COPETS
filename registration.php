<?php session_start();
include_once 'config.php';
include('assets/req_files/register.php'); ?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>إنشاء حساب - COPETS</title>
    <link rel="shortcut icon" href="assets/img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="assets/css/register.css">
    <script src="https://www.google.com/recaptcha/api.js?render=6LfeXqwZAAAAAOMGg387jT1MftPNplGa0miPFFzg"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

</head>

<body dir="rtl">
    <div class="login-dark" style="background-image: url(assets/img/splash.png);">
        <img class="cat" src="assets/img/anml.png" alt="">
        <form class="reg_form" method="post">
            <h2 class="text-center" style="margin-bottom: 23px;font-family: Tajawal, sans-serif;">إنشاء حساب</h2>
<?php
        if(!isset($_SESSION['reg_err'])){}  
        elseif(isset($_SESSION['reg_err']))
        { echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['reg_err']."</div>";}
        unset($_SESSION['reg_err']);
        session_destroy();
?>
        <input type="hidden" id="g-token" name="g-token">
            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="text" name="fullname" placeholder="الاسم الكامل" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-id-card"></i></span>
                  </div>
            </div>

            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="text" name="username" placeholder="اسم المستخدم" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-user"></i></span>
                  </div>
            </div>

            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="text" name="email" placeholder="البريد الالكتروني" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-envelope"></i></span>
                  </div>
            </div>

            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="password" style="background-color: #ffffff;color: #3A3A6D;font-family: Tajawal, sans-serif;" name="password" placeholder="كلمة المرور" minlength="3" required="">
                    <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-key"></i></span>
                  </div>
            </div>

            <div class="input-group mb-3">
                <select class="form-control form-control-lg" name="province"><optgroup label="اختر المحافظة:"><option value="أربيل">أربيل</option><option value="الانبار">الانبار</option><option value="بابل">بابل</option><option value="بغداد">بغداد</option><option value="البصرة">البصرة</option><option value="دهوك">دهوك</option><option value="الديوانية">الديوانية</option><option value="ديالى">ديالى</option><option value="ذي قار">ذي قار</option><option value="السليمانية">السليمانية</option><option value="صلاح الدين">صلاح الدين</option><option value="كركوك">كركوك</option><option value="كربلاء">كربلاء</option><option value="المثنى">المثنى</option><option value="ميسان">ميسان</option><option value="النجف">النجف</option><option value="نينوى">نينوى</option><option value="واسط">واسط</option></optgroup></select>
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-map-marker-alt"></i></span>
                  </div>
            </div>

            <div class="form-group"><button class="btn btn-lg btn-block" name="register" type="submit">تسجيل</button></div>
            <div class="text-center"><p class="d-inline-block" style="margin-bottom: 0px;width: 143px;font-family: Tajawal, sans-serif;">هل لديك حساب؟&nbsp;</p><a class="d-inline-block" href="login.php" style="color: #FA9592;font-family: Tajawal, sans-serif;">تسجيل دخول</a></div>
            <div class="text-center" style="margin-top:10px;">
            <div class="form-group"><small class="form-text text-center">إنشاء حساب عن طريق :</small></div>
            <?php echo '<a class="d-inline-block brand" href="'.$google_client->createAuthUrl().'"><i class="fab fa-google fa-2x"></i></a>'; ?>
            <span style="margin: auto 4em;font-family: Tajawal, sans-serif;"> أو </span>
            <a class="d-inline-block brand" href="#"><i class="fab fa-facebook-f fa-2x"></i></a>
            </div>
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
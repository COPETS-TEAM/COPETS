<?php session_start(); 
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>إنشاء كلمة مرور - COPETS</title>
    <link rel="shortcut icon" href="../img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="../css/register.css">
</head>

<body dir="rtl">
    <div class="login-dark" style="background-image: url(../img/splash.png);">
        <img class="cat" src="../img/cat_splash.png" alt="">
        <?php
    if (!isset($_GET['pta'])) {
        if(!isset($_SESSION['err'])){}  
        elseif(isset($_SESSION['err']))
        { echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['err']."</div>";}
        unset($_SESSION['err']);
        session_destroy();

    }
    else
    {
        $pwd_token = $_GET['pta'];
    ?>
        <form method="post" action="new_pwd.php">
            <h2 class="text-center" style="margin-bottom: 23px;font-family: Tajawal, sans-serif;">إنشاء كلمة مرور </h2>
            <?php
            if(!isset($_SESSION['err'])){}  
            elseif(isset($_SESSION['err']))
            { echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['err']."</div>";}
            unset($_SESSION['err']);
            session_destroy();
            ?>

            <div class="input-group mb-3">
            <input type="hidden" name="ptkn" value="<?php echo $pwd_token; ?>">
                <input class="form-control form-control-lg" type="password" name="password" placeholder="كلمة المرور الجديدة" minlength="3" required="">
                <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-lock"></i></span>
                  </div>
            </div>
            <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="password" name="verify_password" placeholder="تأكيد كلمة المرور" minlength="3" required="">
                    <div class="input-group-prepend">
                    <span class="input-group-text iconc" id="basic-addon"><i class="fas fa-key"></i></span>
                  </div>
            </div>

            <div class="form-group"><button class="btn btn-lg btn-block" name="change_pwd" type="submit">تغيير كلمة المرور</button></div>
            </form>
    <?php } ?>
    </div>
    <script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>

</body>

</html>
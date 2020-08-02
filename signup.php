<?php session_start();
require_once 'assets/req_files/connectdb.php';
include_once 'config.php';
if(isset($_GET["code"]))
{
    $urlcode = $_GET["code"];
    $urlscope = $_GET["scope"];
    $urlauthuser = $_GET["authuser"];
    $urlprompt = $_GET["prompt"];

    $token = $google_client->fetchAccessTokenWithAuthCode($_GET["code"]);
    if(!isset($token['error'])){
        $google_client->setAccessToken($token['access_token']);

        $_SESSION['access_token'] = $token['access_token'];

        $google_service = new Google_Service_Oauth2($google_client);
        $data = $google_service->userinfo->get();
        
        if(!empty($data['given_name']))
        {
            $user_name = $data['given_name'];
        }
        if(!empty($data['family_name']))
        {
            $last_name = $data['family_name'];
        }
        if(!empty($data['email']))
        {
            $user_email = $data['email'];
        }
        if(!empty($data['picture']))
        {
            $user_avatar = $data['picture'];
        }
        $email_check_query = "SELECT `email` FROM `users` WHERE email='$user_email'";
        $email_res = mysqli_query($conn, $email_check_query);
        $cmail = mysqli_fetch_assoc($email_res);


        if (isset($cmail['email']) && $cmail['email'] === $user_email) {
            $_SESSION['err'] ="الحساب موجود مسبقا! قم بتسجيل الدخول";
            header('location: login.php');
            exit;
        }

    }
    
}
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>تسجيل حساب - COPETS</title>
    <link rel="shortcut icon" href="assets/img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="assets/css/register.css">
</head>

<body dir="rtl">
    <div class="login-dark" style="background-image: url(assets/img/splash.png);">
        <img class="cat" src="assets/img/cat_splash.png" alt="">
        <form method="post" action="assets/req_files/googlesign.php">
            <h2 class="text-center" style="margin-bottom: 23px;font-family: Tajawal, sans-serif;">إنشاء حساب جديد</h2>
            <?php
                if(!isset($_SESSION['reg_err'])){}  
                elseif(isset($_SESSION['reg_err']))
                { echo '<div class="alert alert-warning text-right" style="font-size: 11px;font-family: Tajawal, sans-serif;" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['reg_err']."</div>";}
                unset($_SESSION['reg_err']);
                ?>
                <input type="hidden" id="email" name="email" value="<?php echo $user_email ?>">
                <input type="hidden" id="last_name" name="last_name" value="<?php echo $user_name.' '.$last_name ?>">
                <input type="hidden" id="user_name" name="user_name" value="<?php echo $user_name ?>">
                <input type="hidden" id="user_pic" name="user_pic" value="<?php echo $user_avatar ?>">

                <input type="hidden" name="urlcode" value="<?php echo $urlcode ?>">
                <input type="hidden" name="urlscope" value="<?php echo $urlscope ?>">
                <input type="hidden" name="urlauthuser" value="<?php echo $urlauthuser ?>">
                <input type="hidden" name="urlprompt" value="<?php echo $urlprompt ?>">
                <div class="input-group mb-3">
                <input class="form-control form-control-lg" type="password" name="password" placeholder="كلمة المرور" minlength="3" required="">
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

            <div class="form-group"><button class="btn btn-lg btn-block" name="reg_google" type="submit">تسجيل</button></div>
            </form>
    </div>
        <!-- jQuery CDN - Slim version (=without AJAX) -->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
    // Run on page load
    window.onload = function() {

        // If sessionStorage is storing default values (ex. name), exit the function and do not restore data
        if (sessionStorage.getItem('email') == "email") {
            return;
        }
            // Before refreshing the page, save the form data to sessionStorage
    window.onbeforeunload = function() {
        sessionStorage.setItem("email", $('#email').val());
        sessionStorage.setItem("last_name", $('#last_name').val());
        sessionStorage.setItem("user_name", $('#user_name').val());
        sessionStorage.setItem("user_pic", $('#user_pic').val());
    }

        // If values are not blank, restore them to the fields
        var email = sessionStorage.getItem('email');
        if (email !== null) $('#email').val(email);

        var last_name = sessionStorage.getItem('last_name');
        if (last_name !== null) $('#last_name').val(last_name);

        var user_name= sessionStorage.getItem('user_name');
        if (user_name!== null) $('#user_name').val(user_name);

        var user_pic= sessionStorage.getItem('user_pic');
        if (user_pic!== null) $('#user_pic').val(user_pic);
    }



    </script>
    <script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>

</body>

</html>

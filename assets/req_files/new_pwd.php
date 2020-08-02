<?php session_start();
      require_once 'connectdb.php';
      
      if (isset($_POST['change_pwd'])) {
        $password = mysqli_real_escape_string($conn, $_POST['password']);
        $ptkn = mysqli_real_escape_string($conn, $_POST['ptkn']);
        $verify_password = mysqli_real_escape_string($conn, $_POST['verify_password']);

        $user_check_query = "SELECT `pwd_token`,`pwd_expire` FROM `users` WHERE pwd_token='$ptkn'";
        $result = mysqli_query($conn, $user_check_query);
        $user = mysqli_fetch_assoc($result);
        $expir = date("U");
        $errors = 0;
    
        if (!$user) {
                $errors = $errors + 1;
                $_SESSION['err'] = "لا يمكنك تلبية طلبك";
            }else{
        if ( $password != $verify_password) {
                $errors = $errors + 1;
                $_SESSION['err'] = "كلمتي المرور غير متطابقتين";
            }else{
                if ( $expir > $user['pwd_expire']) {
                    $errors = $errors + 1;
                    $_SESSION['err'] = "انتهت صلاحية الطلب رجاء انشاء طلب جديد";
                }
            }}

        if ($errors == 0) {
            $password_hashed = password_hash($password,PASSWORD_DEFAULT);
            $query = "UPDATE `users` SET `password`='$password_hashed',`pwd_token`=0,`pwd_expire`=0 WHERE pwd_token='$ptkn' AND pwd_expire >= $expir";
            mysqli_query($conn, $query);

            $_SESSION['err'] = "تم تغيير كلمة المرور يمكنك تسجيل الدخول";
            header('location: ../../login.php');
        }else
        {
            header('location: create_new_password.php?pta='.$ptkn.'');
        }


      }
      ?>
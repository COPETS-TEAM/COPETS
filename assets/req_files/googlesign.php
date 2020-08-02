<?php session_start();
require_once 'connectdb.php';
            if (isset($_POST['reg_google'])) {
            $urlcode = mysqli_real_escape_string($conn, $_POST['urlcode']);
            $urlscope = mysqli_real_escape_string($conn, $_POST['urlscope']);
            $urlauthuser = mysqli_real_escape_string($conn, $_POST['urlauthuser']);
            $urlprompt = mysqli_real_escape_string($conn, $_POST['urlprompt']);

            $umail = mysqli_real_escape_string($conn, $_POST['email']);
            $ulname = mysqli_real_escape_string($conn, $_POST['last_name']);
            $username = mysqli_real_escape_string($conn, $_POST['user_name']);
            $user_picture = mysqli_real_escape_string($conn, $_POST['user_pic']);
            $password = mysqli_real_escape_string($conn, $_POST['password']);
            $verify_password = mysqli_real_escape_string($conn, $_POST['verify_password']);

                if ( $password != $verify_password) {
                    $_SESSION['reg_err'] = "كلمتي المرور غير متطابقتين";
                    header('location: ../../signup.php?code='.$urlcode.'&scope='.$urlscope.'&authuser='.$urlauthuser.'&prompt='.$urlprompt.'');
                }elseif (strlen($password)< 6) {
                        $_SESSION['reg_err'] ="يجب انت تكون كلمة المرور اكثر من 6 احرف";
                        header('location: ../../signup.php?code='.$urlcode.'&scope='.$urlscope.'&authuser='.$urlauthuser.'&prompt='.$urlprompt.'');
                }else {
            $user_id = $username.date("U");
            $password_hashed = password_hash($password,PASSWORD_DEFAULT);
            $query = "INSERT INTO users (username,fl_name,user_pic,email,password,verified) 
            VALUES('$user_id','$ulname','$user_picture','$umail','$password_hashed',1)";
            mysqli_query($conn, $query);
            $_SESSION['err'] = "تم انشاء الحساب. قم بتسجيل الدخول";
            header('location: ../../login.php');
            }

        }
?>
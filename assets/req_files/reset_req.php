<?php session_start();
      require_once 'connectdb.php';
      require_once 'mail/PHPMailerAutoload.php';

if (isset($_POST['reset_pwd'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    $user_check_query = "SELECT `email` FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn, $user_check_query);
    $user = mysqli_fetch_assoc($result);
    $errors = 0;

    if (!$user) {
            $errors = $errors + 1;
        }
    
    if ($errors == 0) {
        $vkey = random_bytes(32);
        $v_alpha = bin2hex($vkey);
        $expiration = date("U") + 1800;
        $query = "UPDATE `users` SET `pwd_token`='$v_alpha',`pwd_expire`='$expiration' WHERE `email`='$email'";
        mysqli_query($conn, $query);
         //Send email
        $mail = new PHPMailer;
        $mail->Host='smtp.gmail.com';
        $mail->Port=587;
        $mail->isSMTP();
        $mail->SMTPAuth=true;
        $mail->SMTPSecure='tls';
        $mail->Username='copets.c4i@gmail.com';
        $mail->Password='zico1997.7991';
        $mail->setFrom('copets.c4i@gmail.com','COPETS-TEAM');
        $mail->addAddress($email);
        $mail->addReplyTo('copets.c4i@gmail.com');
        $mail->isHTML(true);
        $mail->Subject='Password Reset Request';
        $mail->Body='<div style="text-align: right;">
        <h3>طلب أعادة تعيين كلمة المرور</h3>
        <p style"color:#000;">لقد تلقينا طلبًا لإعادة تعيين كلمة المرور الخاصة بك.<br>
         إذا لم تقم بهذا الطلب فقط تجاهل هذا البريد الإلكتروني<br>
          وإلا يمكنك إعادة تعيين كلمة المرور الخاصة بك باستخدام الرابط ادناه:<br></p>
        <a style="background-color: #fccac9; color: #3a3a6d; text-decoration: none; padding: 5px 10px;border-radius: 15px;" href="http://localhost/pets/assets/req_files/create_new_password.php?pta='.$v_alpha.'">تغيير كلمة المرور</a>
        <p><br><b style="font-size: 16px;">علما ان صلاحية هذا الرابط هي ساعة واحده فقط</b>
        <br>مع تحياتنا COPETS TEAM</p>
        </div>';

        if(!$mail->send())
        {
        echo "Something went wrong";
        echo $mail->ErrorInfo;
        }
        else
        {
          header('location: ../../login.php');
          $_SESSION['err'] = "تم ارسال طلب استرجاع كلمة المرور الى بريدك الالكتروني";
        }


    } else {
        $_SESSION['res_err'] ="هذا البريد الالكتروني لا ينتمي لأي حساب";
        header('location: ../../reset_password.php');
        exit;
    }

}
?>
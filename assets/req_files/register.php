<?php require_once 'connectdb.php';
      require_once 'mail/PHPMailerAutoload.php';

// REGISTER USER
if (isset($_POST['register'])) {
  $secretKey 	= '6LfeXqwZAAAAAHZtxZypfWikQ6cbeLhdf3EFWi5n';
	$token 		= $_POST["g-token"];
	$ip			= $_SERVER['REMOTE_ADDR'];
	
	$url = "https://www.google.com/recaptcha/api/siteverify";
	$data = array('secret' => $secretKey, 'response' => $token, 'remoteip'=> $ip);
 
	$options = array('http' => array(
		'method'  => 'POST',
		'content' => http_build_query($data)
	));
	$context  = stream_context_create($options);
	$result = file_get_contents($url, false, $context);
  $response = json_decode($result);
  if ($response->false) {
    $_SESSION['reg_err'] ="خطأ في توثيق الهوية";
    header('location: registration.php');
    exit;
}
  $full_name = mysqli_real_escape_string($conn, $_POST['fullname']);
  $username = mysqli_real_escape_string($conn, $_POST['username']);
  $email = mysqli_real_escape_string($conn, $_POST['email']);
  $password = mysqli_real_escape_string($conn, $_POST['password']);
  $province = mysqli_real_escape_string($conn, $_POST['province']);

  $user_check_query = "SELECT `username` FROM `users` WHERE username='$username'";
  $user_res = mysqli_query($conn, $user_check_query);
  $user = mysqli_fetch_assoc($user_res);
  $email_check_query = "SELECT `email` FROM `users` WHERE email='$email'";
  $email_res = mysqli_query($conn, $email_check_query);
  $cmail = mysqli_fetch_assoc($email_res);

  $errors = 0;

  if (($user || $cmail)||($user && $cmail)) {
    if ((isset($user['username']) && $user['username'] === $username) && (isset($cmail['email']) && $cmail['email'] === $email)) {
        $_SESSION['reg_err'] ="البريد الالكتروني واسم المستخدم موجود مسبقا";
        $errors = $errors + 1;
    }
    elseif (isset($cmail['email']) && $cmail['email'] === $email) {
        $_SESSION['reg_err'] ="البريد الالكتروني موجود مسبقا";
        $errors = $errors + 1;
    }
    elseif (isset($user['username']) && $user['username'] === $username) {
        $_SESSION['reg_err'] ="اسم المستخدم موجود مسبقا";
        $errors = $errors + 1;
    }
  }
  if (strlen($password)< 6) {
    $_SESSION['reg_err'] ="يجب انت تكون كلمة المرور اكبر من 6 احرف";
    $errors = $errors + 1;
    }

  if ($errors == 0) {
    $vkey = 'qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!$%*';
    $vkey = str_shuffle($vkey);
    $vkey = substr($vkey,0,15);
  	$password_hashed = password_hash($password,PASSWORD_DEFAULT);
  	$query = "INSERT INTO users (username,fl_name,email,password,province,vkey) 
  			  VALUES('$username','$full_name','$email','$password_hashed', '$province','$vkey')";
  	mysqli_query($conn, $query);
      $_SESSION['username'] = $username;
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
        $mail->Subject='Email Vertification';
        $mail->Body="<div class='text-right'>
        <h3>Welcome to COPETS</h3>
        <p>مرحبا بموقع COPETS نتمنى لك قضاء اوقات ممتعة معنا!
        <br>
        لتأكيد حسابك اضغط على الرابط ادناه
        <br>
        <a href='http://localhost/pets/assets/req_files/verify.php?key=$vkey'>تأكيد الحساب</a>
        <br>
        مع تحياتنا COPETS TEAM
        </p>
        </div>";

        if(!$mail->send())
        {
        echo "Something went wrong";
        echo $mail->ErrorInfo;
        }
        else
        {
          header('location: thankyou.php');
        }
  }
  if(isset($conn))
{
    mysqli_close($conn);
}
}
?>
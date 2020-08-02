<?php
require_once 'connectdb.php';
$errors = array(); 

// LOGIN INTO AN ACCOUNT //

if (isset($_POST['signin'])) {
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
    $_SESSION['err'] ="خطأ في توثيق الهوية";
    header('location: login.php');
    exit;
}
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
  
    if (count($errors) == 0) {
      $query = "SELECT username, fl_name, user_type, email, password,verified FROM users WHERE (username='$username' OR email='$username')";
      $results = mysqli_query($conn, $query);
      $pwd_check = mysqli_fetch_array($results);
      if ($pwd_check['verified'] == 1) {
      $isCorrect=password_verify($password,$pwd_check['password']);
      if($isCorrect){
        if ($pwd_check['user_type']== 'ادمن'||$pwd_check['user_type']== 'متطوع') {
          $_SESSION['id_admin'] = $pwd_check['username'];
          header('location: control_center.php');
          exit;
          } else{
          $_SESSION['id_user'] = $pwd_check['username'];
          header('location: index.php');
          exit;
          }
        }
      else {
          $_SESSION['err'] = "خطأ في اسم المستخدم/الايميل او كلمة المرور!";
        }
      } else {
        $_SESSION['err'] = "قم بتأكيد حسابك لتتمكن من الدخول";
    } 
  }
}

?>

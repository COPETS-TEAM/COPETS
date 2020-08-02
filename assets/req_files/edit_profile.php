<?php session_start();
require_once 'connectdb.php';
$profile = $_SESSION['id_user'];
$date_name = date("Ymdhis");
if(isset($_POST['update_profile'])){

        if(isset($_FILES['avatar-file']) && $_FILES['avatar-file']['name'] != ""){
            $ext = pathinfo($_FILES['avatar-file']['name'], PATHINFO_EXTENSION);
            $fileName = 'assets/img/profile_pic/'.$profile .'.'. $ext ;
            $fileadd =  $profile .'.'. $ext ;
            $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
            $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../img/profile_pic/";
            $uploadDirectory .= $fileadd;
            $imgquery= "UPDATE `users` SET user_pic='$fileName' WHERE username = '$profile' ";
            $imgresult = mysqli_query($conn, $imgquery);
            move_uploaded_file($_FILES['avatar-file']['tmp_name'], $uploadDirectory);
        }

            $username = trim($_POST['user_id']);
            $username = mysqli_real_escape_string($conn, $username);

            $fullname = trim($_POST['fullname']);
            $fullname = mysqli_real_escape_string($conn, $fullname);

            $email = trim($_POST['email']);
            $email = mysqli_real_escape_string($conn, $email);
            
            $phone_no = trim($_POST['phone_no']);
            $phone_no = mysqli_real_escape_string($conn, $phone_no);
            
            $province = trim($_POST['province']);
            $province = mysqli_real_escape_string($conn, $province);

            $address = trim($_POST['address']);
            $address = mysqli_real_escape_string($conn, $address);


            $user_check_query = "SELECT username, email FROM users WHERE username='$username'";
            $email_check_query = "SELECT email FROM users WHERE email='$email'";
            $u_res = mysqli_query($conn, $user_check_query);
            $e_res = mysqli_query($conn, $email_check_query);
            $user = mysqli_fetch_assoc($u_res);
            $cmail = mysqli_fetch_assoc($e_res);

if ($user['username'] === $username && $cmail['email'] === $email) {
        $query ="UPDATE `users` SET `fl_name`='$fullname',
         `phone_no`='$phone_no',`province`='$province',
         `address`='$address' WHERE `username`='$profile' ";    
         
        }
elseif ($user['username'] === $username) {
        $query ="UPDATE `users` SET `fl_name`='$fullname',
        `email`='$email', `phone_no`='$phone_no',`province`='$province',
         `address`='$address' WHERE `username`='$profile' ";    
        }
elseif ($cmail['email'] === $email) {
        $query ="UPDATE `users` SET `username`='$username', `fl_name`='$fullname',
         `phone_no`='$phone_no',`province`='$province',
         `address`='$address' WHERE `username`='$profile' ";
        $_SESSION['id_user'] = $username;
        }
else {         
        $query ="UPDATE `users` SET `username`='$username', `fl_name`='$fullname',
         `email`='$email', `phone_no`='$phone_no',`province`='$province',
         `address`='$address' WHERE `username`='$profile' ";
        $_SESSION['id_user'] = $username;
}

            $result = mysqli_query($conn, $query);
		if(!$result){
			exit;
		} else {
            $_SESSION['edit']     = "تم تحديث معلومات الحساب";  
			header("Location: ../../profile.php");
                
        }
    } ?>
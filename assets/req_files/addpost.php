<?php session_start();
require_once 'connectdb.php';
if (isset($_POST['subPost'])) {

    $petName = mysqli_real_escape_string($conn, $_POST['petName']);
    $Details = mysqli_real_escape_string($conn, $_POST['Details']);
    $user_name = $_SESSION['id_admin'];


    if(isset($_FILES['avatar-file']) && $_FILES['avatar-file']['name'] != ""){
        $ext = pathinfo($_FILES['avatar-file']['name'], PATHINFO_EXTENSION);
        $date_name = date("Ymdhis");
        $fileName =  $date_name .'.'. $ext ;
        $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
        $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../img/post_img/";
        $uploadDirectory .= $fileName;
        move_uploaded_file($_FILES['avatar-file']['tmp_name'], $uploadDirectory);
    }
    $postquery= "INSERT INTO `posts`(`post_title`, `post_desc`, `post_img`, `user_name`) VALUES ('$petName','$Details','$fileName','$user_name')";
    $postresult = mysqli_query($conn, $postquery);
    header('location: ../../control_center.php');
    exit;
}
?>
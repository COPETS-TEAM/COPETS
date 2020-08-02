<?php session_start();
require_once 'connectdb.php';
if (isset($_POST['subfyi'])) {

$Details = mysqli_real_escape_string($conn, $_POST['Details']);
$user_name = $_SESSION['id_admin'];


if(isset($_FILES['fyi-file']) && $_FILES['fyi-file']['name'] != ""){
    $ext = pathinfo($_FILES['fyi-file']['name'], PATHINFO_EXTENSION);
    $date_name = date("Ymdhis");
    $fileName =  $date_name .'.'. $ext ;
    $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
    $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../img/fyi_img/";
    $uploadDirectory .= $fileName;
    move_uploaded_file($_FILES['fyi-file']['tmp_name'], $uploadDirectory);
}
$fyiquery= "INSERT INTO `fyi`(`user_name`,`post_desc`, `post_img`) VALUES ('$user_name','$Details','$fileName')";
$fyiresult = mysqli_query($conn, $fyiquery);
header('location: ../../control_center.php');
exit;
}
?>
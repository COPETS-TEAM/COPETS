<?php
session_start();
include('connectdb.php');

    $pst_id = $_GET['pst'];
    $query = "SELECT post_ID,archive FROM posts WHERE post_ID='$pst_id'";



	$pst_res = mysqli_query($conn, $query);
	if(!$pst_res){
	  echo mysqli_error($conn);
	  exit;
    }
    $raw=mysqli_fetch_assoc($pst_res);
  	if(!$raw){
	  echo "المنشور غير متوفر";
	  exit;
    }


    $querydel = "UPDATE `posts` SET `archive`='مؤرشف' WHERE post_ID='$pst_id'";

	$result = mysqli_query($conn, $querydel);
	if(!$result){
		echo "خطأ في ارشفة المنشور " . mysqli_error($conn);
		exit;
    }
       
        $_SESSION['posts'] = "تم ارشفة المنشور";
		header("Location: ../../control_center.php");

?>
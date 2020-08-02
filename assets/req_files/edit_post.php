<?php session_start();
include('connectdb.php');

if(isset($_POST['chngPost'])){

            $pstid = trim($_POST['pstid']);
            $pstid = mysqli_real_escape_string($conn, $pstid);

            $petname = trim($_POST['Namechng']);
            $petname = mysqli_real_escape_string($conn, $petname);

            $Details = trim($_POST['Detachng']);
            $Details = mysqli_real_escape_string($conn, $Details);
            
            if(isset($_FILES['avatar-edit']) && $_FILES['avatar-edit']['name'] != ""){
                $ext = pathinfo($_FILES['avatar-edit']['name'], PATHINFO_EXTENSION);
                $date_name = date("Ymdhis");
                $fileName =  $date_name .'.'. $ext ;
                $directory_self = str_replace(basename($_SERVER['PHP_SELF']), '', $_SERVER['PHP_SELF']);
                $uploadDirectory = $_SERVER['DOCUMENT_ROOT'] . $directory_self . "../img/post_img/";
                $uploadDirectory .= $fileName;
                move_uploaded_file($_FILES['avatar-edit']['tmp_name'], $uploadDirectory);
            }

            $query ="UPDATE `posts` SET  `post_title`='$petname', `post_desc`= '$Details' WHERE `post_ID`='$pstid' ";
            $result = mysqli_query($conn, $query);

            if(isset($fileName)){
                $imgquery= "UPDATE `posts` SET post_img='$fileName' WHERE post_ID = '$pstid' ";
                $imgresult = mysqli_query($conn, $imgquery);

            }
		if(!$result){
			echo "Can't update data " . mysqli_error($conn);
			exit;
		} else {
            $_SESSION['posts'] =  "تم تعديل المنشور";
            header("Location: ../../control_center.php");
        }
    }
    ?>
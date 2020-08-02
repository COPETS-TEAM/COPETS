<?php require_once 'connectdb.php';

if(isset($_POST['change_priv'])){
    
    $account_type = trim($_POST['acnt_type']);
    $account_type = mysqli_real_escape_string($conn, $account_type);

    $username = trim($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $query ="UPDATE `users` SET `user_type`='$account_type' WHERE username ='$username'";

    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't update data " . mysqli_error($conn);
        exit;
    } else {
        header("Location: ../../control_center.php");
            exit;
    }

}
if(isset($_POST['un_arch'])){
    
    $change_priv = "غير مؤرشف";

    $post_ID = trim($_POST['post_ID']);
    $post_ID = mysqli_real_escape_string($conn, $post_ID);

    $username = trim($_POST['username']);
    $username = mysqli_real_escape_string($conn, $username);

    $query ="UPDATE `posts` SET `archive`='$change_priv' WHERE user_name ='$username' AND post_ID = '$post_ID'";

    $result = mysqli_query($conn, $query);
    if(!$result){
        echo "Can't update data " . mysqli_error($conn);
        exit;
    } else {
        header("Location: ../../control_center.php");
            exit;
    }

}
?>
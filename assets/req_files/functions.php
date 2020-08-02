<?php session_start();
require_once 'connectdb.php';

function selectLatesPosts($conn){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_desc, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic , users.fb_account, users.tel_account FROM posts, users WHERE posts.user_name = users.username AND posts.archive ='غير مؤرشف' ORDER BY posts.post_date DESC LIMIT 6";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}


function selectMorePosts($conn,$postNewCount){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_desc, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic , users.fb_account, users.tel_account FROM posts, users WHERE posts.user_name = users.username AND posts.archive ='غير مؤرشف' ORDER BY posts.post_date DESC LIMIT $postNewCount";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}
function selectEditPosts($conn,$username){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_desc, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, user_pic FROM posts, users WHERE (posts.user_name = users.username AND posts.user_name = '$username' ) AND posts.archive ='غير مؤرشف' ORDER BY posts.post_date DESC";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}


function selectLatesFYIs($conn){
    $row = array();
    $query = "SELECT fyi.post_ID, fyi.user_name, fyi.post_desc, fyi.post_img, date_format(fyi.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic FROM fyi, users WHERE fyi.user_name = users.username ORDER BY fyi.post_date DESC LIMIT 6";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}

function selectMoreFYIs($conn,$postNewCount){
    $row = array();
    $query = "SELECT fyi.post_ID, fyi.user_name, fyi.post_desc, fyi.post_img, date_format(fyi.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic FROM fyi, users WHERE fyi.user_name = users.username ORDER BY fyi.post_date DESC LIMIT $postNewCount";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}
function selectEditFYIs($conn,$username){
    $row = array();
    $query = "SELECT fyi.post_ID, fyi.post_img, fyi.post_desc, date_format(fyi.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, user_pic FROM fyi, users WHERE (fyi.user_name = users.username AND fyi.user_name = '$username' ) ORDER BY fyi.post_date DESC";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}

function selectLatestArchived($conn){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_desc, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic FROM posts, users WHERE posts.user_name = users.username AND posts.archive ='مؤرشف' ORDER BY posts.post_date DESC LIMIT 6";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}

function selectMoreArchived($conn,$postNewCount){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_desc, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, users.fl_name, users.user_pic FROM posts, users WHERE posts.user_name = users.username AND posts.archive ='مؤرشف' ORDER BY posts.post_date DESC LIMIT $postNewCount";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}
function selectArchivedList($conn,$username){
    $row = array();
    $query = "SELECT posts.post_ID, posts.post_title, posts.post_img, date_format(posts.post_date,'%Y/%m/%d, %h:%i%p') as post_date, posts.archive, users.username FROM posts, users WHERE (posts.user_name = users.username AND posts.user_name='$username' ) AND posts.archive ='مؤرشف' ORDER BY posts.post_date DESC";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if(!$result){
        echo "Can't retrieve data " . mysqli_error($conn);
        exit;
    }
    for($i = 0; $i < $row_cnt; $i++){
        array_push($row, mysqli_fetch_assoc($result));
    }
    return $row;
}

function selectProfileInfo($conn,$profile){

$query = "SELECT `username`, `fl_name`, `user_pic`, `email`, `phone_no`,`fb_account`, `tel_account`, `province`, `address` FROM `users` WHERE  username = '".$profile."' ";
$result = mysqli_query($conn, $query);
if(!$result){ exit; }
$row = mysqli_fetch_assoc($result);
if(!$row){
  echo "قم بتسجيل دخول لعرض هذه الصفحة";
  echo '<a href="login.php">تسجيل الدخول</a>';
  exit;
}
return $row;
}

function checkPriv($conn,$profile){

$query = "SELECT `user_type` FROM `users` WHERE  username = '".$profile."' ";
$result = mysqli_query($conn, $query);
if(!$result){ exit; }
$row = mysqli_fetch_assoc($result);
if(!$row){
  exit;
}
return $row;
}

function selectAccountsInfo($conn){
$row = array();
$query = "SELECT `username`, `fl_name`, `user_type`, `email` FROM `users` ORDER BY FIELD(user_type,'ادمن','متطوع','مستخدم') limit 10";
$result = mysqli_query($conn, $query);
$row_cnt = mysqli_num_rows($result);

if(!$result){
    echo "Can't retrieve data " . mysqli_error($conn);
    exit;
}
for($i = 0; $i < $row_cnt; $i++){
    array_push($row, mysqli_fetch_assoc($result));
}
return $row;
}
?>
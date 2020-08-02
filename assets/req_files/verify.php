<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="refresh" content="3;url=../../login.php">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>تأكيد الحساب - COPETS</title>
    <link rel="shortcut icon" href="../img/cop_logo.png">
</head>
<body>
<?php
require_once 'connectdb.php';
if (isset($_GET['key'])) {
    $key = $_GET['key'];
    $query = "SELECT `vkey`, `verified` FROM users WHERE verified = 0 AND vkey='" . $key . "'";
    $result = mysqli_query($conn, $query);
    $row_cnt = mysqli_num_rows($result);

    if ($row_cnt == 1) {
      $verfy_query = "UPDATE `users` SET `verified`=1 WHERE `vkey`='" . $key . "'";
      $verfy_res = mysqli_query($conn, $verfy_query);
      if ($verfy_res) {
          echo "تم تأكيد حسابك بنجاح... الرجاء تسجيل الدخول للوصول لحسابك";
      } else {
          echo "الرابط غير صحيح!";
      }
    }
    else {
        echo "انتهت صلاحية الرابط او الحساب غير موجود !";
    }
}
?>
    
</body>
</html>
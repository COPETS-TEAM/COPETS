
<?php

define("HOSTNAME","localhost");
define("HOST_USER","zayn");
define("HOST_PASS","zayn");
define("DB_NAME","copets");

$conn= mysqli_connect(HOSTNAME,HOST_USER,HOST_PASS,DB_NAME);

if(!$conn)
{
    die("Connection failed!".mysqli_connect_error()." Error No:".mysqli_connect_errno());
}
mysqli_set_charset($conn,'utf8');
mysqli_set_charset($conn,"utf8");
?>
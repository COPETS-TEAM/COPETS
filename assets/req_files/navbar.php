<?php
    if(!isset($_SESSION['id_user'])){
        header("location:login.php");
        die();
        }
        $user_check = $_SESSION['id_user'];

        $ses_sql = mysqli_query($conn,"SELECT user_pic FROM users WHERE (username = '$user_check' OR email =  '$user_check')");

        $row2 = mysqli_fetch_array($ses_sql);

        $user_avatar = $row2['user_pic']; 

        include "splash.html";
?>

<link rel="stylesheet" href="assets/css/footer.css">


<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/js/bootstrap.bundle.min.js"></script>

<nav class="navbar navbar-light navbar-expand-md text-center sticky-top shadow-sm">
    <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navcol-1">
            <div class="dropdown"><a class="dropdown-toggle d-flex justify-content-center justify-content-lg-end align-items-center align-items-lg-end main-dd" data-toggle="dropdown" aria-expanded="false" href="#" style="color: #3a3a6d;text-decoration:none;"><div style="width:50px;height: 50px;"><img class="img-fluid" style="border-radius: 25px;" src="<?php echo $user_avatar;?>"></div>&nbsp;</a>
                    <div
                        class="dropdown-menu dropdown-menu-right text-right border-light shadow-sm dd-menu" role="menu">
                        <a class="dropdown-item text-right drb-dwn" role="presentation" href="profile.php">الصفحة الشخصية</a>
                        <a class="dropdown-item text-right drb-dwn" role="presentation" href="assets/req_files/logout.php">تسجيل خروج</a>
                    </div>
            </div>
            <ul class="nav navbar-nav mx-auto">
                <?php if(isset($title) && $title == "home") { ?>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center active" href="index.php">الصفحة الرئيسية</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="informations.php" >هل تعلم</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="archive.php" >الارشيف</a></li><?php } ?>


                <?php if(isset($title) && $title == "info") { ?>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="index.php" >الصفحة الرئيسية</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center active" href="informations.php">هل تعلم</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="archive.php" >الارشيف</a></li><?php } ?>

                <?php if(isset($title) && $title == "archive") { ?>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="index.php" >الصفحة الرئيسية</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="informations.php" >هل تعلم</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center active" href="archive.php">الارشيف</a></li><?php } ?>

                <?php if(!isset($title)) { ?>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="index.php" >الصفحة الرئيسية</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="informations.php" >هل تعلم</a></li>
                <li class="nav-item text-center" role="presentation"><a class="nav-link text-center disact" href="archive.php" >الارشيف</a></li><?php } ?>
            </ul>

    </div>
    <a class="navbar-brand" href="#"><img src="assets/img/cop_logo.png" width="60px"></a><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
    </div>
</nav>
<script>
    $(window).on("load", function(){
    $(".wrapper").fadeOut("slow");
    });
</script>
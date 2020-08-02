<?php
require_once 'assets/req_files/functions.php';
$row = selectProfileInfo($conn,$_SESSION['id_user']);?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title> حساب <?php echo $row['fl_name'];?> - COPETS</title>
    <link rel="shortcut icon" href="assets/img/cop_logo.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/profile.css">
</head>

<body dir="rtl">
<?php require_once "assets/req_files/navbar.php";?>

        <?php
        if (isset($_SESSION['edit'])) {
        echo '<div class="alert alert-prof alert-success position-absolute text-right" style="font-family: Tajawal, sans-serif;" role="alert">';
        echo '<i class="fas fa-user-check"></i> '.$_SESSION['edit']."</div>";
        unset ($_SESSION['edit']);}
        ?>

    <div class="container profile profile-view" id="profile">
        <form method="post" action="assets/req_files/edit_profile.php" enctype="multipart/form-data">
            <div class="form-row profile-row">
                <div class="col-md-3 text-center relative">
                    <div class="avatar"><img id="updateProf" src="<?php echo $row['user_pic'];?>" width="100px" height="100px"></div>
                    <div class="upload-btn-wrapper">
                        <label class="change" for="imgfile">تغيير الصورة</label>
                        <input type="file" id="imgfile" class="form-control" name="avatar-file" onchange="readURL(this);" accept="image/*">
                    </div>
                    <input class="userid" type="text" value="<?php echo $row['username'];?>" name="user_id">
                    <input class="userid" type="text" value="<?php echo $row['fl_name'];?>" name="fullname">
                </div>

                <div class="col-md-9">
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>البريد الالكتروني</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="text" name="email" inputmode="email" value="<?php echo $row['email'];?>" required=""></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>رقم الموبايل</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="tel" name="phone_no" inputmode="tel" value="0<?php echo $row['phone_no'];?>" pattern="[07]{2}[4,5,6,7,8]{1}[0-9]{8}" placeholder="0780xxxxxxx"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>المحافظة</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group text-right"><select class="form-control user_ip" name="province" ><optgroup label="اختر المحافظة:"><option value="<?php echo $row['province'];?>"><?php echo $row['province'];?></option><option value="أربيل">أربيل</option><option value="الانبار">الانبار</option><option value="بابل">بابل</option><option value="بغداد">بغداد</option><option value="البصرة">البصرة</option><option value="دهوك">دهوك</option><option value="الديوانية">الديوانية</option><option value="ديالى">ديالى</option><option value="ذي قار">ذي قار</option><option value="السليمانية">السليمانية</option><option value="صلاح الدين">صلاح الدين</option><option value="كركوك">كركوك</option><option value="كربلاء">كربلاء</option><option value="المثنى">المثنى</option><option value="ميسان">ميسان</option><option value="النجف">النجف</option><option value="نينوى">نينوى</option><option value="واسط">واسط</option></optgroup></select></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>العنوان</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="text" value="<?php echo $row['address'];?>" name="address"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-lg form-btn sub_btn" type="submit" name="update_profile">تعديل  <i class="fas fa-pen"></i></button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <?php require_once "assets/req_files/footer.html";?>

<script>
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#updateProf')
                .attr('src', e.target.result);
        };

        reader.readAsDataURL(input.files[0]);
    }
}
</script>
</body>
<script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>
</html>
<?php
    require_once 'assets/req_files/connectdb.php';
    require_once 'assets/req_files/functions.php';

    if(!isset($_SESSION['id_admin'])){
        header("location:login.php");
        die();
        }
        $user_check = $_SESSION['id_admin'];

        $ses_sql = mysqli_query($conn,"SELECT user_pic FROM users WHERE (username = '$user_check' OR email =  '$user_check') AND (user_type='ادمن' OR user_type='متطوع') ");

        if (!$ses_sql) {
            header("location:login.php");
            die();
        }

        $row2 = mysqli_fetch_array($ses_sql);

        $user_avatar = $row2['user_pic']; 
?>
<!DOCTYPE html>
<html lang="ar" dir="ltr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>أدارة الموقع - COPETS</title>
    <link rel="shortcut icon" href="assets/img/yaqdha_logo.png" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Tajawal:400,500,700">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
  <!-- Font Awesome JS -->
  <script src="https://kit.fontawesome.com/323f58b68e.js" crossorigin="anonymous"></script>
  <!-- Page CSS -->
  <link rel="stylesheet" href="assets/css/control.css">
  <link rel="stylesheet" href="assets/css/profile.css">

</head>


<body dir="rtl">
    <nav class="navbar navigation-clean main_nav">
        <div class="container">
            <img class="navbar-pic" src="<?php echo  $user_avatar;?>" alt="">
            <img class="navbar-brand" src="assets/img/copet_name.png" alt="">
            <h4 class="dash_name">Dashboard</h4></div>
    </nav>
    <div class="wrapper">
        <!-- Sidebar  -->
        <nav id="sidebar">
            <div class="sidebar-header">
                <h3><img src="assets/img/cop_nt.png" style="width: 40%;" alt=""></h3>
                
                <strong><img src="assets/img/cop_nt.png" style="width: 90%;" alt=""></strong>
            </div>

            <ul class="list-unstyled components">
                <!-- الصفحة الرئيسية -->
                <li>
                    <a href="#mainpage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-right active">
                        <i class="fas fa-home fa-2x"></i> <span>الصفحة الرئيسية</span>
                    </a>
                    <ul class="collapse nav" role="tablist" id="mainpage">
                        <li role="presentation">
                            <a href="#addpost" class="tabs3" aria-controls="1" role="tab" data-toggle="tab" ><i class="fas fa-plus"></i> <span>اضافة منشور</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#editpost" class="tabs3" aria-controls="2" role="tab" data-toggle="tab"><i class="fas fa-edit"></i> <span>تعديل منشور </span></a>
                        </li>
                        <li role="presentation">
                            <a href="#archive" class="tabs3" aria-controls="3" role="tab" data-toggle="tab"><i class="fas fa-folder-open"></i> <span> الارشيف</span></a>
                        </li>
                    </ul>
                </li>
                <!-- هل تعلم -->
                <li>
                    <a href="#fyipage" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-right">
                        <i class="fas fa-question-circle fa-2x"></i> <span>هل تعلم</span>
                    </a>
                    <ul class="collapse nav" role="tablist" id="fyipage">
                        <li role="presentation">
                            <a href="#addfyi" aria-controls="1" role="tab" data-toggle="tab"><i class="fas fa-plus"></i> <span>اضافة معلومة</span></a>
                        </li>
                        <li role="presentation">
                            <a href="#editfyi" aria-controls="2" role="tab" data-toggle="tab"><i class="fas fa-edit"></i> <span>تعديل معلومة </span></a>
                        </li>
                    </ul>
                </li>
                <!-- الصفحة الشخصية -->
                <li>
                    <a href="#editProfile" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle text-right">
                        <i class="fas fa-user fa-2x"></i> <span>الصفحة الشخصية</span>
                    </a>
                    <ul class="collapse nav" role="tablist" id="editProfile">
                        <li role="presentation">
                            <a href="#profile_sec" aria-controls="1" role="tab" data-toggle="tab"><i class="fas fa-user-cog"></i> <span>تعديل</span></a>
                        </li>
                        <?php $row = checkPriv($conn,$_SESSION['id_admin']); 
                              if ($row['user_type']=='ادمن') { ?>
                        <li role="presentation">
                            <a href="#permission" aria-controls="1" role="tab" data-toggle="tab"><i class="fas fa-user-astronaut"></i> <span>الصلاحيات</span></a>
                        </li> <?php } ?>
                    </ul>
                </li>

                <li>
                    <a href="assets/req_files/logout.php" class="text-right">
                        <i class="fas fa-sign-out-alt fa-2x"></i> <span> تسجيل خروج</span>
                    </a>
                </li>
            </ul>


        </nav>
        <button type="button" id="sidebarCollapse" class="btn btn_active arrowin"></button>
        <div id="content">


        <div class="tab-content">
        <?php

if(!isset($_SESSION['posts'])){}  
elseif(isset($_SESSION['posts']))
{ echo '<div class="alert alert-warning text-right" data-dismiss="alert" role="alert"><i class="fas fa-exclamation-circle" style="margin-left: 15px;"></i>'. $_SESSION['posts']."</div>";}
unset($_SESSION['posts']);

    ?>
            <!-- اضافة منشور -->
            <div role="tabpanel" class="tab-pane active" id="addpost">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-clean">
                                    <form method="post" action="assets/req_files/addpost.php"enctype="multipart/form-data">
                                        <h2 class="text-right">اضافة منشور</h2>

                                        <div class="text-center">
                                            <div class="avatar">
                                                <label for="pstimg"><span class="roll" ></span></label>
                                                <img id="avatar" src="" onerror="this.src='assets/img/ImageNotFound.jpg'">
                                            </div>
                                            <div class="upload-btn-wrapper">
                                                <input  type="file" id="pstimg" class="form-control" name="avatar-file" onchange="readURL(this);" accept="image/*">
                                            </div>
                                        </div>
                        

                                        <div class="form-group"><input class="form-control" type="text" name="petName" placeholder="اسم الحيوان"></div>
                                        <!-- End: Success Example -->
                                        <div class="form-group"><textarea class="form-control" name="Details" placeholder="التفاصيل" rows="4"></textarea></div>
                                        <div class="form-group"><button class="btn" type="submit" name="subPost"><i class="fas fa-paper-plane"></i> نشر</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- تعديل منشور -->
            <div role="tabpanel" class="tab-pane" id="editpost">
                <?php $row = selectEditPosts($conn,$_SESSION['id_admin']); ?>
                    <div class="container" >
                    <div class="row">
                        <?php foreach($row as $post) { ?>
                            <div class="col-md-4">
                                <div class="card">                
                                    <div class="">
                                        <img class="w-100 d-block imgcar" src="assets/img/post_img/<?php echo $post['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="text-right card-title" style="font-family: Tajawal, sans-serif;font-style: normal;font-weight: bold;color:#3A3A6D;"><img style="width: 50px;height: 50px;margin-left: 10px;border-radius:25px;" src="<?php echo $post['user_pic'];?>"><?php echo $post['fl_name'];?></h5>
                                        <h3 class="form-text text-right" style="font-size: 18px;font-family: Changa, sans-serif;font-weight: bold;"><?php echo $post['post_title'];?></h3>
                                        <small class="form-text text-lowercase text-muted text-right" style="font-size: 16px;"><?php echo $post['post_date']; ?></small>
                                        <p  class="text-right card-text desc" style="font-family: Changa, sans-serif;"><?php echo $post['post_desc'];?></p>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            
                                            <button type="button" class="btn btnsb btn-outline-danger" data-toggle="modal" data-target=".cncl-<?php echo $post['post_ID']; ?>"><i class="fas fa-trash"></i> حذف</button>
                                            <a class="btn btn-outline-primary" href="assets/req_files/archive_post.php?pst=<?php echo $post['post_ID']; ?>"><i class="fas fa-inbox"></i> ارشفة</a>
                                            <button type="button" class="btn btnsa btn-outline-success" data-toggle="modal" data-target=".mdl-<?php echo $post['post_ID']; ?>"><i class="fas fa-edit"></i> تعديل</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- حذف -->
                            <div class="modal cncl-<?php echo $post['post_ID']; ?> fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content contact-clean">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-circle"></i> تنبيه</h5>
                                    </div>
                                    <div class="modal-body">
                                        <h4>سوف يتم حذف المنشور. هل انت متأكد؟</h4>
                                    </div>
                                    <div class="modal-footer">
                                    <button class="btn cancel" data-dismiss="modal"><i class="fas fa-times"></i> الغاء</button>
                                    <a class="btn" href='assets/req_files/post_delete.php?pst=<?php echo $post['post_ID']; ?>' role="button"><i class="fas fa-trash"></i> حذف</a>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- تعديل -->
                            <div class="modal fade bd-example-modal-lg mdl-<?php echo $post['post_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content contact-clean">
                                <h3 class="addstitle text-right">تعديل المنشور :</h3>
                                <form method="post" action="assets/req_files/edit_post.php" enctype="multipart/form-data">

                                    <div class="text-center">
                                        <div class="avatar">
                                            <label id="lbl" for="edtimg<?php echo $post['post_ID']; ?>"><span class="roll" ><a href="assets/req_files/delete_pic.php?pst=<?php echo $post['post_ID']; ?>"><i class="fas fa-times-circle fa-2x"></i></a></span></label>
                                            <img id="edt<?php echo $post['post_ID']; ?>" src="assets/img/post_img/<?php echo $post['post_img']; ?>" onerror="this.src='assets/img/ImageNotFound.jpg'">
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <input type="file" id="edtimg<?php echo $post['post_ID']; ?>" class="form-control" name="avatar-edit" onchange="psting<?php echo $post['post_ID']; ?>(this);" accept="image/*">
                                            
                                        </div>
                                    </div>
                    
                                    <input name="pstid" value="<?php echo $post['post_ID']; ?>" type="hidden">
                                    <div class="form-group"><input class="form-control" type="text" name="Namechng" value="<?php echo $post['post_title']; ?>" placeholder="اسم الحيوان"></div>
                                    <div class="form-group"><textarea class="form-control" name="Detachng" placeholder="التفاصيل" rows="4"><?php echo $post['post_desc']; ?></textarea></div>
                                    <div class="modal-footer">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <div class="form-group"><button class="btn cancel" data-dismiss="modal"><i class="fas fa-times"></i> الغاء</button></div>
                                            <div class="form-group"><button class="btn" type="submit" name="chngPost"><i class="fas fa-paper-plane"></i> حفظ التغييرات</button></div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                <script>
                                            function psting<?php echo $post['post_ID']; ?>(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                            
                                                reader.onload = function (e) {
                                                        $('#edt<?php echo $post['post_ID']; ?>')
                                                            .attr('src', e.target.result);
                                                    };   
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                </script>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <!-- ارشيف -->
            <div role="tabpanel" class="tab-pane" id="archive">
            <div class="container">
                  <div class="row">                      
                      <div class="col-md-12">
                      <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">ID المنشور</th>
                                <th scope="col">عنوان المنشور</th>
                                <th scope="col">صورة المنشور</th>
                                <th scope="col">تاريخ النشر</th>
                                <th scope="col">حذف من الارشيف</th>
                                <caption><span style="color:red;">*</span> سيتم نقل المنشور الى الصفحة الرئيسية</caption>
                                </tr>
                            </thead>
                            <tbody>
                            <?php $arch = selectArchivedList($conn,$_SESSION['id_admin']);
                                  foreach($arch as $list) { ?>
                                <tr>
                                <th scope="row"><?php echo $list['post_ID'];?></th>
                                <td><?php echo $list['post_title'];?></td>
                                <td><img src="assets/img/post_img/<?php echo $list['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="" style="width:50px;height:50px;"></td>
                                <td><?php echo $list['post_date'];?></td>
                                <td>
                                <form method="post" action="assets/req_files/priv.php" enctype="multipart/form-data">
                                        <input type="hidden" name="post_ID" value="<?php echo $list['post_ID'];?>">
                                        <input type="hidden" name="username" value="<?php echo $list['username'];?>">
                                        <button class="btn btn-outline-danger" type="submit" name="un_arch"><i class="fas fa-trash"></i></button>
                                    </form>
                                </td>
                                  </tr><?php } ?>
                            </tbody>
                            </table>
                      </div>
                  </div>
              </div>
            </div>
            <!-- اضافة معلومة -->
            <div role="tabpanel" class="tab-pane" id="addfyi">
                <div>
                    <div class="container">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="contact-clean">
                                    <form method="post" action="assets/req_files/add_fyi.php"enctype="multipart/form-data">
                                        <h2 class="text-right">اضافة معلومة</h2>

                                        <div class="text-center">
                                            <div class="avatar">
                                                <label for="fiyimg"><span class="roll" ></span></label>
                                                <img id="fyi" src="" onerror="this.src='assets/img/ImageNotFound.jpg'">
                                            </div>
                                            <div class="upload-btn-wrapper">
                                                <input  type="file" id="fiyimg" class="form-control" name="fyi-file" onchange="addfyimg(this);" accept="image/*">
                                            </div>
                                        </div>
                        
                                        <div class="form-group"><textarea class="form-control" name="Details" placeholder="التفاصيل" rows="4"></textarea></div>
                                        <div class="form-group"><button class="btn" type="submit" name="subfyi"><i class="fas fa-paper-plane"></i> نشر</button></div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- تعديل معلومة -->
            <div role="tabpanel" class="tab-pane scrollable" id="editfyi">
            <?php $row = selectEditFYIs($conn,$_SESSION['id_admin']); ?>
                    <div class="container" >
                    <div class="row">
                        <?php foreach($row as $fyi) { ?>
                            <div class="col-md-4">
                                <div class="card">                
                                    <div class="">
                                        <img class="w-100 d-block imgcar" src="assets/img/fyi_img/<?php echo $fyi['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="">
                                    </div>
                                    <div class="card-body">
                                        <h5 class="text-right card-title" style="color:#3A3A6D;"><img style="width: 50px;height: 50px;margin-left: 10px;border-radius:25px;" src="<?php echo $fyi['user_pic'];?>"><?php echo $fyi['fl_name'];?></h5>
                                        <small class="form-text text-lowercase text-muted text-right" style="font-size: 16px;"><?php echo $fyi['post_date']; ?></small>
                                        <p  class="text-right desc card-text" style="font-family: Changa, sans-serif;"><?php echo $fyi['post_desc'];?></p>
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            
                                            <button type="button" class="btn btnsb btn-outline-danger" data-toggle="modal" data-target=".cancl-<?php echo $fyi['post_ID']; ?>"><i class="fas fa-trash"></i> حذف</button>
                                            <button type="button" class="btn btnsa btn-outline-success" data-toggle="modal" data-target=".medl-<?php echo $fyi['post_ID']; ?>"><i class="fas fa-edit"></i> تعديل</button>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- حذف -->
                            <div class="modal cancl-<?php echo $fyi['post_ID']; ?> fade" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                <div class="modal-dialog modal-dialog-centered" role="document">
                                    <div class="modal-content contact-clean">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLongTitle"><i class="fas fa-exclamation-circle"></i> تنبيه</h5>
                                    </div>
                                    <div class="modal-body">
                                        <h4>سوف يتم حذف المعلومة. هل انت متأكد؟</h4>
                                    </div>
                                    <div class="modal-footer">
                                    <button class="btn cancel" data-dismiss="modal"><i class="fas fa-times"></i> الغاء</button>
                                    <a class="btn" href='assets/req_files/fyi_delete.php?pst=<?php echo $fyi['post_ID']; ?>' role="button"><i class="fas fa-trash"></i> حذف</a>
                                    </div>
                                    </div>
                                </div>
                            </div>

                            <!-- تعديل -->
                            <div class="modal fade bd-example-modal-lg medl-<?php echo $fyi['post_ID']; ?>" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                                <div class="modal-dialog modal-lg">
                                <div class="modal-content contact-clean">
                                <h3 class="addstitle text-right">تعديل المعلومة :</h3>
                                <form method="post" action="assets/req_files/edit_fyi.php" enctype="multipart/form-data">

                                    <div class="text-center">
                                        <div class="avatar">
                                            <label id="lbl" for="fyiedt-<?php echo $fyi['post_ID']; ?>"><span class="roll" ><a href="assets/req_files/delFYI_pic.php?pst=<?php echo $fyi['post_ID']; ?>"><i class="fas fa-times-circle fa-2x"></i></a></span></label>
                                            <img id="fyia<?php echo $fyi['post_ID']; ?>" src="assets/img/fyi_img/<?php echo $fyi['post_img']; ?>" onerror="this.src='assets/img/ImageNotFound.jpg'">
                                        </div>
                                        <div class="upload-btn-wrapper">
                                            <input type="file" id="fyiedt-<?php echo $fyi['post_ID']; ?>" class="form-control" name="avatar-fyi" onchange="fyIMG<?php echo $fyi['post_ID']; ?>(this);" accept="image/*">
                                        </div>
                                    </div>
                    
                                    <input name="pstid" value="<?php echo $fyi['post_ID']; ?>" type="hidden">
                                    <div class="form-group"><textarea class="form-control" name="Detachng" placeholder="التفاصيل" rows="4"><?php echo $fyi['post_desc']; ?></textarea></div>
                                    <div class="modal-footer">
                                        <div class="btn-group" role="group" aria-label="Basic example">
                                            <div class="form-group"><button class="btn cancel" data-dismiss="modal"><i class="fas fa-times"></i> الغاء</button></div>
                                            <div class="form-group"><button class="btn" type="submit" name="chngfyi"><i class="fas fa-paper-plane"></i> حفظ التغييرات</button></div>
                                        </div>
                                    </div>
                                </form>
                                </div>
                                </div>
                                </div>
                                <script>
                                            function fyIMG<?php echo $fyi['post_ID']; ?>(input) {
                                                if (input.files && input.files[0]) {
                                                    var reader = new FileReader();
                                            
                                                reader.onload = function (e) {
                                                        $('#fyia<?php echo $fyi['post_ID']; ?>')
                                                            .attr('src', e.target.result);
                                                    };   
                                                    reader.readAsDataURL(input.files[0]);
                                                }
                                            }
                                </script>
                    <?php } ?>
                    </div>
                </div>
            </div>
            <!-- الصفحة الشخصية -->
            <div role="tabpanel" class="tab-pane" id="profile_sec">

            <!--  -->
            <?php $prof = selectProfileInfo($conn,$_SESSION['id_admin']); ?>

    <div class="container profile profile-view" id="profile">
        <form method="post" action="assets/req_files/admin_Infoedt.php" enctype="multipart/form-data">
            <div class="form-row profile-row">
                <div class="col-md-3 text-center relative">
                    <div class="upload-btn-wrapper">
                    <div class="avatar"><img id="updateProf" src="<?php echo $prof['user_pic'];?>" style="width:100px; height:100px;"></div>
                        <label class="change" for="prof_pic">تغيير الصورة</label>
                        <input type="file" id="prof_pic" class="form-control" name="avatar-file" onchange="updProf(this);" accept="image/*">
                    </div>
                    <input class="userid" type="text" value="<?php echo $prof['username'];?>" name="user_id">
                    <input class="userid" type="text" value="<?php echo $prof['fl_name'];?>" name="fullname">
                </div>

                <div class="col-md-9">
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>البريد الالكتروني</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="text" name="email" inputmode="email" value="<?php echo $prof['email'];?>" required=""></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>رقم الموبايل</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="tel" name="phone_no" inputmode="tel" value="0<?php echo $prof['phone_no'];?>" pattern="[07]{2}[4,5,6,7,8]{1}[0-9]{8}" placeholder="0780xxxxxxx"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>المحافظة</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group text-right"><select class="form-control user_ip" name="province" ><optgroup label="اختر المحافظة:"><option value="<?php echo $prof['province'];?>"><?php echo $prof['province'];?></option><option value="أربيل">أربيل</option><option value="الانبار">الانبار</option><option value="بابل">بابل</option><option value="بغداد">بغداد</option><option value="البصرة">البصرة</option><option value="دهوك">دهوك</option><option value="الديوانية">الديوانية</option><option value="ديالى">ديالى</option><option value="ذي قار">ذي قار</option><option value="السليمانية">السليمانية</option><option value="صلاح الدين">صلاح الدين</option><option value="كركوك">كركوك</option><option value="كربلاء">كربلاء</option><option value="المثنى">المثنى</option><option value="ميسان">ميسان</option><option value="النجف">النجف</option><option value="نينوى">نينوى</option><option value="واسط">واسط</option></optgroup></select></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>العنوان</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="text" value="<?php echo $prof['address'];?>" name="address"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>حساب الفيسبوك</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="url" value="<?php echo $prof['fb_account'];?>" name="fbaccount"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-sm-6 col-lg-2 labels align-self-center text-right"><span>حساب التيليجرام</span></div>
                        <div class="col-sm-6 col-lg-9">
                            <div class="form-group"><input class="form-control user_ip" type="url" value="<?php echo $prof['tel_account'];?>" name="telaccount"></div>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="col-md-12 content-right"><button class="btn btn-lg form-btn sub_btn" type="submit" name="update_profile">تعديل  <i class="fas fa-pen"></i></button></div>
                    </div>
                </div>
            </div>
        </form>
    </div>
            <!--  -->
            </div>
            <!-- الصفحة الشخصيةEND -->

            <!-- الصلاحيات -->
            <?php $row = checkPriv($conn,$_SESSION['id_admin']); 
                    if ($row['user_type']=='ادمن') { ?>

            <div role="tabpanel" class="tab-pane" id="permission">
                <div class="container">
                  <div class="row">  
                        <div class="col-sm-2 col-md-4">
                            <div class="form-group pull-right">
                            <form  method="post">
                                <input type="text"  name="search_text" id="search_text" aria-label="Search" class="search form-control" placeholder="اسم المستخدم او البريد الالكتروني">
                                </form>
                            </div>
                        </div>
                      
                      <div class="col-md-12">
                      <table class="table table-striped">
                            <thead>
                                <tr>
                                <th scope="col">معرف الحساب</th>
                                <th scope="col">اسم المستخدم</th>
                                <th scope="col">البريد الالكتروني</th>
                                <th scope="col">نوع الحساب</th>
                                </tr>
                            </thead>
                            <tbody id="result"></tbody>

                            <?php $perm = selectAccountsInfo($conn);
                                  foreach($perm as $user) { ?>
                                <tr>
                                <th scope="row"><?php echo $user['username'];?></th>
                                <td><?php echo $user['fl_name'];?></td>
                                <td><?php echo $user['email'];?></td>
                                <td>
                                <form method="post" action="assets/req_files/priv.php" enctype="multipart/form-data">
                                    <input type="hidden" name="username" value="<?php echo $user['username'];?>">

                                    <div class="input-group mb-3">
                                        <select name="acnt_type" class="form-control">
                                            <option value="<?php echo $user['user_type'];?>"><?php echo $user['user_type'];?></option>
                                            <option value="ادمن">ادمن</option>
                                            <option value="متطوع">متطوع</option>
                                            <option value="مستخدم">مستخدم</option>
                                        </select>
                                        <div class="input-group-prepend">
                                        <button class="btn btn-outline-success" type="submit" id="save" name="change_priv"><i class="fas fa-sync"></i></button>
                                        </div>
                                    </div>
                                    </form>
                                </td>
                                  </tr><?php } ?>
                            </table>
                        </div>
                  </div>
              </div>
          </div>
          <?php } ?>
        </div>
    </div>
</div>

<!-- Footer -->
<footer class="page-footer pt-2">  
    <div class="footer-copyright text-center py-3">All Copyrights reserved 
      <a href="#"> @ Code for Iraq © 2020</a>
    </div>  
</footer>

    <!-- jQuery CDN - Slim version (=without AJAX) -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>

    <script>
    
        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                $('#sidebar').toggleClass('active');
            });
        });

        $(document).ready(function () {
            $('#sidebarCollapse').on('click', function () {
                if($("#sidebarCollapse").hasClass('arrowout'))
                {$("#sidebarCollapse").removeClass('arrowout')
                $("#sidebarCollapse").addClass('arrowin');}

               else{
                $("#sidebarCollapse").removeClass('arrowin')
                $("#sidebarCollapse").addClass('arrowout');
               }
            });
        });

        var $homeIcon = $('#sidebar');
        $(window).width(function() {
        if (window.innerWidth <= 768) $homeIcon.addClass('active');
        if (window.innerWidth >768) $homeIcon.removeClass('active');
        });

        $(window).resize(function() {
        if (window.innerWidth <= 768) $homeIcon.addClass('active');
        if (window.innerWidth >768) $homeIcon.removeClass('active');
        });

        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
            reader.onload = function (e) {
                    $('#avatar')
                        .attr('src', e.target.result);

                };   
                reader.readAsDataURL(input.files[0]);
            }
        }

        function addfyimg(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
            reader.onload = function (e) {
                    $('#fyi')
                        .attr('src', e.target.result);

                };   
                reader.readAsDataURL(input.files[0]);
            }
        }

        function prof_pic(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
        
            reader.onload = function (e) {
                    $('#updateProf')
                        .attr('src', e.target.result);
                };   
                reader.readAsDataURL(input.files[0]);
            }
        }



        $(function() {
        // OPACITY OF BUTTON SET TO 0%
        $(".roll").css("opacity","0");

        // ON MOUSE OVER
        $(".roll").mouseenter(function() {
        
            $(".roll").css("opacity",".7");
            $(".roll").css("transition","all 0.4s ease 0s");

        });
        $(".roll").mouseleave(function() {
        
            $(".roll").css("opacity","0");

        });
        });
        
        $(document).ready(function() {
            // show the alert
            setTimeout(function() {
                $(".alert").alert('close');
            }, 2000);
        });


          $(document).ready(function(){
            load_data();
            function load_data(query)
            {
              $.ajax({
                url:"assets/req_files/search.php",
                method:"post",
                data:{query:query},
                success:function(data)
                {
                  $('#result').html(data);
                }
              });
            }
            $('#search_text').keyup(function(){
              var search = $(this).val();
              if(search != '')
              {
                load_data(search);
              }
              else
              {
                load_data();
              }
            });
          });
      </script>
</body>

</html>

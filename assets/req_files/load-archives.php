<?php
require_once 'functions.php';

$postNewCount = $_POST['postNewCount'];
$row = selectMoreArchived($conn,$postNewCount);
?>
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
                    <small class="form-text text-lowercase text-muted" style="font-size: 16px;"><?php echo $post['post_date']; ?></small>
                    <p  class="text-right card-text desc" style="font-family: Changa, sans-serif;"><?php echo $post['post_desc'];?></p>
                    <button class="btn more"  data-toggle="modal" data-target=".modl-<?php echo $post['post_ID'];?>" >المزيد</button>
                    <p class="done">تم التبني</p>
                </div>
            </div>
        </div>
        <!-- Large modal -->

        <div class="modal fade bd-example-modal-lg  modl-<?php echo $post['post_ID'];?>"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                <!-- Activity inside Modal-->
                <!-- Image -->
                <img class="w-100 d-block imgcarmdl" src="assets/img/post_img/<?php echo $post['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="">
                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        <h3 class="text-right card-title" style="font-family: Tajawal, sans-serif;font-style: normal;font-weight: bold;color:#3A3A6D;"><img style="width: 50px;height: 50px;margin-left: 10px;border-radius:25px;" src="<?php echo $post['user_pic'];?>"><?php echo $post['fl_name'];?></h3>
                        <h3 class="form-text text-right" style="font-size: 20px;font-family: Changa, sans-serif;font-weight: bold;"><?php echo $post['post_title'];?></h3>
                        <small class="form-text text-lowercase text-muted" style="font-size: 16px;"><?php echo $post['post_date']; ?></small>
                        <p  class="text-right card-text" style="font-family: Changa, sans-serif;"><?php echo $post['post_desc'];?></p>
                        <button class="btn mdl-more"  data-toggle="modal" data-target=".modl-<?php echo $post['post_ID'];?>" style="font-family: Tajawal, sans-serif;font-style: normal;">رجوع</button>
                        <p class="modl-done">تم التبني</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
            <!-- Large modal End -->
</div>
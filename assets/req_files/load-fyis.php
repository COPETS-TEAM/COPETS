<?php
require_once 'functions.php';

$postNewCount = $_POST['postNewCount'];
$row = selectMoreFYIs($conn,$postNewCount);
?>
<div class="row">
    <?php foreach($row as $fyi) { ?>
        <div class="col-md-4">
            <div class="card">                
                <div class="card-body">
                    <h5 class="text-right card-title" style="font-family: Tajawal, sans-serif;font-style: normal;font-weight: bold;color:#3A3A6D;"><img style="width: 50px;height: 50px;margin-left: 10px;border-radius:25px;" src="<?php echo $fyi['user_pic'];?>"><?php echo $fyi['fl_name'];?></h5>
                    <h3 class="form-text text-right" style="font-size: 18px;font-family: Changa, sans-serif;font-weight: bold;">هل تعلم</h3>
                    <small class="form-text text-lowercase text-muted" style="font-size: 16px;"><?php echo $fyi['post_date']; ?></small>
                    <div  class="text-right card-text desc" style="font-family: Changa, sans-serif;"><?php echo $fyi['post_desc'];?></div>
                </div>
                <div class="">
                    <img class="w-100 d-block" src="assets/img/fyi_img/<?php echo $fyi['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="">
                    <button class="btn more"  data-toggle="modal" data-target=".modl-<?php echo $fyi['post_ID'];?>" style="font-family: Tajawal, sans-serif;font-style: normal;">المزيد</button>
                </div>
            </div>
        </div>
        <!-- Large modal -->

    <div class="modal fade bd-example-modal-lg modl-<?php echo $fyi['post_ID'];?>"  tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <!-- Activity inside Modal-->
                <div class="card">
                    <!-- Card body -->
                    <div class="card-body">
                        <h3 class="text-right card-title" style="font-family: Tajawal, sans-serif;font-style: normal;font-weight: bold;color:#3A3A6D;"><img style="width: 50px;height: 50px;margin-left: 10px;border-radius:25px;" src="<?php echo $fyi['user_pic'];?>"><?php echo $fyi['fl_name'];?></h3>
                        <h3 class="form-text text-right" style="font-size: 20px;font-family: Changa, sans-serif;font-weight: bold;">هل تعلم</h3>
                        <small class="form-text text-lowercase text-muted" style="font-size: 16px;"><?php echo $fyi['post_date']; ?></small>
                        <div  class="text-right card-text" style="font-family: Changa, sans-serif;"><?php echo $fyi['post_desc'];?></div>
                    </div>
                    <div class="">
                    <img class="w-100 d-block  " src="assets/img/fyi_img/<?php echo $fyi['post_img'];?>" onerror="this.src='assets/img/ImageNotFound.jpg'" alt="">
                    </div>
                </div>
            </div>
            <button class="btn more-modal"  data-toggle="modal" data-target=".modl-<?php echo $fyi['post_ID'];?>" style="font-family: Tajawal, sans-serif;font-style: normal;">رجوع</button>

            </div>
        </div>
    <?php } ?>        <!-- Large modal End -->
</div>
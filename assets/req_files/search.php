<?php
require_once ('connectdb.php') ;

if(isset($_POST["query"]))
{
    $search = mysqli_real_escape_string($conn, $_POST["query"]);
	$query = "SELECT `username`, `fl_name`, `user_type`,
                `email` FROM `users` WHERE
                (username LIKE '%".$search."%'
                OR  email LIKE '%".$search."%'
                OR fl_name LIKE '%".$search."%')
                ORDER BY FIELD(user_type,'ادمن','متطوع','مستخدم')";

$result = mysqli_query($conn, $query);
if(mysqli_num_rows($result) > 0)
{
	while($row = mysqli_fetch_array($result))
	{ ?>
        <tr class="table-success">
        <th scope="row"><?php echo $row['username'];?></th>
        <th><?php echo $row['fl_name'];?></th>
        <th><?php echo $row['email'];?></th>
        <th>
        <form method="post" action="assets/req_files/priv.php" enctype="multipart/form-data">
            <input type="hidden" name="username" value="<?php echo $row['username'];?>">

            <div class="input-group mb-3">
                <select name="acnt_type" class="form-control">
                    <option value="<?php echo $row['user_type'];?>"><?php echo $row['user_type'];?></option>
                    <option value="ادمن">ادمن</option>
                    <option value="متطوع">متطوع</option>
                    <option value="مستخدم">مستخدم</option>
                </select>
                <div class="input-group-prepend">
                <button class="btn btn-outline-success" type="submit" id="save" name="change_priv"><i class="fas fa-sync"></i></button>
                </div>
            </div>
            </form>
        </th>
        </tr>
        <?php
    }
    echo '<tr class="table-light"><th colspan="1"><hr></th><th style="color:#F8726E;" colspan="2">نهاية نتائج البحث</th><th colspan="1"><hr></th></tr>';

}
else
{
    echo '<tr class="table-warning"><th colspan="4">لا توجد نتائج...</th></tr>
    <tr class="table-light"><th colspan="4"><hr></th></tr>';
}
}

?>

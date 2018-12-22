<?php
if(User('type') == 0){
    to('/dash');
}
$pageOption =
    array(
        'title' => User('full_name'),
        'sidebar' => true,
        'need_login' =>true
    );
?>
<?php include "inc/header.php"; ?>

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/dash">لوحة التحكم</a>
            </li>
            <li class="breadcrumb-item active">الرئيسية</li>
        </ol>

        <!-- Page Content -->
        <h1>الغرف المستأجرة</h1>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <?php if (count(selectby(['user_id'=> User('id')],'bookings')) != 0){ ?>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>رقم الحجز</th>
                                    <th>اسم الفندق</th>
                                    <th>رقم الغرفة</th>
                                    <th>السعر </th>
                                    <th>صورة</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (selectby(['user_id'=> User('id')],'bookings') as $booking ){
                                    $rooms = selectby(['id'=> $booking['room_id']],'rooms')[0];
                                    ?>
                                <tr class="odd gradeX">
                                    <td ><label class="no-copy">#</label><?= $booking['id'] ?></td>
                                    <td><a href="<?= selectby(['id'=>$rooms['hotel_id']],"hotels")[0]['location'] ?>" target="_blank"><?= selectby(['id'=>$rooms['hotel_id']],"hotels")[0]['name'] ?></a> </td>
                                    <td><?= ($rooms['room_no']) ?></td>
                                    <td><?= ($booking['amount']) ?></td>
                                    <td><img src="/<?= ($rooms['pic']) ?>" width="300"></td>
                                    <td>
                                    <?php
                                    if ($booking['status']==0){
                                        echo '<label class="label  label-warning">قيد المراجعه</label>';
                                    }else if($booking['status']==1){
                                        echo '<label class="label  label-success">تم الحجز بنجاح</label>';
                                    }else if($booking['status']==2){
                                        echo '<label class="label  label-warning">تم  رفض الحجز</label>';
                                    }else if ($booking['status']==3){
                                        echo '<label class="label  label-danger">تم انهاء الحجز</label>';
                                    }
                                    ?>
                                    </td>
                                </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->
<?php }else { echo 'لم يتم استأجر اي غرف فندقية , <a href="/search/">بحث عن فندق</a>'; } ?>
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>


    </div>
    <!-- /.container-fluid -->
<?php include "inc/footer.php"; ?>
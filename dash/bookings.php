<?php
if(User('type') == 1){
    to('/dash/renter');
}
@updateby(['unread' => 0],$_GET['Nid'],'notifications');

if (isset($_GET['bid'])){
    if ($_GET['b']== 'ok'){
        updateby(['status' => 1],$_GET['bid'],'bookings');
    }else if ($_GET['b']== 'no'){
        updateby(['status' => 2],$_GET['bid'],'bookings');
    }else if ($_GET['b']== 'stop'){
        updateby(['status' => 3],$_GET['bid'],'bookings');
    }
    to('/dash/bookings');

}

$pageOption =
    array(
        'title' => 'طلبات الحجوزات',
        'sidebar' => true,
        'need_login' => true
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
        <h1><?= @$pageOption['title'] ?></h1>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>رقم الحجز</th>
                                    <th>اسم الفندق</th>
                                    <th>رقم الغرفة</th>
                                    <th>السعر</th>
                                    <th>الاتصال بصاحب الطلب</th>
                                    <th> الاتصال بالفندق</th>
                                    <th>الحالة</th>
                                    <th>اجراء</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (select('bookings') as $booking ){
                                    $rooms = selectby(['id'=> $booking['room_id']],'rooms')[0];
                                    $hotels = selectby(['id'=> $rooms['hotel_id']],'hotels')[0];
                                    $users = selectby(['id'=> $booking['user_id']],'users')[0];
                                    ?>
                                    <tr class="odd gradeX">
                                        <td ><label class="no-copy">#</label><?= $booking['id'] ?></td>
                                        <td><a href="<?= selectby(['id'=>$rooms['hotel_id']],"hotels")[0]['location'] ?>" target="_blank"><?= selectby(['id'=>$rooms['hotel_id']],"hotels")[0]['name'] ?></a> </td>
                                        <td><?= ($rooms['room_no']) ?></td>
                                        <td><?= ($booking['amount']) ?></td>
                                        <td><a href="mailto:<?= $users['email'] ?>"><?= $users['email'] ?></a></td>
                                        <td><a href="mailto:<?= $hotels['email'] ?>"><?= $hotels['email'] ?></a> -
                                            <a href="tel:<?= $hotels['phone'] ?>"><?= $hotels['phone'] ?></a></td>
                                        <td>
                                            <?php
                                            if ($booking['status']==0){
                                                echo '<label class="label  label-warning">بإنتظار المراجعه</label>';
                                            }else if($booking['status']==1){
                                                echo '<label class="label  label-success">تمت الموافقه </label>';
                                            }else if ($booking['status']==2){
                                                echo '<label class="label  label-danger">تمت الرفض </label>';
                                            }else if ($booking['status']==3){
                                                echo '<label class="label  label-danger">تم انهاء الحجز</label>';
                                            }
                                            ?>
                                        </td>
                                        <td width="225px">
                                            <?php
                                            if ($booking['status']==0){
                                                echo '<div class="btn-group"  role="group" >';
                                                    echo '<a href="/dash/bookings?b=ok&bid='.$booking['id'].'" class="btn   btn-success">الموافقه على الحجز</a>';
                                                    echo '<a href="/dash/bookings?b=no&bid='.$booking['id'].'" class="btn   btn-danger">رفض الحجز</a>';
                                                echo '</div>';
                                            }else if($booking['status']==1){
                                                echo '<a  href="/dash/bookings?b=stop&bid='.$booking['id'].'" class="btn btn-danger">انهاء الحجز</a>';
                                            }else{
                                                echo '<hr>';
                                            }
                                            ?>
                                        </td>
                                    </tr>
                                <? } ?>
                                </tbody>
                            </table>
                        </div>
                        <!-- /.table-responsive -->

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
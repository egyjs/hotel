<?php
if(User('type') == 1){
    to('/dash/renter');
}
$pageOption =
    array(
        'title' => User('full_name'),
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
        <h1>الفنادق المضافة</h1>
        <hr>
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                <thead>
                                <tr>
                                    <th>اسم الفندق</th>
                                    <th>عدد الغرف المضافة</th>
                                    <th>الغرف المتاحة</th>
                                    <th>الحالة</th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php foreach (select('hotels') as $hotel ){ ?>
                                <tr class="odd gradeX">
                                    <td><a href="hotel?id=<?= $hotel['id'] ?>"><?= $hotel['name'] ?></a></td>
                                    <td><?= count(selectby(["hotel_id" =>$hotel['id']],"rooms")) ?></td>
                                    <td><?= count(selectby(["hotel_id" =>$hotel['id'],'empty'=>1],"rooms")) ?></td>
                                    <td>
                                    <?php
                                    if ($hotel['status']==1){
                                        echo '<label class="label  label-success">منشور</label>';
                                    }else{
                                        echo '<label class="label  label-danger">غير منشور</label>';
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
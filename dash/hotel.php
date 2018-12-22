<?php
if (isset($_GET['cancelR'])) {
    updateby(["empty" => 1], $_GET['cancelR'], 'rooms');
    to('/dash/hotel/?id=' . $_GET['id']);
}

if (isset($_GET['Hc'])) {
    updateby(["status" => 0], $_GET['Hc'], 'hotels');
    to('/dash');

} elseif (isset($_GET['Hreturn'])) {
    updateby(["status" => 1], $_GET['Hreturn'], 'hotels');
    to('/dash');
}
$H = selectby(['id' => $_GET['id']], "hotels")[0];
$title = $H['name'];

if (isset($_POST['del'])){
    _delete('rooms',$_POST['Rid']);
}

$err = array();
if (isset($_POST['update'])) {
    $target_file = $_POST['Rpic'];
    if ($_FILES['image']['size'] == 0) {
        updateby([
            'room_no' => $_POST['room_no'],
            'price' => $_POST['price'],
            'max_pepole' => $_POST['max_pepole'],
            'pic' => $target_file,
            'empty' => (isset($_POST['empty']) ? 0 : 1),
        ], $_POST['Rid'], 'rooms');
    } else if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
        updateby([
            'room_no' => $_POST['room_no'],
            'price' => $_POST['price'],
            'max_pepole' => $_POST['max_pepole'],
            'pic' => $target_file,
            'empty' => (isset($_POST['empty']) ? 0 : 1),
        ], $_POST['Rid'], 'rooms');
    } else {
        $err[] = "Sorry, there was an error uploading your file.";
    }


}

if (isset($_POST['Hupdate'])) {
    updateby([
        'name'=>$_POST['Hname'],
        'email'=>$_POST['Hemail'],
        'site'=>$_POST['Hsite'],
        'phone'=>$_POST['Hphone'],
        'location'=>$_POST['Hloc'],
        'address'=>$_POST['Hadrs'],
        'status'=>1,
        'country_code'=>$_POST['HCC'],
    ],$H['id'],'hotels');
    echo "<script> alert('تم التحديث بنجاح'); window.location.href= window.location.href; </script>";
}


$pageOption =
    array(
        'title' => $title,
        'sidebar' => true,
        'need_login' => true
    );


?>
    <meta http-equiv='cache-control' content='no-cache'>
    <meta http-equiv='expires' content='0'>
    <meta http-equiv='pragma' content='no-cache'>
<?php include "inc/header.php"; ?>

    <div class="container-fluid">

        <!-- Breadcrumbs-->
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="/dash">لوحة التحكم</a>
            </li>
            <li class="breadcrumb-item active">الفنادق</li>
        </ol>

        <!-- Page Content -->
        <h1 class="pull-right">غرف <?= $pageOption['title'] ?> <a class="btn btn-info" target="_blank"
                                                                  href="<?= $H['location'] ?>">على خرائط جوجل</a></h1>


        <a href="#He<?= $H['id'] ?>" data-toggle="modal" class="btn btn-info pull-left"> تعديل معلومات الفندق</a>
        <?php
        if ($H['status'] == 1) {
            echo '<a href="?Hc=' . $H['id'] . '" class="btn btn-danger pull-left">الغاء نشر الفندق</a>';
        } else {
            echo '<a href="?Hreturn=' . $H['id'] . '" class="btn btn-success pull-left">نشر الفندق</a>';
        }
        ?>
        <div class="clearfix"></div>

        <hr class="">
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="table-responsive">

                            <?php if (!empty((selectby(["hotel_id" => $H['id']], 'rooms')))) { ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                    <tr>
                                        <th>الغرفة</th>
                                        <th>العدد للنزلاء</th>
                                        <th>السعر لليلة</th>
                                        <th>رؤية</th>
                                        <th>حجز</th>
                                        <th>اجراء</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php foreach (selectby(["hotel_id" => $H['id']], 'rooms') as $room) { ?>
                                        <tr class="odd gradeX">
                                            <td><?= $room['room_no'] ?></td>
                                            <td><?= $room['max_pepole'] ?></td>
                                            <td><?= $room['price'] ?> دينار ليبي</td>
                                            <td><img src="/<?= $room['pic'] ?>?time=<?= time(); ?>" width="300px"></td>
                                            <td><?php
                                                if ($room['empty'] == 1) {
                                                    echo "<h3><label class='label  label-success'>غير محجوزة</label></h3>";
                                                } else {
                                                    echo "<h3><label class='label label-danger'>محجوزة </label>&emsp;<a class='btn btn-primary' href='hotel?id=" . $_GET['id'] . "&cancelR=" . $room['id'] . "'>ايقاف الحجز</a> </h3>";
                                                }
                                                ?></td>
                                            <td>
                                                <h3></h3>
                                                <a class="btn btn-sm btn-success" data-toggle="modal"
                                                   title="تعديل معلومات الغرفة" alt="تعديل معلومات الغرفة"
                                                   href="#M<?= $room['id'] ?>"><i class="fa fa-edit"></i></a>
                                                <a class="btn btn-sm btn-danger"  data-toggle="modal"title="حذف الغرفة" alt="حذف الغرفة"
                                                   href="#MD<?= $room['id'] ?>"><i class="fa fa-minus"></i></a>
                                            </td>

                                        </tr>
                                        <!-- Modal -->
                                        <div id="M<?= $room['id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" hidden name="Rid"
                                                               value="<?= $room['id'] ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title form-inline"><label
                                                                        class="form-inline">رقم الغرفة :</label>
                                                                <input
                                                                        class="form-control  " name="room_no"
                                                                        value="<?= $room['room_no'] ?>">
                                                            <label class="form-inline"> محجوزة :</label>
                                                                <input type="checkbox"
                                                                         name="empty"
                                                                        <?= ($room['empty']) == 0 ? 'checked' : "" ?> >

                                                            </h4>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="form-group">
                                                                <label for="image" class="control-label">تغير صورة
                                                                    الغرفة</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-image"></i>
                                                                    </div>
                                                                    <input id="image" name="image" accept="image/*"
                                                                           type="file" class="form-control">
                                                                    <input name="Rpic" type="hidden" hidden
                                                                           value="<?= $room['pic'] ?>"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="price" class="control-label">السعر بالدينار
                                                                    الليبي في الليله الواحدة</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-dollar"></i>
                                                                    </div>
                                                                    <input id="price" name="price"
                                                                           value="<?= $room['price'] ?>" type="number"
                                                                           class="form-control">
                                                                </div>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="max_pepole" class="control-label">عدد
                                                                    الأشخاص</label>
                                                                <div class="input-group">
                                                                    <div class="input-group-addon">
                                                                        <i class="fa fa-sort-numeric-asc"></i>
                                                                    </div>
                                                                    <input id="max_pepole" name="max_pepole"
                                                                           value="<?= $room['max_pepole'] ?>"
                                                                           type="number" class="form-control">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="submit" name="update" class="btn btn-success">
                                                                تحديث
                                                            </button>
                                                            <button type="reset" class="btn btn-default"
                                                                    data-dismiss="modal">اغلاق
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                        <!-- Modal delete -->
                                        <div id="MD<?= $room['id'] ?>" class="modal fade" role="dialog">
                                            <div class="modal-dialog">

                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <form method="post" enctype="multipart/form-data">
                                                        <input type="hidden" hidden name="Rid"
                                                               value="<?= $room['id'] ?>">
                                                        <div class="modal-header">
                                                            <button type="button" class="close" data-dismiss="modal">
                                                                &times;
                                                            </button>
                                                            <h4 class="modal-title ">حذف الغرفة رقم : <?= $room['room_no'] ?></h4>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button type="submit" name="del" class="btn btn-danger">
                                                                حذف
                                                            </button>
                                                            <button type="reset" class="btn btn-default"
                                                                    data-dismiss="modal">الغاء
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>

                                            </div>
                                        </div>
                                    <? } ?>
                                    </tbody>
                                </table>
                            <?php } else {
                                echo "<a href='/dash/addRoom?Hid={$H["id"]}'>اضافة غرفة</a>";
                            } ?>
                        </div>

                    </div><!-- /.table-responsive -->
                </div>
            </div>
            <!-- /.panel-body -->
        </div>
        <!-- /.panel -->
    </div>
    <!-- /.col-lg-12 -->
    </div>
    </div>
    <div id="He<?= $H['id'] ?>" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <form class="modal-content" method="post">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><?= $H['name'] ?></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="Hname" class="control-label">*اسم الفندق</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-home"></i>
                            </div>
                            <input id="Hname" name="Hname" type="text" value="<?= $H['name'] ?>" class="form-control" required="required">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hsite" class="control-label">الموقع الإلكتروني</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-globe"></i>
                            </div>
                            <input id="Hsite" name="Hsite" value="<?= $H['site'] ?>" type="url" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hemail" class="control-label">بريد الفندق الإلكتروني</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-envelope"></i>
                            </div>
                            <input id="Hemail" name="Hemail" value="<?= $H['email'] ?>" type="email" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hphone" class="control-label">رقم الهاتف*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-phone"></i>
                            </div>
                            <input id="Hphone" name="Hphone" value="<?= $H['phone'] ?>" type="number" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hloc" class="control-label">الموقع(رابط الخريطة)*</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <input id="Hloc" name="Hloc" type="url" value="<?= $H['location'] ?>" required class="form-control" placeholder="من خرائط جوجل .. مثال :https://goo.gl/maps/TPuhkFNVUER2 ">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hadrs" class="control-label">*العنوان نصاً</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <input id="Hadrs" name="Hadrs" required type="text" value="<?= $H['address'] ?>" class="form-control" placeholder="ليبيا,سبها, شارع القارات">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="Hloc" class="control-label">الرقم البريدي</label>
                        <div class="input-group">
                            <div class="input-group-addon">
                                <i class="fa fa-location-arrow"></i>
                            </div>
                            <input id="Hloc" name="HCC" value="<?= $H['country_code'] ?>" type="text" class="form-control" placeholder="Country Code">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button name="Hupdate" type="submit" class="btn btn-primary ">تحديث</button>

                    <button type="button" class="btn btn-default" data-dismiss="modal">الغاء</button>
                </div>
            </form>

        </div>
    </div>
    <!-- /.container-fluid -->
<?php include "inc/footer.php"; ?>
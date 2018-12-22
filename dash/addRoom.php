<?php
$pageOption =
    array(
        'title' => "اضافة غرفة",
        'sidebar' => true,
        'need_login' =>true
    );

    $err=array();
    if (isset($_POST['submit'])) {
        $target_dir = "public/uploads/";
        $target_file = $target_dir . rand(0,2002)."-".basename($_FILES["image"]["name"]);
        $uploadOk = 1;
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

        insert_into_table('rooms',[
            'hotel_id'=>$_POST['Hname'],
            'room_no'=>$_POST['room_no'],
            'price'=>$_POST['price'],
            'max_pepole'=>$_POST['max_pepole'],
            'pic'=>$target_file,
            'empty'=>true,
        ]);
        echo "<script> alert('تم التسجيل بنجاح'); window.location.href='/dash'; </script>";
        } else {
            $err[]= "Sorry, there was an error uploading your file.";
        }


    }

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
        <h1><?= $pageOption['title'] ?></h1>
        <hr>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="Hname" class="control-label">الفندق</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <select id="Hname" name="Hname" class="form-control" required="required">
                        <?php
                        foreach (select("hotels") as $hotel){
                            if ($hotel['id']== $_GET['Hid']){
                                echo "<option selected value='" .$hotel['id']."'>".$hotel['name']."</option>";
                            }else{
                                echo "<option value='".$hotel['id']."'>".$hotel['name']."</option>";
                            }
                        }
                        ?>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="image" class="control-label">صورة الغرفة</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-image"></i>
                    </div>
                    <input id="image" name="image" accept="image/*"  type="file" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="price" class="control-label">السعر بالدينار الليبي في الليله الواحدة</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-dollar"></i>
                    </div>
                    <input id="price" name="price" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="room_no" class="control-label">رقم الغرفة</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-sort-numeric-asc"></i>
                    </div>
                    <input id="room_no" name="room_no" type="number" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="max_pepole" class="control-label">عدد  الأشخاص</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-sort-numeric-asc"></i>
                    </div>
                    <input id="max_pepole" name="max_pepole" type="number" class="form-control">
                </div>
            </div>

            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary pull-left">اضافة</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
<?php include "inc/footer.php"; ?>
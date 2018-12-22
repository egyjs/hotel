<?php
$pageOption =
    array(
        'title' => "اضافة فندق",
        'sidebar' => true,
        'need_login' =>true
    );

    $err=array();
    if (isset($_POST['submit'])) {
        insert_into_table('hotels',[
            'name'=>$_POST['Hname'],
            'email'=>$_POST['Hemail'],
            'site'=>$_POST['Hsite'],
            'phone'=>$_POST['Hphone'],
            'location'=>$_POST['Hloc'],
            'address'=>$_POST['Hadrs'],
            'status'=>1,
            'country_code'=>$_POST['HCC'],
        ]);
        echo "<script> alert('تم التسجيل بنجاح'); window.location.href='/dash'; </script>";
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

        <form method="post">
            <div class="form-group">
                <label for="Hname" class="control-label">*اسم الفندق</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-home"></i>
                    </div>
                    <input id="Hname" name="Hname" type="text" class="form-control" required="required">
                </div>
            </div>
            <div class="form-group">
                <label for="Hsite" class="control-label">الموقع الإلكتروني</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-globe"></i>
                    </div>
                    <input id="Hsite" name="Hsite" type="url" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="Hemail" class="control-label">بريد الفندق الإلكتروني</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-envelope"></i>
                    </div>
                    <input id="Hemail" name="Hemail" type="email" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="Hphone" class="control-label">رقم الهاتف*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-phone"></i>
                    </div>
                    <input id="Hphone" name="Hphone" type="text" class="form-control">
                </div>
            </div>
            <div class="form-group">
                <label for="Hloc" class="control-label">الموقع(رابط الخريطة)*</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                    <input id="Hloc" name="Hloc" type="url" required class="form-control" placeholder="من خرائط جوجل .. مثال :https://goo.gl/maps/TPuhkFNVUER2 ">
                </div>
            </div>
            <div class="form-group">
                <label for="Hadrs" class="control-label">*العنوان نصاً</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                    <input id="Hadrs" name="Hadrs" required type="text" class="form-control" placeholder="ليبيا,سبها, شارع القارات">
                </div>
            </div>
            <div class="form-group">
                <label for="Hloc" class="control-label">الرقم البريدي</label>
                <div class="input-group">
                    <div class="input-group-addon">
                        <i class="fa fa-location-arrow"></i>
                    </div>
                    <input id="Hloc" name="HCC" type="text" class="form-control" placeholder="Country Code">
                </div>
            </div>
            <div class="form-group">
                <button name="submit" type="submit" class="btn btn-primary pull-left">اضافة</button>
            </div>
        </form>
    </div>
    <!-- /.container-fluid -->
<?php include "inc/footer.php"; ?>
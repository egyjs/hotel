<?php
$pageOption =
    array(
        'title' => 'تعديل الحساب',
        'sidebar' => true,
        'need_login' =>true
    );

$row = selectby(['id'=>User('id')],'users')[0];

if (isset($_POST['go'])){
    updateby([
            'full_name'=>$_POST['full_name'],
            'email'=>$_POST['email'],
            'phone'=>$_POST['phone'],
            'date_of_birth'=>$_POST['date_of_birth'],
    ],User('id'),'users');
    refresh();
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
        <div class="row">
            <div class="col-lg-12">
                <div class="panel panel-default">
                    <form class="panel-body" method="post">
                        <div class="form-group">
                            <label for="full_name" class="control-label">الاسم الكامل</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-user"></i>
                                </div>
                                <input id="full_name" name="full_name"
                                       value="<?= $row['full_name'] ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="email" class="control-label">البريد الإلكتروني</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-dollar"></i>
                                </div>
                                <input id="email" name="email"
                                       value="<?= $row['email'] ?>" type="email"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="phone" class="control-label">رقم الهاتف</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-phone"></i>
                                </div>
                                <input id="phone" name="phone"
                                       value="<?= $row['phone'] ?>" type="text"
                                       class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="date_of_birth" class="control-label">تاريخ الميلاد</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-birthday-cake"></i>
                                </div>
                                <input id="date_of_birth" name="date_of_birth"
                                       value="<?= $row['date_of_birth'] ?>" type="date"
                                       class="form-control">
                            </div>
                        </div>
                        <input type="submit" value="تحديث" name="go" class="btn btn-success pull-left btn-lg">
                    </form>
                    <!-- /.panel-body -->
                </div>
                <!-- /.panel -->
            </div>
            <!-- /.col-lg-12 -->
        </div>


    </div>
    <!-- /.container-fluid -->
<?php include "inc/footer.php"; ?>
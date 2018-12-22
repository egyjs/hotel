<?php
if (!is_login()){
    if (@$pageOption['need_login'] == true){
        to('/dash/login');
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>لوحة التحكم - <?= @$pageOption['title'] ?></title>


    <!-- Bootstrap Core CSS -->
    <link href="<?= $assets ?>/../vendor/css/rtl/bootstrap.min.css" rel="stylesheet">

    <!-- not use this in ltr -->
    <link href="<?= $assets ?>/../vendor/css/rtl/bootstrap.rtl.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="<?= $assets ?>/../vendor/css/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Timeline CSS -->
    <link href="<?= $assets ?>/../vendor/css/plugins/timeline.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="<?= $assets ?>/../vendor/css/rtl/sb-admin-2.css" rel="stylesheet">

    <!-- Morris Charts CSS -->
    <link href="<?= $assets ?>/../vendor/css/plugins/morris.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="<?= $assets ?>/../vendor/css/font-awesome/font-awesome.min.css" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style>
        .no-copy {
            -webkit-user-select: none;  /* Chrome all / Safari all */
            -moz-user-select: none;     /* Firefox all */
            -ms-user-select: none;      /* IE 10+ */
            user-select: none;          /* Likely future */
        }
        .badge{
            background-color: #f00 !important;
        }
    </style>
</head>

<body class="<?= @$pageOption['bgcolor'] ?>" id="page-top">

<div id="wrapper">

    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top  <?= (@$pageOption['auth'] == true) ? 'hidden':"" ?>" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="/dash">لوحة التحكم (<?= type(); ?>)</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-left">
            <?php if (User('type') == 0): ?>

            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <span class="badge "><?= (count(selectby(['unread'=>1],'notifications')) !=0)?count(selectby(['unread'=>1],'notifications')):'' ?></span> <i class="fa fa-bell"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <?php
                    foreach (select('notifications') as $not){
                        if ($not['type'] == 'bookings'){
                            $Ntyp= 'حجز';
                        }
                        $from = selectby(['id'=>$not['sender_id']],'users')[0]['full_name'];


                        echo '<li class="  '.($not['unread'] == 1 ?'active':'').'">';
                            echo '<a href="'.$not['type'].'?Nid='.$not['id'].'">';
                            echo 'هناك ';
                            echo "$Ntyp ";
                            echo 'من ';
                            echo "'$from'";
                            echo '</a></li>';
                    }
                    ?>
                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
            <?php endif; ?>
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <li><a href="#"><i class="fa fa-user fa-fw"></i> User Profile</a>
                    </li>
                    <li><a href="#"><i class="fa fa-gear fa-fw"></i> Settings</a>
                    </li>
                    <li class="divider"></li>
                    <li><a href="/logout"><i class="fa fa-sign-out fa-fw"></i> Logout</a>
                    </li>
                </ul>
                <!-- /.DropDown-notifications -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->
        <?php
        if (@$pageOption['sidebar'] == true){ ?>
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <li class="sidebar-search">
                        <div class="input-group custom-search-form">
                            <input type="text" class="form-control" placeholder="Search...">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                        </div>
                        <!-- /input-group -->
                    </li>
                    <li>
                        <a href="/dash"><i class="fa fa-dashboard fa-fw"></i> لوحة التحكم</a>
                    </li>
                    <?php if (User('type') == 0): ?>
                    <li>
                        <a href="#"><i class="fa fa-plus"></i> اضافة<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="addH">اضافة فندق</a>
                            </li>
                            <li>
                                <a href="addRoom">اضفة غرفة</a>
                            </li>
                        </ul>
                        <!-- /.nav-second-level -->
                    </li>
                    <li>
                        <a href="bookings"><i class="fa fa-plus"></i> الحجوزات <span class="badge"><?= (count(selectby(['status'=>0],'bookings')) != 0)?count(selectby(['status'=>0],'bookings')):'' ?></span></a>
                    </li>
                    <?php endif; ?>
                    <li >
                        <a href="#"><i class="fa fa-user"></i> حسابي</a>

                    </li>

                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
        <?php } ?>
    </nav>
    <!-- Page Content -->
    <div id="page-wrapper" style="<?= (@$pageOption['sidebar'] != true) ? "margin: 90px auto;":"" ?>">
        <div class="row">
            <div class="col-lg-12">
                <br>

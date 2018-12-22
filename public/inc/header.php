<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 12/11/18
 * Time: 11:22 PM
 */

?>
<!DOCTYPE html>
<html lang="ar">

<head>
    <meta name="description" content="Webpage description goes here" />
    <meta charset="utf-8">
    <title><?= $pageOption['title'] ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="">
    <link href="<?= $assets ?>/dist/css/boot.css" rel="stylesheet">
    <link href="<?= $assets ?>/dist/css/style.css" rel="stylesheet">


    <!-- not use this in ltr -->
    <link href="<?= $assets ?>/../vendor/css/rtl/bootstrap.rtl.css" rel="stylesheet">


    <link href="https://fonts.googleapis.com/css?family=Cairo|Tajawal" rel="stylesheet">
<style>
    body{
        font-family: 'Tajawal', sans-serif;
    }
    h1,h2,h3,h4,h5,h6{
        font-family: 'Cairo', sans-serif !important;
    }



</style>
    <!---->

    <!--    <link rel="stylesheet" href="--><?//= $assets ?><!--/css/screen.css">-->

</head>
<body>
<div class="navbar navbar-inverse ">
    <div class="container-fluid">
        <div class="navbar-header">
            <a href="/" class="navbar-brand">LOGO</a>
            <button class="navbar-toggle" type="button" data-toggle="collapse" data-target="#navbar-main">
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="navbar-collapse collapse" id="navbar-main">
            <ul class="nav navbar-nav">
                <li>
                    <a href="/">الرئيسية</a>
                </li>
                <li>
                    <a href="/search">بجث</a>
                </li>
                <li>
                    <?php if (!is_login()): ?>
                    <a href="/dash">دخول</a>
                    <?php else: ?>
                    <a href="/dash">حسابي (<?= User('full_name') ?>)</a>
                    <?php endif; ?>
                </li>
            </ul>

            <form class="navbar-form navbar-left" role="search" action="/search">
                <div class="form-group">
                    <input type="search" name="address" class="form-control" placeholder="المدينة">
                </div>
                <button type="submit" class="btn btn-default">بحث</button>
            </form>

        </div>
    </div>
</div>
<?php
/**
 * Created by PhpStorm.
 * User: el3zahaby
 * Date: 11/23/18
 * Time: 4:53 PM
 */

$pageOption =
    array(
        'title' => "الرئيسية",
        'need_login' =>false
    );

$result = mysqli_query($conn,
    "SELECT *
FROM hotels 
LEFT JOIN rooms
ON rooms.hotel_id = hotels.id
WHERE  hotels.status = 1 LIMIT 6;
");
?>
<!--<h1>Welcome home  --><?//= User("full_name"); ?><!--</h1>-->
<?php include "inc/header.php"?>
<div class="container-fluid">
    <div class="item shadow p-3 mb-5 bg-white rounded ">
        <div class=""
             style="background: url('https://www.batuta.com/media/1439976/%D9%81%D9%86%D8%A7%D8%AF%D9%82-%D8%A8%D9%8A%D8%B1%D9%88%D8%AA.jpg');background-size: cover;height: 450px;position: relative;">
            <div class="bg-transdark" style="position: absolute;left: 0;right: 0;bottom: 0;">
                <h2 class="text-right text-white">ابحث عن فندق</h2>
                <div class="container">
                    <form class="container" method="get" action="search">
                        <div class="row">
                            <div class="col-md-5"><input name="address" required type="text" class="form-control " placeholder="الدولة او الميدينة (الموقع)"></div>
                            <div class="col-md-5"><input name="person" required type="number" class="form-control " placeholder="عدد النزلاء"></div>
                            <div class="col-md-2"><input type="submit"  value="بحث" class="btn btn-block btn-success  "></div>
                        </div>



                    </form>
                </div>
            </div>
        </div>
    </div>


    <div class="item  p-3 mb-5 bg-white">
        <div class="container">
            <div class="row">
                <?php   if ($result->num_rows !== 0){
                while ($row = mysqli_fetch_array($result)){
                    ?>

                <div class="col-md-4 ">
                    <div class="thumbnail shadow">
                        <img src="<?= $row['pic'] ?>" alt="...">
                        <div class="caption">
                            <h4><?= $row['name'] ?></h4>
                            <blockquote class="small"><?= $row['address'] ?></blockquote>
                            <p><a href="search?address=<?= $row['address'] ?>&rid=<?= $row['id'] ?>" class="btn btn-primary" role="button">مزيد من التفاصل</a>

                        </div>
                    </div>
                </div>
                <?php }
                } ?>
            </div>
            </div>
        </div>
    </div>


</div>
<?php include "inc/footer.php"?>

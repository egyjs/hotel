<?php
$pageOption =
    array(
        'title' => "بحث",
        'need_login' =>false
    );
$adrs=  @$_GET['address'];
$prsn = @$_GET['person'];
$detalsid = @$_GET['rid'];
if (!isset($_GET['rid'])) {
    $result = mysqli_query($conn,
        "SELECT *
FROM hotels 
LEFT JOIN rooms
ON rooms.hotel_id = hotels.id
WHERE hotels.address LIKE '%{$adrs}%'
AND rooms.max_pepole >= '{$prsn}%' 
AND hotels.status = 1
ORDER BY `rooms`.`max_pepole` ASC LIMIT 15;
");
}else{
    $result = mysqli_query($conn,
        "SELECT *
FROM hotels 
LEFT JOIN rooms
ON rooms.hotel_id = hotels.id
WHERE hotels.address LIKE '%{$adrs}%'
AND rooms.id = '{$detalsid}%' 
AND hotels.status = 1
ORDER BY `rooms`.`max_pepole` ASC LIMIT 15;
");
}
?>
<!--<h1>Welcome home  --><?//= User("full_name"); ?><!--</h1>-->
<?php include "inc/header.php"?>
<div class="container-fluid">
    <div class="item shadow p-3 mb-5 bg-white rounded ">
        <div>
            <?php
            if ($result->num_rows !== 0){  ?>
                <h2>بحث عن فنادق في : <b><?= @$_GET['address'] ?></b></h2>
                <div class="table-responsive">
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead>
                        <tr>
                            <th>اسم الفندق</th>
                            <th>العنوان</th>
                            <th>رقم الغرفة</th>
                            <th>العدد الأقصى للنزلاء</th>
                            <th>الذهاب إلى هناك</th>
                            <th>السعر لليلة الواحدة</th>
                            <th>رؤية</th>
                            <th>حجز</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php while ($row = mysqli_fetch_array($result)){  ?>
                            <tr class="odd gradeX">
                                <td><a href="#hotel?id=<?= $row['hotel_id'] ?>"><?= $row['name'] ?></a></td>
                                <td><?= $row['address']?></td>
                                <td><?= $row['room_no']?></td>
                                <td><?= $row['max_pepole']?></td>
                                <td><a class="btn btn-success" target="_blank" href="<?= $row['location']?>">على خرائط جوجل</a></td>
                                <td><?= $row['price']?> دينار ليبي</td>
                                <td><img src="/<?= $row['pic'] ?>" width="300px"> </td>
                                <td>
                                    <a href="reservation?roomid=<?= $row['id']?>"  class="btn btn-lg btn-primary">حجز الغرفة</a>
                                </td>
                            </tr>
                        <? } ?>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            <?php }else{ ?>
                <h2>
                    لا يوجد تطابق للبحث في موقعنا !
                </h2>
                <h3> جرب البحث مره اخرى :</h3>
                <div class="container">
                    <form class="row" method="get" action="search">
                        <input name="address" required type="text" class="form-control col-md-5" placeholder="الدولة او الميدينة (الموقع)">
                        <input name="person" required type="number" class="form-control col-md-5" placeholder="عدد النزلاء">
                        <input type="submit" value="بحث" class="btn btn-success col-md-2">
                    </form>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"?>

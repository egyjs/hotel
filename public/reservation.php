<?php
$pageOption =
    array(
        'title' => "حجز ",
        'need_login' => true,
    );
if (@$pageOption['need_login'] ){
    if (!is_login()){
        to('/dash/login?goto='.$_SERVER['REQUEST_URI']);
    }
}

if (isset($_POST['sub'])){
    $amount = (selectby(['id'=>$_POST['roomid']],'rooms')[0]['price']) * $_POST['night'];
    if (count(selectby(['user_id'=>User('id'),'room_id'=>$_POST['roomid'],'status'=>0],'bookings')) ==0){
        if (insert_into_table('bookings',['user_id'=>User('id'),'room_id'=>$_POST['roomid'],'amount'=>$amount])){
            $booking_id = @end(selectby(['room_id'=>$_POST['roomid'],'amount'=>$amount],'bookings'))['id'];
            make_notification(User('id'),'bookings',$booking_id);

//
//
//    //------------ to renter --------------//
//    $mail = new PHPMailer;
//    dd($mail);
//    $mail->isSMTP();                            // Set mailer to use SMTP
//    $mail->Host = 'smtp.gmail.com';              // Specify main and backup SMTP servers
//    $mail->SMTPAuth = true;                     // Enable SMTP authentication
//    $mail->Username = 'example@gmail.com'; // your email id
//    $mail->Password = 'password'; // your password
//    $mail->SMTPSecure = 'tls';
//    $mail->Port = 587;     //587 is used for Outgoing Mail (SMTP) Server.
//    $mail->setFrom('sendfrom@gmail.com', 'Name');
//    $mail->addAddress('sendto@yahoo.com');   // Add a recipient
//    $mail->isHTML(true);  // Set email format to HTML
//
//    $bodyContent = '<h1>HeY!,</h1>';
//    $bodyContent .= '<p>This is a email that Radhika send you From LocalHost using PHPMailer</p>';
//    $mail->Subject = 'Email from Localhost by Radhika';
//    $mail->Body    = $bodyContent;
//    if(!$mail->send()) {
//        echo 'Message was not sent.';
//        echo 'Mailer error: ' . $mail->ErrorInfo;
//    } else {
//        echo 'Message has been sent.';
//    }
//
//
//        $adminEmail = selectby(['type'=>0],'users')[0]['email'];
//        $to      = User('email');
//        $subject = 'تم استلام طلبكم وسيتم الرد عليكم في اقرب وقت ممكن';
//        $message = 'hello';
//        $headers = 'From: '.$adminEmail . "\r\n" .
//            'Reply-To: '.$adminEmail . "\r\n" .
//            'X-Mailer: PHP/' . phpversion();
//
//        mail($to, $subject, $message, $headers);

            $msg="تم ارسال حجزك بنجاح وهو قيد المراجعه , ستصلك رساله للتأكيد انك ارسلت الحجز";
        }
    }else{
        $msg = 'لقد تم ارسال طلب حجز بالفعل .. نرجو الانتظار للرد عليك برساله';
    }




}

?>
<?php include "inc/header.php"?>

<?php if (isset($msg)): ?>
<div class="container">
    <div class="alert alert-warning">
        <strong>!</strong><?= $msg ?>.
    </div>
</div>
<?php endif; ?>
<form method="post" class="container  form-inline">
    <input type="hidden" hidden value="<?= $_GET['roomid'] ?>" name="roomid">
    <label>عدد الليالي المراد حجزها :</label>
    <input required class="form-control" min="1" name="night" type="number">
    <input type="submit" class="btn btn-success" value="حـــــــــــــجــــــــــــز" name="sub">
</form>


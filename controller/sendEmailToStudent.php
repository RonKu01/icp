<?php
use PHPMailer\PHPMailer\PHPMailer;

if(isset($_POST['name']) && isset($_POST['sender_email']) && isset($_POST['recipient_email'])){
    $name = $_POST['name'];
    $sender_email = $_POST['sender_email'];
    $recipient_email = $_POST['recipient_email'];
    $subject = $_POST['subject'];
    $body = $_POST['body'];

    require_once "../PHPMailer/PHPMailer.php";
    require_once "../PHPMailer/SMTP.php";
    require_once "../PHPMailer/Exception.php";

    $mail = new PHPMailer();

    //smtp settings
    $mail->isSMTP();
    $mail->Host = "smtp.gmail.com";
    $mail->SMTPAuth = true;
    $mail->Username = "icplecturer@gmail.com";
    $mail->Password = 'icplecturer123';
    $mail->Port = 465;
    $mail->SMTPSecure = "ssl";

    //email settings
    $mail->isHTML(true);
    $mail->setFrom($sender_email, $name);
    $mail->addAddress("$recipient_email");
    $mail->Subject = ("$subject");
    $mail->Body = $body;

    if($mail->send()){
        $status = "success";
        $response = "Email is sent!";
    }
    else
    {
        $status = "failed";
        $response = "Something is wrong: <br>" . $mail->ErrorInfo;
    }
    exit(json_encode(array("status" => $status, "response" => $response)));
}

?>

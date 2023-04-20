<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';
$mail = new PHPMailer(true);
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Email sending using PHPMAILER and Hosting SMTP </title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>

<body>
    <div class="container">
        <?php
        if (isset($_POST['submit_form'])) {
            $to = $_POST['to'];
            $subject = $_POST['subject'];
            $msg = $_POST['msg'];
            $name = $_POST['name'];

            try {
                //Server settings
                //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'mail.padandas.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'noreply@padandas.com';                     //SMTP username
                $mail->Password   = '(password)';                               //SMTP password
                $mail->SMTPSecure = 'TLS';            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`


                $mail->setFrom('noreply@padandas.com', 'Padandas Noreply');

                //for multiple emails
                // $toarray=explode(",",$to);
                // foreach($toarray as $row)
                // {
                //      $mail->addAddress($row); 
                // }
                //for single email 
                $mail->addAddress($to, $name);     //Add a recipient              //Name is optional

                $mail->addReplyTo('noreply@padandas.com', 'Padandas no-reply');
                //$mail->addCC('cc@example.com');
                //$mail->addBCC('bcc@example.com');

                //Attachments
                //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
                //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = $subject;
                $mail->Body    = $msg;
                //$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                echo '<div class="success ">Message has been sent</div>';
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
        ?>
        <h2>Email sending by PHPMailer(Hosting SMTP) &#9971;</h2>
        <form action="" method="POST">
            <label> To Email :-</label>
            <input type="text" name="to" class="form-control" required>
            <label> Name :-</label>
            <input type="text" name="name" class="form-control">

            <label>Subject :-</label>
            <input type="subject" name="subject" class="form-control" required>

            <label> Message Body :-</label>
            <textarea name="msg" cols="10" rows="5" class="form-control" required></textarea>
            <br>
            <input type="submit" name="submit_form" value="Send" class="btn-primary">
        </form>
    </div>
</body>

</html>
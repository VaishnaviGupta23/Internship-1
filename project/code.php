<?php
session_start();
include('dbcon.php');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';


//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\Exception;

//include('plugins/PHPMailer/src/Exception.php');
//include('plugins/PHPMailer/src/PHPMailer.php');
//include('plugins/PHPMailer/src/SMTP.php');

//require 'plugins/PHPMailer/src/Exception.php';
//require 'plugins/PHPMailer/src/PHPMailer.php';
//require 'plugins/PHPMailer/src/SMTP.php';
function sendemail_verify($name,$email,$verify_token)
{
    $mail = new PHPMailer(true);
    $mail->isSMTP();
    $mail->SMTPAuth=true;

    $mail->Host ='smtp.gmail.com';
    $mail->Username="vaishnavii.gupta23@gmail.com";
    $mail->Password="Harshabc@123";

    $mail->SMTPSecure="tls";
    $mail->Port='587';

    $mail->setFrom("vaishnavii.gupta23@gmail.com",$name);
    $mail->addAddress($email);

    $mail->isHTML(true);
    $mail->Subject="Email verification";

    $email_template="
        <h2>You have registered with Careerty Informatics</h2>
        <h5>Verify your email address to login with the below given link</h5>
        <a href='http://localhost/proj/verify-email.php?token=$verify_token'>Click Me</a>
    ";

    $mail->Body=$email_template;
    $mail->send();
    //echo'msg sent!';


}


if(isset($_POST['submit']))
{
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $verify_token=md5(rand());

    sendemail_verify("$name","$email","$verify_token");
    echo "sent or not?";
    
    
    // //email exists or not
    // $check_email_query="SELECT email FROM register WHERE email='$email' LIMIT 1";
    // $check_email_query_run=mysqli_query($con,$check_email_query);

    // if(mysqli_num_rows($check_email_query_run)>0)
    // {
    //     $_SESSION['status']="Email id already exists";
    //     header("Location: register.php");
    // }
    // else{
    //     //insert user/registered user data
    //     $query="INSERT INTO register (username,password,email,verify_token) VALUES('$username','$password','$email','$verify_token')";
    //     $query_run=mysqli_query($con,$query);

    //     if($query_run)
    //     {
    //         sendemail_verify("$username","$email","$verify_token");

    //         $_SESSION['status']="Registration successful! Please verify your email";
    //         header("Location: register.php");
    //     }
    //     else
    //     {
    //         $_SESSION['status']="Registration failed";
    //         header("Location: register.php");
    //     }
    // }
 }
 ?>
<?php
include("./config.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\Users\ankit\vendor\phpmailer\phpmailer\src\Exception.php';
require 'C:\Users\ankit\vendor\phpmailer\phpmailer\src\PHPMailer.php';
require 'C:\Users\ankit\vendor\phpmailer\phpmailer\src\SMTP.php';

$n = 10;
function getRandomString($n)
{
  $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
  $randomString = '';

  for ($i = 0; $i < $n; $i++) {
    $index = rand(0, strlen($characters) - 1);
    $randomString .= $characters[$index];
  }

  return $randomString;
}

if (isset($_POST["submit_email"])) {
    $email = $_POST["email"];
    $category = $_POST["category"];

    if ($category == "student") {
        $find_user = "SELECT * FROM students WHERE email = '$email' and active = '1'";
        $category='student';
        $p= getRandomString($n);
        $password = sha1($p);

        $update_profile = "UPDATE 
            students 
            SET password = '$password' 
            WHERE email = '$email' 
            ";
            $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));

    } else if($category == "teacher"){
        $find_user = "SELECT * FROM teachers WHERE email = '$email' and active = '1'";
        $category='teacher';
        $p= getRandomString($n);
        $password = sha1($p);

        $update_profile = "UPDATE 
            teachers 
            SET password = '$password' 
            WHERE email = '$email'
        ";
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));

    }else{
        $find_user = "SELECT * FROM miscellaneous WHERE email = '$email' and active = '1'";
        $category='miscellaneous';
        $p= getRandomString($n);
        $password = sha1($p);

        $update_profile = "UPDATE 
            teachers 
            SET password = '$password' 
            WHERE email = '$email'
        ";
        $response = mysqli_query($conn, $update_profile) or die(mysqli_error($conn));

    }

    $response = mysqli_query($conn, $find_user) or die(mysqli_error($conn));
    if (mysqli_num_rows($response) == 1) {
        $user_details = mysqli_fetch_array($response, MYSQLI_ASSOC);

        
          $email=($user_details['email']);
          $pass=($user_details['password']);
          $name = ($user_details['name']);

          $_SESSION["user_email"] = $user_details["email"];
          $_SESSION["user_category"] = $category;

        // $link="<a href='www.samplewebsite.com/reset_pass.php?key=".$email."&reset=".$pass."'>Click To Reset password</a>";
            // require_once('PHPMailer\src\PHPMailerAutoload.php');
            $mail = new PHPMailer(true);
            // $mail = new mail();
            $mail->isSMTP();
            $mail->Host = 'sandbox.smtp.mailtrap.io';
            $mail->SMTPAuth = true;
            $mail->Port = 2525;
            $mail->Username = '1940e8*****';
            $mail->Password = '****';
            $mail->FromName='Admin';
            $mail->AddAddress($email, $name);
            $mail->Subject  =  'Reset Password';
            $mail->IsHTML(true);
            $mail->Body    = 'Use this OTP for login: '.$p.'';
            if($mail->Send())
            {
            echo "Check Your Email and Click on the link sent to your email";
            }
            else
            {
            echo "Mail Error - >".$mail->ErrorInfo;
            }
  }	
}
?>

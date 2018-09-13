<?php
require("class.phpmailer.php");
$errorMSG = "";

// NAME
if (empty($_POST["name"])) {
    $errorMSG .= "Name is required ";
} else {
    $name = $_POST["name"];
}

// EMAIL
if (empty($_POST["email"])) {
    $errorMSG .= "Email is required ";
} else {
    $email = $_POST["email"];
}

// MESSAGE
if (empty($_POST["message"])) {
    $errorMSG .= "Message is required ";
} else {
    $message = $_POST["message"];
}


// prepare email body text
$MsgContent = "";
$MsgContent .= "Name: ";
$MsgContent .= $name;
$MsgContent .= "<br> \n";
$MsgContent .= "Email: ";
$MsgContent .= $email;
$MsgContent .= "<br> \n";
$MsgContent .= "Message: ";
$MsgContent .= $message;
$MsgContent .= "<br> \n";


$mail = new PHPMailer();
$mail->IsSMTP();
//$mail->SMTPDebug = 4; 
//$mail->Debugoutput = 'html';
$mail->SMTPAuth = true;
$mail->SMTPSecure = 'tls'; 
$mail->Host = "smtp.gmail.com"; 
$mail->Port = 587; 
$mail->IsHTML(true);
$mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true)); // SMTP Config
$mail->SetLanguage("tr", "phpmailer/language");
$mail->CharSet  ="utf-8";
$mail->Username = "email.address@emaildomain.com"; 
$mail->Password = "Password"; 
$mail->SetFrom("email.address@emaildomain.com", "Name Here"); 
$mail->Subject = "Subject"; 
$mail->Body = $MsgContent ; 
$mail->AddAddress("email.address@emaildomain.com", "Name Here"); // Where to send it - Recipient
$success = $mail->Send();


if ($success && $errorMSG == ""){
   echo "success";
}else{
    if($errorMSG == ""){
        echo "Something went wrong :(";
    } else {
        echo $errorMSG . "<br> Mailer Error: " . $mail->ErrorInfo;
    }
}

?>

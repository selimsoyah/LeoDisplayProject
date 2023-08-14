<?php

session_start();
require '../server/includes/PHPMailer.php';
require '../server/includes/SMTP.php';
require '../server/includes/Exception.php';
require_once '../server/vendor/autoload.php';
// Define namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load the environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if (isset($_POST['send_email'])) {
    // File upload handling
    if (isset($_FILES['upload-bat']) && $_FILES['upload-bat']['error'] === UPLOAD_ERR_OK) {
        $file = $_FILES['upload-bat']['tmp_name'];
        $fileName = $_FILES['upload-bat']['name'];
        $mail = new PHPMailer();
        $mail->IsSMTP();
        $mail->SMTPAuth = true;
        $mail->SMTPSecure = "tls";
        $mail->Host = $_ENV['host'];
        $mail->Port = $_ENV['port'];
        $mail->Username = $_ENV['email'];       // your email address
        $mail->Password = $_ENV['key'];         // your 16 digits app password
        $mail->FromName = "Tech Area";
        $mail->setFrom($_ENV['email']);
        $mail->AddAddress('soyahselim@gmail.com');
        // $mail->AddAddress('amineboussetta006@gmail.com');
        // $mail->AddAddress('lachkar.ali.100@gmail.com');
        $mail->Subject = "Enquiry";
        $mail->isHTML(TRUE);
        
        // Construct the email body
        $body = "<h1>BAT</h1>";
        $body .= "<p>This is your BAT file:</p>";
        $body .= "<p>File Name: " . $fileName . "</p>";
        
        // Add a button to the email
        $body .= "<button onclick='simulateClick()'>Click to Change Variable</button>";
        
        $mail->Body = $body;
        $mail->addAttachment($file, $fileName);
        
        if ($mail->send()) {
            $success = "Email sent successfully";
        } else {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        
        // header('location:index.php');
    } else {
        echo "Error uploading file";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Email Page</title>
    <script>
        function simulateClick() {
            alert("Button clicked! Simulated interaction.");
        }
    </script>
</head>
<body>
    <!-- Your HTML content -->
</body>
</html>

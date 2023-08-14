<?php

session_start();
require 'includes/PHPMailer.php';
require 'includes/SMTP.php';
require 'includes/Exception.php';
require_once 'vendor/autoload.php';
//Define name spaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

// Load the environment variables from .env file
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

//Create an instance; passing `true` enables exceptions
// $mail = new PHPMailer(true);
include('connection.php');
$order_date = date('Y-m-d H:i:s');

$user_id = $_SESSION['user_id'];

$stmt8 = $conn->prepare("SELECT * FROM users WHERE user_id=? LIMIT 1");
$stmt8->bind_param('i', $user_id);
$stmt8->execute();
$checkout_details = $stmt8->get_result();

while ($row = $checkout_details->fetch_assoc()) {
    // Access the columns using the column names
    $user_id = $row['user_id'];
    $username = $row['user_name'];
    $user_email = $row['user_email'];

    // Display the retrieved data

}

echo "<pre>";
print_r($username); // or var_dump($checkout_details);
echo "</pre>";
echo "Error: " . $stmt8->error;
$stmt8->close();
if (isset($_POST['place_order'])) {

    // $name = $_POST['name'];
    // $email = $_POST['email'];
    $phone = 654654654;
    $city = $user_email;
    $address = $user_email;
    $order_cost = 8777;
  



    $stmt = $conn->prepare("INSERT INTO orders (order_cost,user_id,user_phone,user_city,user_address,order_date)
                            VALUES (?,?,?,?,?,?) ");

    $stmt->bind_param('iiisss', $order_cost, $user_id, $phone, $city, $address, $order_date);

    $stmt->execute();


    //2. issue new order and store order info in database
    $order_id = $stmt->insert_id;


    //3. get product from cart (from session)

    foreach ($_SESSION['cart'] as $key => $value) {

        $product = $_SESSION['cart'][$key];
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        // $product_quantity = $product['product_quantity'];
        $option1 = $product['option1'];
        $option2 = $product['option2'];
        $option3 = $product['option3'];
        $option4 = $product['option4'];
        $option5 = $product['option5'];
        $quantity_1 = $product['quantity_1'];
        $quantity_2 = $product['quantity_2'];
        $quantity_3 = $product['quantity_3'];
        $quantity_5 = $product['quantity_5'];
        $order_date = date('Y-m-d H:i:s');
        $order_status = "on_hold";
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id,order_status,product_name, product_image,order_date,product_price,option1,option2,option3,option4,option5,quantity_1,quantity_2,quantity_3,quantity_5)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt1->bind_param('iiissssssssbiiiii', $order_id, $product_id,  $user_id,$order_status ,$product_name, $product_image, $order_date, $product_price, $option1, $option2, $option3, $option4, $option5, $quantity_1, $quantity_2, $quantity_3, $quantity_5);
        $stmt1->send_long_data(11, $option4);
        $stmt1->execute();
        // array_splice($_SESSION['cart'], 0);
      
        $success = "Feedback submitted successfully";
        header('location:../account.php');
    }

    //5. remove everything from cart

    //unset($_SESSION['cart']);
    // Get the form data
    $email = $_ENV['email'];
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
    $mail->AddAddress($user_email);
    $mail->AddAddress('amineboussetta006@gmail.com');
    $mail->AddAddress('lachkar.ali.100@gmail.com');
    $mail->Subject = "Enquiry";
    $mail->isHTML(TRUE);
    
    // Construct the email body
    $body = "<h1>Commande accepté</h1>";
    $body .= "<p> Votre commande de : </p>";
    foreach ($_SESSION['cart'] as $key => $product) {
        $product_id = $product['product_id'];
        $product_name = $product['product_name'];
        $product_image = $product['product_image'];
        $product_price = $product['product_price'];
        $product_quantity = $product['product_quantity'];
        $option1 = $product['option1'];
        $option2 = $product['option2'];
        $option3 = $product['option3'];
        $option4 = $product['option4'];
        $option5 = $product['option5'];
        $quantity_1 = $product['quantity_1'];
        $quantity_2 = $product['quantity_2'];
        $quantity_3 = $product['quantity_3'];
        $quantity_5 = $product['quantity_5'];
        $order_date = date('Y-m-d H:i:s');
    
        // Check if any options or quantities are not null
        if (!empty($option2) && !empty($quantity_2)) {
            $body .= "<p> <b>$option1 $option2 </b> x <b>$quantity_2</b></p>";
        }
        if (!empty($option3) && !empty($quantity_3)) {
            $body .= "<p> <b>$option3 </b> x <b>$quantity_3</b></p>";
        }
        if (!empty($option5) && !empty($quantity_5)) {
            if($option5 == 1){
                $body .= "<p> <b> Avec Bare Metalique </b> x <b>$quantity_5</b></p>";
            }
           
        }
    }
    $body .= "<p> A été accepté avec succés . Un email vous sera envoyé dés que la commande sera completé</p>";
    $mail->Body = $body;
    
    if ($mail->send()) {
        array_splice($_SESSION['cart'], 0);
        $_SESSION['total'] = 0;
        $_SESSION['quantity'] = 0;
    } else {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }

}



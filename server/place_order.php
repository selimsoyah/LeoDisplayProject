<?php

session_start();
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
// require 'vendor/autoload.php';

//Create an instance; passing `true` enables exceptions
$mail = new PHPMailer(true);


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
    $email = $row['user_email'];

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
    $city = $email;
    $address = $email;
    $order_cost = 8777;
    $order_status = "on_hold";



    $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                            VALUES (?,?,?,?,?,?,?) ");

    $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

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


        // if (($product_id == 3 || $product_id == 1) && empty($option3)){
        //     //4. store each single item in order_items database

        //         $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image,order_date,product_price,option1,option2,option4,quantity_1,quantity_2)
        //         VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        //         $stmt1->bind_param('iiissssssbii', $order_id, $product_id,  $user_id, $product_name, $product_image,$order_date, $product_price,$option1,$option2,$option4,$quantity_1,$quantity_2 );
        //         $stmt1->send_long_data(9, $option4);
        //         $stmt1->execute();
        //         // array_splice($_SESSION['cart'], 0);
        //         header('location:../account.php');
        // }else if (($product_id == 3 || $product_id == 1)){
        //                 //4. store each single item in order_items database
        //                 $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image, order_date, product_price, product_quantity, option1, option2, option3, option4)
        //                 VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        //                 $stmt1->bind_param('iiisssissssb', $order_id, $product_id, $user_id, $product_name, $product_image, $order_date, $product_price, $product_quantity, $option1, $option2, $option3, $option4);

        //                 $stmt1->send_long_data(11, $option4);

        //                 $stmt1->execute();

        //                 // $stmt1->execute();
        //                 // array_splice($_SESSION['cart'], 0);
        //                 header('location:../account.php');
        // }else if ($product_id == 2 && empty($option2) && empty($option3)){
        //                        //4. store each single item in order_items database

        //                        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image,order_date,product_price, product_quantity,option1,option4)
        //                        VALUES (?,?,?,?,?,?,?,?,?,?)");

        //                        $stmt1->bind_param('iiisssissb', $order_id, $product_id,  $user_id, $product_name, $product_image,$order_date, $product_price, $product_quantity,$option1,$option4 );
        //                        $stmt1->send_long_data(9, $option4);
        //                        $stmt1->execute();
        //                     //    array_splice($_SESSION['cart'], 0);
        //                        header('location:../account.php');
        // }


        // $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image,order_date,product_price,option1,option2,option4,quantity_1,quantity_2)
        // VALUES (?,?,?,?,?,?,?,?,?,?,?,?)");

        // $stmt1->bind_param('iiissssssbii', $order_id, $product_id,  $user_id, $product_name, $product_image,$order_date, $product_price,$option1,$option2,$option4,$quantity_1,$quantity_2 );
        // $stmt1->send_long_data(9, $option4);
        // $stmt1->execute();
        // // array_splice($_SESSION['cart'], 0);
        // header('location:../account.php');
        $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image,order_date,product_price,option1,option2,option3,option4,option5,quantity_1,quantity_2,quantity_3,quantity_5)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

        $stmt1->bind_param('iiisssssssbiiiii', $order_id, $product_id,  $user_id, $product_name, $product_image, $order_date, $product_price, $option1, $option2, $option3, $option4, $option5, $quantity_1, $quantity_2, $quantity_3, $quantity_5);
        $stmt1->send_long_data(10, $option4);
        $stmt1->execute();
        // array_splice($_SESSION['cart'], 0);
        header('location:../account.php');
    }

    array_splice($_SESSION['cart'], 0);
    $_SESSION['total'] = 0;
    $_SESSION['quantity'] = 0;

    //5. remove everything from cart

    //unset($_SESSION['cart']);
      // Get the form data



}

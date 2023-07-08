<?php

session_start();


include('connection.php');
   $order_date = date('Y-m-d H:i:s');
if(isset($_POST['place_order'])){

    //1. get user info and store it in database

        $name = $_POST['name'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $city = $_POST['city'];
        $address = $_POST['address'];
        $order_cost = $_SESSION['total'];
        $order_status = "on_hold";
        $user_id = $_SESSION['user_id'];
     

        $stmt = $conn->prepare("INSERT INTO orders (order_cost,order_status,user_id,user_phone,user_city,user_address,order_date)
                            VALUES (?,?,?,?,?,?,?) ");
        
        $stmt->bind_param('isiisss', $order_cost, $order_status, $user_id, $phone, $city, $address, $order_date);

        $stmt->execute();


    //2. issue new order and store order info in database
        $order_id = $stmt->insert_id;


    //3. get product from cart (from session)
        
        foreach($_SESSION['cart'] as $key => $value){

            $product = $_SESSION['cart'][$key];
            $product_id = $product['product_id'];
            $product_name = $product['product_name'];
            $product_image = $product['product_image'];
            $product_price = $product['product_price'];
            $product_quantity = $product['product_quantity'];
            $option1 = $product['option1'];
            $option2 = $product['option2'];
            $option3 = $product['option3'];
            $option4 = $product['option4'];
            $quantity_1 = $product['quantity_1'];
            $quantity_2 = $product['quantity_2'];
            $quantity_3 = $product['quantity_3'];
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
                    $stmt1 = $conn->prepare("INSERT INTO order_items (order_id, product_id, user_id, product_name, product_image,order_date,product_price,option1,option2,option3,option4,quantity_1,quantity_2,quantity_3)
                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?)");

                    $stmt1->bind_param('iiisssssssbiii', $order_id, $product_id,  $user_id, $product_name, $product_image,$order_date, $product_price,$option1,$option2,$option3,$option4,$quantity_1,$quantity_2,$quantity_3 );
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


    //6. inform user whether everything is fine or there is a problem


}











?>
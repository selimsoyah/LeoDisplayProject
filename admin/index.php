<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }

?>

<?php
    
    //1 determine page no
    if(isset($_GET['page_no']) && $_GET['page_no'] != ""){
        //if user has already entered the page then page number is the one that they selected
        $page_no = $_GET['page_no'];
    }else{
        //if user just entered the page then default page is 1
        $page_no = 1;
    }

    //2 return number of products
    $stmt1 = $conn->prepare("SELECT COUNT(*) AS total_records FROM orders");
    $stmt1->execute();
    $stmt1->bind_result($total_records);
    $stmt1->store_result();
    $stmt1->fetch();

    //3 products per page
    $total_records_per_page = 10;

    $offset = ($page_no - 1) * $total_records_per_page;

    $previous_page = $page_no - 1;
    $next_page = $page_no + 1;

    $adjacents = "2";

    $total_no_of_pages = ceil($total_records/$total_records_per_page);

    //4 get all products

    $stmt2 = $conn->prepare("SELECT orders.*, users.user_name, order_items.option1, order_items.option2 FROM orders JOIN users ON orders.user_id = users.user_id JOIN order_items ON orders.order_id = order_items.order_id ORDER BY order_date DESC LIMIT $offset, $total_records_per_page");
    $stmt2->execute();
    $orders = $stmt2->get_result();


    // Group orders by order date
    $grouped_orders = [];
    while ($order = $orders->fetch_assoc()) {
        $order_date = date('d-m-Y', strtotime($order['order_date']));
        $grouped_orders[$order_date][] = $order;
    }


    if (isset($_POST['edit_order_status_btn'])) {
        $order_id = $_POST['order_id'];
        $order_status = $_POST['order_status'];

        // Modify the order status based on the current status
        if ($order_status == 'on_hold') {
            $new_status = 'delivered';
        } else {
            $new_status = 'on_hold';
        }

        $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
        $stmt->bind_param('si', $new_status, $order_id);

        if ($stmt->execute()) {
            header('Location: index.php?order_updated=Order status has been updated successfully');
            exit;
        } else {
            header('Location: index.php?order_failed=Error occurred, try again');
            exit;
        }
    }

    if (isset($_POST['delete_order_btn'])) {
        $order_id = $_POST['order_id'];

        $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
        $stmt->bind_param('i', $order_id);

        if ($stmt->execute()) {
            header('Location: index.php?order_deleted=Order has been deleted successfully');
            exit;
        } else {
            header('Location: index.php?delete_failed=Error occurred while deleting the order');
            exit;
        }
    }


?>




<div class="container-fluid">
    <div class="row">


        <?php include('sidemenu.php'); ?>
        
        <main class="col-md-9 ms_sm_auto col_lg-10 px_md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>

            <h2>Orders</h2>



            <?php if(isset($_GET['order_updated'])){?>
                <p class="text-center" style="color:green;"> <?php echo $_GET['order_updated'] ?> </p>
                <?php } ?>

                <?php if(isset($_GET['order_failed'])){?>
                <p class="text-center" style="color:red;"> <?php echo $_GET['order_failed'] ?> </p>
                <?php } ?>


            <div class="table-responsive">
                <?php foreach ($grouped_orders as $order_date => $orders) { ?>
                <h3><?php echo $order_date; ?></h3>
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th scope="col">Produit</th>
                            <th scope="col">Status</th>
                            <th scope="col">Username</th>
                            <th scope="col">User Phone</th>
                            <th scope="col">User Address</th>
                            <th scope="col">Taille</th>
                            <th scope="col">Type</th>
                            <th scope="col">Quantite</th>
                            <th scope="col">Image</th>
                            <th scope="col">Status</th>
                            <th scope="col">Delete</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach($orders as $order){ ?>
                        <tr>
                            
                                            <?php
                    // Retrieve product_id from order_items
                    $stmt = $conn->prepare("SELECT product_id FROM order_items WHERE order_id = ?");
                    $stmt->bind_param('i', $order['order_id']);
                    $stmt->execute();
                    $stmt->bind_result($product_id);
                    $stmt->fetch();
                    $stmt->close();

                    // Retrieve product image from products
                    $stmt2 = $conn->prepare("SELECT product_image FROM products WHERE product_id = ?");
                    $stmt2->bind_param('i', $product_id);
                    $stmt2->execute();
                    $stmt2->bind_result($product_image);
                    $stmt2->fetch();
                    $stmt2->close();

                    // Display the product image
                    ?>
                    <td>
                        <img src="<?php echo $product_image; ?>" alt="Product Image" width="100">
                    </td>

                            <td><?php echo $order['order_status']; ?></td>
                            <td><?php echo $order['user_name']; ?></td>
                            <td><?php echo $order['user_phone']; ?></td>
                            <td><?php echo $order['user_address']; ?></td>
                            <td><?php echo $order['option2']; ?></td>
                            <td><?php echo $order['option1']; ?></td>
                            <td>quantity</td>
                            <td>image</td>
                            
                            
                            <!-- <td><a class="btn btn-primary" href="edit_order.php?order_id=<?php echo $order['order_id']; ?>">Edit</a></td> -->
                       
                            <td>
                                <form action="index.php" method="POST">
                                    <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                    <input type="hidden" name="order_status" value="<?php echo $order['order_status']; ?>">
                                    <button class="btn btn-primary" type="submit" name="edit_order_status_btn">
                                        <?php echo ($order['order_status'] == 'on_hold') ? 'On Hold' : 'Delivered'; ?>
                                    </button>
                                </form>
                            
                            </td>

                            <?php if (isset($_GET['order_deleted'])) { ?>
    <p class="text-center" style="color: green;"><?php echo $_GET['order_deleted']; ?></p>
<?php } ?>

<?php if (isset($_GET['delete_failed'])) { ?>
    <p class="text-center" style="color: red;"><?php echo $_GET['delete_failed']; ?></p>
<?php } ?>


                            <td>
    <form action="index.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this order?');">
        <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
        <button class="btn btn-danger" type="submit" name="delete_order_btn">Delete</button>
    </form>
</td>

                            
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
                <?php } ?>











                <!-- pagination -->
                <nav aria-label="Page navigation example" class="mx-auto">
                    <ul class="pagination mt-5 mx-auto">

                        <li class="page-item <?php if($page_no <= 1){echo 'disabled';}?> ">
                            <a href="<?php if($page_no <= 1){echo '#';}else{echo "?page_no=".($page_no-1);} ?>" class="page-link">Previous</a>
                        </li>

                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                        <?php if($page_no >= 3){ ?>
                        <li class="page-item"><a class="page-link" href="">...</a></li>
                        <li class="page-item"><a class="page-link" href="<?php echo "?page_no=".$page_no; ?>"><?php echo $page_no; ?></a></li>

                        <?php } ?>

                        <li class="page-item <?php if($page_no >= $total_no_of_pages){echo'disabled';}?>">
                            <a class="page-link" href=" <?php if($page_no >= $total_no_of_pages){echo '#';}else{echo "?page_no=".($page_no+1);} ?>">Next</a></li>
                    </ul>
                </nav>










            </div>

        </main>
    </div>
</div>
<?php include('header.php'); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}

?>

<?php

//1 determine page no
if (isset($_GET['page_no']) && $_GET['page_no'] != "") {
    //if user has already entered the page then page number is the one that they selected
    $page_no = $_GET['page_no'];
} else {
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

$total_no_of_pages = ceil($total_records / $total_records_per_page);

//4 get all products

$stmt2 = $conn->prepare("SELECT orders.*, users.user_name, order_items.option1, order_items.option2, order_items.option3, order_items.option4, order_items.option5, order_items.product_image, order_items.quantity_2, order_items.quantity_3, order_items.quantity_5 FROM orders JOIN users ON orders.user_id = users.user_id JOIN order_items ON orders.order_id = order_items.order_id ORDER BY order_date DESC LIMIT $offset, $total_records_per_page");
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

<style>
    .line-between-td {
        border-right: 1px solid black;
        padding-right: 10px;
    }

    .btn-delivered {
        background-color: green;
        color: white;
    }

    .btn-delivered:hover {
        background-color: #3F704D;
        color: white;
    }

    .input-b {
        padding-top: 3px;
    }

    .in {
        border: none;
        outline: none;
        background: none;
        padding: 0;
        margin: 0;
        font: inherit;
        color: inherit;
        text-align: inherit;
    }
</style>

<div class="container-fluid" style="width: 100%;">
    <div class="row" style="width: 100%;">
        <?php include('sidemenu.php'); ?>
        <main class="col-md-9 ms_sm_auto col_lg-10 px_md-4" style="width: 100%;">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Dashboard</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">
                    </div>
                </div>
            </div>

            <h2>Orders</h2>

            <?php if (isset($_GET['order_updated'])) { ?>
                <p class="text-center" style="color:green;"> <?php echo $_GET['order_updated'] ?> </p>
            <?php } ?>

            <?php if (isset($_GET['order_failed'])) { ?>
                <p class="text-center" style="color:red;"> <?php echo $_GET['order_failed'] ?> </p>
            <?php } ?>

            <div class="table-responsive" style="overflow-x: visible; width: 100%; white-space: nowrap;">
                <?php foreach ($grouped_orders as $order_date => $orders) { ?>
                    <h3><?php echo $order_date; ?></h3>
                    <table class="table table-striped table-sm">
                        <thead>
                            <tr>
                                <th class="line-between-td" style="border-top:1px solid black; border-left:1px solid black;" scope="col">Produit</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Username</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Type</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Taille</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Quantite</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Bare metalique</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Base</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Image</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Status</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">BAT</th>
                                <th class="line-between-td" style="border-top:1px solid black;" scope="col">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($orders as $order) { ?>
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
                                    <td class="line-between-td" style="border-left:1px solid black;">
                                        <img src="../<?php echo $order['product_image']; ?>" alt="Product Image" width="100">
                                    </td>

                                    <td class="line-between-td" data-name="name"><?php echo $order['user_name']; ?></td>

                                    <!-- TYPE -->
                                    <td class="line-between-td" data-name="quantity"><?php echo $order['option1']; ?></td>
                                    <!-- TAILLE -->
                                    <td class="line-between-td"><?php echo $order['option2']; ?></td>
                                    <!-- QUANTITE -->
                                    <td class="line-between-td">X <?php echo $order['quantity_2']; ?> </td>
                                    <!-- BARE METALIQUE -->
                                    <td class="line-between-td"><?php if ($order['option5'] > 0) : ?>
                                            <?php if ($order['quantity_5'] >= "1") : ?>
                                                <span>X <span class="product-price"><?php echo $order['quantity_5'] ?></span></span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span><span class="product-price">Sans</span></span>
                                        <?php endif; ?>
                                    </td>
                                    <!--BASE-->
                                    <td class="line-between-td"><?php if ($order['option3'] != NULL) : ?>
                                            <?php if ($order['quantity_3'] >= "1") : ?>
                                                <span>X <span class="product-price"><?php echo $order['quantity_3'] ?></span></span>
                                            <?php endif; ?>
                                        <?php else : ?>
                                            <span><span class="product-price">Sans</span></span>
                                        <?php endif; ?>
                                    </td>

                                    <!-- IMAGE-->
                                    <td class="line-between-td">
                                        <a href="data:image/jpeg;base64,<?php echo base64_encode($order['option4']) ?>" download>
                                            <img src="data:image/jpeg;base64,<?php echo base64_encode($order['option4']) ?>" alt="Product Image" style="width: 100px; height: 100px;">
                                        </a>
                                    </td>

                                    <!-- STATUS -->
                                    <td class="line-between-td">
                                        <form action="index.php" method="POST">
                                            <input type="hidden" name="order_id" value="<?php echo $order['order_id']; ?>">
                                            <input type="hidden" name="order_status" value="<?php echo $order['order_status']; ?>">
                                            <button class="btn <?php echo ($order['order_status'] == 'delivered') ? 'btn-delivered' : 'btn-primary'; ?>" type="submit" name="edit_order_status_btn">
                                                <?php echo ($order['order_status'] == 'on_hold') ? 'On Hold' : 'Delivered'; ?>
                                            </button>
                                        </form>
                                    </td>

                                    <!-- BAT -->
                                    <td class="line-between-td">
                                        <form action="generate_pdf.php" method="POST">
                                            <input type="hidden" name="option1" value="<?php echo $order['option1']; ?>">
                                            <input type="hidden" name="option2" value="<?php echo $order['option2']; ?>">
                                            <input type="hidden" name="quantity2" value="<?php echo $order['quantity_2']; ?>">
                                            <input type="hidden" name="quantity5" value="<?php echo $order['quantity_5'] ?>">
                                            <input type="hidden" name="quantity3" value="<?php echo $order['quantity_3'] ?>">



                                            <button class="btn btn-primary" type="submit" name="download-bat">BAT</button>
                                        </form>
                                        <div class="input-b" >
                                            <form action="send_email.php" method="post" enctype="multipart/form-data" style="display: flex; flex-direction:column;">
                                                <input type="file" name="upload-bat" class="in">
                                                <input type="submit" name="send_email" style="width: 97px; margin-top:5px;">
                                            </form>
                                        </div>

                                    </td>

                                    <?php if (isset($_GET['order_deleted'])) { ?>
                                        <p class="text-center" style="color: green;"><?php echo $_GET['order_deleted']; ?></p>
                                    <?php } ?>

                                    <?php if (isset($_GET['delete_failed'])) { ?>
                                        <p class="text-center" style="color: red;"><?php echo $_GET['delete_failed']; ?></p>
                                    <?php } ?>

                                    <td class="line-between-td">
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
                        <li class="page-item <?php if ($page_no <= 1) {
                                                    echo 'disabled';
                                                } ?>">
                            <a href="<?php if ($page_no <= 1) {
                                            echo '#';
                                        } else {
                                            echo "?page_no=" . ($page_no - 1);
                                        } ?>" class="page-link">Previous</a>
                        </li>

                        <li class="page-item"><a class="page-link" href="?page_no=1">1</a></li>
                        <li class="page-item"><a class="page-link" href="?page_no=2">2</a></li>

                        <?php if ($page_no >= 3) { ?>
                            <li class="page-item"><a class="page-link" href="">...</a></li>
                            <li class="page-item"><a class="page-link" href="<?php echo "?page_no=" . $page_no; ?>"><?php echo $page_no; ?></a></li>
                        <?php } ?>

                        <li class="page-item <?php if ($page_no >= $total_no_of_pages) {
                                                    echo 'disabled';
                                                } ?>">
                            <a class="page-link" href="<?php if ($page_no >= $total_no_of_pages) {
                                                            echo '#';
                                                        } else {
                                                            echo "?page_no=" . ($page_no + 1);
                                                        } ?>">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </main>
    </div>
</div>
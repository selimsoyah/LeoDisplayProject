<?php include('header.php'); ?>

<?php
if (!isset($_SESSION['admin_logged_in'])) {
    header('location: login.php');
    exit;
}
include('../server/connection.php');

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
?>

<?php

// Fetch users from the database
$sql = "SELECT user_id, user_name, user_email FROM users";
$result = $conn->query($sql);

// Close the connection
$conn->close();

?>

<body>
  <h1 style="margin:20px;">User Accounts</h1>
  <table  style="width:100%; margin-left:0px;">
  <?php include('sidemenu.php'); ?>
    <thead>
      <tr>
        <th>User ID</th>
        <th>Name</th>
        <th>Email</th>
      </tr>
    </thead>
    <tbody>
    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["user_name"] . "</td>";
                echo "<td>" . $row["user_email"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
      ?>
    </tbody>
  </table>
  <!-- pagination -->
                <nav aria-label="Page navigation example" class="mx-auto" style="margin:20px;">
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
</body>
</html>



<div class="container-fluid">
    <div class="row">


        <?php include('sidemenu.php'); ?>
        


    
        <main class="col-md-9 ms_sm_auto col_lg-10 px_md-4">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
                <h1 class="h2">Accounts</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group me-2">

                    </div>
                </div>
            </div>


            <!-- Database config needed -->
            <h2>Accounts</h2>
                
            <div class="table-responsive">
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Name</th>
                        <th>Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["user_id"] . "</td>";
                echo "<td>" . $row["user_name"] . "</td>";
                echo "<td>" . $row["user_email"] . "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='3'>No users found</td></tr>";
        }
      ?>
                    </tbody>
                </table>

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

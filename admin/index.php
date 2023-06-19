<?php include('header.php'); ?>

<?php
    if(!isset($_SESSION['admin_logged_in'])){
        header('location: login.php');
        exit;
    }





?>




<div class="container-fluid">
    <div class="row">
        <?php
        include('sidemenu.php');
        ?>
        
    </div>
</div>
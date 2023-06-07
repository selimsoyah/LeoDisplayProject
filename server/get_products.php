<?php 

include('connection.php');

$request = $conn->prepare('SELECT * FROM products LIMIT 3');

$request->execute();
$products = $request->get_result();
?>
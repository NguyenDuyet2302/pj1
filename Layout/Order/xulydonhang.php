<?php
//$conn = new mysqli("localhost", "root", "", "pj1(1)");

include_once ('../../Config/connect.php');
$order_id = $_GET['order_id'];
$order_status = $_GET['order_status'];
$sql = "UPDATE orders SET `order_status` = $order_status WHERE `order_id` = $order_id";
mysqli_query($connect, $sql);
header('location: ../../index.php?page=order_details&order_id=' . $order_id);


?>

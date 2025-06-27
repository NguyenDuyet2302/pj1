<?php
////$conn = new mysqli("localhost", "root", "", "pj1(1)");
//
//include_once ('../../Config/connect.php');
//$order_id = $_GET['order_id'];
//$order_status = $_GET['order_status'];
//$sql = "UPDATE orders SET `order_status` = $order_status WHERE `order_id` = $order_id";
//mysqli_query($conn, $sql);
//header('location: ../../index.php?page=order_detail&order_id=' . $order_id);
//
//?>

<?php
////$conn = new mysqli("localhost", "root", "", "pj1(1)");
//
//include_once ('../../Config/connect.php');
//$order_id = $_GET['order_id'];
//$order_status = $_GET['order_status'];
//$sql = "UPDATE orders SET `order_status` = $order_status WHERE `order_id` = $order_id";
//mysqli_query($connect, $sql);
//header('location: ../../index.php?page=order_details&order_id=' . $order_id);
//
//
?>
<?php
include_once ('../../Config/connect.php');

$order_id = $_GET['order_id'];
$new_status = $_GET['order_status'];

// 1. Lấy trạng thái hiện tại của đơn
$sql_check = "SELECT order_status FROM orders WHERE order_id = $order_id";
$result = mysqli_query($connect, $sql_check);
$row = mysqli_fetch_assoc($result);

if ($row['order_status'] == 6) {
    // Đơn đã bị khách hủy
    echo "<script>alert('Đơn hàng này đã bị hủy. Không thể xử lý tiếp!'); window.location.href='../../index.php?page=order_details&order_id=$order_id';</script>";
    exit;
}

// 2. Nếu không bị hủy, thì cho phép cập nhật
$sql_update = "UPDATE orders SET order_status = $new_status WHERE order_id = $order_id";
mysqli_query($connect, $sql_update);
header("Location: ../../index.php?page=order_details&order_id=$order_id");
?>

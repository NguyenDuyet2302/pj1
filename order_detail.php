<?php
include_once('header.php');
$order_id = $_GET['order_id'];

// Cập nhật trạng thái nếu người dùng xác nhận đã nhận hàng
if (isset($_POST['confirm_received'])) {
    $update_status = "UPDATE orders SET order_status = 5 WHERE order_id = '$order_id'";
    mysqli_query($connect, $update_status);
}


// Cập nhật trạng thái nếu người dùng hủy đơn hàng
if (isset($_POST['cancel_order'])) {
    $update_status = "UPDATE orders SET order_status = 6 WHERE order_id = '$order_id'";
    mysqli_query($connect, $update_status);
}

// Lấy thông tin đơn hàng
$sql_order = "SELECT order_date, order_status FROM orders WHERE order_id = '$order_id'";
$query_order = mysqli_query($connect, $sql_order);
$order_info = mysqli_fetch_assoc($query_order);

// Lấy chi tiết các sản phẩm trong đơn hàng
$sql_detail = "SELECT order_details.*, books.title, books.image_url, books.price 
               FROM order_details 
               JOIN books ON order_details.book_id = books.book_id 
               WHERE order_id = '$order_id'";
$query_detail = mysqli_query($connect, $sql_detail);

if (isset($_POST['cancel_order'])) {
    $check_status = mysqli_fetch_assoc(mysqli_query($connect, "SELECT order_status FROM orders WHERE order_id = '$order_id'"));
    if ($check_status['order_status'] == 1) {
        $update_status = "UPDATE orders SET order_status = 6 WHERE order_id = '$order_id'";
        mysqli_query($connect, $update_status);
    } else {
        echo "<script>alert('Không thể hủy đơn hàng này vì đơn đã được duyệt hoặc xử lý.');</script>";
    }
}
?>

<div class="container my-5">
    <h3>Chi tiết đơn hàng #<?= $order_id ?></h3>
    <p>Ngày đặt: <?= date("d/m/Y H:i:s", strtotime($order_info['order_date'])) ?></p>

    <table class="table table-bordered text-center">
        <thead class="table-light">
        <tr>
            <th>Ảnh</th>
            <th>Tên sách</th>
            <th>Giá</th>
            <th>Số lượng</th>
            <th>Tổng</th>
        </tr>
        </thead>
        <tbody>
        <?php
        $total_amount = 0;
        while ($row = mysqli_fetch_assoc($query_detail)) {
            $subtotal = $row['price'] * $row['order_detail_quantity'];
            $total_amount += $subtotal;
            ?>
            <tr>
                <td><img src="asset/img/<?= $row['image_url'] ?>" width="50"></td>
                <td><?= $row['title'] ?></td>
                <td><?= number_format($row['price']) ?>đ</td>
                <td><?= $row['order_detail_quantity'] ?></td>
                <td><?= number_format($subtotal) ?>đ</td>
            </tr>
        <?php } ?>
        <tr>
            <td colspan="4" class="text-end"><strong>Tổng cộng:</strong></td>
            <td><strong><?= number_format($total_amount) ?>đ</strong></td>
        </tr>
        </tbody>
    </table>

    <form method="post">

        <?php if ($order_info['order_status'] == 1) { ?>
            <button type="submit" name="cancel_order" class="btn btn-danger mt-3 ms-2" onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này không?');">
                Hủy đơn hàng
            </button>
        <?php } elseif ($order_info['order_status'] == 4) { ?>
            <button type="submit" name="confirm_received" class="btn btn-success mt-3">
                Đã nhận hàng
            </button>
        <?php } ?>
    </form>
</div>
<?php include_once('footer.php'); ?>
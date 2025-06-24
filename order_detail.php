<?php
include_once('header.php');
$order_id = $_GET['order_id'];

// Cập nhật trạng thái nếu người dùng xác nhận đã nhận hàng
if (isset($_POST['confirm_received'])) {
    $update_status = "UPDATE orders SET order_status = 5 WHERE order_id = '$order_id'";
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
        <?php while ($row = mysqli_fetch_assoc($query_detail)) { ?>
            <tr>
                <td><img src="asset/img/<?= $row['image_url'] ?>" width="50"></td>
                <td><?= $row['title'] ?></td>
                <td><?= number_format($row['price']) ?>đ</td>
                <td><?= $row['order_detail_quantity'] ?></td>
                <td><?= number_format($row['price'] * $row['order_detail_quantity']) ?>đ</td>
            </tr>
        <?php } ?>
        </tbody>
    </table>

    <?php if ($order_info['order_status'] == 4) { ?>
        <form method="post">
            <button type="submit" name="confirm_received" class="btn btn-success mt-3">
                Đã nhận hàng
            </button>
        </form>
    <?php } ?>
</div>

<?php include_once('footer.php'); ?>

<?php
include_once('header.php');

$username = $_SESSION['username'];
$s_find_cus = "SELECT * FROM customers WHERE user_name = '$username'";
$q_find_cus = mysqli_query($connect, $s_find_cus);
$customer_info = mysqli_fetch_assoc($q_find_cus);
$customer_id = $customer_info['user_id'];

$sql_orders = "SELECT orders.*, order_details.order_detail_quantity, books.title, books.image_url, orders.order_date
               FROM orders 
               JOIN order_details ON orders.order_id = order_details.order_id 
               JOIN books ON order_details.book_id = books.book_id 
               WHERE orders.cus_id = '$customer_id' 
               ORDER BY orders.order_date DESC";

$query_orders = mysqli_query($connect, $sql_orders);
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Lịch sử mua hàng</h2>
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <table class="table table-bordered table-hover text-center">
                <thead class="table-dark">
                <tr>
                    <th>Ảnh</th>
                    <th>Tên sách</th>
                    <th>Số lượng</th>
                    <th>Tổng giá</th>
                    <th>Ngày mua</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($order = mysqli_fetch_assoc($query_orders)) { ?>
                    <tr>
                        <td><img src="asset/img/<?= $order['image_url'] ?>" width="50" class="img-thumbnail"></td>
                        <td><?= $order['title'] ?></td>
                        <td><?= $order['order_detail_quantity'] ?></td>
                        <td><?= number_format($order['total_price']) ?>đ</td>
                        <td><?= date("d/m/Y H:i:s", strtotime($order['order_date'])) ?></td>
                        <td>
                            <?php
                            if ($order['order_status'] == 6) {
                                echo '<span class="badge bg-danger">Đã hủy</span>';
                            }
                            if ($order['order_status'] == 1) {
                                echo '<span class="badge bg-danger">Chờ xác nhận</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <?php if (!in_array($order['order_status'], [6, 'Cancelled'])) { ?>
                                <form method="post">
                                    <input type="hidden" name="order_id" value="<?= $order['order_id'] ?>">
                                    <button type="submit" name="cancel" class="btn btn-danger btn-sm">Hủy đơn</button>
                                </form>
                            <?php } else { ?>
                                <span class="text-muted">Không thể hủy</span>
                            <?php } ?>
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
if (isset($_POST['cancel'])) {
    $order_id = $_POST['order_id'];
    $sql_cancel = "UPDATE orders SET order_status=6 WHERE order_id='$order_id'";
    mysqli_query($connect, $sql_cancel);
    header("Location: layout_user.php?pageLayout=history");
}

include_once('footer.php');
?>

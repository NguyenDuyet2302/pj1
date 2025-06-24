<?php
include_once('header.php');

$username = $_SESSION['username'];
$s_find_cus = "SELECT * FROM customers WHERE user_name = '$username'";
$q_find_cus = mysqli_query($connect, $s_find_cus);
$customer_info = mysqli_fetch_assoc($q_find_cus);
$customer_id = $customer_info['user_id'];

$sql_orders = "SELECT * FROM orders WHERE cus_id = '$customer_id' ORDER BY order_date DESC";
$query_orders = mysqli_query($connect, $sql_orders);
?>

<div class="container my-5">
    <h2 class="text-center mb-4">Lịch sử mua hàng</h2>
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <table class="table table-bordered text-center">
                <thead class="table-dark">
                <tr>
                    <th>Mã đơn hàng</th>
                    <th>Người mua</th>
                    <th>Ngày đặt</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>
                <?php while ($order = mysqli_fetch_assoc($query_orders)) { ?>
                    <tr>
                        <td>#<?= $order['order_id'] ?></td>
                        <td><?= $customer_info['fullname'] ?></td>
                        <td><?= date("d/m/Y H:i:s", strtotime($order['order_date'])) ?></td>
                        <td>
                            <?php
                            if ($order['order_status'] == 6) {
                                echo '<span class="badge bg-danger">Đã hủy</span>';
                            } elseif ($order['order_status'] == 1) {
                                echo '<span class="badge bg-warning">Chờ xác nhận</span>';
                            } elseif ($order['order_status'] == 2) {
                                echo '<span class="badge bg-info">Đã xác nhận</span>';
                            } elseif ($order['order_status'] == 3) {
                                echo '<span class="badge bg-info">Đang vận chuyển</span>';
                            } elseif ($order['order_status'] == 4) {
                                echo '<span class="badge bg-info">Đã giao hàng</span>';
                            } else {
                                echo '<span class="badge bg-success">Hoàn tất</span>';
                            }
                            ?>
                        </td>
                        <td>
                            <a href="layout_user.php?pageLayout=order_detail&order_id=<?= $order['order_id'] ?>" class="btn btn-primary btn-sm">Xem chi tiết</a
                        </td>
                    </tr>
                <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>

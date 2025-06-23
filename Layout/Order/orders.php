<?php
$conn = new mysqli("localhost", "root", "", "pj1");
//
$sql = "SELECT * FROM orders";
$result = $conn->query($sql);
?>

<div class="container" >
    <h2>Danh sách Đơn hàng 🛒</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID Đơn hàng</th>
            <th>ID Người dùng</th>
            <th>ID Nhân viên</th>
            <th>Ngày đặt hàng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['order_id'] ?></td>
                <td><?= $row['cus_id'] ?></td>
                <td><?= $row['staff_id'] ?></td>
                <td><?= $row['order_date'] ?></td>
                <td><?= number_format($row['total_price']) ?> VNĐ</td>
                <td><?= $row['order_status'] ?></td>
                <td><button class="btn btn-danger btn-sm">Hủy đơn</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

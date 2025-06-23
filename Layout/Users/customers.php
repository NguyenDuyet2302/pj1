<?php
$conn = new mysqli("localhost", "root", "", "pj1");

$sql = "SELECT * FROM customers";
$result = $conn->query($sql);
?>

<div class="container"  >
    <h2>Danh sách Khách hàng 👤</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Tên đăng nhập</th>
            <th>Tên đầy đủ</th>
            <th>Email</th>
            <th>Mật khẩu</th>
            <th>Số điện thoại</th>
            <th>Địa chỉ giao hàng</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['fullname'] ?></td>
                <td><?= $row['email'] ?></td>
                <td><?= $row['password'] ?></td>
                <td><?= $row['contact_info'] ?></td>
                <td><?= $row['shipping_address'] ?></td>
                <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

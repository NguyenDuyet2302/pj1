<?php
$conn = new mysqli("localhost", "root", "", "pj1");
$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1'; // tham số thứ 4 là csdl cần kết nối
$connect =  mysqli_connect($server, $username, $password, $database);
$sql = "SELECT * FROM orders o INNER JOIN customers c ON c.user_id = o.cus_id ORDER BY order_date DESC ";
$query = mysqli_query($connect, $sql);
$result = $conn->query($sql);
?>

<div class="container" >
    <h2>Danh sách Đơn hàng </h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID Đơn hàng</th>
            <th>Ngày đặt hàng</th>
            <th> Người dùng</th>
            <th>Tổng tiền</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($query as $key => $value) {
            ?>
            <tr>
                <td><?= $value['order_id'] ?></td>
                <td><?= $value['order_date'] ?></td>
                <td><?= $value['fullname'] ?></td>
                <td class="text-danger"><?= number_format($value['total_price']) ?>vnd</td>
                <?php
                switch ($value['order_status']) {
                    case 1: echo '<td class="text-secondary">chua duyet</td>'; break;
                    case 2: echo '<td class="text-primary">da duyet</td>'; break;
                    case 3: echo '<td class="text-info">dang giao hang</td>'; break;
                    case 4: echo '<td class="text-warning">da giao hang</td>'; break;
                    case 5: echo '<td class="text-success">da nhan hang</td>'; break;
                    case 6: echo '<td class="text-danger">da huy</td>'; break;

                }
                ?>
                <td>
                    <a class="btn btn_primary" href="?page=order_details&order_id=<?= $value['order_id'] ?>">xem chi tiet </a>
                </td>
            </tr>
            <?php
        }
        ?>
        <!--        --><?php //while ($row = $result->fetch_assoc()) { ?>
        <!--            <tr>-->
        <!--                <td>--><?//= $row['order_id'] ?><!--</td>-->
        <!--                <td>--><?//= $row['cus_id'] ?><!--</td>-->
        <!--                <td>--><?//= $row['staff_id'] ?><!--</td>-->
        <!--                <td>--><?//= $row['order_date'] ?><!--</td>-->
        <!--                <td>--><?//= number_format($row['total_price']) ?><!-- VNĐ</td>-->
        <!--                <td>--><?//= $row['order_status'] ?><!--</td>-->
        <!--                <td><button class="btn btn-danger btn-sm">Hủy đơn</button></td>-->
        <!--            </tr>-->
        <!--        --><?php //} ?>
        </tbody>
    </table>
</div>

<?php
$conn = new mysqli("localhost", "root", "", "pj1");
$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1'; // tham số thứ 4 là csdl cần kết nối
$connect =  mysqli_connect($server, $username, $password, $database);
$sql = "SELECT 
            MONTH(o.order_date) AS thang,
            SUM(od.order_detail_quantity * od.order_detail_price) AS doanh_thu
        FROM orders o
        JOIN order_details od ON o.order_id = od.order_id
        WHERE o.order_status = 5
        GROUP BY  MONTH(o.order_date)
        ORDER BY  thang DESC";
$result = mysqli_query($conn, $sql);



?>


<div class="container">
    <h2>Chào mừng bạn đến với trang quản trị!</h2>
    <h4>📅 Doanh thu theo tháng</h4>
    <table border="1" cellpadding="8" cellspacing="0" style="border-collapse: collapse; text-align: center;">
        <tr style="background-color: #f2f2f2;">
            <th>Tháng</th>
            <th>Doanh thu</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
            <tr>
                <td>Tháng <?= $row['thang'] ?></td>
                <td><?= number_format($row['doanh_thu'], 0, ',', '.') ?> đ</td>
            </tr>
        <?php } ?>
    </table>
</div>
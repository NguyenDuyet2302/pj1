<?php
$conn = new mysqli("localhost", "root", "", "pj1");
//
$sql = "SELECT * FROM order_details";
$result = $conn->query($sql);
//?>

<div class="container" style="margin-left: 248px;"
>
    <h2>Chi tiết Đơn hàng</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID Đơn hàng</th>
            <th>ID Sách</th>
            <th>Tổng tiền</th>
            <th>Số lượng</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
     <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
               <td><?= $row['order_id'] ?></td>
               <td><?= $row['book_id'] ?></td>
                <td><?= $row['order_detail_price'] ?></td>
                <td><?= $row['order_detail_quantity'] ?></td>
                <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

<?php
$conn = new mysqli("localhost", "root", "", "pj1");

$order_id = $_GET['order_id'];
$sql = "SELECT o.buyer_name, o.buyer_phone, o.buyer_address, o.order_status, o.total_price, 
               c.fullname, c.contact_info, c.shipping_address, 
               od.*, b.* 
        FROM order_details od 
        JOIN books b ON b.book_id = od.book_id 
        JOIN orders o ON o.order_id = od.order_id 
        JOIN customers c ON c.user_id = o.cus_id 
        WHERE od.order_id = $order_id";

$query = mysqli_query($conn, $sql);
//$result = $conn->query($sql);
$row = mysqli_fetch_array($query);
?>

<!--<div class="container" style="margin-left: 248px;"-->

<!--    <h2>Chi tiết Đơn hàng </h2>-->
<!--    <table class="table table-bordered">-->
<!--        <thead class="thead-dark">-->
<!--        <tr>-->
<!--            <th>ID Đơn hàng</th>-->
<!--            <th>ID Sách</th>-->
<!--            <th>Số lượng</th>-->
<!--            <th>Chi tiết số lượng đơn hàng</th>-->
<!--            <th>Hành động</th>-->
<!--        </tr>-->
<!--        </thead>-->
<!--        <tbody>-->
<!--     --><?php //while ($row = $result->fetch_assoc()) { ?>
<!--            <tr>-->
<!--               <td>--><?//= $row['order_id'] ?><!--</td>-->
<!--               <td>--><?//= $row['book_id'] ?><!--</td>-->
<!--                <td>--><?//= $row['order_detail_price'] ?><!--</td>-->
<!--                <td>--><?//= $row['order_detail_quantity'] ?><!--</td>-->
<!--                <td><button class="btn btn-danger btn-sm">Xóa</button></td>-->
<!--            </tr>-->
<!--        --><?php //} ?>
<!--        </tbody>-->
<!--    </table>-->
<!--</div>-->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Chi tiết đơn hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            /*padding: 40px;*/
        }

        h2 {
            text-align: center;
            margin-bottom: 20px;
        }

        .info {
            margin-bottom: 20px;
        }

        .info p {
            margin: 6px 0;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }

        th {
            background-color: #f5f5f5;
        }

        .total {
            text-align: right;
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 30px;
        }

        .actions {
            text-align: center;
        }

        .actions button {
            padding: 10px 20px;
            margin: 0 10px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        .actions button.cancel {
            background-color: #dc3545;
        }
    </style>
</head>
<body>
<div class="container" >
    <h2>Chi tiết đơn hàng</h2>

    <div class="info">
        <p>Người nhận: <?= htmlspecialchars($row['fullname']) ?></p>
        <p>Số điện thoại: <?= htmlspecialchars($row['contact_info']) ?></p>
        <p>Địa chỉ: <?= htmlspecialchars($row['shipping_address']) ?></p>

        <?php if (!empty($row['buyer_name']) || !empty($row['buyer_phone']) || !empty($row['buyer_address'])): ?>
            <hr>
            <p><strong>📦 Mua hộ cho:</strong></p>
            <p>Người mua hộ: <?= htmlspecialchars($row['buyer_name']) ?></p>
            <p>Điện thoại: <?= htmlspecialchars($row['buyer_phone']) ?></p>
            <p>Địa chỉ: <?= htmlspecialchars($row['buyer_address']) ?></p>
        <?php endif; ?>
    </div>


    <table>
        <tr>
            <th>#</th>
            <th>Sản phẩm</th>
            <th>Ảnh sản phẩm</th>
            <th>Số lượng</th>
            <th>Đơn giá</th>
        </tr>
        <?php
        foreach ($query as $key => $value) {
            ?>
            <tr>
                <th scope="row"><?= $key + 1 ?></th>
                <td><?= $value['title'] ?></td>
                <td><img src="images/<?= $value['image_url'] ?>" alt="" width="90px" ></td>
                <td><?= $value['book_qtt'] ?></td>
                <td><?= number_format($value['price'])  ?></td>
            </tr>
        <?php } ?>
        <!--    <tr>-->
        <!--        <td>2</td>-->
        <!--        <td>Sản phẩm 2</td>-->
        <!--        <td>(Hình ảnh)</td>-->
        <!--        <td>2</td>-->
        <!--        <td>20.000.000 đ</td>-->
        <!--    </tr>-->
    </table>

    <div class="total">
        Tổng tiền: <?= number_format($row['total_price']) ?>đ
    </div>

    <div class="row">
        <div class="col-lg-3">
            <?php
            if ($row['order_status'] == 1) {
                ?>
                <a href="Layout/Order/xulydonhang.php?order_status=2&order_id=<?=$row['order_id'] ?>" class="btn btn-warning">Xác nhận đơn hàng </a>
                <a href="Layout/Order/xulydonhang.php?order_status=6&order_id=<?=$row['order_id'] ?>" class="btn btn-danger">Hủy đơn hàng </a>
                <?php
            } elseif ($row['order_status'] == 2) {
                ?>
                <a href="Layout/Order/xulydonhang.php?order_status=3&order_id=<?=$row['order_id'] ?>" class="btn btn-info">Giao hàng </a>
                <?php
            } elseif ($row['order_status'] == 3) {
                ?>
                <a href="Layout/Order/xulydonhang.php?order_status=4&order_id=<?=$row['order_id'] ?>" class="btn btn-info">Đã giao </a>
                <?php
            } elseif ($row['order_status'] == 6) {
                ?>
                <p class="text-danger">Đơn hàng hủy</p>
                <?php
            } elseif ($row['order_status'] == 5) {
                ?>
                <p class="text-success">Giao hàng thành công</p>
                <?php
            }
            ?>
        </div>
    </div>
</div>
</body>
</html>
<?php  ?>

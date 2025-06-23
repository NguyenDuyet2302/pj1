<?php
$conn = new mysqli("localhost", "root", "", "pj1");
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
?>
<?php
//// bảo mật trang con tránh vc truy cập trực tiếp thông qua URL
//// hàm define() dùng để kt sự tồn tại của 1 hằng trong php
//if (!define('SECURITY')) {
//    // hàm die khi đc sử dụng sẽ ẩn toàn bộ nội dung từ hàm die trở xuống
//    die('Bạn đang truy cập trái phép, vui lòng đăng nhập để sử dụng');
//}
//?>
<div class="container">
    <h2>Danh sách Sách</h2>
    <a href="Layout/Product/add_product.php" class="btn btn-primary">Thêm sản phẩm</a>
    <!--    <h2><button href="add_product.php"  class="btn btn-primary btn-sm">Thêm sản phẩm</button></h2>-->
    <!--    <a href="add_product.php" class="btn btn-primary">Thêm sản phẩm</a>-->
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Tên sách</th>
            <th>Năm</th>
            <th>Dạng</th>
            <th>Số trang</th>
            <th>Id nhà xuất bản</th>
            <th>Id Danh mục</th>
            <th>Số lượng</th>
            <th>Giá</th>
            <th>Giá cũ</th>
            <th>Mô tả</th>
            <th>Ảnh</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['book_id'] ?></td>
                <td><?= $row['title'] ?></td>
                <td><?= $row['book_year'] ?></td>
                <td><?= $row['form'] ?></td>
                <td><?= $row['page'] ?></td>
                <td><?= $row['publisher_id'] ?></td>
                <td><?= $row['category_id'] ?></td>
                <td><?= $row['book_qtt'] ?></td>
                <td><?= number_format($row['price']) ?> VNĐ</td>
                <td><?= number_format($row['old_price']) ?> VNĐ</td>
                <td><?= $row['description'] ?></td>
                <td><img src="Admin/images/<?= htmlspecialchars($row['image_url']) ?>" alt="Hình ảnh sản phẩm"></td>
                <td>
                    <button class="btn btn-danger btn-sm">Xóa</button>
                </td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

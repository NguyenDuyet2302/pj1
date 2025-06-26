<?php
$conn = new mysqli("localhost", "root", "", "pj1");
$sql = "SELECT * FROM books";
$result = $conn->query($sql);
// giải thuật phân trang
$row_per_page = 4;  // số lg bản ghi hiển thị trong 1 trang
$query = mysqli_query($conn, $sql);

// hiển thị sp
//$sql = "SELECT * FROM books p INNER JOIN categories c ON c.category_id = p.category_id ORDER BY book_id DESC LIMIT 0, 5";
//$sql = "SELECT p.book_id, p.title, p.price, p.image_url,p.book_qtt, c.category_name
//FROM books p
//INNER JOIN categories c ON c.category_id = p.category_id
//ORDER BY p.book_id DESC
//LIMIT 0, 5";
$sql = "SELECT p.book_id, p.title, p.price, p.image_url, p.book_qtt, c.category_name 
        FROM books p 
        INNER JOIN categories c ON c.category_id = p.category_id 
        ORDER BY p.book_id DESC";
$query = mysqli_query($conn, $sql);

?>
<?php
//// bảo mật trang con tránh vc truy cập trực tiếp thông qua URL
//// hàm define() dùng để kt sự tồn tại của 1 hằng trong php
//if (!define('SECURITY')) {
//    // hàm die khi đc sử dụng sẽ ẩn toàn bộ nội dung từ hàm die trở xuống
//    die('Bạn đang truy cập trái phép, vui lòng đăng nhập để sử dụng');
//}
//?>

<style>
    .pagination {
        display: flex;
        justify-content: center;
        margin-top: 20px;
    }
    .pagination a {
        color: black;
        padding: 8px 16px;
        text-decoration: none;
        border: 1px solid #ddd;
        margin: 0 5px;
        border-radius: 5px;
    }
    .pagination a:hover {
        background-color: #007bff;
        color: white;
    }
</style>
<div class="container" >
    <h2>Danh sách Sách</h2>
    <a href="Layout/Product/add_product.php" class="btn btn-primary">Thêm sản phẩm</a>
    <!--    <h2><button href="add_product.php"  class="btn btn-primary btn-sm">Thêm sản phẩm</button></h2>-->
    <!--    <a href="add_product.php" class="btn btn-primary">Thêm sản phẩm</a>-->
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>STT</th>
            <th>Tên sách</th>
            <th>Giá</th>
            <th>Ảnh</th>
            <th>Số lượng</th>
            <th>Tên danh mục</th>
            <th>Hành động</th>

        </tr>
        </thead>


        <tbody>
        <?php
        $stt = 1;
        while ($item = mysqli_fetch_assoc($query)) {

            ?>
            <tr>
                <td><?= $stt ?></td>
                <td><?= $item['title'] ?></td>
                <td><?= number_format($item['price']) ?>vnd</td>
                <td><img src="asset/img/<?= $item['image_url'] ?>" alt="Ảnh sách" width="80">
                </td>
                <?php
                if($item['book_qtt'] >=10) {
                    ?>
                    <td><span class="label label-success">Còn hàng</span></td>
                    <?php
                } elseif  ($item['book_qtt'] < 10 && $item['book_qtt'] > 0) {
                    ?>
                    <td><span class="label label-warning">Sắp hết hàng</span></td>
                    <?php
                } else {
                    ?>
                    <td><span class="label label-danger">Hết hàng</span></td>
                    <?php
                }
                ?>
                <td><?= $item['category_name'] ?></td>
                <!--        <td>Danh mục số 1</td>-->
                <td class="form-group">
                    <a href="?page=edit_product&book_id=<?= $item['book_id']?>" class="btn btn-primary">Sửa</a>
                    <a onclick="return confirm('Xác nhận xóa?')" href="?page=delete_product&book_id=<?= $item['book_id']?>" class="btn btn-danger">Xóa</a>
                </td>
            </tr>
            <?php
            $stt++;
        }
        ?>
        <!--           <tr>-->
        <!--             <td>--><?//= $row['book_id'] ?><!--</td>-->
        <!--               <td>--><?//= $row['title'] ?><!--</td>-->
        <!--               <td>--><?//= $row['book_year'] ?><!--</td>-->
        <!--                <td>--><?//= $row['form'] ?><!--</td>-->
        <!--                <td>--><?//= $row['page'] ?><!--</td>-->
        <!--                <td>--><?//= $row['publisher_id'] ?><!--</td>-->
        <!--                <td>--><?//= $row['category_id'] ?><!--</td>-->
        <!--                <td>--><?//= $row['book_qtt'] ?><!--</td>-->
        <!--              <td>--><?//= number_format($row['price']) ?><!-- VNĐ</td>-->
        <!--              <td>--><?//= number_format($row['old_price']) ?><!-- VNĐ</td>-->
        <!--               <td>--><?//= $row['description'] ?><!--</td>-->
        <!--               <td>--><?//= $row['image_url'] ?><!--</td>-->
        <!--               <td><button class="btn btn-danger btn-sm" name="delete_product">Xóa</button></td>-->
        <!--            </tr>-->
        <!--        --><?php //} ?>



        </tbody>
    </table>
    <div class="pagination">
        <a href="#">&laquo;</a>
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#">3</a>
        <a href="#">4</a>
        <a href="#">5</a>
        <a href="#">6</a>
        <a href="#">&raquo;</a>
    </div>
</div>

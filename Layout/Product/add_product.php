<?php
$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1'; // tham số thứ 4 là csdl cần kết nối
$connect =  mysqli_connect($server, $username, $password, $database);
$sql_cate = "SELECT * FROM categories ORDER BY category_id ASC";
$query_cate = mysqli_query($connect, $sql_cate);

// thực hiện thêm mới sản phẩm
if (isset($_POST['sbm'])) {
    $book_id = $_POST['book_id'];
    $title = $_POST['title'];
    $book_year = $_POST['book_year'];
    $form = $_POST['form'];
    $page = $_POST['page'];
    $publisher_id = $_POST['publisher_id'];
    $category_id = $_POST['category_id'];
    $book_qtt = $_POST['book_qtt'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $description = $_POST['description'];
    // lay ra ten cua tep
    $image_url = $_FILES['image_url']['name'];
    // luu tru tam thoi tep
    $tmp = $_FILES['image_url']['tmp_name'];
    // thuc hien truy van ban ghi
    $sql = "INSERT INTO books (`book_id`,`title`,`book_year`,`form`,`page`,`publisher_id`,`category_id`,`book_qtt`,`price`,`old_price`,`description`,`image_url`) VALUES ($book_id,'$title',$book_year,'$form',$page,$publisher_id,$category_id,$book_qtt,$price,$old_price,'$description','$image_url')";
    mysqli_query($connect, $sql);
    // lấy ảnh từ thư mục tạm về thư mục của dự án
    move_uploaded_file($tmp, 'images/' . $image_url);
    // chuyển hướng về trang danh sách
    header('location: ?page=books');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            padding: 20px;
        }
        .form-container {
            max-width: 600px;
            margin: auto;
            padding: 30px;
            background: white;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
    </style>
</head>
<body>

<div class="form-container">
    <h2 class="text-center"> Thêm Sản Phẩm</h2>
    <form role="form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Id:</label>
            <input type="text" class="form-control" required name="book_id" >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên Sản Phẩm:</label>
            <input type="text" class="form-control" required name="title" >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Năm:</label>
            <input type="text" class="form-control" required name="book_year" >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Dạng:</label>
            <input type="text" class="form-control" required name="form" >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Số trang:</label>
            <input type="text" class="form-control" required name="page" >
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Id nhà xuất bản:</label>
            <input type="text" class="form-control" required name="publisher_id" >
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Danh Mục:</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                <?php
                while ($item = mysqli_fetch_array($query_cate)) {
                    ?>
                    <option value=<?= $item['category_id'] ?>><?= $item['category_name'] ?> </option>
                    <?php
                }
                ?>

            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Số Lượng:</label>
            <input type="text" class="form-control" id="book_qtt" required name="book_qtt" >
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="old_price" class="form-label">Giá cũ:</label>
            <input type="number" class="form-control" id="price" name="old_price" required>
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả:</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label>Ảnh Sản Phẩm</label>
            <input required name="image_url" type="file" id="fileInput">
        </div>
        <button name="sbm" type="submit" class="btn btn-primary w-100">Thêm Sản Phẩm</button>
    </form>
</div>

</body>
</html>

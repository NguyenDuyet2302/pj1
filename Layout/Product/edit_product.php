
<?php
$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1'; // tham số thứ 4 là csdl cần kết nối
$connect =  mysqli_connect($server, $username, $password, $database);
$sql_cate = "SELECT * FROM categories ORDER BY category_id ASC";
$query_cate = mysqli_query($connect, $sql_cate);

// truy vấn tìm bản ghi theo id truyền sang
$book_id = $_GET['book_id'];
$sql_book = "SELECT * FROM books WHERE `book_id` = $book_id";
$row = mysqli_fetch_array(mysqli_query($connect,$sql_book));
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
    //trong trường hợp người dùng ko thay đổi ảnh
    if ($_FILES['image_url']['name'] == '') {
        $image_url = $row['images_url'];
    }else {
        // lay ra ten cua tep
        $image_url = $_FILES['image_url']['name'];
        // luu tru tam thoi tep
        $tmp = $_FILES['image_url']['tmp_name'];
        // lấy ảnh từ thư mục tạm về thư mục của dự án
        move_uploaded_file($tmp, 'images/' . $image_url);
    }
    // thuc hien truy van ban ghi
    $sql = "UPDATE books SET `title` = `$title`,
            `price` = $price,`book_qtt` = $book_qtt,
                 `category_id` = $category_id,`publisher_id` = $publisher_id
                 `page` = $page,`form` = $form,`book_year` = $book_year,
                 `old_price` = $old_price,`description` = $description
                 WHERE `book_id` = $book_id";

    mysqli_query($connect, $sql);

    // chuyển hướng về trang danh sách
    header('location: ?page_layout=books');
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sửa sản Phẩm</title>
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
    <h2 class="text-center"> Sửa sản Phẩm: <?= $row['title'] ?></h2>
    <form role="form" method="post" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Id:</label>
            <input type="text" class="form-control" required name="book_id" value="<?= $row['book_id'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Tên Sản Phẩm:</label>
            <input  type="text" class="form-control" placeholder="" required name="title" value="<?= $row['title'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Năm:</label>
            <input type="text" class="form-control" required name="book_year" value="<?= $row['book_year'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Dạng:</label>
            <input type="text" class="form-control" required name="form" value="<?= $row['form'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Số trang:</label>
            <input type="text" class="form-control" required name="page" value="<?= $row['page'] ?>">
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Id nhà xuất bản:</label>
            <input type="text" class="form-control" required name="publisher_id" value="<?= $row['publisher_id'] ?>">
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Danh Mục:</label>
            <select class="form-select" id="category" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                <?php
                while ($item = mysqli_fetch_array($query_cate)) {
                ?>
                <option <?php if($item['category_id'] == $row['category_id']){echo 'selected';} ?> value=<?= $item['category_id'] ?>><?= $item['category_name'] ?> </option>
                <?php
                }
                ?>

            </select>
        </div>
        <div class="mb-3">
            <label for="quantity" class="form-label">Số Lượng:</label>
            <input type="text" class="form-control" id="book_qtt" required name="book_qtt" value="<?= $row['book_qtt'] ?>">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" id="price" name="price" required value="<?= $row['price'] ?>">
        </div>
        <div class="mb-3">
            <label for="old_price" class="form-label">Giá cũ:</label>
            <input type="number" class="form-control" id="price" name="old_price" required value="<?= $row['old_price'] ?>">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả:</label>
            <textarea class="form-control" id="description" name="description" >value="<?= $row['description'] ?>"</textarea>
        </div>
        <div class="mb-3">
            <label>Ảnh Sản Phẩm</label>
            <input  name="image_url" type="file" id="fileInput">
            <br>
            <div>
                <img src="asset/img/<?= $item['image_url'] ?>"" alt="">
            </div>
        </div>
        <button name="sbm" type="submit" class="btn btn-primary w-100">Thêm Sản Phẩm</button>
    </form>
</div>

</body>
</html>

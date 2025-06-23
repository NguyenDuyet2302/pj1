<?php
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'pj1';

// Kết nối CSDL
$connect = mysqli_connect($server, $username, $password, $database);
if (!$connect) {
    die("Kết nối thất bại: " . mysqli_connect_error());
}

// Truy vấn danh mục và nhà xuất bản
$sql_cate = "SELECT * FROM categories ORDER BY category_id ASC";
$query_cate = mysqli_query($connect, $sql_cate);

$sql_pub = "SELECT * FROM publishers ORDER BY publisher_id ASC";
$query_pub = mysqli_query($connect, $sql_pub);

// Thực hiện thêm mới sản phẩm
if (isset($_POST['sbm'])) {
    $book_id = $_POST['book_id'];
    $prd_name = $_POST['title'];
    $book_year = $_POST['book_year'];
    $form = $_POST['form'];
    $page = $_POST['page'];
    $publisher_id = $_POST['publisher_id'];
    $category_id = $_POST['category_id'];
    $book_qtt = $_POST['book_qtt'];
    $price = $_POST['price'];
    $old_price = $_POST['old_price'];
    $description = $_POST['description'];

    // Kiểm tra hình ảnh
    $image_url = $_FILES['image_url']['name'];
    $tmp = $_FILES['image_url']['tmp_name'];

    // Thực hiện truy vấn
    $sql = "INSERT INTO books (book_id, title, book_year, form, page, publisher_id, category_id, book_qtt, price, old_price, description, image_url)
            VALUES ('$book_id', '$prd_name', '$book_year', '$form', '$page', '$publisher_id', '$category_id', '$book_qtt', '$price', '$old_price', '$description', '$image_url')";

    if (mysqli_query($connect, $sql)) {
        // Di chuyển ảnh vào thư mục lưu trữ
        move_uploaded_file($tmp, "images/" . $image_url);
        header('location: ?page_layout=books');
    } else {
        echo "Lỗi: " . mysqli_error($connect);
    }
}
?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thêm Sản Phẩm</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
</head>
<body>

<div class="container mt-5">
    <h2 class="text-center">🛒 Thêm Sản Phẩm</h2>
    <form method="post" enctype="multipart/form-data">

        <div class="mb-3">
            <label for="title" class="form-label">Tên Sách:</label>
            <input type="text" class="form-control" required name="title">
        </div>

        <div class="mb-3">
            <label for="book_year" class="form-label">Năm:</label>
            <input type="number" class="form-control" required name="book_year">
        </div>

        <div class="mb-3">
            <label for="form" class="form-label">Dạng:</label>
            <input type="text" class="form-control" required name="form">
        </div>

        <div class="mb-3">
            <label for="page" class="form-label">Số Trang:</label>
            <input type="number" class="form-control" required name="page">
        </div>

        <div class="mb-3">
            <label for="publisher" class="form-label">Nhà Xuất Bản:</label>
            <select class="form-select" name="publisher_id" required>
                <option value="">-- Chọn nhà xuất bản --</option>
                <?php while ($item = mysqli_fetch_array($query_pub)) { ?>
                    <option value="<?= $item['publisher_id'] ?>"><?= $item['name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="category" class="form-label">Danh Mục:</label>
            <select class="form-select" name="category_id" required>
                <option value="">-- Chọn danh mục --</option>
                <?php while ($item = mysqli_fetch_array($query_cate)) { ?>
                    <option value="<?= $item['category_id'] ?>"><?= $item['category_name'] ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="mb-3">
            <label for="book_qtt" class="form-label">Số Lượng:</label>
            <input type="number" class="form-control" required name="book_qtt">
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Giá:</label>
            <input type="number" class="form-control" required name="price">
        </div>

        <div class="mb-3">
            <label for="old_price" class="form-label">Giá Cũ:</label>
            <input type="number" class="form-control" required name="old_price">
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả:</label>
            <textarea class="form-control" required name="description"></textarea>
        </div>

        <div class="mb-3">
            <label>Ảnh Sản Phẩm:</label>
            <input type="file" name="image_url" required>
        </div>

        <button name="sbm" type="submit" class="btn btn-primary w-100">Thêm Sản Phẩm</button>
    </form>
</div>

</body>
</html>


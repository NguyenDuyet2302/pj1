<?php
session_start();
ob_start();

include_once('asset/Config/connect.php');

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Nhà sách</title>
    <link rel="stylesheet" href="asset/css/base.css">
    <link rel="stylesheet" href="asset/css/main.css">
    <link rel="stylesheet" href="asset/font/fontawesome-free-6.7.2-web/css/all.min.css">
    <link rel="stylesheet" href="asset/bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="asset/bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
</head>
<body>

<?php
include_once('header.php');

if (isset($_GET['pageLayout'])) {
    switch ($_GET['pageLayout']) {
        case 'register':
            include_once('register.php');
            break;
        case 'login':
            include_once('login.php');
            break;
        case 'user_info':
            include_once('user_info.php');
            break;
        case 'cart':
            include_once('cart.php');
            break;
        case 'search':
            if (isset($_GET['pageLayout']) && $_GET['pageLayout'] == "search") {
                include_once('search.php');
            }
            break;
        case 'success':
            include_once('success.php');
            break;
        case 'history':
            include_once('history.php');
            break;
        case 'order_detail':
            include_once('order_detail.php');
            break;
        case 'product_detail':
            if (isset($_GET['book_id'])) {
                include_once('product_detail.php');
            } else {
                echo "<div class='container mt-5 alert alert-danger'>Không tìm thấy sản phẩm!</div>";
            }
            break;
        default:
            echo "<div class='container mt-5 alert alert-warning'>Trang không tồn tại!</div>";
            break;
    }
} else {
    include_once('dashboard.php');
}

include_once('footer.php');
?>

</body>
</html>

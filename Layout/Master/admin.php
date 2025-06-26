
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Sách</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="bootstrap-5.3.3-dist/js/bootstrap.min.js"></script>
    <script src="jquery.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link href="css/style.css" rel="stylesheet">
    <style>
        .sidebar {
            width: 250px;
            background-color: #343a40;
            height: 100vh;
            color: white;
            position: fixed;
            padding-top: 20px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            transition: 0.3s;
        }
        .sidebar a:hover {
            background-color: #495057;
        }
        .main-content {
            margin-left: 260px;
            padding: 20px;
        }
        .container {
            margin-left: 245px;
        }

    </style>
</head>
<body>
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar">
        <h3 class="text-center">Quản Lý Sách </h3>
        <ul class="nav flex-column">
            <!--                <li class="nav-item"><a class="nav-link text-white" href="?page=dashboard">Trang chủ</a></li>-->

            <h5 class="text-white mt-3">🔹 Quản lý danh mục</h5>
            <li class="nav-item"><a class="nav-link text-white" href="?page=categories">Danh mục sản phẩm</a></li>

            <h5 class="text-white mt-3">🔹 Quản lý sản phẩm</h5>
            <li class="nav-item"><a class="nav-link text-white" href="?page=books">Danh sách sản phẩm</a></li>

            <h5 class="text-white mt-3">🔹 Quản lý đơn hàng</h5>
            <li class="nav-item"><a class="nav-link text-white" href="?page=orders">Danh sách đơn hàng</a></li>
            <!--                <li class="nav-item"><a class="nav-link text-white" href="?page=order_details">Chi tiết đơn hàng</a></li>-->

            <h5 class="text-white mt-3">🔹 Quản lý người dùng</h5>
            <li class="nav-item"><a class="nav-link text-white" href="?page=customers">Danh sách khách hàng</a></li>
            <li class="nav-item"><a class="nav-link text-white" href="?page=users">Danh sách nhân viên</a></li>

            <!--                <h5 class="text-white mt-3">🔹 Báo cáo & Thống kê</h5>-->
            <!--                <li class="nav-item"><a class="nav-link text-white" href="?page=table">B-->
            <li><a href="Layout/Master/logout.php">
                    <button>Đăng xuất</button>
                </a></li>
        </ul>
    </div>
    <?php
    $page = isset($_GET['page']) ? $_GET['page'] : 'dashboard';

    switch ($page) {
//        case 'dashboard':
//                include 'Layout/dashboard.php';
//                break;
        case 'categories':
            include 'Layout/Category/categories.php';
            break;
        case 'books':
            include 'Layout/Product/books.php';
            break;
        case 'edit_product':
            include 'Layout/Product/edit_product.php';
            break;
        case 'delete_product':
            include 'Layout/Product/delete_product.php';
            break;
        case 'orders':
            include 'Layout/Order/orders.php';
            break;
        case 'order_details':
            include 'Layout/Order/order_detail.php';
            break;
        case 'customers':
            include 'Layout/Users/customers.php';
            break;
        case 'users':
            include 'Layout/Users/staff.php';
            break;
//            case 'table':
//                include 'Table/statistics.php';
//                break;
        default:
            echo " <h2 style=\"text-align: center; margin-left: 600px;\">Chào mừng bạn đến với trang quản trị</h2>";
            break;
    }
    ?>

    <!--        Main Content-->
    <!--        <div class
<?php
    //           $page = isset($_GET['page']) ? $_GET['page'] : 'books';
    //          include "admin.php";
    //          ?>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
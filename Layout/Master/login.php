<?php
$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1'; // tham số thứ 4 là csdl cần kết nối
$connect =  mysqli_connect($server, $username, $password, $database);
if (isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    // tim kiem ban ghi tuong ung trong csdl
    $sql = "SELECT * FROM users WHERE `user_name` = '$username' AND `user_password` = $password";
    $query = mysqli_query($connect, $sql);
    //  dem so luong ban ghi thoa man
    $check = mysqli_num_rows($query);
    // xac thuc du lieu va tao session
    if ($check == 1) {
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: index.php');
    }else {
        $error = '<div class="alert alert_danger">Tai khoan khong hop le! </div>';
    }
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
    font-family: Arial, sans-serif;
    display: flex;
    justify-content: center;
    align-items: center;
    height: 100vh;
    background-color: #f4f4f4;
    }

    .login-container {
    background: #fff;
    padding: 20px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    text-align: center;
    }

    input {
    display: block;
    width: 100%;
    margin: 10px 0;
    padding: 8px;
    }

    button {
    background: #007BFF;
    color: white;
    padding: 10px;
    border: none;
    cursor: pointer;
    }
    </style>
</head>
<body>
<div class="row">
    <div class="login-panel panel panel-default">
    <div class="panel-heading">Đăng nhập Admin</div>
    <div class="panel-body">
        <?php
        if (isset($error)) {
            echo $error;
        }
        ?>
    <form role="form" method="post">
        <fieldset>
            <div class="form-group">
                 <input class="form-control" type="text" placeholder="Tên đăng nhập" name="username" required>
            </div>
            <div class="form-group">
                 <input class="form-control" type="password" placeholder="Mật khẩu" name="password" required>
            </div>
        <button name="sbm" type="submit">Đăng nhập</button>
        </fieldset>
    </form>
    </div>
    </div>
</div>
<script src="script.js"></script>
</body>
</html>

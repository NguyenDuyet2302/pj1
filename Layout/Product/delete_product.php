<?php

$server = 'localhost'; // Tham số thứ 1 là máy chủ my sql
$username = 'root'; // tham số thứ 2 là tài khoản quản trị csdl
$password = ''; // tham số thứ 3 là mật khẩu quản trị csdl
$database = 'pj1(1)'; // tham số thứ 4 là csdl cần kết nối
$connect = mysqli_connect($server, $username, $password, $database);


$book_id = $_GET['book_id'];

$sql = "DELETE FROM books WHERE `book_id` = $book_id";
if (!mysqli_query($connect, $sql)) {
 die("❌ Lỗi xóa sản phẩm: " . mysqli_error($connect));
}else{
//mysqli_query($connect, $sql);

header('location: ?page_layout=books');
exit;
}
?>

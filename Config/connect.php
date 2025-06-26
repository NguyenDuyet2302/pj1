<?php

$server = 'localhost'; // Tham số thứ nhất là máy chủ CSDL
$username = 'root';// Tham số thứ 2 là tài khoản quản trị CSDL
$password = ''; // Tham số thứ 3 là mật khẩu quản trị CSDL
$database = 'pj1'; // Tham số thứ 4 là CSDL cần kết nối
global $connect;
$connect = mysqli_connect($server, $username, $password, $database); // Hàm connect yêu cầu 4 tham số đầu vào
?>
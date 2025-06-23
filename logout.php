<?php
session_start();
session_destroy(); // Xóa toàn bộ session
header("Location: layout_user.php"); // Chuyển hướng về trang chủ
exit();
?>


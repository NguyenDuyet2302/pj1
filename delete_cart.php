<?php
session_start();

// Kiểm tra xem có tham số book_id không
if (isset($_GET['book_id'])) {
    $book_id = $_GET['book_id'];

    // Xóa sản phẩm khỏi giỏ hàng nếu tồn tại
    if (isset($_SESSION['cart'][$book_id])) {
        unset($_SESSION['cart'][$book_id]);
    }

    // Kiểm tra nếu giỏ hàng trống thì xóa session
    if (empty($_SESSION['cart'])) {
        unset($_SESSION['cart']);
    }
}

// Chuyển hướng về trang giỏ hàng
header('Location: layout_user.php?pageLayout=cart');
exit();
?>

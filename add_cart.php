<?php
session_start();

// Kiểm tra dữ liệu đầu vào
if (isset($_GET['book_id']) && isset($_GET['qtt'])) {
    $book_id = intval($_GET['book_id']);
    $qtt = max(1, intval($_GET['qtt'])); // Đảm bảo số lượng tối thiểu là 1

    // Kiểm tra nếu sản phẩm đã có trong giỏ hàng
    if (isset($_SESSION['cart'][$book_id])) {
        $_SESSION['cart'][$book_id] = $qtt; // Cập nhật số lượng thay vì cộng dồn
    } else {
        $_SESSION['cart'][$book_id] = $qtt;
    }

    // Chuyển hướng đến giỏ hàng để hiển thị số lượng đúng
    header('Location: layout_user.php?pageLayout=cart');
    exit();
} else {
    die("Dữ liệu không hợp lệ!");
}
?>



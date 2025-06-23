<?php
include_once('header.php');

// Kiểm tra nếu người dùng chưa đăng nhập, chuyển hướng về trang chính
if (!isset($_SESSION['username'])) {
    header("Location: layout_user.php");
    exit();
}

// Xóa giỏ hàng sau khi đặt hàng thành công
unset($_SESSION['cart']);
?>

<div class="container my-5 text-center">
    <h2 class="text-success">🎉 Đặt hàng thành công!</h2>
    <p>Cảm ơn bạn đã đặt hàng. Chúng tôi sẽ xử lý đơn hàng của bạn trong thời gian sớm nhất.</p>
    <a href="layout_user.php" class="btn btn-primary">Tiếp tục mua sắm</a>
</div>

<?php include_once('footer.php'); ?>


<?php
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['login'])) {
    if (!empty($_POST['username']) && !empty($_POST['password'])) {
        $username = mysqli_real_escape_string($connect, $_POST['username']);
        $password = mysqli_real_escape_string($connect, $_POST['password']);

        // Truy vấn kiểm tra tài khoản
        $sql = "SELECT * FROM customers WHERE user_name = '$username'";
        $result = mysqli_query($connect, $sql);
        $row = mysqli_fetch_assoc($result);

        // Kiểm tra nếu có tài khoản
        if ($row) {
            // Nếu mật khẩu chưa được mã hóa, bạn cần kiểm tra theo dạng lưu hiện tại
            if ($password === $row['password']) {
                $_SESSION['username'] = $username;
                header('Location: layout_user.php'); // Chuyển hướng sau khi đăng nhập thành công
                exit();
            } else {
                echo '<div class="alert alert-danger">Tên đăng nhập hoặc mật khẩu không đúng</div>';
            }
        } else {
            echo '<div class="alert alert-danger">Tài khoản không tồn tại</div>';
        }
    } else {
        echo '<div class="alert alert-warning">Vui lòng nhập đầy đủ thông tin</div>';
    }
}
?>



<header>
    <?php
    include_once ('header.php');
//    include_once ('menu.php');
//    include_once ('banner.php');
//    include_once ('shopping.php');
    ?>
</header>
<form action="" method="post">
<div class="auth-form">
    <div class="auth-form__container">
        <div class="auth-form--header">
            <h3 class="auth-form__heading">Đăng nhập</h3>
            <span class="auth-form__switch-bin"><a class="auth-form__switch-bin-link" href="?pageLayout=register">Đăng ký</a></span>
        </div>


        <div class="auth-form__form">
            <div class="auth-form__group">
                <input type="text" name="username" class="auth-form__input" placeholder="Tên đăng nhập của bạn">
            </div>
            <div class="auth-form__group">
                <input type="password" name="password" class="auth-form__input" placeholder="Mật khẩu của bạn">
            </div>
        </div>

        <div class="auth-form__aside">
            <div class="auth-form__help">
                <a href="" class="auth-form__help-link auth-form__help-forgot">Quên mật khẩu</a>
                <span class="auth-form__help-separate"></span>
                <a href="" class="auth-form__help-link">Cần trợ giúp?</a>
            </div>
        </div>

        <div class="auth-form__controls">
            <button class="btn btn--normal auth-form__control-back">TRỞ LẠI</button>
            <button type="submit" class="btn btn--primary" name="login">ĐĂNG NHẬP</button>
        </div>
    </div>
</form>
<!--    <div class="auth-form__socials">-->
<!--        <a href="" class="auth-form__socials--facebook btn btn--size-s btn--width-icon">-->
<!--            <i class="auth-form__socials-icon fa-brands fa-square-facebook"></i>-->
<!--            <span class="auth-form__socials-title">-->
<!--                        Kết nối với Facebook-->
<!--                    </span>-->
<!--        </a>-->
<!--        <a href="" class="auth-form__socials--google btn btn--size-s btn--width-icon">-->
<!--            <i class="auth-form__socials-icon fa-brands fa-google"></i>-->
<!--            <span class="auth-form__socials-title">-->
<!--                        Kết nối với Google-->
<!--                    </span>-->
<!--        </a>-->
<!--    </div>-->
</div>

<footer>
    <?php include_once ('footer.php')?>
</footer>





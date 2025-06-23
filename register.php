<?php
if (isset($_POST['sbm'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $re_password = $_POST['re_password'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];

    // Kiểm tra xem số điện thoại đã tồn tại chưa
    $check_phone_query = "SELECT * FROM customers WHERE contact_info = '$phone'";
    $result = mysqli_query($connect, $check_phone_query);

    if (mysqli_num_rows($result) > 0) {
        $error = '<div class="alert alert-danger">Số điện thoại đã được sử dụng. Vui lòng chọn số khác.</div>';
    } elseif ($password == $re_password) {
        $sql = "INSERT INTO customers (`user_name`, `password`, `contact_info`, `shipping_address`)
                VALUES ('$username', '$password', '$phone', '$address')";
        mysqli_query($connect, $sql);
        $_SESSION['username'] = $username;
        $_SESSION['password'] = $password;
        header('location: layout_user.php');
    } else {
        $error1 = '<div class="alert alert-danger">Mật khẩu không đúng, nhập lại.</div>';
    }
}
?>

<header>
    <?php include_once('header.php'); ?>
</header>
<form method="post" action="">
    <div class="auth-form">
        <div class="auth-form__container">
            <div class="auth-form--header">
                <h3 class="auth-form__heading">Đăng ký</h3>
                <span class="auth-form__switch-bin">
                    <a class="auth-form__switch-bin-link" href="?pageLayout=login">Đăng nhập</a>
                </span>
            </div>
            <div class="auth-form__form">
                <div class="auth-form__group">
                    <?php
                    if (isset($error)) {
                        echo $error;
                    }
                    ?>
                    <input name="phone" type="text" class="auth-form__input" placeholder="SĐT của bạn">
                </div>
                <div class="auth-form__group">
                    <input name="username" type="text" class="auth-form__input" placeholder="Tên tài khoản của bạn">
                </div>
                <div class="auth-form__group">
                    <input name="address" type="text" class="auth-form__input" placeholder="Địa chỉ của bạn">
                </div>
                <div class="auth-form__group">
                    <input name="password" type="password" class="auth-form__input" placeholder="Mật khẩu của bạn">
                </div>
                <div class="auth-form__group">
                    <?php
                    if (isset($error1)) {
                        echo $error1;
                    }
                    ?>
                    <input name="re_password" type="password" class="auth-form__input" placeholder="Nhập lại mật khẩu">
                </div>
            </div>
            <div class="auth-form__aside">
                <p class="auth-form__policy-text">
                    Bằng việc đăng ký, bạn đã đồng ý với BOOKSHOP về
                    <a href="" class="auth-form__text-link">Điều khoản dịch vụ</a> &
                    <a href="" class="auth-form__text-link">Chính sách bảo mật</a>
                </p>
            </div>
            <div class="auth-form__controls">
                <button class="btn btn--normal auth-form__control-back">TRỞ LẠI</button>
                <button name="sbm" class="btn btn--primary">ĐĂNG KÝ</button>
            </div>
        </div>
    </div>
</form>
<footer>
    <?php include_once('footer.php'); ?>
</footer>

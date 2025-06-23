<?php
include_once('header.php');

$username = mysqli_real_escape_string($connect, $_SESSION['username']);

// Truy vấn thông tin khách hàng
$s_find_cus = "SELECT * FROM customers WHERE user_name = '$username'";
$q_find_cus = mysqli_query($connect, $s_find_cus);



// Kiểm tra kết quả truy vấn
$customer_info = mysqli_fetch_assoc($q_find_cus) ?? [];

$full_name = $customer_info['fullname'] ?? '';
$phone = $customer_info['contact_info'] ?? '';
$email = $customer_info['mail'] ?? '';
$address = $customer_info['shipping_address'] ?? '';

if (!$customer_info) {
    echo "<p style='color: red;'>Lỗi: Không tìm thấy thông tin khách hàng!</p>";
    $full_name = $phone = $email = $address = "";
} else {
    $full_name = htmlspecialchars($customer_info['fullname'] ?? '');
    $phone = htmlspecialchars($customer_info['contact_info'] ?? '');
    $email = htmlspecialchars($customer_info['mail'] ?? '');
    $address = htmlspecialchars($customer_info['shipping_address'] ?? '');
}


// Kiểm tra nếu form được gửi
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $full_name = mysqli_real_escape_string($connect, $_POST['customer_name']);
    $email = mysqli_real_escape_string($connect, $_POST['customer_email']);
    $phone = mysqli_real_escape_string($connect, $_POST['customer_phone']);
    $address = mysqli_real_escape_string($connect, $_POST['customer_address']);

    // Cập nhật thông tin vào cơ sở dữ liệu
    $sql_update = "UPDATE customers SET customer_name='$full_name', customer_phone='$phone', customer_email='$email', customer_address='$address' WHERE user_name='$username'";

    if (mysqli_query($connect, $sql_update)) {
        header("Location: profile.php?success=1");
        exit();
    } else {
        echo "Lỗi cập nhật: " . mysqli_error($connect);
    }
}
?>

<div class="container mt-5">
    <div class="card shadow-sm">
        <div class="card-header bg-danger text-white text-center">
            <h3>Thông Tin Khách Hàng</h3>
        </div>
        <div class="card-body">
            <form method="POST">
                <div class="mb-3">
                    <label for="customer_name" class="form-label">Họ tên</label>
                    <input type="text" class="form-control" name="customer_name" value="<?= htmlspecialchars($full_name) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="customer_phone" class="form-label">Số điện thoại</label>
                    <input type="text" class="form-control" name="customer_phone" value="<?= htmlspecialchars($phone) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="customer_email" class="form-label">Email</label>
                    <input type="email" class="form-control" name="customer_email" value="<?= htmlspecialchars($email) ?>" required>
                </div>
                <div class="mb-3">
                    <label for="customer_address" class="form-label">Địa chỉ</label>
                    <textarea class="form-control" name="customer_address" rows="3" required><?= htmlspecialchars($address) ?></textarea>
                </div>
                <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
                <a href="layout_user.php" class="btn btn-secondary">Quay lại</a>
            </form>
        </div>
    </div>
</div>

<?php include_once('footer.php'); ?>

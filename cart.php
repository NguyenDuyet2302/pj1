<?php
include_once('header.php');

// Kiểm tra đăng nhập
if (!isset($_SESSION['username'])) {
    header("Location: layout_user.php?pageLayout=login");
    exit();
}

// Kiểm tra giỏ hàng
if (empty($_SESSION['cart'])) {
    echo "<div class='alert alert-warning text-center mt-5'>Bạn chưa có sản phẩm nào trong giỏ hàng.</div>";
    include_once('footer.php');
    exit();
}

// Cập nhật số lượng sản phẩm
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['update_cart'])) {
    foreach ($_POST['qtt'] as $book_id => $quantity) {
        // Lấy số lượng tối đa của sản phẩm từ database
        $book_id = intval($book_id);
        $s_check_qtt = "SELECT book_qtt FROM books WHERE book_id = $book_id";
        $q_check_qtt = mysqli_query($connect, $s_check_qtt);
        $book_data = mysqli_fetch_assoc($q_check_qtt);
        $max_qtt = $book_data['book_qtt'];

        // Giới hạn số lượng đặt hàng không vượt quá tồn kho
        $_SESSION['cart'][$book_id] = max(1, min(intval($quantity), $max_qtt));
    }
}


// Lấy danh sách sản phẩm trong giỏ hàng
$ids = implode(",", array_map('intval', array_keys($_SESSION['cart'])));
$s_show_cart = "SELECT * FROM books WHERE book_id IN ($ids)";
$q_show_cart = mysqli_query($connect, $s_show_cart);
$total = 0;

// Lấy thông tin người dùng
$username = mysqli_real_escape_string($connect, $_SESSION['username']);
$s_find_cus = "SELECT * FROM customers WHERE user_name = '$username'";
$q_find_cus = mysqli_query($connect, $s_find_cus);
$customer_info = mysqli_fetch_assoc($q_find_cus);

// Thực hiện chức năng mua hàng
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['order'])) {
    $customer_id = $customer_info['user_id'] ?? null;
    $staff_id = 1;
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date_buy = date('Y-m-d H:i:s');
    $total = $_SESSION['total_price'] ?? 0;
    $order_status = 1;

    // Lấy thông tin người mua hộ từ form (thay đổi thông tin khách hàng nếu có)
    $buyer_name = mysqli_real_escape_string($connect, $_POST['customer_name'] ?? '');
    $buyer_phone = mysqli_real_escape_string($connect, $_POST['customer_phone'] ?? '');
    $buyer_address = mysqli_real_escape_string($connect, $_POST['customer_address'] ?? '');

    // Thêm đơn hàng mới (lưu thông tin người mua hộ)
    $s_add_order = "INSERT INTO orders 
        (`cus_id`, `staff_id`, `order_date`, `total_price`, `order_status`, `buyer_name`, `buyer_phone`, `buyer_address`)
        VALUES 
        ($customer_id, $staff_id, '$date_buy', $total, $order_status, '$buyer_name', '$buyer_phone', '$buyer_address')";

    $q_add_order = mysqli_query($connect, $s_add_order);

    if ($q_add_order) {
        $ord_id = mysqli_insert_id($connect);

        foreach ($_SESSION['cart'] as $book_id => $order_detail_quantity) {
            $book_id = intval($book_id);
            $s_find_book = "SELECT price, book_qtt FROM books WHERE book_id = $book_id";
            $q_find_book = mysqli_query($connect, $s_find_book);
            $book_info = mysqli_fetch_assoc($q_find_book);
            $order_detail_price = $book_info['price'];
            $new_quantity = max(0, $book_info['book_qtt'] - $order_detail_quantity);

            $s_update_prd = "UPDATE books SET book_qtt = $new_quantity WHERE book_id = $book_id";
            mysqli_query($connect, $s_update_prd);

            $s_add_order_detail = "INSERT INTO order_details 
                (`book_id`, `order_id`, `order_detail_price`, `order_detail_quantity`)
                VALUES 
                ($book_id, $ord_id, $order_detail_price, $order_detail_quantity)";
            mysqli_query($connect, $s_add_order_detail);
        }

        header('Location: layout_user.php?pageLayout=success');
        exit();
    }
}

?>

<!-- Giao diện hiển thị giỏ hàng -->
<div class="container my-5">
    <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>
    <form method="POST">
        <div class="row">
            <!-- Phần sản phẩm -->
            <div class="col-lg-8">
                <?php while ($row = mysqli_fetch_assoc($q_show_cart)) :
                    $book_id = $row['book_id'];
                    $qtt = $_SESSION['cart'][$book_id];
                    $subtotal = $row['price'] * $qtt;
                    $total += $subtotal;
                    $_SESSION['total_price'] = $total;
                    ?>
                    <div class="card mb-3 p-3">
                        <div class="row g-2 align-items-center">
                            <div class="col-3 col-md-2 text-center">
                                <img src="asset/img/<?= htmlspecialchars($row['image_url']) ?>" class="img-fluid rounded" style="max-height: 100px; object-fit: cover;">
                            </div>
                            <div class="col-9 col-md-7">
                                <h6 class="mb-1"><?= htmlspecialchars($row['title']) ?></h6>
                                <p class="mb-1 small text-muted">Giá: <?= number_format($row['price']) ?> đ</p>
                                <div class="d-flex align-items-center">
                                    <label for="qtt_<?= $book_id ?>" class="me-2 mb-0 small">Số lượng:</label>
                                    <input type="number" id="qtt_<?= $book_id ?>" name="qtt[<?= $book_id ?>]"
                                           value="<?= $qtt ?>" min="1" max="<?= $row['book_qtt'] ?>"
                                           class="form-control form-control-sm" style="width: 70px;">
                                </div>
                                <p class="mt-2 mb-0"><small><strong>Tạm tính: <?= number_format($subtotal) ?> đ</strong></small></p>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="delete_cart.php?book_id=<?= $book_id ?>" class="btn btn-sm btn-outline-danger">Xoá</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>

                <div class="d-flex justify-content-between align-items-center mt-3">
                    <h5>Tổng cộng: <?= number_format($total) ?> đ</h5>
                    <button type="submit" name="update_cart" class="btn btn-warning">Cập nhật giỏ hàng</button>
                </div>
            </div>

            <!-- Phần thông tin khách hàng -->
            <div class="col-lg-4 mt-4 mt-lg-0">
                <div class="card p-4 shadow-sm">
                    <h4 class="mb-3">Thông tin khách hàng</h4>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="customer_name" class="form-label">Họ tên</label>
                            <input type="text" class="form-control" name="customer_name"
                                   value="<?= htmlspecialchars($_POST['customer_name'] ?? $customer_info['fullname']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" name="customer_phone"
                                   value="<?= htmlspecialchars($_POST['customer_phone'] ?? $customer_info['contact_info']) ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="customer_address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" name="customer_address" rows="3" required><?= htmlspecialchars($_POST['customer_address'] ?? $customer_info['shipping_address']) ?></textarea>
                        </div>

                        <button type="submit" name="order" class="btn btn-success w-100">Đặt hàng</button>
                    </form>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include_once('footer.php'); ?>

<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Giỏ hàng</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container my-5">
    <h2 class="text-center mb-4">Giỏ hàng của bạn</h2>

    <form>
        <div class="row">
            <!-- PHẦN SẢN PHẨM -->
            <div class="col-lg-8 mb-4">
                <div class="card p-3 shadow-sm">

                    <!-- 1 SẢN PHẨM -->
                    <div class="row align-items-center border-bottom py-3">
                        <div class="col-3">
                            <img src="https://via.placeholder.com/100" class="img-fluid rounded shadow">
                        </div>
                        <div class="col-6">
                            <h5>Tên sách ví dụ</h5>
                            <p class="mb-1">Giá: <strong>100.000 đ</strong></p>
                            <p class="mb-1">Tạm tính: <strong>200.000 đ</strong></p>
                        </div>
                        <div class="col-3 text-end">
                            <input type="number" value="2" min="1" class="form-control mb-2">
                            <button class="btn btn-sm btn-danger">Xoá</button>
                        </div>
                    </div>

                    <!-- Thêm nhiều sản phẩm ở đây nếu muốn -->

                </div>
            </div>

            <!-- PHẦN THÔNG TIN KHÁCH HÀNG -->
            <div class="col-lg-4">
                <div class="card p-4 shadow-sm">
                    <h5>Thông tin khách hàng</h5>

                    <div class="mb-3">
                        <label for="name" class="form-label">Họ tên</label>
                        <input type="text" id="name" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="phone" class="form-label">Số điện thoại</label>
                        <input type="text" id="phone" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" id="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label for="address" class="form-label">Địa chỉ giao hàng</label>
                        <textarea id="address" class="form-control" rows="3" required></textarea>
                    </div>

                    <hr>
                    <h5 class="text-end">Tổng tiền: <strong>200.000 đ</strong></h5>

                    <div class="d-grid gap-2 mt-3">
                        <button type="submit" class="btn btn-outline-primary">Cập nhật giỏ hàng</button>
                        <button type="submit" class="btn btn-success">Đặt hàng</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

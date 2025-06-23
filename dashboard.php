<?php
// Lấy danh mục từ URL nếu có
$category_id = isset($_GET['category_id']) ? $_GET['category_id'] : '';

// Lấy danh sách danh mục
$sql = "SELECT * FROM categories ORDER BY category_id ASC LIMIT 8";
$query = mysqli_query($connect, $sql);

// Truy vấn sản phẩm theo danh mục được chọn
$sql_product = "SELECT * FROM books";
if ($category_id) {
    $sql_product .= " WHERE category_id = '$category_id'";
}
$sql_product .= " ORDER BY book_id DESC LIMIT 8"; // Chỉ lấy 8 sản phẩm
$query_product = mysqli_query($connect, $sql_product);
?>

<!-- Nhúng Bootstrap 5 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<header>
    <?php include_once('header.php'); ?>
</header>
<div class="wrap-container">
    <div class="container">
        <div class="row">
            <!-- Menu danh mục -->
            <div class="col-12 col-md-2 app__container">
                <nav class="category">
                    <h3 class="category__heading">
                        <i class="category__heading-icon fa-solid fa-list"></i> Danh mục
                    </h3>
                    <ul class="category-list">
                        <li class="category-item">
                            <a href="layout_user.php" class="category-item__link">Tất cả sản phẩm</a>
                        </li>
                        <?php while ($item = mysqli_fetch_array($query)) { ?>
                            <li class="category-item">
                                <a href="?category_id=<?= $item['category_id'] ?>" class="category-item__link">
                                    <?= $item['category_name'] ?>
                                </a>
                            </li>
                        <?php } ?>
                    </ul>
                </nav>
            </div>

            <!-- Nội dung sản phẩm -->
            <div class="col-12 col-md-10 home-product-wrap">
                <div class="home-product">
                    <img class="sale-img img-fluid" src="asset/img/sale.png" alt="">

                    <?php
                    $category_name = "Tất cả sản phẩm";
                    if ($category_id) {
                        $sql_category_name = "SELECT category_name FROM categories WHERE category_id = '$category_id'";
                        $query_category_name = mysqli_query($connect, $sql_category_name);
                        $row_category_name = mysqli_fetch_assoc($query_category_name);
                        $category_name = $row_category_name['category_name'];
                    }
                    ?>
                    <h2 class="header-home-product mt-3 mb-4"><?= $category_name ?></h2>

                    <div class="row g-3">
                        <?php while ($item = mysqli_fetch_array($query_product)) { ?>
                            <div class="col-6 col-md-3">
                                <div class="home-product-wrap">
                                    <a class="home-product-item d-block text-decoration-none" href="?pageLayout=product_detail&book_id=<?= $item['book_id'] ?>">
                                        <img src="asset/img/<?= $item['image_url'] ?>" alt="<?= $item['title'] ?>" class="home-product-item__img img-fluid">
                                        <h4 class="home-product-item__name"><?= $item['title'] ?></h4>
                                        <div class="home-product-item__price">
                                            <span class="home-product-item__price-old"><?= number_format($item['old_price']) ?>đ</span>
                                            <span class="home-product-item__price-current"><?= number_format($item['price']) ?>đ</span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<footer>
    <?php include_once('footer.php'); ?>
</footer>

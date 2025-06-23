<?php

if (isset($_GET['book_id'])) {
    $book_id = intval($_GET['book_id']);
    // Kiểm tra SQL
    $sql_product = "SELECT b.book_id, b.title, b.image_url, b.price, b.book_qtt,
                       GROUP_CONCAT(a.name SEPARATOR ', ') AS authors, 
                       p.name AS publisher_name, 
                       b.book_year, b.form, b.page, b.description 
                FROM books b 
                JOIN book_authors ba ON b.book_id = ba.book_id 
                JOIN authors a ON ba.author_id = a.author_id 
                JOIN publishers p ON b.publisher_id = p.publisher_id
                WHERE b.book_id = ?
                GROUP BY b.book_id";

    $stmt = $connect->prepare($sql_product);
    if (!$stmt) {
        die("Lỗi prepare(): " . $connect->error);
    }

    $stmt->bind_param("i", $book_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $val = $result->fetch_assoc();
    } else {
        die("Sản phẩm không tồn tại!");
    }
} else {
    die("Không có ID sản phẩm được truyền!");
}
?>

<header>
    <?php include_once ('header.php')?>
</header>

<h1 class="product-header"><?= htmlspecialchars($val['title']) ?></h1>
<main class="container">
    <section class="product">
        <div class="image-wrapper">
            <img src="asset/img/<?= htmlspecialchars($val['image_url']) ?>" alt="<?= htmlspecialchars($val['title']) ?>" />
        </div>
        <div class="details">
            <h2>Thông tin sản phẩm</h2>
            <ul>
                <li><strong>Tác giả:</strong> <?= htmlspecialchars($val['authors']) ?></li>
                <li><strong>Nhà xuất bản:</strong> <?= htmlspecialchars($val['publisher_name']) ?></li>
                <li><strong>Năm xuất bản:</strong> <?= htmlspecialchars($val['book_year']) ?></li>
                <li><strong>Hình thức:</strong> <?= htmlspecialchars($val['form']) ?></li>
                <li><strong>Số trang:</strong> <?= htmlspecialchars($val['page']) ?></li>
                <li><strong>Giá:</strong> <?= number_format($val['price']) ?> đ</li>
            </ul>
            <div class="qtt">
                <?php
                if (isset($_GET['buy'])) {
                    $qtt = intval($_GET['qtt']);
                    header('Location: add_cart.php?book_id=' . $val['book_id'] . '&qtt=' . $qtt);
                    exit();
                }
                ?>
                <form action="add_cart.php" method="get">
                    <input type="hidden" name="book_id" value="<?= $val['book_id'] ?>">
                    <label for="qtt">Số lượng:</label>
                    <input type="number" id="qtt" name="qtt" value="1" min="1" max="<?= $val['book_qtt'] ?>">
                    <div class="buttons">
                        <input type="submit" name="buy" class="buy-now-btn" value="Thêm vào giỏ hàng">
                    </div>
                </form>

            </div>

            <section class="description">
                <h2>Mô tả sản phẩm</h2>
                <p><?= nl2br(htmlspecialchars($val['description'])) ?></p>
            </section>
        </div>
    </section>
</main>

<footer>
    <?php include_once('footer.php'); ?>
</footer>

<?php

include_once('header.php'); // Include header để giữ bố cục đồng nhất

if (isset($_GET['keyword'])) {
    $keyword = mysqli_real_escape_string($connect, $_GET['keyword']);

    $s_search = "SELECT books.*, authors.name 
                 FROM books
                 JOIN book_authors ON books.book_id = book_authors.book_id
                 JOIN authors ON book_authors.author_id = authors.author_id
                 WHERE books.title LIKE '%$keyword%' 
                 OR authors.name LIKE '%$keyword%'";

    $q_search = mysqli_query($connect, $s_search);
    ?>

    <div class="container mt-5">
        <h2 class="text-center mb-4">Kết quả tìm kiếm cho: <strong><?= htmlspecialchars($keyword) ?></strong></h2>

        <div class="row">
            <?php if (mysqli_num_rows($q_search) > 0): ?>
                <?php while ($row = mysqli_fetch_assoc($q_search)): ?>
                    <div class="col-md-4 mb-4">
                        <div class="card h-100 shadow-sm">
                            <img src="asset/img/<?= htmlspecialchars($row['image_url']) ?>" class="card-img-top" alt="<?= htmlspecialchars($row['title']) ?>">
                            <div class="card-body">
                                <h5 class="card-title"><?= htmlspecialchars($row['title']) ?></h5>
                                <p class="card-text"><strong>Tác giả:</strong> <?= htmlspecialchars($row['name']) ?></p>
                                <p class="card-text text-danger"><strong>Giá:</strong> <?= number_format($row['price']) ?> đ</p>
                                <a href="?pageLayout=product_detail&book_id=<?= $row['book_id'] ?>" class="btn btn-primary w-100">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p class="text-center text-muted">Không tìm thấy sản phẩm nào phù hợp.</p>
            <?php endif; ?>
        </div>
    </div>

    <?php
}
include_once('footer.php');
?>

<?php
$sql = "SELECT * FROM categories ORDER BY category_id ASC LIMIT 8";
$query = mysqli_query($connect, $sql);
$row = mysqli_num_rows($query);
$totalRow = ceil($row / 2);
?>

<div class="app__container">
    <div class="grid">
        <div class="grid__row">
            <div class="grid__column-2">
                <nav class="category">
                    <h3 class="category__heading">
                        <i class="category__heading-icon fa-solid fa-list"></i>
                        Danh mục
                    </h3>
                    <ul class="category-list">
                        <?php
                        while ($item = mysqli_fetch_array($query)) {
                            ?>
                            <li class="category-item category-item--active">
                                <a href="#" class="category-item__link"><?= $item['category_name'] ?></a>
                            </li>
                            <?php
                        }
                        ?>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>


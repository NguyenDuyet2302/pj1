<?php
$conn = new mysqli("localhost", "root", "", "pj1");

$sql = "SELECT * FROM categories";
$result = $conn->query($sql);
?>

<div class="container" >
    <h2>Danh sách Danh mục 📖</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Tên Danh mục</th>
            <th>Mô tả</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
<?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
              <td><?= $row['category_id'] ?></td>
              <td><?= $row['category_name'] ?></td>
              <td><?= $row['description'] ?></td>
              <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

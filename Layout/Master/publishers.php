<?php
$conn = new mysqli("localhost", "root", "", "pj1");

$sql = "SELECT * FROM publishers";
$result = $conn->query($sql);
?>

<div class="container">
    <h2>Danh sách Nhà xuất bản</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Tên Nhà xuất bản</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
           <tr>
                <td><?= $row['publisher_id'] ?></td>
                <td><?= $row['name'] ?></td>
                <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>

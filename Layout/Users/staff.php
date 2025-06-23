<?php

?>
<?php
$conn = new mysqli("localhost", "root", "", "pj1");

$sql = "SELECT * FROM users";
$result = $conn->query($sql);
?>

<div class="container"  >
    <h2>Danh sách Nhân viên 👤</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID</th>
            <th>Tên </th>
            <th>Mật khẩu</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $result->fetch_assoc()) { ?>
            <tr>
                <td><?= $row['user_id'] ?></td>
                <td><?= $row['user_name'] ?></td>
                <td><?= $row['user_password'] ?></td>
                <td><button class="btn btn-danger btn-sm">Xóa</button></td>
            </tr>
        <?php } ?>
        </tbody>
    </table>
</div>


<?php
//$conn = new mysqli("localhost", "root", "", "bookstore");
//
//$sql = "SELECT * FROM reviews";
//$result = $conn->query($sql);
//?>

<div class="container">
    <h2>Danh sách Đánh giá</h2>
    <table class="table table-bordered">
        <thead class="thead-dark">
        <tr>
            <th>ID Đánh giá</th>
            <th>ID Người dùng</th>
            <th>ID Sách</th>
            <th>Điểm Đánh giá</th>
            <th>Nhận xét</th>
            <th>Ngày đánh giá</th>
            <th>Hành động</th>
        </tr>
        </thead>
        <tbody>
<!--        --><?php //while ($row = $result->fetch_assoc()) { ?>
<!--            <tr>-->
<!--                <td>--><?//= $row['Review_ID'] ?><!--</td>-->
<!--                <td>--><?//= $row['User_ID'] ?><!--</td>-->
<!--                <td>--><?//= $row['Book_ID'] ?><!--</td>-->
<!--                <td>--><?//= $row['Rating'] ?><!--⭐</td>-->
<!--                <td>--><?//= $row['Comments'] ?><!--</td>-->
<!--                <td>--><?//= $row['Review_Date'] ?><!--</td>-->
<!--                <td><button class="btn btn-danger btn-sm">Xóa</button></td>-->
<!--            </tr>-->
<!--        --><?php //} ?>
        </tbody>
    </table>
</div>

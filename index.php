<?php
// khai báo đối tượng
ob_start();
// Khai báo session
session_start();
// khai báo 1 hằng để kiểm soát vc truy cập
define('SECURITY', true);
include_once('asset/Config/connect.php');
include_once('Layout/Master/admin.php');
?>

<?php
//if (!file_exists('../../Config/connect.php')) {
//echo "⚠️ File Config/connect.php không tồn tại hoặc sai đường dẫn!";
//}
//if (!file_exists('../Layout/Master/admin.php')) {
//echo "⚠️ File Layout/Master/admin.php không tồn tại!";
//}
//?>
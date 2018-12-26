<?php
$conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
// Câu truy vấn
$sql = 'DELETE FROM CUSTOMERS WHERE customerNumber = ' . $_GET['customerNumber'] . '';
mysqli_set_charset($conn, 'UTF8');
$result = $conn->query($sql);
if (!$result) {
    die ('Câu truy vấn bị sai');
} else {
    header('Location: index.php');
}
?>
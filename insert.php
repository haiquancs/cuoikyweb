<?php include "head.php"; ?>
<?php
echo '<bre>';
if (isset($_POST['name'])||isset($_POST['phone'])||isset($_POST['address'])||isset($_POST['city'])||isset($_POST['country'])) {
    $conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
    // Câu truy vấn
    $sql = "INSERT INTO CUSTOMERS (customerName, phone, addressLine1, city, country) VALUE ('".$_POST['name']."','".$_POST['phone']."','".$_POST['address']."','".$_POST['city']."','".$_POST['country']."')";
    mysqli_set_charset($conn, 'UTF8');
    $result = $conn->query($sql);
    if (!$result) {
        die ('Câu truy vấn bị sai');
    }else{
        header('Location: index.php');
    }
}
?>
<div class="container">
    <h1 style="text-align: center">Thêm Dữ Liệu</h1>
    <form action="insert.php" method="POST">
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Tên :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Nhập Tên" name="name">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Điện Thoại :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Nhập Điện Thoại" name="phone">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Địa Chỉ :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Nhập Địa Chỉ" name="address">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Thành Phố :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Nhập Thành Phố" name="city">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Đất Nước :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" placeholder="Nhập Đất Nước" name="country">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Thêm</button>&nbsp
        <a class="btn btn-dark" href="index.php">Trở Về</a>
    </form>
</div>
<?php include "tail.php"; ?>

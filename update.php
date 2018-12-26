<?php include "head.php"; ?>
<?php
echo '<bre>';
if (isset($_POST['name'])||isset($_POST['phone'])||isset($_POST['address'])||isset($_POST['city'])||isset($_POST['country'])) {
//    Không Validate
    $conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
    // Câu truy vấn
    $sql = "UPDATE CUSTOMERS SET customerName = '".$_POST['name']."', phone = '".$_POST['phone']."', addressLine1 = '".$_POST['address']."', city = '".$_POST['city']."', country = '".$_POST['country']."' WHERE customerNumber = ".$_POST['code']."";
    mysqli_set_charset($conn, 'UTF8');
    $result = $conn->query($sql);
    if (!$result) {
        die ('Câu truy vấn bị sai');
    }else{
        header('Location: index.php');
    }
//    Có Validate
}
?>
<div class="container">
    <?php
    $conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
    // Câu truy vấn
    $sql = 'SELECT * FROM CUSTOMERS WHERE customerNumber = '. $_GET['customerNumber'] .'';
    mysqli_set_charset($conn, 'UTF8');
    $result = mysqli_query($conn,$sql);
    if (!$result) {
        die ('Câu truy vấn bị sai');
    }
    $row = mysqli_fetch_array($result,MYSQLI_ASSOC);
    ?>
    <h1 style="text-align: center">Thêm Dữ Liệu</h1>
    <form action="update.php" method="POST">
        <div class="form-group row">
            <input type="hidden" name="code" value="<?php echo $_GET['customerNumber']; ?>">
            <label for="inputPassword" class="col-sm-2 col-form-label">Tên :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" name="name" value="<?php echo $row['customerName']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Điện Thoại :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword"  name="phone" value="<?php echo $row['phone']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Địa Chỉ :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" name="address" value="<?php echo $row['addressLine1']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Thành Phố :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" name="city" value="<?php echo $row['city']; ?>">
            </div>
        </div>
        <div class="form-group row">
            <label for="inputPassword" class="col-sm-2 col-form-label">Đất Nước :</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="inputPassword" name="country" value="<?php echo $row['country']; ?>">
            </div>
        </div>
        <button type="submit" class="btn btn-success">Sửa</button>&nbsp
        <a class="btn btn-dark" href="index.php">Trở Về</a>
    </form>
</div>
<?php include "tail.php"; ?>

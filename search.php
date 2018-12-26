<?php include "head.php"; ?>
    <div style="margin: auto">
        <h1 style="text-align: center">Tìm Kiếm</h1>
        <div class="row" style="margin: auto">
            <form class="form-inline" action="search.php" method="POST" style="margin: auto; width: 60%">
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInput" <?php if (@$_POST['id']) {
                        echo 'value="' . $_POST['id'] . '"';
                    }
                    echo 'placeholder="Mã"'; ?> name="id">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInputGroup" <?php if (@$_POST['name']) {
                        echo 'value="' . $_POST['name'] . '"';
                    }
                    echo 'placeholder="Tên"'; ?> name="name">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInputGroup" <?php if (@$_POST['phone']) {
                        echo 'value="' . $_POST['phone'] . '"';
                    }
                    echo 'placeholder="Điện Thoại"'; ?> name="phone">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInputGroup" <?php if (@$_POST['address']) {
                        echo 'value="' . $_POST['address'] . '"';
                    }
                    echo 'placeholder="Địa Chỉ"'; ?> name="address">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInputGroup" <?php if (@$_POST['city']) {
                        echo 'value="' . $_POST['city'] . '"';
                    }
                    echo 'placeholder="Thành Phố"'; ?> name="city">
                    <input type="text" class="form-control mb-2 mr-sm-2 mb-sm-0"
                           id="inlineFormInputGroup" <?php if (@$_POST['country']) {
                        echo 'value="' . $_POST['country'] . '"';
                    }
                    echo 'placeholder="Đất Nước"'; ?> name="country">
                    <button type="submit" class="btn btn-info">Tìm Kiếm</button>
                    &nbsp
                    <a class="btn btn-dark" href="index.php">Trở Về</a>
                    &nbsp
                    <a class="btn btn-warning" href="search.php">Reset</a>
                </div>
            </form>
        </div>
        <br>
    </div>
    <div class="container">
        <div class="row">
            <table class="table table-sm table-bordered table-dark" id="quan">
                <thead>
                <tr>
                    <th scope="col">STT</th>
                    <th scope="col">Mã</th>
                    <th scope="col">Tên</th>
                    <th scope="col">Điện Thoại</th>
                    <th scope="col">Địa Chỉ</th>
                    <th scope="col">Thành Phố</th>
                    <th scope="col">Đất Nước</th>
                </tr>
                </thead>
                <tbody>
                <?php
                $conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
                // Câu truy vấn
                $sql = 'SELECT * FROM CUSTOMERS';
                if (@$_POST['id'] || @$_POST['name'] || @$_POST['phone'] || @$_POST['address'] || @$_POST['city'] || @$_POST['country']) {
                    // Câu truy vấn
                    $sql = "SELECT * FROM CUSTOMERS WHERE customerName 
                    LIKE '%" . $_POST['name'] . "%' 
                    AND customerNumber LIKE '%" . $_POST['id'] . "%' 
                    AND phone LIKE '%" . $_POST['phone'] . "%' 
                    AND addressLine1 LIKE '%" . $_POST['address'] . "%' 
                    AND city LIKE '%" . $_POST['city'] . "%' 
                    AND country LIKE '%" . $_POST['country'] . "%'";
                }
                mysqli_set_charset($conn, 'UTF8');
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die ('Câu truy vấn bị sai');
                } else {
                    $i = 1;
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo '<tr>
                    <th scope="row">' . $i . '</th>
                    <td>' . $row['customerNumber'] . '</td>
                    <td>' . $row['customerName'] . '</td>
                    <td>' . $row['phone'] . '</td>
                    <td>' . $row['addressLine1'] . '</td>
                    <td>' . $row['city'] . '</td>
                    <td>' . $row['country'] . '</td>
                    </tr>';
                        $i++;
                    }
                }
                mysqli_free_result($result);
                // Ngắt kết nối
                mysqli_close($conn);
                ?>
                </tbody>
            </table>
        </div>
    </div>
<?php include "tail.php"; ?>
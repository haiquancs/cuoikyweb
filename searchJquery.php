<?php include "head.php"; ?>
    <script>
        $(document).ready(function(){
            $("#search").on("keyup", function() {
                var value = $(this).val().toLowerCase();
                $("#myTable tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });
    </script>
    <div style="margin: auto">
        <h1 style="text-align: center">Tìm Kiếm</h1>
        <div class="row" style="margin: auto">
            <div style="margin: auto; width: 54%">
                <div class="input-group mb-2 mr-sm-2 mb-sm-0">
                    <input id="search" class="form-control" type="text" placeholder="Nhập Dữ Liệu Tìm Kiếm">
                    &nbsp
                    <a class="btn btn-dark" href="index.php" style="vertical-align: center">Trở Về</a>
                </div>
            </div>
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
                <tbody id="myTable">
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
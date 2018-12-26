<?php include "head.php"; ?>
<!--Xóa-->

<div class="container">
<!--    Chức Năng-->
    <div class="card-tools">
        <label>Chức năng : </label>
        <a class="btn btn-success" href="insert.php">Thêm Dữ Liệu</a>
        <a class="btn btn-info" href="search.php">Tìm Kiếm</a>
        <a class="btn btn-info" href="searchJquery.php">Tìm Kiếm Jquery</a>
        <a class="btn btn-danger" href="listJoinQuestions.php">Các Dạng Join</a>
    </div>
    <br>
<!--    Tìm Kiếm Jquery-->
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
<!--    Bảng Kết Quả-->
    <h1 style="text-align: center">Bảng Kết Quả</h1>
    <table class="table table-sm table-bordered table-dark" id="quan">
        <thead>
        <tr>
            <th>STT</th>
            <th>Mã</th>
            <th>Tên</th>
            <th style="width: 18%">Điện Thoại</th>
            <th style="width: 18%">Địa Chỉ</th>
            <th>Thành Phố</th>
            <th style="width: 8%">Đất Nước</th>
            <th style="width: 25%">Chức Năng</th>
        </tr>
        </thead>
        <tbody id="myTable">
        <!--Hiển Thị-->
        <?php
        $conn = mysqli_connect('localhost', 'root', '', 'classicmodels') or die ('Lỗi kết nối server');
        // Câu truy vấn
        $sql = 'SELECT * FROM CUSTOMERS';
        mysqli_set_charset($conn, 'UTF8');
        $result = mysqli_query($conn, $sql);
        if (!$result) {
            die ('Câu truy vấn bị sai');
        }
        //        Biến dữ liệu thu được thành mảng
        //        while ($row = mysqli_fetch_assoc($result)) {
        //            $data[] = $row;
        //        }
        //        echo '<pre>';
        //        print_r($data);
        //        echo '<pre>';
        //        die();
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
            <td><div class="row"><div class="col-md-3"><a class="btn btn-success" href="update.php?customerNumber=' . $row['customerNumber'] . '">Sửa</a></div>
                <div class="col-md-6"><button type="button" class="btn btn-success" data-customerNumber="' . $row['customerNumber'] . '" data-customerName="' . $row['customerName'] . '" data-phone="' . $row['phone'] . '" data-addressLine1="' . $row['addressLine1'] . '" data-city="' . $row['city'] . '" data-country="' . $row['country'] . '">Sửa Modal</button></div
                <div class="col-md-4"><a class="btn btn-danger" href="delete.php?customerNumber=' . $row['customerNumber'] . '">Xóa</a></div></div></td>
            </tr>';
            $i++;
        }
        echo '<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog">
                  <div class="modal-dialog" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Thông tin</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                          <span aria-hidden="true">&times;</span>
                        </button>
                      </div>
                      <div class="modal-body">
                        <form action="update.php" method="POST">
                          <input type="hidden" name="code">
                          <div class="form-group">
                            <label class="col-form-label">Tên :</label>
                            <input type="text" class="form-control" name="name">
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Điện Thoại :</label>
                            <input type="text" class="form-control" name="phone">
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Địa Chỉ :</label>
                            <input type="text" class="form-control" name="address">
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Thành Phố :</label>
                            <input type="text" class="form-control" name="city">
                          </div>
                          <div class="form-group">
                            <label class="col-form-label">Đất Nước :</label>
                            <input type="text" class="form-control" name="country">
                          </div>
                          <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                            <button type="submit" class="btn btn-success">Sửa</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>';
        mysqli_free_result($result);
        // Ngắt kết nối
        mysqli_close($conn);
        ?>
        <script>
            $(document).ready(function () {
                $("button").on("click", function () {
                    $("#exampleModal").find("input[name='code']").attr("value",$(this).attr("data-customerNumber"));
                    $("#exampleModal").find("input[name='name']").attr("value",$(this).attr("data-customerName"));
                    $("#exampleModal").find("input[name='phone']").attr("value",$(this).attr("data-phone"));
                    $("#exampleModal").find("input[name='address']").attr("value",$(this).attr("data-addressLine1"));
                    $("#exampleModal").find("input[name='city']").attr("value",$(this).attr("data-city"));
                    $("#exampleModal").find("input[name='country']").attr("value",$(this).attr("data-country"));
                    $("#exampleModal").modal();
                });
            });
            $(document).ready(function(){
                $("#search").on("keyup", function() {
                    var value = $(this).val().toLowerCase();
                    $("#myTable tr").filter(function() {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        </script>
        </tbody>
    </table>
</div>
<?php include "tail.php"; ?>


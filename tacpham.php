<?php
// kết nối cơ sở dữ liệu
	include 'db-func.php';
	$conn=mysqli_connect("localhost","root","","hoivien") or die("không thể kết nối");
	mysqli_query($conn,"SET NAME 'utf8'");
	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
// xử lý dữ liệu$cb 
	global $id	,$name,$date, $cmd, $cb ,$rd ;
	$tbgv='tacgia_tacpham';
	if(isset($_POST['id'])) 	$id		= $_POST['id'];
	if(isset($_POST['name']))  	$name 	= $_POST['name'];
	if(isset($_POST['date']))  	$date 	= $_POST['date'];
	if(isset($_POST['cmd']))  	$cmd 	= $_POST['cmd'];

	if(isset($_POST['cb'])) 	$cb 	= $_POST['cb'];
	if(isset($_POST['rd']))  	$rd 	= $_POST['rd'];
// xử lý nút
	if(isset($cmd)){
		switch ($cmd) {
			case 'Thêm':

			if((isset($name) && isset($id)) && (!empty($name) && !empty($id))){
				mh_add_row($conn,$tbgv,$id,$name,$date);
				$row=mysqli_fetch_array(mh_read_one($conn,$tbgv,$id,$name));
			
				$head="<tr>
						<td>1</td>
						<td><input type='checkbox' name='cb[".$id."][".$name."]'></td>
						<td><input type='radio' checked name='rd' value='".$id.".".$name."'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['matacpham']."</td>
						<td>".$row['ngayxuatban']."</td>
					</tr>";
					$kq=mh_read_other($conn,$tbgv,$id,$name);
				$id=$name=$rd='';
			} else {
				$error="Phải nhập đầy đủ các trường";
			}
			
			break;

			case 'Sửa':
				if(isset($rd)){
					$rd1=explode($rd,".")[0];
					$rd2=explode($rd,".")[1];
					mh_edit_row($conn,$tbgv,$rd1,$rd2,$id,$name,$date);
					$id=$name=$rd='';

				} else {
					$error="Không có dữ liệu nào được chọn";
				}
				$kq=mh_read_some($conn,$tbgv);
				break;
			case 'Xoá':
				if(isset($cb)){
					foreach ($cb as $key => $value) {
						foreach ($value as $k => $val) {
							del_row($conn,$tbgv,$key,$k);
						}
					}
					$id=$name=$rd='';
				} else {
					$error="Phải chọn dữ liệu xoá";
				}
				$kq=mh_read_some($conn,$tbgv);
				break;			
			
		} 
	}else{
		if(isset($rd)){
			$rd1=explode(".",$rd)[0];
			$rd2=explode(".",$rd)[1];
			$row=mysqli_fetch_array(mh_read_one($conn,$tbgv,$rd1,$rd2));
			$id=$row['matacgia'];
			$name=$row['matacpham'];
			$date=$row['ngaybatdau'];
			$kq=mh_read_other($conn,$tbgv,$rd1,$rd2);
			$head="<tr>
						<td>1</td>
						<td><input type='checkbox' name='cb[".$id."][".$name."]'></td>
						<td><input type='radio' checked name='rd' value='".$id.".".$name."'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['matacpham']."</td>
						<td>".$row['ngayxuatban']."</td>
					</tr>";
		} else {
			$kq=mh_read_some($conn,$tbgv);
		}
	}


?>
<body style="font-size: 20px;">
		<form method="post" action=""> 
			<label>Nhập mã tác giả</label>
			<input type="text" name="id" value="<?php echo $id ?>">
			<br/>
			<label>Nhập mã tác phẩm</label>
			<input type="text" name="name" value="<?php echo $name ?>">
			<br/>
			<label>Nhập ngày xuất bản</label>
			<input type="date" name="date" value="<?php echo $date ?>">
			<br/>
			<?php if(!empty($error)) echo "<p style='color:red'>".$error."</p>" ?>
			<button type="submit" name="cmd" value="Thêm">Thêm</button>
			<button type="submit" name="cmd" value="Sửa">Sửa</button>
			<button type="submit" name="cmd" value="Xoá">Xoá</button>
			<br/><br/>
			<table border="2px" style="border-collapse: collapse;">
				<tr>
					<td>STT</td>
					<td><input type="checkbox" name="cb"></td>
					<td><input type="radio" name="rd" value=""></td>
					<td>Mã tác giả</td>
					<td>Mã Tác Phẩm</td>
					<td>Ngày xuất bản</td>
				</tr>
				<?php

					
					if(!empty($head)){
						echo $head;
						$i=2;
					} else {
						$i=1;
					}
					while($row=mysqli_fetch_array($kq)){
					echo "<tr>
						<td>".$i++."</td>
						<td><input type='checkbox' name='cb[".$row['matacgia']."][".($row['matacpham'])."]'></td>
						<td><input type='radio' name='rd' value='".$row['matacgia'].".".$row['matacpham']."' onclick='submit()'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['matacpham']."</td>
						<td>".$row['ngayxuatban']."</td>
					</tr>";};
				?>
			</table>
		</form>
</body>
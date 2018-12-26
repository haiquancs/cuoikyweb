<?php
// kết nối cơ sở dữ liệu
	include 'db-func.php';
	$conn=mysqli_connect("localhost","root","","hoivien") or die("không thể kết nối");
	mysqli_query($conn,"SET NAME 'utf8'");
	mysqli_query($conn,"SET CHARACTER SET 'utf8'");
// xử lý dữ liệu$cb 
	global $id	,$name, $cmd, $cb ,$rd ;
	$tbgv='tacgia';
	if(isset($_POST['id'])) 	$id		= $_POST['id'];
	if(isset($_POST['name']))  	$name 	= chuanhoa($_POST['name']);
	if(isset($_POST['cmd']))  	$cmd 	= $_POST['cmd'];

	if(isset($_POST['cb'])) 	$cb 	= $_POST['cb'];
	if(isset($_POST['rd']))  	$rd 	= $_POST['rd'];
// xử lý nút
	if(isset($cmd)){
		switch ($cmd) {
			case 'Thêm':

			if((isset($name) && isset($id)) && (!empty($name) && !empty($id))){
				add_row($conn,$tbgv,$id,$name);
				$row=mysqli_fetch_array(read_one($conn,$tbgv,$id));
				$row2=mysqli_fetch_array(count_sub($conn,$row['matacgia'])
			);
				$head="<tr>
						<td>1</td>
						<td><input type='checkbox' name='cb[".$id."]'></td>
						<td><input type='radio' checked name='rd' value='".$id."'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['tentacgia']."</td>
						<td>".$row2['num']."</td>
					</tr>";
				$id=$name=$rd='';
			} else {
				$error="Phải nhập đầy đủ các trường";
			}
			$kq=read_some($conn,$tbgv);
			break;

			case 'Sửa':
				if(isset($rd)){
					edit_row($conn,$tbgv,$rd,$id,$name);
					$id=$name=$rd='';

				} else {
					$error="Không có dữ liệu nào được chọn";
				}
				$kq=read_some($conn,$tbgv);
				break;
			case 'Xoá':
				if(isset($cb)){
					foreach ($cb as $key => $value) {
						del_row($conn,$tbgv,$key);
					}
					$id=$name=$rd='';
				} else {
					$error="Phải chọn dữ liệu xoá";
				}
				$kq=read_some($conn,$tbgv);
				break;
			case 'Xem':
				header('Location: tacpham.php');
				break;
			
			
		} 
	}else{
		if(isset($rd)){
			$row=mysqli_fetch_array(read_one($conn,$tbgv,$rd));
			$id=$row['matacgia'];
			$name=$row['tentacgia'];
			$kq=read_other($conn,$tbgv,$rd);
			$row2=mysqli_fetch_array(count_sub($conn,$row['matacgia']));
			$head="<tr>
						<td>1</td>
						<td><input type='checkbox' name='cb[".$id."]'></td>
						<td><input type='radio' checked name='rd' value='".$id."'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['tentacgia']."</td>
						<td>".$row2['num']."</td>
					</tr>";
		} else {
			$kq=read_some($conn,$tbgv);
		}
	}


?>
<body style="font-size: 20px;">
	<center>
		<form method="post" action=""> 
			<label>Nhập mã tác giả</label>
			<input type="text" name="id" value="<?php echo $id ?>">
			<br/>
			<label>Nhập tên tác giả</label>
			<input type="text" name="name" value="<?php echo $name ?>">
			<br/>
			<?php if(!empty($error)) echo "<p style='color:red'>".$error."</p>" ?>
			<button type="submit" name="cmd" value="Thêm">Thêm</button>
			<button type="submit" name="cmd" value="Sửa">Sửa</button>
			<button type="submit" name="cmd" value="Xoá">Xoá</button>
			<button type="submit" name="cmd" value="Xem">Xem</button>
			<br/><br/>
			<table border="2px" style="border-collapse: collapse;">
				<tr>
					<td>STT</td>
					<td><input type="checkbox" name="cb"></td>
					<td><input type="radio" name="rd" value=""></td>
					<td>Mã tác giả</td>
					<td>Tên tác giả</td>
					<td>Số tác phẩm</td>
				</tr>
				<?php

					
					if(!empty($head)){
						echo $head;
						$i=2;
					} else {
						$i=1;
					}
					while($row=mysqli_fetch_array($kq)){
						$row2=mysqli_fetch_array(count_sub($conn,$row['matacgia']));
					echo "<tr>
						<td>".$i++."</td>
						<td><input type='checkbox' name='cb[".$row['matacgia']."][".($row['matacgia']+1)."]'></td>
						<td><input type='radio' name='rd' value='".$row['matacgia']."' onclick='submit()'></td>
						<td>".$row['matacgia']."</td>
						<td>".$row['tentacgia']."</td>
						<td>".$row2['num']."</td>
					</tr>";};
				?>
			</table>
		</form>
	</center>
</body>
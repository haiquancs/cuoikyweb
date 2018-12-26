<?php
//file index.php
	function add_row($db,$tbl,$id,$name){
		return mysqli_query($db,"INSERT INTO $tbl VALUES($id,'{$name}')");
	}
	function edit_row($db,$tbl,$key,$id,$name){
		return mysqli_query($db,"UPDATE $tbl SET matacgia= $id, tentacgia='{$name}' WHERE matacgia=$key");
	}
	function del_row($db,$tbl,$id){
		return mysqli_query($db,"DELETE FROM $tbl WHERE matacgia=$id");
	}
	function read_one($db,$tbl,$id){
		return mysqli_query($db,"SELECT * FROM $tbl WHERE matacgia=$id");
	}
	function read_some($db,$tbl){
		return mysqli_query($db,"SELECT * FROM $tbl");
	}
	function read_other($db,$tbl,$id){
		return mysqli_query($db,"SELECT * FROM $tbl WHERE matacgia<>$id");
	}
	function count_sub($db,$id){
		return mysqli_query($db,"SELECT count(matacpham) as num FROM `tacgia_tacpham` WHERE matacgia=$id GROUP by matacgia");
	}
//file tacpham.php

	function mh_add_row($db,$tbl,$gv,$mon,$date){
		return mysqli_query($db,"INSERT INTO $tbl VALUES($gv,$mon,'$date')");
	}
	function mh_edit_row($db,$tbl,$key,$key2,$gv,$mon,$date){
		return mysqli_query($db,"UPDATE $tbl SET matacgia= $gv, matacpham=$mon,ngaybatdau='{$date}' WHERE matacgia=$key and matacpham=$key2");
	}
	function mh_del_row($db,$tbl,$gv,$mon){
		return mysqli_query($db,"DELETE FROM $tbl WHERE matacgia=$gv and matacpham=$mon");
	}
	function mh_read_one($db,$tbl,$gv,$mon){
		return mysqli_query($db,"SELECT * FROM $tbl WHERE matacgia=$gv and matacpham=$mon");
	}
	function mh_read_some($db,$tbl){
		return mysqli_query($db,"SELECT * FROM $tbl");
	}
	function mh_read_other($db,$tbl,$gv,$mon){
		return mysqli_query($db,"SELECT * FROM $tbl WHERE matacgia<>$gv and matacpham<> $mon");
	}
	function chuanhoa($s){
		$s = trim($s);
	    $s = strtolower($s);
	    $s = ucwords($s);
	    $s = preg_replace('/\s+/', ' ',$s);
	    return $s;
	}
	

?>
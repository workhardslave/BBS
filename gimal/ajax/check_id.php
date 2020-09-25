<?php
	!empty($_POST['id']) ? $id = $_POST['id'] : $id="";
	$ret['check'] = false;	
	if($id != ""){
 		$con = mysqli_connect("localhost", "root", "", "bbs");
		$sql = "select 
					id 
				from 
					user
				where
					id = '{$id}' 
				";
		$result = mysqli_query($con, $sql);
		$num = mysqli_num_rows($result);
		
		if($num==0){
			$ret['check'] = true;
		}
	}
	echo json_encode($ret);
?>
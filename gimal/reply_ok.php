<?php
	include './config.php';
	include './db/db_con.php';
	
	$bno = $_POST['bno'];
	$userpw = password_hash($_POST['dat_pw'], PASSWORD_DEFAULT);
	$sql = mq("insert
					reply
			   set
					con_num = '".$bno."',
					name = '".$_POST['dat_user']."',
					pw = '".$userpw."',
					content = '".$_POST['rep_con']."'
			");
?>
	

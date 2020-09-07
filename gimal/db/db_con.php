<!-- DB 연동 -->
<?php
	$db_id="root";
	$db_pw="";
	$db_name="bbs";
	$db_domain="localhost";
	$db=mysqli_connect($db_domain,$db_id,$db_pw,$db_name);
	
	// 페이징, 조회수 처리 등 코드 간소화를 위해 사용할 함수
	function mq($sql){
		global $db;
		return $db->query($sql);
	}
?>
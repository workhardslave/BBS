<!-- 세션 관리 -->
<?php
	session_start();
	if (isset($_SESSION["userid"])) {
		$userid = $_SESSION["userid"];
	}else{
		$userid = "";
	}if (isset($_SESSION["username"])){
		$username = $_SESSION["username"];
	}else{
		$username = "";
	}if (isset($_SESSION["role"])){ // 사용자, 관리자 구분 용도
		$role = $_SESSION["role"];
	}else{
		$role = "";
	}
?>
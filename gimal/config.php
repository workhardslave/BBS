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
	}
?>
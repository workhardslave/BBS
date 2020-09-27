<?php
	include "./db/db_con.php";
	$bno = $_GET['idx'];
	/* 받아온 idx값을 선택해서 게시글 삭제 */
	mq("delete 
		   from 
				board 
		   where 
				idx='$bno'
		");
?>
	<script>
		alert("삭제되었습니다.");
	</script>
	<meta http-equiv="refresh" content="0 url=/bbs/gimal/list.php">

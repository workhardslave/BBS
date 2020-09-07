<?php
	include "./config.php";
	include "./db/db_con.php";

	$bno = $_POST['idx']; // $bno(hidden)에 idx값을 받아와 넣음
	$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT); // 입력받은 패스워드를 해쉬값으로 암호화
	$date = date('Y-m-d'); 
	/* 받아온 idx값을 선택해서 게시글 수정 */
	mq("update 
			board 
	   set 
			date = '".$date."', 
			pw='".$userpw."',
			title='".$_POST['title']."',
			content='".$_POST['content']."' 
	   where 
			idx='".$bno."'
	");
?>
	<script>
		alert("수정되었습니다.");
	</script>
	<meta http-equiv="refresh" content="0 url=/gimal/read.php?idx=<?=$bno?>">


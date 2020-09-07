<?php
	include "./config.php";
	include "./db/db_con.php";
	
	$name = $userid;
	$date = date('Y-m-d');
	$userpw = password_hash($_POST['pw'], PASSWORD_DEFAULT); // 입력받은 패스워드를 해쉬값으로 암호화
	$title = $_POST['title'];
	$content = $_POST['content'];
	/* lo_post 값이 1이면 잠금 0이면 공개 */
	if(isset($_POST['lockpost'])){
		$lo_post = '1';
	}else{
		$lo_post = '0';
	}

	
// 	$sql = mq("insert into board(name,pw,title,content,date) 
// 			values('".$_POST['name']."','".$userpw."','".$_POST['title']."','".$_POST['content']."','".$date."')"); 
	
	mq("alter table board auto_increment =1"); //auto_increment 값 초기화 (삭제 시 번호 비지 않게 하기 위해서)
	
	mq("INSERT 
			board
		SET	
			name = '".$name."', 
			pw = '".$userpw."', 
			title = '".$title."', 
			content = '".$content."',  
			date ='".$date."',
			lock_post = '".$lo_post."'
	");
?>
	<script>
		alert("글쓰기 완료되었습니다.");
		location.href = 'list.php';
	</script>


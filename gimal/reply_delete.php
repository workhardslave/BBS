<?php
	include './config.php';
	include './db/db_con.php';
	
	// hidden의 값 rno를 받아와 그 값에 해당하는 idx 에 대한 reply 테이블 정보 가져오기
	$rno = $_POST['rno']; 
	$role = $_SESSION['role'];
	$sql = mq("select 
					* 
			   from 
					reply 
			   where 
					idx='".$rno."'
			");
	$reply = $sql->fetch_array();
	
	// hidden의 값 b_no를 받아와 그 값에 해당하는 idx 에 대한 board 정보 가져오기
	$bno = $_POST['b_no'];
	$sql2 = mq("select 
					* 
			    from 
					board 
			    where 
					idx='".$bno."'
			");
	$board = $sql2->fetch_array();
	
	$pwk = $_POST['pw']; // 모달창에서 입력한 비밀번호
	$rpw = $reply['pw']; // reply 테이블에 저장된 해쉬값
	
	if($role=="USER") {
		/* 비밀번호를 db의 해쉬값과 비교,  세션값과 db의 name을 비교  */
		if((password_verify($pwk, $rpw)) && ($userid == $reply['name']))
		{
			// 테이블 reply에서 인덱스값이 $rno인 값을 찾아 삭제
			$sql = mq("delete
					   from
							reply
					   where
							idx='".$rno."'
					");
			?>
					<script>
						alert("댓글이 삭제 되었습니다.");
					</script>
					<meta http-equiv="refresh" content="0 url=/bbs/gimal/read.php?idx=<?=$bno?>">
		
				<?php 
			}else{ ?>
					<script>
						alert('본인의 댓글이 아니거나 비밀번호가 틀립니다');
						history.back();
					</script>
		<?php } ?>
	<?php 
	} else if($role=="ADMIN") { 
				// 테이블 reply에서 인덱스값이 $rno인 값을 찾아 삭제
				$sql = mq("delete
							   from
									reply
							   where
									idx='".$rno."'
							");
				?>
					<script>
						alert("댓글이 삭제 되었습니다.");
					</script>
					<meta http-equiv="refresh" content="0 url=/bbs/gimal/read.php?idx=<?=$bno?>">
		
		<?php } ?>
	

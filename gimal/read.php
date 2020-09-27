<?php
	include_once "./config.php";
	include "./db/db_con.php";
	include_once "./login_check.php";
	
	$bno = $_GET['idx']; // $bno에 idx값을 받아와 넣음 
	/* 조회수 올리기  */
	$hit = mysqli_fetch_array(mq("select 
									* 
								  from 
									board 
								  where 
									idx ='".$bno."'
								"));
	$hit = $hit['hit'] + 1;
	mq("update 
		 board 
	   set 
		 hit = '".$hit."' 
	   where 
		 idx = '".$bno."'
	");
	/* 조회수 올리기 끝 */
	
	/* 받아온 idx값을 선택해서 게시글 정보 가져오기 */
	$sql = mq("select 
				 * 
			   from 
				 board 
			   where 
				 idx='".$bno."'
			"); 
	$board = $sql->fetch_array();
?>
<!DOCTYPE html>
<html>
	<head>
		<?php include_once "./fragments/head.php";?>
		
	</head>
	<body>
		<!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
		<nav class="navbar navbar-default">
			<?php include_once "./fragments/header.php";?>
		</nav>
		<div class="container">
			<!-- 글 불러오기 -->
			<div id="board_read">
				<table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
					<thead>
						<tr>
							<th colspan="2" style="background-color: #eeeeee; text-align: center;"><h3>게시판 글읽기</h3></th>
						</tr>
					</thead>	
					<tbody>
						<tr>
							<td>글 제목</td>
							<td colspan="2"><?=$board['title']?></td>
						</tr>
						<tr>
							<td>작성자</td>
							<td colspan="2"><?=$board['name']?></td>
						</tr>
						<tr>
							<td>작성일자</td>
							<td colspan="2"><?=$board['date']?></td>
						</tr>
						<tr>
							<td>내용</td>
							<td colspan="2" style="min-height: 200px; text-align: left;"><?=$board['content']?></td>
						</tr>
					</tbody>
				</table>
				<!-- 목록, 수정, 삭제 -->
				<a href="list.php" class="btn btn-primary">목록</a>
				<!-- 자신의 글만 수정, 삭제 할 수 있도록 설정-->
				<?php 
					if($userid==$board['name'] || $role=="ADMIN"){ // 본인 아이디거나, 관리자 계정이거나
				?>
						<a href="update.php?idx=<?=$board['idx']?>" class="btn btn-primary">수정</a>
						<a href="delete.php?idx=<?=$board['idx']?>" class="btn btn-primary">삭제</a>
				<?php } ?>
			</div>
		</div>
		<!-- 댓글 불러오기 -->
		<div class="container">
			<div class="reply_view">
				<h3 style="padding:10px 0 15px 0; border-bottom: solid 1px gray;">댓글목록</h3>
				<?php 
					$sql3=mq("select
						*
					  from
						reply
					  where
						con_num='".$bno."'
					  order by
						idx desc
					");
					while($reply=$sql3->fetch_array()){
				?>
				<div class="dat_view">
					<div><b><?=$reply['name']?></b></div>
					<div class="dap_to comt_edit"><?php echo nl2br("$reply[content]"); ?></div>
					<div class="rep_me dap_to"><?=$reply['date']?></div>
					<div class="rep_me rep_menu">
						<a class="dat_del_btn" href="#">삭제</a>
					</div>
				</div>
				<!-- 댓글 삭제 모달창 구현(회원) -->
				<div class="modal fade" id="rep_modal_del">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- header -->
							<div class="modal-header">
								<!-- 닫기(x) 버튼 -->
								<button type="button" class="close" data-dismiss="modal">×</button>
								<!-- header title -->
								<h4 class="modal-title"><b>댓글 삭제</b></h4>
							</div>
							<!-- body -->
							<div class="modal-body">
							<!-- 회원일 때 댓글 삭제 -->
							<?php if($role=="USER") {?>
								<form method="post" id="modal_form1" action="reply_delete.php">
									<input type="hidden" name="rno" value="<?=$reply['idx'];?>" /><input type="hidden" name="b_no" value="<?=$bno;?>">		
									<p>비밀번호  <input type="password" name="pw" /> <input type="submit" class="btn btn-primary" value="확인" /></p>
								</form>
								
							<!-- 관리자일 때 댓글 삭제 -->
							<?php } else if($role=="ADMIN") {?>
								<form method="post" id="modal_form2" action="reply_delete.php">
									<input type="hidden" name="rno" value="<?=$reply['idx'];?>" /><input type="hidden" name="b_no" value="<?=$bno;?>">
									<input type="hidden" name="pw" value="">		
									<p>삭제하시겠습니까? <input type="submit" class="btn btn-primary" value="확인" /></p>
								</form>
							<?php }?>
							</div>
					  	</div>
				  	</div>
				</div>
				<!-- 댓글 삭제 모달창 구현 끝 -->
			
				<?php } ?>
				<!-- 댓글 달기 -->
				<div class="dat_ins">
					<input type="hidden" name="bno" class="bno" value=<?=$bno?>>
					<input type="hidden" name="dat_user" id="dat_user" class="dat_user" value=<?=$userid?>>
					<input type="password" name="dat_pw" id="dat_pw" class="dat_pw" size="15" placeholder="비밀번호">
					<div style="margin-top:10px;">
						<textarea name="content" class="rep_con" id="rep_con"></textarea>
						<button id="rep_btn" class="rep_btn">댓글</button>
					</div>
				</div>
			</div>
		</div>
		<!-- 댓글 불러오기 끝 -->
		<script src="./js/login.js"></script>
		<script src="./js/event.js"></script>
	</body>
</html>
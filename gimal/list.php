<?php 
	include_once "./config.php";
	include_once "./db/db_con.php";
	
	// 현재 페이지 번호를 확인
	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
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
		<!-- 비밀 글 모달창 양식 구현-->
		<div class="modal fade" id="modal_div">
			<div class="modal-dialog">
				<div class="modal-content">
					<!-- header -->
					<div class="modal-header">
						<!-- 닫기(x) 버튼 -->
						<button type="button" class="close" data-dismiss="modal">×</button>
						<!-- header title -->
						<h4 class="modal-title"><b>비밀글 입니다.</b></h4>
					</div>
					<!-- body -->
					<div class="modal-body">
						<form method="post" id="modal_form" action="./ck_read.php?idx=" data-action="./ck_read.php?idx=">
							<p>비밀번호  <input type="password" name="pw_chk" /> <input type="submit" class="btn btn-primary" value="확인" /></p>
						</form>
					</div>
			  	</div>
		  	</div>
		</div>
		<!-- 비밀 글 모달창 구현 끝-->
		<div class="container">
			<div id="board_area"> 
			  <h1><b>자유게시판</b></h1><br>
			  <h4>자유롭게 글을 쓸 수 있는 게시판입니다.</h4><br>
			  <table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
			  	<tr>
					<th style="background-color: #eeeeee; text-align: center;">번호</th>
					<th style="background-color: #eeeeee; text-align: center;">제목</th>
					<th style="background-color: #eeeeee; text-align: center;">작성자</th>
					<th style="background-color: #eeeeee; text-align: center;">작성일</th>
					<th style="background-color: #eeeeee; text-align: center;">조회수</th>
			    </tr>
			    
			    <!-- 페이징 구현 -->
			    <?php 
			    	$sql = mq("select
			    					*
			    			   from 
			    					board
			    			");
			    	$total_record = mysqli_num_rows($sql); // 게시판 총 레코드 수z
			  		
			    	$list = 5; // 한 페이지에 보여줄 개수
			  		$block_cnt = 5; // 블록당 보여줄 페이지 개수
			  		$block_num = ceil($page / $block_cnt); // 현재 페이지 블록 구하기
			  		$block_start = (($block_num - 1) * $block_cnt) + 1; // 블록의 시작 번호  ex) 1,6,11 ...
			    	$block_end = $block_start + $block_cnt - 1; // 블록의 마지막 번호 ex) 5,10,15 ...
			    	
			    	
			    	$total_page = ceil($total_record / $list); // 페이징한 페이지 수
			    	if($block_end > $total_page){ // 블록의 마지막 번호가 페이지 수 보다 많다면
			    		$block_end = $total_page; // 마지막 번호는 페이지 수
			    	}
			    	$total_block = ceil($total_page / $block_cnt); // 블럭 총 개수
			    	$page_start = ($page - 1) * $list; // 페이지 시작
			    	
			    	/* 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
			    	$sql2 = mq("select 
			    					* 
			    				from 
			    					board 
			    				order by 
			    					idx desc limit $page_start, $list
			    			");
			    	while($board = $sql2->fetch_array()){
			    		$title=$board["title"];
			    		/* 글자수가 30이 넘으면 ... 처리해주기 */
			    		if(strlen($title)>30){
			    			$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
			    		}
			    
			    		/* 댓글 수 구하기 */
			    		$sql3 = mq("select
			    						*
			    				    from
			    						reply
			    					where
			    						con_num='".$board['idx']."'
			    				");
			    		$rep_count = mysqli_num_rows($sql3); // 레코드의 수(댓글의 수)
			    					  
			    ?>
			    
			      <!-- 글 목록 가져오기 -->
			      <tbody>
			      	<tr>
			          <td width="70"><?=$board['idx']; ?></td>
			          <td width="500">
			          <!-- 비밀 글 가져오기 -->	 
			          <?php 
			          	$lockimg="<img src='./img/lock.png' alt='lock' title='lock' width='18' height='18'>";
			          	if($board['lock_post']=="1"){ // lock_post 값이 1이면 잠금
			          ?>
			          		<span class="lock_check" style="cursor:pointer" data-idx="<?=$board['idx']?>" ><?=$title?> <?=$lockimg?></span>
			          <!-- 일반 글 가져오기 -->
			          <?php 
			          	}else{	// 아니면 공개 글
			          ?>
			          		<span class="read_check" style="cursor:pointer" data-action="./read.php?idx=<?=$board['idx']?>" ><?=$title?></span> 
			          		<span style="color:blue;">[<?=$rep_count?>]</span></td>
			          <?php 		
			          	}
			          ?>
			          <td width="120"><?=$board['name'];?></td>
			          <td width="100"><?=$board['date'];?></td>
			          <td width="100"><?=$board['hit']; ?></td>
			        </tr>
			      </tbody>
			      <?php } ?>
			    </table>
			    <div id="page_num" style="text-align: center;">
			    	<?php
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		echo "<a href='list.php?page=1'>처음</a>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<a href='list.php?page=$pre'>◀ 이전 </a>";
				    		
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<b> $i </b>";
				    		} else {
				    			echo "<a href='list.php?page=$i'> $i </a>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<a href='list.php?page=$next'> 다음 ▶</a>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<a href='list.php?page=$total_page'>마지막</a>";
				    	}
					?>
				</div>	
			    <div id="write_btn">
			      <a href="write.php"><button class="btn btn-primary pull-right" >글쓰기</button></a>
			    </div>
			  <div id="search_box" style="text-align: center; padding-top: 50px;">
			  	<form action="search_result.php" method="get">
			  		<select name="category">
			  			<option value="title">제목</option>
			  			<option value="name">글쓴이</option>
			  			<option value="content">내용</option>
			  		</select>
			  		<input type="text" name="search" size="40" required="required">
			  			<button class="btn btn-primary">검색</button>
			  	</form>
			  </div>
		  </div>
		</div>
		<script src="./js/login.js"></script>
		
		<script>
		<!-- 비밀글 클릭시 모달창을 띄우는 이벤트 -->
		$(function(){
		    $(".lock_check").click(function(){
				$("#modal_div").modal();
				<!-- 주소에 data-idx(idx)값을 더하기 -->
				var action_url = $("#modal_form").attr("data-action")+$(this).attr("data-idx")
				$("#modal_form").attr("action",action_url);
			});
		});
	
		<!-- 일반 글 클릭시 해당 idx의 read 페이지로 이동하는 이벤트 -->
		$(function(){
		    $(".read_check").click(function(){
			    var action_url = $(this).attr("data-action");
			    console.log(action_url);
			    $(location).attr("href",action_url);
			});
		});
		</script>
	</body>
</html>
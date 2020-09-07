<?php 
	include_once "./config.php";
	include_once "./db/db_con.php";
	
	// 현재 페이지 번호를 확인
	if (isset($_GET["page"]))
		$page = $_GET["page"]; //1,2,3,4,5
	else
		$page = 1;
	
	$category = $_GET['category'];
	$search = $_GET['search'];
?>
<!DOCTYPE html>
<html>
	<head>
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width" initial-scale="1">
		<!-- 스타일 시트 참조 / css폴더의 bootstrap.css 참조 -->
		<title>PHP 게시판 웹 사이트</title>
		<link rel="stylesheet" href="css/bootstrap.css"> 
		<script src="https://ajax.aspnetcdn.com/ajax/jQuery/jquery-3.3.1.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
			    $(location).attr("href",action_url);
			});
		});
		</script>
	
	</head>
	<body>
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
		
		<!-- 표준 네비게이션 바 (화면 상단에 위치, 화면에 의존하여 확대 및 축소) -->
		<nav class="navbar navbar-default">
			<div class="navbar-header">
				<!-- Collapse : 제목을 클릭하면 해당내용이 펼쳐지고 다른내용은 접히는 특수 효과 -->
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"
				aria-expanded="false">
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="main.php">PHP 게시판 웹 사이트</a>
			</div>   
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li><a href="main.php">메인</a></li>
					<li class="active"><a href="list.php">게시판</a></li>
				</ul>
			<?php 
				if(!$userid){
			?>    
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
						aria-haspopup="true" aria-expanded="false">접속하기<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li class="active"><a href="login.php">로그인</a></li>
							<li><a href="join.php">회원가입</a></li>
						</ul>
					</li>
				</ul>
			<?php 
				}else{	
					$logged = $username."(".$userid.")";
			?>
				<ul class="nav navbar-nav navbar-right">
					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" 
						aria-haspopup="true" aria-expanded="false"><b><?=$logged ?></b>님의 회원관리<span class="caret"></span></a>
						<ul class="dropdown-menu">
							<li><a href="logout.php">로그아웃</a></li>
						</ul>
					</li>
				</ul>
			<?php
				}
			?>
			</div>
		</nav>
		<div class="container">
			<div id="board_area"> 
			<!-- 출력을 위해서 form의 title, name, content 값을 제목, 글쓴이, 내용으로 변경하기 위한 조건문 -->
			<?php 
				if($category == 'title'){
					$keyword = '제목';
				} else if($category == 'name'){
					$keyword = '글쓴이';
				} else{
					$keyword = '내용';
				}
			?>
			  <h1>'<?=$keyword?>' 에서 '<b><?=$search?></b>' 검색결과</h1><br>
			  <h4>는 다음과 같습니다.</h4><br>
			  <table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
			  	<tr>
					<th style="background-color: #eeeeee; text-align: center;">번호</th>
					<th style="background-color: #eeeeee; text-align: center;">제목</th>
					<th style="background-color: #eeeeee; text-align: center;">작성자</th>
					<th style="background-color: #eeeeee; text-align: center;">작성일</th>
					<th style="background-color: #eeeeee; text-align: center;">조회수</th>
			    </tr>
			   	<!-- 검색한 결과 페이징 구현 -->
			    <?php 
			    	$sql2 = mq("select 
			    					* 
			    				from 
			    					board 
			    				where
			    					$category like '%{$search}%'
			    				order by 
			    					idx desc
			    			");
			    	$total_record = mysqli_num_rows($sql2); // 검색된 게시판 총 레코드 수
			    	
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
			    	
			    	/* 검색된 게시글 정보 가져오기  limit : (시작번호, 보여질 수) */
			    	$sql2 = mq("select 
			    					* 
			    				from 
			    					board 
			    				where
			    					$category like '%{$search}%'
			    				order by 
			    					idx desc limit $page_start, $list
			    			");
			    	
			    	while($board = $sql2->fetch_array()){
			    		$title=$board["title"];
			    		/* 글자수가 30이 넘으면 ... 처리해주기 */
			    		if(strlen($title)>30){
			    			$title=str_replace($board["title"],mb_substr($board["title"],0,30,"utf-8")."...",$board["title"]);
			    		}
			    		$sql3 = mq("select 
			    						* 
			    					from 
			    						reply 
			    					where 
			    						con_num='".$board['idx']."'
			    				");
			    		$rep_count = mysqli_num_rows($sql3);
			    				    	
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
			          		<span class="lock_check" style="background-color:yellow; cursor:pointer;" data-idx="<?=$board['idx']?>" ><?=$title?> <?=$lockimg?></span>
			          <!-- 일반 글 가져오기 -->
			          <?php 
			          	}else{	// 아니면 공개 글
			          ?>
			          		<span class="read_check" style="background-color:orange; cursor:pointer;" data-action="./read.php?idx=<?=$board['idx']?>" ><?=$title?></span>
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
				    		echo "<a href='search_result.php?category=$category&search=$search&page=1'>처음</a>";
				    	}
				    	
				    	if ($page <= 1){
				    		// 빈 값
				    	} else {
				    		$pre = $page - 1;
				    		echo "<a href='search_result.php?category=$category&search=$search&page=$pre'>◀ 이전 </a>";
				    	}
				    	
				    	for($i = $block_start; $i <= $block_end; $i++){
				    		if($page == $i){
				    			echo "<b> $i </b>";
				    		} else {
				    			echo "<a href='search_result.php?category=$category&search=$search&page=$i'> $i </a>";
				    		}
				    	}
				    	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		$next = $page + 1;
				    		echo "<a href='search_result.php?category=$category&search=$search&page=$next'> 다음 ▶</a>";
				    	}
					   	
				    	if($page >= $total_page){
				    		// 빈 값
				    	} else {
				    		echo "<a href='search_result.php?category=$category&search=$search&page=$total_page'>마지막</a>";
				    	}
					?>
				</div>
				<br><br><br>
				<div id="search_box" style="text-align: center;">
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
	</body>
</html>
<?php
	include "./config.php";
	include "./db/db_con.php";
	include "./login_check.php";
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
		<script src="./js/jquery-1.10.2.js"></script>
		<script src="./js/login.js"></script>
	
	</head>
	<body>
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
					<li class="active"><a href="main.php">메인</a></li>
					<li><a href="list.php">게시판</a></li>
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
			<div id="board_write">
                <form action="write_ok.php" method="post">
					<table class="table table-striped" style="text-align: center; border: 1px solid #ddddda">
						<thead>
							<tr>
								<th colspan="2" style="background-color: #eeeeee; text-align: center;"><h3>게시판 글쓰기</h3></th>
							</tr>
						</thead>	
						<tbody>
							<tr>
								<td><span class="pull-left">&nbsp;&nbsp;&nbsp;아이디 : <b><?=$userid?></b></span></td>
							</tr>
							<tr>
								<td><input type="text" class="form-control" placeholder="글 제목" name="title" id="utitle" required></td>
							</tr>
							<tr>
								<td><input type="password" class="form-control" placeholder="글 비밀번호" name="pw" id="upw" style="width: 150px;"></td>
							</tr>
							<tr>	
								<td><textarea class="form-control" placeholder="글 내용" name="content" id="ucontent" style="height: 350px" required></textarea></td>
							</tr>
						</tbody>
					</table>
					<input type="checkbox" value="1" name="lockpost">비밀글<br><br> 
					<button type="submit" class="btn btn-primary">글쓰기</button>
				</form>
			</div>
		</div>       
	</body>
</html>
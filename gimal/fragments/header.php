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
					<li><a href="main.php">메인</a></li> <!-- 바닐라 자바스크립트로 나중에 active 속성 추가 -->
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
							<li><a href="login.php">로그인</a></li> <!-- 바닐라 자바스크립트로 나중에 active 속성 추가 -->
							<li><a href="join.php">회원가입</a></li>
						</ul>
					</li>
				</ul>
			<?php 
				}else if($userid){	
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
			<?php }?>
			</div>
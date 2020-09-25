<?php
	include_once "./config.php";
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
			<div class="jumbotron">
				<div class="container">
					<h1>웹 사이트 소개</h1>
					<p>이 웹 사이트는 '서버프로그래밍' 수업의 기말 프로젝트를 위해서 PHP를 이용해 간단하게 구현한 게시판 입니다.</p>
					<p><a class="btn btn-primary btn-pull" href="list.php" role="button">게시판 바로가기</a></p>
				
				</div>
			</div>
		</div>
		<div class="container"> 
    		<div id="carousel-example-generic" class="carousel slide">
            <!-- Indicators(이미지 하단의 동그란것->class="carousel-indicators") -->
            	<ol class="carousel-indicators">
	              <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
	              <li data-target="#carousel-example-generic" data-slide-to="1"></li>
	              <li data-target="#carousel-example-generic" data-slide-to="2"></li>
	            </ol>
	            <!-- Carousel items -->
	            <div class="carousel-inner">
	            	<div class="item active">
                		<img src="https://c1.staticflickr.com/5/4320/35952487306_154709a4eb_b.jpg" width="1200" height="400" alt="First slide">
                	</div>
	                <div class="item">
	                   <img src="https://c1.staticflickr.com/5/4324/35605403570_4caa1e57bd_b.jpg" width="1200" height="400" alt="Second slide">               
	                </div>
	                <div class="item">
	                   <img src="https://c1.staticflickr.com/5/4323/35605404720_ed06f4dbae_b.jpg" width="1200" height="400" alt="Third slide">                 
	                </div>
             	</div>
             	<!-- Controls -->
              	<a class="left carousel-control" href="#carousel-example-generic" data-slide="prev">
                	<span class="icon-prev"></span>
              	</a>
              	<a class="right carousel-control" href="#carousel-example-generic" data-slide="next">
                	<span class="icon-next"></span>
              	</a>
          	</div>
  		</div>
  		<!-- JS 코드는 밑에 두는걸 권장 -->
  		<script src="./js/login.js"></script> 
		<script>
// 			$(function(){
// 				 $(".carousel").carousel(){ // 캐러셀 jQuery
// 					interval: 1000;
// 				 }); 
// 			});
		</script>
	</body>
</html>
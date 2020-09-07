<?php
	include_once "./db/db_con.php";
    $id   = $_POST['id'];
    $pass = password_hash($_POST['pass'], PASSWORD_DEFAULT); // 입력받은 패스워드를 해쉬값으로 암호화
    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email  = $_POST['email'];

              
//  $con = mysqli_connect("localhost", "user1", "12345", "bbs");

//  	$sql = "insert into user(id, pass, name, gender, phone, email) ";
//  	$sql .= "values('$id', '$pass', '$name', '$gender', '$phone', '$email')";
// 	mq("INSERT 
// 			user
// 		SET 
// 			id = '$id' ,
// 			pass = '$pass',
// 			name = '$name',
// 			gender = '$gender',
// 			phone = '$phone',
// 			email = '$email'
// 		");    
    mq("insert into user(id,pass,name,gender,phone,email) values('".$id."','".$pass."','".$name."','".$gender."','".$phone."','".$email."')");
    

    echo "
	      <script>
    	      alert('회원가입이 완료 되었습니다.');
	          location.href = 'index.php';
	      </script>
	  ";
?>

   

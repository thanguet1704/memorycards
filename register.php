<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>REGISTER</title>
	<link rel="stylesheet" href="style.css">

	<?php
		if (isset($_POST['register'])){
			if (strlen($_POST["email"]) == 0){
				echo "<script>";
				echo "alert('Email không được để trống');";    
				echo "</script>";
			}
			else if (strlen($_POST["username"]) == 0){
				echo "<script>";
				echo "alert('Tên đăng nhập không được để trống');";    
				echo "</script>";
			}
			else if (strlen($_POST["username"]) < 6 || strlen($_POST["username"]) > 20){
				echo "<script>";
				echo "alert('Tên đăng nhập nằm trong khoảng 6 đến 20 kí tự');";    
				echo "</script>";
			}

			else if (strlen($_POST["password"]) == 0){
				echo "<script>";
				echo "alert('Mật khẩu không được để trống');";    
				echo "</script>";
			}
			else if (strlen($_POST["password"]) < 6 || strlen($_POST["password"]) > 20){
				echo "<script>";
				echo "alert('Mật khẩu nằm trong khoảng 6 đến 20 ký tự');";    
				echo "</script>";
			}
			else if (strlen($_POST["enterpassword"]) == 0){
				echo "<script>";
				echo "alert('Nhập lại mật khẩu');";    
				echo "</script>";
			}
			else if ($_POST['password'] != $_POST['enterpassword']){
				echo "<script>";
				echo "alert('Mật khẩu không khớp');";    
				echo "</script>";
			}
			else if (!emailValid($_POST['email'])){
				echo "<script>";
				echo "alert('Email không hợp lệ');";    
				echo "</script>";
			}
			else{
				$servername = "localhost";
				$username = "root";
				$password = "1";
				$dbname = "memorycards";

				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn -> connect_error ) {
					die("Khong the ket noi den server : " .$conn->connect_error); 
				}

				$myusername = $_POST['username'];
				$mypassword = $_POST['password'];
				$myemail = $_POST['email'];
		
				$sql = "insert into users(userName, passWord, email) values('$myusername', '$mypassword', '$myemail')";
				$sqlemail ="select * from users where email = '$myemail' ";
				$sqlusername = "select * from users where userName = '$myusername' ";
				$result = mysqli_query($conn, $sqlemail);
				$result2 = mysqli_query($conn, $sqlusername);

				if (mysqli_num_rows($result) > 0){
					echo "<script>";
					echo "alert('Email đã được sử dụng');";    
					echo "</script>";
					
				}
				else if (mysqli_num_rows($result2) > 0){
					echo "<script>";
					echo "alert('Tên người dùng đã được sử dụng');";    
					echo "</script>";
					
				}
				else if (mysqli_query($conn, $sql)){
					echo "<script>";
					echo "alert('Đăng kí thành công !');";    
					echo "</script>";
					header("Location: login.php");
				}
				mysqli_close($conn);
			}
		}

	?>

	<?php
		function emailValid($string) 
    	{ 
        if (preg_match ("/^([a-zA-Z0-9])+([a-zA-Z0-9\._-])*@([a-zA-Z0-9_-])+\.[A-Za-z]{2,6}$/", $string)) 
            return true; 
    	} 

	?>
</head>
<body>
	<form class = "box" action="register.php" method="post">
		<h1><strong>REGISTER</strong></h1>
		  <input type="text" name="email" placeholder="Email">
		  <input type="text" name="username" placeholder="Username">
		  <input type="password" name="password" placeholder="Password">
		  <input type="password" name="enterpassword" placeholder="Enter your password">
		  <input type="submit" name="register" value="Register">
	</form>

</body>
</html>
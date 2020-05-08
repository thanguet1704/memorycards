<?php
	session_start();
   
   if( isset( $_SESSION['counter'] ) )
   {
      $_SESSION['counter'] += 1;
   }
   else
   {
      $_SESSION['counter'] = 1;
   }
   $msg = "Bạn đã truy cập trang này ".  $_SESSION['counter']. " lần trong session này.";
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> Login </title>
	<link rel="stylesheet" href="style.css">
	<?php
		if (isset($_POST["login"])){
			if (strlen($_POST["username"]) == 0){
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

			else{
				$servername = "localhost";
				$username = "root";
				$password = "1";
				$dbname = "memorycards";

				$conn = new mysqli($servername, $username, $password, $dbname);
				if ($conn -> connect_error ) {
					die("Khong the ket noi den server : " .$conn->connect_error); 
				}
				$sql = "select * from users ";
				$result = mysqli_query($conn, $sql);

				if (mysqli_num_rows($result) != 0){
					$myusername = $_POST["username"];
					$mypassword = $_POST["password"];
					$myiduser = NULL;
					$tmp = 0;
					while ($array = $result->fetch_assoc()) {
						if ($array['userName'] == $myusername && $array['passWord'] == $mypassword){
							$tmp++;
							$myiduser = $array['idUser'];
						}
					}
					if ($tmp != 0){
						unlink("temp.txt");
						$myfile = fopen("temp.txt", "a");
						$name = "$myusername"."\n";
						$id = "$myiduser"."\n";
						fwrite($myfile, $id);
						fwrite($myfile, $name);
						fclose($myfile);
						header('Location: home_login.php');
					}
					else{
						echo "<script>";
						echo "alert('Sai tên đăng nhập hoặc mật khẩu');";    
						echo "</script>";
					
					}
				}

				mysqli_close($conn);

			}
		}
	?>
</head>
<body>
	<form class="box" action="login.php" method="POST">
		 <h1><strong>Login</strong></h1>
		 <input type="text" name="username" placeholder="Username">
		 <input type="password" name="password" placeholder="Password">
		 <input type="submit" name="login" value="Login">
	</form>
</body>
</html>
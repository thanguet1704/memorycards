<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Edit</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/create.css">
	<link rel="stylesheet" href="css/browser.css">
	<script src="jquery/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<?php
		$count = 0;
		$myfile = "temp.txt";
		$tmp = fopen($myfile, "r");
		while (!feof($tmp)){
			$iduser = fgets($tmp);
			break;

		}
		while (!feof($tmp) && $count < 1){
			$nameuser = fgets($tmp);
			$count++;
		}
		fclose($tmp);


		$_myfilegc = "idgroupcard.txt";
		$_tmpgc = fopen($_myfilegc, "r");
		while (!feof($_tmpgc)){
			$_idgroupcard = fgets($_tmpgc);
			break;
		}
		fclose($_tmpgc);

		$idgroupcard = $_idgroupcard;
		//echo $idcard;
		$servername = "localhost";
		$username = "root";
		$password = "1";
		$dbname = "memorycards";
		$conn = new mysqli($servername, $username, $password, $dbname);
		if ($conn -> connect_error ) {
			die("Khong the ket noi den server : " .$conn->connect_error); 
		}
	
		$title = substr($idgroupcard, 2);
		$id_card = "C".$title.date('dmyHims');
		//echo $id_card;

		//thêm thẻ vào nhóm thẻ

		if (isset($_POST['add'])){
			if ($_POST['frontcard'] == NULL){
				echo "<script>";
				echo "alert('Mặt trước không được bỏ trống')";
				echo "</script>";	
			}
			else if ($_POST['backcard'] == NULL){
				echo "<script>";
				echo "alert('Mặt sau không được bỏ trống')";
				echo "</script>";	
			}
			else{
				$add ="insert into cards(idCard,frontCard,backCard,idGroupCard) values('$id_card', '".$_POST['frontcard']."', '".$_POST['backcard']."', '$idgroupcard')";
				$rs_add = mysqli_query($conn, $add);
				echo "<script> alert('Thêm thành công')</script>";

			}
		}
	?>
</head>
<body>
	<div class="container-fluid">
		<header class="container-fluid">
			<!-- phần đầu trang giống home -->
			<nav class="navbar navbar-default" role="navigation">
				

				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="#">
						<img src="image/squarelogo.jpg" alt="">
					</a>
				</div>

				
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="home_login.php">SmartCards</a>
						</li>	
					</ul>
					<form class="navbar-form navbar-left" method ="GET" role="search" action="search_login.php">
						<div class="form-group">
							<input type="text" id="text_search" name ="text_search" class="form-control" placeholder="Search">
						</div>
						<button type="submit" id="submit_search" name ="submit_search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#" onclick = "home()"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>
						
						<li>
							<a href="groupcard.php"><span class="glyphicon glyphicon-user"></span><?php echo "$nameuser"; ?></a>
						</li>
						<li>
							<a href="logout.php" ><span class="glyphicon glyphicon-off"></span>Logout</a>
						</li>

					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>


		<div class="container">
			<div class="well clearfix">
				<form class = "box" action="add_card.php" method="post">

					<!-- phần tạo chủ đề, tên chủ đề, miêu tả và link ảnh cover  + thêm nút Create-->		
							<input type="submit" name = "add"  class="btn btn-primary" style="float: right;" value="Add">
					<hr>
					
					<!-- Chỗ tạo thẻ và thêm vào chủ đề mà mình tạo -->
					<div class="row">
						<!--<input type="image" src="image/icon_add.png" alt="Add" style="max-width: 50px; max-height: 50px; float: right;">-->
						<h1>About Card : </h1>
						
						<h3>Front</h3>
						<div class="col-lg-12">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-default" name = "browserfront" type="button">Browser <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>
								</span>
								<input type="text" name = "frontcard" class="form-control" placeholder="Front of Card" method="post">
							</div><!-- /input-group -->
						</div><!-- /.col-lg-12 -->
						
						<h3>Back</h3>
						<div class="col-lg-12">
							<div class="input-group">
								<span class="input-group-btn">
									<button class="btn btn-default" name = "browserback" type="button">Browser <span class="glyphicon glyphicon-picture" aria-hidden="true"></span></button>
								</span>
								<input type="text" name = "backcard" class="form-control" placeholder="Back of Card" method="post">
							</div><!-- /input-group -->
						</div><!-- /.col-lg-12 -->
						
						
					</div>

				</form>
			</div>

			
		</div>

	</div>

	<script type="text/javascript">
		function home(){
			window.location.href = "home_login.php";
		}
	</script>
	<script src="browser.js"></script>
</body>
</html>

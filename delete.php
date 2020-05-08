<?php
	$servername = "localhost";
	$username = "root";
	$password = "1";
	$dbname = "memorycards";

	$conn = new mysqli($servername, $username, $password, $dbname);
	if ($conn -> connect_error ) {
		die("Khong the ket noi den server : " .$conn->connect_error); 
	}

	$_myfile = "cardid.txt";
	$_tmp = fopen($_myfile, "r");
	while (!feof($_tmp)){
		$_iduser = fgets($_tmp);
		break;
	}
	fclose($_tmp);

	$idcard = $_iduser;

	//đưa ra idgroupcard chứa thẻ
	$sql_idgroupcards = "select idGroupCard from cards where idCard = '$idcard'";
	$rs_idgroupcards = mysqli_query($conn, $sql_idgroupcards);
	$array_groupcards = mysqli_fetch_array($rs_idgroupcards, MYSQLI_ASSOC);

	// xóa thẻ
	//echo "<script> if(confirm('Bạn có chắc chắn xóa thẻ không?')) </script>";
	$sql_del = "delete from cards where idCard = '$idcard'";
	if(mysqli_query($conn, $sql_del)){
		echo "<script> alert('Xóa thành công') </script>";
	}

	//kiểm tra trong groupcard có còn card không nếu không thì xóa groupcard
	$idgroupcard = $array_groupcards['idGroupCard'];
	$check_num = "select idCard from cards where idGroupCard ='$idgroupcard' ";
	$rs_check = mysqli_query($conn, $check_num);
	$a = mysqli_fetch_array($rs_check);

	if (mysqli_num_rows($rs_check) == 0){
		$del_groupcard = "delete from groupcards where idGroupCard = '$idgroupcard'";
		$rs = mysqli_query($conn,$del_groupcard);
	}
	//echo "<script> alert(confirm('Bạn có chắc chắn xóa thẻ không?')) </script>";
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>MyCard</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="group_card.css">
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

	?>
</head>
<body>
	<div class="container-fluid">
		<!-- phần đầu trang, cũng giống như home -->
		<header class="container-fluid">
			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
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

				<!-- Collect the nav links, forms, and other content for toggling -->
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
							<a href="home_login.php"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>
						<li>
							<a href="create.php"><span class="glyphicon glyphicon-plus"></span>CREATE</a>
						</li>
						<li>
							<a href="groupcard.php"><span class="glyphicon glyphicon-user"></span><?php echo $nameuser ?></a>
						</li>
						<li>
							<a href="logout.php" ><span class="glyphicon glyphicon-off"></span>Logout</a>
						</li>

					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>
		

		<main class="content">

			<div class="container">
				<!-- phần chủ đề và mô tả ở bên trái -->
				<div class="col-md-4 intro" >
					<h1 style="text-align: center">▼</h1>
					<img class="theme" src="image/<?php echo $nameuser?>.jpg" alt="thumbnail">
					<h2><a href="groupcard.php"><span class="glyphicon glyphicon-user"></span><?php echo $nameuser ?></a></h2>
					
				</div>

				<!-- phần show ra các card ở bên phải -->
				<div class="col-md-8">
					<h1 style="text-align: center">My Cards</h1>
					<div class="jumbotron clearfix">
						<?php
							$servername = "localhost";
							$username = "root";
							$password = "1";
							$dbname = "memorycards";

							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn -> connect_error ) {
								die("Khong the ket noi den server : " .$conn->connect_error); 
							}

							$sql = "select * from groupcards where idUser = '$iduser' ";
							$result = mysqli_query($conn, $sql);
							if(mysqli_num_rows($result) != 0){
								while ($array_groupcards=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
								?>
									<div class="card_row clearfix">
										<div class="col-md-4 left">
											<a href="card_name_login.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
											<?php
												if ($array_groupcards['cover'] == NULL){
											?>
													<img class = "theme" src="image\nocard.jpg" alt="" height="300" width="250">
											<?php
												}
												else{
											?>
												<img class = "theme" src="<?php echo $array_groupcards['cover'] ?>" alt="" height="300" width="250">
											<?php
												}
											?>
											</a>
										</div>
										<div class="col-md-8 right">
											<a href="card_name_login.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
												<h3><?php echo $array_groupcards['title'] ?></h3>
											</a>
											<p><?php echo $array_groupcards['description'] ?></p>
											<?php
												$sql_count = "select * from cards where idGroupCard = '".$array_groupcards['idGroupCard']."'";
												$rs = mysqli_query($conn, $sql_count);
											?>
											
											<p class="user">
												<image src="image/<?php echo $nameuser?>.jpg" alt="thumbnail" hight="10" width="15">
												<?php
													$id = "select userName from users where idUser = '".$array_groupcards['idUser']."' ";
													$rs_id = mysqli_query($conn, $id);
													$array_username = mysqli_fetch_array($rs_id, MYSQLI_ASSOC);
													echo $array_username['userName'];
												?> 
											</p>
											<p><span class="glyphicon glyphicon glyphicon-book"></span><?php echo (mysqli_num_rows($rs))?></p>

										</div>
									</div>

								<?php
								}
							}
							else{
								echo "<b>NO RESULT </b>";
							}
						?>
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
</html>

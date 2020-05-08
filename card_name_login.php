<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Card_Name</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/card_name.css">
	<link rel="stylesheet" type="text/css" href="css/add.css">
	<script src="jquery/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<link rel="stylesheet" href="latthe.css">
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
	<?php
		$id =  $_GET['id'];
		$title = $_GET['title'];
		$description = $_GET['description'];
		$cover = $_GET['cover'];
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
							<input type="text" id="text_search" name="text_search" class="form-control" placeholder="Search" method="post">
						</div>
						<button type="submit" id="submit_search" name="submit_search" class="btn btn-default" method="post"><span class="glyphicon glyphicon-search"></span></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="home_login.php"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>
						<li>
							<a href="create.php"><span class="glyphicon glyphicon-plus"></span>CREATE</a>
						</li>
						<li>
							<a href="groupcard.php"><span class="glyphicon glyphicon-user"></span><?php echo $nameuser?></a>
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
					<?php
						if ($cover == NULL){
					?>
							<img class = "cover" src="image\nocard.jpg" alt="" height="300" width="250">
					<?php
						}
						else{
					?>
						<img class = "cover" src="<?php echo $cover ?>" alt="" height="300" width="250">
					<?php
						}
					?>
					<h2><b><?php echo $title; ?></b></h2>
					<p class="description"><?php echo $description; ?></p>
					<p class="user">
						<?php
							$servername = "localhost";
							$username = "root";
							$password = "1";
							$dbname = "memorycards";

							$conn = new mysqli($servername, $username, $password, $dbname);
							if ($conn -> connect_error ) {
								die("Khong the ket noi den server : " .$conn->connect_error); 
							}
							$_iduser = "select idUser from groupcards where idGroupCard = '$id' ";
							$rs_iduser = mysqli_query($conn, $_iduser);
							$array_groupcards = mysqli_fetch_array($rs_iduser, MYSQLI_ASSOC);
							$_id = $array_groupcards['idUser'];
							$sql_user = "select userName from users where idUser = '$_id'";
							$result_user = mysqli_query($conn,$sql_user);
							$array_users = mysqli_fetch_array($result_user, MYSQLI_ASSOC);

							$sql_num_card = "select idCard from cards where idGroupCard = '$id'";
							$rs_num_card = mysqli_query($conn, $sql_num_card);

						?>
						<image src="image/<?php echo $array_users['userName']?>.jpg" alt="thumbnail" hight="10" width="15">
						<?php
							echo $array_users['userName'];
						?> 
					</p>
				</div>

				<!-- phần show ra các card ở bên phải -->
				<div class="col-md-8">
					<h1 style="text-align: center">Cards(<?php echo mysqli_num_rows($rs_num_card)?>)</h1>
					<div class="jumbotron clearfix">
						
					<?php
						$sql = "select * from cards where idGroupCard = '$id' ";
						$result = mysqli_query($conn, $sql);
						if(mysqli_num_rows($result) != 0){
							while ($array_cards=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
							?>
								<div class="col-md-4">
									<div class="flip-container" onclick="this.classList.toggle('active');">
										<div class="flipper">
											<div class="front">
												<!-- front content -->
												<?php
													$file_path = $array_cards['frontCard'];
													if (file_exists($file_path)){
												?>
														<img class="img-thumbnail" src="<?php echo $array_cards['frontCard']?>">
												<?php
													}
													else{
												?>
														<div class="boxx-border clearfix">
															<p><b><?php echo $array_cards['frontCard'] ?></b></p>
														</div>
												<?php
													}
												?>
											</div>
											<div class="back">
												<!-- back content -->
												<?php
													$file_path = $array_cards['backCard'];
													if (file_exists($file_path)){
												?>
														<img class="img-thumbnail" src="<?php echo $array_cards['backCard']?>">
												<?php
													}
													else{
												?>
														<div class="boxx-border clearfix">
															<p><b><?php echo $array_cards['backCard'] ?></b></p>
														</div>
												<?php
													}
												?>
										
											</div>
										</div>
									</div>
									<div style="float:right">
										<a href="write_file_edit.php?idCard=<?php echo $array_cards['idCard'] ?>&idgroupcard=<?php echo $id?>&title=<?php echo $title?>&description=<?php echo $description?>" name ="edit" method="get">
											<h6 class="glyphicon glyphicon-edit" ></h6>
										</a>
										<a name="del" href="write_file_delete.php?id=<?php echo $array_cards['idCard']?>&idgroupcard=<?php echo $id?>&title=<?php echo $title?>&description=<?php echo $description?>" method="get">
											<h7  class="glyphicon glyphicon-trash"></h7>
										</a>
									</div>
								</div>
							<?php
							}
						}
					?>
						<div class="add_card">
							<a href="write_file_add.php?idGroupCard=<?php echo $id?>" method="get">
								<h9 class="glyphicon glyphicon-plus" > </h9>
							</a>
						</div>
					</div>
					</div>
				</div>

			</div>
		</main>
	</div>
</body>
</html>
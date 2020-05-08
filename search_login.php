<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Search</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/search_for.css">
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
					<a class="navbar-brand" href="home_login.php">
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
					<form class="navbar-form navbar-left" role="search">
						<div class="form-group">
							<input type="text" name ="text_search" class="form-control" placeholder="Search">
						</div>
						<button type="submit" iid="submit_search" name ="submit_search" class="btn btn-default"><span class="glyphicon glyphicon-search"></span></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="home_login.php"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>

						<li>
							<a href="create.php"><span class="glyphicon glyphicon-plus"></span>Create</a>
						</li>
						<li>
							<a href="groupcard.php"><span class="glyphicon glyphicon-user"></span><?php echo $nameuser; ?></a>
						</li>
						<li>
							<a href="logout.php" ><span class="glyphicon glyphicon-off"></span>Logout</a>
						</li>

					</ul>
				</div>
			</nav>
		</header>
		

		<main class="content">

			<div class="container">
				<div class="row col-md-12" id="search_for">
					<h2 style="text-align: center">Search results for "<?php echo $_GET['text_search']; ?>"</h2>
				</div>
				<div class="row col-md-12">
					<div class="jumbotron clearfix">
						<?php
							if (isset($_REQUEST['submit_search'])){
								$search = $_GET['text_search'];
								if (empty($search)){
									echo "<script> alert('Bạn chưa nhập dữ liệu'); </script>";
									echo "<strong> NO RESULT </strong>";
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

									$sql = "select * from groupcards where title like '%$search%' ";
									$result = mysqli_query($conn, $sql);
									if(mysqli_num_rows($result) != 0){
										while ($array_groupcards=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
										?>
											<div class="card_row clearfix">
												<div class="col-md-4 left">
													<a href="card_name_login_noedit.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
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
												<div class="col-md-8 right" id="title">
													<a href="card_name_login_noedit.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
														<h3><?php echo $array_groupcards['title'] ?></h3>
													</a>
													<p><?php echo $array_groupcards['description'] ?></p>
													<?php
														$sql_count = "select * from cards where idGroupCard = '".$array_groupcards['idGroupCard']."'";
														$rs = mysqli_query($conn, $sql_count);
													?>
													<p class="user">
														<?php
															$id = "select userName from users where idUser = '".$array_groupcards['idUser']."' ";
															$rs_id = mysqli_query($conn, $id);
															$array_username = mysqli_fetch_array($rs_id, MYSQLI_ASSOC);
														?>
														<image src="image/<?php echo $array_username['userName']?>.jpg" alt="thumbnail" hight="10" width="15">
														<?php
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
								}
							}

						?>
					
					</div>
				</div>
			</div>
		</main>
	</div>
</body>
</html>
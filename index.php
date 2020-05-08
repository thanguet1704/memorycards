<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Home</title>
	<!-- Latest compiled and minified CSS & JS -->
	<link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="css/home.css">
	<script src="jquery/jquery.js"></script>
	<script src="bootstrap/js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
	<div class="container-fluid">
		<header class="container-fluid">
			<!-- Phân này tạo cái hàng trên cùng, gồm tên, ô search, create, home và login -->
			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button> -->
					<a class="navbar-brand" href="#">
						<img src="image/squarelogo.jpg" alt="">
					</a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="active">
							<a href="home.php">SmartCards</a>
						</li>	
					</ul>
					<form class="navbar-form navbar-left" method ="GET" role="search" action="search.php">
						<div class="form-group">
							<input type="text" id="text_search" name ="text_search" class="form-control" placeholder="Search">
						</div>
						<button type="submit" id="submit_search" name ="submit_search" class="btn btn-default" data-toggle="modal" data-target="#SearchResult"><span class="glyphicon glyphicon-search"></span></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#" onclick="home()"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>
						
						<li>
							<a data-toggle="modal" href="#SignInModal" onclick = "login()" ><span class="glyphicon glyphicon-user"></span>Login</a>
						</li>
						<li>
							<a data-toggle="modal" href="#SignUpModal" onclick = "register()" ><span class="glyphicon glyphicon-pencil"></span>Register</a>
						</li>

					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>

		<!-- Silde trôi -->
		<section>
			<div class="container">
				<div class="row" >
					<div class="col-md-12 col-xs-6" >
						<div id="carousel-id" class="carousel slide" data-ride="carousel" >
							<ol class="carousel-indicators">
								<li data-target="#carousel-id" data-slide-to="0" class=""></li>
								<li data-target="#carousel-id" data-slide-to="1" class=""></li>
								<li data-target="#carousel-id" data-slide-to="2" class="active"></li>
							</ol>
							<div class="carousel-inner" >
								<div class="item">
									<img alt="First slide" src="image/banner1.jpg" >

								</div>
								<div class="item">
									<img alt="Second slide" src="image/banner2.jpg">

								</div>
								<div class="item active">
									<img alt="Third slide" src="image/banner3.jpg">

								</div>
							</div>
							<a class="left carousel-control" href="#carousel-id" data-slide="prev"><span class="glyphicon glyphicon-chevron-left"></span></a>
							<a class="right carousel-control" href="#carousel-id" data-slide="next"><span class="glyphicon glyphicon-chevron-right"></span></a>
						</div>
					</div>
				</div>
			</div>
		</section>

		<div class="container text-description">
			<h3>SmartCard</h3>
			<p><em>The world from magic cards</em></p>
			<p>là loại thẻ mang thông tin (từ, số hoặc cả hai), được sử dụng cho việc học bài trên lớp hoặc trong nghiên cứu cá nhân. người dùng sẽ viết một câu hỏi ở mặt trước thẻ và một câu trả lời ở trang sau. Người ta thường dùng Smartcard học từ vựng tiếng Anh rất hiệu quả. Ngoài ra có thể dùng Smartcard để học ngày tháng năm lịch sử, công thức hoặc bất kỳ vấn đề gì có thể được học thông qua định dạng một câu hỏi và câu trả lời. Smartcard được sử dụng rộng rãi như một cách rèn luyện để hỗ trợ ghi nhớ bằng cách lặp đi lặp lại cách nhau.</p>
			<br>
		</div>

		<hr>

		<!-- trending và see all -->
		<section>
			<div class="container">
				<div class="row text-content" >
					<div class="col-md-8">
						<h2 class="title">Trending</h2>
					</div>
					<div class="col-md-4 button-see-all">
						<a href="searchall.php">
							<button type="button" class="btn btn-default" style="float: right">See All</button>
						</a>
					</div>
				</div>
			</div>
		</section>

		<!-- danh sách các CARD mà mình có, show ra -->
		<div class="container">
			<div class="well clearfix">
				<div class="main-content">
					<?php
						$servername = "localhost";
						$username = "root";
						$password = "1";
						$dbname = "memorycards";

						$conn = new mysqli($servername, $username, $password, $dbname);
						if ($conn -> connect_error ) {
							die("Khong the ket noi den server : " .$conn->connect_error); 
						}

						$sql = "select * from groupcards limit 6";
						$result = mysqli_query($conn, $sql);
						if(mysqli_num_rows($result) != 0){
							while ($array_groupcards=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
							?>
								<div class="one-topic">
									<div class="image-show">
										<a href="card_name.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
											<div class="image">
												<img src="<?php echo $array_groupcards['cover']?>" alt="" height="170" width="150">
											</div>
										</a>
									</div>
									<div class="progress">
										<div class="progress-bar progress-bar-striped">
											<span class="sr-only">60%</span>
										</div>
									</div>
									<div class="title-card">
										<a href="card_name.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
											<div class="text-title-card">
												<p><?php echo $array_groupcards['title']?></p>
											</div>
										</a>
									</div>
									<div class="user">
										<p>
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
									</div>
									<div class="number-cards">
										<div>
											<?php
												$sql_count = "select * from cards where idGroupCard = '".$array_groupcards['idGroupCard']."'";
												$rs = mysqli_query($conn, $sql_count);
											?>
											<p><span class="glyphicon glyphicon glyphicon-book"></span><?php echo (mysqli_num_rows($rs))?></p>
										</div>
									</div>
								</div>

							<?php
							}
						}
					?>
				</div>
			</div>
		</div>

		<br>
		<br>
		<!-- Container (Contact Section) -->
		<div id="contact" class="container">
			<h3 class="text-center">Contact</h3>
			<br>

			<div class="row">
				<div class="col-md-4">
					<p>Fan? Drop a note.</p>
					<p><span class="glyphicon glyphicon-map-marker"></span>Chicago, US</p>
					<p><span class="glyphicon glyphicon-phone"></span>Phone: +00 1515151515</p>
					<p><span class="glyphicon glyphicon-envelope"></span>Email: mail@mail.com</p>
				</div>
				<div class="col-md-8">
					<div class="row">
						<div class="col-sm-6 form-group">
							<input class="form-control" id="name" name="name" placeholder="Name" type="text" required>
						</div>
						<div class="col-sm-6 form-group">
							<input class="form-control" id="email" name="email" placeholder="Email" type="email" required>
						</div>
					</div>
					<textarea class="form-control" id="comments" name="comments" placeholder="Comment" rows="5"></textarea>
					<br>
					<div class="row">
						<div class="col-md-12 form-group">
							<button class="btn pull-right" type="submit">Send</button>
						</div>
					</div>
				</div>
			</div>
			<br>

		</div>
		
		


		<!-- Footer -->
		<footer class="text-center">
			
			<a class="up-arrow" href="#myPage" data-toggle="tooltip" title="TO TOP">
				<span class="glyphicon glyphicon-chevron-up"></span>
			</a>
			<br>
			<br>
			
		</footer>

		<!-- cái này là modal hiện lên để sign up 
		<div class="modal fade" id="SignUpModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
					<div class="container-fluid" style="padding-top: 20px">
						<center><h3><STRONG> Creat an account</STRONG></h3></center>

						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Example: anyone@gmail.com">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="********">
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Retype your password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="********">
							</div>
							<button type="button" class="btn btn-success" onclick="sweetalert()" data-dismiss="modal">Sign Up</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</form>
					</div>
				</div>
			</div>
		</div>

		cái này là modal hiện lên để sign in 
		<div class="modal fade" id="SignInModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"></span></button>
					<div class="container-fluid" style="padding-top: 20px">
						<center><h3><STRONG> SIGN IN </STRONG></h3></center>
					
						<form>
							<div class="form-group">
								<label for="exampleInputEmail1">Email address</label>
								<input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Example: anyone@gmail.com">
								<small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
							</div>
							<div class="form-group">
								<label for="exampleInputPassword1">Password</label>
								<input type="password" class="form-control" id="exampleInputPassword1" placeholder="********">
							</div>
							
							<button type="button" class="btn btn-success" data-dismiss="modal">Sign In</button>

							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</form>
					</div>
				</div>
			</div>
		</div> -->
	
	<div class="modal fade" id="SearchResult" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<blockquote class="blockquote text-center">
							<p class="mb-0">Nothing found</p>
							<footer class="blockquote-footer">Dev</footer>
						</blockquote>
					</div>
				</div>
			</div>
</div>

<script>
	function sweetalert() {			
		swal(
			'Good job!',
			'Sign up success!',
			'success'

		)
	}
	function create(){
		window.location.href = "create.php";
	}

	function login(){
		window.location.href = "login.php";
	}
	function register(){
		window.location.href = "register.php";
	}
	function home(){
		window.location.href = "home.php";
	}
	function card_name(){
		window.location.href = "card_name.php";
	}
</script>
</body>
</html>


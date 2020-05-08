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
	<link rel="stylesheet" href="stylemenu.css"> 
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
		<header class="container-fluid">
			<!-- Phân này tạo cái hàng trên cùng, gồm tên, ô search, create, home và login -->
			<nav class="navbar navbar-default" role="navigation">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<!-- <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-baro"></span>
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
							<a href="home_login.php">SmartCards</a>
						</li>	
					</ul>
					<form class="navbar-form navbar-left" method ="GET" role="search" action="search_login.php">
						<div class="form-group">
							<input type="text" name ="text_search" class="form-control" placeholder="Search">
						</div>
						<button type="submit" id="submit_search" name ="submit_search" class="btn btn-default" data-toggle="modal" data-target="#SearchResult"><span class="glyphicon glyphicon-search"></span></button>
					</form>
					<ul class="nav navbar-nav navbar-right">
						<li>
							<a href="#" onclick="home()"><span class="glyphicon glyphicon-home"></span>HOME</a>
						</li>
						<li>
							<a href="#" onclick="create()"><span class="glyphicon glyphicon-plus"></span>CREATE</a>
						</li>
						<li>
							<a data-toggle="modal" href="#" onclick="groupcard()" ><span class="glyphicon glyphicon-user"></span><?php  echo $nameuser;  ?></a>
						</li>
						<li>
							<a href="logout.php" ><span class="glyphicon glyphicon-off"></span>Logout</a>
						</li>
						

					</ul>
				</div><!-- /.navbar-collapse -->
			</nav>
		</header>

		<!-- Silde trôi -->

		<section>
			<div class="container">
				<div class="row" >
					<div class="col-md-12" >
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
					<div class="col-md-4 button-see-all" >
						<a href="searchall_login.php" >
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

						$sql = "select * from groupcards limit 6 ";
						$result = mysqli_query($conn, $sql);
						if(mysqli_num_rows($result) != 0){
							while ($array_groupcards=mysqli_fetch_array($result,MYSQLI_ASSOC)) {
							?>
								<div class="one-topic">
									<div class="image-show">
										<a href="card_name_login_noedit.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
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
										<a href="card_name_login_noedit.php?id=<?php echo $array_groupcards['idGroupCard'] ?>&title=<?php echo $array_groupcards['title'] ?>&description=<?php echo $array_groupcards['description'] ?>&cover=<?php echo $array_groupcards['cover'] ?>" method="get">
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
	function home(){
		window.location.href = "home_login.php";
	}

	function create(){
		window.location.href = "create.php";
	}
	function groupcard(){
		window.location.href = "groupcard.php";
	}
	

</script>
<script>
    /* Thêm hoặc xóa class show ra khỏi phần tử */
    function myFunction(id) {
        document.getElementById(id).classList.toggle("show");
    }
    //lấy tất cả các button menu
    var buttons = document.getElementsByClassName('glyphicon glyphicon-user');
    //lấy tất cả các thẻ chứa menu con
    var contents = document.getElementsByClassName('dropdown-content');
    //lặp qua tất cả các button menu và gán sự kiện
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].addEventListener("click", function(){
            //lấy value của button
            var id = this.value;
            //ẩn tất cả các menu con đang được hiển thị
            for (var i = 0; i < contents.length; i++) {
                contents[i].classList.remove("show");
            }
            //hiển thị menu vừa được click
            myFunction(id);
        });
    }
    //nếu click ra ngoài các button thì ẩn tất cả các menu con
    window.addEventListener("click", function(){
         if (!event.target.matches('.glyphicon glyphicon-user')){
            for (var i = 0; i < contents.length; i++) {
                contents[i].classList.remove("show");
            }
         }
    });
</script>
</body>
</html>


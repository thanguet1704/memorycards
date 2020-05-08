<?php
	session_start();
	session_destroy();
	unlink("temp.txt");
	header("Location: home.php");
?>

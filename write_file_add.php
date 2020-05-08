<?php 

	unlink('idgroupcard.txt');

	$_myfileGC = fopen('idgroupcard.txt', "a");
	$_idGC = $_GET['idGroupCard'];
	fwrite($_myfileGC, $_idGC);
	fclose($_myfileGC);
	echo $_idGC;

	header("Location: add_card.php");
?>
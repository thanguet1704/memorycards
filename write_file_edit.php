<?php 

	unlink('cardid.txt');

	$_myfile = fopen('cardid.txt', "a");
	$_id = $_GET['idCard'];
	fwrite($_myfile, $_id);
	fclose($_myfile);
	echo $_id;


	unlink('groupcardid.txt');

	$_myfileGC = fopen('groupcardid.txt', "a");
	$_idGC = $_GET['idgroupcard'];
	fwrite($_myfileGC, $_idGC);
	fclose($_myfileGC);
	echo $_idGC;
	//}
	header("Location: edit.php");
?>
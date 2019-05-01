<?php
session_start();
$staffname = $_SESSION['staffname'];
	if(isset($staffname)){
		$_SESSION['staffname'] = $_SESSION['staffname'];
	}
	echo "Keep moving...";
	exit;
?>

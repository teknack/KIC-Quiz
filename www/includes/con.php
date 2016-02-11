<?php
	define('HOST', 'localhost');
	define('USER', 'root');
	define('PASS', '');
	define('DB', 'kic_quiz');

	$con = new mysqli(HOST,USER,PASS,DB) or die("Database connection couldn't be established");
?>
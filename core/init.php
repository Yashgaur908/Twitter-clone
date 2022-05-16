<?php 
	session_start();
	include 'database/connection.php';
	include 'classes/user.php';
	include 'classes/tweet.php';
	include 'classes/follow.php';
	include 'classes/message.php';
  	global $pdo;

  	$getFromU = new User($pdo);
  	$getFromT = new Tweet($pdo);
    $getFromF = new Follow($pdo);
    $getFromM = new Message($pdo);
  
  	define('BASE_URL', 'http://localhost/twitter/');
 ?>                                                   
 
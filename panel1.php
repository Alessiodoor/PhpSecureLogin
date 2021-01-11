<!DOCTYPE html>
<html>
<head>
	<title>Panel1</title>
	<?php 
	    //check login values
	    require_once 'php/db_conn.php';
	    include 'php/functions.php';

	    sec_session_start();

	    include 'php/links.php';

	    if(!login_check($conn)){
	        header('Location: login.php?dest=http://' . $_SERVER['HTTP_HOST'] . $_SERVER["REQUEST_URI"]);
	    }

	    if(isset($_SESSION['username'])){
	        $username = $_SESSION['username'];
	    }
	?> 
</head>
<body>
	<h1>Welcome to Panel1 <?php echo $username; ?>!</h1>
	<a class="nav-link tab-consigliati cursor-pointer" href="logout.php" onclick="clearLocalStorage()">Logout</a>
</body>
</html>
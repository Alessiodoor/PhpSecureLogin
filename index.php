<!DOCTYPE html>
<html>
<head>
	<title>LoginTemplate</title>
  	<?php 
  		include 'php/links.php';
      	require_once 'php/db_conn.php';
      	sec_session_start();
      	include 'php/functions.php';
 	?>
</head>
<body>
	<section id=title>
		<div>
		  <nav class="navbar navbar-expand-lg">
	          <a class="navbar-brand card-title" href="index.php">stappa</a>
	           <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
	          <span class="navbar-toggler-icon"></span>
	        </button>
	        <div class="collapse navbar-collapse" id="navbarSupportedContent">
	          <ul class="navbar-nav ml-auto">
	              <li class="nav-item">
	              	<?php
			          if(login_check($conn)){
			              echo '<a class="nav-link" href="login.php">' . $_SESSION['username'] . '</a>';
			          }else{
			              echo '<a class="nav-link" href="login.php">Login</a>';
			          }
			        ?>
	              </li>
	          </ul>
	       </div>
	      </nav>
	</div>
	</section>

</body>
</html>
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
		<?php
			require_once 'php/db_conn.php';
			include 'php/functions.php';
			// Elimina tutti i valori della sessione.
			sec_session_start();
			$_SESSION = array();
			// Recupera i parametri di sessione.
			$params = session_get_cookie_params();
			// Cancella i cookie attuali.
			setcookie(session_name(), '', time() - 42000, $params["path"], $params["domain"], $params["secure"], $params["httponly"]);
			// Cancella la sessione.
			session_destroy();
			header("location: index.php"); 
		?>
	</head>
</html>
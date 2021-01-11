<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
    	<title>Login</title>
        <?php
            include 'php/links.php';
            require_once 'php/db_conn.php';
            include 'php/functions.php';
            sec_session_start();

            $error = false;

            if(login_check($conn)){
                switch ($_SESSION['type']) {
                    case 0:    
                        header('Location: panel1.php');
                        break;
                    case 1:
                        header('Location: panel2.php');
                        break;
                    
                    default:
                        echo "Tipo invalido";
                        break;
                }
            }

            if(isset($_POST["user-log"], $_POST['p'])){
                $user = $_POST["user-log"];
                $pass = $_POST['p'];
                $type = $_POST['type'];
                if(login($user, $pass, $type, $conn) == true){
                    //header("location: ". $_POST['destination']); 
                    switch ($type) {
                        case 0:    
                            header('Location: panel1.php');
                            break;
                        case 1:
                            header('Location: panel2.php');
                            break;
                        default:
                            echo "Tipo invalido";
                            break;
                    }
                }else{
                    $error = true;
                    //header('Location: login.php?dest=' . $_POST['destination'] . '&error=1&email=' . $user);
                }
            } 
        ?>
    </head>

    <script type="text/javascript">
        $( document ).ready(function() {
            if(localStorage['type'] == '0'){
                $("#panel1").prop("checked", true);
            }
            if(localStorage['type'] == '1'){
                $("#panel2").prop("checked", true);
            }
            $('.type_radio').click(function () {
               var checkedradio = $('[name="type"]:radio:checked').val();
               localStorage['type'] = checkedradio;
            });
        }); 

    </script>

    <script>
        function submitFromKey(e){
            if (e.keyCode == 13) {
                var form = document.getElementById("login-form");
                formhash(form, form.password);
            }
        }
    </script>

    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <div class="container panel">
            <nav class="navbar navbar-expand-lg">
                  <a class="navbar-brand card-title" href="index.php">LoginTemplate</a>
                   <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                  <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  <ul class="navbar-nav ml-auto">

                  </ul>
               </div>
              </nav>
            <!-- Login Block Content -->
            <section id="login">
            	<div>
                	<p class="text-shadow" style="font-size: 80px; text-align: center; margin-top: 100px;">Welcome</p>
                </div>
                	<?php
    	            	if(isset($_GET['error'])){
    	            		$error = $_GET['error'];
    	            		if($error < 10)
    	            			echo '<div class="container form-div">';
    	            		else
    	            			echo '<div class="container form-div" style="display: none;">';
    	            	}else
    	            		echo '<div class="container form-div">';
                	?>
                    <div class="reg-box">
                        <?php
                            if($error){
                                echo '<h4 style="color: red">Credenziali errate, riprova.</h4>';
                            }
                        ?>
                        <div class="row form-box shadow">
                            <div class="col-sm-12" style="margin-top: 20px;">
                                <form id="login-form" action="login.php" method="post">
                                    <div class="row">
                                        <p>Chi sei?</p>
                                        <label class="radio-inline">
                                            <input type="radio" class="type_radio" id="admin" name="type" value="0" checked>Panel1
                                        </label>
                                        <label class="radio-inline">
                                            <input type="radio" class="type_radio" id="birreria" name="type" value="1">Panel2
                                        </label>
                                    </div> 
                                    <hr>

                                    <input type="hidden" name="destination" value="<?php echo $_GET['dest'];?>">
                                    <!-- in $_GET['prev'] c'è l'ndirizzo della pagina precedente nel caso del login dalla ricerca-->
                                	<?php          
    	                            	if(isset($_GET["error"])){
    						            	$error = $_GET["error"];
    						            	if($error == 1)
    						            		echo '<p style="color: red;">Username o password errati</p>';
    						            }
    					            ?>
                                    <div class="row">
                                        <?php
                                            if(isset($_GET['error']))
                                                echo '<input  class="reg-el reg-in col-sm-12" style="width: 96%;" id="login-user" type="email" name="user-log" value="' .$_GET['email'] . '" required>';
                                            else
                                                echo '<input class="reg-el reg-in col-sm-12" style="width: 96%;" id="login-user" type="email" name="user-log" placeholder="Email" value required>';
                                        ?>
                                    </div>
                                    <div class="row">
                                        <input class="reg-el reg-in col-sm-12" style="width: 96%;" type="password" name="p" id="password" placeholder="Password" onkeypress="return submitFromKey(event)" required>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <button class="btn btn-primary btn-lg btn-block" value="login" type="button" name="btn" onclick="formhash(this.form, this.form.password);">Accedi</button>                
                                    </div>          
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section><!-- Block Content end-->
        </div>
        <!-- JavaScript -->
        <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
    </body>	
</html>	
<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <script type="text/javascript" src="js/sha512.js"></script>
        <script type="text/javascript" src="js/forms.js"></script>

    	<title>Registration</title>
        <?php
            require_once 'php/db_conn.php';
            include 'php/functions.php';
            sec_session_start();
            include 'php/links.php';
        ?>
        
    </head>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <script type="text/javascript">
            function setEmail(id){
                var selectBox = document.getElementById(id);
                var selectedValue = selectBox.options[selectBox.selectedIndex].getAttribute('email');
                if(selectedValue != ''){
                    document.getElementById('email').value = selectedValue;
                }
            }
        </script>
        <head>
        	<div class="nav-logo col-xs-10">
                <a class="navbar-brand" href="index.php"><p style="font-size: 27px; color: #231808;">LoginTemplate</p></a>
            </div>
        </head>

         <!-- Reg Block Content -->
        <section>
            <?php
            	/*if(isset($_GET['error'])){
            		$error = $_GET['error'];
            		if($error >= 10)
            			echo '<div class="container form-div">';
            		else
            			echo '<div class="container form-div" style="display: none;">';
            	}else
					echo '<div class="container form-div" style="display: none;">'; */           		
            ?>
                <div class="reg-box">
                    <div class="row shadow">
                        <div class="col-sm-12" style="padding: 20px; margin-left: 20px;">
                            <form action="account_creation.php" id="reg-form" method="post">                   
                                <div class="row">
                                    <p>Select type</p>
                                    <select name="type" form="reg-form" id="type">
                                        <option value="0">Panel1</option>
                                        <option value="1">Panel2</option>
                                    </select>
                                </div> 

                                <div class="row" id="pub-name-div" style="display: none;">
                                    <input class="reg-el reg-in col-sm-12" style="width: 96%;" id="pub-name" type="text" name="name" placeholder="Nome birreria" required>
                                </div>

                                <hr>  

                                <div class="row">
                                    <input class="reg-el reg-in col-sm-12" style="width: 96%;" id="passreg" type="password" name="password" placeholder="Nuova Password" required>
                                </div>   
                                <div class="row">
                                    <input class="reg-el reg-in col-sm-12" style="width: 96%;" id="email" type="email" name="email" placeholder="Email" required>
                                </div>   
                                <hr>   
                                <button class="reg-btn btn btn-primary" value="reg" id="regsubmit" type="button" name="btn" onclick="formhash(this.form, this.form.passreg);">Register</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section><!-- Block Content end-->

        <!-- JavaScript -->
        <script src="http://code.jquery.com/jquery-1.12.1.min.js"></script>		
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>
        <!-- Bootsnav js -->
        <script src="js/bootsnav.js"></script>

        <!-- JS Implementing Plugins -->
        <script src="http://maps.google.com/maps/api/js?sensor=true"></script>
        <script src="js/gmaps.min.js"></script>
        
        <!--main js-->
        <script type="text/javascript" src="js/main.js"></script>
    </body>	
</html>	
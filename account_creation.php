<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8"> <![endif]-->
<!--[if !IE]><!--> <html lang="en"> <!--<![endif]-->
    <head>
        <title>Complete Registration</title>
        <?php
            //check login values
            require_once 'php/db_conn.php';
            include 'php/functions.php';
            sec_session_start();

            if(isset($_POST["p"], $_POST['email'], $_POST['type'])){
                // Recupero la password criptata dal form di inserimento.
                $password = $_POST['p'];
                $email = $_POST['email'];
                $type = $_POST['type'];

                // Crea una chiave casuale
                $random_salt = hash('sha512', uniqid(mt_rand(1, mt_getrandmax()), true));
                // Crea una password usando la chiave appena creata.
                $password = hash('sha512', $password.$random_salt);

                /*$ret = check($email, $conn);//check email metodo vecchio
                if($ret != 0)
                    header('Location: login.php?error=' . $ret . '&dest=account.php');*/
                // Inserisci a questo punto il codice SQL per eseguire la INSERT nel tuo database
                // Assicurati di usare statement SQL 'prepared'.
                if ($type == 0 || $type == 1) {
                    $sql = "INSERT INTO Admin (email, password, salt, type) VALUES (?, ?, ?, ?)";
                    if($stmt = $conn->prepare($sql)){
                        $stmt->bind_param("sssi", $email, $password, $random_salt, $type);
                        $stmt->execute();
                        echo "<p>Admin created</p><br><a href='login.php'>Go back to panel</a>";
                    }else{
                        echo "Errore INSERT Amministratore";
                    }
                }else{
                    echo "Invalid type";
                }
            }else{
                echo "error";
            }
        ?>
    </head>
    <body data-spy="scroll" data-target="#navbar-menu" data-offset="100">
        <!-- scroll up-->
        <div class="scrollup">
            <a href="#"><i class="fa fa-chevron-up"></i></a>
        </div><!-- End off scroll up-->

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
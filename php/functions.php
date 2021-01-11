<?php
    function checkbrute($user_id, $mysqli) {
       // Recupero il timestamp
       $now = time();
       // Vengono analizzati tutti i tentativi di login a partire dalle ultime due ore.
       $valid_attempts = $now - (2 * 60 * 60); 
       if ($stmt = $mysqli->prepare("SELECT time FROM login_attempts WHERE user_id = ? AND time > '$valid_attempts'")) { 
          $stmt->bind_param('i', $user_id); 
          // Eseguo la query creata.
          $stmt->execute();
          $stmt->store_result();
          // Verifico l'esistenza di più di 5 tentativi di login falliti.
          if($stmt->num_rows > 5) {
             return true;
          } else {
             return false;
          }
       }
    }

    function login($username, $password, $type, $mysqli) {
      // Usando statement sql 'prepared' non sarà possibile attuare un attacco di tipo SQL injection.
      if($type == 0 || $type == 1) {
          $sql = "SELECT id, email, password, salt, type FROM Admin WHERE email = ? LIMIT 1";
      }else{
          // Invalid type
          return false;
      }

      if ($stmt = $mysqli->prepare($sql)) {
          $stmt->bind_param('s', $username); // esegue il bind del parametro '$username'.
          $stmt->execute(); // esegue la query appena creata.
          $stmt->store_result();
          $stmt->bind_result($user_id, $db_user, $db_password, $salt, $db_type); // recupera il risultato della query e lo memorizza nelle relative variabili.
          $stmt->fetch();
          // controllo che il tipo di admin corrisponda a quello del db
          if($type == $db_type){
            $password = hash('sha512', $password.$salt); // codifica la password usando una chiave univoca.

            if($stmt->num_rows == 1) { // se l'utente esiste
                // verifichiamo che non sia disabilitato in seguito all'esecuzione di troppi tentativi di accesso errati.
                if(checkbrute($user_id, $mysqli) == true) { 
                    // Account disabilitato
                    // Invia un e-mail all'utente avvisandolo che il suo account è stato disabilitato.
                    return false;
                } else {
                    if($db_password == $password) { // Verifica che la password memorizzata nel database corrisponda alla password fornita dall'utente.
                    // Password corretta!            
                       $user_browser = $_SERVER['HTTP_USER_AGENT']; // Recupero il parametro 'user-agent' relativo all'utente corrente.
                      
                       $user_id = preg_replace("/[^0-9]+/", "", $user_id); // ci proteggiamo da un attacco XSS
                       $_SESSION['user_id'] = $user_id; 
                       $db_user = preg_replace("/[^a-zA-Z0-9_\-]+/", "", $db_user); // ci proteggiamo da un attacco XSS
                       $_SESSION['username'] = $db_user;
                       $_SESSION['login_string'] = hash('sha512', $password.$user_browser);
                       $_SESSION['type'] = $type;
                       // Login eseguito con successo.
                       return true;    
                    } else {
                        // Password incorretta.
                        // Registriamo il tentativo fallito nel database.
                        $now = time();
                        $mysqli->query("INSERT INTO login_attempts (user_id, time) VALUES ('$user_id', '$now')");
                        return false;
                    }
                }
            } else {
               // L'utente inserito non esiste.
               return false;
            }
          }else{
            // il tipo non corrisponde con quello del db
            return false;
          }
       }
    }

    function login_check($mysqli) {
       // Verifica che tutte le variabili di sessione siano impostate correttamente
        if(isset($_SESSION['user_id'], $_SESSION['username'], $_SESSION['login_string'], $_SESSION['type'])) {
           $user_id = $_SESSION['user_id'];
           $login_string = $_SESSION['login_string'];
           $username = $_SESSION['username'];    
           $type = $_SESSION['type'];
           $user_browser = $_SERVER['HTTP_USER_AGENT']; // reperisce la stringa 'user-agent' dell'utente.

        if($type == 0 || $type == 1) {
            $sql = "SELECT password FROM Admin WHERE id = ? LIMIT 1";
        }else{
            echo "Invalid type";
            return false;
        }

          if ($stmt = $mysqli->prepare($sql)) { 
            $stmt->bind_param('i', $user_id); // esegue il bind del parametro '$user_id'.
            $stmt->execute(); // Esegue la query creata.
            $stmt->store_result();
          
            if($stmt->num_rows == 1) { // se l'utente esiste
               $stmt->bind_result($password); // recupera le variabili dal risultato ottenuto.
               $stmt->fetch();
               $login_check = hash('sha512', $password.$user_browser);
               if($login_check == $login_string) {
                  // Login eseguito!!!!
                  return true;
               } else {
                  //  Login non eseguito
                  return false;
               }
            } else {
                // Login non eseguito
                return false;
            }
         } else {
            // Login non eseguito
            return false;
         }
       } else {
         // Login non eseguito
         return false;
       }
    }

    function checkpass($password){
      if(strlen($password) < 6)
        header('Location: login.php?error=11');
      /*if (preg_match('#[0-9]#',$password)){
        header('Location: login.php?error=12');*/
    }

    // not used
    function check($email, $mysqli){             
      $sql = "SELECT * FROM utente WHERE email = '$email'";
      $result = $mysqli->query($sql);
      if ($result->num_rows > 0) 
        return 15;

      return 0;
    }
  ?>
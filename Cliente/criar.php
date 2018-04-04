<?php require_once 'config.php';
      require_once DBAPI; 

if(!empty($_POST['enviar_reg'])){
    $nome = $_POST['nome'];
      $email = $_POST['email'];
       $tipo_pagamento = $_POST['tipo_pagamento'];
 }else
    echo "Alguma coisa aconteceu!"; 

  if(filter_var($email,FILTER_VALIDATE_EMAIL)){
          $db = open_database();
           $sql = "INSERT INTO `cliente`(`nome`, `email`, `tipo_pagamento`) VALUES ('$nome','$email','$tipo_pagamento')";
            $db->query($sql);

        // Fecahndo a conexão com o banco.
        close_database($db);
         echo "Registros criado! ";
  } else
      echo "Email Inválido" ;
      
  


        
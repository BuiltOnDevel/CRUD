<?php require_once 'config.php';
      require_once DBAPI; 

if(!empty($_POST['enviar_ped'])){
    $id_cliente = $_POST['id_cliente'];
      $id_produto = $_POST['id_produto'];
       $quantidade = $_POST['quantidade'];
		$valor = $_POST['valor'];
 }else
    echo "Alguma coisa aconteceu!"; 

  if($quantidade > 0){
	     $valor = $valor * $quantidade;
          $db = open_database();
           $sql = "INSERT INTO `pedido`(`id_cliente`, `id_produto`, `quantidade`, `valor_total`) VALUES ('$id_cliente','$id_produto','$quantidade','$valor')";
            $db->query($sql);

        // Fecahndo a conexão com o banco.
        close_database($db);
         echo "Registros criado! ";
  } else
      echo "Valor Inválido" ;
      
  


        
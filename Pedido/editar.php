<?php require_once 'config.php';
      require_once DBAPI; ?>

<!DOCTYPE html>
<html lang="">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
</head>
        <?php 
             $id_cliente = ($_GET['codigo']);
               $db=open_database();
                $sql = "SELECT `id_cliente`, `id_produto`, `quantidade`, `valor_total` FROM `pedido` WHERE id_cliente = '$id_cliente'";
                 $resultado = $db->query($sql); 
             
           /*Essa maneira de lista os dados, usa o metodo "statements", mas no caso eu estou usando os
           dois tipos de métodos, mas o statements é mais seguro contra SQL injection
           é só descomentar o código, que ele irá mostra o nome do cliente em um echo! */
          /* $stmt = $db->prepare("SELECT `nome` FROM `pedido` WHERE id = ?");   
               $stmt->bind_param('i', $id);
                 $stmt->execute();
                  $resultado_stmt = $stmt->get_result();
                   $resultado_stmt->fetch_all();
                     foreach($resultado_stmt as $dados){
                      echo $dados['nome'];
                  }*/
    
            if($resultado ->num_rows > 0)
                 $resultado  = $resultado->fetch_all(MYSQLI_ASSOC);
                  foreach($resultado as $dados){
                    $id_cliente = $dados['id_cliente'];
                      $id_produto = $dados['id_produto'];
                       $quantidade = $dados['quantidade'];
                        $valor = $dados['valor_total'];
                         
                }
        ?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nome">ID do Cliente</label>
            <input type="text" name="id_cliente" value="<?php echo $id_cliente; ?>" />
        </div>
        <div>
            <label for="email">ID do produto</label>
            <input type="text" name="id_produto" value="<?php echo $id_produto; ?>" />
        </div>
        <div>
            <label for="tipo_pagamento">Quantidade:</label>
			<input type="number" name="quantidade" min="0" value="<?php echo $quantidade; ?>">
        </div>
        <div>
            <label for="valor">Valor</label>
			<input type="text" name="valor" value="<?php echo $valor; ?>">
            <div>
        </div>
        </div>
        <div>
            <input type="submit" name="atualizar" value="Atualizar" />
            <input type="submit" name="excluir" value="Excluir" />
        </div>
    </form>
    <script src=""></script>
</body>
</html>

    <?php
    // Post caso o usuario queria atualizar
    if(!empty($_POST['atualizar'])){
        if(!isset($_GET['id_cliente'])){
               $id_cliente= $_POST['id_cliente'];
                $id_produto = $_POST['id_produto'];
                  $quantidade = $_POST['quantidade'];
				   $valor = $_POST['valor'];
                     $sql = "UPDATE pedido set id_cliente = '$id_cliente', id_produto = '$id_produto',quantidade = '$quantidade',valor_total = '$valor' where id_cliente = '$id_cliente' ";
                       $db->query($sql);
               }
               
           volta();
         } 
    // Deleta usuario junto com o arquivo
    if(!empty($_POST['excluir'])){
          $sql = "DELETE FROM `pedido` WHERE id_cliente = '$id_cliente' ";
            $db->query($sql);
             volta();
    }
    function volta(){
        header('Location: listar.php');
    }
  
    close_database($db);
   
?>
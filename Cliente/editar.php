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
             $id = ($_GET['codigo']);
               $db=open_database();
                $sql = "SELECT `nome`, `email`, `data_cadastro`, `tipo_pagamento` FROM `cliente` WHERE id = '$id'";
                 $resultado = $db->query($sql); 
             
           /*Essa maneira de lista os dados, usa o metodo "statements", mas no caso eu estou usando os
           dois tipos de métodos, mas o statements é mais seguro contra SQL injection
           é só descomentar o código, que ele irá mostra o nome do cliente em um echo! */
          /* $stmt = $db->prepare("SELECT `nome` FROM `cliente` WHERE id = ?");   
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
                    $nome = $dados['nome'];
                      $email = $dados['email'];
                       $data_cadastro = $dados['data_cadastro'];
                        $tipo_pagamento = $dados['tipo_pagamento'];
                         
                }
        ?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" />
        </div>
        <div>
            <label for="email">Email</label>
            <input type="text" name="email" value="<?php echo $email; ?>" />
        </div>
        <div>
            <label for="tipo_pagamento">Data de Cadastro</label>
            <label name="tipo_pagamento"><?php echo $data_cadastro; ?></label>
        </div>
        <div>
            <label for="tipo_pagamento">Tipo Pagamento</label>
            <label name="tipo_pagamento"> <?php echo $tipo_pagamento; ?></label>
            <div>
            <select name="tipo_pagamento">
                   <option values="credito">Crédito</option>
                   <option values="boleto">Boleto</option>
                   <option values="transferencia">Transferência</option>
            </select>
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
        if(!isset($_GET['id'])){
               $nome = $_POST['nome'];
                $email = $_POST['email'];
                  $tipo_pagamento =$_POST['tipo_pagamento'] ;           
                   $sql = "UPDATE cliente set nome = '$nome', email = '$email',tipo_pagamento = '$tipo_pagamento' where id = '$id' ";
                    $db->query($sql);
               }
               
           volta();
         } 
    // Deleta usuario junto com o arquivo
    if(!empty($_POST['excluir'])){
          $sql = "DELETE FROM `cliente` WHERE id = '$id' ";
            $db->query($sql);
             volta();
    }
    function volta(){
        header('Location: listar.php');
    }
  
    close_database($db);
   
?>
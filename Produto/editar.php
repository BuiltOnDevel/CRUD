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
                $sql = "SELECT `nome`, `valor`, `descricao`, `nome_foto` FROM `produto` WHERE id = '$id'";
                 $resultado = $db->query($sql);
    
               /* Essa maneira de lista os dados, usa o metodo "statements", mas no caso eu estou usando os
               dois tipos de métodos, mas o statements é mais seguro contra SQL injection
               é só descomentar o código, que ele irá mostra o nome do cliente em um echo!*/
              /* $stmt = $db->prepare("SELECT `nome` FROM `produto` WHERE id = ?");   
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
                      $valor = $dados['valor'];
                       $desc = $dados['descricao'];
                        $foto = $dados['nome_foto'];
                }
        ?>
<body>
    <form action="" method="post" enctype="multipart/form-data">
        <div>
            <label for="nome">Nome</label>
            <input type="text" name="nome" value="<?php echo $nome; ?>" />
        </div>
        <div>
            <label for="valor">Valor</label>
            <input type="text" name="valor" value="<?php echo $valor; ?>" />
        </div>
        <div>
            <label for="descricao">Descrição</label>
            <input type="text" name="descricao" value="<?php echo $desc; ?>" />
        </div>
        <div>
             <label for="foto">Foto</label>
              <a href="uploads/<?php echo $foto; ?>" target="_blank"> Abrir </a>
            <div>
                <input type="file" name="foto" value="" />
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
                $valor = $_POST['valor'];
                 $desc = $_POST['descricao'];           
                  $sql = "UPDATE produto set nome = '$nome', valor = '$valor',descricao = '$desc' where id = '$id' ";
                   $db->query($sql);
               // verifica se há um arquivo, caso contrário ele mantem o arquivo original         
               if(!empty($_FILES['foto']['size'] > 1)){
                   //metodo para deletar o arquivo da pasta
                   deletar_arquivo($foto);
                    $nome_foto = $_FILES['foto']['name'];
                     $extensao = strstr(strtolower($nome_foto), ".");
                      $re_nome = md5(time()).$extensao;
                        move_uploaded_file($_FILES['foto']['tmp_name'],"uploads/".$re_nome);
                         $sql = "UPDATE produto set nome_foto = '$re_nome' where id = '$id' ";
                          $db->query($sql);
                           // volta para página listar
                           volta();
               }
               
           volta();
         }
    } 
    // Deleta usuario junto com o arquivo
    if(!empty($_POST['excluir'])){
        deletar_arquivo($foto);
          $sql = "DELETE FROM `produto` WHERE id = '$id' ";
            $db->query($sql);
             volta();
    }
    // Função para deletar um arquivo usando unlink
    function deletar_arquivo($nome_foto){
        unlink("uploads/".$nome_foto);
    }
    function volta(){
        header('Location: listar.php');
    }
  
    close_database($db);
   
?>
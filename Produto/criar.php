<?php require_once 'config.php';
      require_once DBAPI; 

if(!empty($_POST['enviar_prod'])){
    $nome = $_POST['nome'];
      $valor = $_POST['valor'];
       $descricao = $_POST['desc'];
        $nome_foto = $_FILES['foto']['name'];
    
//Verifica que o post não esteja vazio e seja maior que 8MB
if(($_FILES['foto']['size'] > 8387608) || !isset($_FILES['foto'])){
    echo "Arquivo muito grande ou inválido";
     exit;
}
        //pega a extensão e renomeia o arquivo para que não tenha arquivos do mesmo nome.
        $extensao = strstr(strtolower($nome_foto), ".");
          $re_nome = md5(time()).$extensao;
           move_uploaded_file($_FILES['foto']['tmp_name'],"uploads/".$re_nome);
        //Salvando as informações no banco
        $db = open_database();
          $sql = "INSERT INTO `produto`(`nome`, `valor`, `descricao`, `nome_foto`) VALUES ('$nome','$valor','$descricao','$re_nome')";
           $db->query($sql);
        // Fecahndo a conexão com o banco.
        close_database($db);
    echo "Registros criado! ";
} 
else
    echo "Alguma coisa deu errado! ";
        
<?php require_once 'config.php';
      require_once DBAPI; 
?>

<!DOCTYPE html>
<html lang="UTF-8">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="">
</head>

<body>
    <form action="criar.php" method="post" enctype="multipart/form-data">
    <div class="">
        <div>
            <label>Nome do produto</label>
            <input type="text" name="nome">
        </div>
        <div>
            <label>Valor do produto</label>
            <input type="text" name="valor">
        </div>
        <div>
            <label>Descrição do produto</label>
            <input type="text" name="desc">
        </div>
        <div>
            <label>Foto</label>
            <input type="file" required name="foto">
        </div>
        <div>
            <input type="submit" name="enviar_prod" value="Enviar"/>
        </div>
        <div>   
            <button type="reset" value="resetar" >Limpa Campo</button>
        </div>
    </div>
    </form>
    
    <div>
        <table border="1" width="100%">
        <tr>
            <th>Código</th>
            <th>Nome</th>
            <th>valor</th>
            <th>Descrição</th>
            <th>Arquivo</th>
            <th>Ação</th>
        </tr>
            
            <?php
            // Faz um select para popula a tabela com as informações do banco de dados.
             $db=open_database();
               $sql="select * from produto";
                 $resultado = $db->query($sql);
            // Guarda a consulta em um array Resultado
            if($resultado ->num_rows > 0)
                $resultado  = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>
            
            <?php foreach($resultado as $dado) : ?>
            <tr>
                <td><?php echo $dado['id']; ?> </td>
                <td><?php echo $dado['nome']; ?> </td>
                <td><?php echo $dado['valor']; ?> </td>
                <td><?php echo $dado['descricao']; ?> </td>
                <td> <a href="uploads/<?php echo $dado['nome_foto']; ?>" target="_blank"> Abrir </a></td> 
                <td><a href='editar.php?codigo=<?php echo $dado['id']; ?>'>Editar</a>
            </tr>

            <?php endforeach; ?>
            <?php close_database($db);?>

         </table>
    </div>
    <script src=""></script>
</body>
</html>


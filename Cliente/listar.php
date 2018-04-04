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
            <label>Nome do cliente</label>
            <input type="text" name="nome">
        </div>
        <div>
            <label>Email do cliente</label>
            <input type="text" name="email">
        </div>
            <div>
            <label for="tipo_pagamento">Tipo Pagamento</label>
            <select name="tipo_pagamento">
                   <option values="credito">Crédito</option>
                   <option values="boleto">Boleto</option>
                   <option values="transferencia">Transferência</option>
            </select>
            </div>
        <div>
            <input type="submit" name="enviar_reg" value="Registrar"/>
        </div>
        <div>   
            <button type="reset" value="resetar" >Limpar Campos</button>
        </div>
    </div>
    </form>
    
    <div>
        <table border="1" width="100%">
        <tr>
            <th>Código</th>
            <th>Nome cliente</th>
            <th>Email</th>
            <th>Data de cadastro</th>
            <th>Tipo de pagamento</th>
            <th>Ação</th>
        </tr>
            
            <?php
            // Faz um select para popula a tabela com as informações do banco de dados.
             $db=open_database();
               $sql="select * from cliente";
                 $resultado = $db->query($sql);
            // Guarda a consulta em um array Resultado
            if($resultado ->num_rows > 0)
                $resultado  = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>
            
            <?php foreach($resultado as $dado) : ?>
            <tr>
                <td><?php echo $dado['id']; ?> </td>
                <td><?php echo $dado['nome']; ?> </td>
                <td><?php echo $dado['email']; ?> </td>
                <td><?php echo $dado['data_cadastro']; ?> </td>
                <td><?php echo $dado['tipo_pagamento']; ?> </td> 
                <td><a href='editar.php?codigo=<?php echo $dado['id']; ?>'>Editar</a>
            </tr>

            <?php endforeach; ?>
            <?php close_database($db);?>

         </table>
    </div>
    <script src=""></script>
</body>
</html>


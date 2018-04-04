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
            <label>ID do cliente</label>
            <input type="text" name="id_cliente">
        </div>
        <div>
            <label>ID do produto</label>
            <input type="text" name="id_produto">
        </div>
            <div>
				<label> Quantidade</label>
				<input type="number" name="quantidade" min="0">
		    </div>
        <div>
	    <div>
            <label>Valor</label>
            <input type="text" name="valor">
        </div>
            <input type="submit" name="enviar_ped" value="Registrar"/>
        </div>
        <div>   
            <button type="reset" value="resetar" >Limpar Campos</button>
        </div>
    </div>
    </form>
    
    <div>
        <table border="1" width="100%">
        <tr>
            <th>ID do Cliente</th>
            <th>ID do Pedido</th>
            <th>Quantidade</th>
			<th>Valor</th>
            <th>Ação</th>
        </tr>
            
            <?php
            // Faz um select para popula a tabela com as informações do banco de dados.
             $db=open_database();
               $sql="select * from pedido";
                 $resultado = $db->query($sql);
            // Guarda a consulta em um array Resultado
            if($resultado ->num_rows > 0)
                $resultado  = $resultado->fetch_all(MYSQLI_ASSOC);
            ?>
            
            <?php foreach($resultado as $dado) : ?>
            <tr>
                <td><?php echo $dado['id_cliente']; ?> </td>
                <td><?php echo $dado['id_produto']; ?> </td>
                <td><?php echo $dado['quantidade']; ?> </td>
				<td><?php echo $dado['valor_total']; ?> </td>
                <td><a href='editar.php?codigo=<?php echo $dado['id_cliente']; ?>'>Editar</a>
            </tr>

            <?php endforeach; ?>
            <?php close_database($db);?>

         </table>
    </div>
    <script src=""></script>
</body>
</html>


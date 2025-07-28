<?php
include ('conexao.php');

$sql = "SELECT * FROM viagens";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Agencia de Viagens</title>
</head>
<body>

<h2>Lista de Viagens</h2>
<table>
    <tr>
        <th>ID</th>
        <th>Destino</th>
        <th>Pacote</th>
        <th>Duração</th>
        <th>Vagas</th>
    </tr>
    <?php while($row = $result->fetch_assoc()) :?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['destino']; ?></td>
        <td><?php echo $row['codigo_pacote']; ?></td>
        <td><?php echo $row['duracao_dias']; ?></td>
        <td><?php echo $row['quantidade_vagas']; ?></td>
        <td>
            <a class="btn btn-consult" href="consultar.php?id=<?php echo $row['id']; ?>">Consultar</a>
         
            <a class="btn btn-edit" href="editar.php?id=<?php echo $row['id']; ?>">Editar</a>
   
            <a class="btn btn-delete" href="excluir.php?id=<?php echo $row['id']; ?>" onclick="return confirm('Deseja excluir este produto?');">Excluir</a>
        </td>
    </tr>
    
    <?php endwhile; ?>

</table>

<h2>Cadastrar Produto</h2>
<form action="cadastrar.php" method="post">
    <input type="text" name="destino" placeholder="Destino" required>
    <input type="text" name="codigo_pacote" placeholder="Pacote" required>
    <input type="number"name="duracao_dias" placeholder="Dias" required>
    <input type="number" name="quantidade_vagas" placeholder="Vagas" required>
    <button type="submit">Cadastrar</button>
</form>

</body>
</html>

<?php $conn->close(); ?>

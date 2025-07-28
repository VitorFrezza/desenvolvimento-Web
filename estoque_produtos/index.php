<?php
include ('conexao.php');

$sql = "SELECT * FROM produtos";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Controle de Estoque</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>

<h2>Lista de Produtos</h2>
<table>
    <tr>
        <th>Nome</th>
        <th>Quantidade</th>
        <th>Valor</th>
        <th>Categoria</th>
        <th>Opções</th>
    </tr>
    <?php while($row = $result->fetch_assoc()): ?>
    <tr>
        <td><?php echo $row['nome']; ?></td>
        <td><?php echo $row['quantidade']; ?></td>
        <td>R$ <?php echo number_format($row['valor'], 2, ',', '.'); ?></td>
        <td><?php echo $row['categoria']; ?></td>
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
    <input type="text" name="nome" placeholder="Nome" required>
    <input type="number" name="quantidade" placeholder="Quantidade" required>
    <input type="number" step="0.01" name="valor" placeholder="Valor" required>
    <input type="text" name="categoria" placeholder="Categoria" required>
    <button type="submit">Cadastrar</button>
</form>

</body>
</html>

<?php $conn->close(); ?>

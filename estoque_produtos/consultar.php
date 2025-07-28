<?php
include ('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc();

    if ($produto):
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalhes do Produto</title>
</head>
<body>
    <h2>Detalhes do Produto</h2>
    <p><strong>Nome:</strong> <?php echo $produto['nome']; ?></p>
    <p><strong>Quantidade:</strong> <?php echo $produto['quantidade']; ?></p>
    <p><strong>Valor:</strong> R$ <?php echo number_format($produto['valor'], 2, ',', '.'); ?></p>
    <p><strong>Categoria:</strong> <?php echo $produto['categoria']; ?></p>
    <a href="index.php">Voltar</a>
</body>
</html>
<?php
    else:
        echo "Produto não encontrado.<br><a href='index.php'>Voltar</a>";
    endif;
    $stmt->close();
}
$conn->close();
?>

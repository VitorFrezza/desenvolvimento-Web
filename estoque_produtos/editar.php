<?php
include 'conexao.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM produtos WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $produto = $resultado->fetch_assoc();

    if (!$produto) {
        echo "Produto não encontrado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];

    $stmt = $conn->prepare("UPDATE produtos SET nome = ?, quantidade = ?, valor = ?, categoria = ? WHERE id = ?");
    $stmt->bind_param("sidsi", $nome, $quantidade, $valor, $categoria, $id);

    if ($stmt->execute()) {
        header("Location: index.php");
        exit;
    } else {
        echo "Erro ao atualizar: " . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar Produto</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<h2>Editar Produto</h2>
<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $produto['id']; ?>">
    <input type="text" name="nome" value="<?php echo $produto['nome']; ?>" required>
    <input type="number" name="quantidade" value="<?php echo $produto['quantidade']; ?>" required>
    <input type="number" step="0.01" name="valor" value="<?php echo $produto['valor']; ?>" required>
    <input type="text" name="categoria" value="<?php echo $produto['categoria']; ?>" required>
    <button type="submit">Salvar Alterações</button>
</form>
<a href="index.php">Cancelar</a>
</body>
</html>

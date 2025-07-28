<?php
include ('conexao.php');

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM viagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $viagem = $resultado->fetch_assoc();

    if (!$viagem) {
        echo "Produto não encontrado.";
        exit;
    }
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $destino = $_POST['destino'] ?? "";
    $pacote = $_POST['codigo_pacote'] ?? "";
    $dias = $_POST['duracao_dias'] ?? 0;
    $vagas = $_POST['quantidade_vagas'] ?? 0;

    $stmt = $conn->prepare("UPDATE viagens SET destino = ?, codigo_pacote = ?, duracao_dias = ?, quantidade_vagas = ? WHERE id = ?");
    $stmt->bind_param("ssiii", $destino, $pacote, $dias, $vagas, $id);

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
    <title>Editar Viagem</title>
</head>
<body>
<h2>Editar Viagem</h2>
<form method="post" action="editar.php">
    <input type="hidden" name="id" value="<?php echo $viagem['id']; ?>">
    <input type="text" name="destino" value="<?php echo $viagem['destino']; ?>" required>
    <input type="text" name="codigo_pacote" value="<?php echo $viagem['codigo_pacote']; ?>" required>
    <input type="number" name="duracao_dias" value="<?php echo $viagem['duracao_dias']; ?>" required>
    <input type="number" name="quantidade_vagas" value="<?php echo $viagem['quantidade_vagas']; ?>" required>
    <button type="submit">Salvar Alterações</button>
</form>
<a href="index.php">Cancelar</a>
</body>
</html>

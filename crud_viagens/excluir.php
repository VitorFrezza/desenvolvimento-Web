<?php
include ('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("DELETE FROM viagens WHERE id = ?");
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        echo "Produto excluído com sucesso!";
    } else {
        echo "Erro ao excluir: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<a href="index.php">Voltar</a>

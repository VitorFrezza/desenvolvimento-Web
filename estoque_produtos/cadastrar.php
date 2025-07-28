<?php
include ('conexao.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $quantidade = $_POST['quantidade'];
    $valor = $_POST['valor'];
    $categoria = $_POST['categoria'];

    $sql = "INSERT INTO produtos (nome, quantidade, valor, categoria) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sids", $nome, $quantidade, $valor, $categoria);

    if ($stmt->execute()) {
        echo "Produto cadastrado com sucesso!";
    } else {
        echo "Erro: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
?>

<a href="index.php">Voltar</a>

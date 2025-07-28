<?php
include ('conexao.php');

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $stmt = $conn->prepare("SELECT * FROM viagens WHERE id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $viagem = $resultado->fetch_assoc();

    if ($viagem):
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Detalhes da Viagem</title>
</head>
<body>
    <h2>Detalhes da Viagem</h2>
    <p><strong>Destino:</strong> <?php echo $viagem['destino']; ?></p>
    <p><strong>Pacote:</strong> <?php echo $viagem['codigo_pacote']; ?></p>
    <p><strong>Dias:</strong>   <?php echo $viagem['duracao_dias']; ?></p>
    <p><strong>Vagas:</strong>  <?php echo $viagem['quantidade_vagas']; ?></p>
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

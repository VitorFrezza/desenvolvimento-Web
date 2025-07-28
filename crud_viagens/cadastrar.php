<?php include("conexao.php"); 

if($_SERVER["REQUEST_METHOD"] == "POST") {
    $destino = $_POST['destino'];
    $pacote = $_POST['codigo_pacote'];
    $dias = $_POST['duracao_dias'];
    $vagas = $_POST['quantidade_vagas'];

    $stmt = $conn->prepare("INSERT INTO viagens (destino, codigo_pacote, duracao_dias, quantidade_vagas) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("ssii", $destino, $pacote, $dias,$vagas);

    $stmt->execute();

    header("Location: index.php");
}

?>


    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cadastrar</title>
    </head>
    <body>
        <h2>INSERIR VIAGEM</h2>
        <form method="POST" action="">
            <label for="destino">Destino:</label>
            <input type="text" id="destino" name="destino" required>
            <br>
            <label for="pacote">Pacote:</label>
            <input type="text" id="pacote" name="pacote" required>
            <br>
            <label for="dias">Dias :</label>
            <input type="number" id="dias" name="dias" required>
            <br>
            <label for="vagas">Vagas:</label>
            <input type="number" id="vagas" name="vagas" required>
            <br>
            <button type="submit">Cadastrar</button>
            <a href="index.php">Voltar</a>
    </body>
    </html>

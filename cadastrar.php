<?php
include 'db.php';

$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nome = trim($_POST['nome']);
    $tipo = $_POST['tipo'];
    $localizacao = $_POST['localizacao'];
    $data_registro = $_POST['data_registro'];
    $hp = intval($_POST['hp']);
    $ataque = intval($_POST['ataque']);
    $defesa = intval($_POST['defesa']);
    $observacoes = $_POST['observacoes'];
    $foto = $_POST['foto'];

    if (!$nome) {
        $msg = "O nome é pokemon";
    } else {
        $stmt = $conn->prepare("INSERT INTO pokemons (nome, tipo, localizacao, data_registro, hp, ataque, defesa, observacoes, foto) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("ssssiiiss", $nome, $tipo, $localizacao, $data_registro, $hp, $ataque, $defesa, $observacoes, $foto);
        $stmt->execute();
        $msg = "Pokemon cadastrado!";
    }
}
?>
<!DOCTYPE html>
<html>
<head><title>Cadastrar Pokémon</title></head>
<body>
    <h1>Cadastrar Pokémon Perdido</h1>
    <?php if ($msg) echo "<p>$msg</p>"; ?>
    <form method="post">
        Nome: <input type="text" name="nome" required><br>
        Tipo: <input type="text" name="tipo" required><br>
        Localização: <input type="text" name="localizacao"><br>
        Data do registro: <input type="date" name="data_registro"><br>
        HP: <input type="number" name="hp"><br>
        Ataque: <input type="number" name="ataque"><br>
        Defesa: <input type="number" name="defesa"><br>
        Observações: <textarea name="observacoes"></textarea><br>
        Foto (URL): <input type="text" name="foto"><br>
        <button type="submit">Cadastrar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>

<?php
include 'db.php';

$id = intval($_GET['id']);
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
        $msg = "Nome é obrigatório!";
    } else {
        $stmt = $conn->prepare("UPDATE pokemons SET nome=?, tipo=?, localizacao=?, data_registro=?, hp=?, ataque=?, defesa=?, observacoes=?, foto=? WHERE id=?");
        $stmt->bind_param("ssssiiissi", $nome, $tipo, $localizacao, $data_registro, $hp, $ataque, $defesa, $observacoes, $foto, $id);
        $stmt->execute();
        $msg = "Pokémon atualizado!";
    }
}

$stmt = $conn->prepare("SELECT * FROM pokemons WHERE id=?");
$stmt->bind_param("i", $id);
$stmt->execute();
$pokemon = $stmt->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head><title>Editar Pokémon</title></head>
<body>
    <h1>Editar Pokémon</h1>
    <?php if ($msg) echo "<p>$msg</p>"; ?>
    <form method="post">
        Nome: <input type="text" name="nome" value="<?= htmlspecialchars($pokemon['nome']) ?>" required><br>
        Tipo: <input type="text" name="tipo" value="<?= htmlspecialchars($pokemon['tipo']) ?>" required><br>
        Localização: <input type="text" name="localizacao" value="<?= htmlspecialchars($pokemon['localizacao']) ?>"><br>
        Data do registro: <input type="date" name="data_registro" value="<?= $pokemon['data_registro'] ?>"><br>
        HP: <input type="number" name="hp" value="<?= $pokemon['hp'] ?>"><br>
        Ataque: <input type="number" name="ataque" value="<?= $pokemon['ataque'] ?>"><br>
        Defesa: <input type="number" name="defesa" value="<?= $pokemon['defesa'] ?>"><br>
        Observações: <textarea name="observacoes"><?= htmlspecialchars($pokemon['observacoes']) ?></textarea><br>
        Foto (URL): <input type="text" name="foto" value="<?= htmlspecialchars($pokemon['foto']) ?>"><br>
        <button type="submit">Salvar</button>
    </form>
    <a href="index.php">Voltar</a>
</body>
</html>

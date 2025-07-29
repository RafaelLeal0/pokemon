<?php
// Gustavo Martins e Rafael Leal
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
<head>
    <title>Editar Pokémon</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #e3f2fd 0%, #f3f7fa 100%);
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 420px;
            margin: 48px auto;
            padding: 36px 44px 28px 44px;
            border-radius: 18px;
            box-shadow: 0 8px 32px rgba(45,114,217,0.10), 0 1.5px 8px rgba(45,114,217,0.08);
            position: relative;
        }
        .header-icon {
            display: flex;
            justify-content: center;
            align-items: center;
            margin-bottom: 10px;
        }
        .header-icon img {
            width: 48px;
            height: 48px;
        }
        h1 {
            text-align: center;
            color: #111; 
            margin-bottom: 28px;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        form label {
            display: block;
            margin-bottom: 6px;
            color: #1565c0;
            font-weight: 500;
            font-size: 15px;
        }
        form input[type="text"],
        form input[type="number"],
        form input[type="date"],
        form textarea {
            width: 100%;
            padding: 10px;
            margin-bottom: 18px;
            border: 1.5px solid #cfd8dc;
            border-radius: 7px;
            box-sizing: border-box;
            font-size: 16px;
            transition: border-color 0.2s;
            background: #f7fbff;
        }
        form input:focus,
        form textarea:focus {
            border-color: #2d72d9;
            outline: none;
            background: #e3f2fd;
        }
        form textarea {
            resize: vertical;
            min-height: 70px;
        }
        button {
            background: linear-gradient(90deg,#2d72d9 60%,#1565c0 100%);
            color: #fff;
            border: none;
            padding: 12px 0;
            width: 100%;
            border-radius: 7px;
            font-size: 17px;
            font-weight: 500;
            cursor: pointer;
            margin-top: 12px;
            box-shadow: 0 2px 8px rgba(45,114,217,0.08);
            transition: background 0.2s, transform 0.15s;
        }
        button:hover {
            background: linear-gradient(90deg,#1565c0 60%,#2d72d9 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .msg {
            background: #e3f2fd;
            color: #1565c0;
            padding: 12px;
            border-radius: 7px;
            margin-bottom: 18px;
            text-align: center;
            font-size: 15px;
            box-shadow: 0 1px 4px rgba(45,114,217,0.07);
        }
        a {
            display: block;
            text-align: center;
            margin-top: 22px;
            color: #2d72d9;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
        }
        a:hover {
            color: #1565c0;
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-icon">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball">
        </div>
        <h1>Editar Pokémon</h1>
        <?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>
        <form method="post">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" value="<?= htmlspecialchars($pokemon['nome']) ?>" required>
            
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="Normal" <?= $pokemon['tipo']=='Normal'?'selected':'' ?>>Normal</option>
                <option value="Fogo" <?= $pokemon['tipo']=='Fogo'?'selected':'' ?>>Fogo</option>
                <option value="Água" <?= $pokemon['tipo']=='Água'?'selected':'' ?>>Água</option>
                <option value="Grama" <?= $pokemon['tipo']=='Grama'?'selected':'' ?>>Grama</option>
                <option value="Elétrico" <?= $pokemon['tipo']=='Elétrico'?'selected':'' ?>>Elétrico</option>
                <option value="Gelo" <?= $pokemon['tipo']=='Gelo'?'selected':'' ?>>Gelo</option>
                <option value="Lutador" <?= $pokemon['tipo']=='Lutador'?'selected':'' ?>>Lutador</option>
                <option value="Voador" <?= $pokemon['tipo']=='Voador'?'selected':'' ?>>Voador</option>
                <option value="Psíquico" <?= $pokemon['tipo']=='Psíquico'?'selected':'' ?>>Psíquico</option>
                <option value="Inseto" <?= $pokemon['tipo']=='Inseto'?'selected':'' ?>>Inseto</option>
                <option value="Pedra" <?= $pokemon['tipo']=='Pedra'?'selected':'' ?>>Pedra</option>
                <option value="Fantasma" <?= $pokemon['tipo']=='Fantasma'?'selected':'' ?>>Fantasma</option>
                <option value="Sombrio" <?= $pokemon['tipo']=='Sombrio'?'selected':'' ?>>Sombrio</option>
                <option value="Dragão" <?= $pokemon['tipo']=='Dragão'?'selected':'' ?>>Dragão</option>
                <option value="Aço" <?= $pokemon['tipo']=='Aço'?'selected':'' ?>>Aço</option>
                <option value="Fada" <?= $pokemon['tipo']=='Fada'?'selected':'' ?>>Fada</option>
            </select>
            
            <label for="localizacao">Localização:</label>
            <select name="localizacao" id="localizacao">
                <option value="">Selecione a localização</option>
                <option value="São Paulo" <?= $pokemon['localizacao']=='São Paulo'?'selected':'' ?>>São Paulo</option>
                <option value="Rio de Janeiro" <?= $pokemon['localizacao']=='Rio de Janeiro'?'selected':'' ?>>Rio de Janeiro</option>
                <option value="Belo Horizonte" <?= $pokemon['localizacao']=='Belo Horizonte'?'selected':'' ?>>Belo Horizonte</option>
                <option value="Porto Alegre" <?= $pokemon['localizacao']=='Porto Alegre'?'selected':'' ?>>Porto Alegre</option>
                <option value="Curitiba" <?= $pokemon['localizacao']=='Curitiba'?'selected':'' ?>>Curitiba</option>
                <option value="Brasília" <?= $pokemon['localizacao']=='Brasília'?'selected':'' ?>>Brasília</option>
                <option value="Salvador" <?= $pokemon['localizacao']=='Salvador'?'selected':'' ?>>Salvador</option>
                <option value="Fortaleza" <?= $pokemon['localizacao']=='Fortaleza'?'selected':'' ?>>Fortaleza</option>
                <option value="Manaus" <?= $pokemon['localizacao']=='Manaus'?'selected':'' ?>>Manaus</option>
                <option value="Recife" <?= $pokemon['localizacao']=='Recife'?'selected':'' ?>>Recife</option>
                <option value="Outra" <?= $pokemon['localizacao']=='Outra'?'selected':'' ?>>Outra</option>
            </select>
            
            <label for="data_registro">Data do registro:</label>
            <input type="date" name="data_registro" id="data_registro" value="<?= $pokemon['data_registro'] ?>">
            
            <label for="hp">HP:</label>
            <input type="number" name="hp" id="hp" value="<?= $pokemon['hp'] ?>">
            
            <label for="ataque">Ataque:</label>
            <input type="number" name="ataque" id="ataque" value="<?= $pokemon['ataque'] ?>">
            
            <label for="defesa">Defesa:</label>
            <input type="number" name="defesa" id="defesa" value="<?= $pokemon['defesa'] ?>">
            
            <label for="observacoes">Observações:</label>
            <textarea name="observacoes" id="observacoes"><?= htmlspecialchars($pokemon['observacoes']) ?></textarea>
            
            <label for="foto">Foto (URL):</label>
            <input type="text" name="foto" id="foto" value="<?= htmlspecialchars($pokemon['foto']) ?>">
            
            <button type="submit">Salvar</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>

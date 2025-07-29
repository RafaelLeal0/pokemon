<?php
// Gustavo Martins e Rafael Leal
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

    if (isset($_FILES['foto_arquivo']) && $_FILES['foto_arquivo']['error'] == UPLOAD_ERR_OK) {
        $ext = strtolower(pathinfo($_FILES['foto_arquivo']['name'], PATHINFO_EXTENSION));
        $permitidas = ['jpg','jpeg','png','gif'];
        if (in_array($ext, $permitidas)) {
            $destino = 'imagens/' . uniqid('poke_') . '.' . $ext;
            if (!is_dir('imagens')) mkdir('imagens');
            move_uploaded_file($_FILES['foto_arquivo']['tmp_name'], $destino);
            $foto = $destino;
        }
    }

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
<head>
    <title>Cadastrar Pokémon</title>
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
        <h1>Cadastrar Pokémon Perdido</h1>
        <?php if ($msg) echo "<div class='msg'>$msg</div>"; ?>
        <form method="post" enctype="multipart/form-data">
            <label for="nome">Nome:</label>
            <input type="text" name="nome" id="nome" required>
            
            <label for="tipo">Tipo:</label>
            <select name="tipo" id="tipo" required>
                <option value="">Selecione o tipo</option>
                <option value="Normal">Normal</option>
                <option value="Fogo">Fogo</option>
                <option value="Água">Água</option>
                <option value="Grama">Grama</option>
                <option value="Elétrico">Elétrico</option>
                <option value="Gelo">Gelo</option>
                <option value="Lutador">Lutador</option>
                <option value="Voador">Voador</option>
                <option value="Psíquico">Psíquico</option>
                <option value="Inseto">Inseto</option>
                <option value="Pedra">Pedra</option>
                <option value="Fantasma">Fantasma</option>
                <option value="Sombrio">Sombrio</option>
                <option value="Dragão">Dragão</option>
                <option value="Aço">Aço</option>
                <option value="Fada">Fada</option>
            </select>
            
            <label for="localizacao">Localização:</label>
            <select name="localizacao" id="localizacao">
                <option value="">Selecione a localização</option>
                <option value="São Paulo">São Paulo</option>
                <option value="Rio de Janeiro">Rio de Janeiro</option>
                <option value="Belo Horizonte">Belo Horizonte</option>
                <option value="Porto Alegre">Porto Alegre</option>
                <option value="Curitiba">Curitiba</option>
                <option value="Brasília">Brasília</option>
                <option value="Salvador">Salvador</option>
                <option value="Fortaleza">Fortaleza</option>
                <option value="Manaus">Manaus</option>
                <option value="Recife">Recife</option>
                <option value="Outra">Outra</option>
            </select>
            
            <label for="data_registro">Data do registro:</label>
            <input type="date" name="data_registro" id="data_registro">
            
            <label for="hp">HP:</label>
            <input type="number" name="hp" id="hp">
            
            <label for="ataque">Ataque:</label>
            <input type="number" name="ataque" id="ataque">
            
            <label for="defesa">Defesa:</label>
            <input type="number" name="defesa" id="defesa">
            
            <label for="observacoes">Observações:</label>
            <textarea name="observacoes" id="observacoes"></textarea>
            
            <label for="foto">Foto (URL):</label>
            <input type="text" name="foto" id="foto">
            
            <label for="foto_arquivo">Ou envie uma imagem:</label>
            <input type="file" name="foto_arquivo" id="foto_arquivo" accept="image/*">
            
            <button type="submit">Cadastrar</button>
        </form>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>
</body>
</html>

<?php
// Gustavo Martins e Rafael Leal
include 'db.php';

$search = isset($_GET['search']) ? $_GET['search'] : '';
$sql = "SELECT * FROM pokemons";
if ($search) {
    $search = $conn->real_escape_string($search);
    $sql .= " WHERE nome LIKE '%$search%'";
}
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pokémons Encontrados</title>
    <style>
        body {
            font-family: 'Segoe UI', Arial, sans-serif;
            background: linear-gradient(120deg, #e3f2fd 0%, #f3f7fa 100%);
            margin: 0;
            padding: 0;
        }
        .container {
            background: #fff;
            max-width: 950px;
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
        .top-links {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 22px;
        }
        form {
            display: flex;
            gap: 10px;
        }
        form input[type="text"] {
            padding: 10px;
            border: 1.5px solid #cfd8dc;
            border-radius: 7px;
            font-size: 16px;
            width: 220px;
            background: #f7fbff;
            transition: border-color 0.2s;
        }
        form input:focus {
            border-color: #2d72d9;
            outline: none;
            background: #e3f2fd;
        }
        form button {
            background: linear-gradient(90deg,#2d72d9 60%,#1565c0 100%);
            color: #fff;
            border: none;
            padding: 10px 22px;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 500;
            cursor: pointer;
            box-shadow: 0 2px 8px rgba(45,114,217,0.08);
            transition: background 0.2s, transform 0.15s;
        }
        form button:hover {
            background: linear-gradient(90deg,#1565c0 60%,#2d72d9 100%);
            transform: translateY(-2px) scale(1.03);
        }
        .top-links a {
            background: linear-gradient(90deg,#2d72d9 60%,#1565c0 100%);
            color: #fff;
            padding: 10px 22px;
            border-radius: 7px;
            font-size: 16px;
            font-weight: 500;
            text-decoration: none;
            box-shadow: 0 2px 8px rgba(45,114,217,0.08);
            transition: background 0.2s, transform 0.15s;
        }
        .top-links a:hover {
            background: linear-gradient(90deg,#1565c0 60%,#2d72d9 100%);
            transform: translateY(-2px) scale(1.03);
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 22px;
        }
        th, td {
            padding: 12px 8px;
            border-bottom: 1px solid #e0e0e0;
            text-align: center;
        }
        th {
            background: #e3f2fd;
            color: #1565c0;
            font-size: 15px;
        }
        tr:nth-child(even) {
            background: #f7fbff;
        }
        tr:hover {
            background: #e3f2fd;
        }
        img {
            border-radius: 5px;
            box-shadow: 0 1px 4px rgba(45,114,217,0.07);
        }
        .actions a {
            color: #2d72d9;
            text-decoration: none;
            margin: 0 5px;
            font-weight: 500;
            transition: color 0.2s;
        }
        .actions a:hover {
            color: #1565c0;
            text-decoration: underline;
        }
        .estatisticas-link {
            display: block;
            text-align: right;
            margin-top: 10px;
            color: #2d72d9;
            text-decoration: none;
            font-weight: 500;
            font-size: 15px;
            transition: color 0.2s;
        }
        .estatisticas-link:hover {
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
        <h1>Pokémons Encontrados</h1>
        <div class="top-links">
            <form method="get">
                <input type="text" name="search" placeholder="Pesquisar por nome" value="<?= htmlspecialchars($search) ?>">
                <button type="submit">Pesquisar</button>
            </form>
            <a href="cadastrar.php">Cadastrar Novo Pokémon</a>
        </div>
        <table>
            <tr>
                <th>Nome</th><th>Tipo</th><th>Localização</th><th>HP</th><th>Ataque</th><th>Defesa</th><th>Foto</th><th>Ações</th>
            </tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['nome']) ?></td>
                <td><?= htmlspecialchars($row['tipo']) ?></td>
                <td><?= htmlspecialchars($row['localizacao']) ?></td>
                <td><?= $row['hp'] ?></td>
                <td><?= $row['ataque'] ?></td>
                <td><?= $row['defesa'] ?></td>
                <td>
                    <?php if ($row['foto']): ?>
                        <img src="<?= htmlspecialchars($row['foto']) ?>" width="50">
                    <?php endif; ?>
                </td>
                <td class="actions">
                    <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                    <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a class="estatisticas-link" href="estatisticas.php">Ver Estatísticas</a>
    </div>
</body>
</html>

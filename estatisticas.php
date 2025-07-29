<?php
include 'db.php';
$sql = "SELECT tipo, COUNT(*) as total FROM pokemons GROUP BY tipo";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Estatísticas</title>
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
        h1 {
            text-align: center;
            color: #111;
            margin-bottom: 28px;
            font-size: 2rem;
            letter-spacing: 1px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 18px;
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
        .header-icon {
            text-align: center;
            margin-bottom: 24px;
        }
        .header-icon img {
            width: 60px;
            height: 60px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header-icon">
            <img src="https://raw.githubusercontent.com/PokeAPI/sprites/master/sprites/items/poke-ball.png" alt="Pokeball">
        </div>
        <h1>Estatísticas por Tipo</h1>
        <table>
            <tr><th>Tipo</th><th>Quantidade</th></tr>
            <?php while($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['tipo']) ?></td>
                <td><?= $row['total'] ?></td>
            </tr>
            <?php endwhile; ?>
        </table>
        <a href="index.php">Voltar</a>
    </div>
</body>
</html>

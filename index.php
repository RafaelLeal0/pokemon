<?php
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
        /* ...estilos simples para tabela e formulário... */
    </style>
</head>
<body>
    <h1>Pokémons Encontrados</h1>
    <form method="get">
        <input type="text" name="search" placeholder="Pesquisar por nome" value="<?= htmlspecialchars($search) ?>">
        <button type="submit">Pesquisar</button>
    </form>
    <a href="cadastrar.php">Cadastrar Novo Pokémon</a>
    <table border="1">
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
            <td>
                <a href="editar.php?id=<?= $row['id'] ?>">Editar</a> |
                <a href="excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Excluir?')">Excluir</a>
            </td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="estatisticas.php">Ver Estatísticas</a>
</body>
</html>

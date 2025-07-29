<?php
include 'db.php';
$sql = "SELECT tipo, COUNT(*) as total FROM pokemons GROUP BY tipo";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html>
<head><title>Estatísticas</title></head>
<body>
    <h1>Estatísticas por Tipo</h1>
    <table border="1">
        <tr><th>Tipo</th><th>Quantidade</th></tr>
        <?php while($row = $result->fetch_assoc()): ?>
        <tr>
            <td><?= htmlspecialchars($row['tipo']) ?></td>
            <td><?= $row['total'] ?></td>
        </tr>
        <?php endwhile; ?>
    </table>
    <a href="index.php">Voltar</a>
</body>
</html>

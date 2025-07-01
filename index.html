<?php
include 'db/conexao.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>🧁 Confeitaria - Produtos</title>
  <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
  <div class="container">
    <h1>🧁 Catálogo de Produtos</h1>
    <p><a href="produtos/cadastrar.php">+ Novo Produto</a></p>

    <form method="GET">
      <input type="text" name="busca" placeholder="Buscar produto, código ou categoria..." value="<?= isset($_GET['busca']) ? htmlspecialchars($_GET['busca']) : '' ?>">
      <input type="submit" value="Buscar">
    </form>

    <table>
      <tr>
        <th>Produto</th>
        <th>Categoria</th>
        <th>Código</th>
        <th>Preço (R$)</th>
        <th>Estoque</th>
        <th>Status</th>
        <th>Ações</th>
      </tr>

      <?php
      $busca = isset($_GET['busca']) ? $conn->real_escape_string($_GET['busca']) : '';
      $sql = "SELECT * FROM produtos WHERE nome LIKE '%$busca%' OR codigo LIKE '%$busca%' OR categoria LIKE '%$busca%' ORDER BY nome";
      $res = $conn->query($sql);

      if ($res->num_rows > 0):
        while ($row = $res->fetch_assoc()):
          $status = '';
          if ($row['quantidade_estoque'] == 0) {
            $status = '<span class="status none">Sem Estoque</span>';
          } elseif ($row['quantidade_estoque'] <= 5) {
            $status = '<span class="status low">Estoque Baixo</span>';
          } else {
            $status = '<span class="status ok">Em Estoque</span>';
          }
      ?>
        <tr>
          <td><?= htmlspecialchars($row['nome']) ?></td>
          <td><?= htmlspecialchars($row['categoria']) ?></td>
          <td><?= htmlspecialchars($row['codigo']) ?></td>
          <td><?= number_format($row['preco'], 2, ',', '.') ?></td>
          <td><?= $row['quantidade_estoque'] ?> un.</td>
          <td><?= $status ?></td>
          <td>
            <a href="produtos/ver.php?id=<?= $row['id'] ?>">Ver</a> |
            <a href="produtos/editar.php?id=<?= $row['id'] ?>">Editar</a> |
            <a href="produtos/excluir.php?id=<?= $row['id'] ?>" onclick="return confirm('Deseja excluir este produto?')">Excluir</a>
          </td>
        </tr>
      <?php endwhile; else: ?>
        <tr><td colspan="7">Nenhum produto encontrado.</td></tr>
      <?php endif; ?>
    </table>
  </div>
</body>
</html>

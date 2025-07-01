<?php
include '../db/conexao.php';

$id = $_GET['id'] ?? '';

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();
$produto = $res->fetch_assoc();

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

function formatarData($data) {
    return date('d/m/Y H:i', strtotime($data));
}

function statusEstoque($qtd) {
    if ($qtd == 0) return '<span class="status none">Sem Estoque</span>';
    if ($qtd <= 5) return '<span class="status low">Estoque Baixo</span>';
    return '<span class="status ok">Em Estoque</span>';
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Detalhes do Produto</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
  <h1>📦 Detalhes do Produto</h1>
  <p><a href="../index.php">← Voltar ao Catálogo</a></p>

  <h2><?= htmlspecialchars($produto['nome']) ?></h2>
  <p><strong>Código:</strong> <?= $produto['codigo'] ?></p>
  <p><strong>Categoria:</strong> <?= $produto['categoria'] ?></p>
  <p><strong>Preço:</strong> R$ <?= number_format($produto['preco'], 2, ',', '.') ?></p>
  <p><strong>Estoque:</strong> <?= $produto['quantidade_estoque'] ?> unidades</p>
  <p><strong>Status:</strong> <?= statusEstoque($produto['quantidade_estoque']) ?></p>
  <p><strong>Criado em:</strong> <?= formatarData($produto['created_at']) ?></p>
  <p><strong>Atualizado em:</strong> <?= formatarData($produto['updated_at']) ?></p>
</div>
</body>
</html>

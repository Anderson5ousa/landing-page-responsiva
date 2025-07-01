<?php
include '../db/conexao.php';

$id = $_GET['id'] ?? '';
$erro = '';

if (empty($id)) {
    header("Location: ../index.php");
    exit;
}

$sql = "SELECT * FROM produtos WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();
$produto = $result->fetch_assoc();

if (!$produto) {
    echo "Produto não encontrado.";
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $codigo = strtoupper(trim($_POST['codigo']));
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['quantidade_estoque']);
    $categoria = trim($_POST['categoria']);

    if (empty($nome) || empty($codigo)) {
        $erro = "Nome e Código são obrigatórios.";
    } else {
        $sql_check = "SELECT id FROM produtos WHERE codigo = ? AND id != ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("si", $codigo, $id);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $erro = "Já existe outro produto com este código!";
        } else {
            $sql = "UPDATE produtos SET nome = ?, codigo = ?, preco = ?, quantidade_estoque = ?, categoria = ? WHERE id = ?";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdisi", $nome, $codigo, $preco, $estoque, $categoria, $id);
            if ($stmt->execute()) {
                header("Location: ../index.php");
                exit;
            } else {
                $erro = "Erro ao atualizar produto.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Editar Produto</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
  <h1>✏️ Editar Produto</h1>
  <p><a href="../index.php">← Voltar ao Catálogo</a></p>

  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= $erro ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="nome">Nome *</label>
    <input type="text" name="nome" value="<?= htmlspecialchars($produto['nome']) ?>" required>

    <label for="categoria">Categoria</label>
    <input type="text" name="categoria" value="<?= htmlspecialchars($produto['categoria']) ?>">

    <label for="codigo">Código *</label>
    <input type="text" name="codigo" value="<?= htmlspecialchars($produto['codigo']) ?>" required>

    <label for="preco">Preço (R$) *</label>
    <input type="number" step="0.01" name="preco" value="<?= $produto['preco'] ?>" required>

    <label for="quantidade_estoque">Quantidade em Estoque *</label>
    <input type="number" name="quantidade_estoque" value="<?= $produto['quantidade_estoque'] ?>" required>

    <br><br>
    <input type="submit" value="Salvar Alterações">
  </form>
</div>
</body>
</html>

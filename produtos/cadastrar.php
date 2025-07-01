<?php
include '../db/conexao.php';

$erro = '';
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = trim($_POST['nome']);
    $codigo = strtoupper(trim($_POST['codigo']));
    $preco = floatval($_POST['preco']);
    $estoque = intval($_POST['quantidade_estoque']);
    $categoria = trim($_POST['categoria']);

    if (empty($nome) || empty($codigo)) {
        $erro = "Nome e Código são obrigatórios.";
    } else {
        $sql_check = "SELECT id FROM produtos WHERE codigo = ?";
        $stmt_check = $conn->prepare($sql_check);
        $stmt_check->bind_param("s", $codigo);
        $stmt_check->execute();
        $stmt_check->store_result();

        if ($stmt_check->num_rows > 0) {
            $erro = "Já existe um produto com este código!";
        } else {
            $sql = "INSERT INTO produtos (nome, codigo, preco, quantidade_estoque, categoria) VALUES (?, ?, ?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("ssdis", $nome, $codigo, $preco, $estoque, $categoria);
            if ($stmt->execute()) {
                header("Location: ../index.php");
                exit;
            } else {
                $erro = "Erro ao cadastrar produto.";
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <title>Cadastrar Produto</title>
  <link rel="stylesheet" href="../css/estilo.css">
</head>
<body>
<div class="container">
  <h1>🧁 Novo Produto</h1>
  <p><a href="../index.php">← Voltar ao Catálogo</a></p>

  <?php if (!empty($erro)): ?>
    <p style="color:red;"><?= $erro ?></p>
  <?php endif; ?>

  <form method="POST">
    <label for="nome">Nome *</label>
    <input type="text" name="nome" required>

    <label for="categoria">Categoria</label>
    <input type="text" name="categoria">

    <label for="codigo">Código *</label>
    <input type="text" name="codigo" required>

    <label for="preco">Preço (R$) *</label>
    <input type="number" step="0.01" name="preco" required>

    <label for="quantidade_estoque">Quantidade em Estoque *</label>
    <input type="number" name="quantidade_estoque" required>

    <br><br>
    <input type="submit" value="Cadastrar Produto">
  </form>
</div>
</body>
</html>

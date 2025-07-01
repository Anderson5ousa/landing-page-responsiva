<?php
include '../db/conexao.php';

$id = $_GET['id'] ?? '';

if ($id) {
    $sql = "DELETE FROM produtos WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
}

header("Location: ../index.php");
exit;

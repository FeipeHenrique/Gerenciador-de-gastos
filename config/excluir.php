<?php
require_once 'config.php';

$id = $_GET['id'] ?? null;

if ($id !== null) {
    $stmt = mysqli_prepare($conexao, "DELETE FROM gastos WHERE id_gasto = ?");
    mysqli_stmt_bind_param($stmt, 'i', $id);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
}

header('Location: ../index.php');
exit;

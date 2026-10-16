<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = floatval($_POST['valor'] ?? '');
    $categoria = trim($_POST['categoria'] ?? '');
    $data = trim($_POST['data'] ?? '');

    $stmt = mysqli_prepare(
        $conexao,
        "INSERT INTO gastos (data, valor, categoria) VALUES (?, ?, ?)"
    );
    mysqli_stmt_bind_param($stmt, 'sds', $data, $valor, $categoria);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);
    header('Location: ../index.php');
    exit;
}

header('Location: form.php');
exit;

<?php
require 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $valor = floatval($_POST['valor'] ?? 0);

    // Insere um novo registro de saldo (mantém histórico simples)
    $stmt = mysqli_prepare(
        $conexao,
        "INSERT INTO saldo (valor) VALUES (?)"
    );
    mysqli_stmt_bind_param($stmt, 'd', $valor);
    mysqli_stmt_execute($stmt);
    mysqli_stmt_close($stmt);

    header('Location: ../index.php');
    exit;
}

header('Location: form_saldo.php');
exit;

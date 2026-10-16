<?php
require_once 'config.php';

// Busca o saldo atual para mostrar no formulário
$resultado = mysqli_query(
    $conexao,
    "SELECT valor FROM saldo ORDER BY id_saldo DESC LIMIT 1"
);
$saldo_atual = mysqli_fetch_assoc($resultado)['valor'] ?? 0;

include '../includes/header_form.php';
?>

<div class="container">
    <h2>Atualizar Saldo</h2>
    <p style="margin-bottom: 15px; color: #555;">
        Saldo atual: <strong>R$ <?= number_format($saldo_atual, 2, ',', '.') ?></strong>
    </p>

    <form action="salvar_saldo.php" method="POST" class="form-agendamento">
        <label for="valor">Novo saldo (R$): </label>
        <input type="number" name="valor" id="valor" step="0.01" min="0"
               placeholder="0.00" value="<?= htmlspecialchars($saldo_atual) ?>" required>

        <button type="submit">Salvar Saldo</button>
    </form>

    <?php include '../includes/menu.php'; ?>
</div>

<?php include '../includes/footer.php'; ?>

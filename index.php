<?php
require 'config/config.php';

// Busca todos os gastos
$result = mysqli_query(
    $conexao,
    "SELECT *
     FROM gastos
     ORDER BY data ASC"
);
$gastos = mysqli_fetch_all($result, MYSQLI_ASSOC);

// Total de gastos
$resultado = mysqli_query(
    $conexao,
    "SELECT SUM(valor) AS total FROM gastos"
);
$total_gastos = mysqli_fetch_assoc($resultado)['total'] ?? 0;

// Busca o saldo atual (pega o mais recente)
$resultado_saldo = mysqli_query(
    $conexao,
    "SELECT valor FROM saldo ORDER BY id_saldo DESC LIMIT 1"
);
$saldo = mysqli_fetch_assoc($resultado_saldo)['valor'] ?? 0;

// Calcula o restante
$restante = $saldo - $total_gastos;

include 'includes/header.php';
?>

<div class="container">

    <!-- Resumo do orçamento -->
    <div class="resumo-orcamento">
        <h2>Resumo do Orçamento</h2>
        <div class="cards">
            <div class="card saldo">
                <span class="label">Saldo disponível</span>
                <span class="valor">R$ <?= number_format($saldo, 2, ',', '.') ?></span>
            </div>
            <div class="card gastos">
                <span class="label">Total de gastos</span>
                <span class="valor">R$ <?= number_format($total_gastos, 2, ',', '.') ?></span>
            </div>
            <div class="card restante <?= $restante >= 0 ? 'positivo' : 'negativo' ?>">
                <span class="label">Restante</span>
                <span class="valor">R$ <?= number_format($restante, 2, ',', '.') ?></span>
            </div>
        </div>
        <a href="config/form_saldo.php" class="botao-novo">Atualizar Saldo</a>
    </div>

    <hr class="separador">

    <h2>Gastos:</h2>
    <?php if (empty($gastos)): ?>
        <p class="vazio">Nenhum gasto cadastrado.</p>
    <?php else: ?>

        <table class="tabela-gastos">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Categoria</th>
                    <th>Data</th>
                    <th>Excluir</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($gastos as $gasto): ?>
                    <tr>
                        <td><?= htmlspecialchars($gasto['id_gasto']) ?></td>
                        <td>R$ <?= htmlspecialchars($gasto['valor']) ?></td>
                        <td><?= htmlspecialchars($gasto['categoria']) ?></td>
                        <td>
                            <?= htmlspecialchars(date('d/m/Y', strtotime($gasto['data']))) ?>
                        </td>
                        <td>
                            <a href="config/excluir.php?id=<?= $gasto['id_gasto'] ?>"
                               class="btn-excluir"
                               onclick="return confirm('Excluir este gasto?')"
                               title="Excluir">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    <?php endif; ?>

    <a href="config/form.php" class="botao-novo">+ Novo Gasto</a>
</div>

<?php
include 'includes/footer.php';
?>

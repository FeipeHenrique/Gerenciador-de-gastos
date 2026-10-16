<?php
require_once 'config.php';
include '../includes/header_form.php';
?>

<div class="container">
    <h2>Cadastrar Gasto</h2>
    <form action="salvar.php" method="POST" class="form-agendamento">
        <label for="valor">Valor: </label>
        <input type="number" name="valor" id="valor" step="0.01" min="0" placeholder="0.00" required>

        <label for="categoria">Categoria: </label>
        <select name="categoria" id="categoria" required>
            <option value="" disabled selected>Selecione uma categoria</option>
            <option value="Alimentação">Alimentação</option>
            <option value="Lazer">Lazer</option>
            <option value="Transporte">Transporte</option>
            <option value="Educação">Educação</option>
            <option value="Saúde">Saúde</option>
            <option value="Moradia">Moradia</option>
            <option value="Outros">Outros</option>
        </select>

        <label for="data">Data: </label>
        <input type="date" id="data" name="data" required>

        <button type="submit">Adicionar</button>
    </form>

    <?php include '../includes/menu.php'; ?>
</div>

<?php include '../includes/footer.php'; ?>

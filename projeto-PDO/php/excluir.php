<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Excluir aluno</title>
</head>
<body>
    <header class="container">
        <a class="botao-header" href="../index.html">Início</a>
        <div class="container-titulo">
            <img src="../img/logo.jpeg" alt="Logo do Sistema Escola">
            <div>
                <h1>Sistema Escolar</h1>
                <h2>Gerenciamento de Alunos</h2>
            </div>
        </div>
        <a class="botao-header" href="../listar.html">Mostrar lista</a>
    </header>

    <main class="conteudo">
        <section class="painel">
            <h1>Excluir aluno</h1>
            <?php
            require_once "conexao.php";

            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

            if ($id === false || $id === null || $id < 1) {
                echo '<p class="mensagem">Informe um ID válido.</p>';
            } else {
                $sql = "DELETE FROM alunos WHERE id = :id";
                $stmt = $pdo->prepare($sql);
                $stmt->execute([':id' => $id]);

                if ($stmt->rowCount() > 0) {
                    echo '<p class="mensagem">Aluno excluído com sucesso!</p>';
                } else {
                    echo '<p class="mensagem">Aluno não encontrado.</p>';
                }
            }
            ?>
            <div class="acoes">
                <a class="botao" href="../excluir.html">Excluir outro</a>
                <a class="botao" href="../index.html">Voltar ao menu</a>
            </div>
        </section>
    </main>

    <footer class="rodape">Sistema Escola · PHP + MySQL &copy; 2026</footer>
</body>
</html>
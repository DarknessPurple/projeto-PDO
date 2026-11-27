<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Atualização de e-mail</title>
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
            <h1>Atualização de e-mail</h1>
            <?php
            require_once "conexao.php";

            $id = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);
            $novoEmail = trim($_POST['email'] ?? '');

            if ($id === false || $id === null || $id < 1) {
                echo '<p class="mensagem">Informe um ID válido.</p>';
            } elseif (!filter_var($novoEmail, FILTER_VALIDATE_EMAIL)) {
                echo '<p class="mensagem">Informe um e-mail válido.</p>';
            } else {
                $consulta = $pdo->prepare("SELECT email FROM alunos WHERE id = :id");
                $consulta->execute([':id' => $id]);
                $aluno = $consulta->fetch(PDO::FETCH_ASSOC);

                if (!$aluno) {
                    echo '<p class="mensagem">Aluno não encontrado.</p>';
                } elseif ($aluno['email'] === $novoEmail) {
                    echo '<p class="mensagem">Nenhuma alteração necessária.</p>';
                } else {
                    $sql = "UPDATE alunos SET email = :email WHERE id = :id";
                    $stmt = $pdo->prepare($sql);
                    $stmt->execute([
                        ':email' => $novoEmail,
                        ':id' => $id
                    ]);

                    echo '<p class="mensagem">E-mail atualizado com sucesso!</p>';
                }
            }
            ?>
            <div class="acoes">
                <a class="botao" href="../atualizar.html">Voltar à atualização</a>
                <a class="botao" href="../index.html">Voltar ao menu</a>
            </div>
        </section>
    </main>

    <footer class="rodape">Sistema Escola · PHP + MySQL &copy; 2026</footer>
</body>
</html>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Aluno cadastrado</title>
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
            <h1>Cadastro de alunos</h1>
            <?php
            require_once "conexao.php";

            $nome = trim($_POST['nome'] ?? '');
            $email = trim($_POST['email'] ?? '');
            $idade = filter_input(INPUT_POST, 'idade', FILTER_VALIDATE_INT);
            $erro = '';

            if (strlen($nome) < 2) {
                $erro = 'Informe um nome válido.';
            } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $erro = 'Informe um e-mail válido.';
            } elseif ($idade === false || $idade === null || $idade < 1) {
                $erro = 'Informe uma idade válida.';
            } else {
                $sql = "INSERT INTO alunos (nome, email, idade)
                        VALUES (:nome, :email, :idade)";

                $stmt = $pdo->prepare($sql);
                $stmt->execute([
                    ':nome' => $nome,
                    ':email' => $email,
                    ':idade' => $idade
                ]);
            }
            ?>
            <?php if ($erro !== ''): ?>
                <p class="mensagem"><?= htmlspecialchars($erro) ?></p>
            <?php else: ?>
                <p class="mensagem">Aluno cadastrado com sucesso!</p>
            <?php endif; ?>
            <div class="acoes">
                <a class="botao" href="../cadastrar.html">Cadastrar outro</a>
                <a class="botao" href="../index.html">Voltar ao menu</a>
            </div>
        </section>
    </main>

    <footer class="rodape">Sistema Escola · PHP + MySQL &copy; 2026</footer>
</body>
</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css/estilos.css">
    <title>Listagem de alunos</title>
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
            <h1>Listagem de alunos</h1>
            <?php
            require_once "conexao.php";

            $sql = "SELECT * FROM alunos";
            $stmt = $pdo->prepare($sql);
            $stmt->execute();
            $alunos = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <div class="tabela">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>E-mail</th>
                            <th>Idade</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($alunos as $aluno): ?>
                        <tr>
                            <td><?= htmlspecialchars($aluno['id']) ?></td>
                            <td><?= htmlspecialchars($aluno['nome']) ?></td>
                            <td><?= htmlspecialchars($aluno['email']) ?></td>
                            <td><?= htmlspecialchars($aluno['idade']) ?></td>
                            <td class="acoes-tabela">
                                <a class="botao-acao" href="../atualizar.html?id=<?= urlencode($aluno['id']) ?>&email=<?= urlencode($aluno['email']) ?>">Editar</a>
                                <form method="POST" action="excluir.php" onsubmit="return confirm('Tem certeza que deseja excluir este aluno?')">
                                    <input type="hidden" name="id" value="<?= htmlspecialchars($aluno['id']) ?>">
                                    <button class="botao-acao botao-excluir" type="submit">Excluir</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
                <?php if (empty($alunos)): ?>
                    <p class="mensagem">Nenhum aluno cadastrado.</p>
                <?php endif; ?>
            </div>

            <div class="acoes">
                <a class="botao" href="../index.html">Voltar ao menu</a>
            </div>
        </section>
    </main>

    <footer class="rodape">Sistema Escola · PHP + MySQL &copy; 2026</footer>
</body>
</html>
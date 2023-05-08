<?php 
require_once 'db.php';
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Registro de Produtos</title>
</head>
<body>
<div class="container">
        <h1>Registro de Produtos</h1>
        <?php 
        if (isset($_POST['submit'])){
            $nome = $_POST['nome'];
            $tamanho = $_POST['tamanho'];
            $peso = $_POST['peso'];
            $qnt = $_POST['qnt'];
            $prc = $_POST['prc'];
            
            
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM produto WHERE nome = ? AND tamanho = ?');
            $stmt->execute([$nome, $tamanho]);
            $count = $stmt->fetchColumn();
            
            if ($count > 0){
                $error = 'Produto já existente.';}
            else{
                $stmt = $pdo->prepare('INSERT INTO produto (nome, tamanho, peso, quantidade, preco)
                VALUES (:nome, :tamanho, :peso, :quantidade, :preco)');
                $stmt->execute(['nome' => $nome, 'tamanho' => $tamanho, 'peso' => $peso,
                'quantidade' => $qnt, 'preco' => $prc]);

                if ($stmt->rowCount()){
                    echo '<span>Novo produto registrado com sucesso!</span>';
                }else{
                    echo '<span>Erro ao registrar produto. Tente novamente mais tarde!</span>';
                }

            }

            if (isset($error)) {
                echo '<span>' . $error . '</span>';
            }
        }
?>

<form method="post">

<label for="nome">Nome:</label>
<input type="text" name="nome" required><br>

<label for="tamanho">Tamanho:</label>
<input type="text" name="tamanho" required><br>

<label for="peso">Peso:</label>
<input type="text" name="peso" maxlenght="11" required><br>

<label for="qnt">Quantidade:</label>
<input type="text" name="qnt" required><br>

<label for="prc">Preço:</label>
<input type="text" name="prc" required><br>


    <div>

    <button type="submit" name="submit" value="Cadastrar">Cadastrar</button>
    <button><a href="listar-f.php">Listar</a></button>
    </div>

    </form>
    </div>
    </section>
</body>
</html>
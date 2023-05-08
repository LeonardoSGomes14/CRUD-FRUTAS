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
    <title>Cadastro Cliente</title>
</head>
<body>
<div class="container">
        <h1>Cadastro do cliente</h1>
        <?php 
        if (isset($_POST['submit'])){
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $telefone = $_POST['telefone'];
            $dtnasc = $_POST['dtnasc'];
            
            
            $stmt = $pdo->prepare('SELECT COUNT(*) FROM cliente WHERE nome = ? AND email = ?');
            $stmt->execute([$nome, $email]);
            $count = $stmt->fetchColumn();
            
            if ($count > 0){
                $error = 'Cliente já existente.';}
            else{
                $stmt = $pdo->prepare('INSERT INTO cliente (nome, email, telefone, dtnasc)
                VALUES (:nome, :email, :telefone, :dtnasc)');
                $stmt->execute(['nome' => $nome, 'email' => $email, 'telefone' => $telefone,
                'dtnasc' => $dtnasc]);

                if ($stmt->rowCount()){
                    echo '<span>Novo cadastro realizado com sucesso!</span>';
                }else{
                    echo '<span>Erro ao cadastrar cliente. Tente novamente mais tarde!</span>';
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

<label for="email">E-mail:</label>
<input type="email" name="email" required><br>

<label for="telefone">Telefone:</label>
<input type="text" name="telefone" maxlenght="11" required><br>

<label for="dtnasc">Data de nascimento:</label>
<input type="date" name="dtnasc" required><br>


    <div>

    <button type="submit" name="submit" value="Cadastrar">Cadastrar</button>
    <button><a href="listar.php">Listar</a></button>
    </div>

    </form>
    </div>
    </section>
</body>
</html>
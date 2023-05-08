<?php include 'db.php';?>


<!DOCTYPE html>
<html>

<head>
    <link rel="stylesheet" href="style.css">
    <title>Registros dos produtos</title>
</head>

<body class="listar">
    <div class="container">
    <h1>Registros dos produtos</h1>

    <?php
    $stmt = $pdo->query ('SELECT * FROM produto');
    $registros = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($registros) == 0) {
        echo '<p>Nenhum produto registrado.</p>';
    } else {
        echo '<table border="1">';
        echo '<thead><tr><th>Nome</th><th>tamanho</th><th>peso</th><th>quantidade</th><th>preço</th><th colspan="2">Opções</th></tr></thead>';
        echo '<tbody>';

        foreach ($registros as $registro) {
            echo '<tr>';
            echo '<td>' . $registro['nome'] . '</td>';
            echo '<td>' . $registro['tamanho'] . '</td>';
            echo '<td>' . $registro['peso'] . '</td>';
            echo '<td>' . $registro['quantidade'] . '</td>';
            echo '<td>' . $registro['preco'] . '</td>';

            echo '<td><a style="color:black;" href="atualizar-f.php?id=' .
            $registro['id'] . '">Atualizar</a></td>';
            echo '<td><a style="color:black;" href="deletar-f.php?id=' .
            $registro['id'] . '">Deletar</a></td>';
            
    
        }
    
        echo '</tbody>';
        echo '</table>';
        }
    ?>   
    </div> 
    </body>
    </html>
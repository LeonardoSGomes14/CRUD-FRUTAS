<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];

$stmt = $pdo-> prepare('SELECT * FROM produto WHERE id = ?');
$stmt ->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('location: listar.php');
    exit;
}

$nome = $appointment ['nome'];
$tamanho = $appointment['tamanho'];
$peso = $appointment['peso'];
$qnt = $appointment['quantidade'];
$prc = $appointment ['preco'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar registro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Atualizar registro</h1>
    <form method = "post">
        <label for = "nome">Nome do produto: </label>
        <input type = "text" name = "nome" value = "<?php echo $nome; ?>" required><br>

        <label for = "tamanho"> tamanho: </label>
        <input type = "text" name = "tamanho" value = "<?php echo $tamanho; ?>" required><br>

        <label for = "peso">Peso: </label>
        <input type = "text" name = "peso" value = "<?php echo $peso; ?>"><br>

        <label for = "qnt">Quantidade: </label>
        <input type = "text" name = "qnt" value = "<?php echo $qnt; ?>" required><br>

        <label for = "prc">Preço: </label>
        <input type = "text" name = "prc" value = "<?php echo $prc; ?>" required><br>

        <button type ="submit">Atualizar</button>
</form>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $tamanho = $_POST['tamanho'];
    $peso = $_POST['peso'];
    $qnt = $_POST['qnt'];
    $prc = $_POST['prc'];


//Validação dos dados dos formulários aqui.\\

$stmt = $pdo -> prepare('UPDATE produto SET nome = ?, tamanho = ?, peso = ?,quantidade = ?, preco = ? WHERE id = ?');
$stmt -> execute([$nome, $tamanho, $peso, $qnt, $prc, $id]);
header('location: listar-f.php');
exit;
}
?>
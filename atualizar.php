<?php
include 'db.php';
if (!isset($_GET['id'])) {
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];

$stmt = $pdo-> prepare('SELECT * FROM cliente WHERE id = ?');
$stmt ->execute([$id]);
$appointment = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$appointment) {
    header('location: listar.php');
    exit;
}

$nome = $appointment ['nome'];
$email = $appointment['email'];
$telefone = $appointment['telefone'];
$dtnasc = $appointment['dtnasc'];

?>

<!DOCTYPE html>
<html>
<head>
    <title>Atualizar Cadastro</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>Atualizar Cadastro</h1>
    <form method = "post">
        <label for = "nome">Nome: </label>
        <input type = "text" name = "nome" value = "<?php echo $nome; ?>" required><br>

        <label for = "email"> E-mail: </label>
        <input type = "email" name = "email" value = "<?php echo $email; ?>" required><br>

        <label for = "telefone">Telefone: </label>
        <input type = "text" name = "telefone" value = "<?php echo $telefone; ?>"><br>

        <label for = "dtnasc">Data de nascimento: </label>
        <input type = "date" name = "dtnasc" value = "<?php echo $dtnasc; ?>" required><br>

        <button type ="submit">Atualizar</button>
</form>
</div>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $dtnasc = $_POST['dtnasc'];


//Validação dos dados dos formulários aqui.\\

$stmt = $pdo -> prepare('UPDATE cliente SET nome = ?, email = ?, telefone = ?, dtnasc = ? WHERE id = ?');
$stmt -> execute([$nome, $email, $telefone, $dtnasc, $id]);
header('location: listar.php');
exit;
}
?>
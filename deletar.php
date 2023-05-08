<?php
include 'db.php';

if(!isset($_GET['id'])) {
    header('location: listar.php');
    exit;
}

$id = $_GET['id'];
$stmt = $pdo->prepare('SELECT * FROM cliente WHERE id = ?');
$stmt->execute([$id]);
$appointment = $stmt -> fetch(PDO::FETCH_ASSOC);

if(!$appointment) {
    header('location: listar.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $stmt = $pdo->prepare('DELETE FROM cliente WHERE id = ?');
    $stmt ->execute ([$id]);
    header('location: listar.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Deletar Cadastro</title>
</head>
<body>
    <div class="container">
    <h1>Deletar Cadastro</h1>
    <p>Tem certeza que deseja deletar o cadastro de <?php echo $appointment['nome']; ?>?</p> 
<form method = "post">
    <button type = "submit"> Sim </button>
    <a href = "listar.php"> Não </a>

</form> 
</div>
</body>
</html>
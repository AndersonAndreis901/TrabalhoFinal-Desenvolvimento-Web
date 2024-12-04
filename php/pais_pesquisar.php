<?php
include 'conexao.php';

$nome = $_GET['nome'];

$query = "SELECT * FROM paises WHERE nome LIKE '%$nome%'";
$result = mysqli_query($conn, $query);

$paises = array();
while ($row = mysqli_fetch_assoc($result)) {
    $paises[] = $row;
}

echo json_encode($paises);
?>

<?php
include 'conexao.php';

$query = "SELECT * FROM paises";
$result = mysqli_query($conn, $query);

$paises = array();
while ($row = mysqli_fetch_assoc($result)) {
    $paises[] = $row;
}

echo json_encode($paises);
?>

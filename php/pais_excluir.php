<?php
include 'conexao.php';

$id = $_GET['id'];

$query = "DELETE FROM paises WHERE id = $id";
if (mysqli_query($conn, $query)) {
    echo "País excluído com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>

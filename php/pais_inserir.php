<?php
include 'conexao.php';

$nome = $_GET['nome'];
$capital = $_GET['capital'];
$regiao = $_GET['regiao'];
$populacao = $_GET['populacao'];
$area = $_GET['area'];

$query = "INSERT INTO paises (nome, capital, regiao, populacao, area) VALUES ('$nome', '$capital', '$regiao', '$populacao', '$area')";
if (mysqli_query($conn, $query)) {
    echo "País inserido com sucesso!";
} else {
    echo "Erro: " . mysqli_error($conn);
}
?>

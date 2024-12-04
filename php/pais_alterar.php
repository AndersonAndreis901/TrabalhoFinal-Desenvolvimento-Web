<?php
require 'banco2.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nome = $_POST['nome'];
    $capital = $_POST['capital'];
    $regiao = $_POST['regiao'];
    $populacao = $_POST['populacao'];
    $area = $_POST['area'];

    try {
        $stmt = $conn->prepare("UPDATE paises SET nome = ?, capital = ?, regiao = ?, populacao = ?, area = ? WHERE id = ?");
        $stmt->execute([$nome, $capital, $regiao, $populacao, $area, $id]);
        echo json_encode(["success" => true]);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>

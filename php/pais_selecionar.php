<?php
require 'banco2.php';

if ($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['id'])) {
    $id = $_GET['id'];

    try {
        $stmt = $conn->prepare("SELECT * FROM paises WHERE id = ?");
        $stmt->execute([$id]);
        $pais = $stmt->fetch(PDO::FETCH_ASSOC);
        echo json_encode($pais);
    } catch (PDOException $e) {
        echo json_encode(["success" => false, "error" => $e->getMessage()]);
    }
}
?>

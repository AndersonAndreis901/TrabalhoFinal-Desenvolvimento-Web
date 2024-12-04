<?php
$servername = "localhost";  
$username = "root";       
$password = "";            
$dbname = "banco2";         

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexão falhou: " . $conn->connect_error);
}

$countries = json_decode(file_get_contents("php://input"), true);

if ($countries) {
    foreach ($countries as $country) {
        $nome = $country['name'];
        $capital = $country['capital'];
        $regiao = $country['region'];
        $populacao = $country['population'];
        $area = $country['area'];

        $sql = "INSERT INTO paises (nome, capital, regiao, populacao, area)
                VALUES ('$nome', '$capital', '$regiao', '$populacao', '$area')";

        if ($conn->query($sql) !== TRUE) {
            echo "Erro ao inserir país: " . $conn->error;
        }
    }

    echo "Dados exportados com sucesso!";
} else {
    echo "Nenhum dado de país recebido!";
}

$conn->close();
?>

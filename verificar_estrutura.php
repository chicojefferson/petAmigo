<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bd_adocao_pet";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

echo "<h1>Estrutura da Tabela 'animal'</h1>";

// Verificar estrutura da tabela
$sql = "DESCRIBE animal";
$result = $conn->query($sql);

if ($result) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    echo "<tr style='background: #f0f0f0;'><th>Campo</th><th>Tipo</th><th>Nulo</th><th>Chave</th><th>Padrão</th><th>Extra</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td><strong>" . $row['Field'] . "</strong></td>";
        echo "<td>" . $row['Type'] . "</td>";
        echo "<td>" . $row['Null'] . "</td>";
        echo "<td>" . $row['Key'] . "</td>";
        echo "<td>" . $row['Default'] . "</td>";
        echo "<td>" . $row['Extra'] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Erro ao verificar estrutura: " . $conn->error;
}

// Verificar se existem dados na tabela
echo "<h2>Dados de Exemplo (primeiros 3 registros)</h2>";
$sql2 = "SELECT * FROM animal LIMIT 3";
$result2 = $conn->query($sql2);

if ($result2 && $result2->num_rows > 0) {
    echo "<table border='1' style='border-collapse: collapse; width: 100%;'>";
    $first = true;
    while ($row = $result2->fetch_assoc()) {
        if ($first) {
            echo "<tr style='background: #e0e0e0;'>";
            foreach ($row as $key => $value) {
                echo "<th>" . $key . "</th>";
            }
            echo "</tr>";
            $first = false;
        }
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>" . (($value === null) ? 'NULL' : $value) . "</td>";
        }
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "Nenhum dado encontrado ou erro: " . $conn->error;
}

$conn->close();
?>
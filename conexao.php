<?php
// Configurações de conexão com o MySQL
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    // Coletar apenas dados básicos
    $nome = $conn->real_escape_string($_POST['nome']);
    $especie = (int)$_POST['especieId'];
    $raca = (int)$_POST['racaId'];
    $sexo = ($_POST['sexo'] == 'M') ? 1 : 2;
    $cor = $conn->real_escape_string($_POST['cor']);
    $data_entrada = $conn->real_escape_string($_POST['dataEntrada']);

    // Query mais simples
    $sql = "INSERT INTO animal (nome, especie, raca, sexo, cor, data_entrada) 
            VALUES (?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    
    if ($stmt) {
        $stmt->bind_param("siisss", $nome, $especie, $raca, $sexo, $cor, $data_entrada);

        if ($stmt->execute()) {
            echo "<script>
                    alert('Animal cadastrado com sucesso!');
                    window.location.href = 'cadastro-animal.php';
                  </script>";
        } else {
            echo "<script>
                    alert('Erro ao cadastrar: " . addslashes($stmt->error) . "');
                    window.history.back();
                  </script>";
        }
        $stmt->close();
    } else {
        echo "<script>
                alert('Erro na preparação: " . addslashes($conn->error) . "');
                window.history.back();
              </script>";
    }
}

$conn->close();
?>

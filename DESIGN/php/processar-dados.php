<?php
/* Definições globais */
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "formulario-_site";

// Criar conexão
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexão
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

/* Pegando os dados do formulário */
$nome = $_POST['nome'];
$email = $_POST['email'];
$telefone = $_POST['telefone'];
$servico = $_POST['servico'];
$mensagem = $_POST['mensagem'];
$data_atual = date('Y-m-d H:i:s'); // Usar um formato de data padrão

/* Preparar e vincular */
$stmt = $conn->prepare("INSERT INTO mensagens (nome_completo, email, telefone, servicos_desejado, descricao_projeto, data) VALUES (?, ?, ?, ?, ?, ?)");
$stmt->bind_param("ssssss", $nome, $email, $telefone, $servico, $mensagem, $data_atual);

// Executar a consulta
if ($stmt->execute()) {
    echo "Mensagem enviada com sucesso!";
} else {
    echo "Erro ao enviar a mensagem: " . $stmt->error;
}

// Fechar conexões
$stmt->close();
$conn->close();
?>

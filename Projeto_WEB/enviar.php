<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $mensagem = $_POST['mensagem'];

    $mail = new PHPMailer(true);

    try {
        // Configuração do servidor SMTP Gmail
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'SEU_EMAIL@gmail.com'; // seu Gmail
        $mail->Password = 'tukbqigvieqfgjjp';    // sua senha de app (sem espaços)
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Remetente e destinatário
        $mail->setFrom($email, $nome);
        $mail->addAddress('projeto.ipw.gmr@gmail.com'); // para onde vai o email

        // Conteúdo do email
        $mail->isHTML(true);
        $mail->Subject = 'Nova mensagem do site Sabores da Casa';
        $mail->Body = "<p><strong>Nome:</strong> $nome</p>
                       <p><strong>Email:</strong> $email</p>
                       <p><strong>Mensagem:</strong><br>$mensagem</p>";

        $mail->send();
        echo 'Mensagem enviada com sucesso!';
    } catch (Exception $e) {
        echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
    }
} else {
    echo "Método inválido";
}
?>

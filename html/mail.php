<?php

ini_set('display_errors',1);
ini_set('display_startup_erros',1);
error_reporting(E_ALL);

$email_envio = 'contato@repinda.tk'; // E-mail receptor
$email_pass = 'RepindaSenac'; // Senha do e-mail

$site_name = 'Repinda'; // Nome do Site
$site_url = 'repinda.tk'; // URL do Site

$host_smtp = 'mail.repinda.tk'; // HOST SMTP Ex: smtp.domain.com.br
$host_port = '465'; // Porta do Host

// Variáveis do Formulário

$name = $_POST['name'];
$email = $_POST['email'];
$suggestions = $_POST['suggestions'];

// Conteúdo do Formulário

$body_content = "
<html>
<head>
<title>HTML email</title>

<style>

h1, p {
    color: #fff;   
    text-align: center;
}

a {
    color: #fff !important;
}

.box {
    width: 40%;
    height: 300px;
    margin: 0 auto;
    background-color: #1abc9c;
}


</style>

</head>
<body>

<div class='box'>
    <h1> Contato de cliente! </h1>
    <p>Nome: <br> $name</p>
    <p>E-mail: <br> $email</p>
    <p>Sugestões: <br>$suggestions</p>
</div>
</body>
</html>
";

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

$mail = new PHPMailer;
//$mail->SMTPDebug = 4;
$mail->CharSet = 'UTF-8';

$mail->isSMTP();
$mail->Host = $host_smtp;
$mail->SMTPAuth = true;
$mail->Username = $email_envio;
$mail->Password = $email_pass;
$mail->SMTPSecure = 'ssl';
$mail->Port = $host_port; 
$mail->isHTML(true);
$mail->From = $email_envio;

$mail->addAddress($email_envio);

$mail->FromName = 'Formulário de Contato';
$mail->AddReplyTo($_POST['email'], $_POST['name']);

$mail->WordWrap = 70;

$mail->Subject = 'Formulário - ' . $site_name . ' - ' . $_POST['name'];

$mail->Body = $body_content;

header('Content-type: application/json');

if(!$mail->send()) {
    header("HTTP/1.1 400 error");
    echo json_encode(["status" => false]);    
} else {
    header("HTTP/1.1 200 ok");
    echo json_encode(["status" => true]); 
}

?>
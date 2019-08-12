<?php


$data = $_POST;



$to = "thomaz.alt1593@gmail.com, thomaz.alt1593@gmail.com";
$subject = "HTML email";

$message = "
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
    <p>Nome: <br>".$data['name']."</p>
    <p>E-mail: <br>".$data['email']."</p>
    <p>Sugestões: <br>".$data['suggestions']."</p>
</div>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <thomaz1593@gmail.com>' . "\r\n";

mail($to,$subject,$message,$headers);

header('Content-type: application/json');
//echo json_encode(["status" => true]);
echo json_encode($data);

?>


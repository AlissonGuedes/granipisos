<?php
require('lib/class.phpmailer.php');

$emailDominio = "contato@studioadv.com.br";
$nomeDominio = "Studio Advocacia";

$emailDominio2 = "tacticwebcg@gmail.com";
$nomeDominio2 = "Felipe";

$assunto = "Contato pelo site Studio Advocacia";

$nomeContato = $_POST['nome'];
$emailContato = $_POST['email'];
$msgContato = $_POST['msg'];
// echo $nomeContato.' - '.$emailContato.' - '.$phoneContato.' - '.$cidadeContato.' - '.$setorContato.' - '.$msgContato;
// die();

$mensagem = '
<html>

    <body>
        <strong><h2>Contato pelo Site StudioAdv</h2></strong>
        <br>
        <strong> Nome: </strong>  '.$nomeContato.'<br>
        <strong> E-mail: </strong>  '.$emailContato.'<br>
        <strong> Mensagem: </strong><br>  '.$msgContato.'
    </body>
</html>
';


// --------------- PHP MAIL() ---------------

// $header = "MIME-Version: 1.0\n";
// $header.= "Content-type:text/html; charset=iso-8859-1\n";
// $header.= "From: ".$emailContato."\n";

// if(mail($emailDominio, $assunto, $mensagem, $header)){
//     header("Location: contact.php?msg=mensagem_enviada");
// }else{
//     echo 'Erro ao enviar mensagem :<br> '.var_dump(mail($emailDominio, $assunto, $mensagem, $header));
// }

// --------------- PHP MAILER ---------------

$mail = new PHPMailer(true);

try {
     $mail->Host = $_SERVER['SERVER_NAME'];
     $mail->SMTPAuth   = true;
     $mail->Port       = 25;
     $mail->Username = 'usuário';
     $mail->Password = 'senha';

     $mail->SetFrom($emailContato, $nomeContato);
     $mail->Subject = $assunto;
     $mail->AddAddress($emailDominio, $nomeDominio);
     // Adiciona um novo Email
	 $mail->AddBCC($emailDominio2, $nomeDominio);

	 // Ou se quiser adicionar uma cópia oculta. Nesse caso, o Email 2 não ficará visivel para o Email 1, vice-versa.
	 //$mail->AddBCC( $nomeDominio2, $emailDominio2 );


     $mail->MsgHTML($mensagem);

     $mail->Send();
     header("Location: att.php?msg=enviado");

    }catch (phpmailerException $e) {
      echo $e->errorMessage();
}
?>

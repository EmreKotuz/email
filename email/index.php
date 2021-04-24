<?php
if(isset($_POST['submit'])) 
{
$message=
'İsim:	'.$_POST['isim'].'<br />
Konu:	'.$_POST['konu'].'<br />
E-Posta:	'.$_POST['eposta'].'<br />
Mesaj:	'.$_POST['mesaj'].'
';
    require "PHPMailer-master/class.phpmailer.php";		// phpmailder dosyamızı çağırıyoruz
      
    // Sınıf
    $mail = new PHPMailer();  
      
    // SMTP Ayarları
    $mail->CharSet = 'UTF-8';		// Türkçe karakter sorunu olmaması için karakter seti belirtiyoruz.
	$mail->IsSMTP();                // SMTP bağlantısı kuruyoruz
    $mail->SMTPAuth = true;         // SMTP bağlantı yetkilendirmeyi aktif ediyoruz
    $mail->SMTPSecure = "ssl";      // Bağlantı türünü belirliyoruz. Alternatif => tls
    $mail->Host = "smtp.gmail.com";	// Gmail SMTP sunucu adresi
    $mail->Port = 465;				// Gmail SMTP port
    $mail->Encoding = '7bit';
          
    // Oluştur
    $mail->SetFrom($_POST['eposta'], $_POST['isim']);
    $mail->AddReplyTo($_POST['eposta'], $_POST['isim']);
    $mail->Subject = "İletişim Formu";					// Konu (gerekli değil)
    $mail->MsgHTML($message);
 
    // Gönder
    $mail->AddAddress("emre@emrekotuz.com", "İsim Soyisim"); // Mailleri hangi adrese gönderelim? - İsim ne olsun
    $result = $mail->Send();		// Gönder!  
	$message = $result ? '<div class="alert alert-success" role="alert"><strong>Başarılı! </strong>Mesajınız gönderildi!</div>' : '<div class="alert alert-danger" role="alert"><strong>Hata! </strong>Mesaj gönderilirken bir sorun oluştu.</div>';  

	unset($mail);
}
?>
<!DOCTYPE html>
<html lang="tr-TR">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gmail SMTP İletişim Formu</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body>
  	<div class="contactform">
  	<div class="panel panel-default">
  		<div class="panel-heading">
    	<h3 class="panel-title">İletişim Formu</h3>
    	</div>
    	<div class="panel-body">
    	<form name="form1" id="form1" action="" method="post">
    			<fieldset>
    			  <input type="text" class="form-control" name="isim" placeholder="İsim" required />
    			  <br />
    			  <input type="text" class="form-control" name="konu" placeholder="Konu" required />
    			  <br />
    			  <input type="email" class="form-control" name="eposta" placeholder="E-Posta" required />
    			  <br />
    			  <textarea rows="4" class="form-control" cols="20" name="mesaj" placeholder="Mesajınız" required ></textarea>
    			  <br />
    			  <input type="submit" class="btn btn-success"name="submit" value="Gönder" />
    			</fieldset>
    	</form>
    	<p><?php if(!empty($message)) echo $message; ?></p>
    	</div>
	</div>
	</div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
  </body>
</html>
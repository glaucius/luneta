<?php
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/

require_once('PHPMailer/class.phpmailer.php');

// Funcion to do the services check
//
function pscDoCheck($host, $service, $port='', $timeout=20) {
    $host = strtolower($host);

    switch($service) {
         case 'http': 
            $Request = "HEAD / HTTP/1.0\r\nUser-Agent: Luneta luneta.sf.net\r\nHost: $host\r\n\r\n";
            $OkResults = array("200\D+OK", "200\D+Document\s+Follows", "302", "301");
            if(!is_numeric($port)) $port = 80;
            break;

         case 'ftp': 
            $OkResults = array("220");
            $Request = '';
            if(!is_numeric($port)) $port = 21;
            break;

         case 'smtp': 
            $OkResults = array("220");
            $Request = '';
            if(!is_numeric($port)) $port = 25;
            break;

         case 'pop3': 
            $OkResults = array("\\+OK");
            $Request = '';
            if(!is_numeric($port)) $port = 110;
            break;

         case 'imap': 
            $OkResults = array("\\* OK"); 
            $Request = '';
            if(!is_numeric($port)) $port = 143;
            break;
    }

      list($MSec, $Sec) = explode(" ", microtime());
      $TimeBegin = (double) $MSec + (double) $Sec;

      $Socket = @fsockopen($host, $port, $error_number, $error, $timeout);

      list($MSec, $Sec) = explode(" ", microtime());
      $TimeEnd = (double) $MSec + (double) $Sec;
	  $Time = number_format($TimeEnd - $TimeBegin, 3);
      // Check port

	  if (is_resource($Socket))
      {
             if ($Request != "") { fputs($Socket, $Request); }
             if (!feof($Socket)) { $Response = fgets($Socket, 4096); }
             
             $Result = "Failed";
             $Error  = $Response;

             foreach($OkResults as $exp_result) {
                if (preg_match("/$exp_result/",$Response)) {
                   $Error = "";
                   $Result = "Ok";
                }
             }
         fclose($Socket);
      }
      else 
	  { 
          $Result = "Failed";
		  $Error = ((!$error) ? "Time out" : $error);
	  }

      return array(
            'host'   => $host,
            'service'=> $service,
            'port'   => $port,
            'result' => $Result,
            'time'   => $Time,
            'error'  => $Error
          );

}


// Sending mail funcions

function send_email_up($email, $host, $error, $service, $mail_config_smtp) {


$mail = new PHPMailer(true);

$mail->IsSMTP();

try {
  $mail->SMTPAuth   = false;
  $mail->Host       = $mail_config_smtp[1]; // sets the SMTP server
  $mail->Port       = $mail_config_smtp[2];                    // set the SMTP port for the GMAIL server
  $mail->Username   = $mail_config_smtp[3]; // SMTP account username
  $mail->Password   = $mail_config_smtp[4];        // SMTP account password
  $mail->AddAddress($email);
  $mail->SetFrom("$mail_config_smtp[5]", "$mail_config_smtp[8]");
  $mail->Subject = "$mail_config_smtp[6]  $host ";
  $mail->AltBody = "$mail_config_smtp[7]";
//  $mail->MsgHTML(file_get_contents('contents.html'));
  $mail->Body = "Hi, the monitor $host is UP <p> Luneta Team <p> http://luneta.sf.net ";
  $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
  $mail->Send();
//  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
//  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
//  echo $e->getMessage(); //Boring error messages from anything else!
}

}

function send_email_down($email, $host, $error, $service, $mail_config_smtp) {

$mail = new PHPMailer(true);


$mail->IsSMTP();

try {
  $mail->SMTPAuth   = false;
  $mail->Host       = $mail_config_smtp[1]; // sets the SMTP server
  $mail->Port       = $mail_config_smtp[2];                    // set the SMTP port for the GMAIL server
  $mail->Username   = $mail_config_smtp[3]; // SMTP account username
  $mail->Password   = $mail_config_smtp[4];        // SMTP account password
  $mail->AddAddress($email);
  $mail->SetFrom("$mail_config_smtp[5]", "$mail_config_smtp[8]");
  $mail->Subject = "$mail_config_smtp[6]  $host ";
  $mail->AltBody = "$mail_config_smtp[7]";
//  $mail->MsgHTML(file_get_contents('contents.html'));
  $mail->Body = "Hi, the monitor $host is DOWN <p> Luneta Team <p> http://luneta.sf.net ";
  $mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
  $mail->Send();
//  echo "Message Sent OK</p>\n";
} catch (phpmailerException $e) {
//  echo $e->errorMessage(); //Pretty error messages from PHPMailer
} catch (Exception $e) {
//  echo $e->getMessage(); //Boring error messages from anything else!
}

}


?>



<?
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
include('include/config.inc.php');
include('include/comum.php');
include('include/functions.inc.php');

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

# Declaring the variables
$host_address=$argv[1];
$id_host=$argv[2];
$email=$argv[3];

# Selecting the hosts and the services, and starting the monitor
$rs = $DB->Execute("select id,service,status from hosts_services where id_host=$id_host");
while ($array = $rs->FetchRow()) {

	$service_check = pscDoCheck("$host_address", "$array[service]");

	if("$service_check[result]"=="Ok") {

		if ("$array[status]"=="0") {
			$mail_config_smtp=array($smtp_auth, $smtp_server, $smtp_port, $smtp_username, $smtp_password, $smtp_from, $send_mail['subject'], $send_mail['body'], $smtp_from_name);
			send_email_up($email, $host_address, $service_check['error'], $array['service'], $mail_config_smtp);
		}


	$ok = $DB->Execute("update `hosts_services` set `lastcheck` = NOW(), `tta`=$service_check[time], `status`='1' where `id_host`='$id_host' and `service`='$array[service]'");
	if (!$ok) mylogerr($DB->ErrorMsg());

	$ok = $DB->Execute("INSERT INTO `status_history` VALUES (NULL, '$id_host', '$array[id]', CURRENT_TIMESTAMP, '$service_check[time]', '1')");
	if (!$ok) mylogerr($DB->ErrorMsg());

	} else {

		if ("$array[status]"=="1") {
			$mail_config_smtp=array($smtp_auth, $smtp_server, $smtp_port, $smtp_username, $smtp_password, $smtp_from, $send_mail['subject'], $send_mail['body'], $smtp_from_name);
			send_email_down($email, $host_address, $service_check['error'], $array['service'], $mail_config_smtp);
		}

	$ok = $DB->Execute("update `hosts_services` set `lastcheck` = NOW(), `tta`=$service_check[time], `status`='0' where `id_host`='$id_host' and `service`='$array[service]'");
	if (!$ok) mylogerr($DB->ErrorMsg());

	$ok = $DB->Execute("INSERT INTO `status_history` VALUES (NULL, '$id_host', '$array[id]', CURRENT_TIMESTAMP, '$service_check[time]', '0')");
	if (!$ok) mylogerr($DB->ErrorMsg());


	}
}



?>

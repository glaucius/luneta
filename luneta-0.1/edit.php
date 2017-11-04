<?php
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
// Verificador de sessão / session check
require "include/verifica.php";
// Conexão com o banco de dados / database connection
require "include/comum.php";

echo "$header";

$host_name=$_GET['name'];

echo "<div class='row'>
	  <div class='six columns'>
	<h3>Edit  $host_name </h3>
	
	<div class='panel'>";
  

if(!$_POST) {

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);
$id_result=$DB->Execute("select * from hosts where name='$host_name';");
while ($array_id = $id_result->FetchRow()) {
	$name="$array_id[nome]";

echo "<form  action='edit.php' method='post'>";
echo "<p><h6>Nome :  </h6>";
echo "<br><input type='text' name='name' size='50' value='$array_id[name]'";
echo "<p><p><h6>Endereço ip/hostname :  </h6>";
echo "<br><input type='text' name='address' size='50' value='$array_id[address]'>";
echo "<INPUT TYPE='hidden' NAME='id_host'  VALUE='$array_id[id]'>";
echo "<p><h6>Serviços Habilitados :  </h6><p><p>";

$id_result2=$DB->Execute("select * from hosts_services where id_host='$array_id[id]';");
while ($array_id2 = $id_result2->FetchRow()) {
	$servicename="$array_id2[service]";

	if($array_id2[service]=='imap')
		$imapok='checked';
	if($array_id2[service]=='http')
		$httpok='checked';
	if($array_id2[service]=='pop3')
		$pop3ok='checked';
	if($array_id2[service]=='smtp')
		$smtpok='checked';
		
	}
echo "
	<label for='http'>
  	<input type='checkbox' name='http' name='http' value='1' $httpok>
  	<span class='custom checkbox'></span> HTTP / WWW
	</label>
	<label for='imap'>
  	<input type='checkbox' name='imap' name='imap' value='1' $imapok>
  	<span class='custom checkbox'></span> IMAP
	</label>
	<label for='pop3'>
  	<input type='checkbox' name='pop3' name='pop3' value='1' $pop3ok>
  	<span class='custom checkbox'></span> POP3
	</label>
	<label for='smtp'>
  	<input type='checkbox' name='smtp' name='smtp' value='1' $smtpok>
  	<span class='custom checkbox'></span> SMTP
	</label>
	";

echo "<br><input type='submit' class='small green button' value='Alterar' border='0'>  <a href='del.php?id_host=$array_id[id]' class='small red button'>Remover Host</a>";

}

} else {


$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

$id_result2=$DB->Execute("select service from hosts_services where id_host='$id_host';");
while ($array_id2 = $id_result2->FetchRow()) {
	$servicename="$array_id2[service]";
	if($array_id2[service]=='imap')
		$imapok='checked';
	if($array_id2[service]=='http')
		$httpok='checked';
	if($array_id2[service]=='pop3')
		$pop3ok='checked';
	if($array_id2[service]=='smtp')
		$smtpok='checked';
}

if($_POST[name]){
$update_query=$DB->Execute("update hosts set name='$_POST[name]' where id='$id_host';");
$ok=1;
}

if($_POST[address]){
$update_query=$DB->Execute("update hosts set address='$_POST[address]' where id='$id_host';");
$ok=1;
}



if($_POST[imap]==1) {
		if($imapok!="checked") {
				$insert_query=$DB->Execute("insert into hosts_services values ('','$id_host','imap','','','0');");
				}
}
if(!$_POST[imap]) {
		if($imapok=="checked") {
				$insert_query=$DB->Execute("delete from hosts_services where id_host='$id_host' and service='imap';");
				}
}

if($_POST[smtp]==1) {
		if($smtpok!="checked") {
				$insert_query=$DB->Execute("insert into hosts_services values ('','$id_host','smtp','','','0');");
				}
}
if(!$_POST[smtp]) {
		if($smtpok=="checked") {
				$insert_query=$DB->Execute("delete from hosts_services where id_host='$id_host' and service='smtp';");
				}
}
if($_POST[pop3]==1) {
		if($pop3ok!="checked") {
				$insert_query=$DB->Execute("insert into hosts_services values ('','$id_host','pop3','','','0');");
				}
}
if(!$_POST[pop3]) {
		if($pop3ok=="checked") {
				$insert_query=$DB->Execute("delete from hosts_services where id_host='$id_host' and service='pop3';");
				}
}
if($_POST[http]==1) {
		if($httpok!="checked") {
				echo "incluido";
				$insert_query=$DB->Execute("insert into hosts_services values ('','$id_host','http','','','0');");
				}
}
if(!$_POST[http]) {
		if($httpok=="checked") {
				$insert_query=$DB->Execute("delete from hosts_services where id_host='$id_host' and service='http';");
				}
}


		
}	

if($ok==1) {
echo "<h3>Alterado com sucesso !!!</h3>";
echo "<br> <a href='index.php' class='small green button'>Ir para painel</a> ";
echo "<p><p>";	

}



echo "</div></div></div>";


echo "$footer";

?>



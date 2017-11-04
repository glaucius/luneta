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
require "include/comum.php";

echo "$header";


echo "<div class='row'> <div class='six columns'> <h3>Add</h3>

<div class='panel'>";


if(!$_POST) {

echo "<form  action='add.php' method='post'>";

echo "<h6>Nome do serviço :  </h6>"; echo "<br><input type='text'
name='nome' size='50'>"; echo "<p><h6>Hostname ou endereço IP :  </h6>";
echo "<br><input type='text' name='host' size='50'>"; echo "

<p><h6>Serviços disponíveis :  </h6> <p><p> <label for='pop3'> <input
type='checkbox' id='pop3' name='pop3' value='1'> <span class='custom
checkbox'></span> POP3 / Recebimento de Email </label> <label
for='http'> <input type='checkbox' name='http' name='http' value='1'>
<span class='custom checkbox'></span> HTTP / WWW </label> <label
for='smtp'> <input type='checkbox' id='smtp' name='smtp' value='1'>
<span class='custom checkbox'></span> SMTP / Envio de Email </label>
<label for='imap'> <input type='checkbox' id='imap' name='imap'
value='1'> <span class='custom checkbox'></span> IMAP / Recebimento de
Email </label>

";

echo "<br><input type='submit' class='small green button'
value='Adicionar'></form>";

} else {


$DB = NewADOConnection('mysql'); $DB->Connect($db_server, $db_user,$db_password, $db_database);

//echo "<br> $_SESSION[email]";

# Selecting the hosts and the services, and starting the monitor
//$add_result = $DB->Execute("insert into hosts values('',$_POST[nome],$_POST[host],$_SESSION[email]);");
$add_result=$DB->Execute("insert into hosts values('','$_POST[nome]','$_POST[host]','$_SESSION[email]');");

$id_result=$DB->Execute("select * from hosts where name='$_POST[nome]' and address='$_POST[host]';"); while ($array_id = $id_result->FetchRow()) { $id="$array_id[id]"; }

if($_POST[http]==1) { $add_http=$DB->Execute("insert into hosts_services values ('','$id','http','','','0');"); }

if($_POST[imap]==1) { $add_imap=$DB->Execute("insert into hosts_services values ('','$id','imap','','','0');"); }

if($_POST[pop3]==1) { $add_pop3=$DB->Execute("insert into hosts_services values ('','$id','pop3','','','0');"); }

if($_POST[smtp]==1) { $add_smtp=$DB->Execute("insert into hosts_services values ('','$id','smtp','','','0');"); }

echo "<h3>Adicionado com sucesso !!! </h3>";


echo "<br> <a href='index.php' class='small green button'>Ir para painel</a> "; echo "<p><p>"; }

echo "</div></div></div>";


echo "$footer";

?>



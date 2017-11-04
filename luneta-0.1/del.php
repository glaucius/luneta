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


echo "<div class='row'>
	  <div class='ten columns'>
	<h3>Deletar</h3>
	
	<div class='panel'>";


$id_host=$_GET[id_host];


if(!$_POST) {

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

$id_result=$DB->Execute("select * from hosts where id='$id_host';");
while ($array_id = $id_result->FetchRow()) {
	$name="$array_id[name]";
}
echo "<form  action='del.php' method='post'>";
echo "<H4> Tem certeza que deseja remover o host \" $name \" ????</h4>";
echo "<input type='hidden' name='id_host' value='$id_host'>";
echo "<br><input type='submit' class='small red button' value='Remover'>";

echo " <a href='index.php' class='small green button'> Voltar </a>   </form> ";


} else {

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);


$id_result=$DB->Execute("delete from hosts_services where id_host='$_POST[id_host]';");
$id_result=$DB->Execute("delete from hosts where id='$_POST[id_host]';");

echo "<h3>Removido com sucesso !!!</h3>";

echo "<br> <a href='index.php' class='small green button'>Ir para painel</a> ";
echo "<p><p>";	
}

echo "</div></div></div>";


echo "$footer";

?>



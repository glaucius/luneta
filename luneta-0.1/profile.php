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
	  <div class='six columns'>
	<h3>Profile</h3>
	
	<div class='panel'>";


// 	id	name	email	phone	password	admin
//			1	glaucius	glaucius@drivus.com.br	1181218715	4ccae67f2340b46db9e060990f34fc4a	1 Check All / Uncheck All With selected:    

if(!$_POST) {

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);
$id_result=$DB->Execute("select * from users where email='$_SESSION[email]';");
while ($array_id = $id_result->FetchRow()) {
	$name="$array_id[nome]";

echo "<form  action='profile.php' method='post'>";
echo "<p><h6>Nome :  </h6>";
echo "<br><input type='text' name='name' size='50' value='$array_id[name]'";
echo "<p><p><h6>Telefone :  </h6>";
echo "<br><input type='text' name='phone' size='50' value='$array_id[phone]'>";
echo "<p><h6>Email :  </h6>";
echo "<br><input type='text' name='email' size='50' value='$array_id[email]'>";
echo "<p><h6>Nova Senha :  </h6>";
echo "<br><input type='password' name='pass' size='50'>";
echo "<p><h6>Repetir Nova Senha :  </h6>";
echo "<br><input type='password' name='pass2' size='50'>";
echo "<br><p><p><input type='submit' class='small green button' value='Alterar'>";

}

} else {


$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

//echo "<br> $_SESSION[email]";

if($_POST[email]!=$_SESSION[email]) {
	$update_query=$DB->Execute("update users set email='$_POST[email]' where email='$_SESSION[email]';");
	$update_query=$DB->Execute("update hosts set email='$_POST[email]' where email='$_SESSION[email]';");
	$_SESSION[email]=$_POST[email];
	$ok=1;
}	

if($_POST[name]){
$update_query=$DB->Execute("update users set name='$_POST[name]' where email='$_SESSION[email]';");
$ok=1;
}

if($_POST[phone]){
$update_query=$DB->Execute("update users set phone='$_POST[phone]' where email='$_SESSION[email]';");
$ok=1;
}

if($_POST[pass]) {
	//$update_query=$DB->Execute("update users set email='$_POST[email]' where email='$_SESSION[email]';");
	//$update_query=$DB->Execute("update hosts set email='$_POST[email]' where email='$_SESSION[email]';");
	//$_SESSION[email]=$_POST[email];
	if($_POST[pass]!=$_POST[pass2]) {
		echo "Senhas informadas não conferem....";
		echo "<br> <a href='index.php' class='small green button'>Voltar</a> ";
		echo "<p><p>";
		$ok=0;
	}	else {
	$update_query=$DB->Execute("update users set password=md5('$_POST[pass]') where email='$_SESSION[email]';");
	$ok=1;
	}
		
}	

if($ok==1) {
echo "<h3>Alterado com sucesso !!!</h3>";
}

echo "<br> <a href='index.php' class='small green button'>Ir para painel</a> ";
echo "<p><p>";	
}

echo "</div></div></div>";


echo "$footer";

?>



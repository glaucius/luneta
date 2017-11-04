<?
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
require('include/comum.php');


echo "$header_login";

?>

<p><div class='row'>
<div class='two columns'></div>
<div class='eight columns'>
<div class="panel">
<div id="loginform">
<center>
<form action="login_vai.php" method="post">

<h4>Email</h4><p> <input type="text" name="login"><p>
<h4>Senha </h4><p> <input type="password" name="senha"><p>
<input type="submit" value="Login" class='small green button'> 
</form></center>
</div>
</div>
</div>
</div>

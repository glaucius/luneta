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

echo "<div id='loaddiv'>";

include_once('loading.php');

echo "</div>"; 

echo "$footer";

?>



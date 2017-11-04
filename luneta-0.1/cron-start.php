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

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

# Selecting the hosts and the services, and starting the monitor
$rs = $DB->Execute("select id,address,email from hosts");
while ($array = $rs->FetchRow()) {
//    print_r($array[address]);
    system("php $full_path/cron-script.php $array[address] $array[id] $array[email] &");
}

//$ok = $DB->Execute("update atable set aval = 0");
//if (!$ok) mylogerr($DB->ErrorMsg());


?>

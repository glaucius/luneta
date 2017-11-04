<?
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

echo "<div class='row'>
	  <div class='eight columns'>
	<h3>Dashboard</h3>
	<div class='row'>
	<div class='twelve columns'>
	<div class='panel'>";

$DB = NewADOConnection('mysql');
$DB->Connect($db_server, $db_user, $db_password, $db_database);

//echo "<br> $_SESSION[email]";

echo "<table class='table'><tr><td style='vertical-align:middle; width: 200px;'><h6><img src='images/host.png'> Host</h6></td>";
echo "<td style='vertical-align:middle'><h6>Service</h6></td><td style='vertical-align:middle'><h6><img src='images/lastcheck.png'> Last Check</h6></td>";
echo "<td style='vertical-align:middle'><h6>Status</h6></td></tr></table>";

# Selecting the hosts and the services, and starting the monitor
$rs_hosts = $DB->Execute("select * from hosts where email='$_SESSION[email]';");
while ($array_hosts = $rs_hosts->FetchRow()) {

echo "<table class='table'>";

$loopcounter=1;

	$rs_services = $DB->Execute("select * from hosts_services where id_host=$array_hosts[id];");
	$numservices=$rs_services->RecordCount();
	while ($array_services = $rs_services->FetchRow()) {

	if($loopcounter==1) {
		echo "<tr><td style='vertical-align:middle; width: 200px;' align='left' rowspan=$numservices> &nbsp&nbsp <a href='edit.php?name=$array_hosts[name]'><h6>$array_hosts[name] </a></h6></td>";
		$newline="";
		$loopcounter++;
	} else {
			$newline="<tr>";
	}

	echo "$newline<td>$array_services[service]</td><td> $array_services[lastcheck]</td>";

	if($array_services[status]==1) {
		echo "<td> <img src='images/online.png'> </td>";
		$online++;
	}
	if($array_services[status]==0) {
		echo "<td> <img src='images/offline.png'> </td>";
		$offline++;
	}


	}

echo "</table>";
}

$totalhosts=$online+$offline;
$onlineok=$online*100/$totalhosts;

echo "							
							
							
						</div>
					</div>
				</div>
				
				
				
			</div>
		
	
		
			
			<div class='four columns'>
				<h3>Disponibilidade</h3>
				
				<div class='row'>
					<div class='twelve columns'>";
					
					
	include('chart.php');

	echo "<br> <a href='add.php' class='small green button'>Adicionar Host</a> ";

echo "							
						
					</div>
				</div>
				
				
			</div>
		</div>
		
		
";

?>

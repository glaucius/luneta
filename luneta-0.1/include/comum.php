<?
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
include_once('include/config.inc.php');
include_once("include/lang/$lang.php");
include_once('include/adodb5/adodb.inc.php');

 
mysql_connect($db_server, $db_user, $db_password);
// Mysql Database
mysql_select_db($db_database);


// header e footer

$header = "<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class='no-js lt-ie9 lt-ie8 lt-ie7' lang='en'> <![endif]-->
<!--[if IE 7]>    <html class='no-js lt-ie9 lt-ie8' lang='en'> <![endif]-->
<!--[if IE 8]>    <html class='no-js lt-ie9' lang='en'> <![endif]-->
<!--[if gt IE 8]><!--> <html lang='en'> <!--<![endif]-->
<head>
	<meta charset='utf-8' />
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name='viewport' content='width=device-width' />
	
	<title>Luneta</title>
  
	<!-- Included CSS Files -->
	<!-- These files are being included - to omit files, move them to the block below. -->

	<link rel='stylesheet' href='stylesheets/globals.css'>
	<link rel='stylesheet' href='stylesheets/ui.css'>
	<link rel='stylesheet' href='stylesheets/forms.css'>
	<link rel='stylesheet' href='stylesheets/orbit.css'>
	<link rel='stylesheet' href='stylesheets/reveal.css'>
	<link rel='stylesheet' href='stylesheets/app.css'>
	<link rel='stylesheet' href='stylesheets/mobile.css'>

	<!--[if lt IE 9]>
		<link rel='stylesheet' href='public/css/ie.css'>
	<![endif]-->

	<!-- These files are not being included.
	
		# <link rel='stylesheet' href='public/css/example.css'>
		# 
		# 
		# 
	
	-->
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
	<![endif]-->
	
	<script src='http://ajax.googleapis.com/ajax/libs/jquery/1.3.0/jquery.min.js'></script>
	 <script>
	var auto_refresh = setInterval(
	function()
	{
	$('#loaddiv').fadeOut('slow').load('loading.php').fadeIn('slow');
	}, 10000);
	</script>


</head>
<body>

	<!-- container -->
	<div class='container'>
			<div class='row'>
				<div class='logo'>
				<img src='images/luneta-logo.png'>
				</div>
				<div class='menu'>
				<a href='index.php' class='small blue button'>Home</a>
				<a href='add.php' class='small blue button'>$add</a>
				<a href='profile.php' class='small blue button'>$profile</a>
				<a href='sair.php' class='small blue button'>$logout</a>
			
				</div>
			</div>
		
";


$header_login = "<!DOCTYPE html>

<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7]> <html class='no-js lt-ie9 lt-ie8 lt-ie7' lang='en'> <![endif]-->
<!--[if IE 7]>    <html class='no-js lt-ie9 lt-ie8' lang='en'> <![endif]-->
<!--[if IE 8]>    <html class='no-js lt-ie9' lang='en'> <![endif]-->
<!--[if gt IE 8]><!--> <html lang='en'> <!--<![endif]-->
<head>
	<meta charset='utf-8' />
	
	<!-- Set the viewport width to device width for mobile -->
	<meta name='viewport' content='width=device-width' />
	
	<title>Luneta</title>
  
	<!-- Included CSS Files -->
	<!-- These files are being included - to omit files, move them to the block below. -->

	<link rel='stylesheet' href='stylesheets/globals.css'>
	<link rel='stylesheet' href='stylesheets/ui.css'>
	<link rel='stylesheet' href='stylesheets/forms.css'>
	<link rel='stylesheet' href='stylesheets/orbit.css'>
	<link rel='stylesheet' href='stylesheets/reveal.css'>
	<link rel='stylesheet' href='stylesheets/app.css'>
	<link rel='stylesheet' href='stylesheets/mobile.css'>

	<!--[if lt IE 9]>
		<link rel='stylesheet' href='public/css/ie.css'>
	<![endif]-->

	<!-- These files are not being included.
	
		# <link rel='stylesheet' href='public/css/example.css'>
		# 
		# 
		# 
	
	-->
	
	<!-- IE Fix for HTML5 Tags -->
	<!--[if lt IE 9]>
		<script src='http://html5shiv.googlecode.com/svn/trunk/html5.js'></script>
	<![endif]-->

</head>
<body>

	<!-- container -->
	<div class='container'>
			<div class='row'>
				<div class='logo'>
				<img src='images/luneta-logo.png'>
				</div>
				
			</div>
		
";


$footer="	

		
	<div class='bottom'>
	
	<div class='row'>
				<div class='logo'>
				<img src='images/luneta-logo.png'>
				</div>
				<div class='menu'>
				<a href='#' class='small blue button'>Home</a>
				<a href='#' class='small blue button'>Add</a>
				<a href='#' class='small blue button'>Profile</a>
				<a href='#' class='small blue button'>Logout</a>
			
				</div>
			</div>
	
	</div>
		
		
	</div><!-- container -->
	
	

	<!-- Included JS Files  -->
	<!-- These files are being included - to omit files, move them to the block below. -->

	<script src='javascripts/jquery-1.5.1.min.js'></script>
	<script src='javascripts/jquery.reveal.js'></script>
	<script src='javascripts/jquery.orbit-1.3.0.js'></script>
	<script src='javascripts/forms.jquery.js'></script>
	<script src='javascripts/jquery.customforms.js'></script>
	<script src='javascripts/jquery.placeholder.min.js'></script>
	<script src='javascripts/app.js'></script>
	
	
	<!-- These files are not being included.
		# <script src='public/js/example.js'></script>
		# 
		# 
		# 
	-->
	
</body>
</html>	";



?>

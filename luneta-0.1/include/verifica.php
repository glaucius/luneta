
<?php
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
// Inicia sessões

session_start();


// Verifica se existe os dados da sessão de login

if(!isset($_SESSION["id_usuario"]) || !isset($_SESSION["nome_usuario"]))

{

    // Usuário não logado! Redireciona para a página de login

    header("Location: login.php");

    exit;

}

?>



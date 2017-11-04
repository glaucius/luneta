
<?php
/*
Este trabalho foi licenciado com a Licença Creative Commons
Atribuição - Uso Não Comercial - Partilha nos Mesmos Termos 3.0 Não
Adaptada. Para ver uma cópia desta licença, visite
http://creativecommons.org/licenses/by-nc-sa/3.0/ ou envie um pedido por
carta para Creative Commons, 444 Castro Street, Suite 900, Mountain
View, California, 94041, USA.
*/
// Conexão com o banco de dados

require "include/comum.php";



// Inicia sessões

session_start();



// Recupera o login

$login = isset($_POST["login"]) ? addslashes(trim($_POST["login"])) : FALSE;

// Recupera a senha, a criptografando em MD5

$senha = isset($_POST["senha"]) ? md5(trim($_POST["senha"])) : FALSE;



// Usuário não forneceu a senha ou o login

if(!$login || !$senha)

{

    echo "Você deve digitar sua senha e login!";

    exit;

}



/**

* Executa a consulta no banco de dados.

* Caso o número de linhas retornadas seja 1 o login é válido,

* caso 0, inválido.

*/

$SQL = "SELECT id, name, email, phone, password

        FROM users

        WHERE email = '" . $login . "'";

$result_id = @mysql_query($SQL) or die("Erro no banco de dados!");

$total = @mysql_num_rows($result_id);



// Caso o usuário tenha digitado um login válido o número de linhas será 1..

if($total)

{

    // Obtém os dados do usuário, para poder verificar a senha e passar os demais dados para a sessão

    $dados = @mysql_fetch_array($result_id);



    // Agora verifica a senha

    if(!strcmp($senha, $dados["password"]))

    {

        // TUDO OK! Agora, passa os dados para a sessão e redireciona o usuário

        $_SESSION["id_usuario"]   = $dados["id"];

        $_SESSION["nome_usuario"] = stripslashes($dados["name"]);
        
        $_SESSION["email"] = stripslashes($dados["email"]);

        $_SESSION["permissao"]    = $dados["admin"];

        header("Location: index.php");

        exit;

    }

    // Senha inválida

    else

    {

        echo "Senha inválida!";

        exit;

    }

}

// Login inválido

else

{

    echo "O login fornecido por você é inexistente!";

    exit;

}

?>



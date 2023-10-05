<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if ($_SESSION["permissao"]){
    $idprofessor = $_GET["id"];
    $nomeProfessor = $_SESSION["nome"];
    
    ?>
<!DOCTYPE html>
<html>
    <head>
        <title>SOLAR - Sistema online de agendamento de recursos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <div class="container_principal">
            <div class="cabecalho" align="center">
                <div class="logo"><img src="../Imagens/logo1.png" width="90" alt=""/>
                    <br><img src="../Imagens/etec1.png" width="120"  align="center" alt=""/></div>
                            
                <br><br><img src="../Imagens/solar.1.png" width="500" alt=""/>
                <img src="../Imagens/cps.png" align="right" width="120" alt=""/><br>
                <img src="../Imagens/gov.png" align="right" width="120" alt=""/>
            </div>

            <br>

            <hr color="beige" />
            <hr color="beige" />

            <div class="ola">Olá Adm <a href="../logoff.php" id="linkLogout">Sair</a></div>

            <nav id="menu">
                <ul>
                    <li><a href="../adm/adm.php">Administrador</a></li>
                    <li><a href="../senha/formudarsenha.php">Alterar Senha</a></li>
                    <li><a href="../contato.php">Contato</a></li>
                </ul>
            </nav>

            <hr color="beige" >
            <hr color="beige" >

                <br>

            <div id="menu2" align="center">
                <ul>
                    <li><a href="cadastroprof.php">Cadastrar professor</a></li>
                    <li><a href="listarprof.php">Listar professores</a></li>
                    <li><a href="cadastrorec.php">Cadastrar recurso</a></li>
                    <li><a href="listarrec.php">Listar recursos</a></li>
                </ul>
            </div>   

            <br>
<?php

    require_once "../conexao/conexao.php";
    $conn = conectar();
    $sql = "SELECT * FROM usuarios WHERE usu_cod = $idprofessor";
  
    $resultado = $conn->query($sql);
       
    foreach ($resultado as $row){
        $idprofessor = $row ['usu_cod'];
        $nome        = $row ['usu_nome'];
        $email       = $row ['usu_login'];
        $senha       = $row ['usu_senha'];
        
}



?>

        <table>    
            <form action="alterarprof.php" name="form_alter_prof.php" method="get">
                <thead>
                    <tr>
                        <th align="center" colspan="2">Alteração de Professores</th>
                    </tr>
                </thead>    
                
                <tbody>
                    <tr>
                        <td align="left">ID:</td>
                        <td><input type="hidden" name="id" value="<?= $idprofessor ?>" required/></td>
                    </tr>
                    <tr>
                        <td align="left">Nome:</td>
                        <td><input type="text" name="nome" value="<?= $nome ?>" required/></td>
                    </tr>
                    <tr>
                        <td align="left">Login:</td>
                        <td><input type="text" name="email" value="<?= $email ?>" required/></td>
                    </tr>
                    <tr>
                        <td align="left">Senha:</td>
                        <td><input type="password" name="senha" value="<?= $senha ?>" required/></td>
                    </tr>
                                                          
                    <tr>
                        <td></td>
                        <td>
                        <input type="submit" value="Gravar" name="gravar"/>  
                        </td>
                    </tr>  
                                
                </form>
            </tbody>
        </table>
    </div>
        <?php
              require_once('../versao.php');
            ?>
        <div class="footer">
            © Copyright 2016 Sistema Solar - <?php echo $versao; ?>
        </div>
    </body>
</html>
<?php
    
}else{
    header("Location: ../adm/listarprof.php");
}
  

<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if (isset($_SESSION["permissao"]) && $_SESSION["permissao"] == 0) {
    $idProfessor = $_SESSION["usuario"];
    $nomeProfessor = $_SESSION["nome"];
    
    ?>
<!DOCTYPE html>
<html>
        <head>

                 
            <title>SOLAR - Sistema online de agendamento de recursos</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../jquery/jquery-1.11.2.js" type="text/javascript"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
            <script src="../jquery/sweetalert.min.js"></script> 
            <link rel="stylesheet" type="text/css" href="../css/sweetalert.css">
                      
            

           </div>
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

    <div class="ola">Olá <?= $nomeProfessor ?> <a href="../logoff.php" id="linkLogout">Sair</a></div>

            

            <nav id="menu">
                <ul>
                    <li><a href="../prof/prof.php">Calendário</a></li>
                    <li><a href="../prof/formudarsenha.php">Alterar Senha</a></li>
                    <li><a href="../prof/contato.php">Contato</a></li>
                </ul>
            </nav>

            <hr color="beige" >
            <hr color="beige" >
            <br>
             <table border="0">
                <tbody>
                    <tr>
                        <th align="left">Alteração de Senha</th>
                        <form action="" name="formudarsenha.php" method="post">
                    </tr>
                    <tr>                      
                        <td align="left">Nova Senha:</td><td><input type="password" name="novasenha" value=""  required/></td>
                    </tr>
                    <tr>
                        <td align="left">Repetir senha:</td><td><input type="password" name="repetsenha" value=""  required/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                    <input type="submit"  value="Gravar" name="gravar" />
                        </td>
                    </tr>  
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
    
    <?php
        if (isset($_SESSION['usuario']) && isset($_POST['novasenha'])) {

             $cod   =$_SESSION['usuario']; //puxa o codigo do usuario
             $novasenha =$_POST['novasenha']; //puxa a nova senha do formulario 
             $repetsenha =$_POST['repetsenha'];

    if ($novasenha == $repetsenha){

        echo "<script>swal('Senha Alterada com Sucesso')</script>";
    }else{
         echo "<script>swal('Verifique a senha')</script>";

    }
    
    
  
     require_once "../conexao/conexao.php";


    $conn = conectar();      
    $sql =  "UPDATE usuarios SET usu_senha = ? WHERE usu_cod = $cod";
             //header("Location: ../prof/formudarsenha.php");
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$novasenha);
    
    
    
  
    
$comando->execute();
$conn = null;

       
            
        }

   ?> 





    </html>
    <?php
    
} else {
    header("Location: ../index.php");
}
    
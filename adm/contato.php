<!DOCTYPE html>

<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if (isset($_SESSION["permissao"]) && $_SESSION["permissao"] == 1) {
    $idProfessor = $_SESSION["usuario"];
    $nomeProfessor = $_SESSION["nome"];

?>

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
                    <li><a href="../adm/adm.php">Administrador</a></li>
                    <li><a href="../senha/formudarsenha.php">Alterar Senha</a></li>
                    <li><a href="../adm/contato.php">Contato</a></li>
                </ul>
            </nav>


            <hr color="beige" >
            <hr color="beige" >
            <br>

    <img src="../Imagens/tel1.png" id="imgtel" alt=""/>


            <table border="0">
            <form action="" method="post">
    <thead>
        <tr>
            <th align="center" colspan="2">Entre em contato</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Nome:</td>
            <td><input text="text" name="nome"/></td>
        </tr>
        <tr>
            <td>Email:</td>
            <td><input type="text" name="email"/></td>
        </tr>
                <tr>
            <td>Assunto:</td>
            <td><select name="assunto">
                 <option selected="selected"> Selecione o Assunto</option>
                 <option value="parceria">Parceria</option>
                 <option value="reclamacao">Reclamação</option>
                 <option value="sugestao">Sugestão</option>
                 <option value="suporte">Suporte</option>
                 <option value="outro">Outro</option>
                </select></td>
        </tr>
        <tr>
            <td>Mensagem:</td>
            <td><textarea name="msg" cols="30" rows="10"></textarea></td>
        </tr>
        <tr>
            <td></td>
            <td><input type="hidden" name="acao" value="env-cont"/>
                <input type="submit" value="Enviar"/></td>
        </tr>
    </tbody>
            </form>
            </table>
            
        <?php
            if (isset($_POST['email']) && isset($_POST['nome'])){
                $nome    = strip_tags(trim(ucfirst($_POST['nome'])));
                $email   = strip_tags(trim($_POST['email']));
                $assunto = strip_tags(trim($_POST['assunto']));
                $msg     = strip_tags(trim(ucwords($_POST['msg'])));

                 $conn = conectar();
              
                    $sql= "INSERT INTO contato (nome, email, assunto, mensagem) VALUES (?,?,?,?)";
                    $comando = $conn->prepare($sql);
                    $comando->bindvalue(1,$nome);
                    $comando->bindvalue(2,$email);
                    $comando->bindvalue(3,$assunto);
                    $comando->bindvalue(4,$msg);
                    $comando->execute();
                    $conn = null;

        if($sql){
            echo '<script>alert("Mensagem enviada com sucesso");</script>';
         
    }else{
        }  
        } 
?>
            <br><br>
            <br><br>
        
        <div align="center">
            <table cellspacing="2" class="borda">
    <thead>
        <tr>
            <th align="center" colspan="2">Equipe Desenvolvedora</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td>Ana Carolina Kojima Sena </td>
            <td>Luiz Paulo Vieira</td>
        </tr>
        <tr>
            <td align="center" colspan="2">E-mail: contato@agsolar.com.br</td>
            <td></td>
        </tr>
    </tbody>
            </table>
    </div>
  <?php }
            ?>            
        </div>
        <?php
              require_once('../versao.php');
            ?>
        <div class="footer">
            © Copyright 2016 Sistema Solar - <?php echo $versao; ?>
        </div>
    </body>
</html>


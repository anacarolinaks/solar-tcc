<!DOCTYPE html>
<html>
<?php

     
  if(isset($_POST['recnome']) && isset($_POST['rectipo'])){

  

    $nomerec = $_POST["recnome"];
    $tiporec=$_POST["rectipo"];
    
    require_once "../conexao/conexao.php";
    $conn = conectar();
    $sql = "INSERT INTO recurso (rec_nome, rec_tipo) VALUES (?,?)";
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$nomerec);
    $comando->bindvalue(2,$tiporec);
    
    $comando->execute();
$conn = null;
echo "<script>swal('Cadastrou')</script>";

}
?>
    <head>
        <title>SOLAR - Sistema online de agendamento de recursos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            <br><br>
            <h3>Cadastro de Recursos</h3>
             <form action="" name="cadastrorec.php" method="post">
            <form name="cadastroprof">
                <table>
                    <tr><td>Nome</td><td><input type="text" name="recnome" value="" required /></td></tr>
                    <tr><td>Tipo</td><td><select name="rectipo">
                        <option value="1">Laboratorio</option>
                        <option value="2">Kit Multimidias</option>
                    </select></td></tr>

                    <tr><td></td><td> <input type="submit" value="Gravar" name="gravar" required /></td></tr>
                </table>
            </form>
            <br><br>
            <br><br>
            <br><br>
            
        </div>
            <?php
              require_once('../versao.php');
            ?>
        <div class="footer">
            © Copyright 2016 Sistema Solar - <?php echo $versao; ?>
        </div>

    </body>
</html>





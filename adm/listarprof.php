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
                        
            <h3>Lista de Professores</h3>
            
            <table align="center" border="1">

                <thead>
                    <tr>
                        
                        <th class="listar">ID</th>
                        <th class="listar">Nome</th>
                        <th class="listar">Login</th>
                        
                        <th class="listar"> Alterar/Inativar</th>
               
                    </tr>
                </thead>
                <tbody>
            
                    <?php

    require_once "../conexao/conexao.php";
    $conn = conectar();
    $sql = "SELECT * FROM usuarios";
    $resultado = $conn->query($sql);
    
    foreach ($resultado as $row){
        $idprofessor   = $row['usu_cod'];
        $nome  = $row ['usu_nome'];
        $email = $row ['usu_login'];
        $senha = $row ['usu_senha'];


    echo "<tr>";
        echo"<td>$idprofessor</td>";
        echo "<td>$nome</td>";
        echo "<td>$email</td>";
        
        
          echo "<td><a href='form_alter_prof.php?id=$idprofessor'>Alterar</a></td>";
    }
?>               
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

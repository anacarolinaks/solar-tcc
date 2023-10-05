<!DOCTYPE html>
<?php
    session_start();
        if($_SESSION["permissao"]==0){
            header("Location: ../prof/prof.php");
        }else{

        }
?>
<html>
    <head>
        <title>SOLAR - Sistema online de agendamento de recursos</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>

        <script>
                $(document).ready(function () {

                    $(".vazio").click(function () {
                        var dataF = $(this).attr("data");
                        var data=$(this).attr("data2");
                        var recurso=$(this).attr("recurso");
                        var horario=$(this).attr("horario");
                        var td = $(this);
                        $("#msg").text("Confirma a reserva para o dia " + dataF);
                        $("#dialog-confirm").dialog({
                            resizable: false,
                            height: 200,
                            modal: true,
                            buttons: {
                                "Confirmar": function () {
                                    $(this).dialog("close");
                                    $("#carregando").show();
                                    $.post("incluirRecurso.php",
                                            {
                                                data: data,
                                                recurso: recurso,
                                                horario: horario
                                           //     usuario: usuario,
                                            },
                                    function (status) {
                                        //alert("Funcionou");
                                        window.location.reload(); // refresh automatico
                                        dialog.dialog("close");
                                        $("msg").text("Atualizando");
                                        //window.location.reload();
                                    });
                                    dialog.dialog("close");
                                    td.removeClass("vazio");
                                    td.addClass("ocupado");
                                   // td.text("Nome da Pessoa");

                                },
                                Cancel: function () {
                                    $(this).dialog("close");
                                }
                            }
                        });

                    });
                });
            </script>

        <div id="dialog-confirm" title="Alerta">
            <p id="msg" style="font-size: 12px;"></p>
        </div>

    </head>
    <body>
    <?php
        if (!isset($_POST['data'])) {
            $data = date("Y-m-d");
        } else {
            $data = $_POST['data'];
            //echo $_POST['data'];
        }
        if (!isset($_POST['tipo'])) {
            $tipo = 1;
        } else {
            $tipo = $_POST['tipo'];
        }
        if (!isset($_POST['page'])) {
            $page = 1;
        } else {
            $page = $_POST['page'];
        }
        $outroTipo = $tipo % 2 + 1;
        $diaSemana = date("N", strtotime($data));
        $i = 0;
//Volta a data até encontrar a segunda
        while ($diaSemana > 1) {
            $data = date('Y-m-d', strtotime($data . ' - 1 days'));
            $diaSemana = date("w", strtotime($data));
            //  echo "$diaSemana ";
        }
        $de = $data;
        //echo $de;
        $proximo = date('Y-m-d', strtotime($data . ' + 7 days'));
        $anterior = date('Y-m-d', strtotime($data . ' - 7 days'));
        ?>

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
                    <li><a href="../adm/contato.php">Contato</a></li>
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
            if ($tipo == 1) {
                $textoTipo = "Kits";
            } else {
                $textoTipo = "Agendamento de Laboratórios";
            }
            ?>
    <br>
            <div align="center">
            <form action="adm.php" method="post" id="alinham1">
                <a href="javascript:;" onclick="parentNode.submit();"><img src="../Imagens/kits.png" alt=""/></a>
                <input type="hidden" name="data" value="<?= $de ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="tipo" value="<?= $outroTipo ?>"/>
            </form>
            <form action="adm.php" method="post" id="alinham1">
                <a  href="javascript:;" onclick="parentNode.submit();"><img src="../Imagens/lab.png" alt=""/></a>
                <input type="hidden" name="data" value="<?= $de ?>"/>
                <input type="hidden" name="page" value="<?= $page ?>"/>
                <input type="hidden" name="tipo" value="<?= $outroTipo ?>"/>
            </form>
            </div>
            <br>
            <?php
            if ($page == 1) {///aqui
                ?>
                <form action="adm.php" method="post" id="alinham2">
                    <a href="javascript:;" onclick="parentNode.submit();"><img src="../Imagens/prox.png" alt=""/></a>
                    <input type="hidden" name="data" value="<?= $proximo ?>"/>
                    <input type="hidden" name="page" value="<?= $page + 1 ?>"/>
                    <input type="hidden" name="tipo" value="<?= $tipo ?>"/>
                </form>
                <?php
            } else {
                ?>
                <form action="adm.php" method="post" id="alinham2">
                    <a href="javascript:;" onclick="parentNode.submit();"><img src="../Imagens/ant.png" alt=""/></a>
                    <input type="hidden" name="data" value="<?= $anterior ?>"/>
                    <input type="hidden" name="page" value="<?= $page - 1 ?>"/>
                    <input type="hidden" name="tipo" value="<?= $tipo ?>"/>
                </form>
                <?php
            }
            require_once('../conexao/conexao.php');
            $conn = conectar();
            $sql = "select * from recurso where rec_tipo=" . $tipo;
            $resultado = $conn->query($sql);

            foreach ($resultado as $row) {
                $tipo = $row ['rec_tipo'];
                $nome = $row ['rec_nome'];
                $codRecurso = $row ['rec_cod'];
                ?>
                <table border="2" cellspacing="1" style="margin-top: 30px">
                    <thead>
                        <tr>
                            <th class="agendath" colspan="6"><?php echo $nome; ?></th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>     
                        <td></td>
                            <?php
                            $data = $de;
                                //Exibe os dias da semana após segunda

                            for ($i = 0; $i < 5; $i++) {
                                //echo date('Y-m-d', strtotime("$data  +  $i days"))."<br>";
                                $dataF = date('d/m/Y', strtotime($data));
                                $data = date('Y-m-d', strtotime("$data  + 1 days"));
                                $ds = $i + 2;
                                echo "<td class='tamanho'> $ds ª Feira<br> $dataF </td>";
                            }
                            $ate = $data;
                            $sql = "select * from reserva,usuarios,recurso where reserva.usu_cod = usuarios.usu_cod and reserva.rec_cod = recurso.rec_cod and res_data between '$de' and '$ate'";


                            for ($i = 1; $i < 3; $i++) {
                                echo "<tr>";
                                echo "<td class='agenda'>" . $i . " ª aula</td>";
                                //
                                for ($j = 0; $j < 5; $j++) {
                                    $data = date('d/m/Y', strtotime("$de + $j days"));
                                    $data2 = date('Y-m-d', strtotime("$de + $j days"));
                                    $rs = $conn->query($sql);
                                    $ocupado = false;
                                    if ($rs->rowCount() > 0) {
                                        
                                        foreach ($rs as $linha) {
                                            $horario = $linha['res_horario'];
                                            $rec = $linha['rec_cod'];
                                            $dia = $linha['res_data'];
                                            $professor = $linha['usu_nome'];
                                            if ($dia == $data2 && $rec == $codRecurso && $horario == $i) {
                                                echo "<td class='ocupado'>$professor</td>";
                                                $ocupado=true;
                                                break;
                                            } 
                                        }
                                        if(!$ocupado){
                                                echo "<td class='vazio' data='$data' data2='$data2' recurso='$codRecurso' horario='$i'></td>";
                                            
                                        }
                                    } else {
                                        echo "<td class='vazio' data='$data' data2='$data2' recurso='$codRecurso' horario='$i'></td>";
                                    }
                                }
                                //
                                echo "</tr>";
                            }
                            ?>
                        </tr>

                    </tbody>
                </table>
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

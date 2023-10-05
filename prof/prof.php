<!DOCTYPE html>
<?php
//error_reporting(E_ERROR | E_WARNING | E_PARSE);
session_start();

if (isset($_SESSION["permissao"]) && $_SESSION["permissao"] == 0) {
    $idProfessor = $_SESSION["usuario"];
    $nomeProfessor = $_SESSION["nome"];
    ?>
    <html>
        <head>
            <title>SOLAR - Sitema online de agendamento de recursos</title>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <script src="../jquery/jquery-1.11.2.js" type="text/javascript"></script>
            <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
            <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
            <link href="../css/estilo.css" rel="stylesheet" type="text/css"/>
            <!--  <link rel="stylesheet" href="https://jqueryui.com/resources/demos/style.css">-->

            <script>
                $(document).ready(function () {

                    $(".vazio").click(function () {
                        var dataF = $(this).attr("data");
                        var data = $(this).attr("data2");
                        var recurso = $(this).attr("recurso");
                        var horario = $(this).attr("horario");
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
                    
                    
                    
                    $(".minhaReserva").click(function () {
                        var codigoReserva = $(this).attr("idRes");
                        var td = $(this);
                        $("#msg").text("Deseja Excluir a sua reserva para esse Dia? " );
                        $("#dialog-confirm").dialog({
                            resizable: false,
                            height: 220,
                            width: 320,
                            modal: true,
                            buttons: {
                                "Confirmar": function () {
                                    
                                    $(this).dialog("close");
                                    $("#carregando").show();
                                    $.post("excluirRegistro.php",
                                            {
                                                idReserva: codigoReserva,
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

            <div class="ola">Olá <?= $nomeProfessor ?> <a href="../logoff.php" id="linkLogout">Sair</a></div>

            <nav id="menu">
                <ul>
                <li><a href="../prof/formudarsenha.php">Alterar Senha</a></li>
                <li><a href="../contato.php">Contato</a></li>
                </ul>
            </nav>

            <hr color="beige" >
            <hr color="beige" >
            <br>

            <?php
            if ($tipo == 1) {
                $textoTipo = "<img src='../Imagens/kits.png'/>";
            } else {
                $textoTipo = "<img src='../Imagens/lab.png' />";
            }
            ?> 

            <div class="divmenu" align="center">

                <form action="prof.php" method="post" id="alinham1">
                    <a href="javascript:;" onclick="parentNode.submit();"><?= $textoTipo ?></a>
                    <input type="hidden" name="data" value="<?= $de ?>"/>
                    <input type="hidden" name="page" value="<?= $page ?>"/>
                    <input type="hidden" name="tipo" value="<?= $outroTipo ?>"/>
                </form>

            </div>

            <br>
            <div class="divmenu" align="center">
                <?php
                $data2 = date('d/m/Y', strtotime($data));
                $de2 = $data2;

                $ate2 = date('d/m/Y', strtotime($data . ' + 4 days'));
                ?>

                <h3>Calendário da Semana (<?php echo "$de2 até $ate2"; ?>)</h3>
            </div>
            <br>

            <br>

  <br>
<div class="excluir"> * Para excluir clique na reserva.</div><br>  
        
            <?php
            if ($page == 1) {///aqui
                ?>
                <form action="prof.php" method="post" id="alinham2">
                    <a href="javascript:;" onclick="parentNode.submit();"><img src="../Imagens/prox.png" alt=""/></a>
                    <input type="hidden" name="data" value="<?= $proximo ?>"/>
                    <input type="hidden" name="page" value="<?= $page + 1 ?>"/>
                    <input type="hidden" name="tipo" value="<?= $tipo ?>"/>
                </form>
                <?php
            } else {
                ?>
                <form action="prof.php" method="post" id="alinham2">
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
                            <th id="agendath" colspan="6"><?php echo $nome; ?></th>
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

                                for ($j = 0; $j < 5; $j++) {
                                    $data = date('d/m/Y', strtotime("$de + $j days"));
                                    $data2 = date('Y-m-d', strtotime("$de + $j days"));
                                    $rs = $conn->query($sql);
                                    $ocupado = false;
                                    if ($rs->rowCount() > 0) {

                                        foreach ($rs as $linha) {
                                            $codProf = $linha['usu_cod'];
                                            $horario = $linha['res_horario'];
                                            $rec = $linha['rec_cod'];
                                            $dia = $linha['res_data'];
                                            $professor = $linha['usu_nome'];
                                            $codigoReserva = $linha['res_cod'];
                                            if ($dia == $data2 && $rec == $codRecurso && $horario == $i) {
                                                if ($codProf == $idProfessor) {
                                                    echo "<td class='minhaReserva' idRes='$codigoReserva'>$professor</td>";
                                                } else {
                                                    echo "<td class='ocupado'>$professor</td>";
                                                }
                                                $ocupado = true;
                                                break;
                                            }
                                        }

                                        if (!$ocupado) {
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
            <br>

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
} else {
    header("Location: ../index.php");
}
?>


<?php

require './conexao/conexao.php';

if (isset($_POST['acessar'])) {

    //pegar os dados do formulario
    $usu_login = trim($_POST['Login']);
    $usu_senha = trim($_POST['senha']);
    //$usu_adm = addslashes(trim($_POST['nivel']));


    if (!empty($usu_login) AND ! empty($usu_senha)) {
        //se nao estivar vazio nenhum campo continua com a instrução
        $pdo = conectar();
        $sql = "SELECT * FROM usuarios WHERE usu_login = ? AND usu_senha = ? ";
        //$verifica = $db->prepare($sql);
        $verifica = $pdo->prepare($sql);
        $verifica->bindValue(1, $usu_login, PDO::PARAM_STR);
        $verifica->bindValue(2, $usu_senha, PDO::PARAM_STR);
//    $verifica->bindValue(3,$usu_adm);
        $verifica->execute();
        
        if ($verifica->rowCount() == 1) {
            $linha = $verifica->fetch(PDO::FETCH_ASSOC);
            $usu_adm = $linha['usu_adm'];
            print_r($linha);
            session_start();
            $_SESSION["permissao"] = $usu_adm;
            $_SESSION["nome"] = $linha["usu_nome"];
            $_SESSION["usuario"] = $linha["usu_cod"];
            if ($usu_adm == 1) {
                header("Location: adm/adm.php");
            } else {

                header("Location: prof/prof.php");
            }
        } else {
            header("Location: index.php");
        }
    } else {//else empty
        // se estiver vazio qualquer campo mostra mensagem de erro
        header("Location: index.php");
    }
}else{
    echo " Erro de acesso";
}
?>



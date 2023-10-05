<?php

 session_start();
if($_SESSION["permissao"]==1){
    header("Location: ../adm/cadastrorec.php");
    echo "Gravado com sucesso";
}else{
    
}
  

    $nomerec = $_POST["recnome"];
    $tiporec=$_POST["rectipo"];
    
    require_once "../conexao/conexao.php";
    $conn = conectar();
    $sql = "UPDATE recurso (rec_nome, rec_tipo) VALUES (?,?)";
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$nomerec);
    $comando->bindvalue(2,$tiporec);
    
    $comando->execute();
$conn = null;

?>
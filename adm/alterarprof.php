<?php
session_start();
//if($_SESSION["permissao"]){
//    header("Location: ../adm/form_alter_prof.php");
   
//}else{
   


    $idprofessor    = $_GET['id']; 
    $nome  = $_GET['nome'];
    $email = $_GET['email'];
    $senha = $_GET['senha'];
    
    
  
     require_once "../conexao/conexao.php";
      

      
    $conn = conectar();    
   //sql =  "UPDATE usuarios SET  usu_nome = ? usu_login = ? usu_senha = ? WHERE usu_cod = $idprofessor";
     $sql =  "UPDATE usuarios SET  usu_nome = ?, usu_login = ?, usu_senha = ? WHERE usu_cod = $idprofessor";
             
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$nome);
    $comando->bindvalue(2,$email);
    $comando->bindvalue(3,$senha);

    
  
 //}  
$comando->execute();
$conn = null;

header("Location: ../adm/listarprof.php")
?>




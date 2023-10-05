<?php
    session_start();
   //iniciando a sessão

 if( $_SESSION["permissao"]){
    header("Location: ../prof/formudarsenha.php");
    
}else{
    

  } 

    $cod   =$_SESSION['usuario']; //puxa o codigo do usuario
    $novasenha =$_POST['novasenha']; //puxa a nova senha do formulario 
    $repetsenha =$_POST['repetsenha'];

    if ($novasenha == $repetsenha);
    
    
     require_once "../conexao/conexao.php";
     

    $conn = conectar();      
    $sql =  "UPDATE usuarios SET usu_senha = ? WHERE usu_cod = $cod";
            header("Location: ../prof/formudarsenha.php");
    $comando = $conn->prepare($sql);
    $comando->bindvalue(1,$novasenha);
   

    $comando->execute();
    $conn = null;


  

 ?>       
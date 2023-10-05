<!DOCTYPE html>
<html>
    <head>
    <script type="text/javascript"></script>
    </head>
    <body>


<?php

//session_start();
   //iniciando a sessão

 //if( $_SESSION["permissao"]){
    //header("Location: ../contato.php");
    
//}else{
    
  //} 
	
		if (isset($_POST['Enviar'])){
            $nome    = strip_tags(trim(ucfirst($_POST['nome'])));
            $email   = strip_tags(trim($_POST['email']));
            $assunto = strip_tags(trim($_POST['assunto']));
            $msg     = strip_tags(trim(ucwords($_POST['msg'])));

                
             
                 if(!empty($nome) && !empty($email) && !empty($assunto) && !empty($msg)){
                 
                 require_once"./conexao/conexao.php";
                    $conn = conectar();
                    $sql = "INSERT INTO contato (nome, email, assunto, mensagem) VALUES (?,?,?,?)"; 
                    $comando = $conn->prepare($sql);
                    $comando->bindvalue(1,$nome);
                    $comando->bindvalue(2,$email);
                    $comando->bindvalue(3,$assunto);
                    $comando->bindvalue(4,$msg);
                    $comando->execute();
                    $conn = null;
                    
                }else{
                     echo '<script>alert("Preencha todos os campos");</script>';
              
                } 
            }           
                                         
         if($comando){
            echo '<script>alert("Mensagem enviada com sucesso");</script>';
                } 


	header("Location: ../contato.php");

?>

</body>
</html>
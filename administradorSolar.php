<?php
session_start();
if($_SESSION["permissao"]!=1){
	header("Location: ../prof/prof.php");
}else{
echo $_SESSION["nome"];
}
?>
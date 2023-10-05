<?php

session_start();
unset($_SESSION['permissao']);
session_destroy();
header ("Location: index.php");

?>
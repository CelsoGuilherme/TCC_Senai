<?php

include("conexao.php");

$loginusuario = $_COOKIE['nomlogin'];

$nomed            = $_POST['NomeDiretor'];
$gen              = $_POST['genDiretor'];
$nasc             = $_POST['nascDiretor'];
$emaildiretor     = $_POST['emailDiretor'];
$celdiretor       = $_POST['celDiretor'];
$cpf              = $_POST['cpfDiretor'];


$result_usua = "UPDATE escola SET NomeD = '$nomed', emaildiretor = '$emaildiretor', celular = '$celdiretor', gen = '$gen', DataN = '$nasc', CPF = '$cpf' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);


if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}

?>
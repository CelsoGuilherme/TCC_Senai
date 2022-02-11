<?php 

include("../php/conexao.php");

$tabela = $_COOKIE['tabela'];
$loginusuario = $_COOKIE['nomlogin'];


$nome     = $_POST['Nome'];
$idade    = $_POST['Idade'];
$gen      = $_POST['Gen'];
$cidade   = htmlspecialchars($_POST['Cidade'], ENT_QUOTES);
$estado   = $_POST['Estado'];
$telefone = $_POST['Telefone'];
$celular  = $_POST['Celular'];
$email    = $_POST['Email'];


$result_usua = "UPDATE $tabela SET Nome = '$nome', idade = '$idade', gen = '$gen', cidade = '$cidade', estado = '$estado', telefone = '$telefone', celular = '$celular', email = '$email' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);


if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}


?>
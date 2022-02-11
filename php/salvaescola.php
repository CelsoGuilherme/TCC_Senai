<?php

include("conexao.php");

$loginusuario = $_COOKIE['nomlogin'];

$escola      = htmlspecialchars($_POST['NomeEscola'], ENT_QUOTES);
$periodo     = $_POST['TelefoneEscola'];
$datatermino = htmlspecialchars($_POST['EstadoEscola'], ENT_QUOTES);
$duracao     = $_POST['NumEscola'];
$emailescola = $_POST['EmailEscola'];
$cep         = $_POST['cep'];
$bairro      = htmlspecialchars($_POST['BairroEscola'], ENT_QUOTES);
$cidade      = htmlspecialchars($_POST['CidadeEscola'], ENT_QUOTES);
$rua         = htmlspecialchars($_POST['RuaEscola'], ENT_QUOTES);


$result_usua = "UPDATE escola SET Nome = '$escola', emailescola = '$emailescola', Telefone = '$periodo', Estado = '$datatermino', Num = '$duracao', cep = '$cep', 
Cidade = '$cidade', bairro='$bairro', rua = '$rua' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);


if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}

?>
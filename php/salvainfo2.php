<?php

include("../php/conexao.php");

$tabela = $_COOKIE['tabela'];
$loginusuario = $_COOKIE['nomlogin'];


$TipoE       = $_POST['tipoEnsino'];
$curso       = $_POST['Curso'];
$escola      = htmlspecialchars($_POST['Escola'], ENT_QUOTES);
$periodo     = $_POST['periodoCurso'];
$datatermino = $_POST['DataTermino'];
$duracao     = $_POST['Duracao'];


$result_usua = "UPDATE $tabela SET tipoensino = '$TipoE', materia = '$curso', escola = '$escola', periodo = '$periodo', datatermino = '$datatermino', duracao = '$duracao' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);


if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}

?>
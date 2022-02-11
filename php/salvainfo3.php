<?php

include("conexao.php");

$tabela = $_COOKIE['tabela'];
$loginusuario = $_COOKIE['nomlogin'];

 
$escola             = $_POST['Escola'];
$periodo            = $_POST['PeriodoExp'];
$dataencerramento   = $_POST['DataEncerramento'];
$materiaslecionadas = htmlspecialchars($_POST['MateriasLecionadas'], ENT_QUOTES);
$aulassemanais      = $_POST['AulasSemanais'];


$result_usua = "UPDATE $tabela SET ultimoescola = '$escola', ultimoperiodo = '$periodo', dataencerramento = '$dataencerramento', materiaslecionadas = '$materiaslecionadas', aulassemanais = '$aulassemanais' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);


if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}


?>
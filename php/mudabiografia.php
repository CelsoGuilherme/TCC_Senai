<?php
    include("conexao.php");

$tabela = $_COOKIE['tabela'];
$biografia = $_POST['biografia'];
$loginusuario = $_COOKIE['nomlogin'];


$result_usua = "UPDATE $tabela SET biografia = '$biografia' WHERE Login = '$loginusuario'";
$resultado = mysqli_query($conexao, $result_usua);

if($resultado){
    header("location:../Feed/index.php");
}else{
    header("location:../index.php");
}

?>
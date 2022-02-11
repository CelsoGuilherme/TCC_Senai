<?php

    session_start();

  include("conexao.php");

  $nome  = $_POST["nome"];
  $login = $_POST["login"];
  $senha = $_POST["senha"];
  $email = $_POST["email"];
  $idade = null;
  $gen = null;
  $dataencerramento = null;
  $materiaslecionadas = null;
  $aulassemanais = null;
  $celular = null;
  $escola = null;
  $periodo = null;
  $datatermino = null;
  $duracao = null;
  $ultimoescola = null;
  $ultimoperiodo = null;
  $estadocivil = null;
  $materia = null;
  $tipoensino = null;
  $disponibilidade = null;
  $imagemperfil = "MudaFoto.jpg";
  $telefone = null;
  $curriculo = null;
  $biografia = null;
  $cidade = null; 
  $estado = null;


  $result  = "SELECT Login FROM professor WHERE Login = '$login'";
  $con = $conexao->query($result) or die ($conexao->error);

  $aa = mysqli_num_rows($con);
  
  if($aa == 0){
  $result_usua = "INSERT INTO professor (idade, gen, dataencerramento, materiaslecionadas, aulassemanais, celular, escola, periodo, datatermino, duracao, ultimoescola, 
  ultimoperiodo, estadocivil, materia, tipoensino, disponibilidade, imagemperfil, telefone, curriculo, biografia, cidade, estado, Nome, Email, 
  Login, Senha) VALUES ('$idade','$gen','$dataencerramento','$materiaslecionadas','$aulassemanais','$celular','$escola',
  '$periodo','$datatermino','$duracao','$ultimoescola','$ultimoperiodo','$estadocivil','$materia','$tipoensino','$disponibilidade','$imagemperfil',
  '$telefone','$curriculo','$biografia','$cidade','$estado','$nome','$email','$login',md5('$senha'))";
  $resultado = mysqli_query($conexao, $result_usua);
    header("location:../index.php");
    setcookie('alerta', null, -1, '/');
    setcookie('sucesso', 'Usuário cadastrado com sucesso!!', time() + 2, '/');
  }else{
    header("location:../index.php   ");
    setcookie('alerta','Usuario Existente', time() + 2, '/');

  }

?>
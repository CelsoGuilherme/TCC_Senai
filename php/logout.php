<?php
    include './conexao.php';
    session_start();
    unset($_SESSION["id"]);
    setcookie('nomelogin', null, -1, '/');
    setcookie('idusuario', null, -1, '/');
    setcookie('tabela', null, -1, '/');
    setcookie('nomlogin', null, -1, '/');
    setcookie('imgperfil', null, -1, '/');
    setcookie('nome', null, -1, '/');
    mysqli_close($conexao);
    header("Location:../index.php");
?>
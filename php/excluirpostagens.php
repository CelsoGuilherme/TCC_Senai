<?php 
    include("conexao.php");
    if(isset($_GET['codigo'])){
        $idpost = $_GET['codigo'];
        $insertsave = "DELETE FROM postagens WHERE IdPostagens = '$idpost'";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        header("location:../Feed/pagAdm.php");
    }else
    if(isset($_GET['prof'])){
        $idpost = $_GET['prof'];
        $insertsave = "DELETE FROM professor WHERE IdProfessor = '$idpost'";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        header("location:../Feed/pagAdm.php");
    }else
    if(isset($_GET['escola'])){
        $idpost = $_GET['escola'];
        $insertsave = "DELETE FROM escola WHERE IdEscola = '$idpost'";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        header("location:../Feed/pagAdm.php");
    }
?>
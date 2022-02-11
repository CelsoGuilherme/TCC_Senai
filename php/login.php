<?php
    include("conexao.php");
    session_start();
    $name = $_POST["user_name"];
    $tabela = $_POST["format"];

    if(count($_POST)>0) {
        $sql = "SELECT * FROM $tabela WHERE Login='" . $name . "' and Senha = '". md5($_POST["senhaLogin"])."'";
        $result = mysqli_query($conexao,$sql);
        $row  = mysqli_fetch_array($result);
        if(is_array($row)) {
            $_SESSION["id"] = $row['Id'];
            $nomec = $row['Login'];
            $nome  = $row['Nome'];
            
            
            if($tabela == "professor"){
                $idusuario = $row["IdProfessor"];
                setcookie('nomelogin','Prof. '.$nome, time() +86400,'/');
                setcookie('nomlogin',$nomec, time() +86400,'/');
                setcookie('nome',$nome, time() +86400,'/');
                setcookie('idusuario',$idusuario, time() +86400,'/');
                setcookie('tabela',$tabela, time() + 86400, '/');
                header("location:../Feed/index.php");
            }else if($tabela == "escola"){
                $idusuario = $row["IdEscola"];
                setcookie('nomelogin','Escola '.$nome, time() +86400,'/');
                setcookie('nomlogin',$nomec, time() +86400,'/');
                setcookie('nome',$nome, time() +86400,'/');
                setcookie('idusuario',$idusuario, time() +86400,'/');
                setcookie('tabela',$tabela, time() + 86400, '/');
                header("location:../Feed/index.php");
            }else{
                $idusuario = $row["IdAdmin"];
                setcookie('idusuario',$idusuario, time() +86400,'/');
                setcookie('tabela',$tabela, time() + 86400, '/');
                header("location:../Feed/pagAdm.php");
            }
            exit();
            
        } else {
            setcookie('incorreto',"Login ou Senha incorreto", time() + 2, '/');
            header("location:../index.php");
        }
    }
?>
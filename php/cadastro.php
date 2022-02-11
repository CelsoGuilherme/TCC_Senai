<?php
    include("conexao.php");

    $nome     =  htmlspecialchars($_POST['nome'], ENT_QUOTES);
    $CNPJ     = $_POST["CNPJ"];
    $cep      = $_POST["cep"];
    $cidade   =  htmlspecialchars($_POST['cidade'], ENT_QUOTES);
    $estado   = $_POST["estado"];
    $tipoe    = $_POST["tipoe"];
    $nomed    = $_POST["nomeD"];
    $CPF      = $_POST["CPF"];
    $datan    = $_POST["data"];
    $tel      = $_POST["tel"];
    $emailescola  = $_POST["email"];
    $emaildiretor = $_POST["emailD"];
    $rua          = $_POST["rua"];
    $bairro   = $_POST["bairro"];
    $num      = $_POST["numeroResi"];
    $login    = $_POST["login"];
    $senha    = $_POST["senha"];
    $gen      = $_POST["gen"];
    $cel      = $_POST["CelularDiretor"];
    $biografia = null;
    $imagemperfil = "MudaFoto.jpg";


    $result  = "SELECT Login FROM escola WHERE Login = '$login'";
    $con = $conexao->query($result) or die ($conexao->error);

    $aa = mysqli_num_rows($con);

    if($aa == 0){
        $result_usua = "INSERT INTO escola (Nome, imagemperfil, CNPJ, Cidade, Estado, TipoE, NomeD, CPF, DataN, Telefone, emaildiretor, Num, Login, Senha, cep, gen, emailescola, celular, bairro, biografia, rua) 
        VALUES ('$nome','$imagemperfil','$CNPJ','$cidade','$estado','$tipoe','$nomed','$CPF','$datan','$tel','$emaildiretor','$num','$login',md5('$senha'),
        '$cep','$gen','$emailescola','$cel','$bairro','$biografia','$rua')";
        $resultado = mysqli_query($conexao, $result_usua);
        header("location:../CadastroEscola.php");
        setcookie('sucesso','Cadastro concluido!', time() + 2, '/');
    }else{
        header("location:../CadastroEscola.php");
        setcookie('alerta','Login Existente!', time() + 2, '/');
    }

?>
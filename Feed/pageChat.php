<?php 
    include("../php/conexao.php");

    $idChat = $_COOKIE['idChat'];
    $idusuario = $_COOKIE['idusuario'];
    if(isset($_COOKIE['tabelChat'])){
        $tabelChat = $_COOKIE['tabelChat'];
        if($tabelChat=="professor"){
            $testeselect1 = "SELECT * FROM professor WHERE IdProfessor = '$idChat'";
            $queryteste1 = mysqli_query($conexao, $testeselect1);
            $row1  = mysqli_fetch_array($queryteste1);
            $selectmensagem = "SELECT * FROM mensagens 
            WHERE destinatario IN ($idusuario, $idChat) 
            AND idUsuario    IN ($idusuario, $idChat)
            ORDER BY datamensagem DESC";
            $queryselect1 = mysqli_query($conexao, $selectmensagem);
            $tipo = "P";
        }else{
            $tipo = "E";
            $testeselect1 = "SELECT * FROM escola WHERE IdEscola = '$idChat'";
            $queryteste1 = mysqli_query($conexao, $testeselect1);
            $row1  = mysqli_fetch_array($queryteste1);
            $selectmensagem = "SELECT * FROM mensagens 
            WHERE destinatario IN ($idusuario, $idChat) 
            AND idUsuario    IN ($idusuario, $idChat)
            ORDER BY datamensagem DESC";
            $queryselect1 = mysqli_query($conexao, $selectmensagem);
        }
    }

    $tabela    = $_COOKIE['tabela'];
    if($tabela=="professor"){
        $tipoU = "P";
    }else{
        $tipoU = "E";
    }
    if(!empty($_POST['mensagem'])){
        if(isset($_POST['mensagem'])){
            $mensagem = $_POST['mensagem'];
            $insertmensagem = "INSERT INTO mensagens (mensagem, loginusuario, datamensagem, destinatario, IdUsuario, tipoD, tipoU) VALUES ('$mensagem','$nome', NOW(), '$idChat','$idusuario','$tipo','$tipoU')";
            $queryinsert = mysqli_query($conexao, $insertmensagem);
            if($queryinsert){
                header("location:pageChat.php");
            }else{
                header("location:../index.php");
            }
        }
    }

?>

<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Chat | Teste</title>
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sidebars.css" rel="stylesheet">
        <link href="css/perfil.css" rel="stylesheet">
        <link href="css/pageChat.css" rel="stylesheet">
        <link href="css/layoutPosts.css" rel="stylesheet">
        <link href="css/modal.css" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <link rel="manifest" href="/site.webmanifest">
        <script src="js/script.js"></script>
    </head>
    <body>
        <div class="containerChatWrapper">
            <div class="divLogo">
                <img src="../img/LogoBlack" alt="">
            </div>
            <div class="containerConversa d-flex">
                <div class="headerConversa">
                    <div class="fotoPerfilConversaWrapper">
                        <img src="imgperfil/<?php echo $row1['imagemperfil'];?>" alt="">
                    </div>
                    <div class="nomePessoaConversa">
                        <h2><?php echo $row1['Nome'];?></h2>
                    </div>
                    <div class="fechaConversa">
                        <a onclick="fechaPopupPerfil()">
                            <i class="fas fa-times fs-5 text-white"></i>
                        </a>
                    </div>
                </div>
                <div class="bodyConversa">
                <?php while($chat1 = $queryselect1->fetch_array()){
                    if($chat1['IdUsuario'] == $idusuario){?>
                    <div class="user1 msg">
                        <span><?php echo htmlentities($chat1['mensagem']);?></span>
                    </div>
                    <?php }else{?>
                    <div class="user2 msg">
                    <span><?php echo htmlentities($chat1['mensagem']);?></span>
                    </div>
                <?php }} ?>
                </div>
                <div class="divCampoDigita">
                    <form action="pageChat.php" method="post" class="formEnviaMsg">
                        <input type="text" name="mensagem" id="" placeholder="Mensagem" autocomplete="off" maxlength="240">
                        <div class="submitMensagem">
                            <button type="submit"><i class="fas fa-arrow-right"></i></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
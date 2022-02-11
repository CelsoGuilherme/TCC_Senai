<?php
    include("../php/conexao.php");
    session_start();
    $tabela = $_COOKIE['tabela'];
    $loginusuario = $_COOKIE['nomlogin'];
    $nomelogin = $_COOKIE['nomelogin'];
    $idusuario = $_COOKIE['idusuario'];
    setcookie("idChat","");
    setcookie("tabelChat","");
    setcookie("tabelPost","");
    
    /*----------------------------- Select Perfil---------------------------------*/
    if ($nomelogin == "") {
        session_destroy();
        mysqli_close($conexao);
        header("Location:../index.php");
    }
    
    $descperfil = "SELECT * FROM $tabela WHERE Login = '$loginusuario'";
    $descricao = $conexao->query($descperfil) or die ($conexao->error);
    $desc = $conexao->query($descperfil) or die ($conexao->error);
    $row  = mysqli_fetch_array($desc);
    if($tabela=="professor"){
        $idperfil = $row["IdProfessor"];
        $curriculo = $row['curriculo'];
    }else{
        $idperfil = $row["IdEscola"];
    }
    $imagemperfil = $row["imagemperfil"];
    
    /*----------------------------- Update imagem de perfil ---------------------------------*/
    
    if(isset($_FILES['fileImgPerfil'])){
        $imgperfil = strtolower(substr($_FILES['fileImgPerfil']['name'], -125));
        $diretorioperfil = "imgperfil/";
        move_uploaded_file($_FILES['fileImgPerfil']['tmp_name'], $diretorioperfil.$imgperfil);
        
        $result_usua = "UPDATE $tabela SET imagemperfil = '$imgperfil' WHERE Login = '$loginusuario'";
        $resultado = mysqli_query($conexao, $result_usua);
        $postimg = "UPDATE postagens SET imagemperfil = '$imgperfil' WHERE IdUsuario = '$idperfil'";
        $result   = mysqli_query($conexao, $postimg);
        
        if($resultado){
            header("location:../Feed/index.php");
        }else{
            header("location:../index.php");
        }
    }
    /*----------------------------- Update curriculo ---------------------------------*/


   if(isset($_FILES['fileCurriculo'])){
      $curriculopdf = strtolower(substr($_FILES['fileCurriculo']['name'],-125));
      $dir = 'curriculo/';
      move_uploaded_file($_FILES['fileCurriculo']['tmp_name'], $dir.$curriculopdf);
      $result_usua = "UPDATE professor SET curriculo = '$curriculopdf' WHERE Login = '$loginusuario'";
      $resultado = mysqli_query($conexao, $result_usua);
      if($resultado){
        header("location:../Feed/index.php");
    }else{
        header("location:../index.php");
    }
   }


    /*----------------------------- Select Postagens---------------------------------*/
    
    $consulta = "SELECT * FROM postagens ORDER BY IdPostagens DESC";
    $con = $conexao->query($consulta) or die ($conexao->error);
    
    /*----------------------------- Insert Postagens ---------------------------------*/
    
    if(isset($_FILES['fileImg'])){
        $extensao = strtolower(substr($_FILES['fileImg']['name'], -125));
        $diretorio = "img/";
        $mensagem = htmlspecialchars($_POST['post'], ENT_QUOTES);
        move_uploaded_file($_FILES['fileImg']['tmp_name'], $diretorio.$extensao);
            
        $result_usua = "INSERT INTO postagens (IdUsuario, nomelogin, imagemperfil, mensagem, imagem, data, tabela) VALUES ('$idperfil','$nomelogin', '$imagemperfil', '$mensagem','$extensao',NOW(),'$tabela')";
        $resultado = mysqli_query($conexao, $result_usua);
 
        if(mysqli_insert_id($conexao)){
            header("location:../Feed/index.php");
        }else{
            header("location:../index.php");
        }
    }

    /*----------------------------- Insert Postagens Salvas---------------------------------*/
    
    if(isset($_COOKIE['idPost'])){
        $idpostagens = $_COOKIE['idPost'];
        $ifpostagens = "SELECT * FROM postagensalvas WHERE IdPostagens = '$idpostagens' AND IdUsuario = '$idperfil'";
        $ifpost = $conexao->query($ifpostagens) or die ($conexao->error); 
        $aaa = mysqli_num_rows($ifpost);

        if($aaa == 0){
        $insertsave = "INSERT INTO postagensalvas (IdUsuario, IdPostagens) VALUES ('$idperfil','$idpostagens')";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        setcookie("idPost","");
    
} else {

/*----------------------------- Delete Postagens Salvas ---------------------------------*/

        $insertsave = "DELETE FROM postagensalvas WHERE IdUsuario = '$idperfil' AND IdPostagens = '$idpostagens'";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        setcookie("idPost","");
    }
}

    /*----------------------------- Select Postagens Salvas---------------------------------*/
    
    $postagensalvas    = "SELECT * FROM postagensalvas WHERE IdUsuario = '$idperfil'";
    $postsalva = $conexao->query($postagensalvas) or die ($conexao->error);
    
    /*----------------------------- Select Mensagens ---------------------------------*/

    $mensagens    = "SELECT *  
                    FROM (SELECT 
                                   mensagem,
                                   loginusuario, 
                                   datamensagem,
                                   tipoD, 
                                   tipoU, 
                                   destinatario usuario1, 
                                   idUsuario usuario2 
                              FROM mensagens 
                            WHERE destinatario = '$idusuario'
                         UNION  
                            SELECT 
                                   mensagem, 
                                   loginusuario, 
                                   datamensagem, 
                                   tipoD, 
                                   tipoU, 
                                   idUsuario usuario1, 
                                   destinatario usuario2 
                              FROM mensagens  
                              WHERE idUsuario = '$idusuario') tabela
                     GROUP BY tabela.usuario2 
                     ORDER BY tabela.datamensagem DESC";
    $chatall = $conexao->query($mensagens) or die ($conexao->error);

    $testemen = "SELECT * FROM mensagens WHERE IdUsuario ='$idusuario' OR destinatario ='$idusuario' ORDER BY datamensagem DESC";
    $chatal = $conexao->query($testemen) or die ($conexao->error);


    
    /*------------------------------------------------------------------*/
    
?>
<!doctype html>
<html lang="pt-BR">
<head>
    <meta charset="utf-8">
    <title>Escolariza | Feed</title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/layoutPosts.css" rel="stylesheet">
    <link href="css/perfil.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
    <link href="css/responsivo.css" rel="stylesheet">
    <link href="css/chat.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="../js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="../js/additional-methods.js"></script>
    <script type="text/javascript" src="../js/localization/messages_pt_BR.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <!-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script> -->
    <script src="../js/Cadastro.js"></script>
    <script type="text/javascript">
        $(function(){
            $('#fileImgPerfil').change(
                function(){
                    const file = $(this)[0].files[0]
                    const fileReader = new FileReader()
                    fileReader.onloadend = function(){
                        $('.imgMudaPerfil').attr('src', fileReader.result)
                    }
                    fileReader.readAsDataURL(file)
                }
            )
        })
        $(document).ready(function(){
            $("#formPerfilDadosGerais").validate({
                rules:{
                    Nome: {
                        required: true,
                        minWords: 2
                    },
                    Idade: {
                        number: true
                    },
                    Email: {
                        email: true
                    }
                }
            })
            $("#formEscolaridadeProfessor").validate({
                rules:{
                    tipoEnsino: {
                        required: true
                    },
                    Escola: {
                        required: true
                    },
                    periodoCurso: {
                        required: true
                    },
                    DataTermino: {
                        required: true,
                        date: true
                    },
                    Duracao: {
                        required: true
                    },
                }
            })
            $("#formUltimaExp").validate({
                rules:{
                    Escola: {
                        required: true
                    },
                    PeriodoExp: {
                        required: true
                    },
                    DataEncerramento: {
                        required: true
                    },
                    MateriasLecionadas: {
                        required: true
                    },
                    AulasSemanais: {
                        required: true
                    }
                }
            })
            $("#formPerfilDadosGeraisEscola").validate({
                rules:{
                    NomeEscola: {
                        required: true,
                        minWords:2
                    },
                    EmailEscola: {
                        required: true,
                        email: true
                    },
                    TelefoneEscola: {
                        required: true,
                    },
                    CidadeEscola: {
                        required: true,
                    },
                    EstadoEscola: {
                        required: true,
                    },
                    BairroEscola: {
                        required: true,
                    },
                    RuaEscola: {
                        required: true,
                    },
                    NumEscola: {
                        required: true,
                        num: true
                    }
                }
            })
            $("#formInfoDiretor").validate({
                rules:{
                    NomeDiretor: {
                        required: true,
                        minWords: 2
                    },
                    genDiretor: {
                        required: true
                    },
                    nascDiretor: {
                        required: true
                    },
                    emailDiretor: {
                        required: true,
                        email: true
                    },
                    celDiretor: {
                        required: true
                    },
                    cpfDiretor: {
                        required: true,
                        cpfBR: true
                    }
                }
            })
        })
    </script>
    <script>
        function carrega(id){
            // Get the modal
            var modal = document.getElementById("myModal");

            // Get the image and insert it inside the modal - use its "alt" text as a caption
            var img = document.getElementById(id);
            var modalImg = document.getElementById("img01");
            var captionText = document.getElementById("caption");
            img.onclick = function(){
                modal.style.display = "block";
                modalImg.src = this.src;
                captionText.innerHTML = this.alt;
            }

            // Get the <span> element that closes the modal
            var span = document.getElementsByClassName("close")[0];

            // When the user clicks on <span> (x), close the modal
            span.onclick = function() {
            modal.style.display = "none";
            }
        }
    </script>
    <script>
        function saved(id, idpost){
            document.cookie='idPost='+idpost;
            window.location.reload(); 
        }
    </script>
</head>
<body onload="travaInputs()">
    <div class="containerM d-flex">
        <!------------------------------------------------------- Popup Envia Curriculo ----------------------------------------------------->
        <div class="containerPopup d-none" id="containerPopupCurriculo">
            <div class="popupBiografia">
                <div class="fechaPopupPerfil">
                    <a onclick="fechaCurriculo()">
                        <i class="fas fa-times fs-5 text-white"></i>
                    </a>
                </div>
                <form action="#" method="post" class="formMudaFoto formEnviaPDF" enctype="multipart/form-data">
                    <div class="containerFile">
                        <div class="iconUpload">
                            <label for="fileCurriculo" class="text-white"><i class="fas fa-cloud-upload-alt"></i></label>
                        </div>
                        <div class="descUpload">
                            <span class="filePath"></span>
                        </div>
                    </div>
                    <input type="file"   name="fileCurriculo" class="inputFile d-none" id="fileCurriculo" accept="application/pdf" onchange="mostraCaminho(this.id)">
                    <input type="submit" value="ENVIAR" class="newPost submitForm submitPDF">
                </form>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------- Popup Muda Biografia ----------------------------------------------------->
        <div class="containerPopup d-none" id="containerPopupBiografia">
            <div class="popupBiografia">
                <div class="fechaPopupPerfil">
                    <a onclick="fechaBiografia()">
                        <i class="fas fa-times fs-5 text-white"></i>
                    </a>
                </div>
                <form action="../php/mudabiografia.php" method="post" class="formMudaFoto">
                    <div class="wrapperTextarea">
                        <textarea cols="30" rows="13" maxlength="240" name="biografia"></textarea>
                    </div>
                    <input type="submit" value="ENVIAR" class="newPost submitForm">
                </form>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------- Popup Muda Perfil ----------------------------------------------------->
        <div class="containerPopup d-none" id="containerPopupPerfil">
            <div class="popupMudaFoto">
                <div class="fechaPopupPerfil">
                    <a onclick="fechaMudaPerfil()">
                        <i class="fas fa-times fs-5 text-white"></i>
                    </a>
                </div>
                <form action="index.php" method="post" class="formMudaFoto" enctype="multipart/form-data">
                    <div class="containerImgPopup">
                        <div class="imgPopupWrapper">
                            <img src="imgperfil/<?php echo $row['imagemperfil'];?>" alt="" class="imgMudaPerfil">
                        </div>
                    </div>
                    <label for="fileImgPerfil" class="text-white"><i class="far fa-images fs-4 mb-3"></i></label>
                    <input type="file" name="fileImgPerfil" class="inputFile d-none" id="fileImgPerfil" accept="image/png,image/jpeg">
                    <input type="submit" value="ENVIAR" class="newPost submitForm">
                </form>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------- Popup novo post ------------------------------------------------------->
        <div class="containerPopup d-none" id="containerPopupPost">
            <div class="popupNovoPost">
                <form action="index.php" method="POST" enctype="multipart/form-data">
                    <div class="headerNewPost d-flex text-white">
                        <div class="profileWrapper">
                            <img src="imgperfil/<?php echo $row['imagemperfil'];?>" alt="">
                        </div>
                        <div class="closeWindow">
                            <a onclick="closePopup()">
                                <i class="fas fa-times fs-5"></i>
                            </a>
                        </div>
                    </div>
                    <hr class="text-white">
                    <div class="bodyNewPost d-flex flex-column" id="bodyNewPost">
                        <form>
                            <textarea class="textNewPost text-white mb-3" required name="post" maxlength="200"></textarea>
                            <label for="fileImg" class="text-white"><i class="far fa-images fs-4 mb-3"></i></label>
                            <input type="file"   name="fileImg" class="inputFile d-none" id="fileImg" accept="image/png,image/jpeg">
                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                        </form>
                    </div>
                </form>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!------------------------------------------------------------ Sidebar -------------------------------------------------------------->
        <main id="mainSidebar">
            <div class="sidebar d-flex flex-column flex-shrink-0 p-3 text-white bg-dark">
                <a class="d-flex align-items-center mb-3 mb-md-0 text-white text-decoration-none sidebarLogoEscolariza">
                    <img src="../img/LogoBlackHeader.png" alt="" width="40" height="40" class="me-2">
                    <span class="fs-4">Escolariza<sup>&copy;</sup></span>
                </a>
                <hr>
                <ul class="nav nav-pills flex-column">
                    <li class="fs-5 mb-3">
                        <a class="nav-link text-white navLinkActived" id="navLinkHome" onclick="abreFeed(this.id)">
                            <i class="fas fa-home"></i>
                            <span>Home</span>
                        </a>
                    </li>
                    <li class="fs-5 mb-3">
                        <a class="nav-link text-white" id="navLinkPerfil" onclick="abrePerfil(this.id)">
                            <i class="fas fa-user"></i>
                            <span>Perfil</span>
                        </a>
                    </li>
                    <li class="fs-5 mb-3">
                        <a class="nav-link text-white" id="navLinkSaves" onclick="abreSaves(this.id)">
                            <i class="fas fa-bookmark"></i>
                            <span>Itens Salvos</span>
                        </a>
                    </li>
                    <li id="liNewPost">
                        <input type="button" value="Novo Post" class="newPost newPostText" onclick="openPopup()">
                        <button class="newPostIcon newPost" onclick="openPopup()"><i class="fas fa-plus"></i></button>
                    </li>
                </ul>
                <hr>
                <div class="divBuscaPerfil mb-auto">
                    <form>
                        <div class="divBusca">
                            <div class="inputBusca">
                                <input id="busca" type="text" placeholder="Buscar Login" autocomplete="off" class="">
                            </div>
                            <div class="iconBusca">
                                <i class="fas fa-search"></i>
                            </div>
                        </div>
                    </form>
                    <div id="result" class="containerResultPesquisa"></div>
                </div>
                <hr>
                <div class="dropdown">
                    <a href="#" class="d-flex align-items-center text-white text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                        <div class="sidebarPerfilImgWrapper">
                            <img src="imgperfil/<?php  echo $row['imagemperfil']; ?>">
                        </div>
                        <strong><?php echo $_COOKIE['nomelogin'];?></strong>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-dark text-small shadow" aria-labelledby="dropdownUser1">
                        <li><a class="dropdown-item" href="../php/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </main>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!-------------------------------------------------- Container de Principal --------------------------------------------------------->
        <div class="containerFeed"> 
            <!------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------- Container do Feed ---------------------------------------------------------->
            <div class="feed col-md-8 d-flex flex-column">
                <?php 
                    $conta = 0;
                    $nomeid = "";
                    while($dado = $con->fetch_array()){
                    $nomeid = "myImage".$conta;
                    $idsave = $conta;
                ?>
                <div class="Post col-md-12 d-flex flex-column">
                    <div class="postHeader d-flex align-items-center">
                        <div class="fotoEscola col-md-1">
                            <div class="fotoPerfilPostWrapper">
                                <img src="imgperfil/<?php echo $dado['imagemperfil'];?>">
                            </div>
                        </div>
                        <div class="nomeEscola col-md-9">
                            <strong><span class="text-white fs-5 spanNomeEscola" onclick="abrePopupPerfil('<?php echo $dado['IdUsuario']; ?>','<?php echo $dado['tabela'];?>')"><?php echo $dado["nomelogin"];?></span></strong>
                        </div>
                        <div class="dataPost col-md-2">
                        <?php echo date("d/m/Y",strtotime($dado["data"]));?>
                        </div>
                    </div>
                    <hr class="hrPost">
                    <div class="postBody text-white" id="37197">
                        <div class="textBody">
                            <h3 class="fs-5"><?php echo htmlentities($dado["mensagem"])?></h3>
                        </div>
                        <?php if(!empty($dado['imagem'])){ ?>
                                <div class="imageBody">
                                    <div class="imageBodyWrapper">
                                        <img src="img/<?php echo $dado['imagem']?>" id="<?php echo $nomeid ?>" onclick="carrega('<?php echo $nomeid ?>')">
                                    </div>
                                </div>
                        <?php }?>        
                    </div>
                    <div class="postActions d-flex text-white fs-5 mt-2">
                    <?php
                        $postagensid = $dado['IdPostagens'];
                        $msavepost  = "SELECT * FROM postagensalvas WHERE IdUsuario = '$idperfil' AND IdPostagens = '$postagensid'";
                        $savepost = $conexao->query($msavepost) or die ($conexao->error); 
                        
                        $aa = mysqli_num_rows($savepost);
                    ?>
                        <ul>
                            <li>
                                <a>
                                    <button class="buttonSavePost" id="save">
                                        <i <?php if($aa == 0){
                                                echo "class='far fa-bookmark btnSave'";
                                            } else {
                                                echo "class='fas fa-bookmark btnSave'";
                                            } ?> id="<?php echo $idsave;?>" onclick="saved('<?php echo $idsave;?>','<?php echo $dado['IdPostagens'];?>')"></i>
                                    </button>                                 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php 
                    $conta++;
                }?>
            </div>
            <!------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------- Container do perfil -------------------------------------------------------->
            <?php while($dados = $descricao->fetch_array()){?>
            <div class="profile col-md-8 d-none flex-column">
                <div class="containerProfile d-flex flex-column">
                    <!---------------------- Header do perfil ----------------------------->
                    <div class="headerProfile d-flex flex-column">
                        <div class="iconeEdita">
                            <a>
                                <div class="animacao">
                                    <a onclick="abreMudaPerfil()">
                                        <i class="fas fa-pen"></i>
                                    </a>
                                </div>
                            </a>
                        </div>
                        <div class="center">
                            <div class="imgPerfilWrapper">
                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                    <img src="imgperfil/<?php echo $dados["imagemperfil"];?>" alt="" class="FotoPerfil">
                                </form>
                            </div>
                            <h1><?php echo $dados["Nome"];?></h1>
                        </div>
                        <?php if ($tabela == "professor"){?>  
                            <div class="iconeCurriculo">
                                <a href="">
                                    <div class="animacao">
                                        <a onclick="abreEnviaCurriculo()">
                                            <i class="fas fa-cloud-upload-alt"></i>
                                        </a>
                                    </div>
                                </a>
                            </div>
                        <?php }else{ ?>
                            
                        <?php } ?>
                    </div>
                    <!----------------------- Infos do perfil ----------------------------->
                    <div class="bodyProfile">
                        <div class="biografia d-flex flex-column">
                            <div class="headerBiografia">
                                <?php if ($tabela == "professor"){?>
                                    <h3>Sobre Mim</h3>
                                <?php }else{ ?>
                                    <h3>Sobre Nossa Escola</h3>
                                <?php } ?>
                                <div class="iconeEdita">
                                    <a>
                                        <div class="animacao">
                                            <a onclick="abreBiografia()">
                                                <i class="fas fa-pen"></i>
                                            </a>
                                        </div>
                                    </a>
                                </div>
                            </div>
                            <p><?php  echo htmlentities($dados["biografia"]);?></p>
                        </div>
                        <hr class="hrPost">
                        <!----------------------- PHP para verificar se é escola ou professor ----------------------------->
                        <?php if ($tabela == "professor"){ ?>
                        <!------------------------------------------------------------>
                        <!--------------------- Professor ---------------------------->
                            <div class="formPerfil d-flex flex-column">
                                <fieldset class="fieldset1">  
                                    <legend>Informações Gerais</legend>
                                    <div class="iconeEdita">
                                        <a>
                                            <div class="animacao">
                                                <a onclick="abreForm1()"> 
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                    <form action="../php/salvainfo1.php" method="post" class="row g-3 needs-validation" novalidate id="formPerfilDadosGerais">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Nome Completo</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Nome" autocomplete="off" value="<?php echo $dados["Nome"];?>" onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Idade</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Idade" autocomplete="off" value="<?php echo $dados["idade"];?>" onkeypress="$(this).mask('00');">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Gênero</label>
                                            <select class="form-control inputInfoGeral" id="" name="Gen">
                                                <option selected disabled value="<?php echo $dados["gen"];?>"><?php echo $dados["gen"];?></option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Feminino">Feminino</option>
                                                <option value="Outro">Outro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-7">
                                            <label for="" class="form-label">Cidade</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Cidade" autocomplete="off" value="<?php echo $dados["cidade"];?>" onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Estado</label>
                                            <select class="form-control inputInfoGeral" id="" name="Estado">
                                                <option selected disabled value="<?php echo $dados["estado"];?>"><?php echo $dados["estado"];?></option>
                                                <option value="Acre">Acre</option>
                                                <option value="Alagoas">Alagoas</option>
                                                <option value="Amapá">Amapá</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Bahia">Bahia</option>
                                                <option value="Ceará">Ceará</option>
                                                <option value="Espírito Santo">Espírito Santo</option>
                                                <option value="Goiás">Goiás</option>
                                                <option value="Maranhão">Maranhão</option>
                                                <option value="Mato Grosso">Mato Grosso</option>
                                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                                <option value="Minas Gerais">Minas Gerais</option>
                                                <option value="Pará">Pará</option>
                                                <option value="Paraíba">Paraíba</option>
                                                <option value="Paraná">Paraná</option>
                                                <option value="Pernambuco">Pernambuco</option>
                                                <option value="Piauí">Piauí</option>
                                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                                <option value="Rondônia">Rondônia</option>
                                                <option value="Roraima">Roraima</option>
                                                <option value="Santa Catarina">Santa Catarina</option>
                                                <option value="São Paulo">São Paulo</option>
                                                <option value="Sergipe">Sergipe</option>
                                                <option value="Tocantins">Tocantins</option>
                                                <option value="Distrito Federal">Distrito Federal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Telefone</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Telefone" autocomplete="off" value="<?php echo $dados["telefone"];?>" onkeypress="$(this).mask('(00) 0000-0000');">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Celular</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Celular" autocomplete="off" value="<?php echo $dados["celular"];?>" onkeypress="$(this).mask('(00) 0 0000-0000');">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Email" autocomplete="off" value="<?php echo $dados["Email"];?>">
                                        </div>
                                        <div class="containerEnviaForm d-none infoGeral" id="submitInfoGerais">
                                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                                        </div>
                                    </form>
                                </fieldset>
                                <fieldset class="fieldset2">
                                    <legend>Escolaridade</legend>
                                    <div class="iconeEdita">
                                        <a>
                                            <div class="animacao">
                                                <a onclick="abreForm2()">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                    <form action="../php/salvainfo2.php" method="post" class="row g-3 needs-validation" id="formEscolaridadeProfessor" novalidate>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Grau de Escolaridade</label>
                                            <select class="form-control inputInfoEscolaridade" id="" name="tipoEnsino" disabled>
                                                <option selected value="<?php echo $dados["tipoensino"];?>"><?php echo $dados["tipoensino"];?></option>
                                                <option value="Ensino Fundamental Completo">Ensino Fundamental Completo</option>
                                                <option value="Ensino Médio Completo">Ensino Médio Completo</option>
                                                <option value="Ensino Superior Cursando">Ensino Superior Cursando</option>
                                                <option value="Ensino Superior Completo">Ensino Superior Completo</option>
                                                <option value="Pós Graduação">Pós Graduação</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Curso</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="Curso" autocomplete="off" value="<?php echo $dados["materia"];?>" disabled onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Escola</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="Escola" autocomplete="off" value="<?php echo $dados["escola"];?>" disabled onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Período</label>
                                            <select class="form-control inputInfoEscolaridade" id="" name="periodoCurso" disabled>
                                                <option selected value="<?php echo $dados["periodo"];?>"><?php echo $dados["periodo"];?></option>
                                                <option value="Manhã">Manhã</option>
                                                <option value="Tarde">Tarde</option>
                                                <option value="Noite">Noite</option>
                                                <option value="Integral">Integral</option>
                                            </select>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Data de término</label>
                                            <input type="date" class="form-control inputInfoEscolaridade" id="" name="DataTermino" autocomplete="off" value="<?php echo $dados["datatermino"];?>" disabled>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Duração</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="Duracao" autocomplete="off" value="<?php echo $dados["duracao"];?>" disabled placeholder="(Semestres)" onkeypress="return somenteNumeros()">
                                        </div>
                                        <div class="containerEnviaForm d-none infoEscolaridade" id="submitInfoEscolaridade">
                                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                                        </div>
                                    </form>
                                </fieldset>
                                <fieldset class="fieldset3">
                                    <legend>Última Experiência Profissional</legend>
                                    <div class="iconeEdita">
                                        <a>
                                            <div class="animacao">
                                                <a onclick="abreForm3()">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                    <form action="../php/salvainfo3.php" method="post" class="row g-3 needs-validation" id="formUltimaExp" novalidate>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Escola</label>
                                            <input type="text" class="form-control inputInfoExp" id="" name="Escola" autocomplete="off" value="<?php echo $dados["ultimoescola"];?>" disabled onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Período</label>
                                            <select class="form-control inputInfoExp" id="" name="PeriodoExp" disabled>
                                                <option selected value="<?php echo $dados["ultimoperiodo"];?>"><?php echo $dados["ultimoperiodo"];?></option>
                                                <option value="Manhã">Manhã</option>
                                                <option value="Tarde">Tarde</option>
                                                <option value="Noite">Noite</option>
                                                <option value="Integral">Integral</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Saída</label>
                                            <input type="date" class="form-control inputInfoExp" id="" name="DataEncerramento" autocomplete="off" value="<?php echo $dados["dataencerramento"];?>" disabled>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Matérias Lecionadas</label>
                                            <input type="text" class="form-control inputInfoExp" id="" name="MateriasLecionadas" autocomplete="off" value="<?php echo $dados["materiaslecionadas"];?>" disabled onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Aulas Semanais</label>
                                            <input type="text" class="form-control inputInfoExp" id="" name="AulasSemanais" autocomplete="off" value="<?php echo $dados["aulassemanais"];?>" disabled onkeypress="return somenteNumeros()">
                                        </div>
                                        <div class="containerEnviaForm d-none infoExp" id="submitInfoExp">
                                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        <?php }else{ ?>
                        <!------------------------------------------------------------>
                        <!----------------------- ESCOLA ----------------------------->   
                        <div class="formPerfil d-flex flex-column">
                                <fieldset class="fieldset1">  
                                    <legend>Informações Gerais</legend>
                                    <div class="iconeEdita">
                                        <a>
                                            <div class="animacao">
                                                <a onclick="abreForm1()"> 
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div>
                                        </a>
                                    </div>
                                    <form action="../php/salvaescola.php" method="post" class="row g-3 needs-validation" novalidate id="formPerfilDadosGeraisEscola">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Nome Escola</label>
                                            <input type="text" class="form-control inputInfoGeral" id="nomeEscola" name="NomeEscola" autocomplete="off" value="<?php echo $dados['Nome'];?>" onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="EmailEscola" autocomplete="off" value="<?php echo $dados['emailescola'];?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Telefone</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="TelefoneEscola" value="<?php echo $dados['Telefone'];?>" autocomplete="off" onkeypress="$(this).mask('(00) 0000-0000');">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">CEP</label>
                                            <input type="text" class="form-control inputInfoGeral" id="cep" name="cep" value="<?php echo $dados['cep'];?>" autocomplete="off" onkeypress="$(this).mask('00000-000');" onkeyup="pesquisacep(this.value);" placeholder="00000-000">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Cidade</label>
                                            <input type="text" class="form-control inputInfoGeral inputEnd" id="cidade" name="CidadeEscola" value="<?php echo $dados['Cidade'];?>" autocomplete="off" readonly placeholder="Preenchimento Automático" onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Estado</label>
                                            <select class="form-control inputInfoGeral" id="EstadoEscola" name="EstadoEscola">
                                                <option selected value="<?php echo $dados["Estado"];?>"><?php echo $dados["Estado"];?></option>
                                                <option value="Acre">Acre</option>
                                                <option value="Alagoas">Alagoas</option>
                                                <option value="Amapá">Amapá</option>
                                                <option value="Amazonas">Amazonas</option>
                                                <option value="Bahia">Bahia</option>
                                                <option value="Ceará">Ceará</option>
                                                <option value="Espírito Santo">Espírito Santo</option>
                                                <option value="Goiás">Goiás</option>
                                                <option value="Maranhão">Maranhão</option>
                                                <option value="Mato Grosso">Mato Grosso</option>
                                                <option value="Mato Grosso do Sul">Mato Grosso do Sul</option>
                                                <option value="Minas Gerais">Minas Gerais</option>
                                                <option value="Pará">Pará</option>
                                                <option value="Paraíba">Paraíba</option>
                                                <option value="Paraná">Paraná</option>
                                                <option value="Pernambuco">Pernambuco</option>
                                                <option value="Piauí">Piauí</option>
                                                <option value="Rio de Janeiro">Rio de Janeiro</option>
                                                <option value="Rio Grande do Norte">Rio Grande do Norte</option>
                                                <option value="Rio Grande do Sul">Rio Grande do Sul</option>
                                                <option value="Rondônia">Rondônia</option>
                                                <option value="Roraima">Roraima</option>
                                                <option value="Santa Catarina">Santa Catarina</option>
                                                <option value="São Paulo">São Paulo</option>
                                                <option value="Sergipe">Sergipe</option>
                                                <option value="Tocantins">Tocantins</option>
                                                <option value="Distrito Federal">Distrito Federal</option>
                                            </select>
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Bairro</label>
                                            <input type="text" class="form-control inputInfoGeral inputEnd" id="bairro" name="BairroEscola" autocomplete="off" value="<?php echo $dados['bairro'];?>" readonly placeholder="Preenchimento Automático">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Rua</label>
                                            <input type="text" class="form-control inputInfoGeral inputEnd" id="rua" name="RuaEscola" autocomplete="off" value="<?php echo $dados['rua'];?>" readonly placeholder="Preenchimento Automático">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Nº</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="NumEscola" autocomplete="off" value="<?php echo $dados['Num'];?>" onkeypress="return somenteNumeros()">
                                        </div>
                                        <div class="containerEnviaForm d-none infoGeral" id="submitInfoGerais">
                                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                                        </div>
                                    </form>
                                </fieldset>
                                <fieldset class="fieldset2">
                                    <legend>Informações Diretor(a)</legend>
                                    <div class="iconeEdita">
                                        <a>
                                            <div class="animacao">
                                                <a onclick="abreForm2()">
                                                    <i class="fas fa-pen"></i>
                                                </a>
                                            </div> 
                                        </a>
                                    </div>
                                    <form action="../php/salvadiretor.php" method="post" class="row g-3 needs-validation" id="formInfoDiretor" novalidate>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Nome Completo</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id=""  name="NomeDiretor" autocomplete="off" disabled value="<?php echo $dados['NomeD'];?>" onkeypress="return somenteLetra()">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Gênero</label>
                                            <select class="form-control inputInfoEscolaridade" id="selectGenDiretor" name="genDiretor" disabled value="">
                                                <option selected value="<?php echo $dados['gen'];?>"><?php echo $dados['gen'];?></option>
                                                <option value="Masculino">Masculino</option>
                                                <option value="Feminino">Feminino</option>
                                                <option value="Outro">Outro</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Nascimento</label>
                                            <input type="date" class="form-control inputInfoEscolaridade" id="" name="nascDiretor" autocomplete="off" disabled value="<?php echo $dados['DataN'];?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="emailDiretor" autocomplete="off" disabled value="<?php echo $dados['emaildiretor'];?>">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">Celular</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="celDiretor" value="<?php echo $dados['celular'];?>" autocomplete="off" disabled onkeypress="$(this).mask('(00) 0 0000-0000');">
                                        </div>
                                        <div class="col-md-4">
                                            <label for="" class="form-label">CPF</label>
                                            <input type="text" class="form-control inputInfoEscolaridade" id="" name="cpfDiretor" value="<?php echo $dados['CPF'];?>" autocomplete="off" disabled onkeypress="$(this).mask('000.000.000-00');" placeholder="000.000.000-00">
                                        </div>
                                        <div class="containerEnviaForm d-none infoEscolaridade" id="submitInfoEscolaridade">
                                            <input type="submit" value="ENVIAR" class="newPost submitForm">
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php  } ?> 
            <!------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------- Container de Saves --------------------------------------------------------->
            <div class="saves col-md-8 d-none flex-column">
            <?php while($dadosalva = $postsalva->fetch_array()){
                    $idpost = $dadosalva['IdPostagens'];
                    $postagensalvas2 = "SELECT * FROM postagens WHERE IdPostagens = '$idpost'";
                    $postsalva2 = $conexao->query($postagensalvas2) or die ($conexao->error);
                    while($dadossalva = $postsalva2->fetch_array()){
                    ?>

                <div class="Post col-md-12 d-flex flex-column">
                    <div class="postHeader d-flex align-items-center">
                        <div class="fotoEscola col-md-1">
                            <div class="fotoPerfilPostWrapper">
                                <img src="imgperfil/<?php echo $dadossalva['imagemperfil'];?>">
                            </div>
                        </div>
                        <div class="nomeEscola col-md-9">
                            <strong><span class="text-white fs-5 spanNomeEscola" onclick="abrePopupPerfil('<?php echo $dadossalva['IdUsuario']; ?>')"><?php echo $dadossalva["nomelogin"]; ?></span></strong>
                        </div>
                        <div class="dataPost col-md-2">
                        <?php echo date("d/m/Y",strtotime($dadossalva["data"]));?>
                        </div>
                    </div>
                    <hr class="hrPost">
                    <div class="postBody text-white" id="37197">
                        <div class="textBody">
                            <h3 class="fs-5"><?php echo $dadossalva["mensagem"]?></h3>
                        </div>
                        <?php if(!empty($dadossalva['imagem'])){ ?>
                                <div class="imageBody">
                                    <div class="imageBodyWrapper">
                                        <img src="img/<?php echo $dadossalva['imagem']?>" id="<?php echo $nomeid ?>" onclick="carrega('<?php echo $nomeid ?>')">
                                    </div>
                                </div>
                        <?php }?>        
                    </div>
                    <div class="postActions d-flex text-white fs-5 mt-2">
                        <?php                         
                        $postagensid = $dadossalva['IdPostagens'];
                        $msavepost  = "SELECT * FROM postagensalvas WHERE IdUsuario = '$idperfil' AND IdPostagens = '$postagensid'";
                        $savepost = $conexao->query($msavepost) or die ($conexao->error); 
                        
                        $aa = mysqli_num_rows($savepost);
                        ?>
                        <ul>
                            <li>
                                <a>
                                    <button class="buttonSavePost" id="save">
                                        <i <?php if($aa == 1){
                                                echo "class='fas fa-bookmark btnSave'";
                                            } else {
                                                echo "class='far fa-bookmark btnSave'";
                                            } ?> id="<?php echo $idsave;?>" onclick="saved('<?php echo $idsave;?>','<?php echo $dadossalva['IdPostagens'];?>')"></i>
                                    </button>                                 
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <?php 
                    $conta++;
                ?>
                <?php }}?>
            </div>
            <!------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------- Modal expande img ---------------------------------------------------------->
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <div class="imageModal">
                    <div class="wrapperModal">
                        <img class="modal-content" id="img01">
                    </div>
                </div>
            </div>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
        <!----------------------------------------------------------- Chat ------------------------------------------------------------------>
        <div class="containerChat">
        <?php while($chat = $chatall->fetch_array()){
                $sqlE = "SELECT nome,imagemperfil FROM escola WHERE idEscola = ".$chat['usuario2'];
                $chatNome = $conexao->query($sqlE) or die ($conexao->error);
                $chatNomee = $conexao->query($sqlE) or die ($conexao->error);
                $chatNominho = $chatNome->fetch_array();
                $aaaa = mysqli_num_rows($chatNomee);
                if($aaaa == 1){
                    $tabelChatt = "escola";
                }else{
                    $sqlE = "SELECT nome,imagemperfil FROM professor WHERE IdProfessor = ".$chat['usuario2'];
                    $chatNome = $conexao->query($sqlE) or die ($conexao->error);
                    $chatNominho = $chatNome->fetch_array();
                    $tabelChatt = "professor";
                }
            
            ?>
                <div class="containerMensagem" onclick="NovoChat('<?php echo $chat['usuario2'];?>','<?php echo $tabelChatt;;?>')">
                <div class="divFotoPerfilMensagem">
                    <div class="imgPerfilMsgWrapper">
                        <img src="imgperfil/<?php echo $chatNominho['imagemperfil'];?>">
                    </div>
                </div>
                <div class="divBodyConversa">
                    <div class="nomeMensagem">
                        <span><?php echo $chatNominho['nome'];?></span>
                        <span><?php echo date("H:i",strtotime($chat["datamensagem"]));?></span>
                    </div>
                </div>
            </div>
        <?php }?>
        </div>
        <!----------------------------------------------------------------------------------------------------------------------------------->
    </div>
<script src="js/bootstrap.bundle.min.js"></script>
<script src="js/sidebars.js"></script>
<script src="js/script.js"></script>
<script>
    $("#busca").keyup(function(){
        var busca = $("#busca").val();
        $.post('../php/busca.php', {busca: busca},function(data){
            $("#result").html(data);
        });
    });
</script>
<!-- <script src="js/modal.js"></script> -->
</body>
</html>
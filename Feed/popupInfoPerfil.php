<?php 
    include("../php/conexao.php");
    $idperfil = $_GET['codigo'];
    $idusuario = $_COOKIE['idusuario'];
    $tabelPost = $_COOKIE['tabelPost'];
    if(isset($_COOKIE['nomlogin'])){
        $loginusuario = $_COOKIE['nomlogin'];
    }
    $tabela = $_COOKIE['tabela'];

        
    /*----------------------------- Select Perfil---------------------------------*/
    if($tabela == "professores"){
        $descperfil = "SELECT * FROM professor WHERE Login = '$loginusuario'";
        $descricao = $conexao->query($descperfil) or die ($conexao->error);
        $desc = $conexao->query($descperfil) or die ($conexao->error);
        $row  = mysqli_fetch_array($desc);
            $perfilid = $row["IdProfessor"];
    }else if($tabela == "escola"){
        $descperfil = "SELECT * FROM escola WHERE Login = '$loginusuario'";
        $descricao = $conexao->query($descperfil) or die ($conexao->error);
        $desc = $conexao->query($descperfil) or die ($conexao->error);
        $row  = mysqli_fetch_array($desc);
            $perfilid = $row["IdEscola"];
    }
    


    /*----------------------------- Insert Postagens Salvas---------------------------------*/
    
    if(isset($_COOKIE['idPost'])){
        $idpostagens = $_COOKIE['idPost'];
        $ifpostagens = "SELECT * FROM postagensalvas WHERE IdPostagens = '$idpostagens'";
        $ifpost = $conexao->query($ifpostagens) or die ($conexao->error); 
        $aaa = mysqli_num_rows($ifpost);

        if($aaa == 0){
        $insertsave = "INSERT INTO postagensalvas (IdUsuario, IdPostagens) VALUES ('$perfilid','$idpostagens')";
        $save = $conexao->query($insertsave) or die ($conexao->error);
        setcookie("idPost","");
    
    } else {

    /*----------------------------- Delete Postagens Salvas ---------------------------------*/

            $insertsave = "DELETE FROM postagensalvas WHERE IdUsuario = '$idperfil' AND IdPostagens = '$idpostagens'";
            $save = $conexao->query($insertsave) or die ($conexao->error);
            setcookie("idPost","");
        }
    }

    if($tabelPost=="professor"){
        $descperfil = "SELECT * FROM professor WHERE IdProfessor = '$idperfil'";
        $desc = $conexao->query($descperfil) or die ($conexao->error);
        $descricao = $conexao->query($descperfil) or die ($conexao->error);
        $tabelaperfil = "professor";
    }else{
        $descperfil = "SELECT * FROM escola WHERE IdEscola = '$idperfil'";
        $desc = $conexao->query($descperfil) or die ($conexao->error);
        $descricao = $conexao->query($descperfil) or die ($conexao->error);
        $tabelaperfil = "escola";
    }


    $consulta = "SELECT * FROM postagens WHERE IdUsuario = '$idperfil'";
    $postagens = $conexao->query($consulta) or die ($conexao->error);

    $nomerow  = mysqli_fetch_array($descricao);

    $nomeperfil = $nomerow['Nome'];
    

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo "Escolariza | ".$nomeperfil;?></title>
    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/sidebars.css" rel="stylesheet">
    <link href="css/perfil.css" rel="stylesheet">
    <link href="css/popupPerfil.css" rel="stylesheet">
    <link href="css/layoutPosts.css" rel="stylesheet">
    <link href="css/modal.css" rel="stylesheet">
    <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
    <link rel="manifest" href="/site.webmanifest">
    <script src="js/script.js"></script>
    <script src="js/scriptAdm.js"></script>
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
<body>
    <div class="divLogo">
        <img src="../img/LogoBlack" alt="">
    </div>
    <!-------------------------------------------------- Popup Professor --------------------------------------------------------->
    <?php if($tabelaperfil == "professor"){?>
        <div class="containerPopup d-flex" id="containerPopupPerfil">
            <div class="containerPopupPerfil">
                <div class="fechaPopupPerfil">
                    <?php if($tabela=="administradores"){?>
                    <a onclick="fechaPopupAdm()">
                        <i class="fas fa-times fs-5 text-white"></i>
                    </a>
                    <?php }else{?>
                    <a onclick="fechaPopupPerfil()">
                        <i class="fas fa-times fs-5 text-white"></i>
                    </a>
                    <?php }?>
                </div>
                <div class="containerGeralInfos">
                    <?php while($dado = $desc->fetch_array()){?>
                    <div class="containerParteUm">
                        <div class="divFoto">
                            <?php if($tabela != "administradores"){if($idusuario != $idperfil){?>
                                <div class="iconNovaMensagem">
                                    <i class="fas fa-comments" onclick="NovoChat('<?php echo $idperfil;?>','<?php echo $tabelaperfil;?>')"></i>
                                </div>
                            <?php }} ?>
                            <?php if(!empty($nomerow['curriculo'])){?>
                            <div class="iconDownload">
                                <a href="curriculo/<?php echo $nomerow['curriculo'];?>" download><i class="fas fa-download"></i></a>
                            </div>
                            <?php } ?>
                            <div class="fotoPopupWrapper">
                                <img src="imgperfil/<?php echo $dado['imagemperfil'];?>" alt="">
                            </div>
                            <h3><?php echo htmlentities($dado['Nome']);?></h3>
                        </div>
                        <div class="divForm">
                            <fieldset class="fieldset1">  
                                <legend>Informações Gerais</legend>
                                <form action="../php/salvainfo1.php" method="post" class="row g-2 needs-validation" novalidate id="formPerfilDadosGerais">
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Nome Completo</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Nome" disabled value="<?php echo $dado['Nome'];?>">
                                    </div>
                                    <div class="col-md-2">
                                        <label for="" class="form-label">Idade</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Idade" disabled value="<?php echo $dado['idade'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Gênero</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Gen" disabled value="<?php echo $dado['gen'];?>">
                                    </div>
                                    <div class="col-md-7">
                                        <label for="" class="form-label">Cidade</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Cidade" disabled value="<?php echo $dado['cidade'];?>">
                                    </div>
                                    <div class="col-md-5">
                                        <label for="" class="form-label">Estado</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Estado" disabled value="<?php echo $dado['estado'];?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Telefone</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Telefone" disabled value="<?php echo $dado['telefone'];?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Celular</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Celular" disabled value="<?php echo $dado['celular'];?>">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="" class="form-label">Email</label>
                                        <input type="text" class="form-control inputInfoGeral" id="" name="Email" disabled value="<?php echo $dado['Email'];?>">
                                    </div>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                    <div class="containerParteDois">
                        <div class="divForm">
                            <fieldset class="fieldset2">
                                <legend>Escolaridade</legend>
                                <form action="../php/salvainfo2.php" method="post" class="row g-2 needs-validation" id="formEscolaridadeProfessor" novalidate>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Tipo de ensino</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="TipoEnsino" disabled value="<?php echo $dado['tipoensino'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Curso</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="Curso" disabled value="<?php echo $dado['materia'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Escola</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="Escola" disabled value="<?php echo $dado['escola'];?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Período</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="Periodo" disabled value="<?php echo $dado['periodo'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Data de término</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="DataTermino" disabled value="<?php echo date("d/m/Y",strtotime($dado["datatermino"]));?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Duração</label>
                                        <input type="text" class="form-control inputInfoEscolaridade" id="" name="Duracao" disabled value="<?php echo $dado['duracao'];?>">
                                    </div>
                                </form>
                            </fieldset>
                        </div>
                        <div class="divForm">
                            <fieldset class="fieldset3">
                                <legend>Última Experiência Profissional</legend>
                                <form action="../php/salvainfo3.php" method="post" class="row g-2 needs-validation" id="formUltimaExp" novalidate>
                                    <div class="col-md-5">
                                        <label for="" class="form-label">Escola</label>
                                        <input type="text" class="form-control inputInfoExp" id="" name="Escola" disabled value="<?php echo $dado['ultimoescola'];?>">
                                    </div>
                                    <div class="col-md-4">
                                        <label for="" class="form-label">Período</label>
                                        <input type="text" class="form-control inputInfoExp" id="" name="Periodo" disabled value="<?php echo $dado['ultimoperiodo'];?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Saída</label>
                                        <input type="text" class="form-control inputInfoExp" id="" name="DataEncerramento" disabled value="<?php echo date("d/m/Y",strtotime($dado["dataencerramento"]));?>">
                                    </div>
                                    <div class="col-md-9">
                                        <label for="" class="form-label">Matérias Lecionadas</label>
                                        <input type="text" class="form-control inputInfoExp" id="" name="MateriasLecionadas" disabled value="<?php echo $dado['materiaslecionadas'];?>">
                                    </div>
                                    <div class="col-md-3">
                                        <label for="" class="form-label">Aulas Semanais</label>
                                        <input type="text" class="form-control inputInfoExp" id="" name="AulasSemanais" disabled value="<?php echo $dado['aulassemanais'];?>">
                                    </div>
                                </form>
                            </fieldset>
                        </div>
                    </div>
                </div>
                <div class="containerParteTres">
                    <div class="divBiografia">
                        <p><?php echo htmlentities($dado['biografia']);?></p>
                    </div>
                </div>
                <?php }?>
            </div>
        </div>
    <!---------------------------------------------------------------------------------------------------------------------------->
    <!-------------------------------------------------- Popup Escola ------------------------------------------------------------>
    <?php }else{?>
        <div class="containerPopup d-flex" id="containerPopupPerfilEscola">
            <div class="containerPopupPerfil">
                <div class="fechaPopupPerfil">
                    <?php if($tabela=="administradores"){?>
                        <a onclick="fechaPopupAdm()">
                            <i class="fas fa-times fs-5 text-white"></i>
                        </a>
                        <?php }else{?>
                        <a onclick="fechaPopupPerfil()">
                            <i class="fas fa-times fs-5 text-white"></i>
                        </a>
                    <?php }?>
                </div>
                <div class="containerEscola">
                    <?php while($dado = $desc->fetch_array()){?>
                        <div class="containerParteUmEscola">
                            <div class="divFotoEscola">
                                <?php if($idusuario != $idperfil){?>
                                    <div class="iconNovaMensagem">
                                        <i class="fas fa-comments" onclick="NovoChat('<?php echo $idperfil;?>','<?php echo $tabelaperfil;?>')"></i>
                                    </div>
                                <?php } ?>
                                <div class="fotoPopupWrapper">
                                    <img src="imgperfil/<?php echo $dado['imagemperfil'];?>" alt="">
                                </div>
                                <h3><?php echo $dado['Nome'];?></h3>
                            </div>
                            <hr class="divideDivs">
                            <div class="divFormEscola">
                                <fieldset class="fieldset1">  
                                    <legend>Informações Gerais</legend>
                                    <form action="../php/salvaescola.php" method="post" class="row g-2 needs-validation" novalidate id="formPerfilDadosGeraisEscola">
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Nome Escola</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="NomeEscola" disabled value="<?php echo $dado['Nome'];?>">
                                        </div>
                                        <div class="col-md-6">
                                            <label for="" class="form-label">Email</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="EmailEscola" disabled value="<?php echo $dado['emailescola'];?>">
                                        </div>
                                        <div class="col-md-3">
                                            <label for="" class="form-label">Telefone</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="TelefoneEscola" disabled value="<?php echo $dado['Telefone'];?>">
                                        </div>
                                        <div class="col-md-4">
                                        <label for="" class="form-label">CEP</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="Gen" disabled value="<?php echo $dado['cep'];?>">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Cidade</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="CidadeEscola" disabled value="<?php echo $dado['Cidade'];?>">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Estado</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="EstadoEscola" disabled value="<?php echo $dado['Estado'];?>">
                                        </div>
                                        <div class="col-md-7">
                                            <label for="" class="form-label">Bairro</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="BairroEscola" disabled value="<?php echo $dado['bairro'];?>">
                                        </div>
                                        <div class="col-md-5">
                                            <label for="" class="form-label">Rua</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="RuaEscola" disabled value="<?php echo $dado['rua'];?>">
                                        </div>
                                        <div class="col-md-2">
                                            <label for="" class="form-label">Nº</label>
                                            <input type="text" class="form-control inputInfoGeral" id="" name="NumEscola" disabled value="<?php echo $dado['Num'];?>">
                                        </div>
                                    </form>
                                </fieldset>
                            </div>
                        </div>
                    <?php }?>
                    <div class="containerParteDoisEscola">
                        <?php 
                            $conta = 0;
                            $nomeid = "";
                            while($post = $postagens->fetch_array()){
                            $nomeid = "myImage".$conta;
                            $idsave = $conta;
                        ?>
                        <div class="Post col-md-12 d-flex flex-column">
                            <div class="postHeader d-flex align-items-center">
                                <div class="fotoEscola col-md-1">
                                    <div class="fotoPerfilPostWrapper">
                                        <img src="imgperfil/<?php echo $post['imagemperfil'];?>">
                                    </div>
                                </div>
                                <div class="nomeEscola col-md-9">
                                    <strong><span class="text-white fs-5 spanNomeEscola" onclick=""><?php echo $post['nomelogin'];?></span></strong>
                                </div>
                                <div class="dataPost col-md-2">
                                    <?php echo date("d/m/Y",strtotime($post["data"]));?>
                                </div>
                            </div>
                            <hr class="hrPost">
                            <div class="postBody text-white" id="37197">
                                <div class="textBody">
                                    <h3 class="fs-5"><?php echo $post['mensagem'];?></h3>
                                </div>
                                <?php if(!empty($post['imagem'])){ ?>
                                    <div class="imageBody">
                                        <div class="imageBodyWrapper">
                                            <img src="img/<?php echo $post['imagem']?>" id="<?php echo $nomeid ?>" onclick="carrega('<?php echo $nomeid ?>')">
                                        </div>
                                    </div>
                                <?php }?>    
                            </div>
                            <div class="postActions d-flex text-white fs-5 mt-2">
                                <?php
                                    if($tabela=="administradores"){}else{
                                    $postagensid = $post['IdPostagens'];
                                    $msavepost  = "SELECT * FROM postagensalvas WHERE IdUsuario = '$perfilid' AND IdPostagens = '$postagensid'";
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
                                                    } ?> id="<?php echo $idsave;?>" onclick="saved('<?php echo $idsave;?>','<?php echo $post['IdPostagens'];?>')"></i>
                                            </button>                                 
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <?php }}?>
                    </div>                        
                </div>
            </div>
            <div id="myModal" class="modal">
                <span class="close">&times;</span>
                <div class="imageModal">
                    <div class="wrapperModal">
                        <img class="modal-content" id="img01">
                    </div>
                </div>
            </div>
        </div>
        <!---------------------------------------------------------------------------------------------------------------------------->
    <?php }?>
</body>
</html>
<?php 
include("../php/conexao.php");
    /*----------------------------- Select Postagens---------------------------------*/
    
    $consulta = "SELECT * FROM postagens ORDER BY IdPostagens DESC";
    $con = $conexao->query($consulta) or die ($conexao->error);


    $selectprof = "SELECT * FROM professor";
    $queryprof = $conexao->query($selectprof) or die ($conexao->error);

    $selectescola = "SELECT * FROM escola";
    $queryescola = $conexao->query($selectescola) or die ($conexao->error);

?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
        <meta charset="UTF-8">
        <title>Escolariza | ADM</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sidebars/">
        <link href="css/bootstrap.min.css" rel="stylesheet">
        <link href="css/sidebars.css" rel="stylesheet">
        <link href="css/layoutPosts.css" rel="stylesheet">
        <link href="css/perfil.css" rel="stylesheet">
        <link href="css/modal.css" rel="stylesheet">
        <link href="css/responsivo.css" rel="stylesheet">
        <link href="css/pagAdm.css" rel="stylesheet">
        <link rel="apple-touch-icon" sizes="180x180" href="../img/apple-touch-icon.png">
        <link rel="icon" type="image/png" sizes="32x32" href="../img/favicon-32x32.png">
        <link rel="icon" type="image/png" sizes="16x16" href="../img/favicon-16x16.png">
        <script type="text/javascript" src="../js/jquery-3.3.1.min.js"></script>
        <link rel="manifest" href="/site.webmanifest">
        <script src="js/bootstrap.bundle.min.js"></script>
        <script src="js/sidebars.js"></script>
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
            function abrePagApaga(){
            var teste2 = teste;
            document.cookie='idPost='+teste2;
            window.location.reload(); 
        }
        </script>
    </head>
    <body>
    <div class="containerPopupAdm d-none" id="containerPopupApagaPost">
        <div class="popupApagaPost d-flex">
            <h3>Tem certeza que deseja apagar esse post?</h3>
                <div class="divOptions">
                <button class="aceitar" onclick="abrePagApaga()">Sim</button>
                <button class="negar" onclick="fechaPopupApaga()">Não</button>
            </div>
        </div>
    </div>
    <div class="containerM d-flex">
         <!------------------------------------------------------- Popup Apaga Post ----------------------------------------------------->

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
                            <i class="fas fa-users-cog"></i>
                            <span>Área do ADM</span>
                        </a>
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
                            <img src="imgperfil/LogoBlack.png">
                        </div>
                        <strong>Escolariza ADM</strong>
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
                            <strong><span class="text-white fs-5 spanNomeEscola" onclick="abrePopupPerfil('<?php echo $dado['IdUsuario']; ?>')"><?php echo $dado["nomelogin"];?></span></strong>
                        </div>
                        <div class="dataPost col-md-2">
                            <?php echo date("d/m/Y H:i",strtotime($dado["data"]));?>
                        </div>
                    </div>
                    <hr class="hrPost">
                    <div class="postBody text-white" id="37197">
                        <div class="textBody">
                            <h3 class="fs-5"><?php echo $dado["mensagem"]?></h3>
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
                        <ul>
                            <li>
                                <a href="javascript: if(confirm('Tem certeza que deseja excluir esta postagem?'))location.href='../php/excluirpostagens.php?codigo='+<?php echo $dado['IdPostagens'];?>;">
                                    <button class="buttonApagarPost" id="apagar" href="pagAdm.p">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>          <?php $conta++;}?>
            </div>
            <!------------------------------------------------------------------------------------------------------------------------------->
            <!-------------------------------------------------- Container do adm -------------------------------------------------------->
            <div class="profile col-md-8 d-none flex-column">
                <div class="containerProfile d-flex flex-column">
                    <div class="headerProfile d-flex flex-column">
                        <div class="center">
                            <div class="imgPerfilWrapper">
                                <form action="index.php" method="POST" enctype="multipart/form-data">
                                    <img src="imgperfil/LogoBlack.png" alt="" class="FotoPerfil">
                                </form>
                            </div>
                            <h1>Escolariza ADM</h1>
                        </div>
                    </div>
                    <div class="bodyProfile">
                        <h1>Tabela Professores</h1>
                        <hr>
                        <div class="divTabelaPerfis">
                            <table class="tabela-pers">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Nome</th>
                                        <th>Gênero</th>
                                        <th>Email</th>
                                        <th>Estado</th>
                                        <th>Idade</th>
                                        <th class="optionsLeito">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($prof = $queryprof->fetch_array()){?>
                                    <tr>
                                        <td titulo="ID"><?php echo $prof['IdProfessor'];?></td>
                                        <td titulo="NOME"><?php echo $prof['Nome'];?></td>
                                        <td titulo="GENERO"><?php echo $prof['gen'];?></td>
                                        <td titulo="EMAIL"><?php echo $prof['Email'];?></td>
                                        <td titulo="ESTADO"><?php echo $prof['estado'];?></td>
                                        <td titulo="IDADE"><?php echo $prof['idade'];?></td>
                                        <td titulo="OPTIONS" class="optionsLeito"><a href="javascript: if(confirm('Tem certeza que deseja excluir este perfil?'))location.href='../php/excluirpostagens.php?prof='+<?php echo $prof['IdProfessor'];?>;">
                                        <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                        <h1>Tabela Escolas</h1>
                        <hr>
                        <div class="divTabelaPerfis">
                            <table class="tabela-pers">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Escola</th>
                                        <th>CNPJ</th>
                                        <th>CEP</th>
                                        <th>Email</th>
                                        <th>Telefone</th>
                                        <th class="optionsLeito">Opções</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php while($escola = $queryescola->fetch_array()){?>
                                    <tr>
                                        <td titulo="ID"><?php echo $escola['IdEscola'];?></td>
                                        <td titulo="ESCOLA"><?php echo $escola['Nome'];?></td>
                                        <td titulo="CNPJ"><?php echo $escola['CNPJ'];?></td>
                                        <td titulo="CEP"><?php echo $escola['cep'];?></td>
                                        <td titulo="EMAIL"><?php echo $escola['emailescola'];?></td>
                                        <td titulo="TELEFONE"><?php echo $escola['Telefone'];?></td>
                                        <td titulo="OPTIONS" class="optionsLeito"><a href="javascript: if(confirm('Tem certeza que deseja excluir este perfil?'))location.href='../php/excluirpostagens.php?escola='+<?php echo $escola['IdEscola'];?>;">
                                        <i class="fas fa-trash"></i></a></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
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
        <div class="containerChat">
        </div>
    </div>
    <script>
        $("#busca").keyup(function(){
            var busca = $("#busca").val();
            $.post('../php/busca.php', {busca: busca},function(data){
                $("#result").html(data);
            });
        });
    </script>
    
    </body>
</html>
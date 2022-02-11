<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Escolariza | Home</title>
    <link rel="stylesheet" href="css/index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest" />
</head>

<body id="idBody">
    <div class="containerAll">
        <div class="containerPopup d-none">
            <div id="popupLogin" class="popupLogin">
                <div class="headerPopup">
                    <a href="javascript: fechar();" id="fechar"><i class="fas fa-times"></i></a>
                </div>
                <div class="divFormPopup">
                    <form method="POST" action="php/login.php" class="formPopup" id="formLogin">
                        <div class="input ilogin">
                            <input type="text" class="campo btnPopup" id="loginL" required autocomplete="off" name="user_name">
                            <label for="user_name" class="label-campo">Login</label>
                            <span class="error"></span>
                        </div>
                        <div class="input ilogin">
                            <input type="password" class="campo btnPopup" id="senhaLogin" required autocomplete="off" name="senhaLogin">
                            <label for="senhaLogin" class="label-campo">Senha</label>
                            <span class="error"></span>
                        </div>
                        <div class="select">
                            <select name="format" id="format" required>
                                <option selected value="administradores">Escolha...</option>
                                <option value="professor">Professor</option>
                                <option value="escola">Escola</option>
                            </select>
                        </div>
                        <?php if(isset($_COOKIE['incorreto'])){
                            echo '<div class="msgInvalid">Usuário ou Senha incorreto</div>';}
                        ?>
                        <input type="submit" class="btn submitBtn" value="Entrar" id="btnLogin">
                    </form>
                </div>
            </div>
        </div>
        <a href="#section-1">
            <div class="btnup">
                <i class="fas fa-arrow-up"></i>
            </div>
        </a>
        <header>
            <nav id="navbar">
                <a href="#section-1">
                    <img src="img/LogoBlackHeader.png">
                </a>
                <div class="mobilem">
                    <div class="line1"></div>
                    <div class="line2"></div>
                    <div class="line3"></div>
                </div>
                <ul class="navl">
                    <li><a href="javascript: popupLogin();" class="navli">Login</s></a></li>
                    <li><a href="#section-2" class="navli">Vantagens</a></li>
                    <li><a href="#section-3" class="navli">Depoimentos</a></li>
                    <li><a href="CadastroEscola.php" class="navli">Cadastre sua escola</a></li>
                </ul>
            </nav>
        </header>
        <section class="section-1" id="section-1">
            <div class="background-wrapper">
                <img src="img/Background.jpg">
            </div>
            <div class="container">
                <div class="banner">
                    <div class="bannerwrapper">
                        <img src="img/Banner.png">
                    </div>
                </div>
                <div class="registre-se">
                    <div class="title">
                        <h1>Registre-se</h1>
                    </div>
                    <div class="formCadastro">
                        <form id="formCadastro" action="php/registrar.php" method="POST">
                            <div class="input iCadastro">
                                <span class="error"></span>
                                <input type="text" class="campo" id="nome" name="nome" autocomplete="off" required>
                                <label for="nome" class="label-campo">Nome</label>
                            </div>
                            <div class="input iCadastro">
                                <span class="error"></span>
                                <input type="email" class="campo" id="email" name="email" autocomplete="off" required>
                                <label for="email" class="label-campo">E-mail</label>
                            </div>
                            <div class="input iCadastro">
                                <span class="error"></span>
                                <input type="text" class="campo" id="login" name="login" autocomplete="off" required>
                                <label for="login" class="label-campo">Login</label>
                            </div>
                            <div class="input iCadastro">
                                <span class="error"></span>
                                <input type="password" class="campo" id="senhaCadastro" name="senha" autocomplete="off" required>
                                <label for="senha" class="label-campo">Senha</label>
                            </div>
                            <?php if(isset($_COOKIE['alerta'])){
                                echo '<div class="msgInvalid">Login Existente</div>';}
                            ?>
                            <?php if(isset($_COOKIE['sucesso'])){
                                echo '<div class="msgValid">Usuário cadastrado com sucesso!</div>';}
                            ?>
                            <input type="submit" class="btn submitBtn" value="Enviar" id="btnRegistra">
                        </form>
                    </div>
                </div>
            </div>
        </section>
        <section class="section-2" id="section-2">
            <div class="section-header">
                <h1>Vantagens</h1>
            </div>
            <div class="vantagens">
                <div class="vantagens-grid">
                    <div class="topico">
                        <div class="topico-header">
                            <i class="fas fa-briefcase"></i>
                            <h3>Oportunidades</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbsp Com a gente o seu emprego é garantido!!! Você terá ótimas oportunidades para entrar na escola dos sonhos e alcançar a tão sonhada estabilidade totalmente <b>de graça</b>.
                            </p>
                        </div>
                    </div>
                    <div class="topico">
                        <div class="topico-header">
                            <i class="fas fa-chart-line"></i>
                            <h3>Crescimento</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbsp Além de conseguir um bom emprego, você terá ótimas chances de se provar para conseguir se destacar na escola. Temos também a opção de avaliação aonde seu supervisor poderá te dar notas por meio de estrelas. </p>
                        </div>
                    </div>
                    <div class="topico">
                        <div class="topico-header">
                            <i class="fas fa-school"></i>
                            <h3>Escolas</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbsp Cada escola pode ter um login único para navegar pelo site, com acesso a várias informações úteis sobre as caracteristicas e formações dos professores que poderão ser contatados pela escola.
                            </p>
                        </div>
                    </div>
                    <div class="topico">
                        <div class="topico-header">
                            <i class="far fa-handshake"></i>
                            <h3>Contratação</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbspContamos com um sistema de chat, aonde a escola poderá conversar com o professor para conhece-lo ainda melhor e para facilitar o agendamento de uma possivel entrevista de emprego.
                            </p>
                        </div>
                    </div>
                    <div class="topico">
                        <div class="topico-header">
                            <i class="fas fa-info"></i>
                            <h3>Informação</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbspContamos com perfis individuais repletos de informações tanto dos professores quanto da escola para ambos se conhecerem melhor.
                            </p>
                        </div>
                    </div>
                    <div class="topico">
                        <div class="topico-header">
                            <i class="fas fa-upload"></i>
                            <h3>Posts</h3>
                        </div>
                        <div class="topico-conteudo">
                            <p>&nbspTemos também um sistema de post como de uma rede social para que as escolas compartilhem suas atividades e chamem a atenção dos professores.
                            </p>
                        </div>
                    </div>
                    <div class="vantagens-img-wrapper">
                        <img src="img/VantagensIcon.png">
                    </div>
                </div>
            </div>
        </section>
        <section class="section-3" id="section-3">
            <div class="section-header">
                <h1>Depoimento de Nossos Usuários</h1>
            </div>
            <div class="depoimento">
                <div class="card">
                    <div class="card-image-wrapper">
                        <img src="img/Depoimento1.jpg">
                    </div>
                    <div class="card-info">
                        <div class="card-text-wrapper">
                            <div class="CardName">
                                <h1>Lucas Campos</h1>
                            </div>
                            <div class="CardText">
                                <p>&nbsp Comecei a utilizar o site assim que foi lançado, não me arrependo nem um pouco, tudo funciona bem e existem diversas ferramentas que nos auxilia a seguir uma carreira e tanto.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image-wrapper">
                        <img src="img/Depoimento2.jpg">
                    </div>
                    <div class="card-info">
                        <div class="card-text-wrapper">
                            <div class="CardName">
                                <h1>Gabriel Nascimento</h1>
                            </div>
                            <div class="CardText">
                                <p>Esse site me ajudou a conseguir meu primeiro emprego como professor em uma escola maravilhosa, mesmo após conseguir um emprego eu continuo utilizando o site para me manter atualizado sobre o que acontece em outras escolas.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image-wrapper">
                        <img src="img/Depoimento3.jpg" alt="">
                    </div>
                    <div class="card-info">
                        <div class="card-text-wrapper">
                            <div class="CardName">
                                <h1>Eduarda Fregolente</h1>
                            </div>
                            <div class="CardText">
                                <p>&nbsp Amei a experiência que tive no site, a interface é autodidatica e de fácil aprendizado. A equipe de suporte é super educada e prestativa, recomendo.</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-image-wrapper">
                        <img src="img/Depoimento4.jpg" alt="">
                    </div>
                    <div class="card-info">
                        <div class="card-text-wrapper">
                            <div class="CardName">
                                <h1>Carlos Eduardo</h1>
                            </div>
                            <div class="CardText">
                                <p>Sou diretor de uma escola e recentemente fiz meu cadastro no site, já fiz diversas postagens e contratei dois ótimos professores. </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <div class="footer-container">
            <footer>
                <div class="content-1">
                    <div class="logo-wrapper">
                        <img src="img/LogoBlackHeader.png">
                    </div>
                    <span>© 2021 Company, Inc</span>
                </div>
                <ul class="content-2">
                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                </ul>
            </footer>
        </div>
    </div>
</body>
<script src="js/script.js"></script>
<script src="js/CheckInput.js"></script>

</html>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escolariza | Cadastro de escola</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="apple-touch-icon" sizes="180x180" href="img/apple-touch-icon.png" />
    <link rel="icon" type="image/png" sizes="32x32" href="img/favicon-32x32.png" />
    <link rel="icon" type="image/png" sizes="16x16" href="img/favicon-16x16.png" />
    <link rel="manifest" href="/site.webmanifest"/>
    <link rel="stylesheet" href="css/Cadastro.css">
    <link rel="stylesheet" href="Feed/css/bootstrap.min.css">
    <script type="text/javascript" src="js/jquery-3.3.1.min.js"></script>
    <script type="text/javascript" src="js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="js/additional-methods.js"></script>
    <script type="text/javascript" src="js/localization/messages_pt_BR.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(){
            $("#formEscola").validate({
                rules:{
                    nome: {
                        required: true,
                        minWords: 2
                    },
                    CNPJ: {
                        cnpjBR: true,
                        required: true
                    },
                    tel: {
                        required: true
                    },
                    email: {
                        required: true,
                        email: true
                    },
                    cep: {
                        postalcodeBR: true,
                        required: true
                    },
                    rua: {
                        required: true,
                    },
                    bairro: {
                        required: true
                    },
                    estado: {
                        required: true,
                    },
                    numeroResi: {
                        required: true,
                        number: true
                    },
                    cidade: {
                        required: true,
                    },
                    nomeD: {
                        required: true,
                        minWords: 2
                    },
                    data: {
                        required: true,
                        date: true
                    },
                    emailD: {
                        required: true,
                        email: true
                    },
                    CPF: {
                        required: true,
                        cpfBR: true
                    },
                    login: {
                        required: true,
                    },
                    CelularDiretor: {
                        required: true,
                    },
                    senha: {
                        required: true,
                    }
                }
            })
        })
    </script>
</head>
<body>
    <svg xmlns="http://www.w3.org/2000/svg" style="display: none;">
        <symbol id="facebook" viewBox="0 0 16 16">
            <path d="M16 8.049c0-4.446-3.582-8.05-8-8.05C3.58 0-.002 3.603-.002 8.05c0 4.017 2.926 7.347 6.75 7.951v-5.625h-2.03V8.05H6.75V6.275c0-2.017 1.195-3.131 3.022-3.131.876 0 1.791.157 1.791.157v1.98h-1.009c-.993 0-1.303.621-1.303 1.258v1.51h2.218l-.354 2.326H9.25V16c3.824-.604 6.75-3.934 6.75-7.951z"/>
        </symbol>
        <symbol id="instagram" viewBox="0 0 16 16">
            <path d="M8 0C5.829 0 5.556.01 4.703.048 3.85.088 3.269.222 2.76.42a3.917 3.917 0 0 0-1.417.923A3.927 3.927 0 0 0 .42 2.76C.222 3.268.087 3.85.048 4.7.01 5.555 0 5.827 0 8.001c0 2.172.01 2.444.048 3.297.04.852.174 1.433.372 1.942.205.526.478.972.923 1.417.444.445.89.719 1.416.923.51.198 1.09.333 1.942.372C5.555 15.99 5.827 16 8 16s2.444-.01 3.298-.048c.851-.04 1.434-.174 1.943-.372a3.916 3.916 0 0 0 1.416-.923c.445-.445.718-.891.923-1.417.197-.509.332-1.09.372-1.942C15.99 10.445 16 10.173 16 8s-.01-2.445-.048-3.299c-.04-.851-.175-1.433-.372-1.941a3.926 3.926 0 0 0-.923-1.417A3.911 3.911 0 0 0 13.24.42c-.51-.198-1.092-.333-1.943-.372C10.443.01 10.172 0 7.998 0h.003zm-.717 1.442h.718c2.136 0 2.389.007 3.232.046.78.035 1.204.166 1.486.275.373.145.64.319.92.599.28.28.453.546.598.92.11.281.24.705.275 1.485.039.843.047 1.096.047 3.231s-.008 2.389-.047 3.232c-.035.78-.166 1.203-.275 1.485a2.47 2.47 0 0 1-.599.919c-.28.28-.546.453-.92.598-.28.11-.704.24-1.485.276-.843.038-1.096.047-3.232.047s-2.39-.009-3.233-.047c-.78-.036-1.203-.166-1.485-.276a2.478 2.478 0 0 1-.92-.598 2.48 2.48 0 0 1-.6-.92c-.109-.281-.24-.705-.275-1.485-.038-.843-.046-1.096-.046-3.233 0-2.136.008-2.388.046-3.231.036-.78.166-1.204.276-1.486.145-.373.319-.64.599-.92.28-.28.546-.453.92-.598.282-.11.705-.24 1.485-.276.738-.034 1.024-.044 2.515-.045v.002zm4.988 1.328a.96.96 0 1 0 0 1.92.96.96 0 0 0 0-1.92zm-4.27 1.122a4.109 4.109 0 1 0 0 8.217 4.109 4.109 0 0 0 0-8.217zm0 1.441a2.667 2.667 0 1 1 0 5.334 2.667 2.667 0 0 1 0-5.334z"/>
        </symbol>
        <symbol id="twitter" viewBox="0 0 16 16">
            <path d="M5.026 15c6.038 0 9.341-5.003 9.341-9.334 0-.14 0-.282-.006-.422A6.685 6.685 0 0 0 16 3.542a6.658 6.658 0 0 1-1.889.518 3.301 3.301 0 0 0 1.447-1.817 6.533 6.533 0 0 1-2.087.793A3.286 3.286 0 0 0 7.875 6.03a9.325 9.325 0 0 1-6.767-3.429 3.289 3.289 0 0 0 1.018 4.382A3.323 3.323 0 0 1 .64 6.575v.045a3.288 3.288 0 0 0 2.632 3.218 3.203 3.203 0 0 1-.865.115 3.23 3.23 0 0 1-.614-.057 3.283 3.283 0 0 0 3.067 2.277A6.588 6.588 0 0 1 .78 13.58a6.32 6.32 0 0 1-.78-.045A9.344 9.344 0 0 0 5.026 15z"/>
        </symbol>
    </svg>
    <header>
        <nav id="navbar">
            <a href="index.php">
                <img src="img/LogoBlackHeader.png">
            </a>
            <div class="mobilem">
                <div class="line1"></div>
                <div class="line2"></div>
                <div class="line3"></div>
            </div>
            <ul class="navl">
                <li><a href="index.php" class="navli">Página inicial</s></a></li>
            </ul>
        </nav>
    </header>
    <section class="section-1">
        <div class="containerCadastro">
            <div class="headerCadastro">
                <h1>Preencha o Formulário</h1>
            </div>
            <hr>
            <div class="bodyCadastro">
                <div class="formsCadastro">
                    <div class="escola">
                        <div class="containerForm1">
                            <form action="php/cadastro.php" class="row g-3 formCadastro needs-validation" method="post" id="formEscola" novalidate>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Nome da escola</label>
                                    <input type="text" class="form-control" id="" name="nome" autocomplete="off" onkeypress="return somenteLetra()">
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">CNPJ</label>
                                    <input type="text" class="form-control" id="" name="CNPJ" autocomplete="off" onkeypress="$(this).mask('00.000.000/0000-00');" placeholder="00.000.000/0000-00">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Telefone</label>
                                    <input type="tel" class="form-control" id="" name="tel" autocomplete="off" onkeypress="$(this).mask('(00) 0000-0000');" placeholder="(00) 0000-0000">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Email da Escola</label>
                                    <input type="email" class="form-control" id="" name="email" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Cep</label>
                                    <input type="text" class="form-control" id="cep" name="cep" autocomplete="off" onkeypress="$(this).mask('99999-999');" onblur="pesquisacep(this.value);">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Endereço</label>
                                    <input type="text" class="form-control inputEnd" id="rua" name="rua" autocomplete="off" readonly placeholder="Preenchimento Automático">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Bairro</label>
                                    <input type="text" class="form-control inputEnd" id="bairro" name="bairro" autocomplete="off" readonly placeholder="Preenchimento Automático">
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">Estado</label>
                                    <select class="form-control inputInfoGeral required" id="" name="estado">
                                        <option selected disabled></option>
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
                                <div class="col-md-1">
                                    <label for="" class="form-label">Nº</label>
                                    <input type="text" class="form-control" id="numeroResi" name="numeroResi" autocomplete="off" onkeypress="return somenteNumeros()" maxlength="4">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Cidade</label>
                                    <input type="text" class="form-control inputEnd" id="cidade" name="cidade" autocomplete="off" readonly placeholder="Preenchimento Automático">
                                </div>
                                <div class="col-md-4">
                                    <label for="" class="form-label">Tipo de ensino</label>
                                    <select class="form-control inputInfoGeral required" id="" name="tipoe">
                                        <option selected disabled></option>
                                        <option value="Ensino Fundamental">Ensino Fundamental</option>
                                        <option value="Ensino Fundamental e Médio">Ensino Fundamental e Médio</option>
                                        <option value="Ensino Médio">Ensino Médio</option>
                                        <option value="Ensino Médio e Técnico">Ensino Médio e Técnico</option>
                                        <option value="Ensino Técnico">Ensino Técnico</option>
                                        <option value="Ensino Superior">Ensino Superior</option>
                                    </select>
                                </div>
                                <!-- //-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//-//- -->
                                <div class="col-md-5">
                                    <label for="" class="form-label">Nome do(a) diretor(a)</label>
                                    <input type="text" class="form-control" id="" name="nomeD" autocomplete="off" onkeypress="return somenteLetra()">
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">Data de nascimento</label>
                                    <input type="date" class="form-control" id="" name="data" autocomplete="off">
                                </div>
                                <div class="col-md-2">
                                    <label for="" class="form-label">Gênero</label>
                                    <select class="form-control inputInfoGeral required" id="" name="gen">
                                        <option selected disabled></option>
                                        <option value="Masc">Masculino</option>
                                        <option value="Fem">Feminino</option>
                                        <option value="Outro">Outro</option>
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Email do(a) Diretor(a)</label>
                                    <input type="email" class="form-control" id="" name="emailD" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label required">Celular</label>
                                    <input type="text" class="form-control" name="CelularDiretor" autocomplete="off" onkeypress="$(this).mask('(00) 0 0000-0000');" placeholder="(00) 0 0000-0000">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">CPF</label>
                                    <input type="text" class="form-control" id="" name="CPF" autocomplete="off" onkeypress="$(this).mask('000.000.000-00');" placeholder="000.000.000-00">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Login</label>
                                    <input type="text" class="form-control" id="" name="login" autocomplete="off">
                                </div>
                                <div class="col-md-3">
                                    <label for="" class="form-label">Senha</label>
                                    <input type="password" class="form-control" id="" name="senha" autocomplete="off">
                                </div>
                                <?php if(isset($_COOKIE['alerta'])){
                                    echo '<div class="msgInvalid">Login Existente</div>';}
                                ?>
                                <?php if(isset($_COOKIE['sucesso'])){
                                    echo '<div class="msgValid">Usuário cadastrado com sucesso!</div>';}
                                ?>
                                <div class="submitWrapper">  
                                    <input type="submit" value="CADASTRAR" class="newPost">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
<script src="js/Cadastro.js"></script>
<script src="js/script.js"></script>
</html>
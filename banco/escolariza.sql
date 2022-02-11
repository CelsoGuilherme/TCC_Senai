-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 16-Dez-2021 às 16:47
-- Versão do servidor: 5.7.31
-- versão do PHP: 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `escolariza`
--
CREATE DATABASE IF NOT EXISTS `escolariza` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `escolariza`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `administradores`
--

DROP TABLE IF EXISTS `administradores`;
CREATE TABLE IF NOT EXISTS `administradores` (
  `IdAdmin` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `Login` char(100) NOT NULL,
  `Senha` varchar(120) NOT NULL,
  PRIMARY KEY (`IdAdmin`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `administradores`
--

INSERT INTO `administradores` (`IdAdmin`, `Nome`, `Login`, `Senha`) VALUES
(1, 'Escolariza', 'Adm', '81dc9bdb52d04dc20036dbd8313ed055');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escola`
--

DROP TABLE IF EXISTS `escola`;
CREATE TABLE IF NOT EXISTS `escola` (
  `IdEscola` int(11) NOT NULL AUTO_INCREMENT,
  `Nome` varchar(100) NOT NULL,
  `imagemperfil` varchar(120) NOT NULL,
  `CNPJ` varchar(22) NOT NULL,
  `Cidade` varchar(100) NOT NULL,
  `Estado` varchar(100) NOT NULL,
  `TipoE` varchar(100) NOT NULL,
  `NomeD` varchar(100) NOT NULL,
  `CPF` varchar(14) NOT NULL,
  `DataN` date NOT NULL,
  `Telefone` varchar(14) NOT NULL,
  `emaildiretor` varchar(100) NOT NULL,
  `Num` int(11) NOT NULL,
  `Login` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  `cep` varchar(9) NOT NULL,
  `gen` varchar(32) NOT NULL,
  `emailescola` varchar(64) NOT NULL,
  `celular` varchar(16) NOT NULL,
  `biografia` varchar(240) NOT NULL,
  `bairro` varchar(120) NOT NULL,
  `rua` varchar(120) NOT NULL,
  PRIMARY KEY (`IdEscola`)
) ENGINE=MyISAM AUTO_INCREMENT=1012 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escola`
--

INSERT INTO `escola` (`IdEscola`, `Nome`, `imagemperfil`, `CNPJ`, `Cidade`, `Estado`, `TipoE`, `NomeD`, `CPF`, `DataN`, `Telefone`, `emaildiretor`, `Num`, `Login`, `Senha`, `cep`, `gen`, `emailescola`, `celular`, `biografia`, `bairro`, `rua`) VALUES
(101, 'Senai &#039;Alvares Romi&#039;', 'logosenai.png', '123456789', 'Santa BÃ¡rbara D&#039;Oeste', 'SÃ£o Paulo', 'ET', 'Marco Antonio', '482.640.418-25', '2004-01-31', '19971463777', 'heitorfm3@gmail.com', 123, 'Senai', '81dc9bdb52d04dc20036dbd8313ed055', '13454-335', 'Feminino', 'heitorfm3@gmail.com', '(19) 9714-6377', '1234\r\n', 'Loteamento Planalto do Sol', 'Rua GoiÃ¢nia'),
(102, 'Maria JosÃ© Margato Brocatto', 'MudaFoto.jpg', '32.834.668/0001-20', 'Santa BÃ¡rbara D&#039;Oeste', 'SÃ£o Paulo', 'Ensino Fundamental e MÃ©dio', 'Valter Silva', '482.640.418-25', '1978-04-30', '1936265366', 'valter@gmail.com', 155, 'brocatto', '81dc9bdb52d04dc20036dbd8313ed055', '13454-335', 'Masc', 'brocatto@gmail.com', '(19) 9 71463-777', '', 'Loteamento Planalto do Sol', 'Rua GoiÃ¢nia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensagens`
--

DROP TABLE IF EXISTS `mensagens`;
CREATE TABLE IF NOT EXISTS `mensagens` (
  `IdMensagem` int(11) NOT NULL AUTO_INCREMENT,
  `mensagem` varchar(240) NOT NULL,
  `loginusuario` varchar(120) NOT NULL,
  `datamensagem` datetime NOT NULL,
  `destinatario` varchar(120) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `tipoD` varchar(1) NOT NULL,
  `tipoU` varchar(1) NOT NULL,
  PRIMARY KEY (`IdMensagem`)
) ENGINE=MyISAM AUTO_INCREMENT=178 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagens`
--

DROP TABLE IF EXISTS `postagens`;
CREATE TABLE IF NOT EXISTS `postagens` (
  `IdPostagens` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` int(11) DEFAULT NULL,
  `nomelogin` varchar(120) NOT NULL,
  `imagemperfil` varchar(120) NOT NULL,
  `mensagem` varchar(360) NOT NULL,
  `imagem` varchar(120) NOT NULL,
  `data` datetime NOT NULL,
  `tabela` varchar(120) NOT NULL,
  PRIMARY KEY (`IdPostagens`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `postagens`
--

INSERT INTO `postagens` (`IdPostagens`, `IdUsuario`, `nomelogin`, `imagemperfil`, `mensagem`, `imagem`, `data`, `tabela`) VALUES
(35, 17, 'Prof. Guilherme Gomes Ferreira', 'perfilguilherme.jpg', 'Consegui meu primeiro estÃ¡gio graÃ§as ao escolariza!!!', '', '2021-12-13 15:16:02', 'professor'),
(36, 20, 'Prof. Leandro Ferreira Das Neves', 'perfilleandro.jpg', 'Estou gostando muito dessa plataforma.', '', '2021-12-13 15:16:42', 'professor'),
(37, 6, 'Prof. Luana Ustulin', 'perfilluana.jpg', 'Busco por vaga como professora de FÃ­sica, currÃ­culo no perfil.', '', '2021-12-13 15:18:51', 'professor'),
(38, 101, 'Escola Senai &#039;Alvares Romi&#039;', 'logosenai.png', 'Senai abre vagas para professores das seguintes Ã¡reas: Desenvolvimento de Sistemas, MecÃ¢nica de Usinagem e EletroeletrÃ´nica. confira mais em https://www.sp.senai.br/institucional/40/0/trabalhe-conosco', 'bannersenai2.jpg', '2021-12-13 15:21:59', 'escola');

-- --------------------------------------------------------

--
-- Estrutura da tabela `postagensalvas`
--

DROP TABLE IF EXISTS `postagensalvas`;
CREATE TABLE IF NOT EXISTS `postagensalvas` (
  `IdSalva` int(11) NOT NULL AUTO_INCREMENT,
  `IdUsuario` varchar(240) NOT NULL,
  `IdPostagens` varchar(120) NOT NULL,
  PRIMARY KEY (`IdSalva`)
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `postagensalvas`
--

INSERT INTO `postagensalvas` (`IdSalva`, `IdUsuario`, `IdPostagens`) VALUES
(80, '101', '38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `professor`
--

DROP TABLE IF EXISTS `professor`;
CREATE TABLE IF NOT EXISTS `professor` (
  `IdProfessor` int(11) NOT NULL AUTO_INCREMENT,
  `idade` varchar(12) NOT NULL,
  `gen` varchar(120) NOT NULL,
  `dataencerramento` varchar(120) NOT NULL,
  `materiaslecionadas` varchar(120) NOT NULL,
  `aulassemanais` varchar(120) NOT NULL,
  `celular` varchar(120) NOT NULL,
  `escola` varchar(120) NOT NULL,
  `periodo` varchar(120) NOT NULL,
  `datatermino` varchar(120) NOT NULL,
  `duracao` varchar(120) NOT NULL,
  `ultimoescola` varchar(120) NOT NULL,
  `ultimoperiodo` varchar(120) NOT NULL,
  `estadocivil` varchar(60) NOT NULL,
  `materia` varchar(60) NOT NULL,
  `tipoensino` varchar(60) NOT NULL,
  `disponibilidade` varchar(60) NOT NULL,
  `imagemperfil` varchar(120) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `curriculo` varchar(120) NOT NULL,
  `biografia` varchar(480) NOT NULL,
  `cidade` varchar(120) NOT NULL,
  `estado` varchar(120) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Email` char(100) NOT NULL,
  `Login` varchar(100) NOT NULL,
  `Senha` varchar(100) NOT NULL,
  PRIMARY KEY (`IdProfessor`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `professor`
--

INSERT INTO `professor` (`IdProfessor`, `idade`, `gen`, `dataencerramento`, `materiaslecionadas`, `aulassemanais`, `celular`, `escola`, `periodo`, `datatermino`, `duracao`, `ultimoescola`, `ultimoperiodo`, `estadocivil`, `materia`, `tipoensino`, `disponibilidade`, `imagemperfil`, `telefone`, `curriculo`, `biografia`, `cidade`, `estado`, `Nome`, `Email`, `Login`, `Senha`) VALUES
(3, '20', '', '25/07/2020', 'MatemÃ¡tica, QuÃ­mica e FÃ­sica', '34', '(19) 9 9665-6208', 'Senai &#039;Alvares&#039; Romi', 'Tarde', '2001-02-17', '3 Semestres', 'Sonia Aparecida Bataglia Cardoso', 'Integral', '', 'Desenvolvimento de Sistemas', 'Ensino TÃ©cnico', '', 'perfilheitor.jpg', '(19) 3455-0726', 'curriculo heitor franca.pdf', '', 'Santa Barbara d&#039;Oeste', '', 'Heitor FranÃ§a Melegate', 'heitorfm3@gmail.com', 'Heitor', '81dc9bdb52d04dc20036dbd8313ed055'),
(5, '19', 'Outro', '', '', '', '(19) 9 8934-443', 'Uninter', 'Noite', '2022-10-21', '4', '', '', '', 'Design de Games', 'Ensino Superior', '', 'perfilgustavo.jpg', '(19) 9893-4444', '', '', 'Santa BÃ¡rbara dOeste', 'SÃ£o Paulo', 'Gustavo Schiavon Rodrigues', 'gustavo.rodrigues21@senaisp.edu.br', 'gustavo', '81dc9bdb52d04dc20036dbd8313ed055'),
(6, '19', 'Feminino', '2020-12-12', 'Mobile', '5', '(19) 9 8206-2434', 'Senai', 'Tarde', '2021-12-22', '3', 'Senai', 'ManhÃ£', '', 'Desenvolvimento de Sistemas', 'Ensino MÃ©dio e TÃ©cnico', '', 'perfilluana.jpg', '(19) 3454-3592', 'curriculo luana ustulin.pdf', 'Brasileira', 'Santa BÃ¡rbara dOeste', 'SÃ£o Paulo', 'Luana Ustulin', 'luana.ustulin@senaisp.edu.br', 'luana', '81dc9bdb52d04dc20036dbd8313ed055'),
(7, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'MudaFoto.jpg', '', '', '', '', '', 'Mirian Miron MagalhÃ£es', 'mirian.magalhaes@senaisp.edu.br', 'mirian', '81dc9bdb52d04dc20036dbd8313ed055'),
(8, '17', 'Masculino', '2021-12-10', 'EducaÃ§Ã£o FÃ­sica', '12', '(19) 9 8719-4880', 'SENAI Alvares Romi', 'Tarde', '2021-12-22', '3', 'Maria josÃ© Margato Brocatto ', 'ManhÃ£', '', 'Desenvolvimento de Sistemas', 'Ensino MÃ©dio e TÃ©cnico', '', 'perfilmarcos.jpg', '(19) 3458-8847', '', '', 'SBO', 'SÃ£o Paulo', 'Marcos VinÃ­cius Barbosa', 'marcos.santos112@senaisp.edu.br', 'marcos', '81dc9bdb52d04dc20036dbd8313ed055'),
(9, '20', 'Feminino', '2021-12-22', 'Tec de FabricaÃ§Ã£o MecÃ¢nica', '15', '(19) 9 9159-9543', 'Uniesp', 'Noite', '2020-12-10', '10', 'Senai Alvares Romi', 'Tarde', '', 'Bacharelado em Enfermagem', 'Ensino Superior', '', 'perfilleticia.jpg', '(19) 3454-5415', '', '', 'Santa BÃ¡rbara d Oeste', 'SÃ£o Paulo', 'Leticia Rafaela Santana', 'leticia.santana3@senaisp.edu.br', 'leticia', '81dc9bdb52d04dc20036dbd8313ed055'),
(10, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'MudaFoto.jpg', '', '', '', '', '', 'Isabella Camargo', 'isabella.silva87@senaisp.edu.br', 'isabela', '81dc9bdb52d04dc20036dbd8313ed055'),
(11, '18', 'Feminino', '2020-01-05', 'matematica', '8', '(19) 9 9552-2710', 'Senai Alvares Romi', 'Tarde', '2021-12-15', '3', 'Magui', 'Integral', '', 'Desenvolvimento de Sistema', 'Ensino MÃ©dio e TÃ©cnico', '', 'perfilmaria.jpg', '(00) 0000-0000', '', '', 'Santa barbara d Oeste', 'SÃ£o Paulo', 'Maria Eduarda Cotrim', 'maria.cotrim@senaisp.edu.br', 'maria', '81dc9bdb52d04dc20036dbd8313ed055'),
(13, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'perfilnicoli.jpeg', '', '', '', '', '', 'Nicoli Matias Guidoni', 'nicoli.guidoni@senaisp.edu.br', 'nicoli', '81dc9bdb52d04dc20036dbd8313ed055'),
(14, '18', 'Masculino', '', '', '', '(19) 9 9416-3502', 'Etec Polivalente  Americana', 'ManhÃ£', '2021-12-13', '6', '', '', '', 'Cursando EM', 'Ensino MÃ©dio', '', 'perfilquibao.jpg', '(19) 3626-8141', '', '', 'Santa BÃ¡rbara dOeste', 'SÃ£o Paulo', 'Felipe Mendes Quibao', 'felipe.quibao@senaisp.edu.br', 'felipe', '81dc9bdb52d04dc20036dbd8313ed055'),
(15, '18', 'Masculino', '2021-12-22', 'Desenvolvimento de Sistemas', '25', '(19) 9 8892-7374', 'ATTILIO DEXTRO', 'ManhÃ£', '2021-12-15', '6', 'SENAI Alvares Romi', 'Tarde', '', 'MÃ©dio', 'Ensino MÃ©dio', '', 'perfilcaio.jpg', '(19) 3458-5003', '', '', 'AraÃ§atuba', 'SÃ£o Paulo', 'Caio Gabriel Santos do Vale', 'caio.vale@senaisp.edu.br', 'caio', '81dc9bdb52d04dc20036dbd8313ed055'),
(16, '18', 'Masculino', '', '', '', '(19) 9 9969-1878', 'SENAI', 'Tarde', '2021-12-22', '3', '', '', '', 'DS', 'Ensino MÃ©dio e TÃ©cnico', '', 'perfilnikolas.jpg', '(51) 5151-5154', '', 'Instagram - @sm.nikolas', 'Santa BÃ¡rbara dOeste', 'SÃ£o Paulo', 'Nikolas Soares Moreira', 'nikolas.moreira@senaisp.edu.br', 'nikolas', '81dc9bdb52d04dc20036dbd8313ed055'),
(17, '19', 'Outro', '', '', '', '(19) 9 8256-6951', 'FATEC', 'Noite', '2022-12-20', '6', '', '', '', 'Jogos Digitais', 'Ensino Superior', '', 'perfilguilherme.jpg', '(19) 3456-6924', '', '', 'SBO', 'SÃ£o Paulo', 'Guilherme Gomes Ferreira', 'guilherme.ferreira14@portalsesisp.org.br', 'guilherme', '81dc9bdb52d04dc20036dbd8313ed055'),
(18, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'perfilkek.jpg', '', '', '', '', '', 'Kaiky Campos Fregolente', 'kaiky.fregolente@senaisp.edu.br', 'kaiky', '81dc9bdb52d04dc20036dbd8313ed055'),
(20, '17', 'Masculino', '', '', '', '(19) 9 9100-7115', 'Senai SBO', 'Tarde', '2021-12-22', '3', '', '', '', 'Desenvolvimento de Sistemas ', 'Ensino TÃ©cnico', '', 'perfilleandro.jpg', '(19) 3383-9539', '', 'Sou um rapaz muito elegante e charmoso.', 'Americana', 'SÃ£o Paulo', 'Leandro Ferreira Das Neves', 'leandro.neves4@senaisp.edu.br', 'leandro', '81dc9bdb52d04dc20036dbd8313ed055'),
(21, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'perfilnayara.jpg', '', '', '', '', '', 'Nayara de Jesus Junque', 'nayara.junque@senaisp.edu.br', 'nayara', '81dc9bdb52d04dc20036dbd8313ed055'),
(22, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'perfiljoao.jpg', '', '', '', '', '', 'JoÃ£o Pedro Vigetti Pelisson', 'joao.pelisson@senaisp.edu.br', 'joao', '81dc9bdb52d04dc20036dbd8313ed055');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 02-Dez-2023 às 19:44
-- Versão do servidor: 8.0.31
-- versão do PHP: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `accesspulse`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_funcionario`
--

DROP TABLE IF EXISTS `acesso_funcionario`;
CREATE TABLE IF NOT EXISTS `acesso_funcionario` (
  `horaentrada` date DEFAULT NULL,
  `horasaida` date DEFAULT NULL,
  `funcionario_cpf_funcionario` varchar(11) NOT NULL,
  `espaco_idespaco` int NOT NULL,
  KEY `acesso_funcionario_espaco_fk` (`espaco_idespaco`),
  KEY `acesso_funcionario_func_fk` (`funcionario_cpf_funcionario`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `acesso_membro`
--

DROP TABLE IF EXISTS `acesso_membro`;
CREATE TABLE IF NOT EXISTS `acesso_membro` (
  `horaentrada` datetime DEFAULT NULL,
  `horasaida` datetime DEFAULT NULL,
  `membro_cpf_membro` varchar(11) NOT NULL,
  `espaco_idespaco` int NOT NULL,
  KEY `acesso_membro_espaco_fk` (`espaco_idespaco`),
  KEY `acesso_membro_membro_fk` (`membro_cpf_membro`)
);

--
-- Extraindo dados da tabela `acesso_membro`
--

INSERT INTO `acesso_membro` (`horaentrada`, `horasaida`, `membro_cpf_membro`, `espaco_idespaco`) VALUES
('2023-11-30 21:26:54', NULL, '01788644638', 1),
('2023-12-01 15:18:32', NULL, '01788644638', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `contem`
--

DROP TABLE IF EXISTS `contem`;
CREATE TABLE IF NOT EXISTS `contem` (
  `plano_idplano` int NOT NULL,
  `modalidade_idmodalidade` int NOT NULL,
  KEY `fk_idplano` (`plano_idplano`),
  KEY `fk_idmodalidade` (`modalidade_idmodalidade`)
);

--
-- Extraindo dados da tabela `contem`
--

INSERT INTO `contem` (`plano_idplano`, `modalidade_idmodalidade`) VALUES
(1, 1),
(2, 1),
(2, 2),
(3, 1),
(3, 2),
(3, 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `espaco`
--

DROP TABLE IF EXISTS `espaco`;
CREATE TABLE IF NOT EXISTS `espaco` (
  `idespaco` int NOT NULL AUTO_INCREMENT,
  `nomeespaco` varchar(255) DEFAULT NULL,
  `capacidade` int DEFAULT NULL,
  `horarioabertura` time DEFAULT NULL,
  `horariofechamento` time DEFAULT NULL,
  PRIMARY KEY (`idespaco`)
);

--
-- Extraindo dados da tabela `espaco`
--

INSERT INTO `espaco` (`idespaco`, `nomeespaco`, `capacidade`, `horarioabertura`, `horariofechamento`) VALUES
(3, 'Estúdio de Yoga', 20, '08:00:00', '20:00:00'),
(2, 'Academia', 50, '06:00:00', '23:00:00'),
(1, 'Sala de Aeróbico', 30, '07:00:00', '21:00:00'),
(4, 'Estúdio de Pilates', 15, '09:00:00', '18:00:00'),
(5, 'Piscina', 20, '06:30:00', '19:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `cpf` varchar(11)  NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `datanascimento` date NOT NULL,
  `funcao` varchar(255) NOT NULL,
  `salario` decimal(10,2) NOT NULL,
  `dataadmissao` date NOT NULL,
  `datademissao` date DEFAULT NULL,
  `senha` varchar(255) NOT NULL,
  `cpfgerente` varchar(11),
  PRIMARY KEY (`cpf`),
  KEY `acesso_funcionario_func_fk` (`cpfgerente`)
);

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`cpf`, `nome`, `endereco`, `telefone`, `datanascimento`, `funcao`, `salario`, `dataadmissao`, `datademissao`, `senha`) VALUES
('11111111111', 'João Silva', 'Rua A, 123', '123456789', '1985-05-10', 'Instrutor de Fitness', '5000.00', '2021-01-15', NULL, '1234'),
('22222222222', 'Maria Oliveira', 'Rua B, 456', '987654321', '1990-02-20', 'Nutricionista', '6000.00', '2020-03-22', NULL, '1234'),
('33333333333', 'Carlos Pereira', 'Rua C, 789', '555555555', '1988-08-15', 'Fisioterapeuta', '7000.00', '2021-02-10', NULL, '1234'),
('44444444444', 'Ana Santos', 'Rua D, 321', '999888777', '1993-11-30', 'Personal Trainer', '5500.00', '2019-12-05', NULL, '1234'),
('55555555555', 'Fernando Lima', 'Rua E, 654', '111222333', '1987-04-25', 'Instrutor de Yoga', '6500.00', '2022-04-18', NULL, '1234'),
('66666666666', 'Mariana Costa', 'Rua F, 987', '444333222', '1995-07-12', 'Massoterapeuta', '4800.00', '2020-06-08', NULL, '1234'),
('77777777777', 'Paulo Oliveira', 'Rua G, 654', '777666555', '1980-01-08', 'Gerente', '9000.00', '2018-09-03', NULL, '1234'),
('88888888888', 'Amanda Souza', 'Rua H, 321', '333444555', '1991-09-14', 'Instrutor de Pilates', '7500.00', '2021-05-20', NULL, '1234'),
('99999999999', 'Ricardo Santos', 'Rua I, 789', '666777888', '1984-12-02', 'Fisiologista do Exercício', '6200.00', '2019-07-15', NULL, '1234'),
('10101010101', 'Camila Lima', 'Rua J, 123', '222333444', '1994-03-17', 'Professor de Natação', '5800.00', '2020-11-30', NULL, '1234');

-- --------------------------------------------------------

--
-- Estrutura da tabela `membro`
--

DROP TABLE IF EXISTS `membro`;
CREATE TABLE IF NOT EXISTS `membro` (
  `cpf` varchar(11)  NOT NULL,
  `nome` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(15) NOT NULL,
  `datanascimento` date NOT NULL,
  `senha` varchar(255) NOT NULL,
  `plano_idplano` int DEFAULT NULL,
  PRIMARY KEY (`cpf`),
  KEY `fk_idplano` (`plano_idplano`)
);

--
-- Extraindo dados da tabela `membro`
--

INSERT INTO `membro` (`cpf`, `nome`, `email`, `endereco`, `telefone`, `datanascimento`, `senha`, `plano_idplano`) VALUES
('01010101011', 'Teste', 'teste@a.a', 'Rua Teste', '31987213', '0000-00-00', '1q2w3e', NULL),
('01788644638', 'Matheus Mendes', 'matheusmendes0100@gmail.com', 'Rua Aurélio Lopes, 237', '31975825572', '2000-01-14', '1234', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mensalidade`
--

DROP TABLE IF EXISTS `mensalidade`;
CREATE TABLE IF NOT EXISTS `mensalidade` (
  `numeroboleto` varchar(47) NOT NULL,
  `pago` char(1) NOT NULL,
  `datavencimento` date NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `plano_idplano` int NOT NULL,
  `membro_cpf_membro` varchar(11) NOT NULL,
  PRIMARY KEY (`numeroboleto`),
  KEY `mensalidade_membro_fk` (`membro_cpf_membro`),
  KEY `mensalidade_plano_fk` (`plano_idplano`)
);

-- --------------------------------------------------------

--
-- Estrutura da tabela `modalidade`
--

DROP TABLE IF EXISTS `modalidade`;
CREATE TABLE IF NOT EXISTS `modalidade` (
  `idmodalidade` int NOT NULL AUTO_INCREMENT,
  `nomemodalidade` varchar(255) NOT NULL,
  `utiliza_espaco_idespaco` int NOT NULL,
  PRIMARY KEY (`idmodalidade`),
  KEY `fk_espaco_idespaco` (`utiliza_espaco_idespaco`)
);

--
-- Extraindo dados da tabela `modalidade`
--

INSERT INTO `modalidade` (`idmodalidade`, `nomemodalidade`, `utiliza_espaco_idespaco`) VALUES
(1, 'Aeróbico', 1),
(2, 'Musculação', 2),
(3, 'Yoga', 3),
(4, 'Pilates', 4),
(16, 'teste', 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `plano`
--

DROP TABLE IF EXISTS `plano`;
CREATE TABLE IF NOT EXISTS `plano` (
  `idplano` int NOT NULL AUTO_INCREMENT,
  `nomeplano` varchar(255) NOT NULL,
  `duracao` varchar(255) NOT NULL,
  `valorplano` decimal(10,2) NOT NULL,
  PRIMARY KEY (`idplano`)
);

--
-- Extraindo dados da tabela `plano`
--

INSERT INTO `plano` (`idplano`, `nomeplano`, `duracao`, `valorplano`) VALUES
(1, 'Plano Básico', '1 mês', '150.00'),
(2, 'Plano Intermediário', '1 mês', '250.00'),
(3, 'Plano Premium', '1 mês', '400.00'),
(51, 'teste', 'teste', '5.00');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 05-Mar-2021 às 21:47
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 8.0.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `bdfinal`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cliente`
--

CREATE TABLE `cliente` (
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Cpf` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cliente`
--

INSERT INTO `cliente` (`Nome`, `Email`, `Cpf`) VALUES
('Arlindo', 'arlingo@gmail.br', '123.444.555-79'),
('Rogerio', 'Rogerio11@hotmail.com', '123.456.789-04'),
('JulianoAndrade', 'juliano@hotmail.com', '123.456.789-34'),
('Julia', 'julia@gmail.br', '123.456.789-55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `Nome` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Senha` varchar(50) NOT NULL,
  `Cpf` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`Nome`, `Email`, `Senha`, `Cpf`) VALUES
('Julia', 'julia@gmail.br555', '123', '123.456.789-01'),
('Julia', 'julia@gmail.br', '1231234', '123.456.789-02'),
('asdasd', 'qqq@asd.gh', '123', '123.456.789-03'),
('Julia', 'julia@gmail.br141243124', '123', '123.456.789-08'),
('Juliano', 'julianoeagodinho6@gmail.com', '123', '123.456.789-11'),
('asd', 'julia@gmail.br12', '12345', '123.456.789-34'),
('Julia222', 'julia@gmail.br1123123', '123123123', '123.456.789-66'),
('qwerty', 'julia@gmail.br1hh', '123', '333.456.789-01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `livro`
--

CREATE TABLE `livro` (
  `Nome` varchar(50) NOT NULL,
  `Autor` varchar(50) NOT NULL,
  `Editora` varchar(50) NOT NULL,
  `Id` int(6) NOT NULL,
  `Locado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `livro`
--

INSERT INTO `livro` (`Nome`, `Autor`, `Editora`, `Id`, `Locado`) VALUES
('Calculo 2', 'James', 'Noite', 100000, 1),
('Calculo 1', 'James', 'Noite', 100001, 1),
('Calculo 3', 'James', 'Noite', 100002, 1),
('Calculo 4', 'James', 'Noite', 100003, 1),
('Calculo Numerico', 'Jone', 'Noite', 100004, 0),
('Arquitetura de Computadores', 'Roger', 'Dia', 100005, 0),
('Arquitetura de Computadores II', 'Roger', 'Dia', 100006, 0),
('O Cavaleiro dos Sete Reinos', 'George', 'Tarde', 100007, 0),
('Elden Ring', 'Miyazaki', 'From', 100008, 0),
('O Flagelo de Lordaeron', 'Martin', 'Blizzard', 100009, 0),
('O Flagelo de Lordaeron 2', 'Martin', 'Blizzard', 100010, 0),
('Dalaran', 'Martin', 'Blizzard', 100011, 0),
('Rotas da selva', 'Rock', 'Riot', 100012, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livrolocado`
--

CREATE TABLE `livrolocado` (
  `IdLocacao` int(5) NOT NULL,
  `IdLivro` int(6) NOT NULL,
  `CpfCliente` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `livrolocado`
--

INSERT INTO `livrolocado` (`IdLocacao`, `IdLivro`, `CpfCliente`) VALUES
(10073, 100003, '123.456.789-04'),
(10073, 100001, '123.456.789-04'),
(10073, 100000, '123.456.789-04'),
(10073, 100002, '123.456.789-04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

CREATE TABLE `locacao` (
  `Id` int(5) NOT NULL,
  `CpfCliente` varchar(14) NOT NULL,
  `DataLimite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`Id`, `CpfCliente`, `DataLimite`) VALUES
(10073, '123.456.789-04', '2021-03-19');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`Cpf`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`Cpf`);

--
-- Índices para tabela `livro`
--
ALTER TABLE `livro`
  ADD PRIMARY KEY (`Id`);

--
-- Índices para tabela `livrolocado`
--
ALTER TABLE `livrolocado`
  ADD KEY `Cpf` (`CpfCliente`),
  ADD KEY `IdLivro` (`IdLivro`),
  ADD KEY `IdLocacao` (`IdLocacao`);

--
-- Índices para tabela `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `CpfLoc` (`CpfCliente`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `livro`
--
ALTER TABLE `livro`
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=100013;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10075;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `livrolocado`
--
ALTER TABLE `livrolocado`
  ADD CONSTRAINT `IdLivro` FOREIGN KEY (`IdLivro`) REFERENCES `livro` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `IdLocacao` FOREIGN KEY (`IdLocacao`) REFERENCES `locacao` (`Id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limitadores para a tabela `locacao`
--
ALTER TABLE `locacao`
  ADD CONSTRAINT `CpfLoc` FOREIGN KEY (`CpfCliente`) REFERENCES `cliente` (`Cpf`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

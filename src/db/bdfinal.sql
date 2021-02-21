-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 21-Fev-2021 às 14:02
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
('Julia', 'julia@gmail.br', '123.456.789-01'),
('Julianoea', 'julianoea@hotmail.com', '123.456.789-02'),
('Juliano', 'juliano@gmail.com', '123.456.789-10'),
('JulianoAndrade', 'juliano@hotmail.com', '123.456.789-34'),
('Julia123', '123123@ttt.br', '333.123.345-88');

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
('Julia', 'julia@gmail.br', '1231234', '123.456.789-02'),
('asdasd', 'qqq@asd.gh', '123', '123.456.789-03'),
('Julia', 'julia@gmail.br141243124', '123', '123.456.789-08'),
('Juliano', 'julianoeagodinho6@gmail.com', '123', '123.456.789-11'),
('asd', 'julia@gmail.br12', '12345', '123.456.789-34'),
('Julia222', 'julia@gmail.br1123123', '123123123', '123.456.789-66');

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
('Calculo Numerico', 'Jone', 'Noite', 100004, 1),
('Arquitetura de Computadores', 'Roger', 'Dia', 100005, 1),
('Arquitetura de Computadores II', 'Roger', 'Dia', 100006, 1),
('O Cavaleiro dos Sete Reinos', 'George', 'Tarde', 100007, 1),
('Elden Ring', 'Miyazaki', 'From', 100008, 1),
('O Flagelo de Lordaeron', 'Martin', 'Blizzard', 100009, 1),
('O Flagelo de Lordaeron 2', 'Martin', 'Blizzard', 100010, 1),
('Dalaran', 'Martin', 'Blizzard', 100011, 1),
('Rotas da selva', 'Rock', 'Riot', 100012, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `locacao`
--

CREATE TABLE `locacao` (
  `Id` int(5) NOT NULL,
  `CpfCliente` varchar(14) NOT NULL,
  `IdLivro` varchar(34) NOT NULL,
  `DataLimite` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `locacao`
--

INSERT INTO `locacao` (`Id`, `CpfCliente`, `IdLivro`, `DataLimite`) VALUES
(10022, '123.456.789-01', '100001,100002', '2021-02-18'),
(10023, '123.456.789-02', '100003,100004,100005,100006', '2021-02-28'),
(10024, '123.456.789-01', '100007,100008,100009,100010,100011', '2021-02-16'),
(10025, '123.456.789-01', '100012', '2021-02-26'),
(10026, '123.456.789-01', '100000', '2021-02-19');

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
-- Índices para tabela `locacao`
--
ALTER TABLE `locacao`
  ADD PRIMARY KEY (`Id`);

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
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10027;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

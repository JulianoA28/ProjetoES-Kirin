-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 12-Mar-2021 às 21:36
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

-- --------------------------------------------------------

--
-- Estrutura da tabela `livrolocado`
--

CREATE TABLE `livrolocado` (
  `IdLocacao` int(5) NOT NULL,
  `IdLivro` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  MODIFY `Id` int(6) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `locacao`
--
ALTER TABLE `locacao`
  MODIFY `Id` int(5) NOT NULL AUTO_INCREMENT;

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

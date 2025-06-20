-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 20/06/2025 às 23:33
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `shoolmanagerdb`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `alunos`
--

CREATE TABLE `alunos` (
  `IdAluno` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Nota` decimal(5,2) NOT NULL,
  `Frequencia` decimal(5,2) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Endereco` text DEFAULT NULL,
  `Telefone` varchar(25) DEFAULT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`IdAluno`, `Nome`, `Nota`, `Frequencia`, `Email`, `Endereco`, `Telefone`, `Senha`) VALUES
(1, 'Carlos Souza', 88.50, 92.00, 'carlos.souza@escola.com', NULL, NULL, 'senha789'),
(2, 'Ana Paula', 75.00, 85.00, 'ana.paula@escola.com', NULL, NULL, 'senha101'),
(5, 'Teste 1', 0.00, NULL, 'teste1@escola.com', NULL, NULL, '$2y$10$55gYE0d13n78mVfRUDSbT.n8MUoTqyPXKgYfDZTDxc6fLjV9UyuKC');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `IdDisciplina` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`IdDisciplina`, `Nome`, `Descricao`) VALUES
(1, 'Matemática', 'Introdução à álgebra e geometria.'),
(2, 'História', 'História do Brasil e Geral.');

-- --------------------------------------------------------

--
-- Estrutura para tabela `professores`
--

CREATE TABLE `professores` (
  `IdProfessor` int(11) NOT NULL,
  `Nome` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Senha` varchar(255) NOT NULL,
  `isFirstLogin` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `professores`
--

INSERT INTO `professores` (`IdProfessor`, `Nome`, `Email`, `Senha`, `isFirstLogin`) VALUES
(1, 'João Silva', 'joao.silva@escola.com', 'Root', 1),
(2, 'Maria Oliveira', 'maria.oliveira@escola.com', 'root', 1),
(3, 'Jolivan', 'Jolivan@escola.com', 'Jolivan', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `IdTurma` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `IdProfessor` int(11) NOT NULL,
  `IdDisciplina` int(11) NOT NULL,
  `Dia` varchar(50) NOT NULL,
  `Horario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`IdTurma`, `Nome`, `IdProfessor`, `IdDisciplina`, `Dia`, `Horario`) VALUES
(1, 'Turma A', 1, 1, 'Segunda-feira', '08:00-10:0'),
(2, 'Turma B', 2, 2, 'Terça-feira', '10:00-12:0'),
(18, 'Teste 1', 1, 2, '', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `alunos`
--
ALTER TABLE `alunos`
  ADD PRIMARY KEY (`IdAluno`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Índices de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD PRIMARY KEY (`IdDisciplina`);

--
-- Índices de tabela `professores`
--
ALTER TABLE `professores`
  ADD PRIMARY KEY (`IdProfessor`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Índices de tabela `turmas`
--
ALTER TABLE `turmas`
  ADD PRIMARY KEY (`IdTurma`),
  ADD KEY `FK_Turmas_Professores` (`IdProfessor`),
  ADD KEY `FK_Turmas_Disciplinas` (`IdDisciplina`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `IdAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `disciplinas`
--
ALTER TABLE `disciplinas`
  MODIFY `IdDisciplina` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `professores`
--
ALTER TABLE `professores`
  MODIFY `IdProfessor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `turmas`
--
ALTER TABLE `turmas`
  MODIFY `IdTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `turmas`
--
ALTER TABLE `turmas`
  ADD CONSTRAINT `FK_Turmas_Disciplinas` FOREIGN KEY (`IdDisciplina`) REFERENCES `disciplinas` (`IdDisciplina`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Turmas_Professores` FOREIGN KEY (`IdProfessor`) REFERENCES `professores` (`IdProfessor`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

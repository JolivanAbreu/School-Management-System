-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/01/2025 às 02:00
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
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `alunos`
--

INSERT INTO `alunos` (`IdAluno`, `Nome`, `Nota`, `Frequencia`, `Email`, `Senha`) VALUES
(1, 'Carlos Souza', 88.50, 92.00, 'carlos.souza@escola.com', 'senha789'),
(2, 'Ana Paula', 75.00, 85.00, 'ana.paula@escola.com', 'senha101');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disciplinas`
--

CREATE TABLE `disciplinas` (
  `IdDisciplina` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Descricao` varchar(500) DEFAULT NULL,
  `IdProfessor` int(11) NOT NULL,
  `IdTurma` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `disciplinas`
--

INSERT INTO `disciplinas` (`IdDisciplina`, `Nome`, `Descricao`, `IdProfessor`, `IdTurma`) VALUES
(1, 'Matemática', 'Introdução à álgebra e geometria.', 1, 1),
(2, 'História', 'História do Brasil e Geral.', 2, 2);

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
(3, 'Teste', 'teste@escola.com', '$2y$10$7d4jdDXYwT23HN8zwbH8wenq/AuTYGNP2EyHDQi7lJ4Wm7.Tb1kA6', 1);

-- --------------------------------------------------------

--
-- Estrutura para tabela `turmas`
--

CREATE TABLE `turmas` (
  `IdTurma` int(11) NOT NULL,
  `Nome` varchar(100) NOT NULL,
  `Professor` varchar(100) NOT NULL,
  `Disciplina` varchar(100) NOT NULL,
  `Dia` varchar(50) NOT NULL,
  `Horario` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `turmas`
--

INSERT INTO `turmas` (`IdTurma`, `Nome`, `Professor`, `Disciplina`, `Dia`, `Horario`) VALUES
(1, 'Turma A', '', '', '', ''),
(2, 'Turma B', '', '', '', '');

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
  ADD PRIMARY KEY (`IdDisciplina`),
  ADD KEY `FK_Disciplinas_Professores` (`IdProfessor`),
  ADD KEY `FK_Disciplinas_Turmas` (`IdTurma`);

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
  ADD PRIMARY KEY (`IdTurma`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `alunos`
--
ALTER TABLE `alunos`
  MODIFY `IdAluno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `IdTurma` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `disciplinas`
--
ALTER TABLE `disciplinas`
  ADD CONSTRAINT `FK_Disciplinas_Professores` FOREIGN KEY (`IdProfessor`) REFERENCES `professores` (`IdProfessor`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_Disciplinas_Turmas` FOREIGN KEY (`IdTurma`) REFERENCES `turmas` (`IdTurma`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

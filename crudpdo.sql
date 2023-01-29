-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jan-2023 às 22:14
-- Versão do servidor: 10.4.27-MariaDB
-- versão do PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crudpdo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimo`
--

CREATE TABLE `emprestimo` (
  `id_emprestimo` int(11) NOT NULL,
  `fk_id` int(11) DEFAULT NULL,
  `fk_isbn` int(11) DEFAULT NULL,
  `data_emprestimo` date DEFAULT NULL,
  `data_devolucao` date DEFAULT NULL,
  `nome_livro` varchar(100) DEFAULT NULL,
  `nome_pessoa` varchar(100) DEFAULT NULL,
  `email_pessoa` varchar(100) DEFAULT NULL,
  `devolvido` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `emprestimo`
--

INSERT INTO `emprestimo` (`id_emprestimo`, `fk_id`, `fk_isbn`, `data_emprestimo`, `data_devolucao`, `nome_livro`, `nome_pessoa`, `email_pessoa`, `devolvido`) VALUES
(1, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(3, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(5, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(6, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(8, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(9, 148, 1, '2023-01-27', '2023-01-29', 'A cabana', 'Daniele', 'dani@gmail.com', 1),
(10, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(11, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(12, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(13, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(14, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(15, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(16, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(17, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(18, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(19, 148, 4, '2023-01-28', '2023-01-30', 'O poder da ação', 'Daniele', 'dani@gmail.com', 1),
(20, 148, 4, '2023-01-28', '2023-01-30', 'O poder da ação', 'Daniele', 'dani@gmail.com', 1),
(21, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(22, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(23, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(24, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(25, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(26, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(27, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(28, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(29, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(30, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(31, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(32, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(33, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(34, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(35, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(36, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(37, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(38, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(39, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(40, 148, 2, '2023-01-28', '2023-01-30', 'Nunca desista de seus sonhos', 'Daniele', 'dani@gmail.com', 1),
(41, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(42, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(43, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(44, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(45, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(46, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(47, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(48, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele', 'dani@gmail.com', 1),
(49, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele Munhoz', 'dani@gmail.com', 1),
(50, 148, 3, '2023-01-28', '2023-01-30', 'A garota do lago', 'Daniele Munhoz', 'dani@gmail.com', 1),
(51, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(52, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(53, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(54, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(55, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(56, 148, 9, '2023-01-28', '2023-02-04', 'Mafalda', 'Daniele Munhoz', 'dani@gmail.com', 1),
(57, 148, 7, '2023-01-28', '2023-02-04', 'O Guia dos Curiosos', 'Daniele Munhoz', 'dani@gmail.com', 1),
(58, 148, 2, '2023-01-28', '2023-02-04', 'Perdas e Ganhos', 'Daniele Munhoz', 'dani@gmail.com', 1),
(59, 148, 1, '2023-01-28', '2023-02-04', 'Quem Ama, Educa!', 'Daniele Munhoz', 'dani@gmail.com', 1),
(60, 148, 3, '2023-01-28', '2023-02-04', 'Sentimento do Mundo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(61, 148, 10, '2023-01-28', '2023-02-04', 'Turma da Mônica', 'Daniele Munhoz', 'dani@gmail.com', 1),
(62, 148, 8, '2023-01-28', '2023-02-04', 'Vitória!', 'Daniele Munhoz', 'dani@gmail.com', 1),
(63, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(64, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(65, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(66, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(67, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(68, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(69, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(70, 148, 6, '2023-01-28', '2023-02-04', 'Engenharia de Software', 'Daniele Munhoz', 'dani@gmail.com', 1),
(71, 148, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Daniele Munhoz', 'dani@gmail.com', 1),
(72, 160, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Wagner Leme', 'wagner.wesley.leme96@gmail.com', 0),
(73, 163, 6, '2023-01-29', '2023-02-05', 'Engenharia de Software', 'Estela', 'estela@gmail.com', 1),
(74, 163, 9, '2023-01-29', '2023-02-05', 'Mafalda', 'Estela', 'estela@gmail.com', 1),
(75, 163, 9, '2023-01-29', '2023-02-05', 'Mafalda', 'Estela', 'estela@gmail.com', 1),
(76, 163, 6, '2023-01-29', '2023-02-05', 'Engenharia de Software', 'Estela', 'estela@gmail.com', 0),
(77, 148, 7, '2023-01-29', '2023-02-05', 'O Guia dos Curiosos', 'Daniele Munhoz', 'dani@gmail.com', 1),
(78, 148, 1, '2023-01-29', '2023-02-05', 'Quem Ama, Educa!', 'Daniele Munhoz', 'dani@gmail.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `isbn` int(11) NOT NULL,
  `nome` varchar(50) DEFAULT NULL,
  `edicao` varchar(20) DEFAULT NULL,
  `editora` varchar(20) DEFAULT NULL,
  `autor` varchar(40) DEFAULT NULL,
  `dataPublicacao` date DEFAULT NULL,
  `idioma` varchar(10) DEFAULT NULL,
  `numeroPagina` int(11) DEFAULT NULL,
  `categoria` varchar(100) DEFAULT NULL,
  `quantidade` tinyint(11) NOT NULL,
  `reservar` int(11) NOT NULL,
  `fk_id_pessoa` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`isbn`, `nome`, `edicao`, `editora`, `autor`, `dataPublicacao`, `idioma`, `numeroPagina`, `categoria`, `quantidade`, `reservar`, `fk_id_pessoa`) VALUES
(1, 'Quem Ama, Educa!', '1° edição', 'Integrare ', 'Icami tiba', '2015-02-05', 'Português', 120, 'leitura-comportamento', 2, 0, 148),
(2, 'Perdas e Ganhos', '1° edição', 'Record', 'Lya Luft', '2004-06-01', 'Português', 120, 'leitura-comportamento', 4, 0, 148),
(3, 'Sentimento do Mundo', '1° edição', ' Companhia de Bolso', 'Carlos Drummond de Andrade', '2012-10-09', 'Português', 150, 'leitura-comportamento', 3, 0, 148),
(4, 'Como Fazer Quase Tudo', '1° edição', 'Readers Digest', 'Readers Digest', '2006-08-02', 'Português', 90, 'tecnicos-profissionais', 0, 0, 160),
(5, 'O Código da Vinci', '1° edição', 'Arqueiro', 'Dan Brown', '2013-03-06', 'Português', 240, 'leitura-comportamento', 0, 0, NULL),
(6, 'Engenharia de Software', '1° edição', 'Makron Books', 'Roger S. PRESMAN', '1995-08-03', 'Português', 415, 'tecnicos-profissionais', 2, 0, 163),
(7, 'O Guia dos Curiosos', '2° edição', 'Cia das letras', 'Marcelo Duarte', '1996-07-04', 'Português', 63, 'equilibrio-pessoal', 4, 0, 148),
(8, 'Vitória!', '2° edição', 'Globo', 'Cida Santos \\\\ Nicolau Radamés Creti', '1994-09-19', 'Português', 49, 'equilibrio-pessoal', 2, 0, 148),
(9, 'Mafalda', '1° edição', 'Martins Fontes', 'Quino', '1989-03-04', 'Português', 30, 'periodicos', 3, 0, 163),
(10, 'Turma da Mônica', '1° edição', 'Panini', 'Mauricio de Sousa', '2011-07-06', 'Português', 31, 'periodicos', 7, 0, 148);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa`
--

CREATE TABLE `pessoa` (
  `id` int(11) NOT NULL,
  `nome` varchar(40) DEFAULT NULL,
  `telefone` varchar(15) DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `endereco` varchar(50) DEFAULT NULL,
  `senha` varchar(32) DEFAULT NULL,
  `permissao` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoa`
--

INSERT INTO `pessoa` (`id`, `nome`, `telefone`, `email`, `endereco`, `senha`, `permissao`) VALUES
(146, 'Administrador', '11 9 71466919', 'admin@admin.com', 'Rua admin', '144a3f71a03ab7c4f46f9656608efdb2', 'Administrador'),
(148, 'Daniele Munhoz', '11 9 7348 5263', 'dani@gmail.com', 'Rua Benedito Rita', '144a3f71a03ab7c4f46f9656608efdb2', 'Padrão'),
(159, 'Paulo Leme', '11 9 9571-8543', 'paulo.oph@hotmail.com', 'Euclides lopes terron', '144a3f71a03ab7c4f46f9656608efdb2', 'Administrador'),
(160, 'Wagner Leme', '11 9 7146-6919', 'wagner.wesley.leme96@gmail.com', 'Rua Benedito Rita', '144a3f71a03ab7c4f46f9656608efdb2', 'Padrão'),
(162, 'Geraldo Aparecido', '11 9 74899044', 'geraldo@gmail.com', 'Rua Benedito Rita', '144a3f71a03ab7c4f46f9656608efdb2', 'Padrão'),
(163, 'Estela', '145236512123', 'estela@gmail.com', 'Rua Benedito Rita', '144a3f71a03ab7c4f46f9656608efdb2', 'Padrão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_livro`
--

CREATE TABLE `pessoa_livro` (
  `id_emprestimo` int(11) NOT NULL,
  `fk_id` int(11) DEFAULT NULL,
  `fk_isbn` int(11) DEFAULT NULL,
  `data_emprestimo` date NOT NULL,
  `data_devolucao` date NOT NULL,
  `nome_Livro` varchar(100) NOT NULL,
  `nome_pessoa` varchar(100) NOT NULL,
  `email_pessoa` varchar(100) NOT NULL,
  `devolvido` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Extraindo dados da tabela `pessoa_livro`
--

INSERT INTO `pessoa_livro` (`id_emprestimo`, `fk_id`, `fk_isbn`, `data_emprestimo`, `data_devolucao`, `nome_Livro`, `nome_pessoa`, `email_pessoa`, `devolvido`) VALUES
(440, 160, 4, '2023-01-28', '2023-02-04', 'Como Fazer Quase Tudo', 'Wagner Leme', 'wagner.wesley.leme96@gmail.com', 0),
(444, 163, 6, '2023-01-29', '2023-02-05', 'Engenharia de Software', 'Estela', 'estela@gmail.com', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  ADD PRIMARY KEY (`id_emprestimo`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`isbn`),
  ADD KEY `fk_id_pessoa` (`fk_id_pessoa`);

--
-- Índices para tabela `pessoa`
--
ALTER TABLE `pessoa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `pessoa_livro`
--
ALTER TABLE `pessoa_livro`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `fk_id` (`fk_id`),
  ADD KEY `fk_isbn` (`fk_isbn`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `emprestimo`
--
ALTER TABLE `emprestimo`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT de tabela `pessoa_livro`
--
ALTER TABLE `pessoa_livro`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=447;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `livros_ibfk_1` FOREIGN KEY (`fk_id_pessoa`) REFERENCES `pessoa` (`id`);

--
-- Limitadores para a tabela `pessoa_livro`
--
ALTER TABLE `pessoa_livro`
  ADD CONSTRAINT `pessoa_livro_ibfk_1` FOREIGN KEY (`fk_id`) REFERENCES `pessoa` (`id`),
  ADD CONSTRAINT `pessoa_livro_ibfk_2` FOREIGN KEY (`fk_isbn`) REFERENCES `livros` (`isbn`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 29-Jan-2023 às 23:34
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
(79, 167, 857608502, '2023-01-29', '2023-02-05', 'Use A Cabeça! PHP e MySQL', 'Padrão', 'padrao@padrao.com', 1),
(80, 167, 978857255, '2023-01-29', '2023-02-05', 'Valores - Natureza e Equilíbrio', 'Padrão', 'padrao@padrao.com', 1),
(81, 167, 2147483647, '2023-01-29', '2023-02-05', 'Engenharia de software', 'Padrão', 'padrao@padrao.com', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `isbn` int(20) NOT NULL,
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
(857608502, 'Use A Cabeça! PHP e MySQL', '1° edição', 'Alta Books', 'Lynn Beighley', '2010-05-20', 'Português', 808, 'Tecnico Profissionais', 2, 0, 167),
(978857255, 'Valores - Natureza e Equilíbrio', '1° edição', 'FTD Educação', 'Gabriel Chalita', '2011-01-01', 'Português', 64, 'Equilibrio Pessoal', 6, 0, 167),
(2147483647, 'Engenharia de software', '1° edição', 'AMGH', 'Roger S. PRESMAN', '2021-07-05', 'Português', 704, 'Tecnico Profissionais', 3, 0, 167);

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
(166, 'Administrador', '(11) 9 7452-631', 'admin@admin.com', 'Rua Benedito Rita', '21232f297a57a5a743894a0e4a801fc3', 'Administrador'),
(167, 'Padrão', '(11) 9 7452-685', 'padrao@padrao.com', 'Rua José Domingues', 'f57e6cb73b8273814c84aec62a3f5ce4', 'Padrão');

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
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT de tabela `pessoa`
--
ALTER TABLE `pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=168;

--
-- AUTO_INCREMENT de tabela `pessoa_livro`
--
ALTER TABLE `pessoa_livro`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=450;

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

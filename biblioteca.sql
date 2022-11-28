-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 30-Jun-2022 às 20:09
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_livros`
--

CREATE TABLE `cadastro_livros` (
  `id_livro` int(11) NOT NULL,
  `genero` varchar(20) NOT NULL,
  `isbn` varchar(13) NOT NULL,
  `tombo` varchar(20) NOT NULL,
  `titulo` varchar(200) NOT NULL,
  `autores` varchar(200) NOT NULL,
  `edicao` varchar(2) NOT NULL,
  `ano` varchar(4) NOT NULL,
  `editora` varchar(20) NOT NULL,
  `exemplar` varchar(4) NOT NULL,
  `observacoes` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro_livros`
--

INSERT INTO `cadastro_livros` (`id_livro`, `genero`, `isbn`, `tombo`, `titulo`, `autores`, `edicao`, `ano`, `editora`, `exemplar`, `observacoes`) VALUES
(1, 'literatura', '9788501044457', '12345678', 'O diario de Anne Frank', 'Anne Frank', '1', '2016', 'Record', '1', '   '),
(2, 'literatura', '9788599296554', '0987654', 'O Simbolo Perdido', 'Dan Brown', '1', '2009', 'Sextante', '1', '   ');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cadastro_usuarios`
--

CREATE TABLE `cadastro_usuarios` (
  `id_usuario` int(11) NOT NULL,
  `tipo_usuario` varchar(1) NOT NULL,
  `matcpf` varchar(20) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(12) NOT NULL,
  `celular` varchar(12) NOT NULL,
  `login` varchar(50) NOT NULL,
  `senha` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cadastro_usuarios`
--

INSERT INTO `cadastro_usuarios` (`id_usuario`, `tipo_usuario`, `matcpf`, `nome`, `email`, `telefone`, `celular`, `login`, `senha`) VALUES
(2, 'B', '12345678', 'bibliotecario', 'bibliotecario@bibliotecario', '4899999999', '4899999999', 'bibliotecario', '18042a2d9336bf77016b1e21d915bed6'),
(3, 'A', '09876543', 'Aluno', 'aluno@aluno', '489999999', '489999999', 'aluno', 'ca0cd09a12abade3bf0777574d9f987f'),
(4, 'P', '456789', 'Professor', 'professor@professor', '489999999', '489999999', 'professor', '3f9cd3c7b11eb1bae99dddb3d05da3c5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `emprestimos`
--

CREATE TABLE `emprestimos` (
  `id_emprestimo` int(11) NOT NULL,
  `id_livro` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` varchar(10) NOT NULL,
  `data_devolucao` varchar(10) NOT NULL,
  `renovacoes` varchar(1) NOT NULL,
  `emstatus` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `emprestimos`
--

INSERT INTO `emprestimos` (`id_emprestimo`, `id_livro`, `id_usuario`, `data`, `data_devolucao`, `renovacoes`, `emstatus`) VALUES
(1, 1, 3, '30-06-2022', '14-07-2022', '1', 'D'),
(2, 1, 3, '30-06-2022', '07-07-2022', '0', 'E');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cadastro_livros`
--
ALTER TABLE `cadastro_livros`
  ADD PRIMARY KEY (`id_livro`);

--
-- Índices para tabela `cadastro_usuarios`
--
ALTER TABLE `cadastro_usuarios`
  ADD PRIMARY KEY (`id_usuario`);

--
-- Índices para tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD PRIMARY KEY (`id_emprestimo`),
  ADD KEY `id_livro` (`id_livro`,`id_usuario`),
  ADD KEY `id_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cadastro_livros`
--
ALTER TABLE `cadastro_livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cadastro_usuarios`
--
ALTER TABLE `cadastro_usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  MODIFY `id_emprestimo` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `emprestimos`
--
ALTER TABLE `emprestimos`
  ADD CONSTRAINT `emprestimos_ibfk_1` FOREIGN KEY (`id_livro`) REFERENCES `cadastro_livros` (`id_livro`),
  ADD CONSTRAINT `emprestimos_ibfk_2` FOREIGN KEY (`id_usuario`) REFERENCES `cadastro_usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

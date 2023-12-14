-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 10-Out-2023 às 09:39
-- Versão do servidor: 10.4.28-MariaDB
-- versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `gestao_de_expediente_db`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `nome`, `descricao`, `created_at`, `updated_at`) VALUES
(2, 'Director', 'Comandar as actividades da Direccao', '2023-07-20 13:18:43', '2023-07-20 13:18:43'),
(3, 'Tecnico Informatico', 'Tecnico Informatico..', '2023-07-20 13:19:11', '2023-07-20 13:19:11'),
(4, 'Chefe do Grupo', 'Chefe do Grupo', '2023-07-20 13:19:28', '2023-07-20 13:19:28'),
(5, 'PCA', 'pca', '2023-07-20 13:19:39', '2023-07-20 13:19:39');

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `cursos`
--

INSERT INTO `cursos` (`id`, `nome`, `sigla`, `created_at`, `updated_at`) VALUES
(1, 'Informática de Sistema', 'IS', '2023-07-24 08:53:58', '2023-07-24 08:53:58'),
(2, 'Contabilidade e Auditoria...', 'CA', '2023-07-24 08:54:18', '2023-07-28 05:10:23'),
(3, 'Direito', 'DR', '2023-07-28 05:09:26', '2023-07-28 05:09:26');

-- --------------------------------------------------------

--
-- Estrutura da tabela `departamentos`
--

CREATE TABLE `departamentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `sigla` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `departamentos`
--

INSERT INTO `departamentos` (`id`, `nome`, `descricao`, `sigla`, `created_at`, `updated_at`) VALUES
(2, 'Departamento de Registro Academico', 'Departamento de Registro Academico', 'DRA', '2023-07-19 06:58:51', '2023-07-19 09:56:22'),
(3, 'Departamento da Dirrecção Financeira', 'Departamento da Dirrecção Financeira', 'DDF', '2023-07-19 09:56:50', '2023-07-19 09:56:50'),
(4, 'Departamento de Conteciosos', 'Departamento de Conteciosos', 'DC', '2023-07-19 09:57:15', '2023-07-19 09:57:15');

-- --------------------------------------------------------

--
-- Estrutura da tabela `documentos`
--

CREATE TABLE `documentos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `expediente_id` bigint(20) UNSIGNED NOT NULL,
  `nome_unico` varchar(255) NOT NULL,
  `nome_original` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `documentos`
--

INSERT INTO `documentos` (`id`, `expediente_id`, `nome_unico`, `nome_original`, `created_at`, `updated_at`) VALUES
(5, 3, 'expediente_64d355ea4dd20_Politica de Sistema de Tecnologias de Informática da CM.PDF', 'Politica de Sistema de Tecnologias de Informática da CM.PDF', '2023-08-09 07:01:30', '2023-08-09 07:01:30'),
(6, 3, 'expediente_64d356079d7a1_Politica de Sistema de Tecnologias de Informática da CM.PDF', 'Politica de Sistema de Tecnologias de Informática da CM.PDF', '2023-08-09 07:01:59', '2023-08-09 07:01:59'),
(7, 3, 'expediente_64d3574e58963_DTI.PO.002.00 Processo de Gestão e Manutenção de Sistemas de Suporte.doc', 'DTI.PO.002.00 Processo de Gestão e Manutenção de Sistemas de Suporte.doc', '2023-08-09 07:07:26', '2023-08-09 07:07:26'),
(8, 3, 'expediente_64d3574e6a702_Lista de pessoas autorizadas a acessar salas de servidores mKesh_vf.pdf', 'Lista de pessoas autorizadas a acessar salas de servidores mKesh_vf.pdf', '2023-08-09 07:07:26', '2023-08-09 07:07:26'),
(9, 4, 'expediente_64d35777040ba_Politica de Sistema de Tecnologias de Informática da CM.PDF', 'Politica de Sistema de Tecnologias de Informática da CM.PDF', '2023-08-09 07:08:07', '2023-08-09 07:08:07'),
(10, 4, 'expediente_64d3592e82358_Lista de pessoas autorizadas a acessar salas de servidores mKesh_vf.pdf', 'Lista de pessoas autorizadas a acessar salas de servidores mKesh_vf.pdf', '2023-08-09 07:15:26', '2023-08-09 07:15:26'),
(11, 6, 'expediente_64d35c427dd7d_Horario de Inf..pdf', 'Horario de Inf..pdf', '2023-08-09 07:28:34', '2023-08-09 07:28:34'),
(12, 8, 'expediente_64e264b582815_Configuracao Metabase Final.txt', 'Configuracao Metabase Final.txt', '2023-08-20 17:08:37', '2023-08-20 17:08:37'),
(13, 8, 'expediente_64e387923650d_atalhos.txt', 'atalhos.txt', '2023-08-21 13:49:38', '2023-08-21 13:49:38');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagio_processos`
--

CREATE TABLE `estagio_processos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `tempo_estimado_conclusao` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `parent_estagio_processo_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estagio_processos`
--

INSERT INTO `estagio_processos` (`id`, `nome`, `descricao`, `tempo_estimado_conclusao`, `created_at`, `updated_at`, `parent_estagio_processo_id`) VALUES
(7, 'Recebimento na Secretaria e Encaminhamento', 'Recebimento na Secretaria e Encaminhamento', 3, '2023-08-03 08:19:13', '2023-08-03 11:17:37', NULL),
(12, 'Aprovação do Coordenador do Curso', 'Aprovação do Coordenador do Curso', 2, '2023-08-03 10:37:18', '2023-08-03 11:20:48', 7),
(14, 'Aprovação da Direção Academica', 'Aprovação da Direção Academica', 3, '2023-08-03 11:04:42', '2023-08-03 11:29:05', 12),
(15, 'Aprovação do Director Geral', 'Aprovação do Director Geral', 4, '2023-08-03 11:31:55', '2023-08-03 11:31:55', 14),
(16, 'PCA', 'PCA', 2, '2023-08-03 12:50:58', '2023-08-03 12:50:58', 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estagio_processo_tipo_expediente`
--

CREATE TABLE `estagio_processo_tipo_expediente` (
  `estagio_processo_id` bigint(20) UNSIGNED NOT NULL,
  `tipo_expediente_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estagio_processo_tipo_expediente`
--

INSERT INTO `estagio_processo_tipo_expediente` (`estagio_processo_id`, `tipo_expediente_id`) VALUES
(7, 6),
(12, 6),
(14, 6),
(7, 12),
(12, 12),
(14, 12),
(7, 13),
(12, 13),
(14, 13);

-- --------------------------------------------------------

--
-- Estrutura da tabela `estudantes`
--

CREATE TABLE `estudantes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `apelido` varchar(255) NOT NULL,
  `codigo` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `curso_id` bigint(20) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `estudantes`
--

INSERT INTO `estudantes` (`id`, `nome`, `apelido`, `codigo`, `contacto`, `morada`, `created_at`, `updated_at`, `curso_id`) VALUES
(1, 'John', 'Doe', '123', 'john@example.com', '123 Main St', '2023-07-19 07:19:09', '2023-07-19 07:19:09', 1),
(2, 'sadd', 'Macamo', '2019142', '84491313', 'Hulene Rua 15', '2023-07-19 07:22:40', '2023-07-19 07:22:40', 1),
(3, 'Vânio Aníbal Macamo', 'Macamo', '1111', '11111', '111', '2023-07-27 16:28:06', '2023-08-02 12:12:12', 1),
(4, 'Yuran Artur', 'Mauaie', '2019430', '84491313', 'Hulene Rua 15', '2023-10-08 08:34:57', '2023-10-08 08:34:57', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `expedientes`
--

CREATE TABLE `expedientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` text NOT NULL,
  `data_submissao` date NOT NULL,
  `tipo_expediente_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `estagio_processo_id` bigint(20) UNSIGNED NOT NULL,
  `estudante_id` bigint(20) UNSIGNED NOT NULL,
  `data_inicio_estagio` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `expedientes`
--

INSERT INTO `expedientes` (`id`, `nome`, `descricao`, `data_submissao`, `tipo_expediente_id`, `created_at`, `updated_at`, `estagio_processo_id`, `estudante_id`, `data_inicio_estagio`) VALUES
(3, 'Expediente', 'Expediente Descricao', '2023-07-20', 6, '2023-07-19 07:32:27', '2023-08-03 11:34:58', 15, 3, '2023-08-09'),
(4, 'a', 'a', '2023-07-20', 13, '2023-07-20 07:21:36', '2023-08-03 12:51:13', 16, 3, '2023-08-07'),
(5, 'Actividade 1 Teste', 'b', '2023-08-02', 6, '2023-08-02 12:53:42', '2023-08-03 13:34:05', 14, 2, '2023-08-01'),
(6, 'bbb', 'c', '2023-08-10', 13, '2023-08-03 12:45:10', '2023-08-03 12:45:10', 7, 3, '2023-08-05'),
(7, 'Pedido de Notas do primeiro ano', 'Estou a pedir notas do primeiro ano conforme ja viemos falando', '2023-08-11', 6, '2023-08-11 07:13:25', '2023-08-11 07:13:25', 7, 1, '2023-08-11'),
(8, 'Pedido de Notas do primeiro ano Segundo Semestre', 'Pedido de Notas do primeiro ano Segundo Semestre', '2023-08-20', 6, '2023-08-20 17:02:14', '2023-08-20 17:02:14', 7, 3, '2023-08-20');

-- --------------------------------------------------------

--
-- Estrutura da tabela `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionarios`
--

CREATE TABLE `funcionarios` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `morada` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `contacto` varchar(255) NOT NULL,
  `genero` varchar(255) NOT NULL,
  `num_bi` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionarios`
--

INSERT INTO `funcionarios` (`id`, `nome`, `morada`, `email`, `contacto`, `genero`, `num_bi`, `created_at`, `updated_at`) VALUES
(1, 'Vanio Anibal  Macamo', 'Hulene Rua 15', 'macamovanioanibal@gmail.com', '84491313', 'Masculino', '1213143EERE', '2023-07-20 10:38:54', '2023-07-20 12:10:09'),
(3, 'Antonio Fernando Cuna', 'Hulene Rua 15', 'admin@example.com', '82123421', 'Masculino', '211111', '2023-07-24 08:18:19', '2023-07-28 04:39:16'),
(4, 'Pedro Antonio Fonseca', 'uhijokpl', 'h.@a', '8213731891', 'Masculino', '2132132', '2023-07-28 08:19:10', '2023-07-28 08:19:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_comentario_expediente`
--

CREATE TABLE `funcionario_comentario_expediente` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `funcionario_id` bigint(20) UNSIGNED NOT NULL,
  `expediente_id` bigint(20) UNSIGNED NOT NULL,
  `comentario` text NOT NULL,
  `data_comentario` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionario_comentario_expediente`
--

INSERT INTO `funcionario_comentario_expediente` (`id`, `funcionario_id`, `expediente_id`, `comentario`, `data_comentario`, `created_at`, `updated_at`) VALUES
(1, 1, 3, 'Comentario Teste1', '2023-08-03 07:20:07', NULL, NULL),
(2, 1, 3, 'Testando os Comentarios.', '2023-08-03 07:22:28', NULL, NULL),
(3, 1, 4, 'TTT', '2023-08-03 07:24:30', NULL, NULL),
(4, 1, 4, 'HJK', '2023-08-03 07:25:30', NULL, NULL),
(5, 1, 4, 'Fazendo outro Teste', '2023-08-03 07:40:20', NULL, NULL),
(6, 1, 3, 'kja.c bjsavIadacdmasd', '2023-08-09 07:47:45', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario_departamento_cargo`
--

CREATE TABLE `funcionario_departamento_cargo` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `funcionario_id` bigint(20) UNSIGNED NOT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL,
  `cargo_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `funcionario_departamento_cargo`
--

INSERT INTO `funcionario_departamento_cargo` (`id`, `funcionario_id`, `departamento_id`, `cargo_id`, `created_at`, `updated_at`) VALUES
(6, 1, 2, 3, '2023-07-28 04:38:16', '2023-07-28 04:38:16'),
(7, 3, 2, 4, '2023-07-28 04:39:54', '2023-07-28 05:01:49');

-- --------------------------------------------------------

--
-- Estrutura da tabela `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 2),
(6, '2023_07_12_082814_create_tipo_expediente_table', 3),
(7, '2023_07_12_083330_create_tipo_expediente_table', 4),
(8, '2023_07_18_095909_create_departamentos_table', 5),
(9, '2023_07_18_122239_create_estagio_processos_table', 6),
(10, '2023_07_18_122545_add_parent_estagio_processo_to_estagio_processos_table', 7),
(11, '2023_07_18_152002_create_expedientes_table', 8),
(12, '2023_07_18_152131_add_tipo_expediente_id_to_expedientes', 9),
(13, '2023_07_18_155723_create_expedientes_table', 10),
(14, '2023_07_18_155914_create_expedientes_table', 11),
(15, '2023_07_18_160120_add_tipo_expediente_id_to_expedientes', 12),
(16, '2023_07_18_175043_create_estudantes_table', 13),
(17, '2023_07_19_091744_create_estudantes_table', 14),
(18, '2023_07_19_144903_create_estagio_processo_tipo_expediente_table', 15),
(19, '2023_07_19_142736_create_cursos_table', 16),
(20, '2023_07_20_102807_create_funcionarios_table', 17),
(21, '2023_07_20_103013_create_funcionarios_table', 18),
(22, '2023_07_20_144548_create_cargos_table', 19),
(23, '2023_07_20_152613_create_funcionario_departamento_cargo_table', 20),
(24, '2023_07_24_093304_add_curso_id_to_estudantes_table', 21),
(25, '2023_07_24_095501_remove_curso_column_from_estudantes_table', 21),
(26, '2023_07_24_123001_create_roles_table', 22),
(27, '2023_07_24_123748_create_permissions_table', 23),
(28, '2023_07_24_124411_create_permission_role_table', 24),
(29, '2023_07_24_124514_create_role_user_table', 25),
(30, '2023_07_24_155952_add_userable_to_users_table', 26),
(31, '2023_07_24_175345_add_tipo_usuario_to_users_table', 27),
(32, '2023_07_26_120326_add_estado_to_users_table', 28),
(33, '2023_08_03_082341_create_funcionario_comentario_expediente_table', 29),
(34, '2023_08_09_084930_create_documentos_table', 30),
(36, '2023_08_11_085219_add_data_inicio_estagio_to_expedientes', 31);

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `created_at`, `updated_at`) VALUES
(6, 'Cadastrar Funcionario', NULL, NULL),
(7, 'Editar Funcionario', NULL, NULL),
(8, 'Visualizar Funcionario', NULL, NULL),
(9, 'Apagar Funcionario', NULL, NULL),
(10, 'Cadastrar Estudante', '2023-07-28 07:02:19', '2023-07-28 07:02:19'),
(11, 'Editar Estudante', '2023-07-28 07:02:19', '2023-07-28 07:02:19'),
(12, 'Visualizar Estudante', '2023-07-28 07:02:19', '2023-07-28 07:02:19'),
(13, 'Apagar Estudante', '2023-07-28 07:02:19', '2023-07-28 07:02:19'),
(14, 'Cadastrar Departamento', '2023-07-28 07:02:19', '2023-07-28 07:02:19'),
(15, 'Editar Departamento', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(16, 'Visualizar Departamento', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(17, 'Apagar Departamento', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(18, 'Cadastrar Curso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(19, 'Editar Curso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(20, 'Visualizar Curso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(21, 'Apagar Curso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(22, 'Cadastrar Alocacao', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(23, 'Editar Alocacao', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(24, 'Visualizar Alocacao', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(25, 'Apagar Alocacao', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(26, 'Cadastrar Cargo', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(27, 'Editar Cargo', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(28, 'Visualizar Cargo', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(29, 'Apagar Cargo', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(30, 'Cadastrar EstagioProcesso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(31, 'Editar EstagioProcesso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(32, 'Visualizar EstagioProcesso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(33, 'Apagar EstagioProcesso', '2023-07-28 07:02:20', '2023-07-28 07:02:20'),
(34, 'Cadastrar Expediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(35, 'Editar Expediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(36, 'Visualizar Expediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(37, 'Apagar Expediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(38, 'Cadastrar Role', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(39, 'Editar Role', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(40, 'Visualizar Role', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(41, 'Apagar Role', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(42, 'Cadastrar TipoExpediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(43, 'Editar TipoExpediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(44, 'Visualizar TipoExpediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(45, 'Apagar TipoExpediente', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(46, 'Cadastrar User', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(47, 'Editar User', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(48, 'Visualizar User', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(49, 'Apagar User', '2023-07-28 07:02:21', '2023-07-28 07:02:21'),
(50, 'Cadastrar Permission', '2023-08-03 05:41:17', '2023-08-03 05:41:17'),
(51, 'Editar Permission', '2023-08-03 05:41:17', '2023-08-03 05:41:17'),
(52, 'Visualizar Permission', '2023-08-03 05:41:17', '2023-08-03 05:41:17'),
(53, 'Apagar Permission', '2023-08-03 05:41:17', '2023-08-03 05:41:17');

-- --------------------------------------------------------

--
-- Estrutura da tabela `permission_role`
--

CREATE TABLE `permission_role` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `permission_role`
--

INSERT INTO `permission_role` (`id`, `permission_id`, `role_id`, `created_at`, `updated_at`) VALUES
(12, 6, 1, NULL, NULL),
(14, 8, 1, NULL, NULL),
(17, 6, 4, NULL, NULL),
(18, 8, 4, NULL, NULL),
(20, 7, 1, NULL, NULL),
(21, 9, 1, NULL, NULL),
(22, 10, 1, NULL, NULL),
(23, 11, 1, NULL, NULL),
(24, 12, 1, NULL, NULL),
(25, 13, 1, NULL, NULL),
(26, 12, 5, NULL, NULL),
(27, 14, 1, NULL, NULL),
(28, 15, 1, NULL, NULL),
(29, 16, 1, NULL, NULL),
(30, 17, 1, NULL, NULL),
(31, 18, 1, NULL, NULL),
(32, 19, 1, NULL, NULL),
(33, 20, 1, NULL, NULL),
(34, 21, 1, NULL, NULL),
(35, 22, 1, NULL, NULL),
(36, 23, 1, NULL, NULL),
(37, 24, 1, NULL, NULL),
(38, 25, 1, NULL, NULL),
(39, 26, 1, NULL, NULL),
(40, 27, 1, NULL, NULL),
(41, 28, 1, NULL, NULL),
(42, 29, 1, NULL, NULL),
(43, 30, 1, NULL, NULL),
(44, 31, 1, NULL, NULL),
(45, 32, 1, NULL, NULL),
(46, 33, 1, NULL, NULL),
(47, 34, 1, NULL, NULL),
(48, 35, 1, NULL, NULL),
(49, 36, 1, NULL, NULL),
(50, 37, 1, NULL, NULL),
(51, 38, 1, NULL, NULL),
(52, 39, 1, NULL, NULL),
(53, 40, 1, NULL, NULL),
(54, 41, 1, NULL, NULL),
(55, 42, 1, NULL, NULL),
(56, 43, 1, NULL, NULL),
(57, 44, 1, NULL, NULL),
(58, 45, 1, NULL, NULL),
(59, 46, 1, NULL, NULL),
(60, 47, 1, NULL, NULL),
(61, 48, 1, NULL, NULL),
(62, 49, 1, NULL, NULL),
(63, 50, 1, NULL, NULL),
(64, 51, 1, NULL, NULL),
(65, 52, 1, NULL, NULL),
(66, 53, 1, NULL, NULL),
(67, 35, 5, NULL, NULL),
(68, 36, 5, NULL, NULL),
(69, 34, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', '2023-07-24 12:44:39', '2023-07-24 13:20:38'),
(3, 'Admin', '2023-07-24 12:53:12', '2023-07-24 13:20:54'),
(4, 'Secretaria', '2023-07-24 13:21:32', '2023-07-24 13:21:32'),
(5, 'Estudante', '2023-08-02 12:10:03', '2023-08-02 12:10:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `role_user`
--

CREATE TABLE `role_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `role_user`
--

INSERT INTO `role_user` (`id`, `role_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 4, 2, NULL, NULL),
(2, 1, 3, NULL, NULL),
(5, 1, 6, NULL, NULL),
(7, 3, 6, NULL, NULL),
(12, 1, 1, NULL, NULL),
(13, 5, 8, NULL, NULL),
(19, 1, 15, NULL, NULL),
(20, 5, 17, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_expedientes`
--

CREATE TABLE `tipo_expedientes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `departamento_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `tipo_expedientes`
--

INSERT INTO `tipo_expedientes` (`id`, `nome`, `descricao`, `created_at`, `updated_at`, `departamento_id`) VALUES
(6, 'Declaração de Notas', 'Quando um estudante precisar de notas', '2023-07-12 08:12:33', '2023-07-19 09:57:54', 2),
(12, 'Mudança de Turnos', 'Expediente de mUDANCAS DE UAS', '2023-07-12 15:47:20', '2023-07-19 09:58:15', 2),
(13, 'Pedido de Bolsa de Estudos', 'Pedido de Bolsa de Estudos', '2023-07-19 10:04:44', '2023-07-19 10:04:44', 3);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `userable_id` bigint(20) UNSIGNED DEFAULT NULL,
  `userable_type` varchar(255) DEFAULT NULL,
  `tipo_usuario` varchar(255) DEFAULT NULL,
  `estado` varchar(255) NOT NULL DEFAULT 'Activo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `userable_id`, `userable_type`, `tipo_usuario`, `estado`) VALUES
(1, 'Vanio Anibal Macamo', 'macamovanioanibal@gmail.comm', NULL, '$2y$10$PnafPzt/4EpairN/EqxAQuwxnLZpbn1oxLY2STKsxdWPIlZ0ea5n2', 'KNaGZhGM8eU4dYV93zI2SIPiPMlJ3CeeFcn0ZqMpFOasT1OXLNIpNjyBg4zH', '2023-07-07 10:39:57', '2023-08-18 05:30:46', 1, 'App\\Models\\Funcionario', 'Funcionario', 'Activo'),
(2, 'Vanio Anibal Macamo', 'test@teste.co.mz', NULL, '$2y$10$ZZ7xbN1uMUGxu3f4tLvWZ.UuWgPABeYbTfMwlfcFlsXCgNjvwFqLa', NULL, '2023-07-24 16:03:40', '2023-07-24 16:03:41', 1, 'App\\Models\\Funcionario', NULL, 'Activo'),
(3, 'aaa', 'admin@example.com', NULL, '$2y$10$WYVHwa5aLUjPZt5p47tSie46izdXaYZbmG8ao5DPHWiLofV4aQzhm', NULL, '2023-07-24 16:07:17', '2023-07-24 16:07:17', 3, 'App\\Models\\Funcionario', NULL, 'Activo'),
(6, 'Quessane Paulo Joaquim', 'vanio.macamo@exi.co.mz', NULL, '$2y$10$urBnErbxAYB78cOWxS.Jx.0KFurLdhVhMYSj0WmeXzV6OBSsoOX1a', NULL, '2023-07-26 10:05:56', '2023-07-26 13:12:32', 1, 'App\\Models\\Estudante', 'Estudante', 'Activo'),
(8, 'vanio', 'vaniocor@gmail.com', NULL, '$2y$10$voq/CBuJOjN8VnA4BSXUg.CpuoH3UJj/kdYXZtVZ5TCibGVY62zrG', NULL, '2023-08-02 12:12:56', '2023-08-02 12:12:56', 3, 'App\\Models\\Estudante', 'Estudante', 'Activo'),
(15, 'Vanio Anibal Macamo Super Admin', 'macamovanioanibal@gmail.com', NULL, '$2y$10$ara0irBHdY.St8JjFMxfNeNoeZbyv32IILhplKUGIidTR2iqNFMyS', 'PAXYXsqMmZoYN4FipwLOtZeXVQwbuGBr41Hi1HcRgZlZM2P2C5J1rVj3ryoq', '2023-08-18 06:04:10', '2023-08-20 16:20:16', 4, 'App\\Models\\Funcionario', 'Funcionario', 'Activo'),
(16, 'Ana Beula', 'test@teaste.co.mz', NULL, '$2y$10$e5wjYtgb8zeAPGkOM.wBWuuzSSYiIMkPGjlhRhSBvbmrGvNzre.ie', NULL, '2023-10-08 08:07:08', '2023-10-08 08:07:08', NULL, NULL, NULL, 'Activo'),
(17, 'yuran', 'yuranarturmawae@gmail.com', NULL, '$2y$10$oPX1ggoo9dq/sa3NHxxndeH874BXp69RAVDfBVT47zOj57oQ2xfmm', NULL, '2023-10-08 08:36:50', '2023-10-08 08:36:58', 4, 'App\\Models\\Estudante', 'Estudante', 'Activo');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `departamentos`
--
ALTER TABLE `departamentos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `documentos`
--
ALTER TABLE `documentos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documentos_nome_unico_unique` (`nome_unico`),
  ADD KEY `documentos_expediente_id_foreign` (`expediente_id`);

--
-- Índices para tabela `estagio_processos`
--
ALTER TABLE `estagio_processos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estagio_processos_parent_estagio_processo_id_foreign` (`parent_estagio_processo_id`);

--
-- Índices para tabela `estagio_processo_tipo_expediente`
--
ALTER TABLE `estagio_processo_tipo_expediente`
  ADD KEY `estagio_processo_tipo_expediente_estagio_processo_id_foreign` (`estagio_processo_id`),
  ADD KEY `estagio_processo_tipo_expediente_tipo_expediente_id_foreign` (`tipo_expediente_id`);

--
-- Índices para tabela `estudantes`
--
ALTER TABLE `estudantes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estudantes_curso_id_foreign` (`curso_id`);

--
-- Índices para tabela `expedientes`
--
ALTER TABLE `expedientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `expedientes_tipo_expediente_id_foreign` (`tipo_expediente_id`);

--
-- Índices para tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Índices para tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `funcionarios_email_unique` (`email`),
  ADD UNIQUE KEY `funcionarios_num_bi_unique` (`num_bi`);

--
-- Índices para tabela `funcionario_comentario_expediente`
--
ALTER TABLE `funcionario_comentario_expediente`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_comentario_expediente_funcionario_id_foreign` (`funcionario_id`),
  ADD KEY `funcionario_comentario_expediente_expediente_id_foreign` (`expediente_id`);

--
-- Índices para tabela `funcionario_departamento_cargo`
--
ALTER TABLE `funcionario_departamento_cargo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `funcionario_departamento_cargo_funcionario_id_foreign` (`funcionario_id`),
  ADD KEY `funcionario_departamento_cargo_departamento_id_foreign` (`departamento_id`),
  ADD KEY `funcionario_departamento_cargo_cargo_id_foreign` (`cargo_id`);

--
-- Índices para tabela `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Índices para tabela `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Índices para tabela `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Índices para tabela `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `permission_role_permission_id_foreign` (`permission_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Índices para tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Índices para tabela `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Índices para tabela `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`),
  ADD KEY `role_user_user_id_foreign` (`user_id`);

--
-- Índices para tabela `tipo_expedientes`
--
ALTER TABLE `tipo_expedientes`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `departamentos`
--
ALTER TABLE `departamentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `documentos`
--
ALTER TABLE `documentos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT de tabela `estagio_processos`
--
ALTER TABLE `estagio_processos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `estudantes`
--
ALTER TABLE `estudantes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `expedientes`
--
ALTER TABLE `expedientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `funcionarios`
--
ALTER TABLE `funcionarios`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `funcionario_comentario_expediente`
--
ALTER TABLE `funcionario_comentario_expediente`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `funcionario_departamento_cargo`
--
ALTER TABLE `funcionario_departamento_cargo`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT de tabela `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT de tabela `permission_role`
--
ALTER TABLE `permission_role`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT de tabela `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `role_user`
--
ALTER TABLE `role_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `tipo_expedientes`
--
ALTER TABLE `tipo_expedientes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `documentos`
--
ALTER TABLE `documentos`
  ADD CONSTRAINT `documentos_expediente_id_foreign` FOREIGN KEY (`expediente_id`) REFERENCES `expedientes` (`id`);

--
-- Limitadores para a tabela `estagio_processos`
--
ALTER TABLE `estagio_processos`
  ADD CONSTRAINT `estagio_processos_parent_estagio_processo_id_foreign` FOREIGN KEY (`parent_estagio_processo_id`) REFERENCES `estagio_processos` (`id`);

--
-- Limitadores para a tabela `estagio_processo_tipo_expediente`
--
ALTER TABLE `estagio_processo_tipo_expediente`
  ADD CONSTRAINT `estagio_processo_tipo_expediente_estagio_processo_id_foreign` FOREIGN KEY (`estagio_processo_id`) REFERENCES `estagio_processos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `estagio_processo_tipo_expediente_tipo_expediente_id_foreign` FOREIGN KEY (`tipo_expediente_id`) REFERENCES `tipo_expedientes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `estudantes`
--
ALTER TABLE `estudantes`
  ADD CONSTRAINT `estudantes_curso_id_foreign` FOREIGN KEY (`curso_id`) REFERENCES `cursos` (`id`);

--
-- Limitadores para a tabela `expedientes`
--
ALTER TABLE `expedientes`
  ADD CONSTRAINT `expedientes_tipo_expediente_id_foreign` FOREIGN KEY (`tipo_expediente_id`) REFERENCES `tipo_expedientes` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `funcionario_comentario_expediente`
--
ALTER TABLE `funcionario_comentario_expediente`
  ADD CONSTRAINT `funcionario_comentario_expediente_expediente_id_foreign` FOREIGN KEY (`expediente_id`) REFERENCES `expedientes` (`id`),
  ADD CONSTRAINT `funcionario_comentario_expediente_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`);

--
-- Limitadores para a tabela `funcionario_departamento_cargo`
--
ALTER TABLE `funcionario_departamento_cargo`
  ADD CONSTRAINT `funcionario_departamento_cargo_cargo_id_foreign` FOREIGN KEY (`cargo_id`) REFERENCES `cargos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionario_departamento_cargo_departamento_id_foreign` FOREIGN KEY (`departamento_id`) REFERENCES `departamentos` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `funcionario_departamento_cargo_funcionario_id_foreign` FOREIGN KEY (`funcionario_id`) REFERENCES `funcionarios` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

--
-- Limitadores para a tabela `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

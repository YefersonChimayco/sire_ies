-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost:8889
-- Tiempo de generación: 19-09-2025 a las 15:15:21
-- Versión del servidor: 8.0.40
-- Versión de PHP: 8.3.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `sire`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Client_API`
--

CREATE TABLE `Client_API` (
  `id` int NOT NULL,
  `ruc` varchar(20) NOT NULL,
  `razon_social` varchar(150) NOT NULL,
  `telefono` varchar(20) DEFAULT NULL,
  `correo` varchar(100) DEFAULT NULL,
  `fecha_registro` date NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Client_API`
--

INSERT INTO `Client_API` (`id`, `ruc`, `razon_social`, `telefono`, `correo`, `fecha_registro`, `estado`) VALUES
(1, '1111111', 'josuca', '', '', '2025-09-19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Count_request`
--

CREATE TABLE `Count_request` (
  `id` int NOT NULL,
  `id_token` int NOT NULL,
  `contador` int DEFAULT '0',
  `tipo` varchar(50) DEFAULT NULL,
  `fecha` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudiantes`
--

CREATE TABLE `estudiantes` (
  `dni` char(8) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'DNI único (formato de 8 dígitos)',
  `nombres` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombres completos del estudiante',
  `apellido_paterno` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Apellido paterno',
  `apellido_materno` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Apellido materno',
  `estado` enum('activo','inactivo','graduado','suspendido') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'activo' COMMENT 'Estado del estudiante',
  `semestre` tinyint UNSIGNED NOT NULL COMMENT 'Semestre actual del estudiante',
  `programa_id` int UNSIGNED NOT NULL COMMENT 'ID del programa de estudio',
  `fecha_matricula` date DEFAULT NULL COMMENT 'Fecha de matrícula del estudiante'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estudiantes`
--

INSERT INTO `estudiantes` (`dni`, `nombres`, `apellido_paterno`, `apellido_materno`, `estado`, `semestre`, `programa_id`, `fecha_matricula`) VALUES
('41664487', 'Jesus', 'ORDOÑEZ', 'GUINEA', 'activo', 5, 3, '2023-03-03'),
('4224223', 'Robert Andres', 'VILLAMIZAR', 'VICENT', 'activo', 6, 4, '0000-00-00'),
('42535120', 'Lizbeth Liliana', 'NAVARRO', 'MEDINA', 'activo', 5, 3, '2023-03-03'),
('43302197', 'Lucinda', 'CONDO', 'YACCA', 'activo', 6, 3, '2023-03-03'),
('46780897', 'Brigitt Katterine', 'CHOCCA', 'RAMOS', 'activo', 6, 3, '2023-03-03'),
('47134927', 'Tania Esther', 'PAREJA', 'CHOCCE', 'activo', 6, 2, '2023-03-03'),
('47385033', 'Nelly', 'FERNANDEZ', 'FLORES', 'activo', 5, 3, '2023-03-03'),
('47577508', 'Liz Leyla', 'QUISPE', 'PAREJA', 'activo', 5, 4, '0000-00-00'),
('47585638', 'Noemi', 'MENDOZA', 'AYALA', 'activo', 6, 3, '2023-03-03'),
('47699702', 'Ruth Mery', 'ROJAS', 'QUISPE', 'activo', 6, 2, '2023-03-03'),
('48000230', 'Deysi', 'PEREZ', 'QUISPE', 'activo', 5, 3, '2023-03-03'),
('48104237', 'Soshiree Ambar', 'QUINTANO', 'HUAMAN', 'activo', 5, 3, '2023-03-03'),
('48138515', 'Janeth Rosaura', 'SILVA', 'CHAVARRIA', 'activo', 5, 3, '2023-03-03'),
('48158876', 'Victor', 'ROQUE', 'SAICO', 'activo', 3, 5, '0000-00-00'),
('48296575', 'Sarita', 'GUERREROS', 'LUNASCO', 'activo', 3, 3, '2024-03-03'),
('60000306', 'Mirian', 'QUISPE', 'RAMOS', 'activo', 1, 3, '2024-03-03'),
('60011605', 'Anderson Edel', 'CESPEDES', 'PUJAY', 'activo', 3, 4, '0000-00-00'),
('60044164', 'Milder Jakc', 'PILLHUAMAN', 'PALOMINO', 'activo', 3, 5, '0000-00-00'),
('60047752', 'Miguel Angel', 'PINO', 'TORRES', 'activo', 3, 4, '0000-00-00'),
('60047759', 'Ada Miluska', 'MORENO', 'SILVERA', 'activo', 3, 3, '2024-03-03'),
('60047973', 'Jefferson Adriano', 'ROMERO', 'OBANDO', 'activo', 1, 5, '0000-00-00'),
('60148191', 'William Sadot', 'MAULI', 'MORALES', 'activo', 6, 5, '0000-00-00'),
('60148351', 'Diego Alonzo', 'HUAMAN', 'SALINAS', 'activo', 5, 3, '2023-03-03'),
('60148450', 'Daniel Gamaniel', 'CCENTE', 'CURO', 'activo', 3, 5, '0000-00-00'),
('60148480', 'Maritza', 'POTOSINO', 'CURO', 'activo', 5, 3, '2023-03-03'),
('60148808', 'Nayeli Sheyla', 'HUACHACA', 'RIMACHI', 'activo', 3, 3, '2024-03-03'),
('60148901', 'Esther Anabell', 'HUAMAN', 'MENDOZA', 'activo', 3, 3, '2024-03-03'),
('60148904', 'Yocer Anderson', 'ÑAUPA', 'VELASQUE', 'activo', 3, 4, '0000-00-00'),
('60148914', 'Mirko Aaron', 'TAYPE', 'VELASQUE', 'activo', 3, 4, '0000-00-00'),
('60149034', 'Miquer Andrez', 'PEREZ', 'HUACHACA', 'activo', 3, 5, '0000-00-00'),
('60149856', 'Noelia', 'PALOMINO', 'HUAMAN', 'activo', 5, 3, '2023-03-03'),
('60149874', 'Jheyson', 'ASTO', 'MAYHUA', 'activo', 3, 4, '0000-00-00'),
('60195108', 'Luis Miguel Angel', 'POZO', 'LANGA', 'activo', 3, 3, '2024-03-03'),
('60197297', 'Luis Fernando', 'YGNACIO', 'QUISPE', 'activo', 6, 2, '2023-03-03'),
('60199374', 'Willians', 'MADUEÑO', 'BERMUDO', 'activo', 5, 3, '2023-03-03'),
('60232117', 'Santa Mirian', 'VELASQUE', 'SANTIAGO', 'activo', 3, 3, '2024-03-03'),
('60285809', 'Nicole Ana', 'JORGE', 'PEREZ', 'activo', 5, 3, '2023-03-03'),
('60329946', 'Roxana', 'QUISPE', 'HUAMANI', 'activo', 5, 3, '2023-03-03'),
('60380026', 'Luis Angel', 'ROJAS', 'URBINA', 'activo', 6, 5, '0000-00-00'),
('60404617', 'Nayeli Mayte', 'ROBLES', 'ORE', 'activo', 5, 4, '0000-00-00'),
('60420785', 'Ruth Jimena', 'SIMBRON', 'SULCA', 'activo', 3, 4, '0000-00-00'),
('60420837', 'Roger Paris', 'AYALA', 'INGA', 'activo', 3, 3, '2024-03-03'),
('60459125', 'Olga Lizeth', 'LOPEZ', 'ROJAS', 'activo', 6, 3, '2023-03-03'),
('60459127', 'Jose Antonio', 'LOPEZ', 'ROJAS', 'activo', 2, 5, '0000-00-00'),
('60480496', 'Ciome', 'MENDOZA', 'ONOFRE', 'activo', 3, 3, '2024-03-03'),
('60514870', 'Edison', 'MEDINA', 'TAIPE', 'activo', 2, 5, '0000-00-00'),
('60550168', 'Jhoan Deyvi', 'AVENDAÑO', 'ESPINOZA', 'activo', 3, 5, '0000-00-00'),
('60789432', 'Denilson Jersy', 'LAIMES', 'VIÑAS', 'activo', 2, 5, '0000-00-00'),
('60819707', 'Jonathan Joseph', 'RUIZ', 'MORALES', 'activo', 3, 2, '2023-03-03'),
('60819835', 'Nilda Marilyn', 'AYALA', 'LUNASCO', 'activo', 3, 3, '2024-03-03'),
('60819887', 'Victor Jose', 'GARZON', 'URBANO', 'activo', 5, 5, '0000-00-00'),
('60922650', 'Jainer Nestor', 'NUÑEZ', 'ORE', 'activo', 3, 5, '0000-00-00'),
('60922886', 'Michael Fernando', 'QUISPE', 'GUTIERREZ', 'activo', 5, 5, '0000-00-00'),
('60998135', 'Luz Mercedes', 'VELASQUE', 'YARANGA', 'activo', 3, 4, '0000-00-00'),
('61014092', 'Nayeli Rosario', 'DURAN', 'AUQUI', 'activo', 3, 4, '0000-00-00'),
('61100581', 'Mijhail Jaxier', 'ARANGÜENA', 'RUIZ', 'activo', 5, 2, '2023-03-03'),
('61205668', 'Luz Karina', 'OLARTE', 'MANCILLA', 'activo', 5, 3, '2023-03-03'),
('61335295', 'Jhon Jhonatan', 'LUJAN', 'LAPA', 'activo', 3, 5, '0000-00-00'),
('61383171', 'Kiner', 'QUISPE', 'PRADO', 'activo', 5, 5, '0000-00-00'),
('61483959', 'Rosilda', 'POTOCINO', 'AGUILAR', 'activo', 5, 2, '2023-03-03'),
('61597811', 'Maiker', 'DE LA CRUZ', 'CASAMAYOR', 'activo', 1, 5, '0000-00-00'),
('62074530', 'Loida', 'HINOSTROZA', 'VILLANUEVA', 'activo', 3, 3, '2024-03-03'),
('62102620', 'Anily Yesica', 'LAGUNES', 'ARCE', 'activo', 5, 4, '0000-00-00'),
('62260810', 'Gimena Nayeli', 'QUISPE', 'LUNASCO', 'activo', 3, 3, '2024-03-03'),
('62377713', 'Kevin Julian', 'SANCHEZ', 'FIGUEROA', 'activo', 3, 5, '0000-00-00'),
('62691582', 'Ivan Yeferson', 'PAREDES', 'MERCADO', 'activo', 3, 5, '0000-00-00'),
('63432636', 'Ruth', 'ALANYA', 'FERNANDEZ', 'activo', 2, 3, '2024-03-03'),
('70075713', 'Jorge', 'RODRIGUEZ', 'YARANGA', 'activo', 5, 4, '0000-00-00'),
('70077913', 'Andy Junior', 'LOPEZ', 'AYALA', 'activo', 5, 4, '0000-00-00'),
('70116996', 'Dinner Andy', 'PANDALLA', 'CRUZ', 'activo', 5, 5, '0000-00-00'),
('70141574', 'Shiomara Dania', 'PALOMINO', 'CHACCERI', 'activo', 5, 4, '0000-00-00'),
('70188944', 'Jhovani Harold', 'MOREYRA', 'SACHA', 'activo', 6, 5, '0000-00-00'),
('70240770', 'Yoshin Yames', 'MENDOZA', 'MUÑOZ', 'activo', 5, 5, '0000-00-00'),
('70370697', 'Alfredo', 'ASTO', 'PUCLLA', 'activo', 5, 2, '2023-03-03'),
('70407413', 'Aurora', 'QUISPE', 'CUNTO', 'activo', 4, 4, '0000-00-00'),
('70408448', 'Joseph Michael', 'PEREZ', 'MUÑOZ', 'activo', 6, 5, '0000-00-00'),
('70408468', 'Yeny Margoth', 'CUCHURI', 'VALENCIA', 'activo', 6, 3, '2023-03-03'),
('70408475', 'Cadmiel', 'LOPE', 'PARHUAY', 'activo', 5, 5, '0000-00-00'),
('70410608', 'Ana Marina', 'ARROYO', 'LAMA', 'activo', 5, 3, '2023-03-03'),
('70424000', 'Rony', 'MUÑOZ', 'BARRANTES', 'activo', 5, 5, '0000-00-00'),
('70548020', 'Nolberto', 'CCENTE', 'CHOCCE', 'activo', 6, 5, '0000-00-00'),
('70551313', 'Deisy Maximina', 'MORALES', 'DE LA CRUZ', 'activo', 5, 2, '2023-03-03'),
('70599065', 'Jimmy Christian', 'LAPA', 'GUZMAN', 'activo', 5, 5, '0000-00-00'),
('70599083', 'Denisse Vanessa', 'SALAS', 'SAAVEDRA', 'activo', 5, 2, '2023-03-03'),
('70607715', 'Luz Marina', 'MERINO', 'HUAYLLASCO', 'activo', 5, 3, '2023-03-03'),
('70608346', 'Luis Miguel', 'APONTE', 'TIRACCAYA', 'activo', 3, 5, '0000-00-00'),
('70755282', 'Jhon Carlos', 'SICHA', 'CCENTE', 'activo', 3, 5, '0000-00-00'),
('70776742', 'Jose Michel', 'BULEJE', 'RONDINEL', 'activo', 6, 3, '2023-03-03'),
('70796131', 'Aymi Medalit', 'SALAZAR', 'ROQUE', 'activo', 5, 3, '2023-03-03'),
('70797655', 'Brigner Kenydy', 'ARROYO', 'OCHOA', 'activo', 3, 5, '0000-00-00'),
('70822226', 'Lida Raquel', 'PUCLLA', 'MENDOZA', 'activo', 6, 3, '2023-03-03'),
('70822254', 'Derian Alexis', 'HURTADO', 'MONTES', 'activo', 5, 5, '0000-00-00'),
('70872656', 'Kemal Esenin', 'MADUEÑO', 'URBANO', 'activo', 6, 5, '0000-00-00'),
('70945264', 'Sheyla', 'CHAVEZ', 'CCOCHACHI', 'activo', 3, 3, '2024-03-03'),
('71013918', 'Yonever', 'QUISPE', 'ÑAUPA', 'activo', 6, 5, '0000-00-00'),
('71040660', 'Rosmery', 'DIAZ', 'CHANCAS', 'activo', 5, 4, '0000-00-00'),
('71070805', 'Lourdes Fiorela', 'CUSICHE', 'ROJAS', 'activo', 6, 3, '2023-03-03'),
('71317461', 'Andre Rolando', 'VALENCIA', 'SORIANO', 'activo', 5, 5, '0000-00-00'),
('71328201', 'Belina Lizbeth', 'QUISPE', 'PALOMINO', 'activo', 3, 3, '2024-03-03'),
('71409160', 'Ronny Aron', 'SANCHEZ', 'SULCA', 'activo', 4, 5, '0000-00-00'),
('71413497', 'Evy Maricruz', 'CARBAJAL', 'QUISPE', 'activo', 3, 3, '2024-03-03'),
('71416545', 'Fredy', 'VILLANUEVA', 'HUAYLLA', 'activo', 5, 5, '0000-00-00'),
('71416588', 'Jhoselin', 'GOZME', 'QUISPE', 'activo', 6, 3, '2023-03-03'),
('71416590', 'Rosmery', 'GOZME', 'HUAMAN', 'activo', 3, 3, '2023-03-03'),
('71416600', 'Keyla Mayeli', 'SOSA', 'FIGUEROA', 'activo', 5, 3, '2023-03-03'),
('71416610', 'Isabel Milagros', 'CCOLLQUE', 'PUCLLA', 'activo', 5, 3, '2023-03-03'),
('71416620', 'Liz Fressi', 'QUISPE', 'PINO', 'activo', 5, 4, '0000-00-00'),
('71416663', 'Katerin Brizaida', 'CARDENAS', 'MENECES', 'activo', 5, 4, '0000-00-00'),
('71421045', 'Aracely Thais', 'GAVILAN', 'QUISPE', 'activo', 3, 4, '0000-00-00'),
('71422962', 'Sarina Sarita', 'ORE', 'POTOSINO', 'activo', 6, 4, '0000-00-00'),
('71427013', 'Leidy Liliana', 'FIGUEROA', 'QUISPE', 'activo', 6, 3, '2023-03-03'),
('71430974', 'Daniel Mario', 'AGUILAR', 'VEGA', 'activo', 5, 3, '2023-03-03'),
('71498892', 'Elsa Milagros', 'ATAUCUSI', 'HUAMAN', 'activo', 6, 3, '2023-03-03'),
('71591417', 'Maribel', 'GUTIERREZ', 'HUERTA', 'activo', 6, 4, '0000-00-00'),
('71591450', 'Juan Carlos', 'FARFAN', 'LLANTOY', 'activo', 6, 5, '0000-00-00'),
('71706439', 'Maximo', 'CASTILLO', 'DE LA CRUZ', 'activo', 6, 5, '0000-00-00'),
('71715948', 'Guitter', 'GARAY', 'RAMIREZ', 'activo', 5, 5, '0000-00-00'),
('71734513', 'Katherine Mirella', 'ONOFRE', 'PERALES', 'activo', 5, 3, '2023-03-03'),
('71742741', 'Alexandra', 'PALOMINO', 'UGARTE', 'activo', 3, 4, '0000-00-00'),
('71743211', 'Diana Carolina', 'GOMEZ', 'MEDINA', 'activo', 5, 3, '2023-03-03'),
('71743260', 'Javier Olivio', 'VELAZQUE', 'HUICHO', 'activo', 6, 5, '0000-00-00'),
('71745133', 'Jack Omar', 'CCENTE', 'VARGAS', 'activo', 5, 5, '0000-00-00'),
('71745232', 'Cesar Edu', 'ORTEGA', 'CUNTO', 'activo', 5, 3, '2023-03-03'),
('71745262', 'Ruth Karina', 'CUNTO', 'CHAVEZ', 'activo', 5, 3, '2023-03-03'),
('71745314', 'Oliver', 'CUNTO', 'URBANO', 'activo', 5, 2, '2023-03-03'),
('71745321', 'Dany', 'RONDINEL', 'CERAS', 'activo', 5, 5, '0000-00-00'),
('71747834', 'Oscar Jason', 'ÑAUPARI', 'PACHECO', 'activo', 5, 5, '0000-00-00'),
('71747843', 'Mary Luz', 'VILCA', 'MOREYRA', 'activo', 1, 4, '0000-00-00'),
('71748020', 'Irma', 'PACHECO', 'QUISPE', 'activo', 6, 3, '2023-03-03'),
('71748039', 'Percy Anthony', 'CISNEROS', 'ROJAS', 'activo', 5, 4, '0000-00-00'),
('71748912', 'Janeth', 'BARRA', 'RAMOS', 'activo', 5, 3, '2023-03-03'),
('71748991', 'William', 'ESPINOZA', 'URBANO', 'activo', 4, 5, '0000-00-00'),
('71748996', 'Eslinger', 'HUAMAN', 'RIMACHI', 'activo', 1, 5, '0000-00-00'),
('71750519', 'Liz Karen', 'ARAUJO', 'CURO', 'activo', 3, 3, '2024-03-03'),
('71750602', 'Luz Angela', 'CURO', 'VIVANCO', 'activo', 5, 3, '2023-03-03'),
('71750604', 'Lourdes', 'CURO', 'MIGUEL', 'activo', 3, 4, '0000-00-00'),
('71750624', 'Yimmy', 'LOPEZ', 'CARTOLIN', 'activo', 5, 3, '2023-03-03'),
('71750633', 'Karen Sandra', 'PARIONA', 'CUNTO', 'activo', 5, 4, '0000-00-00'),
('71750654', 'Yuleydy Yassira', 'VALENZUELA', 'AGAMA', 'activo', 5, 3, '2023-03-03'),
('71750655', 'Cristian', 'AGAMA', 'CERAS', 'activo', 5, 5, '0000-00-00'),
('71750656', 'Kevin Alejandro', 'AGAMA', 'CERAS', 'activo', 5, 5, '0000-00-00'),
('71750761', 'Victor Alfonso', 'HUAMAN', 'VELASQUE', 'activo', 5, 5, '0000-00-00'),
('71751181', 'Fraile', 'MOREIRA', 'FERNANDEZ', 'activo', 1, 4, '0000-00-00'),
('71752377', 'Carol Rubi', 'GARCIA', 'LEON', 'activo', 5, 4, '0000-00-00'),
('71752456', 'Flor Maria', 'HUAMAN', 'ARAUJO', 'activo', 3, 3, '2024-03-03'),
('71755208', 'Yack Bryan', 'AYALA', 'GAVILAN', 'activo', 5, 5, '0000-00-00'),
('71764320', 'Amily Luzmila', 'PEREZ', 'PALOMINO', 'activo', 5, 3, '2023-03-03'),
('71764787', 'Gabriel Angel', 'LOPEZ', 'QUISPE', 'activo', 5, 5, '0000-00-00'),
('71764954', 'Celia', 'GAMBOA', 'ROJAS', 'activo', 5, 4, '0000-00-00'),
('71771591', 'Henry Grover', 'RAMOS', 'OBANDO', 'activo', 6, 5, '0000-00-00'),
('71772050', 'Jhon Alex', 'GABRIEL', 'CASO', 'activo', 3, 5, '0000-00-00'),
('71774450', 'Kenyhi', 'GUILLEN', 'URRIBURU', 'activo', 5, 5, '0000-00-00'),
('71779632', 'Reyna', 'SOTO', 'CUNTO', 'activo', 3, 4, '0000-00-00'),
('71783380', 'Henry Waldir', 'RAFAEL', 'RIMACHI', 'activo', 5, 5, '0000-00-00'),
('71783756', 'Marleni', 'HUAMANI', 'RAMOS', 'activo', 1, 4, '0000-00-00'),
('71786046', 'Filiberta', 'HUAMAN', 'BAUTISTA', 'activo', 5, 3, '2023-03-03'),
('71786328', 'Kevin Romer', 'HUAMAN', 'BALCON', 'activo', 5, 3, '2023-03-03'),
('71791014', 'Beatriz Cintia', 'RODRIGUEZ', 'GONZALES', 'activo', 5, 3, '2023-03-03'),
('71793943', 'Heber', 'HINOSTROZA', 'HUACHACA', 'activo', 5, 3, '2023-03-03'),
('71794150', 'Percy', 'TAIPE', 'CCOÑAS', 'activo', 5, 5, '0000-00-00'),
('71796003', 'Nelson', 'HUANACO', 'VELAZQUE', 'activo', 5, 5, '0000-00-00'),
('71796063', 'Liz Jimena', 'AGUIRRE', 'TELLO', 'activo', 6, 3, '2023-03-03'),
('71804939', 'Breyson', 'CCORIÑAUPA', 'HUAMAN', 'activo', 6, 2, '2023-03-03'),
('71812123', 'Abel', 'BENDEZU', 'TORRES', 'activo', 6, 5, '0000-00-00'),
('71812147', 'Max Oliver', 'SULCA', 'SULCA', 'activo', 5, 5, '0000-00-00'),
('71815881', 'Dioel', 'CAPCHA', 'SANCHEZ', 'activo', 1, 4, '0000-00-00'),
('71815969', 'Flor Erika', 'PIZARRO', 'DELGADO', 'activo', 5, 3, '2023-03-03'),
('71815988', 'Marco Enrrique', 'URRIBARRI', 'ESTRADA', 'activo', 3, 5, '0000-00-00'),
('71841149', 'Eben Moises', 'CASTAÑEDA', 'ZAMBRANO', 'activo', 1, 5, '0000-00-00'),
('71855537', 'Cinthia', 'QUISPE', 'TANTAHUILLCA', 'activo', 5, 3, '2023-03-03'),
('71875931', 'Camilo Anthony', 'HUAYHUA', 'CASTAÑEDA', 'activo', 6, 2, '2023-03-03'),
('71891372', 'Jhordy Edwin', 'MEZA', 'CASTAÑEDA', 'activo', 6, 2, '2023-03-03'),
('71895838', 'Leonel', 'PALACIOS', 'LANDEO', 'activo', 3, 5, '0000-00-00'),
('71954611', 'Julio', 'ARANGO', 'ECHAVARRIA', 'activo', 6, 5, '0000-00-00'),
('72027235', 'Ronel Gustavo', 'QUISPE', 'ROMANI', 'activo', 6, 3, '2023-03-03'),
('72027283', 'Jose Antonio', 'CONDOR', 'AGUILAR', 'activo', 1, 5, '0000-00-00'),
('72027285', 'Miriam', 'CONDOR', 'AGUILAR', 'activo', 6, 2, '2023-03-03'),
('72037241', 'Elsa', 'RIMACHI', 'QUINTANA', 'activo', 5, 4, '0000-00-00'),
('72037261', 'Zulema', 'LOAYZA', 'GAMBOA', 'activo', 3, 4, '0000-00-00'),
('72255798', 'Dannai Lucero', 'HUAMAN', 'MALLQUI', 'activo', 5, 3, '2023-03-03'),
('72363048', 'Mayly Margorie', 'GAMBOA', 'GUZMAN', 'activo', 6, 4, '0000-00-00'),
('72383078', 'Carlos Eduardo', 'ARAUJO', 'CABEZAS', 'activo', 1, 5, '0000-00-00'),
('72383101', 'Simri Maricela', 'QUISPE', 'URBANO', 'activo', 6, 4, '0000-00-00'),
('72383106', 'Erika Diana', 'GODOY', 'OSORES', 'activo', 5, 3, '2023-03-03'),
('72455405', 'Danilo', 'URRIBARRI', 'ESTRADA', 'activo', 4, 5, '0000-00-00'),
('72696858', 'Breisci Katherin', 'MORA', 'CHAVEZ', 'activo', 6, 3, '2023-03-03'),
('72904755', 'Edwin Aaron', 'SANTA CRUZ', 'MEDINA', 'activo', 5, 2, '2023-03-03'),
('73113746', 'Gedeon Daniel', 'MOREYRA', 'QUISPE', 'activo', 6, 5, '0000-00-00'),
('73271215', 'Enders Antony', 'PARIONA', 'HUERTA', 'activo', 3, 5, '0000-00-00'),
('73302217', 'Maria De Los Angeles', 'HORNA', 'MORENO', 'activo', 5, 3, '2023-03-03'),
('73333167', 'Elva', 'MANRIQUE', 'CONDOR', 'activo', 5, 3, '2023-03-03'),
('73345837', 'Oliver Danny', 'EGOAVIL', 'ULLOA', 'activo', 6, 5, '0000-00-00'),
('73353343', 'Nayeli', 'HUARANCCA', 'GARZON', 'activo', 5, 3, '2023-03-03'),
('73353382', 'Ruth Vanesa', 'PALOMINO', 'RODRIGUEZ', 'activo', 6, 2, '2023-03-03'),
('73355033', 'Anais Deysi', 'BENDEZU', 'GOZME', 'activo', 3, 3, '2024-03-03'),
('73355045', 'Karen Yesenia', 'CUADROS', 'MINAYA', 'activo', 5, 3, '2023-03-03'),
('73355046', 'Sthefany Del Pilar', 'CUADROS', 'MINAYA', 'activo', 3, 4, '0000-00-00'),
('73355801', 'Rosa Luz', 'RIMACHI', 'CABEZAS', 'activo', 5, 3, '2023-03-03'),
('73355810', 'Naesvet', 'DE LA CRUZ', 'HUAMANI', 'activo', 5, 3, '2023-03-03'),
('73360740', 'James Franco', 'MESCUA', 'ENCISO', 'activo', 3, 3, '2023-03-03'),
('73376841', 'Raul Freddy', 'HUAMAN', 'VITOR', 'activo', 5, 5, '0000-00-00'),
('73383568', 'Thalia', 'QUISPE', 'QUISPE', 'activo', 6, 4, '0000-00-00'),
('73495251', 'Yems Raul', 'AVILA', 'GALVEZ', 'activo', 6, 2, '2023-03-03'),
('73524359', 'Rony Jhordan', 'PACHECO', 'SAYAS', 'activo', 6, 5, '0000-00-00'),
('73567736', 'Josue', 'LOPEZ', 'CONDORAY', 'activo', 6, 2, '2023-03-03'),
('73657346', 'Defy', 'ROJAS', 'CUSICHI', 'activo', 5, 3, '2023-03-03'),
('73768542', 'Marvin Antony', 'LEON', 'GUERRA', 'activo', 5, 5, '0000-00-00'),
('73770429', 'Jose Maria', 'GARAY', 'NARVAEZ', 'activo', 5, 4, '0000-00-00'),
('73770609', 'Abiud Placido', 'ÑAUPA', 'LLANTOY', 'activo', 3, 5, '0000-00-00'),
('73802212', 'Mayte Anali', 'MOISES', 'YANASUPO', 'activo', 5, 2, '2023-03-03'),
('73806046', 'Jesica', 'RUA', 'VASQUEZ', 'activo', 3, 3, '2024-03-03'),
('73814533', 'Zarai Andrea', 'ROMERO', 'PEREZ', 'activo', 3, 3, '2024-03-03'),
('73820444', 'Henrry Esau', 'AVILA', 'RODRIGUEZ', 'activo', 5, 5, '0000-00-00'),
('73825442', 'Mell Zurisadai', 'SANTIAGO', 'ÑAUPA', 'activo', 5, 3, '2023-03-03'),
('73825443', 'Itai Betzabe', 'SANTIAGO', 'ÑAUPA', 'activo', 5, 3, '2023-03-03'),
('73879251', 'Willian Angel', 'CONDORI', 'FARFAN', 'activo', 5, 2, '2023-03-03'),
('73886770', 'Nhayely Rouss', 'RUIZ', 'OTTOS', 'activo', 1, 3, '2024-03-03'),
('73898455', 'Erik Josep', 'PALMARES', 'MONTES', 'activo', 3, 5, '0000-00-00'),
('73900864', 'Rosa Angelica', 'CANCHARI', 'VILLANTOY', 'activo', 3, 3, '2024-03-03'),
('73901012', 'Wilder', 'PALOMINO', 'HUAMAN', 'activo', 5, 5, '0000-00-00'),
('73904155', 'Ketty Miluzca', 'CUNTO', 'FERNANDEZ', 'activo', 3, 3, '2024-03-03'),
('73939154', 'Angel Jesus', 'CHOCCA', 'RAMOS', 'activo', 6, 2, '2023-03-03'),
('73954408', 'Yerson Elvis', 'LANDEO', 'QUISPE', 'activo', 1, 5, '0000-00-00'),
('73959495', 'Marlene', 'GONZALES', 'CARBAJAL', 'activo', 6, 3, '2023-03-03'),
('73976352', 'Eliza', 'HEREDIA', 'AGUILAR', 'activo', 6, 3, '2023-03-03'),
('73984214', 'Bruno', 'PEREZ', 'FARFAN', 'activo', 5, 2, '2023-03-03'),
('73984225', 'Fredy Ulrich', 'PAUCAR', 'LUJAN', 'activo', 6, 5, '0000-00-00'),
('73984287', 'Virginia', 'CONDORI', 'CHAVEZ', 'activo', 3, 4, '0000-00-00'),
('74020324', 'Alexa Leticia', 'LUNA', 'ARIAS', 'activo', 6, 3, '2023-03-03'),
('74022501', 'Gladys Sabina', 'ARAUJO', 'ENCISO', 'activo', 3, 4, '0000-00-00'),
('74028789', 'Gardenia', 'CONDORI', 'VARGAS', 'activo', 5, 3, '2023-03-03'),
('74031587', 'Jhann Carlos', 'ATAUCUSI', 'HUAMAN', 'activo', 6, 5, '0000-00-00'),
('74034629', 'Rosa Maria', 'MIGUEL', 'GUTIERREZ', 'activo', 3, 3, '2024-03-03'),
('74047352', 'Elvis Abel', 'BARBARAN', 'MORALES', 'activo', 5, 5, '0000-00-00'),
('74048972', 'Andre Everson', 'CONDORI', 'HUAMAN', 'activo', 5, 3, '2023-03-03'),
('74066886', 'Miguel', 'QUINTO', 'AYALA', 'activo', 6, 5, '0000-00-00'),
('74067124', 'Khristel Jennifer', 'PEÑA', 'GAMBOA', 'activo', 5, 3, '2023-03-03'),
('74070983', 'Nataly Cony', 'LLANA', 'RIVERA', 'activo', 6, 3, '2023-03-03'),
('74088792', 'Nigdol Klifer', 'CESPEDES', 'PUJAY', 'activo', 5, 5, '0000-00-00'),
('74089741', 'Yober', 'HUACHACA', 'YULGO', 'activo', 5, 4, '0000-00-00'),
('74120102', 'Josue Andre', 'TALAVERA', 'ACOSTA', 'activo', 5, 5, '0000-00-00'),
('74133491', 'Miqueas Omar', 'GAMBOA', 'PARIONA', 'activo', 3, 2, '2023-03-03'),
('74144014', 'Jeanet', 'GARZON', 'RIVEROS', 'activo', 1, 4, '0000-00-00'),
('74170917', 'Judith Tamy', 'PEREZ', 'POMA', 'activo', 5, 3, '2023-03-03'),
('74205923', 'Piter Gabriel', 'QUISPE', 'ARIAS', 'activo', 5, 5, '0000-00-00'),
('74217718', 'Edith Pamela', 'CONDORI', 'OCHOA', 'activo', 5, 4, '0000-00-00'),
('74225663', 'Hans', 'TORRES', 'GUERRA', 'activo', 6, 5, '0000-00-00'),
('74285270', 'Angie', 'SAEZ', 'GONZALES', 'activo', 5, 3, '2023-03-03'),
('74307671', 'David Omar', 'GODOY', 'OSORES', 'activo', 5, 5, '0000-00-00'),
('74308566', 'Andrea Ercilia', 'CHOCCE', 'YARANGA', 'activo', 3, 3, '2024-03-03'),
('74322487', 'Josue', 'Gomez', 'Ccochachi', 'activo', 6, 1, '2023-03-12'),
('74347132', 'Efrain', 'QUISPE', 'LANDEO', 'activo', 5, 5, '0000-00-00'),
('74347368', 'Ivan Cristhofer', 'CRUZ', 'DE LA CRUZ', 'activo', 5, 5, '0000-00-00'),
('74347603', 'Yudith', 'CURO', 'QUISPE', 'activo', 5, 3, '2023-03-03'),
('74353519', 'Mayra', 'FIDEL', 'HUICHO', 'activo', 3, 4, '0000-00-00'),
('74353945', 'Amanda', 'ÑAUPA', 'RICRA', 'activo', 6, 2, '2023-03-03'),
('74361056', 'Piero Aron', 'PARIONA', 'AGUILAR', 'activo', 5, 5, '0000-00-00'),
('74385650', 'Raul', 'ÑAUPARI', 'ARAUJO', 'activo', 5, 2, '2023-03-03'),
('74385707', 'Lia Santa', 'MAULI', 'MORALES', 'activo', 4, 4, '0000-00-00'),
('74398812', 'Sandra Alison', 'SUAREZ', 'PAREJA', 'activo', 3, 3, '2024-03-03'),
('74404977', 'Walter Antonio', 'RUA', 'MAURI', 'activo', 5, 3, '2023-03-03'),
('74434553', 'Jhon Leno', 'HUARANCCA', 'CRUZ', 'activo', 5, 5, '0000-00-00'),
('74437664', 'Emerson', 'GOMEZ', 'MENESES', 'activo', 3, 5, '0000-00-00'),
('74437731', 'Ever', 'CABEZAS', 'CASTILLA', 'activo', 5, 5, '0000-00-00'),
('74442208', 'Ruth Miluzca', 'GOMEZ', 'MENESES', 'activo', 5, 4, '0000-00-00'),
('74491821', 'Sandra Yesica', 'HUAYTA', 'CABEZAS', 'activo', 5, 3, '2023-03-03'),
('74551332', 'Nancy Marisol', 'TORRES', 'IGNACIO', 'activo', 6, 3, '2023-03-03'),
('74551426', 'Liliana', 'ROMERO', 'FERNANDEZ', 'activo', 6, 4, '0000-00-00'),
('74553456', 'Wilder Jhunior', 'CCAHUANA', 'DURAND', 'activo', 5, 3, '2023-03-03'),
('74553461', 'Nicke Johan', 'CHOCCE', 'HUAMAN', 'activo', 3, 4, '0000-00-00'),
('74553486', 'Dina', 'FARFAN', 'RIMACHI', 'activo', 6, 3, '2023-03-03'),
('74553652', 'Keysi Nayeli', 'NAVARRO', 'ÑAUPA', 'activo', 3, 3, '2024-03-03'),
('74657672', 'Max Cipriano', 'CABEZAS', 'RONDINEL', 'activo', 3, 3, '2024-03-03'),
('74662054', 'Anahi', 'ARANGO', 'CRISOSTOMO', 'activo', 3, 4, '0000-00-00'),
('74760947', 'Belice Oswaldo', 'LUDEÑA', 'TOVAR', 'activo', 5, 3, '2023-03-03'),
('74761085', 'Yesica', 'HINOSTROZA', 'ROSAS', 'activo', 3, 3, '2024-03-03'),
('74815789', 'Frank Angel', 'GAMBOA', 'CUSICHE', 'activo', 3, 5, '0000-00-00'),
('74815822', 'Zadith Sarai', 'BARBOZA', 'FLORES', 'activo', 5, 3, '2023-03-03'),
('74874109', 'Alex', 'HUAMAN', 'CENTENO', 'activo', 5, 5, '0000-00-00'),
('75008355', 'Eliane', 'BARRIENTOS', 'ROJAS', 'activo', 6, 3, '2023-03-03'),
('75084597', 'Yaserin', 'PEREZ', 'ROJAS', 'activo', 5, 4, '0000-00-00'),
('75362620', 'Yul Giomar', 'CISNEROS', 'MOLINA', 'activo', 5, 2, '2023-03-03'),
('75413154', 'Esthefani', 'VILLEGAS', 'PEÑA', 'activo', 6, 4, '0000-00-00'),
('75589828', 'Tiffany', 'ODAR', 'OROSCO', 'activo', 5, 3, '2023-03-03'),
('75670890', 'Franklin', 'GUILLEN', 'CRUZ', 'activo', 3, 5, '0000-00-00'),
('75671000', 'Roly', 'LAZO', 'MENDEZ', 'activo', 3, 4, '0000-00-00'),
('75712285', 'Hugo Adiel', 'VALENCIA', 'CANCHARI', 'activo', 5, 5, '0000-00-00'),
('75712401', 'Rosalinda Luz', 'VELASQUE', 'YARANGA', 'activo', 3, 4, '0000-00-00'),
('75844497', 'Olinda', 'GARZON', 'AYALA', 'activo', 3, 3, '2023-03-03'),
('75844840', 'Alex', 'OLARTE', 'MENDOZA', 'activo', 6, 5, '0000-00-00'),
('75911661', 'Flor Zulema', 'CRESPO', 'PARIONA', 'activo', 3, 4, '0000-00-00'),
('75945669', 'Mayli Yurico', 'QUISPE', 'CONTRERAS', 'activo', 5, 3, '2023-03-03'),
('75975833', 'Gimena', 'ACHA', 'CCOCHACHI', 'activo', 6, 4, '0000-00-00'),
('76046471', 'Brus Ney', 'DE LA CRUZ', 'HUAMAN', 'activo', 1, 5, '0000-00-00'),
('76124302', 'Karina', 'QUISPE', 'MENDOZA', 'activo', 5, 4, '0000-00-00'),
('76210114', 'David Jose', 'QUISPE', 'PARDO', 'activo', 5, 4, '0000-00-00'),
('76230675', 'Angel Cruz', 'QUISPE', 'PARDO', 'activo', 5, 4, '0000-00-00'),
('76478601', 'Joao Fortunato', 'LOZANO', 'PIANTO', 'activo', 5, 5, '0000-00-00'),
('76509078', 'Eliana Mel', 'CONDOR', 'CONTRERAS', 'activo', 5, 2, '2023-03-03'),
('76529403', 'Zamira Giuliana', 'PANEBRA', 'CAVALCANTI', 'activo', 5, 2, '2023-03-03'),
('76540709', 'Magaly', 'TALAVERA', 'SANCHEZ', 'activo', 5, 2, '2023-03-03'),
('76590615', 'Rosmery', 'YURA', 'CCAMA', 'activo', 6, 3, '2023-03-03'),
('76620880', 'Rosmery', 'VALENCIA', 'HUAMAN', 'activo', 5, 4, '0000-00-00'),
('76620885', 'Luz Tania', 'VALENCIA', 'HUAMAN', 'activo', 5, 3, '2023-03-03'),
('76686213', 'Ederson', 'DURAND', 'RICRA', 'activo', 3, 5, '0000-00-00'),
('76803792', 'Ruth Nayda', 'CALDERON', 'VELASQUE', 'activo', 1, 4, '0000-00-00'),
('76817575', 'Adaly Yesenia', 'SULLCA', 'PARIONA', 'activo', 3, 4, '0000-00-00'),
('76835515', 'Dris Mabel', 'CASTILLO', 'GAMBOA', 'activo', 5, 3, '2023-03-03'),
('76839060', 'Joel Eliezer', 'FLORES', 'ORE', 'activo', 1, 4, '0000-00-00'),
('76877194', 'Jesus Stewar', 'AMAYA', 'SILVA', 'activo', 1, 4, '0000-00-00'),
('76877195', 'Emmanuel Aaron', 'AMAYA', 'SILVA', 'activo', 3, 5, '0000-00-00'),
('76944170', 'Ronal', 'CCENTE', 'VARGAS', 'activo', 3, 5, '0000-00-00'),
('77060694', 'Miguel Angel', 'LOPEZ', 'HUAMAN', 'activo', 5, 5, '0000-00-00'),
('77079395', 'Mikel', 'CCORA', 'CASO', 'activo', 5, 5, '0000-00-00'),
('77163314', 'Fortunita', 'MOREIRA', 'VICAÑA', 'activo', 5, 3, '2023-03-03'),
('77170339', 'Angie Soley', 'PAREJA', 'RUIZ', 'activo', 5, 3, '2023-03-03'),
('77212869', 'Anddy Nahun', 'AGUILAR', 'TAYPE', 'activo', 5, 5, '0000-00-00'),
('77215209', 'Cristian', 'MANRIQUE', 'QUISPE', 'activo', 3, 3, '2023-03-03'),
('77231786', 'Meliza', 'BAUTISTA', 'ZANABRIA', 'activo', 6, 3, '2023-03-03'),
('77329277', 'Mileydi Carmelinda', 'GALDO', 'CCORIPURI', 'activo', 6, 5, '0000-00-00'),
('77352841', 'Jose Luis', 'MUÑOZ', 'GUTIERREZ', 'activo', 6, 5, '0000-00-00'),
('77383382', 'Vladimiro', 'HUANACO', 'MADUEÑO', 'activo', 1, 5, '0000-00-00'),
('77501319', 'Yeferson', 'Chimayco', 'Carbajal', 'activo', 6, 1, '2023-03-29'),
('77538106', 'Jean Jearen', 'LEANDRO', 'SULCA', 'activo', 4, 5, '0000-00-00'),
('77905729', 'Megan Evelyn', 'LUNASCO', 'CURO', 'activo', 5, 3, '2023-03-03'),
('77907423', 'Abraham', 'QUISPE', 'CACHIQUE', 'activo', 5, 5, '0000-00-00'),
('77917917', 'Amilcar', 'CERAS', 'QUIROZ', 'activo', 3, 5, '0000-00-00'),
('78005776', 'Betsa Karina', 'VELAZQUE', 'CCENTE', 'activo', 1, 4, '0000-00-00'),
('78020134', 'Jose Antonio', 'CARDENAS', 'GONZALES', 'activo', 4, 5, '0000-00-00'),
('78109468', 'Judith Joselin', 'CCOCHACHI', 'VELAZQUE', 'activo', 6, 4, '0000-00-00'),
('78115454', 'Yosselin Lucy', 'BAUTISTA', 'AVILA', 'activo', 5, 4, '0000-00-00'),
('78185489', 'Karina Mia', 'LOPEZ', 'ROJAS', 'activo', 5, 3, '2023-03-03'),
('78288010', 'Yampier Huharo', 'BENDEZÚ', 'QUISPE', 'activo', 3, 5, '0000-00-00'),
('78289420', 'Jerson Cesar', 'QUISPE', 'PEREZ', 'activo', 5, 2, '2023-03-03'),
('79051381', 'Zaida', 'GAMBOA', 'LUNASCO', 'activo', 5, 4, '0000-00-00'),
('79626418', 'Roger', 'RAMOS', 'VARGAS', 'activo', 3, 5, '0000-00-00'),
('80856795', 'Jhakelene', 'PIMENTEL', 'CURO', 'activo', 6, 4, '0000-00-00');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `programas_estudio`
--

CREATE TABLE `programas_estudio` (
  `id` int UNSIGNED NOT NULL COMMENT 'Identificador único del programa',
  `nombre` varchar(100) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre del programa (e.g., Ingeniería de Sistemas)',
  `descripcion` text COLLATE utf8mb4_general_ci COMMENT 'Descripción opcional del programa'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `programas_estudio`
--

INSERT INTO `programas_estudio` (`id`, `nombre`, `descripcion`) VALUES
(1, 'Diseño y Programación Web', NULL),
(2, 'Enfermería Técnica', NULL),
(3, 'Mecánica Automotriz', NULL),
(4, 'Producción Agropecuaria', NULL),
(5, 'Industrias de Alimentos y Bebidas', NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `semestres_lista`
--

CREATE TABLE `semestres_lista` (
  `id` tinyint UNSIGNED NOT NULL COMMENT 'Identificador único del semestre (1-12)',
  `descripcion` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Descripción opcional (e.g., "Primer Semestre")'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `semestres_lista`
--

INSERT INTO `semestres_lista` (`id`, `descripcion`) VALUES
(1, 'Primer Semestre'),
(2, 'Segundo Semestre'),
(3, 'Tercer Semestre'),
(4, 'Cuarto Semestre'),
(5, 'Quinto Semestre'),
(6, 'Sexto Semestre');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Tokens`
--

CREATE TABLE `Tokens` (
  `id` int NOT NULL,
  `id_client_api` int NOT NULL,
  `token` varchar(255) NOT NULL,
  `fecha_reg` date NOT NULL,
  `estado` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Volcado de datos para la tabla `Tokens`
--

INSERT INTO `Tokens` (`id`, `id_client_api`, `token`, `fecha_reg`, `estado`) VALUES
(2, 1, 'asdasfgfdadfsghjkljhdgsdfas', '2025-09-19', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int UNSIGNED NOT NULL COMMENT 'Identificador único del usuario',
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nombre de usuario único para inicio de sesión',
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `username`, `password`) VALUES
(1, 'admin', '$2y$10$nsbN9iGgTd2NxgrnypL.IeRzq1ob4keYFI6w6mMZ9k0NIpy6G4FRu'),
(2, 'chima', '$2y$10$KfT3wKgB6PrNHjcSsgq9SefD2l3SojE1Z2.EjJXQfPFXuGek6/uDC');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `Client_API`
--
ALTER TABLE `Client_API`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `correo` (`correo`);

--
-- Indices de la tabla `Count_request`
--
ALTER TABLE `Count_request`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_token` (`id_token`);

--
-- Indices de la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD PRIMARY KEY (`dni`),
  ADD KEY `idx_apellido_paterno` (`apellido_paterno`),
  ADD KEY `idx_semestre` (`semestre`),
  ADD KEY `idx_programa_id` (`programa_id`);

--
-- Indices de la tabla `programas_estudio`
--
ALTER TABLE `programas_estudio`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nombre` (`nombre`);

--
-- Indices de la tabla `semestres_lista`
--
ALTER TABLE `semestres_lista`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `Tokens`
--
ALTER TABLE `Tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_client_api` (`id_client_api`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD KEY `idx_username` (`username`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `Client_API`
--
ALTER TABLE `Client_API`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `Count_request`
--
ALTER TABLE `Count_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `programas_estudio`
--
ALTER TABLE `programas_estudio`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del programa', AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `Tokens`
--
ALTER TABLE `Tokens`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Identificador único del usuario', AUTO_INCREMENT=3;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `Count_request`
--
ALTER TABLE `Count_request`
  ADD CONSTRAINT `count_request_ibfk_1` FOREIGN KEY (`id_token`) REFERENCES `Tokens` (`id`);

--
-- Filtros para la tabla `estudiantes`
--
ALTER TABLE `estudiantes`
  ADD CONSTRAINT `estudiantes_ibfk_1` FOREIGN KEY (`semestre`) REFERENCES `semestres_lista` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `estudiantes_ibfk_2` FOREIGN KEY (`programa_id`) REFERENCES `programas_estudio` (`id`) ON UPDATE CASCADE;

--
-- Filtros para la tabla `Tokens`
--
ALTER TABLE `Tokens`
  ADD CONSTRAINT `tokens_ibfk_1` FOREIGN KEY (`id_client_api`) REFERENCES `Client_API` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
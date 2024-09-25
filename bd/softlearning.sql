-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 23-05-2024 a las 22:39:58
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `softlearning`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `book`
--

CREATE TABLE `book` (
  `Codi` int(11) NOT NULL,
  `Preu` float NOT NULL,
  `Descripcio` varchar(240) NOT NULL,
  `Autor` varchar(240) NOT NULL,
  `Titol` varchar(240) NOT NULL,
  `Tapa` varchar(240) NOT NULL,
  `Pagines` int(11) NOT NULL,
  `Genere` varchar(240) NOT NULL,
  `Editorial` varchar(240) NOT NULL,
  `ISBN` varchar(240) NOT NULL,
  `Altura` float NOT NULL,
  `Amplada` float NOT NULL,
  `Longitud` float NOT NULL,
  `Pes` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `book`
--

INSERT INTO `book` (`Codi`, `Preu`, `Descripcio`, `Autor`, `Titol`, `Tapa`, `Pagines`, `Genere`, `Editorial`, `ISBN`, `Altura`, `Amplada`, `Longitud`, `Pes`) VALUES
(12345, 4567, 'magia', 'j.krowling', 'harry potter', 'dura', 789, 'fantasia', 'santillana', '9784567890987', 12, 21, 12, 12);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `client`
--

CREATE TABLE `client` (
  `nom` varchar(240) NOT NULL,
  `cognom` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `telefon` varchar(240) NOT NULL,
  `adreca` varchar(240) NOT NULL,
  `aniversari` date NOT NULL,
  `soci` int(11) NOT NULL,
  `pagament` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `client`
--

INSERT INTO `client` (`nom`, `cognom`, `email`, `telefon`, `adreca`, `aniversari`, `soci`, `pagament`) VALUES
('CARLES', 'MECA', 'josem@gmail.es', '34 655 67 89 09', 'Carrer de la arruga, 13, 5-5', '2024-09-13', 56789, 'fisicament'),
('Jessica', 'MECA', 'palotes1@gmail.com', '34 645 12 56 75', 'C/Montflorit', '2004-09-12', 67809, 'Fisicament'),
('Jessica1', 'MECA', 'carles.meca@gmail.com', '34 678 90 98 89', 'C/Montflorit', '2004-09-12', 454454, 'Fisicament');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `clientcompany`
--

CREATE TABLE `clientcompany` (
  `nom` varchar(240) NOT NULL,
  `cognom` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `telefon` varchar(240) NOT NULL,
  `adreca` varchar(240) NOT NULL,
  `antiguitat` date NOT NULL,
  `empresa` int(11) NOT NULL,
  `pagament` varchar(240) NOT NULL,
  `treballador` int(11) NOT NULL,
  `entitat` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `clientcompany`
--

INSERT INTO `clientcompany` (`nom`, `cognom`, `email`, `telefon`, `adreca`, `antiguitat`, `empresa`, `pagament`, `treballador`, `entitat`) VALUES
('Jessica', 'Prats', 'jessica.nuria@gmail.com', '34 657 12 34 56', 'Av.Rie', '2000-12-13', 45678, 'targeta', 12, 'Educació'),
('Jessica', 'Prats', 'jessicaprats.nuria@gmail.com', '34 657 78 90 09', 'Av.Riera', '2000-12-13', 123456, 'Fisicament', 1, 'Educació'),
('Jessica', 'Prats', 'jessicaprats.nuria@gmail.com', '34 657 78 90 09', 'Av.Riera', '2000-12-13', 1234567, 'Fisicament', 1, 'Educació');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `courses`
--

CREATE TABLE `courses` (
  `codi` int(11) NOT NULL,
  `preu` float NOT NULL,
  `descripcio` varchar(240) NOT NULL,
  `hores` int(11) NOT NULL,
  `departament` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `courses`
--

INSERT INTO `courses` (`codi`, `preu`, `descripcio`, `hores`, `departament`) VALUES
(1223, 1234, 'asasasa', 100, 'asasa');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `employee`
--

CREATE TABLE `employee` (
  `nom` varchar(240) NOT NULL,
  `cognoms` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `telefon` varchar(240) NOT NULL,
  `adreca` varchar(240) NOT NULL,
  `antiguitat` date NOT NULL,
  `treballador` int(11) NOT NULL,
  `departament` varchar(240) NOT NULL,
  `horari` varchar(240) NOT NULL,
  `banc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `employee`
--

INSERT INTO `employee` (`nom`, `cognoms`, `email`, `telefon`, `adreca`, `antiguitat`, `treballador`, `departament`, `horari`, `banc`) VALUES
('Josefino', 'meseguer', 'josem@gmail.es', '34 655 67 89 09', 'C/montflorit', '2000-12-30', 123456, 'HTML', '15:00-21:30', 1234567898);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `provider`
--

CREATE TABLE `provider` (
  `nom` varchar(240) NOT NULL,
  `cognom` varchar(240) NOT NULL,
  `email` varchar(240) NOT NULL,
  `telefon` varchar(240) NOT NULL,
  `adreca` varchar(240) NOT NULL,
  `antiguitat` date NOT NULL,
  `proveidor` int(11) NOT NULL,
  `treballa` varchar(240) NOT NULL,
  `treballador` int(11) NOT NULL,
  `entitat` varchar(240) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `provider`
--

INSERT INTO `provider` (`nom`, `cognom`, `email`, `telefon`, `adreca`, `antiguitat`, `proveidor`, `treballa`, `treballador`, `entitat`) VALUES
('jose', 'meseguer', 'jesicaa@gmail.es', '34 655 67 89 93', 'C/montflorits', '2000-12-30', 12345, 'CEFP Nuri', 100, 'Education'),
('Jessica', 'Prats', 'jessicaprats.nuria@gmail.com', '34 657 78 90 09', 'Av.Riera', '2000-12-13', 14567, 'PHP', 12, 'Educació'),
('Josefino', 'palotes', 'josefino@gmail.net', '34 655 67 89 09', 'C/montflorit', '2000-12-30', 56789, 'CEFP Nuria', 45, 'Education');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`Codi`);

--
-- Indices de la tabla `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`soci`);

--
-- Indices de la tabla `clientcompany`
--
ALTER TABLE `clientcompany`
  ADD PRIMARY KEY (`empresa`);

--
-- Indices de la tabla `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`codi`);

--
-- Indices de la tabla `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`treballador`);

--
-- Indices de la tabla `provider`
--
ALTER TABLE `provider`
  ADD PRIMARY KEY (`proveidor`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

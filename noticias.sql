-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 07-12-2021 a las 22:31:09
-- Versión del servidor: 10.4.21-MariaDB
-- Versión de PHP: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `noticias`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE `categoria` (
  `IdCategoria` int(11) NOT NULL,
  `Nombre` char(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`IdCategoria`, `Nombre`) VALUES
(2, 'Salud'),
(3, 'Política'),
(4, 'Local'),
(5, 'Farandula');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `imagen`
--

CREATE TABLE `imagen` (
  `IdImagen` int(11) NOT NULL,
  `Url` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `imagen`
--

INSERT INTO `imagen` (`IdImagen`, `Url`) VALUES
(1, 'https://www.flaticon.es/packs/customer-reviews-24'),
(2, 'https://www.flaticon.es/icono-premium/buena-resena_4142342?related_id=4142342#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticia`
--

CREATE TABLE `noticia` (
  `IdNoticia` int(11) NOT NULL,
  `Descripcion` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `Titulo` char(200) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL,
  `Visitas` int(11) NOT NULL DEFAULT 0,
  `Likes` int(11) NOT NULL DEFAULT 0,
  `IdPais` int(11) NOT NULL,
  `IdCategoria` int(11) NOT NULL,
  `IdReportero` int(11) NOT NULL,
  `IdEditor` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `noticia`
--

INSERT INTO `noticia` (`IdNoticia`, `Descripcion`, `Titulo`, `Fecha`, `Visitas`, `Likes`, `IdPais`, `IdCategoria`, `IdReportero`, `IdEditor`) VALUES
(1, 'Se dio la jornada de vacunación de los centenials en el país, en Celaya hubo 2 sitios de vacunación, .........', 'Vacunación Centenials', '2021-10-15 22:15:11', 0, 0, 3, 2, 20, 0),
(2, 'Se dice que en trece semanas máximo 4 todos los alumnos y profesores del tecnológico nacional de México en Celaya, deberán asistir a clases presenciales. Rumor por confirmar, pero es muy probable.', 'Clases Presenciales', '2021-12-18 22:28:59', 0, 0, 3, 4, 19, 1),
(3, 'bla bla bla bla ....', 'El huracán toca tierra', '2021-12-23 00:56:00', 0, 0, 3, 4, 2, 0),
(4, 'guacala', 'En china comen ratas', '2021-12-06 09:25:33', 0, 0, 4, 2, 2, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `noticiaimagen`
--

CREATE TABLE `noticiaimagen` (
  `Id` int(11) NOT NULL,
  `IdNoticia` int(11) NOT NULL,
  `IdImagen` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `opinion`
--

CREATE TABLE `opinion` (
  `IdOpinion` int(11) NOT NULL,
  `IdNoticia` int(11) NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Comentario` text COLLATE utf8mb4_spanish_ci NOT NULL,
  `Censurado` char(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Fecha` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `opinion`
--

INSERT INTO `opinion` (`IdOpinion`, `IdNoticia`, `IdUsuario`, `Comentario`, `Censurado`, `Fecha`) VALUES
(1, 2, 24, 'No se pasen hijos de su madre patria, como es que ya vamos a regresar a clases, si no me han vacunado...', '1', '2021-11-01 04:33:13'),
(2, 2, 22, 'Me parece excelente, ya no aguanto en mi casa, mi mamá como j*** todos los días con que no hago nada....', '', '2021-11-03 12:23:14'),
(3, 1, 23, 'Esa vacuna no sirve, a mi me inyectaron agua.', '1', '2021-11-11 12:46:14');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pais`
--

CREATE TABLE `pais` (
  `IdPais` int(11) NOT NULL,
  `Nombre` char(20) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `pais`
--

INSERT INTO `pais` (`IdPais`, `Nombre`) VALUES
(2, 'Rusiaaa'),
(3, 'México'),
(4, 'Alemania');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referencia`
--

CREATE TABLE `referencia` (
  `IdReferencia` int(11) NOT NULL,
  `Url` text COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `referencia`
--

INSERT INTO `referencia` (`IdReferencia`, `Url`) VALUES
(1, 'https://www.flaticon.es/packs/customer-reviews-24'),
(2, 'https://www.flaticon.es/icono-premium/buena-resena_4142342?related_id=4142342#');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `referenciaimagen`
--

CREATE TABLE `referenciaimagen` (
  `Id` int(11) NOT NULL,
  `IdNoticia` int(11) NOT NULL,
  `IdReferencia` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipousuario`
--

CREATE TABLE `tipousuario` (
  `Id` int(11) NOT NULL,
  `Nombre` char(10) COLLATE utf8mb4_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `tipousuario`
--

INSERT INTO `tipousuario` (`Id`, `Nombre`) VALUES
(1, 'Admin'),
(2, 'Reportero'),
(3, 'Normal');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `Email` char(70) COLLATE utf8mb4_spanish_ci NOT NULL,
  `IdUsuario` int(11) NOT NULL,
  `Nombre` char(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Apellidos` char(30) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Genero` char(1) COLLATE utf8mb4_spanish_ci NOT NULL,
  `Password` char(13) COLLATE utf8mb4_spanish_ci NOT NULL,
  `FechUltimoAcceso` datetime NOT NULL,
  `ContAccesos` int(11) NOT NULL,
  `Foto` blob NOT NULL,
  `IdTipoUsuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_spanish_ci;

--
-- Volcado de datos para la tabla `usuario`
--

INSERT INTO `usuario` (`Email`, `IdUsuario`, `Nombre`, `Apellidos`, `Genero`, `Password`, `FechUltimoAcceso`, `ContAccesos`, `Foto`, `IdTipoUsuario`) VALUES
('admin1@noticias.com', 1, 'Godofredo', 'De las altas Torres', 'M', '1234', '2021-09-23 00:00:00', 0, '', 1),
('benito@noticias.com', 22, 'Benito', 'Bodoque', 'M', '1234', '2021-12-01 05:31:56', 3, '', 3),
('clodomira@noticias.com', 2, 'Clodomira', 'Maluma Baby', 'F', '*A4B615731903', '2021-09-23 00:00:00', 1, '', 2),
('faverto@gmail.com', 18, 'Roberto', 'Favela', 'M', '2RxYbq7vdD', '2021-12-01 04:48:54', 0, '', 3),
('genaro@gmail.com', 17, 'Genaro', 'Favela', 'M', 'nZrjp6bAM4', '2021-12-01 04:47:41', 0, '', 3),
('goku@noticias.com', 23, 'Goku', 'Son', 'M', '1234', '2021-12-01 05:31:56', 4, '', 3),
('julia@noticias.com', 24, 'Julia', 'Roberts', 'F', '1234', '2021-12-20 22:34:52', 6, '', 3),
('ninguno@noticias.com', 0, 'Ninguno', 'Ninguno', 'O', '1234', '2021-12-01 05:11:07', 0, '', 3),
('patychapoy@noticias.com', 20, 'Patricia', 'Chapoy', 'F', '*A4B615731903', '2021-12-01 04:55:57', 0, '', 2),
('reportero1@noticias.com', 19, 'Bad bunny', 'Rabioso', 'M', '*A4B615731903', '2021-12-01 04:54:30', 0, '', 2);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categoria`
--
ALTER TABLE `categoria`
  ADD PRIMARY KEY (`IdCategoria`);

--
-- Indices de la tabla `imagen`
--
ALTER TABLE `imagen`
  ADD PRIMARY KEY (`IdImagen`);

--
-- Indices de la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD PRIMARY KEY (`IdNoticia`),
  ADD KEY `IdPais` (`IdPais`),
  ADD KEY `IdCategoria` (`IdCategoria`),
  ADD KEY `IdReportero` (`IdReportero`),
  ADD KEY `IdEditor` (`IdEditor`);

--
-- Indices de la tabla `noticiaimagen`
--
ALTER TABLE `noticiaimagen`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdImagen` (`IdImagen`),
  ADD KEY `IdNoticia` (`IdNoticia`);

--
-- Indices de la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD PRIMARY KEY (`IdOpinion`),
  ADD KEY `IdNoticia` (`IdNoticia`),
  ADD KEY `IdUsuario` (`IdUsuario`);

--
-- Indices de la tabla `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`IdPais`);

--
-- Indices de la tabla `referencia`
--
ALTER TABLE `referencia`
  ADD PRIMARY KEY (`IdReferencia`);

--
-- Indices de la tabla `referenciaimagen`
--
ALTER TABLE `referenciaimagen`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `IdNoticia` (`IdNoticia`),
  ADD KEY `IdReferencia` (`IdReferencia`);

--
-- Indices de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  ADD PRIMARY KEY (`Id`);

--
-- Indices de la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`Email`),
  ADD UNIQUE KEY `IdUsuario` (`IdUsuario`),
  ADD KEY `IdTipoUsuario` (`IdTipoUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categoria`
--
ALTER TABLE `categoria`
  MODIFY `IdCategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `imagen`
--
ALTER TABLE `imagen`
  MODIFY `IdImagen` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `noticia`
--
ALTER TABLE `noticia`
  MODIFY `IdNoticia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `noticiaimagen`
--
ALTER TABLE `noticiaimagen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `opinion`
--
ALTER TABLE `opinion`
  MODIFY `IdOpinion` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `pais`
--
ALTER TABLE `pais`
  MODIFY `IdPais` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `referencia`
--
ALTER TABLE `referencia`
  MODIFY `IdReferencia` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `referenciaimagen`
--
ALTER TABLE `referenciaimagen`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `tipousuario`
--
ALTER TABLE `tipousuario`
  MODIFY `Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario`
--
ALTER TABLE `usuario`
  MODIFY `IdUsuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `noticia`
--
ALTER TABLE `noticia`
  ADD CONSTRAINT `Noticia_ibfk_1` FOREIGN KEY (`IdPais`) REFERENCES `pais` (`IdPais`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Noticia_ibfk_2` FOREIGN KEY (`IdCategoria`) REFERENCES `categoria` (`IdCategoria`) ON UPDATE CASCADE,
  ADD CONSTRAINT `Noticia_ibfk_3` FOREIGN KEY (`IdReportero`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Noticia_ibfk_4` FOREIGN KEY (`IdEditor`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `noticiaimagen`
--
ALTER TABLE `noticiaimagen`
  ADD CONSTRAINT `NoticiaImagen_ibfk_1` FOREIGN KEY (`IdImagen`) REFERENCES `imagen` (`IdImagen`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `NoticiaImagen_ibfk_2` FOREIGN KEY (`IdNoticia`) REFERENCES `noticia` (`IdNoticia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `opinion`
--
ALTER TABLE `opinion`
  ADD CONSTRAINT `Opinion_ibfk_1` FOREIGN KEY (`IdNoticia`) REFERENCES `noticia` (`IdNoticia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `Opinion_ibfk_2` FOREIGN KEY (`IdUsuario`) REFERENCES `usuario` (`IdUsuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `referenciaimagen`
--
ALTER TABLE `referenciaimagen`
  ADD CONSTRAINT `ReferenciaImagen_ibfk_1` FOREIGN KEY (`IdNoticia`) REFERENCES `noticia` (`IdNoticia`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `ReferenciaImagen_ibfk_2` FOREIGN KEY (`IdReferencia`) REFERENCES `referencia` (`IdReferencia`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `usuario`
--
ALTER TABLE `usuario`
  ADD CONSTRAINT `Usuario_ibfk_1` FOREIGN KEY (`IdTipoUsuario`) REFERENCES `tipousuario` (`Id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

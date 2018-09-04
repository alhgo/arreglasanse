-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 04-09-2018 a las 18:50:21
-- Versión del servidor: 10.1.13-MariaDB
-- Versión de PHP: 7.0.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `arreglasanse`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marks`
--

CREATE TABLE `marks` (
  `id_mark` int(13) NOT NULL,
  `ident` varchar(10) COLLATE latin1_spanish_ci NOT NULL,
  `time_created` int(13) NOT NULL DEFAULT '0',
  `time_confirm` int(13) NOT NULL DEFAULT '0',
  `id_map` int(13) NOT NULL,
  `id_cat` int(13) NOT NULL,
  `lat` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `lng` varchar(100) COLLATE latin1_spanish_ci NOT NULL,
  `addr` text COLLATE latin1_spanish_ci,
  `id_neigh` int(13) DEFAULT NULL COMMENT 'barrio',
  `id_usr` int(13) NOT NULL,
  `nick` varchar(150) COLLATE latin1_spanish_ci DEFAULT NULL,
  `tit` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `descr` text COLLATE latin1_spanish_ci NOT NULL,
  `time_solved` int(150) DEFAULT '0',
  `solved_descr` text COLLATE latin1_spanish_ci,
  `id_usr_res` int(13) DEFAULT NULL,
  `agree` int(13) NOT NULL DEFAULT '0',
  `comments` int(13) NOT NULL DEFAULT '0',
  `solved` int(13) NOT NULL DEFAULT '0',
  `time_updated` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `marks`
--

INSERT INTO `marks` (`id_mark`, `ident`, `time_created`, `time_confirm`, `id_map`, `id_cat`, `lat`, `lng`, `addr`, `id_neigh`, `id_usr`, `nick`, `tit`, `descr`, `time_solved`, `solved_descr`, `id_usr_res`, `agree`, `comments`, `solved`, `time_updated`) VALUES
(1, '', 1343790770, 1343791770, 1, 6, '40.56500', '-3.62570', 'c/Lope de Vega 8', 1, 1, NULL, 'Primera marca', 'Esta es la descripción de la incidencia', NULL, NULL, NULL, 0, 2, 0, 1351166013),
(2, '', 1343990770, 1343990770, 1, 7, '40.56570', '-3.62330', 'c/José Hierro 18', 2, 1, NULL, 'Segunda marca', 'Esta es la segunda incidencia', 2012, NULL, NULL, 0, 0, 0, 1535213406);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `marks_cat`
--

CREATE TABLE `marks_cat` (
  `id_cat` int(13) NOT NULL,
  `ord` int(2) DEFAULT '1',
  `icon` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `name` varchar(50) COLLATE latin1_spanish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `marks_cat`
--

INSERT INTO `marks_cat` (`id_cat`, `ord`, `icon`, `name`) VALUES
(5, 2, 'limpieza.png', 'Limpieza'),
(6, 4, 'servicios.png', 'Sanidad y servicios'),
(7, 9, 'otros.png', 'Otros'),
(8, 3, 'parques.png', 'Parques y zonas verdes'),
(9, 5, 'movilidad.png', 'Movilidad, transporte y aparcamiento'),
(10, 6, 'ruido.png', 'Ruido'),
(11, 8, 'deportes.png', 'Deportes'),
(12, 7, 'cultura.png', 'Educación y cultura');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `password_reset`
--

CREATE TABLE `password_reset` (
  `id` int(13) NOT NULL,
  `id_user` int(13) NOT NULL,
  `token` varchar(150) COLLATE utf8_bin NOT NULL,
  `time_expire` int(50) NOT NULL,
  `time_confirm` int(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `password_reset`
--

INSERT INTO `password_reset` (`id`, `id_user`, `token`, `time_expire`, `time_confirm`) VALUES
(1, 1, 'bf90a91df33751d1e41cef323a974d78', 1533384523, 0),
(2, 1, 'ad8a4a7550f63ff3dcf96dcbde259ac1', 1533384557, 0),
(3, 1, '7eb61892a843fb0769bd5d25b824aaac', 1533487332, 0);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users`
--

CREATE TABLE `users` (
  `id_user` int(13) NOT NULL,
  `fb_token` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `admin` int(2) NOT NULL,
  `time_confirmed` int(150) NOT NULL DEFAULT '0',
  `name` varchar(250) COLLATE latin1_spanish_ci NOT NULL,
  `username` varchar(50) COLLATE latin1_spanish_ci NOT NULL,
  `birth` int(5) NOT NULL,
  `avatar` varchar(250) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password` varchar(150) COLLATE latin1_spanish_ci DEFAULT NULL,
  `password_recall` int(13) DEFAULT NULL,
  `email` varchar(150) COLLATE latin1_spanish_ci NOT NULL,
  `descr` text COLLATE latin1_spanish_ci,
  `ident` varchar(10) COLLATE latin1_spanish_ci DEFAULT NULL,
  `send_mail_com` int(1) NOT NULL DEFAULT '0',
  `last_logged` int(13) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_spanish_ci;

--
-- Volcado de datos para la tabla `users`
--

INSERT INTO `users` (`id_user`, `fb_token`, `admin`, `time_confirmed`, `name`, `username`, `birth`, `avatar`, `password`, `password_recall`, `email`, `descr`, `ident`, `send_mail_com`, `last_logged`) VALUES
(1, '-LKXpEbb-Uy1__kcgd5Q', 1, 0, 'Álvaro Holguera G', 'alhgo', 1977, NULL, '3377437e35aa5c8574fa04f33ce23e10', NULL, 'correo@laultimapregunta.com', 'Administrador del sitio', NULL, 0, NULL);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_cats_notice`
--

CREATE TABLE `users_cats_notice` (
  `id` int(13) NOT NULL,
  `id_user` int(13) NOT NULL,
  `id_cat` int(13) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Volcado de datos para la tabla `users_cats_notice`
--

INSERT INTO `users_cats_notice` (`id`, `id_user`, `id_cat`) VALUES
(34, 1, 8),
(35, 1, 7),
(36, 1, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `users_temp`
--

CREATE TABLE `users_temp` (
  `id` int(13) NOT NULL,
  `name` varchar(150) COLLATE utf8_bin NOT NULL,
  `username` varchar(12) COLLATE utf8_bin NOT NULL,
  `email` varchar(150) COLLATE utf8_bin NOT NULL,
  `password` varchar(150) COLLATE utf8_bin NOT NULL,
  `token` varchar(150) COLLATE utf8_bin NOT NULL,
  `expire` int(25) NOT NULL,
  `birth` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id_mark`);

--
-- Indices de la tabla `marks_cat`
--
ALTER TABLE `marks_cat`
  ADD PRIMARY KEY (`id_cat`);

--
-- Indices de la tabla `password_reset`
--
ALTER TABLE `password_reset`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indices de la tabla `users_cats_notice`
--
ALTER TABLE `users_cats_notice`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `users_temp`
--
ALTER TABLE `users_temp`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `marks`
--
ALTER TABLE `marks`
  MODIFY `id_mark` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `marks_cat`
--
ALTER TABLE `marks_cat`
  MODIFY `id_cat` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT de la tabla `password_reset`
--
ALTER TABLE `password_reset`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT de la tabla `users`
--
ALTER TABLE `users`
  MODIFY `id_user` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT de la tabla `users_cats_notice`
--
ALTER TABLE `users_cats_notice`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
--
-- AUTO_INCREMENT de la tabla `users_temp`
--
ALTER TABLE `users_temp`
  MODIFY `id` int(13) NOT NULL AUTO_INCREMENT;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

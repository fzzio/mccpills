-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 28-01-2014 a las 19:28:09
-- Versión del servidor: 5.5.27
-- Versión de PHP: 5.4.7

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `pillbrief`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `briefenviado`
--

CREATE TABLE IF NOT EXISTS `briefenviado` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `pillbrief` int(11) DEFAULT NULL,
  `fechaEnvio` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_7A354E542265B05D` (`usuario`),
  KEY `IDX_7A354E5433B76241` (`pillbrief`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `brief_usuarios`
--

CREATE TABLE IF NOT EXISTS `brief_usuarios` (
  `pill_id` int(11) NOT NULL,
  `usuario_id` int(11) NOT NULL,
  PRIMARY KEY (`pill_id`,`usuario_id`),
  KEY `IDX_E81E3564EACD9F12` (`pill_id`),
  KEY `IDX_E81E3564DB38439E` (`usuario_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `brief_usuarios`
--

INSERT INTO `brief_usuarios` (`pill_id`, `usuario_id`) VALUES
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `calificacion`
--

CREATE TABLE IF NOT EXISTS `calificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tipocalificacion` int(11) DEFAULT NULL,
  `pillbrief` int(11) DEFAULT NULL,
  `valorActual` int(11) NOT NULL,
  `fechaModificacion` date NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8A3AF218E1A36E1E` (`tipocalificacion`),
  KEY `IDX_8A3AF21833B76241` (`pillbrief`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categoria`
--

CREATE TABLE IF NOT EXISTS `categoria` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `categoria`
--

INSERT INTO `categoria` (`id`, `nombre`, `descripcion`, `estado`) VALUES
(1, 'categoria1', 'descripcion', 1),
(2, 'categoria2', 'descripcion', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contacto`
--

CREATE TABLE IF NOT EXISTS `contacto` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `pillbrief` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estudio`
--

CREATE TABLE IF NOT EXISTS `estudio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `favorito`
--

CREATE TABLE IF NOT EXISTS `favorito` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `pill` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_881067C72265B05D` (`usuario`),
  KEY `IDX_881067C7803186F7` (`pill`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Volcado de datos para la tabla `favorito`
--

INSERT INTO `favorito` (`id`, `usuario`, `pill`, `estado`, `fechaCreacion`) VALUES
(16, 1, 12, 0, '2014-01-28 16:55:15'),
(17, 1, 13, 0, '2014-01-28 16:55:27'),
(21, 1, 14, 0, '2014-01-28 18:50:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `fondo`
--

CREATE TABLE IF NOT EXISTS `fondo` (
  `idFondo` int(11) NOT NULL AUTO_INCREMENT,
  `imagen` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `color` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`idFondo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pill`
--

CREATE TABLE IF NOT EXISTS `pill` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` int(11) DEFAULT NULL,
  `estudio` int(11) DEFAULT NULL,
  `descripcion` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  `imagen` longtext COLLATE utf8_unicode_ci,
  `fechaCreacion` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_803186F72265B05D` (`usuario`),
  KEY `IDX_803186F7BF0B1A29` (`estudio`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=19 ;

--
-- Volcado de datos para la tabla `pill`
--

INSERT INTO `pill` (`id`, `usuario`, `estudio`, `descripcion`, `estado`, `imagen`, `fechaCreacion`) VALUES
(12, 1, NULL, 'Nada es imposible', 1, '52e6c308844e4.png', '2014-01-27 21:35:32'),
(13, 1, NULL, 'No lo digo yo', 1, '52e6d14032aef.png', '2014-01-27 22:36:11'),
(14, 1, NULL, 'Contenido del pill que se va a mostrar', 1, '52e6d1ac829e0.png', '2014-01-27 22:38:13'),
(15, 1, NULL, 'Toda la verdad que necesitas saber', 1, '52e6d45f6912c.png', '2014-01-27 22:49:30'),
(16, 1, NULL, 'Dar un paso a veces es complicado pero no imposible', 1, '52e6d8ba974b5.png', '2014-01-27 23:08:13'),
(17, 1, NULL, 'la vida no es tan dura a menos que seas como la DICK', 1, '52e7c59985b6b.png', '2014-01-28 15:59:06'),
(18, 1, NULL, 'placeholder', 1, '52e7d98418a36.png', '2014-01-28 17:23:43');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pillbrief`
--

CREATE TABLE IF NOT EXISTS `pillbrief` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pill` int(11) DEFAULT NULL,
  `idContacto` int(11) DEFAULT NULL,
  `entendimiento` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `briefing` varchar(140) COLLATE utf8_unicode_ci NOT NULL,
  `fechaCreacion` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  `usuario` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_33B76241803186F7` (`pill`),
  KEY `IDX_33B762412265B05D` (`usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=17 ;

--
-- Volcado de datos para la tabla `pillbrief`
--

INSERT INTO `pillbrief` (`id`, `pill`, `idContacto`, `entendimiento`, `briefing`, `fechaCreacion`, `estado`, `usuario`) VALUES
(10, 12, NULL, 'entendimiento', 'brief', '2014-01-27 21:35:32', 1, 1),
(11, 13, NULL, 'entiende bro', 'briefing', '2014-01-27 22:36:11', 1, 1),
(12, 14, NULL, 'asdadasdaasdgsd', 'asdfsdfasdfsdf', '2014-01-27 22:38:13', 1, 1),
(13, 15, NULL, 'pruba', 'brief de prueba', '2014-01-27 22:49:30', 1, 1),
(14, 16, NULL, 'Entendimiento', 'briefing', '2014-01-27 23:08:13', 1, 1),
(15, 17, NULL, 'entendimiento', 'briefing', '2014-01-28 15:59:06', 1, 1),
(16, 18, NULL, 'entiendimiento', 'briedasfasdosdnfsdfn', '2014-01-28 17:23:43', 1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pillcat`
--

CREATE TABLE IF NOT EXISTS `pillcat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pill` int(11) DEFAULT NULL,
  `categoria` int(11) DEFAULT NULL,
  `estado` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_12D2198A803186F7` (`pill`),
  KEY `IDX_12D2198A4E10122D` (`categoria`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pilltag`
--

CREATE TABLE IF NOT EXISTS `pilltag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` int(11) DEFAULT NULL,
  `pilll` int(11) DEFAULT NULL,
  `fechaCreacion` datetime NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_8F05EDA1389B783` (`tag`),
  KEY `IDX_8F05EDA1B55F94C7` (`pilll`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pill_categorias`
--

CREATE TABLE IF NOT EXISTS `pill_categorias` (
  `pill_id` int(11) NOT NULL,
  `categorias_id` int(11) NOT NULL,
  PRIMARY KEY (`pill_id`,`categorias_id`),
  KEY `IDX_1C4629F6EACD9F12` (`pill_id`),
  KEY `IDX_1C4629F65792B277` (`categorias_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pill_categorias`
--

INSERT INTO `pill_categorias` (`pill_id`, `categorias_id`) VALUES
(12, 1),
(13, 1),
(14, 1),
(15, 2),
(16, 2),
(17, 1),
(18, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `pill_tags`
--

CREATE TABLE IF NOT EXISTS `pill_tags` (
  `pill_id` int(11) NOT NULL,
  `tag_id` int(11) NOT NULL,
  PRIMARY KEY (`pill_id`,`tag_id`),
  KEY `IDX_1E95967BEACD9F12` (`pill_id`),
  KEY `IDX_1E95967BBAD26311` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Volcado de datos para la tabla `pill_tags`
--

INSERT INTO `pill_tags` (`pill_id`, `tag_id`) VALUES
(12, 17),
(13, 17),
(13, 18),
(14, 6),
(14, 19),
(15, 20),
(15, 21),
(16, 17),
(16, 22),
(17, 17),
(17, 23),
(18, 6),
(18, 10);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tag`
--

CREATE TABLE IF NOT EXISTS `tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Volcado de datos para la tabla `tag`
--

INSERT INTO `tag` (`id`, `nombre`, `estado`) VALUES
(3, 'asdasd', 1),
(4, 'asdasdas', 1),
(5, 'cambio', 1),
(6, 'prueba', 1),
(7, 'dos', 1),
(8, 'asdasdasdasd', 1),
(9, 'asadasdas', 1),
(10, 'heroes_del_silencio', 1),
(11, 'rock', 1),
(12, 'cancion', 1),
(13, 'tag1', 1),
(14, 'tag2', 1),
(15, 'pija', 1),
(17, 'motivacion', 1),
(18, 'dragonball', 1),
(19, 'jaiba', 1),
(20, 'verdad', 1),
(21, 'pill', 1),
(22, 'demo', 1),
(23, 'consejo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipocalificacion`
--

CREATE TABLE IF NOT EXISTS `tipocalificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `descripcion` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `user_pills`
--

CREATE TABLE IF NOT EXISTS `user_pills` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_canonical` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `enabled` tinyint(1) NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_login` datetime DEFAULT NULL,
  `locked` tinyint(1) NOT NULL,
  `expired` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  `confirmation_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password_requested_at` datetime DEFAULT NULL,
  `roles` longtext COLLATE utf8_unicode_ci NOT NULL COMMENT '(DC2Type:array)',
  `credentials_expired` tinyint(1) NOT NULL,
  `credentials_expire_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `UNIQ_DA95626A92FC23A8` (`username_canonical`),
  UNIQUE KEY `UNIQ_DA95626AA0D96FBF` (`email_canonical`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=3 ;

--
-- Volcado de datos para la tabla `user_pills`
--

INSERT INTO `user_pills` (`id`, `username`, `username_canonical`, `email`, `email_canonical`, `enabled`, `salt`, `password`, `last_login`, `locked`, `expired`, `expires_at`, `confirmation_token`, `password_requested_at`, `roles`, `credentials_expired`, `credentials_expire_at`) VALUES
(1, 'hectoritoh', 'hectoritoh', 'misticalelf9@gmail.com', 'misticalelf9@gmail.com', 1, 'qdq29m4lidc4ocwkgocssk0g8ckkskg', 'zXi6MCvSvK5YB7JO9ricLU0bapHIeDJ+sr7Fpk0EER3SyeMDQ7gBKRi1occ65OLbVLVyAWS3uqndt0AVSBYBKg==', '2014-01-27 16:49:16', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL),
(2, 'usuario', 'usuario', 'halvarad@fiec.espol.edu.ec', 'halvarad@fiec.espol.edu.ec', 1, 'qknjpmx6udc4o0o0gww80080wowcoc4', '4sU+vTs83e62VrzdWeieU0vGMXjzob0HU70eDAvaDB/hT0aZRONooHSVMPYtZahfifffus/alSablMRcbJghnQ==', '2014-01-20 20:23:52', 0, 0, NULL, NULL, NULL, 'a:0:{}', 0, NULL);

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `briefenviado`
--
ALTER TABLE `briefenviado`
  ADD CONSTRAINT `FK_7A354E542265B05D` FOREIGN KEY (`usuario`) REFERENCES `user_pills` (`id`),
  ADD CONSTRAINT `FK_7A354E5433B76241` FOREIGN KEY (`pillbrief`) REFERENCES `pillbrief` (`id`);

--
-- Filtros para la tabla `brief_usuarios`
--
ALTER TABLE `brief_usuarios`
  ADD CONSTRAINT `FK_E81E3564DB38439E` FOREIGN KEY (`usuario_id`) REFERENCES `user_pills` (`id`),
  ADD CONSTRAINT `FK_E81E3564EACD9F12` FOREIGN KEY (`pill_id`) REFERENCES `pillbrief` (`id`);

--
-- Filtros para la tabla `calificacion`
--
ALTER TABLE `calificacion`
  ADD CONSTRAINT `FK_8A3AF21833B76241` FOREIGN KEY (`pillbrief`) REFERENCES `pillbrief` (`id`),
  ADD CONSTRAINT `FK_8A3AF218E1A36E1E` FOREIGN KEY (`tipocalificacion`) REFERENCES `tipocalificacion` (`id`);

--
-- Filtros para la tabla `favorito`
--
ALTER TABLE `favorito`
  ADD CONSTRAINT `FK_881067C72265B05D` FOREIGN KEY (`usuario`) REFERENCES `user_pills` (`id`),
  ADD CONSTRAINT `FK_881067C7803186F7` FOREIGN KEY (`pill`) REFERENCES `pill` (`id`);

--
-- Filtros para la tabla `pill`
--
ALTER TABLE `pill`
  ADD CONSTRAINT `FK_803186F72265B05D` FOREIGN KEY (`usuario`) REFERENCES `user_pills` (`id`),
  ADD CONSTRAINT `FK_803186F7BF0B1A29` FOREIGN KEY (`estudio`) REFERENCES `estudio` (`id`);

--
-- Filtros para la tabla `pillbrief`
--
ALTER TABLE `pillbrief`
  ADD CONSTRAINT `FK_33B762412265B05D` FOREIGN KEY (`usuario`) REFERENCES `user_pills` (`id`),
  ADD CONSTRAINT `FK_33B76241803186F7` FOREIGN KEY (`pill`) REFERENCES `pill` (`id`);

--
-- Filtros para la tabla `pillcat`
--
ALTER TABLE `pillcat`
  ADD CONSTRAINT `FK_12D2198A4E10122D` FOREIGN KEY (`categoria`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_12D2198A803186F7` FOREIGN KEY (`pill`) REFERENCES `pill` (`id`);

--
-- Filtros para la tabla `pilltag`
--
ALTER TABLE `pilltag`
  ADD CONSTRAINT `FK_8F05EDA1389B783` FOREIGN KEY (`tag`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `FK_8F05EDA1B55F94C7` FOREIGN KEY (`pilll`) REFERENCES `pill` (`id`);

--
-- Filtros para la tabla `pill_categorias`
--
ALTER TABLE `pill_categorias`
  ADD CONSTRAINT `FK_1C4629F65792B277` FOREIGN KEY (`categorias_id`) REFERENCES `categoria` (`id`),
  ADD CONSTRAINT `FK_1C4629F6EACD9F12` FOREIGN KEY (`pill_id`) REFERENCES `pill` (`id`);

--
-- Filtros para la tabla `pill_tags`
--
ALTER TABLE `pill_tags`
  ADD CONSTRAINT `FK_1E95967BBAD26311` FOREIGN KEY (`tag_id`) REFERENCES `tag` (`id`),
  ADD CONSTRAINT `FK_1E95967BEACD9F12` FOREIGN KEY (`pill_id`) REFERENCES `pill` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

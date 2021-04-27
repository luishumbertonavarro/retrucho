-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 24-04-2021 a las 00:53:22
-- Versión del servidor: 10.4.18-MariaDB
-- Versión de PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `retrucho`
--

DELIMITER $$
--
-- Procedimientos
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comunidad_delete` (IN `p_id` INT)  DELETE FROM comunidad WHERE id=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comunidad_insert` (IN `p_nombre` VARCHAR(200), IN `p_usuarioId` INT)  BEGIN
INSERT INTO comunidad (nombre, idUsuarioCreador)
                 VALUES (p_nombre, p_usuarioId);
SELECT LAST_INSERT_ID() as lastInsertId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comunidad_selectAll` ()  SELECT id, nombre,idUsuarioCreador 
FROM comunidad$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comunidad_selectById` (IN `p_id` INT)  SELECT id, nombre, idUsuarioCreador
            FROM comunidad
            WHERE id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Comunidad_update` (IN `p_nombre` VARCHAR(200), IN `p_idUsuarioCreador` INT, IN `p_id` INT)  UPDATE comunidad
        SET nombre = p_nombre,
            idUsuarioCreador = p_idUsuarioCreador
        WHERE id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_delete` (IN `p_id` INT)  DELETE FROM publicacion WHERE id=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_insert` (IN `p_titulo` VARCHAR(200), IN `p_descripcion` VARCHAR(200), IN `p_cantidadVotos` INT, IN `p_idComunidad` INT, IN `p_idUsuarioCreador` INT)  BEGIN
INSERT INTO publicacion (titulo, descripcion, cantidadVotos, idComunidad,idUsuarioCreador)
                 VALUES (p_titulo, p_descripcion, p_cantidadVotos,p_idComunidad,p_idUsuarioCreador);
SELECT LAST_INSERT_ID() as lastInsertId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_restarPuntos` (IN `p_publicacionId` INT, IN `p_userEmail` VARCHAR(200))  BEGIN
declare usuarioConvertidoId int DEFAULT 0;
SELECT id INTO usuarioConvertidoId FROM usuarios WHERE correo=p_userEmail;
IF((SELECT COUNT(*) as voto FROM votacion WHERE idPublicacion=p_publicacionId AND idUsuario=usuarioConvertidoId)=0) THEN
UPDATE publicacion
SET cantidadVotos=cantidadVotos-1
WHERE id=p_publicacionId ;
INSERT INTO votacion (idPublicacion, idUsuario, estado) VALUES (p_publicacionId,usuarioConvertidoId,1);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_selectAll` ()  SELECT id, titulo,descripcion,cantidadVotos,idComunidad,idUsuarioCreador
FROM publicacion$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_selectByComunidadId` (IN `p_id` INT)  SELECT id, titulo,descripcion,cantidadVotos,idComunidad,idUsuarioCreador
FROM publicacion
WHERE idComunidad=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_selectById` (IN `p_id` INT)  SELECT id, titulo,descripcion,cantidadVotos,idComunidad,idUsuarioCreador
FROM publicacion
WHERE id=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_selectByUserId` (IN `p_UserId` INT)  SELECT id, titulo,descripcion,cantidadVotos,idComunidad,idUsuarioCreador
FROM publicacion
WHERE idUsuarioCreador=p_UserIdd$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_sumarPuntos` (IN `p_publicacionId` INT, IN `p_userEmail` VARCHAR(200))  BEGIN
declare usuarioConvertidoId int DEFAULT 0;
SELECT id INTO usuarioConvertidoId FROM usuarios WHERE correo=p_userEmail;
IF((SELECT COUNT(*) as voto FROM votacion WHERE idPublicacion=p_publicacionId AND idUsuario=usuarioConvertidoId)=0) THEN
UPDATE publicacion
SET cantidadVotos=cantidadVotos+1
WHERE id=p_publicacionId ;
INSERT INTO votacion (idPublicacion, idUsuario, estado) VALUES (p_publicacionId,usuarioConvertidoId,1);
END IF;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Publicacion_update` (IN `p_titulo` VARCHAR(200), IN `p_descripcion` VARCHAR(200), IN `p_id` INT)  UPDATE publicacion
SET titulo=p_titulo,
	descripcion=p_descripcion

WHERE id=p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_delete` (IN `p_id` INT)  DELETE FROM usuarios WHERE id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_insert` (IN `p_correo` VARCHAR(200), IN `p_contrasenha` VARCHAR(200))  BEGIN
INSERT INTO usuarios (correo, contrasenha)
                 VALUES (p_correo, p_contrasenha);
                 
SELECT LAST_INSERT_ID() as lastInsertId;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_login` (IN `p_correo` VARCHAR(200), IN `p_contrasenha` VARCHAR(200))  BEGIN
SELECT IF((SELECT COUNT(*) FROM usuarios WHERE correo=p_correo AND contrasenha=p_contrasenha)>0,"EXISTE", "NO EXISTE");
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_login2` (IN `p_correo` VARCHAR(200), IN `p_contrasenha` VARCHAR(200))  SELECT COUNT(*) as cantUsuarios FROM usuarios WHERE correo=p_correo AND contrasenha=p_contrasenha$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_selectAll` ()  SELECT id,correo,contrasenha FROM usuarios$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuarios_selectById` (IN `p_id` INT)  SELECT id, correo, contrasenha
            FROM usuarios
            WHERE id = p_id$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `sp_Usuario_getByEmail` (IN `p_email` VARCHAR(200))  SELECT id,correo,contrasenha FROM usuarios WHERE correo LIKE p_email$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `comunidad`
--

CREATE TABLE `comunidad` (
  `id` int(11) NOT NULL,
  `nombre` varchar(11) NOT NULL,
  `idUsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `comunidad`
--

INSERT INTO `comunidad` (`id`, `nombre`, `idUsuarioCreador`) VALUES
(1, 'Comelones', 1),
(5, 'zzzzz', 1),
(6, 'nur2', 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `publicacion`
--

CREATE TABLE `publicacion` (
  `id` int(11) NOT NULL,
  `titulo` varchar(400) NOT NULL,
  `descripcion` varchar(400) NOT NULL,
  `cantidadVotos` int(11) NOT NULL,
  `idComunidad` int(11) NOT NULL,
  `idUsuarioCreador` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `publicacion`
--

INSERT INTO `publicacion` (`id`, `titulo`, `descripcion`, `cantidadVotos`, `idComunidad`, `idUsuarioCreador`) VALUES
(1, 'Milanesa', 'tengo mucha hambre y queiro comer milanesa', 5, 1, 1),
(3, 'economico', 'comida muy barata en el shopping no se donde', 2, 1, 20),
(4, 'pastas con papas', 'de caramelo con algo raro 3e1231', 1, 1, 1),
(5, 'ganas de mimir', 'porque no mimo hace 3 dias', 1, 5, 1),
(6, 'sistemas 2', 'estudiantes de ing sistemas parte 2', 1, 6, 24);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `correo` varchar(200) NOT NULL,
  `contrasenha` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`id`, `correo`, `contrasenha`) VALUES
(1, 'ribeiro.beton@gmail.com', 'test123'),
(20, 'probando@gmail.com', '123'),
(21, 'alroriginal1234@globo.com', '123'),
(22, 'cuca@gmail.com', 'kuka12345'),
(24, 'probando2@gmail.com', 'test123');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `votacion`
--

CREATE TABLE `votacion` (
  `id` int(11) NOT NULL,
  `idPublicacion` int(11) NOT NULL,
  `idUsuario` int(11) NOT NULL,
  `estado` int(11) NOT NULL COMMENT '0=negativo, 1=positivo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Volcado de datos para la tabla `votacion`
--

INSERT INTO `votacion` (`id`, `idPublicacion`, `idUsuario`, `estado`) VALUES
(1, 3, 1, 1),
(4, 1, 1, 1),
(5, 4, 1, 1),
(6, 5, 1, 1),
(7, 3, 24, 1),
(8, 6, 24, 1);

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comunidad_usuarios_id_fk` (`idUsuarioCreador`);

--
-- Indices de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `publicacion_comunidad_id_fk` (`idComunidad`),
  ADD KEY `publicacion_usuarios_id_fk` (`idUsuarioCreador`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD PRIMARY KEY (`id`),
  ADD KEY `votacion_publicacion_id_fk` (`idPublicacion`),
  ADD KEY `votacion_usuarios_id_fk` (`idUsuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `comunidad`
--
ALTER TABLE `comunidad`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de la tabla `publicacion`
--
ALTER TABLE `publicacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT de la tabla `votacion`
--
ALTER TABLE `votacion`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `comunidad`
--
ALTER TABLE `comunidad`
  ADD CONSTRAINT `comunidad_usuarios_id_fk` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`id`);

--
-- Filtros para la tabla `publicacion`
--
ALTER TABLE `publicacion`
  ADD CONSTRAINT `publicacion_comunidad_id_fk` FOREIGN KEY (`idComunidad`) REFERENCES `comunidad` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `publicacion_usuarios_id_fk` FOREIGN KEY (`idUsuarioCreador`) REFERENCES `usuarios` (`id`) ON DELETE CASCADE;

--
-- Filtros para la tabla `votacion`
--
ALTER TABLE `votacion`
  ADD CONSTRAINT `votacion_publicacion_id_fk` FOREIGN KEY (`idPublicacion`) REFERENCES `publicacion` (`id`),
  ADD CONSTRAINT `votacion_usuarios_id_fk` FOREIGN KEY (`idUsuario`) REFERENCES `usuarios` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

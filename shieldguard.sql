-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 20-08-2024 a las 06:30:35
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `shieldguard`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ambientes`
--

CREATE TABLE `ambientes` (
  `id` int(11) NOT NULL,
  `nombre_ambiente` varchar(15) DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ambientes`
--

INSERT INTO `ambientes` (`id`, `nombre_ambiente`, `est`) VALUES
(1, 'Produccion', 1),
(2, 'Staging', 1),
(3, 'Desarrollo', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `cliente_id` int(11) NOT NULL,
  `cliente_id_root` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `id_tipo_cliente` int(11) DEFAULT NULL,
  `cliente_cuit_cuil` varchar(255) DEFAULT NULL,
  `cliente_nombre` varchar(255) DEFAULT NULL,
  `cliente_razon_social` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `cliente_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `cliente`
--

INSERT INTO `cliente` (`cliente_id`, `cliente_id_root`, `empresa_id`, `id_tipo_cliente`, `cliente_cuit_cuil`, `cliente_nombre`, `cliente_razon_social`, `fecha_creacion`, `cliente_est`) VALUES
(1, 1, 1, 1, '6-20563214-2', 'La casa del audio', 'La casa del audio s.a', '2024-08-11 09:41:05', 1),
(2, 0, 3, 1, '1-4571215-5', 'Coto', 'Coto s.a', '2024-08-11 10:02:28', 1),
(3, 1, 1, 1, '15-124512-20', 'Hendel', 'Hender s.a', '2024-08-17 14:19:25', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `consultora`
--

CREATE TABLE `consultora` (
  `consultora_id` int(11) NOT NULL,
  `consultora_nombre` varchar(255) DEFAULT NULL,
  `consultora_cuit` varchar(255) DEFAULT NULL,
  `consultora_razon_social` varchar(255) DEFAULT NULL,
  `consultora_fecha_creacion` datetime DEFAULT current_timestamp(),
  `consultora_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_consultora`
--

CREATE TABLE `contrato_consultora` (
  `contrato_consultora_id` int(11) NOT NULL,
  `consultora_id` int(11) DEFAULT NULL,
  `detalle_contrato_consultora` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_baja` varchar(255) DEFAULT NULL,
  `contrato_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `contrato_empresa`
--

CREATE TABLE `contrato_empresa` (
  `contrato_empresa_id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `detalle_contrato_empresa` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_baja` varchar(255) DEFAULT NULL,
  `empresa_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa`
--

CREATE TABLE `empresa` (
  `empresa_id` int(11) NOT NULL,
  `root_id` int(11) NOT NULL,
  `usuario_empresa_creador` int(11) NOT NULL,
  `empresa_nombre` varchar(255) DEFAULT NULL,
  `empresa_cuit` varchar(255) DEFAULT NULL,
  `empresa_razon_social` varchar(255) DEFAULT NULL,
  `empresa_fecha_creacion` datetime DEFAULT current_timestamp(),
  `empresa_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa`
--

INSERT INTO `empresa` (`empresa_id`, `root_id`, `usuario_empresa_creador`, `empresa_nombre`, `empresa_cuit`, `empresa_razon_social`, `empresa_fecha_creacion`, `empresa_est`) VALUES
(1, 1, 1, 'Shieldpath', 'n/a', 'Shieldpath sas', '2024-06-09 01:50:08', 1),
(3, 0, 1, 'Info Sur', 'Info Sur S.R.L', '11-52412-6', '2024-08-11 09:44:19', 1);

--
-- Disparadores `empresa`
--
DELIMITER $$
CREATE TRIGGER `log_insert_partner` AFTER INSERT ON `empresa` FOR EACH ROW BEGIN
INSERT INTO logs_partners_empresas(usuario_empresa_id,logs_accion,empresa_id,fech_crea)VALUES (NEW.usuario_empresa_creador,"Alta de Partner",NEW.empresa_id,now());
end
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `empresa_servicios`
--

CREATE TABLE `empresa_servicios` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `servicio_id` int(11) DEFAULT NULL,
  `fech_crea` timestamp NOT NULL DEFAULT current_timestamp(),
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `empresa_servicios`
--

INSERT INTO `empresa_servicios` (`id`, `empresa_id`, `servicio_id`, `fech_crea`, `est`) VALUES
(1, 1, 1, '2024-08-16 22:47:26', 1),
(2, 1, 2, '2024-08-16 22:47:26', 1),
(3, 1, 3, '2024-08-16 22:47:26', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escaneo`
--

CREATE TABLE `escaneo` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `escaneo_titulo` varchar(255) DEFAULT NULL,
  `escaneo_fecha` varchar(30) DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escaneo`
--

INSERT INTO `escaneo` (`id`, `cliente_id`, `usuario_id`, `escaneo_titulo`, `escaneo_fecha`) VALUES
(1, 3, 1, 'escaneo 1', '2024-08-20 01:27');

--
-- Disparadores `escaneo`
--
DELIMITER $$
CREATE TRIGGER `after_insert_escaneo` AFTER INSERT ON `escaneo` FOR EACH ROW BEGIN
    INSERT INTO historial_escaneos (escaneo_id, id_estado_escaneo) 
    VALUES (NEW.id, 1);
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escaneo_ips`
--

CREATE TABLE `escaneo_ips` (
  `id` int(11) NOT NULL,
  `escaneo_id` int(11) DEFAULT NULL,
  `ips_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escaneo_ips`
--

INSERT INTO `escaneo_ips` (`id`, `escaneo_id`, `ips_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `escaneo_urls`
--

CREATE TABLE `escaneo_urls` (
  `id` int(11) NOT NULL,
  `escaneo_id` int(11) DEFAULT NULL,
  `urls_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `escaneo_urls`
--

INSERT INTO `escaneo_urls` (`id`, `escaneo_id`, `urls_id`) VALUES
(1, 1, 2),
(2, 1, 3);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_escaneos`
--

CREATE TABLE `estados_escaneos` (
  `id` int(11) NOT NULL,
  `estado_escaneo` varchar(25) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `estados_escaneos`
--

INSERT INTO `estados_escaneos` (`id`, `estado_escaneo`) VALUES
(1, 'Pendiente'),
(2, 'Assets Agregados'),
(3, 'En Proceso'),
(4, 'En Espera'),
(5, 'Cancelado'),
(6, 'Finalizado');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `historial_escaneos`
--

CREATE TABLE `historial_escaneos` (
  `id` int(11) NOT NULL,
  `escaneo_id` int(11) DEFAULT NULL,
  `id_estado_escaneo` int(11) DEFAULT NULL,
  `fecha_estado` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `historial_escaneos`
--

INSERT INTO `historial_escaneos` (`id`, `escaneo_id`, `id_estado_escaneo`, `fecha_estado`) VALUES
(1, 1, 1, '2024-08-20 01:27:20'),
(2, 1, 2, '2024-08-20 01:27:42');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `ips`
--

CREATE TABLE `ips` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `ambiente_id` int(11) NOT NULL,
  `ip` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_baja` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `ips`
--

INSERT INTO `ips` (`id`, `cliente_id`, `ambiente_id`, `ip`, `fecha_creacion`, `fecha_baja`, `est`) VALUES
(1, 3, 1, '192.168.56.12', '2024-08-19 16:24:20', NULL, 1),
(2, 3, 1, '192.168.1.36', '2024-08-19 16:24:20', NULL, 1),
(3, 3, 1, '192.168.56.1', '2024-08-19 16:24:20', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_partners_empresas`
--

CREATE TABLE `logs_partners_empresas` (
  `logs_empresa_id` int(11) NOT NULL,
  `usuario_empresa_id` int(11) NOT NULL,
  `logs_accion` varchar(50) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs_partners_empresas`
--

INSERT INTO `logs_partners_empresas` (`logs_empresa_id`, `usuario_empresa_id`, `logs_accion`, `empresa_id`, `fech_crea`) VALUES
(1, 1, 'Alta de Partner', 3, '2024-08-11 09:44:19');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `logs_usuarios_empresa`
--

CREATE TABLE `logs_usuarios_empresa` (
  `logs_usuarios_id` int(11) NOT NULL,
  `logs_accion` varchar(50) NOT NULL,
  `usuario_empresa_creador` int(11) DEFAULT NULL,
  `usuario_empresa_pasivo` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `fech_crea` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `logs_usuarios_empresa`
--

INSERT INTO `logs_usuarios_empresa` (`logs_usuarios_id`, `logs_accion`, `usuario_empresa_creador`, `usuario_empresa_pasivo`, `empresa_id`, `fech_crea`) VALUES
(1, 'Alta de Cuenta', 1, 1, 1, '2024-08-11 09:24:30'),
(2, 'Alta de Cuenta', 1, 1, 1, '2024-08-11 09:38:38'),
(3, 'Alta de Cuenta', 1, 2, 1, '2024-08-11 09:40:18'),
(4, 'Alta de Cuenta', 1, 3, 3, '2024-08-11 09:53:18'),
(5, 'Alta de Cuenta', 1, 4, 3, '2024-08-11 12:21:36');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `rol`
--

CREATE TABLE `rol` (
  `rol_id` int(11) NOT NULL,
  `rol_nombre` varchar(50) DEFAULT NULL,
  `rol_est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `rol`
--

INSERT INTO `rol` (`rol_id`, `rol_nombre`, `rol_est`) VALUES
(1, 'Administrador', 1),
(2, 'Usuario', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `root`
--

CREATE TABLE `root` (
  `root_id` int(11) NOT NULL,
  `root_estado` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `root`
--

INSERT INTO `root` (`root_id`, `root_estado`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `sector`
--

CREATE TABLE `sector` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) NOT NULL,
  `cliente_id` int(11) NOT NULL,
  `uninegocio_id` int(11) DEFAULT NULL,
  `sector_nombre` varchar(255) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `sector`
--

INSERT INTO `sector` (`id`, `empresa_id`, `cliente_id`, `uninegocio_id`, `sector_nombre`, `fech_crea`, `est`) VALUES
(1, 1, 3, 1, 'Local Zona Sur', '2024-08-19 14:32:42', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `servicios`
--

CREATE TABLE `servicios` (
  `id` int(11) NOT NULL,
  `servicio` varchar(50) DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `servicios`
--

INSERT INTO `servicios` (`id`, `servicio`, `est`) VALUES
(1, 'Gestion de Vulnerabilidades', 1),
(2, 'Incident Response', 1),
(3, 'Soc Lite', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `tipo_cliente`
--

CREATE TABLE `tipo_cliente` (
  `id` int(11) NOT NULL,
  `tipo_cliente` varchar(30) DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `tipo_cliente`
--

INSERT INTO `tipo_cliente` (`id`, `tipo_cliente`, `est`) VALUES
(1, 'Juridica', 1),
(2, 'Fisica', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `unidad_negocio`
--

CREATE TABLE `unidad_negocio` (
  `id` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) NOT NULL,
  `uninegocio_nombre` varchar(255) DEFAULT NULL,
  `fech_crea` datetime DEFAULT current_timestamp(),
  `est` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `unidad_negocio`
--

INSERT INTO `unidad_negocio` (`id`, `empresa_id`, `cliente_id`, `uninegocio_nombre`, `fech_crea`, `est`) VALUES
(1, 1, 3, 'Uni negocuo 1', '2024-08-19 14:31:19', 1),
(2, 1, 3, 'Uni negocuo CENTRAL', '2024-08-19 14:31:46', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `urls`
--

CREATE TABLE `urls` (
  `id` int(11) NOT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `ambiente_id` int(11) DEFAULT NULL,
  `url` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `fecha_baja` datetime DEFAULT NULL,
  `est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `urls`
--

INSERT INTO `urls` (`id`, `cliente_id`, `ambiente_id`, `url`, `fecha_creacion`, `fecha_baja`, `est`) VALUES
(1, 3, 1, 'http://ejemplo1.com', '2024-08-19 19:45:39', NULL, 1),
(2, 3, 1, 'http://ejemplo2.com', '2024-08-19 19:45:39', NULL, 1),
(3, 3, 1, 'http://ejemplo3.com', '2024-08-19 19:45:39', NULL, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_cliente`
--

CREATE TABLE `usuario_cliente` (
  `id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `cliente_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `email_usuario_cliente` varchar(50) DEFAULT NULL,
  `password_usuario_cliente` varchar(255) DEFAULT NULL,
  `usuario_cliente_fecha_creacion` datetime DEFAULT current_timestamp(),
  `usuario_cliente_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_cliente`
--

INSERT INTO `usuario_cliente` (`id`, `rol_id`, `cliente_id`, `empresa_id`, `email_usuario_cliente`, `password_usuario_cliente`, `usuario_cliente_fecha_creacion`, `usuario_cliente_est`) VALUES
(1, 2, 2, 3, 'coto_soporte@shieldpath.com.ar', '$2y$10$XEuuflAn1WriQpG0jai67uSOZ5mVFViBtpwGEJwVSp5iL6hbiwq7m', '2024-08-11 12:24:28', 1),
(3, 1, 1, 1, 'admin@shieldpath.com.ar', '$2y$10$eorTU.3zqXEcx/TQ3cZZVOnZT8Uzvxs4gb4RlU5JFtbFkmdTKI5tG', '2024-08-16 14:00:17', 1),
(4, 2, 1, 1, 'prueba2@shieldpath.com.ar', '$2y$10$R8oor41VCYQphuwWWkLfOOt1yQDEHHzpnmS9og6SPVIP3.T87x9ES', '2024-08-19 13:01:58', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_consultora`
--

CREATE TABLE `usuario_consultora` (
  `usaurio_consultora_id` int(11) NOT NULL,
  `consultora_id` int(11) DEFAULT NULL,
  `email_usuario_consultora` varchar(255) DEFAULT NULL,
  `password_usuario_consultora` varchar(255) DEFAULT NULL,
  `fecha_creacion` datetime DEFAULT current_timestamp(),
  `usaurio_consultora_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario_empresa`
--

CREATE TABLE `usuario_empresa` (
  `usuario_empresa_id` int(11) NOT NULL,
  `rol_id` int(11) DEFAULT NULL,
  `usuario_empresa_creador` int(11) NOT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `email_usuario_empresa` varchar(100) DEFAULT NULL,
  `password_usuario_empresa` varchar(255) DEFAULT NULL,
  `usuario_empresa_fecha_creacion` datetime DEFAULT current_timestamp(),
  `usuario_empresa_est` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Volcado de datos para la tabla `usuario_empresa`
--

INSERT INTO `usuario_empresa` (`usuario_empresa_id`, `rol_id`, `usuario_empresa_creador`, `empresa_id`, `email_usuario_empresa`, `password_usuario_empresa`, `usuario_empresa_fecha_creacion`, `usuario_empresa_est`) VALUES
(1, 1, 1, 1, 'mrgonzalez@shieldpath.com.ar', '$2y$10$Xh3YWQivpvC0uqCgUrhLyO.rC6L3kidjt1RFXxjzmnbcy2kPy8j/e', '2024-08-11 09:38:38', 1),
(2, 2, 1, 1, 'prueba@shielpath.com.ar', '$2y$10$Xh3YWQivpvC0uqCgUrhLyO.rC6L3kidjt1RFXxjzmnbcy2kPy8j/e', '2024-08-11 09:40:18', 1),
(3, 1, 1, 3, 'infoSur@shieldpath.com.ar', '$2y$10$Xh3YWQivpvC0uqCgUrhLyO.rC6L3kidjt1RFXxjzmnbcy2kPy8j/e', '2024-08-11 09:53:18', 1),
(4, 2, 1, 3, 'infoSurAdmin@shieldpath.com.ar', '$2y$10$Xh3YWQivpvC0uqCgUrhLyO.rC6L3kidjt1RFXxjzmnbcy2kPy8j/e', '2024-08-11 12:21:36', 1);

--
-- Disparadores `usuario_empresa`
--
DELIMITER $$
CREATE TRIGGER `log_activacion_usuario` AFTER UPDATE ON `usuario_empresa` FOR EACH ROW BEGIN
    IF OLD.usuario_empresa_est != NEW.usuario_empresa_est AND NEW.usuario_empresa_est = 1 THEN
        INSERT INTO logs_usuarios_empresa (logs_accion, usuario_empresa_creador, usuario_empresa_pasivo, empresa_id)
        VALUES ('Activacion de Cuenta', OLD.usuario_empresa_creador, NEW.usuario_empresa_id, NEW.empresa_id);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_desactivacion_usuario` AFTER UPDATE ON `usuario_empresa` FOR EACH ROW BEGIN
    IF OLD.usuario_empresa_est != NEW.usuario_empresa_est AND NEW.usuario_empresa_est = 0 THEN
        INSERT INTO logs_usuarios_empresa (logs_accion, usuario_empresa_creador, usuario_empresa_pasivo, empresa_id)
        VALUES ('Inactivacion de Cuenta', OLD.usuario_empresa_creador, NEW.usuario_empresa_id, NEW.empresa_id);
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `log_insert_usuario` AFTER INSERT ON `usuario_empresa` FOR EACH ROW BEGIN
INSERT INTO logs_usuarios_empresa(logs_accion,usuario_empresa_creador,usuario_empresa_pasivo,empresa_id)VALUES ("Alta de Cuenta", NEW.usuario_empresa_creador,NEW.usuario_empresa_id,NEW.empresa_id);
end
$$
DELIMITER ;

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`cliente_id`);

--
-- Indices de la tabla `consultora`
--
ALTER TABLE `consultora`
  ADD PRIMARY KEY (`consultora_id`);

--
-- Indices de la tabla `contrato_consultora`
--
ALTER TABLE `contrato_consultora`
  ADD PRIMARY KEY (`contrato_consultora_id`);

--
-- Indices de la tabla `contrato_empresa`
--
ALTER TABLE `contrato_empresa`
  ADD PRIMARY KEY (`contrato_empresa_id`);

--
-- Indices de la tabla `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`empresa_id`);

--
-- Indices de la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escaneo`
--
ALTER TABLE `escaneo`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escaneo_ips`
--
ALTER TABLE `escaneo_ips`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `escaneo_urls`
--
ALTER TABLE `escaneo_urls`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `estados_escaneos`
--
ALTER TABLE `estados_escaneos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `historial_escaneos`
--
ALTER TABLE `historial_escaneos`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `ips`
--
ALTER TABLE `ips`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `logs_partners_empresas`
--
ALTER TABLE `logs_partners_empresas`
  ADD PRIMARY KEY (`logs_empresa_id`);

--
-- Indices de la tabla `logs_usuarios_empresa`
--
ALTER TABLE `logs_usuarios_empresa`
  ADD PRIMARY KEY (`logs_usuarios_id`);

--
-- Indices de la tabla `rol`
--
ALTER TABLE `rol`
  ADD PRIMARY KEY (`rol_id`);

--
-- Indices de la tabla `root`
--
ALTER TABLE `root`
  ADD PRIMARY KEY (`root_id`);

--
-- Indices de la tabla `sector`
--
ALTER TABLE `sector`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `servicios`
--
ALTER TABLE `servicios`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `unidad_negocio`
--
ALTER TABLE `unidad_negocio`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `urls`
--
ALTER TABLE `urls`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_cliente`
--
ALTER TABLE `usuario_cliente`
  ADD PRIMARY KEY (`id`);

--
-- Indices de la tabla `usuario_consultora`
--
ALTER TABLE `usuario_consultora`
  ADD PRIMARY KEY (`usaurio_consultora_id`);

--
-- Indices de la tabla `usuario_empresa`
--
ALTER TABLE `usuario_empresa`
  ADD PRIMARY KEY (`usuario_empresa_id`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `ambientes`
--
ALTER TABLE `ambientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `cliente`
--
ALTER TABLE `cliente`
  MODIFY `cliente_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `consultora`
--
ALTER TABLE `consultora`
  MODIFY `consultora_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato_consultora`
--
ALTER TABLE `contrato_consultora`
  MODIFY `contrato_consultora_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `contrato_empresa`
--
ALTER TABLE `contrato_empresa`
  MODIFY `contrato_empresa_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `empresa`
--
ALTER TABLE `empresa`
  MODIFY `empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `empresa_servicios`
--
ALTER TABLE `empresa_servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `escaneo`
--
ALTER TABLE `escaneo`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `escaneo_ips`
--
ALTER TABLE `escaneo_ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `escaneo_urls`
--
ALTER TABLE `escaneo_urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `estados_escaneos`
--
ALTER TABLE `estados_escaneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `historial_escaneos`
--
ALTER TABLE `historial_escaneos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `ips`
--
ALTER TABLE `ips`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `logs_partners_empresas`
--
ALTER TABLE `logs_partners_empresas`
  MODIFY `logs_empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `logs_usuarios_empresa`
--
ALTER TABLE `logs_usuarios_empresa`
  MODIFY `logs_usuarios_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de la tabla `rol`
--
ALTER TABLE `rol`
  MODIFY `rol_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `root`
--
ALTER TABLE `root`
  MODIFY `root_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `sector`
--
ALTER TABLE `sector`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `servicios`
--
ALTER TABLE `servicios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `tipo_cliente`
--
ALTER TABLE `tipo_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `unidad_negocio`
--
ALTER TABLE `unidad_negocio`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `urls`
--
ALTER TABLE `urls`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `usuario_cliente`
--
ALTER TABLE `usuario_cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `usuario_consultora`
--
ALTER TABLE `usuario_consultora`
  MODIFY `usaurio_consultora_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `usuario_empresa`
--
ALTER TABLE `usuario_empresa`
  MODIFY `usuario_empresa_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

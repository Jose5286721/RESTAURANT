-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Servidor: localhost
-- Tiempo de generación: 28-02-2020 a las 19:39:17
-- Versión del servidor: 10.1.35-MariaDB
-- Versión de PHP: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `restaurant`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `categorias`
--

CREATE TABLE `categorias` (
  `idcategoria` int(11) NOT NULL,
  `nombrecategoria` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `categorias`
--

INSERT INTO `categorias` (`idcategoria`, `nombrecategoria`) VALUES
(8, 'POSTRES '),
(9, 'VERDULERIAS  '),
(13, 'CARNE'),
(14, 'POLLO'),
(15, 'PESCADO'),
(17, 'BEBIDAS '),
(18, 'PANIFICACIÓN'),
(19, 'SERVICIO DE MESA'),
(20, 'PIZZERIA');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalles`
--

CREATE TABLE `detalles` (
  `iddetalle` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL,
  `cantidad` double NOT NULL,
  `precio` int(11) NOT NULL,
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `detalles`
--

INSERT INTO `detalles` (`iddetalle`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `precio_total_producto`) VALUES
(4, 14, 3, '07-01-2020', 'MESA 1', 0, 25000, 0),
(5, 18, 3, '07-01-2020', 'MESA 1', 0, 15000, 0),
(7, 12, 3, '08-01-2020', 'MESA 1', 0, 10000, 0),
(8, 23, 3, '08-01-2020', 'MESA 1', 0, 30000, 0),
(9, 15, 3, '08-01-2020', 'MESA 1', 0, 15000, 0),
(10, 12, 3, '19-01-2020', 'MESA 12', 0, 10000, 0),
(11, 12, 3, '19-01-2020', 'MESA 12', 0, 10000, 0),
(12, 16, 3, '22-01-2020', '\'MESA 1\'', 1, 6000, 6000),
(13, 23, 3, '23-01-2020', '\'MESA 1\'', 1, 30000, 30000),
(14, 16, 3, '24-01-2020', 'MESA 1', 1, 6000, 6000),
(15, 16, 3, '24-01-2020', 'MESA 1', 1, 6000, 6000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `detalle_pedido`
--

CREATE TABLE `detalle_pedido` (
  `idpedido` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `cantidad` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estados_productos`
--

CREATE TABLE `estados_productos` (
  `id_estado_producto` int(11) NOT NULL,
  `estado` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estados_productos`
--

INSERT INTO `estados_productos` (`id_estado_producto`, `estado`) VALUES
(1, 'PENDIENTE'),
(2, 'ENTREGADO'),
(3, 'CANCELADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `estado_mesa`
--

CREATE TABLE `estado_mesa` (
  `idestado` int(11) NOT NULL,
  `nombreestado` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `estado_mesa`
--

INSERT INTO `estado_mesa` (`idestado`, `nombreestado`) VALUES
(1, 'LIBRE'),
(2, 'RESERVADO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Mesa`
--

CREATE TABLE `Mesa` (
  `idmesa` int(11) NOT NULL,
  `nombremesa` varchar(45) NOT NULL,
  `estado_mesa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `Mesa`
--

INSERT INTO `Mesa` (`idmesa`, `nombremesa`, `estado_mesa`) VALUES
(1, 'MESA 1', 1),
(2, 'MESA 2', 1),
(3, 'MESA 3', 1),
(4, 'MESA 4', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa1`
--

CREATE TABLE `mesa1` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 1',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa1`
--

INSERT INTO `mesa1` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(1, 11, 3, '20-02-2020', '1', 4, 10000, 2, 40000),
(2, 23, 3, '20-02-2020', '1', 3, 30000, 2, 90000),
(3, 11, 3, '20-02-2020', '1', 1, 10000, 1, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa2`
--

CREATE TABLE `mesa2` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 2',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa2`
--

INSERT INTO `mesa2` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(48, 11, 3, '20-02-2020', '2', 13, 10000, 1, 130000),
(49, 21, 3, '20-02-2020', '2', 1, 7000, 1, 7000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa3`
--

CREATE TABLE `mesa3` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 3',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa3`
--

INSERT INTO `mesa3` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(1, 16, 3, '20-02-2020', '3', 2, 6000, 3, 12000),
(2, 14, 3, '20-02-2020', '3', 5, 25000, 3, 125000),
(3, 12, 3, '28-02-2020', '3', 1, 10000, 2, 10000),
(4, 19, 3, '28-02-2020', '3', 1, 25000, 2, 25000),
(5, 12, 3, '28-02-2020', '3', 3, 10000, 1, 30000),
(6, 23, 3, '28-02-2020', '3', 2, 30000, 1, 60000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa4`
--

CREATE TABLE `mesa4` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 4',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa4`
--

INSERT INTO `mesa4` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(1, 11, 3, '28-02-2020', '4', 1, 10000, 1, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa5`
--

CREATE TABLE `mesa5` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 5',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa6`
--

CREATE TABLE `mesa6` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 6',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa7`
--

CREATE TABLE `mesa7` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 7',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa7`
--

INSERT INTO `mesa7` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(44, 19, 3, '20-02-2020', '7', 1, 25000, 1, 25000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa8`
--

CREATE TABLE `mesa8` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 8',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa9`
--

CREATE TABLE `mesa9` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 9',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa9`
--

INSERT INTO `mesa9` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(44, 11, 3, '20-02-2020', '9', 1, 10000, 1, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa10`
--

CREATE TABLE `mesa10` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 10',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa11`
--

CREATE TABLE `mesa11` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 11',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa12`
--

CREATE TABLE `mesa12` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 12',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa13`
--

CREATE TABLE `mesa13` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 13',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa14`
--

CREATE TABLE `mesa14` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 14',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa15`
--

CREATE TABLE `mesa15` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 15',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa16`
--

CREATE TABLE `mesa16` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 16',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

--
-- Volcado de datos para la tabla `mesa16`
--

INSERT INTO `mesa16` (`idmesa`, `idproducto`, `idusuario`, `fecha`, `mesa`, `cantidad`, `precio`, `id_estado_producto`, `precio_total_producto`) VALUES
(44, 12, 3, '20-02-2020', '16', 1, 10000, 2, 10000);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa17`
--

CREATE TABLE `mesa17` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 17',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa18`
--

CREATE TABLE `mesa18` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 18',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa19`
--

CREATE TABLE `mesa19` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 18',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa20`
--

CREATE TABLE `mesa20` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 20',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa21`
--

CREATE TABLE `mesa21` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 21',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa22`
--

CREATE TABLE `mesa22` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 22',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa23`
--

CREATE TABLE `mesa23` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 23',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa24`
--

CREATE TABLE `mesa24` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 24',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `mesa25`
--

CREATE TABLE `mesa25` (
  `idmesa` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `fecha` varchar(50) NOT NULL,
  `mesa` varchar(50) NOT NULL DEFAULT 'MESA 25',
  `cantidad` int(11) NOT NULL DEFAULT '1',
  `precio` double NOT NULL,
  `id_estado_producto` int(11) NOT NULL DEFAULT '1',
  `precio_total_producto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `Pedido`
--

CREATE TABLE `Pedido` (
  `idpedido` int(11) NOT NULL,
  `idusuario` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `fechapedido` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `totalpedido` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `productos`
--

CREATE TABLE `productos` (
  `idproducto` int(11) NOT NULL,
  `nombreproducto` text NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `precio` double NOT NULL,
  `idusuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `productos`
--

INSERT INTO `productos` (`idproducto`, `nombreproducto`, `idcategoria`, `precio`, `idusuario`) VALUES
(11, 'AGUA C/GAS', 17, 10000, 1),
(12, 'COCA COLA 500CM', 17, 10000, 1),
(13, 'VINO LA CASONA MALBEC', 17, 128000, 1),
(14, 'ENSALADA C/ RÚCULA', 9, 25000, 1),
(15, 'ENSALADA MIXTA', 9, 15000, 1),
(16, 'SODA 500 CM', 17, 6000, 1),
(18, 'HELADOS 2 BOCHAS', 8, 15000, 1),
(19, 'MILANESA C/ FRITAS', 13, 25000, 1),
(20, 'VINO VALDEROBLE TINTO', 17, 100000, 1),
(21, 'FLAN', 8, 7000, 1),
(23, 'COLITA DE CUADRIL', 13, 30000, 1),
(24, '1 SERVICIO DE MESA ', 19, 10000, 3),
(25, '2 SERVICIO DE MESAS', 19, 10000, 1),
(26, '3  SERVICIO DE MESAS', 19, 10000, 1),
(27, '4  SERVICIO DE MESAS', 19, 10000, 1),
(28, '5 SERVICIO DE MESAS', 19, 10000, 1),
(29, '6 SERVICIO DE MESAS', 19, 10000, 1),
(30, '7 SERVICIO DE MESAS', 19, 10000, 1),
(31, '8 SERVICIO DE MESAS', 19, 10000, 1),
(32, '9 SERVICIO DE MESAS', 19, 10000, 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `proveedores`
--

CREATE TABLE `proveedores` (
  `idproveedor` int(11) NOT NULL,
  `nombreproveedor` varchar(150) NOT NULL,
  `idcategoria` int(11) NOT NULL,
  `idproducto` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `reservas`
--

CREATE TABLE `reservas` (
  `idreserva` int(11) NOT NULL,
  `idmesa` int(11) NOT NULL,
  `nombrecliente` varchar(150) NOT NULL,
  `cantidadpersonas` varchar(150) NOT NULL,
  `telefono` varchar(150) NOT NULL,
  `diallegada` date NOT NULL,
  `horallegada` text NOT NULL,
  `observaciones` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `reservas`
--

INSERT INTO `reservas` (`idreserva`, `idmesa`, `nombrecliente`, `cantidadpersonas`, `telefono`, `diallegada`, `horallegada`, `observaciones`) VALUES
(23, 1, 'Jose', '12', '0991631870', '2020-02-25', '22:00', 'Sin Restricciones'),
(24, 2, 'JOSE', '12', '0991687052', '2020-02-25', '22:22', 'Sin Restricciones'),
(25, 1, 'Jose', '3', '0991631870', '2020-02-26', '20:20', 'Sin Restricciones'),
(26, 2, 'Jose', '8', '0991631870', '2020-02-26', '20:20', 'Sin Restricciones'),
(27, 4, 'Jose', '5', '0991631870', '2020-02-26', '20:20', 'Sin Restricciones'),
(28, 1, 'Jose', '7', '0991631870', '2020-02-27', '22:22', 'Sin Restricciones'),
(29, 1, 'Jose', '12', '0991631870', '2020-02-28', '20:20', 'Sin Restricciones'),
(32, 2, 'Jose', '4', '0991631870', '2020-02-28', '22:22', 'Sin Restricciones'),
(33, 3, 'Jose', '4', '0991631870', '2020-02-28', '22:22', 'Sin Restricciones'),
(34, 4, 'Jose', '5', '0991631870', '2020-02-28', '22:22', 'Sin Restricciones');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuarios`
--

CREATE TABLE `usuarios` (
  `idusuario` int(11) NOT NULL,
  `nombreusuario` varchar(150) NOT NULL,
  `password` varchar(150) NOT NULL,
  `fechacreado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Volcado de datos para la tabla `usuarios`
--

INSERT INTO `usuarios` (`idusuario`, `nombreusuario`, `password`, `fechacreado`) VALUES
(1, 'ADMINISTRADOR', '1234', '2016-12-22 00:59:29'),
(2, 'CMALDONADO', '1234', '2017-01-24 01:47:34'),
(3, 'BIANCA', '1234', '2017-01-24 01:53:00');

--
-- Índices para tablas volcadas
--

--
-- Indices de la tabla `categorias`
--
ALTER TABLE `categorias`
  ADD PRIMARY KEY (`idcategoria`);

--
-- Indices de la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD PRIMARY KEY (`iddetalle`),
  ADD KEY `FK__productos` (`idproducto`),
  ADD KEY `FK_detalles_usuarios` (`idusuario`);

--
-- Indices de la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD KEY `idpedido` (`idpedido`),
  ADD KEY `idmesa` (`idmesa`);

--
-- Indices de la tabla `estados_productos`
--
ALTER TABLE `estados_productos`
  ADD PRIMARY KEY (`id_estado_producto`);

--
-- Indices de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  ADD PRIMARY KEY (`idestado`);

--
-- Indices de la tabla `Mesa`
--
ALTER TABLE `Mesa`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `estado_mesa` (`estado_mesa`);

--
-- Indices de la tabla `mesa1`
--
ALTER TABLE `mesa1`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa1_productos` (`idproducto`),
  ADD KEY `FK_mesa1_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa2`
--
ALTER TABLE `mesa2`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa2_productos` (`idproducto`),
  ADD KEY `FK_mesa2_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa3`
--
ALTER TABLE `mesa3`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa3_productos` (`idproducto`),
  ADD KEY `FK_mesa3_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa4`
--
ALTER TABLE `mesa4`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa4_productos` (`idproducto`),
  ADD KEY `FK_mesa4_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa5`
--
ALTER TABLE `mesa5`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa5_productos` (`idproducto`),
  ADD KEY `FK_mesa5_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa6`
--
ALTER TABLE `mesa6`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa6_productos` (`idproducto`),
  ADD KEY `FK_mesa6_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa7`
--
ALTER TABLE `mesa7`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa7_productos` (`idproducto`),
  ADD KEY `FK_mesa7_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa8`
--
ALTER TABLE `mesa8`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa8_productos` (`idproducto`),
  ADD KEY `FK_mesa8_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa9`
--
ALTER TABLE `mesa9`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa9_productos` (`idproducto`),
  ADD KEY `FK_mesa9_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa10`
--
ALTER TABLE `mesa10`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa10_productos` (`idproducto`),
  ADD KEY `FK_mesa10_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa11`
--
ALTER TABLE `mesa11`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa11_productos` (`idproducto`),
  ADD KEY `FK_mesa11_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa12`
--
ALTER TABLE `mesa12`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa12_productos` (`idproducto`),
  ADD KEY `FK_mesa12_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa13`
--
ALTER TABLE `mesa13`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa13_productos` (`idproducto`),
  ADD KEY `FK_mesa13_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa14`
--
ALTER TABLE `mesa14`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa14_productos` (`idproducto`),
  ADD KEY `FK_mesa14_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa15`
--
ALTER TABLE `mesa15`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa15_productos` (`idproducto`),
  ADD KEY `FK_mesa15_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa16`
--
ALTER TABLE `mesa16`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa16_productos` (`idproducto`),
  ADD KEY `FK_mesa16_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa17`
--
ALTER TABLE `mesa17`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa17_productos` (`idproducto`),
  ADD KEY `FK_mesa17_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa18`
--
ALTER TABLE `mesa18`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa18_productos` (`idproducto`),
  ADD KEY `FK_mesa18_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa19`
--
ALTER TABLE `mesa19`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa19_productos` (`idproducto`),
  ADD KEY `FK_mesa19_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa20`
--
ALTER TABLE `mesa20`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa20_productos` (`idproducto`),
  ADD KEY `FK_mesa20_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa21`
--
ALTER TABLE `mesa21`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa21_productos` (`idproducto`),
  ADD KEY `FK_mesa21_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa22`
--
ALTER TABLE `mesa22`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa22_productos` (`idproducto`),
  ADD KEY `FK_mesa22_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa23`
--
ALTER TABLE `mesa23`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa23_productos` (`idproducto`),
  ADD KEY `FK_mesa23_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa24`
--
ALTER TABLE `mesa24`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa24_productos` (`idproducto`),
  ADD KEY `FK_mesa24_usuarios` (`idusuario`);

--
-- Indices de la tabla `mesa25`
--
ALTER TABLE `mesa25`
  ADD PRIMARY KEY (`idmesa`),
  ADD KEY `FK_mesa25_productos` (`idproducto`),
  ADD KEY `FK_mesa25_usuarios` (`idusuario`);

--
-- Indices de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD PRIMARY KEY (`idpedido`),
  ADD KEY `idusuario` (`idusuario`),
  ADD KEY `idmesa` (`idmesa`);

--
-- Indices de la tabla `productos`
--
ALTER TABLE `productos`
  ADD PRIMARY KEY (`idproducto`),
  ADD KEY `FK_productos_categorias` (`idcategoria`),
  ADD KEY `FK_productos_usuarios` (`idusuario`);

--
-- Indices de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD PRIMARY KEY (`idproveedor`),
  ADD KEY `idcategoria` (`idcategoria`),
  ADD KEY `idproducto` (`idproducto`);

--
-- Indices de la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD PRIMARY KEY (`idreserva`),
  ADD KEY `idmesa` (`idmesa`);

--
-- Indices de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`idusuario`);

--
-- AUTO_INCREMENT de las tablas volcadas
--

--
-- AUTO_INCREMENT de la tabla `categorias`
--
ALTER TABLE `categorias`
  MODIFY `idcategoria` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de la tabla `detalles`
--
ALTER TABLE `detalles`
  MODIFY `iddetalle` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de la tabla `estado_mesa`
--
ALTER TABLE `estado_mesa`
  MODIFY `idestado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de la tabla `Mesa`
--
ALTER TABLE `Mesa`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de la tabla `mesa1`
--
ALTER TABLE `mesa1`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de la tabla `mesa2`
--
ALTER TABLE `mesa2`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT de la tabla `mesa3`
--
ALTER TABLE `mesa3`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de la tabla `mesa4`
--
ALTER TABLE `mesa4`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de la tabla `mesa5`
--
ALTER TABLE `mesa5`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa6`
--
ALTER TABLE `mesa6`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa7`
--
ALTER TABLE `mesa7`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `mesa8`
--
ALTER TABLE `mesa8`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa9`
--
ALTER TABLE `mesa9`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `mesa10`
--
ALTER TABLE `mesa10`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa11`
--
ALTER TABLE `mesa11`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa12`
--
ALTER TABLE `mesa12`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa13`
--
ALTER TABLE `mesa13`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa14`
--
ALTER TABLE `mesa14`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa15`
--
ALTER TABLE `mesa15`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa16`
--
ALTER TABLE `mesa16`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT de la tabla `mesa17`
--
ALTER TABLE `mesa17`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa18`
--
ALTER TABLE `mesa18`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa19`
--
ALTER TABLE `mesa19`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa20`
--
ALTER TABLE `mesa20`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa21`
--
ALTER TABLE `mesa21`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa22`
--
ALTER TABLE `mesa22`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa23`
--
ALTER TABLE `mesa23`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa24`
--
ALTER TABLE `mesa24`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `mesa25`
--
ALTER TABLE `mesa25`
  MODIFY `idmesa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `Pedido`
--
ALTER TABLE `Pedido`
  MODIFY `idpedido` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `productos`
--
ALTER TABLE `productos`
  MODIFY `idproducto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT de la tabla `proveedores`
--
ALTER TABLE `proveedores`
  MODIFY `idproveedor` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de la tabla `reservas`
--
ALTER TABLE `reservas`
  MODIFY `idreserva` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de la tabla `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `idusuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restricciones para tablas volcadas
--

--
-- Filtros para la tabla `detalles`
--
ALTER TABLE `detalles`
  ADD CONSTRAINT `FK__productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_detalles_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `detalle_pedido`
--
ALTER TABLE `detalle_pedido`
  ADD CONSTRAINT `detalle_pedido_ibfk_1` FOREIGN KEY (`idpedido`) REFERENCES `Pedido` (`idpedido`),
  ADD CONSTRAINT `detalle_pedido_ibfk_2` FOREIGN KEY (`idmesa`) REFERENCES `Mesa` (`idmesa`);

--
-- Filtros para la tabla `Mesa`
--
ALTER TABLE `Mesa`
  ADD CONSTRAINT `Mesa_ibfk_1` FOREIGN KEY (`estado_mesa`) REFERENCES `estado_mesa` (`idestado`);

--
-- Filtros para la tabla `mesa1`
--
ALTER TABLE `mesa1`
  ADD CONSTRAINT `FK_mesa1_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa1_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa2`
--
ALTER TABLE `mesa2`
  ADD CONSTRAINT `FK_mesa2_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa2_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa3`
--
ALTER TABLE `mesa3`
  ADD CONSTRAINT `FK_mesa3_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa3_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa4`
--
ALTER TABLE `mesa4`
  ADD CONSTRAINT `FK_mesa4_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa4_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa5`
--
ALTER TABLE `mesa5`
  ADD CONSTRAINT `FK_mesa5_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa5_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa6`
--
ALTER TABLE `mesa6`
  ADD CONSTRAINT `FK_mesa6_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa6_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa7`
--
ALTER TABLE `mesa7`
  ADD CONSTRAINT `FK_mesa7_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa7_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa8`
--
ALTER TABLE `mesa8`
  ADD CONSTRAINT `FK_mesa8_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa8_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa9`
--
ALTER TABLE `mesa9`
  ADD CONSTRAINT `FK_mesa9_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa9_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa10`
--
ALTER TABLE `mesa10`
  ADD CONSTRAINT `FK_mesa10_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa10_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa11`
--
ALTER TABLE `mesa11`
  ADD CONSTRAINT `FK_mesa11_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa11_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa12`
--
ALTER TABLE `mesa12`
  ADD CONSTRAINT `FK_mesa12_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa12_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa13`
--
ALTER TABLE `mesa13`
  ADD CONSTRAINT `FK_mesa13_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa13_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa14`
--
ALTER TABLE `mesa14`
  ADD CONSTRAINT `FK_mesa14_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa14_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa15`
--
ALTER TABLE `mesa15`
  ADD CONSTRAINT `FK_mesa15_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa15_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa16`
--
ALTER TABLE `mesa16`
  ADD CONSTRAINT `FK_mesa16_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa16_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa17`
--
ALTER TABLE `mesa17`
  ADD CONSTRAINT `FK_mesa17_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa17_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa18`
--
ALTER TABLE `mesa18`
  ADD CONSTRAINT `FK_mesa18_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa18_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa19`
--
ALTER TABLE `mesa19`
  ADD CONSTRAINT `FK_mesa19_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa19_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa20`
--
ALTER TABLE `mesa20`
  ADD CONSTRAINT `FK_mesa20_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa20_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa21`
--
ALTER TABLE `mesa21`
  ADD CONSTRAINT `FK_mesa21_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa21_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa22`
--
ALTER TABLE `mesa22`
  ADD CONSTRAINT `FK_mesa22_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa22_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa23`
--
ALTER TABLE `mesa23`
  ADD CONSTRAINT `FK_mesa23_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa23_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa24`
--
ALTER TABLE `mesa24`
  ADD CONSTRAINT `FK_mesa24_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa24_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `mesa25`
--
ALTER TABLE `mesa25`
  ADD CONSTRAINT `FK_mesa25_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_mesa25_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `Pedido`
--
ALTER TABLE `Pedido`
  ADD CONSTRAINT `Pedido_ibfk_1` FOREIGN KEY (`idusuario`) REFERENCES `productos` (`idproducto`),
  ADD CONSTRAINT `Pedido_ibfk_2` FOREIGN KEY (`idmesa`) REFERENCES `Mesa` (`idmesa`);

--
-- Filtros para la tabla `productos`
--
ALTER TABLE `productos`
  ADD CONSTRAINT `FK_productos_categorias` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_productos_usuarios` FOREIGN KEY (`idusuario`) REFERENCES `usuarios` (`idusuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `proveedores`
--
ALTER TABLE `proveedores`
  ADD CONSTRAINT `FK_proveedores_categorias` FOREIGN KEY (`idcategoria`) REFERENCES `categorias` (`idcategoria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_proveedores_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`idproducto`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Filtros para la tabla `reservas`
--
ALTER TABLE `reservas`
  ADD CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`idmesa`) REFERENCES `Mesa` (`idmesa`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

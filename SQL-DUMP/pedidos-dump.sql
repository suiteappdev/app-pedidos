-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.5.27 - MySQL Community Server (GPL)
-- Server OS:                    Win32
-- HeidiSQL version:             7.0.0.4053
-- Date/time:                    2015-01-27 12:47:21
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET FOREIGN_KEY_CHECKS=0 */;

-- Dumping database structure for suiteapp_johnvery
CREATE DATABASE IF NOT EXISTS `suiteapp_johnvery` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `suiteapp_johnvery`;


-- Dumping structure for table suiteapp_johnvery.ciudad
CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_ciudad_departamento` (`iddepartamento`),
  CONSTRAINT `FK_ciudad_departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.ciudad: ~3 rows (approximately)
/*!40000 ALTER TABLE `ciudad` DISABLE KEYS */;
INSERT INTO `ciudad` (`id`, `iddepartamento`, `descripcion`) VALUES
	(1, 1, 'SINCELEJO'),
	(2, 1, 'COROZAL'),
	(3, 2, 'BARRANQUILLA');
/*!40000 ALTER TABLE `ciudad` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(255) NOT NULL,
  `clave` varchar(255) NOT NULL,
  `identificacion` bigint(50) unsigned NOT NULL,
  `tipoidentificacion` int(11) NOT NULL,
  `nombres` varchar(100) DEFAULT NULL,
  `apellidos` varchar(100) DEFAULT NULL,
  `descuento1` int(10) NOT NULL,
  `descuento2` int(10) NOT NULL,
  `descuento3` int(10) NOT NULL,
  `direccion` varchar(100) NOT NULL,
  `telefono1` varchar(20) NOT NULL,
  `telefono2` varchar(20) NOT NULL,
  `telefono3` varchar(20) NOT NULL,
  `departamento` int(11) NOT NULL,
  `ciudad` int(100) NOT NULL,
  `tipocliente` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `estado` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_clientes_tipocliente` (`tipocliente`),
  KEY `FK_clientes_ciudad` (`ciudad`),
  KEY `FK_clientes_departamento` (`departamento`),
  KEY `tipoidentificacion` (`tipoidentificacion`),
  KEY `FK_clientes_estadosclientes` (`estado`),
  KEY `identificacion` (`identificacion`),
  KEY `descuento1` (`descuento1`),
  KEY `descuento2` (`descuento2`),
  KEY `descuento3` (`descuento3`),
  CONSTRAINT `FK_clientes_ciudad` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clientes_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clientes_estadosclientes` FOREIGN KEY (`estado`) REFERENCES `estadosclientes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clientes_tipocliente` FOREIGN KEY (`tipocliente`) REFERENCES `tipocliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.clientes: ~3 rows (approximately)
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` (`id`, `usuario`, `clave`, `identificacion`, `tipoidentificacion`, `nombres`, `apellidos`, `descuento1`, `descuento2`, `descuento3`, `direccion`, `telefono1`, `telefono2`, `telefono3`, `departamento`, `ciudad`, `tipocliente`, `email`, `estado`) VALUES
	(2, 'andrew', '123456', 123456789012345, 1, 'ANDREW ALEXANDER', 'CASTRO VITAL', 0, 0, 0, 'COROZAL', '1', '1', '1', 1, 1, 1, 'DAMAGEDECREASE@HOTMAIL.COM', 1),
	(8, '', '', 1103098183, 1, 'MAURICIO JOSE', 'CASTRO VITAL', 5, 0, 0, 'KRA 26A # 35 - 56', '30052895122', '3107349075', '', 1, 2, 2, 'MAJOCA10@HOTMAIL.COM', 1),
	(9, 'evelya', '123456', 1003504001, 1, 'EVELYA MARGARITA', 'GOMEZ DIAZ', 0, 0, 0, 'pioneros', '3126059560', '', '', 1, 1, 3, 'evelygomez@hotmail.com', 1);
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.clienteslineasdeprecios
CREATE TABLE IF NOT EXISTS `clienteslineasdeprecios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(50) unsigned NOT NULL DEFAULT '0',
  `lineadeprecios` int(11) NOT NULL DEFAULT '0',
  `zona` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_clienteslineasdeprecios_lineasdeprecio` (`lineadeprecios`),
  KEY `FK_clienteslineasdeprecios_zonas` (`zona`),
  KEY `FK_clienteslineasdeprecios_clientes` (`identificacion`),
  CONSTRAINT `FK_clienteslineasdeprecios_clientes` FOREIGN KEY (`identificacion`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clienteslineasdeprecios_lineasdeprecio` FOREIGN KEY (`lineadeprecios`) REFERENCES `lineasdeprecio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clienteslineasdeprecios_zonas` FOREIGN KEY (`zona`) REFERENCES `zonas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.clienteslineasdeprecios: ~1 rows (approximately)
/*!40000 ALTER TABLE `clienteslineasdeprecios` DISABLE KEYS */;
INSERT INTO `clienteslineasdeprecios` (`id`, `identificacion`, `lineadeprecios`, `zona`) VALUES
	(1, 1003504001, 1, 1);
/*!40000 ALTER TABLE `clienteslineasdeprecios` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.departamento
CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpais` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_departamento_pais` (`idpais`),
  CONSTRAINT `FK_departamento_pais` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.departamento: ~3 rows (approximately)
/*!40000 ALTER TABLE `departamento` DISABLE KEYS */;
INSERT INTO `departamento` (`id`, `idpais`, `descripcion`) VALUES
	(1, 1, 'SUCRE'),
	(2, 1, 'ATLANTICO'),
	(3, 1, 'cordoba');
/*!40000 ALTER TABLE `departamento` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.estadocategoria
CREATE TABLE IF NOT EXISTS `estadocategoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.estadocategoria: ~2 rows (approximately)
/*!40000 ALTER TABLE `estadocategoria` DISABLE KEYS */;
INSERT INTO `estadocategoria` (`id`, `descripcion`) VALUES
	(1, 'ACTIVO'),
	(2, 'INACTIVOS');
/*!40000 ALTER TABLE `estadocategoria` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.estadoproductos
CREATE TABLE IF NOT EXISTS `estadoproductos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT 'desactivado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.estadoproductos: ~2 rows (approximately)
/*!40000 ALTER TABLE `estadoproductos` DISABLE KEYS */;
INSERT INTO `estadoproductos` (`id`, `descripcion`) VALUES
	(1, 'activo'),
	(2, 'inactivo');
/*!40000 ALTER TABLE `estadoproductos` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.estadosclientes
CREATE TABLE IF NOT EXISTS `estadosclientes` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.estadosclientes: ~2 rows (approximately)
/*!40000 ALTER TABLE `estadosclientes` DISABLE KEYS */;
INSERT INTO `estadosclientes` (`id`, `descripcion`) VALUES
	(1, 'ACTIVO'),
	(2, 'INACTIVO');
/*!40000 ALTER TABLE `estadosclientes` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.estadospedidos
CREATE TABLE IF NOT EXISTS `estadospedidos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.estadospedidos: ~3 rows (approximately)
/*!40000 ALTER TABLE `estadospedidos` DISABLE KEYS */;
INSERT INTO `estadospedidos` (`id`, `descripcion`) VALUES
	(1, 'Activo'),
	(2, 'Inactivo'),
	(3, 'Despachado');
/*!40000 ALTER TABLE `estadospedidos` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.familia1
CREATE TABLE IF NOT EXISTS `familia1` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` tinytext NOT NULL,
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia1_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia1_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.familia1: ~4 rows (approximately)
/*!40000 ALTER TABLE `familia1` DISABLE KEYS */;
INSERT INTO `familia1` (`id`, `descripcion`, `urlimg`, `estado`) VALUES
	(1, 'sin categoria', '', 1),
	(6, 'AEIOU', 'http://suiteapp.net/johnvery/imgjhonvery/familia1-AEIOU/AEIOULINEABEBE.png', 1),
	(7, 'familia ', 'http://localhost/public/uploads/fa4bb5393504d4c6d48662a00eed86de_300.jpg', 1),
	(8, 'test 2', 'http://localhost/public/uploads/5b269c4f8a2b65740673bbd86aa9bc7d_300.jpg', 1);
/*!40000 ALTER TABLE `familia1` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.familia2
CREATE TABLE IF NOT EXISTS `familia2` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `familia` int(100) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia2_familia1` (`familia`),
  KEY `FK_familia2_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia2_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_familia2_familia1` FOREIGN KEY (`familia`) REFERENCES `familia1` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.familia2: ~2 rows (approximately)
/*!40000 ALTER TABLE `familia2` DISABLE KEYS */;
INSERT INTO `familia2` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
	(1, 1, 'sin categoria', '0', 1),
	(2, 6, 'test 2', 'http://localhost/public/uploads/a98ba54c15c78041ec553faf66e88e5d_300.jpg', 1);
/*!40000 ALTER TABLE `familia2` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.familia3
CREATE TABLE IF NOT EXISTS `familia3` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `familia` int(100) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia3_familia2` (`familia`),
  KEY `FK_familia3_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia3_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_familia3_familia2` FOREIGN KEY (`familia`) REFERENCES `familia2` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.familia3: ~1 rows (approximately)
/*!40000 ALTER TABLE `familia3` DISABLE KEYS */;
INSERT INTO `familia3` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
	(1, 1, 'sin categoria', '0', 1);
/*!40000 ALTER TABLE `familia3` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.familia4
CREATE TABLE IF NOT EXISTS `familia4` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `familia` int(100) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia4_familia3` (`familia`),
  KEY `FK_familia4_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia4_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_familia4_familia3` FOREIGN KEY (`familia`) REFERENCES `familia3` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.familia4: ~1 rows (approximately)
/*!40000 ALTER TABLE `familia4` DISABLE KEYS */;
INSERT INTO `familia4` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
	(1, 1, 'sin categoria', '0', 1);
/*!40000 ALTER TABLE `familia4` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.familia5
CREATE TABLE IF NOT EXISTS `familia5` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `familia` int(100) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia5_familia4` (`familia`),
  KEY `FK_familia5_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia5_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_familia5_familia4` FOREIGN KEY (`familia`) REFERENCES `familia4` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.familia5: ~1 rows (approximately)
/*!40000 ALTER TABLE `familia5` DISABLE KEYS */;
INSERT INTO `familia5` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
	(1, 1, 'sin categoria', '0', 1);
/*!40000 ALTER TABLE `familia5` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.impuesto
CREATE TABLE IF NOT EXISTS `impuesto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.impuesto: ~3 rows (approximately)
/*!40000 ALTER TABLE `impuesto` DISABLE KEYS */;
INSERT INTO `impuesto` (`id`, `descripcion`) VALUES
	(1, 0),
	(2, 5),
	(3, 16);
/*!40000 ALTER TABLE `impuesto` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.lineasdeprecio
CREATE TABLE IF NOT EXISTS `lineasdeprecio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.lineasdeprecio: ~2 rows (approximately)
/*!40000 ALTER TABLE `lineasdeprecio` DISABLE KEYS */;
INSERT INTO `lineasdeprecio` (`id`, `descripcion`) VALUES
	(1, 'lista sucre'),
	(2, 'lista cordoba');
/*!40000 ALTER TABLE `lineasdeprecio` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.noticias
CREATE TABLE IF NOT EXISTS `noticias` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL DEFAULT '0',
  `contenido` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `fechapublicacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.noticias: ~0 rows (approximately)
/*!40000 ALTER TABLE `noticias` DISABLE KEYS */;
/*!40000 ALTER TABLE `noticias` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.pais
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.pais: ~1 rows (approximately)
/*!40000 ALTER TABLE `pais` DISABLE KEYS */;
INSERT INTO `pais` (`id`, `descripcion`) VALUES
	(1, 'COLOMBIA');
/*!40000 ALTER TABLE `pais` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.pedidodetalle
CREATE TABLE IF NOT EXISTS `pedidodetalle` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpedido` int(11) NOT NULL DEFAULT '0',
  `idpro` int(11) NOT NULL DEFAULT '0',
  `referencia` int(10) NOT NULL,
  `cantidad` int(11) NOT NULL DEFAULT '0',
  `precioventa` int(11) NOT NULL,
  `iva` int(10) NOT NULL,
  `descuento1` int(10) NOT NULL,
  `descuento2` int(10) NOT NULL,
  `descuento3` int(10) NOT NULL,
  `descripcion` varchar(50) NOT NULL,
  `subtotal` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idpedido` (`idpedido`),
  KEY `FK_pedidodetalle_productos` (`idpro`),
  CONSTRAINT `FK_pedidodetalle_pedidos` FOREIGN KEY (`idpedido`) REFERENCES `pedidos` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidodetalle_productos` FOREIGN KEY (`idpro`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.pedidodetalle: ~0 rows (approximately)
/*!40000 ALTER TABLE `pedidodetalle` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidodetalle` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.pedidos
CREATE TABLE IF NOT EXISTS `pedidos` (
  `idpedido` int(10) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(50) unsigned DEFAULT '0',
  `subtotal` int(10) DEFAULT '0',
  `dto1` int(10) NOT NULL DEFAULT '0',
  `vdcto1` int(10) NOT NULL DEFAULT '0',
  `dto2` int(10) NOT NULL DEFAULT '0',
  `vdcto2` int(10) NOT NULL DEFAULT '0',
  `dto3` int(10) NOT NULL DEFAULT '0',
  `vdcto3` int(10) NOT NULL DEFAULT '0',
  `totaldescuento` int(10) DEFAULT '0',
  `iva` int(10) DEFAULT '0',
  `total` int(10) DEFAULT '0',
  `tmuestra` int(10) DEFAULT '0',
  `tunidades` int(10) DEFAULT '0',
  `observacion` varchar(1000) DEFAULT 'sin observación',
  `fechapedido` datetime DEFAULT NULL,
  `fechafinal` datetime DEFAULT NULL,
  `idvendedor` bigint(50) unsigned DEFAULT NULL,
  `estado` int(10) DEFAULT '0',
  `geolocalizacion` varchar(255) NOT NULL DEFAULT 'sin ubicación',
  `iva1` int(10) DEFAULT NULL,
  `valriva1` int(10) DEFAULT NULL,
  `baseimp1` int(10) DEFAULT '0',
  `iva2` int(10) DEFAULT NULL,
  `valriva2` int(10) DEFAULT NULL,
  `iva3` int(10) DEFAULT NULL,
  `baseimp2` int(10) DEFAULT '0',
  `valriva3` int(10) DEFAULT NULL,
  `baseimp3` int(10) DEFAULT '0',
  PRIMARY KEY (`idpedido`),
  KEY `estado` (`estado`),
  KEY `FK_pedidos_clientes` (`identificacion`),
  KEY `FK_pedidos_clientes_2` (`idvendedor`),
  KEY `FK_pedidos_clientes_3` (`dto1`),
  KEY `FK_pedidos_clientes_4` (`dto2`),
  KEY `FK_pedidos_clientes_5` (`dto3`),
  CONSTRAINT `FK_pedidos_clientes` FOREIGN KEY (`identificacion`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidos_clientes_2` FOREIGN KEY (`idvendedor`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidos_clientes_3` FOREIGN KEY (`dto1`) REFERENCES `clientes` (`descuento1`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidos_clientes_4` FOREIGN KEY (`dto2`) REFERENCES `clientes` (`descuento2`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidos_clientes_5` FOREIGN KEY (`dto3`) REFERENCES `clientes` (`descuento3`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidos_estados` FOREIGN KEY (`estado`) REFERENCES `estadospedidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.pedidos: ~0 rows (approximately)
/*!40000 ALTER TABLE `pedidos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pedidos` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.preciosalternos
CREATE TABLE IF NOT EXISTS `preciosalternos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpro` int(11) NOT NULL DEFAULT '0',
  `lineadeprecio` int(11) NOT NULL DEFAULT '0',
  `precioneto` int(11) NOT NULL DEFAULT '0',
  `descuento1` int(10) NOT NULL DEFAULT '0',
  `descuento2` int(10) NOT NULL DEFAULT '0',
  `descuento3` int(10) NOT NULL DEFAULT '0',
  `subtotal` int(10) NOT NULL DEFAULT '0',
  `iva` int(11) NOT NULL DEFAULT '1',
  `utilidad` int(11) NOT NULL DEFAULT '0',
  `totalutilidad` int(11) NOT NULL DEFAULT '0',
  `precioventa` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_preciosalternos_referenciasalterna` (`idpro`),
  KEY `FK_preciosalternos_lineasdeprecio` (`lineadeprecio`),
  KEY `FK_preciosalternos_impuesto` (`iva`),
  CONSTRAINT `FK_preciosalternos_impuesto` FOREIGN KEY (`iva`) REFERENCES `impuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_preciosalternos_lineasdeprecio` FOREIGN KEY (`lineadeprecio`) REFERENCES `lineasdeprecio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_preciosalternos_productos` FOREIGN KEY (`idpro`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.preciosalternos: ~10 rows (approximately)
/*!40000 ALTER TABLE `preciosalternos` DISABLE KEYS */;
INSERT INTO `preciosalternos` (`id`, `idpro`, `lineadeprecio`, `precioneto`, `descuento1`, `descuento2`, `descuento3`, `subtotal`, `iva`, `utilidad`, `totalutilidad`, `precioventa`) VALUES
	(1, 12, 1, 10000, 10, 10, 10, 7655, 2, 30, 2187, 7655),
	(2, 12, 2, 20000, 10, 10, 10, 16913, 3, 30, 4379, 18975),
	(3, 14, 1, 10000, 0, 0, 0, 7655, 1, 30, 2187, 0),
	(4, 14, 2, 20000, 0, 0, 0, 16913, 1, 30, 4379, 0),
	(5, 15, 1, 10000, 10, 10, 10, 7655, 2, 10, 729, 7655),
	(6, 15, 2, 20000, 10, 10, 10, 16913, 3, 10, 1460, 16056),
	(7, 16, 1, 10000, 20, 20, 20, 5376, 2, 20, 1025, 6150),
	(8, 16, 2, 20000, 10, 10, 10, 15309, 2, 30, 4376, 18961),
	(9, 17, 1, 10000, 10, 10, 10, 7655, 2, 10, 730, 8025),
	(10, 17, 2, 20000, 10, 10, 10, 15309, 2, 10, 1459, 16044);
/*!40000 ALTER TABLE `preciosalternos` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.productos
CREATE TABLE IF NOT EXISTS `productos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `embalaje` int(11) NOT NULL DEFAULT '0',
  `familia1` int(100) NOT NULL DEFAULT '1',
  `familia2` int(100) NOT NULL DEFAULT '1',
  `familia3` int(100) NOT NULL DEFAULT '1',
  `familia4` int(100) NOT NULL DEFAULT '1',
  `familia5` int(100) NOT NULL DEFAULT '1',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `estado` int(10) NOT NULL DEFAULT '2',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.productos: ~9 rows (approximately)
/*!40000 ALTER TABLE `productos` DISABLE KEYS */;
INSERT INTO `productos` (`id`, `descripcion`, `embalaje`, `familia1`, `familia2`, `familia3`, `familia4`, `familia5`, `urlimg`, `estado`) VALUES
	(9, '', 0, 0, 0, 0, 0, 0, '0', 0),
	(10, '', 0, 0, 0, 0, 0, 0, '0', 0),
	(11, '', 0, 0, 0, 0, 0, 0, '0', 0),
	(12, 'ajajajajaj tes', 23, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/118e36ab4a68b41987e5e7880a9754f9_226.jpg', 1),
	(13, 'ajajajajaj test 3', 23, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/e022d941f6a318b725291b654403f763_226.jpg', 1),
	(14, 'ajajajajaj test 3', 23, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/cec3ec574fcca2452fd4e7376f8e0bd7_226.jpg', 1),
	(15, 'fsdfdsffdf', 34, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/48225a688a3c24fbb6d965e671384f88_226.jpg', 1),
	(16, 'testte 23', 34, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/bb7faf81362bb8d7bc778f36d63cfbd5_226.jpg', 1),
	(17, 'testets 23', 23, 1, 1, 1, 1, 1, 'http://localhost/public/uploads/cfd58e64b7924e5fba4977be2789e999_226.jpg', 1);
/*!40000 ALTER TABLE `productos` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.referenciasalterna
CREATE TABLE IF NOT EXISTS `referenciasalterna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idproducto` int(10) DEFAULT '0',
  `referencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referencia` (`referencia`),
  KEY `FK__productos` (`idproducto`),
  CONSTRAINT `FK_referenciasalterna_productos` FOREIGN KEY (`idproducto`) REFERENCES `productos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.referenciasalterna: ~20 rows (approximately)
/*!40000 ALTER TABLE `referenciasalterna` DISABLE KEYS */;
INSERT INTO `referenciasalterna` (`id`, `idproducto`, `referencia`) VALUES
	(1, 12, '23456'),
	(2, 12, '6456234'),
	(3, 12, '2313156987567'),
	(4, 12, '243243'),
	(6, 14, '234563344'),
	(7, 14, '64562345445'),
	(8, 14, '23569875675655'),
	(9, 14, '2432435656'),
	(10, 15, '232445687'),
	(11, 15, '786545334242'),
	(12, 15, '4567523436'),
	(13, 15, '89875654645'),
	(14, 16, '234890'),
	(15, 16, '000854433'),
	(16, 16, '9909090'),
	(17, 16, '76540000'),
	(18, 17, '21234234456'),
	(19, 17, '756356537'),
	(20, 17, '1415455435'),
	(21, 17, '354566742');
/*!40000 ALTER TABLE `referenciasalterna` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.tipocliente
CREATE TABLE IF NOT EXISTS `tipocliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.tipocliente: ~4 rows (approximately)
/*!40000 ALTER TABLE `tipocliente` DISABLE KEYS */;
INSERT INTO `tipocliente` (`id`, `descripcion`) VALUES
	(1, 'ADMINISTRADOR'),
	(2, 'CLIENTE'),
	(3, 'VENDEDOR'),
	(4, 'SUPERVISOR');
/*!40000 ALTER TABLE `tipocliente` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.tipoidentificacion
CREATE TABLE IF NOT EXISTS `tipoidentificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.tipoidentificacion: ~1 rows (approximately)
/*!40000 ALTER TABLE `tipoidentificacion` DISABLE KEYS */;
INSERT INTO `tipoidentificacion` (`id`, `descripcion`) VALUES
	(1, 'CEDULA');
/*!40000 ALTER TABLE `tipoidentificacion` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` int(11) DEFAULT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `estado` bit(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.users: 1 rows
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `identificacion`, `username`, `password`, `estado`) VALUES
	(1, 123456, 'andrew', '123456', b'00000000');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.zonas
CREATE TABLE IF NOT EXISTS `zonas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.zonas: ~2 rows (approximately)
/*!40000 ALTER TABLE `zonas` DISABLE KEYS */;
INSERT INTO `zonas` (`id`, `descripcion`) VALUES
	(1, 'Zona Sucre'),
	(2, 'zona cordoba');
/*!40000 ALTER TABLE `zonas` ENABLE KEYS */;


-- Dumping structure for table suiteapp_johnvery.zonasalternas
CREATE TABLE IF NOT EXISTS `zonasalternas` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idzona` int(10) NOT NULL DEFAULT '0',
  `iddepartamento` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__zonas` (`idzona`),
  KEY `FK__departamento` (`iddepartamento`),
  CONSTRAINT `FK__departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__zonas` FOREIGN KEY (`idzona`) REFERENCES `zonas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

-- Dumping data for table suiteapp_johnvery.zonasalternas: ~2 rows (approximately)
/*!40000 ALTER TABLE `zonasalternas` DISABLE KEYS */;
INSERT INTO `zonasalternas` (`id`, `idzona`, `iddepartamento`) VALUES
	(1, 1, 1),
	(2, 2, 3);
/*!40000 ALTER TABLE `zonasalternas` ENABLE KEYS */;
/*!40014 SET FOREIGN_KEY_CHECKS=1 */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

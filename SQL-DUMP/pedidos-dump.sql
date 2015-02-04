CREATE DATABASE IF NOT EXISTS `suiteapp_ecomm`
USE `suiteapp_ecomm`;


CREATE TABLE IF NOT EXISTS `ciudad` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iddepartamento` int(11) NOT NULL DEFAULT '0',
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_ciudad_departamento` (`iddepartamento`),
  CONSTRAINT `FK_ciudad_departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `cliente` (
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
  KEY `FK_cliente_tipocliente` (`tipocliente`),
  KEY `FK_cliente_ciudad` (`ciudad`),
  KEY `FK_cliente_departamento` (`departamento`),
  KEY `tipoidentificacion` (`tipoidentificacion`),
  KEY `FK_cliente_estadocliente` (`estado`),
  KEY `identificacion` (`identificacion`),
  KEY `descuento1` (`descuento1`),
  KEY `descuento2` (`descuento2`),
  KEY `descuento3` (`descuento3`),
  CONSTRAINT `FK_cliente_ciudad` FOREIGN KEY (`ciudad`) REFERENCES `ciudad` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cliente_departamento` FOREIGN KEY (`departamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cliente_estadocliente` FOREIGN KEY (`estado`) REFERENCES `estadocliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_cliente_tipocliente` FOREIGN KEY (`tipocliente`) REFERENCES `tipocliente` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;


INSERT INTO `cliente` (`id`, `usuario`, `clave`, `identificacion`, `tipoidentificacion`, `nombres`, `apellidos`, `descuento1`, `descuento2`, `descuento3`, `direccion`, `telefono1`, `telefono2`, `telefono3`, `departamento`, `ciudad`, `tipocliente`, `email`, `estado`) VALUES
  (2, 'administrador', '123456', 123456789012345, 1, 'administrador', 'ecommerce', 0, 0, 0, 'COROZAL', '1', '1', '1', 1, 1, 1, 'administrador@HOTMAIL.COM', 1),
  (8, '', '', 1103098183, 1, 'cliente', 'ecommerce', 5, 0, 0, 'KRA 26A # 35 - 56', '30052895122', '3107349075', '', 1, 2, 2, 'cliente@HOTMAIL.COM', 1),
  (9, 'vendedor', '123456', 1003504001, 1, 'vendedor', 'ecommerce', 0, 0, 0, 'pioneros', '3126059560', '', '', 1, 1, 3, 'evelygomez@hotmail.com', 1);


CREATE TABLE IF NOT EXISTS `clientelineadeprecio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `identificacion` bigint(50) unsigned NOT NULL DEFAULT '0',
  `lineadeprecios` int(11) NOT NULL DEFAULT '0',
  `zona` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK_clientelineadeprecio_lineadeprecio` (`lineadeprecios`),
  KEY `FK_clientelinesdeprecio_zonas` (`zona`),
  KEY `FK_clientelineadeprecio_cliente` (`identificacion`),
  CONSTRAINT `FK_clientelineadeprecio_cliente` FOREIGN KEY (`identificacion`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clientelineadeprecio_lineadeprecio` FOREIGN KEY (`lineadeprecios`) REFERENCES `lineasdeprecio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_clientelineadeprecio_zona` FOREIGN KEY (`zona`) REFERENCES `zonas` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `clientelineadeprecio` (`id`, `identificacion`, `lineadeprecios`, `zona`) VALUES
  (1, 1003504001, 1, 1);


CREATE TABLE IF NOT EXISTS `departamento` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idpais` int(11) NOT NULL,
  `descripcion` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_departamento_pais` (`idpais`),
  CONSTRAINT `FK_departamento_pais` FOREIGN KEY (`idpais`) REFERENCES `pais` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `departamento` (`id`, `idpais`, `descripcion`) VALUES
  (1, 1, 'SUCRE'),
  (2, 1, 'ATLANTICO'),
  (3, 1, 'CORODOBA');


CREATE TABLE IF NOT EXISTS `estadocategoria` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `estadocategoria` (`id`, `descripcion`) VALUES
  (1, 'ACTIVO'),
  (2, 'INACTIVOS');


CREATE TABLE IF NOT EXISTS `estadoproducto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(255) DEFAULT 'desactivado',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `estadoproducto` (`id`, `descripcion`) VALUES
  (1, 'ACTIVO'),
  (2, 'INACTIVO');


CREATE TABLE IF NOT EXISTS `estadocliente` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `estadocliente` (`id`, `descripcion`) VALUES
  (1, 'ACTIVO'),
  (2, 'INACTIVO');


CREATE TABLE IF NOT EXISTS `estadopedido` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `estadopedido` (`id`, `descripcion`) VALUES
  (1, 'ACTIVO'),
  (2, 'INACTIVO'),
  (3, 'DESPACHADO');


CREATE TABLE IF NOT EXISTS `familia1` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` tinytext NOT NULL,
  `estado` int(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_familia1_estadocategoria` (`estado`),
  CONSTRAINT `FK_familia1_estadocategoria` FOREIGN KEY (`estado`) REFERENCES `estadocategoria` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;


INSERT INTO `familia1` (`id`, `descripcion`, `urlimg`, `estado`) VALUES
  (1, 'sin categoria', '', 1);


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


INSERT INTO `familia2` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
  (1, 1, 'sin categoria', '0', 1);


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


INSERT INTO `familia3` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
  (1, 1, 'sin categoria', '0', 1);


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


INSERT INTO `familia4` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
  (1, 1, 'sin categoria', '0', 1);


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


INSERT INTO `familia5` (`id`, `familia`, `descripcion`, `urlimg`, `estado`) VALUES
  (1, 1, 'sin categoria', '0', 1);


CREATE TABLE IF NOT EXISTS `impuesto` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `descripcion` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;


INSERT INTO `impuesto` (`id`, `descripcion`) VALUES
  (1, 0),
  (2, 5),
  (3, 16);


CREATE TABLE IF NOT EXISTS `lineadeprecio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `lineadeprecio` (`id`, `descripcion`) VALUES
  (1, 'LINEA DE PRECIO 1'),
  (2, 'LINEA DE PRECIO 2');


CREATE TABLE IF NOT EXISTS `noticia` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(100) NOT NULL DEFAULT '0',
  `contenido` varchar(100) NOT NULL DEFAULT '0',
  `urlimg` varchar(100) NOT NULL DEFAULT '0',
  `fechapublicacion` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `estado` bit(1) NOT NULL DEFAULT b'0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(250) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `pais` (`id`, `descripcion`) VALUES
  (1, 'COLOMBIA');


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
  CONSTRAINT `FK_pedidodetalle_pedido` FOREIGN KEY (`idpedido`) REFERENCES `pedido` (`idpedido`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedidodetalle_producto` FOREIGN KEY (`idpro`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `pedido` (
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
  KEY `FK_pedido_cliente` (`identificacion`),
  KEY `FK_pedido_cliente_2` (`idvendedor`),
  KEY `FK_pedido_cliente_3` (`dto1`),
  KEY `FK_pedido_cliente_4` (`dto2`),
  KEY `FK_pedido_cliente_5` (`dto3`),
  CONSTRAINT `FK_pedido_cliente` FOREIGN KEY (`identificacion`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_cliente_2` FOREIGN KEY (`idvendedor`) REFERENCES `clientes` (`identificacion`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_cliente_3` FOREIGN KEY (`dto1`) REFERENCES `clientes` (`descuento1`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_cliente_4` FOREIGN KEY (`dto2`) REFERENCES `clientes` (`descuento2`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_cliente_5` FOREIGN KEY (`dto3`) REFERENCES `clientes` (`descuento3`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_pedido_estado` FOREIGN KEY (`estado`) REFERENCES `estadospedidos` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


CREATE TABLE IF NOT EXISTS `precioalterno` (
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
  KEY `FK_precioalterno_referenciaalterna` (`idpro`),
  KEY `FK_precioalterno_lineadeprecio` (`lineadeprecio`),
  KEY `FK_precioalterno_impuesto` (`iva`),
  CONSTRAINT `FK_precioalterno_impuesto` FOREIGN KEY (`iva`) REFERENCES `impuesto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_precioalterno_lineadeprecio` FOREIGN KEY (`lineadeprecio`) REFERENCES `lineadeprecio` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK_precioalterno_producto` FOREIGN KEY (`idpro`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `producto` (
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



CREATE TABLE IF NOT EXISTS `referenciaalterna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idproducto` int(10) DEFAULT '0',
  `referencia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `referencia` (`referencia`),
  KEY `FK__productos` (`idproducto`),
  CONSTRAINT `FK_referenciaalterna_producto` FOREIGN KEY (`idproducto`) REFERENCES `producto` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=latin1;



CREATE TABLE IF NOT EXISTS `tipocliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;


INSERT INTO `tipocliente` (`id`, `descripcion`) VALUES
  (1, 'ADMINISTRADOR'),
  (2, 'CLIENTE'),
  (3, 'VENDEDOR'),
  (4, 'SUPERVISOR');


CREATE TABLE IF NOT EXISTS `tipoidentificacion` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `tipoidentificacion` (`id`, `descripcion`) VALUES
  (1, 'CEDULA');


CREATE TABLE IF NOT EXISTS `zona` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descripcion` varchar(100) DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `zona` (`id`, `descripcion`) VALUES
  (1, 'Zona Sucre'),
  (2, 'zona cordoba');

CREATE TABLE IF NOT EXISTS `zonaalterna` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idzona` int(10) NOT NULL DEFAULT '0',
  `iddepartamento` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `FK__zonas` (`idzona`),
  KEY `FK__departamento` (`iddepartamento`),
  CONSTRAINT `FK__departamento` FOREIGN KEY (`iddepartamento`) REFERENCES `departamento` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `FK__zona` FOREIGN KEY (`idzona`) REFERENCES `zona` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;


INSERT INTO `zonaalterna` (`id`, `idzona`, `iddepartamento`) VALUES
  (1, 1, 1),
  (2, 2, 3);


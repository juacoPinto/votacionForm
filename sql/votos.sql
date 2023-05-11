CREATE TABLE `votos` (
  `rut` varchar(64) NOT NULL,
  `nombre` varchar(64) NOT NULL,
  `alias` varchar(64) NOT NULL,
  `email` varchar(64) NOT NULL,
  `region` varchar(64) NOT NULL,
  `comuna` varchar(64) NOT NULL,
  `candidato` varchar(64) NOT NULL,
  `contacto` varchar(64) NOT NULL,
  PRIMARY KEY (`rut`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
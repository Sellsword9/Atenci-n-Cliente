-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.28-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.5.0.6677
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para examenticket
CREATE DATABASE IF NOT EXISTS `examenticket` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `examenticket`;

-- Volcando estructura para tabla examenticket.respuestas
CREATE TABLE IF NOT EXISTS `respuestas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) DEFAULT NULL,
  `texto` text DEFAULT NULL,
  `id_autor` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla examenticket.respuestas: ~8 rows (aproximadamente)
DELETE FROM `respuestas`;
INSERT INTO `respuestas` (`id`, `id_ticket`, `texto`, `id_autor`) VALUES
	(2, 12, 'Pacogarcia comentó: No, no se puede', 2),
	(4, 12, 'Pues que mal no?', 1),
	(6, 12, 'Pacogarcia comentó: There is nothing we can do...', 2),
	(7, 12, 'ok', 1),
	(8, 13, 'Pacogarcia comentó: Somos panaderos bro', 2),
	(9, 13, 'Pacogarcia comentó: No vuelvas por aqui', 2),
	(10, 16, 'Pacogarcia comentó: lo hemos arreglado ya', 2),
	(11, 16, 'Estupendo grarcias', 6);

-- Volcando estructura para tabla examenticket.ticket
CREATE TABLE IF NOT EXISTS `ticket` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `texto` text DEFAULT NULL,
  `nombre` varchar(255) DEFAULT NULL,
  `id_cliente` varchar(255) DEFAULT NULL,
  `estado` smallint(5) unsigned DEFAULT 0,
  `id_trabajador` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla examenticket.ticket: ~5 rows (aproximadamente)
DELETE FROM `ticket`;
INSERT INTO `ticket` (`id`, `texto`, `nombre`, `id_cliente`, `estado`, `id_trabajador`) VALUES
	(12, 'Es posible poner modo oscuro?', 'Me molesta la gui', '1', 3, 2),
	(13, 'Que grave es eso!!', 'Chatgpt se ha caido', '1', 3, 2),
	(14, 'Buenos dias a todos\r\nmenos a pacogarcia', 'Hola buen dia', '6', 0, NULL),
	(15, 'asdasd', 'asdsad', '6', 0, NULL),
	(16, 'se ha caido el servidor', 'No funciona fortnite', '6', 1, 2);

-- Volcando estructura para tabla examenticket.usuarios
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(255) DEFAULT NULL,
  `rol` int(11) DEFAULT NULL,
  `contraseña` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla examenticket.usuarios: ~6 rows (aproximadamente)
DELETE FROM `usuarios`;
INSERT INTO `usuarios` (`id`, `nombre`, `rol`, `contraseña`) VALUES
	(1, 'Sellsword9', -1, 'hola'),
	(2, 'Pacogarcia', 2, 'cls'),
	(4, 'root', -1, 'toor'),
	(5, 'yeray', 1, 'yeray'),
	(6, 'pepe', 0, 'pepe'),
	(7, 'paco2', 1, 'paco2');

-- Volcando estructura para tabla examenticket.valoraciones
CREATE TABLE IF NOT EXISTS `valoraciones` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_ticket` int(11) DEFAULT NULL,
  `valoracion` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla examenticket.valoraciones: ~2 rows (aproximadamente)
DELETE FROM `valoraciones`;
INSERT INTO `valoraciones` (`id`, `id_ticket`, `valoracion`) VALUES
	(1, 12, 3),
	(2, 13, 5);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;

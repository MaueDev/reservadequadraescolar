-- --------------------------------------------------------
-- Servidor:                     localhost
-- Versão do servidor:           10.4.13-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.1.0.6116
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para reservaquadra
CREATE DATABASE IF NOT EXISTS `reservaquadra` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `reservaquadra`;

-- Copiando estrutura para tabela reservaquadra.cad_usuario
CREATE TABLE IF NOT EXISTS `cad_usuario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela reservaquadra.cad_usuario: ~0 rows (aproximadamente)
DELETE FROM `cad_usuario`;
/*!40000 ALTER TABLE `cad_usuario` DISABLE KEYS */;
INSERT INTO `cad_usuario` (`id`, `usuario`, `senha`) VALUES
	(1, 'adm', '1e48c4420b7073bc11916c6c1de226bb');
/*!40000 ALTER TABLE `cad_usuario` ENABLE KEYS */;

-- Copiando estrutura para tabela reservaquadra.mv_reserva
CREATE TABLE IF NOT EXISTS `mv_reserva` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` date DEFAULT NULL,
  `hora` time DEFAULT NULL,
  `modalidade` varchar(50) DEFAULT NULL,
  `responsavel` varchar(50) DEFAULT NULL,
  `solicitação` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela reservaquadra.mv_reserva: ~0 rows (aproximadamente)
DELETE FROM `mv_reserva`;
/*!40000 ALTER TABLE `mv_reserva` DISABLE KEYS */;
/*!40000 ALTER TABLE `mv_reserva` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

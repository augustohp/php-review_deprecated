-- MySQL Administrator dump 1.4
--
-- ------------------------------------------------------
-- Server version	5.1.37-1ubuntu5.4


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


--
-- Create schema revista
--

CREATE DATABASE IF NOT EXISTS revista;
USE revista;
CREATE TABLE  `revista`.`anuncios` (
  `id_anuncio` int(11) NOT NULL AUTO_INCREMENT,
  `id_empresa` int(11) NOT NULL,
  `url_empresa` varchar(100) NOT NULL,
  `url_imagem` varchar(45) NOT NULL,
  `nr_show` int(11) DEFAULT NULL,
  `nr_clicks` int(11) DEFAULT NULL,
  `dt_inicio` datetime NOT NULL,
  `dt_final` datetime NOT NULL,
  `in_disponivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_anuncio`),
  KEY `fk_enquete_itens` (`id_empresa`),
  CONSTRAINT `fk_anuncios_1` FOREIGN KEY (`id_empresa`) REFERENCES `empresa` (`id_empresa`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela que relaciona os anÃºncios que aparecem no site.';

CREATE TABLE  `revista`.`atividades` (
  `id_atividade` int(11) NOT NULL AUTO_INCREMENT,
  `ds_atividade` varchar(45) NOT NULL,
  `in_disponivel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_atividade`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relaciona todas as atividades possÃ­veis de um usuÃ¡rio.';

CREATE TABLE  `revista`.`atividades_usuarios` (
  `id_atividade` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `dt_relacionamento` varchar(45) NOT NULL,
  PRIMARY KEY (`id_atividade`,`id_usuario`),
  KEY `fk_Atividades_has_Usuario_Atividades1` (`id_atividade`),
  KEY `fk_Atividades_has_Usuario_Usuario1` (`id_usuario`),
  CONSTRAINT `fk_Atividades_has_Usuario_Atividades1` FOREIGN KEY (`id_atividade`) REFERENCES `atividades` (`id_atividade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Atividades_has_Usuario_Usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE  `revista`.`cargos` (
  `id_nivel_cargo` int(11) NOT NULL AUTO_INCREMENT,
  `ds_cargo` varchar(45) NOT NULL,
  `in_disponivel` varchar(45) NOT NULL,
  PRIMARY KEY (`id_nivel_cargo`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='NÃ­vel de cargo de um usuÃ¡rio na empresa que trabalha.';
INSERT INTO `revista`.`cargos` VALUES   (1,'Estagiario','1');
INSERT INTO `revista`.`cargos` VALUES   (2,'Trainee','1');
INSERT INTO `revista`.`cargos` VALUES   (3,'Tecnico','1');
INSERT INTO `revista`.`cargos` VALUES   (4,'Analista','1');
INSERT INTO `revista`.`cargos` VALUES   (5,'Coordenador','1');
INSERT INTO `revista`.`cargos` VALUES   (6,'Gerente','1');
INSERT INTO `revista`.`cargos` VALUES   (7,'Diretor','1');
INSERT INTO `revista`.`cargos` VALUES   (8,'Free-lancer','1');

CREATE TABLE  `revista`.`empresa` (
  `id_empresa` int(11) NOT NULL,
  `ds_empresa` varchar(45) DEFAULT NULL,
  `url_empresa` varchar(45) DEFAULT NULL,
  `id_responsavel` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_empresa`),
  KEY `fk_empresa_1` (`id_responsavel`),
  CONSTRAINT `fk_empresa_1` FOREIGN KEY (`id_responsavel`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tabela das empresas que anunciaram no site';

CREATE TABLE  `revista`.`enquete` (
  `id_enquete` int(11) NOT NULL,
  `ds_enquete` varchar(45) DEFAULT NULL,
  `dt_inicio` datetime DEFAULT NULL,
  `dt_final` datetime DEFAULT NULL,
  `in_ativo` tinyint(1) DEFAULT NULL,
  `id_usuario_criacao` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_enquete`),
  KEY `fk_enquete_1` (`id_usuario_criacao`),
  CONSTRAINT `fk_enquete_1` FOREIGN KEY (`id_usuario_criacao`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tebale que cadastra as enquetes disponÃ­veis.';

CREATE TABLE  `revista`.`escolaridades` (
  `id_escolaridade` int(11) NOT NULL AUTO_INCREMENT,
  `ds_escolaridade` varchar(40) NOT NULL,
  `in_disponivel` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_escolaridade`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COMMENT='Escolaridades disponÃ­veis.';

INSERT INTO `revista`.`escolaridades` VALUES   (10,'Ensino Medio Incompleto',1);
INSERT INTO `revista`.`escolaridades` VALUES   (11,'Ensino Medio',1);
INSERT INTO `revista`.`escolaridades` VALUES   (12,'Ensino Superior Incompleto',1);
INSERT INTO `revista`.`escolaridades` VALUES   (13,'Ensino Superior',1);
INSERT INTO `revista`.`escolaridades` VALUES   (14,'Ensino Superior + MBA',1);
INSERT INTO `revista`.`escolaridades` VALUES   (15,'Ensino Superior + Especializacao',1);
INSERT INTO `revista`.`escolaridades` VALUES   (16,'Mestrado',1);
INSERT INTO `revista`.`escolaridades` VALUES   (17,'Doutorado',1);
INSERT INTO `revista`.`escolaridades` VALUES   (18,'Pos-Doc (PhD)',1);

CREATE TABLE  `revista`.`faixa_salarial` (
  `id_faixa_salarial` int(11) NOT NULL AUTO_INCREMENT,
  `vl_minimo` float DEFAULT NULL,
  `vl_maximo` float NOT NULL,
  `in_disponivel` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id_faixa_salarial`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Identifica as possÃ­veis faixas salariais do usuÃ¡rio.';

INSERT INTO `revista`.`faixa_salarial` VALUES   (1,0,500,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (2,500.01,1000,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (3,1000.01,1500,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (4,1500.01,2000,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (5,2000.01,3000,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (6,3000.01,4000,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (7,4000.01,5000,1);
INSERT INTO `revista`.`faixa_salarial` VALUES   (8,5000,0,1);

CREATE TABLE  `revista`.`grupo_usuario` (
  `id_grupo` int(11) NOT NULL AUTO_INCREMENT,
  `ds_grupo` varchar(45) NOT NULL,
  `in_ativo` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_grupo`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Tipos de grupo de usuÃ¡rio.';

INSERT INTO `revista`.`grupo_usuario` VALUES   (1,'Usuario',1);

CREATE TABLE  `revista`.`itens_enquete` (
  `id_item_enquete` int(11) NOT NULL AUTO_INCREMENT,
  `id_enquete` int(11) NOT NULL,
  `ds_item_enquete` varchar(45) NOT NULL,
  `nr_votos` int(11) NOT NULL,
  PRIMARY KEY (`id_item_enquete`,`id_enquete`),
  KEY `fk_enquete_itens` (`id_enquete`),
  CONSTRAINT `fk_enquete_itens` FOREIGN KEY (`id_enquete`) REFERENCES `enquete` (`id_enquete`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='Tabela que lista todos os itens de uma enquete.';

CREATE TABLE  `revista`.`materias` (
  `id_materia` int(11) NOT NULL AUTO_INCREMENT,
  `id_publicacao` int(11) DEFAULT NULL,
  `ds_titulo` varchar(45) NOT NULL,
  `tx_materia` text NOT NULL,
  `dt_publicacao` datetime NOT NULL,
  `dt_alteracao` datetime DEFAULT NULL,
  `dt_limite` datetime DEFAULT NULL,
  `in_home` tinyint(1) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `ds_resumo` text NOT NULL,
  `url_imagem` varchar(200) NOT NULL,
  PRIMARY KEY (`id_materia`,`id_usuario`),
  KEY `fk_materias_1` (`id_usuario`),
  KEY `fk_materias_2` (`id_publicacao`),
  CONSTRAINT `fk_materias_1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON UPDATE CASCADE,
  CONSTRAINT `fk_materias_2` FOREIGN KEY (`id_publicacao`) REFERENCES `publicacoes` (`id_publicacao`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=utf8 COMMENT='Relaciona todas as matÃ©rias do site';

CREATE TABLE  `revista`.`publicacoes` (
  `id_publicacao` int(11) NOT NULL AUTO_INCREMENT,
  `ds_titulo` varchar(45) NOT NULL,
  `tx_resumo` tinytext NOT NULL,
  `nr_edicao` int(11) NOT NULL,
  `id_tp_publicacao` int(11) NOT NULL,
  `ano_publicacao` int(4) NOT NULL,
  `ds_periodo` varchar(45) NOT NULL,
  `ds_arquivo` varchar(100) NOT NULL,
  `dt_publicacao` datetime NOT NULL,
  PRIMARY KEY (`id_publicacao`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='guarda informaÃ§Ãµes principais das publicaÃ§Ãµes.';

INSERT INTO `revista`.`publicacoes` VALUES   (1,'QrCode','Uma revista sobre QRcode,',1,1,2010,'ago/set','/../revistas/ed01.pdf','2010-08-15 00:00:00');

CREATE TABLE  `revista`.`usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `nm_usuario` varchar(120) NOT NULL,
  `ds_email` varchar(50) NOT NULL,
  `sexo` enum('m','f') NOT NULL DEFAULT 'm',
  `ds_endereco` varchar(200) NOT NULL,
  `ds_complemento` varchar(50) DEFAULT NULL,
  `ds_numero` varchar(10) NOT NULL,
  `nr_cep` int(8) NOT NULL,
  `ds_bairro` varchar(45) NOT NULL,
  `ds_cidade` varchar(70) NOT NULL,
  `id_estado` int(11) NOT NULL,
  `ds_senha` varchar(100) NOT NULL DEFAULT ' ',
  `id_escolaridade` int(11) NOT NULL,
  `id_faixa_salarial` int(11) NOT NULL,
  `id_nivel_cargo` int(11) NOT NULL,
  `ds_como_conheceu` varchar(100) DEFAULT NULL,
  `dt_criacao` datetime NOT NULL,
  `dt_atualizacao` datetime NOT NULL,
  `id_grupo` int(11) NOT NULL,
  PRIMARY KEY (`id_usuario`) USING BTREE,
  KEY `fk_Usuario_1` (`id_escolaridade`),
  KEY `fk_Usuario_Faixa_Salarial1` (`id_faixa_salarial`),
  KEY `fk_usuario_2` (`id_grupo`),
  KEY `fk_Usuario_Cargos1` (`id_nivel_cargo`),
  CONSTRAINT `fk_Usuario_1` FOREIGN KEY (`id_escolaridade`) REFERENCES `escolaridades` (`id_escolaridade`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_usuario_2` FOREIGN KEY (`id_grupo`) REFERENCES `grupo_usuario` (`id_grupo`) ON UPDATE CASCADE,
  CONSTRAINT `fk_Usuario_Cargos1` FOREIGN KEY (`id_nivel_cargo`) REFERENCES `cargos` (`id_nivel_cargo`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_Faixa_Salarial1` FOREIGN KEY (`id_faixa_salarial`) REFERENCES `faixa_salarial` (`id_faixa_salarial`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COMMENT='Tabela que contÃ©m o cadastro das pessoas da revista';

CREATE TABLE  `revista`.`usuario_publicacao` (
  `id_relacionamento` int(11) NOT NULL AUTO_INCREMENT,
  `id_usuario` int(11) NOT NULL,
  `id_publicacao` int(11) NOT NULL,
  `qtde_download` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id_relacionamento`,`id_usuario`,`id_publicacao`),
  KEY `fk_Usuario_has_Publicacoes_Usuario1` (`id_usuario`),
  KEY `fk_Usuario_has_Publicacoes_Publicacoes1` (`id_publicacao`),
  CONSTRAINT `fk_Usuario_has_Publicacoes_Publicacoes1` FOREIGN KEY (`id_publicacao`) REFERENCES `publicacoes` (`id_publicacao`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_Usuario_has_Publicacoes_Usuario1` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Relaciona quais usuÃ¡rios ja realizaram download';



/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

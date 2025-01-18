-- MySQL dump 10.13  Distrib 8.0.36, for Win64 (x86_64)
--
-- Host: 127.0.0.1    Database: db_topglass
-- ------------------------------------------------------
-- Server version	5.5.5-10.4.32-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `tbl_banner`
--

DROP TABLE IF EXISTS `tbl_banner`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_banner` (
  `idBanner` int(11) NOT NULL AUTO_INCREMENT,
  `nomeBanner` varchar(30) NOT NULL,
  `caminhoBanner` varchar(50) NOT NULL,
  `altBanner` varchar(80) NOT NULL,
  `statusBanner` varchar(12) NOT NULL,
  PRIMARY KEY (`idBanner`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_banner`
--

LOCK TABLES `tbl_banner` WRITE;
/*!40000 ALTER TABLE `tbl_banner` DISABLE KEYS */;
INSERT INTO `tbl_banner` VALUES (1,'BANNER DE PARCELAS DE CARTAO','img/banners/1_bannerdeparcelasdecartao.jpg','BANNER DE PARCELAS DE CARTAO','ATIVO'),(2,'BANNER DE DESCONTO','img/banners/2_bannerdedesconto.jpg','BANNER DE DESCONTO','ATIVO');
/*!40000 ALTER TABLE `tbl_banner` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_cliente`
--

DROP TABLE IF EXISTS `tbl_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_cliente` (
  `idCliente` int(11) NOT NULL AUTO_INCREMENT,
  `nomeCliente` varchar(50) NOT NULL,
  `emailCliente` varchar(50) NOT NULL,
  `enderecoCliente` varchar(80) NOT NULL,
  `numeroCliente` varchar(15) NOT NULL,
  `cpfCliente` varchar(14) NOT NULL,
  `dataCadCliente` date DEFAULT current_timestamp(),
  `statusCliente` varchar(12) NOT NULL,
  `senhaCliente` varchar(20) NOT NULL,
  `dataNascimentoCliente` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`idCliente`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_cliente`
--

LOCK TABLES `tbl_cliente` WRITE;
/*!40000 ALTER TABLE `tbl_cliente` DISABLE KEYS */;
INSERT INTO `tbl_cliente` VALUES (1,'Josoé','josoedejesus1805@email.com','Rua Joao Paulo II,105 - Rondonia','(10)90494-8242','321.123.567-99','2024-05-10','ATIVO','2323',''),(2,'Josoé','josoedejesus1805@email.com','Rua Joao Paulo II,105 - Rondonia','(10)90494-8242','321.123.567-99','2024-05-10','INATIVO','123456',''),(3,'Hugo','teste2@email.com','Rua Teste2, 222','(10) 22222-222','222.222.222-22','2024-06-10','ATIVO','222',''),(4,'Vitor Daniel Silva Oliveira','email@email.com','Rua 17','(11)23258-5572','000.222.222-22','2024-06-29','INATIVO','28',''),(5,'Vitor Daniel Silva Oliveira','email@email.com','Rua 77','(11) 1 0000-000','000.222.222-22','2024-06-29','INATIVO','',''),(6,'Vitor ','vitor@email.com','Rua Teste','(11) 1111111','111.111.111-11','2024-07-15','ATIVO','',''),(7,'pedro teste','pedroteste@email.com','rua teste, 54','(11) 123456789','25297398043','2024-07-23','INATIVO','',''),(8,'teste teste','teste3322@email.com','rua teste, 33','(11) 222233333','32345624376','2024-07-23','INATIVO','',''),(9,'teste100','teste1000@email.com','rua teste, 1','(11)11111-1111','111.111.111-11','2024-07-24','INATIVO','123',''),(10,'Roberto','roberto@email.com','Rua das Flores, 15 A','(11) 9000-0000','222.222.222-00','2024-07-24','ATIVO','123',''),(11,'ultimo','ultimo@email.com','ultimo, 123','(11)11100-0000','000.000.111-11','2024-07-26','DESATIVADO','0011',''),(12,'teste de cliente','teste@gmail.com','rua teste, 21','(22)22222-2222','222.222.222-22','2024-08-02','DESATIVADO','222',''),(13,'Douglas','douglas@email.com','Rua das Ruas, 15','(11) 11111-111','231.234.123-41','2024-08-04','ATIVO','',NULL),(14,'TESTE 01','teste@email.com','TESTE 01','(11) 11111-111','111.111.111-11','2024-08-04','INATIVO','',NULL);
/*!40000 ALTER TABLE `tbl_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_funcionario`
--

DROP TABLE IF EXISTS `tbl_funcionario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_funcionario` (
  `idFuncionario` int(11) NOT NULL AUTO_INCREMENT,
  `nomeFuncionario` varchar(50) NOT NULL,
  `emailFuncionario` varchar(50) NOT NULL,
  `enderecoFuncionario` varchar(80) NOT NULL,
  `numeroFuncionario` varchar(15) NOT NULL,
  `cpfFuncionario` varchar(14) NOT NULL,
  `dataFuncionario` date DEFAULT current_timestamp(),
  `statusFuncionario` varchar(12) NOT NULL,
  `senhaFuncionario` varchar(20) NOT NULL,
  `altFotoFuncionario` varchar(35) NOT NULL,
  `fotoFuncionario` varchar(35) NOT NULL,
  PRIMARY KEY (`idFuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_funcionario`
--

LOCK TABLES `tbl_funcionario` WRITE;
/*!40000 ALTER TABLE `tbl_funcionario` DISABLE KEYS */;
INSERT INTO `tbl_funcionario` VALUES (1,'Julha','julha123@email.com','Rua Juan, 12','(12)12121-2121','121.212.121-21','2024-08-03','ATIVO','123','foto Julha','img/funcionarios/julha.png'),(2,'João da Silva','joaosilva@email.com','Rua das Flores, 123, Centro','(11) 98765-432','123.456.789-00','2024-08-03','ATIVO','43','foto João da Silva','img/funcionarios/joãodasilva.png'),(3,'Maria Oliveira','mariaoliveira@email.com','Avenida Paulista, 456, Sala','(11) 97654-321','234.567.890-11','2024-08-04','ATIVO','09','foto Maria Oliveira','img/funcionarios/.png'),(4,'Carlos Souza','carlossouza@email.com','Rua 02','(21) 91234-567','345.678.901-22','2024-08-04','ATIVO','909','foto Carlos Souza','img/funcionarios/carlossouza.png');
/*!40000 ALTER TABLE `tbl_funcionario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_galeria`
--

DROP TABLE IF EXISTS `tbl_galeria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_galeria` (
  `idGaleria` int(11) NOT NULL AUTO_INCREMENT,
  `nomeGaleria` varchar(30) NOT NULL,
  `caminhoGaleria` varchar(50) NOT NULL,
  `altGaleria` varchar(80) NOT NULL,
  `statusGaleria` varchar(12) NOT NULL,
  PRIMARY KEY (`idGaleria`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_galeria`
--

LOCK TABLES `tbl_galeria` WRITE;
/*!40000 ALTER TABLE `tbl_galeria` DISABLE KEYS */;
INSERT INTO `tbl_galeria` VALUES (1,'FUNDO DO SITE','img/galeria/1_fundodosite.jpg','FUNDO DO SITE','ATIVO');
/*!40000 ALTER TABLE `tbl_galeria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_itens`
--

DROP TABLE IF EXISTS `tbl_itens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_itens` (
  `idItens` int(11) NOT NULL AUTO_INCREMENT,
  `idProduto` int(11) NOT NULL,
  `valorItens` double(10,2) NOT NULL,
  PRIMARY KEY (`idItens`),
  KEY `fk_produto_itens` (`idProduto`),
  CONSTRAINT `fk_produto_itens` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_itens`
--

LOCK TABLES `tbl_itens` WRITE;
/*!40000 ALTER TABLE `tbl_itens` DISABLE KEYS */;
INSERT INTO `tbl_itens` VALUES (1,1,270.50);
/*!40000 ALTER TABLE `tbl_itens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_marca`
--

DROP TABLE IF EXISTS `tbl_marca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_marca` (
  `idMarca` int(11) NOT NULL AUTO_INCREMENT,
  `nomeMarca` varchar(50) NOT NULL,
  `caminhoMarca` varchar(50) NOT NULL,
  `altMarca` varchar(50) NOT NULL,
  `statusMarca` varchar(8) NOT NULL,
  PRIMARY KEY (`idMarca`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_marca`
--

LOCK TABLES `tbl_marca` WRITE;
/*!40000 ALTER TABLE `tbl_marca` DISABLE KEYS */;
/*!40000 ALTER TABLE `tbl_marca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orcamento`
--

DROP TABLE IF EXISTS `tbl_orcamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_orcamento` (
  `idOrcamento` int(11) NOT NULL AUTO_INCREMENT,
  `idCliente` int(11) NOT NULL,
  `idServico` int(11) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  `valorOrcamento` double(10,2) NOT NULL,
  `statusOrcamento` varchar(35) NOT NULL,
  `dataOrcamento` date DEFAULT current_timestamp(),
  `comentOrcamento` varchar(100) DEFAULT NULL,
  `situacaoOrcamento` varchar(10) NOT NULL,
  `idProduto` int(11) NOT NULL,
  PRIMARY KEY (`idOrcamento`),
  KEY `cliente_orcamento` (`idCliente`),
  KEY `servico_orcamento` (`idServico`),
  KEY `funcionario_orcamento` (`idFuncionario`),
  KEY `fk_produto_orcamento` (`idProduto`),
  CONSTRAINT `cliente_orcamento` FOREIGN KEY (`idCliente`) REFERENCES `tbl_cliente` (`idCliente`),
  CONSTRAINT `fk_produto_orcamento` FOREIGN KEY (`idProduto`) REFERENCES `tbl_produto` (`idProduto`),
  CONSTRAINT `funcionario_orcamento` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`idFuncionario`),
  CONSTRAINT `servico_orcamento` FOREIGN KEY (`idServico`) REFERENCES `tbl_servico` (`idServico`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orcamento`
--

LOCK TABLES `tbl_orcamento` WRITE;
/*!40000 ALTER TABLE `tbl_orcamento` DISABLE KEYS */;
INSERT INTO `tbl_orcamento` VALUES (1,13,24,1,1500.00,'INATIVO','2024-08-05','Vidro temperado, cor azul e unica placa','PENDENTE',3),(2,13,14,2,1000.00,'INATIVO','2024-08-05','Janela prata, persiana verde','FEITO',3),(3,6,9,4,500.00,'INATIVO','2024-08-05','AAA','PAGO',1),(4,13,12,1,15.00,'ATIVO','2024-08-06','Persiana clara e janela prata','FEITO',3),(5,13,7,4,3.00,'ATIVO','2024-08-06','Espelho liso e sem detalhe','PENDENTE',7),(6,1,9,3,1500.00,'ATIVO','2024-08-06','Porta com kit branco','PAGO',2);
/*!40000 ALTER TABLE `tbl_orcamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_orcamento_site`
--

DROP TABLE IF EXISTS `tbl_orcamento_site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_orcamento_site` (
  `idOrcamentoSite` int(11) NOT NULL AUTO_INCREMENT,
  `idServico` int(11) NOT NULL,
  `nomeCliente` varchar(50) NOT NULL,
  `emailCliente` varchar(50) NOT NULL,
  `numeroCliente` varchar(13) NOT NULL,
  `enderecoCliente` varchar(100) NOT NULL,
  `comentOrcamento` varchar(100) NOT NULL,
  `alturaOrcamento` varchar(8) NOT NULL,
  `larguraOrcamento` varchar(8) NOT NULL,
  `dataCadOrcamento` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idOrcamentoSite`),
  KEY `fk_servico_orcsite` (`idServico`),
  CONSTRAINT `fk_servico_orcsite` FOREIGN KEY (`idServico`) REFERENCES `tbl_servico` (`idServico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_orcamento_site`
--

LOCK TABLES `tbl_orcamento_site` WRITE;
/*!40000 ALTER TABLE `tbl_orcamento_site` DISABLE KEYS */;
INSERT INTO `tbl_orcamento_site` VALUES (1,14,'Pedro Viana','pedrov@gmail.com','+55 11 987654','rua juan, 12','Com desenho','10','5','2024-08-05 22:48:57'),(2,12,'Luciano Moraes','liomoraes@gmail.com','21 98765-4321','Rua das Flores, 123','vidro temperado de 10mm','4','5','2024-08-05 22:58:24'),(3,15,'Ana Costa','anacosta@gmail.com','11 99876-5432','Avenida Paulista, 987','porta de alumínio anodizado, perfis de alta resistência conforme especificado.','3','1','2024-08-05 23:01:48');
/*!40000 ALTER TABLE `tbl_orcamento_site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_produto`
--

DROP TABLE IF EXISTS `tbl_produto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_produto` (
  `idProduto` int(11) NOT NULL AUTO_INCREMENT,
  `nomeProduto` varchar(50) NOT NULL,
  `valorProduto` double(10,2) NOT NULL,
  `quantidadeProduto` int(11) NOT NULL,
  `statusProduto` varchar(12) NOT NULL,
  `fotoProduto` varchar(50) DEFAULT NULL,
  `altProduto` varchar(50) DEFAULT NULL,
  `descProduto` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idProduto`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_produto`
--

LOCK TABLES `tbl_produto` WRITE;
/*!40000 ALTER TABLE `tbl_produto` DISABLE KEYS */;
INSERT INTO `tbl_produto` VALUES (1,'Puxador Aço Inox Polido',270.10,2,'ATIVO','produtos/puxadoraçoinoxpolido.png','foto Puxador Aço Inox Polido','é isso 2'),(2,'Puxador de alumínio',174.50,2,'ATIVO','produtos/puxadordealumínio.png','foto Puxador de alumínio','Puxador de alumínio'),(3,'Persiana para Janela',82.00,1,'ATIVO','produtos/persianaparajanela.png','foto Persiana para Janela','é isso'),(4,'teste 1',1.00,1,'DESATIVADO','produtos/teste1.png','fototeste 1','up teste'),(5,'testo 2',2.00,2,'ATIVO','produtos/testo2.png','foto testo 2','sla 222222'),(6,'teste99',99.00,99,'DESATIVADO','produtos/teste99.png','foto teste99','b99'),(7,'Silicone',100.00,40,'ATIVO','img/produtos/silicone.png','foto Silicone','Silicone');
/*!40000 ALTER TABLE `tbl_produto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_serv_exe`
--

DROP TABLE IF EXISTS `tbl_serv_exe`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_serv_exe` (
  `idServExe` int(11) NOT NULL AUTO_INCREMENT,
  `idOrcamento` int(11) NOT NULL,
  `statusServExe` varchar(12) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  PRIMARY KEY (`idServExe`),
  KEY `fk_orcamento_exe` (`idOrcamento`),
  KEY `fk_funcionario_servexe` (`idFuncionario`),
  CONSTRAINT `fk_funcionario_servexe` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`idFuncionario`),
  CONSTRAINT `fk_orcamento_exe` FOREIGN KEY (`idOrcamento`) REFERENCES `tbl_orcamento` (`idOrcamento`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_serv_exe`
--

LOCK TABLES `tbl_serv_exe` WRITE;
/*!40000 ALTER TABLE `tbl_serv_exe` DISABLE KEYS */;
INSERT INTO `tbl_serv_exe` VALUES (1,4,'FEITO',3);
/*!40000 ALTER TABLE `tbl_serv_exe` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_servico`
--

DROP TABLE IF EXISTS `tbl_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_servico` (
  `idServico` int(11) NOT NULL AUTO_INCREMENT,
  `nomeServicos` varchar(100) NOT NULL,
  `statusServicos` varchar(12) NOT NULL,
  `idTipoServico` int(11) NOT NULL,
  `descServico` varchar(200) NOT NULL,
  `fotoServicos` varchar(50) NOT NULL,
  `altServicos` varchar(50) NOT NULL,
  PRIMARY KEY (`idServico`),
  KEY `tipo_servico_servico` (`idTipoServico`),
  CONSTRAINT `tipo_servico_servico` FOREIGN KEY (`idTipoServico`) REFERENCES `tbl_tipo_servico` (`idTipoServico`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_servico`
--

LOCK TABLES `tbl_servico` WRITE;
/*!40000 ALTER TABLE `tbl_servico` DISABLE KEYS */;
INSERT INTO `tbl_servico` VALUES (1,'Box de Vidro','DESATIVADO',1,'','',''),(2,'Teto de vidro','DESATIVADO',1,'Um teto de vidro','servico/tetodevidro.jpg','fotoTeto de vidro'),(6,'Vidrinho','DESATIVADO',1,'É o Vidrinho nao tem como','servico/vidrinho.png','fotoVidrinho'),(7,'ESPELHO DE PAREDE','ATIVO',2,'Desfrute da facilidade de manutenção e da sensação de luminosidade que ele proporciona. Reflita o melhor do seu espaço.','img/servicos/7_espelhodeparede.svg','fotoESPELHO DE PAREDE'),(8,'Porta de Alumínio','DESATIVADO',3,'Serviço de uma porta de alumínio de medidas a pedido','1_portadealuminio.jpg','foto de uma porta de aluminio'),(9,'PORTA DE CORRER','ATIVO',1,'Combinando funcionalidade e estilo, permite a entrada de luz natural, criando espaços convidativos, uma nova definição de mordernidade.','img/servicos/9_portadecorrer.png','Foto do serviço de porta de correr de vidro'),(10,'TESTE 01','INATIVO',3,'TESTE 01','img/servicos/Image.png','TESTE 01'),(11,'CORRIMÃO DE VIDRO','ATIVO',1,'Adicione segurança e requinte ao seu lar com nosso corrimão de vidro, oferecemos uma solução durável e moderna para escadas e varandas.','img/servicos/11_corrimaodevidro.svg','Foto do serviço de corrimão de vidro'),(12,'TETO DE VIDRO','ATIVO',1,'Com uma superfície translúcida, durável e de fácil manutenção. Deixe a luz natural fluir e transforme cada momento em uma experiência única e inspiradora.','img/servicos/12_tetodevidro.svg','Foto do serviço de teto de vidro'),(13,'JANELA DE CORRER','ATIVO',1,'Com um design durável e fácil de limpar, nossa janela de correr oferece estilo e conveniência, deixe a luz natural banhar os seus ambientes.','img/servicos/13_janeladecorrer.svg','Foto do serviço de janela de vidro de correr'),(14,'JANELA DE CORRER','ATIVO',3,'Além de oferecer iluminação natural, ela proporciona isolamento térmico e acústico, criando um ambiente acolhedor e confortável.','img/servicos/14_janeladecorrer.svg','Foto do serviço de porta de correr de aluminio'),(15,'PORTA DE ALUMINIO','ATIVO',3,'Desc da porta de aluminio','img/servicos/15_portadealuminio.svg','Foto do serviço de porta aluminio'),(16,'CORRIMÃO DE ALUMINIO','ATIVO',3,'Desc do corrimão de aluminio','img/servicos/16_corrimaodealuminio.svg','Foto do serviço de corrimão de aluminio'),(17,'OUTRA FOTO DO CORRIMAO','INATIVO',3,'DESC','17_outrafotodocorrimao.jpg','DESC'),(18,'OUTRA FOTO DA PORTA','ATIVO',3,'Desc da porta','img/servicos/18_outrafotodaporta.svg','desc'),(19,'NOVA FOTO','INATIVO',3,'APRENDA A TREINAR O PRETIN AI DA TELA','img/servicos/19_novafoto.png','DRAGÃO BAGUELA PRETO QUE COSPE AZUL'),(20,'CORRIMÃO DE ALUMINIO','INATIVO',3,'Com um design durável e fácil de limpar, nossa janela de correr oferece estilo e conveniência, deixe a luz natural banhar os seus ambientes.','img/servicos/20_corrimodealuminio.jpg','Foto do serviço de porta de correr de aluminio'),(21,'ÉEEEEE','DESATIVADO',1,'ADFGDFHGE','img/servicos/hhahdfgfdg.png','foto ÉEEEEE'),(22,'MUSEU COM ESPELHOS','INATIVO',3,'Com um design durável e fácil de limpar, nossa janela de correr oferece estilo e conveniência, deixe a luz natural banhar os seus ambientes.','img/servicos/22_museucomespelhos.jpg','TESTE 01'),(23,'CORRIMÃO DE ALUMINIO','ATIVO',3,'Desfrute da facilidade de manutenção e da sensação de luminosidade que ele proporciona. Reflita o melhor do seu espaço.','img/servicos/23_corrimodealuminio.svg','Foto do serviço de corrimão de ALUMINIO'),(24,'PIA DE VIDRO','ATIVO',1,'A transparência do vidro permite criar um ambiente mais leve e arejado, ampliando visualmente o espaço. Além disso, as pias de vidro estão disponíveis em diversas cores e acabamentos, possibilitando c','img/servicos/24_piadevidro.jpg','Foto do serviço de pia de vidro'),(25,'TESTE 01','INATIVO',2,'TESTE 01','img/servicos/25_teste01.jpeg','TESTE 01'),(26,'TESTE 01','INATIVO',2,'TESTE 01','img/servicos/26_teste01.jpg','TESTE 01'),(27,'TESTE 01','INATIVO',3,'TESTE 01','img/servicos/27_teste01.jpg','TESTE 01');
/*!40000 ALTER TABLE `tbl_servico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_servicos`
--

DROP TABLE IF EXISTS `tbl_servicos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_servicos` (
  `idServicos` int(11) NOT NULL AUTO_INCREMENT,
  `idServico` int(11) NOT NULL,
  `idItens` int(11) NOT NULL,
  `comentServicos` varchar(100) NOT NULL,
  `valorServicos` double(10,2) NOT NULL,
  PRIMARY KEY (`idServicos`),
  KEY `servico_servicoS` (`idServico`),
  KEY `itens_servicoS` (`idItens`),
  CONSTRAINT `itens_servicoS` FOREIGN KEY (`idItens`) REFERENCES `tbl_itens` (`idItens`),
  CONSTRAINT `servico_servicoS` FOREIGN KEY (`idServico`) REFERENCES `tbl_servico` (`idServico`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_servicos`
--

LOCK TABLES `tbl_servicos` WRITE;
/*!40000 ALTER TABLE `tbl_servicos` DISABLE KEYS */;
INSERT INTO `tbl_servicos` VALUES (1,1,1,'Serviço de vidro rapido e simples',300.00);
/*!40000 ALTER TABLE `tbl_servicos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tbl_tipo_servico`
--

DROP TABLE IF EXISTS `tbl_tipo_servico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tbl_tipo_servico` (
  `idTipoServico` int(11) NOT NULL AUTO_INCREMENT,
  `tipoServico` varchar(50) NOT NULL,
  `statusServico` varchar(12) NOT NULL,
  `idFuncionario` int(11) NOT NULL,
  PRIMARY KEY (`idTipoServico`),
  KEY `fk_funcionario_tipo_servico` (`idFuncionario`),
  CONSTRAINT `fk_funcionario_tipo_servico` FOREIGN KEY (`idFuncionario`) REFERENCES `tbl_funcionario` (`idFuncionario`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tbl_tipo_servico`
--

LOCK TABLES `tbl_tipo_servico` WRITE;
/*!40000 ALTER TABLE `tbl_tipo_servico` DISABLE KEYS */;
INSERT INTO `tbl_tipo_servico` VALUES (1,'VIDRO','ATIVO',1),(2,'ESPELHO','ATIVO',3),(3,'ALUMINIO','ATIVO',3),(4,'AlUMINIO','DESATIVADO',5);
/*!40000 ALTER TABLE `tbl_tipo_servico` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2025-01-18  0:28:39

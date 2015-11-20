-- MySQL dump 10.15  Distrib 10.0.21-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: lms
-- ------------------------------------------------------
-- Server version	10.0.21-MariaDB-log

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `email_verification`
--

DROP TABLE IF EXISTS `email_verification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `email_verification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `verification_code` varchar(255) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user` (`user`),
  CONSTRAINT `email_verification_ibfk_1` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `email_verification`
--

LOCK TABLES `email_verification` WRITE;
/*!40000 ALTER TABLE `email_verification` DISABLE KEYS */;
INSERT INTO `email_verification` VALUES (1,1,'a0e1110908b9730f6fbba512db21fef2569845028218d9f26fb3b315f54540a5','0');
/*!40000 ALTER TABLE `email_verification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `emails`
--

DROP TABLE IF EXISTS `emails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `emails` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `receiptent` varchar(255) DEFAULT NULL,
  `subject` text,
  `message` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `emails`
--

LOCK TABLES `emails` WRITE;
/*!40000 ALTER TABLE `emails` DISABLE KEYS */;
INSERT INTO `emails` VALUES (1,'a@a.com','Welcome to Lab Management System | email verification.','					Welcome Ganesh Gautam, please click on this <a href=\'http://localhost/accounts/verify/1/a0e1110908b9730f6fbba512db21fef2569845028218d9f26fb3b315f54540a5\'>link</a> to vefity your account.');
/*!40000 ALTER TABLE `emails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `group_name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `group_name` (`group_name`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'BIO-CHEMICAL REPORT'),(2,'HEMATOLOGY'),(3,'SEROLOGICAL TEST'),(6,'STOOL ANALYSIS'),(5,'URINE ANALYSIS'),(4,'WIDAL TEST');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lost_password`
--

DROP TABLE IF EXISTS `lost_password`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `lost_password` (
  `email` varchar(255) DEFAULT NULL,
  `token` text,
  `used` enum('0','1') DEFAULT NULL,
  KEY `email` (`email`),
  CONSTRAINT `lost_password_ibfk_1` FOREIGN KEY (`email`) REFERENCES `users` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lost_password`
--

LOCK TABLES `lost_password` WRITE;
/*!40000 ALTER TABLE `lost_password` DISABLE KEYS */;
/*!40000 ALTER TABLE `lost_password` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `results`
--

DROP TABLE IF EXISTS `results`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `results` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test` int(11) DEFAULT NULL,
  `test_name` varchar(255) DEFAULT NULL,
  `unit_measurement` varchar(200) DEFAULT NULL,
  `default_value` varchar(200) DEFAULT NULL,
  `result` varchar(200) DEFAULT NULL,
  `belongs_to` int(11) DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `test` (`test`),
  KEY `belongs_to` (`belongs_to`),
  CONSTRAINT `results_ibfk_1` FOREIGN KEY (`test`) REFERENCES `tests` (`id`),
  CONSTRAINT `results_ibfk_2` FOREIGN KEY (`belongs_to`) REFERENCES `tests_id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `results`
--

LOCK TABLES `results` WRITE;
/*!40000 ALTER TABLE `results` DISABLE KEYS */;
INSERT INTO `results` VALUES (1,1,'Glucose (F)','mg%','60-110 mg%','113',4,0),(2,2,'Glucose P.P','mg%','80-140 mg%','157',4,0),(3,6,'S. Uric Acid','mg%','(M) 2-7 (F) 2-6 mg%','5.57',5,0);
/*!40000 ALTER TABLE `results` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests`
--

DROP TABLE IF EXISTS `tests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(255) DEFAULT NULL,
  `group_in` int(11) DEFAULT NULL,
  `unit_measurement` varchar(200) DEFAULT NULL,
  `default_value` varchar(200) DEFAULT NULL,
  `prefill_value` varchar(200) DEFAULT NULL,
  `input_field` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `group_in` (`group_in`),
  CONSTRAINT `tests_ibfk_1` FOREIGN KEY (`group_in`) REFERENCES `groups` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests`
--

LOCK TABLES `tests` WRITE;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` VALUES (1,'Glucose (F)',1,'mg%','60-110 mg%','','',0),(2,'Glucose P.P',1,'mg%','80-140 mg%','','',0),(3,'Glucose R',1,'mg%','80-140 mg%','','',0),(4,'Urea',1,'mg%','15-45 mg%','','',0),(5,'Creatinine',1,'mg%','0.4-1.4 mg%','','',0),(6,'S. Uric Acid',1,'mg%','(M) 2-7 (F) 2-6 mg%','','',0),(7,'Total Cholesterol',1,'mg%','150-250 mg%','','',0),(8,'Triglyceride',1,'mg%','60-150 mg%','','',0),(9,'HDL',1,'mg%','35-65 mg%','','',0),(10,'LDL',1,'mg%','<150 mg%','','',0),(11,'VLDL',1,'mg%','5-35 mg%','','',0),(12,'Total Bilirubin',1,'mg%','0.4-1.4 mg%','','',0),(13,'Direct Billirubin',1,'mg%','0.2-0.4 mg%','','',0),(14,'Alkaline Phosphates (ALP)',1,'U/L','60-306 U/L','','',0),(15,'SGPT',1,'U/L','5-35 U/L','','',0),(16,'SGOT',1,'U/L','5-40 U/L','','',0),(17,'Total Protein',1,'g%','5.8-7.5 g%','','',0),(18,'S. Albumin',1,'g%','3.5-4.5 g%','','',0),(19,'S Calcium',1,'mg%','8.5-11.5 mg%','','',0),(20,'Phasphorus (PO4)',1,'mg%','2.5-5 mg%','','',0),(21,'S Amylase',1,'Units/100 Ml','9-80 Units/100 Ml','','',0),(22,'Sodium (Na+)',1,'mmol/l','135-155 mmol/l','','',0),(23,'Potassium (K+)',1,'mmol/l','3.5-5.5 mmol/l','','',0),(24,'CK-MB',1,'U/L','<24 U/L','','',0),(25,'HbA1 C',1,'%','<6.2 %','','',0),(26,'Urine Micro Albumin',1,'mg/L','24','','',0),(27,'Others',1,'','','','',0),(28,'Total Count',2,'','','','',0),(29,'WBC',2,'/Cumm','','','',0),(30,'RBC',2,'/Cumm','','','',0),(31,'Platelets',2,'/Cumm','','','',0),(32,'Haemoglobine',2,'gm%','','','',0),(33,'ESR (Wintrobe Method)',2,'mm/hr','','','',0),(34,'<b>DIFFERENTIAL COUNT</b>',2,'','','','',0),(35,'Neutrophils',2,'%','','','',0),(36,'Lymphocytes',2,'%','','','',0),(37,'Eosinopils',2,'','','','',0),(38,'Monocytes',2,'%','','','',0),(39,'Basophil',2,'%','','','',0),(40,'Blast Cell',2,'%','','','',0),(41,'PCV',2,'%','','','',0),(42,'MCV',2,'FL','','','',0),(43,'MCSC',2,'%','','','',0),(44,'Reticulocytes',2,'%','','','',0),(45,'BT',2,'___Min___Sec','','','',0),(46,'CET',2,'___Min___Sec','','','',0),(47,'PT',2,'Sec','','','',0),(48,'INR',2,'Sec','','','',0),(49,'Control',2,'','','','',0),(51,'Blood Group',2,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'O\'>O</option><option value=\'A\'>A</option><option value=\'B\'>B</option><option value=\'AB\'>AB</option></select>',0),(52,'Rh Anti \'D\'',2,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(53,'VDRL',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Reactive\'>Reactive</option><option value=\'Non Reactive\'>Non Reactive</option></select>',0),(54,'RA Factor',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(55,'CRP',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(56,'ASO Titre',3,'IU/ml','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'1:200 IU/ml\'>1:200 IU/ml</option><option value=\'1:400 IU/ml\'>1:400 IU/ml</option><option value=\'1:600 IU/ml\'>1:600 IU/ml</option></select>',0),(57,'HBS Ag',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(58,'HIV',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(59,'HCV',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(60,'TPHA',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(61,'M.P. Ag',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Negative\'>Negative</option><option value=\'(Positive) Pf\'>(Positive) Pf</option><option value=\'(Positive) Pv\'>(Positive) Pv</option><option value=\'(Positive) Pf/Pv\'>(Positive) Pf/Pv</option></select>',0),(62,'Troponim I',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(63,'H. pyloric',3,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(64,'Others',3,'','','','',0),(66,'Salmonella Typhi - O',4,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Negative\'>Negative</option><option value=\'Positive\'>Positive</option><option value=\'(Positive) 1:20\'>(Positive) 1:20</option><option value=\'(Positive) 1:40\'>(Positive) 1:40</option><option value=\'(Positive) 1:80\'>(Positive) 1:80</option><option value=\'(Positive) 1:160\'>(Positive) 1:160</option><option value=\'(Positive) 1:320\'>(Positive) 1:320</option></select>',0),(67,'Salmonella Typhi -H',4,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Negative\'>Negative</option><option value=\'Positive\'>Positive</option><option value=\'(Positive) 1:20\'>(Positive) 1:20</option><option value=\'(Positive) 1:40\'>(Positive) 1:40</option><option value=\'(Positive) 1:80\'>(Positive) 1:80</option><option value=\'(Positive) 1:160\'>(Positive) 1:160</option><option value=\'(Positive) 1:320\'>(Positive) 1:320</option></select>',0),(68,'Salmonella Para Typhi -AH',4,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Negative\'>Negative</option><option value=\'Positive\'>Positive</option><option value=\'(Positive) 1:20\'>(Positive) 1:20</option><option value=\'(Positive) 1:40\'>(Positive) 1:40</option><option value=\'(Positive) 1:80\'>(Positive) 1:80</option><option value=\'(Positive) 1:160\'>(Positive) 1:160</option><option value=\'(Positive) 1:320\'>(Positive) 1:320</option></select>',0),(69,'Salmonella Para Typhi -BH',4,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Negative\'>Negative</option><option value=\'Positive\'>Positive</option><option value=\'(Positive) 1:20\'>(Positive) 1:20</option><option value=\'(Positive) 1:40\'>(Positive) 1:40</option><option value=\'(Positive) 1:80\'>(Positive) 1:80</option><option value=\'(Positive) 1:160\'>(Positive) 1:160</option><option value=\'(Positive) 1:320\'>(Positive) 1:320</option></select>',0),(70,'Physical Examination',5,'','','','',0),(71,'Colour',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Yellow\'>Yellow</option><option value=\'Deep Yellow\'>Deep Yellow</option><option value=\'Reddish Brown\'>Reddish Brown</option><option value=\'Red\'>Red</option></select>',0),(72,'Transparency',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Clear\'>Clear</option><option value=\'Trubid\'>Trubid</option></select>',0),(73,'Reaction',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Acidic\'>Acidic</option><option value=\'Alkaline\'>Alkaline</option></select>',0),(74,'Sp. Gravity',5,'','','','',0),(75,'Chemical Examination',5,'','','','',0),(78,'Sugar',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Nil\'>Nil</option><option value=\'Trace\'>Trace</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(79,'Albumin',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Nil\'>Nil</option><option value=\'Trace\'>Trace</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(80,'Bile Salt',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(81,'Urobilinogen',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(82,'Acetone/Ketone',5,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(83,'Microscopic Examination',5,'','','','',0),(84,'Co-oxalates',5,'/HPF','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Nil\'>Nil</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(85,'RBC',5,'/HPF','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Nil\'>Nil</option><option value=\'Trace\'>Trace</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(86,'Pus Cell',5,'/HPF','','','',0),(87,'Casts',5,'/HPF','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Nil\'>Nil</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(88,'Epi-Cell',5,'/HPF','','','',0),(89,'Others',5,'','','','',0),(90,'Physical Examination',6,'','','','',0),(91,'Colour',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Brown\'>Brown</option><option value=\'Green\'>Green</option></select>',0),(92,'Mucous',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Present\'>Present</option><option value=\'Absent\'>Absent</option></select>',0),(93,'Blood',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Present\'>Present</option><option value=\'Absent\'>Absent</option></select>',0),(94,'Consistancy',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Soft\'>Soft</option><option value=\'Hard\'>Hard</option><option value=\'Loose\'>Loose</option></select>',0),(95,'Microscopic Examination',6,'','','','',0),(96,'RBC',6,'/HPF','','','',0),(97,'Pus Cell',6,'/HPF','','','',0),(98,'Microscopic Exam',6,'','','','',0),(99,'Protozal Paracites',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option>\n<option value=\'Entamoebia Histolytica (Cyst)\'>Entamoebia Histolytica (Cyst)</option><option value=\'Entamoebia Histolytica (Trophozoite)\'>Entamoebia Histolytica (Trophozoite)</option><option value=\'Giardia Iamblia (Cyst)\'>Giardia Iamblia (Cyst)</option><option value=\'Giardia Iamblia (Trophozoite)\'>Giardia Iamblia (Trophozoite)</option></select>',0),(100,'Helmenthic Paracites',6,'','','','',0),(101,'Ascaris Lumbricoides',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option><option value=\'Larva\'>Larva</option></select>',0),(102,'Enterobius Vermicularis',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option><option value=\'Larva\'>Larva</option></select>',0),(103,'Taenia Solium/Saginata',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option><option value=\'Sigment\'>Sigment</option></select>',0),(104,'Strongyloiders stercoralis',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Actively Motile Larva\'>Actively Motile Larva</option></select>',0),(105,'Hook Worm',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option><option value=\'Larva\'>Larva</option></select>',0),(106,'Truchuris trichiura',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option><option value=\'Sigment\'>Sigment</option></select>',0),(107,'H-nana',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Absent\'>Absent</option><option value=\'Ova\'>Ova</option></select>',0),(108,'Occult Blood',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'Positive\'>Positive</option><option value=\'Negative\'>Negative</option></select>',0),(109,'Others',6,'','','','',0),(110,'Undigested Food Particle',6,'','','','<select tabindex=\'1\' class=\'form-control\' name=\'{name}\'><option value=\'\'>Select One</option><option value=\'+\'>+</option><option value=\'++\'>++</option><option value=\'+++\'>+++</option><option value=\'++++\'>++++</option></select>',0),(111,'Rod Bacteria Seen',6,'','','','',0);
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tests_id`
--

DROP TABLE IF EXISTS `tests_id`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tests_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `ref` varchar(10) DEFAULT NULL,
  `age` varchar(10) DEFAULT NULL,
  `sex` varchar(10) DEFAULT NULL,
  `date_taken` date DEFAULT NULL,
  `address` text,
  `short_clinical_history` text,
  `price` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tests_id`
--

LOCK TABLES `tests_id` WRITE;
/*!40000 ALTER TABLE `tests_id` DISABLE KEYS */;
INSERT INTO `tests_id` VALUES (4,'Yanaraj Aryal','SELF','72','Male','2015-10-26','Bohiya','Fasting / PP',100),(5,'bindu nepal','SELF','25','Female','2015-10-26','babani','s ,uricacid',150);
/*!40000 ALTER TABLE `tests_id` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sn` varchar(100) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_type` int(11) DEFAULT NULL,
  `register_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `phone_num` varchar(20) DEFAULT NULL,
  `phone_num_parents` varchar(20) DEFAULT NULL,
  `last_visit_date` date DEFAULT NULL,
  `status` enum('0','1') DEFAULT '0',
  `blocked` enum('0','1') DEFAULT '0',
  `deleted` enum('0','1') DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `sn` (`sn`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,NULL,'a@a.com','Ganesh Gautam','$2y$10$udcql.LXehABOFV/uBqc1u2Ars4Kbt6Fc8Mzew2VqOARbtJYpifI6',1,'2001-10-14 11:33:04',NULL,NULL,NULL,'1','0','0');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-10-26 17:19:37

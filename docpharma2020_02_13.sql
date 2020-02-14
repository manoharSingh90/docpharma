/*
SQLyog Trial v13.1.2 (32 bit)
MySQL - 5.7.29-0ubuntu0.18.04.1 : Database - docpharmauat
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`docpharmauat` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `docpharmauat`;

/*Table structure for table `abbreviation_master` */

DROP TABLE IF EXISTS `abbreviation_master`;

CREATE TABLE `abbreviation_master` (
  `id` double DEFAULT NULL,
  `abbreviation` varchar(30) DEFAULT NULL,
  `meaning` blob,
  `is_active` double DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `modified_dttm` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `abbreviation_master` */

insert  into `abbreviation_master`(`id`,`abbreviation`,`meaning`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'1/2NS','one-half normal saline (0.45%)',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:40'),
(2,'5-ASA','5-aminosalicylic acid',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(3,'a','before',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(4,'A.M.','morning',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(5,'aa','of each',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(6,'AAA','abdominal aortic aneurysm (called a \"triple-A)',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(7,'a.a.a.','apply to affected area',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(8,'ac','before meals',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(9,'achs','before meals and at bedtime',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(10,'AD','right ear',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(11,'ad lib','freely',NULL,'0000-00-00 00:00:00','2019-10-04 11:58:55'),
(12,'ad sat.','to saturation',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(13,'ad.','to',NULL,'0000-00-00 00:00:00','2019-10-04 11:59:08'),
(14,'ALT','alanine aminotransferase',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(15,'alt.','alternate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(16,'alt. h.','every other hour',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(17,'am','in the morning',NULL,'0000-00-00 00:00:00','2019-10-04 11:58:49'),
(18,'amp','ampule',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:41'),
(19,'amt.','amount',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(20,'ant.','anterior',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(21,'ante','before',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(22,'ap','before dinner',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(23,'APAP','acetaminophen',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(24,'aPTT','activated partial thromboplastin',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(25,'aq','water',NULL,'0000-00-00 00:00:00','2019-10-04 11:53:34'),
(26,'as','left ear',NULL,'0000-00-00 00:00:00','2019-10-04 11:53:48'),
(27,'ASA','aspirin',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(28,'AST','aspartate aminotransferase',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(29,'ATC','around the clock',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(30,'AU','both ears',NULL,'0000-00-00 00:00:00','2019-10-04 11:59:24'),
(31,'AZT','zidovudine',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(32,'Ba','barium',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(33,'BCP','birth control pills',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(34,'Bi','bismuth',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(35,'bid','twice a day',NULL,'0000-00-00 00:00:00','2019-10-04 11:53:53'),
(36,'BM','bowel movement',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:42'),
(37,'BMI','body mass index',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(38,'bol','bolus',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(39,'BP','blood pressure',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(40,'BPH','benign prostatic hypertrophy',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(41,'BS','blood sugar',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(42,'BSA','body surface area',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(43,'BT','bedtime',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(44,'c','with',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(45,'C.C.','chief complaint',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(46,'c/o','complaints of',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(47,'C&S','culture and sensitivity',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(48,'CABG','coronary artery bypass graft',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(49,'CaCO3','calcium carbonate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(50,'CAD','coronary artery disease',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(51,'CAP','cancer of the prostate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(52,'cap.','capsule',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(53,'CBC','complete blood count',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:43'),
(54,'cc','cubic centimeter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(55,'CD','controlled delivery',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(56,'CF','cystic fibrosis',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(57,'cm','centimeter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(58,'CNS','central nervous system',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(59,'conc','concentrated',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(60,'CPZ','Compazine',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(61,'CR','controlled-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(62,'crm','cream',NULL,'0000-00-00 00:00:00','2019-10-04 11:54:11'),
(63,'CV','cardiovascular',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(64,'CXR','chest x-ray',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(65,'dc','discharge',NULL,'0000-00-00 00:00:00','2019-10-04 11:59:44'),
(66,'D5/0.9 NaC','5% dextrose and normal saline solution (0.9% ',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(67,'D5 1/2/NS','5% dextrose and half normal saline solution (',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(68,'D5NS','dextrose 5% in normal saline (0.9%)',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(69,'D5W','5% dextrose in water',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(70,'DAW','dispense as written',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(71,'DBP','diastolic blood pressure',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:44'),
(72,'dil.','diluted',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(73,'disp','dispense',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(74,'div','divide',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(75,'DKA','diabetic ketoacidosis',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(76,'dL','deciliter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(77,'DM','diabetes mellitus',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(78,'DO','Doctor of Osteopathic Medicine',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(79,'DOB','date of birth',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(80,'DPT','diphtheria-pertussis-tetanus',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(81,'DR','delayed-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(82,'DVT','deep vein thrombosis',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(83,'DW','dextrose in water',NULL,'0000-00-00 00:00:00','2019-10-04 12:00:05'),
(84,'EC','enteric-coated',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(85,'EENT','Eye, Ear, Nose, and Throat',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(86,'elix.','elixir',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(87,'emuls.','emulsion',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(88,'ER','extended-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:45'),
(89,'ER','emergency room',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(90,'ETOH','ethyl alcohol',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(91,'F','Fahrenheit',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(92,'f or F','female',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(93,'FBS','fasting blood sugar',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(94,'FDA','Food and Drug Administration',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(95,'Fe','Iron',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(96,'FFP','fresh frozen plasma',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(97,'fl or fld','fluid',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(98,'ft','foot',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(99,'g','gram',NULL,'0000-00-00 00:00:00','2019-10-04 11:54:45'),
(100,'garg','gargle',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(101,'GERD','gastroesophageal reflux disease',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(102,'GI','gastrointestinal',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(103,'gr.','grain',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(104,'GTT','glucose tolerance test',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:46'),
(105,'gtts','drops',NULL,'0000-00-00 00:00:00','2019-10-04 11:55:30'),
(106,'GU','genitourinary',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(107,'guttat.','drop by drop',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(108,'hr.','hour',NULL,'0000-00-00 00:00:00','2019-10-04 11:55:01'),
(109,'h/o','history of',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(110,'H&H','hematocrit and hemoglobin',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(111,'H2','histamine 2',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(112,'H20','water',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(113,'HAART','highly active antiretroviral therapy',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(114,'Hc','hematocrit',NULL,'0000-00-00 00:00:00','2019-10-04 11:55:11'),
(115,'HCT','hydrocortisone',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(116,'HCTZ','hydrochlorothiazide',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(117,'HR','heart rate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(118,'HS','half-strength',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:47'),
(119,'h.s.','at bedtime',NULL,'0000-00-00 00:00:00','2019-10-04 12:00:48'),
(120,'HTN','hypertension',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(121,'hx','history',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(122,'IBW','ideal body weight',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(123,'ID','infectious disease',NULL,'0000-00-00 00:00:00','2019-10-04 12:00:22'),
(124,'IJ','injection',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(125,'IM','intramuscular',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(127,'inf','infusion',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(128,'inj.','injection',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(129,'instill.','instillation',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(130,'IP','intraperitoneal',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(131,'IR','immediate-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(132,'IU','international unit',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(133,'IUD','intrauterine device',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(134,'IV','intravenous',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:48'),
(135,'IVP','intravenous push',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(136,'IVPB','intravenous piggyback',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(137,'J','joule',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(138,'K','potassium',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(139,'KOH','potassium hydroxide',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(140,'L','liter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(141,'LA','long-acting',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(142,'lab','laboratory',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(143,'lb.','pound',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(144,'LDL','low-density lipoprotein',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(145,'LFT','liver function tests',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(146,'Li','lithium',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(147,'liq.','liquid',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(148,'LMP','last menstrual period',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(149,'lot','lotion',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(150,'LPN','licensed practical nurse',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(151,'LR','lactated ringer (solution)',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(152,'mane','in the morning',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(153,'mcg','microgram',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(154,'MD','medical doctor',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(155,'MDI','metered-dose inhaler',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:49'),
(156,'mEq','milliequivalent',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(157,'mEq/L','milliequivalent per liter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(158,'Mg','magnesium',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(159,'mg','milligram',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(160,'MgSO4','magnesium sulfate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(161,'mL','milliliter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(162,'mm','millimeter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(163,'mm of Hg','millimeters of mercury',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(164,'mMol','millimole',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(165,'MMR','measle-mumps-rubella (vaccine)',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(166,'mol wt','molecular weight',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(167,'MR','modified-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(168,'MS','morphine sulfate or magnesium sulfate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(169,'MSO4','morphine sulfate',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(170,'n','in the night',NULL,'0000-00-00 00:00:00','2019-10-04 11:56:05'),
(171,'N/A','not applicable',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:50'),
(172,'N/V','nausea and vomiting',NULL,'0000-00-00 00:00:00','2019-10-04 11:55:54'),
(173,'Na','sodium',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(174,'NAS','intranasal',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(175,'NDC','National Drug Code',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(176,'NGT','nasogastric tube',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(177,'NH3','ammonia',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(178,'NKA','no known allergies',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(179,'NKDA','no known drug allergies',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(180,'noct. mane','night and morning',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(181,'NP','nurse practitioner',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(182,'NPO','nothing by mouth',NULL,'0000-00-00 00:00:00','2019-10-04 11:56:26'),
(183,'NS','normal saline',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(184,'NSAID','nonsteroidal anti-inflammatory drug',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(185,'NTE','not to exceed',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(186,'O2','oxygen',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(187,'OC','oral contraceptive',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(188,'OD','right eye',NULL,'0000-00-00 00:00:00','2019-10-04 11:56:48'),
(189,'o.d.','once per day',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:51'),
(190,'OJ','orange juice',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(191,'OM','otitis media',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(192,'OS','left eye',NULL,'0000-00-00 00:00:00','2019-10-04 11:56:55'),
(193,'OTC','over-the-counter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(194,'OU','both eyes',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:00'),
(195,'oz','ounce',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(196,'p','after',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(197,'pr','as needed',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:05'),
(198,'PA','physician assistant',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(199,'pc','after meals',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(200,'PCA','patient-controlled analgesia',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(201,'PE','physical exam',NULL,'0000-00-00 00:00:00','2019-10-04 11:58:15'),
(202,'per','by',NULL,'0000-00-00 00:00:00','2019-10-04 12:01:57'),
(203,'per neb','by nebulizer',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(204,'per os','orally',NULL,'0000-00-00 00:00:00','2019-10-04 12:01:45'),
(205,'PFT','pulmonary function tests',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(206,'pH','hydrogen ion concentration',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(207,'PharmD','Doctor of Pharmacy',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:52'),
(208,'PM','evening',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(209,'PMH','past medical history',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(210,'PO','orally',NULL,'0000-00-00 00:00:00','2019-10-04 11:58:29'),
(211,'PR','per the rectum',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:22'),
(212,'PT','prothrombin time',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(213,'PTT','partial thromboplastin time',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(214,'pulv','powder',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(215,'PV','per the vagina',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(216,'q','every',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(217,'qs','as much as needed',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:47'),
(218,'q12h','every 12 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(219,'qd','daily',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:51'),
(220,'q2h','every 2 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(221,'q3h','every 3 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(222,'q4h','every 4 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(223,'q6h','every 6 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(224,'q6PM','every evening at 6 PM',NULL,'0000-00-00 00:00:00','2019-10-04 11:57:57'),
(225,'q8h','every 8 hours',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(226,'qam','every morning',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:53'),
(227,'qd','every day',NULL,'0000-00-00 00:00:00','2019-10-04 12:02:08'),
(228,'qh','every hour',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(229,'qhs','each night at bedtime',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(230,'qid','four times a day',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(231,'qn','Nightly or at bedtime',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(232,'qod','every other day',NULL,'0000-00-00 00:00:00','2019-10-04 12:02:14'),
(233,'q.s. ad','add sufficient quantity to make',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(234,'RA','rheumatoid arthritis',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(235,'RDA','recommended daily allowances',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(236,'RE','right eye',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(237,'rep','repeats',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(238,'RN','registered nurse',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(239,'RPh','pharmacist',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(240,'Rx','prescription',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(241,'s','without',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(242,'s.o.s.','if necessary',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(243,'sa','best practice',NULL,'0000-00-00 00:00:00','2019-10-04 12:02:41'),
(244,'SA','sustained action',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(245,'SBP','systolic blood pressure',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(246,'SID','Used ONLY in Veterinary medicine to mean \"onc',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(247,'sig codes','medical or prescription abbreviations',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(248,'Sig.','write on label',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:54'),
(249,'SL','under the tongue',NULL,'0000-00-00 00:00:00','2019-10-04 12:02:29'),
(250,'SNRI','serotonin/norepinephrine reuptake inhibitor',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(251,'SOB','shortness of breath',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(252,'sol','solution',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:21'),
(253,'sp gr','specific gravity',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(254,'SQ','subcutaneously',NULL,'0000-00-00 00:00:00','2019-10-04 12:02:58'),
(255,'SR','sustained release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(256,'ss','sliding scale (insulin) OR 1/2 (apothecary; o',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(257,'SSI','Sliding scale insulin',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(258,'SSRI','sliding scale regular insulin OR selective se',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(259,'stat','immediately',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(260,'STD','sexually transmitted diseases',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(261,'sup.','superior',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(262,'supf.','superficial',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(263,'supp','suppository',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(264,'susp','suspension',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(265,'syr.','syrup',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(266,'T','temperature',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(267,'tab','tablet',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(268,'tbsp','tablespoon',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:55'),
(269,'TIA','transient ischemic attack',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(270,'TID','three times a day',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:04'),
(271,'tid ac','three times a day before meals',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(272,'TIN','three times a night',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:12'),
(273,'tinct','tincture',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:08'),
(274,'TIW, tiw','3 times a week',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(275,'top.','topical',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(276,'TO','telephone order',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(277,'TPN','total parenteral nutrition',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(278,'TR','timed-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(279,'troche','lozenge',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(280,'TSH','thyroid stimulating hormone',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(281,'tsp','teaspoon',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(282,'Tx','treatment',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(283,'u','unit',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:31'),
(284,'UA','urinalysis',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:56'),
(285,'ud','as directed',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:39'),
(286,'ung','ointment',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(287,'UTI','urinary tract infection',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(288,'vag','via the vagina',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:43'),
(289,'VLDL','very low density lipoprotein',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(290,'vol %','volume percent',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(291,'vol.','volume',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(292,'w/o','without',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(293,'w/v','weight in volume',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(294,'WBC','white blood cell',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(295,'WNL','within normal limits',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(296,'wt.','weight',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(297,'x','multiplied by',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(298,'XL','extended-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(299,'XR','extended-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(300,'XT','extended-release',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(301,'yo','years old',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(302,'yr','year',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(303,'Zn','zinc',NULL,'0000-00-00 00:00:00','2019-10-04 06:42:50'),
(304,'?Eq','microequivalent',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:57'),
(305,'mcg','microgram',NULL,'0000-00-00 00:00:00','2019-10-04 12:03:58'),
(306,'?L','microliter',NULL,'0000-00-00 00:00:00','2019-10-04 11:45:58');

/*Table structure for table `appointment_details` */

DROP TABLE IF EXISTS `appointment_details`;

CREATE TABLE `appointment_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `appointment_date` varchar(50) DEFAULT NULL,
  `appointment_day` varchar(10) DEFAULT NULL,
  `appointment_time` varchar(50) DEFAULT NULL,
  `appointment_date1` date DEFAULT NULL,
  `appointment_time1` time DEFAULT NULL,
  `comments` text,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `cancel_message` varchar(100) NOT NULL DEFAULT 'NULL',
  `queue_data` int(11) DEFAULT '0',
  `payment_data` int(11) DEFAULT '0',
  `bulkcancellation_status` int(11) DEFAULT '1' COMMENT '"0=>Cancelled","1=>Not Cancelled"',
  `bulkcancellation_message` text,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=latin1;

/*Data for the table `appointment_details` */

insert  into `appointment_details`(`id`,`clinic_id`,`users_id`,`doctor_id`,`patient_id`,`appointment_date`,`appointment_day`,`appointment_time`,`appointment_date1`,`appointment_time1`,`comments`,`is_active`,`cancel_message`,`queue_data`,`payment_data`,`bulkcancellation_status`,`bulkcancellation_message`,`created`,`modified`) values 
(1,1,NULL,10,15,'09 Oct 2019','Wed','05:30 PM','2019-10-09','17:30:00','dddddd',1,'',0,0,1,NULL,'2019-10-09 11:56:54','2019-10-09 12:02:17'),
(3,1,NULL,10,15,'11 Oct 2019','Fri','06:30 PM','2019-10-11','18:30:00','hjhk',1,'NULL',0,0,0,'ghmjghj','2019-10-10 06:39:24','2019-10-10 13:21:54'),
(4,1,NULL,10,15,'11 Oct 2019','Fri','10:00 AM','2019-10-11','10:00:00','ghj',1,'NULL',0,0,0,'ghmjghj','2019-10-10 07:23:34','2019-10-10 13:21:54'),
(6,1,NULL,10,16,'10 Oct 2019','Thu','06:30 PM','2019-10-10','18:30:00','etreter',1,'NULL',0,0,1,'','2019-10-10 11:20:07','2019-10-10 12:56:14'),
(7,1,NULL,10,16,'11 Oct 2019','Fri','06:00 PM','2019-10-11','18:00:00','uyiyui',1,'NULL',0,0,1,NULL,'2019-10-11 06:32:05','2019-10-11 06:32:05'),
(8,1,NULL,10,19,'11 Oct 2019','Fri','05:00 PM','2019-10-11','17:00:00','dsdsd',1,'NULL',0,0,1,NULL,'2019-10-11 11:01:20','2019-10-11 11:01:20'),
(9,1,NULL,10,19,'14 Oct 2019','Mon','12:30 PM','2019-10-14','12:30:00','dsdsd',1,'NULL',1,0,1,NULL,'2019-10-14 06:34:56','2019-10-14 13:13:44'),
(10,1,NULL,10,19,'17 Oct 2019','Thu','09:30 AM','2019-10-17','09:30:00','ffff',1,'NULL',1,2,1,NULL,'2019-10-14 06:35:15','2019-10-17 12:53:42'),
(11,1,NULL,10,17,'22 Oct 2019','Tue','09:00 AM','2019-10-22','09:00:00','ggggg',1,'NULL',0,0,1,NULL,'2019-10-14 06:35:27','2019-10-14 06:35:27'),
(12,1,NULL,11,20,'14 Oct 2019','Mon','01:15 PM','2019-10-14','13:15:00','sdsd',1,'NULL',1,0,1,NULL,'2019-10-14 07:40:01','2019-10-14 13:13:43'),
(13,1,NULL,11,16,'15 Oct 2019','Tue','09:30 AM','2019-10-15','09:30:00','fdfdf',1,'',0,0,1,NULL,'2019-10-14 07:40:14','2019-10-14 07:40:33'),
(14,1,NULL,10,21,'14 Oct 2019','Mon','07:00 PM','2019-10-14','19:00:00',';l;l;kljk',1,'NULL',1,2,1,NULL,'2019-10-14 13:13:13','2019-10-14 13:14:06'),
(15,1,NULL,12,21,'16 Oct 2019','Wed','07:00 PM','2019-10-16','19:00:00',';\';\'kklkl',1,'NULL',1,0,0,'jkjkjkjkjk','2019-10-14 13:15:18','2019-10-14 13:20:13'),
(16,1,NULL,12,20,'15 Oct 2019','Tue','03:15 PM','2019-10-15','15:15:00',NULL,1,'NULL',0,0,1,NULL,'2019-10-15 06:13:45','2019-10-15 06:13:45'),
(17,1,NULL,10,21,'16 Oct 2019','Wed','12:30 PM','2019-10-16','12:30:00','dddddddddd',1,'NULL',1,0,1,NULL,'2019-10-16 06:45:03','2019-10-16 06:45:08'),
(18,1,NULL,11,19,'17 Oct 2019','Thu','01:00 PM','2019-10-17','13:00:00','abcd',1,'NULL',0,0,1,NULL,'2019-10-16 14:18:26','2019-10-16 14:18:26'),
(19,1,NULL,12,17,'17 Oct 2019','Thu','06:45 PM','2019-10-17','18:45:00','rgfh',1,'NULL',0,0,1,NULL,'2019-10-17 10:08:30','2019-10-17 10:08:30'),
(20,1,NULL,12,20,'17 Oct 2019','Thu','07:30 PM','2019-10-17','19:30:00','ergtert',1,'NULL',0,0,0,'gfhfgh','2019-10-17 10:08:49','2019-10-17 10:13:29'),
(21,1,NULL,16,21,'18 Oct 2019','Fri','01:45 PM','2019-10-18','13:45:00',NULL,1,'NULL',1,0,1,NULL,'2019-10-18 08:05:20','2019-10-18 08:06:33'),
(22,1,NULL,17,20,'07 Nov 2019','Thu','11:45 AM','2019-11-07','11:45:00','dddd',1,'NULL',1,0,1,NULL,'2019-11-07 06:07:54','2019-11-07 06:07:56'),
(23,1,NULL,17,15,'08 Nov 2019','Fri','11:15 AM','2019-11-08','11:15:00','dsds dsdsd',1,'NULL',1,0,1,NULL,'2019-11-08 05:36:44','2019-11-08 05:36:48'),
(24,1,NULL,10,22,'20 Nov 2019','Wed','03:30 PM','2019-11-20','15:30:00','anbhb',1,'NULL',1,0,1,NULL,'2019-11-20 09:44:40','2019-11-20 09:44:43'),
(25,1,NULL,16,21,'20 Nov 2019','Wed','03:30 PM','2019-11-20','15:30:00','abcd',1,'NULL',0,0,1,NULL,'2019-11-20 09:45:37','2019-11-20 14:22:01'),
(26,1,NULL,16,24,'21 Nov 2019','Thu','09:00 AM','2019-11-21','09:00:00',NULL,1,'NULL',0,0,1,NULL,'2019-11-20 14:21:44','2019-11-21 08:44:14'),
(27,1,NULL,17,24,'22 Nov 2019','Fri','04:00 PM','2019-11-22','16:00:00','dsds',1,'NULL',1,0,1,NULL,'2019-11-22 10:28:33','2019-11-22 10:28:36'),
(28,1,NULL,16,21,'22 Nov 2019','Fri','06:45 PM','2019-11-22','18:45:00',NULL,1,'NULL',1,2,1,NULL,'2019-11-22 13:00:22','2019-11-22 13:30:52'),
(29,1,NULL,16,20,'04 Dec 2019','Wed','12:15 PM','2019-12-04','12:15:00',NULL,1,'NULL',1,0,1,NULL,'2019-12-04 06:33:18','2019-12-04 06:33:21'),
(30,1,NULL,16,21,'02 Jan 2020','Thu','03:45 PM','2020-01-02','15:45:00',NULL,1,'NULL',1,0,1,NULL,'2020-01-02 10:05:13','2020-01-02 10:05:21'),
(31,1,NULL,17,21,'06 Feb 2020','Thu','03:00 PM','2020-02-06','15:00:00',NULL,1,'NULL',1,0,1,NULL,'2020-02-06 09:26:27','2020-02-06 09:26:30');

/*Table structure for table `blackout_details` */

DROP TABLE IF EXISTS `blackout_details`;

CREATE TABLE `blackout_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `blackout_startdate` date DEFAULT NULL,
  `blackout_enddate` date DEFAULT NULL,
  `blackout_starttime` time DEFAULT NULL,
  `blackout_endtime` time DEFAULT NULL,
  `comments` varchar(200) DEFAULT NULL,
  `is_active` int(11) DEFAULT '1',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `blackout_details` */

insert  into `blackout_details`(`id`,`users_id`,`doctor_id`,`clinic_id`,`blackout_startdate`,`blackout_enddate`,`blackout_starttime`,`blackout_endtime`,`comments`,`is_active`,`created`,`modified`) values 
(1,1,10,1,'2019-10-16','2019-10-16','13:00:00','15:00:00','zxzx',1,'2019-10-10 10:45:55','2019-10-10 10:45:55'),
(2,1,10,1,'2019-10-11','2019-10-11','10:00:00','20:00:00','test blackout',1,'2019-10-11 13:03:15','2019-10-11 13:03:15'),
(3,1,11,1,'2019-10-12','2019-10-14','09:00:00','11:00:00','fghfgh',1,'2019-10-11 12:58:11','2019-10-11 12:58:11'),
(4,1,10,1,'2019-10-14','2019-10-14','02:00:00','01:00:00','',1,'2019-10-14 10:21:47','2019-10-14 10:21:47');

/*Table structure for table `customer_details` */

DROP TABLE IF EXISTS `customer_details`;

CREATE TABLE `customer_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(22) DEFAULT NULL,
  `first_name` varchar(22) DEFAULT NULL,
  `middle_name` varchar(22) DEFAULT NULL,
  `last_name` varchar(22) DEFAULT NULL,
  `dob` varchar(11) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_code` varchar(50) DEFAULT NULL,
  `phone` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `longitude` varchar(200) DEFAULT NULL,
  `latitude` varchar(200) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `pincode` varchar(50) DEFAULT NULL,
  `allergies` varchar(100) DEFAULT NULL,
  `other_allergies` varchar(100) DEFAULT NULL,
  `conditions` varchar(100) DEFAULT NULL,
  `other_conditions` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `customer_details` */

/*Table structure for table `doctor_details` */

DROP TABLE IF EXISTS `doctor_details`;

CREATE TABLE `doctor_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `middle_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `gender` int(11) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `email` varchar(300) DEFAULT NULL,
  `phone` varchar(300) DEFAULT NULL,
  `type` varchar(20) DEFAULT NULL,
  `image` varchar(200) NOT NULL,
  `speciality` varchar(255) DEFAULT NULL,
  `registration_number` varchar(50) DEFAULT NULL,
  `registration_authority` varchar(50) DEFAULT NULL,
  `registration_state` varchar(50) DEFAULT NULL,
  `qualification` text,
  `timing` text,
  `affiliation` text,
  `password` varchar(200) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL COMMENT '"0=>DeActivated","1=>Activated"',
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

/*Data for the table `doctor_details` */

insert  into `doctor_details`(`id`,`clinic_id`,`users_id`,`title`,`first_name`,`middle_name`,`last_name`,`gender`,`dob`,`email`,`phone`,`type`,`image`,`speciality`,`registration_number`,`registration_authority`,`registration_state`,`qualification`,`timing`,`affiliation`,`password`,`is_active`,`created`,`modified`) values 
(10,1,3,'Dr','denial','','den',1,NULL,'[\"fgnj@gmail.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"9897866867\"}]','Permanent','2019-10-09_11-05-13user3.png','','67768','678678','6787','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon,Tue,Wed,Thu,Fri\",\"start_time\":\"09:00\",\"start_meridiem\":\"AM\",\"end_time\":\"11:00\",\"end_meridiem\":\"AM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"},{\"day\":\"Mon,Tue,Wed,Thu,Fri\",\"start_time\":\"11:00\",\"start_meridiem\":\"AM\",\"end_time\":\"07:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"30\",\"duration_min\":\"Min\"}],[{\"day\":\"Sat,Sun\",\"start_time\":\"11:00\",\"start_meridiem\":\"AM\",\"end_time\":\"03:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"30\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,'2019-10-14 12:44:32'),
(11,1,4,'Dr','sass','sas','sas',1,'1992-04-17','[\"dsdsds@dsd.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"3232\"}]','Permanent','','speciality1','dsd','dsd','ds','[{\"university\":\"ds\",\"degree\":\"dsd\",\"passing_year\":\"2014\"}]','[[{\"day\":\"Mon,Wed\",\"start_time\":\"01:00\",\"start_meridiem\":\"PM\",\"end_time\":\"02:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"},{\"day\":\"Mon,Wed\",\"start_time\":\"03:00\",\"start_meridiem\":\"PM\",\"end_time\":\"04:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"30\",\"duration_min\":\"Min\"}],[{\"day\":\"Tue,Thu,Sat\",\"start_time\":\"01:00\",\"start_meridiem\":\"PM\",\"end_time\":\"06:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"30\",\"duration_min\":\"Min\"}]]','[\"dsd\"]',NULL,1,NULL,'2019-10-14 10:40:45'),
(12,1,5,'Dr','sharda','','singh',2,'1997-12-31','[\"sharda@unikove.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"9889789787\"}]','Temporary','2019-10-14_13-08-41download.png','','9879789','97896','up','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon,Tue\",\"start_time\":\"10:00\",\"start_meridiem\":\"AM\",\"end_time\":\"01:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"30\",\"duration_min\":\"Min\"},{\"day\":\"Mon,Tue\",\"start_time\":\"03:00\",\"start_meridiem\":\"PM\",\"end_time\":\"05:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}],[{\"day\":\"Wed,Thu\",\"start_time\":\"06:00\",\"start_meridiem\":\"PM\",\"end_time\":\"08:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,'2019-10-16 05:42:53'),
(13,1,6,'Dr','fsfd','fdsf','fdsf',2,'1992-05-11','[\"ffsdf@sdf.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"64566\"}]','','','hgh','hgh','hgh','hgh','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon\",\"start_time\":\"01:00\",\"start_meridiem\":\"PM\",\"end_time\":\"02:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,NULL),
(14,1,7,'Dr','dsd','fdfd','fdfd',2,'1992-04-09','[\"fdfdf@dsd.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"\"}]','','','','tr','trt','rtrt','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Tue,Wed\",\"start_time\":\"02:00\",\"start_meridiem\":\"PM\",\"end_time\":\"05:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,'2019-10-16 06:30:25'),
(15,1,10,'Dr','inder','','singh',1,'1977-09-12','[\"indre.docpharm@gmail.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"6534362717\"}]','Permanent','','','726151617','616152425','delhi','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon,Tue,Wed,Thu,Fri,Sat\",\"start_time\":\"09:00\",\"start_meridiem\":\"AM\",\"end_time\":\"05:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,'2019-10-16 14:39:30'),
(16,1,11,'Dr','Inder','','Singh',1,'1978-09-12','[\"inder.docpharm@gmail.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"161717\"}]','Permanent','','','1611525','dmc','delhi','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon,Tue,Wed,Thu,Fri\",\"start_time\":\"09:00\",\"start_meridiem\":\"AM\",\"end_time\":\"07:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,NULL),
(17,1,12,'Dr','Sahil','','Ranjan',1,'1970-01-01','[\"sahilranjan05@gmail.com\"]','[{\"phone_code\":\"+91\",\"phone\":\"1212121212\"}]','Permanent','','','212','344','454','[{\"university\":\"\",\"degree\":\"\",\"passing_year\":\"\"}]','[[{\"day\":\"Mon,Tue,Wed,Thu,Fri,Sat,Sun\",\"start_time\":\"11:00\",\"start_meridiem\":\"AM\",\"end_time\":\"05:00\",\"end_meridiem\":\"PM\",\"duration_time\":\"15\",\"duration_min\":\"Min\"}]]','[\"\"]',NULL,1,NULL,'2019-11-07 06:07:20');

/*Table structure for table `doctor_notes` */

DROP TABLE IF EXISTS `doctor_notes`;

CREATE TABLE `doctor_notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `doctor_notes` */

insert  into `doctor_notes`(`id`,`doctor_id`,`patient_id`,`notes`,`date`,`is_active`,`created`,`modified`) values 
(1,17,15,'dsdsddddw2','08 Nov 2019',NULL,'2019-11-08 05:38:40','2019-11-08 05:38:46');

/*Table structure for table `doctor_timings` */

DROP TABLE IF EXISTS `doctor_timings`;

CREATE TABLE `doctor_timings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `day` varchar(30) DEFAULT NULL,
  `start_time` varchar(20) DEFAULT NULL,
  `start_meridiem` varchar(20) NOT NULL,
  `end_time` varchar(20) DEFAULT NULL,
  `end_meridiem` varchar(20) NOT NULL,
  `duration_time` varchar(20) DEFAULT NULL,
  `duration_min` varchar(20) NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=latin1;

/*Data for the table `doctor_timings` */

insert  into `doctor_timings`(`id`,`doctor_id`,`day`,`start_time`,`start_meridiem`,`end_time`,`end_meridiem`,`duration_time`,`duration_min`,`created`,`modified`) values 
(57,11,'Mon,Wed','01:00','PM','02:00','PM','15','Min','2019-10-14 10:40:45','2019-10-14 10:40:45'),
(58,11,'Mon,Wed','03:00','PM','04:00','PM','30','Min','2019-10-14 10:40:45','2019-10-14 10:40:45'),
(59,11,'Tue,Thu,Sat','01:00','PM','06:00','PM','30','Min','2019-10-14 10:40:45','2019-10-14 10:40:45'),
(63,10,'Mon,Tue,Wed,Thu,Fri','09:00','AM','11:00','AM','15','Min','2019-10-14 12:44:32','2019-10-14 12:44:32'),
(64,10,'Mon,Tue,Wed,Thu,Fri','11:00','AM','07:00','PM','30','Min','2019-10-14 12:44:32','2019-10-14 12:44:32'),
(65,10,'Sat,Sun','11:00','AM','03:00','PM','30','Min','2019-10-14 12:44:32','2019-10-14 12:44:32'),
(66,12,'Mon,Tue','10:00','AM','01:00','PM','30','Min','2019-10-14 13:08:41','2019-10-14 13:08:41'),
(67,12,'Mon,Tue','03:00','PM','05:00','PM','15','Min','2019-10-14 13:08:41','2019-10-14 13:08:41'),
(68,12,'Wed,Thu','06:00','PM','08:00','PM','15','Min','2019-10-14 13:08:41','2019-10-14 13:08:41'),
(69,13,'Mon','01:00','PM','02:00','PM','15','Min','2019-10-16 06:19:06','2019-10-16 06:19:06'),
(71,14,'Tue,Wed','02:00','PM','05:00','PM','15','Min','2019-10-16 06:30:25','2019-10-16 06:30:25'),
(72,15,'Mon,Tue,Wed,Thu,Fri,Sat','09:00','AM','05:00','PM','15','Min','2019-10-16 14:22:24','2019-10-16 14:22:24'),
(73,16,'Mon,Tue,Wed,Thu,Fri','09:00','AM','07:00','PM','15','Min','2019-10-16 14:37:57','2019-10-16 14:37:57'),
(76,17,'Mon,Tue,Wed,Thu,Fri,Sat,Sun','11:00','AM','05:00','PM','15','Min','2019-11-07 06:07:20','2019-11-07 06:07:20');

/*Table structure for table `doctor_visit` */

DROP TABLE IF EXISTS `doctor_visit`;

CREATE TABLE `doctor_visit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `appointment_id` int(11) NOT NULL,
  `observation` text,
  `patient_notes` text,
  `visit_date` varchar(100) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `doctor_visit` */

insert  into `doctor_visit`(`id`,`doctor_id`,`patient_id`,`appointment_id`,`observation`,`patient_notes`,`visit_date`,`is_active`,`created`,`modified`) values 
(2,16,21,21,'','abcd','18 Oct 2019',NULL,NULL,NULL),
(3,17,20,22,'dsdsds','aaa aaaa','07 Nov 2019',NULL,NULL,NULL),
(4,17,15,23,'','dsd','08 Nov 2019',NULL,NULL,NULL),
(5,16,21,25,'headache due to high blood pressure ','make appointment after two weeks','20 Nov 2019',NULL,NULL,NULL),
(6,16,24,26,'','','21 Nov 2019',NULL,NULL,NULL),
(7,16,20,29,'','','04 Dec 2019',NULL,NULL,NULL);

/*Table structure for table `executive` */

DROP TABLE IF EXISTS `executive`;

CREATE TABLE `executive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(22) DEFAULT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `middle_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `gender` varchar(11) DEFAULT NULL,
  `dob` varchar(22) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `phone_code` varchar(11) DEFAULT NULL,
  `phone` varchar(200) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `permission` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT NULL,
  `modified_on` time DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `executive` */

/*Table structure for table `inventory_details` */

DROP TABLE IF EXISTS `inventory_details`;

CREATE TABLE `inventory_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) NOT NULL DEFAULT '1',
  `product_id` int(32) NOT NULL,
  `batch_no` varchar(50) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `qty_available` varchar(100) DEFAULT NULL,
  `expiry_date` varchar(100) DEFAULT NULL,
  `quantity` int(100) DEFAULT NULL,
  `no_of_pack` varchar(100) DEFAULT NULL,
  `location` varchar(100) DEFAULT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

/*Data for the table `inventory_details` */

insert  into `inventory_details`(`id`,`pharmacy_id`,`product_id`,`batch_no`,`unit_price`,`qty_available`,`expiry_date`,`quantity`,`no_of_pack`,`location`,`is_active`,`created_dttm`,`created_by`,`modified_dttm`,`modified_by`) values 
(9,1,10,'ER45',45,'30','12 Aug 2025',30,'3','tbl1',1,'2019-10-09 10:25:34',1,'2019-10-09 10:25:34',1);

/*Table structure for table `manufacturers` */

DROP TABLE IF EXISTS `manufacturers`;

CREATE TABLE `manufacturers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `manufacturer_name` varchar(128) NOT NULL,
  `mfg_logo_url` varchar(512) NOT NULL DEFAULT 'logo',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

/*Data for the table `manufacturers` */

insert  into `manufacturers`(`id`,`manufacturer_name`,`mfg_logo_url`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'Ranbaxy','logo',1,'2019-06-04 10:24:29','2019-06-04 10:24:29'),
(2,'Mankind','logo',1,'2019-06-04 10:51:57','2019-06-04 10:51:57'),
(3,'Cipla','logo',1,'2019-06-04 10:52:44','2019-06-04 10:52:44'),
(4,'Levo','logo',1,'2019-06-04 10:53:47','2019-06-04 10:53:47'),
(5,'Panadol company','logo',1,'2019-06-04 10:55:17','2019-06-04 10:55:17'),
(6,'Sun Pharamx','logo',1,'2019-06-04 10:56:18','2019-06-04 10:56:18'),
(7,'levion','logo',1,'2019-06-04 11:53:50','2019-06-04 11:53:50'),
(8,'fgnjfg','logo',1,'2019-06-19 06:16:30','2019-06-19 06:16:30');

/*Table structure for table `order_details` */

DROP TABLE IF EXISTS `order_details`;

CREATE TABLE `order_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `order_form_id` int(11) NOT NULL,
  `slug` varchar(128) DEFAULT NULL,
  `product_id` int(11) NOT NULL,
  `num_of_pack` int(128) DEFAULT NULL,
  `quantity_ordered` int(255) DEFAULT NULL,
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=latin1;

/*Data for the table `order_details` */

insert  into `order_details`(`id`,`order_form_id`,`slug`,`product_id`,`num_of_pack`,`quantity_ordered`,`created_dttm`,`modified_dttm`) values 
(40,12,NULL,11,NULL,10,'2019-11-20 13:45:32','2019-11-20 13:45:32');

/*Table structure for table `order_form` */

DROP TABLE IF EXISTS `order_form`;

CREATE TABLE `order_form` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) NOT NULL DEFAULT '1',
  `order_date` datetime NOT NULL,
  `order_name` varchar(128) NOT NULL,
  `order_status` int(11) NOT NULL DEFAULT '1',
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL DEFAULT '1',
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL DEFAULT '1',
  `slug` varchar(128) DEFAULT NULL,
  `product_id` varchar(123) DEFAULT NULL,
  `quantity_ordered` varchar(123) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `order_form` */

insert  into `order_form`(`id`,`pharmacy_id`,`order_date`,`order_name`,`order_status`,`is_active`,`created_dttm`,`created_by`,`modified_dttm`,`modified_by`,`slug`,`product_id`,`quantity_ordered`) values 
(12,1,'2019-11-20 13:45:32','new',1,1,'2019-11-20 13:45:32',1,'2019-11-20 13:45:32',1,NULL,NULL,NULL);

/*Table structure for table `patient_details` */

DROP TABLE IF EXISTS `patient_details`;

CREATE TABLE `patient_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) DEFAULT NULL,
  `title` varchar(10) DEFAULT NULL,
  `fname` varchar(50) DEFAULT NULL,
  `mname` varchar(50) DEFAULT NULL,
  `lname` varchar(50) DEFAULT NULL,
  `dob` varchar(50) DEFAULT NULL,
  `guardian_name` varchar(128) DEFAULT NULL,
  `guardian_contact` varchar(128) DEFAULT NULL,
  `relation` varchar(128) DEFAULT NULL,
  `gender` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `m_number` varchar(100) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `notes` text,
  `country` varchar(20) DEFAULT NULL,
  `state` varchar(20) DEFAULT NULL,
  `city` varchar(20) DEFAULT NULL,
  `pincode` varchar(20) DEFAULT NULL,
  `country_code` varchar(30) DEFAULT NULL,
  `allergy` varchar(500) DEFAULT NULL,
  `conditions` varchar(100) DEFAULT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

/*Data for the table `patient_details` */

insert  into `patient_details`(`id`,`clinic_id`,`title`,`fname`,`mname`,`lname`,`dob`,`guardian_name`,`guardian_contact`,`relation`,`gender`,`email`,`m_number`,`address`,`notes`,`country`,`state`,`city`,`pincode`,`country_code`,`allergy`,`conditions`,`created`,`modified`) values 
(15,1,'Mr','fgh','','gh','09 Oct 2019',NULL,NULL,NULL,'Male','swati@unikove.com','6756756767','gjj',NULL,'India','Delhi','Delhi','567567','+91','{629F77FD-53D0-45FF-92DF-8F83C4C1347B}_Paraguay tea,{11EC93DB-AACB-4998-948D-0A48D21B53EB}_Adenosma glutinosum','','2019-10-09 07:45:20','2019-11-08 05:38:30'),
(16,1,'Mr','cbhfgh','','fgfh','01 Jan 2019',NULL,NULL,NULL,'Male','sharda@unikove.com','7989899897','delhi',NULL,'India','Delhi','Delhi','','+91','','fhfgh','2019-10-10 11:19:47','2019-10-10 12:28:00'),
(17,1,'Ms','dsd','dsd','sdsd','01 Oct 2019',NULL,NULL,NULL,'Male','ds@ds.com','2343434','43434',NULL,'','','','','+91','','','2019-10-11 10:51:26','2019-10-11 10:51:26'),
(19,1,'Ms','dddd','','ffff','10 Nov 2019','fhfgh','565687','gjgj','Male','fdf@ASD.COM','32423434','EWEW','','','','','','+91','','','2019-10-11 10:53:15','2019-10-17 12:15:06'),
(20,1,'Ms','bbb','b','b','01 Oct 2019','fghfh','57567','ghjgh','Female','fdf@sd.com','434343','trtrtrt','','','','','','+91','','','2019-10-11 11:01:53','2019-10-17 13:06:53'),
(21,1,'Ms','sharda','','singh','14 Oct 2019',NULL,NULL,NULL,'Female','sharda@unikove.com','9878978978','noida',NULL,'India','Delhi','Delhi','7867','+91','{B3E73EA3-6D1A-425E-82FC-44EDD77C2A98}_Cromolyn and related agents','peanut','2019-10-14 13:10:36','2019-10-14 13:10:36'),
(22,1,'Ms','ssss','','ssss','04 Sep 2008','tyty','56785','yti','Female','jasvdhgv@jj','7897897897','fgh','Notes For test','India','Delhi','Delhi','','+91','{6CEF0646-50E1-4EDF-85B5-8BB25FEC065D}_Resorcinol','Not good','2019-10-15 06:11:31','2019-10-15 07:39:55'),
(23,1,'Mr','G','','Singh','03 Sep 1937',NULL,NULL,NULL,'Male','inderpreet78@hotmail.com','8929339079','E-18 sector 30 Noida','','India','Delhi','Delhi','','+91','','','2019-11-20 13:43:33','2019-11-20 13:43:33'),
(24,1,'Mr','G','','Singh','03 Sep 1937',NULL,NULL,NULL,'Male','inderpreet78@hotmail.com','8929339079','e-18 sector 30 , Noida , U.P.','','','','','','+91','','','2019-11-20 14:21:25','2019-11-20 14:21:25');

/*Table structure for table `patient_prescriptions` */

DROP TABLE IF EXISTS `patient_prescriptions`;

CREATE TABLE `patient_prescriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_visit_id` int(11) NOT NULL,
  `product_guid` varchar(100) DEFAULT NULL,
  `product_name` varchar(100) DEFAULT NULL,
  `product_type` varchar(50) DEFAULT NULL,
  `product_search_by` int(11) NOT NULL DEFAULT '1' COMMENT '"1=>Product","2=>Molecule"',
  `dosage_qty` int(11) DEFAULT NULL,
  `dosage_frequency` varchar(20) DEFAULT NULL,
  `duration_no` int(11) DEFAULT NULL,
  `duration_frequency` varchar(20) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `notes` text,
  `patient_prescription` text,
  `email_status` int(11) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `patient_prescriptions` */

insert  into `patient_prescriptions`(`id`,`doctor_visit_id`,`product_guid`,`product_name`,`product_type`,`product_search_by`,`dosage_qty`,`dosage_frequency`,`duration_no`,`duration_frequency`,`total_qty`,`notes`,`patient_prescription`,`email_status`,`is_active`,`created`,`modified`) values 
(3,2,'{AC340A53-6611-425A-8A75-70E82F00B79C}','paracetamol','TAB',1,NULL,'Daily',7,'Day',28,'','abcd',0,NULL,NULL,NULL),
(4,4,'{95371D01-01C8-441D-A726-0CC8F4224E79}','CROCIN TAB 650mg','TAB',1,NULL,'Daily',2,'Week',42,'dsd','dsd',0,NULL,NULL,NULL),
(5,5,'{560AC113-D713-4B6A-9CC4-58D9070F22B2}','AMLAN TAB 5mg','TAB',1,NULL,'Daily',14,'Day',14,'for blood pressure','make appointment after two weeks',0,NULL,NULL,NULL),
(6,5,'{72D181D0-47DD-41B4-BFAD-0208AEADF696}','LOSARTAS-HT FILM-COATED TAB','FILM-COATED TAB',1,NULL,'Daily',14,'Day',14,'','make appointment after two weeks',0,NULL,NULL,NULL),
(7,5,'{565641D2-6530-4F5A-9E60-6D3CE683DF98}','OMEPRAL CAP 10mg','CAP',1,NULL,'Daily',14,'Day',14,'for stomach','make appointment after two weeks',0,NULL,NULL,NULL),
(8,5,'{715C7D3C-0F20-406B-B5BF-1E310C4CA186}','FEN-TOUCH TRANSDERMAL PATCH 12.5mcg/1hr','TRANSDERMAL PATCH',1,NULL,'',14,'Day',3,'For pain','make appointment after two weeks',1,NULL,NULL,NULL),
(11,6,'{90B634D1-0DFE-49CF-9562-593A20CAD48B}','DYTOR TAB 5mg','INJ',1,NULL,'Daily',7,'Day',7,'','',0,NULL,NULL,NULL),
(12,6,'{90B634D1-0DFE-49CF-9562-593A20CAD48B}','DYTOR TAB 5mg','TAB',1,NULL,'Daily',2,'Day',2,'','',0,NULL,NULL,NULL),
(13,7,'{371FFB94-F897-4647-98BC-01AA72672F47}','CROCIN ORAL SUSP 120mg/5mL','ORAL SUSP',1,NULL,'',3,'Day',1,'','',1,NULL,NULL,NULL);

/*Table structure for table `patient_remarks` */

DROP TABLE IF EXISTS `patient_remarks`;

CREATE TABLE `patient_remarks` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `users_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `remarks` text,
  `is_active` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT CURRENT_TIMESTAMP,
  `modified_dttm` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;

/*Data for the table `patient_remarks` */

insert  into `patient_remarks`(`id`,`users_id`,`patient_id`,`remarks`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,1,15,'',NULL,'2019-10-10 08:18:58','2019-10-10 08:18:58'),
(2,1,16,'htthrh',NULL,'2019-10-10 11:19:47','2019-10-10 11:19:47'),
(3,1,17,'',NULL,'2019-10-11 10:51:26','2019-10-11 10:51:26'),
(4,1,18,'',NULL,'2019-10-11 10:52:58','2019-10-11 10:52:58'),
(5,1,19,'',NULL,'2019-10-11 10:53:15','2019-10-11 10:53:15'),
(6,1,20,'',NULL,'2019-10-11 11:01:53','2019-10-11 11:01:53'),
(7,1,21,'good',NULL,'2019-10-14 13:10:36','2019-10-14 13:10:36'),
(8,5,22,'bad',NULL,'2019-10-15 06:11:31','2019-10-15 06:11:31'),
(9,2,23,'',NULL,'2019-11-20 13:43:34','2019-11-20 13:43:34'),
(10,11,24,'',NULL,'2019-11-20 14:21:25','2019-11-20 14:21:25');

/*Table structure for table `patient_test_reports` */

DROP TABLE IF EXISTS `patient_test_reports`;

CREATE TABLE `patient_test_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_visit_id` int(11) NOT NULL,
  `test_id` int(11) DEFAULT NULL,
  `test_recommended` tinyint(4) DEFAULT NULL,
  `recommended_date` varchar(50) DEFAULT NULL,
  `test_date` varchar(50) DEFAULT NULL,
  `test_notes` text,
  `test_report_filename` varchar(100) DEFAULT NULL,
  `is_active` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `patient_test_reports` */

insert  into `patient_test_reports`(`id`,`doctor_visit_id`,`test_id`,`test_recommended`,`recommended_date`,`test_date`,`test_notes`,`test_report_filename`,`is_active`,`created`,`modified`) values 
(4,2,2,1,'18 Oct 2019',NULL,NULL,NULL,NULL,NULL,NULL),
(7,3,2,1,'07 Nov 2019',NULL,NULL,NULL,NULL,NULL,NULL),
(8,4,2,1,'08 Nov 2019',NULL,NULL,NULL,NULL,NULL,NULL),
(13,5,1,1,'20 Nov 2019',NULL,NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `pharmacy_details` */

DROP TABLE IF EXISTS `pharmacy_details`;

CREATE TABLE `pharmacy_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `clinic_id` int(11) NOT NULL,
  `pharmacy_name` varchar(128) NOT NULL,
  `license_num` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) NOT NULL,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pharmacy_details` */

/*Table structure for table `pharmacy_prescription` */

DROP TABLE IF EXISTS `pharmacy_prescription`;

CREATE TABLE `pharmacy_prescription` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) DEFAULT NULL,
  `patient_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `doctor_prescription_id` int(11) DEFAULT NULL,
  `order_date` datetime DEFAULT NULL,
  `order_amt_before_taxes` double DEFAULT NULL,
  `total_taxes` double DEFAULT NULL,
  `total_order_amt` double DEFAULT NULL,
  `mode_of_payment` int(11) DEFAULT NULL,
  `invoice_number` varchar(100) DEFAULT NULL,
  `order_status` varchar(100) DEFAULT NULL,
  `qr_code` varchar(500) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_dttm` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pharmacy_prescription` */

/*Table structure for table `pharmacy_prescription_order_items` */

DROP TABLE IF EXISTS `pharmacy_prescription_order_items`;

CREATE TABLE `pharmacy_prescription_order_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `prescription_id` int(11) DEFAULT NULL,
  `product_id` int(11) DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `inventory_id` int(11) DEFAULT NULL,
  `expiry_date` varchar(50) DEFAULT NULL,
  `discount` int(11) DEFAULT NULL,
  `unit_price` double DEFAULT NULL,
  `total_price_before_tax` double DEFAULT NULL,
  `taxes` double DEFAULT NULL,
  `total_price_after_tax` double DEFAULT NULL,
  `product_guid` text,
  `product_name` text,
  `product_type` varchar(50) DEFAULT NULL,
  `product_search_by` int(11) NOT NULL DEFAULT '1' COMMENT '"1=>Product","2=>Molecule"',
  `dosage_qty` int(11) DEFAULT NULL,
  `dosage_frequency` varchar(20) DEFAULT NULL,
  `duration_no` int(11) DEFAULT NULL,
  `duration_frequency` varchar(20) DEFAULT NULL,
  `total_qty` int(11) DEFAULT NULL,
  `notes` varchar(500) DEFAULT NULL,
  `day_of_week` varchar(50) DEFAULT NULL,
  `morning` varchar(20) DEFAULT NULL,
  `afternoon` varchar(20) DEFAULT NULL,
  `evening` varchar(20) DEFAULT NULL,
  `dinner` varchar(20) DEFAULT NULL,
  `morning_quantity` varchar(100) DEFAULT NULL,
  `afternoon_quantity` varchar(100) DEFAULT NULL,
  `evening_quantity` varchar(100) DEFAULT NULL,
  `dinner_quantity` varchar(100) DEFAULT NULL,
  `custom_times` text,
  `abbreviation` varchar(200) DEFAULT NULL,
  `abbreviation_meaning` text,
  `unit_price_total` varchar(100) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_dttm` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pharmacy_prescription_order_items` */

/*Table structure for table `pharmacy_users` */

DROP TABLE IF EXISTS `pharmacy_users`;

CREATE TABLE `pharmacy_users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) DEFAULT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `title_id` int(11) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `mobile` varchar(16) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `is_admin` int(11) DEFAULT NULL,
  `is_active` int(11) DEFAULT NULL,
  `created_dttm` datetime DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `modified_dttm` datetime DEFAULT NULL,
  `modified_by` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

/*Data for the table `pharmacy_users` */

/*Table structure for table `prescription_timings` */

DROP TABLE IF EXISTS `prescription_timings`;

CREATE TABLE `prescription_timings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_visit_id` int(11) NOT NULL,
  `prescription_id` int(11) NOT NULL,
  `day_of_week` varchar(50) DEFAULT NULL,
  `morning` varchar(20) DEFAULT NULL,
  `midday` varchar(20) DEFAULT NULL,
  `afternoon` varchar(20) DEFAULT NULL,
  `evening` varchar(20) DEFAULT NULL,
  `dinner` varchar(20) DEFAULT NULL,
  `morning_quantity` varchar(100) DEFAULT NULL,
  `afternoon_quantity` varchar(100) DEFAULT NULL,
  `evening_quantity` varchar(100) DEFAULT NULL,
  `dinner_quantity` varchar(100) DEFAULT NULL,
  `custom_times` text,
  `abbreviation` varchar(200) DEFAULT NULL,
  `abbreviation_meaning` text,
  `is_active` tinyint(4) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;

/*Data for the table `prescription_timings` */

insert  into `prescription_timings`(`id`,`doctor_visit_id`,`prescription_id`,`day_of_week`,`morning`,`midday`,`afternoon`,`evening`,`dinner`,`morning_quantity`,`afternoon_quantity`,`evening_quantity`,`dinner_quantity`,`custom_times`,`abbreviation`,`abbreviation_meaning`,`is_active`,`created`,`modified`) values 
(3,2,3,'','Anytime','','','Anytime','','2','','2','','',NULL,NULL,NULL,NULL,NULL),
(4,4,4,'','Anytime','','','Anytime','','2','','1','','',NULL,NULL,NULL,NULL,NULL),
(5,5,5,'','After','','','','','1','','','','',NULL,NULL,NULL,NULL,NULL),
(6,5,6,'','After','','','','','1','','','','',NULL,NULL,NULL,NULL,NULL),
(7,5,7,'','Before','','','','','1','','','','',NULL,NULL,NULL,NULL,NULL),
(8,5,8,'','','','','','','','','','','[{\"time\":\"12:00\",\"abbreviation\":\"Apply One Patch ONCE every 72 hours \",\"abbreviation_meaning\":\"Apply One Patch ONCE every 72 hours \"}]',NULL,NULL,NULL,NULL,NULL),
(11,6,11,'','After','','','','','1','','','','',NULL,NULL,NULL,NULL,NULL),
(12,6,12,'','Anytime','','','','','1','','','','',NULL,NULL,NULL,NULL,NULL),
(13,7,13,'','','','','','','','','','','[{\"time\":\"12:00\",\"abbreviation\":\"Take 5ml in the morning and 5ml at night\",\"abbreviation_meaning\":\"Take 5ml in the morning and 5ml at night\"}]',NULL,NULL,NULL,NULL,NULL);

/*Table structure for table `product_dosages` */

DROP TABLE IF EXISTS `product_dosages`;

CREATE TABLE `product_dosages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dosages_type` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

/*Data for the table `product_dosages` */

insert  into `product_dosages`(`id`,`dosages_type`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'Tablets',1,'2019-04-16 06:00:40','2019-05-02 11:35:39'),
(2,'Syrups',1,'2019-04-19 04:33:41','2019-05-02 11:35:33'),
(3,'Gel',1,'2019-04-19 04:33:41','2019-05-02 11:35:30'),
(4,'Tube',1,'2019-04-25 10:19:34','2019-04-25 10:19:34'),
(5,'Cream',1,'2019-04-25 10:19:38','2019-04-25 10:20:02'),
(6,'Syringe',1,'2019-04-25 10:20:16','2019-04-25 10:20:16'),
(7,'Capsules',1,'2019-05-10 11:41:42','2019-05-10 11:41:42');

/*Table structure for table `product_type` */

DROP TABLE IF EXISTS `product_type`;

CREATE TABLE `product_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_type_name` varchar(128) NOT NULL,
  `is_active` int(11) NOT NULL,
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `product_type` */

insert  into `product_type`(`id`,`product_type_name`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'Medicines',1,'2019-04-16 05:53:57','2019-04-16 05:54:48'),
(2,'Cosmetics',1,'2019-04-16 05:53:57','2019-04-16 05:53:57');

/*Table structure for table `products` */

DROP TABLE IF EXISTS `products`;

CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pharmacy_id` int(11) NOT NULL DEFAULT '1',
  `product_guid` varchar(100) DEFAULT NULL,
  `product_name` varchar(512) NOT NULL,
  `product_desc` varchar(512) NOT NULL,
  `manufacturer_id` int(11) DEFAULT NULL,
  `product_type_id` int(11) DEFAULT NULL,
  `product_dosage_id` int(11) DEFAULT NULL,
  `qty_alert` int(11) DEFAULT NULL,
  `qty_in_pack` int(11) DEFAULT NULL,
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT '1',
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_by` int(11) DEFAULT '1',
  `is_active` int(11) DEFAULT '1',
  `type` varchar(11) DEFAULT NULL,
  `reason` varchar(128) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=latin1;

/*Data for the table `products` */

insert  into `products`(`id`,`pharmacy_id`,`product_guid`,`product_name`,`product_desc`,`manufacturer_id`,`product_type_id`,`product_dosage_id`,`qty_alert`,`qty_in_pack`,`created_dttm`,`created_by`,`modified_dttm`,`modified_by`,`is_active`,`type`,`reason`) values 
(10,1,'{BA3EFF1A-73FF-4F3B-B5FC-2C83F1DFA2D1}','crocin 1000 tab 1000mg','crocin 1000 tab 1000mg',1,1,1,20,10,'2019-10-09 10:23:39',1,'2019-10-09 10:23:39',1,1,NULL,NULL),
(11,1,'{AB65B69E-3448-44BC-B65B-80A5C5AF1D6F}','CONCOR FILM-COATED TAB 2.5mg','CONCOR FILM-COATED TAB 2.5mg',NULL,NULL,NULL,NULL,NULL,'2019-11-20 13:45:32',1,'2019-11-20 13:45:32',1,1,NULL,NULL);

/*Table structure for table `role_master` */

DROP TABLE IF EXISTS `role_master`;

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `role_type` varchar(50) NOT NULL,
  `role_description` varchar(200) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT NULL,
  `created_dttm` timestamp NULL DEFAULT NULL,
  `modified_dttm` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `role_master` */

insert  into `role_master`(`id`,`role_type`,`role_description`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'Clinic Admin',NULL,0,NULL,NULL),
(2,'Doctor',NULL,0,NULL,NULL),
(3,'Executive Assistant',NULL,0,NULL,NULL),
(4,'Super Admin',NULL,0,NULL,NULL);

/*Table structure for table `test_master` */

DROP TABLE IF EXISTS `test_master`;

CREATE TABLE `test_master` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `test_name` varchar(200) NOT NULL,
  `test_description` varchar(500) NOT NULL,
  `is_active` tinyint(4) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `test_master` */

insert  into `test_master`(`id`,`test_name`,`test_description`,`is_active`,`created`,`modified`) values 
(1,'Stress','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
(2,'Cardiac','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
(3,'ECG','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00'),
(4,'City Scan','',0,'0000-00-00 00:00:00','0000-00-00 00:00:00');

/*Table structure for table `users` */

DROP TABLE IF EXISTS `users`;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `password` varchar(200) NOT NULL,
  `clinic_id` int(11) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `created_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `modified_dttm` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `fk_users_roleid` (`role_id`),
  CONSTRAINT `fk_users_roleid` FOREIGN KEY (`role_id`) REFERENCES `role_master` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

/*Data for the table `users` */

insert  into `users`(`id`,`email`,`password`,`clinic_id`,`role_id`,`is_active`,`created_dttm`,`modified_dttm`) values 
(1,'admin@gmail.com','12345',1,1,1,'2019-10-15 10:11:27','2019-10-15 10:11:27'),
(2,'pharmacy@gmail.com','12345',1,4,1,'2019-10-15 10:11:28','2019-10-15 10:11:28'),
(3,'fgnj@gmail.com','denial',1,2,1,'2019-10-15 10:11:30','2019-10-15 10:11:30'),
(4,'dsdsds@dsd.com','sass',1,2,1,'2019-10-15 10:11:31','2019-10-15 10:11:31'),
(5,'sharda@unikove.com','sharda',1,2,1,'2019-10-15 10:14:46','2019-10-15 10:14:46'),
(6,'ffsdf@sdf.com','fsfd',1,2,1,'2019-10-16 06:19:06','2019-10-16 06:19:06'),
(7,'fdfdf@dsd.com','dsd',1,2,1,'2019-10-16 06:25:51','2019-10-16 06:25:51'),
(8,'fdfdf@dsd.com','dsd',1,2,1,'2019-10-16 06:26:23','2019-10-16 06:26:23'),
(9,'fdfdf@dsd.com','dsd',1,2,1,'2019-10-16 06:27:11','2019-10-16 06:27:11'),
(10,'indre.docpharm@gmail.com','inder',1,2,1,'2019-10-16 14:22:24','2019-10-16 14:22:24'),
(11,'inder.docpharm@gmail.com','Inder',1,2,1,'2019-10-16 14:37:57','2019-10-16 14:37:57'),
(12,'sahilranjan05@gmail.com','Sahil',1,2,1,'2019-10-22 10:03:24','2019-10-22 10:03:24');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

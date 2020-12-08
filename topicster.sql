-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 20, 2020 at 05:59 AM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `topicst1_topicster_main`
--
CREATE DATABASE IF NOT EXISTS `topicst1_topicster_main` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `topicst1_topicster_main`;

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `Status` varchar(100) NOT NULL,
  `UserUrl` varchar(100) NOT NULL,
  `AccountType` varchar(100) NOT NULL,
  `AccountName` varchar(100) NOT NULL,
  `IsVerifyed` varchar(100) NOT NULL,
  `AccountAs` varchar(100) NOT NULL,
  `Bio` text NOT NULL,
  `CreateTime` varchar(100) NOT NULL,
  `UpdateTime` varchar(100) NOT NULL,
  `CreateDtls` text NOT NULL,
  `UpdateDtls` text NOT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` text DEFAULT NULL,
  `StatusReason` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`Status`, `UserUrl`, `AccountType`, `AccountName`, `IsVerifyed`, `AccountAs`, `Bio`, `CreateTime`, `UpdateTime`, `CreateDtls`, `UpdateDtls`, `USetting`, `Setting`, `StatusReason`, `Signature`) VALUES
('¢8ª{2ú?w™$3', 'Ü6€xâXX_Î…‚ò|„Â|/V”Miäp	/zO°Ýo0«Bï¯ý™Ï{', 'XßÎ®DtöÜ—Ôî÷ö`À½', 'bé#Sé\0|E”—Œ5píÄŸëPÇâøúšÂ\ríŠÅ}\r', '²¨Ïq1¸ÙØžé‚F!', 'éJŽÙTh>Ørò»¹ä•', 'f¢€ÍaTž§²ªÙH„ÅÀq\'ûïk_Œ6ËcŸÏ‘ðÜ}1Jåµ»_³ÚLdz¯ïXv[Ø™‹¡6b', '¡­å‚Ž=\'À8cõÀÁ', '»\'ë¿>ÿò	¡5fQÃs+', '¢³hm²qU²Ù4|eÓ˜–ð6ÙF{Ý¼A2:[‡~Á2˜¼Ëô¨T£,Flœr{Ò•v¼!_âkK\0ÀVWE•V	u¯|cKØ}UE™wÅæ÷ém¾=J*¬‹:ã;Åâ€CN‰›¢g¾', '¢³hm²qU²Ù4|eÓ˜–ð6ÙF{Ý¼A2:[‡~Á2˜¼Ëô¨T£,Flœr{Ò•v¼!_âkK\0ÀVWE•V	u¯|cKØ}UE™wÅæ÷ém¾=J*¬‹:ã;Åâ€CN‰›¢g¾', NULL, 'Ìà‚5î®Îµ·ÙÎP•™†±¢³NÝ‡¹Î™‰¦Aí@ç_ÁïÔ§»=ÊŸE,Ã¶ ëµc°Þp‘È‰N\ZHôcœQh`²i^9ê‡Ð¶n6”á¡ÔÕ8ºSc¨µÀÌ\rÁì/îÆa‹ðè~Mj”45+Öüµräm¤ùßq\'M8žZÔ4ŒÙ°ïØ', NULL, NULL),
('¢8ª{2ú?w™$3', 'w\"]¡­£Š3ÞwÀ\'ÓMö‘–Ü%ðÇ»*mW*±çiKÉˆOÞþ–cQN„ÜÏ', '¨†]´½ŠÌQ®$\0^…ó', '`«ÊÕ»U?Ç©´¾•uæ', 'ÆÒf¼Siåg“½ÄkD', '¨†]´½ŠÌQ®$\0^…ó', 'f¢€ÍaTž§²ªÙH„ÅÀ‰Ê}ƒÃ¸Þå”mB\"‚ZYKlá8|nÀ4Ìî€ŽO%u«¯ì†^‡J’‡á˜', '}[º/ö{¦°}‘õgƒñÍ¶', '}[º/ö{¦°}‘õgƒñÍ¶', '¢³hm²qU²Ù4|eÓ˜–ð6ÙF{Ý¼A2:[‡~Á2˜¼Ëô¨T£,Flœr{Ò•v¼!_âkK\0ÀVWE•V	u¯|cKØ}B_“é—ôŒŒ±Ž®~ú A‹:ã;Åâ€CN‰›¢g¾', '¢³hm²qU²Ù4|eÓ˜–ð6ÙF{Ý¼A2:[‡~Á2˜¼Ëô¨T£,Flœr{Ò•v¼!_âkK\0ÀVWE•V	u¯|cKØ}B_“é—ôŒŒ±Ž®~ú A‹:ã;Åâ€CN‰›¢g¾', NULL, 'Ìà‚5î®Îµ·ÙÎP•™†±¢³NÝ‡¹Î™‰¦Aí@ç_ÁïÔ§»=ÊŸE,Ã¶ ëµc°Þp‘È‰N\ZHôcœQh`²i^9ê‡Ð¶n6”á¡ÔÕ8ºSc¨µÀÌ\rÁì/îÆa‹ðè~Mj”45+Öüµräm¤ùßq\'M8žZÔ4ŒÙ°ïØ', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `main_account`
--

CREATE TABLE `main_account` (
  `Status` varchar(100) NOT NULL,
  `UserUrl` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Mobile` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `SocialAccount` text DEFAULT NULL,
  `VerifyedAccount` text DEFAULT NULL,
  `Position` varchar(100) NOT NULL,
  `Profile` varchar(120) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Pincode` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `CreateTime` varchar(100) NOT NULL,
  `UpdateTime` varchar(100) NOT NULL,
  `CreateDtls` text NOT NULL,
  `UpdateDtls` text NOT NULL,
  `OtpData` text DEFAULT NULL,
  `SecurityCode` varchar(300) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `ActiveTime` varchar(100) DEFAULT NULL,
  `LoginTime` varchar(100) DEFAULT NULL,
  `PassUpdateTime` varchar(100) NOT NULL,
  `LoginData` text DEFAULT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` mediumtext DEFAULT NULL,
  `StatusReason` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `main_account`
--

INSERT INTO `main_account` (`Status`, `UserUrl`, `FullName`, `Email`, `Mobile`, `Gender`, `SocialAccount`, `VerifyedAccount`, `Position`, `Profile`, `Address`, `Pincode`, `City`, `State`, `Country`, `CreateTime`, `UpdateTime`, `CreateDtls`, `UpdateDtls`, `OtpData`, `SecurityCode`, `Password`, `ActiveTime`, `LoginTime`, `PassUpdateTime`, `LoginData`, `USetting`, `Setting`, `StatusReason`, `Signature`) VALUES
('¢8ª{2ú?w™$3', 'w\"]¡­£Š3ÞwÀ\'ÓMö‘–Ü%ðÇ»*mW*±çiKÉˆOÞþ–cQN„ÜÏ', '$t»„TG ƒ»5fÈ', 'm‚à\'–¯ø_Ø¹i$¢VÇ#Ô&–nž—¨ävCÑQ', 'Ýcý lÅÈË„}—*D~ªo', 'Qb4U;=„áà%', NULL, NULL, '—†\rÄÍNn*l tF¨', 'w\"]¡­£Š3ÞwÀ\'ÓMö‘–Ü%ðÇ»*mW*±µ{S4LKË4±;j', 'x´³G>’x>’Å¤ü’TõÇº¥áHÊ\r0q ‘ž-', 'z½pu8¶™ÅAJ»ù¾‘', '¼`,P%ÖŠ+?îît;~8', '^‹ƒÛÁÏ×`>¡bø', '@(ÝýwAHŸ¿×`y¹]', '}[º/ö{¦°}‘õgƒñÍ¶', '}[º/ö{¦°}‘õgƒñÍ¶', '¢³hm²qU²Ù4|eÓ˜#|e“È¥§fI%¯¢nd÷ºï%\rßXŸƒ¾,º¥ý^Þº¦Co®µäžÉpMÌHœÇ¦Js&RKaðEN7z¨d‚Ð\0Pfº?|Øë˜ÉÄñÍãÂ’C( ;ª2ŒoÙ\ZWjXïÊ-É)‚S“˜àdðm–’ƒö²ü§ž¢Ò', '¢³hm²qU²Ù4|eÓ˜#|e“È¥§fI%¯¢nd÷ºï%\rßXŸƒ¾,º¥ý^Þº¦Co®µäžÉpMÌHœÇ¦Js&RKaðEN7z¨d‚Ð\0Pfº?|Øë˜ÉÄñÍãÂ’C( ;ª2ŒoÙ\ZWjXïÊ-É)‚S“˜àdðm–’ƒö²ü§ž¢Ò', NULL, '‚Nþ!†³4Y(íË®`h˜’\'ô,ò4ÜW¯¯€˜ôqd­Ø‘Î8N‚l†Ú…T`EBc?ç)&‘ê]o‹:ã;Åâ€CN‰›¢g¾', '™¬îº‰ï;æq…C$-HÃ¬,mÂŽ¶õŸŸÚ€ø;—òHÿBQ Ý\'„èÛuÃ£N\05ÇY–öÔÃ©Zw2¹m‹:ã;Åâ€CN‰›¢g¾', '¿ÊOl´q ?8¾E\'v+ï›', 'ÛÛv¸Z°c¦denà', '}[º/ö{¦°}‘õgƒñÍ¶', '…ÌÇæWZúYÚÓ·Ó.>ûü5ï,ätMK­ÄgÝ³‚„“ÓyµÙ	¤ÇU–/¸ò™‹ÂÑ9»ÎÞðpä0ª›í%¦×!®4ÌQ_eî€»wŽ½§Ð-¿mÑÆZ!&!Éù)bÛÒˆPKŽ>-t¨íD´„Õï§Ç(¥Òo)cu‹Ÿ˜¼Î¸nü×%ÎZÿ-´ì½‰ŒÖýOjÔ†[­–14¾Ù\rÐÈ±‡õáI}î„^€-hz6!v¥ë¼<KÛ ’\n2émŠ®ÏÆÂqð¢¢²êlµïõµ…3€…å¨•Òê/îmˆ~”59k38ä»±˜ÿ	vE+‹º©µá@³åtç:(¥\\Kö&§Ôêï¯MËaË³1x„\\btÕ\ZÇMUò´ùÞ©»|ÖÔï0)?¢©owÀN8˜è­©t¾˜ƒ\rxm.õêm=º^b©S0ˆöR³GLê-†·›†\";ÎCÃ“·	ÓB\\N(KÕsÂ\\š´F\"×É;Ç\rÄ¬HxB.o\r7³fb!Éhµin³šÓ#ˆ	\nÒeÆ9àäôÅ÷ ÖPùVWì:|?Q™°5á€[ÖåÂÇ\Z¯¾!XY¤lÎ†Œ»!yÀ¦3ÝÕ“§þ¡ºÜ7rõ \"1àå6\"0v¿ì-¢-æU|2ûJƒÅ÷%ê´ ˆXm‘ å56xêhm2šèó¶*¾.ÌpýjñÈ]ýÛÛ\\J·OÞ¶iÆk\"`ÃúÎØu¾þZØG<©nåôû¨r6Qi¿4fS•?…Ø3kt*QIŸi2M¾Ÿ›Ç\ZTÊ¦€±t%ÕZùÍ±ðõfxb\\1}Õñwqb:ºÇNa«˜Þ>”ZèTR´OP‰Q Ug•cx[ˆºQŠåž|aŸ^ëÏ©ª~•\n¼Èî1™ €m6¯0¤=Øe§¦ïWB±ÏkY&‹®ÿøœ³j®™$¶ŒÕ¡Ÿ-ó1_Á(ŽÛ!$ÅÔX]Ø©D(\0~ËX–)ôÓýáÒ¾›™‹:êvhèäØm3Bð YµqúÿjØ˜†äžk\nµaÞJ­ýk°pÛ`š›-Â}‘¡U“à¼RR@¤áâŠ ôÐyäúH´VÛèÌ˜ðº³ÂEÜzY®XAYÆY^’Çí×bž›™¿üÁ6R¾ø‡\Z–Øõ\ZctÞ–\Z‰a:>çH¯ØŒ¤›öÜÅ©´z]ª\nÈ*ˆmÿ{_0OUFlu}ê¶ò\"×<\r-e+Ô¿ˆï.Ä1£<RÆ“˜B&§lBF¡æÏ9ü}¿~!,AyêÇö\n³ï5fØ—¼õ£]‡=k3&cR²ŸâÀö—‹/Üd(&3M¥·¯SbL3ëýig£JeL2]¬{Æ¾Þ·vÄ¯1(Ó\Zç!¯1¢\\ÁíêE?~¥¥›8ìBZ]ÍsÒ»öðNzþl¾ND¸³G“±1Z\nP9t/!æomêÓ;ßÚ¦…àÝ\0„aÁSuƒŸ]ŒÍúÄ˜¹%-2«\\¨‰öK¿ßÓÒ»(68;J²wîcw€ãmâŽü†x’oüÉ&‹	Yî\0\0œx¦Î%ÊÝ²M‚ìYVå3í¹Þor3¯ø¨Vf²šãƒ¥µ‹Ôä„~^ø˜³æ@YPÜ¾dÄw™¼ß\\¡|Jßý÷“L¢Ó5†î¥.Â¾›Ooà¿ý$', NULL, NULL, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`AccountName`),
  ADD UNIQUE KEY `UserUrl` (`UserUrl`),
  ADD UNIQUE KEY `USetting` (`USetting`);

--
-- Indexes for table `main_account`
--
ALTER TABLE `main_account`
  ADD PRIMARY KEY (`UserUrl`),
  ADD UNIQUE KEY `Mobile` (`Mobile`),
  ADD UNIQUE KEY `Profile` (`Profile`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `USetting` (`USetting`),
  ADD UNIQUE KEY `Signature` (`Signature`);
--
-- Database: `topicst1_topicster_partner`
--
CREATE DATABASE IF NOT EXISTS `topicst1_topicster_partner` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `topicst1_topicster_partner`;

-- --------------------------------------------------------

--
-- Table structure for table `t850nq1595676899iukhk_t850nq1595676899iukhk_account`
--

CREATE TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_account` (
  `Status` varchar(100) NOT NULL,
  `UserUrl` varchar(100) NOT NULL,
  `FullName` varchar(100) NOT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Mobile` varchar(100) NOT NULL,
  `Gender` varchar(100) NOT NULL,
  `SocialAccount` text DEFAULT NULL,
  `VerifyedAccount` text DEFAULT NULL,
  `Position` varchar(100) NOT NULL,
  `Profile` varchar(120) NOT NULL,
  `Address` varchar(200) NOT NULL,
  `Pincode` varchar(100) NOT NULL,
  `City` varchar(100) NOT NULL,
  `State` varchar(100) NOT NULL,
  `Country` varchar(100) NOT NULL,
  `CreateTime` varchar(100) NOT NULL,
  `UpdateTime` varchar(100) NOT NULL,
  `CreateDtls` text NOT NULL,
  `UpdateDtls` text NOT NULL,
  `OtpData` text DEFAULT NULL,
  `SecurityCode` varchar(300) NOT NULL,
  `Password` varchar(300) NOT NULL,
  `ActiveTime` varchar(100) DEFAULT NULL,
  `LoginTime` varchar(100) DEFAULT NULL,
  `PassUpdateTime` varchar(100) NOT NULL,
  `LoginData` text DEFAULT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` mediumtext DEFAULT NULL,
  `StatusReason` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `t850nq1595676899iukhk_t850nq1595676899iukhk_account`
--

INSERT INTO `t850nq1595676899iukhk_t850nq1595676899iukhk_account` (`Status`, `UserUrl`, `FullName`, `Email`, `Mobile`, `Gender`, `SocialAccount`, `VerifyedAccount`, `Position`, `Profile`, `Address`, `Pincode`, `City`, `State`, `Country`, `CreateTime`, `UpdateTime`, `CreateDtls`, `UpdateDtls`, `OtpData`, `SecurityCode`, `Password`, `ActiveTime`, `LoginTime`, `PassUpdateTime`, `LoginData`, `USetting`, `Setting`, `StatusReason`, `Signature`) VALUES
('¢8ª{2ú?w™$3', 'Ü6€xâXX_Î…‚ò|„Â|/V”Miäp	/zO°Ýo0«Bï¯ý™Ï{', '$t»„TG ƒ»5fÈ', 'bé#Sé\0|E”—Œ5píÄ˜v¹Ögø·^à¢Ñ/¿Ä', 'ñ\0î>ª¨ÏÚD(4cÓ‚¼', 'Qb4U;=„áà%', NULL, NULL, '—†\rÄÍNn*l tF¨', 'Ü6€xâXX_Î…‚ò|„Â|/V”Miäp	/zÝ›Õx>ýòÃ(\'ì<ïR', 'x´³G>’x>’Å¤ü’TõÇº¥áHÊ\r0q ‘ž-', 'z½pu8¶™ÅAJ»ù¾‘', '¼`,P%ÖŠ+?îît;~8', '^‹ƒÛÁÏ×`>¡bø', '@(ÝýwAHŸ¿×`y¹]', '¡­å‚Ž=\'À8cõÀÁ', '¡­å‚Ž=\'À8cõÀÁ', '¢³hm²qU²Ù4|eÓ˜%AÏå1sQª\r[Ô§G%‡Æû·‚&¾ìTqÊûƒ³áõEÓsF€Ïô–•Ç¦Js&RKaðEN7z¨d‚Ð\0Pfº?|Øë˜ÉÄñÍãÂ’C( ;ª2ŒoÙ/“÷å[wkËR³OŠc5ÚƒøÆodÆàK', '¢³hm²qU²Ù4|eÓ˜%AÏå1sQª\r[Ô§G%‡Æû·‚&¾ìTqÊûƒ³áõEÓsF€Ïô–•Ç¦Js&RKaðEN7z¨d‚Ð\0Pfº?|Øë˜ÉÄñÍãÂ’C( ;ª2ŒoÙ/“÷å[wkËR³OŠc5ÚƒøÆodÆàK', NULL, '±_ö[D•Võ9Œ¼\n®`“š¤\n|ïxmÅê‡à\ZI—<€HFbìyÁ„9D%|Ãz_²=-=´•ýæ8QËezDt‹:ã;Åâ€CN‰›¢g¾', 'P–EÖ¢~¹Áº®ÁríŸñ§ƒ ‹>£\\î˜@‰2ÄÅ¬4–Tm)(Š¿’mOî#sn´¸Åê´óÏõ]Wž¿;‹:ã;Åâ€CN‰›¢g¾', 'ÃmñØd/d¤ø9Ì', '¨^QÃÒã_±D†\0]¹«ê', '¡­å‚Ž=\'À8cõÀÁ', '…ÌÇæWZúYÚÓ·Ó.>ûü5ï,ätMK­ÄgÝ$>œéìú*9×\0Øþ#®Ðt·F\0Wj´JŒ*Æ}lb¥\" áU‡¤!yGoáí/Ž¡W\".‰/T\\Œ±œ˜ð4§D0±˜¿lKÛL­ÉŸÙ¦-t¨íD´„Õï§Ç(¥Òo)cu‹Ÿ˜¼Î¸nünA[A[uxpC½?õ\r³5ÀHA‚†B&Xþ:{˜¦©Q7Ì#­Vö1·ƒìô;ßþØ3^\\	“ž±¡ÁŒgú%ÑtgMÉ•¥égõ’ÖŠØcœ3´öiHõÝPg¾£­ÊIÝ¥C2Ž9}Ð˜@z)%˜­dý8Á¯&±{Úçì¨N&<©TÈ³!\ráIªg\rc©ûXèUiBCK`¦,†Üð±Íødv€•Tòê…8œýBò6«³aÔZP|ƒáS¬Ö¦Õ<ìË¾£ÝFâ©n\\ÙÍèø¹çu-¹;@UûFÉé`¥quîN™{2<iÎ®S.ª/‰¶-é¹PòfùYº¼EåÝaü°ÑÌ@E;WðÂ\"	\nÒeÆ9àäôÅ÷ ÖPÆ|`;‰”B%´¢!Nnx¾ó#4Ó*Šì¿	J%¾EAG*Š7þÐ×7æUílQÑ±@2«!X›Á´¿Õ§ÊYª¡3W\'7ä²˜ÃŠ.¸LÎ2ûJƒÅ÷%ê´ ˆXm‘ å56xêhm2šèó¶*¾Û‡®ùã’«‚ŽÚÀA=*{ÔI)‡eÉ›`ëº½m”ää5#æzÓæ™!á\rÿð’L±m˜%f úÄK–ÒŒŠªBzN\\w	®P#	4³¯º@¾–NeÛ#…:“?ÁF­<Ì\04Õf\'¸Zé_ãÊq\\îÝ‘æàéÒšøÎwÖHMœ°ß©8sO£›S³èf^ëÏ©ª~•\n¼Èî1Òf»ÌvµùòŒîl~‘&%\ZñÉéÖZ±ˆrÙƒ‘2Þ=Ü¦ñ,“ªH“j§kInz|i!\0hªåQ„ÄY\0Z2	é<©Gö¬<¯‡‚Êã;­¤¶*iÆ=9úâ<ý×\'.\'t+ÂÁ3ö=Ñ€6¤?F<O%\ZÌ|ç…zw&½9”é¹ã5jÆà#hÞ¦·03¦Ì˜ðº³ÂEÜzY®XAYÆYº7†h31X9mö	k¦Ø½ã¿¥Üèô!=W°-2Ažn—¸×?Ê˜äA¤@D³}ÀÓü®+þn´5»ß\'Ž>3^4eC\'kæKõº}DW5ÃÝ¿ˆï.Ä1£<RÆ“˜B&§lBF¡æÏ9ü}¿~!,eÅºm£~Á\rƒôV+U•Î<°ý¶2ƒð7¸#W­émvtÕWæoº€…»t4ò4ÛBY¢´®äâúe9t#,6Ç;Qc&?þ<Òž&ÕÏGÞT£²ÑOõëhšÕ½ºOáž.šîÊfoVöˆV«B¨ÑÑ-Dä«7=ò¤\Zs]›ÿ–6ÌEø5Ãké±1aÁSuƒŸ]ŒÍúÄ˜¹¾Ð¬\0; Ö§×Š%Ê§û¨Z¿qâ®ä«éS¥,×Â9JØ¨‰a’âÅLÇŠÆ?¹ÍB…†ãÌ2Àúe˜n±Ï¤‹|nzÃšcÖµ0)ÀÇ;FyÏ3 A9síû«3¨sv­žŸ’¬=>ï°ºµ•Úª¶,óËðlmCûM$±ÆpÄÅr', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `t850nq1595676899iukhk_t850nq1595676899iukhk_activity_for_partner`
--

CREATE TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_activity_for_partner` (
  `Status` varchar(100) NOT NULL,
  `ActivityId` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Data` varchar(500) NOT NULL,
  `UData` varchar(500) DEFAULT NULL,
  `ActivityTime` varchar(100) NOT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t850nq1595676899iukhk_t850nq1595676899iukhk_setting`
--

CREATE TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_setting` (
  `Ukey` varchar(400) DEFAULT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `SKey` text DEFAULT NULL,
  `Setting` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t850nq1595676899iukhk_t850nq1595676899iukhk_account`
--
ALTER TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_account`
  ADD PRIMARY KEY (`UserUrl`),
  ADD UNIQUE KEY `Mobile` (`Mobile`),
  ADD UNIQUE KEY `Profile` (`Profile`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `USetting` (`USetting`),
  ADD UNIQUE KEY `Signature` (`Signature`);

--
-- Indexes for table `t850nq1595676899iukhk_t850nq1595676899iukhk_activity_for_partner`
--
ALTER TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_activity_for_partner`
  ADD PRIMARY KEY (`ActivityId`),
  ADD UNIQUE KEY `UData` (`UData`),
  ADD UNIQUE KEY `USetting` (`USetting`),
  ADD UNIQUE KEY `Signature` (`Signature`);

--
-- Indexes for table `t850nq1595676899iukhk_t850nq1595676899iukhk_setting`
--
ALTER TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_setting`
  ADD UNIQUE KEY `Ukey` (`Ukey`),
  ADD UNIQUE KEY `USetting` (`USetting`);
--
-- Database: `topicst1_topicster_post_data`
--
CREATE DATABASE IF NOT EXISTS `topicst1_topicster_post_data` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `topicst1_topicster_post_data`;

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `PostNumber` int(100) NOT NULL,
  `Status` varchar(100) NOT NULL,
  `Url` varchar(500) NOT NULL,
  `FUrl` varchar(500) NOT NULL,
  `Title` text NOT NULL,
  `ModTitle` text NOT NULL,
  `Description` longtext NOT NULL,
  `Keyword` text DEFAULT NULL,
  `PKeyword` text DEFAULT NULL,
  `MetaDescription` text NOT NULL,
  `CreateTime` varchar(100) NOT NULL,
  `UpdateTime` varchar(100) NOT NULL,
  `ViewCount` varchar(100) NOT NULL,
  `CommentCount` varchar(100) NOT NULL,
  `ShareCount` varchar(100) NOT NULL,
  `ImageCount` varchar(100) NOT NULL,
  `VideoCount` varchar(100) NOT NULL,
  `WatchTime` varchar(100) NOT NULL,
  `LinkCount` varchar(100) NOT NULL,
  `InternalLinkCount` varchar(100) NOT NULL,
  `InternalLinkForSelf` varchar(100) NOT NULL,
  `InternalLinkForOther` varchar(100) NOT NULL,
  `ExternalLinkCount` varchar(100) NOT NULL,
  `Ranking` varchar(100) NOT NULL,
  `Performance` varchar(100) NOT NULL,
  `DefinedWatchTime` varchar(100) NOT NULL,
  `UniqueViews` varchar(100) NOT NULL,
  `VerifyedViews` varchar(100) NOT NULL,
  `LikeCount` varchar(100) NOT NULL,
  `DislikeCount` varchar(100) NOT NULL,
  `ReportCount` varchar(100) NOT NULL,
  `Author` varchar(100) NOT NULL,
  `Category` text NOT NULL,
  `ImageUrl` text DEFAULT NULL,
  `MediaFilePath` varchar(200) NOT NULL,
  `ShowAdCount` varchar(100) NOT NULL,
  `RequestAdCount` varchar(100) NOT NULL,
  `ClickAdCount` varchar(100) NOT NULL,
  `Revenue` varchar(100) NOT NULL,
  `AgeRestriction` varchar(100) NOT NULL,
  `BestForGender` varchar(100) NOT NULL,
  `SubscriberGainOrDrop` varchar(100) NOT NULL,
  `DonateAmount` varchar(100) NOT NULL,
  `Availability` varchar(100) NOT NULL,
  `Price` varchar(100) NOT NULL,
  `PublishTime` varchar(100) NOT NULL,
  `StatusReason` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`PostNumber`, `Status`, `Url`, `FUrl`, `Title`, `ModTitle`, `Description`, `Keyword`, `PKeyword`, `MetaDescription`, `CreateTime`, `UpdateTime`, `ViewCount`, `CommentCount`, `ShareCount`, `ImageCount`, `VideoCount`, `WatchTime`, `LinkCount`, `InternalLinkCount`, `InternalLinkForSelf`, `InternalLinkForOther`, `ExternalLinkCount`, `Ranking`, `Performance`, `DefinedWatchTime`, `UniqueViews`, `VerifyedViews`, `LikeCount`, `DislikeCount`, `ReportCount`, `Author`, `Category`, `ImageUrl`, `MediaFilePath`, `ShowAdCount`, `RequestAdCount`, `ClickAdCount`, `Revenue`, `AgeRestriction`, `BestForGender`, `SubscriberGainOrDrop`, `DonateAmount`, `Availability`, `Price`, `PublishTime`, `StatusReason`, `Signature`) VALUES
(2, 'tá0H…¡Zû¨8Hs^z', '.#ôâýö\nEw!¯ZÉ¢å', 'Z ÿA2:á¡•‰g×ÏÔõ-F%_ÍƒlDâå D¼Ã˜â%`n$‰×%Ë³‘=‘oWxv*ÑxJ‹ùZ‹:ã;Åâ€CN‰›¢g¾', '¸]îvé}¥±zÊ\rÂè«Š§ß¡žŽ	ÚÊ×úø}hˆ', '¸]îvé}¥±zÊ\rÂè«Š§ß¡žŽ	ÚÊ×úø}hˆ', 'ès®ï¿Ë\\UÙˆU‘lé”j¬O¦½o½ÖËå—Zæ$ÒRBç`²\\\\M¡+nyUÖ\nbgÔëE•l¤k¡Q}íÏºÓša¯ÛN Y¾’ö#ì¿ì”ð=3 ù	„`ùcå›´ŠšŠæ?×çéŽt|b¾&öUïXi´ßÃ˜¾ó´IÌ°wƒ°í P8r²×·\nÀwð½@²y³ð¦0ðwç2ÈK€wÊ\'5~Jaüò”æÔôV¨Üù¤ \r*x¯J‰²ÓïU«ð¥ñÍ]œ—þºI™ÀÑëóÎÃ$±máÉÍ¨—cQKyó‘ëÅîª\'€ËÈ0×üz|Ï¸Üð \nQ¯µÃdŸ“{!2åñ\0¨®Ð@ÄüVÆ—}$~›‡V‰Ê(…`ØÉ>Ùæ##\Z\r°>eå³Ïß¯8#\0V‹(•)Îv3„Æü»Ì`¥u^(yLPÒc—wØ\'™!ÞÛ¡ßçB;á6ÄY\ZtŒgý|M¢·3‚í	Î¤\Z“ñN~8y;ÍÊû¥õj³õ÷¦\'lµü¾š3‚´[öŽPQC\nEZ¶u}—)Ý¦|È–jI)nyUÖ\nbgÔëE•l¤k¡¼µòËÌ7ÛÙÖ£ÊôÓÔUd„âß¼q§›¬Šêà´VU«;eŸ‘ÿ@Ž`BË2Áà~©×5(Lk­MHª{ÿ³‚t9æ$YõTƒâîcËOà@eR/ÛH6-ÀdLOj+!§¦ù8\n·\Z¼¨2¦;OÐmQoT¹&ëê†LõŸ’#ØÆ÷×:UÚ1¶vû.ó]ó_|òÏ´ K¹ÍÙtô|ËøÅ™z\'ÁnØ¯ÆSB«gjÚ#æéùá[•»Å©gGRTE»4£Ú8æÍøkO2«A~‚æALøûÆÆxÏ¦H“JWÈ0ì‘âŽ¬Î-\"¢®BÂ¤|üý°#wÆ’!zÑ¶0q@à°•Z\\JVö#hÜZzF&\rú Þ¹ÏxZ\0%“ú®a/à­BFð’Ý\'’¤†U9zU‰Í¤îs‹tš8kk¯í¯Ë7…0%eGðHµrv›Ò–\rÔŠ—WÀÿë¡%²ÌØÇàUÏëÔžÛ½ÏÇÜ1pêqçª‰¦Ë_‡Ò<Ãdà1Û¾ðH…` ­L]T2:–Ç	fÙ’pmÍk«[GûJë’]\Zþ…-úè^w–*-$µÿû¨8ÀPn1Ôê„¾9îÚÛCÌÚšv|à$\Zª`…du{ãZ¸‹fŠ\r	 <x—k“;¢i‚åø$çøÀªXlRŽUÈXw	Œ\r%nj;=>#Ê¶…PÔ’\0‹A$ŽéÅjÊ’‹mñ8¾ògEë6î™i§¤ÆGpŸ„µP“­õ“2¼7ˆ³ˆ„ÀPìCÈŒÍKª¿¨_Êê;ÌËä¨òè¿²`ÁÜ9@:Àêé ÎÕ€ÚH:æà¦é„\n±òàn>Ú‚a`?ºä,ö5\'\nz„Ôÿ–p‚.AG-37è:EO¶:c¹´%„úÇ7Ñ˜£sßbAÜ¼ÄÝC¾ÔWÞSjŠE£\n®:EÌX¿þ\\Câ8%ú›èËk¦€9 pûK•t,÷iÛçQ;×ír0M_k˜–ô~ãw¶®\nÍ’ç>ƒåœüª€´´“7ÎTæbŠŒbP×—+VIú¥….5“TÒ¼RÍ8Ü U:¡§ilÝEómd½]h÷”’Wóe¬ù9ýÛlëzžiwùÓòx%v¦àëŸ·ÑoYM	ásÛ?ïŠò™TGFÖn>Ú‚a`?ºä,ö5\'\nz;PUÄ˜\"Ã±b‡éíU1oySóß·.QGfÕfÌÓÏ‹­EºfŠQ}ã uØï`ž•1™.èÜ“Ÿ7oDD|”‘äç­ºYÉdSâù‘às«ø‡éQ†•L_\'+¤þ]lNþÍÍë#6P=§%¡\nm!Þ„@éÂÚýÝ¼ã:¸«YÙž¨ÈâfšˆÜRõK‹!(6ÁYû ÎÀÖ«36!„O¦ì[&ß[ìé67ºË7O1èCû¥ áïßMuþ’ïÝÄc\n§íeQ“9ää\'¯¦ž¼˜Dl8Wt×;8£ä2¼†€\Z_;N0g0¶†¶ÇÝòŽG7uSÝ\"\0¥´ù%8FTÃ{¡Ë÷*?›]QÒ-†Ô›—g9\Z= Wý…S¼;šØ¼ÂË­‘h†<DØ‰\0>À’T½wKá—S‹ÿ›Á9ŠD[KÄŒ\Z2ËL°ÃŽ1ÃÔ	†\\5ûÎIV“S“ß	#™õèç€±Dé]þg‚Ñ†i–¤ü¡(œ;XIÊ¤m{Š—Ìž§È¸¾1º¢ñžõ….e»o0i<wßL¿½êæóüX\'ÏZË‡NÈŒpæ3+™7E¿ÍiÚ”üîÃÈxÓ þŽC±ÿ”ÎÌ¼-ÙYy%ÄÈÀ!YXyfÄÍùèbI.Ža&Ò«×Züëk‡­‘HÚ9×^ AH5“¾§Ü²P{†DÛ8±pÝ®Gùr_ÁO˜-©l›\n;?%Þþ¬²`p_ÌÔFRËµ%¹/V_(k÷Þw¤„X\"\rfÃ²hêG;Ü¢¦týµ<‹:ã;Åâ€CN‰›¢g¾', '±½øgŠìÚz*€ôÉ^æ\\«ŒDZf|TN}*¤ªÞŒ„|OÂ&œÈ½·‡þ\rþf±Õœ]ƒ)F:Í	ÈÝdŽp:³÷VŽWiìëaÉÛLEUAÌ-™ì•½L]5¨Ô)/óÊh÷â,O¢c\"øœŠéƒ)\'OXUZãCüC·±X•eiv-P×ü‰9–nžd\"U(Élüövîo‘ Í8±<E{Ìó62%vé', '°ù³lý$¢_:zwIÄÅ0', '‡lælÁMwÂËN¼ÐŽÓbQ}íÏºÓša¯ÛN Y¾’ö#ì¿ì”ð=3 ù	„`ùcå›´ŠšŠæ?×çéŽt|b¾&öUïXi´ßÃ˜¾ó´IÌ°wƒ°í P8VÃ\Z¿ÂÎÐé¢ò;\rÃŒÊ¡“€Èà”K?‚u”ƒûá‘É™!â ôKDf¸	¶áBË»¡án²•Ø‘¬ë‰FqÓ&ý“å¨qC•Á°¹d°!	>eu”â³ •hÄ\"O:¾×›^V˜–ÆRŠAÜ×\Z¡JÛ©\Zt1RÒ@=ìUÑÂã\0‘‡yäFé;Acè« m­ßeƒw!\"ÜÏ¹Š\rÚ­_ÞãÅ\\¦1K4ŒÁü‰e_Ãq€`n»ƒþl(.t¨åŽvR³jÁ`vÓì«ƒ:yYŠv…~©îðRÿ=vØÞmý7YsOGÅ¤¦K,3éûRãØ¥wcœÍø¢§Ùk]4JV$ËÚêýÂ@œd·³ Éæe®ÓGKl¾ÙM£C€[± ä!\':/c’üO¢-ÏÃ¶hja!/tJÇmž-\0aqtPÀéjšÅ°ûÞ¬RðeÉçß#×X‰‚ ª˜}Þp¨$J;¬NÃßšx—’w|Ýg Áÿ…}f½{±GáÚVºÎ¶W¬ƒIooûq$öðzÏ)ÿŠ.9õÛ¤ylZÌ/2ÞŽ˜Ø¬·”.{Ô¨»J©ä.ÚXE—G&ÖìöwÿÈ³²~', '+=Šý{Ur–ç±À¥wˆÒ', 'ðÕ­ì˜As²:Ø1Ó’¦É', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', 'Æ+´àßÈ,mØM³Œ¾á', 'Æ+´àßÈ,mØM³Œ¾á', '0ÈØ6i2D„rR¯z`‚', '	ÛÂˆ¿õ&¥’s\nË', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '	ÛÂˆ¿õ&¥’s\nË', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', 'Æ+´àßÈ,mØM³Œ¾á', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', 'Ü6€xâXX_Î…‚ò|„Â|/V”Miäp	/zO°Ýo0«Bï¯ý™Ï{', 'ñ<{:¾*Ì >óòš9)ƒü‚ô£¤»çØJ¹¤í^”á', 'óäñ`IÁª•«ü˜õëOÙ8ëw§0¯°ÂÃ)ðvg[Ò`XÖZÎcsÝš¼……:â\rB$ù¥Ý‹â”^ö º8á[„]™dÛæ©¨Ÿ+Îjé¤hè¡pßX¦–GfÝI&ûäŒi‰‹È&VîÞY ¢®£4ø¼)‘ßÐ0&ãZ0^ØzÝYu', 'bé#Sé\0|E”—Œ5píÄî=\"\ncrÐ‡\\ÏªMBÌatþ¢\nAZÐz‘§É´¯', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '0ÈØ6i2D„rR¯z`‚', '7à0<XJ´+ÉñÔ,', '0ÈØ6i2D„rR¯z`‚', 'ðÕ­ì˜As²:Ø1Ó’¦É', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`Url`(100)),
  ADD UNIQUE KEY `FUrl` (`FUrl`),
  ADD UNIQUE KEY `MediaFilePath` (`MediaFilePath`),
  ADD UNIQUE KEY `PostNumber` (`PostNumber`) USING BTREE,
  ADD UNIQUE KEY `Signature` (`Signature`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `PostNumber` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- Database: `topicst1_topicster_user_activity`
--
CREATE DATABASE IF NOT EXISTS `topicst1_topicster_user_activity` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `topicst1_topicster_user_activity`;

-- --------------------------------------------------------

--
-- Table structure for table `t21lnu1594009894j5kks_t21lnu1594009894j5kks_activity`
--

CREATE TABLE `t21lnu1594009894j5kks_t21lnu1594009894j5kks_activity` (
  `Status` varchar(100) NOT NULL,
  `ActivityId` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Data` varchar(500) NOT NULL,
  `UData` varchar(500) DEFAULT NULL,
  `ActivityTime` varchar(100) NOT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `t850nq1595676899iukhk_t850nq1595676899iukhk_activity`
--

CREATE TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_activity` (
  `Status` varchar(100) NOT NULL,
  `ActivityId` varchar(100) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Data` varchar(500) NOT NULL,
  `UData` varchar(500) DEFAULT NULL,
  `ActivityTime` varchar(100) NOT NULL,
  `USetting` varchar(600) DEFAULT NULL,
  `Setting` text DEFAULT NULL,
  `Signature` varchar(300) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t21lnu1594009894j5kks_t21lnu1594009894j5kks_activity`
--
ALTER TABLE `t21lnu1594009894j5kks_t21lnu1594009894j5kks_activity`
  ADD PRIMARY KEY (`ActivityId`),
  ADD UNIQUE KEY `UData` (`UData`),
  ADD UNIQUE KEY `USetting` (`USetting`),
  ADD UNIQUE KEY `Signature` (`Signature`);

--
-- Indexes for table `t850nq1595676899iukhk_t850nq1595676899iukhk_activity`
--
ALTER TABLE `t850nq1595676899iukhk_t850nq1595676899iukhk_activity`
  ADD PRIMARY KEY (`ActivityId`),
  ADD UNIQUE KEY `UData` (`UData`),
  ADD UNIQUE KEY `USetting` (`USetting`),
  ADD UNIQUE KEY `Signature` (`Signature`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

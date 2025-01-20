-- phpMyAdmin SQL Dump
-- version 5.2.1deb1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jan 05, 2025 at 06:29 PM
-- Server version: 10.11.6-MariaDB-0+deb12u1
-- PHP Version: 8.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `projet`
--

-- --------------------------------------------------------

--
-- Table structure for table `grille`
--

CREATE TABLE `grille` (
  `id_grille` int(20) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `difficulté` enum('facile','moyen','difficile') NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` varchar(500) NOT NULL,
  `estimated_time` int(20) NOT NULL,
  `width` int(10) NOT NULL,
  `height` int(10) NOT NULL,
  `case_noire` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`case_noire`)),
  `clues` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`clues`)),
  `solutions` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`solutions`)),
  `date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `grille`
--

INSERT INTO `grille` (`id_grille`, `id_user`, `difficulté`, `nom`, `description`, `estimated_time`, `width`, `height`, `case_noire`, `clues`, `solutions`, `date`) VALUES
(8, 'raid_br', 'moyen', 'Test Grid', 'This is a test description.', 45, 5, 5, '[{\"x\":1,\"y\":1},{\"x\":2,\"y\":2}]', '{\"horizontal-1-1\":\"clue1\",\"vertical-1-1\":\"clue2\"}', '{\"solution-1\":\"answer\"}', '2024-12-30'),
(9, 'raid_br', 'facile', 'zef', 'zefzf', 42, 5, 5, '[{\"x\":\"4\",\"y\":\"1\"},{\"x\":\"3\",\"y\":\"2\"}]', '{\"horizontal-1-1\":\"zefazfezaf\",\"horizontal-2-1\":\"zefazefazefza\",\"horizontal-2-2\":\"zef\",\"horizontal-3-1\":\"azefazefazefazf\",\"horizontal-4-1\":\"zefazefazefzefaz\",\"horizontal-5-1\":\"zef\",\"vertical-1-1\":\"zef\",\"vertical-2-1\":\"zef\",\"vertical-3-1\":\"zef\",\"vertical-4-1\":\"zef\",\"vertical-5-1\":\"zef\"}', '{\"horizontal-1-1\":\"ZEJ\",\"horizontal-2-1\":\"GF\",\"horizontal-2-2\":\"EZ\",\"horizontal-3-1\":\"UFTZU\",\"horizontal-4-1\":\"FZFEF\",\"horizontal-5-1\":\"IUTEF\",\"vertical-1-1\":\"ZGUFI\",\"vertical-2-1\":\"EFFZU\",\"vertical-3-1\":\"TFT\",\"vertical-4-1\":\"EZEE\",\"vertical-5-1\":\"GZUFF\"}', '2025-01-04'),
(12, 'raid_br', 'difficile', 'lw1', 'test de la grille LW1', 62, 10, 10, '[{\"x\":\"5\",\"y\":\"2\"},{\"x\":\"2\",\"y\":\"3\"},{\"x\":\"5\",\"y\":\"3\"},{\"x\":\"8\",\"y\":\"4\"},{\"x\":\"5\",\"y\":\"5\"},{\"x\":\"10\",\"y\":\"5\"},{\"x\":\"4\",\"y\":\"6\"},{\"x\":\"5\",\"y\":\"6\"},{\"x\":\"3\",\"y\":\"7\"},{\"x\":\"6\",\"y\":\"9\"},{\"x\":\"7\",\"y\":\"9\"},{\"x\":\"9\",\"y\":\"9\"},{\"x\":\"2\",\"y\":\"10\"}]', '{\"horizontal-1-1\":\"outils des astronomes\",\"horizontal-2-1\":\"Louis XIV\",\"horizontal-2-2\":\"chasseur equatorial\",\"horizontal-3-1\":\"que se soit le dieu ou le metal\",\"horizontal-3-2\":\"sam ou tom\",\"horizontal-4-1\":\"porteuse de message celeste\",\"horizontal-4-2\":\"A une liaison avec jupitere\",\"horizontal-5-1\":\"Aurochs\",\"horizontal-5-2\":\"bout de bois\",\"horizontal-6-1\":\"Court\",\"horizontal-6-2\":\"Religieuse\",\"horizontal-7-1\":\"A la mode\",\"horizontal-7-2\":\"Technique utilis\\u00e9e par les virtuoses\",\"horizontal-8-1\":\"petits ensemble\",\"horizontal-9-1\":\"local industriel\",\"horizontal-10-1\":\"nord de l\'italie\",\"vertical-1-1\":\"telle notre bonne viellie plan\\u00e8te\",\"vertical-2-1\":\"les astronomes sont \\u00e0 sa recherche\",\"vertical-2-2\":\"le cadre d\'Hershel\",\"vertical-3-1\":\"Brouillent la vision\",\"vertical-3-2\":\"Odeur m\\u00e9ridionale\",\"vertical-4-1\":\"pour \\u00e9viter le ciel tombe\",\"vertical-4-2\":\"en moravie\",\"vertical-5-1\":\"article\",\"vertical-6-1\":\"Bor\\u00e9al\",\"vertical-7-1\":\"D\\u00e9odorant\",\"vertical-8-1\":\"astronomie fran\\u00e7aise\",\"vertical-8-2\":\"instruments astronomiques\",\"vertical-9-1\":\"pour faire avec du vent\",\"vertical-10-1\":\"quatre coins de la rose\",\"vertical-10-2\":\"gamin d\\u00e9sordonn\\u00e9\"}', '{\"horizontal-1-1\":\"18cfbe30664d50818caa17f99ad9ffbe8862e9e6b666d8a914f58043db825f3f\",\"horizontal-2-1\":\"071b80bfa423735d18a4da41c7ba53ed6349d04f53cf3dee370fdf30c7201ce6\",\"horizontal-2-2\":\"6723598ceda1f26f2031670089d57ed9c7f57fdfa7393106a5c045fd05d403a8\",\"horizontal-3-1\":\"5a4afafd041a19c69699cda107fd5f2f860b54b455778937b505ffced0d7bc32\",\"horizontal-3-2\":\"218cedb8be0f4ef7528afdc7c9c5e3827ecc37756082c0f343a49e55a30832e8\",\"horizontal-4-1\":\"557022315efe45d6e46855aca3df5cc44d1d10c13c63a638daf6794fea8105cb\",\"horizontal-4-2\":\"1295b0b84cea614a9331304f55324ef70d6392a177dfdbe9612800fc6148eb9d\",\"horizontal-5-1\":\"3494a3424bc742f89e7279aa980aa74dcfba2c2463468b5796fe877df97d4711\",\"horizontal-5-2\":\"1023fa56ab54bbf9b044810ea3fb2fedb8d430f20392ef33edbd06f44034db7e\",\"horizontal-6-1\":\"8a84fd359f8103230fb6d3f16f55a4c077bf1813b828216da3b1bd3272326774\",\"horizontal-6-2\":\"ae49f2526a61715e24daaa18964e1f4593856d925425c732b29dee9c79630dbb\",\"horizontal-7-1\":\"fed1d872f6d540f4118582ec694270274e987b12f5dfe2057dddf1e12df2761a\",\"horizontal-7-2\":\"22b74f8644d2652560616165c9b1a66dcc1ee582aa3f8b12140260500b3564cc\",\"horizontal-8-1\":\"3d63a8e93298e83fc021eb1e627a2f7b94fc7bef93a1059db6d34e6a0aff14d1\",\"horizontal-9-1\":\"7c00aefa7914031a3a3de6e61a82a8e95555dffebb9a28397ba8cddabaa3ecd8\",\"horizontal-10-1\":\"7eacfbfa31be018257065d97400f096b937790fc98a7d7c909c8a9417afedc69\",\"vertical-1-1\":\"c137fa9421a19577006c40db2db375d512e01c553ef0ebc07b12304f6113cf9c\",\"vertical-2-1\":\"a61555e7cf631236a3a2befa0d7048a735a5e732f4ed997cfe9eeb477ac2b823\",\"vertical-2-2\":\"7a110b56f6ace355e223da5ec85337745f2eefd87c35411f1d82716bf2fea9ef\",\"vertical-3-1\":\"80eb258d5065bea0994a914568dfe23ee746af42d7ba58c6eca74ed048e5ad88\",\"vertical-3-2\":\"f4caf7286f8a4186668e387f6dabba7e21099dca67fd0dbf3e8cae473ba171da\",\"vertical-4-1\":\"b3e76b8de61b06bfc88bbfdaba6779a97ad3dc7a487d3c66c6a025bd30848d15\",\"vertical-4-2\":\"7280f90c79d507047728a55789e96608b03b3963f690155508a76bb753b45a60\",\"vertical-5-1\":\"8550f340539484c0a7d9425bd20e5bfe51e0c49b123d04ca527614b250880953\",\"vertical-6-1\":\"d6987084d4a5596f45aa004a0809189c041511bb70d46034e4560f95374d18cc\",\"vertical-7-1\":\"851c5ea4af5dfbd23d20f1bff80946674ecc7c065c73c3b8958b99f4a3925f25\",\"vertical-8-1\":\"5195eed19619a3dd6b18c6e328de46ee57a8db731582a49c4f7f6222d9d130d3\",\"vertical-8-2\":\"27a53f53404c63f30d01bc893e84a469c466a9056ef085f266661d924be3bbd0\",\"vertical-9-1\":\"11bbf89b71b28189e6bfb9234db29a635c4ee7282be19a1cc90b212fe77c380a\",\"vertical-10-1\":\"d7d1c0a5f0968260174f3e6d4a83d63c9516dbb1772c63eddc74575df622f9b9\",\"vertical-10-2\":\"9fff8d04b71dd6c275f4785ea1c7de2b4ca43aa8c680975a02677c810092fa51\"}', '2025-01-04'),
(13, 'raid_br', 'difficile', 'qrfzerf', 'zef', 73, 5, 5, '[{\"x\":\"1\",\"y\":\"2\"},{\"x\":\"3\",\"y\":\"3\"}]', '{\"horizontal-1-1\":\"outils des astronomes\",\"horizontal-2-1\":\"Louis XIV\",\"horizontal-3-1\":\"que se soit le dieu ou le metal\",\"horizontal-3-2\":\"sam ou tom\",\"horizontal-4-1\":\"porteuse de message celeste\",\"horizontal-5-1\":\"Aurochs\",\"vertical-1-1\":\"telle notre bonne viellie plan\\u00e8te\",\"vertical-2-1\":\"les astronomes sont \\u00e0 sa recherche\",\"vertical-3-1\":\"Brouillent la vision\",\"vertical-3-2\":\"Odeur m\\u00e9ridionale\",\"vertical-4-1\":\"pour \\u00e9viter le ciel tombe\",\"vertical-5-1\":\"article\"}', '{\"horizontal-1-1\":\"90a449b19c90470a0370eb9cd2d0cdff3fbab40f1b7aa37c26993b64372599e3\",\"horizontal-2-1\":\"4631f13009bd6427eac2c4c77cce10469a2f552763331de26d12f9402601e10e\",\"horizontal-3-1\":\"2097d9edbebf7ccc834ac87b2bf4f2b871908a7f8ef80b35a8608cbb08e0ce07\",\"horizontal-3-2\":\"c0f9080ce75406997b07e7adb23dc218ca0bc7a810df83f9b59b98132696409c\",\"horizontal-4-1\":\"7cd9091db275484fd204c83a221bca403e051f68539feb0fdb91923094d45f7f\",\"horizontal-5-1\":\"cf9bd5aad89fd5f0dcc16c635bc7fbcb5cd9af39fb649a245e8d07a14932fea2\",\"vertical-1-1\":\"febfe9b049de62b398b751e4fa738d3e3d3b906e0d584fc921f9fc3bb980ac14\",\"vertical-2-1\":\"ba6246cbf8bab372887deae199deae556485014baf19e9ab1b318a4c40720811\",\"vertical-3-1\":\"68915d5a1b08021e1fbbcdfa910e526c6c87c414972e55c4419bd336b1d32e80\",\"vertical-3-2\":\"60547bd9ab11c5459a6fffa441ed70d662c73f05c37822da5f3a653f95a9d2a4\",\"vertical-4-1\":\"a08a23582c3e03e502d1ecf690a46d9a785c59fb29aeea3cc506cda8b8cd4781\",\"vertical-5-1\":\"80359500daa3bdfc5e1ccd596607a2ec7746d544346d64dc58e1d05d420612b7\"}', '2025-01-04'),
(17, 'raid_br', 'difficile', 'qsd', 'qsdf', 3, 10, 8, '[{\"x\":\"1\",\"y\":\"1\"},{\"x\":\"9\",\"y\":\"4\"},{\"x\":\"5\",\"y\":\"5\"}]', '{\"1.1\":\"qsdf\",\"2.1\":\"kl\",\"3.1\":\"kl\",\"4.1\":\"kl\",\"5.1\":\"k\",\"5.2\":\"lk\",\"6.1\":\"lk\",\"7.1\":\"lk\",\"8.1\":\"lk\",\"A.1\":\"lk\",\"B.1\":\"l\",\"C.1\":\"kl\",\"D.1\":\"kl\",\"E.1\":\"kl\",\"E.2\":\"k\",\"F.1\":\"lk\",\"G.1\":\"lk\",\"H.1\":\"lk\",\"I.1\":\"l\",\"I.2\":\"kl\",\"J.1\":\"kl\"}', '{\"1.1\":\"5a5dfe7c48aec62c7aec3c77f11cd4f3160b2ff89045e0d759d49aacead9d31f\",\"2.1\":\"2e264dc8259fa9c81a572112f0e5caabf2874c7b23111b5dcdd3ccf1cb92118a\",\"3.1\":\"f02aa7412088a3efa53ec8a0991d69e3da4886bdd4ff9a79628ff098dcb4ad10\",\"4.1\":\"d78efee2b1d031df33890bd1f8270fb290113648e8394c301a3c0f54a4c07e37\",\"5.1\":\"e355bbe0808f068b6adb05a1b8f6d5c9a5a622d3ada3cf6ed2d797281f0cfe48\",\"5.2\":\"92e0a6ee21ce501e9d4bd025518adf5d6add7caa29b31704bd595c14d3d2d665\",\"6.1\":\"ab70d288ea90492ee2c9e8618d2b1109f06296f08a334193a4fa3605dd6676cf\",\"7.1\":\"22794d44753aad3e78171af53369eb24dc3e98702f2bf19cb0b5feaa2b9205d1\",\"8.1\":\"7676325b5220a7e815c0cb532aa974cb192842e56d1e1969783adb883289e5f4\",\"A.1\":\"ffc3077bb38740dc767b6eb87864f5202fbb707e2adbb58c4256d20ab176821a\",\"B.1\":\"a103a0e0a3c8475b7f472576871aadca3b912a1978aff7eaa62833d173f42ab5\",\"C.1\":\"2efb9b0edfee41b77fa1a254466fe472a2d7f43dd5da92846a21e7b073da9a3d\",\"D.1\":\"3297123858b899391edc3b836cbc6efbc8056b2573d5fd4596805fe82153d80c\",\"E.1\":\"d3c185fbcf01259748539dca90ef5a433ca45fa016c094ae3b0d4840d1465204\",\"E.2\":\"e1e6b8c49d103eaf1c487731a1243b99f89684cbe880c2bc02236c66df2319f5\",\"F.1\":\"01329266178cbefa7329c30ef1957600c28e28f03b5199e3be0666fbc958dfd4\",\"G.1\":\"a500143deb2ba2c8650c05617e6dbc25e611078876636d1582371dd93c367e68\",\"H.1\":\"7a1c0667bbf28a60a79b31ab0771fe8bc6caa1410a749d259886f928fe5c0663\",\"I.1\":\"f65eee41252d3974fd7f5f5616459af2096be55dcb07e79ef5c562a2774fea08\",\"I.2\":\"ee20feeb2d2d1302969cb8eb4f40188283b5a85f19874c75f4aed67dcc87c63e\",\"J.1\":\"506f9807f3137c2b7e990ad4d123719c61ccab01df872b517bbadfe65ba0662e\"}', '2025-01-05'),
(18, 'raid_br', 'facile', 'Kamyl Taibi', 'bcildbvileb', 30, 6, 5, '[{\"x\":\"2\",\"y\":\"2\"},{\"x\":\"5\",\"y\":\"4\"}]', '{\"1.1\":\"eefze\",\"2.1\":\"ezf\",\"3.1\":\"zef\",\"4.1\":\"zef\",\"5.1\":\"zef\",\"A.1\":\"zef\",\"B.1\":\"zef\",\"C.1\":\"zefze\",\"D.1\":\"zefzef\",\"E.1\":\"zef\",\"F.1\":\"zef\"}', '{\"1.1\":\"1aa7e20e50d0965385a24f86cbda76ead392d1dbfd5b9dae9e66e7f628b0fc72\",\"2.1\":\"91f0b266ad6479e1ca81b931589e14c8fae5eea84da70c522da447c442714d9d\",\"3.1\":\"797479abb61e814fce13f89490369cc8a60187ea2006ce818f5912e63187f8cd\",\"4.1\":\"6a0ef87ab9316f96d822453260f585249b7bf4c5793053b8923f65dd2411f516\",\"5.1\":\"dd7d026c74a77ec587ba2cca7aa6786d5d9a304bf615811996e8674487347a5d\",\"A.1\":\"b6d7a594721a31646d4c15d11eabb2415911a164d0cb2a451d09ddb07e337f73\",\"B.1\":\"7b7ad9a4f798d9ce45826fa27d1da060eb8be928d17d84e3684f0efa5b3aa1c4\",\"C.1\":\"adeb27564f31fc51eab874b05487b7d9e96908bd19a5b467cb3e33151627b32d\",\"D.1\":\"8d3ad9b0aabe7002887e5c88ed97b876906dec39b05c36f52429a66c55d3fbab\",\"E.1\":\"c2a988f1f3f03cdb9aa9a39ef21d70730cab5730a2cdcc74f5205af34497b46c\",\"F.1\":\"9c33779436cc630d1257fb51d3bb87f7e11b34e6364ef65e8815074d8332e6f9\"}', '2025-01-05'),
(19, 'raid_br', 'facile', 'Université de rouen', 'ferfr', 39, 5, 5, '[{\"x\":\"1\",\"y\":\"3\"},{\"x\":\"4\",\"y\":\"4\"}]', '{\"1.1\":\"trhrzht\",\"2.1\":\"\'ztgergerg\",\"3.1\":\"erger\",\"4.1\":\"earg\",\"5.1\":\"earg\",\"A.1\":\"ergaerg\",\"A.2\":\"ezf\",\"B.1\":\"efz\",\"C.1\":\"zefz\",\"D.1\":\"zef\",\"E.1\":\"zef\"}', '{\"1.1\":\"c6f05176a1140f4f502f0cefa35212d8628032c52f09b1dac28ad473aad0a8ab\",\"2.1\":\"793e78fd4136bc17960b2e2be2723f940571a4e00d203a35d7cd4d849d649fd9\",\"3.1\":\"829140eb7becfc1456a211d02165f439c1f977c6b42a6c6b35c421ccb2d49e61\",\"4.1\":\"082da9dc29eb9b7cf97dc36482fa66c3fad9fc7b10a9780f230a862397b14bce\",\"5.1\":\"39ae8d8b11b43ca7662da7f69c7e87794b37e886cce2ba1de5a1745ee816094f\",\"A.1\":\"099987a5188a32ab07b68b4219a824bb83bfcc10aca0fd4f58e41c99b37f09f9\",\"A.2\":\"3a4db4ee1e59ce1a0a1b9f56bd6d5506d8c204e2f1d501b7a3a4021e6365e8db\",\"B.1\":\"886520a330ae2b3046df868c18fadaeacad967c5a0dbb1d39bb17f75f9f6ce49\",\"C.1\":\"570e10cee73e67dd4a9930e949588bc84e9030f6aae4d73d5f6ae0c5b30845ce\",\"D.1\":\"d60fba613b79950fb3514c0ab8ab56359779facdfa802f344d823490b0b515d9\",\"E.1\":\"e57fb8422e8d382dad7a910e0cf0160665e61980bbae9def1c520896c1ae76b7\"}', '2025-01-05'),
(20, 'raid_br', 'moyen', 'sfdg', 'sdfgsg', 3, 6, 6, '[{\"x\":\"1\",\"y\":\"1\"},{\"x\":\"5\",\"y\":\"1\"},{\"x\":\"3\",\"y\":\"3\"}]', '{\"1.1\":\"sdfg\",\"2.1\":\"kl\",\"3.1\":\"kl\",\"3.2\":\"klk\",\"4.1\":\"lk\",\"5.1\":\"lk\",\"6.1\":\"lkl\",\"A.1\":\"kl\",\"B.1\":\"kl\",\"C.1\":\"kl\",\"C.2\":\"kl\",\"D.1\":\"kl\",\"E.1\":\"lk\",\"F.1\":\"lk\"}', '{\"1.1\":\"d20268c911bb808b6d9314dddc4a12cf3df91ff5068924d81c9052e57b0ca401\",\"2.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"3.1\":\"0e6fac6a3ad129a64c2b9d6eaf6680e4b5f95dcd36949dad585415b017633875\",\"3.2\":\"d20268c911bb808b6d9314dddc4a12cf3df91ff5068924d81c9052e57b0ca401\",\"4.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"5.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"6.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"A.1\":\"54967cc3dd84252d3e2ba7d9f86e4836753cb24c03ad2a001d0d8929fb079a80\",\"B.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"C.1\":\"0e6fac6a3ad129a64c2b9d6eaf6680e4b5f95dcd36949dad585415b017633875\",\"C.2\":\"d20268c911bb808b6d9314dddc4a12cf3df91ff5068924d81c9052e57b0ca401\",\"D.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\",\"E.1\":\"54967cc3dd84252d3e2ba7d9f86e4836753cb24c03ad2a001d0d8929fb079a80\",\"F.1\":\"2e00fa6fc1784cf9c60caa62e52097ae1cd1557d77479caf2ccadcdcacff8e12\"}', '2025-01-05');

-- --------------------------------------------------------

--
-- Table structure for table `sauvegarde`
--

CREATE TABLE `sauvegarde` (
  `id_grille` int(20) NOT NULL,
  `id_user` varchar(100) NOT NULL,
  `solution` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`solution`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sauvegarde`
--

INSERT INTO `sauvegarde` (`id_grille`, `id_user`, `solution`) VALUES
(8, 'raid_br', '[{\"x\":\"1\",\"y\":\"2\"},{\"x\":\"3\",\"y\":\"3\"}]'),
(9, 'raid_br', '{\"1.1\":\"KIK\",\"2.1\":\"  \",\"2.2\":\"  \",\"3.1\":\"     \",\"4.1\":\"     \",\"5.1\":\"     \",\"A.1\":\"N    \",\"B.1\":\"I    \",\"C.1\":\"   \",\"D.1\":\"    \",\"E.1\":\"     \"}');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `full_name` varchar(100) NOT NULL,
  `mail` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `full_name`, `mail`, `password`) VALUES
('admin_cruciweb', 'Jhon Administrator', 'admin@cruciweb.com', '$2y$10$iG3CWiv/iIosfR53LtJECeDx9mgolabgP0RsRHrZnhBtHVr12/t9y'),
('raid_br', 'test test', 'raid@esi.dz', '$2y$10$iG3CWiv/iIosfR53LtJECeDx9mgolabgP0RsRHrZnhBtHVr12/t9y'),
('taibikam', 'test test', 'tkamyl@hotmail.fr', '$2y$10$.XcZECOR1inJN16VCiOqsOiAdH5eYqUP7fZ/wSXGyxcoZmoZgXAsG');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `grille`
--
ALTER TABLE `grille`
  ADD PRIMARY KEY (`id_grille`),
  ADD KEY `g_u` (`id_user`);

--
-- Indexes for table `sauvegarde`
--
ALTER TABLE `sauvegarde`
  ADD PRIMARY KEY (`id_grille`,`id_user`),
  ADD KEY `s_u` (`id_user`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `grille`
--
ALTER TABLE `grille`
  MODIFY `id_grille` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `grille`
--
ALTER TABLE `grille`
  ADD CONSTRAINT `g_u` FOREIGN KEY (`id_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sauvegarde`
--
ALTER TABLE `sauvegarde`
  ADD CONSTRAINT `s_g` FOREIGN KEY (`id_grille`) REFERENCES `grille` (`id_grille`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `s_u` FOREIGN KEY (`id_user`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

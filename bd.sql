{\rtf1\ansi\ansicpg1252\cocoartf1561\cocoasubrtf200
{\fonttbl\f0\fswiss\fcharset0 Helvetica;}
{\colortbl;\red255\green255\blue255;}
{\*\expandedcolortbl;;}
\paperw11900\paperh16840\margl1440\margr1440\vieww10800\viewh8400\viewkind0
\pard\tx566\tx1133\tx1700\tx2267\tx2834\tx3401\tx3968\tx4535\tx5102\tx5669\tx6236\tx6803\pardirnatural\partightenfactor0

\f0\fs24 \cf0 -- phpMyAdmin SQL Dump\
-- version 4.7.7\
-- https://www.phpmyadmin.net/\
--\
-- Servidor: localhost:3306\
-- Tiempo de generaci\'f3n: 18-04-2018 a las 01:05:49\
-- Versi\'f3n del servidor: 5.6.38\
-- Versi\'f3n de PHP: 5.6.32\
\
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";\
SET time_zone = "+00:00";\
\
--\
-- Base de datos: `smcp-training`\
--\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `answer`\
--\
\
CREATE TABLE `answer` (\
  `id` int(11) NOT NULL,\
  `answer` varchar(300) NOT NULL,\
  `id_question` int(11) NOT NULL,\
  `correct` tinyint(1) NOT NULL DEFAULT '1'\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `answer`\
--\
\
INSERT INTO `answer` (`id`, `answer`, `id_question`, `correct`) VALUES\
(11, 'Fire is on', 10, 1),\
(12, 'Fire is in engine-room', 10, 1),\
(13, 'Fire is in hold', 10, 1),\
(15, 'Fire is in superstructure', 10, 1),\
(16, 'Fire is in accommodation', 10, 1),\
(17, 'Fire is in living spaces', 10, 1),\
(18, 'Yes, dangerous goods are on fire', 11, 1),\
(19, 'No, dangerous goods are not on fire', 11, 1),\
(20, 'Yes, danger of explosion', 12, 1),\
(21, 'No, no danger of explosion', 12, 1),\
(22, 'Yes, fire is under control', 13, 1),\
(23, 'No, fire is not under control', 13, 1),\
(24, 'I do not require assistance', 14, 1),\
(25, 'I require fire fighting assistance', 14, 1),\
(26, 'I require breathing apparatus. Smoke is toxic', 14, 1),\
(27, 'I require foam extinguishers', 14, 1),\
(28, 'I require CO2 extinguishers', 14, 1),\
(29, 'I require fire pumps', 14, 1),\
(30, 'I require fire medical assistance', 14, 1),\
(31, 'I require pumps', 14, 1),\
(32, 'I require divers', 14, 1),\
(33, 'I require escort', 14, 1),\
(34, 'I require tug assistance', 14, 1),\
(35, 'I require medical assistance', 14, 1),\
(36, 'I require navigational assistance', 14, 1),\
(37, 'I require military assistance', 14, 1),\
(38, 'I require ice-breaker assistance', 14, 1),\
(39, 'I require boat for hospital transfer', 14, 1),\
(40, 'I require radio medical advice', 14, 1),\
(41, 'I require helicopter with doctor', 14, 1),\
(42, 'I require helicopter with doctor to pick up person', 14, 1),\
(43, 'I require helicopter with doctor to pick up persons', 14, 1),\
(44, 'I require oil dispersants', 14, 1),\
(45, 'I require floating booms', 14, 1),\
(46, 'I require $number$ tug', 14, 1),\
(47, 'I require $number$ tugs', 14, 1),\
(48, 'I require ice-breaker assistance to reach $mv name$', 14, 1),\
(52, 'No persons injured', 16, 1),\
(53, 'Number of injured persons $number$', 16, 1),\
(54, 'Number of casualties $number$', 16, 1),\
(85, 'Aground forward', 19, 1),\
(86, 'Aground aft', 19, 1),\
(87, 'Aground amidships', 19, 1),\
(88, 'Aground full length', 19, 1),\
(89, 'I cannot establish which part is aground', 19, 1),\
(90, 'I expect to refloat at $time$', 20, 1),\
(91, 'I expect to refloat when tide rises', 20, 1),\
(92, 'I expect to refloat when weather improves', 20, 1),\
(93, 'I expect to refloat when draft decreases', 20, 1),\
(94, 'I expect to refloat with tug assistance', 20, 1),\
(95, 'Yes, I can beach in $position$', 21, 1),\
(96, 'No, I cannot beach', 21, 1),\
(122, 'I have damage below water line', 23, 1),\
(123, 'I have damage above water line', 23, 1),\
(124, 'I am not under command', 23, 1),\
(125, 'I cannot establish damage', 23, 1),\
(126, 'I can only proceed at slow speed ', 23, 1),\
(127, 'I have no damage', 23, 1),\
(128, 'I have damage to navigational equipment', 23, 1),\
(129, 'Yes, I can proceed', 24, 1),\
(130, 'No, I cannot proceed', 24, 1),\
(131, 'Yes, I can continue search', 25, 1),\
(132, 'No, I cannot continue search', 25, 1),\
(138, 'Condition of person good', 27, 1),\
(139, 'Condition of person bad', 27, 1),\
(140, 'Person dead', 27, 1),\
(141, 'Condition of persons good', 28, 1),\
(142, 'Condition of persons bad', 28, 1),\
(143, 'Persons dead', 28, 1),\
(145, 'My position is $position$', 30, 1),\
(146, 'My present course $degrees$, my speed $speed$', 31, 1),\
(147, 'Number of persons on board $number$', 32, 1),\
(148, 'No persons injured', 33, 1),\
(149, 'Number of injured persons $number$', 33, 1),\
(150, 'Number of casualties $number$', 33, 1),\
(153, 'Yes, my EPIRB is transmitting', 35, 1),\
(154, 'Yes, my EPIRB is transmitting by mistake', 35, 1),\
(155, 'Yes, my SART is transmitting', 36, 1),\
(156, 'Yes, my SART is transmitting by mistake', 36, 1),\
(157, 'Yes, I transmitted a DSC alert', 37, 1),\
(158, 'Yes, I transmitted a DSC alert by mistake', 37, 1),\
(159, 'I will launch $number$ lifeboats', 38, 1),\
(160, 'I will launch $number$ lifeboats with $number$ persons', 39, 1),\
(161, 'I will launch $number$ liferafts', 40, 1),\
(162, 'I will launch $number$ liferafts with $number$ persons', 41, 1),\
(163, 'No person will stay on board', 42, 1),\
(164, '$number$ persons will stay on board', 42, 1),\
(165, 'Wind $cardinal point$ force Beaufort $beaufort$', 43, 1),\
(166, 'Visibility good', 43, 1),\
(167, 'Visibility moderate', 43, 1),\
(168, 'Visibility poor ', 43, 1),\
(169, 'Wind direction $cardinal point$ force Beaufort $beaufort$ in my position', 43, 1),\
(170, 'Smooth sea slight swell $cardinal point$', 43, 1),\
(171, 'Smooth sea moderate swell $cardinal point$', 43, 1),\
(172, 'Smooth sea heavy swell $cardinal point$', 43, 1),\
(173, 'Moderate sea slight swell $cardinal point$', 43, 1),\
(174, 'Moderate sea moderate swell $cardinal point$', 43, 1),\
(175, 'Moderate sea heavy swell $cardinal point$', 43, 1),\
(176, 'Rough sea slight swell $cardinal point$', 43, 1),\
(177, 'Rough sea moderate swell $cardinal point$', 43, 1),\
(178, 'Rough sea heavy swell $cardinal point$', 43, 1),\
(179, 'High sea slight swell $cardinal point$', 43, 1),\
(180, 'High sea moderate swell $cardinal point$', 43, 1),\
(181, 'High sea heavy swell $cardinal point$', 43, 1),\
(182, 'Current $speed$ to $cardinal point$', 43, 1),\
(184, 'The smooth sea slight swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(185, 'The smooth sea moderate swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(186, 'The smooth sea heavy swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(187, 'The moderate sea slight swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(188, 'The moderate sea moderate swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(189, 'The moderate sea heavy swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(190, 'The rough sea slight swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(191, 'The rough sea moderate swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(192, 'The rough sea heavy swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(193, 'The high sea slight swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(194, 'The high sea moderate swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(195, 'The high sea heavy swell in my position is $number$ metres from $cardinal point$', 43, 1),\
(196, 'Visibility in my position is $number$ metres', 43, 1),\
(197, 'Visibility in my position is $decimal$ nautical miles', 43, 1),\
(198, 'Visibility is restricted by mist', 43, 1),\
(199, 'Visibility is restricted by fog', 43, 1),\
(200, 'Visibility is restricted by snow', 43, 1),\
(201, 'Visibility is restricted by dust', 43, 1),\
(202, 'Visibility is restricted by rain', 43, 1),\
(203, 'Visibility is increasing', 43, 1),\
(204, 'Visibility is decreasing ', 43, 1),\
(205, 'Visibility is variable', 43, 1),\
(206, 'Wind is backing and increasing', 43, 1),\
(207, 'Wind is backing and decreasing', 43, 1),\
(208, 'Wind is veering and increasing', 43, 1),\
(209, 'Wind is veering and decreasing', 43, 1),\
(210, 'No, no dangers to navigation', 44, 1),\
(211, 'Warning! Uncharted rocks', 44, 1),\
(212, 'Warning! Uncharted ice', 44, 1),\
(213, 'Warning! Uncharted abnormally low tides', 44, 1),\
(214, 'Warning! Uncharted mines', 44, 1),\
(245, 'Yes, I can proceed to distress position', 46, 1),\
(246, 'No, I cannot proceed to distress position', 46, 1),\
(247, 'My ETA at distress position within $number$ hours', 47, 1),\
(248, 'My ETA at distress position at $time$', 47, 1),\
(249, 'Correct MAYDAY position is $position$', 48, 1),\
(414, 'The result of search is negative', 53, 1),\
(415, 'I located person in $position$', 53, 1),\
(416, 'I located persons in $position$', 53, 1),\
(417, 'I picked up person in $position$', 53, 1),\
(418, 'I picked up persons in $position$', 53, 1),\
(419, 'Sighted vessel in $position$', 53, 1),\
(420, 'Sighted lifeboats in $position$', 53, 1),\
(421, 'Sighted liferafts in $position$', 53, 1),\
(422, 'Sighted $number$ persons in water', 53, 1),\
(423, 'Sighted $number$ persons in $position$', 53, 1),\
(424, 'Picked up $number$ survivors in $position$', 53, 1),\
(425, 'Picked up $number$ lifeboats in $position$', 53, 1),\
(426, 'Picked up $number$ liferafts in $position$', 53, 1),\
(427, 'Picked up $number$ lifeboats with $number$ persons in $position$', 53, 1),\
(428, 'Picked up $number$ lifeboats with $number$ casualties in $position$', 53, 1),\
(429, 'Picked up $number$ liferafts with $number$ persons in $position$', 53, 1),\
(430, 'Picked up $number$ liferafts with $number$ casualties in $position$', 53, 1),\
(431, 'Picked up $number$ persons in lifejackets in $position$', 53, 1),\
(432, 'Picked up $number$ casualties in lifejackets in $position$', 53, 1),\
(433, 'Picked up $mv name$ in $position$', 53, 1),\
(434, 'Survivors in bad condition', 53, 1),\
(435, 'Survivors in good condition', 53, 1),\
(436, 'There are still $number$ lifeboats with survivors', 53, 1),\
(437, 'There are still $number$ liferafts with survivors', 53, 1),\
(438, 'There are no more lifeboats', 53, 1),\
(439, 'There are no more liferafts', 53, 1),\
(440, 'Picked up $number$ lifeboats with $number$ casualties in $position$', 53, 1),\
(441, 'Picked up $number$ liferafts with $number$ persons in $position$', 53, 1),\
(443, 'Picked up $number$ persons in lifejackets in $position$', 53, 1),\
(444, 'Picked up $number$ casualties in lifejackets in $position$', 53, 1),\
(445, 'Picked up $mv name$ in $position$', 53, 1),\
(446, 'Survivors in bad condition', 53, 1),\
(447, 'Survivors in good condition', 53, 1),\
(448, 'There are still $number$ lifeboats with survivors', 53, 1),\
(449, 'There are still $number$ liferafts with survivors', 53, 1),\
(450, 'There are no more lifeboats', 53, 1),\
(451, 'There are no more liferafts', 53, 1),\
(452, 'Total number of persons on board was $number$', 53, 1),\
(453, 'All persons rescued', 53, 1),\
(462, 'I do not require assistance', 56, 1),\
(463, 'I require fire fighting assistance', 56, 1),\
(464, 'I require radio medical advice', 56, 1),\
(465, 'I require boat for hospital transfer', 56, 1),\
(466, 'I require ice-breaker assistance', 56, 1),\
(467, 'I require helicopter with doctor', 56, 1),\
(468, 'I require helicopter with doctor to pick up person', 56, 1),\
(469, 'I require helicopter with doctor to pick up persons', 56, 1),\
(470, 'I require oil dispersants', 56, 1),\
(471, 'I require floating booms', 56, 1),\
(472, 'I require oil clearance assistance', 56, 1),\
(473, 'I require ice-breaker assistance to reach $mv name$', 56, 1),\
(474, 'I require breathing apparatus. Smoke is toxic', 56, 1),\
(475, 'I require foam extinguishers', 56, 1),\
(476, 'I require CO2 extinguishers', 56, 1),\
(477, 'I require fire pumps', 56, 1),\
(478, 'I require medical assistance', 56, 1),\
(479, 'I require pumps', 56, 1),\
(480, 'I require divers', 56, 1),\
(481, 'I require escort', 56, 1),\
(482, 'I require tug assistance', 56, 1),\
(483, 'I require navigational assistance', 56, 1),\
(484, 'I require military assistance', 56, 1),\
(485, 'I require $number$ tug', 56, 1),\
(486, 'Yes, I have doctor on board', 57, 1),\
(487, 'No, I have no doctor on board', 57, 1),\
(488, 'No, I cannot make rendezvous', 58, 1),\
(489, 'Yes, I can make rendezvous in position $position$ at $time$', 58, 1),\
(490, 'Yes, I can make rendezvous in position $position$ within $number$ hours', 58, 1),\
(491, 'I have problems with $vhf channel$ marina pina', 59, 1),\
(492, 'I am manoeuvring with difficulty', 59, 1),\
(493, 'I require tug assistance', 59, 1),\
(494, 'Yes, I can proceed without assistance', 60, 1),\
(495, 'No, I cannot proceed without assistance', 60, 1),\
(496, 'I try to proceed without assistance', 60, 1),\
(499, 'The wind in your position is expected from direction $cardinal point$, force Beaufort $beaufort$', 63, 1),\
(500, 'The wind in your position is expected to increase', 63, 1),\
(501, 'The wind in your position is expected to decrease', 63, 1),\
(502, 'The wind in your position is expected variable', 63, 1),\
(503, 'The latest gale warning is as follows: Gale warning. Winds at $time$ in area $mv name$ from $cardinal point$', 64, 1),\
(504, 'The latest gale warning is as follows: Gale warning. Winds at $time$ in area $mv name$ from $cardinal point$', 64, 1),\
(505, 'The latest storm warning is as follows: Storm warning. Winds at $time$ in area $mv name$ from $cardinal point$', 65, 1),\
(507, 'The latest tropical storm warning is as follows: Tropical storm warning at $time$. Hurricane $mv name$ ', 66, 1),\
(508, 'The latest tropical storm warning is as follows: Tropical storm warning at $time$. Hurricane $mv name$ ', 66, 1),\
(509, '$number$ millibars located in $position$. Present movement $cardinal point$ at $speed$. ', 66, 1),\
(510, 'asdfasf', 67, 1),\
(511, 'I have problems with $degrees$ marina pina', 67, 1),\
(512, 'esta en la posicion $position$, marina', 68, 1);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `categories_final_test`\
--\
\
CREATE TABLE `categories_final_test` (\
  `id` int(11) NOT NULL,\
  `id_category` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `categories_final_test`\
--\
\
INSERT INTO `categories_final_test` (`id`, `id_category`) VALUES\
(17, 2),\
(18, 5),\
(19, 6),\
(20, 7),\
(21, 3),\
(22, 4);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `category`\
--\
\
CREATE TABLE `category` (\
  `id` int(11) NOT NULL,\
  `number` varchar(10) NOT NULL,\
  `description` varchar(100) NOT NULL,\
  `id_parent_category` int(11) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `category`\
--\
\
INSERT INTO `category` (`id`, `number`, `description`, `id_parent_category`) VALUES\
(1, 'A1', 'External communication phrases', NULL),\
(2, '1', 'Distress traffic', 1),\
(3, '2', 'Urgency traffic', 1),\
(4, '3', 'Safety communications', 1),\
(5, '1.1', 'Distress communications', 2),\
(6, '1.2', 'Search and Rescue communication', 2),\
(7, '1.3', 'Requesting medical assistance ', 2),\
(8, '3.1', 'Meteorological and hydrological conditions', 4),\
(9, '3.2', 'Navigational warning', 4),\
(12, '6', 'Vessel Traffic Service (VTS) Standard Phrases', 1),\
(13, '6.1', 'Phrases for acquiring and providing data for a traffic images', 12),\
(14, '6.1.1', 'Acquiring and providing routine traffic data', 13),\
(15, '6.1.2', 'Acquiring and providing distress traffic data', 13),\
(16, '6.2', 'Phrases for providing VTS services', 12),\
(17, '6.2.1', 'Information service', 16),\
(18, '6.2.1.1', 'Navigational warnings', 17),\
(19, '6.2.1.2', 'Navigational information', 17),\
(20, '6.2.1.3', 'Traffic information', 17),\
(21, '6.2.1.4', 'Route information', 17),\
(23, '6.2.1.6', 'Electronic navigational aids information', 17),\
(24, '6.2.2', 'Navigational assistance service', 16),\
(25, '6.2.2.1', 'Request and identification', 24),\
(26, '6.2.2.2', 'Position', 24),\
(27, '6.2.2.3', 'Course', 24),\
(28, '6.2.3', 'Traffic organization service', 16),\
(29, '6.2.3.1', 'Clearance, forward planning', 28),\
(30, '6.2.3.2', 'Anchoring', 28),\
(31, '6.3', 'Handing over to another VTS', 12),\
(32, '6.4', 'Phrases for communication with emergency services and allied services', 12),\
(33, '6.4.1', 'Emergency services(SAR, fire fighting, pollution fighting)', 32),\
(34, '6.4.2', 'Tug services', 32),\
(35, '6.4.3', 'Pilot request', 32),\
(36, '6.4.4', 'Embarking / disembarking pilot', 32),\
(42, '6.2.1.7', 'Meteorological warnings', 17),\
(43, '2', 'ejemploa', NULL),\
(44, 'ejemplo', 'ejemplo', NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `disordered_statement`\
--\
\
CREATE TABLE `disordered_statement` (\
  `id` int(11) NOT NULL,\
  `ordered` varchar(400) NOT NULL,\
  `disordered` varchar(400) NOT NULL,\
  `id_category` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `disordered_statement`\
--\
\
INSERT INTO `disordered_statement` (`id`, `ordered`, `disordered`, `id_category`) VALUES\
(1, 'Report at the next waypoint at 1200 hours UTC', 'at next waypoint at 1200 hours UTC next Report the ', 44);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `entry`\
--\
\
CREATE TABLE `entry` (\
  `id` int(11) NOT NULL,\
  `id_exam` int(11) NOT NULL,\
  `answer` varchar(100) DEFAULT NULL,\
  `correct` tinyint(1) DEFAULT NULL,\
  `date` datetime DEFAULT CURRENT_TIMESTAMP,\
  `time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,\
  `id_question` int(11) NOT NULL,\
  `id_type_question` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `entry`\
--\
\
INSERT INTO `entry` (`id`, `id_exam`, `answer`, `correct`, `date`, `time`, `id_question`, `id_type_question`) VALUES\
(356, 1309, 'yes, i can proceed', 0, '2017-09-15 16:53:17', '2017-09-15 14:53:17', 60, 1),\
(357, 1309, 'dsf', 0, '2017-09-15 16:53:17', '2017-09-15 14:53:17', 48, 1),\
(358, 1309, 'Yes, I can beach', 0, '2017-09-15 16:53:17', '2017-09-15 14:53:17', 21, 1),\
(359, 1309, 'sf', 0, '2017-09-15 16:53:17', '2017-09-15 14:53:17', 28, 1),\
(360, 1309, 'sf', 0, '2017-09-15 16:53:17', '2017-09-15 14:53:17', 13, 1),\
(596, 1345, 'asdf', 0, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 1, 2),\
(597, 1345, 'distress communicaionssdf', 1, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 1, 3),\
(598, 1345, 'urgency trafinc', 1, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 2, 3),\
(599, 1345, 'navigational warning', 1, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 3, 3),\
(600, 1345, 'ejemplo', 1, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 67, 4),\
(601, 1345, 'asdf', 0, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 39, 1),\
(602, 1345, 'asdf', 0, '2017-10-09 04:49:20', '2017-10-09 02:49:20', 33, 1),\
(610, 1347, 'k', 0, '2017-10-11 10:26:08', '2017-10-11 08:26:08', 1, 2),\
(611, 1347, 'navigational warning', 1, '2017-10-11 10:26:08', '2017-10-11 08:26:08', 3, 3),\
(612, 1347, 'urgency trafinc', 1, '2017-10-11 10:26:08', '2017-10-11 08:26:08', 2, 3),\
(613, 1347, 'distress communicaionssdf', 1, '2017-10-11 10:26:08', '2017-10-11 08:26:08', 1, 3),\
(614, 1347, 'ejemplo', 1, '2017-10-11 10:26:08', '2017-10-11 08:26:08', 67, 4),\
(615, 1348, 'k', 0, '2017-10-11 10:28:39', '2017-10-11 08:28:39', 1, 2),\
(616, 1348, 'navigational warning', 1, '2017-10-11 10:28:39', '2017-10-11 08:28:39', 3, 3),\
(617, 1348, 'urgency trafinc', 1, '2017-10-11 10:28:39', '2017-10-11 08:28:39', 2, 3),\
(618, 1348, 'distress communicaionssdf', 1, '2017-10-11 10:28:39', '2017-10-11 08:28:39', 1, 3),\
(619, 1348, 'ejemplo', 1, '2017-10-11 10:28:39', '2017-10-11 08:28:39', 67, 4),\
(620, 1349, 'k', 0, '2017-10-11 10:28:51', '2017-10-11 08:28:51', 1, 2),\
(621, 1349, 'navigational warning', 1, '2017-10-11 10:28:51', '2017-10-11 08:28:51', 3, 3),\
(622, 1349, 'urgency trafinc', 1, '2017-10-11 10:28:51', '2017-10-11 08:28:51', 2, 3),\
(623, 1349, 'distress communicaionssdf', 1, '2017-10-11 10:28:51', '2017-10-11 08:28:51', 1, 3),\
(624, 1349, 'ejemplo', 1, '2017-10-11 10:28:51', '2017-10-11 08:28:51', 67, 4),\
(625, 1350, 'asdf', 0, '2017-10-11 11:41:34', '2017-10-11 09:41:34', 1, 2),\
(626, 1350, 'navigational warning', 1, '2017-10-11 11:41:34', '2017-10-11 09:41:34', 3, 3),\
(627, 1350, 'distress communicaionssdf', 1, '2017-10-11 11:41:34', '2017-10-11 09:41:34', 1, 3),\
(628, 1350, 'faaaaalso', 0, '2017-10-11 11:41:34', '2017-10-11 09:41:34', 2, 3),\
(629, 1350, 'asdf', 0, '2017-10-11 11:41:34', '2017-10-11 09:41:34', 67, 4),\
(630, 1351, 'asdf', 0, '2017-10-11 12:08:42', '2017-10-11 10:08:42', 1, 2),\
(631, 1351, 'navigational warning', 1, '2017-10-11 12:08:42', '2017-10-11 10:08:42', 3, 3),\
(632, 1351, 'ejemplo 1', 0, '2017-10-11 12:08:42', '2017-10-11 10:08:42', 1, 3),\
(633, 1351, 'urgency trafinc', 1, '2017-10-11 12:08:42', '2017-10-11 10:08:42', 2, 3),\
(634, 1351, 'asd', 0, '2017-10-11 12:08:42', '2017-10-11 10:08:42', 67, 4),\
(635, 1352, 'asdf', 0, '2017-10-11 12:11:04', '2017-10-11 10:11:04', 1, 2),\
(636, 1352, 'distress communicaionssdf', 1, '2017-10-11 12:11:04', '2017-10-11 10:11:04', 1, 3),\
(637, 1352, 'false', 0, '2017-10-11 12:11:04', '2017-10-11 10:11:04', 3, 3),\
(638, 1352, 'faaaaalso', 0, '2017-10-11 12:11:04', '2017-10-11 10:11:04', 2, 3),\
(639, 1352, 'asf', 0, '2017-10-11 12:11:04', '2017-10-11 10:11:04', 67, 4),\
(640, 1353, 'asdf', 0, '2017-10-11 12:11:12', '2017-10-11 10:11:12', 1, 2),\
(641, 1353, 'distress communicaionssdf', 1, '2017-10-11 12:11:12', '2017-10-11 10:11:12', 1, 3),\
(642, 1353, 'false', 0, '2017-10-11 12:11:12', '2017-10-11 10:11:12', 3, 3),\
(643, 1353, 'faaaaalso', 0, '2017-10-11 12:11:12', '2017-10-11 10:11:12', 2, 3),\
(644, 1353, 'asf', 0, '2017-10-11 12:11:12', '2017-10-11 10:11:12', 67, 4),\
(645, 1354, 'asdf', 0, '2017-10-11 12:12:48', '2017-10-11 10:12:48', 1, 2),\
(646, 1354, 'urgency trafinc', 1, '2017-10-11 12:12:48', '2017-10-11 10:12:48', 2, 3),\
(647, 1354, 'distress communicaionssdf', 1, '2017-10-11 12:12:48', '2017-10-11 10:12:48', 1, 3),\
(648, 1354, 'false', 0, '2017-10-11 12:12:48', '2017-10-11 10:12:48', 3, 3),\
(649, 1354, 'asdfadsf', 0, '2017-10-11 12:12:48', '2017-10-11 10:12:48', 67, 4),\
(650, 1355, 'asdf', 0, '2017-10-11 13:39:17', '2017-10-11 11:39:17', 1, 2),\
(651, 1355, 'ejemplo 1', 0, '2017-10-11 13:39:17', '2017-10-11 11:39:17', 1, 3),\
(652, 1355, 'false', 0, '2017-10-11 13:39:17', '2017-10-11 11:39:17', 3, 3),\
(653, 1355, 'urgency trafinc', 1, '2017-10-11 13:39:17', '2017-10-11 11:39:17', 2, 3),\
(654, 1355, 'ejemplo', 1, '2017-10-11 13:39:17', '2017-10-11 11:39:17', 67, 4),\
(683, 1360, 'asdf', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 1, 2),\
(684, 1360, 'false', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 3, 3),\
(685, 1360, 'urgency trafinc', 1, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 2, 3),\
(686, 1360, 'ejemplo 1', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 1, 3),\
(687, 1360, 'asdf', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 67, 4),\
(688, 1360, 'asdf', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 32, 1),\
(689, 1360, 'asdf', 0, '2017-10-14 00:51:47', '2017-10-13 22:51:47', 53, 1),\
(690, 1361, 'f', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 1, 2),\
(691, 1361, 'false', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 3, 3),\
(692, 1361, 'distress communicaionssdf', 1, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 1, 3),\
(693, 1361, 'faaaaalso', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 2, 3),\
(694, 1361, 'asdf', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 67, 4),\
(695, 1361, 'asdf', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 14, 1),\
(696, 1361, 'asdf', 0, '2017-10-14 02:29:18', '2017-10-14 00:29:18', 46, 1),\
(697, 1362, 'asdf', 0, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 1, 2),\
(698, 1362, 'ejemplo 1', 0, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 1, 3),\
(699, 1362, 'urgency trafinc', 1, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 2, 3),\
(700, 1362, 'navigational warning', 1, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 3, 3),\
(701, 1362, 'asdf', 0, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 67, 4),\
(702, 1362, 'asdf', 0, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 28, 1),\
(703, 1362, 'asdf', 0, '2017-10-14 02:34:23', '2017-10-14 00:34:23', 57, 1),\
(704, 1363, 'asdf', 0, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 1, 2),\
(705, 1363, 'ejemplo 1', 0, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 1, 3),\
(706, 1363, 'urgency trafinc', 1, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 2, 3),\
(707, 1363, 'navigational warning', 1, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 3, 3),\
(708, 1363, 'asdf', 0, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 67, 4),\
(709, 1363, 'asdf', 0, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 28, 1),\
(710, 1363, 'asdf', 0, '2017-10-14 02:36:12', '2017-10-14 00:36:12', 57, 1),\
(711, 1364, 'asdf', 0, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 1, 2),\
(712, 1364, 'ejemplo 1', 0, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 1, 3),\
(713, 1364, 'urgency trafinc', 1, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 2, 3),\
(714, 1364, 'navigational warning', 1, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 3, 3),\
(715, 1364, 'asdf', 0, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 67, 4),\
(716, 1364, 'asdf', 0, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 28, 1),\
(717, 1364, 'asdf', 0, '2017-10-14 02:36:47', '2017-10-14 00:36:47', 57, 1),\
(917, 1390, 'lkn', 0, '2017-10-16 03:30:46', '2017-10-16 01:30:46', 47, 1),\
(918, 1390, 'lkn', 0, '2017-10-16 03:30:46', '2017-10-16 01:30:46', 41, 1),\
(919, 1390, '-lkn', 0, '2017-10-16 03:30:46', '2017-10-16 01:30:46', 25, 1),\
(920, 1390, '-lkn', 0, '2017-10-16 03:30:46', '2017-10-16 01:30:46', 53, 1),\
(921, 1390, 'kln', 0, '2017-10-16 03:30:46', '2017-10-16 01:30:46', 42, 1),\
(930, 1392, 'ef', 0, '2017-10-16 05:57:28', '2017-10-16 03:57:28', 65, 1),\
(931, 1392, 'f', 0, '2017-10-16 05:57:28', '2017-10-16 03:57:28', 19, 1),\
(932, 1392, 'f', 0, '2017-10-16 05:57:28', '2017-10-16 03:57:28', 30, 1),\
(933, 1392, 'f', 0, '2017-10-16 05:57:28', '2017-10-16 03:57:28', 40, 1),\
(934, 1392, 'f', 0, '2017-10-16 05:57:28', '2017-10-16 03:57:28', 41, 1),\
(935, 1393, 'kjb', 0, '2017-10-16 05:58:48', '2017-10-16 03:58:48', 1, 2),\
(936, 1393, 'faaaaalso', 0, '2017-10-16 05:58:48', '2017-10-16 03:58:48', 2, 3),\
(937, 1393, 'false', 0, '2017-10-16 05:58:48', '2017-10-16 03:58:48', 3, 3),\
(938, 1393, 'distress communicaionssdf', 1, '2017-10-16 05:58:48', '2017-10-16 03:58:48', 1, 3),\
(939, 1393, 'm', 0, '2017-10-16 05:58:48', '2017-10-16 03:58:48', 67, 4),\
(940, 1394, 'asdf', 0, '2017-10-16 15:05:36', '2017-10-16 13:05:36', 1, 2),\
(941, 1396, 'dzfg', 0, '2017-10-16 15:07:00', '2017-10-16 13:07:00', 1, 2),\
(942, 1397, 'asdf', 0, '2017-10-17 00:54:43', '2017-10-16 22:54:43', 64, 1),\
(943, 1398, NULL, 0, '2017-10-17 00:56:08', '2017-10-16 22:56:08', 64, 1),\
(944, 1399, 'asdf', 0, '2017-10-17 00:59:07', '2017-10-16 22:59:07', 64, 1),\
(945, 1400, 'asdf', 0, '2017-10-17 00:59:13', '2017-10-16 22:59:13', 64, 1),\
(994, 1424, 'qa', 0, '2017-10-17 05:48:54', '2017-10-17 03:48:54', 66, 1),\
(995, 1424, 'aaaa', 0, '2017-10-17 05:48:54', '2017-10-17 03:48:54', 65, 1),\
(996, 1424, 'aaaaa', 0, '2017-10-17 05:48:54', '2017-10-17 03:48:54', 63, 1),\
(997, 1425, 'what is the latest gale warning', 0, '2017-10-30 19:01:32', '2017-10-30 18:01:32', 64, 1),\
(998, 1426, 'marina marina marina', 0, '2017-10-30 19:02:10', '2017-10-30 18:02:10', 64, 1),\
(999, 1427, 'what is marina', 0, '2017-10-30 19:03:14', '2017-10-30 18:03:14', 64, 1),\
(1000, 1428, 'fdf', 0, '2017-12-29 18:52:36', '2017-12-29 17:52:36', 64, 1),\
(1001, 1429, 'asf', 0, '2017-12-29 18:56:18', '2017-12-29 17:56:18', 1, 2),\
(1002, 1429, 'faaaaalso', 0, '2017-12-29 18:56:18', '2017-12-29 17:56:18', 2, 3),\
(1003, 1429, 'navigational warning', 1, '2017-12-29 18:56:18', '2017-12-29 17:56:18', 3, 3),\
(1004, 1429, 'distress communicaionssdf', 1, '2017-12-29 18:56:18', '2017-12-29 17:56:18', 1, 3),\
(1005, 1429, 'asdf', 0, '2017-12-29 18:56:18', '2017-12-29 17:56:18', 67, 4),\
(1006, 1430, 'es dia November 2nd', 1, '2018-01-06 20:17:55', '2018-01-06 19:17:55', 68, 1),\
(1007, 1431, 'es dia November 2nd', 1, '2018-01-06 20:21:18', '2018-01-06 19:21:18', 68, 1),\
(1008, 1432, 'es dia November 2nd,', 1, '2018-01-06 20:21:45', '2018-01-06 19:21:45', 68, 1),\
(1009, 1433, 'es dia November 2nd,', 1, '2018-01-06 20:22:42', '2018-01-06 19:22:42', 68, 1),\
(1010, 1434, 'es dia November 2nd,', 1, '2018-01-06 20:25:40', '2018-01-06 19:25:40', 68, 1),\
(1011, 1435, 'es dia September 16th', 1, '2018-01-06 20:25:52', '2018-01-06 19:25:52', 68, 1),\
(1012, 1436, 'es dia September 16th,', 1, '2018-01-06 20:26:08', '2018-01-06 19:26:08', 68, 1),\
(1013, 1437, 'es dia September 36th ', 0, '2018-01-06 20:26:43', '2018-01-06 19:26:43', 68, 1),\
(1014, 1438, 'es dia September 36th, hoy', 0, '2018-01-06 20:29:18', '2018-01-06 19:29:18', 68, 1),\
(1015, 1439, 'es dia September 16th, hoy', 1, '2018-01-06 20:29:32', '2018-01-06 19:29:32', 68, 1),\
(1016, 1440, 'es dia September 16th, hoy', 1, '2018-01-06 20:31:37', '2018-01-06 19:31:37', 68, 1),\
(1017, 1441, 'es dia September 16th, hoy ', 1, '2018-01-06 20:31:52', '2018-01-06 19:31:52', 68, 1),\
(1018, 1442, 'es dia September 16th, hoy ', 0, '2018-01-06 20:32:11', '2018-01-06 19:32:11', 68, 1),\
(1019, 1443, 'es dia April 23th hoy', 0, '2018-01-06 20:32:30', '2018-01-06 19:32:30', 68, 1),\
(1020, 1444, 'es dia April 23rd hoy', 0, '2018-01-06 20:32:45', '2018-01-06 19:32:45', 68, 1),\
(1021, 1445, 'es dia April 23rd hoy', 0, '2018-01-06 20:33:54', '2018-01-06 19:33:54', 68, 1),\
(1022, 1446, 'es dia April 23rd hoy', 0, '2018-01-06 20:34:06', '2018-01-06 19:34:06', 68, 1),\
(1023, 1447, 'es dia April 23rd hoy', 1, '2018-01-06 20:34:41', '2018-01-06 19:34:41', 68, 1),\
(1024, 1448, 'es dia April 23rd, hoy', 0, '2018-01-06 20:34:55', '2018-01-06 19:34:55', 68, 1),\
(1025, 1449, 'es dia January 6th hoy', 1, '2018-01-06 20:35:09', '2018-01-06 19:35:09', 68, 1),\
(1026, 1450, 'asf', 0, '2018-01-08 00:45:46', '2018-01-07 23:45:46', 64, 1),\
(1027, 1451, 'asf', 0, '2018-01-08 00:48:56', '2018-01-07 23:48:56', 64, 1),\
(1028, 1452, 'asf', 0, '2018-01-08 00:50:38', '2018-01-07 23:50:38', 64, 1),\
(1029, 1453, 'asdfasdf', 0, '2018-01-08 00:50:55', '2018-01-07 23:50:55', 64, 1),\
(1030, 1454, 'asdfasdf', 0, '2018-01-08 00:55:26', '2018-01-07 23:55:26', 64, 1),\
(1031, 1455, 'hoy es dia january 21st', 0, '2018-01-08 01:00:21', '2018-01-08 00:00:21', 68, 1),\
(1032, 1456, 'hoy es dia january 21st', 0, '2018-01-08 01:01:31', '2018-01-08 00:01:31', 68, 1),\
(1033, 1457, 'ejemplo 1', 0, '2018-01-08 01:11:13', '2018-01-08 00:11:13', 1, 3),\
(1034, 1457, 'aaa', 0, '2018-01-08 01:11:13', '2018-01-08 00:11:13', 14, 1),\
(1035, 1457, 'marina', 0, '2018-01-08 01:11:13', '2018-01-08 00:11:13', 10, 1),\
(1036, 1457, 'ana', 0, '2018-01-08 01:11:13', '2018-01-08 00:11:13', 27, 1),\
(1037, 1458, 'distress communicaionssdf', 1, '2018-01-08 01:11:43', '2018-01-08 00:11:43', 1, 3),\
(1038, 1458, 'aaaa', 0, '2018-01-08 01:11:43', '2018-01-08 00:11:43', 20, 1),\
(1039, 1458, 'm', 0, '2018-01-08 01:11:43', '2018-01-08 00:11:43', 11, 1),\
(1040, 1458, 'an', 0, '2018-01-08 01:11:43', '2018-01-08 00:11:43', 21, 1),\
(1041, 1459, 'urgency trafinc', 1, '2018-01-08 01:13:49', '2018-01-08 00:13:49', 2, 3),\
(1042, 1459, 'navigational warning', 1, '2018-01-08 01:13:49', '2018-01-08 00:13:49', 3, 3),\
(1043, 1459, 'hola', 0, '2018-01-08 01:13:49', '2018-01-08 00:13:49', 67, 4),\
(1044, 1460, 'urgency trafinc', 1, '2018-01-08 01:14:03', '2018-01-08 00:14:03', 2, 3),\
(1045, 1460, 'false', 0, '2018-01-08 01:14:03', '2018-01-08 00:14:03', 3, 3),\
(1046, 1460, 'a', 0, '2018-01-08 01:14:03', '2018-01-08 00:14:03', 67, 4),\
(1047, 1461, 'asf', 0, '2018-01-08 01:58:18', '2018-01-08 00:58:18', 28, 1),\
(1048, 1461, 'asf', 0, '2018-01-08 01:58:18', '2018-01-08 00:58:18', 46, 1),\
(1049, 1461, 'asdf', 0, '2018-01-08 01:58:18', '2018-01-08 00:58:18', 36, 1),\
(1050, 1461, 'asdf', 0, '2018-01-08 01:58:18', '2018-01-08 00:58:18', 48, 1),\
(1051, 1461, 'asdf', 0, '2018-01-08 01:58:18', '2018-01-08 00:58:18', 11, 1),\
(1052, 1462, 'as', 0, '2018-01-08 02:00:10', '2018-01-08 01:00:10', 24, 1),\
(1053, 1462, 'df', 0, '2018-01-08 02:00:10', '2018-01-08 01:00:10', 16, 1),\
(1054, 1462, 'asdf', 0, '2018-01-08 02:00:10', '2018-01-08 01:00:10', 27, 1),\
(1055, 1462, 'asd', 0, '2018-01-08 02:00:10', '2018-01-08 01:00:10', 11, 1),\
(1056, 1462, 'asdf', 0, '2018-01-08 02:00:10', '2018-01-08 01:00:10', 28, 1),\
(1057, 1463, 'as', 0, '2018-01-08 02:00:24', '2018-01-08 01:00:24', 24, 1),\
(1058, 1463, 'df', 0, '2018-01-08 02:00:24', '2018-01-08 01:00:24', 16, 1),\
(1059, 1463, 'asdf', 0, '2018-01-08 02:00:24', '2018-01-08 01:00:24', 27, 1),\
(1060, 1463, 'asd', 0, '2018-01-08 02:00:24', '2018-01-08 01:00:24', 11, 1),\
(1061, 1463, 'asdf', 0, '2018-01-08 02:00:24', '2018-01-08 01:00:24', 28, 1),\
(1062, 1464, 'as', 0, '2018-01-08 02:00:45', '2018-01-08 01:00:45', 24, 1),\
(1063, 1464, 'df', 0, '2018-01-08 02:00:45', '2018-01-08 01:00:45', 16, 1),\
(1064, 1464, 'asdf', 0, '2018-01-08 02:00:45', '2018-01-08 01:00:45', 27, 1),\
(1065, 1464, 'asd', 0, '2018-01-08 02:00:45', '2018-01-08 01:00:45', 11, 1),\
(1066, 1464, 'asdf', 0, '2018-01-08 02:00:45', '2018-01-08 01:00:45', 28, 1),\
(1067, 1465, 'as', 0, '2018-01-08 02:01:06', '2018-01-08 01:01:06', 24, 1),\
(1068, 1465, 'df', 0, '2018-01-08 02:01:06', '2018-01-08 01:01:06', 16, 1),\
(1069, 1465, 'asdf', 0, '2018-01-08 02:01:06', '2018-01-08 01:01:06', 27, 1),\
(1070, 1465, 'asd', 0, '2018-01-08 02:01:06', '2018-01-08 01:01:06', 11, 1),\
(1071, 1465, 'asdf', 0, '2018-01-08 02:01:06', '2018-01-08 01:01:06', 28, 1),\
(1072, 1466, 'asf', 0, '2018-01-08 02:02:47', '2018-01-08 01:02:47', 1, 2),\
(1073, 1467, 'sf', 0, '2018-01-08 02:02:57', '2018-01-08 01:02:57', 1, 2),\
(1074, 1468, 'urgency trafinc', 1, '2018-01-08 02:21:38', '2018-01-08 01:21:38', 2, 3),\
(1075, 1468, 'false', 0, '2018-01-08 02:21:38', '2018-01-08 01:21:38', 3, 3),\
(1076, 1468, 'df', 0, '2018-01-08 02:21:38', '2018-01-08 01:21:38', 67, 4),\
(1077, 1469, 'asdf', 0, '2018-01-08 02:28:00', '2018-01-08 01:28:00', 64, 1),\
(1078, 1470, 'df', 0, '2018-01-08 02:28:20', '2018-01-08 01:28:20', 64, 1),\
(1079, 1471, 'aaaaaaaaaaa', 0, '2018-01-08 02:31:19', '2018-01-08 01:31:19', 64, 1),\
(1080, 1472, 'yujuuu', 0, '2018-01-08 02:32:17', '2018-01-08 01:32:17', 64, 1),\
(1081, 1473, 'yujuuu', 0, '2018-01-08 02:34:56', '2018-01-08 01:34:56', 64, 1),\
(1082, 1474, 'marinaaa', 0, '2018-01-08 02:43:16', '2018-01-08 01:43:16', 64, 1),\
(1083, 1475, 'esta en la posicion cape paloma', 0, '2018-01-14 01:28:20', '2018-01-14 00:28:20', 68, 1),\
(1084, 1476, 'esta en la posicion Cape Paloma', 1, '2018-01-14 01:28:50', '2018-01-14 00:28:50', 68, 1),\
(1085, 1477, 'esta en la posicion Cape Paloma, marina', 1, '2018-01-14 01:29:49', '2018-01-14 00:29:49', 68, 1),\
(1086, 1478, 'esta en la posicion Cape Paloma, marina', 1, '2018-01-14 01:30:13', '2018-01-14 00:30:13', 68, 1),\
(1087, 1479, 'esta en la posicion Cape Paloma marina', 0, '2018-01-14 01:30:31', '2018-01-14 00:30:31', 68, 1),\
(1088, 1480, 'esta en la posicion Cape Trafalgar, marina', 1, '2018-01-14 01:30:52', '2018-01-14 00:30:52', 68, 1),\
(1089, 1481, 'Esta en la posicion Cape Trafalgar, Marina', 0, '2018-01-14 01:31:06', '2018-01-14 00:31:06', 68, 1),\
(1090, 1482, 'esta en la posicion 2 marina', 1, '2018-01-14 01:44:15', '2018-01-14 00:44:15', 68, 1),\
(1091, 1483, 'esta en la posicion 2 marina', 1, '2018-01-14 01:46:04', '2018-01-14 00:46:04', 68, 1),\
(1092, 1484, 'esta en la posicion 12 marina', 1, '2018-01-14 01:46:17', '2018-01-14 00:46:17', 68, 1),\
(1093, 1485, 'esta en la posicion 0 marina', 1, '2018-01-14 01:47:51', '2018-01-14 00:47:51', 68, 1),\
(1094, 1486, 'esta en la posicion -2 marina', 0, '2018-01-14 01:47:59', '2018-01-14 00:47:59', 68, 1),\
(1095, 1487, 'esta en la posicion e4uas marina', 0, '2018-01-14 01:54:02', '2018-01-14 00:54:02', 68, 1),\
(1096, 1488, 'esta en la posicion e4uas marina', 0, '2018-01-14 01:55:51', '2018-01-14 00:55:51', 68, 1),\
(1097, 1489, 'esta en la posicion e4uas marina', 0, '2018-01-14 01:56:10', '2018-01-14 00:56:10', 68, 1),\
(1098, 1490, 'esta en la posicion e4uas marina', 0, '2018-01-14 01:59:24', '2018-01-14 00:59:24', 68, 1),\
(1099, 1491, 'esta en la posicion e4uas marina', 0, '2018-01-14 01:59:45', '2018-01-14 00:59:45', 68, 1),\
(1100, 1492, 'asdfasdf', 0, '2018-01-14 01:59:52', '2018-01-14 00:59:52', 68, 1),\
(1101, 1493, 'asdfasdf', 0, '2018-01-14 02:00:22', '2018-01-14 01:00:22', 68, 1),\
(1102, 1494, 'asdfasf', 0, '2018-01-14 02:00:31', '2018-01-14 01:00:31', 68, 1),\
(1103, 1496, 'asdfasf', 0, '2018-01-14 02:01:57', '2018-01-14 01:01:57', 68, 1),\
(1104, 1497, 'esta en la posicion 38dj0', 0, '2018-01-14 02:02:11', '2018-01-14 01:02:11', 68, 1),\
(1105, 1498, 'esta en la posicion 4juof marina', 1, '2018-01-14 02:02:29', '2018-01-14 01:02:29', 68, 1),\
(1106, 1499, 'esta en la posicion 5098 marina', 1, '2018-01-14 02:02:53', '2018-01-14 01:02:53', 68, 1),\
(1107, 1500, 'esta en la posicion 45hsi, marina', 1, '2018-01-14 02:03:29', '2018-01-14 01:03:29', 68, 1),\
(1108, 1501, 'esta en la posicion 45hsip marina', 0, '2018-01-14 02:03:43', '2018-01-14 01:03:43', 68, 1),\
(1109, 1502, 'esta en la posicion NW, marina', 1, '2018-01-14 02:10:43', '2018-01-14 01:10:43', 68, 1),\
(1110, 1503, 'esta en la posicion NW, marina', 1, '2018-01-14 02:11:05', '2018-01-14 01:11:05', 68, 1),\
(1111, 1504, 'esta en la posicion S, marina', 1, '2018-01-14 02:11:25', '2018-01-14 01:11:25', 68, 1),\
(1112, 1505, 'esta en la posicion W  marina', 0, '2018-01-14 02:11:46', '2018-01-14 01:11:46', 68, 1),\
(1113, 1506, 'esta en la posicion S,  marina', 0, '2018-01-14 02:12:15', '2018-01-14 01:12:15', 68, 1),\
(1114, 1507, 'esta en la posicion N , marina', 0, '2018-01-14 02:13:00', '2018-01-14 01:13:00', 68, 1),\
(1115, 1508, 'esta en la posicion N,  marina', 0, '2018-01-14 02:13:17', '2018-01-14 01:13:17', 68, 1),\
(1116, 1509, 'esta en la posicion N, marina', 1, '2018-01-14 02:17:27', '2018-01-14 01:17:27', 68, 1),\
(1117, 1510, 'esta en la posicion s, marina', 0, '2018-01-14 02:17:33', '2018-01-14 01:17:33', 68, 1),\
(1118, 1511, 'esta en la posicion BUOY5, marina', 1, '2018-01-14 02:20:16', '2018-01-14 01:20:16', 68, 1),\
(1119, 1512, 'esta en la posicion BuOY5, marina', 0, '2018-01-14 02:20:31', '2018-01-14 01:20:31', 68, 1),\
(1120, 1513, 'esta en la posicion June 16th, marina', 0, '2018-01-14 02:35:15', '2018-01-14 01:35:15', 68, 1),\
(1121, 1514, 'esta en la posicion June 16th, marina', 1, '2018-01-14 02:36:49', '2018-01-14 01:36:49', 68, 1),\
(1122, 1515, 'esta en la posicion July 2nd, marina', 1, '2018-01-14 02:37:07', '2018-01-14 01:37:07', 68, 1),\
(1123, 1516, 'esta en la posicion SEA5 marina', 1, '2018-01-14 02:42:14', '2018-01-14 01:42:14', 68, 1),\
(1124, 1517, 'esta en la posicion 2,4, marina', 0, '2018-01-14 02:48:20', '2018-01-14 01:48:20', 68, 1),\
(1125, 1518, 'esta en la posicion 2,4, marina', 1, '2018-01-14 02:48:50', '2018-01-14 01:48:50', 68, 1),\
(1126, 1519, 'esta es la posicion 34,32, marina', 0, '2018-01-14 02:49:12', '2018-01-14 01:49:12', 68, 1),\
(1127, 1520, 'esta es la posicion 34,2, marina', 0, '2018-01-14 02:49:33', '2018-01-14 01:49:33', 68, 1),\
(1128, 1521, 'esta es la posicion 34,2, marina', 0, '2018-01-14 02:50:20', '2018-01-14 01:50:20', 68, 1),\
(1129, 1522, 'esta es la posicion 34,2, marina', 0, '2018-01-14 02:51:09', '2018-01-14 01:51:09', 68, 1),\
(1130, 1523, 'esta es la posicion 34,2, marina', 0, '2018-01-14 02:51:33', '2018-01-14 01:51:33', 68, 1),\
(1131, 1524, 'esta en la posicion 11,5, marina', 1, '2018-01-14 02:51:39', '2018-01-14 01:51:39', 68, 1),\
(1132, 1525, 'esta en la posicion 32,3 marina', 0, '2018-01-14 02:51:53', '2018-01-14 01:51:53', 68, 1),\
(1133, 1526, 'esta en la posicion 32,3 marina', 0, '2018-01-14 02:53:16', '2018-01-14 01:53:16', 68, 1),\
(1134, 1527, 'esta en la posicion 32,3, marina', 1, '2018-01-14 02:53:42', '2018-01-14 01:53:42', 68, 1),\
(1135, 1528, 'esta en la posicion 32,33 marina', 0, '2018-01-14 02:53:51', '2018-01-14 01:53:51', 68, 1),\
(1136, 1529, 'esta en la posicion 32,33, marina', 1, '2018-01-14 02:54:03', '2018-01-14 01:54:03', 68, 1),\
(1137, 1530, 'esta en la posicion 3243,3, marina', 1, '2018-01-14 02:54:21', '2018-01-14 01:54:21', 68, 1),\
(1138, 1531, 'esta en la posicion 3243,33, marina', 0, '2018-01-14 02:54:33', '2018-01-14 01:54:33', 68, 1),\
(1139, 1532, 'esta en la posicion 3243,3\'ba, marina', 0, '2018-01-14 03:04:14', '2018-01-14 02:04:14', 68, 1),\
(1140, 1533, 'esta en la posicion 3243,3\'ba, marina', 0, '2018-01-14 03:04:39', '2018-01-14 02:04:39', 68, 1),\
(1141, 1534, 'esta en la posicion 323,3\'ba, marina', 1, '2018-01-14 03:04:53', '2018-01-14 02:04:53', 68, 1),\
(1142, 1535, 'esta en la posicion 363,3\'ba, marina', 0, '2018-01-14 03:05:06', '2018-01-14 02:05:06', 68, 1),\
(1143, 1536, 'esta en la posicion 3,3\'ba, marina', 0, '2018-01-14 03:05:17', '2018-01-14 02:05:17', 68, 1),\
(1144, 1537, 'esta en la posicion 003,3\'ba, marina', 1, '2018-01-14 03:05:53', '2018-01-14 02:05:53', 68, 1),\
(1145, 1538, 'esta en la posicion 03,93\'ba, marina', 0, '2018-01-14 03:06:08', '2018-01-14 02:06:08', 68, 1),\
(1146, 1539, 'esta en la posicion GLOBAL, marina', 1, '2018-01-14 03:14:02', '2018-01-14 02:14:02', 68, 1),\
(1147, 1540, 'esta en la posicion SEA3, marina', 0, '2018-01-14 03:15:10', '2018-01-14 02:15:10', 68, 1),\
(1148, 1541, 'esta en la posicion SEA5, marina', 1, '2018-01-14 03:15:17', '2018-01-14 02:15:17', 68, 1),\
(1149, 1542, 'esta en la posicion GLOBAL, marina', 0, '2018-01-14 03:15:22', '2018-01-14 02:15:22', 68, 1),\
(1150, 1543, 'esta en la posicion Cape Trafalgar, marina', 0, '2018-01-14 03:17:34', '2018-01-14 02:17:34', 68, 1),\
(1151, 1544, 'esta en la posicion Cape Trafalgar, marina', 1, '2018-01-14 03:17:49', '2018-01-14 02:17:49', 68, 1),\
(1152, 1545, 'esta en la posicion hold, marina', 1, '2018-01-14 03:37:28', '2018-01-14 02:37:28', 68, 1),\
(1153, 1546, 'esta en la posicion main deck, marina', 0, '2018-01-14 03:37:53', '2018-01-14 02:37:53', 68, 1),\
(1154, 1547, 'esta en la posicion main deck, marina', 0, '2018-01-14 03:38:14', '2018-01-14 02:38:14', 68, 1),\
(1155, 1548, 'esta en la posicion the bridge, marina', 0, '2018-01-14 03:38:37', '2018-01-14 02:38:37', 68, 1),\
(1156, 1550, 'esta en la posicion the bridge, marina', 1, '2018-01-14 03:40:00', '2018-01-14 02:40:00', 68, 1),\
(1157, 1551, 'esta en la posicion the living spaces, marina', 1, '2018-01-14 03:40:17', '2018-01-14 02:40:17', 68, 1),\
(1158, 1552, 'the living spaces', 0, '2018-01-14 03:40:23', '2018-01-14 02:40:23', 68, 1),\
(1159, 1553, 'esta en la posicion hold the bridge, marina', 0, '2018-01-14 03:40:45', '2018-01-14 02:40:45', 68, 1),\
(1160, 1554, 'esta en la posicion hold the bridge, marina', 0, '2018-01-14 03:41:40', '2018-01-14 02:41:40', 68, 1),\
(1161, 1555, 'esta en la posicion hold the bridge, marina', 0, '2018-01-14 03:42:34', '2018-01-14 02:42:34', 68, 1),\
(1162, 1556, 'esta en la posicion hold the bridge, marina', 0, '2018-01-14 03:43:12', '2018-01-14 02:43:12', 68, 1),\
(1163, 1557, 'esta en la posicion the bridge, marina', 1, '2018-01-14 03:43:26', '2018-01-14 02:43:26', 68, 1),\
(1164, 1558, 'esta en la posicion hold the bridge, marina', 0, '2018-01-14 03:43:50', '2018-01-14 02:43:50', 68, 1),\
(1165, 1559, 'esta en la posicion the engine room, marina', 1, '2018-01-14 03:44:05', '2018-01-14 02:44:05', 68, 1),\
(1166, 1560, 'esta en la posicion BART4, marina', 1, '2018-01-15 21:02:14', '2018-01-15 20:02:14', 68, 1),\
(1167, 1561, 'esta en la posicion Foxy5, marina', 0, '2018-01-15 21:03:10', '2018-01-15 20:03:10', 68, 1),\
(1168, 1562, 'esta en la posicion Foxy5, marina', 1, '2018-01-15 21:03:53', '2018-01-15 20:03:53', 68, 1),\
(1169, 1563, 'esta en la posicion isolated danger, marina', 0, '2018-01-15 21:04:08', '2018-01-15 20:04:08', 68, 1),\
(1170, 1564, 'esta en la posicion isolated danger, marina', 1, '2018-01-15 21:11:44', '2018-01-15 20:11:44', 68, 1),\
(1171, 1565, 'esta en la posicion isolated danger, marina', 1, '2018-01-15 21:12:14', '2018-01-15 20:12:14', 68, 1),\
(1172, 1566, 'esta en la posicion isolated danger, marina', 1, '2018-01-15 21:14:39', '2018-01-15 20:14:39', 68, 1),\
(1173, 1567, 'esta en la posicion isolated danger, marina', 1, '2018-01-15 21:15:20', '2018-01-15 20:15:20', 68, 1),\
(1174, 1568, 'esta en la posicion Foxy5, marina', 1, '2018-01-15 21:15:41', '2018-01-15 20:15:41', 68, 1),\
(1175, 1569, 'esta en la posicion LUNDY, marina', 1, '2018-01-15 21:18:07', '2018-01-15 20:18:07', 68, 1),\
(1176, 1570, 'esta en la posicion 09876543, marina', 0, '2018-01-15 21:18:49', '2018-01-15 20:18:49', 68, 1),\
(1177, 1571, 'esta en la posicion -09876543, marina', 0, '2018-01-15 21:18:58', '2018-01-15 20:18:58', 68, 1),\
(1178, 1572, 'esta en la posicion 809876543, marina', 1, '2018-01-15 21:19:05', '2018-01-15 20:19:05', 68, 1),\
(1179, 1573, 'esta en la posicion Castor, marina', 1, '2018-01-15 21:20:17', '2018-01-15 20:20:17', 68, 1),\
(1180, 1574, 'esta en la posicion TRACY5, marina', 0, '2018-01-15 21:20:58', '2018-01-15 20:20:58', 68, 1),\
(1181, 1575, 'esta en la posicion TRACY5, marina', 1, '2018-01-15 21:21:22', '2018-01-15 20:21:22', 68, 1),\
(1182, 1576, 'esta en la posicion 78, marina', 1, '2018-01-15 21:21:48', '2018-01-15 20:21:48', 68, 1),\
(1183, 1577, 'esta en la posicion 76,8, marina', 0, '2018-01-15 21:21:54', '2018-01-15 20:21:54', 68, 1),\
(1184, 1578, 'esta en la posicion 98.9, marina', 0, '2018-01-15 21:22:01', '2018-01-15 20:22:01', 68, 1),\
(1185, 1579, 'esta en la posicion helicopter, marina', 1, '2018-01-15 21:22:36', '2018-01-15 20:22:36', 68, 1),\
(1186, 1580, 'esta en la posicion fire-fighting assistance, marina', 1, '2018-01-15 21:22:52', '2018-01-15 20:22:52', 68, 1),\
(1187, 1581, 'esta en la posicion a lifeboat, marina', 1, '2018-01-15 21:23:11', '2018-01-15 20:23:11', 68, 1),\
(1188, 1582, 'ekd', 0, '2018-01-15 21:25:43', '2018-01-15 20:25:43', 68, 1),\
(1189, 1583, 'esta en la posicion GLOBAL, marina', 1, '2018-01-15 21:25:51', '2018-01-15 20:25:51', 68, 1),\
(1190, 1584, 'esta en la posicion DELTA5, marina', 1, '2018-01-15 21:27:20', '2018-01-15 20:27:20', 68, 1),\
(1191, 1585, 'sta en la posicion 30, marina', 0, '2018-01-15 21:30:37', '2018-01-15 20:30:37', 68, 1),\
(1192, 1586, 'esta en la posicion DELTA5, marina', 0, '2018-01-15 21:31:19', '2018-01-15 20:31:19', 68, 1),\
(1193, 1587, 'esta en la posicion 30, marina', 1, '2018-01-15 21:31:27', '2018-01-15 20:31:27', 68, 1),\
(1194, 1588, 'esta en la posicion 32,1, marina', 1, '2018-01-15 21:31:41', '2018-01-15 20:31:41', 68, 1),\
(1195, 1589, 'esta en la posicion 32.1, marina', 0, '2018-01-15 21:31:50', '2018-01-15 20:31:50', 68, 1),\
(1196, 1590, 'esta en la posicion Blueway Station, marina', 0, '2018-01-15 21:34:00', '2018-01-15 20:34:00', 68, 1),\
(1197, 1591, 'esta en la posicion Blueway Station, marina', 0, '2018-01-15 21:34:21', '2018-01-15 20:34:21', 68, 1),\
(1198, 1592, 'esta en la posicion Tarifa VTS, marina', 1, '2018-01-15 21:35:19', '2018-01-15 20:35:19', 68, 1),\
(1199, 1593, 'esta en la posicion 2312, marina', 1, '2018-01-15 22:03:38', '2018-01-15 21:03:38', 68, 1),\
(1200, 1594, 'esta en la posicion 3212, marina', 0, '2018-01-15 22:03:50', '2018-01-15 21:03:50', 68, 1),\
(1201, 1595, 'esta en la posicion 2402, marina', 0, '2018-01-15 22:04:00', '2018-01-15 21:04:00', 68, 1),\
(1202, 1596, 'esta en la posicion 0021, marina', 1, '2018-01-15 22:04:12', '2018-01-15 21:04:12', 68, 1),\
(1203, 1598, 'esta en la posicion 1, marina', 1, '2018-01-15 22:06:37', '2018-01-15 21:06:37', 68, 1),\
(1204, 1599, 'd', 0, '2018-01-15 22:06:41', '2018-01-15 21:06:41', 68, 1),\
(1205, 1600, 'esta en la posicion 0, marina', 0, '2018-01-15 22:06:51', '2018-01-15 21:06:51', 68, 1),\
(1206, 1601, 'sta en la posicion 5,3, marina', 0, '2018-01-15 22:06:57', '2018-01-15 21:06:57', 68, 1),\
(1207, 1602, 'esta en la posicion 5,3, marina', 0, '2018-01-15 22:07:04', '2018-01-15 21:07:04', 68, 1),\
(1208, 1603, 'esta en la posicion 99, marina', 1, '2018-01-15 22:07:14', '2018-01-15 21:07:14', 68, 1),\
(1209, 1604, 'esta en la posicion B52, marina', 1, '2018-01-15 22:09:38', '2018-01-15 21:09:38', 68, 1),\
(1210, 1605, 'esta en la posicion B31, marina', 1, '2018-01-15 22:10:47', '2018-01-15 21:10:47', 68, 1),\
(1211, 1606, 'esta en la posicion GLOBAL, marina', 1, '2018-01-15 22:13:09', '2018-01-15 21:13:09', 68, 1),\
(1212, 1607, 'esta en la posicion 130, marina', 0, '2018-01-15 22:31:10', '2018-01-15 21:31:10', 68, 1),\
(1213, 1608, 'esta en la posicion 130, marina', 1, '2018-01-15 22:31:30', '2018-01-15 21:31:30', 68, 1),\
(1214, 1609, 'esta en la posicion 0, marina', 1, '2018-01-15 22:31:38', '2018-01-15 21:31:38', 68, 1),\
(1215, 1610, 'esta en la posicion 1300, marina', 1, '2018-01-15 22:31:44', '2018-01-15 21:31:44', 68, 1),\
(1216, 1611, 'esta en la posicion 1380, marina', 0, '2018-01-15 22:31:51', '2018-01-15 21:31:51', 68, 1),\
(1217, 1612, 'jn', 0, '2018-01-15 22:35:06', '2018-01-15 21:35:06', 1, 2),\
(1218, 1612, 'faaaaalso', 0, '2018-01-15 22:35:06', '2018-01-15 21:35:06', 2, 3),\
(1219, 1612, 'distress communicaionssdf', 1, '2018-01-15 22:35:06', '2018-01-15 21:35:06', 1, 3),\
(1220, 1612, 'navigational warning', 1, '2018-01-15 22:35:06', '2018-01-15 21:35:06', 3, 3),\
(1221, 1612, ',m', 0, '2018-01-15 22:35:06', '2018-01-15 21:35:06', 67, 4),\
(1222, 1613, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 01:57:10', '2018-01-17 00:57:10', 68, 1),\
(1223, 1614, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 01:59:04', '2018-01-17 00:59:04', 68, 1),\
(1224, 1615, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 01:59:59', '2018-01-17 00:59:59', 68, 1),\
(1225, 1616, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:00:35', '2018-01-17 01:00:35', 68, 1),\
(1226, 1617, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:01:16', '2018-01-17 01:01:16', 68, 1),\
(1227, 1618, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:01:37', '2018-01-17 01:01:37', 68, 1),\
(1228, 1619, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:01:55', '2018-01-17 01:01:55', 68, 1),\
(1229, 1620, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:02:04', '2018-01-17 01:02:04', 68, 1),\
(1230, 1621, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:02:27', '2018-01-17 01:02:27', 68, 1),\
(1231, 1622, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:02:46', '2018-01-17 01:02:46', 68, 1),\
(1232, 1623, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:03:15', '2018-01-17 01:03:15', 68, 1),\
(1233, 1624, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:03:41', '2018-01-17 01:03:41', 68, 1),\
(1234, 1625, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:04:08', '2018-01-17 01:04:08', 68, 1),\
(1235, 1626, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:04:23', '2018-01-17 01:04:23', 68, 1),\
(1236, 1627, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:05:07', '2018-01-17 01:05:07', 68, 1),\
(1237, 1628, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:06:48', '2018-01-17 01:06:48', 68, 1),\
(1238, 1629, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:17:42', '2018-01-17 01:17:42', 68, 1),\
(1239, 1630, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:18:04', '2018-01-17 01:18:04', 68, 1),\
(1240, 1631, 'esta en la posicion 25\'ba13,5\\'06\'92\'92N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:18:45', '2018-01-17 01:18:45', 68, 1),\
(1241, 1632, 'esta en la posicion 25\'ba13,5\\'06\'94N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:19:17', '2018-01-17 01:19:17', 68, 1),\
(1242, 1633, 'esta en la posicion 25\'ba13,5\\'06\'94N 126\'ba30,2\'9223\'92\'92 W, marina', 0, '2018-01-17 02:19:36', '2018-01-17 01:19:36', 68, 1),\
(1243, 1634, 'asdf', 0, '2018-01-17 02:40:43', '2018-01-17 01:40:43', 68, 1),\
(1244, 1635, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:41:14', '2018-01-17 01:41:14', 68, 1),\
(1245, 1636, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:42:08', '2018-01-17 01:42:08', 68, 1),\
(1246, 1637, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:42:40', '2018-01-17 01:42:40', 68, 1),\
(1247, 1638, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:42:51', '2018-01-17 01:42:51', 68, 1),\
(1248, 1639, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:43:07', '2018-01-17 01:43:07', 68, 1),\
(1249, 1640, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:43:16', '2018-01-17 01:43:16', 68, 1),\
(1250, 1641, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:43:46', '2018-01-17 01:43:46', 68, 1),\
(1251, 1642, 'esta en la posicion 25\'ba13,5\'9212,88\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 02:43:49', '2018-01-17 01:43:49', 68, 1),\
(1252, 1643, 'ad', 0, '2018-01-17 12:38:49', '2018-01-17 11:38:49', 68, 1),\
(1253, 1644, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:39:05', '2018-01-17 11:39:05', 68, 1),\
(1254, 1645, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:39:29', '2018-01-17 11:39:29', 68, 1),\
(1255, 1646, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:39:39', '2018-01-17 11:39:39', 68, 1),\
(1256, 1647, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:39:49', '2018-01-17 11:39:49', 68, 1),\
(1257, 1648, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:00', '2018-01-17 11:40:00', 68, 1),\
(1258, 1649, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:13', '2018-01-17 11:40:13', 68, 1),\
(1259, 1650, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:24', '2018-01-17 11:40:24', 68, 1),\
(1260, 1651, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:34', '2018-01-17 11:40:34', 68, 1),\
(1261, 1652, '25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:48', '2018-01-17 11:40:48', 68, 1),\
(1262, 1653, '25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:40:56', '2018-01-17 11:40:56', 68, 1),\
(1263, 1654, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:41:08', '2018-01-17 11:41:08', 68, 1),\
(1264, 1655, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:41:27', '2018-01-17 11:41:27', 68, 1),\
(1265, 1656, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:46:30', '2018-01-17 11:46:30', 68, 1),\
(1266, 1657, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:46:42', '2018-01-17 11:46:42', 68, 1),\
(1267, 1658, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:50:25', '2018-01-17 11:50:25', 68, 1),\
(1268, 1659, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:50:35', '2018-01-17 11:50:35', 68, 1),\
(1269, 1660, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:50:38', '2018-01-17 11:50:38', 68, 1),\
(1270, 1661, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:50:55', '2018-01-17 11:50:55', 68, 1),\
(1271, 1662, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:51:09', '2018-01-17 11:51:09', 68, 1),\
(1272, 1663, 'esta en la posicion 25\'ba13,5\'b412,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:51:28', '2018-01-17 11:51:28', 68, 1),\
(1273, 1664, 'esta en la posicion 25\'ba13,5\'b412,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:53:21', '2018-01-17 11:53:21', 68, 1),\
(1274, 1665, 'esta en la posicion 25\'ba13,5\'b412,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:53:32', '2018-01-17 11:53:32', 68, 1),\
(1275, 1666, 'esta en la posicion 25\'ba13,5\'b412,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:53:52', '2018-01-17 11:53:52', 68, 1),\
(1276, 1667, 'esta en la posicion 25\'ba13,5\'b412,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:54:22', '2018-01-17 11:54:22', 68, 1),\
(1277, 1668, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:54:36', '2018-01-17 11:54:36', 68, 1),\
(1278, 1669, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:55:06', '2018-01-17 11:55:06', 68, 1),\
(1279, 1670, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:55:14', '2018-01-17 11:55:14', 68, 1),\
(1280, 1671, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:55:41', '2018-01-17 11:55:41', 68, 1),\
(1281, 1672, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:56:18', '2018-01-17 11:56:18', 68, 1),\
(1282, 1673, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:56:44', '2018-01-17 11:56:44', 68, 1),\
(1283, 1674, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:57:03', '2018-01-17 11:57:03', 68, 1),\
(1284, 1675, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:57:15', '2018-01-17 11:57:15', 68, 1),\
(1285, 1676, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:59:00', '2018-01-17 11:59:00', 68, 1),\
(1286, 1677, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 12:59:39', '2018-01-17 11:59:39', 68, 1),\
(1287, 1678, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:00:32', '2018-01-17 12:00:32', 68, 1),\
(1288, 1679, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:00:50', '2018-01-17 12:00:50', 68, 1),\
(1289, 1680, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:01:08', '2018-01-17 12:01:08', 68, 1),\
(1290, 1681, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:01:51', '2018-01-17 12:01:51', 68, 1),\
(1291, 1682, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:02:31', '2018-01-17 12:02:31', 68, 1),\
(1292, 1683, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:02:50', '2018-01-17 12:02:50', 68, 1),\
(1293, 1684, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:03:01', '2018-01-17 12:03:01', 68, 1),\
(1294, 1685, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:03:18', '2018-01-17 12:03:18', 68, 1),\
(1295, 1686, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:03:38', '2018-01-17 12:03:38', 68, 1),\
(1296, 1687, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:03:47', '2018-01-17 12:03:47', 68, 1),\
(1297, 1688, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:04:21', '2018-01-17 12:04:21', 68, 1),\
(1298, 1689, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:04:28', '2018-01-17 12:04:28', 68, 1),\
(1299, 1690, 'esta en la posicion 25\'ba13,5\'9212,8\\"N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:04:53', '2018-01-17 12:04:53', 68, 1),\
(1300, 1691, 'esta en la posicion 25\'ba13,5\'9212,8\\"N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:05:01', '2018-01-17 12:05:01', 68, 1),\
(1301, 1692, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:05:12', '2018-01-17 12:05:12', 68, 1),\
(1302, 1693, '25\'ba13,5\'9212,8\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:05:47', '2018-01-17 12:05:47', 68, 1),\
(1303, 1694, 'esta en la posicion 25\'ba13,5\'9212,8\'94N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:06:13', '2018-01-17 12:06:13', 68, 1),\
(1304, 1695, '25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:35:16', '2018-01-17 12:35:16', 68, 1),\
(1305, 1696, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:35:36', '2018-01-17 12:35:36', 68, 1),\
(1306, 1697, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:37:24', '2018-01-17 12:37:24', 68, 1),\
(1307, 1698, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:37:41', '2018-01-17 12:37:41', 68, 1),\
(1308, 1699, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:37:52', '2018-01-17 12:37:52', 68, 1),\
(1309, 1700, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:38:12', '2018-01-17 12:38:12', 68, 1),\
(1310, 1701, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:38:20', '2018-01-17 12:38:20', 68, 1),\
(1311, 1702, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:38:45', '2018-01-17 12:38:45', 68, 1),\
(1312, 1703, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:43:32', '2018-01-17 12:43:32', 68, 1),\
(1313, 1704, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:43:43', '2018-01-17 12:43:43', 68, 1),\
(1314, 1705, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:44:12', '2018-01-17 12:44:12', 68, 1),\
(1315, 1706, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:52:50', '2018-01-17 12:52:50', 68, 1),\
(1316, 1707, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:53:13', '2018-01-17 12:53:13', 68, 1),\
(1317, 1708, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:54:05', '2018-01-17 12:54:05', 68, 1),\
(1318, 1709, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:54:29', '2018-01-17 12:54:29', 68, 1),\
(1319, 1710, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:54:40', '2018-01-17 12:54:40', 68, 1),\
(1320, 1711, 'esta en la posicion 25\'ba13,5\\'12,8\\'\\'N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:54:54', '2018-01-17 12:54:54', 68, 1),\
(1321, 1712, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92W 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:55:07', '2018-01-17 12:55:07', 68, 1),\
(1322, 1713, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:55:54', '2018-01-17 12:55:54', 68, 1),\
(1323, 1714, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:56:45', '2018-01-17 12:56:45', 68, 1),\
(1324, 1715, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:57:06', '2018-01-17 12:57:06', 68, 1),\
(1325, 1716, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:58:54', '2018-01-17 12:58:54', 68, 1),\
(1326, 1717, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:59:21', '2018-01-17 12:59:21', 68, 1),\
(1327, 1718, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 13:59:48', '2018-01-17 12:59:48', 68, 1),\
(1328, 1719, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:00:15', '2018-01-17 13:00:15', 68, 1),\
(1329, 1720, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:00:41', '2018-01-17 13:00:41', 68, 1),\
(1330, 1721, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:00:58', '2018-01-17 13:00:58', 68, 1),\
(1331, 1722, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:01:08', '2018-01-17 13:01:08', 68, 1),\
(1332, 1723, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:01:20', '2018-01-17 13:01:20', 68, 1),\
(1333, 1724, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:01:38', '2018-01-17 13:01:38', 68, 1),\
(1334, 1725, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:01:52', '2018-01-17 13:01:52', 68, 1),\
(1335, 1726, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:02:06', '2018-01-17 13:02:06', 68, 1),\
(1336, 1727, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:02:15', '2018-01-17 13:02:15', 68, 1),\
(1337, 1728, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:02:45', '2018-01-17 13:02:45', 68, 1),\
(1338, 1729, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:03:16', '2018-01-17 13:03:16', 68, 1),\
(1339, 1730, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:03:58', '2018-01-17 13:03:58', 68, 1),\
(1340, 1731, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:04:46', '2018-01-17 13:04:46', 68, 1),\
(1341, 1732, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:04:57', '2018-01-17 13:04:57', 68, 1),\
(1342, 1733, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:05:25', '2018-01-17 13:05:25', 68, 1),\
(1343, 1734, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:06:27', '2018-01-17 13:06:27', 68, 1),\
(1344, 1735, 'esta en la posicion 25\'ba63,4\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 14:06:39', '2018-01-17 13:06:39', 68, 1),\
(1345, 1736, 'nknkn', 0, '2018-01-17 17:38:14', '2018-01-17 16:38:14', 68, 1),\
(1346, 1737, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 17:38:29', '2018-01-17 16:38:29', 68, 1),\
(1347, 1738, ' esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:38:57', '2018-01-17 16:38:57', 68, 1),\
(1348, 1739, ' esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:39:41', '2018-01-17 16:39:41', 68, 1),\
(1349, 1740, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:39:59', '2018-01-17 16:39:59', 68, 1),\
(1350, 1741, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:40:12', '2018-01-17 16:40:12', 68, 1),\
(1351, 1742, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:40:42', '2018-01-17 16:40:42', 68, 1),\
(1352, 1743, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:41:08', '2018-01-17 16:41:08', 68, 1),\
(1353, 1744, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:41:46', '2018-01-17 16:41:46', 68, 1),\
(1354, 1745, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:42:20', '2018-01-17 16:42:20', 68, 1),\
(1355, 1746, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:44:24', '2018-01-17 16:44:24', 68, 1),\
(1356, 1747, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:44:38', '2018-01-17 16:44:38', 68, 1),\
(1357, 1748, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:45:03', '2018-01-17 16:45:03', 68, 1),\
(1358, 1749, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:45:05', '2018-01-17 16:45:05', 68, 1),\
(1359, 1750, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:45:23', '2018-01-17 16:45:23', 68, 1),\
(1360, 1751, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:45:49', '2018-01-17 16:45:49', 68, 1),\
(1361, 1752, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:46:45', '2018-01-17 16:46:45', 68, 1),\
(1362, 1753, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:46:47', '2018-01-17 16:46:47', 68, 1),\
(1363, 1754, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:47:07', '2018-01-17 16:47:07', 68, 1),\
(1364, 1755, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:47:50', '2018-01-17 16:47:50', 68, 1),\
(1365, 1756, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:48:37', '2018-01-17 16:48:37', 68, 1),\
(1366, 1757, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:48:45', '2018-01-17 16:48:45', 68, 1),\
(1367, 1758, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:50:05', '2018-01-17 16:50:05', 68, 1),\
(1368, 1759, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:50:48', '2018-01-17 16:50:48', 68, 1),\
(1369, 1760, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:50:56', '2018-01-17 16:50:56', 68, 1);\
INSERT INTO `entry` (`id`, `id_exam`, `answer`, `correct`, `date`, `time`, `id_question`, `id_type_question`) VALUES\
(1370, 1761, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:51:05', '2018-01-17 16:51:05', 68, 1),\
(1371, 1762, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:51:10', '2018-01-17 16:51:10', 68, 1),\
(1372, 1763, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:51:40', '2018-01-17 16:51:40', 68, 1),\
(1373, 1764, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229,8\'92\'92W, marina', 0, '2018-01-17 17:52:28', '2018-01-17 16:52:28', 68, 1),\
(1374, 1765, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N 126\'ba32,5\'9229,8\'92\'92W, marina', 0, '2018-01-17 17:52:45', '2018-01-17 16:52:45', 68, 1),\
(1375, 1766, 'esta es la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,8\\'\\'W, marina', 0, '2018-01-17 17:53:19', '2018-01-17 16:53:19', 68, 1),\
(1376, 1767, 'esta es la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,8\\'\\'W, marina', 0, '2018-01-17 17:53:40', '2018-01-17 16:53:40', 68, 1),\
(1377, 1768, 'esta es la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,8\\'\\'W, marina', 0, '2018-01-17 17:53:53', '2018-01-17 16:53:53', 68, 1),\
(1378, 1769, 'esta en la posicion 25\'ba13,5\'9212,8\'92\'92N126\'ba32,5\'9229\'92\'92W, marina', 0, '2018-01-17 17:54:03', '2018-01-17 16:54:03', 68, 1),\
(1379, 1770, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229\\'\\'W, marina', 0, '2018-01-17 17:54:37', '2018-01-17 16:54:37', 68, 1),\
(1380, 1771, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:54:58', '2018-01-17 16:54:58', 68, 1),\
(1381, 1772, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:55:22', '2018-01-17 16:55:22', 68, 1),\
(1382, 1773, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:55:54', '2018-01-17 16:55:54', 68, 1),\
(1383, 1774, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:56:18', '2018-01-17 16:56:18', 68, 1),\
(1384, 1775, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:56:59', '2018-01-17 16:56:59', 68, 1),\
(1385, 1777, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:57:52', '2018-01-17 16:57:52', 68, 1),\
(1386, 1778, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:58:07', '2018-01-17 16:58:07', 68, 1),\
(1387, 1779, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 17:58:41', '2018-01-17 16:58:41', 68, 1),\
(1388, 1780, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 0, '2018-01-17 18:04:40', '2018-01-17 17:04:40', 68, 1),\
(1389, 1781, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 1, '2018-01-17 18:08:35', '2018-01-17 17:08:35', 68, 1),\
(1390, 1782, 'esta en la posicion 25\'ba13,5\'9212,8\\'\\'N 126\'ba32,5\'9229,2\\'\\'W, marina', 1, '2018-01-17 18:08:50', '2018-01-17 17:08:50', 68, 1),\
(1391, 1783, 'esta en la posicion 43\'ba59,5\'9212,8\\'\\'S 226\'ba32,5\'9229,2\\'\\'E, marina', 1, '2018-01-18 01:58:38', '2018-01-18 00:58:38', 68, 1),\
(1392, 1784, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:45:10', '2018-02-22 16:45:10', 68, 1),\
(1393, 1785, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:48:17', '2018-02-22 16:48:17', 68, 1),\
(1394, 1786, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:49:40', '2018-02-22 16:49:40', 68, 1),\
(1395, 1787, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:50:34', '2018-02-22 16:50:34', 68, 1),\
(1396, 1788, ' esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:50:53', '2018-02-22 16:50:53', 68, 1),\
(1397, 1789, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:51:25', '2018-02-22 16:51:25', 68, 1),\
(1398, 1790, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 0, '2018-02-22 17:51:46', '2018-02-22 16:51:46', 68, 1),\
(1399, 1791, 'esta en la posicion 25\'ba13,5\\'06\\'\\'N126\'ba30,2\'9223\\'\\'W, marina', 1, '2018-02-22 17:59:14', '2018-02-22 16:59:14', 68, 1),\
(1400, 1792, 'The latest storm warning is as follows: Storm warning. Winds at $time$ in area $mv name$ from $cardi', 0, '2018-03-04 19:55:06', '2018-03-04 18:55:06', 65, 1),\
(1401, 1792, 'asd', 0, '2018-03-04 19:55:06', '2018-03-04 18:55:06', 68, 1),\
(1402, 1793, 'The latest storm warning is as follows: Storm warning. Winds at 2230 in area Casey from N', 1, '2018-03-04 19:55:19', '2018-03-04 18:55:19', 65, 1),\
(1403, 1793, 'asdfas', 0, '2018-03-04 19:55:19', '2018-03-04 18:55:19', 68, 1),\
(1404, 1794, 'I am manoeuvring with difficulty', 1, '2018-03-05 01:40:12', '2018-03-05 00:40:12', 59, 1),\
(1405, 1794, 'No, I cannot proceed without assistance', 1, '2018-03-05 01:40:12', '2018-03-05 00:40:12', 60, 1),\
(1406, 1795, 'No, I cannot proceed without assistance', 1, '2018-03-05 01:40:34', '2018-03-05 00:40:34', 60, 1),\
(1407, 1795, 'No, I cannot proceed without assistance', 0, '2018-03-05 01:40:34', '2018-03-05 00:40:34', 59, 1),\
(1408, 1796, 'asdf', 0, '2018-03-05 01:40:48', '2018-03-05 00:40:48', 59, 1),\
(1409, 1796, 'No, I cannot proceed without asasdfsistance', 0, '2018-03-05 01:40:48', '2018-03-05 00:40:48', 60, 1),\
(1410, 1797, 'I require tug assistance', 1, '2018-03-05 01:42:06', '2018-03-05 00:42:06', 59, 1),\
(1411, 1797, 'No, I cannot proceed without assistance', 1, '2018-03-05 01:42:06', '2018-03-05 00:42:06', 60, 1),\
(1412, 1798, 'eerg', 0, '2018-03-05 01:42:14', '2018-03-05 00:42:14', 59, 1),\
(1413, 1798, 'No, I cannot proceed without assistance', 1, '2018-03-05 01:42:14', '2018-03-05 00:42:14', 60, 1),\
(1414, 1799, 'asf', 0, '2018-03-05 01:42:22', '2018-03-05 00:42:22', 60, 1),\
(1415, 1799, 'asdf', 0, '2018-03-05 01:42:22', '2018-03-05 00:42:22', 59, 1);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `exam`\
--\
\
CREATE TABLE `exam` (\
  `id` int(11) NOT NULL,\
  `id_user` int(11) NOT NULL,\
  `num_questions` int(11) DEFAULT NULL,\
  `right` int(11) DEFAULT NULL,\
  `wrong` int(11) DEFAULT NULL,\
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,\
  `final_test` tinyint(1) NOT NULL DEFAULT '0',\
  `level` int(11) NOT NULL DEFAULT '1',\
  `likert` int(1) DEFAULT NULL,\
  `id_category` int(20) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `exam`\
--\
\
INSERT INTO `exam` (`id`, `id_user`, `num_questions`, `right`, `wrong`, `date`, `final_test`, `level`, `likert`, `id_category`) VALUES\
(1309, 1, 5, 0, 5, '2017-09-15 14:53:17', 0, 2, 0, NULL),\
(1345, 1, 8, 4, 4, '2017-10-09 02:49:20', 1, 1, 0, NULL),\
(1347, 1, 5, 4, 1, '2017-10-11 08:26:08', 0, 1, 0, NULL),\
(1348, 1, 5, 4, 1, '2017-10-11 08:28:39', 0, 1, 0, NULL),\
(1349, 1, 5, 4, 1, '2017-10-11 08:28:51', 0, 1, 0, NULL),\
(1350, 1, 5, 2, 3, '2017-10-11 09:41:34', 0, 1, 0, NULL),\
(1351, 1, 5, 2, 3, '2017-10-11 10:08:42', 0, 1, 0, NULL),\
(1352, 1, 5, 1, 4, '2017-10-11 10:11:04', 0, 1, 0, NULL),\
(1353, 1, 5, 1, 4, '2017-10-11 10:11:12', 0, 1, 0, NULL),\
(1354, 1, 5, 2, 3, '2017-10-11 10:12:48', 0, 1, 0, NULL),\
(1355, 1, 5, 2, 3, '2017-10-11 11:39:17', 0, 1, 0, NULL),\
(1360, 1, 8, 1, 7, '2017-10-13 22:51:47', 1, 1, 0, NULL),\
(1361, 1, 8, 1, 7, '2017-10-14 00:29:18', 1, 1, 0, NULL),\
(1362, 1, 8, 2, 6, '2017-10-14 00:34:23', 1, 1, 0, NULL),\
(1363, 1, 8, 2, 6, '2017-10-14 00:36:12', 1, 1, 0, NULL),\
(1364, 1, 8, 2, 6, '2017-10-14 00:36:47', 1, 1, 0, NULL),\
(1390, 1, 5, 0, 5, '2017-10-16 01:30:46', 0, 2, NULL, NULL),\
(1392, 1, 5, 0, 5, '2017-10-16 03:57:28', 0, 2, NULL, NULL),\
(1393, 1, 5, 1, 4, '2017-10-16 03:58:48', 0, 1, NULL, NULL),\
(1394, 1, 1, 0, 1, '2017-10-16 13:05:36', 0, 1, NULL, NULL),\
(1395, 1, NULL, NULL, NULL, '2017-10-16 13:06:54', 0, 1, NULL, NULL),\
(1396, 1, 1, 0, 1, '2017-10-16 13:07:00', 0, 1, NULL, NULL),\
(1397, 1, 1, 0, 1, '2017-10-16 22:54:43', 1, 1, 4, NULL),\
(1398, 1, 1, 0, 1, '2017-10-16 22:56:08', 1, 1, 4, NULL),\
(1399, 1, 1, 0, 1, '2017-10-16 22:59:07', 1, 1, 4, NULL),\
(1400, 1, 1, 0, 1, '2017-10-16 22:59:13', 1, 1, 2, NULL),\
(1424, 1, 3, 0, 3, '2017-10-17 03:48:54', 0, 2, NULL, NULL),\
(1425, 1, 1, 0, 1, '2017-10-30 18:01:32', 1, 1, 3, NULL),\
(1426, 1, 1, 0, 1, '2017-10-30 18:02:10', 1, 1, 5, NULL),\
(1427, 1, 1, 0, 1, '2017-10-30 18:03:14', 1, 1, 4, NULL),\
(1428, 1, 1, 0, 1, '2017-12-29 17:52:36', 1, 1, 1, NULL),\
(1429, 1, 5, 2, 3, '2017-12-29 17:56:18', 0, 1, NULL, NULL),\
(1430, 1, 1, 1, 0, '2018-01-06 19:17:55', 0, 2, NULL, NULL),\
(1431, 1, 1, 1, 0, '2018-01-06 19:21:18', 0, 2, NULL, NULL),\
(1432, 1, 1, 1, 0, '2018-01-06 19:21:45', 0, 2, NULL, NULL),\
(1433, 1, 1, 1, 0, '2018-01-06 19:22:42', 0, 2, NULL, NULL),\
(1434, 1, 1, 1, 0, '2018-01-06 19:25:40', 0, 2, NULL, NULL),\
(1435, 1, 1, 1, 0, '2018-01-06 19:25:52', 0, 2, NULL, NULL),\
(1436, 1, 1, 1, 0, '2018-01-06 19:26:08', 0, 2, NULL, NULL),\
(1437, 1, 1, 0, 1, '2018-01-06 19:26:43', 0, 2, NULL, NULL),\
(1438, 1, 1, 0, 1, '2018-01-06 19:29:18', 0, 2, NULL, NULL),\
(1439, 1, 1, 1, 0, '2018-01-06 19:29:32', 0, 2, NULL, NULL),\
(1440, 1, 1, 1, 0, '2018-01-06 19:31:37', 0, 2, NULL, NULL),\
(1441, 1, 1, 1, 0, '2018-01-06 19:31:52', 0, 2, NULL, NULL),\
(1442, 1, 1, 0, 1, '2018-01-06 19:32:11', 0, 2, NULL, NULL),\
(1443, 1, 1, 0, 1, '2018-01-06 19:32:30', 0, 2, NULL, NULL),\
(1444, 1, 1, 0, 1, '2018-01-06 19:32:45', 0, 2, NULL, NULL),\
(1445, 1, 1, 0, 1, '2018-01-06 19:33:54', 0, 2, NULL, NULL),\
(1446, 1, 1, 0, 1, '2018-01-06 19:34:06', 0, 2, NULL, NULL),\
(1447, 1, 1, 1, 0, '2018-01-06 19:34:41', 0, 2, NULL, NULL),\
(1448, 1, 1, 0, 1, '2018-01-06 19:34:55', 0, 2, NULL, NULL),\
(1449, 1, 1, 1, 0, '2018-01-06 19:35:09', 0, 2, NULL, NULL),\
(1450, 1, 1, 0, 1, '2018-01-07 23:45:46', 1, 1, 3, NULL),\
(1451, 1, 1, 0, 1, '2018-01-07 23:48:56', 1, 1, 3, NULL),\
(1452, 1, 1, 0, 1, '2018-01-07 23:50:38', 1, 1, 3, NULL),\
(1453, 1, 1, 0, 1, '2018-01-07 23:50:55', 1, 1, 2, NULL),\
(1454, 1, 1, 0, 1, '2018-01-07 23:55:26', 1, 1, 2, NULL),\
(1455, 1, 1, 0, 1, '2018-01-08 00:00:21', 0, 2, NULL, NULL),\
(1456, 1, 1, 0, 1, '2018-01-08 00:01:31', 0, 2, NULL, NULL),\
(1457, 1, 4, 0, 4, '2018-01-08 00:11:13', 1, 1, 2, NULL),\
(1458, 1, 4, 1, 3, '2018-01-08 00:11:43', 1, 1, 3, NULL),\
(1459, 1, 3, 2, 1, '2018-01-08 00:13:49', 0, 1, NULL, NULL),\
(1460, 1, 3, 1, 2, '2018-01-08 00:14:03', 0, 1, NULL, NULL),\
(1461, 1, 5, 0, 5, '2018-01-08 00:58:18', 0, 2, NULL, NULL),\
(1462, 1, 5, 0, 5, '2018-01-08 01:00:10', 0, 2, NULL, NULL),\
(1463, 1, 5, 0, 5, '2018-01-08 01:00:24', 0, 2, NULL, NULL),\
(1464, 1, 5, 0, 5, '2018-01-08 01:00:45', 0, 2, NULL, NULL),\
(1465, 1, 5, 0, 5, '2018-01-08 01:01:06', 0, 2, NULL, NULL),\
(1466, 1, 1, 0, 1, '2018-01-08 01:02:47', 0, 1, NULL, NULL),\
(1467, 1, 1, 0, 1, '2018-01-08 01:02:57', 0, 1, NULL, NULL),\
(1468, 1, 3, 1, 2, '2018-01-08 01:21:38', 0, 1, NULL, 7),\
(1469, 1, 1, 0, 1, '2018-01-08 01:28:00', 0, 2, NULL, NULL),\
(1470, 1, 1, 0, 1, '2018-01-08 01:28:20', 0, 2, NULL, NULL),\
(1471, 1, 1, 0, 1, '2018-01-08 01:31:19', 0, 2, NULL, NULL),\
(1472, 1, 1, 0, 1, '2018-01-08 01:32:17', 0, 2, NULL, 19),\
(1473, 1, 1, 0, 1, '2018-01-08 01:34:56', 0, 2, NULL, 19),\
(1474, 1, 1, 0, 1, '2018-01-08 01:43:16', 0, 2, NULL, 16),\
(1475, 1, 1, 0, 1, '2018-01-14 00:28:20', 0, 2, NULL, 43),\
(1476, 1, 1, 1, 0, '2018-01-14 00:28:50', 0, 2, NULL, 43),\
(1477, 1, 1, 1, 0, '2018-01-14 00:29:49', 0, 2, NULL, 43),\
(1478, 1, 1, 1, 0, '2018-01-14 00:30:13', 0, 2, NULL, 43),\
(1479, 1, 1, 0, 1, '2018-01-14 00:30:31', 0, 2, NULL, 43),\
(1480, 1, 1, 1, 0, '2018-01-14 00:30:52', 0, 2, NULL, 43),\
(1481, 1, 1, 0, 1, '2018-01-14 00:31:06', 0, 2, NULL, 43),\
(1482, 1, 1, 1, 0, '2018-01-14 00:44:15', 0, 2, NULL, 43),\
(1483, 1, 1, 1, 0, '2018-01-14 00:46:04', 0, 2, NULL, 43),\
(1484, 1, 1, 1, 0, '2018-01-14 00:46:17', 0, 2, NULL, 43),\
(1485, 1, 1, 1, 0, '2018-01-14 00:47:51', 0, 2, NULL, 43),\
(1486, 1, 1, 0, 1, '2018-01-14 00:47:59', 0, 2, NULL, 43),\
(1487, 1, 1, 0, 1, '2018-01-14 00:54:02', 0, 2, NULL, 43),\
(1488, 1, 1, 0, 1, '2018-01-14 00:55:51', 0, 2, NULL, 43),\
(1489, 1, 1, 0, 1, '2018-01-14 00:56:10', 0, 2, NULL, 43),\
(1490, 1, 1, 0, 1, '2018-01-14 00:59:24', 0, 2, NULL, 43),\
(1491, 1, 1, 0, 1, '2018-01-14 00:59:45', 0, 2, NULL, 43),\
(1492, 1, 1, 0, 1, '2018-01-14 00:59:52', 0, 2, NULL, 43),\
(1493, 1, 1, 0, 1, '2018-01-14 01:00:22', 0, 2, NULL, 43),\
(1494, 1, 1, 0, 1, '2018-01-14 01:00:31', 0, 2, NULL, 43),\
(1495, 1, NULL, NULL, NULL, '2018-01-14 01:01:35', 0, 2, NULL, 43),\
(1496, 1, 1, 0, 1, '2018-01-14 01:01:57', 0, 2, NULL, 43),\
(1497, 1, 1, 0, 1, '2018-01-14 01:02:11', 0, 2, NULL, 43),\
(1498, 1, 1, 1, 0, '2018-01-14 01:02:29', 0, 2, NULL, 43),\
(1499, 1, 1, 1, 0, '2018-01-14 01:02:53', 0, 2, NULL, 43),\
(1500, 1, 1, 1, 0, '2018-01-14 01:03:29', 0, 2, NULL, 43),\
(1501, 1, 1, 0, 1, '2018-01-14 01:03:43', 0, 2, NULL, 43),\
(1502, 1, 1, 1, 0, '2018-01-14 01:10:43', 0, 2, NULL, 43),\
(1503, 1, 1, 1, 0, '2018-01-14 01:11:05', 0, 2, NULL, 43),\
(1504, 1, 1, 1, 0, '2018-01-14 01:11:25', 0, 2, NULL, 43),\
(1505, 1, 1, 0, 1, '2018-01-14 01:11:46', 0, 2, NULL, 43),\
(1506, 1, 1, 0, 1, '2018-01-14 01:12:15', 0, 2, NULL, 43),\
(1507, 1, 1, 0, 1, '2018-01-14 01:13:00', 0, 2, NULL, 43),\
(1508, 1, 1, 0, 1, '2018-01-14 01:13:17', 0, 2, NULL, 43),\
(1509, 1, 1, 1, 0, '2018-01-14 01:17:27', 0, 2, NULL, 43),\
(1510, 1, 1, 0, 1, '2018-01-14 01:17:33', 0, 2, NULL, 43),\
(1511, 1, 1, 1, 0, '2018-01-14 01:20:16', 0, 2, NULL, 43),\
(1512, 1, 1, 0, 1, '2018-01-14 01:20:31', 0, 2, NULL, 43),\
(1513, 1, 1, 0, 1, '2018-01-14 01:35:15', 0, 2, NULL, 43),\
(1514, 1, 1, 1, 0, '2018-01-14 01:36:49', 0, 2, NULL, 43),\
(1515, 1, 1, 1, 0, '2018-01-14 01:37:07', 0, 2, NULL, 43),\
(1516, 1, 1, 1, 0, '2018-01-14 01:42:14', 0, 2, NULL, 43),\
(1517, 1, 1, 0, 1, '2018-01-14 01:48:20', 0, 2, NULL, 43),\
(1518, 1, 1, 1, 0, '2018-01-14 01:48:50', 0, 2, NULL, 43),\
(1519, 1, 1, 0, 1, '2018-01-14 01:49:12', 0, 2, NULL, 43),\
(1520, 1, 1, 0, 1, '2018-01-14 01:49:33', 0, 2, NULL, 43),\
(1521, 1, 1, 0, 1, '2018-01-14 01:50:20', 0, 2, NULL, 43),\
(1522, 1, 1, 0, 1, '2018-01-14 01:51:09', 0, 2, NULL, 43),\
(1523, 1, 1, 0, 1, '2018-01-14 01:51:33', 0, 2, NULL, 43),\
(1524, 1, 1, 1, 0, '2018-01-14 01:51:39', 0, 2, NULL, 43),\
(1525, 1, 1, 0, 1, '2018-01-14 01:51:53', 0, 2, NULL, 43),\
(1526, 1, 1, 0, 1, '2018-01-14 01:53:16', 0, 2, NULL, 43),\
(1527, 1, 1, 1, 0, '2018-01-14 01:53:42', 0, 2, NULL, 43),\
(1528, 1, 1, 0, 1, '2018-01-14 01:53:51', 0, 2, NULL, 43),\
(1529, 1, 1, 1, 0, '2018-01-14 01:54:03', 0, 2, NULL, 43),\
(1530, 1, 1, 1, 0, '2018-01-14 01:54:21', 0, 2, NULL, 43),\
(1531, 1, 1, 0, 1, '2018-01-14 01:54:33', 0, 2, NULL, 43),\
(1532, 1, 1, 0, 1, '2018-01-14 02:04:14', 0, 2, NULL, 43),\
(1533, 1, 1, 0, 1, '2018-01-14 02:04:39', 0, 2, NULL, 43),\
(1534, 1, 1, 1, 0, '2018-01-14 02:04:53', 0, 2, NULL, 43),\
(1535, 1, 1, 0, 1, '2018-01-14 02:05:06', 0, 2, NULL, 43),\
(1536, 1, 1, 0, 1, '2018-01-14 02:05:17', 0, 2, NULL, 43),\
(1537, 1, 1, 1, 0, '2018-01-14 02:05:53', 0, 2, NULL, 43),\
(1538, 1, 1, 0, 1, '2018-01-14 02:06:08', 0, 2, NULL, 43),\
(1539, 1, 1, 1, 0, '2018-01-14 02:14:02', 0, 2, NULL, 43),\
(1540, 1, 1, 0, 1, '2018-01-14 02:15:10', 0, 2, NULL, 43),\
(1541, 1, 1, 1, 0, '2018-01-14 02:15:17', 0, 2, NULL, 43),\
(1542, 1, 1, 0, 1, '2018-01-14 02:15:22', 0, 2, NULL, 43),\
(1543, 1, 1, 0, 1, '2018-01-14 02:17:34', 0, 2, NULL, 43),\
(1544, 1, 1, 1, 0, '2018-01-14 02:17:49', 0, 2, NULL, 43),\
(1545, 1, 1, 1, 0, '2018-01-14 02:37:28', 0, 2, NULL, 43),\
(1546, 1, 1, 0, 1, '2018-01-14 02:37:53', 0, 2, NULL, 43),\
(1547, 1, 1, 0, 1, '2018-01-14 02:38:14', 0, 2, NULL, 43),\
(1548, 1, 1, 0, 1, '2018-01-14 02:38:37', 0, 2, NULL, 43),\
(1549, 1, NULL, NULL, NULL, '2018-01-14 02:39:26', 0, 2, NULL, 43),\
(1550, 1, 1, 1, 0, '2018-01-14 02:40:00', 0, 2, NULL, 43),\
(1551, 1, 1, 1, 0, '2018-01-14 02:40:17', 0, 2, NULL, 43),\
(1552, 1, 1, 0, 1, '2018-01-14 02:40:23', 0, 2, NULL, 43),\
(1553, 1, 1, 0, 1, '2018-01-14 02:40:45', 0, 2, NULL, 43),\
(1554, 1, 1, 0, 1, '2018-01-14 02:41:40', 0, 2, NULL, 43),\
(1555, 1, 1, 0, 1, '2018-01-14 02:42:34', 0, 2, NULL, 43),\
(1556, 1, 1, 0, 1, '2018-01-14 02:43:12', 0, 2, NULL, 43),\
(1557, 1, 1, 1, 0, '2018-01-14 02:43:26', 0, 2, NULL, 43),\
(1558, 1, 1, 0, 1, '2018-01-14 02:43:50', 0, 2, NULL, 43),\
(1559, 1, 1, 1, 0, '2018-01-14 02:44:05', 0, 2, NULL, 43),\
(1560, 1, 1, 1, 0, '2018-01-15 20:02:14', 0, 2, NULL, 43),\
(1561, 1, 1, 0, 1, '2018-01-15 20:03:10', 0, 2, NULL, 43),\
(1562, 1, 1, 1, 0, '2018-01-15 20:03:53', 0, 2, NULL, 43),\
(1563, 1, 1, 0, 1, '2018-01-15 20:04:08', 0, 2, NULL, 43),\
(1564, 1, 1, 1, 0, '2018-01-15 20:11:44', 0, 2, NULL, 43),\
(1565, 1, 1, 1, 0, '2018-01-15 20:12:14', 0, 2, NULL, 43),\
(1566, 1, 1, 1, 0, '2018-01-15 20:14:39', 0, 2, NULL, 43),\
(1567, 1, 1, 1, 0, '2018-01-15 20:15:20', 0, 2, NULL, 43),\
(1568, 1, 1, 1, 0, '2018-01-15 20:15:41', 0, 2, NULL, 43),\
(1569, 1, 1, 1, 0, '2018-01-15 20:18:07', 0, 2, NULL, 43),\
(1570, 1, 1, 0, 1, '2018-01-15 20:18:49', 0, 2, NULL, 43),\
(1571, 1, 1, 0, 1, '2018-01-15 20:18:58', 0, 2, NULL, 43),\
(1572, 1, 1, 1, 0, '2018-01-15 20:19:05', 0, 2, NULL, 43),\
(1573, 1, 1, 1, 0, '2018-01-15 20:20:17', 0, 2, NULL, 43),\
(1574, 1, 1, 0, 1, '2018-01-15 20:20:58', 0, 2, NULL, 43),\
(1575, 1, 1, 1, 0, '2018-01-15 20:21:22', 0, 2, NULL, 43),\
(1576, 1, 1, 1, 0, '2018-01-15 20:21:48', 0, 2, NULL, 43),\
(1577, 1, 1, 0, 1, '2018-01-15 20:21:54', 0, 2, NULL, 43),\
(1578, 1, 1, 0, 1, '2018-01-15 20:22:01', 0, 2, NULL, 43),\
(1579, 1, 1, 1, 0, '2018-01-15 20:22:36', 0, 2, NULL, 43),\
(1580, 1, 1, 1, 0, '2018-01-15 20:22:52', 0, 2, NULL, 43),\
(1581, 1, 1, 1, 0, '2018-01-15 20:23:11', 0, 2, NULL, 43),\
(1582, 1, 1, 0, 1, '2018-01-15 20:25:43', 0, 2, NULL, 43),\
(1583, 1, 1, 1, 0, '2018-01-15 20:25:51', 0, 2, NULL, 43),\
(1584, 1, 1, 1, 0, '2018-01-15 20:27:20', 0, 2, NULL, 43),\
(1585, 1, 1, 0, 1, '2018-01-15 20:30:37', 0, 2, NULL, 43),\
(1586, 1, 1, 0, 1, '2018-01-15 20:31:19', 0, 2, NULL, 43),\
(1587, 1, 1, 1, 0, '2018-01-15 20:31:27', 0, 2, NULL, 43),\
(1588, 1, 1, 1, 0, '2018-01-15 20:31:40', 0, 2, NULL, 43),\
(1589, 1, 1, 0, 1, '2018-01-15 20:31:50', 0, 2, NULL, 43),\
(1590, 1, 1, 0, 1, '2018-01-15 20:34:00', 0, 2, NULL, 43),\
(1591, 1, 1, 0, 1, '2018-01-15 20:34:21', 0, 2, NULL, 43),\
(1592, 1, 1, 1, 0, '2018-01-15 20:35:19', 0, 2, NULL, 43),\
(1593, 1, 1, 1, 0, '2018-01-15 21:03:38', 0, 2, NULL, 43),\
(1594, 1, 1, 0, 1, '2018-01-15 21:03:50', 0, 2, NULL, 43),\
(1595, 1, 1, 0, 1, '2018-01-15 21:04:00', 0, 2, NULL, 43),\
(1596, 1, 1, 1, 0, '2018-01-15 21:04:12', 0, 2, NULL, 43),\
(1597, 1, NULL, NULL, NULL, '2018-01-15 21:06:15', 0, 2, NULL, 43),\
(1598, 1, 1, 1, 0, '2018-01-15 21:06:37', 0, 2, NULL, 43),\
(1599, 1, 1, 0, 1, '2018-01-15 21:06:41', 0, 2, NULL, 43),\
(1600, 1, 1, 0, 1, '2018-01-15 21:06:51', 0, 2, NULL, 43),\
(1601, 1, 1, 0, 1, '2018-01-15 21:06:57', 0, 2, NULL, 43),\
(1602, 1, 1, 0, 1, '2018-01-15 21:07:04', 0, 2, NULL, 43),\
(1603, 1, 1, 1, 0, '2018-01-15 21:07:14', 0, 2, NULL, 43),\
(1604, 1, 1, 1, 0, '2018-01-15 21:09:38', 0, 2, NULL, 43),\
(1605, 1, 1, 1, 0, '2018-01-15 21:10:47', 0, 2, NULL, 43),\
(1606, 1, 1, 1, 0, '2018-01-15 21:13:09', 0, 2, NULL, 43),\
(1607, 1, 1, 0, 1, '2018-01-15 21:31:10', 0, 2, NULL, 43),\
(1608, 1, 1, 1, 0, '2018-01-15 21:31:30', 0, 2, NULL, 43),\
(1609, 1, 1, 1, 0, '2018-01-15 21:31:38', 0, 2, NULL, 43),\
(1610, 1, 1, 1, 0, '2018-01-15 21:31:44', 0, 2, NULL, 43),\
(1611, 1, 1, 0, 1, '2018-01-15 21:31:51', 0, 2, NULL, 43),\
(1612, 1, 5, 2, 3, '2018-01-15 21:35:06', 0, 1, NULL, 1),\
(1613, 1, 1, 0, 1, '2018-01-17 00:57:10', 0, 2, NULL, 43),\
(1614, 1, 1, 0, 1, '2018-01-17 00:59:04', 0, 2, NULL, 43),\
(1615, 1, 1, 0, 1, '2018-01-17 00:59:59', 0, 2, NULL, 43),\
(1616, 1, 1, 0, 1, '2018-01-17 01:00:35', 0, 2, NULL, 43),\
(1617, 1, 1, 0, 1, '2018-01-17 01:01:16', 0, 2, NULL, 43),\
(1618, 1, 1, 0, 1, '2018-01-17 01:01:37', 0, 2, NULL, 43),\
(1619, 1, 1, 0, 1, '2018-01-17 01:01:55', 0, 2, NULL, 43),\
(1620, 1, 1, 0, 1, '2018-01-17 01:02:04', 0, 2, NULL, 43),\
(1621, 1, 1, 0, 1, '2018-01-17 01:02:27', 0, 2, NULL, 43),\
(1622, 1, 1, 0, 1, '2018-01-17 01:02:46', 0, 2, NULL, 43),\
(1623, 1, 1, 0, 1, '2018-01-17 01:03:15', 0, 2, NULL, 43),\
(1624, 1, 1, 0, 1, '2018-01-17 01:03:41', 0, 2, NULL, 43),\
(1625, 1, 1, 0, 1, '2018-01-17 01:04:08', 0, 2, NULL, 43),\
(1626, 1, 1, 0, 1, '2018-01-17 01:04:23', 0, 2, NULL, 43),\
(1627, 1, 1, 0, 1, '2018-01-17 01:05:07', 0, 2, NULL, 43),\
(1628, 1, 1, 0, 1, '2018-01-17 01:06:48', 0, 2, NULL, 43),\
(1629, 1, 1, 0, 1, '2018-01-17 01:17:42', 0, 2, NULL, 43),\
(1630, 1, 1, 0, 1, '2018-01-17 01:18:04', 0, 2, NULL, 43),\
(1631, 1, 1, 0, 1, '2018-01-17 01:18:45', 0, 2, NULL, 43),\
(1632, 1, 1, 0, 1, '2018-01-17 01:19:17', 0, 2, NULL, 43),\
(1633, 1, 1, 0, 1, '2018-01-17 01:19:36', 0, 2, NULL, 43),\
(1634, 1, 1, 0, 1, '2018-01-17 01:40:43', 0, 2, NULL, 43),\
(1635, 1, 1, 0, 1, '2018-01-17 01:41:14', 0, 2, NULL, 43),\
(1636, 1, 1, 0, 1, '2018-01-17 01:42:08', 0, 2, NULL, 43),\
(1637, 1, 1, 0, 1, '2018-01-17 01:42:40', 0, 2, NULL, 43),\
(1638, 1, 1, 0, 1, '2018-01-17 01:42:51', 0, 2, NULL, 43),\
(1639, 1, 1, 0, 1, '2018-01-17 01:43:07', 0, 2, NULL, 43),\
(1640, 1, 1, 0, 1, '2018-01-17 01:43:16', 0, 2, NULL, 43),\
(1641, 1, 1, 0, 1, '2018-01-17 01:43:46', 0, 2, NULL, 43),\
(1642, 1, 1, 0, 1, '2018-01-17 01:43:49', 0, 2, NULL, 43),\
(1643, 1, 1, 0, 1, '2018-01-17 11:38:49', 0, 2, NULL, 43),\
(1644, 1, 1, 0, 1, '2018-01-17 11:39:05', 0, 2, NULL, 43),\
(1645, 1, 1, 0, 1, '2018-01-17 11:39:29', 0, 2, NULL, 43),\
(1646, 1, 1, 0, 1, '2018-01-17 11:39:39', 0, 2, NULL, 43),\
(1647, 1, 1, 0, 1, '2018-01-17 11:39:49', 0, 2, NULL, 43),\
(1648, 1, 1, 0, 1, '2018-01-17 11:40:00', 0, 2, NULL, 43),\
(1649, 1, 1, 0, 1, '2018-01-17 11:40:13', 0, 2, NULL, 43),\
(1650, 1, 1, 0, 1, '2018-01-17 11:40:24', 0, 2, NULL, 43),\
(1651, 1, 1, 0, 1, '2018-01-17 11:40:34', 0, 2, NULL, 43),\
(1652, 1, 1, 0, 1, '2018-01-17 11:40:48', 0, 2, NULL, 43),\
(1653, 1, 1, 0, 1, '2018-01-17 11:40:56', 0, 2, NULL, 43),\
(1654, 1, 1, 0, 1, '2018-01-17 11:41:08', 0, 2, NULL, 43),\
(1655, 1, 1, 0, 1, '2018-01-17 11:41:27', 0, 2, NULL, 43),\
(1656, 1, 1, 0, 1, '2018-01-17 11:46:30', 0, 2, NULL, 43),\
(1657, 1, 1, 0, 1, '2018-01-17 11:46:42', 0, 2, NULL, 43),\
(1658, 1, 1, 0, 1, '2018-01-17 11:50:25', 0, 2, NULL, 43),\
(1659, 1, 1, 0, 1, '2018-01-17 11:50:35', 0, 2, NULL, 43),\
(1660, 1, 1, 0, 1, '2018-01-17 11:50:38', 0, 2, NULL, 43),\
(1661, 1, 1, 0, 1, '2018-01-17 11:50:55', 0, 2, NULL, 43),\
(1662, 1, 1, 0, 1, '2018-01-17 11:51:09', 0, 2, NULL, 43),\
(1663, 1, 1, 0, 1, '2018-01-17 11:51:28', 0, 2, NULL, 43),\
(1664, 1, 1, 0, 1, '2018-01-17 11:53:21', 0, 2, NULL, 43),\
(1665, 1, 1, 0, 1, '2018-01-17 11:53:32', 0, 2, NULL, 43),\
(1666, 1, 1, 0, 1, '2018-01-17 11:53:52', 0, 2, NULL, 43),\
(1667, 1, 1, 0, 1, '2018-01-17 11:54:22', 0, 2, NULL, 43),\
(1668, 1, 1, 0, 1, '2018-01-17 11:54:36', 0, 2, NULL, 43),\
(1669, 1, 1, 0, 1, '2018-01-17 11:55:06', 0, 2, NULL, 43),\
(1670, 1, 1, 0, 1, '2018-01-17 11:55:14', 0, 2, NULL, 43),\
(1671, 1, 1, 0, 1, '2018-01-17 11:55:41', 0, 2, NULL, 43),\
(1672, 1, 1, 0, 1, '2018-01-17 11:56:18', 0, 2, NULL, 43),\
(1673, 1, 1, 0, 1, '2018-01-17 11:56:44', 0, 2, NULL, 43),\
(1674, 1, 1, 0, 1, '2018-01-17 11:57:03', 0, 2, NULL, 43),\
(1675, 1, 1, 0, 1, '2018-01-17 11:57:15', 0, 2, NULL, 43),\
(1676, 1, 1, 0, 1, '2018-01-17 11:59:00', 0, 2, NULL, 43),\
(1677, 1, 1, 0, 1, '2018-01-17 11:59:39', 0, 2, NULL, 43),\
(1678, 1, 1, 0, 1, '2018-01-17 12:00:32', 0, 2, NULL, 43),\
(1679, 1, 1, 0, 1, '2018-01-17 12:00:50', 0, 2, NULL, 43),\
(1680, 1, 1, 0, 1, '2018-01-17 12:01:08', 0, 2, NULL, 43),\
(1681, 1, 1, 0, 1, '2018-01-17 12:01:51', 0, 2, NULL, 43),\
(1682, 1, 1, 0, 1, '2018-01-17 12:02:31', 0, 2, NULL, 43),\
(1683, 1, 1, 0, 1, '2018-01-17 12:02:50', 0, 2, NULL, 43),\
(1684, 1, 1, 0, 1, '2018-01-17 12:03:01', 0, 2, NULL, 43),\
(1685, 1, 1, 0, 1, '2018-01-17 12:03:18', 0, 2, NULL, 43),\
(1686, 1, 1, 0, 1, '2018-01-17 12:03:38', 0, 2, NULL, 43),\
(1687, 1, 1, 0, 1, '2018-01-17 12:03:47', 0, 2, NULL, 43),\
(1688, 1, 1, 0, 1, '2018-01-17 12:04:21', 0, 2, NULL, 43),\
(1689, 1, 1, 0, 1, '2018-01-17 12:04:28', 0, 2, NULL, 43),\
(1690, 1, 1, 0, 1, '2018-01-17 12:04:53', 0, 2, NULL, 43),\
(1691, 1, 1, 0, 1, '2018-01-17 12:05:01', 0, 2, NULL, 43),\
(1692, 1, 1, 0, 1, '2018-01-17 12:05:12', 0, 2, NULL, 43),\
(1693, 1, 1, 0, 1, '2018-01-17 12:05:47', 0, 2, NULL, 43),\
(1694, 1, 1, 0, 1, '2018-01-17 12:06:13', 0, 2, NULL, 43),\
(1695, 1, 1, 0, 1, '2018-01-17 12:35:16', 0, 2, NULL, 43),\
(1696, 1, 1, 0, 1, '2018-01-17 12:35:36', 0, 2, NULL, 43),\
(1697, 1, 1, 0, 1, '2018-01-17 12:37:24', 0, 2, NULL, 43),\
(1698, 1, 1, 0, 1, '2018-01-17 12:37:41', 0, 2, NULL, 43),\
(1699, 1, 1, 0, 1, '2018-01-17 12:37:52', 0, 2, NULL, 43),\
(1700, 1, 1, 0, 1, '2018-01-17 12:38:12', 0, 2, NULL, 43),\
(1701, 1, 1, 0, 1, '2018-01-17 12:38:20', 0, 2, NULL, 43),\
(1702, 1, 1, 0, 1, '2018-01-17 12:38:45', 0, 2, NULL, 43),\
(1703, 1, 1, 0, 1, '2018-01-17 12:43:32', 0, 2, NULL, 43),\
(1704, 1, 1, 0, 1, '2018-01-17 12:43:43', 0, 2, NULL, 43),\
(1705, 1, 1, 0, 1, '2018-01-17 12:44:12', 0, 2, NULL, 43),\
(1706, 1, 1, 0, 1, '2018-01-17 12:52:50', 0, 2, NULL, 43),\
(1707, 1, 1, 0, 1, '2018-01-17 12:53:13', 0, 2, NULL, 43),\
(1708, 1, 1, 0, 1, '2018-01-17 12:54:05', 0, 2, NULL, 43),\
(1709, 1, 1, 0, 1, '2018-01-17 12:54:29', 0, 2, NULL, 43),\
(1710, 1, 1, 0, 1, '2018-01-17 12:54:40', 0, 2, NULL, 43),\
(1711, 1, 1, 0, 1, '2018-01-17 12:54:54', 0, 2, NULL, 43),\
(1712, 1, 1, 0, 1, '2018-01-17 12:55:07', 0, 2, NULL, 43),\
(1713, 1, 1, 0, 1, '2018-01-17 12:55:54', 0, 2, NULL, 43),\
(1714, 1, 1, 0, 1, '2018-01-17 12:56:45', 0, 2, NULL, 43),\
(1715, 1, 1, 0, 1, '2018-01-17 12:57:06', 0, 2, NULL, 43),\
(1716, 1, 1, 0, 1, '2018-01-17 12:58:54', 0, 2, NULL, 43),\
(1717, 1, 1, 0, 1, '2018-01-17 12:59:21', 0, 2, NULL, 43),\
(1718, 1, 1, 0, 1, '2018-01-17 12:59:48', 0, 2, NULL, 43),\
(1719, 1, 1, 0, 1, '2018-01-17 13:00:15', 0, 2, NULL, 43),\
(1720, 1, 1, 0, 1, '2018-01-17 13:00:41', 0, 2, NULL, 43),\
(1721, 1, 1, 0, 1, '2018-01-17 13:00:58', 0, 2, NULL, 43),\
(1722, 1, 1, 0, 1, '2018-01-17 13:01:08', 0, 2, NULL, 43),\
(1723, 1, 1, 0, 1, '2018-01-17 13:01:20', 0, 2, NULL, 43),\
(1724, 1, 1, 0, 1, '2018-01-17 13:01:38', 0, 2, NULL, 43),\
(1725, 1, 1, 0, 1, '2018-01-17 13:01:52', 0, 2, NULL, 43),\
(1726, 1, 1, 0, 1, '2018-01-17 13:02:06', 0, 2, NULL, 43),\
(1727, 1, 1, 0, 1, '2018-01-17 13:02:15', 0, 2, NULL, 43),\
(1728, 1, 1, 0, 1, '2018-01-17 13:02:45', 0, 2, NULL, 43),\
(1729, 1, 1, 0, 1, '2018-01-17 13:03:16', 0, 2, NULL, 43),\
(1730, 1, 1, 0, 1, '2018-01-17 13:03:58', 0, 2, NULL, 43),\
(1731, 1, 1, 0, 1, '2018-01-17 13:04:46', 0, 2, NULL, 43),\
(1732, 1, 1, 0, 1, '2018-01-17 13:04:57', 0, 2, NULL, 43),\
(1733, 1, 1, 0, 1, '2018-01-17 13:05:25', 0, 2, NULL, 43),\
(1734, 1, 1, 0, 1, '2018-01-17 13:06:27', 0, 2, NULL, 43),\
(1735, 1, 1, 0, 1, '2018-01-17 13:06:39', 0, 2, NULL, 43),\
(1736, 1, 1, 0, 1, '2018-01-17 16:38:14', 0, 2, NULL, 43),\
(1737, 1, 1, 0, 1, '2018-01-17 16:38:29', 0, 2, NULL, 43),\
(1738, 1, 1, 0, 1, '2018-01-17 16:38:57', 0, 2, NULL, 43),\
(1739, 1, 1, 0, 1, '2018-01-17 16:39:41', 0, 2, NULL, 43),\
(1740, 1, 1, 0, 1, '2018-01-17 16:39:59', 0, 2, NULL, 43),\
(1741, 1, 1, 0, 1, '2018-01-17 16:40:12', 0, 2, NULL, 43),\
(1742, 1, 1, 0, 1, '2018-01-17 16:40:42', 0, 2, NULL, 43),\
(1743, 1, 1, 0, 1, '2018-01-17 16:41:08', 0, 2, NULL, 43),\
(1744, 1, 1, 0, 1, '2018-01-17 16:41:46', 0, 2, NULL, 43),\
(1745, 1, 1, 0, 1, '2018-01-17 16:42:20', 0, 2, NULL, 43),\
(1746, 1, 1, 0, 1, '2018-01-17 16:44:24', 0, 2, NULL, 43),\
(1747, 1, 1, 0, 1, '2018-01-17 16:44:38', 0, 2, NULL, 43),\
(1748, 1, 1, 0, 1, '2018-01-17 16:45:03', 0, 2, NULL, 43),\
(1749, 1, 1, 0, 1, '2018-01-17 16:45:05', 0, 2, NULL, 43),\
(1750, 1, 1, 0, 1, '2018-01-17 16:45:23', 0, 2, NULL, 43),\
(1751, 1, 1, 0, 1, '2018-01-17 16:45:49', 0, 2, NULL, 43),\
(1752, 1, 1, 0, 1, '2018-01-17 16:46:45', 0, 2, NULL, 43),\
(1753, 1, 1, 0, 1, '2018-01-17 16:46:47', 0, 2, NULL, 43),\
(1754, 1, 1, 0, 1, '2018-01-17 16:47:07', 0, 2, NULL, 43),\
(1755, 1, 1, 0, 1, '2018-01-17 16:47:50', 0, 2, NULL, 43),\
(1756, 1, 1, 0, 1, '2018-01-17 16:48:37', 0, 2, NULL, 43),\
(1757, 1, 1, 0, 1, '2018-01-17 16:48:45', 0, 2, NULL, 43),\
(1758, 1, 1, 0, 1, '2018-01-17 16:50:05', 0, 2, NULL, 43),\
(1759, 1, 1, 0, 1, '2018-01-17 16:50:48', 0, 2, NULL, 43),\
(1760, 1, 1, 0, 1, '2018-01-17 16:50:56', 0, 2, NULL, 43),\
(1761, 1, 1, 0, 1, '2018-01-17 16:51:05', 0, 2, NULL, 43),\
(1762, 1, 1, 0, 1, '2018-01-17 16:51:10', 0, 2, NULL, 43),\
(1763, 1, 1, 0, 1, '2018-01-17 16:51:40', 0, 2, NULL, 43),\
(1764, 1, 1, 0, 1, '2018-01-17 16:52:28', 0, 2, NULL, 43),\
(1765, 1, 1, 0, 1, '2018-01-17 16:52:45', 0, 2, NULL, 43),\
(1766, 1, 1, 0, 1, '2018-01-17 16:53:19', 0, 2, NULL, 43),\
(1767, 1, 1, 0, 1, '2018-01-17 16:53:40', 0, 2, NULL, 43),\
(1768, 1, 1, 0, 1, '2018-01-17 16:53:53', 0, 2, NULL, 43),\
(1769, 1, 1, 0, 1, '2018-01-17 16:54:03', 0, 2, NULL, 43),\
(1770, 1, 1, 0, 1, '2018-01-17 16:54:37', 0, 2, NULL, 43),\
(1771, 1, 1, 0, 1, '2018-01-17 16:54:58', 0, 2, NULL, 43),\
(1772, 1, 1, 0, 1, '2018-01-17 16:55:22', 0, 2, NULL, 43),\
(1773, 1, 1, 0, 1, '2018-01-17 16:55:54', 0, 2, NULL, 43),\
(1774, 1, 1, 0, 1, '2018-01-17 16:56:18', 0, 2, NULL, 43),\
(1775, 1, 1, 0, 1, '2018-01-17 16:56:59', 0, 2, NULL, 43),\
(1776, 1, NULL, NULL, NULL, '2018-01-17 16:57:36', 0, 2, NULL, 43),\
(1777, 1, 1, 0, 1, '2018-01-17 16:57:52', 0, 2, NULL, 43),\
(1778, 1, 1, 0, 1, '2018-01-17 16:58:07', 0, 2, NULL, 43),\
(1779, 1, 1, 0, 1, '2018-01-17 16:58:41', 0, 2, NULL, 43),\
(1780, 1, 1, 0, 1, '2018-01-17 17:04:40', 0, 2, NULL, 43),\
(1781, 1, 1, 1, 0, '2018-01-17 17:08:35', 0, 2, NULL, 43),\
(1782, 1, 1, 1, 0, '2018-01-17 17:08:50', 0, 2, NULL, 43),\
(1783, 1, 1, 1, 0, '2018-01-18 00:58:38', 0, 2, NULL, 43),\
(1784, 1, 1, 0, 1, '2018-02-22 16:45:10', 0, 2, NULL, 44),\
(1785, 1, 1, 0, 1, '2018-02-22 16:48:17', 0, 2, NULL, 44),\
(1786, 1, 1, 0, 1, '2018-02-22 16:49:40', 0, 2, NULL, 44),\
(1787, 1, 1, 0, 1, '2018-02-22 16:50:34', 0, 2, NULL, 44),\
(1788, 1, 1, 0, 1, '2018-02-22 16:50:53', 0, 2, NULL, 44),\
(1789, 1, 1, 0, 1, '2018-02-22 16:51:25', 0, 2, NULL, 44),\
(1790, 1, 1, 0, 1, '2018-02-22 16:51:46', 0, 2, NULL, 44),\
(1791, 1, 1, 1, 0, '2018-02-22 16:59:14', 0, 2, NULL, 44),\
(1792, 1, 2, 0, 2, '2018-03-04 18:55:06', 0, 2, NULL, 44),\
(1793, 1, 2, 1, 1, '2018-03-04 18:55:19', 0, 2, NULL, 44),\
(1794, 1, 2, 2, 0, '2018-03-05 00:40:12', 1, 1, 3, NULL),\
(1795, 1, 2, 1, 1, '2018-03-05 00:40:34', 1, 1, 2, NULL),\
(1796, 1, 2, 0, 2, '2018-03-05 00:40:48', 1, 1, 5, NULL),\
(1797, 46, 2, 2, 0, '2018-03-05 00:42:06', 1, 1, 2, NULL),\
(1798, 46, 2, 1, 1, '2018-03-05 00:42:14', 1, 1, 4, NULL),\
(1799, 46, 2, 0, 2, '2018-03-05 00:42:22', 1, 1, 3, NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `question`\
--\
\
CREATE TABLE `question` (\
  `id` int(11) NOT NULL,\
  `statement` varchar(400) DEFAULT NULL,\
  `id_category` int(11) NOT NULL,\
  `audio` varchar(400) DEFAULT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `question`\
--\
\
INSERT INTO `question` (`id`, `statement`, `id_category`, `audio`) VALUES\
(10, 'Where is the fire?', 5, NULL),\
(11, 'Are dangerous goods on fire?', 5, NULL),\
(12, 'Is there danger of explosion?', 5, NULL),\
(13, 'Is the fire under control?', 5, NULL),\
(14, 'What kind of assistance is required?', 5, NULL),\
(16, 'Report injured persons', 5, NULL),\
(19, 'What part of your vessel is aground?', 5, NULL),\
(20, 'When do you expect to refloat?', 5, NULL),\
(21, 'Can you beach?', 5, NULL),\
(23, 'Report damage', 5, NULL),\
(24, 'Can you proceed?', 5, NULL),\
(25, 'Can you continue search?', 5, NULL),\
(27, 'What is condition of person?', 5, NULL),\
(28, 'What is condition of persons?', 5, NULL),\
(30, 'What is your position?', 6, NULL),\
(31, 'What is your present course and speed?', 6, NULL),\
(32, 'Report number of persons on board', 6, NULL),\
(33, 'Report injured persons', 6, NULL),\
(35, 'Is your EPIRB transmitting?', 6, NULL),\
(36, 'Is your SART transmitting?', 6, NULL),\
(37, 'Did you transmit a DSC alert?', 6, NULL),\
(38, 'How many lifeboats will you launch?', 6, NULL),\
(39, 'How many lifeboats with how many persons will you launch?', 6, NULL),\
(40, 'How many liferafts will you launch?', 6, NULL),\
(41, 'How many liferafts with how many persons will you launch?', 6, NULL),\
(42, 'How many persons will stay on board?', 6, NULL),\
(43, 'What is the weather situation in your position?', 6, NULL),\
(44, 'Are there dangers to navigation?', 6, NULL),\
(46, 'Can you proceed to distress position? ', 6, NULL),\
(47, 'What is your ETA at distress position?', 6, NULL),\
(48, 'MAYDAY position is not correct', 6, NULL),\
(53, 'What is the result of search?', 6, NULL),\
(56, 'What kind of assistance is required?', 7, NULL),\
(57, 'Do you have doctor on board?', 7, NULL),\
(58, 'Can you make rendezvous in position $position$', 7, NULL),\
(59, 'What problems do you have?', 3, NULL),\
(60, 'Can you proceed without assistance?', 3, NULL),\
(63, 'What wind is expected in my position?', 8, NULL),\
(64, 'What is the latest gale warning?', 19, NULL),\
(65, 'What is the latest storm warning?', 44, NULL),\
(66, 'What is the latest tropical storm warning?', 8, NULL),\
(67, 'ejemplo', 7, 'questionid67_categoryid41.mp3'),\
(68, 'que dia es?', 44, NULL);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `role`\
--\
\
CREATE TABLE `role` (\
  `id` int(11) NOT NULL,\
  `role` varchar(45) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `role`\
--\
\
INSERT INTO `role` (`id`, `role`) VALUES\
(1, 'admin'),\
(2, 'student');\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `tokens`\
--\
\
CREATE TABLE `tokens` (\
  `id` int(11) NOT NULL,\
  `token` varchar(255) NOT NULL,\
  `user_id` int(10) NOT NULL,\
  `created` date NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `true_false_statement`\
--\
\
CREATE TABLE `true_false_statement` (\
  `id` int(11) NOT NULL,\
  `true_statement` varchar(400) NOT NULL,\
  `false_statement` varchar(400) NOT NULL,\
  `id_category` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `true_false_statement`\
--\
\
INSERT INTO `true_false_statement` (`id`, `true_statement`, `false_statement`, `id_category`) VALUES\
(1, 'distress communicaionssdf', 'ejemplo 1', 5),\
(2, 'urgency trafinc', 'faaaaalso', 7),\
(3, 'navigational warning', 'false', 7);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `type_question`\
--\
\
CREATE TABLE `type_question` (\
  `id` int(11) NOT NULL,\
  `name` varchar(400) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=utf8;\
\
--\
-- Volcado de datos para la tabla `type_question`\
--\
\
INSERT INTO `type_question` (`id`, `name`) VALUES\
(1, 'question'),\
(2, 'disordered'),\
(3, 'true false'),\
(4, 'audio');\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `type_variable`\
--\
\
CREATE TABLE `type_variable` (\
  `id` int(11) NOT NULL,\
  `variable` varchar(45) NOT NULL,\
  `restricted` tinyint(1) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `type_variable`\
--\
\
INSERT INTO `type_variable` (`id`, `variable`, `restricted`) VALUES\
(1, 'mv name', 1),\
(2, 'charted name', 1),\
(3, 'atposition', 1),\
(4, 'station name', 1),\
(5, 'search pattern', 1),\
(6, 'datum', 1),\
(7, 'location aboard', 1),\
(8, 'object', 1),\
(9, 'lightvessel name', 1),\
(10, 'port name', 1),\
(11, 'mark type', 1),\
(12, 'way point', 1),\
(18, 'number', 0),\
(19, 'time', 0),\
(23, 'speed', 0),\
(33, 'mmsi', 0),\
(34, 'degrees', 0),\
(35, 'beaufort', 0),\
(36, 'call sign', 1),\
(37, 'date', 0),\
(38, 'decimal', 0),\
(42, 'position', 0),\
(43, 'vhf channel', 0),\
(44, 'cardinal point', 0),\
(45, 'flag state', 1),\
(46, 'loran', 1),\
(47, 'weather event name', 1),\
(48, 'fromrefpoint', 1),\
(49, 'meteorological area', 1),\
(50, 'pressure', 0);\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `users`\
--\
\
CREATE TABLE `users` (\
  `id` int(10) NOT NULL,\
  `email` varchar(100) NOT NULL,\
  `first_name` varchar(100) NOT NULL,\
  `last_name` varchar(100) NOT NULL,\
  `role` int(10) NOT NULL,\
  `password` text NOT NULL,\
  `last_login` varchar(100) DEFAULT NULL,\
  `status` varchar(100) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `users`\
--\
\
INSERT INTO `users` (`id`, `email`, `first_name`, `last_name`, `role`, `password`, `last_login`, `status`) VALUES\
(1, 'admin@gmail.com', 'admin', 'admin', 1, '2826a8078149f92472f57e903766a1b3', '2018-03-05 01:39:18 AM', 'approved'),\
(4, 'prueba@gmail.com', 'prueba', 'prueba', 2, 'c81b5136bcd10b4390108c979ed28ee6', '2018-02-07 03:21:59 AM', 'pending'),\
(6, 'b@gmail.com', 'b', 'b', 2, '4db3a537e0651474362938ffdfb03609', NULL, 'approved'),\
(7, 'a@gmail.com', 'a', 'a', 2, '98803fb76698f99a029f0c7e2991c5a9', NULL, 'pending'),\
(8, 'asdf@gmail.com', 'n', 'j', 2, '4db3a537e0651474362938ffdfb03609', NULL, 'approved'),\
(43, 'vmvmv@gmail.com', 'vvv', 'vvvv', 2, 'ca10ad553b8e28f5a7948adf30d7cbe4', NULL, 'approved'),\
(44, 'admin@gmail.com', 'asdf', 'asdfasdf', 2, '6a204bd89f3c8348afd5c77c717a097a', NULL, 'pending'),\
(45, 'adaaaamin@gmail.com', 'asdf', 'asdf', 2, '6a204bd89f3c8348afd5c77c717a097a', NULL, 'pending'),\
(46, 'alumno@gmail.com', 'alumno', 'alumno', 2, '9fe20e7b2b701c7c7d86c1ca30b5bd2e', '2018-03-05 01:41:40 AM', 'approved');\
\
-- --------------------------------------------------------\
\
--\
-- Estructura de tabla para la tabla `variable`\
--\
\
CREATE TABLE `variable` (\
  `id` int(11) NOT NULL,\
  `name` varchar(45) NOT NULL,\
  `id_type_variable` int(11) NOT NULL\
) ENGINE=InnoDB DEFAULT CHARSET=latin1;\
\
--\
-- Volcado de datos para la tabla `variable`\
--\
\
INSERT INTO `variable` (`id`, `name`, `id_type_variable`) VALUES\
(1, 'Casey', 1),\
(2, 'Babieca', 1),\
(3, 'Draco', 1),\
(4, 'Fairfax', 1),\
(5, 'Payton', 1),\
(6, 'Xanadu', 1),\
(7, 'Pollux', 1),\
(8, 'Berenice', 1),\
(9, 'Castor', 1),\
(10, 'BUOY5', 2),\
(11, 'ALFA5', 2),\
(12, 'Cape Paloma', 3),\
(13, 'Cape Trafalgar', 3),\
(14, 'Blueway Station', 4),\
(15, 'Tarifa VTS', 4),\
(16, 'DELTA2', 5),\
(17, 'DELTA5', 5),\
(18, 'SEA2', 6),\
(19, 'SEA5', 6),\
(20, 'hold', 7),\
(21, 'main deck', 7),\
(22, 'the engine room', 7),\
(23, 'the living spaces', 7),\
(24, 'the bridge', 7),\
(25, 'helicopter', 8),\
(26, 'escort', 8),\
(27, 'fire-fighting assistance', 8),\
(28, 'a lifeboat', 8),\
(32, 'medical assistance', 8),\
(33, 'TRACY5', 9),\
(34, 'GLOBAL', 10),\
(35, 'Foxy5', 11),\
(36, 'isolated danger', 11),\
(37, 'B52', 12),\
(38, 'B31', 12),\
(39, '9', 18),\
(40, '2230', 19),\
(43, '15,5', 23),\
(66, '012242847', 33),\
(67, '140,5\'ba', 34),\
(68, '10', 35),\
(69, 'EDBA5', 36),\
(70, 'October 12th', 37),\
(71, '11,5', 38),\
(75, '25\'ba13,5\'9212,8\'92\'92N126\'ba32,5\'9229\'92\'92W', 42),\
(76, '55', 43),\
(77, 'N', 44),\
(78, 'S', 44),\
(79, 'E', 44),\
(80, 'W', 44),\
(81, 'NE', 44),\
(82, 'NW', 44),\
(83, 'SE', 44),\
(84, 'SW', 44),\
(85, 'NNE', 44),\
(86, 'ENE', 44),\
(87, 'ESE', 44),\
(88, 'SSE', 44),\
(89, 'SSW', 44),\
(90, 'WSW', 44),\
(91, 'WNW', 44),\
(92, 'NNW', 44),\
(93, 'GLOBAL', 45),\
(94, 'BART4', 46),\
(95, 'GLOBAL', 47),\
(96, 'Global lighthouse', 48),\
(97, 'LUNDY', 49),\
(98, '160', 50);\
\
--\
-- \'cdndices para tablas volcadas\
--\
\
--\
-- Indices de la tabla `answer`\
--\
ALTER TABLE `answer`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_question` (`id_question`);\
\
--\
-- Indices de la tabla `categories_final_test`\
--\
ALTER TABLE `categories_final_test`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `category`\
--\
ALTER TABLE `category`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_parent_category` (`id_parent_category`);\
\
--\
-- Indices de la tabla `disordered_statement`\
--\
ALTER TABLE `disordered_statement`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_category` (`id_category`);\
\
--\
-- Indices de la tabla `entry`\
--\
ALTER TABLE `entry`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_exam_idx` (`id_exam`),\
  ADD KEY `id_type_question` (`id_type_question`);\
\
--\
-- Indices de la tabla `exam`\
--\
ALTER TABLE `exam`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_user_idx` (`id_user`),\
  ADD KEY `id_category` (`id_category`);\
\
--\
-- Indices de la tabla `question`\
--\
ALTER TABLE `question`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_category` (`id_category`);\
\
--\
-- Indices de la tabla `role`\
--\
ALTER TABLE `role`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `tokens`\
--\
ALTER TABLE `tokens`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_user_fk_tokens` (`user_id`);\
\
--\
-- Indices de la tabla `true_false_statement`\
--\
ALTER TABLE `true_false_statement`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_category` (`id_category`);\
\
--\
-- Indices de la tabla `type_question`\
--\
ALTER TABLE `type_question`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `type_variable`\
--\
ALTER TABLE `type_variable`\
  ADD PRIMARY KEY (`id`);\
\
--\
-- Indices de la tabla `users`\
--\
ALTER TABLE `users`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_role` (`role`);\
\
--\
-- Indices de la tabla `variable`\
--\
ALTER TABLE `variable`\
  ADD PRIMARY KEY (`id`),\
  ADD KEY `id_type_variable_idx` (`id_type_variable`);\
\
--\
-- AUTO_INCREMENT de las tablas volcadas\
--\
\
--\
-- AUTO_INCREMENT de la tabla `answer`\
--\
ALTER TABLE `answer`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=513;\
\
--\
-- AUTO_INCREMENT de la tabla `categories_final_test`\
--\
ALTER TABLE `categories_final_test`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;\
\
--\
-- AUTO_INCREMENT de la tabla `category`\
--\
ALTER TABLE `category`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;\
\
--\
-- AUTO_INCREMENT de la tabla `disordered_statement`\
--\
ALTER TABLE `disordered_statement`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;\
\
--\
-- AUTO_INCREMENT de la tabla `entry`\
--\
ALTER TABLE `entry`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1416;\
\
--\
-- AUTO_INCREMENT de la tabla `exam`\
--\
ALTER TABLE `exam`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1800;\
\
--\
-- AUTO_INCREMENT de la tabla `question`\
--\
ALTER TABLE `question`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;\
\
--\
-- AUTO_INCREMENT de la tabla `role`\
--\
ALTER TABLE `role`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;\
\
--\
-- AUTO_INCREMENT de la tabla `tokens`\
--\
ALTER TABLE `tokens`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;\
\
--\
-- AUTO_INCREMENT de la tabla `true_false_statement`\
--\
ALTER TABLE `true_false_statement`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;\
\
--\
-- AUTO_INCREMENT de la tabla `type_question`\
--\
ALTER TABLE `type_question`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;\
\
--\
-- AUTO_INCREMENT de la tabla `type_variable`\
--\
ALTER TABLE `type_variable`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;\
\
--\
-- AUTO_INCREMENT de la tabla `users`\
--\
ALTER TABLE `users`\
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;\
\
--\
-- AUTO_INCREMENT de la tabla `variable`\
--\
ALTER TABLE `variable`\
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;\
\
--\
-- Restricciones para tablas volcadas\
--\
\
--\
-- Filtros para la tabla `answer`\
--\
ALTER TABLE `answer`\
  ADD CONSTRAINT `id_question_fk` FOREIGN KEY (`id_question`) REFERENCES `question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `category`\
--\
ALTER TABLE `category`\
  ADD CONSTRAINT `id_parentcategory_idfk` FOREIGN KEY (`id_parent_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `disordered_statement`\
--\
ALTER TABLE `disordered_statement`\
  ADD CONSTRAINT `fk_disordered_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `entry`\
--\
ALTER TABLE `entry`\
  ADD CONSTRAINT `entry_ibfk_1` FOREIGN KEY (`id_type_question`) REFERENCES `type_question` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,\
  ADD CONSTRAINT `id_exam` FOREIGN KEY (`id_exam`) REFERENCES `exam` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;\
\
--\
-- Filtros para la tabla `exam`\
--\
ALTER TABLE `exam`\
  ADD CONSTRAINT `id_category_fk_exam` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON UPDATE CASCADE,\
  ADD CONSTRAINT `id_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `question`\
--\
ALTER TABLE `question`\
  ADD CONSTRAINT `id_category` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`);\
\
--\
-- Filtros para la tabla `tokens`\
--\
ALTER TABLE `tokens`\
  ADD CONSTRAINT `id_user_fk_tokens` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `true_false_statement`\
--\
ALTER TABLE `true_false_statement`\
  ADD CONSTRAINT `true_false_statement_ibfk_1` FOREIGN KEY (`id_category`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `users`\
--\
ALTER TABLE `users`\
  ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`role`) REFERENCES `role` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
\
--\
-- Filtros para la tabla `variable`\
--\
ALTER TABLE `variable`\
  ADD CONSTRAINT `id_type_variable_idk` FOREIGN KEY (`id_type_variable`) REFERENCES `type_variable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;\
}

-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Июн 01 2015 г., 03:53
-- Версия сервера: 5.5.41-log
-- Версия PHP: 5.3.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `KursDB`
--
CREATE DATABASE IF NOT EXISTS `KursDB` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `KursDB`;

-- --------------------------------------------------------

--
-- Структура таблицы `groupreference`
--

DROP TABLE IF EXISTS `groupreference`;
CREATE TABLE IF NOT EXISTS `groupreference` (
  `Gid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groupreference`
--

INSERT INTO `groupreference` (`Gid`, `Tid`) VALUES
(4, 2),
(4, 3),
(1, 3),
(2, 3),
(3, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `Gid` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(25) NOT NULL,
  `Kurs` int(1) NOT NULL,
  PRIMARY KEY (`Gid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`Gid`, `Name`, `Kurs`) VALUES
(1, 'Ж-12', 2),
(2, 'ЖО-32', 1),
(3, 'ЖОП-92', 3),
(4, 'КТсо5-13', 5);

-- --------------------------------------------------------

--
-- Структура таблицы `gsureference`
--

DROP TABLE IF EXISTS `gsureference`;
CREATE TABLE IF NOT EXISTS `gsureference` (
  `Gid` int(30) NOT NULL,
  `Suid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gsureference`
--

INSERT INTO `gsureference` (`Gid`, `Suid`) VALUES
(1, 2),
(1, 1),
(4, 2),
(4, 1),
(4, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `materials`
--

DROP TABLE IF EXISTS `materials`;
CREATE TABLE IF NOT EXISTS `materials` (
  `File_Name` varchar(255) NOT NULL,
  `Srid` int(10) NOT NULL,
  `path` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `materials`
--

INSERT INTO `materials` (`File_Name`, `Srid`, `path`) VALUES
('Методичка_1', 1, '/materialsFile/metoda1.odt'),
('Методичка_2', 1, '/materialsFile/metoda1.odt'),
('PiROS_-_Laboratornaya_rabota_3.doc', 14, '/materialsFile/PiROS_-_Laboratornaya_rabota_3.doc');

-- --------------------------------------------------------

--
-- Структура таблицы `smessages`
--

DROP TABLE IF EXISTS `smessages`;
CREATE TABLE IF NOT EXISTS `smessages` (
  `MsgID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Sid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL,
  `TextM` varchar(512) NOT NULL,
  `Theme` varchar(128) NOT NULL,
  `MsgStatus` bit(1) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MsgID`),
  UNIQUE KEY `MsgID` (`MsgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Дамп данных таблицы `smessages`
--

INSERT INTO `smessages` (`MsgID`, `Sid`, `Tid`, `TextM`, `Theme`, `MsgStatus`, `Date`) VALUES
(1, 1, 1, 'ываыва', 'ваыва', b'1', '2015-05-28 19:16:25'),
(2, 1, 1, 'ываыва', 'ваыва', b'0', '2015-05-28 19:16:25');

-- --------------------------------------------------------

--
-- Структура таблицы `statusDate`
--

DROP TABLE IF EXISTS `statusDate`;
CREATE TABLE IF NOT EXISTS `statusDate` (
  `Wid` int(255) NOT NULL,
  `s1` varchar(25) DEFAULT NULL,
  `s2` varchar(25) DEFAULT NULL,
  `s3` varchar(25) DEFAULT NULL,
  `s4` varchar(25) DEFAULT NULL,
  `s5` varchar(25) DEFAULT NULL,
  `s6` varchar(25) DEFAULT NULL,
  `s7` varchar(25) DEFAULT NULL,
  `s8` varchar(25) DEFAULT NULL,
  `s9` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`Wid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statusDate`
--

INSERT INTO `statusDate` (`Wid`, `s1`, `s2`, `s3`, `s4`, `s5`, `s6`, `s7`, `s8`, `s9`) VALUES
(13, NULL, '1 June 2015', NULL, '31 May 2015', NULL, NULL, NULL, NULL, NULL),
(14, NULL, NULL, '31 May 2015', NULL, NULL, NULL, NULL, NULL, NULL),
(15, '31 May 2015', '31 May 2015', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(16, NULL, NULL, NULL, NULL, '31 May 2015', NULL, NULL, NULL, NULL),
(17, NULL, NULL, NULL, '31 May 2015', NULL, NULL, NULL, NULL, '0'),
(18, NULL, NULL, NULL, '31 May 2015', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `statuslist`
--

DROP TABLE IF EXISTS `statuslist`;
CREATE TABLE IF NOT EXISTS `statuslist` (
  `Stid` int(11) NOT NULL,
  `Status` varchar(150) NOT NULL,
  PRIMARY KEY (`Stid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statuslist`
--

INSERT INTO `statuslist` (`Stid`, `Status`) VALUES
(0, 'None'),
(1, 'Выбор темы'),
(2, 'Разработка ТЗ'),
(3, 'Поиск информации'),
(4, 'Определение концепции продукта'),
(5, 'Разработка продукта'),
(6, 'Написание пояснительной записки'),
(7, 'CD/DVD'),
(8, 'Сдача'),
(9, 'Сдано');

-- --------------------------------------------------------

--
-- Структура таблицы `students`
--

DROP TABLE IF EXISTS `students`;
CREATE TABLE IF NOT EXISTS `students` (
  `Sid` int(11) NOT NULL AUTO_INCREMENT,
  `FIO` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Gid` int(11) NOT NULL,
  `Kurs` int(11) NOT NULL,
  `login` varchar(21) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`Sid`, `FIO`, `Gid`, `Kurs`, `login`, `password`) VALUES
(1, 'Григораш Андрей Сергеевич', 4, 5, 'ss', '142536'),
(5, 'dsfd', 1, 1, 'dfdsff', 'dsfdsfdsffdsdsf');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Suid` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(64) NOT NULL,
  PRIMARY KEY (`Suid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`Suid`, `Name`) VALUES
(1, 'Рисование'),
(2, 'ОБЖ'),
(3, 'Математика');

-- --------------------------------------------------------

--
-- Структура таблицы `subjectreference`
--

DROP TABLE IF EXISTS `subjectreference`;
CREATE TABLE IF NOT EXISTS `subjectreference` (
  `Srid` int(10) NOT NULL AUTO_INCREMENT,
  `Suid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL,
  PRIMARY KEY (`Srid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Дамп данных таблицы `subjectreference`
--

INSERT INTO `subjectreference` (`Srid`, `Suid`, `Tid`) VALUES
(14, 3, 3),
(16, 1, 3);

-- --------------------------------------------------------

--
-- Структура таблицы `sugtreference`
--

DROP TABLE IF EXISTS `sugtreference`;
CREATE TABLE IF NOT EXISTS `sugtreference` (
  `Refid` int(30) NOT NULL AUTO_INCREMENT,
  `Suid` int(30) NOT NULL,
  `Tid` int(30) NOT NULL,
  `Gid` int(30) NOT NULL,
  PRIMARY KEY (`Refid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=16 ;

--
-- Дамп данных таблицы `sugtreference`
--

INSERT INTO `sugtreference` (`Refid`, `Suid`, `Tid`, `Gid`) VALUES
(9, 1, 3, 1),
(10, 2, 3, 1),
(11, 3, 3, 3),
(12, 1, 0, 1),
(13, 3, 3, 4),
(14, 1, 3, 4),
(15, 2, 3, 4);

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `Tid` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `FIO` varchar(70) NOT NULL,
  `office` varchar(1500) NOT NULL,
  `Login` varchar(32) NOT NULL,
  `Password` char(32) NOT NULL,
  `photo` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`Tid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`Tid`, `FIO`, `office`, `Login`, `Password`, `photo`) VALUES
(1, 'Сергей Иванович Иванов', '', 'login', 'password', 'photoTeacher1'),
(2, 'Степан Федорович', '', 'stepka007', 'password', 'photoTeacher2'),
(3, 'Серега Ф', 'Доцент кафедры МОП ЭВМ', 'qq', '123', 'photo1');

-- --------------------------------------------------------

--
-- Структура таблицы `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `TopicID` int(30) NOT NULL AUTO_INCREMENT,
  `Tid` int(30) NOT NULL,
  `Suid` int(30) NOT NULL,
  `theme` varchar(5000) NOT NULL,
  `Sid` int(30) DEFAULT NULL,
  PRIMARY KEY (`TopicID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=59 ;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`TopicID`, `Tid`, `Suid`, `theme`, `Sid`) VALUES
(54, 3, 1, 'ASDASD', NULL),
(55, 3, 1, 'asdasD', NULL),
(58, 3, 2, 'dfgdfg', NULL);

-- --------------------------------------------------------

--
-- Структура таблицы `tmessages`
--

DROP TABLE IF EXISTS `tmessages`;
CREATE TABLE IF NOT EXISTS `tmessages` (
  `MsgID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Sid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL,
  `TextM` varchar(512) NOT NULL,
  `Theme` varchar(128) NOT NULL,
  `MsgStatus` bit(1) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MsgID`),
  UNIQUE KEY `MsgID` (`MsgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `tmessages`
--

INSERT INTO `tmessages` (`MsgID`, `Sid`, `Tid`, `TextM`, `Theme`, `MsgStatus`, `Date`) VALUES
(3, 1, 2, 'вапролрпавыапро вапролрпав', 'яваспм', b'1', '2015-05-05 19:30:35'),
(5, 1, 1, ' Сударь, вы перец.', '12', b'1', '2015-05-15 23:52:11'),
(6, 1, 1, 'Теперь сообщения работают как надо. ', 'Мы сделали это!', b'1', '2015-05-16 00:15:04'),
(7, 1, 1, 'asjdokasjd', 'ashdjsad', b'0', '2015-05-28 02:00:46'),
(8, 1, 1, 'asjdokasjd', 'ashdjsad', b'0', '2015-05-28 02:03:07'),
(9, 1, 1, 'sdfsdf', 'sfsdf', b'0', '2015-05-28 02:03:19'),
(10, 1, 1, 'ываыва', 'ваыва', b'0', '2015-05-28 19:16:25');

-- --------------------------------------------------------

--
-- Структура таблицы `works`
--

DROP TABLE IF EXISTS `works`;
CREATE TABLE IF NOT EXISTS `works` (
  `Wid` int(11) NOT NULL AUTO_INCREMENT,
  `Suid` int(11) NOT NULL,
  `Topic` varchar(100) NOT NULL,
  `Tid` int(11) NOT NULL,
  `Sid` int(11) NOT NULL,
  `semester` int(10) NOT NULL,
  `Stid` int(11) NOT NULL DEFAULT '0',
  `inTime` tinyint(1) NOT NULL DEFAULT '0',
  `defend` tinyint(1) NOT NULL DEFAULT '0',
  `mark` int(3) DEFAULT NULL,
  PRIMARY KEY (`Wid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=19 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`Wid`, `Suid`, `Topic`, `Tid`, `Sid`, `semester`, `Stid`, `inTime`, `defend`, `mark`) VALUES
(13, 1, 'asdasd', 3, 5, 2, 2, 1, 1, 66),
(14, 1, 'asdasD', 3, 5, 4, 3, 0, 0, 0),
(15, 1, 'ASDASD', 3, 1, 5, 2, 0, 0, 0),
(16, 1, 'ASDASD', 3, 1, 0, 5, 0, 0, 0),
(17, 1, 'ASDASD', 3, 5, 0, 4, 1, 0, 89),
(18, 2, 'dfgdfg', 3, 1, 0, 4, 1, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

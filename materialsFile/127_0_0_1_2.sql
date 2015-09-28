-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Хост: 127.0.0.1:3306
-- Время создания: Май 16 2015 г., 04:45
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
-- Структура таблицы `Smessages`
--

DROP TABLE IF EXISTS `Smessages`;
CREATE TABLE IF NOT EXISTS `Smessages` (
  `MsgID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Sid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL,
  `TextM` varchar(512) NOT NULL,
  `Theme` varchar(128) NOT NULL,
  `MsgStatus` bit(1) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MsgID`),
  UNIQUE KEY `MsgID` (`MsgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `Smessages`
--

INSERT INTO `Smessages` (`MsgID`, `Sid`, `Tid`, `TextM`, `Theme`, `MsgStatus`, `Date`) VALUES
(2, 1, 1, ' Сударь, вы перец.', '12', b'1', '2015-05-15 23:52:11'),
(3, 1, 1, 'Теперь сообщения работают как надо. ', 'Мы сделали это!', b'1', '2015-05-16 00:15:04');

-- --------------------------------------------------------

--
-- Структура таблицы `SuGTReference`
--

DROP TABLE IF EXISTS `SuGTReference`;
CREATE TABLE IF NOT EXISTS `SuGTReference` (
  `Refid` int(30) NOT NULL AUTO_INCREMENT,
  `Suid` int(30) NOT NULL,
  `Tid` int(30) NOT NULL,
  `Gid` int(30) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  PRIMARY KEY (`Refid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Структура таблицы `Tmessages`
--

DROP TABLE IF EXISTS `Tmessages`;
CREATE TABLE IF NOT EXISTS `Tmessages` (
  `MsgID` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `Sid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL,
  `TextM` varchar(512) NOT NULL,
  `Theme` varchar(128) NOT NULL,
  `MsgStatus` bit(11) NOT NULL,
  `Date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`MsgID`),
  UNIQUE KEY `MsgID` (`MsgID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=11 ;

--
-- Дамп данных таблицы `Tmessages`
--

INSERT INTO `Tmessages` (`MsgID`, `Sid`, `Tid`, `TextM`, `Theme`, `MsgStatus`, `Date`) VALUES
(3, 1, 2, 'вапролрпавыапро вапролрпав', 'яваспм', b'00000000001', '2015-05-05 19:30:35'),
(5, 1, 1, ' Сударь, вы перец.', '12', b'00000000001', '2015-05-15 23:52:11'),
(6, 1, 1, 'Теперь сообщения работают как надо. ', 'Мы сделали это!', b'00000000001', '2015-05-16 00:15:04');

-- --------------------------------------------------------

--
-- Структура таблицы `gSuReference`
--

DROP TABLE IF EXISTS `gSuReference`;
CREATE TABLE IF NOT EXISTS `gSuReference` (
  `Gid` int(30) NOT NULL,
  `Suid` int(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `gSuReference`
--

INSERT INTO `gSuReference` (`Gid`, `Suid`) VALUES
(1, 2),
(1, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `groupReference`
--

DROP TABLE IF EXISTS `groupReference`;
CREATE TABLE IF NOT EXISTS `groupReference` (
  `Gid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groupReference`
--

INSERT INTO `groupReference` (`Gid`, `Tid`) VALUES
(1, 1),
(1, 2),
(2, 1),
(3, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `Gid` int(11) NOT NULL,
  `Name` varchar(25) NOT NULL,
  PRIMARY KEY (`Gid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `groups`
--

INSERT INTO `groups` (`Gid`, `Name`) VALUES
(1, 'Ж-12'),
(2, 'ЖО-32'),
(3, 'ЖОП-92');

-- --------------------------------------------------------

--
-- Структура таблицы `statusList`
--

DROP TABLE IF EXISTS `statusList`;
CREATE TABLE IF NOT EXISTS `statusList` (
  `Stid` int(11) NOT NULL,
  `Status` varchar(150) NOT NULL,
  PRIMARY KEY (`Stid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `statusList`
--

INSERT INTO `statusList` (`Stid`, `Status`) VALUES
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
  `Sid` int(11) NOT NULL,
  `FIO` varchar(70) NOT NULL,
  `Gid` int(11) NOT NULL,
  `Kurs` int(11) NOT NULL,
  `photo` varchar(512) DEFAULT NULL,
  `login` varchar(21) NOT NULL,
  `password` varchar(15) NOT NULL,
  PRIMARY KEY (`Sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `students`
--

INSERT INTO `students` (`Sid`, `FIO`, `Gid`, `Kurs`, `photo`, `login`, `password`) VALUES
(1, 'Сергей Иванович Даздрапермович', 1, 1, 'none', '', '');

-- --------------------------------------------------------

--
-- Структура таблицы `subject`
--

DROP TABLE IF EXISTS `subject`;
CREATE TABLE IF NOT EXISTS `subject` (
  `Suid` int(11) NOT NULL,
  `Name` varchar(64) NOT NULL,
  PRIMARY KEY (`Suid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subject`
--

INSERT INTO `subject` (`Suid`, `Name`) VALUES
(1, 'Рисование'),
(2, 'ОБЖ'),
(3, 'Математика');

-- --------------------------------------------------------

--
-- Структура таблицы `subjectReference`
--

DROP TABLE IF EXISTS `subjectReference`;
CREATE TABLE IF NOT EXISTS `subjectReference` (
  `Suid` int(11) NOT NULL,
  `Tid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `subjectReference`
--

INSERT INTO `subjectReference` (`Suid`, `Tid`) VALUES
(3, 1),
(1, 1),
(2, 1);

-- --------------------------------------------------------

--
-- Структура таблицы `teachers`
--

DROP TABLE IF EXISTS `teachers`;
CREATE TABLE IF NOT EXISTS `teachers` (
  `Tid` int(10) unsigned NOT NULL,
  `FIO` varchar(70) NOT NULL,
  `Login` varchar(32) NOT NULL,
  `Password` char(32) NOT NULL,
  `photo` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`Tid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `teachers`
--

INSERT INTO `teachers` (`Tid`, `FIO`, `Login`, `Password`, `photo`) VALUES
(1, 'Сергей Иванович Иванов', 'login', 'password', 'photoTeacher1'),
(2, 'Степан Федорович', 'stepka007', 'password', 'photoTeacher2'),
(3, 'Серега Ф', 'qq', '123', 'photo1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Дамп данных таблицы `themes`
--

INSERT INTO `themes` (`TopicID`, `Tid`, `Suid`, `theme`, `Sid`) VALUES
(1, 1, 1, 'New_Test1_3', NULL),
(9, 1, 1, 'Test_Theme1_1', 1),
(11, 1, 1, 'Test_Theme2_1', NULL);

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
  `Stid` int(11) NOT NULL,
  PRIMARY KEY (`Wid`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Дамп данных таблицы `works`
--

INSERT INTO `works` (`Wid`, `Suid`, `Topic`, `Tid`, `Sid`, `Stid`) VALUES
(1, 1, 'Курсовая по рисованию', 1, 1, 9),
(2, 2, 'Спасение от диких обезьян без смс и регистрации', 2, 1, 3),
(3, 1, 'New Sample T', 1, 1, 2),
(6, 1, 'Тема1_1', 1, 1, 0),
(7, 1, 'Test_Theme1_1', 1, 1, 0);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

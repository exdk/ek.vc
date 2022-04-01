-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Хост: localhost
-- Время создания: Июл 27 2014 г., 23:43
-- Версия сервера: 5.1.73
-- Версия PHP: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- База данных: `link82`
--

-- --------------------------------------------------------


--
-- Структура таблицы `counts`
--

CREATE TABLE IF NOT EXISTS `counts` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `idurl` varchar(5) NOT NULL,
  `first` int(10) NOT NULL,
  `last` int(10) NOT NULL,
  `counts` int(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------


--
-- Структура таблицы `url`
--

CREATE TABLE IF NOT EXISTS `url` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `url` varchar(15) NOT NULL,
  `url_real` varchar(1000) NOT NULL,
  `user` varchar(20) NOT NULL,
  `count` int(7) NOT NULL,
  `adver` int(1) NOT NULL,
  `api` int(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `url` (`url`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Дамп данных таблицы `url`
--

INSERT INTO `url` (`id`, `url`, `url_real`, `user`, `count`, `adver`, `api`) VALUES
(1, 'rus', 'http://ek.vc/?p=lang&v=russian', 'System', 0, 0, 0);
(2, 'eng', 'http://ek.vc/?p=lang&v=english', 'System', 0, 0, 0);
(3, 'Jya', 'http://google.com', 'System', 0, 0, 0);

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `password2` varchar(32) NOT NULL DEFAULT '',
  `level` int(1) NOT NULL,
  `bann` varchar(1) NOT NULL DEFAULT '',
  `mail` varchar(40) NOT NULL DEFAULT '',
  `salt` char(3) NOT NULL DEFAULT '',
  `key` varchar(10) NOT NULL DEFAULT '',
  `ip` varchar(15) NOT NULL DEFAULT '',
  `sess` varchar(20) NOT NULL DEFAULT '',
  `visit` varchar(20) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `login` (`login`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `login`, `password`, `password2`, `level`, `bann`, `mail`, `salt`, `key`, `ip`, `sess`, `visit`) VALUES
(1, 'System', '51d3fd0014655dbbee7a08f2eeb59769', '123456', 0, '', 'a@ek.vc', '48j', 'xaosxaos11', '178.163.28.212', '', ''),
(2, 'API', '51d3fd0014655dbbee7a08f2eeb59769', '123456', 0, '', 'a@ek.vc', 'sn4', 'xaosxaos12', '178.163.28.212', '', ''),
(3, 'barmen65', '51d3fd0014655dbbee7a08f2eeb59769', '123456', 3, '', 'a@ek.vc', 'iyh', 'xaosxaos16', '178.163.28.212', '', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

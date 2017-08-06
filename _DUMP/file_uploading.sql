-- phpMyAdmin SQL Dump
-- version 4.7.1
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Авг 06 2017 г., 16:13
-- Версия сервера: 5.7.18-log
-- Версия PHP: 7.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `file_uploading`
--

-- --------------------------------------------------------

--
-- Структура таблицы `file`
--

CREATE TABLE `file` (
  `f_id` int(10) UNSIGNED NOT NULL,
  `f_name` varchar(150) DEFAULT NULL,
  `f_user` int(10) UNSIGNED DEFAULT NULL,
  `f_size` float NOT NULL,
  `f_date` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `file`
--

INSERT INTO `file` (`f_id`, `f_name`, `f_user`, `f_size`, `f_date`) VALUES
(1, 'Olga_file_1', 1, 2, '2017-07-04 22:21:11'),
(2, 'Olga_file_2', 1, 3, '2017-07-04 23:21:11'),
(3, 'serg_file_1', 2, 4, '2017-08-20 22:21:11'),
(4, 'serg_file_2', 2, 5, '2017-08-20 00:21:11');

-- --------------------------------------------------------

--
-- Структура таблицы `user`
--

CREATE TABLE `user` (
  `u_id` int(10) UNSIGNED NOT NULL COMMENT 'Primary Key',
  `u_email` varchar(100) NOT NULL COMMENT 'User''s email.',
  `u_password` char(40) NOT NULL COMMENT 'Password as hash',
  `u_name` varchar(150) NOT NULL COMMENT 'User''s name',
  `u_lastname` varchar(200) NOT NULL COMMENT 'User''s lastname'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `user`
--

INSERT INTO `user` (`u_id`, `u_email`, `u_password`, `u_name`, `u_lastname`) VALUES
(1, 'ol_v@tt.com', 'a642a77abd7d4f51bf9226ceaf891fcbb5b299b8', 'Olga', 'Victorovich'),
(2, 'serg_p@gmail.com', 'f638e2789006da9bb337fd5689e37a265a70f359', 'Sergey', 'Petrov');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `file`
--
ALTER TABLE `file`
  ADD PRIMARY KEY (`f_id`),
  ADD KEY `f_user` (`f_user`);

--
-- Индексы таблицы `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `UQ_user_u_email` (`u_email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `file`
--
ALTER TABLE `file`
  MODIFY `f_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- AUTO_INCREMENT для таблицы `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT 'Primary Key', AUTO_INCREMENT=3;
--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `file`
--
ALTER TABLE `file`
  ADD CONSTRAINT `FK_file_user` FOREIGN KEY (`f_user`) REFERENCES `user` (`u_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Хост: db
-- Время создания: Апр 11 2019 г., 16:38
-- Версия сервера: 5.7.22
-- Версия PHP: 7.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

--
-- База данных: `test-uniweb`
--

-- --------------------------------------------------------

--
-- Структура таблицы `data`
--

CREATE TABLE `data` (
  `ident` varchar(32) NOT NULL,
  `value` varchar(255) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=cp1251;

--
-- Дамп данных таблицы `data`
--

INSERT INTO `data` (`ident`, `value`, `version`) VALUES
('11ca7c4b4f7c775017bd56c5e3341c07', '1', 1),
('c3f9b40539199f5fc491a6c3b73ad702', '2', 2),
('a8fcbe77aa628beb393478bae272ff5e', '4', 5),
('af38fbe961646d65313a20c91b8642f8', '9', 3);

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `data`
--
ALTER TABLE `data`
  ADD UNIQUE KEY `ident` (`ident`);
COMMIT;

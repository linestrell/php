CREATE DATABASE `db_lesson_6` DEFAULT CHARACTER SET UTF8 COLLATE utf8_general_si;
USE `db_lesson_6`;


--
-- Структура таблицы `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback`
(
    `id`       int(11)     NOT NULL AUTO_INCREMENT,
    `feedback` text        NOT NULL,
    `nickname` varchar(64) NOT NULL DEFAULT 'Аноним',
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;



INSERT INTO `feedback` (`id`, `feedback`, `nickname`)
VALUES (1, 'тестовый анонимный отзыв', 'Аноним');



--
-- Структура таблицы `products`
--

CREATE TABLE IF NOT EXISTS `products`
(
    `id`          int(11)       NOT NULL AUTO_INCREMENT,
    `name`        varchar(250)  NOT NULL,
    `price`       decimal(6, 2) NOT NULL,
    `description` text          NOT NULL,
    `image`       varchar(250)  NOT NULL,
    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;




INSERT INTO `products` (`id`, `name`, `price`, `description`, `image`) VALUES
(1, 'Смартфон Huawei P30 Lite', 312.42, 'Поражает своей красотой\r\nБыстро соображает\r\nДолго работает', 'p30lite.jpeg');
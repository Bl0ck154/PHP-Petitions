-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Хост: localhost
-- Время создания: Дек 23 2018 г., 11:41
-- Версия сервера: 10.1.26-MariaDB-0+deb9u1
-- Версия PHP: 7.1.23-2+0~20181017082622.9+stretch~1.gbpab65a0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- База данных: `krivbass_itstep`
--

-- --------------------------------------------------------

--
-- Структура таблицы `petitions`
--

CREATE TABLE `petitions` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `petitions`
--

INSERT INTO `petitions` (`id`, `title`, `description`, `author_id`) VALUES
(1, 'First', 'tsetsatjkl', 1),
(2, 'Second', 'asdasdfaf', 2),
(3, '3rd petition', 'Ð²Ñ„Ð°Ð¿Ñ„Ñ‹Ð²Ð¿', 3),
(4, '4oijjjas', 'Ð¿Ñ‹Ñ„Ð¿Ð°Ñ‹Ð²Ð°', 4),
(5, 'ASDASD', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sunt quos, ipsam vitae quasi hic, laborum dolorum similique veniam porro voluptatem. Quam asperiores dolorem velit. Asperiores, recusandae voluptate excepturi laudantium molestiae ab distinctio nesciunt est blanditiis maiores reprehenderit culpa inventore modi, ullam dolor qui dolore placeat labore! Architecto tempora placeat delectus temporibus quas accusamus amet eveniet, tenetur, earum totam. Necessitatibus maxime doloribus quis, similique neque architecto ex soluta eveniet culpa iure modi ipsam eligendi repellat voluptatibus repellendus adipisci deserunt id impedit, accusantium iste dolore cumque et sit voluptates. Unde laboriosam dolorem quisquam ipsam sequi illo beatae, vel ducimus commodi architecto libero dolore, nemo possimus error tempora, nam corporis reprehenderit soluta! Dignissimos ipsum, omnis rerum, dolor assumenda minima ab libero amet eveniet beatae. Cum quo dignissimos eum rerum itaque at asperiores? Assumenda laborum similique reiciendis velit officiis libero aut asperiores quas id a itaque vitae dolor quia, aperiam aliquid, corporis ipsa quasi ad, quo sit ut consectetur? Possimus eligendi omnis, nobis accusantium enim sequi quaerat nam unde cupiditate officia iste libero adipisci repellendus doloribus dolorum ipsam, molestias ea, numquam exercitationem dolorem maiores, soluta molestiae dicta. Qui rem quia iusto nulla dolor officia optio, libero ea molestiae nesciunt atque, soluta amet est. Illum eum id veritatis iure distinctio earum adipisci quo soluta dolor aspernatur, atque odio eius molestiae placeat deleniti modi rerum fugit possimus aut magnam magni, dignissimos, libero unde. Fugit, vero, dignissimos. Cumque, vel nostrum praesentium ut error omnis facilis labore enim quasi, culpa iure ducimus, blanditiis officiis recusandae, quisquam esse quibusdam placeat minima tempore voluptatum repellat amet soluta corrupti. Possimus eius inventore fuga dolorem rerum sapiente aliquid accusantium vel illo molestiae saepe delectus temporibus ratione quidem a earum mollitia necessitatibus nisi distinctio, aperiam iure, dicta expedita vitae cupiditate. Modi, quis dolorem minima iusto sapiente reiciendis doloremque, optio quibusdam vel expedita molestiae inventore quaerat libero! Magni sit labore fugiat eos ratione tenetur dolorem a, error temporibus dignissimos velit autem animi rerum voluptatibus alias laborum ullam id debitis vero ipsam sapiente perspiciatis sequi eius, eaque necessitatibus? Aliquid non fuga reiciendis laudantium ipsum excepturi molestias soluta sed vitae. Corporis quo labore velit pariatur neque dolores doloribus. Sint vitae eveniet sequi voluptatibus nisi numquam labore voluptatem natus autem. Magni quod sequi eligendi animi modi, optio perferendis, recusandae molestiae deleniti asperiores corrupti magnam expedita ducimus, maxime amet dicta voluptatibus blanditiis. Aut sequi placeat, facere. In officiis perferendis, reprehenderit similique nam quam voluptas et ea porro, beatae provident eos obcaecati impedit, deserunt possimus! Quod modi porro natus vitae, alias magnam, dignissimos dolor ipsam molestiae voluptas deserunt tempora eos, minus reprehenderit. Veniam ea enim, aut ad veritatis facere accusamus animi soluta expedita, voluptatem delectus. Tenetur delectus voluptas optio, placeat numquam nemo recusandae temporibus pariatur distinctio, similique assumenda vitae! Distinctio laboriosam nemo unde quo ipsa neque, reprehenderit modi, ullam explicabo quae, odio aut? Dolore, ipsum, officiis. Velit delectus optio perferendis architecto, quis eius commodi dignissimos, hic quae similique repellat expedita. Excepturi ut veritatis, quos quaerat maiores accusantium repellat, cupiditate, ea quas doloremque voluptatum laudantium voluptatem deleniti! Dolorum neque possimus, ex id et odio dicta expedita, dolor doloribus, praesentium magni, velit amet. Impedit obcaecati, explicabo soluta perferendis officia blanditiis delectus accusantium facere ipsam quam repellendus quae doloremque hic esse eveniet dignissimos, possimus distinctio quod nemo nam praesentium ab. Pariatur quo labore illum nisi fugit quidem delectus quia praesentium similique modi sequi, doloremque! Aperiam deleniti amet ipsum modi veniam deserunt sit?', 5),
(7, 'FFFFFFFFFFFFFFFFFFF', 'ZZZZZZZZZZZZZZZZZZZZZZZZZZ', 7),
(24, 'AJAX', 'TEST AJXA ', 17),
(25, 'new ', 'asdasdasda', 18),
(29, 'hgjhgj', 'hgjghj', 20),
(30, 'Hello petition', 'Hello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petitionHello petition', 22),
(31, 'testtesttest', 'testtesttesttest', 23),
(34, 'ORM petition', 'new petition', 21),
(35, 'ORM petition 223', 'ÑƒÐ¹Ñ†ÑƒÑ„Ñ†ÑƒÐ¹Ñ†ÑƒÑ„Ñ‹Ð²Ñ„Ñ‹Ð²Ñ„Ñ‹', 21),
(36, 'ORM petition 123', 'saasdweqdqweqwe', 21),
(37, '<b>BOLD</b>', '<br><br>hello<script>alert(0)</script>', 21),
(38, '&lt;b&gt;BOLD2&lt;/b&gt;', 'weqweqwe', 21);

-- --------------------------------------------------------

--
-- Структура таблицы `signs`
--

CREATE TABLE `signs` (
  `id` int(11) NOT NULL,
  `petition_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0',
  `activation` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `signs`
--

INSERT INTO `signs` (`id`, `petition_id`, `user_id`, `status`, `activation`) VALUES
(1, 1, 10, '0', 'ca4cdf654ec2a131d4def0fcd52cba0e'),
(2, 2, 8, '0', '0a620d7c1161f7afdd5d579af89b8d4f'),
(3, 2, 8, '0', '8c32ee1c24baf9641981870b50efb3a4'),
(4, 1, 8, '0', 'd8a05886f6e3677aa6e1ecaa3e5880da'),
(5, 2, 10, '0', '3c798cce38ea1f2d14188da4511620b3'),
(6, 1, 8, '0', '5e570e932009a2aa0f1e906a6686be46'),
(7, 2, 11, '0', '0eb6837c86a7532aef578ccab23c08c8'),
(8, 2, 13, '0', '0962221811@mail.ua'),
(9, 2, 8, '0', 'fee1b302041d50c9751022d7daa4a57c'),
(10, 2, 8, '0', '8eaec36b79834c2c0b96eff13d3aa0fc'),
(11, 2, 8, '0', 'f6891d27d49da07bc1a6b48c0c41c944'),
(12, 2, 8, '0', '71e773a05ebea0f94f07796c676f35cd'),
(13, 2, 14, '0', '1ada4be1cb9b5fb3a89e6ad09240ef65'),
(14, 2, 8, '0', '3e6570700198d5de070460021468207f'),
(15, 2, 8, '0', 'b02cff69f086f27b82162317c0c9ff5d'),
(16, 2, 8, '0', 'f0836625fb3631676c7c677ae7d04058'),
(17, 1, 8, '0', 'bfcbc10a0af223f26e55beefb266947c'),
(18, 2, 8, '0', '6d6ef37fb0d2aa3305d31d39aee7dfe4'),
(19, 5, 8, '1', 'a45734a47e64cc18e273d0593ef312db'),
(20, 1, 8, '0', 'af209e06b58c7b5a2dc2d7dc560a9263'),
(21, 1, 8, '1', '58c15b8b057a7e3cbf6fda7d2e6710c2'),
(22, 1, 8, '1', '6ca629df59e9481e56c35883d3938732'),
(23, 1, 8, '0', 'ade52d64177caa7876fe51fa9b67bdbd'),
(24, 1, 8, '0', '4079bafb94fff976c8754148e070b624'),
(25, 2, 8, '1', 'a872df824447fa30546a82856cd9b711'),
(26, 1, 20, '0', '551e4c6fff166ddd194452760677bf81'),
(27, 1, 8, '0', 'd834c0424df1a7464bed84d56915d1bc'),
(28, 1, 8, '0', '1c87a98240a84db8a7370daa16018446'),
(29, 2, 8, '0', '26f0d5b93dc204001b90142d6377f697'),
(30, 2, 8, '0', '6ed758fe1ab05b97530a9f82f4759471'),
(31, 3, 21, '0', '6308590a2056ae4229a66b240007efbb'),
(32, 3, 8, '0', '4bbf1e97987dddec4fdc1d5a4275e94a'),
(33, 30, 10, '0', '176519b362d4c7ce3e163d3c7947e799'),
(34, 3, 8, '0', '16715cb6bf07902376780efe5fd88dfb'),
(35, 31, 8, '0', '88ff1512bbd672c0dc1180fbe1182162'),
(36, 2, 8, '0', 'cc35c032d506eada59af1b3916f6fb3a'),
(37, 1, 8, '0', '62fab486af035c365a395a7248762331'),
(38, 1, 8, '0', 'de2dbb0690e18720802a82e30fae5666'),
(39, 1, 8, '0', '033a4b5c3fae38374aaae9a2feaee108'),
(40, 1, 8, '1', '9fc3f007d3a89dbb26ef69d2dd124d5e'),
(41, 1, 8, '1', 'bb0d8058f8ad4780ffa439b5bf3074ec'),
(42, 2, 8, '1', '33fa217cadd437a8c1a29e894fbdbc7f');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(64) NOT NULL,
  `password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Дамп данных таблицы `users`
--

INSERT INTO `users` (`id`, `email`, `password`) VALUES
(1, 'test@mail.ya', ''),
(2, 'hi@mail.ru', ''),
(3, 'ÑÐ¼Ñ‡ÑÑÐ¼Ð¸Ñ‡ÑÐ¼Ð¸', ''),
(4, 'Ñ„Ñ‹Ð²Ñ„Ñ‹Ð²', ''),
(5, 'asdasd', ''),
(6, '', ''),
(7, 'ZZZ@kilo.ua', ''),
(8, 'Bl0ck@bk.ru', ''),
(9, 'wer', ''),
(10, 'iluxa154@bk.ru', ''),
(11, 'Bl0ck@mail.ua', ''),
(12, 'sdadadsdasd@wen.ru', ''),
(13, '0962221811@mail.ua', ''),
(14, 'dimitrova43@bk.ru', ''),
(15, 'Bl0ck@bnk.ru', ''),
(16, 'Blo0cK@bk.ru', ''),
(17, 'Bl@bk.ru', ''),
(18, 's@s.s', ''),
(19, 'B@b.r', ''),
(20, 'ghjghj@gfhgf.fg', ''),
(21, 'zabil024@gmail.com', ''),
(22, 'test@mail.ru', ''),
(23, 'test@test.ua', '');

--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `petitions`
--
ALTER TABLE `petitions`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `signs`
--
ALTER TABLE `signs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `activation` (`activation`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `petitions`
--
ALTER TABLE `petitions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT для таблицы `signs`
--
ALTER TABLE `signs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

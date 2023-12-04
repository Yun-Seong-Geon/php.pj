-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-12-04 22:36
-- 서버 버전: 10.4.28-MariaDB
-- PHP 버전: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `petfolio`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `username`, `content`, `created_at`) VALUES
(46, 10, 'Saoha', '반가워요', '2023-12-04 08:47:44');

-- --------------------------------------------------------

--
-- 테이블 구조 `notices`
--

CREATE TABLE `notices` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `notices`
--

INSERT INTO `notices` (`id`, `title`, `content`, `author`, `created_at`, `views`) VALUES
(1, '안녕하세요 반갑습니다', '반갑습니다 관리자입니다\n웹사이트를 이용하시면서 불편하신 부분은 게시판에 올려주세요. 확인 후 변경하겠습니다\nPetFolio에서 AI를 입력하시면서 오류가 발생한다면 캡처하여 게시글 작성해주세요\n감사합니다', 'canyun0460', '2023-11-27 02:30:01', 68),
(2, '게시물 제목 여기다가 게시', 'hello', 'canyun0460', '2023-11-27 06:12:33', 84);

-- --------------------------------------------------------

--
-- 테이블 구조 `pf`
--

CREATE TABLE `pf` (
  `id` int(11) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `image_path` varchar(255) NOT NULL,
  `views` int(11) DEFAULT 0,
  `likes` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `pf`
--

INSERT INTO `pf` (`id`, `content`, `author`, `created_at`, `image_path`, `views`, `likes`) VALUES
(10, '이거 인공지능을 통해서 개 고양이 야생동물 분류한겁니다 신기하쥬?', 'Saoha', '2023-12-04 08:47:21', 'pf_image/1701679641793.png', 2, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `author` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `views` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `posts`
--

INSERT INTO `posts` (`id`, `title`, `content`, `author`, `created_at`, `views`) VALUES
(1, '이 홈페이지 뭐하는 홈페이지 인가요..? 설명좀', '제곧내<br /><br />\r\n제곧내제곧내제곧내제곧내제곧내제곧내<br /><br />\r\n제곧내제곧내<br /><br />\r\n제곧내제곧내<br /><br />\r\n제곧내제곧내<br /><br />\r\n<br /><br />\r\n제곧내제곧내', 'Saoha', '2023-11-28 07:17:59', 55),
(6, '최태용은 Joat임', '반박시 니말이 맞음<br />\r\nsubmit을 sumit으로 작성해서 css 연결안됨 ㅋzz', 'Saoha', '2023-11-28 16:02:18', 106),
(7, '이거 무슨 페이지인가요', '뭐야 이게 ㅋㅋ\r\n', 'Saoha', '2023-11-30 12:22:03', 28),
(8, '우리집 강아지는 사료를 안먹는데 어떡하죠?', '사료 안먹는데 밥 잘 먹이는 방법 없을까요?', '윤성건의 바지', '2023-11-30 13:45:28', 17),
(9, '홈페이지 너무 이쁜 것 같아요 ', '여러분도 동의 하시죠?', '윤성건의 바지', '2023-11-30 14:53:27', 0),
(10, '게시판 오류 있는 것 같은데 중첩되서 안나오네 이거', '?????', '윤성건의 바지', '2023-11-30 14:53:54', 6),
(11, 'ㅇㄹㅇㄹ', 'ㄹㅇㄹㅇ', '윤성건의 바지', '2023-11-30 14:54:22', 4),
(12, 'ㄹㅇㄹㅇ', 'ㅇㄹㅇㄹㅇ', '윤성건의 바지', '2023-11-30 14:54:28', 2);

-- --------------------------------------------------------

--
-- 테이블 구조 `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `role` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- 테이블의 덤프 데이터 `users`
--

INSERT INTO `users` (`id`, `username`, `password_hash`, `name`, `role`) VALUES
(1, 'canyun0460', '$2y$10$1LTHjbP6ouCKWFmZD4FV6.Qah7am0j27q5BQW5A4CKTnbldKa34xq', 'Saoha', 'admin'),
(2, 'canyun', '$2y$10$5kbtxjpT2Txlo5frNrt3L.aUu8sDTHIeXbljllNF0ap.bB2Fbd9o.', 'ssaa', 'user'),
(3, 'canyun0', '$2y$10$zGASSZRkDwS8ZKaRY8/JXOGgV8lrPH6blqhBbSMsZMpqt0SkndOai', 'ssaaoha', 'user'),
(4, 'chaitae67', '$2y$10$dtSHTwoFhQP5.1CCpS4VJe43DiA7h.glMO/GsGJcLHATXLc6LSTcu', '윤성건의 바지', 'user');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `post_id` (`post_id`);

--
-- 테이블의 인덱스 `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `pf`
--
ALTER TABLE `pf`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- 테이블의 인덱스 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- 테이블의 AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- 테이블의 AUTO_INCREMENT `pf`
--
ALTER TABLE `pf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- 테이블의 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 덤프된 테이블의 제약사항
--

--
-- 테이블의 제약사항 `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `pf` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

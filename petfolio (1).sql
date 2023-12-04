-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 23-12-04 23:21
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
CREATE DATABASE IF NOT EXISTS `petfolio` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `petfolio`;

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
(46, 10, 'Saoha', '반가워요', '2023-12-04 08:47:44'),
(50, 12, '큐더블유이알', '추천 받습니다!', '2023-12-04 21:50:57'),
(51, 12, '우리집강아지는포포', '귀엽게 생겼네요 ㅎㅎ ', '2023-12-04 21:51:29'),
(52, 12, '우리집강아지는포포', '이름 포피 어때요 귀여운 것 같은데 ㅎ', '2023-12-04 21:51:45'),
(53, 12, '갱얼쥐', '왕 개 귀엽다', '2023-12-04 21:52:22'),
(54, 12, '또리', '아기 이름 또리 어때요', '2023-12-04 21:52:38'),
(55, 12, '또리', '뭔가 또리처럼 생김 ㅋㅋ', '2023-12-04 21:52:49');

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
(1, '안녕하세요 반갑습니다', '반갑습니다 관리자입니다\n웹사이트를 이용하시면서 불편하신 부분은 게시판에 올려주세요. 확인 후 변경하겠습니다\nPetFolio에서 AI를 입력하시면서 오류가 발생한다면 캡처하여 게시글 작성해주세요\n감사합니다', 'canyun0460', '2023-11-27 02:30:01', 72),
(4, 'AI관련 공지사항', '반갑습니다 관리자입니다. AI에 사람 사진을 넣으면 결과가 부정확합니다. 그 점 숙지하시고 AI 사용 당부드립니다', 'canyun0460', '2023-12-04 21:59:20', 3);

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
(10, '이거 인공지능을 통해서 개 고양이 야생동물 분류한겁니다 신기하쥬?', 'Saoha', '2023-12-04 08:47:21', 'pf_image/1701679641793.png', 2, 0),
(12, '이번에 분양 받은 우리집 새 식구에요! 귀엽죠? 아직 이름을 짓지 못했어요 추천 해주세요!\r\n', '큐더블유이알', '2023-12-04 21:50:50', 'pf_image/17017266507364.jpeg', 10, 0),
(13, '슈가글라이더 귀엽죠 아직 애기라서 날지는 못하는데 너무 귀여워요!\r\n주식은 애벌레에요 밥 먹을 때 젤 귀여움', '또리', '2023-12-04 21:55:00', 'pf_image/170172690065.jpeg', 1, 0),
(14, '우리집 집주인 입니다 츄르를 보면 사족을 못써요.\r\n츄르로 이번달에 40만원 나간건 안비밀', '윤성건의 바지', '2023-12-04 21:57:32', 'pf_image/17017270522438.jpeg', 0, 0);

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
(8, '우리집 강아지는 사료를 안먹는데 어떡하죠?', '사료 안먹는데 밥 잘 먹이는 방법 없을까요?', '윤성건의 바지', '2023-11-30 13:45:28', 19),
(9, '홈페이지 너무 이쁜 것 같아요 ', '여러분도 동의 하시죠?', '윤성건의 바지', '2023-11-30 14:53:27', 1),
(13, '홈페이지 배경 사진', '홈페이지 배경 사진 강아지 너무 귀엽긴한데 자주 봐서 지겨워요 업데이트 언제 되나요', '우리집강아지는포포', '2023-12-04 21:43:08', 1),
(14, 'AI 너무 신기하네요 ', '사람 얼굴 사진 넣어보신분 계신가요 저는 참고로 고양이 나옴 나 고양이 상인가봄 ㅋㅋ', '갱얼쥐', '2023-12-04 21:44:34', 1),
(15, '분양 받고 싶어요', '리트리버 너무 귀엽다 분양 받고 싶다 대형견 키워보고 싶어요!!!!!!', '또리', '2023-12-04 21:46:42', 1),
(16, '소형견 VS 대형견', '여러분은 포메 같은 소형견이 좋으세요 아니면 리트리버 같은 대형견이 좋으세여', '또리', '2023-12-04 21:47:17', 2),
(17, '강아지를 분양 받았어요 ', '강아지 이름 추천 받습니당\r\n', '큐더블유이알', '2023-12-04 21:48:17', 5);

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
(4, 'chaitae67', '$2y$10$dtSHTwoFhQP5.1CCpS4VJe43DiA7h.glMO/GsGJcLHATXLc6LSTcu', '윤성건의 바지', 'user'),
(5, '123', '$2y$10$tD1R4VD6K5ux4MJYQ8gGveDoiFDtoYaUdcTaNgkwpr5yW8Fq/dX0K', '우리집강아지는포포', 'user'),
(6, '1234', '$2y$10$Qyv57qgjAcJ1ffNuAJNSfeCTG28v/OOVHy83GYaJBgzW7EIHXBrjm', '갱얼쥐', 'user'),
(7, '12345', '$2y$10$3gjeIsqSdV1YKfUIcuH78.LLoSuUaBB95piscDbKzv/UBAg//o7gW', '또리', 'user'),
(8, 'qwer', '$2y$10$dpp9zgiCM.vTosJaXn4VW.nucguNxKKVchN7F7Vkh.IpJa/0fcwte', '큐더블유이알', 'user');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;

--
-- 테이블의 AUTO_INCREMENT `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- 테이블의 AUTO_INCREMENT `pf`
--
ALTER TABLE `pf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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

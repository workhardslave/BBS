-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- 생성 시간: 20-09-29 05:15
-- 서버 버전: 10.4.10-MariaDB
-- PHP 버전: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `bbs`
--

-- --------------------------------------------------------

--
-- 테이블 구조 `board`
--

CREATE TABLE `board` (
  `idx` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `hit` int(11) NOT NULL,
  `lock_post` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 테이블의 덤프 데이터 `board`
--

INSERT INTO `board` (`idx`, `name`, `pw`, `title`, `content`, `date`, `hit`, `lock_post`) VALUES
(1, 'test', '$2y$10$p15ZHQu2TlJ3p6V4xn1ts.Nq5errsTaz.34bDgqQhOZs8Jd4az8h2', '첫번째 글', '안녕하세요', '2019-11-20', 264, 0),
(2, 'test', '$2y$10$X8qRgc/1SQtUP2YziJLaJOCfllup0AoB/je3PcptSS.GTFvX/sAHO', '두번째 글은 비밀글', 'ㅎㅎ', '2019-11-20', 19, 1),
(3, 'test', '$2y$10$e2DdkRR4IghpU6NrpM4NAOevv0UWdkwBHC.6KSd9.O4Kl1bUkMdp2', '페이징', '페이징', '2019-11-20', 2, 0),
(4, 'test', '$2y$10$47VlDiqmnlAbWKlUzT1HQ.6PzHuRQ.UX7rjD2C9ySAPYNbYeYRua.', '페이징', '페이징', '2019-11-20', 6, 0),
(6, 'test', '$2y$10$2nGGw4HXdiV3QTnjKMtgnejvZ493Q29Q6Q25XJPsDV7URkrRF0vNi', '페이징', '페이징', '2019-11-20', 0, 0),
(7, 'test', '$2y$10$jtU.tSMhXUcBXkE6.QgK7OU5wWvx9lGy8O3PAYm7nJjnjW9vmKr4C', '페이징', '페이징', '2019-11-21', 1, 0),
(8, 'gildong', '$2y$10$FbWXtWEFAdRgd4pzpS0kPO5b2clnqu0bC6RUpgaDUA3obQFfEzkou', '페이징', '카톡', '2019-11-21', 6, 0),
(9, 'gildong', '$2y$10$R1R3D4qwrWKCGg3eeOpCSeGWR9fbLaX73tKePwcHzP0RnnJnQuweK', '페이징', '카톡 vs 라인', '2019-11-21', 3, 0),
(10, 'gildong', '$2y$10$HHh4RM0s1qTeb5VYSPXseu09C0YZNkbDDJRYjQAj6o0fj5W5x.IBS', '글쓰기 연습', '바보', '2019-11-21', 3, 0),
(11, 'gildong', '$2y$10$ab0G8A7rI7ZFvfRgO9Cz5uuLFCdaPeKF1cQwlb1tQltglK2ItcKNC', '수정 연습', '1231233', '2019-11-21', 11, 0),
(12, 'gildong', '$2y$10$3bc.yJ2TJgyABT87JKiE8uG8MSIrAFbsFEv/HRot1UNnIs.DaoyJ.', '글자수가 너무 길면 ... 이 생기도록 설정설정설정설정설정설정설정설정설정설정설정', '설정', '2019-11-21', 7, 0),
(13, 'gildong', '$2y$10$Gju75bY/pzgJBR8uq8sqEub0X5ISO8tJho44lBckBxYmI67zj3QtC', '삭제 연습', '연습', '2019-11-21', 10, 0),
(14, 'test', '$2y$10$2whgx0oGF3oRTMJf/lSRQudvd9klX2qfwOtVtxZRA1tt1Y0H5FtaS', '글쓰기 연습', '아에이오우2233', '2020-05-12', 48, 0);

-- --------------------------------------------------------

--
-- 테이블 구조 `reply`
--

CREATE TABLE `reply` (
  `idx` int(11) NOT NULL,
  `con_num` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pw` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 테이블 구조 `user`
--

CREATE TABLE `user` (
  `num` int(11) NOT NULL,
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `pass` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `name` char(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` char(10) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `phone` char(20) COLLATE utf8_unicode_ci DEFAULT 'NULL',
  `email` char(80) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'USER'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 테이블의 덤프 데이터 `user`
--

INSERT INTO `user` (`num`, `id`, `pass`, `name`, `gender`, `phone`, `email`, `role`) VALUES
(1, 'test', '$2y$10$a0whK3OR0fNhXiip/FmcNu4cw82alizDfs782IufPsW/cmE2A1Wzq', '홍길동', '남자', '01012345678', 'test3@daum.net', 'USER'),
(2, 'gildong', '$2y$10$SUyjaYmzSlwUJDcbY9RRDOD5gfZzKqh1AtvHiAJyLmZXfwVE0azFe', '홍길순', '여자', '01012345678', 'babo@babo', 'USER'),
(4, 'admin', '$2y$10$Mgnc579yqNtpCd4nihf5LObEumXUN9GB5UtHh0gRRCkNLUYaO/8zG', '관리자', '남자', '123', '123', 'ADMIN');

--
-- 덤프된 테이블의 인덱스
--

--
-- 테이블의 인덱스 `board`
--
ALTER TABLE `board`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `reply`
--
ALTER TABLE `reply`
  ADD PRIMARY KEY (`idx`);

--
-- 테이블의 인덱스 `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`num`);

--
-- 덤프된 테이블의 AUTO_INCREMENT
--

--
-- 테이블의 AUTO_INCREMENT `board`
--
ALTER TABLE `board`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- 테이블의 AUTO_INCREMENT `reply`
--
ALTER TABLE `reply`
  MODIFY `idx` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- 테이블의 AUTO_INCREMENT `user`
--
ALTER TABLE `user`
  MODIFY `num` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

CREATE DATABASE IF NOT EXISTS `quizz` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_vietnamese_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `quizz`;

CREATE TABLE IF NOT EXISTS `classes` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `classes` (`id`, `name`) VALUES
	(1, '10C1'),
	(2, '10C2'),
	(3, '10C3'),
	(4, '10C4');
	
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `fullname` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'https://t4.ftcdn.net/jpg/04/08/24/43/360_F_408244382_Ex6k7k8XYzTbiXLNJgIL8gssebpLLBZQ.jpg',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `class_id` bigint unsigned DEFAULT NULL,
  `role` int DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `FK_users_classes` (`class_id`),
  CONSTRAINT `FK_users_classes` FOREIGN KEY (`class_id`) REFERENCES `classes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `users` (`id`, `username`, `fullname`, `email`, `avatar`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `class_id`, `role`) VALUES
	(1, 'hocsinh', 'Nguyễn Văn A', 'a12@gmail.com', 'https://t4.ftcdn.net/jpg/04/08/24/43/360_F_408244382_Ex6k7k8XYzTbiXLNJgIL8gssebpLLBZQ.jpg', NULL, '$2y$10$i.qpAjpEP8rACD2f7UAfGut1GeRMEIVe803c9YD.jnRMyp3JmdyDi', NULL, '2023-09-04 04:55:28', '2023-09-12 08:44:46', 1, 0),
	(2, 'ab', 'Nguyễn Hồ Thanh Bền 3', 'nben20@gmail.com', 'https://res.cloudinary.com/dr4cghpgp/image/upload/v1697940513/gmglzcqqz9m3sgmvbnog.png', NULL, '$2y$10$9Ycua70zEZi/kv2.cgZkbOWuzlDa4eanGukey94B6d1uL0ECqimFe', NULL, '2023-09-03 22:02:03', '2023-10-21 19:08:42', 2, 0),
	(6, 'giaovien', 'Nguyễn Hồ Thanh Bền 2', 'nben19732@gmail.com', 'https://res.cloudinary.com/dr4cghpgp/image/upload/v1700665660/quxrkiedl6xa7ripwtee.png', NULL, '$2y$10$ntz/8nqpHMbdBi8JNnK.E.wiUsi2UpV0MHy2lplMy3m4RT.33wiXO', NULL, NULL, '2023-11-24 13:30:09', 2, 1),
	(7, 'ab', 'Nguyễn Hồ Thanh Bền 3', 'nben201@gmail.com', 'https://res.cloudinary.com/dr4cghpgp/image/upload/v1697940513/gmglzcqqz9m3sgmvbnog.png', NULL, '$2y$10$9Ycua70zEZi/kv2.cgZkbOWuzlDa4eanGukey94B6d1uL0ECqimFe', NULL, '2023-09-03 22:02:03', '2023-10-21 19:08:42', 2, 0);

CREATE TABLE IF NOT EXISTS `exams` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `desc` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `duration` int NOT NULL,
  `password` int DEFAULT NULL,
  `status` int NOT NULL DEFAULT '0',
  `point` int NOT NULL,
  `type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT '0: Practice, 1: Contest',
  `start_time` datetime DEFAULT NULL,
  `end_time` datetime DEFAULT NULL,
  `user_id` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `FK_exams_users` (`user_id`),
  CONSTRAINT `FK_exams_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `exams` (`id`, `title`, `desc`, `duration`, `password`, `status`, `point`, `type`, `start_time`, `end_time`, `user_id`) VALUES
	(14, 'Ôn tập kiểm tra 15p - Môn địa', 'Ôn tập kiểm tra 15p - Môn địa', 10, 123, 1, 17, 'practices', '2023-09-27 23:38:00', '2023-10-10 23:38:00', 6),
	(15, 'Đề Thi Học Kỳ 1 Môn GDCD  2022 - 2023', 'Đề Thi Học Kỳ 1 Môn GDCD  2022 - 2023', 120, 123, 1, 7, 'contests', '2023-09-28 00:01:00', '2023-11-23 02:07:00', 6),
	(17, '123', '123', 1, 123, 1, 7, NULL, NULL, NULL, NULL);


CREATE TABLE IF NOT EXISTS `contests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` bigint unsigned NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `contests_exam_id_foreign` (`exam_id`),
  CONSTRAINT `contests_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `contests` (`id`, `exam_id`, `status`, `start_time`, `end_time`) VALUES
	(12, 15, 0, '2023-09-27 17:02:04', '2023-11-23 17:02:04');


CREATE TABLE IF NOT EXISTS `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `log_contest` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contest_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `point` int unsigned NOT NULL DEFAULT '0',
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_contest_student_id_foreign` (`user_id`) USING BTREE,
  KEY `log_contest_contest_id_foreign` (`contest_id`),
  CONSTRAINT `FK_log_contest_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `log_contest_contest_id_foreign` FOREIGN KEY (`contest_id`) REFERENCES `contests` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `log_contest` (`id`, `contest_id`, `user_id`, `point`, `created_at`) VALUES
	(8, 12, 6, 4, '2023-09-27 18:20:44'),
	(9, 12, 2, 1, '2023-11-22 12:01:03');
	
CREATE TABLE IF NOT EXISTS `practices` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` bigint unsigned NOT NULL,
  `status` int NOT NULL DEFAULT '0',
  `start_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `practices_exam_id_foreign` (`exam_id`),
  CONSTRAINT `practices_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `practices` (`id`, `exam_id`, `status`, `start_time`) VALUES
	(13, 14, 1, '2023-10-22 02:13:49');

CREATE TABLE IF NOT EXISTS `log_practice` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `practice_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `point` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_practice_student_id_foreign` (`user_id`) USING BTREE,
  KEY `log_practice_practice_id_foreign` (`practice_id`),
  CONSTRAINT `FK_log_practice_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `log_practice_practice_id_foreign` FOREIGN KEY (`practice_id`) REFERENCES `practices` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `log_practice` (`id`, `practice_id`, `user_id`, `point`, `created_at`) VALUES
	(19, 13, 6, 1, '2023-10-22 05:08:10'),
	(20, 13, 6, 1, '2023-11-21 15:05:01');

CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
	(1, '2014_10_12_000000_create_users_table', 1),
	(2, '2014_10_12_100000_create_password_resets_table', 1),
	(3, '2019_08_19_000000_create_failed_jobs_table', 1),
	(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
	(5, '2023_09_02_103436_create_students_table', 1),
	(6, '2023_09_02_103437_create_classes_table', 1),
	(7, '2023_09_02_103548_create_teachers_table', 1),
	(8, '2023_09_02_103927_create_student_class_table', 1),
	(9, '2023_09_02_104118_create_badges_table', 1),
	(10, '2023_09_02_104200_create_student_badge_table', 1),
	(11, '2023_09_02_104809_create_exams_table', 1),
	(12, '2023_09_02_105250_create_questions_table', 1),
	(13, '2023_09_02_105811_create_options_table', 1),
	(14, '2023_09_02_110331_create_practices_table', 2),
	(15, '2023_09_02_110618_create_log_practice_table', 2),
	(16, '2023_09_02_110729_create_contests_table', 2),
	(17, '2023_09_02_110828_create_log_contest_table', 2);

CREATE TABLE IF NOT EXISTS `options` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `question_id` bigint unsigned NOT NULL,
  `option_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `options_question_id_foreign` (`question_id`),
  CONSTRAINT `options_question_id_foreign` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `options` (`id`, `question_id`, `option_text`) VALUES
	(69, 18, 'A: Đồi núi chiếm phần lớn diện tích nhưng chủ yếu là núi cao'),
	(70, 18, 'B: Cấu trúc địa hình khá đa dạng'),
	(71, 18, 'C: Địa hình của vùng nhiệt đới ẩm gió mùa'),
	(72, 18, 'D: Địa hình chịu tác động mạnh mẽ của con người'),
	(73, 19, 'A: Đôi núi chiêm phân lớn diện tích'),
	(74, 19, 'B: Hâu hêt là địa hình núi cao'),
	(75, 19, 'C: Có sự phân bậc rõ rệt theo độ cao'),
	(76, 19, 'D: Địa hình vùng nhiệt đới gió mùa.'),
	(77, 20, 'A: hưởng chế độ chăm sóc y tế'),
	(78, 20, 'B: miên thuế thu nhập'),
	(79, 20, 'C: nâng lương trước thời hạn'),
	(80, 20, 'D: từ bỏ quyền nhân thân'),
	(81, 21, 'A: vi phạm pháp luật'),
	(82, 21, 'B: thi hành pháp luật'),
	(83, 21, 'C: xâm phạm pháp luật'),
	(84, 21, 'D: tuân thủ pháp luật'),
	(85, 22, 'A: hưởng mọi lại phụ câp'),
	(86, 22, 'B: tự quyết định mức học bồng'),
	(87, 22, 'C.học l›ẳ.ug nhiều hình thức: D'),
	(88, 22, 'hoàn trả kinh phí đào tạo:'),
	(89, 23, 'A: tính mạng và sức khỏe'),
	(90, 23, 'B: tinh thần của công dân'),
	(91, 23, 'C: thể chất của công dân'),
	(92, 23, 'D: nhân phẩm, danh dự'),
	(93, 24, 'A: nghĩa vụ pháp lý'),
	(94, 24, 'B: quyền dân tộc'),
	(95, 24, 'C: trách nhiệm pháp lý'),
	(96, 24, 'D: quyền tự do cá nhân'),
	(97, 25, 'A: Kỷ lật'),
	(98, 25, 'B: Hình sự'),
	(99, 25, 'C: Dân sự'),
	(100, 25, 'D: Hành chính'),
	(101, 26, 'A: đền bù thiệt hại'),
	(102, 26, 'B: chấp hành án'),
	(103, 26, 'C: khiếu nại'),
	(104, 26, 'D: tố cáo.'),
	(105, 27, 'A: hưởng chế độ chăm sóc y tế'),
	(106, 27, 'B: miên thuế thu nhập'),
	(107, 27, 'C: nâng lương trước thời hạn'),
	(108, 27, 'D: từ bỏ quyền nhân thân'),
	(109, 28, 'A: vi phạm pháp luật'),
	(110, 28, 'B: thi hành pháp luật'),
	(111, 28, 'C: xâm phạm pháp luật'),
	(112, 28, 'D: tuân thủ pháp luật'),
	(113, 29, 'A: hưởng mọi lại phụ câp'),
	(114, 29, 'B: tự quyết định mức học bồng'),
	(115, 29, 'C.học l›ẳ.ug nhiều hình thức: D'),
	(116, 29, 'hoàn trả kinh phí đào tạo:'),
	(117, 30, 'A: tính mạng và sức khỏe'),
	(118, 30, 'B: tinh thần của công dân'),
	(119, 30, 'C: thể chất của công dân'),
	(120, 30, 'D: nhân phẩm, danh dự'),
	(121, 31, 'A: nghĩa vụ pháp lý'),
	(122, 31, 'B: quyền dân tộc'),
	(123, 31, 'C: trách nhiệm pháp lý'),
	(124, 31, 'D: quyền tự do cá nhân'),
	(125, 32, 'A: Kỷ lật'),
	(126, 32, 'B: Hình sự'),
	(127, 32, 'C: Dân sự'),
	(128, 32, 'D: Hành chính'),
	(129, 33, 'A: đền bù thiệt hại'),
	(130, 33, 'B: chấp hành án'),
	(131, 33, 'C: khiếu nại'),
	(132, 33, 'D: tố cáo.');

CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


CREATE TABLE IF NOT EXISTS `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=214 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `expires_at`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
	(137, 'App\\Models\\User', NULL, 1, 'token', '778f21cfd96defec641628b4869bd6696672ddff3fe536f43758b0df15c14610', '["*"]', NULL, '2023-09-12 08:06:10', '2023-09-12 08:06:10'),
	(210, 'App\\Models\\User', NULL, 6, 'token', 'c38b4338a091e6fb1a3e4dceed08c108ba36384d44b142b536a4ee300fc441d9', '["*"]', NULL, '2023-11-22 07:43:13', '2023-11-22 07:43:13'),
	(211, 'App\\Models\\User', NULL, 6, 'token', '75f0d0893cec258dcdb1f800610e2fddf276a8d6e0f6051aa1e27de34639804d', '["*"]', NULL, '2023-11-24 13:05:37', '2023-11-24 13:05:37'),
	(212, 'App\\Models\\User', NULL, 6, 'token', '78fb81dfcafa42685fa2cf272bdfe698ce1c36192a79378541ce8a9f9d18fe94', '["*"]', NULL, '2023-11-25 05:14:26', '2023-11-25 05:14:26'),
	(213, 'App\\Models\\User', NULL, 2, 'token', '67a349bc681ff032744a6f0f519dd4be030db2823b2b9d009c8c6e4c39d27d45', '["*"]', NULL, '2023-11-26 03:26:03', '2023-11-26 03:26:03');


CREATE TABLE IF NOT EXISTS `questions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `exam_id` bigint unsigned NOT NULL,
  `question_text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `correct_option` bigint unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `questions_exam_id_foreign` (`exam_id`),
  KEY `FK_questions_options` (`correct_option`),
  CONSTRAINT `FK_questions_options` FOREIGN KEY (`correct_option`) REFERENCES `options` (`id`) ON DELETE CASCADE,
  CONSTRAINT `questions_exam_id_foreign` FOREIGN KEY (`exam_id`) REFERENCES `exams` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `questions` (`id`, `exam_id`, `question_text`, `correct_option`) VALUES
	(18, 14, '1: Địa hình nước ta không có đặc điểm chung nào sau đây?', 70),
	(19, 14, '17: Đặc fflếrụ nào sau đây không đúng với địa hình Việt Nam?', 73),
	(20, 15, '82: Một trong những nội dung của quyền được phát triển là mọi công dân đều được', 78),
	(21, 15, '83: Hành vi trái pháp luật có lôi do người có năng lực trách nhiệm pháp lí thực hiện, xâm hại đến các quan hệ xã hội được pháp luật bảo vệ là', 82),
	(22, 15, '84: Một trong những nội dung của quyền học tập là bất cứ công dân nào cũng được', 86),
	(23, 15, '85: Bịa đặt điều xấu để hạ uy tín người khác là hành vi xâm phạm m.lyền được pháp luật bảo hộ về', 90),
	(24, 15, '86: Việc xét xử các vụ án kinh tế trọng điểm trong năm qua của nước ta hiện nay không phụ thuộc vào người đó là ai, giữ chức vụ gì, là thể hiện công dân bình đăng về', 94),
	(25, 15, '87: Bên mua không trả tiền đầy đủ và đúng thời hạn, đúng phương thức như đã thỏa thuận với bên bán hàng, khi đó bên mua phải chịu trách nhiệm pháp lý nào dưới đây?', 98),
	(26, 15, '88: Nhằm khôi phục quyền và lợi ích hợp pháp của cơ quan, tổ chức cá nhân bị xâm phạm là mục đích của', 101),
	(27, 17, 'Một trong những nội dung của quyền được phát triển là mọi công dân đều được', 106),
	(28, 17, 'Hành vi trái pháp luật có lôi do người có năng lực trách nhiệm pháp lí thực hiện, xâm hại đến các quan hệ xã hội được pháp luật bảo vệ là', 110),
	(29, 17, 'Một trong những nội dung của quyền học tập là bất cứ công dân nào cũng được', 113),
	(30, 17, 'Bịa đặt điều xấu để hạ uy tín người khác là hành vi xâm phạm m.lyền được pháp luật bảo hộ về', 117),
	(31, 17, 'Việc xét xử các vụ án kinh tế trọng điểm trong năm qua của nước ta hiện nay không phụ thuộc vào người đó là ai, giữ chức vụ gì, là thể hiện công dân bình đăng về', 121),
	(32, 17, 'Bên mua không trả tiền đầy đủ và đúng thời hạn, đúng phương thức như đã thỏa thuận với bên bán hàng, khi đó bên mua phải chịu trách nhiệm pháp lý nào dưới đây?', 127),
	(33, 17, 'Nhằm khôi phục quyền và lợi ích hợp pháp của cơ quan, tổ chức cá nhân bị xâm phạm là mục đích của', 130);


/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;


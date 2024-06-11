-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 21, 2024 at 10:58 AM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_quan_ly_khoa_luan`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendars`
--

CREATE TABLE `calendars` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `file_result` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contents` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `calendars`
--

INSERT INTO `calendars` (`id`, `student_topic_id`, `title`, `start_date`, `end_date`, `file_result`, `contents`, `status`, `created_at`, `updated_at`) VALUES
(1, 25, 'Công việc tuần 1', '2024-03-13', '2024-03-20', '20240330080345-khZSgJbAKAwW6s8-Thêm-các-Quản-lý-Khoa-cán-bộ.docx', '<ul>\r\n	<li>\r\n	<p><strong>V&iacute; dụ: gv hướng dẫn 5 sv th&igrave; gv c&oacute; thể xem danh s&aacute;ch c&ocirc;ng việc đ&atilde; giao cho từng sinh vi&ecirc;n theo từng page ri&ecirc;ng (gọi l&agrave; Page danh s&aacute;ch c&ocirc;ng việc). Trong Page danh s&aacute;ch c&ocirc;ng việc, trang sẽ hiển thị danh s&aacute;ch c&ocirc;ng việc c&oacute; th&ocirc;ng tin (ho&agrave;n th&agrave;nh/chưa ho&agrave;n th&agrave;nh) m&agrave; gv đ&atilde; giao cho sinh vi&ecirc;n (sẽ c&oacute; c&aacute;c button tạo mới c&ocirc;ng việc, sửa, x&oacute;a giống những trang d&ugrave;ng datatable th&ocirc;ng thường).</strong></p>\r\n	</li>\r\n</ul>\r\n\r\n<div id=\"gtx-trans\" style=\"left:-151px; position:absolute; top:-4.8px\">\r\n<div class=\"gtx-trans-icon\">&nbsp;</div>\r\n</div>', 3, '2024-03-12 10:43:00', '2024-03-30 01:24:46'),
(2, 25, 'Công việc tuần 2', '2024-03-20', '2024-03-23', NULL, '<p>dfsfsd</p>', 0, '2024-03-12 10:46:13', '2024-03-12 11:02:45'),
(3, 26, 'Công việc tuần 1', '2024-03-25', '2024-04-03', '20240324140324-SV152019420-Các-chức-năng-cần-làm.docx', '<p>C&ocirc;ng việc tuần 1</p>', 4, '2024-03-24 00:32:41', '2024-03-24 07:20:24'),
(4, 27, 'fdgfdg', '2024-04-03', '2024-04-04', NULL, '<p>dfgdfgdfgdf</p>', 0, '2024-04-02 07:54:28', '2024-04-02 07:54:28');

-- --------------------------------------------------------

--
-- Table structure for table `councils`
--

CREATE TABLE `councils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `co_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'tên hội đồng',
  `co_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung quyết định thành lập hội đồng',
  `co_course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `co_status` tinyint(4) NOT NULL DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `councils`
--

INSERT INTO `councils` (`id`, `co_title`, `co_content`, `co_course_id`, `co_status`, `created_at`, `updated_at`) VALUES
(3, 'Hội đồng khoa CNTT', '<p>Th&agrave;nh lập hội đồng&nbsp;</p>', 8, 1, '2024-03-02 09:21:34', '2024-03-02 09:21:34'),
(5, 'Test hội đồng', '<p>fsadsad</p>', 9, 2, '2024-03-02 02:29:32', '2024-03-02 02:29:32');

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `c_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `c_start_time` datetime DEFAULT NULL,
  `c_end_time` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `c_name`, `c_start_time`, `c_end_time`, `created_at`, `updated_at`) VALUES
(6, '2017-2021', '2021-06-11 00:00:00', '2021-06-30 12:00:00', '2024-03-02 09:21:47', '2024-03-02 09:21:47'),
(7, '2018-2022', '2022-06-11 00:00:00', '2022-06-30 12:00:00', '2024-03-02 09:21:47', '2024-03-02 09:21:47'),
(8, '2019-2023', '2022-06-11 00:00:00', '2022-06-30 12:00:00', '2024-03-02 09:21:47', '2024-03-02 09:21:47'),
(9, '2020-2024', '2024-02-28 09:37:00', '2024-03-31 09:37:00', '2024-03-02 09:21:47', '2024-03-02 02:37:28');

-- --------------------------------------------------------

--
-- Table structure for table `decisions`
--

CREATE TABLE `decisions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `d_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `d_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dp_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dp_parent_id` int(11) NOT NULL DEFAULT 0,
  `dp_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `dp_name`, `dp_parent_id`, `dp_content`, `created_at`, `updated_at`) VALUES
(5, 'Công nghệ thông tin', 0, 'Công nghệ thông tin', '2024-03-02 09:22:11', '2024-03-02 09:22:11'),
(6, 'Khoa học máy tính', 5, 'Khoa học máy tính', '2024-03-02 09:22:11', '2024-03-02 09:22:11'),
(7, 'Mạng máy tính và truyền thông dữ liệu', 5, 'Mạng máy tính và truyền thông dữ liệu', '2024-03-02 09:22:11', '2024-03-02 09:22:11'),
(8, 'Kỹ thuật máy tính', 5, 'Kỹ thuật máy tính', '2024-03-02 09:22:11', '2024-03-02 09:22:11'),
(9, 'Hệ thống quản lý thông tin', 5, 'Hệ thống quản lý thông tin', '2024-03-02 09:22:11', '2024-03-02 09:22:11');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0,
  `user_id` bigint(20) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `status`, `user_id`, `created_at`, `updated_at`) VALUES
(2, 'Nhóm 1', 0, 1, '2024-03-23 23:47:09', '2024-03-23 23:47:09');

-- --------------------------------------------------------

--
-- Table structure for table `group_permission`
--

CREATE TABLE `group_permission` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_permission`
--

INSERT INTO `group_permission` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Quản lý hệ thống', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(2, 'Quản lý danh sách đăng ký', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(3, 'Quản lý sinh viên', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(4, 'Quản lý giáo viên', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(5, 'Quản lý đề tài', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(6, 'Quản lý đề tài theo năm', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(7, 'Quản lý hội đồng', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(8, 'Quản lý thông báo', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(9, 'Quản lý chức vụ', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(10, 'Quản lý khoa / bộ môn', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(11, 'Quản lý niên khóa', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(13, 'Quản lý vai trò', NULL, '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(14, 'Quản lý nhóm sinh viên', 'Quản lý nhóm sinh viên', '2024-03-02 09:22:26', '2024-03-02 09:22:26'),
(15, 'Quản lý lịch hẹn', NULL, '2024-04-12 09:44:41', '2024-04-12 09:44:41'),
(16, 'Phân công công việc', NULL, '2024-04-12 09:47:10', '2024-04-12 09:47:10');

-- --------------------------------------------------------

--
-- Table structure for table `group_students`
--

CREATE TABLE `group_students` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `group_id` bigint(20) UNSIGNED DEFAULT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_02_27_152824_create_positions_table', 1),
(2, '2014_02_27_160350_create_departments_table', 1),
(3, '2014_03_04_151303_create_courses_table', 1),
(4, '2014_10_12_000000_create_users_table', 1),
(5, '2014_10_12_100000_create_password_resets_table', 1),
(6, '2019_08_19_000000_create_failed_jobs_table', 1),
(7, '2021_03_09_171541_laravel_entrust_setup_tables', 1),
(8, '2022_02_25_154607_create_councils_table', 1),
(9, '2022_02_27_152255_create_topics_table', 1),
(10, '2022_02_27_154504_create_decisions_table', 1),
(11, '2022_02_27_163315_create_student_topics_table', 1),
(12, '2022_03_04_152122_create_topic_course_table', 1),
(13, '2022_03_04_161120_create_teacher_councils_table', 1),
(14, '2022_03_04_164419_create_notifications_table', 1),
(15, '2022_03_04_165723_create_notification_councils_table', 1),
(16, '2022_03_20_170512_add_column_to_topic_course_table', 1),
(17, '2022_04_10_082008_add_time_register_to_topic_course_table', 1),
(18, '2022_04_10_095328_create_notification_users_table', 1),
(19, '2022_06_04_175029_add_column_start_end_to_courses_table', 1),
(20, '2022_06_04_175213_add_column_start_end_to_topic_course_table', 1),
(21, '2024_02_20_153657_create_groups_table', 2),
(22, '2024_02_20_153812_create_group_students_table', 3),
(23, '2024_03_11_171946_create_calendars_table', 4),
(24, '2024_03_11_180306_create_schedules_table', 4),
(25, '2024_03_30_031824_create_result_files_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `n_course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `n_user_id` bigint(20) DEFAULT NULL,
  `n_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Tiêu đề thông báo',
  `n_type` tinyint(4) DEFAULT 0,
  `n_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Nội dung thông báo',
  `n_from_date` datetime DEFAULT NULL COMMENT 'Bắt đầu từ ngày',
  `n_end_date` datetime DEFAULT NULL COMMENT 'Ngày kết thúc',
  `n_send_to` tinyint(4) DEFAULT 0,
  `n_status` tinyint(4) DEFAULT 0,
  `n_watched` tinyint(4) DEFAULT 0,
  `n_schedule_type` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `n_course_id`, `n_user_id`, `n_title`, `n_type`, `n_content`, `n_from_date`, `n_end_date`, `n_send_to`, `n_status`, `n_watched`, `n_schedule_type`, `created_at`, `updated_at`) VALUES
(35, NULL, 1, 'Báo cáo nhóm 4', 6, '<p>sdfsdfsdfsd</p>', '2024-04-15 16:44:00', '2024-04-16 14:39:00', 0, 2, 0, 'red', '2024-04-12 09:41:09', '2024-04-21 00:39:40'),
(36, NULL, 1, 'Lịch hẹn báo cáo đồ án', 6, '<p>dsfsfsdfsdfsdfsd</p>', '2024-04-16 17:55:00', '2024-04-18 14:13:00', 0, 2, 0, 'blue', '2024-04-12 09:55:46', '2024-04-21 01:08:09');

-- --------------------------------------------------------

--
-- Table structure for table `notification_councils`
--

CREATE TABLE `notification_councils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nc_council_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nc_notification_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `notification_users`
--

CREATE TABLE `notification_users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `nu_notification_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nu_user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `nu_type_user` tinyint(4) DEFAULT 0,
  `nu_status` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notification_users`
--

INSERT INTO `notification_users` (`id`, `nu_notification_id`, `nu_user_id`, `nu_type_user`, `nu_status`, `created_at`, `updated_at`) VALUES
(75, 35, 7, 2, 2, '2024-04-21 00:39:40', '2024-04-21 00:39:40'),
(76, 36, 6, 2, 1, '2024-04-21 01:08:09', '2024-04-21 01:26:30');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group_permission_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `group_permission_id`, `created_at`, `updated_at`) VALUES
(1, 'toan-quyen-quan-ly', 'Toàn quyền quản lý', NULL, 1, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(2, 'truy-cap-he-thong', 'Truy cập hệ thống', NULL, 1, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(3, 'quan-ly-danh-sach-dang-ky-de-tai', 'Quản lý danh sách đăng ký đề tài', NULL, 2, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(4, 'nhan-set-va-cham-diem-de-tai', 'Nhận xét và chấm điểm đề tài', NULL, 2, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(5, 'xoa-de-tai-sinh-vien-dang-ky', 'Xóa để tài sinh viên đăng ký', NULL, 2, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(6, 'quan-ly-danh-sach-sinh-vien', 'Quản lý danh sách sinh viên', NULL, 3, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(7, 'tao-moi-sinh-vien', 'Tạo mới sinh viên', NULL, 3, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(8, 'chinh-sua-sinh-vien', 'Chỉnh sửa sinh viên', NULL, 3, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(9, 'xoa-sinh-vien', 'Xóa sinh viên', NULL, 3, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(10, 'quan-ly-danh-sach-giao-vien', 'Quản lý danh sách giáo viên', NULL, 4, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(11, 'tao-moi-giao-vien', 'Tạo mới giáo viên', NULL, 4, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(12, 'chinh-sua-giao-vien', 'Chỉnh sửa giáo viên', NULL, 4, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(13, 'xoa-giao-vien', 'Xóa giáo viên', NULL, 4, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(14, 'quan-ly-danh-sach-de-tai', 'Quản lý danh sách đề tài', NULL, 5, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(15, 'tao-moi-de-tai', 'Tạo mới đề tài', NULL, 5, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(16, 'chinh-sua-de-tai', 'Chỉnh sửa đề tài', NULL, 5, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(17, 'xoa-de-tai', 'Xóa đề tài', NULL, 5, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(18, 'quan-ly-danh-sach-de-tai-theo-nam', 'Quản lý danh sách đề tài theo năm', NULL, 6, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(19, 'tao-moi-de-tai-theo-nam', 'Tạo mới đề tài theo năm', NULL, 6, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(20, 'chinh-sua-de-tai-theo-nam', 'Chỉnh sửa đề tài theo năm', NULL, 6, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(21, 'xoa-de-tai-theo-nam', 'Xóa đề tài theo năm', NULL, 6, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(22, 'quan-ly-danh-sach-hoi-dong', 'Quản lý danh sách hội đồng', NULL, 7, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(23, 'tao-moi-hoi-dong', 'Tạo mới hội đồng', NULL, 7, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(24, 'chinh-sua-hoi-dong', 'Chỉnh sửa hội đồng', NULL, 7, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(25, 'xoa-hoi-dong', 'Xóa hội đồng', NULL, 7, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(26, 'quan-ly-danh-sach-thong-bao', 'Quản lý danh sách thông báo', NULL, 8, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(27, 'tao-moi-thong-bao', 'Tạo mới thông báo', NULL, 8, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(28, 'chinh-sua-thong-bao', 'Chỉnh sửa thông báo', NULL, 8, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(29, 'xoa-thong-bao', 'Xóa thông báo', NULL, 8, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(30, 'quan-ly-danh-sach-chuc-vu', 'Quản lý danh sách chức vụ', NULL, 9, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(31, 'tao-moi-chuc-vu', 'Tạo mới chức vụ', NULL, 9, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(32, 'chinh-sua-chuc-vu', 'Chỉnh sửa chức vụ', NULL, 9, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(33, 'xoa-chuc-vu', 'Xóa chức vụ', NULL, 9, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(34, 'quan-ly-danh-sach-khoa-bo-mon', 'Quản lý danh sách khoa bộ môn', NULL, 10, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(35, 'tao-moi-khoa-bo-mon', 'Tạo mới khoa bộ môn', NULL, 10, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(36, 'chinh-sua-khoa-bo-mon', 'Chỉnh sửa khoa bộ môn', NULL, 10, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(37, 'xoa-khoa-bo-mon', 'Xóa khoa bộ môn', NULL, 10, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(38, 'quan-ly-danh-sach-nien-khoa', 'Quản lý danh sách niên khóa', NULL, 11, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(39, 'tao-moi-nien-khoa', 'Tạo mới niên khóa', NULL, 11, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(40, 'chinh-sua-nien-khoa', 'Chỉnh sửa niên khóa', NULL, 11, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(41, 'xoa-nien-khoa', 'Xóa niên khóa', NULL, 11, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(42, 'quan-ly-danh-sach-vai-tro', 'Quản lý danh sách vai trò', NULL, 13, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(43, 'tao-moi-vai-tro', 'Tạo mới vai trò', NULL, 13, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(44, 'chinh-sua-vai-tro', 'Chỉnh sửa vai trò', NULL, 13, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(45, 'xoa-vai-tro', 'Xóa vai trò', NULL, 13, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(48, 'danh-sach-nhom-sinh-vien', 'Danh sách nhóm sinh viên', 'Danh sách nhóm sinh viên', 14, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(49, 'them-moi-nhom-sinh-vien', 'Thêm mới nhóm sinh viên', 'Thêm mới nhóm sinh viên', 14, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(50, 'chinh-sua-nhom-sinh-vien', 'Chỉnh sửa nhóm sinh viên', NULL, 14, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(51, 'xoa-nhom-sinh-vien', 'Xóa nhóm sinh viên', NULL, 14, '2024-03-02 09:22:44', '2024-03-02 09:22:44'),
(52, 'danh-sach-lich-hen', 'Danh sách lịch hẹn', NULL, 15, '2024-04-12 09:45:05', '2024-04-12 09:45:05'),
(53, 'them-moi-lich-hen', 'Thêm mới lịch hẹn', NULL, 15, '2024-04-12 09:45:14', '2024-04-12 09:45:14'),
(54, 'chinh-sua-lich-hen', 'Chỉnh sửa lịch hẹn', NULL, 15, '2024-04-12 09:45:24', '2024-04-12 09:45:24'),
(55, 'xoa-lich-hen', 'Xóa lịch hẹn', NULL, 15, '2024-04-12 09:45:33', '2024-04-12 09:45:33'),
(56, 'them-moi-phan-cong-cong-viec', 'Thêm mới phân công công việc', NULL, 16, '2024-04-12 09:47:30', '2024-04-12 09:47:30'),
(57, 'chinh-sua-phan-cong-cong-viec', 'Chỉnh sửa phân công công việc', NULL, 16, '2024-04-12 09:47:45', '2024-04-12 09:47:45'),
(58, 'danh-sach-phan-cong-cong-viec', 'Danh sách phân công công việc', NULL, 16, '2024-04-12 09:48:20', '2024-04-12 09:48:20'),
(59, 'xoa-phan-cong-cong-viec', 'Xóa phân công công việc', NULL, 16, '2024-04-12 09:50:31', '2024-04-12 09:50:31');

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` bigint(20) UNSIGNED NOT NULL,
  `role_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 2),
(2, 3),
(2, 4),
(3, 2),
(3, 3),
(3, 4),
(4, 2),
(4, 3),
(4, 4),
(5, 2),
(5, 4),
(6, 2),
(6, 3),
(6, 4),
(7, 2),
(7, 4),
(8, 2),
(8, 4),
(9, 2),
(10, 2),
(10, 4),
(11, 2),
(12, 2),
(13, 2),
(14, 2),
(15, 2),
(16, 2),
(17, 2),
(18, 2),
(18, 4),
(19, 2),
(19, 4),
(20, 2),
(20, 4),
(21, 2),
(22, 2),
(23, 2),
(24, 2),
(25, 2),
(26, 2),
(26, 4),
(27, 2),
(27, 4),
(28, 2),
(28, 4),
(29, 4);

-- --------------------------------------------------------

--
-- Table structure for table `positions`
--

CREATE TABLE `positions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `p_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `p_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `positions`
--

INSERT INTO `positions` (`id`, `p_name`, `p_content`, `created_at`, `updated_at`) VALUES
(1, 'Trưởng khoa', 'Trưởng khoa', '2024-03-02 09:22:57', '2024-03-02 09:22:57'),
(2, 'Chủ nhiệm khoa', 'Chủ nhiệm khoa', '2024-03-02 09:22:57', '2024-03-02 09:22:57'),
(3, 'Phó khoa', 'Phó khoa', '2024-03-02 09:22:57', '2024-03-02 09:22:57'),
(4, 'Giáo viên', 'Giáo viên', '2024-03-02 09:22:57', '2024-03-02 09:22:57');

-- --------------------------------------------------------

--
-- Table structure for table `result_files`
--

CREATE TABLE `result_files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rf_student_topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `rf_title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_part_file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_part_file_feedback` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_comment` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rf_point` int(11) DEFAULT 0,
  `rf_status` tinyint(4) DEFAULT 0,
  `rf_type` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `result_files`
--

INSERT INTO `result_files` (`id`, `rf_student_topic_id`, `rf_title`, `rf_part_file`, `rf_part_file_feedback`, `rf_comment`, `rf_point`, `rf_status`, `rf_type`, `created_at`, `updated_at`) VALUES
(6, 25, 'File báo cáo', '20240330040343-khZSgJbAKAwW6s8-Untitled-2.jpg', NULL, NULL, 0, 1, 1, '2024-03-29 21:29:43', '2024-03-29 21:29:43'),
(7, 25, 'sdfsdfsd', '20240330040359-khZSgJbAKAwW6s8-CBDS2103 Assignment JAN 2024 HUTECH.pdf', NULL, NULL, 0, 1, 1, '2024-03-29 21:41:59', '2024-03-29 21:41:59'),
(8, 25, 'sdsfsdfsd', '20240330040329-khZSgJbAKAwW6s8-CBDS2103 Assignment JAN 2024 HUTECH.pdf', NULL, NULL, 0, 1, 1, '2024-03-29 21:44:29', '2024-03-29 21:44:29'),
(9, 25, 'frgdfgdf', '20240330040300-khZSgJbAKAwW6s8-bang-luong.xlsx', NULL, NULL, 0, 1, 1, '2024-03-29 21:58:00', '2024-03-29 21:58:00'),
(10, 26, 'báo cáo lần 1', '20240330080337-SV152019420-Thêm-các-Quản-lý-Khoa-cán-bộ.docx', '20240420030411-website bán cafe.docx', '<p>Nhận s&eacute;t</p>', 8, 2, 1, '2024-03-30 01:57:37', '2024-04-20 00:16:00'),
(11, 26, 'fgdfgdfgdfg', '20240330080318-SV152019420-CBDS2103 Assignment JAN 2024 HUTECH.pdf', NULL, NULL, 0, 1, 1, '2024-03-30 01:58:18', '2024-03-30 01:58:18'),
(12, 26, 'sdfsdfsdf', '20240330090314-SV152019420-freeformatter-out.txt', '20240420070448-website bán cafe.docx', '<p>File đ&iacute;nh k&egrave;m</p>', 10, 2, 2, '2024-03-30 02:51:14', '2024-04-20 00:14:57');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'super-admin', 'Super Admin', NULL, '2024-03-02 09:23:07', '2024-03-02 09:23:07'),
(2, 'bcn-khoa', 'BCN Khoa', 'Ban chủ nhiệm khoa', '2024-03-02 09:23:07', '2024-03-02 09:23:07'),
(3, 'gvhd', 'GVHD', 'Giáo viên - giáo viên hướng dẫn', '2024-03-02 09:23:07', '2024-03-02 09:23:07'),
(4, 'gv', 'GV', 'Giáo vụ', '2024-03-02 09:23:07', '2024-03-02 09:23:07'),
(5, 'sv', 'SV', NULL, '2024-03-02 09:23:07', '2024-03-02 09:23:07');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `role_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`role_id`, `user_id`) VALUES
(1, 1),
(4, 3),
(2, 4),
(4, 5),
(5, 6),
(5, 7);

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_schedule` datetime DEFAULT NULL,
  `contents` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` tinyint(4) DEFAULT 0,
  `status` tinyint(4) DEFAULT 2,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `student_topics`
--

CREATE TABLE `student_topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `st_student_id` bigint(20) UNSIGNED DEFAULT NULL,
  `st_topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `st_teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `st_teacher_instructor_id` bigint(20) UNSIGNED DEFAULT NULL,
  `st_course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `st_outline` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tiêu đề ,đề cương',
  `st_outline_part` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Đường dẫn lưu trữ',
  `st_status_outline` tinyint(4) DEFAULT 0,
  `st_comment_outline` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_point_outline` double(8,2) DEFAULT 0.00 COMMENT 'điểm đề cương',
  `st_thesis_book` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'tiêu đề quyển báo cáo',
  `st_thesis_book_part` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'đường dẫn lưu báo cáo',
  `st_status_thesis_book` tinyint(4) DEFAULT 0,
  `st_comment_thesis_book` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_point_thesis_book` double(8,2) DEFAULT 0.00 COMMENT 'điểm báo cáo',
  `st_point` double(8,2) DEFAULT NULL COMMENT 'điểm bảo vệ',
  `st_status` tinyint(4) DEFAULT 0,
  `st_comments` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `st_point_medium` double(8,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `student_topics`
--

INSERT INTO `student_topics` (`id`, `st_student_id`, `st_topic_id`, `st_teacher_id`, `st_teacher_instructor_id`, `st_course_id`, `st_outline`, `st_outline_part`, `st_status_outline`, `st_comment_outline`, `st_point_outline`, `st_thesis_book`, `st_thesis_book_part`, `st_status_thesis_book`, `st_comment_thesis_book`, `st_point_thesis_book`, `st_point`, `st_status`, `st_comments`, `st_point_medium`, `created_at`, `updated_at`) VALUES
(25, 6, 2, 4, NULL, 9, 'Nội lại đề cương', '20240302090322-khZSgJbAKAwW6s8-Thêm-các-Quản-lý-Khoa-cán-bộ.docx', 3, '<p>sdfsdfsdfsd</p>', 5.00, NULL, NULL, 0, NULL, 0.00, NULL, 0, NULL, NULL, NULL, '2024-03-29 20:05:11'),
(26, 7, 2, 3, NULL, 9, NULL, NULL, 2, NULL, 8.00, NULL, NULL, 2, NULL, 10.00, 8.00, 1, NULL, NULL, NULL, '2024-04-20 00:16:40'),
(27, 6, 2, 3, NULL, 9, 'dsfsdf', NULL, 3, NULL, 0.00, NULL, NULL, 0, NULL, 0.00, NULL, 2, NULL, NULL, NULL, '2024-03-29 19:51:14');

-- --------------------------------------------------------

--
-- Table structure for table `teacher_councils`
--

CREATE TABLE `teacher_councils` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tc_teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_council_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `teacher_councils`
--

INSERT INTO `teacher_councils` (`id`, `tc_teacher_id`, `tc_council_id`, `created_at`, `updated_at`) VALUES
(4, 3, 5, NULL, NULL),
(5, 4, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `topics`
--

CREATE TABLE `topics` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `t_title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `t_registration_number` int(11) DEFAULT 0,
  `t_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `t_content` text COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Mô tả đề tài',
  `t_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topics`
--

INSERT INTO `topics` (`id`, `t_title`, `t_registration_number`, `t_department_id`, `t_content`, `t_status`, `created_at`, `updated_at`) VALUES
(1, 'Xây dựng website quản lý sinh viên', 3, 6, '<p>Người h&ugrave;ng Felisberto, VĐV người Timor Leste gi&agrave;nh 2 huy chương Bạc tại Seagame 31 v&agrave; để lại những khoảnh khắc ấn tượng tại Việt Nam năm nay đ&atilde; ch&iacute;nh thức l&agrave;m Đại sứ thương hiệu cho Telemor-nh&agrave; mạng viễn th&ocirc;ng của Viettel đầu tư tại Timor Leste.</p>', 1, '2024-03-02 09:23:34', '2024-03-02 09:23:34'),
(2, 'Xây dựng ứng dụng quản lý nghe nhạc trực tuyến', 0, 6, '<p>X&acirc;y dựng ứng dụng quản l&yacute; nghe nhạc trực tuyến</p>', 1, '2024-03-02 02:32:58', '2024-03-02 02:32:58');

-- --------------------------------------------------------

--
-- Table structure for table `topic_course`
--

CREATE TABLE `topic_course` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tc_topic_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_council_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_teacher_id` bigint(20) UNSIGNED DEFAULT NULL,
  `tc_start_time` datetime DEFAULT NULL,
  `tc_end_time` datetime DEFAULT NULL,
  `tc_start_outline` datetime DEFAULT NULL,
  `tc_end_outline` datetime DEFAULT NULL,
  `tc_start_thesis_book` datetime DEFAULT NULL,
  `tc_end_thesis_book` datetime DEFAULT NULL,
  `tc_registration_number` int(11) DEFAULT NULL,
  `tc_status` tinyint(4) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `topic_course`
--

INSERT INTO `topic_course` (`id`, `tc_topic_id`, `tc_course_id`, `tc_council_id`, `tc_department_id`, `tc_teacher_id`, `tc_start_time`, `tc_end_time`, `tc_start_outline`, `tc_end_outline`, `tc_start_thesis_book`, `tc_end_thesis_book`, `tc_registration_number`, `tc_status`, `created_at`, `updated_at`) VALUES
(1, 1, 7, 3, 6, 3, '2022-06-11 00:00:00', '2022-06-30 12:00:00', '2022-06-28 12:00:00', '2022-07-02 00:00:00', '2022-06-30 12:00:00', '2022-07-30 00:35:00', 3, 1, '2024-03-02 09:23:50', '2024-03-02 09:23:50'),
(2, 2, 9, 3, 6, 3, '2024-02-28 09:37:00', '2024-03-31 09:37:00', '2024-04-19 16:33:00', '2024-04-30 16:33:00', '2024-04-19 16:33:00', '2024-05-30 16:33:00', 5, 1, '2024-03-02 02:33:46', '2024-04-19 19:41:30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `birthday` date DEFAULT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT 0,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `type` tinyint(4) NOT NULL DEFAULT 0,
  `flag` tinyint(4) NOT NULL DEFAULT 0,
  `course_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `position_id` bigint(20) UNSIGNED DEFAULT NULL,
  `point_medium` double(8,2) DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `code`, `email`, `phone`, `email_verified_at`, `password`, `avatar`, `address`, `birthday`, `gender`, `status`, `type`, `flag`, `course_id`, `department_id`, `position_id`, `point_medium`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1655024568', 'admin@gmail.com', '0928817228', NULL, '$2y$10$uJ66W3MofjBvCHTEfe1lzu6gY2BF2Ml413u4cQ2HWN9Ncp/PaBf36', '', NULL, NULL, 1, 1, 1, 0, NULL, 5, 1, NULL, 'UCKvX7LT0x3lQ2M9wnnULiNK4kq0rGNtgX9VgUFd9gpkGxxOtBuy0tLxYPX8', '2024-03-02 09:24:02', '2024-03-02 09:24:02'),
(3, 'Trần Thị A', 'GV152019403', 'duocnvoit@gmail.com', '0359020898', NULL, '$2y$10$ZOcySm2KfRVz0RPYow1w8.GCZYyIhWQI0CBniLigZSkp2KSPFTfxa', NULL, 'Hà Nội', '1991-08-15', 2, 1, 1, 0, 7, 6, 4, NULL, NULL, '2024-03-02 09:24:02', '2024-03-02 09:24:02'),
(4, 'Ban chủ nhiệp khoa', 'ZnxmHyfjT0SaZrC', 'chunhiemkhoa@gmail.com', '18001008', NULL, '$2y$10$iApRyCZYqEFoC3hW2IW7Iu9iNLRU1VButemvWVkD1qw5l7P6oXzM2', NULL, NULL, NULL, 1, 1, 1, 0, NULL, 5, 2, NULL, NULL, '2024-03-02 09:24:02', '2024-03-02 09:24:02'),
(5, 'Giáo vụ', '9DX4iRvPOz1M8rt', 'giaovu@gmail.com', '19001820', NULL, '$2y$10$9CkAjlTnhv.B6E/LDCl6r.1bG6fYJ7QDcwI5Aj/5hfZWUKjGCJn0a', NULL, NULL, NULL, 2, 1, 1, 0, NULL, 5, 3, NULL, NULL, '2024-03-02 09:24:02', '2024-03-02 09:24:02'),
(6, 'Nguyễn Văn B', 'khZSgJbAKAwW6s8', 'duocnv@funtap.vn', '0359020898', NULL, '$2y$10$IdgJnQVPnHDjPbhwIKVCVOHXE26Aa2bbdaF1iGBEE7FnY6EOis6oW', NULL, 'Hà Nội', NULL, 1, 1, 2, 0, 9, 6, NULL, 9.60, NULL, '2024-03-02 09:24:02', '2024-03-02 09:24:02'),
(7, 'Nguyễn Văn A', 'SV152019420', 'nguyenvanduoc071994@gmail.com', '0928817228', NULL, '$2y$10$DpAYTPLF61J1ix5EEeVhx.6Gkc5rbmsvwUeItNvF6BSMTw0lsUglG', NULL, 'Hà Nội', NULL, 1, 1, 2, 0, 9, 6, NULL, NULL, NULL, NULL, '2024-03-24 00:10:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendars`
--
ALTER TABLE `calendars`
  ADD PRIMARY KEY (`id`),
  ADD KEY `calendars_student_topic_id_foreign` (`student_topic_id`);

--
-- Indexes for table `councils`
--
ALTER TABLE `councils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `councils_co_course_id_foreign` (`co_course_id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `decisions`
--
ALTER TABLE `decisions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_permission`
--
ALTER TABLE `group_permission`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `group_permission_name_unique` (`name`);

--
-- Indexes for table `group_students`
--
ALTER TABLE `group_students`
  ADD PRIMARY KEY (`id`),
  ADD KEY `group_students_group_id_foreign` (`group_id`),
  ADD KEY `group_students_student_id_foreign` (`student_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_n_course_id_foreign` (`n_course_id`);

--
-- Indexes for table `notification_councils`
--
ALTER TABLE `notification_councils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_councils_nc_council_id_foreign` (`nc_council_id`),
  ADD KEY `notification_councils_nc_notification_id_foreign` (`nc_notification_id`);

--
-- Indexes for table `notification_users`
--
ALTER TABLE `notification_users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notification_users_nu_notification_id_foreign` (`nu_notification_id`),
  ADD KEY `notification_users_nu_user_id_foreign` (`nu_user_id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`),
  ADD KEY `permissions_group_permission_id_foreign` (`group_permission_id`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `positions`
--
ALTER TABLE `positions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `result_files`
--
ALTER TABLE `result_files`
  ADD PRIMARY KEY (`id`),
  ADD KEY `result_files_rf_student_topic_id_foreign` (`rf_student_topic_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `schedules_student_id_foreign` (`student_id`),
  ADD KEY `schedules_teacher_id_foreign` (`teacher_id`);

--
-- Indexes for table `student_topics`
--
ALTER TABLE `student_topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_topics_st_student_id_foreign` (`st_student_id`),
  ADD KEY `student_topics_st_topic_id_foreign` (`st_topic_id`),
  ADD KEY `student_topics_st_teacher_id_foreign` (`st_teacher_id`),
  ADD KEY `student_topics_st_teacher_instructor_id_foreign` (`st_teacher_instructor_id`),
  ADD KEY `student_topics_st_course_id_foreign` (`st_course_id`);

--
-- Indexes for table `teacher_councils`
--
ALTER TABLE `teacher_councils`
  ADD PRIMARY KEY (`id`),
  ADD KEY `teacher_councils_tc_teacher_id_foreign` (`tc_teacher_id`),
  ADD KEY `teacher_councils_tc_council_id_foreign` (`tc_council_id`);

--
-- Indexes for table `topics`
--
ALTER TABLE `topics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topics_t_department_id_foreign` (`t_department_id`);

--
-- Indexes for table `topic_course`
--
ALTER TABLE `topic_course`
  ADD PRIMARY KEY (`id`),
  ADD KEY `topic_course_tc_topic_id_foreign` (`tc_topic_id`),
  ADD KEY `topic_course_tc_course_id_foreign` (`tc_course_id`),
  ADD KEY `topic_course_tc_council_id_foreign` (`tc_council_id`),
  ADD KEY `topic_course_tc_department_id_foreign` (`tc_department_id`),
  ADD KEY `topic_course_tc_teacher_id_foreign` (`tc_teacher_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_code_unique` (`code`),
  ADD KEY `users_course_id_foreign` (`course_id`),
  ADD KEY `users_department_id_foreign` (`department_id`),
  ADD KEY `users_position_id_foreign` (`position_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendars`
--
ALTER TABLE `calendars`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `councils`
--
ALTER TABLE `councils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `decisions`
--
ALTER TABLE `decisions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `group_permission`
--
ALTER TABLE `group_permission`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `group_students`
--
ALTER TABLE `group_students`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `notification_councils`
--
ALTER TABLE `notification_councils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `notification_users`
--
ALTER TABLE `notification_users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT for table `password_resets`
--
ALTER TABLE `password_resets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;

--
-- AUTO_INCREMENT for table `positions`
--
ALTER TABLE `positions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `result_files`
--
ALTER TABLE `result_files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `student_topics`
--
ALTER TABLE `student_topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `teacher_councils`
--
ALTER TABLE `teacher_councils`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `topics`
--
ALTER TABLE `topics`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `topic_course`
--
ALTER TABLE `topic_course`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `calendars`
--
ALTER TABLE `calendars`
  ADD CONSTRAINT `calendars_student_topic_id_foreign` FOREIGN KEY (`student_topic_id`) REFERENCES `student_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `councils`
--
ALTER TABLE `councils`
  ADD CONSTRAINT `councils_co_course_id_foreign` FOREIGN KEY (`co_course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `group_students`
--
ALTER TABLE `group_students`
  ADD CONSTRAINT `group_students_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `group_students_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_n_course_id_foreign` FOREIGN KEY (`n_course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_councils`
--
ALTER TABLE `notification_councils`
  ADD CONSTRAINT `notification_councils_nc_council_id_foreign` FOREIGN KEY (`nc_council_id`) REFERENCES `councils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_councils_nc_notification_id_foreign` FOREIGN KEY (`nc_notification_id`) REFERENCES `councils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `notification_users`
--
ALTER TABLE `notification_users`
  ADD CONSTRAINT `notification_users_nu_notification_id_foreign` FOREIGN KEY (`nu_notification_id`) REFERENCES `notifications` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `notification_users_nu_user_id_foreign` FOREIGN KEY (`nu_user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permissions`
--
ALTER TABLE `permissions`
  ADD CONSTRAINT `permissions_group_permission_id_foreign` FOREIGN KEY (`group_permission_id`) REFERENCES `group_permission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `result_files`
--
ALTER TABLE `result_files`
  ADD CONSTRAINT `result_files_rf_student_topic_id_foreign` FOREIGN KEY (`rf_student_topic_id`) REFERENCES `student_topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `schedules`
--
ALTER TABLE `schedules`
  ADD CONSTRAINT `schedules_student_id_foreign` FOREIGN KEY (`student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `schedules_teacher_id_foreign` FOREIGN KEY (`teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `student_topics`
--
ALTER TABLE `student_topics`
  ADD CONSTRAINT `student_topics_st_course_id_foreign` FOREIGN KEY (`st_course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_topics_st_student_id_foreign` FOREIGN KEY (`st_student_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_topics_st_teacher_id_foreign` FOREIGN KEY (`st_teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_topics_st_teacher_instructor_id_foreign` FOREIGN KEY (`st_teacher_instructor_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `student_topics_st_topic_id_foreign` FOREIGN KEY (`st_topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `teacher_councils`
--
ALTER TABLE `teacher_councils`
  ADD CONSTRAINT `teacher_councils_tc_council_id_foreign` FOREIGN KEY (`tc_council_id`) REFERENCES `councils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `teacher_councils_tc_teacher_id_foreign` FOREIGN KEY (`tc_teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topics`
--
ALTER TABLE `topics`
  ADD CONSTRAINT `topics_t_department_id_foreign` FOREIGN KEY (`t_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `topic_course`
--
ALTER TABLE `topic_course`
  ADD CONSTRAINT `topic_course_tc_council_id_foreign` FOREIGN KEY (`tc_council_id`) REFERENCES `councils` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_course_tc_course_id_foreign` FOREIGN KEY (`tc_course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_course_tc_department_id_foreign` FOREIGN KEY (`tc_department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_course_tc_teacher_id_foreign` FOREIGN KEY (`tc_teacher_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `topic_course_tc_topic_id_foreign` FOREIGN KEY (`tc_topic_id`) REFERENCES `topics` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_course_id_foreign` FOREIGN KEY (`course_id`) REFERENCES `courses` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `users_position_id_foreign` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

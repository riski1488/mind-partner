-- Mind Partner Database
-- Created for Laravel Mind Partner Application

-- Create database if not exists
CREATE DATABASE IF NOT EXISTS `mind_partner` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;

-- Use the database
USE `mind_partner`;

-- Drop tables if they exist (for fresh start)
DROP TABLE IF EXISTS `journal_entries`;
DROP TABLE IF EXISTS `mental_health_assessments`;
DROP TABLE IF EXISTS `sessions`;
DROP TABLE IF EXISTS `password_reset_tokens`;
DROP TABLE IF EXISTS `users`;
DROP TABLE IF EXISTS `migrations`;

-- Create migrations table
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create users table
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `avatar` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `gender` enum('male','female','other') DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create password_reset_tokens table
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create sessions table
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create mental_health_assessments table
CREATE TABLE `mental_health_assessments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `score` int(11) DEFAULT NULL,
  `category` enum('anxiety','depression','stress','mood','general') NOT NULL DEFAULT 'general',
  `status` enum('pending','in_progress','completed') NOT NULL DEFAULT 'pending',
  `completed_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mental_health_assessments_user_id_foreign` (`user_id`),
  CONSTRAINT `mental_health_assessments_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Create journal_entries table
CREATE TABLE `journal_entries` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext NOT NULL,
  `mood_score` int(11) DEFAULT NULL,
  `mood_description` enum('very_happy','happy','neutral','sad','very_sad','anxious','stressed') DEFAULT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `is_private` tinyint(1) NOT NULL DEFAULT 0,
  `entry_date` date NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_entries_user_id_foreign` (`user_id`),
  CONSTRAINT `journal_entries_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert migration records
INSERT INTO `migrations` (`migration`, `batch`) VALUES
('0001_01_01_000000_create_users_table', 1),
('0001_01_01_000001_create_cache_table', 1),
('0001_01_01_000002_create_jobs_table', 1),
('2024_01_01_000001_create_mental_health_assessments_table', 1),
('2024_01_01_000002_create_journal_entries_table', 1);

-- Insert admin user
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `role`, `created_at`, `updated_at`) VALUES
('Admin', 'admin123@gmail.com', NOW(), '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW());

-- Insert sample user
INSERT INTO `users` (`name`, `email`, `email_verified_at`, `password`, `role`, `created_at`, `updated_at`) VALUES
('John Doe', 'john@example.com', NOW(), '$2y$12$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'user', NOW(), NOW());

-- Get the user ID for sample data
SET @user_id = (SELECT id FROM users WHERE email = 'john@example.com' LIMIT 1);

-- Insert sample assessments
INSERT INTO `mental_health_assessments` (`user_id`, `title`, `description`, `category`, `status`, `score`, `completed_at`, `created_at`, `updated_at`) VALUES
(@user_id, 'Assessment Kecemasan Harian', 'Assessment untuk mengukur tingkat kecemasan harian', 'anxiety', 'completed', 75, NOW(), NOW(), NOW()),
(@user_id, 'Assessment Stres Kerja', 'Assessment untuk mengukur tingkat stres di tempat kerja', 'stress', 'in_progress', NULL, NULL, NOW(), NOW());

-- Insert sample journal entries
INSERT INTO `journal_entries` (`user_id`, `title`, `content`, `mood_score`, `mood_description`, `entry_date`, `is_private`, `created_at`, `updated_at`) VALUES
(@user_id, 'Hari yang Menyenangkan', 'Hari ini adalah hari yang sangat menyenangkan. Saya berhasil menyelesaikan semua tugas yang ada dan merasa sangat puas dengan hasilnya.', 8, 'happy', DATE_SUB(CURDATE(), INTERVAL 1 DAY), 0, NOW(), NOW()),
(@user_id, 'Refleksi Mingguan', 'Minggu ini penuh dengan tantangan, tapi saya berhasil mengatasinya dengan baik. Saya belajar banyak hal baru dan merasa lebih percaya diri.', 7, 'neutral', DATE_SUB(CURDATE(), INTERVAL 3 DAY), 1, NOW(), NOW()); 
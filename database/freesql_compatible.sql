-- FreeSQL Compatible Database Setup
-- This version uses DATETIME instead of TIMESTAMP to avoid compatibility issues

-- ============================================
-- 1. USERS TABLE (for authentication)
-- ============================================
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL UNIQUE,
  `email` varchar(100) NOT NULL UNIQUE,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','user') NOT NULL DEFAULT 'user',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_username` (`username`),
  KEY `idx_email` (`email`),
  KEY `idx_role` (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 2. TOURNAMENT SIGNUPS TABLE (for team registrations)
-- ============================================
CREATE TABLE IF NOT EXISTS `tournament_signups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(100) NOT NULL,
  `captain_name` varchar(100) NOT NULL,
  `game_title` varchar(100) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idx_team_name` (`team_name`),
  KEY `idx_captain_name` (`captain_name`),
  KEY `idx_game_title` (`game_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- ============================================
-- 3. INSERT DEFAULT DATA
-- ============================================

-- Insert default admin user (password: admin123)
INSERT INTO `users` (`username`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
('admin', 'admin@tournament.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NOW(), NOW())
ON DUPLICATE KEY UPDATE `username` = `username`;

-- Insert sample tournament teams
INSERT INTO `tournament_signups` (`team_name`, `captain_name`, `game_title`, `created_at`, `updated_at`) VALUES
('Team Alpha', 'John Smith', 'League of Legends', NOW(), NOW()),
('Team Beta', 'Jane Doe', 'Valorant', NOW(), NOW()),
('Team Gamma', 'Mike Johnson', 'CS:GO', NOW(), NOW()),
('Team Delta', 'Sarah Wilson', 'Dota 2', NOW(), NOW()),
('Team Echo', 'David Brown', 'Overwatch 2', NOW(), NOW())
ON DUPLICATE KEY UPDATE `team_name` = `team_name`;

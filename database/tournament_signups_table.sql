-- Create tournament_signups table for team registrations
CREATE TABLE IF NOT EXISTS `tournament_signups` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `team_name` varchar(100) NOT NULL,
  `captain_name` varchar(100) NOT NULL,
  `game_title` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `idx_team_name` (`team_name`),
  KEY `idx_captain_name` (`captain_name`),
  KEY `idx_game_title` (`game_title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert some sample data (optional)
INSERT INTO `tournament_signups` (`team_name`, `captain_name`, `game_title`) VALUES
('Team Alpha', 'John Smith', 'League of Legends'),
('Team Beta', 'Jane Doe', 'Valorant'),
('Team Gamma', 'Mike Johnson', 'CS:GO'),
('Team Delta', 'Sarah Wilson', 'Dota 2'),
('Team Echo', 'David Brown', 'Overwatch 2')
ON DUPLICATE KEY UPDATE `team_name` = `team_name`;

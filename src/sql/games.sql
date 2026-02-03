CREATE DATABASE IF NOT EXISTS games_db;

GRANT ALL PRIVILEGES ON games_db.* TO 'testuser'@'%';
FLUSH PRIVILEGES;

USE games_db;

-- Database Schema for Games Application
-- Created: 2025-12-14

-- Drop tables if they exist (for clean setup)
DROP TABLE IF EXISTS game_platform;
DROP TABLE IF EXISTS games;
DROP TABLE IF EXISTS genres;
DROP TABLE IF EXISTS platforms;

-- Create genres table
CREATE TABLE genres (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    description TEXT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create platforms table
CREATE TABLE platforms (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL UNIQUE,
    manufacturer VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create games table
CREATE TABLE games (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    release_date DATE,
    genre_id INT,
    description TEXT,
    image_filename VARCHAR(255),
    FOREIGN KEY (genre_id) REFERENCES genres(id) ON DELETE SET NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Create game_platform pivot table
CREATE TABLE game_platform (
    game_id INT NOT NULL,
    platform_id INT NOT NULL,
    PRIMARY KEY unique_game_platform (game_id, platform_id),
    FOREIGN KEY (game_id) REFERENCES games(id) ON DELETE CASCADE,
    FOREIGN KEY (platform_id) REFERENCES platforms(id) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Insert sample data into genres
INSERT INTO genres (name, description) VALUES
    ('Action', 'Fast-paced games focusing on physical challenges, combat, hand-eye coordination, and quick reflexes. Players engage in intense battles and overcome obstacles through skillful gameplay.'),
    ('Adventure', 'Story-driven games emphasizing exploration, puzzle-solving, and narrative progression. Players embark on journeys through richly detailed worlds and interact with memorable characters.'),
    ('RPG', 'Role-playing games where players control characters, make meaningful choices, develop abilities, and experience deep storylines. Character progression and customization are key elements.'),
    ('Strategy', 'Games requiring careful planning, tactical thinking, and resource management. Players must make strategic decisions to outsmart opponents and achieve victory through clever tactics.'),
    ('Sports', 'Games simulating real-world sports and athletic competitions. Players experience the thrill of professional sports through realistic gameplay and competitive matches.'),
    ('Simulation', 'Games that simulate real-world activities, systems, or experiences. Players can build cities, manage businesses, or experience life-like scenarios in detailed virtual environments.'),
    ('Puzzle', 'Games focused on problem-solving, logic challenges, and mental exercises. Players must use critical thinking and pattern recognition to solve increasingly complex puzzles.'),
    ('Racing', 'Fast-paced competitive driving and vehicle games. Players race against opponents on various tracks, striving for the fastest times and ultimate victory.'),
    ('Horror', 'Games designed to frighten and create suspense through atmospheric storytelling, jump scares, and psychological tension. Players face terrifying situations and must survive against horrific threats.'),
    ('Fighting', 'One-on-one or team-based combat games emphasizing precise timing, combos, and competitive skill. Players master unique fighters and engage in intense battles.');

-- Insert sample data into platforms
INSERT INTO platforms (name, manufacturer) VALUES
    ('PC', 'Various'),
    ('PS5', 'Sony'),
    ('PS4', 'Sony'),
    ('Xbox Series X', 'Microsoft'),
    ('Xbox One', 'Microsoft'),
    ('Nintendo Switch', 'Nintendo'),
    ('Steam Deck', 'Valve'),
    ('Mobile', 'Various');

-- Insert sample data into games
INSERT INTO games (title, release_date, genre_id, description, image_filename) VALUES
    ('The Legend of Zelda: Tears of the Kingdom', '2023-05-12', 2, 'An epic adventure through the kingdom of Hyrule and the skies above.', 'The_Legend_of_Zelda_Tears_of_the_Kingdom.jpg'),
    ('Elden Ring', '2022-02-25', 3, 'A dark fantasy action RPG set in the Lands Between.', 'Elden_Ring.jpg'),
    ('God of War Ragnarok', '2022-11-09', 1, 'Kratos and Atreus embark on a mythic journey for answers before Ragnarok arrives.', 'God_of_War_Ragnarok.jpg'),
    ('Resident Evil 4 Remake', '2023-03-24', 9, 'A remake of the survival horror classic with updated graphics and gameplay.', 'Resident_Evil_4_remake.jpg'),
    ('Street Fighter 6', '2023-06-02', 10, 'The latest installment in the legendary fighting game series.', 'Street_Fighter_6.jpg'),
    ('Baldur''s Gate 3', '2023-08-03', 3, 'A story-rich, party-based RPG set in the Dungeons & Dragons universe.', 'Baldur\'s_Gate_3.jpg'),
    ('Starfield', '2023-09-06', 3, 'An open-world space exploration RPG from Bethesda Game Studios.', 'Starfield.jpg'),
    ('Super Mario Bros. Wonder', '2023-10-20', 2, 'A new 2D platforming adventure featuring creative power-ups and transformations.', 'Mario_Wonder.png'),
    ('Alan Wake 2', '2023-10-27', 9, 'A psychological horror thriller that blurs the line between reality and fiction.', 'Alan_Wake_2.jpg'),
    ('F1 2023', '2023-06-16', 8, 'The official game of the 2023 FIA Formula One World Championship.', 'F1_23.jpg'),
    ('Cities: Skylines II', '2023-10-24', 6, 'Build and manage the city of your dreams in this city-building simulation.', 'Cities_Skylines_II.png'),
    ('Portal 2', '2011-04-19', 7, 'A first-person puzzle-platform game featuring innovative portal mechanics.', 'Portal_2.jpg'),
    ('Civilization VI', '2016-10-21', 4, 'Lead your civilization from the Stone Age to the Information Age.', 'Civilization_VI.jpg'),
    ('The Sims 4', '2014-09-02', 6, 'Create and control people in a virtual world simulation.', 'Sims_4.png'),
    ('FIFA 23', '2022-09-30', 5, 'The world''s most popular football simulation game.', 'FIFA_23.jpg');

-- Insert sample data into game_platform (many-to-many relationship)
INSERT INTO game_platform (game_id, platform_id) VALUES
    -- The Legend of Zelda: Tears of the Kingdom (game_id: 1)
    (1, 6),  -- Nintendo Switch

    -- Elden Ring (game_id: 2)
    (2, 1),  -- PC
    (2, 2),  -- PS5
    (2, 3),  -- PS4
    (2, 4),  -- Xbox Series X
    (2, 5),  -- Xbox One

    -- God of War Ragnarok (game_id: 3)
    (3, 2),  -- PS5
    (3, 3),  -- PS4

    -- Resident Evil 4 Remake (game_id: 4)
    (4, 1),  -- PC
    (4, 2),  -- PS5
    (4, 3),  -- PS4
    (4, 4),  -- Xbox Series X

    -- Street Fighter 6 (game_id: 5)
    (5, 1),  -- PC
    (5, 2),  -- PS5
    (5, 3),  -- PS4
    (5, 4),  -- Xbox Series X

    -- Baldur's Gate 3 (game_id: 6)
    (6, 1),  -- PC
    (6, 2),  -- PS5
    (6, 4),  -- Xbox Series X

    -- Starfield (game_id: 7)
    (7, 1),  -- PC
    (7, 4),  -- Xbox Series X

    -- Super Mario Bros. Wonder (game_id: 8)
    (8, 6),  -- Nintendo Switch

    -- Alan Wake 2 (game_id: 9)
    (9, 1),  -- PC
    (9, 2),  -- PS5
    (9, 4),  -- Xbox Series X

    -- F1 2023 (game_id: 10)
    (10, 1), -- PC
    (10, 2), -- PS5
    (10, 3), -- PS4
    (10, 4), -- Xbox Series X
    (10, 5), -- Xbox One

    -- Cities: Skylines II (game_id: 11)
    (11, 1), -- PC
    (11, 2), -- PS5
    (11, 4), -- Xbox Series X

    -- Portal 2 (game_id: 12)
    (12, 1), -- PC
    (12, 3), -- PS4
    (12, 5), -- Xbox One
    (12, 6), -- Nintendo Switch

    -- Civilization VI (game_id: 13)
    (13, 1), -- PC
    (13, 3), -- PS4
    (13, 5), -- Xbox One
    (13, 6), -- Nintendo Switch

    -- The Sims 4 (game_id: 14)
    (14, 1), -- PC
    (14, 3), -- PS4
    (14, 5), -- Xbox One

    -- FIFA 23 (game_id: 15)
    (15, 1), -- PC
    (15, 2), -- PS5
    (15, 3), -- PS4
    (15, 4), -- Xbox Series X
    (15, 5), -- Xbox One
    (15, 6); -- Nintendo Switch

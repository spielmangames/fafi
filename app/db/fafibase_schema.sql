
#-----------------------------------------------------------------------------------------------------------------------
# DB init [version=1.14]
#-----------------------------------------------------------------------------------------------------------------------


DROP DATABASE IF EXISTS `fafi_db`;

CREATE DATABASE `fafi_db`;
USE fafi_db;




#-----------------------------------------------------------------------------------------------------------------------
# 0. DB version
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `_version` (
    `db_schema` VARCHAR(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

INSERT INTO _version VALUES ('1.14');




#-----------------------------------------------------------------------------------------------------------------------
# 1. Geography
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `countries` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32) NOT NULL,
    `continent` ENUM('Africa', 'America', 'Asia', 'Europe') NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_countries_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `cities` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32) NOT NULL,
    `country_id` INT(11) UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_cities_name` (`name`)
    CONSTRAINT `country_id` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# 2. Teams
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE clubs (
     `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

     `name` VARCHAR(32) NOT NULL,
     `fafi_name` VARCHAR(32) NOT NULL,

     `city_id` INT(11) UNSIGNED NOT NULL,
     `founded` SMALLINT(4) UNSIGNED NOT NULL,,

     PRIMARY KEY (`id`),
     UNIQUE KEY `u_clubs_name` (`name`),
     UNIQUE KEY `u_clubs_fafi_name` (`fafi_name`),
     CONSTRAINT `city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# 3.1 Player Skills
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `positions` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(2) NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_positions_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# 3.2 Player
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `players` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32),
    `particle` VARCHAR(8),
    `surname` VARCHAR(32) NOT NULL,
    `fafi_surname` VARCHAR(32) NOT NULL,
#     `birth_country` INT(11) UNSIGNED NOT NULL,
#     `birth_city` INT(11) UNSIGNED NOT NULL,
#     `birth_date`
    `nationality` INT(11) UNSIGNED NOT NULL,

    `height` TINYINT(3) UNSIGNED,
    `foot` ENUM('L', 'R'),
    `is_fragile` BIT DEFAULT 0,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_players_name_particle_surname` (`name`, `particle`, `surname`),
    UNIQUE KEY `u_players_name_particle_fafi_surname` (`name`, `particle`, `surname`),
#     CONSTRAINT `birth_country` FOREIGN KEY (`birth_country`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
#     CONSTRAINT `birth_city` FOREIGN KEY (`birth_city`) REFERENCES `cities` (`id`) ON DELETE CASCADE,
#     CONSTRAINT `nationality` FOREIGN KEY (`nationality`) REFERENCES `countries` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `player_position_assocs` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `player_id` INT(11) UNSIGNED NOT NULL,
    `position_id` INT(11) UNSIGNED NOT NULL,

    `att_min` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    `att_max` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    `def_min` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,
    `def_max` TINYINT(1) UNSIGNED NOT NULL DEFAULT 0,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_player_position_assocs_player_id_position_id` (`player_id`, `position_id`),
    CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
    CONSTRAINT `position_id` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `player_club_assocs` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `club_id` INT(11) UNSIGNED NOT NULL,
    `num` TINYINT(2) UNSIGNED NOT NULL,
    `player_id` INT(11) UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_player_club_assocs_club_id_no` (`club_id`, `num`),
    UNIQUE KEY `u_player_club_assocs_club_id_player_id` (`club_id`, `player_id`),
    CONSTRAINT `club_id` FOREIGN KEY (`club_id`) REFERENCES `clubs` (`id`) ON DELETE CASCADE,
    CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




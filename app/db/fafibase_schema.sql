
#-----------------------------------------------------------------------------------------------------------------------
# DB init [version=1.5]
#-----------------------------------------------------------------------------------------------------------------------


DROP DATABASE IF EXISTS `fafi_db`;
CREATE DATABASE `fafi_db`;
USE fafi_db;




#-----------------------------------------------------------------------------------------------------------------------
# DB Schema version
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `_version` (
    `db` VARCHAR(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# Geography models
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `countries` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32) NOT NULL,
    `code` VARCHAR(5) NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_countries_name` (`name`),
    UNIQUE KEY `u_countries_code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `cities` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32) NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_cities_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `cities_countries_assocs` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `city_id` INT(11) UNSIGNED NOT NULL,
    `state` VARCHAR(32),
    `country_id` INT(11) UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_cities_countries_assocs_city_id_country_id` (`city_id`, `country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# PLAYER models
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `positions` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(2) NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_positions_name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `players` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32),
    `particle` VARCHAR(8),
    `surname` VARCHAR(32) NOT NULL,
    `fafi_surname` VARCHAR(32) NOT NULL,

    `height` TINYINT(3) UNSIGNED,
    `foot` ENUM('L', 'R'),
    `injure_factor` BIT DEFAULT 0,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_players_name_particle_surname` (`name`, `particle`, `surname`),
    UNIQUE KEY `u_players_fafi_surname` (`fafi_surname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `players_positions_assocs` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `player_id` INT(11) UNSIGNED NOT NULL,
    `position_id` INT(11) UNSIGNED NOT NULL,

    `att_min` TINYINT(1) NOT NULL DEFAULT 0,
    `att_max` TINYINT(1) NOT NULL DEFAULT 0,
    `def_min` TINYINT(1) NOT NULL DEFAULT 0,
    `def_max` TINYINT(1) NOT NULL DEFAULT 0,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_players_player_id_position_id` (`player_id`, `position_id`),
    CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE,
    CONSTRAINT `position_id` FOREIGN KEY (`position_id`) REFERENCES `positions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


# CREATE TABLE `player_origins` (
#     `id` bigint(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,
#
#     `player_id` bigint(16) NOT NULL,
#
#     PRIMARY KEY (`id`),
#     CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE
# ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# set Schema version
#-----------------------------------------------------------------------------------------------------------------------

INSERT INTO _version VALUES ('1.5');


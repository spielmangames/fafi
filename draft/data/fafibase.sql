
#-----------------------------------------------------------------------------------------------------------------------
# DB init
#-----------------------------------------------------------------------------------------------------------------------


CREATE DATABASE `fafi_db`;
USE fafi_db;




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


CREATE TABLE `cities_countries_assignments` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `city_id` INT(11) UNSIGNED NOT NULL,
    `state` VARCHAR(32),
    `country_id` INT(11) UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_cities_countries_assignments_city_id_country_id` (`city_id`, `country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# PLAYER model
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `players` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `name` VARCHAR(32) COLLATE utf8_unicode_ci,
    `particle` VARCHAR(8) COLLATE utf8_unicode_ci,
    `surname` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,
    `fafi_surname` VARCHAR(32) COLLATE utf8_unicode_ci NOT NULL,

    `height` TINYINT(3) UNSIGNED,
    `foot` ENUM('L', 'R'),
    `injure_factor` BIT DEFAULT 0,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_players_name_particle_surname` (`name`, `particle`, `surname`),
    UNIQUE KEY `u_players_fafi_surname` (`fafi_surname`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


# CREATE TABLE `player_origins` (
#     `id` bigint(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,
#
#     `player_id` bigint(16) NOT NULL,
#
#     PRIMARY KEY (`id`),
#     CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE
# ) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;





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


CREATE TABLE `countries_cities_assignments` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT NOT NULL,

    `city_id` INT(11) UNSIGNED NOT NULL,
    `state` VARCHAR(32) NOT NULL,
    `country_id` INT(11) UNSIGNED NOT NULL,

    PRIMARY KEY (`id`),
    UNIQUE KEY `u_countries_cities_assignments_city_id_country_id` (`city_id`, `country_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




#-----------------------------------------------------------------------------------------------------------------------
# PLAYER model
#-----------------------------------------------------------------------------------------------------------------------


CREATE TABLE `players` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,

    `fafi_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
    `status` bool NOT NULL DEFAULT 0,

    `name` varchar(32) COLLATE utf8_unicode_ci,
    `particle` varchar(8) COLLATE utf8_unicode_ci,
    `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,
    `birth_city` varchar(64) COLLATE utf8_unicode_ci,
    `birth_date` DATE,

    `height` int UNSIGNED,
    `foot` ENUM('L', 'R'),
    `injure_factor` bool

) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `player_origins` (
    `id` bigint(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,

    `player_id` bigint(16) NOT NULL,

    PRIMARY KEY (`id`),
    CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




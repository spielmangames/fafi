
#----------------------------------------------------------------------------------------------------------------------#
# DB init
#----------------------------------------------------------------------------------------------------------------------#


CREATE DATABASE `fafi`;




#----------------------------------------------------------------------------------------------------------------------#
# PLAYER model
#----------------------------------------------------------------------------------------------------------------------#


CREATE TABLE `players` (
  `id` bigint(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,

  `fafi_name` varchar(32) COLLATE utf8_unicode_ci NOT NULL UNIQUE,
  `status` bit NOT NULL DEFAULT 0

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


CREATE TABLE `player_origins` (
   `id` bigint(16) NOT NULL PRIMARY KEY AUTO_INCREMENT,

   `player_id` bigint(16) NOT NULL,

   `name` varchar(32) COLLATE utf8_unicode_ci,
   `particle` varchar(8) COLLATE utf8_unicode_ci,
   `surname` varchar(32) COLLATE utf8_unicode_ci NOT NULL,

#    `birth_country`,
   `birth_city` varchar(64) COLLATE utf8_unicode_ci,
   `birth_date` DATE,

   CONSTRAINT `player_id` FOREIGN KEY (`player_id`) REFERENCES `players` (`id`) ON DELETE CASCADE

) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;




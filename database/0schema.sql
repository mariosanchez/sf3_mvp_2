CREATE DATABASE `symfony` DEFAULT CHARACTER SET utf8;

CREATE TABLE `beer` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `brewery` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `style` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `score` decimal(7,5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `photo` longtext COLLATE utf8_unicode_ci NOT NULL,
  `abv` decimal(4,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

CREATE TABLE `review` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` longtext COLLATE utf8_unicode_ci NOT NULL,
  `user_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aroma_score` smallint(6) NOT NULL,
  `appearance_score` smallint(6) NOT NULL,
  `taste_score` smallint(6) NOT NULL,
  `palate_score` smallint(6) NOT NULL,
  `overall_score` decimal(7,5) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `beer_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_794381C6D0989053` (`beer_id`),
  CONSTRAINT `FK_794381C6D0989053` FOREIGN KEY (`beer_id`) REFERENCES `beer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


DROP TABLE IF EXISTS `bono_module_videogallery_files`;
CREATE TABLE `bono_module_videogallery_files` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`lang_id` INT NOT NULL,
	`category_id` INT NOT NULL,
	`title` varchar(254) NOT NULL,
	`name` varchar(254) NOT NULL,
	`description` TEXT NOT NULL,
	`meta_description` TEXT NOT NULL,
	`keywords` TEXT NOT NULL
	
) DEFAULT CHARSET = UTF8;

DROP TABLE IF EXISTS `bono_module_videogallery_categories`;
CREATE TABLE `bono_module_videogallery_categories` (
	`id` INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
	`lang_id` INT NOT NULL,
	`category_id` INT NOT NULL,
	`title` varchar(254) NOT NULL,
	`description` TEXT NOT NULL
    
) DEFAULT CHARSET = UTF8;

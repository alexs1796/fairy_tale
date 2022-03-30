
DROP DATABASE epic_story;

CREATE DATABASE epic_story;

CREATE TABLE `logs` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `class` varchar(255) NOT NULL,
    `action` varchar(255) NOT NULL,
    `value` text NOT NULL,
    `time` TIMESTAMP,
    PRIMARY KEY (`id`)
);

CREATE TABLE `hero` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(255) NOT NULL,
    `weapon` varchar(255) NOT NULL,
    `gender` text NOT NULL,
    `action` text NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `sun` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `stolen` boolean NOT NULL,
    `saved` boolean NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `moon` (
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
   `stolen` boolean NOT NULL,
   `saved` boolean NOT NULL,
   PRIMARY KEY (`id`)
);


CREATE TABLE `good_people` (
    `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
    `name` varchar(15) NOT NULL,
    `height` int(3) NOT NULL,
    `age` int(2) NOT NULL,
--     `type` varchar(10) NOT NULL,
    PRIMARY KEY (`id`)
);

CREATE TABLE `bad_people` (
       `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
       `name` varchar(15) NOT NULL,
       `height` int(3) NOT NULL,
       `age` int(2) NOT NULL,
--     `type` varchar(10) NOT NULL,
       PRIMARY KEY (`id`)
);

CREATE TABLE `day_type` (
   `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
   `day_type` varchar(80) NOT NULL,
   `object_type` varchar(80) NOT NULL,
   `object_rise` boolean NOT NULL,
   PRIMARY KEY (`id`)
);
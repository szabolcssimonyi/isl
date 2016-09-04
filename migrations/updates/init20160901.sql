CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `status` enum('act','temp','del') NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_users_states` (`status`),
  KEY `i_users_emails` (`email`),
  KEY `i_users_names` (`name`),
  KEY `i_users_created` (`created`),
  KEY `i_users_modified` (`modified`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---
CREATE TABLE `userinfo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `aboutme` text,
  `birthdate` date DEFAULT NULL,
  `hometown` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_userinfo_birthdate` (`birthdate`),
  KEY `i_userinfo_hometown` (`hometown`),
  KEY `fk_userinfo_user_idx` (`user_id`),
  CONSTRAINT `fk_userinfo_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---
CREATE TABLE `forms` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(45) NOT NULL,
  `desc` text,
  `created` datetime NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `user_id` int(11) NOT NULL,
  `downloads` int(11) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `i_forms_title` (`title`),
  KEY `i_forms_created` (`created`),
  KEY `i_forms_downloads` (`downloads`),
  KEY `fk_forms_users_idx` (`user_id`),
  CONSTRAINT `fk_forms_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---
CREATE TABLE `downloads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `form_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_downloads_forms_idx` (`form_id`),
  KEY `i_downloads_created` (`created`),
  KEY `fk_downloads_users_idx` (`user_id`),
  CONSTRAINT `fk_downloads_forms` FOREIGN KEY (`form_id`) REFERENCES `forms` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  CONSTRAINT `fk_downloads_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
---
CREATE TRIGGER `downloads_AFTER_INSERT` 
AFTER INSERT ON `downloads` FOR EACH ROW
BEGIN
update forms set downloads=downloads+1 where id=NEW.form_id;
END
---
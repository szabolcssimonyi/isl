CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `status` enum('act','temp','del') NOT NULL,
  `email` varchar(45) DEFAULT NULL,
  `name` varchar(45) NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `created` datetime NOT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

CREATE TABLE `user_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `lang` varchar(2) DEFAULT 'EN',
  `aboutme` text,
  `birthdate` date DEFAULT NULL,
  `hometown` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `i_birthdate` (`birthdate`),
  KEY `i_hometown` (`hometown`),
  KEY `fk_user_idx` (`user_id`),
  CONSTRAINT `fk_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

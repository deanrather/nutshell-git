CREATE TABLE `git_log` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `hash` varchar(64) NOT NULL,
  `date` int(11) NOT NULL,
  `user_name` varchar(45) NOT NULL,
  `message` varchar(256) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `hash` (`hash`)
) ENGINE=InnoDB AUTO_INCREMENT=3720 DEFAULT CHARSET=latin1

CREATE TABLE `git_version` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `date` int(11) unsigned NOT NULL,
  PRIMARY KEY (`id`,`date`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1
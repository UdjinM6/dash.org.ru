CREATE TABLE IF NOT EXISTS `api` (
`id` int(11) NOT NULL,
  `api` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `hosting` (
`id` int(11) NOT NULL,
  `ip` varchar(128) NOT NULL,
  `txid` varchar(128) DEFAULT NULL,
  `address` varchar(128) DEFAULT NULL,
  `pay_address` varchar(128) DEFAULT NULL,
  `key` varchar(128) DEFAULT NULL,
  `out` int(11) DEFAULT NULL,
  `time` int(11) DEFAULT NULL,
  `last` int(11) DEFAULT NULL,
  `pay_time` int(11) DEFAULT NULL,
  `api` int(11) DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `pay_logs` (
`id` int(11) NOT NULL,
  `txid` varchar(128) NOT NULL,
  `coins` varchar(128) NOT NULL,
  `time` varchar(128) NOT NULL,
  `address` varchar(128) NOT NULL,
  `extra` varchar(128) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=0 DEFAULT CHARSET=utf8;

ALTER TABLE `api`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `api` (`api`);

ALTER TABLE `hosting`
 ADD PRIMARY KEY (`id`), ADD UNIQUE KEY `ip` (`ip`), ADD KEY `key` (`txid`), ADD KEY `api` (`api`);

ALTER TABLE `pay_logs`
 ADD PRIMARY KEY (`id`);

ALTER TABLE `api`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;

ALTER TABLE `hosting`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;

ALTER TABLE `pay_logs`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=0;


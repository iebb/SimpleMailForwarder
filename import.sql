
CREATE TABLE IF NOT EXISTS `domains` (
  `domain` varchar(255) NOT NULL,
  `private` varchar(32) NOT NULL,
  `public` varchar(32) NOT NULL,
  `open` int(11) NOT NULL,
  PRIMARY KEY (`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

CREATE TABLE IF NOT EXISTS `forwarding` (
  `prefix` varchar(255) NOT NULL,
  `domain` varchar(255) NOT NULL,
  `destination` varchar(255) NOT NULL,
  `password` varchar(40) NOT NULL,
  PRIMARY KEY (`prefix`,`domain`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

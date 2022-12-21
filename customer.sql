DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `id`       int          NOT NULL AUTO_INCREMENT,
  `filename` varchar(255) NOT NULL,
  `uploaded` datetime     NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

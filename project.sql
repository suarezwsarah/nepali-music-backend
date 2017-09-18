SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";

DROP TABLE IF EXISTS `log_audit`;
CREATE TABLE IF NOT EXISTS `log_audit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `log_level` varchar(10) NOT NULL,
  `log_text` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;


INSERT INTO `log_audit` (`id`, `log_level`, `log_text`) VALUES
(1, 'INFO', 'sdahal remove artist_id 2 from mp3_artist table');
COMMIT;

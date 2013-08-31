SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


DROP TABLE IF EXISTS connected_networks;
CREATE TABLE connected_networks (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  provider varchar(255) NOT NULL,
  network_id varchar(255) NOT NULL,
  access_token varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS contacts;
CREATE TABLE contacts (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  oid varchar(255) DEFAULT NULL,
  locale varchar(255) DEFAULT NULL,
  provider varchar(255) DEFAULT NULL,
  given_name varchar(255) DEFAULT NULL,
  family_name varchar(255) DEFAULT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  username varchar(255) NOT NULL,
  gender varchar(50) NOT NULL,
  dob date DEFAULT NULL,
  email varchar(255) NOT NULL,
  picture varchar(255) NOT NULL,
  phone bigint(20) NOT NULL,
  mobile bigint(20) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  is_active tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS groups;
CREATE TABLE groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  is_active tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO groups (id, name, is_active) VALUES
(3, 'Super Admin', 1),
(4, 'User', 1);

DROP TABLE IF EXISTS login_histories;
CREATE TABLE login_histories (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  session_id varchar(100) NOT NULL,
  log_in_datetime datetime NOT NULL,
  log_out_datetime datetime DEFAULT NULL,
  ip varchar(50) NOT NULL,
  country varchar(50) NOT NULL,
  city varchar(50) NOT NULL,
  state varchar(100) DEFAULT NULL,
  latitude double DEFAULT NULL,
  longitude double DEFAULT NULL,
  zip_code varchar(50) DEFAULT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO login_histories (id, user_id, session_id, log_in_datetime, log_out_datetime, ip, country, city, state, latitude, longitude, zip_code) VALUES
(1, 1, '3fl81cfg0o62so5t0mjqbdub03', '2013-08-16 16:11:53', '2013-08-16 16:13:27', '', '', '', NULL, NULL, NULL, NULL),
(2, 1, '2hsjfhaf1hkipsvv0hjiaaic37', '2013-08-16 16:13:58', '2013-08-16 16:14:09', '', '', '', NULL, NULL, NULL, NULL),
(3, 1, 'gapea9keiat87poch3m9qmleo0', '0000-00-00 00:00:00', '2013-08-16 16:17:49', '127.0.0.1', '', '', NULL, NULL, NULL, NULL),
(4, 1, 'ocf0c0tdqs4p33bvrr155eok77', '2013-08-16 16:32:48', '2013-08-16 16:33:11', '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC');

DROP TABLE IF EXISTS social_media;
CREATE TABLE social_media (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  provider varchar(255) NOT NULL,
  network_id varchar(255) NOT NULL,
  access_id varchar(255) NOT NULL,
  url varchar(255) NOT NULL,
  created int(11) NOT NULL,
  modified int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS users;
CREATE TABLE users (
  id int(11) NOT NULL AUTO_INCREMENT,
  group_id int(11) NOT NULL,
  first_name varchar(255) NOT NULL,
  last_name varchar(255) NOT NULL,
  `password` varchar(128) DEFAULT NULL,
  password_token varchar(128) DEFAULT NULL,
  email varchar(255) DEFAULT NULL,
  email_verified tinyint(1) DEFAULT '0',
  email_token varchar(255) DEFAULT NULL,
  email_token_expires datetime DEFAULT NULL,
  tos tinyint(1) DEFAULT '0',
  archived_date datetime NOT NULL,
  is_archived tinyint(1) DEFAULT '0',
  is_active tinyint(1) DEFAULT '0',
  last_login datetime DEFAULT NULL,
  created datetime DEFAULT NULL,
  modified datetime DEFAULT NULL,
  is_deleted tinyint(1) DEFAULT '0',
  deleted_on datetime DEFAULT NULL,
  PRIMARY KEY (id),
  KEY BY_USERNAME (first_name),
  KEY BY_EMAIL (email)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO users (id, group_id, first_name, last_name, password, password_token, email, email_verified, email_token, email_token_expires, tos, archived_date, is_archived, is_active, last_login, created, modified) VALUES
(1, 1, 'Super', 'Admin', '466a9ac8af0a547eda14b4e0afbbbf242f123fc8', NULL, 'madmin@mengra.com', 1, NULL, NULL, 1, '0000-00-00 00:00:00', 0, 1, '2013-08-16 16:32:48', '2013-07-15 22:50:07', '2013-08-16 16:32:48'),
(2, 2, 'First Name', 'Last Name', '5940bb9520332787775c35745d0272b7f7c5307a', NULL, 'testdata987@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-08-12 14:45:35', '2013-08-12 15:32:42'),
(3, 2, 'testdata', 'data', '5940bb9520332787775c35745d0272b7f7c5307a', NULL, 'testdata777@gmail.com', 0, '2chnowezlv', '2013-08-13 15:37:41', 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-08-12 15:37:41', '2013-08-12 15:37:41');

DROP TABLE IF EXISTS users_contacts;
CREATE TABLE users_contacts (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  contact_id int(11) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;


DROP TABLE IF EXISTS user_profiles;
CREATE TABLE user_profiles (
  id int(11) NOT NULL AUTO_INCREMENT,
  user_id int(11) NOT NULL,
  mobile_no bigint(20) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

INSERT INTO user_profiles (id, user_id, mobile_no, created, modified) VALUES
(1, 1, 9944115544, '2013-07-15 22:51:28', '2013-07-15 22:51:28');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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
  address text,
  about text,
  mobile bigint(20) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id),
  UNIQUE KEY email (email)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS contact_pictures;
CREATE TABLE contact_pictures (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  picture varchar(255) NOT NULL,
  is_profile_pic tinyint(1) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS countries;
CREATE TABLE countries (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(20) DEFAULT NULL,
  is_active tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS educations;
CREATE TABLE educations (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  city varchar(255) NOT NULL,
  university varchar(255) NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  is_studying tinyint(1) NOT NULL,
  class varchar(255) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS groups;
CREATE TABLE groups (
  id int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  is_active tinyint(1) NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

DROP TABLE IF EXISTS languages;
CREATE TABLE languages (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  title varchar(255) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

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

DROP TABLE IF EXISTS works;
CREATE TABLE works (
  id int(11) NOT NULL AUTO_INCREMENT,
  contact_id int(11) NOT NULL,
  employer varchar(255) NOT NULL,
  position varchar(255) NOT NULL,
  city varchar(255) NOT NULL,
  description text NOT NULL,
  start_date date NOT NULL,
  end_date date NOT NULL,
  is_currently_working tinyint(4) NOT NULL,
  created datetime NOT NULL,
  modified datetime NOT NULL,
  PRIMARY KEY (id)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;


INSERT INTO connected_networks (id, contact_id, provider, network_id, access_token, url, created, modified) VALUES
(2, 2, 'Facebook', '100002911597467', 'CAAIUnL5fWsEBAPU2e4xH2uXd93kztZAh9wreGBn0gb4cwteSfMlEAhxBwdEpctsWolm1IaNdvVStomJQOQNZBUJc8PAI7umjn8GLiI00smhFyjZA895Kpi1YzoSYaZCWv2qqWaEWNYdB52xaZALBkgdJS931n6onwNZAlM12bR9bV9SXsqflZBu', 'https://www.facebook.com/sukhjinder.kaur.144', '2013-09-04 12:39:56', '2013-09-04 12:39:56'),
(3, 3, 'Facebook', '100001185010014', 'CAAIUnL5fWsEBACXJZBDwiiQ9VFmKsPr6eAymRVe1wUKlJTIObbeWmdxchlFdUE8hZA17vVn6IxtFWZCB4ZBMoTRZBe134dZBkNvrXhvkFZCWrIhMpeZA7bxq4ZCAgGg7oK2LybNu58C0JP5c5CIaPcdRm832ZCzvhdPdpNY9xSAea6DxawxIEWvsKJ', 'https://www.facebook.com/surinder.sammy', '2013-09-05 11:06:08', '2013-09-05 11:06:08'),
(4, 4, 'Facebook', '100006510407451', 'CAAIUnL5fWsEBAPLuLj5uZCiCx7NhQNNhC6b2bjaPKvx4ctzJJRdw8K89a3ZCliGanOiTNul5GoZCa5HYgOmaB4UwlR9ywBdZCkkCDN0ipEDr6ZAgImtZCjhMUu1n0UNqzSveHuLjd0V6UJjCZCbWuKwtXQ7YKJetaLIZBy0TOrZCuMSZC7qPC3c8Im', 'https://www.facebook.com/gurdeep.mahi.92', '2013-09-05 12:09:53', '2013-09-05 12:09:53'),
(5, 5, 'Facebook', '100002423475634', 'CAAIUnL5fWsEBANwXKwKGuzFZCtrZAqgJgy6OdFZBr6DjOzLxZB3S3pohhPMVo7nrXYJWNHt93CJkZBQMhdZCsDB99PRPZAaUEfUmXgo1uoU0sUuUZBUDo6HMKin7q686ZBvKMlJ4OHaZB9uoiQevs9z1fPD6XfZAQ7XOv9q3Ao8Y5IN25twujBlLCxE3ryeiodsuqIZD', 'https://www.facebook.com/luckys383', '2013-09-07 14:06:58', '2013-09-07 14:06:58');

INSERT INTO contacts (id, user_id, oid, locale, provider, given_name, family_name, first_name, last_name, name, username, gender, dob, email, picture, phone, address, about, mobile, created, modified) VALUES
(2, 4, 'https://www.facebook.com/sukhjinder.kaur.144', 'en_GB', NULL, 'Sukhjinder', 'Kaur', 'Sukhjinder', 'Kaur', 'Sukhjinder Kaur', 'sukhjinder.kaur.144', 'female', NULL, 'ksukhjinder17@gmail.com', 'https://graph.facebook.com/sukhjinder.kaur.144/picture?type=large', 0, NULL, NULL, 0, '2013-09-04 12:39:56', '2013-09-04 12:39:56'),
(3, 5, 'https://www.facebook.com/surinder.sammy', 'en_US', NULL, 'Surinder', 'Sammy', 'Surinder', 'Sammy', 'Surinder Sammy', 'surinder.sammy', 'male', NULL, 'sammy27july@gmail.com', 'https://graph.facebook.com/surinder.sammy/picture?type=large', 0, NULL, NULL, 0, '2013-09-05 11:06:08', '2013-09-05 11:06:08'),
(4, 6, 'https://www.facebook.com/gurdeep.mahi.92', 'en_GB', NULL, 'Gurdeep', 'Mahi', 'Gurdeep', 'Mahi', 'Gurdeep Mahi', 'gurdeep.mahi.92', 'male', NULL, 'gurdeepmahi24@gmail.com', 'https://graph.facebook.com/gurdeep.mahi.92/picture?type=large', 0, NULL, NULL, 0, '2013-09-05 12:09:53', '2013-09-05 12:09:53'),
(5, 7, 'https://www.facebook.com/luckys383', 'en_US', NULL, 'Luckyl', 'Saini', 'Luckyl', 'Saini', 'Luckyl Saini', 'luckys383', 'male', '1988-10-23', 'luckys383@gmail.com', 'https://graph.facebook.com/luckys383/picture?type=large', 0, NULL, NULL, 0, '2013-09-07 14:06:58', '2013-09-07 14:06:58');



INSERT INTO educations (id, contact_id, city, university, start_date, end_date, is_studying, class, created, modified) VALUES
(1, 5, '', 'Guru Gobind Singh Senior Secondar School', '0000-00-00', '0000-00-00', 1, '', '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(2, 5, '', 'Jeewan model high school', '0000-00-00', '0000-00-00', 1, '', '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(3, 5, '', 'Punjab Technical University (PTU)', '0000-00-00', '0000-00-00', 1, 'MCA', '2013-09-07 14:06:58', '2013-09-07 14:06:58');

INSERT INTO groups (id, name, is_active) VALUES
(1, 'Super Admin', 1),
(3, 'User', 1);

INSERT INTO languages (id, contact_id, title, created, modified) VALUES
(1, 5, 'Punjabi', '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(2, 5, 'English', '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(3, 5, 'Hindi', '2013-09-07 14:06:58', '2013-09-07 14:06:58');

INSERT INTO login_histories (id, user_id, session_id, log_in_datetime, log_out_datetime, ip, country, city, state, latitude, longitude, zip_code) VALUES
(1, 1, '97082867077f2c3c6dc0e28e79d167f6', '0000-00-00 00:00:00', '2013-09-07 13:53:15', '', '', '', NULL, NULL, NULL, NULL),
(2, 1, '4d5ec6fb7608614c6441998756e2b75d', '0000-00-00 00:00:00', '2013-09-07 14:05:11', '', '', '', NULL, NULL, NULL, NULL),
(3, 7, 'nj22t3lafcn0ljc017dshkepo1', '2013-09-07 18:12:34', '2013-09-07 18:12:59', '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC'),
(4, 7, '8k6hsfe0ut0166qam67l7i91e6', '2013-09-07 18:14:13', '2013-09-07 18:14:24', '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC'),
(5, 7, 'op8i33ef051a89hrcti9f96793', '2013-09-07 18:14:49', '2013-09-08 10:11:22', '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC'),
(6, 7, '7cgjkmrvuf88a6t16vstg7f1o0', '2013-09-08 10:11:22', '2013-09-16 15:07:00', '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC'),
(7, 7, 'aq2kmvu7n9csamd0f8ik01oq10', '2013-09-16 15:07:00', NULL, '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC'),
(8, 1, 'edi6irt7vongqpt7odirp3hfq4', '2013-10-06 15:26:07', NULL, '127.0.0.1', '', 'city', 'state', 1.325575452, 1.4644416456, 'AABBCC');


INSERT INTO users (id, group_id, first_name, last_name, password, password_token, email, email_verified, email_token, email_token_expires, tos, archived_date, is_archived, is_active, last_login, created, modified, is_deleted, deleted_on) VALUES
(1, 1, 'Super', 'Admin', '5940bb9520332787775c35745d0272b7f7c5307a', NULL, 'madmin@mengra.com', 1, NULL, NULL, 1, '0000-00-00 00:00:00', 0, 1, '2013-10-06 16:14:13', '2013-07-15 22:50:07', '2013-10-06 16:14:13', 0, NULL),
(2, 3, 'First Name', 'Last Name', '5940bb9520332787775c35745d0272b7f7c5307a', NULL, 'testdata987@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-08-12 14:45:35', '2013-08-12 15:32:42', 0, NULL),
(4, 3, 'Sukhjinder', 'Kaur', 'a994708b784ec08ebbd6dc0eb23ade3270494510', NULL, 'ksukhjinder17@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-09-04 12:39:47', '2013-09-04 12:39:47', 0, NULL),
(5, 3, 'Surinder', 'Sammy', '9eee404e4c8dad2fa38aa5b5709121696e904559', NULL, 'sammy27july@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-09-05 11:06:04', '2013-09-05 11:06:04', 0, NULL),
(6, 3, 'Gurdeep', 'Mahi', 'd5a5e77921abcdcd9eed05133b574d82124158ff', NULL, 'gurdeepmahi24@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, NULL, '2013-09-05 12:09:53', '2013-09-05 12:09:53', 0, NULL),
(7, 3, 'Luckyl', 'Saini', '5940bb9520332787775c35745d0272b7f7c5307a', NULL, 'luckys383@gmail.com', 1, NULL, NULL, 0, '0000-00-00 00:00:00', 0, 1, '2013-09-16 15:06:59', '2013-09-07 14:06:57', '2013-09-16 15:06:59', 0, NULL);


INSERT INTO user_profiles (id, user_id, mobile_no, created, modified) VALUES
(1, 1, 9944115544, '2013-07-15 22:51:28', '2013-07-15 22:51:28');

INSERT INTO works (id, contact_id, employer, position, city, description, start_date, end_date, is_currently_working, created, modified) VALUES
(1, 5, 'Logiciel Solutions', 'Web Developer', '', '', '2011-10-01', '0000-00-00', 0, '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(2, 5, 'Kapoor nursing home', 'Doctor asistent', '', 'I worked as a Asistent of doctor', '2006-01-01', '2008-12-31', 0, '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(3, 5, 'The Art of Living', '', '', '', '0000-00-00', '0000-00-00', 0, '2013-09-07 14:06:58', '2013-09-07 14:06:58'),
(4, 5, 'Student', '', '', '', '0000-00-00', '0000-00-00', 0, '2013-09-07 14:06:58', '2013-09-07 14:06:58');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

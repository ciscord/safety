-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Oct 29, 2018 at 01:55 PM
-- Server version: 5.7.23
-- PHP Version: 7.1.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `safety`
--

-- --------------------------------------------------------

--
-- Table structure for table `unf_app_config`
--

CREATE TABLE `unf_app_config` (
  `key` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_app_config`
--

INSERT INTO `unf_app_config` (`key`, `value`) VALUES
('address', 'West Chester'),
('app_logo', 'logo.png'),
('company', 'smartmaxdev'),
('currency_symbol', '0'),
('email', 'development@smartmaxdev.com'),
('facebook_appid', ''),
('facebook_login', '0'),
('facebook_secret', ''),
('fax', ''),
('google_appid', ''),
('google_login', '0'),
('google_secret', ''),
('language', 'english'),
('pagination_limit', '30'),
('phone', '947-2800'),
('reg_mail_send', '1'),
('timezone', '0'),
('twitter_appid', ''),
('twitter_login', '0'),
('twitter_secret', ''),
('website', 'http://www.smartmaxdev.com');

-- --------------------------------------------------------

--
-- Table structure for table `unf_cicookies`
--

CREATE TABLE `unf_cicookies` (
  `id` int(11) NOT NULL,
  `cookie_id` varchar(255) DEFAULT NULL,
  `netid` varchar(255) DEFAULT NULL,
  `ip_address` varchar(255) DEFAULT NULL,
  `user_agent` varchar(255) DEFAULT NULL,
  `orig_page_requested` varchar(120) DEFAULT NULL,
  `php_session_id` varchar(40) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_cicookies`
--

INSERT INTO `unf_cicookies` (`id`, `cookie_id`, `netid`, `ip_address`, `user_agent`, `orig_page_requested`, `php_session_id`, `created_at`, `updated_at`) VALUES
(1, '57c7d48327c8f8.53730201', '236', '127.0.0.1', 'Mozilla/5.0 (Windows NT 6.1; WOW64; rv:47.0) Gecko/20100101 Firefox/47.0', '', 'da7b56b0e002c909d412674012e6d74e2bba2f13', '2017-09-01 09:10:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `unf_ci_sessions`
--

CREATE TABLE `unf_ci_sessions` (
  `id` varchar(40) NOT NULL,
  `ip_address` varchar(45) NOT NULL,
  `timestamp` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `data` blob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `unf_companies`
--

CREATE TABLE `unf_companies` (
  `company_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `company_phone_number` varchar(50) NOT NULL,
  `company_cell` varchar(50) NOT NULL,
  `company_email` varchar(50) NOT NULL,
  `company_address` varchar(250) NOT NULL,
  `company_address2` varchar(250) NOT NULL,
  `company_city` varchar(50) NOT NULL,
  `company_state` varchar(50) NOT NULL,
  `company_zip` varchar(50) NOT NULL,
  `comments` text NOT NULL,
  `company_active` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unf_country_list`
--

CREATE TABLE `unf_country_list` (
  `c_id` int(11) NOT NULL,
  `country_code` varchar(255) NOT NULL,
  `country_name` varchar(260) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_country_list`
--

INSERT INTO `unf_country_list` (`c_id`, `country_code`, `country_name`) VALUES
(1, 'Afghanistan', 'AF'),
(2, 'Åland Islands', 'AX'),
(3, 'Albania', 'AL'),
(4, 'Algeria', 'DZ'),
(5, 'American Samoa', 'AS'),
(6, 'Andorra', 'AD'),
(7, 'Angola', 'AO'),
(8, 'Anguilla', 'AI'),
(9, 'Antarctica', 'AQ'),
(10, 'Antigua and Barbuda', 'AG'),
(11, 'Argentina', 'AR'),
(12, 'Armenia', 'AM'),
(13, 'Aruba', 'AW'),
(14, 'Australia', 'AU'),
(15, 'Austria', 'AT'),
(16, 'Azerbaijan', 'AZ'),
(17, 'Bahamas', 'BS'),
(18, 'Bahrain', 'BH'),
(19, 'Bangladesh', 'BD'),
(20, 'Barbados', 'BB'),
(21, 'Belarus', 'BY'),
(22, 'Belgium', 'BE'),
(23, 'Belize', 'BZ'),
(24, 'Benin', 'BJ'),
(25, 'Bermuda', 'BM'),
(26, 'Bhutan', 'BT'),
(27, 'Bolivia', 'BO'),
(28, 'Bonaire', 'BQ'),
(29, 'Bosnia and Herzegovina', 'BA'),
(30, 'Botswana', 'BW'),
(31, 'Bouvet Island', 'BV'),
(32, 'Brazil', 'BR'),
(33, 'British Indian Ocean Territory', 'IO'),
(34, 'Brunei Darussalam', 'BN'),
(35, 'Bulgaria', 'BG'),
(36, 'Burkina Faso', 'BF'),
(37, 'Burundi', 'BI'),
(38, 'Cambodia', 'KH'),
(39, 'Cameroon', 'CM'),
(40, 'Canada', 'CA'),
(41, 'Cape Verde', 'CV'),
(42, 'Cayman Islands', 'KY'),
(43, 'Central African Republic', 'CF'),
(44, 'Chad', 'TD'),
(45, 'Chile', 'CL'),
(46, 'China', 'CN'),
(47, 'Christmas Island', 'CX'),
(48, 'Cocos Islands', 'CC'),
(49, 'Colombia', 'CO'),
(50, 'Comoros', 'KM'),
(51, 'Congo', 'CG'),
(52, 'Congo', 'CD'),
(53, 'Cook Islands', 'CK'),
(54, 'Costa Rica', 'CR'),
(55, 'Côte d Ivoire', 'CI'),
(56, 'Croatia', 'HR'),
(57, 'Cuba', 'CU'),
(58, 'Curaçao', 'CW'),
(59, 'Cyprus', 'CY'),
(60, 'Czech Republic', 'CZ'),
(61, 'Denmark', 'DK'),
(62, 'Djibouti', 'DJ'),
(63, 'Dominica', 'DM'),
(64, 'Dominican Republic', 'DO'),
(65, 'Ecuador', 'EC'),
(66, 'Egypt', 'EG'),
(67, 'El Salvador', 'SV'),
(68, 'Equatorial Guinea', 'GQ'),
(69, 'Eritrea', 'ER'),
(70, 'Estonia', 'EE'),
(71, 'Ethiopia', 'ET'),
(72, 'Falkland Islands', 'FK'),
(73, 'Faroe Islands', 'FO'),
(74, 'Fiji', 'FJ'),
(75, 'Finland', 'FI'),
(76, 'France', 'FR'),
(77, 'French Guiana', 'GF'),
(78, 'French Polynesia', 'PF'),
(79, 'French Southern Territories', 'TF'),
(80, 'Gabon', 'GA'),
(81, 'Gambia', 'GM'),
(82, 'Georgia', 'GE'),
(83, 'Germany', 'DE'),
(84, 'Ghana', 'GH'),
(85, 'Gibraltar', 'GI'),
(86, 'Greece', 'GR'),
(87, 'Greenland', 'GL'),
(88, 'Grenada', 'GD'),
(89, 'Guadeloupe', 'GP'),
(90, 'Guam', 'GU'),
(91, 'Guatemala', 'GT'),
(92, 'Guernsey', 'GG'),
(93, 'Guinea', 'GN'),
(94, 'Guinea-Bissau', 'GW'),
(95, 'Guyana', 'GY'),
(96, 'Haiti', 'HT'),
(97, 'Heard Island and McDonald Islands', 'HM'),
(98, 'Holy See', 'VA'),
(99, 'Honduras', 'HN'),
(100, 'Hong Kong', 'HK'),
(101, 'Hungary', 'HU'),
(102, 'Iceland', 'IS'),
(103, 'India', 'IN'),
(104, 'Indonesia', 'ID'),
(105, 'Iran', 'IR'),
(106, 'Iraq', 'IQ'),
(107, 'Ireland', 'IE'),
(108, 'Isle of Man', 'IM'),
(109, 'Israel', 'IL'),
(110, 'Italy', 'IT'),
(111, 'Jamaica', 'JM'),
(112, 'Japan', 'JP'),
(113, 'Jersey', 'JE'),
(114, 'Jordan', 'JO'),
(115, 'Kazakhstan', 'KZ'),
(116, 'Kenya', 'KE'),
(117, 'Kiribati', 'KI'),
(118, 'Korea', 'KP'),
(119, 'Korea', 'KR'),
(120, 'Kuwait', 'KW'),
(121, 'Kyrgyzstan', 'KG'),
(122, 'Lao Peoples Democratic Republic', 'LA'),
(123, 'Latvia', 'LV'),
(124, 'Lebanon', 'LB'),
(125, 'Lesotho', 'LS'),
(126, 'Liberia', 'LR'),
(127, 'Libya', 'LY'),
(128, 'Liechtenstein', 'LI'),
(129, 'Lithuania', 'LT'),
(130, 'Luxembourg', 'LU'),
(131, 'Macao', 'MO'),
(132, 'Macedonia', 'MK'),
(133, 'Madagascar', 'MG'),
(134, 'Malawi', 'MW'),
(135, 'Malaysia', 'MY'),
(136, 'Maldives', 'MV'),
(137, 'Mali', 'ML'),
(138, 'Malta', 'MT'),
(139, 'Marshall Islands', 'MH'),
(140, 'Martinique', 'MQ'),
(141, 'Mauritania', 'MR'),
(142, 'Mauritius', 'MU'),
(143, 'Mayotte', 'YT'),
(144, 'Mexico', 'MX'),
(145, 'Micronesia', 'FM'),
(146, 'Moldova', 'MD'),
(147, 'Monaco', 'MC'),
(148, 'Mongolia', 'MN'),
(149, 'Montenegro', 'ME'),
(150, 'Montserrat', 'MS'),
(151, 'Morocco', 'MA'),
(152, 'Mozambique', 'MZ'),
(153, 'Myanmar', 'MM'),
(154, 'Namibia', 'NA'),
(155, 'Nauru', 'NR'),
(156, 'Nepal', 'NP'),
(157, 'Netherlands', 'NL'),
(158, 'New Caledonia', 'NC'),
(159, 'New Zealand', 'NZ'),
(160, 'Nicaragua', 'NI'),
(161, 'Niger', 'NE'),
(162, 'Nigeria', 'NG'),
(163, 'Niue', 'NU'),
(164, 'Norfolk Island', 'NF'),
(165, 'Northern Mariana Islands', 'MP'),
(166, 'Norway', 'NO'),
(167, 'Oman', 'OM'),
(168, 'Pakistan', 'PK'),
(169, 'Palau', 'PW'),
(170, 'Palestine', 'PS'),
(171, 'Panama', 'PA'),
(172, 'Papua New Guinea', 'PG'),
(173, 'Paraguay', 'PY'),
(174, 'Peru', 'PE'),
(175, 'Philippines', 'PH'),
(176, 'Pitcairn', 'PN'),
(177, 'Poland', 'PL'),
(178, 'Portugal', 'PT'),
(179, 'Puerto Rico', 'PR'),
(180, 'Qatar', 'QA'),
(181, 'Réunion', 'RE'),
(182, 'Romania', 'RO'),
(183, 'Russian Federation', 'RU'),
(184, 'Rwanda', 'RW'),
(185, 'Saint Barthélemy', 'BL'),
(186, 'Saint Helena', 'SH'),
(187, 'Saint Kitts and Nevis', 'KN'),
(188, 'Saint Lucia', 'LC'),
(189, 'Saint Martin', 'MF'),
(190, 'Saint Pierre and Miquelon', 'PM'),
(191, 'Saint Vincent and the Grenadines', 'VC'),
(192, 'Samoa', 'WS'),
(193, 'San Marino', 'SM'),
(194, 'Sao Tome and Principe', 'ST'),
(195, 'Saudi Arabia', 'SA'),
(196, 'Senegal', 'SN'),
(197, 'Serbia', 'RS'),
(198, 'Seychelles', 'SC'),
(199, 'Sierra Leone', 'SL'),
(200, 'Singapore', 'SG'),
(201, 'Sint Maarten Dutch part', 'SX'),
(202, 'Slovakia', 'SK'),
(203, 'Slovenia', 'SI'),
(204, 'Solomon Islands', 'SB'),
(205, 'Somalia', 'SO'),
(206, 'South Africa', 'ZA'),
(207, 'South Georgia and the South Sandwich Islands', 'GS'),
(208, 'South Sudan', 'SS'),
(209, 'Spain', 'ES'),
(210, 'Sri Lanka', 'LK'),
(211, 'Sudan', 'SD'),
(212, 'Suriname', 'SR'),
(213, 'Svalbard and Jan Mayen', 'SJ'),
(214, 'Swaziland', 'SZ'),
(215, 'Sweden', 'SE'),
(216, 'Switzerland', 'CH'),
(217, 'Syrian Arab Republic', 'SY'),
(218, 'Taiwan', 'TW'),
(219, 'Tajikistan', 'TJ'),
(220, 'Tanzania', 'TZ'),
(221, 'Thailand', 'TH'),
(222, 'Timor-Leste', 'TL'),
(223, 'Togo', 'TG'),
(224, 'Tokelau', 'TK'),
(225, 'Tonga', 'TO'),
(226, 'Trinidad and Tobago', 'TT'),
(227, 'Tunisia', 'TN'),
(228, 'Turkey', 'TR'),
(229, 'Turkmenistan', 'TM'),
(230, 'Turks and Caicos Islands', 'TC'),
(231, 'Tuvalu', 'TV'),
(232, 'Uganda', 'UG'),
(233, 'Ukraine', 'UA'),
(234, 'United Arab Emirates', 'AE'),
(235, 'United Kingdom', 'GB'),
(236, 'United States', 'US'),
(237, 'United States Minor Outlying Islands', 'UM'),
(238, 'Uruguay', 'UY'),
(239, 'Uzbekistan', 'UZ'),
(240, 'Vanuatu', 'VU'),
(241, 'Venezuela', 'VE'),
(242, 'Viet Nam', 'VN'),
(243, 'Virgin Islands', 'VG'),
(244, 'Virgin Islands', 'VI'),
(245, 'Wallis and Futuna', 'WF'),
(246, 'Western Sahara', 'EH'),
(247, 'Yemen', 'YE'),
(248, 'Zambia', 'ZM'),
(249, 'Zimbabwe', 'ZW');

-- --------------------------------------------------------

--
-- Table structure for table `unf_email_log`
--

CREATE TABLE `unf_email_log` (
  `id` int(11) NOT NULL,
  `address_to` varchar(255) DEFAULT NULL,
  `address_from` varchar(255) DEFAULT NULL,
  `sended_at` datetime DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `sender_ip` varchar(30) DEFAULT NULL,
  `server_response` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unf_locations`
--

CREATE TABLE `unf_locations` (
  `location_id` int(11) NOT NULL,
  `location_company_id` int(11) NOT NULL,
  `location_name` varchar(255) NOT NULL,
  `location_address` varchar(255) NOT NULL,
  `location_address2` varchar(255) NOT NULL,
  `latitude` float NOT NULL,
  `longitude` float NOT NULL,
  `location_active` int(11) NOT NULL,
  `location_delete` int(11) NOT NULL,
  `location_city` varchar(255) NOT NULL,
  `location_state` varchar(255) NOT NULL,
  `location_zip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unf_main_modules`
--

CREATE TABLE `unf_main_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(11) NOT NULL,
  `main_module_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_main_modules`
--

INSERT INTO `unf_main_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `main_module_id`) VALUES
('main_module_users', 'main_module_users_desc', 10, 1),
('main_module_config', 'main_module_config_desc', 20, 2),
('main_module_reports', 'main_module_reports_desc', 30, 3),
('main_module_dashboard', 'main_module_dashboard_desc', 0, 4);

-- --------------------------------------------------------

--
-- Table structure for table `unf_modules`
--

CREATE TABLE `unf_modules` (
  `name_lang_key` varchar(255) NOT NULL,
  `desc_lang_key` varchar(255) NOT NULL,
  `sort` int(10) NOT NULL,
  `module_id` varchar(255) NOT NULL,
  `main_module_id` int(11) NOT NULL,
  `editable` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_modules`
--

INSERT INTO `unf_modules` (`name_lang_key`, `desc_lang_key`, `sort`, `module_id`, `main_module_id`, `editable`) VALUES
('module_config', 'module_config_desc', 10, 'config', 2, 0),
('module_dashboards', 'module_dashboards_desc', 20, 'dashboards', 4, 0),
('module_profiles', 'module_profiles_desc', 20, 'profiles', 1, 0),
('module_trashes', 'module_trashes_desc', 30, 'trashes', 1, 0),
('module_users', 'module_users_desc', 20, 'users', 1, 0),
('module_user_reports', 'module_user_reports_desc', 10, 'user_reports', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `unf_permissions`
--

CREATE TABLE `unf_permissions` (
  `module_id` varchar(255) NOT NULL,
  `user_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_permissions`
--

INSERT INTO `unf_permissions` (`module_id`, `user_id`) VALUES
('config', 1),
('dashboards', 1),
('profiles', 1),
('trashes', 1),
('users', 1),
('user_reports', 1),
('profiles', 113),
('profiles', 117),
('profiles', 119),
('profiles', 120),
('profiles', 121),
('profiles', 122),
('profiles', 123),
('profiles', 125),
('profiles', 141);

-- --------------------------------------------------------

--
-- Table structure for table `unf_statistics`
--

CREATE TABLE `unf_statistics` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_level` int(11) DEFAULT NULL,
  `section` varchar(255) NOT NULL,
  `action` varchar(255) NOT NULL,
  `when_log` datetime NOT NULL,
  `uri` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unf_statistics`
--

INSERT INTO `unf_statistics` (`id`, `user_id`, `username`, `user_level`, `section`, `action`, `when_log`, `uri`) VALUES
(1, NULL, NULL, NULL, 'welcome', 'index', '2018-10-05 18:27:57', 'welcome'),
(2, NULL, NULL, NULL, '', 'index', '2018-10-05 18:27:58', 'favicon.ico'),
(3, NULL, NULL, NULL, '', 'index', '2018-10-05 18:27:58', 'favicon.png'),
(4, NULL, NULL, NULL, '', 'index', '2018-10-05 18:27:58', 'favicon.ico'),
(5, NULL, NULL, NULL, 'login', 'index', '2018-10-05 18:28:04', 'login'),
(6, NULL, NULL, NULL, '', 'index', '2018-10-05 18:28:05', 'favicon.png'),
(7, NULL, NULL, NULL, '', 'index', '2018-10-05 18:28:05', 'favicon.png'),
(8, NULL, NULL, NULL, '', 'index', '2018-10-05 18:28:05', 'favicon.ico'),
(9, NULL, NULL, NULL, 'login', 'index', '2018-10-05 18:28:11', 'login'),
(10, 1, 'smartmaxdev', 1, 'dashboards', 'index', '2018-10-05 18:28:11', 'dashboard/dashboards'),
(11, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 18:28:12', 'favicon.png'),
(12, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 18:28:12', 'favicon.png'),
(13, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 18:28:12', 'favicon.ico'),
(14, 1, 'smartmaxdev', 1, 'Login', 'index', '2018-10-05 18:29:07', ''),
(15, 1, 'smartmaxdev', 1, 'dashboards', 'index', '2018-10-05 18:29:07', 'dashboard/dashboards'),
(16, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 18:29:08', 'favicon.png'),
(17, 1, 'smartmaxdev', 1, 'config', 'index', '2018-10-05 19:25:08', 'config/config'),
(18, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 19:25:09', 'favicon.png'),
(19, 1, 'smartmaxdev', 1, 'dashboards', 'index', '2018-10-05 19:25:25', 'dashboard/dashboards'),
(20, 1, 'smartmaxdev', 1, '', 'index', '2018-10-05 19:25:26', 'favicon.png'),
(21, NULL, NULL, NULL, 'Login', 'index', '2018-10-07 00:54:12', ''),
(22, NULL, NULL, NULL, '', 'index', '2018-10-07 00:54:19', 'favicon.png'),
(23, NULL, NULL, NULL, '', 'index', '2018-10-07 00:55:25', 'user_guide'),
(24, NULL, NULL, NULL, '', 'index', '2018-10-07 00:55:27', 'favicon.png'),
(25, NULL, NULL, NULL, 'Login', 'index', '2018-10-08 01:04:12', ''),
(26, NULL, NULL, NULL, '', 'index', '2018-10-08 01:04:14', 'favicon.png'),
(27, NULL, NULL, NULL, '', 'index', '2018-10-08 01:04:30', 'phpmyadmin'),
(28, NULL, NULL, NULL, '', 'index', '2018-10-08 01:04:31', 'favicon.png'),
(29, NULL, NULL, NULL, '', 'index', '2018-10-08 01:05:22', 'phpMyAdmin'),
(30, NULL, NULL, NULL, '', 'index', '2018-10-08 01:05:23', 'favicon.png'),
(31, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:07', 'phpMyAdmin'),
(32, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:09', 'favicon.png'),
(33, NULL, NULL, NULL, 'Login', 'index', '2018-10-08 01:26:13', ''),
(34, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:15', 'favicon.png'),
(35, NULL, NULL, NULL, 'login', 'social_login', '2018-10-08 01:26:23', 'login/social_login/Google'),
(36, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:24', 'favicon.ico'),
(37, NULL, NULL, NULL, 'Login', 'index', '2018-10-08 01:26:33', ''),
(38, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:37', 'favicon.png'),
(39, NULL, NULL, NULL, 'login', 'user_register', '2018-10-08 01:26:41', 'login/user_register'),
(40, NULL, NULL, NULL, '', 'index', '2018-10-08 01:26:43', 'favicon.png'),
(41, NULL, NULL, NULL, '', 'index', '2018-10-08 01:36:51', 'phpmyadmin'),
(42, NULL, NULL, NULL, '', 'index', '2018-10-08 01:36:51', 'favicon.png'),
(43, NULL, NULL, NULL, 'Login', 'index', '2018-10-08 02:18:38', ''),
(44, NULL, NULL, NULL, '', 'index', '2018-10-08 19:06:26', 'phpmyadmin'),
(45, NULL, NULL, NULL, '', 'index', '2018-10-08 19:06:26', 'favicon.png'),
(46, NULL, NULL, NULL, 'Login', 'index', '2018-10-11 02:37:35', ''),
(47, NULL, NULL, NULL, 'Login', 'index', '2018-10-11 02:37:36', ''),
(48, NULL, NULL, NULL, 'login', 'index', '2018-10-25 19:57:26', 'login'),
(49, NULL, NULL, NULL, '', 'index', '2018-10-25 19:57:26', 'favicon.png'),
(50, NULL, NULL, NULL, 'login', 'user_register', '2018-10-25 19:57:30', 'login/user_register'),
(51, NULL, NULL, NULL, '', 'index', '2018-10-25 19:57:31', 'favicon.png'),
(52, NULL, NULL, NULL, 'login', 'save_user', '2018-10-25 19:58:42', 'login/save_user/-1');

-- --------------------------------------------------------

--
-- Table structure for table `unf_userinfo`
--

CREATE TABLE `unf_userinfo` (
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `profile_image` varchar(260) DEFAULT NULL,
  `register_date` date DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `marital_status` varchar(260) DEFAULT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address` text,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `country_name` varchar(260) DEFAULT NULL,
  `comments` text,
  `user_id` int(10) NOT NULL,
  `social_provider` varchar(260) DEFAULT NULL,
  `social_identifier` varchar(260) DEFAULT NULL,
  `social_profileURL` text,
  `user_company_id` int(11) NOT NULL DEFAULT '-1',
  `employee` varchar(250) NOT NULL,
  `pin` varchar(250) NOT NULL,
  `deleted` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_userinfo`
--

INSERT INTO `unf_userinfo` (`first_name`, `last_name`, `profile_image`, `register_date`, `dob`, `marital_status`, `phone_number`, `email`, `address`, `city`, `state`, `country_code`, `country_name`, `comments`, `user_id`, `social_provider`, `social_identifier`, `social_profileURL`, `user_company_id`, `employee`, `pin`, `deleted`) VALUES
('smartmaxdev', 'Support', '1.png', '2017-05-04', '1955-12-25', 'Single', '14849472800', 'development@smartmaxdev.com', '1450 E Boot', 'West Chester', 'PA', '19380', '236', 'New No comments', 1, '', '', '', 0, '', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `unf_users`
--

CREATE TABLE `unf_users` (
  `username` varchar(250) NOT NULL,
  `password` varchar(250) NOT NULL,
  `email_verification_code` text NOT NULL,
  `forgot_password` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deleted` int(11) NOT NULL,
  `active` int(11) NOT NULL DEFAULT '0',
  `user_level` int(11) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `unf_users`
--

INSERT INTO `unf_users` (`username`, `password`, `email_verification_code`, `forgot_password`, `user_id`, `deleted`, `active`, `user_level`) VALUES
('smartmaxdev', '$2a$08$m7iJI4mxDS6k/yzwSKXoQeQoS1zpK8eUJ/6pg2.fBIzrl3qzyZL1m', '', 0, 1, 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `unf_app_config`
--
ALTER TABLE `unf_app_config`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `unf_cicookies`
--
ALTER TABLE `unf_cicookies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unf_ci_sessions`
--
ALTER TABLE `unf_ci_sessions`
  ADD KEY `ci_sessions_timestamp` (`timestamp`);

--
-- Indexes for table `unf_companies`
--
ALTER TABLE `unf_companies`
  ADD PRIMARY KEY (`company_id`);

--
-- Indexes for table `unf_country_list`
--
ALTER TABLE `unf_country_list`
  ADD PRIMARY KEY (`c_id`);

--
-- Indexes for table `unf_email_log`
--
ALTER TABLE `unf_email_log`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unf_locations`
--
ALTER TABLE `unf_locations`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `unf_main_modules`
--
ALTER TABLE `unf_main_modules`
  ADD PRIMARY KEY (`main_module_id`);

--
-- Indexes for table `unf_modules`
--
ALTER TABLE `unf_modules`
  ADD PRIMARY KEY (`module_id`),
  ADD UNIQUE KEY `desc_lang_key` (`desc_lang_key`),
  ADD UNIQUE KEY `name_lang_key` (`name_lang_key`),
  ADD KEY `main_module_id` (`main_module_id`);

--
-- Indexes for table `unf_permissions`
--
ALTER TABLE `unf_permissions`
  ADD PRIMARY KEY (`module_id`,`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `unf_statistics`
--
ALTER TABLE `unf_statistics`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `unf_userinfo`
--
ALTER TABLE `unf_userinfo`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `unf_users`
--
ALTER TABLE `unf_users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `user_id` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `unf_cicookies`
--
ALTER TABLE `unf_cicookies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unf_companies`
--
ALTER TABLE `unf_companies`
  MODIFY `company_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `unf_country_list`
--
ALTER TABLE `unf_country_list`
  MODIFY `c_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=250;

--
-- AUTO_INCREMENT for table `unf_email_log`
--
ALTER TABLE `unf_email_log`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unf_locations`
--
ALTER TABLE `unf_locations`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `unf_main_modules`
--
ALTER TABLE `unf_main_modules`
  MODIFY `main_module_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `unf_statistics`
--
ALTER TABLE `unf_statistics`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `unf_userinfo`
--
ALTER TABLE `unf_userinfo`
  MODIFY `user_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=151;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `unf_modules`
--
ALTER TABLE `unf_modules`
  ADD CONSTRAINT `unf_modules_ibfk_1` FOREIGN KEY (`main_module_id`) REFERENCES `unf_main_modules` (`main_module_id`),
  ADD CONSTRAINT `unf_modules_ibfk_2` FOREIGN KEY (`main_module_id`) REFERENCES `unf_main_modules` (`main_module_id`);

--
-- Constraints for table `unf_users`
--
ALTER TABLE `unf_users`
  ADD CONSTRAINT `unf_users_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `unf_userinfo` (`user_id`);

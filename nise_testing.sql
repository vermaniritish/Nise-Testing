-- Adminer 4.8.1 MySQL 10.4.32-MariaDB dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

SET NAMES utf8mb4;

DROP TABLE IF EXISTS `activities`;
CREATE TABLE `activities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `url` text NOT NULL,
  `data` text DEFAULT NULL,
  `client` int(11) DEFAULT NULL,
  `admin` int(11) DEFAULT NULL,
  `ip` varchar(100) DEFAULT NULL,
  `device` varchar(255) DEFAULT NULL,
  `browser` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `admin` (`admin`),
  KEY `client` (`client`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `activity_log`;
CREATE TABLE `activity_log` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `admin_id` int(11) DEFAULT NULL,
  `log_name` varchar(255) DEFAULT NULL,
  `batch_uuid` text DEFAULT NULL,
  `description` text NOT NULL,
  `subject_type` varchar(255) DEFAULT NULL,
  `event` varchar(255) DEFAULT NULL,
  `subject_id` char(36) DEFAULT NULL,
  `causer_type` varchar(255) DEFAULT NULL,
  `causer_id` char(36) DEFAULT NULL,
  `properties` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `subject` (`subject_type`,`subject_id`),
  KEY `causer` (`causer_type`,`causer_id`),
  KEY `activity_log_log_name_index` (`log_name`),
  KEY `admin_id` (`admin_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `admins`;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phonenumber` varchar(255) DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `is_admin` tinyint(1) NOT NULL DEFAULT 0,
  `otp` varchar(50) DEFAULT NULL,
  `otp_sent_on` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `address` tinytext DEFAULT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `admins` (`id`, `first_name`, `last_name`, `email`, `password`, `phonenumber`, `last_login`, `is_admin`, `otp`, `otp_sent_on`, `token`, `image`, `created_by`, `status`, `deleted_at`, `created`, `address`, `modified`) VALUES
(7,	'Super',	'Admin',	'admin@laravel.com',	'$2y$10$Plo6sTWjRE2vlwzSpD./.uIjBo/rW.1Q6lde5snn1nX4DlYWNrg16',	NULL,	'2025-10-03 05:02:03',	1,	NULL,	NULL,	'ZZhRAdXPOQMzsbDxZKzkrWe9VQ3ihRJa',	'/uploads/admins/17583358289193-logo.png',	NULL,	1,	NULL,	'2025-07-19 12:15:07',	NULL,	'2025-10-02 23:32:03');

DROP TABLE IF EXISTS `admin_permissions`;
CREATE TABLE `admin_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permission_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `mode` enum('listing','create','update','delete') NOT NULL,
  `created_by` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `permission_id` (`permission_id`),
  KEY `admin_id` (`admin_id`),
  KEY `created_by` (`created_by`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `applications`;
CREATE TABLE `applications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `center_id` int(11) DEFAULT NULL,
  `username` varchar(100) NOT NULL,
  `person_name` varchar(255) NOT NULL,
  `person_email` varchar(255) NOT NULL,
  `person_contact` varchar(20) NOT NULL,
  `status` enum('pending','complete','in progress') DEFAULT 'pending',
  `created` datetime DEFAULT current_timestamp(),
  `modified` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `applications_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `applications` (`id`, `user_id`, `center_id`, `username`, `person_name`, `person_email`, `person_contact`, `status`, `created`, `modified`) VALUES
(24,	69,	13,	'',	'Buffy Allison',	'pusuc@mailinator.com',	'4454544545',	'pending',	'2025-09-23 20:00:33',	'2025-09-23 20:00:33'),
(27,	69,	14,	'',	'India Moran',	'foqumaz@mailinator.com',	'8778788778',	'pending',	'2025-09-23 23:37:32',	'2025-09-23 23:37:32'),
(28,	69,	15,	'',	'Dawn Randall',	'kawolyzemu@mailinator.com',	'6454656564',	'pending',	'2025-09-27 14:04:29',	'2025-09-27 14:04:29'),
(29,	69,	15,	'',	'sdfdsf',	'rohino@mailinator.com',	'6665656566',	'pending',	'2025-09-27 14:04:29',	'2025-09-27 14:04:29'),
(30,	69,	16,	'',	'Lee Newman',	'rohino@mailinator.com',	'8778788778',	'pending',	'2025-09-29 19:53:55',	'2025-09-29 19:53:55'),
(31,	69,	17,	'',	'Gay Noble',	'lubufibo@mailinator.com',	'7887878778',	'pending',	'2025-09-29 20:03:56',	'2025-09-29 20:03:56'),
(32,	69,	18,	'',	'Kameko Battle',	'lubybokike@mailinator.com',	'4544654654',	'pending',	'2025-09-29 20:12:27',	'2025-09-29 20:12:27');

DROP TABLE IF EXISTS `batches`;
CREATE TABLE `batches` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `center_id` int(11) DEFAULT NULL,
  `institute_id` int(11) DEFAULT NULL,
  `batch_id` varchar(255) DEFAULT NULL,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `academic_session` varchar(20) NOT NULL,
  `sanction_year` varchar(20) NOT NULL,
  `batch_strength` int(11) NOT NULL,
  `batch_title` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT current_timestamp(),
  `updated` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`),
  KEY `state_id` (`state_id`),
  CONSTRAINT `batches_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `batches` (`id`, `center_id`, `institute_id`, `batch_id`, `state_id`, `academic_session`, `sanction_year`, `batch_strength`, `batch_title`, `start_date`, `end_date`, `status`, `created_by`, `created`, `updated`) VALUES
(12,	14,	69,	'BCH/2023-2024/00012',	NULL,	'2023-2024',	'2017-2018',	69,	'Quis quos in molesti',	'2000-10-21',	'2011-10-01',	1,	69,	'2025-09-24 00:08:14',	'2025-09-27 10:15:58'),
(13,	13,	69,	'BCH/2021-2022/00013',	NULL,	'2021-2022',	'2024-2025',	1,	'Harum soluta minim c',	'1990-05-08',	'2006-05-06',	1,	69,	'2025-09-24 00:08:32',	'2025-09-24 06:59:00'),
(14,	13,	69,	'BCH/2018-2019/00014',	4,	'2018-2019',	'2019-2020',	150,	'Test',	'2025-09-24',	'2025-09-28',	1,	69,	'2025-09-24 21:51:25',	'2025-09-24 21:51:25'),
(15,	14,	69,	'BCH/2017-2018/00015',	4,	'2017-2018',	'2018-2019',	7,	'Mollitia vitae dolor',	'1980-10-14',	'1978-03-20',	1,	69,	'2025-09-24 21:53:00',	'2025-09-27 10:15:58'),
(16,	13,	69,	'BCH/2018-2019/00016',	11,	'2018-2019',	'2018-2019',	13,	'Hic perferendis ipsa',	'2022-11-07',	'1992-10-07',	1,	69,	'2025-09-24 21:53:13',	'2025-09-27 10:15:58');

DROP TABLE IF EXISTS `batch_allocations`;
CREATE TABLE `batch_allocations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_id` int(11) unsigned DEFAULT NULL,
  `center_id` int(11) unsigned DEFAULT NULL,
  `batch_id` int(11) DEFAULT NULL,
  `state` bigint(20) unsigned DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `batch_strength` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  `sanction_date` date DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0 COMMENT '0 = Not Approved, 1 = Approved',
  `allocated_doc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `center_id` (`center_id`),
  KEY `batch_id` (`batch_id`),
  KEY `state` (`state`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `batch_allocations` (`id`, `institute_id`, `center_id`, `batch_id`, `state`, `city`, `batch_strength`, `sanction_date`, `status`, `allocated_doc`, `created_at`, `updated_at`) VALUES
(58,	69,	13,	13,	NULL,	NULL,	'1',	'2025-09-24',	1,	'1758727120_file-sample_150kB.pdf',	'2025-09-24 15:18:40',	'2025-09-24 15:18:40'),
(59,	69,	14,	12,	NULL,	NULL,	'69',	'2025-09-24',	0,	'1758727120_file-sample_150kB.pdf',	'2025-09-24 15:18:40',	'2025-09-24 15:18:40'),
(60,	69,	13,	16,	NULL,	NULL,	'13',	'2025-09-24',	1,	'1758732916_file-sample_150kB.pdf',	'2025-09-24 16:55:16',	'2025-09-24 16:55:16'),
(61,	69,	14,	15,	NULL,	NULL,	'7',	'2025-09-25',	0,	'1758732916_file-sample_150kB.pdf',	'2025-09-24 16:55:16',	'2025-09-24 16:55:16');

DROP TABLE IF EXISTS `centers`;
CREATE TABLE `centers` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `institute_id` int(11) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `slug` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `state_id` int(11) NOT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `academic_session` varchar(50) NOT NULL,
  `center_afflilation_doc` varchar(255) DEFAULT NULL,
  `traner_certificate` varchar(255) DEFAULT NULL,
  `on_boarding_file` varchar(255) DEFAULT NULL,
  `cctv_camera_file` varchar(255) DEFAULT NULL,
  `mobilisation` varchar(255) DEFAULT NULL,
  `sip_id_proof` varchar(255) DEFAULT NULL,
  `affiliation_valid_from` date DEFAULT NULL,
  `affiliation_valid_to` date DEFAULT NULL,
  `sip_id` varchar(255) DEFAULT NULL,
  `officers` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`officers`)),
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created` timestamp NULL DEFAULT current_timestamp(),
  `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `centers_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `centers` (`id`, `institute_id`, `title`, `username`, `slug`, `address`, `state_id`, `district_id`, `city`, `phone`, `email`, `academic_session`, `center_afflilation_doc`, `traner_certificate`, `on_boarding_file`, `cctv_camera_file`, `mobilisation`, `sip_id_proof`, `affiliation_valid_from`, `affiliation_valid_to`, `sip_id`, `officers`, `status`, `created_by`, `created`, `modified`) VALUES
(17,	69,	'Est et anim facilis',	'INST-CEN-3978360/CEN/SI/017',	'est-et-anim-facilis-Q94y3N',	'Ut sint eos nemo cu',	33,	167,	'Optio a pariatur E',	'5455445454',	'pycagali@mailinator.com',	'2024-2025',	'1759156436_Screenshot_(7).png',	'1759156436_Screenshot_(10).png',	'1759156436_Screenshot_(8).png',	'1759156436_Screenshot_(11).png',	'1759156436_Screenshot_(10).png',	'1759156436_Screenshot_(11).png',	NULL,	NULL,	'Id commodi magnam ex',	NULL,	1,	69,	'2025-09-29 14:33:56',	'2025-09-29 14:40:37'),
(18,	69,	'Maxime adipisicing o',	'INST-CEN-6957920/CEN/AN/018',	'maxime-adipisicing-o-w3PaWE',	'Itaque eveniet quae',	3,	17,	'Cum in dolorem accus',	'4799878797',	'fiwyquz@mailinator.com',	'2025-2026',	'1759156946_Screenshot_(10).png',	'1759156946_Screenshot_(9).png',	'1759156946_Screenshot_(10).png',	'1759156946_Screenshot_(8).png',	'1759156946_Screenshot_(10).png',	'1759156946_Screenshot_(10).png',	'1977-07-20',	'2002-06-26',	'Ratione consequatur',	NULL,	0,	69,	'2025-09-29 14:42:26',	'2025-09-29 14:42:27');

DROP TABLE IF EXISTS `contact_us`;
CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `message` longtext NOT NULL,
  `subject` longtext NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `contact_us` (`id`, `name`, `email`, `phone_number`, `message`, `subject`, `created`, `modified`) VALUES
(8,	'Damian Pittman',	'foxidy@mailinator.com',	'1111111111',	'Obcaecati qui dolor',	'Perferendis beatae s',	'2025-07-20 14:46:57',	'2025-07-20 09:16:57'),
(9,	'Test',	'admin@ryd.com',	'4475555755',	'sdffdfds',	'dsdsds',	'2025-08-13 07:09:10',	'2025-08-13 01:39:10');

DROP TABLE IF EXISTS `custom_page_data`;
CREATE TABLE `custom_page_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(100) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `custom_page_data` (`id`, `key`, `value`) VALUES
(148,	'yellow_button_hi',	'1'),
(147,	'yellow_button_link_hi',	'/development/training/public/contact-us'),
(146,	'yellow_button_text_hi',	'हमसे संपर्क करें'),
(145,	'yellow_heading_hi',	'कृपया अपनी शंकाएँ दूर करने या एनआईएसई - प्रशिक्षण के बारे में अधिक जानने के लिए निःसंकोच संपर्क करें।'),
(144,	'yellow_title_hi',	'क्या आपको और जानकारी चाहिए?'),
(140,	'yellow_heading',	'Please feel free to clear your doubts or know more about NISE - Trainings.'),
(141,	'yellow_button_text',	'Contact Us'),
(142,	'yellow_button_link',	'/development/training/public/contact-us'),
(143,	'yellow_button',	'1'),
(132,	'director_image',	'/uploads/pages/17531101055145-dg21.jpg'),
(133,	'director_designation_hi',	'महानिदेशक'),
(134,	'director_name_hi',	'डॉ. मोहम्मद रिहान'),
(135,	'director_message_hi',	'संस्थान देश के आम नागरिकों तक सौर ऊर्जा से संबंधित तकनीकों और उनके अनुप्रयोगों के विकास एवं प्रदर्शन के लिए प्रतिबद्ध है। एनआईएसई अपनी सुविधाओं को बेहतर बनाने के लिए निरंतर प्रयासरत है ताकि वह नवीनतम तकनीकी प्रगतियों के साथ प्रतिस्पर्धा कर सके। मुझे विश्वास है कि सभी हितधारकों को इस वेबपेज से एनआईएसई की तकनीकी, अनुसंधान, परामर्श और कौशल विकास गतिविधियों की पूरी श्रृंखला से संबंधित आवश्यक जानकारी प्राप्त होगी। हम आपको बेहतर सेवा प्रदान करने के लिए आपके सुझावों का स्वागत करते हैं।'),
(136,	'director_button_text_hi',	NULL),
(137,	'director_button_link_hi',	NULL),
(138,	'director_button_hi',	'0'),
(139,	'yellow_title',	'Need More Information?'),
(131,	'director_button',	'0'),
(130,	'director_button_link',	'A'),
(129,	'director_button_text',	'A'),
(128,	'director_message',	'The institute is committed to the development and demonstration of solar energy related technologies and its applications to the common man in the country. NISE continuously strives to improve the facilities so as to compete with the latest technological advancements. I am sure, all the stake holders would receive the required information from this web page, about the whole range of technical, research, consultancy and skill development activities of the NISE. We welcome your feedbacks to serve you better.'),
(127,	'director_name',	'Dr. Mohammad Rihan'),
(126,	'director_designation',	'Director General\'s'),
(119,	'home_about_us_button',	'1'),
(120,	'home_about_us_title_hi',	'हमारे बारे में'),
(121,	'home_about_us_heading_hi',	'एनआईएसई प्रशिक्षण पाठ्यक्रम'),
(122,	'home_about_us_desc_hi',	'<p>संस्थान देश के आम लोगों तक सौर ऊर्जा से संबंधित तकनीकों और उनके अनुप्रयोगों के विकास और प्रदर्शन के लिए प्रतिबद्ध है। एनआईएसई लगातार अपनी सुविधाओं में सुधार करने का प्रयास करता है ताकि नवीनतम तकनीकी प्रगतियों के साथ प्रतिस्पर्धा कर सके। मुझे विश्वास है कि सभी हितधारकों को इस वेबपेज से एनआईएसई की पूरी श्रृंखला &mdash; तकनीकी, अनुसंधान, परामर्श और कौशल विकास गतिविधियों &mdash; की आवश्यक जानकारी प्राप्त होगी। हम आपको बेहतर सेवा देने के लिए आपके सुझावों का स्वागत करते हैं।</p>'),
(123,	'home_about_us_button_text_hi',	'और जानें'),
(124,	'home_about_us_button_link_hi',	'/development/training/public/about-us'),
(125,	'home_about_us_button_hi',	'0'),
(149,	'logos',	'[\"/uploads/pages/17545788541850-logo-mnr-1.jpg\",\"/uploads/pages/17545788447635-logo-niwe-1.jpg\",\"/uploads/pages/1754578833461-logo-seci.jpg\",\"/uploads/pages/17545788198865-logo-india-gov.jpg\",\"/uploads/pages/17545787986743-logo-mygov.jpg\"]'),
(117,	'home_about_us_button_text',	'Learn More'),
(118,	'home_about_us_button_link',	'/development/training/public/about-us'),
(116,	'home_about_us_desc',	'<p>The institute is committed to the development and demonstration of solar energy related technologies and its applications to the common man in the country. NISE continuously strives to improve the facilities so as to compete with the latest technological advancements. I am sure, all the stake holders would receive the required information from this web page, about the whole range of technical, research, consultancy and skill development activities of the NISE. We welcome your feedbacks to serve you better.</p>'),
(115,	'home_about_us_heading',	'NISE Training Courses'),
(114,	'home_about_us_title',	'About Us'),
(113,	'about_us_desc_hi',	'<p data-end=\"169\" data-start=\"59\"><strong data-end=\"169\" data-start=\"59\">एनआईएसई, भारत सरकार के नवीन और नवीकरणीय ऊर्जा मंत्रालय (एमएनआरई) के अधीन एक स्वायत्त विशेषीकृत संस्थान है।</strong></p>\r\n\r\n<p data-end=\"854\" data-start=\"171\"><strong data-end=\"854\" data-start=\"171\">यह संस्थान अनुसंधान और विकास, सौर घटक परीक्षण और प्रमाणन, क्षमता निर्माण, तथा सौर उत्पादों और अनुप्रयोगों के विकास के लिए अधिकृत है। एनआईएसई का तकनीकी सहयोग, एमएनआरई की उस आवश्यकता को पूरा करता है जिसके अंतर्गत भारत को आत्मनिर्भर नवीकरणीय ऊर्जा उत्पादक राष्ट्र बनाने और राष्ट्रीय सौर मिशन (एनएसएम) के कार्यान्वयन के दौरान आने वाली विभिन्न चुनौतियों का समाधान करने का लक्ष्य है। एनआईएसई ने सौर ऊर्जा क्षेत्र में नई प्रौद्योगिकियों के विकास, मानकों के निर्माण और उद्योग की बदलती आवश्यकताओं को पूरा करने के लिए निरंतर प्रयास करके अपनी पहचान स्थापित की है। इसके अतिरिक्त, एनआईएसई, भारत सरकार के साथ निकट सहयोग करके नवीकरणीय ऊर्जा क्षेत्र के विस्तार को तेज गति देने का लक्ष्य रखता है।</strong></p>'),
(111,	'vision_title_hi',	'दृष्टि'),
(112,	'vision_desc_hi',	'हमारा विजन है कि एनआईएसई को सौर ऊर्जा के क्षेत्र में नवाचार, अनुसंधान और कौशल विकास को बढ़ावा देकर एक वैश्विक उत्कृष्टता केंद्र के रूप में स्थापित किया जाए। हमारा उद्देश्य पूरे देश में सतत ऊर्जा समाधान को अपनाने की गति को तेज करना, समुदायों को सशक्त बनाना और आने वाली पीढ़ियों के लिए एक स्वच्छ और हरित भविष्य में योगदान देना है।'),
(109,	'mission_title_hi',	'उद्देश्य'),
(110,	'mission_desc_hi',	'एनआईएसई सौर ऊर्जा क्षेत्र में अनुसंधान, नवाचार और प्रशिक्षण प्रदान करने के लिए समर्पित है। यह संस्थान आधुनिक तकनीकों, परीक्षण और प्रमाणन सेवाओं के साथ उद्योग की जरूरतों को पूरा करने का निरंतर प्रयास करता है। हमारा उद्देश्य भारत को नवीकरणीय ऊर्जा में आत्मनिर्भर बनाना और उद्योग को नवीनतम तकनीकी समाधान उपलब्ध कराना है।'),
(108,	'about_us_title_hi',	'राष्ट्रीय सौर ऊर्जा संस्थान'),
(106,	'vision_title',	'Vision'),
(107,	'vision_desc',	'Our vision is to establish NISE as a global center of excellence in the field of solar energy by promoting innovation, research, and skill development. We aim to accelerate the adoption of sustainable energy solutions across the nation, empowering communities and contributing to a cleaner, greener future for generations to come.'),
(105,	'mission_desc',	'NISE is dedicated to providing research, innovation, and training in the solar energy sector. The institute continuously strives to meet industry needs through advanced technologies, testing, and certification services. Our goal is to make India self-reliant in renewable energy and deliver cutting-edge solutions to the industry.'),
(104,	'mission_title',	'Mission'),
(103,	'about_us_desc',	'<p>NISE is an autonomous specialized institute under the Ministry of New and Renewable Energy (MNRE), Government of India.</p>\r\n\r\n<p style=\"font-weight:400;\">Mandated for research and development, solar component testing and certification, capacity building, and development of solar products and applications. The technical support of NISE complements the requirements of MNRE to become a self-reliable renewable power producing nation and accept the series of challenges intervened in amidst of implementation of the National Solar Mission (NSM). NISE has established in the solar energy sector through continuous efforts by developing newer technologies, developing standards, and catering to the changing needs in the industry. Furthermore, NISE envisions in accelerating the proliferation of the renewable energy sector by intently working together with the Government of India.</p>'),
(102,	'about_us_title',	'National Institute of  Solar Energy'),
(150,	'courses',	'[\"/uploads/pages/17531133961095-block-chain1.jpg\",\"/uploads/pages/1753113392196-solar-thermal-system1.jpg\",\"/uploads/pages/17531133268729-solar-pv-system1.jpg\"]'),
(151,	'section_2_title',	'Dr. Mohammad Rihan'),
(152,	'sub_title',	'Director General\'s Message'),
(153,	'section_2_desc',	'<p>NISE is an autonomous institute under Ministry of New and Renewable Energy, Government of India established to facilitate the Research &amp; Development, Testing, Certification, Skill Development activities in the field of Solar energy technologies.<br />\r\n<br />\r\nUnder the skill development initiatives of the MNRE, NISE is mandated as the nodal agency for implementation of &ldquo;Suryamitra Skill Development Programme (SSDP)&rdquo;. SSDP aims to develop the skills of youth, considering the opportunities for employment in the growing Solar Energy Power Project&rsquo;s installation, operation &amp; maintenance in India and abroad. The SSDP is also designed to prepare the candidates to become new entrepreneurs in Solar Energy sector. This is a 600 hours residential skill development program following the Qualification Pack of SCG/Q0101.<br />\r\n<br />\r\nThe qualification of participants shall be- ITI / Diploma (Electrical, Electronics, Civil, Mechanical, Fitter, Instrumentation, Welder). Special emphasis to be given to the persons coming from rural background, unemployed youth, women, SC/ST candidates. The candidates would be provided boarding and lodging facilities at the training center by the TP. At the end of the course, proper assessment shall be made and certificates shall be issued by Skill Council of Green Jobs. Persons with higher qualifications like degree in any discipline or higher are strictly not eligible.&quot;</p>'),
(154,	'about_us_image',	NULL),
(155,	'section_2_title_hi',	'डॉ. मोहम्मद रिहान'),
(156,	'sub_title_hi',	'महानिदेशक का संदेश'),
(157,	'section_2_desc_hi',	'<p data-end=\"324\" data-start=\"69\"><strong data-end=\"87\" data-start=\"69\">एनआईएसई (NISE)</strong>, भारत सरकार के नवीन और नवीकरणीय ऊर्जा मंत्रालय (MNRE) के अंतर्गत एक स्वायत्त संस्थान है, जिसे सौर ऊर्जा प्रौद्योगिकियों के क्षेत्र में अनुसंधान एवं विकास, परीक्षण, प्रमाणन और कौशल विकास गतिविधियों को सुगम बनाने हेतु स्थापित किया गया है।</p>\r\n\r\n<p data-end=\"891\" data-start=\"326\"><strong data-end=\"355\" data-start=\"326\">एमएनआरई की कौशल विकास पहल</strong> के अंतर्गत, एनआईएसई को &quot;सूर्यमित्र कौशल विकास कार्यक्रम (SSDP)&quot; के कार्यान्वयन हेतु नोडल एजेंसी के रूप में नामित किया गया है। यह कार्यक्रम युवाओं के कौशल को विकसित करने का लक्ष्य रखता है, ताकि भारत और विदेशों में सौर ऊर्जा पावर परियोजनाओं की स्थापना, संचालन और रखरखाव में रोजगार के अवसरों को ध्यान में रखते हुए उन्हें तैयार किया जा सके। यह कार्यक्रम प्रतिभागियों को सौर ऊर्जा क्षेत्र में नए उद्यमी बनने के लिए भी तैयार करता है। यह 600 घंटे का आवासीय कौशल विकास कार्यक्रम है, जो <strong data-end=\"847\" data-start=\"834\">SCG/Q0101</strong> योग्यता पैक के अनुसार संचालित किया जाता है।</p>\r\n\r\n<p data-end=\"1483\" data-start=\"893\">इस कार्यक्रम में भाग लेने वाले प्रतिभागियों की शैक्षिक योग्यता <strong data-end=\"1055\" data-start=\"956\">आईटीआई / डिप्लोमा (इलेक्ट्रिकल, इलेक्ट्रॉनिक्स, सिविल, मैकेनिकल, फिटर, इंस्ट्रूमेंटेशन, वेल्डर)</strong> होनी चाहिए। विशेष प्राथमिकता ग्रामीण पृष्ठभूमि से आने वाले युवाओं, बेरोजगारों, महिलाओं और एससी/एसटी उम्मीदवारों को दी जाएगी। प्रशिक्षण केंद्र पर उम्मीदवारों को <strong data-end=\"1244\" data-start=\"1216\">निवास एवं भोजन की सुविधा</strong> प्रशिक्षण प्रदाता (TP) द्वारा दी जाएगी। कोर्स के अंत में विधिवत मूल्यांकन किया जाएगा और <strong data-end=\"1362\" data-start=\"1333\">ग्रीन जॉब्स स्किल काउंसिल</strong> द्वारा प्रमाण पत्र प्रदान किए जाएंगे। <strong data-end=\"1483\" data-start=\"1401\">स्नातक या उससे उच्च योग्यता वाले व्यक्ति इस कार्यक्रम के लिए पात्र नहीं होंगे।</strong></p>'),
(195,	'director_title_hi',	'डॉ. मोहम्मद रिहान'),
(158,	'logo_main_title',	'The above data is from 2015 to till date'),
(159,	'logo_image_1',	NULL),
(160,	'logo_number_1',	'59'),
(161,	'logo_title_1',	'Training Partner\'s'),
(162,	'logo_title_1_hi',	'प्रशिक्षण साझेदार या प्रशिक्षण भागीदार'),
(163,	'logo_image_2',	NULL),
(164,	'logo_number_2',	'139'),
(165,	'logo_title_2',	'Registered Center\'s'),
(166,	'logo_title_2_hi',	'पंजीकृत केंद्र'),
(167,	'logo_image_3',	NULL),
(168,	'logo_number_3',	'1870'),
(169,	'logo_title_3',	'Total Batches Completed'),
(170,	'logo_title_3_hi',	'कुल पूर्ण की गई बैचें'),
(171,	'logo_image_4',	NULL),
(172,	'logo_number_4',	'34'),
(173,	'logo_title_4',	'Ongoing Batches'),
(174,	'logo_title_4_hi',	'प्रचलित बैचें'),
(175,	'logo_image_5',	NULL),
(176,	'logo_number_5',	'56087'),
(177,	'logo_title_5',	'Suryamitra Trained'),
(178,	'logo_title_5_hi',	'सूर्यमित्र प्रशिक्षित'),
(179,	'logo_image_6',	NULL),
(180,	'logo_number_6',	'2014-25'),
(181,	'logo_title_6',	'PAN India Data Statewise of Suryamitra'),
(182,	'logo_title_6_hi',	'संपूर्ण भारत के राज्यवार सूर्य मित्र से संबंधित आंकड़े'),
(183,	'notice_button_title',	'Read More'),
(184,	'notice_button_title_hi',	'और पढ़ें'),
(185,	'notice_button_link',	'#'),
(186,	'logo_main_title_hi',	'उपरोक्त डेटा वर्ष 2015 से वर्तमान तक का है।'),
(187,	'logo_url_1',	'#'),
(188,	'logo_url_2',	'#'),
(189,	'logo_url_3',	'#'),
(190,	'logo_url_4',	'#'),
(191,	'logo_url_5',	'#'),
(192,	'logo_url_6',	'#'),
(193,	'director_title',	'Dr. Mohammad Rihan'),
(194,	'director_desc',	'<p>NISE is an autonomous institute under Ministry of New and Renewable Energy, Government of India established to facilitate the Research &amp; Development, Testing, Certification, Skill Development activities in the field of Solar energy technologies.<br />\r\n<br />\r\nUnder the skill development initiatives of the MNRE, NISE is mandated as the nodal agency for implementation of &ldquo;Suryamitra Skill Development Programme (SSDP)&rdquo;. SSDP aims to develop the skills of youth, considering the opportunities for employment in the growing Solar Energy Power Project&rsquo;s installation, operation &amp; maintenance in India and abroad. The SSDP is also designed to prepare the candidates to become new entrepreneurs in Solar Energy sector. This is a 600 hours residential skill development program following the Qualification Pack of SCG/Q0101.<br />\r\n<br />\r\nThe qualification of participants shall be- ITI / Diploma (Electrical, Electronics, Civil, Mechanical, Fitter, Instrumentation, Welder). Special emphasis to be given to the persons coming from rural background, unemployed youth, women, SC/ST candidates. The candidates would be provided boarding and lodging facilities at the training center by the TP. At the end of the course, proper assessment shall be made and certificates shall be issued by Skill Council of Green Jobs. Persons with higher qualifications like degree in any discipline or higher are strictly not eligible.&quot;</p>'),
(196,	'director_desc_hi',	'<p data-end=\"314\" data-start=\"61\"><strong data-end=\"99\" data-start=\"61\">राष्ट्रीय सौर ऊर्जा संस्थान (NISE)</strong> नवीन और नवीकरणीय ऊर्जा मंत्रालय, भारत सरकार के अधीन एक स्वायत्त संस्थान है, जिसे सौर ऊर्जा प्रौद्योगिकियों के अनुसंधान एवं विकास, परीक्षण, प्रमाणन और कौशल विकास गतिविधियों को बढ़ावा देने के लिए स्थापित किया गया है।</p>\r\n\r\n<p data-end=\"883\" data-start=\"316\"><strong data-end=\"324\" data-start=\"316\">MNRE</strong> की कौशल विकास पहलों के अंतर्गत, <strong data-end=\"365\" data-start=\"357\">NISE</strong> को &quot;सूर्यमित्र कौशल विकास कार्यक्रम (SSDP)&quot; के कार्यान्वयन हेतु नोडल एजेंसी के रूप में नामित किया गया है। यह कार्यक्रम युवाओं के कौशल को विकसित करने के उद्देश्य से शुरू किया गया है, ताकि भारत और विदेशों में तेजी से बढ़ रहे सौर ऊर्जा पावर प्रोजेक्ट्स की स्थापना, संचालन और अनुरक्षण के क्षेत्र में रोजगार के अवसरों का लाभ उठाया जा सके। यह कार्यक्रम प्रशिक्षुओं को सौर ऊर्जा क्षेत्र में उद्यमी बनने के लिए भी तैयार करता है। SSDP एक 600 घंटे का आवासीय कौशल विकास कार्यक्रम है जो <strong data-end=\"854\" data-start=\"841\">SCG/Q0101</strong> योग्यता पैक का पालन करता है।</p>\r\n\r\n<p data-end=\"1377\" data-start=\"885\"><strong data-end=\"897\" data-start=\"885\">पात्रता:</strong> प्रतिभागियों की शैक्षणिक योग्यता <strong data-end=\"1030\" data-start=\"931\">आईटीआई / डिप्लोमा (इलेक्ट्रिकल, इलेक्ट्रॉनिक्स, सिविल, मैकेनिकल, फिटर, इंस्ट्रूमेंटेशन, वेल्डर)</strong> होनी चाहिए। विशेष जोर ग्रामीण पृष्ठभूमि से आने वाले व्यक्तियों, बेरोजगार युवाओं, महिलाओं, अनुसूचित जाति / अनुसूचित जनजाति के उम्मीदवारों को दिया जाएगा। प्रशिक्षण केंद्र द्वारा प्रशिक्षुओं को <strong data-end=\"1248\" data-start=\"1222\">आवास और भोजन की सुविधा</strong> प्रदान की जाएगी। कोर्स के अंत में उचित मूल्यांकन किया जाएगा और <strong data-end=\"1341\" data-start=\"1312\">ग्रीन जॉब्स स्किल काउंसिल</strong> द्वारा प्रमाण पत्र जारी किए जाएंगे।</p>\r\n\r\n<p data-end=\"1491\" data-start=\"1379\"><strong data-end=\"1387\" data-start=\"1379\">नोट:</strong> उच्च योग्यता जैसे कि किसी भी विषय में डिग्री या उससे अधिक के उम्मीदवार <strong data-end=\"1478\" data-start=\"1459\">कड़ाई से अयोग्य</strong> माने जाएंगे।</p>'),
(197,	'home_about_us_short_desc',	'Testing and Evaluation of Solar Energy Technologies'),
(198,	'home_about_us_short_desc_hi',	NULL),
(199,	'feedback_title',	'Complaints & Feedback'),
(200,	'feedback_description',	'<p>For any queries/information related to testing and Customer Services you may write to: <a href=\"mailto:csc@nise.res.in\">csc@nise.res.in</a> or Feedback/Complaints- Please provide your inputs in the following format:complain-feedback-form</p>'),
(201,	'feedback_title_hi',	'Complaints & Feedback'),
(202,	'feedback_description_hi',	'<p>For any queries/information related to testing and Customer Services you may write to: <a href=\"mailto:csc@nise.res.in\">csc@nise.res.in</a> or Feedback/Complaints- Please provide your inputs in the following format:complain-feedback-form</p>'),
(203,	'feedback_button_title',	'Feedback Form'),
(204,	'feedback_button_link',	'#'),
(205,	'service_title',	'NISE'),
(206,	'service_short_title',	'Testing Services');

DROP TABLE IF EXISTS `district`;
CREATE TABLE `district` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `slug` varchar(255) DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `district` (`id`, `state_id`, `name`, `status`, `slug`, `deleted_at`, `created_at`, `updated_at`) VALUES
(5,	1,	'Srinagar',	1,	'srinagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(6,	1,	'Anantnag',	1,	'anantnag',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(7,	1,	'Baramulla',	1,	'baramulla',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(8,	1,	'Pulwama',	1,	'pulwama',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(9,	1,	'Kupwara',	1,	'kupwara',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(10,	2,	'Shimla',	1,	'shimla',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(11,	2,	'Kangra',	1,	'kangra',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(12,	2,	'Mandi',	1,	'mandi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(13,	2,	'Solan',	1,	'solan',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(14,	2,	'Una',	1,	'una',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(15,	3,	'Ludhiana',	1,	'ludhiana',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(16,	3,	'Amritsar',	1,	'amritsar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(17,	3,	'Jalandhar',	1,	'jalandhar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(18,	3,	'Patiala',	1,	'patiala',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(19,	3,	'Mohali',	1,	'mohali',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(20,	4,	'Chandigarh',	1,	'chandigarh',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(21,	4,	'Sector 17',	1,	'sector-17',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(22,	4,	'Manimajra',	1,	'manimajra',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(23,	4,	'Burail',	1,	'burail',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(24,	4,	'Dhanas',	1,	'dhanas',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(25,	5,	'Dehradun',	1,	'dehradun',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(26,	5,	'Haridwar',	1,	'haridwar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(27,	5,	'Nainital',	1,	'nainital',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(28,	5,	'Udham Singh Nagar',	1,	'udham-singh-nagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(29,	5,	'Pauri Garhwal',	1,	'pauri-garhwal',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(30,	6,	'Gurgaon',	1,	'gurgaon',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(31,	6,	'Faridabad',	1,	'faridabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(32,	6,	'Ambala',	1,	'ambala',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(33,	6,	'Panipat',	1,	'panipat',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(34,	6,	'Hisar',	1,	'hisar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(35,	7,	'North Delhi',	1,	'north-delhi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(36,	7,	'South Delhi',	1,	'south-delhi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(37,	7,	'East Delhi',	1,	'east-delhi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(38,	7,	'West Delhi',	1,	'west-delhi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(39,	7,	'Central Delhi',	1,	'central-delhi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(40,	8,	'Jaipur',	1,	'jaipur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(41,	8,	'Jodhpur',	1,	'jodhpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(42,	8,	'Udaipur',	1,	'udaipur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(43,	8,	'Ajmer',	1,	'ajmer',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(44,	8,	'Kota',	1,	'kota',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(45,	9,	'Lucknow',	1,	'lucknow',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(46,	9,	'Kanpur',	1,	'kanpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(47,	9,	'Varanasi',	1,	'varanasi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(48,	9,	'Allahabad',	1,	'allahabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(49,	9,	'Noida',	1,	'noida',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(50,	10,	'Patna',	1,	'patna',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(51,	10,	'Gaya',	1,	'gaya',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(52,	10,	'Bhagalpur',	1,	'bhagalpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(53,	10,	'Muzaffarpur',	1,	'muzaffarpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(54,	10,	'Darbhanga',	1,	'darbhanga',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(55,	11,	'Gangtok',	1,	'gangtok',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(56,	11,	'Namchi',	1,	'namchi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(57,	11,	'Mangan',	1,	'mangan',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(58,	11,	'Gyalshing',	1,	'gyalshing',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(59,	11,	'Rangpo',	1,	'rangpo',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(60,	12,	'Itanagar',	1,	'itanagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(61,	12,	'Tawang',	1,	'tawang',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(62,	12,	'Pasighat',	1,	'pasighat',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(63,	12,	'Ziro',	1,	'ziro',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(64,	12,	'Bomdila',	1,	'bomdila',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(65,	13,	'Kohima',	1,	'kohima',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(66,	13,	'Dimapur',	1,	'dimapur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(67,	13,	'Mokokchung',	1,	'mokokchung',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(68,	13,	'Wokha',	1,	'wokha',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(69,	13,	'Mon',	1,	'mon',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(70,	14,	'Imphal East',	1,	'imphal-east',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(71,	14,	'Imphal West',	1,	'imphal-west',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(72,	14,	'Thoubal',	1,	'thoubal',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(73,	14,	'Bishnupur',	1,	'bishnupur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(74,	14,	'Churachandpur',	1,	'churachandpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(75,	15,	'Aizawl',	1,	'aizawl',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(76,	15,	'Lunglei',	1,	'lunglei',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(77,	15,	'Champhai',	1,	'champhai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(78,	15,	'Serchhip',	1,	'serchhip',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(79,	15,	'Kolasib',	1,	'kolasib',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(80,	16,	'Agartala',	1,	'agartala',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(81,	16,	'Udaipur',	1,	'udaipur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(82,	16,	'Dharmanagar',	1,	'dharmanagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(83,	16,	'Kailashahar',	1,	'kailashahar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(84,	16,	'Belonia',	1,	'belonia',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(85,	17,	'Shillong',	1,	'shillong',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(86,	17,	'Tura',	1,	'tura',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(87,	17,	'Jowai',	1,	'jowai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(88,	17,	'Nongpoh',	1,	'nongpoh',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(89,	17,	'Williamnagar',	1,	'williamnagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(90,	18,	'Guwahati',	1,	'guwahati',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(91,	18,	'Silchar',	1,	'silchar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(92,	18,	'Dibrugarh',	1,	'dibrugarh',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(93,	18,	'Jorhat',	1,	'jorhat',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(94,	18,	'Tezpur',	1,	'tezpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(95,	19,	'Kolkata',	1,	'kolkata',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(96,	19,	'Howrah',	1,	'howrah',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(97,	19,	'Darjeeling',	1,	'darjeeling',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(98,	19,	'Siliguri',	1,	'siliguri',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(99,	19,	'Durgapur',	1,	'durgapur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(100,	20,	'Ranchi',	1,	'ranchi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(101,	20,	'Jamshedpur',	1,	'jamshedpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(102,	20,	'Dhanbad',	1,	'dhanbad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(103,	20,	'Hazaribagh',	1,	'hazaribagh',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(104,	20,	'Bokaro',	1,	'bokaro',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(105,	21,	'Bhubaneswar',	1,	'bhubaneswar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(106,	21,	'Cuttack',	1,	'cuttack',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(107,	21,	'Puri',	1,	'puri',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(108,	21,	'Rourkela',	1,	'rourkela',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(109,	21,	'Sambalpur',	1,	'sambalpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(110,	22,	'Raipur',	1,	'raipur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(111,	22,	'Bilaspur',	1,	'bilaspur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(112,	22,	'Durg',	1,	'durg',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(113,	22,	'Korba',	1,	'korba',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(114,	22,	'Jagdalpur',	1,	'jagdalpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(115,	23,	'Bhopal',	1,	'bhopal',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(116,	23,	'Indore',	1,	'indore',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(117,	23,	'Gwalior',	1,	'gwalior',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(118,	23,	'Jabalpur',	1,	'jabalpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(119,	23,	'Ujjain',	1,	'ujjain',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(120,	24,	'Ahmedabad',	1,	'ahmedabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(121,	24,	'Surat',	1,	'surat',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(122,	24,	'Vadodara',	1,	'vadodara',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(123,	24,	'Rajkot',	1,	'rajkot',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(124,	24,	'Bhavnagar',	1,	'bhavnagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(125,	25,	'Daman',	1,	'daman',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(126,	25,	'Diu',	1,	'diu',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(127,	25,	'Nani Daman',	1,	'nani-daman',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(128,	25,	'Devka',	1,	'devka',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(129,	25,	'Ghoghola',	1,	'ghoghola',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(130,	26,	'Silvassa',	1,	'silvassa',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(131,	26,	'Khanvel',	1,	'khanvel',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(132,	26,	'Naroli',	1,	'naroli',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(133,	26,	'Rakholi',	1,	'rakholi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(134,	26,	'Samarvarni',	1,	'samarvarni',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(135,	27,	'Mumbai',	1,	'mumbai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(136,	27,	'Pune',	1,	'pune',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(137,	27,	'Nagpur',	1,	'nagpur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(138,	27,	'Nashik',	1,	'nashik',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(139,	27,	'Aurangabad',	1,	'aurangabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(140,	28,	'Visakhapatnam',	1,	'visakhapatnam',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(141,	28,	'Vijayawada',	1,	'vijayawada',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(142,	28,	'Guntur',	1,	'guntur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(143,	28,	'Nellore',	1,	'nellore',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(144,	28,	'Kurnool',	1,	'kurnool',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(145,	29,	'Bengaluru',	1,	'bengaluru',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(146,	29,	'Mysuru',	1,	'mysuru',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(147,	29,	'Mangalore',	1,	'mangalore',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(148,	29,	'Hubli',	1,	'hubli',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(149,	29,	'Belagavi',	1,	'belagavi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(150,	30,	'North Goa',	1,	'north-goa',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(151,	30,	'South Goa',	1,	'south-goa',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(152,	30,	'Panaji',	1,	'panaji',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(153,	30,	'Margao',	1,	'margao',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(154,	30,	'Vasco da Gama',	1,	'vasco-da-gama',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(155,	31,	'Kavaratti',	1,	'kavaratti',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(156,	31,	'Agatti',	1,	'agatti',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(157,	31,	'Minicoy',	1,	'minicoy',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(158,	31,	'Andrott',	1,	'andrott',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(159,	31,	'Kalpeni',	1,	'kalpeni',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(160,	32,	'Thiruvananthapuram',	1,	'thiruvananthapuram',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(161,	32,	'Kochi',	1,	'kochi',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(162,	32,	'Kozhikode',	1,	'kozhikode',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(163,	32,	'Thrissur',	1,	'thrissur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(164,	32,	'Kannur',	1,	'kannur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(165,	33,	'Chennai',	1,	'chennai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(166,	33,	'Coimbatore',	1,	'coimbatore',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(167,	33,	'Madurai',	1,	'madurai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(168,	33,	'Tiruchirappalli',	1,	'tiruchirappalli',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(169,	33,	'Salem',	1,	'salem',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(170,	34,	'Puducherry',	1,	'puducherry',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(171,	34,	'Karaikal',	1,	'karaikal',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(172,	34,	'Mahe',	1,	'mahe',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(173,	34,	'Yanam',	1,	'yanam',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(174,	34,	'Ozhukarai',	1,	'ozhukarai',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(175,	35,	'Port Blair',	1,	'port-blair',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(176,	35,	'Diglipur',	1,	'diglipur',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(177,	35,	'Mayabunder',	1,	'mayabunder',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(178,	35,	'Rangat',	1,	'rangat',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(179,	35,	'Hut Bay',	1,	'hut-bay',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(180,	36,	'Hyderabad',	1,	'hyderabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(181,	36,	'Warangal',	1,	'warangal',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(182,	36,	'Nizamabad',	1,	'nizamabad',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(183,	36,	'Khammam',	1,	'khammam',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(184,	36,	'Karimnagar',	1,	'karimnagar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(185,	37,	'Leh',	1,	'leh',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(186,	37,	'Kargil',	1,	'kargil',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(187,	37,	'Diskit',	1,	'diskit',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(188,	37,	'Nubra',	1,	'nubra',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(189,	37,	'Zanskar',	1,	'zanskar',	NULL,	'2025-09-22 16:35:06',	'2025-09-22 16:35:06'),
(190,	38,	'Test22',	1,	NULL,	NULL,	'2025-09-28 18:56:53',	'2025-09-28 19:02:51');

DROP TABLE IF EXISTS `email_logs`;
CREATE TABLE `email_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slug` varchar(100) DEFAULT NULL,
  `subject` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `from` varchar(100) NOT NULL,
  `to` text NOT NULL,
  `cc` text DEFAULT NULL,
  `bcc` text DEFAULT NULL,
  `sent` tinyint(1) NOT NULL DEFAULT 0,
  `open` tinyint(1) NOT NULL DEFAULT 0,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `email_logs` (`id`, `slug`, `subject`, `description`, `from`, `to`, `cc`, `bcc`, `sent`, `open`, `created`, `modified`) VALUES
(19,	'staff-assigned',	'Staff assigned to your order - #62.',	'<meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<p>Dear Kiran Kumari,</p>\r\n\r\n<p>We are excited to inform you that a staff member has been assigned to your order with the following details:<br />\r\nYour order is scheduled to be delivered at: 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab</p>\r\n\r\n<p><strong>Order Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Order Number:</strong> 62</li>\r\n	<li><strong>Booking Date:</strong> 03-01-2025</li>\r\n	<li><strong>Order Total:</strong>  1373271.90</li>\r\n	<li><strong>Payment Type: </strong>UPI</li>\r\n	<!-- Add more order details as needed -->\r\n</ul>\r\n\r\n<p><strong>Assigned Staff Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Name:</strong> Myles Zulauf</li>\r\n	<li><strong>Email:</strong> your.email+fakedata88731@gmail.com</li>\r\n	<li><strong>Contact Number:</strong> 1971231231</li>\r\n	<!-- Add more staff details as needed -->\r\n</ul>\r\n\r\n<p>If you have any questions or need further assistance, feel free to contact us.</p>\r\n\r\n<p>Thank you for choosing our services!</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin</p>',	'noreply@saloon.com',	'chaudharykiran125@gmail.com',	NULL,	NULL,	0,	0,	'2024-01-24 17:48:49',	'2024-01-24 12:18:49'),
(20,	'order-assigned',	'Order assigned to you  - #62.',	'<meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<title></title>\r\n<p>Dear Myles Zulauf,</p>\r\n\r\n<p>You have been assigned to an order for the following customer:<br />\r\nYour order is scheduled to be delivered at: 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab</p>\r\n\r\n<p><strong>Customer Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Name:</strong> Kiran Kumari</li>\r\n	<li><strong>Email:</strong> chaudharykiran125@gmail.com</li>\r\n	<li><strong>Contact Number:</strong> 08360445579</li>\r\n	<!-- Add more customer details as needed -->\r\n</ul>\r\n\r\n<p><strong>Order Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Order Number:</strong> 62</li>\r\n	<li><strong>Booking Date:</strong> 03-01-2025</li>\r\n	<li><strong>Order Total:</strong>  1373271.90</li>\r\n	<li><strong>Payment Type: </strong>UPI</li>\r\n	<!-- Add more order details as needed -->\r\n</ul>\r\n\r\n<p>If you have any questions or need additional information about this order, please contact the customer directly.</p>\r\n\r\n<p>Thank you for your dedication to providing excellent service!</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin</p>',	'noreply@saloon.com',	'your.email+fakedata88731@gmail.com',	NULL,	NULL,	0,	0,	'2024-01-24 17:48:49',	'2024-01-24 12:18:49'),
(21,	'order-unassigned',	'Order Unassigned - #62',	'<p>Dear Graciela Aufderhar,</p>\r\n\r\n<p>We regret to inform you that order #62 has been unassigned from you. Here are the details:</p>\r\n\r\n<p><strong>Order Number: </strong>62<br />\r\n<strong>Customer Name:</strong> Kiran Kumari<br />\r\n<strong>Customer Email: </strong>chaudharykiran125@gmail.com<br />\r\n<strong>Customer Contact:</strong> 08360445579<br />\r\n<strong>Order Address:</strong> 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab<br />\r\n<strong>Booking Date:</strong> 03-01-2025<br />\r\n<strong>Total Amount: </strong> 1373271.90<br />\r\n<strong>Payment Type:</strong> UPI</p>\r\n\r\n<p>We appreciate your efforts and understanding. If you have any questions or concerns, please feel free to contact us.</p>\r\n\r\n<p>Thank you,<br />\r\nAdmin<br />\r\n&nbsp;</p>',	'noreply@saloon.com',	'your.email+fakedata88731@gmail.com',	NULL,	NULL,	0,	0,	'2024-01-24 17:48:52',	'2024-01-24 12:18:52'),
(22,	'staff-reassigned',	'Staff Reassigned - Order #62',	'<p>Dear Kiran Kumari,</p>\r\n\r\n<p>We want to inform you that the staff member for your order #62 has been reassigned. Here are the updated details:</p>\r\n\r\n<p><strong>Order Number: </strong>62<br />\r\n<strong>New Staff Name:</strong> Graciela Aufderhar<br />\r\n<strong>New Staff Email:</strong> your.email+fakedata22046@gmail.com<br />\r\n<strong>New Staff Contact:</strong> 5423333333<br />\r\n<strong>Order Address:</strong> 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab<br />\r\n<strong>Booking Date:</strong> 03-01-2025<br />\r\n<strong>Total Amount: </strong> 1373271.90<br />\r\n<strong>Payment Type:</strong> UPI</p>\r\n\r\n<p>If you have any questions or concerns regarding this change, please feel free to contact us.</p>\r\n\r\n<p>Thank you for choosing Admin.</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin<br />\r\n&nbsp;</p>',	'noreply@saloon.com',	'chaudharykiran125@gmail.com',	NULL,	NULL,	0,	0,	'2024-01-24 17:48:52',	'2024-01-24 12:18:52'),
(23,	'staff-reassigned',	'Staff Reassigned - Order #62',	'<p>Dear Kiran Kumari,</p>\r\n\r\n<p>We want to inform you that the staff member for your order #62 has been reassigned. Here are the updated details:</p>\r\n\r\n<p><strong>Order Number: </strong>62<br />\r\n<strong>New Staff Name:</strong> Graciela Aufderhar<br />\r\n<strong>New Staff Email:</strong> your.email+fakedata22046@gmail.com<br />\r\n<strong>New Staff Contact:</strong> 5423333333<br />\r\n<strong>Order Address:</strong> 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab<br />\r\n<strong>Booking Date:</strong> 03-01-2025<br />\r\n<strong>Total Amount: </strong> 1373271.90<br />\r\n<strong>Payment Type:</strong> UPI</p>\r\n\r\n<p>If you have any questions or concerns regarding this change, please feel free to contact us.</p>\r\n\r\n<p>Thank you for choosing Admin.</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin<br />\r\n&nbsp;</p>',	'noreply@saloon.com',	'your.email+fakedata22046@gmail.com',	NULL,	NULL,	0,	0,	'2024-01-24 17:48:52',	'2024-01-24 12:18:52'),
(24,	'staff-assigned',	'Staff assigned to your order - #92.',	'<meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<p>Dear Kiran Kumari,</p>\r\n\r\n<p>We are excited to inform you that a staff member has been assigned to your order with the following details:<br />\r\nYour order is scheduled to be delivered at: 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab</p>\r\n\r\n<p><strong>Order Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Order Number:</strong> 92</li>\r\n	<li><strong>Booking Date:</strong> 27-07-2023</li>\r\n	<li><strong>Order Total:</strong>  139645.00</li>\r\n	<li><strong>Payment Type: </strong>Credit/Debit Cards</li>\r\n	<!-- Add more order details as needed -->\r\n</ul>\r\n\r\n<p><strong>Assigned Staff Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Name:</strong> Myles Zulauf</li>\r\n	<li><strong>Email:</strong> your.email+fakedata88731@gmail.com</li>\r\n	<li><strong>Contact Number:</strong> 1971231231</li>\r\n	<!-- Add more staff details as needed -->\r\n</ul>\r\n\r\n<p>If you have any questions or need further assistance, feel free to contact us.</p>\r\n\r\n<p>Thank you for choosing our services!</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin</p>',	'noreply@saloon.com',	'chaudharykiran125@gmail.com',	NULL,	NULL,	0,	0,	'2024-02-07 17:31:39',	'2024-02-07 17:31:39'),
(25,	'order-assigned',	'Order assigned to you  - #92.',	'<meta charset=\"UTF-8\"><meta name=\"viewport\" content=\"width=device-width, initial-scale=1.0\">\r\n<title></title>\r\n<p>Dear Myles Zulauf,</p>\r\n\r\n<p>You have been assigned to an order for the following customer:<br />\r\nYour order is scheduled to be delivered at: 9-F KItclu Nagar,Kitchlu Nagar,Ludhiana,Punjab</p>\r\n\r\n<p><strong>Customer Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Name:</strong> Kiran Kumari</li>\r\n	<li><strong>Email:</strong> chaudharykiran125@gmail.com</li>\r\n	<li><strong>Contact Number:</strong> 08360445579</li>\r\n	<!-- Add more customer details as needed -->\r\n</ul>\r\n\r\n<p><strong>Order Details:</strong></p>\r\n\r\n<ul>\r\n	<li><strong>Order Number:</strong> 92</li>\r\n	<li><strong>Booking Date:</strong> 27-07-2023</li>\r\n	<li><strong>Order Total:</strong>  139645.00</li>\r\n	<li><strong>Payment Type: </strong>Credit/Debit Cards</li>\r\n	<!-- Add more order details as needed -->\r\n</ul>\r\n\r\n<p>If you have any questions or need additional information about this order, please contact the customer directly.</p>\r\n\r\n<p>Thank you for your dedication to providing excellent service!</p>\r\n\r\n<p>Best regards,<br />\r\nAdmin</p>',	'noreply@saloon.com',	'your.email+fakedata88731@gmail.com',	NULL,	NULL,	0,	0,	'2024-02-07 17:31:39',	'2024-02-07 17:31:39'),
(26,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://app.shaguna.in/admin/recover-password/jn5QgS7Xn4jPVfJTLEzwUV0Dzc3kTFm6<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2024-04-01 00:46:00',	'2024-04-01 00:46:00'),
(27,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://app.shaguna.in/admin/recover-password/t3paQ8BslQ4jFucRYfxarFNgAbtDKTwK<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2024-04-01 00:48:26',	'2024-04-01 00:48:26'),
(28,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://app.shaguna.in/admin/recover-password/Jl6XP4Pp2uw3DGT0u0zdSi5gCtVjNUwU<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2024-04-01 00:57:11',	'2024-04-01 00:57:11'),
(29,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://app.shaguna.in/admin/recover-password/xqeMHj9214but0j2LOWh50Q7TnPRN9tY<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 00:59:00',	'2024-03-31 19:29:03'),
(30,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://app.shaguna.in/admin/recover-password/0cxZjnE6zc60mmnTU3vQec4VlNpSBVXV<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 00:59:13',	'2024-03-31 19:29:17'),
(31,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  \nId: *173*\nCustomer Name: *dsdss - 9988225144*\nAddress: *Aaaa, Ludhiana 1111*\nBooking Time: *01-04-2024 | 09:30AM*\nLocations:\nhttps://maps.google.com/maps?q=30.8658435,75.8325634&z=17&hl=en\n----------------------------\no Waxing | Full Body Wax | Honey | *Qty: 1* | *Time: 02:00*</p>\r\n\r\n<p><a href=\"https://app.shaguna.in/order/173/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">https://app.shaguna.in/order/173/view</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 01:14:22',	'2024-03-31 19:44:25'),
(32,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *174*<br />\nCustomer Name: *dsdss - 9988225144*<br />\nAddress: *Aaaa, Ludhiana 1111*<br />\nBooking Time: *01-04-2024 | 09:30AM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.8658368,75.8325572&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Full Body Wax | Honey | *Qty: 1* | *Time: 02:00*</p>\r\n\r\n<p><a href=\"https://app.shaguna.in/order/174/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 01:15:44',	'2024-03-31 19:45:47'),
(33,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *175*<br />\nCustomer Name: *dsdss - 9988225144*<br />\nAddress: *Aaaa, Ludhiana 1111*<br />\nBooking Time: *01-04-2024 | 09:30AM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.8658352,75.8325599&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Full Body Wax | Honey | *Qty: 1* | *Time: 02:00*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/order/175/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 01:18:03',	'2024-03-31 19:48:06'),
(34,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2177*<br />\nCustomer Name: *dsdss - 9988225144*<br />\nAddress: *Aaaa, Ludhiana 1111*<br />\nBooking Time: *01-04-2024 | 09:30AM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.8658361,75.8325648&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Full Body Wax | Honey | *Qty: 1* | *Time: 02:00*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/order/176/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 01:21:28',	'2024-03-31 19:51:32'),
(35,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2178*<br />\nCustomer Name: *dsdss - 9988225144*<br />\nAddress: *Aaaa, Ludhiana 1111*<br />\nBooking Time: *01-04-2024 | 10:00AM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.8658384,75.8325726&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Full legs | Chocolate | *Qty: 2* | *Time: 00:30*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/order/177/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 01:26:12',	'2024-03-31 19:56:15'),
(36,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2179*<br />\nCustomer Name: *Amita verma - 7087373582*<br />\nAddress: *480,sec-9,panchkula, Panchkula 134109*<br />\nBooking Time: *01-04-2024 | 01:30PM*<br />\n<br />\n----------------------------<br />\no Facials | Lotus Radiant pearl facial | *Qty: 1* | *Time: 01:05*<br />\no Waxing | Full Body Wax | Honey | *Qty: 1* | *Time: 02:00*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/178/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 12:37:27',	'2024-04-01 07:07:30'),
(37,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2180*<br />\nCustomer Name: *Amita verma - 7087373582*<br />\nAddress: *480,sec-9,panchkula, Panchkula 134109*<br />\nBooking Time: *01-04-2024 | 03:30PM*<br />\n<br />\n----------------------------<br />\no Facials | Cheryl\'s OxyBlast Facial | *Qty: 1* | *Time: 01:20*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/179/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 14:16:53',	'2024-04-01 08:46:57'),
(38,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2181*<br />\nCustomer Name: *Amita verma - 6239310300*<br />\nAddress: *480,sector-9,panchkula, Panchkula 134109*<br />\nBooking Time: *01-04-2024 | 03:30PM*<br />\n<br />\n----------------------------<br />\no Facials | Cheryl\'s OxyBlast Facial | *Qty: 1* | *Time: 01:20*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/180/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 14:52:51',	'2024-04-01 09:22:54'),
(39,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2182*<br />\nCustomer Name: *Meenakshi - 6239310300*<br />\nAddress: *480,sector-9,panchkula, Panchkula 134109*<br />\nBooking Time: *02-04-2024 | 01:00PM*<br />\n<br />\n----------------------------<br />\no De-tan | Full Arms | *Qty: 1* | *Time: 00:30*<br />\no De-tan | Face and Neck | *Qty: 1* | *Time: 00:25*<br />\no De-tan | Back | *Qty: 1* | *Time: 00:30*<br />\no Facials | O3+shine & glow facial | *Qty: 1* | *Time: 01:20*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/181/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 18:47:56',	'2024-04-01 13:17:59'),
(40,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2183*<br />\nCustomer Name: *Meenakshi - 6239310300*<br />\nAddress: *480,sector-9,panchkula, Panchkula 134109*<br />\nBooking Time: *02-04-2024 | 03:30PM*<br />\n<br />\n----------------------------<br />\no Facials | O3+shine & glow facial | *Qty: 1* | *Time: 01:20*<br />\no De-tan | Back | *Qty: 1* | *Time: 00:30*<br />\no De-tan | Face and Neck | *Qty: 1* | *Time: 00:25*<br />\no De-tan | Half Arms | *Qty: 1* | *Time: 00:15*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/182/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-01 19:27:52',	'2024-04-01 13:57:54'),
(41,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2184*<br />\nCustomer Name: *Amita - 9501583011*<br />\nAddress: *480,sector-9, Panchkula 134109*<br />\nBooking Time: *10-04-2024 | 04:30PM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.6957853,76.8437187&z=17&hl=en<br />\n----------------------------<br />\no Facials | Lotus Radiant gold facial | *Qty: 1* | *Time: 01:05*<br />\no Waxing | Underarms | Honey | *Qty: 1* | *Time: 00:08*<br />\no Waxing | Full Body Wax | Chocolate | *Qty: 1* | *Time: 01:45*<br />\no Threading | Chin | *Qty: 1* | *Time: 00:05*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/183/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-10 15:43:57',	'2024-04-10 10:14:01'),
(42,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2185*<br />\nCustomer Name: *Amita - 9501583011*<br />\nAddress: *480,sector-9, Panchkula 134109*<br />\nBooking Time: *10-04-2024 | 05:00PM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.7003392,76.8278528&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Full Body Wax | Honey | *Qty: 2* | *Time: 01:45*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/184/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-10 15:50:05',	'2024-04-10 10:20:08'),
(43,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2186*<br />\nCustomer Name: *Amita - 9501583011*<br />\nAddress: *480,sector-9, Panchkula 134109*<br />\nBooking Time: *11-04-2024 | 05:00PM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.695884447717,76.84366803139&z=17&hl=en<br />\n----------------------------<br />\no Manicure | Change of polish | *Qty: 1* | *Time: 00:10*<br />\no Facials | Raaga Express Facial | *Qty: 1* | *Time: 01:10*<br />\no Threading | Upper lip | *Qty: 1* | *Time: 00:05*<br />\no Threading | Eyebrows | *Qty: 1* | *Time: 00:05*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/185/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-11 15:14:04',	'2024-04-11 09:44:07'),
(44,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2187*<br />\nCustomer Name: *Jhankar - 6239932179*<br />\nAddress: *sector-9, Firs floor, house no. 817, near Nirankari Bhawan, Panchkula 134109*<br />\nBooking Time: *12-04-2024 | 05:00PM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.7396608,76.6640128&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Upper Lip | *Qty: 1* | *Time: 00:05*<br />\no Threading | Eyebrows | *Qty: 1* | *Time: 00:05*<br />\no Bleach | Face and Neck | *Qty: 1* | *Time: 00:25*<br />\no Cleanups | Papaya nourishing cleanup | *Qty: 1* | *Time: 00:40*<br />\no Waxing | Sidelock | *Qty: 1* | *Time: 00:10*<br />\no Waxing | Chin | *Qty: 1* | *Time: 00:05*</p>\r\n\r\n<p><br /><br /><a href=\"https://app.shaguna.in/admin/order/186/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	1,	0,	'2024-04-12 16:01:11',	'2024-04-12 10:31:14'),
(45,	'order-placed',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>A new service assigned to  <br />\nId: *2222*<br />\nCustomer Name: *dsdss - 9988225144*<br />\nAddress: *AAASSS, Panchkula 112233*<br />\nBooking Time: *13-04-2024 | 04:00PM*<br />\nLocations:<br />\nhttps://maps.google.com/maps?q=30.8543488,75.8382592&z=17&hl=en<br />\n----------------------------<br />\no Waxing | Chin | *Qty: 1* | *Time: 00:05*<br />\no Waxing | Sidelock | *Qty: 1* | *Time: 00:10*<br />\no Cleanups | Papaya nourishing cleanup | *Qty: 1* | *Time: 00:40*<br />\no Bleach | Face and Neck | *Qty: 1* | *Time: 00:25*<br />\no Threading | Eyebrows | *Qty: 1* | *Time: 00:05*<br />\no Waxing | Upper Lip | *Qty: 1* | *Time: 00:05*</p>\r\n\r\n<p><br /><br /><a href=\"http://127.0.0.1:8000/admin/order/221/view\" target=\"_blank\" style=\"padding:30px;background:pink;\">View Order</a></p>\r\n\r\n\r\nThanks',	'techlordsinfo@gmail.com',	'amitaverma736@gmail.com',	NULL,	NULL,	0,	0,	'2024-04-13 15:44:57',	'2024-04-13 10:14:57'),
(46,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://pldcomp.ae/admin/recover-password/l84BsoqZOoqSsKd7DzmzpcvnYJCXZpxF<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'admin@laravel.com',	NULL,	NULL,	0,	0,	'2024-10-14 16:59:49',	'2024-10-14 15:59:49'),
(47,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttps://pldcomp.ae/admin/recover-password/ZIOPH3pKcEeqKFNTjag0ALG04dezz28W<br />\r\n<br />\r\nThank you!</p>',	'techlordsinfo@gmail.com',	'admin@laravel.com',	NULL,	NULL,	0,	0,	'2024-10-14 17:00:27',	'2024-10-14 16:00:27'),
(48,	'admin-registration',	'Admin Registration Successful.',	'<p>Dear Regan&nbsp;Cain<br />\r\n<br />\r\nYou account has been registered on Grievances. Please use the below credentails for login.<br />\r\n<br />\r\n<a href=\"http://127.0.0.1:8000/admin\" target=\"_blank\">http://127.0.0.1:8000/admin</a><br />\r\nEmail: howigo@mailinator.com<br />\r\nPassword: PgriIwrKTMlFBSpDyiv5<br />\r\n<br />\r\nThanks</p>',	'test@rnzaj60.serv00.net',	'howigo@mailinator.com',	NULL,	NULL,	0,	0,	'2024-12-18 22:55:59',	'2024-12-18 17:25:59'),
(49,	'admin-registration',	'Admin Registration Successful.',	'<p>Dear William&nbsp;Whitney<br />\r\n<br />\r\nYou account has been registered on Grievances. Please use the below credentails for login.<br />\r\n<br />\r\n<a href=\"http://127.0.0.1:8000/admin\" target=\"_blank\">http://127.0.0.1:8000/admin</a><br />\r\nEmail: guje@mailinator.com<br />\r\nPassword: AQm3CbrEzA38jdFBiNmG<br />\r\n<br />\r\nThanks</p>',	'test@rnzaj60.serv00.net',	'guje@mailinator.com',	NULL,	NULL,	0,	0,	'2024-12-18 22:56:52',	'2024-12-18 17:26:52'),
(50,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttp://grievance.nise.res.in/admin/recover-password/2qq5PiWNt5ziM94tvT89bifAjS0QY4a1<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2025-06-02 22:30:20',	'2025-06-02 22:30:20'),
(51,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttp://grievance.nise.res.in/admin/recover-password/UYbFbX7Bs4UmJQu4cPgMiiGviwF0ldIv<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2025-06-02 22:38:35',	'2025-06-02 22:38:35'),
(52,	'admin-forgot-password',	'Forgot Password',	'<p>Dear Super&nbsp;Admin,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\nhttp://grievance.nise.res.in/admin/recover-password/ZZhRAdXPOQMzsbDxZKzkrWe9VQ3ihRJa<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'vermani.ritish@gmail.com',	NULL,	NULL,	0,	0,	'2025-06-02 22:45:30',	'2025-06-02 22:45:30'),
(53,	'send_credentials',	'Send Credentials',	'<p>Dear Customer,<br />\r\n<br />\r\nPlease use the below credentails for login.</p>\r\n\r\n<p>Link:<br />\r\nEmail: woxixijo@mailinator.com<br />\r\nPassword: 1111111111<br />\r\n<br />\r\nThanks</p>',	'niseitdesk@gmail.com',	'woxixijo@mailinator.com',	NULL,	NULL,	0,	0,	'2025-07-19 15:02:50',	'2025-07-19 09:32:50'),
(54,	'user-forgot-password',	'Forgot Password',	'<p>Dear Manav&nbsp;,<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n572523\r\n<br />\r\n{recovery_link}<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'manav@nise.com',	NULL,	NULL,	0,	0,	'2025-07-19 15:42:30',	'2025-07-19 10:12:30'),
(55,	'user-forgot-password',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n679840\r\n<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'manav@nise.com',	NULL,	NULL,	0,	0,	'2025-07-19 15:49:12',	'2025-07-19 10:19:12'),
(56,	'user-forgot-password',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n041428\r\n<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'manav@nise.com',	NULL,	NULL,	0,	0,	'2025-07-19 15:51:25',	'2025-07-19 10:21:25'),
(57,	'user-forgot-password',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n200638\r\n<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'manav@nise.com',	NULL,	NULL,	0,	0,	'2025-07-19 15:53:46',	'2025-07-19 10:23:46'),
(58,	'user-forgot-password',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n975352\r\n<br />\r\n<br />\r\nThank you!</p>',	'niseitdesk@gmail.com',	'woxixijo@mailinator.com',	NULL,	NULL,	0,	0,	'2025-07-19 17:40:13',	'2025-07-19 12:10:13');

DROP TABLE IF EXISTS `email_templates`;
CREATE TABLE `email_templates` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `type` enum('admin','client') DEFAULT NULL,
  `subject` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `short_codes` tinytext DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `email_templates` (`id`, `title`, `slug`, `type`, `subject`, `description`, `short_codes`, `created`, `modified`) VALUES
(1,	'Admin Registration',	'admin-registration',	'admin',	'Admin Registration Successful.',	'<p>Dear {first_name}&nbsp;{last_name}<br />\r\n<br />\r\nYou account has been registered on {company_name}. Please use the below credentails for login.<br />\r\n<br />\r\n{admin_link}<br />\r\nEmail: {email}<br />\r\nPassword: {password}<br />\r\n<br />\r\nThanks</p>',	'{first_name},{last_name},{email},{password},{admin_link},{company_name}',	'2021-03-01 12:18:13',	'2021-03-01 02:44:27'),
(2,	'Forgot Password',	'admin-forgot-password',	'admin',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n{recovery_link}<br />\r\n<br />\r\nThank you!</p>',	'{first_name},{last_name},{email},{recovery_link},{admin_link},{company_name}',	'2021-03-01 12:18:09',	'2023-07-31 21:05:55'),
(3,	'Admin Second Auth OTP',	'admin-second-auth-otp',	'admin',	'Your one time password for {company_name}',	'<p>Dear {first_name}&nbsp;{last_name}<br />\r\n<br />\r\nYour account one time password for login is <strong>{one_time_password}</strong>\r\n<br />\r\nThanks</p>',	'{first_name},{last_name},{one_time_password},{company_name}',	'2021-03-01 12:18:13',	'2021-03-01 02:44:27'),
(4,	'Send Credentials',	'send_credentials',	'client',	'Send Credentials',	'<p>Dear Customer,<br />\r\n<br />\r\nPlease use the below credentails for login.</p>\r\n\r\n<p>Link:<br />\r\nEmail: {email}<br />\r\nPassword: {password}<br />\r\n<br />\r\nThanks</p>',	'{name},{email},{password}',	'2021-03-01 12:18:13',	'2024-04-01 01:00:42'),
(5,	'New Order Placed {order_id}',	'order-placed',	'admin',	'Send Credentials',	'<p>Hi</p>\r\n\r\n<p>A new order has been placed. Below are the order details</p>\r\n\r\n<p>{order_information}</p>\r\n\r\n<p>{order_button}</p>\r\n\r\n\r\nThanks',	'{order_id},{order_information},{order_button}',	'2024-03-31 19:34:54',	'2024-03-31 19:34:54'),
(6,	'Admin Registration',	'admin-registration',	'admin',	'Admin Registration Successful.',	'<p>Dear {first_name}&nbsp;{last_name}<br />\r\n<br />\r\nYou account has been registered on {company_name}. Please use the below credentails for login.<br />\r\n<br />\r\n{admin_link}<br />\r\nEmail: {email}<br />\r\nPassword: {password}<br />\r\n<br />\r\nThanks</p>',	'{first_name},{last_name},{email},{password},{admin_link},{company_name}',	'2021-03-01 12:18:13',	'2021-03-01 02:44:27'),
(7,	'Forgot Password',	'user-forgot-password',	'client',	'Forgot Password',	'<p>Dear {first_name}&nbsp;{last_name},<br />\r\n<br />\r\nPlease click on below link to reset your account password.<br />\r\n<br />\r\n{otp}\r\n<br />\r\n<br />\r\nThank you!</p>',	'{name},{email},{otp}',	'2021-03-01 12:18:09',	'2023-07-31 21:05:55');

DROP TABLE IF EXISTS `footer_menu`;
CREATE TABLE `footer_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `footer_menu` (`id`, `key`, `value`) VALUES
(1,	'Home',	'https://www.facebook.com/'),
(2,	'About us',	'https://www.facebook.com/fhdhf');

DROP TABLE IF EXISTS `gallery`;
CREATE TABLE `gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `created_by` (`created_by`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `gallery` (`id`, `title`, `title_hi`, `image`, `status`, `created_by`, `deleted_at`, `created`, `modified`) VALUES
(1,	'Test',	'Pest',	'[\"/uploads/gallery/17569200961409-screenshot-10.png\",\"/uploads/gallery/17544959857965-logo-1.png\"]',	1,	7,	NULL,	'2025-08-06 21:29:50',	'2025-09-03 17:21:41'),
(2,	'Test 2',	'Test 2',	'[\"/uploads/gallery/17569199445559-screenshot-11.png\"]',	1,	7,	NULL,	'2025-09-03 22:49:10',	'2025-09-03 17:19:10');

DROP TABLE IF EXISTS `header_ads`;
CREATE TABLE `header_ads` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `url_link` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `is_new` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `header_ads_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `header_ads` (`id`, `title`, `title_hi`, `url_link`, `slug`, `status`, `is_new`, `created_by`, `created`, `modified`) VALUES
(1,	'Corrigendum for Expression of Interest (EOI) of Suryamitra Skill Development Program for FY 2021-22',	'सूर्यमित्र कौशल विकास कार्यक्रम के लिए अभिरुचि अभिव्यक्ति (EOI) हेतु संशोधन, वित्तीय वर्ष 2021-22',	NULL,	'corrigendum-for-expression-of-interest-eoi-of-suryamitra-skill-development-program-for-fy-2021-22-K90y32',	1,	1,	7,	'2025-08-14 07:16:13',	'2025-08-14 02:00:53'),
(2,	'Expression of Interest (EOI) of Suryamitra Skill Development Program for FY 2021-22',	'सूर्यमित्र कौशल विकास कार्यक्रम के लिए अभिरुचि अभिव्यक्ति (EOI), वित्तीय वर्ष 2021-22',	NULL,	'expression-of-interest-eoi-of-suryamitra-skill-development-program-for-fy-2021-22-YWYqWR',	1,	1,	7,	'2025-08-14 07:17:23',	'2025-08-14 01:47:23'),
(3,	'AEBAS Onboarding Form',	'एईबीएएस ऑनबोर्डिंग फॉर्म',	NULL,	'aebas-onboarding-form-l9ZeLx',	1,	1,	7,	'2025-08-14 07:18:19',	'2025-08-14 01:48:19'),
(4,	'Corrigendum of EOI for empanement of TPs in Suryamitra Skill Development Programme for FY 2020-21',	'सूर्यमित्र कौशल विकास कार्यक्रम के लिए वित्तीय वर्ष 2020-21 में प्रशिक्षण प्रदाताओं (TPs) के पैनल में शामिल करने हेतु ईओआई (EOI) का संशोधन',	NULL,	'corrigendum-of-eoi-for-empanement-of-tps-in-suryamitra-skill-development-programme-for-fy-2020-21-79qJ3N',	1,	1,	7,	'2025-08-14 07:19:20',	'2025-08-14 01:49:21'),
(5,	'Circular regarding increase in course fee for Suryamitra programmes in FY 2019-20',	'वित्तीय वर्ष 2019-20 में सूर्यमित्र कार्यक्रमों के लिए पाठ्यक्रम शुल्क में वृद्धि संबंधी परिपत्र',	'abc.com',	'circular-regarding-increase-in-course-fee-for-suryamitra-programmes-in-fy-2019-20-lLO09o',	1,	0,	7,	'2025-08-14 07:20:25',	'2025-09-02 17:31:45');

DROP TABLE IF EXISTS `header_menu`;
CREATE TABLE `header_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `header_menu` (`id`, `key`, `value`) VALUES
(1,	'Our Company',	'https://www.facebook.com/'),
(5,	'Our Services',	'https://www.facebook.com/');

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `slug` text NOT NULL,
  `mega_menu` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu` (`id`, `key`, `value`, `slug`, `mega_menu`) VALUES
(85,	'About Us',	'http://127.0.0.1:8000/about-us',	'header',	'[]'),
(86,	'News & Events',	'http://127.0.0.1:8000/news-events',	'header',	'[]'),
(87,	'Gallery',	'#',	'header',	'[{\"title\":\"Photo Galary\",\"title_hi\":null,\"link\":\"http:\\/\\/127.0.0.1:8000\\/gallery\"},{\"title\":\"Video Galary\",\"title_hi\":null,\"link\":\"http:\\/\\/127.0.0.1:8000\\/video-gallery\"}]'),
(88,	'EOI Enrollment',	'http://127.0.0.1:8000/mobile-form',	'header',	'[]'),
(89,	'Partner Login',	'http://127.0.0.1:8000/partner-login',	'header',	'[]'),
(90,	'Contact',	'http://127.0.0.1:8000/contact-us',	'header',	'[]'),
(91,	'NISE Protals',	'#',	'header',	'[{\"title\":\"NISE\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908\",\"link\":\"https:\\/\\/nise.res.in\\/\"},{\"title\":\"Testing Service Portal\",\"title_hi\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u0923 \\u0938\\u0947\\u0935\\u093e \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/testing.nise.res.in\\/\"},{\"title\":\"Suryamitra Portal\",\"title_hi\":\"\\u0938\\u0942\\u0930\\u094d\\u092f\\u092e\\u093f\\u0924\\u094d\\u0930 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/suryamitra.nise.res.in\\/\"},{\"title\":\"NISE Traning\'s\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u091f\\u094d\\u0930\\u0947\\u0928\\u093f\\u0902\\u0917\",\"link\":\"https:\\/\\/training.nise.res.in\\/\"},{\"title\":\"Solar DCR\",\"title_hi\":\"\\u0908-\\u092a\\u094d\\u0930\\u094b\\u0915\\u094d\\u092f\\u094b\\u0930\\u092e\\u0947\\u0902\\u091f \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/solardcrportal.nise.res.in\\/\"},{\"title\":\"National Manufacturing Portal\",\"title_hi\":\"\\u0930\\u093e\\u0937\\u094d\\u091f\\u094d\\u0930\\u0940\\u092f \\u0935\\u093f\\u0928\\u093f\\u0930\\u094d\\u092e\\u093e\\u0923 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/mnre-pv.nise.res.in\\/home\"},{\"title\":\"NISE Careers\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u0915\\u0930\\u093f\\u092f\\u0930\",\"link\":\"#\"}]'),
(98,	'Photo Galary',	'https://firstsite.in/development/suryamitra/public/gallery',	'courses',	NULL),
(99,	'Video Galary',	'https://firstsite.in/development/suryamitra/public/video-gallery',	'courses',	NULL),
(100,	'News & Events',	'https://firstsite.in/development/suryamitra/public/news-events',	'courses',	NULL),
(101,	'About Us',	'http://127.0.0.1:8000/about-us',	'footer',	NULL),
(102,	'Terms & Conditions',	'http://127.0.0.1:8000/terms-condditions',	'footer',	NULL),
(103,	'Privacy policy',	'http://127.0.0.1:8000/privacy-policy',	'footer',	NULL),
(104,	'Contact Us',	'http://127.0.0.1:8000/contact-us',	'footer',	NULL);

DROP TABLE IF EXISTS `menu_hindi`;
CREATE TABLE `menu_hindi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `key` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  `slug` text NOT NULL,
  `mega_menu` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `menu_hindi` (`id`, `key`, `value`, `slug`, `mega_menu`) VALUES
(1,	'फोटो गैलरी',	'https://firstsite.in/development/suryamitra/public/gallery',	'courses',	NULL),
(2,	'वीडियो गैलरी',	'https://firstsite.in/development/suryamitra/public/video-gallery',	'courses',	NULL),
(3,	'समाचार एवं कार्यक्रम',	'https://firstsite.in/development/suryamitra/public/news-events',	'courses',	NULL),
(60,	'हमारे बारे में',	'https://firstsite.in/development/suryamitra/public/about-us',	'footer',	NULL),
(61,	'नियम और शर्तें',	'https://firstsite.in/development/suryamitra/public/terms-condditions',	'footer',	NULL),
(62,	'गोपनीयता नीति',	'https://firstsite.in/development/suryamitra/public/privacy-policy',	'footer',	NULL),
(63,	'हमसे संपर्क करें',	'https://firstsite.in/development/suryamitra/public/contact-us',	'footer',	NULL),
(85,	'हमारे बारे में',	'https://firstsite.in/development/suryamitra/public/about-us',	'header',	'[]'),
(86,	'समाचार और आयोजन',	'https://firstsite.in/development/suryamitra/public/news-events',	'header',	'[]'),
(87,	'चित्रशाला',	'#',	'header',	'[{\"title\":\"Photo Galary\",\"title_hi\":\"चित्र गैलरी\",\"link\":\"http:\\/\\/firstsite.in/development/suryamitra/public\\/gallery\"},{\"title\":\"Video Galary\",\"title_hi\":\"वीडियो गैलरी\",\"link\":\"http:\\/\\/firstsite.in/development/suryamitra/public\\/video-gallery\"}]'),
(88,	'EOI नामांकन',	'https://firstsite.in/development/suryamitra/public/mobile-form',	'header',	'[]'),
(89,	'साझेदार लॉगिन',	'#',	'header',	'[]'),
(90,	'संपर्क',	'https://firstsite.in/development/suryamitra/public/contact-us',	'header',	'[]'),
(91,	'एनआईएसई पोर्टल',	'#',	'header',	'[{\"title\":\"NISE\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908\",\"link\":\"https:\\/\\/nise.res.in\\/\"},{\"title\":\"Testing Service Portal\",\"title_hi\":\"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u0923 \\u0938\\u0947\\u0935\\u093e \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/testing.nise.res.in\\/\"},{\"title\":\"Suryamitra Portal\",\"title_hi\":\"\\u0938\\u0942\\u0930\\u094d\\u092f\\u092e\\u093f\\u0924\\u094d\\u0930 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/suryamitra.nise.res.in\\/\"},{\"title\":\"NISE Traning\'s\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u091f\\u094d\\u0930\\u0947\\u0928\\u093f\\u0902\\u0917\",\"link\":\"https:\\/\\/training.nise.res.in\\/\"},{\"title\":\"Solar DCR\",\"title_hi\":\"\\u0908-\\u092a\\u094d\\u0930\\u094b\\u0915\\u094d\\u092f\\u094b\\u0930\\u092e\\u0947\\u0902\\u091f \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/solardcrportal.nise.res.in\\/\"},{\"title\":\"National Manufacturing Portal\",\"title_hi\":\"\\u0930\\u093e\\u0937\\u094d\\u091f\\u094d\\u0930\\u0940\\u092f \\u0935\\u093f\\u0928\\u093f\\u0930\\u094d\\u092e\\u093e\\u0923 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932\",\"link\":\"https:\\/\\/mnre-pv.nise.res.in\\/home\"},{\"title\":\"NISE Careers\",\"title_hi\":\"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u0915\\u0930\\u093f\\u092f\\u0930\",\"link\":\"#\"}]');

DROP TABLE IF EXISTS `news_events`;
CREATE TABLE `news_events` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `file_type` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `pdf_file` longtext DEFAULT NULL,
  `date` date DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_title_hi` varchar(255) DEFAULT NULL,
  `meta_description` longtext DEFAULT NULL,
  `meta_description_hi` longtext DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_keywords_hi` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `is_new` tinyint(1) DEFAULT 0,
  `created_by` int(11) DEFAULT 1,
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `news_events_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `news_events` (`id`, `type`, `title`, `title_hi`, `file_type`, `description`, `description_hi`, `url`, `pdf_file`, `date`, `meta_title`, `meta_title_hi`, `meta_description`, `meta_description_hi`, `meta_keywords`, `meta_keywords_hi`, `status`, `is_new`, `created_by`, `deleted_at`, `created`, `modified`) VALUES
(3,	'News',	'Navigating Changing Federal Priorities for STEM, Public Engagement, and Education',	'एसटीईएम, जन भागीदारी और शिक्षा के लिए बदलती संघीय प्राथमिकताओं का मार्गदर्शन',	'content',	'<p><strong>Navigating Changing Federal Priorities for STEM, Public Engagement, and Education</strong></p>\r\n\r\n<figure role=\"group\">\r\n<p><img alt=\"Navigating person holding a map looking at mountain clouds \" height=\"199\" loading=\"lazy\" src=\"https://www.nisenet.org/sites/default/files/styles/300_width_scale/public/2025-02/navigating_person_holding_a_map_looking_at_mountain_clouds_photo_by_ali_elliot_on_unsplash_ali-elliott-_ph4skrfgyy-unsplash.jpg?itok=nPE6bWG9\" width=\"300\" /></p>\r\n\r\n<figcaption>Photo by Ali Elliott&nbsp;on Unsplash</figcaption>\r\n</figure>\r\n\r\n<p>Many federal programs have undergone significant transitions as federal agencies align with the priorities of the new federal administration. These changes have already led to major reductions in ongoing scientific research, public engagement in STEM, and educational programs. In addition to federal staff reductions, there have been sudden terminations of existing awarded grants and the &ldquo;archiving&rdquo; of active solicitations.&nbsp;</p>\r\n\r\n<p>Congress is spending much of the summer determining&nbsp;FY26 appropriations bills funding federal agencies and programs. When contacting legislators, good advice is to make your message memorable by sharing a story and talk about an aspect of your life or community that is better because of federal funding or some aspect that is at risk due to cuts.<br />\r\n<br />\r\nYou may find the the following resources helpful as you are adapting to rapid changes and uncertainty related to federal administration priorities:</p>',	'<p data-end=\"132\" data-start=\"50\"><strong data-end=\"130\" data-start=\"50\">एसटीईएम, जन भागीदारी और शिक्षा के लिए बदलती संघीय प्राथमिकताओं का मार्गदर्शन</strong></p>\r\n\r\n<p data-end=\"240\" data-start=\"134\"><strong data-end=\"148\" data-start=\"134\">मार्गदर्शन</strong> &mdash; एक व्यक्ति नक्शा पकड़े पहाड़ों और बादलों की ओर देख रहा है<br data-end=\"211\" data-start=\"208\" />\r\n(फोटो: अली एलियट, Unsplash)</p>\r\n\r\n<p data-end=\"642\" data-start=\"242\">कई संघीय कार्यक्रमों में बड़े बदलाव हुए हैं क्योंकि संघीय एजेंसियां नई संघीय प्रशासन की प्राथमिकताओं के अनुरूप हो रही हैं। इन बदलावों के कारण पहले से चल रहे वैज्ञानिक अनुसंधान, एसटीईएम में जन भागीदारी और शैक्षणिक कार्यक्रमों में भारी कटौती हुई है। संघीय कर्मचारियों की संख्या में कमी के अलावा, पहले से स्वीकृत अनुदानों को अचानक समाप्त कर दिया गया है और सक्रिय आमंत्रणों को &ldquo;आर्काइव&rdquo; कर दिया गया है।</p>\r\n\r\n<p data-end=\"1010\" data-start=\"644\">कांग्रेस गर्मियों का अधिकांश समय FY26 आवंटन विधेयकों के जरिए संघीय एजेंसियों और कार्यक्रमों के लिए धनराशि तय करने में बिता रही है। विधायकों से संपर्क करते समय, अच्छा सुझाव यह है कि अपनी बात को यादगार बनाएं &mdash; एक कहानी साझा करें और अपने जीवन या समुदाय के उस पहलू के बारे में बात करें जो संघीय वित्त पोषण के कारण बेहतर हुआ है, या वह पहलू जो कटौती के कारण खतरे में है।</p>\r\n\r\n<p data-end=\"1153\" data-start=\"1012\">आपको निम्नलिखित संसाधन उपयोगी लग सकते हैं जब आप संघीय प्रशासन की प्राथमिकताओं से संबंधित तेज़ बदलावों और अनिश्चितताओं के अनुकूल हो रहे हों:</p>',	NULL,	NULL,	'2025-08-11',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	0,	7,	NULL,	'2025-08-11 19:35:19',	'2025-08-15 02:12:06'),
(6,	'News',	'Minus consequatur e',	'Dolor aliquid tempor',	'pdf',	NULL,	NULL,	'https://www.mutyhaqig.cc',	'/uploads/news_events/17552230114368-ack605506880070825.bin',	'2000-07-22',	'Aut amet explicabo',	'Ipsam quas ut porro',	'Sunt nulla aute lab',	'Ut iste rem quisquam',	'Deserunt consectetur',	'Officia iure ut odit',	1,	0,	7,	NULL,	'2025-08-15 07:26:55',	'2025-08-15 01:56:55'),
(7,	'News',	'Voluptas esse enim e',	'Amet optio iure co',	'pdf',	NULL,	NULL,	NULL,	'/uploads/news_events/17552230951932-the-react-roadmap-for-web-developers.png',	'1987-02-22',	'Magna deleniti in re',	'Ullamco ea et dolore',	'Necessitatibus iure',	'Et labore deserunt l',	'Sed mollitia beatae',	'Ipsa ducimus enim',	1,	0,	7,	NULL,	'2025-08-15 07:28:26',	'2025-08-15 01:58:26'),
(8,	'Events',	'Autem voluptatem vol',	'Velit praesentium q',	'pdf',	NULL,	NULL,	NULL,	'/uploads/news_events/17568350302274-file-sample-150kb.pdf',	'2002-06-28',	'Voluptatem non aut a',	'Possimus quis sequi',	'<p>Voluptatem nisi amet</p>',	'Labore est ut porro',	'Duis ipsam dolor vol',	'Quia ut esse volupta',	1,	0,	7,	NULL,	'2025-08-15 07:31:36',	'2025-09-02 17:43:56'),
(9,	'News',	'Test',	'dfdfddfdfdf',	'url',	NULL,	'<p>fdfd</p>',	'https://www.youtube.com/watch?v=chx9Rs41W6g&t=38152s',	'/uploads/news_events/1756830558491-file-sample-150kb.pdf',	'2025-09-02',	'dffd',	NULL,	'<p>dfd</p>',	NULL,	'dfdfd',	NULL,	1,	0,	7,	NULL,	'2025-09-02 21:59:40',	'2025-09-20 10:43:33'),
(10,	'Events',	'Rerum reiciendis sed',	'Repudiandae dolore i',	'url',	NULL,	NULL,	'https://www.feny.co',	NULL,	'1985-03-11',	'Est nesciunt quisqu',	'Sequi aut consectetu',	'Qui libero veritatis',	'Et repudiandae lauda',	'Sunt laudantium omn',	'Doloribus quam magna',	1,	0,	7,	NULL,	'2025-09-04 22:29:55',	'2025-09-04 16:59:55'),
(11,	'Events',	'Anim esse dolores o',	'Sit eveniet volupta',	'content',	'<p>test</p>',	NULL,	'https://suryamitra.nise.res.in/uploads/gallery/notice/a7f8989cdbcac45033fb3977051d2be5.pdf',	NULL,	'2025-09-04',	'Quibusdam officia ex',	'Distinctio Autem qu',	'<p>Laboris perferendis</p>',	'Velit eu temporibus',	'Dignissimos pariatur',	'Expedita mollitia do',	1,	1,	7,	NULL,	'2025-09-04 22:30:36',	'2025-09-08 16:38:06');

DROP TABLE IF EXISTS `notices`;
CREATE TABLE `notices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` longtext DEFAULT NULL,
  `description_hi` longtext DEFAULT NULL,
  `button_title` varchar(255) DEFAULT NULL,
  `url` longtext DEFAULT NULL,
  `status` tinyint(1) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `notices_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `notices` (`id`, `title`, `title_hi`, `slug`, `description`, `description_hi`, `button_title`, `url`, `status`, `created_by`, `created`, `modified`) VALUES
(8,	'Testing of Inverters',	'Testing of Inverters',	NULL,	'Performance evaluation testing of Solar PV Power Conditioning Unit as per the IEC 61683Up to 50KVA only. Testing of Conditioning Unit is two month from the date of submission.',	NULL,	'Know More',	'#',	1,	7,	'2025-10-02 12:25:38',	'2025-10-02 06:55:38'),
(9,	'Testing of Batteries',	'Testing of Batteries',	NULL,	'Nise offers performance evaluation and characterization facilities of different types of secondary batteries as per IS 1651. IS 13369, IS 15549, and IEC 61427.',	NULL,	'Know More',	'#',	1,	7,	'2025-10-02 12:26:21',	'2025-10-02 06:56:21'),
(10,	'Testing of Solar Pumps',	'Testing of Solar Pumps',	NULL,	'National Institute of Solar Energy, a renowned institute, have a SPV water pumping testing facility for testing, performance evaluation as well as certifying of different types of SPV water pumps and its components as per the guidelines provided by Ministry of new and renewable...',	NULL,	'Know More',	'#',	1,	7,	'2025-10-02 12:26:53',	'2025-10-02 06:56:53'),
(11,	'Testing of Solar Lighting Systems',	'Testing of Solar Lighting Systems',	NULL,	'The SPV Light testing lab, at NISE is equipped with different test facilities for the performance evaluation of the solar lighting tttproducts ranging from Solar lantern, Solar home lighting system, Solar street lighting system, Solar Task light, Solar study lamp, and Solar Torch etc...',	NULL,	'Read More',	'#',	1,	7,	'2025-10-02 12:27:24',	'2025-10-02 06:57:24'),
(12,	'Testing of Solar Thermal Systems',	'Testing of Solar Thermal Systems',	NULL,	'National Institute of Solar Energy, (NISE) has setup state-of-art of test facility for CSTs under UNDP-GEF CSH project on “Market Development and Promotion of solar Concentrated based process Heat Application in India” to develop...',	NULL,	'Read More',	'#',	1,	7,	'2025-10-02 12:27:58',	'2025-10-02 06:57:58'),
(13,	'Testing and Characterization of Solar Cells, Materials and Thin Films',	'Testing and Characterization of Solar Cells, Materials and Thin Films',	NULL,	'The Advanced Solar Cell Characterization Laboratory (Clean Room) at NISE is equipped with various equipment and facilities for the testing and characterization of solar cells, materials and thin films....',	NULL,	'Read More',	'#',	1,	7,	'2025-10-02 12:28:28',	'2025-10-02 06:58:28');

DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title_hi` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `description_hi` text DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_title_hi` varchar(255) DEFAULT NULL,
  `meta_description` varchar(255) DEFAULT NULL,
  `meta_description_hi` varchar(255) DEFAULT NULL,
  `meta_keywords` varchar(255) DEFAULT NULL,
  `meta_keywords_hi` varchar(255) DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  CONSTRAINT `pages_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `admins` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

INSERT INTO `pages` (`id`, `title`, `title_hi`, `description`, `description_hi`, `slug`, `image`, `meta_title`, `meta_title_hi`, `meta_description`, `meta_description_hi`, `meta_keywords`, `meta_keywords_hi`, `status`, `created_by`, `deleted_at`, `created`, `modified`) VALUES
(6,	'Terms & Conditions',	'',	'<h2>Who we are</h2>\r\n\r\n<p>Our website address is:&nbsp;<a href=\"mailto:info@example.com\">info@example.com</a></p>\r\n\r\n<h2>What personal data we collect and why we collect it</h2>\r\n\r\n<h3>Comments</h3>\r\n\r\n<p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&rsquo;s IP address and browser user agent string to help spam detection.</p>\r\n\r\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\r\n\r\n<h3>Media</h3>\r\n\r\n<p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\r\n\r\n<h3>Cookies</h3>\r\n\r\n<p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\r\n\r\n<p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\r\n\r\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &ldquo;Remember Me&rdquo;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\r\n\r\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\r\n\r\n<h3>Embedded content from other websites</h3>\r\n\r\n<p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\r\n\r\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\r\n\r\n<h2>How long we retain your data</h2>\r\n\r\n<p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\r\n\r\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\r\n\r\n<h2>What rights you have over your data</h2>\r\n\r\n<p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\r\n\r\n<h2>Where we send your data</h2>\r\n\r\n<p>Visitor comments may be checked through an automated spam detection service.</p>',	NULL,	'terms-conditions',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL,	'2024-03-31 14:56:35',	'2024-03-31 09:54:48'),
(7,	'Privacy Policy',	'',	'<h2>Who we are</h2>\r\n\r\n<p>Our website address is:&nbsp;<a href=\"mailto:info@example.com\">info@example.com</a></p>\r\n\r\n<h2>What personal data we collect and why we collect it</h2>\r\n\r\n<h3>Comments</h3>\r\n\r\n<p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&rsquo;s IP address and browser user agent string to help spam detection.</p>\r\n\r\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\r\n\r\n<h3>Media</h3>\r\n\r\n<p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\r\n\r\n<h3>Cookies</h3>\r\n\r\n<p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\r\n\r\n<p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\r\n\r\n<p>When you log in, we will also set up several cookies to save your login information and your screen display choices. Login cookies last for two days, and screen options cookies last for a year. If you select &ldquo;Remember Me&rdquo;, your login will persist for two weeks. If you log out of your account, the login cookies will be removed.</p>\r\n\r\n<p>If you edit or publish an article, an additional cookie will be saved in your browser. This cookie includes no personal data and simply indicates the post ID of the article you just edited. It expires after 1 day.</p>\r\n\r\n<h3>Embedded content from other websites</h3>\r\n\r\n<p>Articles on this site may include embedded content (e.g. videos, images, articles, etc.). Embedded content from other websites behaves in the exact same way as if the visitor has visited the other website.</p>\r\n\r\n<p>These websites may collect data about you, use cookies, embed additional third-party tracking, and monitor your interaction with that embedded content, including tracking your interaction with the embedded content if you have an account and are logged in to that website.</p>\r\n\r\n<h2>How long we retain your data</h2>\r\n\r\n<p>If you leave a comment, the comment and its metadata are retained indefinitely. This is so we can recognize and approve any follow-up comments automatically instead of holding them in a moderation queue.</p>\r\n\r\n<p>For users that register on our website (if any), we also store the personal information they provide in their user profile. All users can see, edit, or delete their personal information at any time (except they cannot change their username). Website administrators can also see and edit that information.</p>\r\n\r\n<h2>What rights you have over your data</h2>\r\n\r\n<p>If you have an account on this site, or have left comments, you can request to receive an exported file of the personal data we hold about you, including any data you have provided to us. You can also request that we erase any personal data we hold about you. This does not include any data we are obliged to keep for administrative, legal, or security purposes.</p>\r\n\r\n<h2>Where we send your data</h2>\r\n\r\n<p>Visitor comments may be checked through an automated spam detection service.</p>',	NULL,	'privacy-policy',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	NULL,	NULL,	'2024-03-31 14:56:35',	'2024-03-31 09:54:48'),
(12,	'Disclaimer',	'अस्वीकरण',	'<h2>What personal data we collect and why we collect it</h2>\r\n\r\n<h3>Comments</h3>\r\n\r\n<p>When visitors leave comments on the site we collect the data shown in the comments form, and also the visitor&rsquo;s IP address and browser user agent string to help spam detection.</p>\r\n\r\n<p>An anonymized string created from your email address (also called a hash) may be provided to the Gravatar service to see if you are using it. The Gravatar service privacy policy is available here: https://automattic.com/privacy/. After approval of your comment, your profile picture is visible to the public in the context of your comment.</p>\r\n\r\n<h3>Media</h3>\r\n\r\n<p>If you upload images to the website, you should avoid uploading images with embedded location data (EXIF GPS) included. Visitors to the website can download and extract any location data from images on the website.</p>\r\n\r\n<h3>Cookies</h3>\r\n\r\n<p>If you leave a comment on our site you may opt-in to saving your name, email address and website in cookies. These are for your convenience so that you do not have to fill in your details again when you leave another comment. These cookies will last for one year.</p>\r\n\r\n<p>If you have an account and you log in to this site, we will set a temporary cookie to determine if your browser accepts cookies. This cookie contains no personal data and is discarded when you close your browser.</p>\r\n\r\n<p>When you log in, we will also set up several cookies to save your login information and your&nbsp;</p>',	'<p>हम कौन सा व्यक्तिगत डेटा एकत्र करते हैं और हम इसे क्यों एकत्र करते हैं<br />\r\nटिप्पणियाँ<br />\r\nजब आगंतुक साइट पर टिप्पणियाँ छोड़ते हैं, तो हम टिप्पणी फ़ॉर्म में दिखाए गए डेटा को एकत्र करते हैं, और स्पैम का पता लगाने में मदद करने के लिए आगंतुक का आईपी पता और ब्राउज़र उपयोगकर्ता एजेंट स्ट्रिंग भी एकत्र करते हैं।</p>\r\n\r\n<p>आपके ईमेल पते (जिसे हैश भी कहा जाता है) से बनाई गई एक अनाम स्ट्रिंग Gravatar सेवा को यह देखने के लिए प्रदान की जा सकती है कि आप इसका उपयोग कर रहे हैं या नहीं। Gravatar सेवा गोपनीयता नीति यहाँ उपलब्ध है: https://automattic.com/privacy/। आपकी टिप्पणी के अनुमोदन के बाद, आपकी प्रोफ़ाइल तस्वीर आपकी टिप्पणी के संदर्भ में जनता को दिखाई देती है।</p>\r\n\r\n<p>मीडिया<br />\r\nयदि आप वेबसाइट पर चित्र अपलोड करते हैं, तो आपको एम्बेडेड स्थान डेटा (EXIF GPS) वाली छवियों को अपलोड करने से बचना चाहिए। वेबसाइट पर आने वाले आगंतुक वेबसाइट पर मौजूद छवियों से कोई भी स्थान डेटा डाउनलोड और निकाल सकते हैं।</p>\r\n\r\n<p>कुकीज़<br />\r\nयदि आप हमारी साइट पर कोई टिप्पणी छोड़ते हैं, तो आप कुकीज़ में अपना नाम, ईमेल पता और वेबसाइट सहेजने का विकल्प चुन सकते हैं। ये आपकी सुविधा के लिए हैं ताकि जब आप कोई अन्य टिप्पणी छोड़ें तो आपको अपना विवरण फिर से न भरना पड़े। ये कुकीज़ एक वर्ष तक चलेंगी।</p>\r\n\r\n<p>यदि आपके पास एक खाता है और आप इस साइट पर लॉग इन करते हैं, तो हम यह निर्धारित करने के लिए एक अस्थायी कुकी सेट करेंगे कि आपका ब्राउज़र कुकीज़ स्वीकार करता है या नहीं। इस कुकी में कोई व्यक्तिगत डेटा नहीं होता है और जब आप अपना ब्राउज़र बंद करते हैं तो इसे हटा दिया जाता है।</p>\r\n\r\n<p>जब आप लॉग इन करते हैं, तो हम आपकी लॉगिन जानकारी और आपकी जानकारी को सहेजने के लिए कई कुकीज़ भी सेट करेंगे।</p>',	'disclaimer',	'/uploads/pages/17460389413705-72064.jpg',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	1,	7,	NULL,	'2025-05-01 00:03:42',	'2025-09-09 16:56:34'),
(13,	'Site Map',	'Site Map',	'<h1>Sitemap &ndash; NISE Suryamitra</h1>\r\n\r\n<ul>\r\n	<li><a href=\"/\">Homepage</a></li>\r\n	<li><a href=\"/about\">About Us</a></li>\r\n	<li><a href=\"/news-events\">News &amp; Events</a></li>\r\n	<li>Gallery\r\n	<ul>\r\n		<li><a href=\"/gallery/photo\">Photo Gallery</a></li>\r\n		<li><a href=\"/gallery/video\">Video Gallery</a></li>\r\n	</ul>\r\n	</li>\r\n	<li><a href=\"/eoi-enrollment\">EOI Enrollment</a></li>\r\n	<li><a href=\"/partner-login\">Partner Login</a></li>\r\n	<li><a href=\"/contact\">Contact</a></li>\r\n	<li>NISE Portals\r\n	<ul>\r\n		<li><a href=\"https://nise.res.in\">NISE</a></li>\r\n		<li><a href=\"#\">Testing Service Portal</a></li>\r\n		<li><a href=\"#\">Suryamitra Portal</a></li>\r\n		<li><a href=\"#\">NISE Training&rsquo;s</a></li>\r\n		<li><a href=\"#\">Solar DCR Portal</a></li>\r\n		<li><a href=\"#\">National Manufacturing Portal</a></li>\r\n		<li><a href=\"#\">NISE Careers</a></li>\r\n	</ul>\r\n	</li>\r\n	<li>Current Notices\r\n	<ul>\r\n		<li><a href=\"#\">Extensions to EOI Submission Date</a></li>\r\n		<li><a href=\"#\">OJT under PM‑SURYAGHAR Scheme</a></li>\r\n		<li><a href=\"#\">List of Empanelled Training Centres (FY 2023‑24 &amp; FY 2024‑25)</a></li>\r\n		<li><a href=\"#\">Guidelines for Suryamitra Programme</a></li>\r\n	</ul>\r\n	</li>\r\n	<li>Quick Links\r\n	<ul>\r\n		<li><a href=\"/terms\">Terms &amp; Conditions</a></li>\r\n		<li><a href=\"/privacy\">Privacy Policy</a></li>\r\n		<li><a href=\"/contact\">Contact Us</a></li>\r\n	</ul>\r\n	</li>\r\n	<li>Footer Links\r\n	<ul>\r\n		<li><a href=\"/disclaimer\">Disclaimer</a></li>\r\n		<li><a href=\"/copyright\">Copyright &amp; Privacy Policy</a></li>\r\n		<li><a href=\"/sitemap\">Site Map</a></li>\r\n	</ul>\r\n	</li>\r\n</ul>',	'<p>Hindi</p>',	'site-map',	NULL,	NULL,	'Nisi sit nesciunt d',	NULL,	'Blanditiis obcaecati',	NULL,	'Eiusmod voluptatem r',	1,	7,	NULL,	'2025-05-01 00:12:19',	'2025-09-10 15:51:50'),
(14,	'Screen Reader Access',	'Screen Reader Access',	'<p>&nbsp;</p>\r\n\r\n<p><strong>The information of the Portal is accessible with different screen readers, such as JAWS, NVDA, SAFA, Supernova and Window-Eyes. Following table lists the information about different screen readers:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>1. Viewing Information in Various File Formats</strong></h2>\r\n\r\n<div class=\"table-responsive\">\r\n<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<th><strong><strong>Screen Reader</strong></strong></th>\r\n			<th><strong><strong>Website</strong></strong></th>\r\n			<th><strong><strong>Free/Commercial</strong></strong></th>\r\n		</tr>\r\n		<tr>\r\n			<td>Screen Access For All (SAFA)</td>\r\n			<td>NA</td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Non Visual Desktop Access (NVDA)</td>\r\n			<td><a aria-label=\"Non Visual Desktop Access (NVDA), External site that opens in a new window\" href=\"http://www.nvda-project.org/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Non Visual Desktop Access (NVDA)\">http://www.nvda-project.org/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>System Access To Go</td>\r\n			<td><a aria-label=\"System Access To Go, External site that opens in a new window\" href=\"http://www.satogo.com/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"System Access To Go\">http://www.satogo.com/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thunder</td>\r\n			<td><a aria-label=\"Thunder, Webbie External site that opens in a new window\" href=\"https://www.webbie.org.uk/thunder/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Thunder\">https://www.webbie.org.uk/thunder/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>WebAnywhere</td>\r\n			<td><a aria-label=\"WebAnywhere, External site that opens in a new window\" href=\"http://webinsight.cs.washington.edu/wa/content.php\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"WebAnywhere\">http://webinsight.cs.washington.edu/wa/content.php</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Hal</td>\r\n			<td><a aria-label=\"Hal, External site that opens in a new window\" href=\"http://www.yourdolphin.co.uk/productdetail.asp?id=5\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Hal\">http://www.yourdolphin.co.uk/productdetail.asp?id=5</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>JAWS</td>\r\n			<td><a aria-label=\"JAWS, External site that opens in a new window\" href=\"http://www.freedomscientific.com/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"JAWS\">http://www.freedomscientific.com/jaws-hq.asp</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Supernova</td>\r\n			<td><a aria-label=\"Supernova, External site that opens in a new window\" href=\"http://www.yourdolphin.co.uk/productdetail.asp?id=1\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Supernova\">http://www.yourdolphin.co.uk/productdetail.asp?id=1</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Window-Eyes</td>\r\n			<td><a aria-label=\"Window Eyes, External site that opens in a new window\" href=\"https://window-eyes.informer.com/7.2/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Window-Eyes\">https://window-eyes.informer.com/7.2/</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>2. Accessibility Help</strong></h2>\r\n\r\n<p>Use the accessibility options provided by this Web site to control the screen display. These options allow increasing the text size and changing the contrast scheme for clear visibility and better readability.</p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>3. Changing the Text Size</strong></h2>\r\n\r\n<p>Changing the size of the text refers to making the text appearing Large or Small from its standard size. There are Three options provided to you to set the size of the text that affect readability. These are:</p>\r\n\r\n<ul class=\"screen-reader-page\">\r\n	<li>Small: Displays information in a font size smaller than the standard font size.</li>\r\n	<li>Medium: Displays information in a standard font size, which is the default size.</li>\r\n	<li>Large: Displays information in a font size larger than the standard font size.</li>\r\n	<li>The website allows you to change the text size by clicking on the text size icons present at the top of each page.</li>\r\n</ul>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>4. Text size Icons</strong></h2>\r\n\r\n<p>Following different options are provided in the form of icons which are available on the top of each page:</p>\r\n\r\n<ul class=\"screen-reader-page\">\r\n	<li>A- : Decrease text size:&nbsp;Allows to decrease the text size.</li>\r\n	<li>A : Normal text size:&nbsp;Allows to set default text size</li>\r\n	<li>A+ : Increase text size:&nbsp;Allows to increase the text size.</li>\r\n</ul>',	'<p>&nbsp;</p>\r\n\r\n<p><strong>The information of the Portal is accessible with different screen readers, such as JAWS, NVDA, SAFA, Supernova and Window-Eyes. Following table lists the information about different screen readers:</strong></p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<h2><strong>1. Viewing Information in Various File Formats</strong></h2>\r\n\r\n<div class=\"table-responsive\">\r\n<table border=\"1\">\r\n	<tbody>\r\n		<tr>\r\n			<th><strong><strong>Screen Reader</strong></strong></th>\r\n			<th><strong><strong>Website</strong></strong></th>\r\n			<th><strong><strong>Free/Commercial</strong></strong></th>\r\n		</tr>\r\n		<tr>\r\n			<td>Screen Access For All (SAFA)</td>\r\n			<td>NA</td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Non Visual Desktop Access (NVDA)</td>\r\n			<td><a aria-label=\"Non Visual Desktop Access (NVDA), External site that opens in a new window\" href=\"http://www.nvda-project.org/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Non Visual Desktop Access (NVDA)\">http://www.nvda-project.org/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>System Access To Go</td>\r\n			<td><a aria-label=\"System Access To Go, External site that opens in a new window\" href=\"http://www.satogo.com/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"System Access To Go\">http://www.satogo.com/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Thunder</td>\r\n			<td><a aria-label=\"Thunder, Webbie External site that opens in a new window\" href=\"https://www.webbie.org.uk/thunder/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Thunder\">https://www.webbie.org.uk/thunder/</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>WebAnywhere</td>\r\n			<td><a aria-label=\"WebAnywhere, External site that opens in a new window\" href=\"http://webinsight.cs.washington.edu/wa/content.php\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"WebAnywhere\">http://webinsight.cs.washington.edu/wa/content.php</a></td>\r\n			<td>Free</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Hal</td>\r\n			<td><a aria-label=\"Hal, External site that opens in a new window\" href=\"http://www.yourdolphin.co.uk/productdetail.asp?id=5\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Hal\">http://www.yourdolphin.co.uk/productdetail.asp?id=5</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>JAWS</td>\r\n			<td><a aria-label=\"JAWS, External site that opens in a new window\" href=\"http://www.freedomscientific.com/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"JAWS\">http://www.freedomscientific.com/jaws-hq.asp</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Supernova</td>\r\n			<td><a aria-label=\"Supernova, External site that opens in a new window\" href=\"http://www.yourdolphin.co.uk/productdetail.asp?id=1\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Supernova\">http://www.yourdolphin.co.uk/productdetail.asp?id=1</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n		<tr>\r\n			<td>Window-Eyes</td>\r\n			<td><a aria-label=\"Window Eyes, External site that opens in a new window\" href=\"https://window-eyes.informer.com/7.2/\" rel=\"noopener noreferrer\" target=\"_blank\" title=\"Window-Eyes\">https://window-eyes.informer.com/7.2/</a></td>\r\n			<td>Commercial</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>2. Accessibility Help</strong></h2>\r\n\r\n<p>Use the accessibility options provided by this Web site to control the screen display. These options allow increasing the text size and changing the contrast scheme for clear visibility and better readability.</p>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>3. Changing the Text Size</strong></h2>\r\n\r\n<p>Changing the size of the text refers to making the text appearing Large or Small from its standard size. There are Three options provided to you to set the size of the text that affect readability. These are:</p>\r\n\r\n<ul class=\"screen-reader-page\">\r\n	<li>Small: Displays information in a font size smaller than the standard font size.</li>\r\n	<li>Medium: Displays information in a standard font size, which is the default size.</li>\r\n	<li>Large: Displays information in a font size larger than the standard font size.</li>\r\n	<li>The website allows you to change the text size by clicking on the text size icons present at the top of each page.</li>\r\n</ul>\r\n\r\n<h2>&nbsp;</h2>\r\n\r\n<h2><strong>4. Text size Icons</strong></h2>\r\n\r\n<p>Following different options are provided in the form of icons which are available on the top of each page:</p>\r\n\r\n<ul class=\"screen-reader-page\">\r\n	<li>A- : Decrease text size:&nbsp;Allows to decrease the text size.</li>\r\n	<li>A : Normal text size:&nbsp;Allows to set default text size</li>\r\n	<li>A+ : Increase text size:&nbsp;Allows to increase the text size.</li>\r\n</ul>',	'sra',	NULL,	'Screen Reader Access',	'Screen Reader Access',	NULL,	NULL,	'Screen Reader Access',	'Screen Reader Access',	1,	7,	NULL,	'2025-05-01 00:24:03',	'2025-09-07 11:10:09');

DROP TABLE IF EXISTS `participants`;
CREATE TABLE `participants` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `full_name` varchar(255) NOT NULL,
  `user_name` varchar(255) DEFAULT NULL,
  `address` text NOT NULL,
  `corresponding_address` text NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `mobile` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `father_name` varchar(255) NOT NULL,
  `mother_name` varchar(255) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `is_physical_handicap` enum('Yes','No') NOT NULL,
  `caste_category` enum('Gen','SC','ST','OBC','Others') NOT NULL,
  `employment_status` enum('Yes','No','Self-Entrepreneur') NOT NULL,
  `qualification` enum('ITA','12TH','Diploma','Graduation','Post Graduation') NOT NULL,
  `organisation_name` varchar(255) NOT NULL,
  `organisation_email` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_phone` varchar(255) NOT NULL,
  `aadhar_number` varchar(20) NOT NULL,
  `emergency_contact` varchar(20) NOT NULL,
  `identity_proof` varchar(255) DEFAULT NULL,
  `candidate_image` varchar(255) DEFAULT NULL,
  `category_proof` varchar(255) DEFAULT NULL,
  `handicap_proof` varchar(255) DEFAULT NULL,
  `highe_education` varchar(255) DEFAULT NULL,
  `salary_slip` varchar(255) DEFAULT NULL,
  `id_proof` varchar(255) DEFAULT NULL,
  `organisation_phone` varchar(255) DEFAULT NULL,
  `academic_session` varchar(15) NOT NULL,
  `center_id` int(11) NOT NULL,
  `batch_id` int(11) NOT NULL,
  `course_duration` int(11) NOT NULL,
  `status` enum('New','Under-Training','Trained') NOT NULL DEFAULT 'New',
  `created_by` int(11) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp(),
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `district_id` (`district_id`),
  CONSTRAINT `participants_ibfk_1` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `participants` (`id`, `full_name`, `user_name`, `address`, `corresponding_address`, `state_id`, `district_id`, `city`, `mobile`, `email`, `date_of_birth`, `father_name`, `mother_name`, `gender`, `is_physical_handicap`, `caste_category`, `employment_status`, `qualification`, `organisation_name`, `organisation_email`, `company_name`, `company_email`, `company_phone`, `aadhar_number`, `emergency_contact`, `identity_proof`, `candidate_image`, `category_proof`, `handicap_proof`, `highe_education`, `salary_slip`, `id_proof`, `organisation_phone`, `academic_session`, `center_id`, `batch_id`, `course_duration`, `status`, `created_by`, `created`, `modified`) VALUES
(16,	'Yvette Jefferson',	'SM-STU-00016',	'Eaque velit elit a',	'Repellendus Porro p',	15,	79,	'Laborum Iure aspern',	'9988855455',	'donuqituz@mailinator.com',	'1990-01-04',	'Marcia Schmidt',	'Risa Phillips',	'Male',	'Yes',	'Gen',	'No',	'Graduation',	'Mosley and Fischer Traders',	'lide@mailinator.com',	'Trevino Prince LLC',	'pyrajizu@mailinator.com',	'5669666565',	'176838476838',	'4554455454',	'1758765664_file-sample_150kB.pdf',	'1758765664_Screenshot (7).png',	'1758765664_file-sample_150kB.pdf',	'1758765664_Screenshot (7).png',	'1758765664_Screenshot (10).png',	'1758765664_Screenshot (7).png',	'1758765664_file-sample_150kB.pdf',	'8885577455',	'2018-2019',	14,	15,	61,	'New',	69,	'2025-09-25 02:01:04',	'2025-09-27 05:16:33'),
(17,	'Melanie Gilbert',	'SM-STU-00017',	'Ullamco nulla est qu',	'Vel veniam et ad ve',	14,	74,	'Fugit quis labore p',	'7878545444',	'rupas@mailinator.com',	'1994-09-30',	'Wesley Moran',	'Evan Trevino',	'Male',	'No',	'ST',	'No',	'Diploma',	'Cohen and Mendez Inc',	'nowet@mailinator.com',	'Charles Clarke Plc',	'topi@mailinator.com',	'6466464646',	'144242354435',	'1867645256',	'1758765809_file-sample_150kB.pdf',	'1758765809_Screenshot (11).png',	'1758765809_file-sample_150kB.pdf',	'1758765809_Screenshot (10).png',	'1758765809_file-sample_150kB.pdf',	'1758765809_Screenshot (10).png',	'1758765809_Screenshot (7).png',	'5444887787',	'2025-2026',	14,	15,	16,	'Under-Training',	69,	'2025-09-25 02:03:29',	'2025-09-27 10:42:14');

DROP TABLE IF EXISTS `permissions`;
CREATE TABLE `permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL,
  `permissions` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `permissions` (`id`, `title`, `type`, `permissions`) VALUES
(1,	'Agents',	'users',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(2,	'Blogs',	'blogs',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(3,	'Blog Categories',	'blog_categories',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(4,	'Constituency',	'constituency',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(5,	'Polling Station',	'pollingstation',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(6,	'Services',	'services',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(7,	'Testimonial',	'testimonial',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(8,	'Contact Us',	'contact_us',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(9,	'About Us',	'about_us',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(10,	'Team',	'teams',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(11,	'Service Category',	'service_categories',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(12,	'Slider Menu',	'slider_menu',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(13,	'Home category',	'home_categories',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(14,	'Home Page',	'home_page',	'{\"listing\":\"0\",\"create\":\"0\",\"update\":\"1\",\"delete\":\"0\"}'),
(15,	'Notices',	'notices',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'),
(16,	'Grievances',	'grievances',	'{\"listing\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\"}'),
(17,	'Grievances Types',	'grievances_types',	'{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `parent_id` int(11) DEFAULT NULL,
  `title` varchar(200) NOT NULL,
  `slug` varchar(200) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `roles` (`id`, `parent_id`, `title`, `slug`) VALUES
(1,	NULL,	'CMU Admin',	'cmuadmin'),
(2,	1,	'Campaign Manager',	'campaignmanager'),
(3,	2,	'Constituency Agent',	'constituencyagent'),
(4,	3,	'Street Agent',	'streetagent');

DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) unsigned DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` text NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('ew33Y8Ox6fo2xATQlqZimk8fNIkW1zMtTjgWYNQr',	NULL,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/131.0.0.0 Safari/537.36',	'YTo2OntzOjY6Il90b2tlbiI7czo0MDoiSWdObnJubE5KY2ZKaFlscGE0VG1VVXZaWEFIWWRIeTZhTlBZYWs3QyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDc6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMC9jYXB0Y2hhL2RlZmF1bHQ/YlBBS2JyMm49Ijt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czo1MjoibG9naW5fYWRtaW5fNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aTo3O3M6NzoiY2FwdGNoYSI7YTozOntzOjk6InNlbnNpdGl2ZSI7YjowO3M6Mzoia2V5IjtzOjYwOiIkMnkkMTAkZUZFbC9Jd1BqTkFnRG1JRklIVVFRZVE5cGVzZ0dYalQ5WXR1MUp5Y29SOEo4Z2N4YWo5L1MiO3M6NzoiZW5jcnlwdCI7YjowO31zOjUxOiJsb2dpbl91c2VyXzU5YmEzNmFkZGMyYjJmOTQwMTU4MGYwMTRjN2Y1OGVhNGUzMDk4OWQiO2k6MzY7fQ==',	1734629229);

DROP TABLE IF EXISTS `settings`;
CREATE TABLE `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `value` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `settings` (`id`, `name`, `value`) VALUES
(1,	'company_name',	'National Institute of Solar Energy'),
(2,	'company_address',	'National Institute of Solar Energy Gwal Pahari,Faridabad Gurugram Road, Gurugram 122003, Haryana.'),
(3,	'pagination_method',	'scroll'),
(4,	'admin_second_auth_factor',	''),
(5,	'admin_notification_email',	'admin@admin.com'),
(6,	'currency_code',	'INR'),
(7,	'currency_symbol',	'₹'),
(8,	'date_format',	'd-m-Y'),
(9,	'time_format',	'h:iA'),
(10,	'tax_percentage',	'10'),
(11,	'order_prefix',	'2001'),
(12,	'from_email',	'niseitdesk@gmail.com'),
(13,	'email_method',	'smtp'),
(14,	'max_orders_per_hour',	'2'),
(15,	'duration',	'[\"09:30\", \"18:00\"]'),
(16,	'cgst',	'9'),
(17,	'sgst',	'9'),
(18,	'igst',	'18'),
(19,	'shaguna_margin',	'1.2'),
(20,	'travel_charges',	'50'),
(21,	'partner_margin',	'4.8'),
(22,	'platform_charges',	'0'),
(23,	'buffer_margin_percent',	'3.7'),
(24,	'buffer_margin_amount',	'0'),
(25,	'shaguna_margin_percent',	'20'),
(26,	'invoice_series',	'50003'),
(27,	'partner_receipt_number',	'43003'),
(28,	'logo',	'/uploads/logos/17593730735491-logonise.png'),
(29,	'favicon',	'/uploads/logos/17550501228167-logo.png'),
(30,	'smtp_host',	''),
(31,	'smtp_encryption',	'ssl'),
(32,	'smtp_port',	'465'),
(33,	'smtp_username',	'niseitdesk@gmail.com'),
(34,	'smtp_email',	'niseitdesk@gmail.com'),
(35,	'sendgrid_email',	''),
(36,	'sendgrid_api_key',	''),
(37,	'smtp_password',	''),
(38,	'one_time_setup_cost',	'15'),
(39,	'banner',	'/uploads/assets/banner.png'),
(40,	'splash_title',	'Get Started'),
(41,	'splash_description',	'In publishing and graphic design, Lorem ipsum is a placeholder text commonly used to '),
(42,	'election_date',	'2024-10-01'),
(43,	'election_date',	'2024-10-01 14:30'),
(44,	'_token',	'HSnXlkgrQhHJPTxrOXSiFhfayIhDmOo98pTFFE58'),
(45,	'company_email',	'suryamitra@nise.res.in  biomatric@nise.res.in'),
(46,	'company_phonenumber',	'0124-2853006 0124-2853015 +91-8368091352'),
(47,	'facebook',	'https://facebook.com'),
(48,	'tiktok',	'https://tiktok.com'),
(49,	'youtube',	'https://youtube.com'),
(50,	'instagram',	'https://instagram.com'),
(51,	'twitter',	'hjvjhv'),
(52,	'gallery',	'[\"/uploads/gallery/17340268989216-2.jpg\",\"/uploads/gallery/1734026894649-1.jpg\",\"/uploads/gallery/17340268904657-notices.jpg\",\"/uploads/gallery/17340268851909-about-main.jpg\"]'),
(53,	'recaptcha_key',	NULL),
(54,	'recaptcha_secret',	NULL),
(55,	'admin_recaptcha',	'');

DROP TABLE IF EXISTS `slider_menu`;
CREATE TABLE `slider_menu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `heading` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_hi` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `button_status` tinyint(4) DEFAULT 1,
  `button_title` varchar(255) DEFAULT NULL,
  `button_link` varchar(255) DEFAULT NULL,
  `heading_hi` varchar(255) DEFAULT NULL,
  `button_title_hi` varchar(255) DEFAULT NULL,
  `button_link_hi` varchar(255) DEFAULT NULL,
  `button_status_hi` tinyint(4) NOT NULL DEFAULT 1,
  `image_hi` text DEFAULT NULL,
  `status_hi` tinyint(4) NOT NULL DEFAULT 1,
  `text1` varchar(255) DEFAULT NULL,
  `text2` varchar(255) DEFAULT NULL,
  `text3` varchar(255) DEFAULT NULL,
  `text4` varchar(255) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `slider_menu` (`id`, `heading`, `title`, `title_hi`, `slug`, `description`, `button_status`, `button_title`, `button_link`, `heading_hi`, `button_title_hi`, `button_link_hi`, `button_status_hi`, `image_hi`, `status_hi`, `text1`, `text2`, `text3`, `text4`, `image`, `status`, `created_by`, `created`, `modified`) VALUES
(12,	'About NISE Testing Services.',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',	'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-sed-do-eiusmod-tempor-incididunt-ut-labore-et-dolore-magna-aliqua-y3zY9A',	'',	1,	'Learn More',	'#',	'About NISE Testing Services.',	'Learn More',	NULL,	1,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	'/uploads/pages/17593793057015-slider1.jpg',	1,	7,	'2024-12-22 13:42:34',	'2025-10-02 04:52:51'),
(13,	'Testing Services',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',	'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.',	'lorem-ipsum-dolor-sit-amet-consectetur-adipiscing-elit-sed-do-eiusmod-tempor-incididunt-ut-labore-et-dolore-magna-aliqua-G9XM3P',	'',	1,	'Learn More',	'#',	'Testing Services',	'Learn More',	'/hi/user/dashboard',	1,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	'/uploads/pages/17593808791597-slider2.jpg',	1,	7,	'2024-12-22 13:44:21',	'2025-10-02 04:57:19');

DROP TABLE IF EXISTS `states`;
CREATE TABLE `states` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `state_code` varchar(50) DEFAULT NULL,
  `latitude` decimal(8,5) DEFAULT NULL,
  `longitude` decimal(8,5) DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `name` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `states` (`id`, `name`, `state_code`, `latitude`, `longitude`, `status`, `created_at`, `updated_at`) VALUES
(3,	'ANDAMAN AND NICOBAR ISLANDS',	'35',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(4,	'ANDHRA PRADESH',	'28',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(5,	'ARUNACHAL PRADESH',	'12',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(6,	'ASSAM',	'18',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(7,	'BIHAR',	'10',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(8,	'CHANDIGARH',	'4',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(9,	'CHHATTISGARH',	'22',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(10,	'DADRA AND NAGAR HAVELI',	'26',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(11,	'DAMAN AND DIU',	'25',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(12,	'DELHI',	'7',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(13,	'GOA',	'30',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(14,	'GUJARAT',	'24',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(15,	'HARYANA',	'6',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(16,	'HIMACHAL PRADESH',	'2',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(17,	'JAMMU AND KASHMIR',	'1',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(18,	'JHARKHAND',	'20',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(19,	'KARNATAKA',	'29',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(20,	'KERALA',	'32',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(21,	'LADAKH UT',	'37',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(22,	'LAKSHADWEEP',	'31',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(23,	'MADHYA PRADESH',	'23',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(24,	'MAHARASHTRA',	'27',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(25,	'MANIPUR',	'14',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(26,	'MEGHALAYA',	'17',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(27,	'MIZORAM',	'15',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(28,	'NAGALAND',	'13',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(29,	'ORISSA',	'21',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(30,	'PUDUCHERRY',	'34',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(31,	'PUNJAB',	'3',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(32,	'RAJASTHAN',	'8',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(33,	'SIKKIM',	'11',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(34,	'TAMIL NADU',	'33',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(35,	'TELANGANA',	'36',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(36,	'TRIPURA',	'16',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(37,	'UTTAR PRADESH',	'9',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(38,	'UTTARAKHAND',	'5',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(39,	'WEST BENGAL',	'19',	NULL,	NULL,	1,	'2025-09-22 16:24:44',	'2025-09-22 16:24:44'),
(40,	'Test',	NULL,	NULL,	NULL,	1,	'2025-09-28 17:38:03',	'2025-09-28 17:38:03');

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `institute_code` varchar(255) DEFAULT NULL,
  `organisation_name` varchar(255) DEFAULT NULL,
  `organisation_file` longtext DEFAULT NULL,
  `pan` varchar(255) DEFAULT NULL,
  `pan_file` longtext DEFAULT NULL,
  `gst` varchar(255) DEFAULT NULL,
  `gst_file` longtext DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  `state_id` bigint(20) unsigned DEFAULT NULL,
  `district_id` int(11) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `mobile_otp` varchar(255) DEFAULT NULL,
  `is_mobile_verified` tinyint(1) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `email_otp` varchar(255) DEFAULT NULL,
  `is_email_verified` tinyint(1) DEFAULT NULL,
  `captcha` varchar(5) DEFAULT NULL,
  `image` text DEFAULT NULL,
  `last_login` datetime DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `token_expiry` datetime DEFAULT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `device_type` varchar(255) DEFAULT NULL,
  `fcm_token` varchar(255) DEFAULT NULL,
  `setup_pin` tinyint(4) DEFAULT 0,
  `gender` enum('male','female','other') DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `verified_at` datetime DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `created_by` (`created_by`),
  KEY `state_id` (`state_id`),
  KEY `district_id` (`district_id`),
  CONSTRAINT `users_ibfk_1` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_ibfk_2` FOREIGN KEY (`district_id`) REFERENCES `district` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users` (`id`, `institute_code`, `organisation_name`, `organisation_file`, `pan`, `pan_file`, `gst`, `gst_file`, `address`, `pin`, `state_id`, `district_id`, `mobile`, `mobile_otp`, `is_mobile_verified`, `email`, `email_otp`, `is_email_verified`, `captcha`, `image`, `last_login`, `token`, `token_expiry`, `device_id`, `device_type`, `fcm_token`, `setup_pin`, `gender`, `status`, `verified_at`, `deleted_at`, `created_by`, `created`, `modified`) VALUES
(69,	'SM-INST-0069',	'R.K Tech',	'uploads/organisation/vmYqtMcKQPsS1WzvvhGBEJvGcFzxZXnLXDFHNcDW.png',	'Gzzpk1266D',	'uploads/pan/MjhxayiUqbjUvux8bTB5WExXQastJrNVzBtUO2yk.png',	'GST1004114432kk',	'uploads/gst/X75E8K8AxxZJ7c0sS8lJmHR61WayDXAgA8LOgWig.png',	'test',	'141008',	31,	156,	'7888584255',	NULL,	1,	'kumarrakesh788858@gmail.com',	NULL,	1,	NULL,	'1758814788_WhatsApp Image 2025-09-10 at 10.14.45 PM.jpeg',	NULL,	NULL,	NULL,	NULL,	NULL,	NULL,	0,	NULL,	1,	NULL,	NULL,	NULL,	NULL,	'2025-09-25 15:39:48');

DROP TABLE IF EXISTS `users_permissions`;
CREATE TABLE `users_permissions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `permission` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `users_permissions` (`id`, `user_id`, `permission`, `status`, `created`) VALUES
(1,	1,	'email_buyer_message',	1,	'2023-12-16 02:56:47'),
(2,	1,	'email_seller_message',	1,	'2023-12-16 02:56:47'),
(3,	1,	'text_buyer_message',	1,	'2023-12-16 02:56:48'),
(4,	1,	'text_seller_message',	1,	'2023-12-16 02:56:48'),
(5,	2,	'email_buyer_message',	1,	'2023-12-25 01:45:15'),
(6,	2,	'email_seller_message',	1,	'2023-12-25 01:45:15'),
(7,	2,	'text_buyer_message',	1,	'2023-12-25 01:45:15'),
(8,	2,	'text_seller_message',	1,	'2023-12-25 01:45:15'),
(9,	3,	'email_buyer_message',	1,	'2024-01-07 11:22:04'),
(10,	3,	'email_seller_message',	1,	'2024-01-07 11:22:04'),
(11,	3,	'text_buyer_message',	1,	'2024-01-07 11:22:04'),
(12,	3,	'text_seller_message',	1,	'2024-01-07 11:22:04'),
(13,	24,	'email_buyer_message',	1,	'2024-09-13 17:45:30'),
(14,	24,	'email_seller_message',	1,	'2024-09-13 17:45:30'),
(15,	24,	'text_buyer_message',	1,	'2024-09-13 17:45:30'),
(16,	24,	'text_seller_message',	1,	'2024-09-13 17:45:30');

DROP TABLE IF EXISTS `users_tokens`;
CREATE TABLE `users_tokens` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `token` varchar(200) NOT NULL,
  `device_id` varchar(255) DEFAULT NULL,
  `device_type` enum('android','ios','web') DEFAULT NULL,
  `device_name` varchar(255) DEFAULT NULL,
  `fcm_token` text DEFAULT NULL,
  `expire_on` datetime NOT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


DROP TABLE IF EXISTS `user_centers`;
CREATE TABLE `user_centers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `center_id` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `user_centers` (`id`, `user_id`, `center_id`, `created_at`, `updated_at`) VALUES
(4,	62,	1,	'2025-08-31 03:23:18',	'2025-08-31 03:23:18'),
(8,	69,	18,	'2025-09-29 14:43:38',	'2025-09-29 14:43:38');

DROP TABLE IF EXISTS `video_gallery`;
CREATE TABLE `video_gallery` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `title_hi` varchar(255) DEFAULT NULL,
  `video` text DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1,
  `created_by` int(11) DEFAULT NULL,
  `deleted_at` datetime DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE,
  KEY `created_by` (`created_by`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

INSERT INTO `video_gallery` (`id`, `title`, `title_hi`, `video`, `status`, `created_by`, `deleted_at`, `created`, `modified`) VALUES
(1,	'Test',	'Pest',	'[\"/uploads/gallery/17544956731469-pine-142579.mp4\"]',	1,	7,	NULL,	'2025-08-06 21:24:46',	'2025-08-06 15:56:27');

DROP TABLE IF EXISTS `visitors`;
CREATE TABLE `visitors` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `user_agent` text DEFAULT NULL,
  `visited_url` varchar(255) DEFAULT NULL,
  `visit_date` date DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `visitors` (`id`, `ip_address`, `user_agent`, `visited_url`, `visit_date`, `created_at`) VALUES
(1,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-04',	'2025-09-04 21:03:05'),
(2,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-05',	'2025-09-05 06:37:09'),
(3,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-06',	'2025-09-06 07:08:52'),
(4,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-07',	'2025-09-07 10:55:55'),
(5,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-08',	'2025-09-08 21:11:35'),
(6,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-09',	'2025-09-09 19:23:36'),
(7,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-10',	'2025-09-10 19:09:03'),
(8,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-11',	'2025-09-11 22:03:42'),
(9,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-14',	'2025-09-14 07:56:47'),
(10,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/139.0.0.0 Safari/537.36',	NULL,	'2025-09-15',	'2025-09-15 18:55:03'),
(11,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-16',	'2025-09-16 00:03:41'),
(12,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-17',	'2025-09-17 19:24:55'),
(13,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-18',	'2025-09-18 19:01:24'),
(14,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-20',	'2025-09-20 07:19:29'),
(15,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-21',	'2025-09-21 06:45:11'),
(16,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-22',	'2025-09-22 19:33:41'),
(17,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-23',	'2025-09-23 18:44:40'),
(18,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-24',	'2025-09-24 06:25:04'),
(19,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-25',	'2025-09-25 07:20:24'),
(20,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-26',	'2025-09-26 20:07:07'),
(21,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-27',	'2025-09-27 07:26:37'),
(22,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-28',	'2025-09-28 10:00:07'),
(23,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-29',	'2025-09-29 19:50:32'),
(24,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-09-30',	'2025-09-30 19:28:00'),
(25,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-10-02',	'2025-10-02 06:04:54'),
(26,	'::1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-10-02',	'2025-10-02 07:45:06'),
(27,	'127.0.0.1',	'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36',	NULL,	'2025-10-03',	'2025-10-03 04:55:01');

-- 2025-10-03 14:11:05

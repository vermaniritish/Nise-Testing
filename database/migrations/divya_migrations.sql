ALTER TABLE `order_status_history`
ADD `staff_id` int NULL AFTER `status`,
ADD FOREIGN KEY (`staff_id`) REFERENCES `staff` (`id`) ON DELETE SET NULL;
ALTER TABLE `order_status_history`
ADD `old_value` int NULL AFTER `staff_id`,
ADD `new_value` tinytext COLLATE 'utf8mb4_general_ci' NULL AFTER `old_value`,
ADD `field` tinytext COLLATE 'utf8mb4_general_ci' NULL AFTER `new_value`;

ALTER TABLE `order_products`
ADD `updated_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP;
ALTER TABLE `order_products`
CHANGE `created` `created_at` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `deleted_at`;

--today
ALTER TABLE `order_products`
CHANGE `created_at` `created_at` timestamp NULL ON UPDATE CURRENT_TIMESTAMP AFTER `deleted_at`,
CHANGE `updated_at` `updated_at` timestamp NULL AFTER `created_at`;




INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (38, 'About Us', 'हमारे बारे में', '/about-us', 'header', '[]');
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (39, 'Notices', 'नोटिस', '/notices', 'header', '[]');
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (40, 'Photo Gallery', 'फोटो गैलरी', '/photo-gallery', 'header', '[]');
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (42, 'Current Notice', 'वर्तमान सूचना', '/notices', 'footer', NULL);
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (41, 'NISE Protals', 'एनआईएसई प्रोटल्स', '#', 'header', '[{"title":"NISE","title_hi":"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908","link":"https:\\/\\/twitter.com\\/"},{"title":"Testing Service Portal","title_hi":"\\u092a\\u0930\\u0940\\u0915\\u094d\\u0937\\u0923 \\u0938\\u0947\\u0935\\u093e \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932","link":"https:\\/\\/twitter.com\\/"},{"title":"Suryamitra Portal","title_hi":"\\u0938\\u0942\\u0930\\u094d\\u092f\\u092e\\u093f\\u0924\\u094d\\u0930 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932","link":"https:\\/\\/twitter.com\\/"},{"title":"NISE Traning\'s","title_hi":"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u091f\\u094d\\u0930\\u0947\\u0928\\u093f\\u0902\\u0917","link":"https:\\/\\/twitter.com\\/"},{"title":"e-Procurement Portal","title_hi":"\\u0908-\\u092a\\u094d\\u0930\\u094b\\u0915\\u094d\\u092f\\u094b\\u0930\\u092e\\u0947\\u0902\\u091f \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932","link":"https:\\/\\/twitter.com\\/"},{"title":"National Manufacturing Portal","title_hi":"\\u0930\\u093e\\u0937\\u094d\\u091f\\u094d\\u0930\\u0940\\u092f \\u0935\\u093f\\u0928\\u093f\\u0930\\u094d\\u092e\\u093e\\u0923 \\u092a\\u094b\\u0930\\u094d\\u091f\\u0932","link":"https:\\/\\/twitter.com\\/"},{"title":"NISE Careers","title_hi":"\\u090f\\u0928\\u0906\\u0908\\u090f\\u0938\\u0908 \\u0915\\u0930\\u093f\\u092f\\u0930","link":"https:\\/\\/twitter.com\\/"}]');
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (43, 'Feedback / Suggestions', 'प्रतिक्रिया/सुझाव', '/about-us', 'footer', NULL);
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (44, 'Registration', 'Registration', '/register', 'footer', NULL);
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (45, 'Login', 'Login', '/login', 'footer', NULL);
INSERT INTO `menu` (`id`, `key`, `key_hi`, `value`, `slug`, `mega_menu`) VALUES (46, 'Photo Gallery', 'फोटो गैलरी', '/photo-gallery', 'footer', NULL);

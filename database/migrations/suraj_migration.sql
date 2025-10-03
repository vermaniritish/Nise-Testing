
CREATE TABLE custom_page_data (
  id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `key` VARCHAR(100) NOT NULL,
  `value` TEXT NOT NULL
);

CREATE TABLE notices (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    image TEXT,
    status TINYINT DEFAULT 1,
    created_by INT NULL,
    created DATETIME NOT NULL,
    modified TIMESTAMP NOT NULL
);

CREATE TABLE blog_category_notice (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    blog_category_id BIGINT UNSIGNED NOT NULL,
    notice_id BIGINT UNSIGNED NOT NULL,
    FOREIGN KEY (blog_category_id) REFERENCES blog_categories(id) ON DELETE CASCADE,
    FOREIGN KEY (notice_id) REFERENCES notices(id) ON DELETE CASCADE
);

INSERT INTO `permissions` (`id`, `title`, `type`, `permissions`) VALUES (NULL, 'Home Page', 'home_page', '{\"listing\":\"0\",\"create\":\"0\",\"update\":\"1\",\"delete\":\"0\"}');
INSERT INTO `permissions` (`id`, `title`, `type`, `permissions`) VALUES (NULL, 'Notices', 'notices', '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

CREATE TABLE `pld`.`contact_us` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(255) NOT NULL,
    `email` VARCHAR(255) NOT NULL,
    `phone_number` VARCHAR(255) NOT NULL,
    `message` LONGTEXT NOT NULL,
    `subject` LONGTEXT NOT NULL,
    `created` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    PRIMARY KEY (`id`)
);


ALTER TABLE `users`
ADD COLUMN `telephone` VARCHAR(11) NULL AFTER `phonenumber`,
ADD COLUMN `serviceman_info` ENUM('yes', 'no') NULL AFTER `telephone`,
ADD COLUMN `hide_identity` TINYINT(1) DEFAULT 0 AFTER `serviceman_info`,
ADD COLUMN `captcha` VARCHAR(5) NULL AFTER `hide_identity`,
MODIFY `gender` ENUM('male', 'female', 'other') NULL DEFAULT NULL;

CREATE TABLE grievances (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userId INT NULL,
    gtype VARCHAR(255) NOT NULL,
    subject VARCHAR(255) NOT NULL,
    message TEXT NOT NULL,
    gfile TEXT,
    status TINYINT DEFAULT 1,
    created DATETIME NOT NULL,
    modified TIMESTAMP NOT NULL,
    CONSTRAINT fk_userId FOREIGN KEY (userId) REFERENCES users(id) ON DELETE SET NULL
);

ALTER TABLE blog_categories
ADD COLUMN status TINYINT DEFAULT 1 AFTER image;

ALTER TABLE grievances DROP COLUMN status;

ALTER TABLE grievances
ADD COLUMN status ENUM('acknowledged', 'in progress', 'resolved', 'closed') DEFAULT 'in progress' AFTER message;

ALTER TABLE `grievances` ADD `number` VARCHAR(100) NULL AFTER `id`;

CREATE TABLE comments (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    users_id INT NULL,
    admins_id INT NULL,
    grievances_id INT NOT NULL,
    subject TEXT,
    message LONGTEXT,
    attachment TEXT,
    status TINYINT DEFAULT 1,
    created DATETIME DEFAULT CURRENT_TIMESTAMP NOT NULL,
    modified TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    CONSTRAINT fk_userId FOREIGN KEY (users_id) REFERENCES users(id) ON DELETE SET NULL,
    CONSTRAINT fk_adminId FOREIGN KEY (admins_id) REFERENCES admins(id) ON DELETE SET NULL,
    CONSTRAINT fk_grievanceId FOREIGN KEY (grievances_id) REFERENCES grievances(id) ON DELETE CASCADE
);

CREATE TABLE status_activities (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    userId INT NULL,
    adminId INT NULL,
    title VARCHAR(255) NOT NULL,
    grievance_id INT NOT NULL,
    message TEXT NOT NULL,
    status TINYINT DEFAULT 1,
    created DATETIME NOT NULL,
    modified TIMESTAMP NOT NULL,
    CONSTRAINT fk_userId FOREIGN KEY (userId) REFERENCES users(id)
 ON DELETE SET NULL,
    CONSTRAINT fk_adminId FOREIGN KEY (adminId) REFERENCES admins(id)
 ON DELETE SET NULL

);

CREATE TABLE `grievances_types` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`parent_id` INT(10) NULL DEFAULT NULL,
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`image` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status` TINYINT(3) NULL DEFAULT '1',
	`slug` VARCHAR(255) NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`created_by` INT(10) NULL DEFAULT NULL,
	`deleted_at` DATETIME NULL DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	UNIQUE INDEX `slug` (`slug`) USING BTREE,
	INDEX `parent_id` (`parent_id`) USING BTREE,
	INDEX `created_by` (`created_by`) USING BTREE
)COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=8
;


INSERT INTO `permissions` (`id`, `title`, `type`, `permissions`) VALUES (NULL, 'Grievances', 'grievances', '{\"listing\":\"1\",\"create\":\"0\",\"update\":\"0\",\"delete\":\"0\"}');

INSERT INTO `permissions` (`id`, `title`, `type`, `permissions`) VALUES (NULL, 'Grievances Types', 'grievances_types', '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

ALTER TABLE `notices` ADD `date` DATETIME NULL AFTER `image`;

ALTER TABLE `slider_menu`
ADD `heading_hi` VARCHAR(255) NULL AFTER `button_link`,
ADD `button_title_hi` VARCHAR(255) NULL AFTER `heading_hi`,
ADD `button_link_hi` VARCHAR(255) NULL AFTER `button_title_hi`,
ADD `button_status_hi` TINYINT NOT NULL DEFAULT '1' AFTER `button_link_hi`,
ADD `image_hi` TEXT NULL AFTER `button_status_hi`,
ADD `status_hi` TINYINT NOT NULL DEFAULT '1' AFTER `image_hi`;


ALTER TABLE `notices` ADD `title_hi` VARCHAR(255) NULL AFTER `description`, ADD `description_hi` VARCHAR(255) NULL AFTER `title_hi`;

ALTER TABLE `grievances_types` ADD `title_hi` VARCHAR(255) NULL AFTER `title`;
ALTER TABLE `blog_categories` ADD `title_hi` VARCHAR(255) NULL AFTER `title`;

ALTER TABLE `menu` ADD `key_hi` TEXT NULL AFTER `key`;
ALTER TABLE `menu_hindi` ADD `key_hi` TEXT NULL AFTER `key`;

CREATE TABLE `gallery` (
	`id` INT(10) NOT NULL AUTO_INCREMENT,
	`title` VARCHAR(255) NOT NULL COLLATE 'utf8_general_ci',
	`title_hi` VARCHAR(255)  NULL COLLATE 'utf8_general_ci',
	`image` TEXT NULL DEFAULT NULL COLLATE 'utf8_general_ci',
	`status` TINYINT(3) NULL DEFAULT '1',
	`created_by` INT(10) NULL DEFAULT NULL,
	`deleted_at` DATETIME NULL DEFAULT NULL,
	`created` DATETIME NOT NULL,
	`modified` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
	PRIMARY KEY (`id`) USING BTREE,
	INDEX `created_by` (`created_by`) USING BTREE
)COLLATE='utf8_general_ci'
ENGINE=InnoDB
AUTO_INCREMENT=8
;


ALTER TABLE `notices`
CHANGE `description_hi` `description_hi` text COLLATE 'utf8mb3_general_ci' NULL AFTER `title_hi`;

ALTER TABLE `pages`
ADD `title_hi` varchar(255) COLLATE 'utf8mb3_general_ci' NULL AFTER `title`,
ADD `description_hi` text COLLATE 'utf8mb3_general_ci' NULL AFTER `description`;

UPDATE `permissions` SET
`id` = '16',
`title` = 'Grievances',
`type` = 'grievances',
`permissions` = '{\"listing\":\"1\",\"create\":\"0\",\"update\":\"1\",\"delete\":\"1\"}'
WHERE `id` = '16';

UPDATE `permissions` SET
`id` = '1',
`title` = 'Users',
`type` = 'users',
`permissions` = '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}'
WHERE `id` = '1';

INSERT INTO `permissions` (`title`, `type`, `permissions`)
VALUES ('Menu', 'menu', '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

INSERT INTO `permissions` (`title`, `type`, `permissions`)
VALUES ('Gallery', 'gallery', '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

INSERT INTO `permissions` (`title`, `type`, `permissions`)
VALUES ('Pages', 'pages', '{\"listing\":\"1\",\"create\":\"1\",\"update\":\"1\",\"delete\":\"1\"}');

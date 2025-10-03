ALTER TABLE `notices`
ADD `file_type` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `description_hi`,
CHANGE `file_url` `url` longtext COLLATE 'utf8mb4_general_ci' NULL AFTER `file_type`,
ADD `pdf_file` longtext COLLATE 'utf8mb4_general_ci' NULL AFTER `url`,
ADD `date` date NULL AFTER `pdf_file`,
CHANGE `modified` `modified` timestamp NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

ALTER TABLE `notices`
CHANGE `date` `date` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `pdf_file`,
CHANGE `modified` `modified` timestamp NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

CREATE TABLE `batch_allocations` (
  `id` BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
  `batch_id` BIGINT UNSIGNED NULL,
  `institute_id` BIGINT UNSIGNED NULL,
  `sanction_date` DATE NULL,
  `status` TINYINT(1) NOT NULL DEFAULT 0 COMMENT '0 = Not Approved, 1 = Approved',
  `allocated_doc` VARCHAR(255) NULL,
  `created_at` TIMESTAMP NULL DEFAULT NULL,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

ALTER TABLE `batch_allocations`
CHANGE `id` `id` int(11) NOT NULL AUTO_INCREMENT FIRST,
CHANGE `batch_id` `batch_id` int(11) NULL AFTER `id`,
CHANGE `institute_id` `center_id` int(11) unsigned NULL AFTER `batch_id`,
ADD FOREIGN KEY (`batch_id`) REFERENCES `batches` (`id`) ON DELETE CASCADE,
ADD FOREIGN KEY (`center_id`) REFERENCES `centers` (`id`) ON DELETE CASCADE;

ALTER TABLE `centers`
ADD `institute_id` int(11) NULL AFTER `id`,
CHANGE `modified` `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;


-- 21/09
ALTER TABLE `centers`
ADD `username` varchar(255) COLLATE 'utf8mb4_general_ci' NOT NULL AFTER `title`,
CHANGE `modified` `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;


ALTER TABLE `centers`
CHANGE `username` `username` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `title`,
CHANGE `modified` `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

ALTER TABLE `centers`
CHANGE `district_id` `district_id` int(11) NULL AFTER `state_id`,
CHANGE `modified` `modified` timestamp NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;


-- 23092025
ALTER TABLE `batches`
CHANGE `center_id` `center_id` int(11) NULL AFTER `id`,
ADD `institute_id` int NULL AFTER `center_id`,
CHANGE `updated` `updated` datetime NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

ALTER TABLE `batches`
ADD `batch_id` varchar(255) NULL AFTER `institute_id`,
CHANGE `updated` `updated` datetime NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

ALTER TABLE `batch_allocations`
ADD `institute_id` int(11) unsigned NULL AFTER `id`;

ALTER TABLE `batch_allocations`
ADD `batch_strength` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `batch_id`;

ALTER TABLE `batch_allocations`
ADD `state` bigint(20) unsigned NULL AFTER `batch_id`,
ADD `city` varchar(255) NULL AFTER `state`,
ADD FOREIGN KEY (`state`) REFERENCES `states` (`id`) ON DELETE CASCADE;

ALTER TABLE `batch_allocations`
CHANGE `status` `status` tinyint(1) NULL DEFAULT '0' COMMENT '0 = Not Approved, 1 = Approved' AFTER `sanction_date`;

ALTER TABLE `batches`
ADD `state_id` bigint(20) unsigned NULL AFTER `batch_id`,
CHANGE `updated` `updated` datetime NULL DEFAULT current_timestamp() ON UPDATE CURRENT_TIMESTAMP AFTER `created`,
ADD FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE CASCADE;

ALTER TABLE `users`
CHANGE `first_name` `institute_code` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `id`,
DROP `last_name`;
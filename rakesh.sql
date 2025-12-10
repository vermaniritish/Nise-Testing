ALTER TABLE `order_detail_of_documents`
ADD `title` varchar(255) NULL AFTER `order_id`,
ADD `sub_title` varchar(255) COLLATE 'utf8mb4_general_ci' NULL AFTER `name_of_doc_ssi`,
CHANGE `created` `created` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `name_of_doc_billmat`,
CHANGE `modified` `modified` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created`;

ALTER TABLE `order_remarks`
CHANGE `assign_to` `assign_to` int(11) NULL AFTER `user_id`,
CHANGE `created` `created` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created_by`;

ALTER TABLE `order_tests`
ADD `mark_disclose` tinyint(1) NULL AFTER `status`,
ADD `report_upload` text NULL AFTER `mark_disclose`,
CHANGE `created` `created` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `actual_completion_date`,
CHANGE `modified` `modified` datetime NULL ON UPDATE CURRENT_TIMESTAMP AFTER `created`;
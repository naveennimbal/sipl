ALTER TABLE `user_master` CHANGE `is_add` `is_add` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
CHANGE `is_change` `is_change` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'Yes',
CHANGE `is_delete` `is_delete` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
CHANGE `is_print` `is_print` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
CHANGE `is_email` `is_email` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No',
CHANGE `admin_panel` `admin_panel` ENUM('No','Yes') CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT 'No';

ALTER TABLE `user_master` CHANGE `active` `active` ENUM('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Yes';

ALTER TABLE `personal_expense_master` CHANGE `reminder` `reminder` ENUM('Yes','No') CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL DEFAULT 'Yes';


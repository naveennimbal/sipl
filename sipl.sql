-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 10, 2018 at 09:52 AM
-- Server version: 5.6.35
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `vidhii98_sipl`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_logs`
--

CREATE TABLE `admin_logs` (
  `fld_id` int(12) NOT NULL,
  `ip_address` varchar(400) NOT NULL,
  `login_time` varchar(400) NOT NULL,
  `username` varchar(400) NOT NULL,
  `status` int(12) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `longitude` varchar(50) DEFAULT NULL,
  `latitude` varchar(50) DEFAULT NULL,
  `staddress` varchar(500) DEFAULT NULL,
  `dbname` varchar(1000) DEFAULT NULL,
  `app_log` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `company_master`
--

CREATE TABLE `company_master` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `telephone` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_mobile` varchar(100) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `logo` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `company_master`
--

INSERT INTO `company_master` (`id`, `name`, `address`, `telephone`, `mobile`, `contact_person`, `contact_mobile`, `gst_no`, `logo`, `created_on`, `created_by`) VALUES
(1, 'sdsadasdasd', 'sadasdasdsad', '3432432432', NULL, 'dfsdf', '33423423', '4324df', NULL, '2018-11-01 23:13:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `material_master`
--

CREATE TABLE `material_master` (
  `id` int(11) NOT NULL,
  `item` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `table_name` varchar(25) NOT NULL,
  `table_reference` varchar(25) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_name` varchar(23) NOT NULL,
  `is_list` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_add` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_edit` enum('Yes','No') NOT NULL DEFAULT 'No',
  `is_delete` enum('Yes','No') NOT NULL DEFAULT 'No'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `table_name`, `table_reference`, `user_id`, `user_name`, `is_list`, `is_add`, `is_edit`, `is_delete`) VALUES
(1, 'role_master', '', 1, 'admin', 'Yes', 'Yes', 'No', 'Yes'),
(2, 'company_master', 'Company', 6, 'Krishna', 'Yes', 'Yes', 'Yes', 'Yes'),
(3, 'material_master', 'Material', 6, 'Krishna', 'Yes', 'No', 'No', 'Yes'),
(4, 'uom_master', 'UOM', 6, 'Krishna', 'Yes', 'Yes', 'No', 'No'),
(5, 'vehicle_master', 'Vehicle', 6, 'Krishna', 'Yes', 'No', 'No', 'No'),
(6, 'vehicle_policy_master', 'Vehicle Policy', 6, 'Krishna', 'Yes', 'No', 'Yes', 'No'),
(7, 'vehicle_tax_master', 'Vehicle Taxation', 6, 'Krishna', 'Yes', 'Yes', 'Yes', 'No'),
(8, 'vendor_master', 'Vendor', 6, 'Krishna', 'Yes', 'Yes', 'Yes', 'Yes'),
(9, 'vendor_bank_master', 'Vendor Bank', 6, 'Krishna', 'Yes', 'Yes', 'Yes', 'No'),
(10, 'property_master', 'Property', 6, 'Krishna', 'Yes', 'Yes', 'No', 'No'),
(11, 'project_master', 'Project', 6, 'Krishna', 'Yes', 'No', 'No', 'No'),
(12, 'personal_expense_master', 'Personal Expense', 6, 'Krishna', 'No', 'No', 'No', 'No'),
(13, 'company_master', 'Company', 7, 'test', 'No', 'No', 'No', 'No'),
(14, 'material_master', 'Material', 7, 'test', 'No', 'No', 'No', 'No'),
(15, 'uom_master', 'UOM', 7, 'test', 'No', 'No', 'No', 'No'),
(16, 'vehicle_master', 'Vehicle', 7, 'test', 'No', 'No', 'No', 'No'),
(17, 'vehicle_policy_master', 'Vehicle Policy', 7, 'test', 'No', 'No', 'No', 'No'),
(18, 'vehicle_tax_master', 'Vehicle Taxation', 7, 'test', 'No', 'No', 'No', 'No'),
(19, 'vendor_master', 'Vendor', 7, 'test', 'No', 'No', 'No', 'No'),
(20, 'vendor_bank_master', 'Vendor Bank', 7, 'test', 'No', 'No', 'No', 'No'),
(21, 'property_master', 'Property', 7, 'test', 'No', 'No', 'No', 'No'),
(22, 'project_master', 'Project', 7, 'test', 'No', 'No', 'No', 'No'),
(23, 'personal_expense_master', 'Personal Expense', 7, 'test', 'No', 'No', 'No', 'No');

-- --------------------------------------------------------

--
-- Table structure for table `permit_master`
--

CREATE TABLE `permit_master` (
  `id` int(11) NOT NULL,
  `permit` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `personal_expense_master`
--

CREATE TABLE `personal_expense_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `phoneno` varchar(10) DEFAULT NULL,
  `billing_cycle_from` date DEFAULT NULL,
  `billing_cycle_to` date DEFAULT NULL,
  `reminder` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `project_master`
--

CREATE TABLE `project_master` (
  `id` int(11) NOT NULL,
  `name` varchar(500) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `stateid` int(11) DEFAULT NULL,
  `area` varchar(500) DEFAULT NULL,
  `uomid` int(11) DEFAULT NULL,
  `soq` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `property_master`
--

CREATE TABLE `property_master` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `elec_biling_cycle_from` date DEFAULT NULL,
  `elec_biling_cycle_to` date DEFAULT NULL,
  `water_biling_cycle_from` date DEFAULT NULL,
  `water_biling_cycle_to` date DEFAULT NULL,
  `htax_biling_cycle_from` date DEFAULT NULL,
  `htax_biling_cycle_to` date DEFAULT NULL,
  `reminder` enum('Yes','No') NOT NULL DEFAULT 'No',
  `rented` enum('Yes','No') NOT NULL DEFAULT 'Yes',
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_master`
--

CREATE TABLE `purchase_master` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_bank_id` int(11) DEFAULT NULL,
  `vendor_name` int(11) DEFAULT NULL,
  `po_no` varchar(100) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `vendor_ref_no` varchar(100) DEFAULT NULL,
  `site_address` varchar(500) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `ship_to` int(11) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `bill_attachments` varchar(500) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_master`
--

CREATE TABLE `purchase_order_master` (
  `id` int(11) NOT NULL,
  `company_id` int(11) DEFAULT NULL,
  `vendor_id` int(11) DEFAULT NULL,
  `vendor_bank_id` int(11) DEFAULT NULL,
  `vendor_name` int(11) DEFAULT NULL,
  `po_no` varchar(100) DEFAULT NULL,
  `po_date` date DEFAULT NULL,
  `vendor_ref_no` varchar(100) DEFAULT NULL,
  `site_address` varchar(500) DEFAULT NULL,
  `material_id` int(11) DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `uom_id` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `tax_id` int(11) DEFAULT NULL,
  `ship_to` int(11) DEFAULT NULL,
  `remarks` varchar(500) DEFAULT NULL,
  `bill_attachments` varchar(500) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_transaction`
--

CREATE TABLE `purchase_order_transaction` (
  `id` int(11) NOT NULL,
  `purchase_order_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `qty` int(11) DEFAULT NULL,
  `rate` decimal(10,2) DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_master`
--

CREATE TABLE `quotation_master` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `project_date` date DEFAULT NULL,
  `description` varchar(200) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `attachment` varchar(200) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_type`
--

CREATE TABLE `quotation_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `requirement_master`
--

CREATE TABLE `requirement_master` (
  `id` int(11) NOT NULL,
  `project_id` int(11) DEFAULT NULL,
  `proj_date` date DEFAULT NULL,
  `description` varchar(500) DEFAULT NULL,
  `remarks` varchar(1000) DEFAULT NULL,
  `attachment` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `role_master`
--

CREATE TABLE `role_master` (
  `id` int(11) NOT NULL,
  `role` varchar(50) CHARACTER SET utf8 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `role_master`
--

INSERT INTO `role_master` (`id`, `role`) VALUES
(1, 'xcvcxvxcvxcv');

-- --------------------------------------------------------

--
-- Table structure for table `state_master`
--

CREATE TABLE `state_master` (
  `int` int(11) NOT NULL,
  `state` varchar(100) DEFAULT NULL,
  `craeted_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tax_type`
--

CREATE TABLE `tax_type` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `uom_master`
--

CREATE TABLE `uom_master` (
  `id` int(11) NOT NULL,
  `uom` varchar(20) DEFAULT NULL,
  `create_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) NOT NULL,
  `mobile` varchar(10) DEFAULT NULL,
  `landline` varchar(100) DEFAULT NULL,
  `user_name` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `role_id` int(11) DEFAULT NULL COMMENT 'Foriegn Key role master table',
  `is_add` enum('No','Yes') DEFAULT 'Yes',
  `is_change` enum('No','Yes') DEFAULT 'Yes',
  `is_delete` enum('No','Yes') DEFAULT 'No',
  `is_print` enum('No','Yes') DEFAULT 'No',
  `is_email` enum('No','Yes') DEFAULT 'No',
  `admin_panel` enum('No','Yes') DEFAULT 'No',
  `imeiid` varchar(100) DEFAULT NULL,
  `active` enum('Yes','No') NOT NULL DEFAULT 'Yes'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `name`, `address`, `mobile`, `landline`, `user_name`, `password`, `role_id`, `is_add`, `is_change`, `is_delete`, `is_print`, `is_email`, `admin_panel`, `imeiid`, `active`) VALUES
(1, 'naveen', 'fsdfdsfds', '3432432234', 'dsfdsfsdfds', 'admin', 'admin', 0, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'kjdfdkjfdsk', 'Yes'),
(2, 'Rajneesh', 'fsdfdsfds', '3432432234', 'dsfdsfsdfds', 'rajneesh', 'rajneesh', 0, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'kjdfdkjfdsk', 'Yes'),
(3, 'Rajeev', 'fsdfdsfds', '3432432234', 'dsfdsfsdfds', 'rajeev', 'rajeev', 0, 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'Yes', 'kjdfdkjfdsk', 'Yes'),
(6, 'Kri', '9348209384', '94804935', NULL, 'Krishna', 'krishna', 1, 'Yes', 'Yes', 'Yes', NULL, 'No', 'Yes', NULL, 'Yes'),
(7, 'Test', 'lkdfklfdjgldfjg', '8437498300', NULL, 'test', 'test', 1, 'Yes', 'Yes', 'Yes', 'Yes', 'No', 'No', NULL, 'Yes');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_make_master`
--

CREATE TABLE `vehicle_make_master` (
  `id` int(11) NOT NULL,
  `make` varchar(100) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_master`
--

CREATE TABLE `vehicle_master` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_no` varchar(20) DEFAULT NULL,
  `description` varchar(100) DEFAULT NULL,
  `reg_authority` varchar(100) DEFAULT NULL,
  `make` varchar(100) DEFAULT NULL COMMENT 'Foriegn Key make_master id',
  `model` varchar(100) DEFAULT NULL,
  `chasis_no` varchar(100) DEFAULT NULL,
  `engine_no` varchar(100) DEFAULT NULL,
  `purchase_date` date DEFAULT NULL,
  `sold` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sold_to` varchar(100) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `mobile` varchar(50) DEFAULT NULL,
  `sale_date` date DEFAULT NULL,
  `rc_copy` varchar(200) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `permit_type` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_movement_master`
--

CREATE TABLE `vehicle_movement_master` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `from_location` int(11) DEFAULT NULL,
  `to_location` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_policy_master`
--

CREATE TABLE `vehicle_policy_master` (
  `id` int(11) NOT NULL,
  `companyname` varchar(300) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `amount` decimal(10,2) DEFAULT NULL,
  `assigned_to` int(11) DEFAULT NULL COMMENT 'Employee/staff',
  `policy_copy` varchar(200) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tax`
--

CREATE TABLE `vehicle_tax` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `type` char(1) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `amount_received` decimal(10,2) DEFAULT NULL,
  `attachments` varchar(200) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_tax_master`
--

CREATE TABLE `vehicle_tax_master` (
  `id` int(11) NOT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `taxtype_id` int(11) DEFAULT NULL,
  `date_from` date DEFAULT NULL,
  `date_to` date DEFAULT NULL,
  `amount_paid` decimal(10,2) DEFAULT NULL,
  `amount_received` decimal(10,2) DEFAULT NULL,
  `attachment` varchar(500) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_bank_master`
--

CREATE TABLE `vendor_bank_master` (
  `id` int(11) NOT NULL,
  `vendor_id` int(11) NOT NULL,
  `bank_name` varchar(200) DEFAULT NULL,
  `address` varchar(500) DEFAULT NULL,
  `ac_name` varchar(500) DEFAULT NULL,
  `ac_no` varchar(50) DEFAULT NULL,
  `rtgs_ifsc` varchar(20) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `vendor_master`
--

CREATE TABLE `vendor_master` (
  `id` int(11) NOT NULL,
  `name` varchar(200) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `address` varchar(300) DEFAULT NULL,
  `contact_person` varchar(100) DEFAULT NULL,
  `contact_mobile` varchar(100) DEFAULT NULL,
  `tin_no` varchar(50) DEFAULT NULL,
  `gst_no` varchar(50) DEFAULT NULL,
  `created_on` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_logs`
--
ALTER TABLE `admin_logs`
  ADD PRIMARY KEY (`fld_id`);

--
-- Indexes for table `company_master`
--
ALTER TABLE `company_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `material_master`
--
ALTER TABLE `material_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permit_master`
--
ALTER TABLE `permit_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_expense_master`
--
ALTER TABLE `personal_expense_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_master`
--
ALTER TABLE `project_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `property_master`
--
ALTER TABLE `property_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_master`
--
ALTER TABLE `purchase_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_master`
--
ALTER TABLE `purchase_order_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `purchase_order_transaction`
--
ALTER TABLE `purchase_order_transaction`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_master`
--
ALTER TABLE `quotation_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quotation_type`
--
ALTER TABLE `quotation_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `requirement_master`
--
ALTER TABLE `requirement_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_master`
--
ALTER TABLE `role_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `state_master`
--
ALTER TABLE `state_master`
  ADD PRIMARY KEY (`int`);

--
-- Indexes for table `tax_type`
--
ALTER TABLE `tax_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `uom_master`
--
ALTER TABLE `uom_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_make_master`
--
ALTER TABLE `vehicle_make_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_master`
--
ALTER TABLE `vehicle_master`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `vehicle_movement_master`
--
ALTER TABLE `vehicle_movement_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_policy_master`
--
ALTER TABLE `vehicle_policy_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_tax`
--
ALTER TABLE `vehicle_tax`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vehicle_tax_master`
--
ALTER TABLE `vehicle_tax_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_bank_master`
--
ALTER TABLE `vendor_bank_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `vendor_master`
--
ALTER TABLE `vendor_master`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_logs`
--
ALTER TABLE `admin_logs`
  MODIFY `fld_id` int(12) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `company_master`
--
ALTER TABLE `company_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `material_master`
--
ALTER TABLE `material_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;
--
-- AUTO_INCREMENT for table `permit_master`
--
ALTER TABLE `permit_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `personal_expense_master`
--
ALTER TABLE `personal_expense_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `project_master`
--
ALTER TABLE `project_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `property_master`
--
ALTER TABLE `property_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_master`
--
ALTER TABLE `purchase_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order_master`
--
ALTER TABLE `purchase_order_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `purchase_order_transaction`
--
ALTER TABLE `purchase_order_transaction`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation_master`
--
ALTER TABLE `quotation_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `quotation_type`
--
ALTER TABLE `quotation_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `requirement_master`
--
ALTER TABLE `requirement_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `role_master`
--
ALTER TABLE `role_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `state_master`
--
ALTER TABLE `state_master`
  MODIFY `int` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tax_type`
--
ALTER TABLE `tax_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `uom_master`
--
ALTER TABLE `uom_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `vehicle_make_master`
--
ALTER TABLE `vehicle_make_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_master`
--
ALTER TABLE `vehicle_master`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_movement_master`
--
ALTER TABLE `vehicle_movement_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_policy_master`
--
ALTER TABLE `vehicle_policy_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_tax`
--
ALTER TABLE `vehicle_tax`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vehicle_tax_master`
--
ALTER TABLE `vehicle_tax_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_bank_master`
--
ALTER TABLE `vendor_bank_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `vendor_master`
--
ALTER TABLE `vendor_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
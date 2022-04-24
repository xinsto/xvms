-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2012 at 01:25 AM
-- Server version: 5.1.44
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `volunteer`
--

-- --------------------------------------------------------

--
-- Table structure for table `acl_controls`
--

CREATE TABLE IF NOT EXISTS `acl_controls` (
  `acl_control_id` int(11) NOT NULL,
  `acl_control_name` varchar(255) NOT NULL,
  PRIMARY KEY (`acl_control_id`),
  UNIQUE KEY `acl_control_name` (`acl_control_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `acl_controls`
--

INSERT INTO `acl_controls` (`acl_control_id`, `acl_control_name`) VALUES
(9, 'Administrator'),
(5, 'Volunteer');

-- --------------------------------------------------------

--
-- Table structure for table `application_settings`
--

CREATE TABLE IF NOT EXISTS `application_settings` (
  `application_setting_name` varchar(255) NOT NULL,
  `application_setting` text NOT NULL,
  PRIMARY KEY (`application_setting_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `application_settings`
--

INSERT INTO `application_settings` (`application_setting_name`, `application_setting`) VALUES
('title', 'PHP Volunteer Management System'),
('version', '1.0.2'),
('organization_name', 'Organization Name');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `document_id` int(11) NOT NULL AUTO_INCREMENT,
  `document_name` varchar(255) NOT NULL,
  `document_description` varchar(255) NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `document_volunteer_id` int(11) NOT NULL,
  `document_type` int(11) NOT NULL COMMENT '1 = Personal 2 = Shared 3 = Volunteer/Admin',
  `document_upload_date` date NOT NULL,
  PRIMARY KEY (`document_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `documents`
--


-- --------------------------------------------------------

--
-- Table structure for table `ethnicities`
--

CREATE TABLE IF NOT EXISTS `ethnicities` (
  `ethnicity_id` int(11) NOT NULL AUTO_INCREMENT,
  `ethnicity_name` varchar(255) NOT NULL,
  PRIMARY KEY (`ethnicity_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `ethnicities`
--

INSERT INTO `ethnicities` (`ethnicity_id`, `ethnicity_name`) VALUES
(1, 'White'),
(2, 'Hispanic'),
(3, 'Asian'),
(8, 'asdff'),
(7, 'African American');

-- --------------------------------------------------------

--
-- Table structure for table `hours`
--

CREATE TABLE IF NOT EXISTS `hours` (
  `hours_id` int(11) NOT NULL AUTO_INCREMENT,
  `hours_volunteer_id` int(11) NOT NULL,
  `hours_work_type_id` int(11) NOT NULL,
  `hours_location_id` int(11) NOT NULL,
  `hours_worked` decimal(11,2) NOT NULL,
  `hours_notes` text NOT NULL,
  `hours_date` date NOT NULL,
  PRIMARY KEY (`hours_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hours`
--


-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE IF NOT EXISTS `locations` (
  `location_id` int(11) NOT NULL AUTO_INCREMENT,
  `location_name` varchar(255) NOT NULL,
  `location_address` text NOT NULL,
  PRIMARY KEY (`location_id`),
  UNIQUE KEY `location_name` (`location_name`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`location_id`, `location_name`, `location_address`) VALUES
(1, 'Location A', '100 W A Street\r\nA Town\r\nAA,  55555');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE IF NOT EXISTS `messages` (
  `message_id` int(11) NOT NULL AUTO_INCREMENT,
  `message_from_id` int(11) NOT NULL,
  `message_to_id` int(11) NOT NULL,
  `message_subject` varchar(255) NOT NULL,
  `message_body` text NOT NULL,
  `message_state` varchar(255) NOT NULL,
  PRIMARY KEY (`message_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `messages`
--


-- --------------------------------------------------------

--
-- Table structure for table `mods`
--

CREATE TABLE IF NOT EXISTS `mods` (
  `mod_name` varchar(255) NOT NULL,
  `mod_path` text NOT NULL,
  `mod_display_name` varchar(255) NOT NULL,
  `mod_parent_name` varchar(255) NOT NULL,
  `mod_acl_control_id` int(11) NOT NULL COMMENT 'lowest acl_control_id that can vire this mod...',
  `mod_weight` int(11) NOT NULL,
  `mod_type` int(11) NOT NULL COMMENT '1 = Main Menu Item 2 = Not Main Menu Item',
  `mod_can_en_dis` int(11) NOT NULL COMMENT '1 = Yes 2 = No',
  `mod_active_inactive` int(11) NOT NULL COMMENT '1 = Active 2 = Inactive',
  PRIMARY KEY (`mod_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mods`
--

INSERT INTO `mods` (`mod_name`, `mod_path`, `mod_display_name`, `mod_parent_name`, `mod_acl_control_id`, `mod_weight`, `mod_type`, `mod_can_en_dis`, `mod_active_inactive`) VALUES
('dashboard', 'dashboard/dashboard.php', 'Dashboard', 'none', 5, 0, 1, 2, 1),
('hours', '', 'Hours', 'none', 5, 1, 1, 2, 1),
('report_hours', 'hours/report_hours.php', 'Report Hours', 'hours', 5, 0, 2, 2, 1),
('manage_reported_hours', 'hours/manage_reported_hours.php', 'Manage Hours', 'hours', 5, 0, 2, 2, 1),
('tasks', '', 'Tasks', 'none', 5, 2, 1, 1, 1),
('tasks_assigned_to_current_user', 'tasks/tasks_assigned_to_current_user.php', 'Assigned', 'tasks', 5, 0, 2, 2, 1),
('tasks_completed_by_current_user', 'tasks/tasks_completed_by_current_user.php', 'Completed', 'tasks', 5, 0, 2, 2, 1),
('administration_menu', '', 'Administration', 'none', 9, 6, 1, 2, 1),
('add_volunteer', 'volunteers/add_volunteer.php', 'Add Volunteer', 'administration_menu', 9, 0, 4, 2, 1),
('manage_volunteers', 'volunteers/manage_volunteers.php', 'Volunteers', 'administration_menu', 9, 10, 2, 1, 1),
('documents', '', 'Documents', 'none', 5, 3, 1, 1, 1),
('personal_documents', 'documents/personal_documents.php', 'Personal Documents', 'documents', 5, 0, 2, 1, 1),
('shared_documents', 'documents/shared_documents.php', 'Shared Documents', 'documents', 5, 0, 2, 1, 1),
('logoff', 'logout/logout.php', 'Log Out', 'none', 9, 0, 4, 2, 1),
('manage_volunteer', 'volunteers/manage_volunteer.php', 'Manage Volunteer', 'manage_volunteers', 9, 0, 2, 1, 1),
('add_location', 'locations/add_location.php', 'Add Location', 'administration_menu', 9, 0, 4, 1, 1),
('manage_locations', 'locations/manage_locations.php', 'Locations', 'administration_menu', 9, 30, 2, 2, 1),
('add_work_type', 'work_types/add_work_type.php', 'Add Work Type', 'administration_menu', 9, 0, 4, 2, 1),
('manage_work_types', 'work_types/manage_work_types.php', 'Work Types', 'administration_menu', 9, 20, 2, 2, 1),
('documentation', 'documentation/documentation.php', 'Documentation', 'none', 9, 0, 4, 2, 1),
('create_task', 'tasks/create_task.php', 'Create Task', 'administration_menu', 9, 0, 4, 2, 1),
('manage_tasks', 'tasks/manage_tasks.php', 'Tasks', 'administration_menu', 9, 50, 1, 2, 1),
('login', 'login/login.php', 'Login', 'none', 9, 0, 4, 2, 1),
('reset_volunteer_password', 'volunteers/reset_volunteer_password.php', 'Reset Password & Email', 'none', 9, 0, 4, 2, 1),
('manage_location', 'locations/manage_location.php', 'Manage Location', 'manage_locations', 9, 0, 4, 2, 1),
('manage_volunteers_custom_details', 'volunteers/manage_volunteers_custom_details.php', 'Custom Details', 'administration_menu', 9, 60, 2, 2, 1),
('add_custom_detail', 'volunteers/add_volunteer_custom_detail.php', 'Add Custom Detail', 'volunteers', 9, 0, 4, 2, 1),
('manage_work_type', 'work_types/manage_work_type.php', 'Manage Work Type', 'work_types', 9, 0, 4, 2, 1),
('edit_reported_hours', 'hours/edit_reported_hours.php', 'Edit Reported Hours', 'hours', 5, 0, 4, 2, 1),
('manage_volunteers_custom_detail', 'volunteers/manage_volunteer_custom_detail.php', 'Manage Custom Detail', 'manage_volunteers_custom_details', 9, 0, 4, 2, 1),
('volunteer_settings', '', 'Options', 'none', 9, 4, 1, 2, 1),
('change_password', 'volunteer_settings/change_password.php', 'Change Password', 'volunteer_settings', 9, 1, 2, 2, 1),
('manage_news_information', 'news_information/manage_news_information.php', 'News & Information', 'administration_menu', 9, 100, 2, 2, 1),
('add_news_information', 'news_information/add_news_information.php', 'Add News & Information', 'manage_news_information', 9, 1, 4, 2, 1),
('edit_news_information', 'news_information/edit_news_information.php', 'Edit News & Information', 'manage_news_information', 9, 4, 4, 2, 1),
('messages', 'messages/inbox.php', 'Messages', 'none', 5, 2, 1, 1, 1),
('compose_message', 'messages/compose_message.php', 'Compose Message', 'messages', 5, 0, 4, 2, 1),
('read_message', 'messages/read_message.php', 'Read Meassage', 'messages', 5, 0, 4, 2, 1),
('edit_task', 'tasks/edit_task.php', 'Edit Task', 'manage_tasks', 9, 0, 4, 2, 1),
('system_settings', '', 'System Settings', 'none', 9, 10, 1, 2, 1),
('manage_modules', 'system_settings/manage_modules.php', 'Manage Modules', 'system_settings', 9, 1, 2, 2, 1),
('volunteer_documents', 'documents/volunteer_documents.php', 'Volunteer''s Documents', 'documents', 5, 0, 4, 1, 1),
('upload_volunteer_document', 'documents/upload_volunteer_document.php', 'Upload Volunteer Document', 'documents', 5, 0, 4, 2, 1),
('upload_personal_document', 'documents/upload_personal_document.php', 'Upload Personal Document', 'documents', 5, 1, 4, 2, 1),
('upload_shared_document', 'documents/upload_shared_document.php', 'Upload Shared Document', 'documents', 5, 10, 4, 2, 1),
('manage_app_settings', 'system_settings/manage_app_settings.php', 'Manage Application Settings', 'system_settings', 9, 1, 2, 1, 1),
('permission_details', 'permissions/permission_details.php', 'Permission Details', 'administration', 9, 0, 3, 1, 1),
('manage_ethnicities', 'ethnicities/manage_ethnicities.php', 'Ethnicities', 'administration_menu', 9, 35, 2, 1, 1),
('add_ethnicity', 'ethnicities/add_ethnicity.php', 'Add Ethnicity', 'administration_menu', 9, 0, 4, 1, 1),
('manage_ethnicity', 'ethnicities/manage_ethnicity.php', 'Manage Ethnicity', 'administration_menu', 9, 0, 4, 1, 1),
('permissions', 'permissions/manage_permissions.php', 'Permissions', 'administration_menu', 9, 55, 2, 1, 1),
('reports', 'reports/reports.php', 'Reports', 'none', 9, 5, 1, 2, 1),
('edit_permission', 'permissions/edit_permission.php', 'edit_permission', 'administration_menu', 9, 0, 3, 1, 1),
('process_update_permission', 'permissions/data/process_update_permission.php', 'process_update_permission', 'administration', 9, 0, 3, 1, 1),
('view_report', 'reports/view_report.php', 'View Report', 'reports', 9, 0, 3, 2, 1),
('report_details', 'reports/report_details.php', 'Report Details', 'reports', 9, 0, 3, 2, 1),
('generate_hours_by_volunteer', 'reports/data/generate_hours_by_volunteer.php', 'Generate Hours By Volunteer', 'reports', 9, 0, 3, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `data` text NOT NULL,
  `login_dashboard` int(11) NOT NULL COMMENT '1 = Both 2 = Login Only 3 = Dashboard Only',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `date_start`, `date_end`, `data`, `login_dashboard`) VALUES
(1, '2000-01-01', '2099-11-30', 'Test News and Information item...', 1);

-- --------------------------------------------------------

--
-- Table structure for table `news_display_states`
--

CREATE TABLE IF NOT EXISTS `news_display_states` (
  `news_display_state_id` int(11) NOT NULL AUTO_INCREMENT,
  `news_display_state` varchar(255) NOT NULL,
  PRIMARY KEY (`news_display_state_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `news_display_states`
--

INSERT INTO `news_display_states` (`news_display_state_id`, `news_display_state`) VALUES
(1, 'Login & Dashboard'),
(2, 'Login Only'),
(3, 'Dashboard Only');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE IF NOT EXISTS `reports` (
  `report_name` varchar(255) NOT NULL,
  `report_display_name` varchar(255) NOT NULL,
  `report_path` text NOT NULL,
  PRIMARY KEY (`report_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_name`, `report_display_name`, `report_path`) VALUES
('hours_by_volunteeer', 'Hours by Volunteer', 'reports/hours_by_volunteer.php');

-- --------------------------------------------------------

--
-- Table structure for table `sexies`
--

CREATE TABLE IF NOT EXISTS `sexies` (
  `sex_id` int(11) NOT NULL AUTO_INCREMENT,
  `sex_name` varchar(255) NOT NULL,
  PRIMARY KEY (`sex_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `sexies`
--

INSERT INTO `sexies` (`sex_id`, `sex_name`) VALUES
(1, 'Male'),
(2, 'Female');

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE IF NOT EXISTS `tasks` (
  `task_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_assigned_to_volunteer_id` int(11) NOT NULL,
  `task_created_by_volunteer_id` int(11) NOT NULL,
  `task_created_date` date NOT NULL,
  `task_state_id` int(11) NOT NULL,
  `task_data` text NOT NULL,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `tasks`
--


-- --------------------------------------------------------

--
-- Table structure for table `tasks_log`
--

CREATE TABLE IF NOT EXISTS `tasks_log` (
  `task_log_task_id` int(11) NOT NULL,
  `task_log_date` date NOT NULL,
  `task_log_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tasks_log`
--


-- --------------------------------------------------------

--
-- Table structure for table `task_states`
--

CREATE TABLE IF NOT EXISTS `task_states` (
  `task_state_id` int(11) NOT NULL AUTO_INCREMENT,
  `task_state` varchar(255) NOT NULL,
  PRIMARY KEY (`task_state_id`),
  UNIQUE KEY `task_state` (`task_state`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `task_states`
--

INSERT INTO `task_states` (`task_state_id`, `task_state`) VALUES
(1, 'New'),
(2, 'Completed');

-- --------------------------------------------------------

--
-- Table structure for table `volunteers`
--

CREATE TABLE IF NOT EXISTS `volunteers` (
  `volunteer_id` int(11) NOT NULL AUTO_INCREMENT,
  `volunteer_first_name` varchar(255) NOT NULL,
  `volunteer_last_name` varchar(255) NOT NULL,
  `volunteer_email` varchar(255) NOT NULL,
  `volunteer_password` varchar(255) NOT NULL,
  `volunteer_date_of_birth` date NOT NULL,
  `volunteer_sex_id` int(11) NOT NULL,
  `volunteer_ethnicity_id` int(11) NOT NULL,
  `volunteer_acl_control_id` int(11) NOT NULL,
  `volunteer_force_password_change` int(11) NOT NULL COMMENT '1 = Force User To Change Password',
  PRIMARY KEY (`volunteer_id`),
  UNIQUE KEY `volunteer_email` (`volunteer_email`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `volunteers`
--

INSERT INTO `volunteers` (`volunteer_id`, `volunteer_first_name`, `volunteer_last_name`, `volunteer_email`, `volunteer_password`, `volunteer_date_of_birth`, `volunteer_sex_id`, `volunteer_ethnicity_id`, `volunteer_acl_control_id`, `volunteer_force_password_change`) VALUES
(1, 'System', 'Administrator', 'admin', '2d56df9a08100634d51940309237855d', '0000-00-00', 0, 0, 9, 0);

-- --------------------------------------------------------

--
-- Table structure for table `volunteer_details`
--

CREATE TABLE IF NOT EXISTS `volunteer_details` (
  `volunteer_detail_volunteer_id` int(11) NOT NULL,
  `volunteer_detail_item_common_name` varchar(255) NOT NULL,
  `volunteer_detail_data` text NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer_details`
--


-- --------------------------------------------------------

--
-- Table structure for table `volunteer_detail_items`
--

CREATE TABLE IF NOT EXISTS `volunteer_detail_items` (
  `volunteer_detail_item_common_name` varchar(255) NOT NULL,
  `volunteer_detail_item_display_name` varchar(255) NOT NULL,
  `volunteer_detail_weight` int(11) NOT NULL,
  PRIMARY KEY (`volunteer_detail_item_common_name`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `volunteer_detail_items`
--


-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE IF NOT EXISTS `work_types` (
  `work_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `work_type_name` varchar(255) NOT NULL,
  PRIMARY KEY (`work_type_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`work_type_id`, `work_type_name`) VALUES
(1, 'General Volunteer Work'),
(2, 'sdfgg');

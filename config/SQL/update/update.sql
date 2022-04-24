-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 21, 2012 at 01:22 AM
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

--
-- UPDATE VERSION
--

UPDATE `application_settings` SET `application_setting` = '1.0.2' WHERE `application_setting_name` = 'version'

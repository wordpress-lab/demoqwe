SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `accounting`
--




CREATE TABLE `access_level` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `create` tinyint(1) NOT NULL DEFAULT '0',
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `update` tinyint(1) NOT NULL DEFAULT '0',
  `delete` tinyint(1) NOT NULL DEFAULT '0',
  `module_id` int(10) unsigned NOT NULL,
  `role_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `access_level_module_id_foreign` (`module_id`),
  KEY `access_level_role_id_foreign` (`role_id`),
  KEY `access_level_created_by_foreign` (`created_by`),
  KEY `access_level_updated_by_foreign` (`updated_by`),
  CONSTRAINT `access_level_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `access_level_module_id_foreign` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `access_level_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `access_level_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO access_level VALUES
("1","1","1","1","1","1","1","1","1","1985-07-28 04:00:18","2017-08-12 11:17:19"),
("2","1","1","1","1","2","1","1","1","2015-05-11 03:36:38","2017-08-12 11:17:19"),
("3","1","1","1","1","3","1","1","1","1987-04-01 09:08:00","2017-08-12 11:17:19"),
("4","1","1","1","1","1","2","1","1","2003-05-18 13:18:05","1972-03-19 18:20:05"),
("5","1","1","0","0","2","2","1","1","1997-12-17 21:19:12","1981-07-26 03:50:51"),
("6","0","0","1","0","3","2","1","1","2013-12-01 04:26:48","2005-10-11 20:13:13"),
("7","1","1","1","0","1","3","1","1","2014-10-16 09:08:14","1977-06-27 17:15:44"),
("8","1","1","1","0","2","3","1","1","2000-08-01 01:19:44","1988-09-04 10:39:01"),
("9","1","1","1","0","3","3","1","1","2017-07-15 21:47:09","1993-05-07 08:00:55"),
("12","1","1","1","1","4","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:32"),
("13","1","1","1","1","5","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:32"),
("14","1","1","1","1","6","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:32"),
("15","1","1","1","1","7","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("16","1","1","1","1","8","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("17","1","1","1","1","9","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("18","1","1","1","1","10","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("19","1","1","1","1","11","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("20","1","1","1","1","12","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("21","1","1","1","1","13","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("22","1","1","1","1","14","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("23","1","1","1","1","15","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("24","1","1","1","1","16","1","1","1","2017-08-12 11:17:19","2017-08-12 11:19:33"),
("25","1","1","1","1","17","1","1","1","2017-08-12 11:17:20","2017-08-12 11:19:33"),
("26","1","1","1","1","18","1","1","1","2017-08-12 11:17:20","2017-08-12 11:19:33");




CREATE TABLE `account` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `dashboard_watchlist` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `required_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_type_id` int(10) unsigned NOT NULL,
  `parent_account_type_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_account_type_id_foreign` (`account_type_id`),
  KEY `account_parent_account_type_id_foreign` (`parent_account_type_id`),
  KEY `account_branch_id_foreign` (`branch_id`),
  KEY `account_created_by_foreign` (`created_by`),
  KEY `account_updated_by_foreign` (`updated_by`),
  CONSTRAINT `account_account_type_id_foreign` FOREIGN KEY (`account_type_id`) REFERENCES `account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `account_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO account VALUES
("1","Advance Tax","Advance Tax","Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.","0","1","3","1","1","1","1","1975-09-26 13:52:25","2010-08-02 05:59:43"),
("2","Employee Advance","Employee Advance","Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.","0","1","3","1","1","1","1","1974-05-25 06:19:52","2013-07-29 18:06:30"),
("3","Petty Cash","Petty Cash","It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.","0","1","4","1","1","1","1","2000-09-02 17:57:33","1971-08-01 22:19:26"),
("4","Undeposited Funds","Undeposited Funds","Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.","0","1","4","1","1","1","1","1996-10-18 12:27:37","1978-05-11 19:29:30"),
("5","Accounts Receivable","Accounts Receivable","The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.","0","1","2","1","1","1","1","1984-09-04 07:47:44","2007-08-05 03:58:38"),
("6","Inventory Asset","Inventory Asset","An account which tracks the value of goods in your inventory.","0","1","7","1","1","1","1","1983-07-13 06:57:28","2005-09-10 00:07:04"),
("7","Opening Balance Adjustments","Opening Balance Adjustments","This account will hold the difference in the debits and credits entered during the opening balance.","0","1","9","2","1","1","1","2001-12-12 14:25:43","1970-01-24 01:42:02"),
("8","Employee Reimbursements","Employee Reimbursements","This account can be used to track the reimbursements that are due to be paid out to employees.","0","1","9","2","1","1","1","1988-09-22 11:46:46","2004-04-05 05:40:36"),
("9","Tax Payable","Tax Payable","The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.","0","1","9","2","1","1","1","2001-02-14 07:04:28","1988-03-01 00:18:46"),
("10","Unearned Revenue","Unearned Revenue","A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.","0","1","9","2","1","1","1","2008-03-25 01:45:45","1984-07-24 21:38:51"),
("11","Accounts Payable","Accounts Payable","This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.","0","1","13","2","1","1","1","1975-03-27 04:46:13","1992-07-28 16:39:15"),
("12","Tag Adjustments","Tag Adjustments","This adjustment account tracks the transfers between different reporting tags.","0","1","12","2","1","1","1","2011-09-18 13:16:49","2015-08-14 00:35:52"),
("13","Drawings","Drawings","The money withdrawn from a business by its owner can be tracked with this account.","0","1","14","3","1","1","1","2005-08-16 23:22:18","1990-02-09 14:06:35"),
("14","Opening Balance Offset","Opening Balance Offset","This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.","0","1","14","3","1","1","1","1999-02-12 03:56:03","1975-07-06 18:53:01"),
("15","Owner Equity","Owner Equity","The owners rights to the assets of a company can be quantified in the owner\'s equity account.","0","1","14","3","1","1","1","1994-10-27 08:21:41","1971-10-28 19:38:38"),
("16","Sales","Sales","The income from the sales in your business is recorded under the sales account.","0","1","15","4","1","1","1","2004-11-22 12:44:41","1995-07-01 05:18:15"),
("17","General Income","General Income","A general category of account where you can record any income which cannot be recorded into any other category.","0","1","15","4","1","1","1","1995-04-23 08:57:23","1985-12-31 08:38:53"),
("18","Other Charges","Other Charges","Miscellaneous charges like adjustments made to the invoice can be recorded in this account.","0","1","15","4","1","1","1","1995-11-03 02:59:43","1990-01-18 22:15:14"),
("19","Interest Income","Interest Income","A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.","0","1","15","4","1","1","1","1990-01-05 16:46:19","1995-09-12 05:30:01"),
("20","Shipping Charge","Shipping Charge","Shipping charges made to the invoice will be recorded in this account.","0","1","15","4","1","1","1","1975-01-15 17:08:01","1972-10-24 04:01:43"),
("21","Discount","Discount","Any reduction on your selling price as a discount can be recorded into the discount account.","0","1","15","4","1","1","1","1986-05-23 14:51:45","1978-07-05 15:29:54"),
("22","Late Fee Income","Late Fee Income","Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.","0","1","15","4","1","1","1","1983-08-15 22:17:52","2014-07-28 16:18:45"),
("23","Other Expenses","Other Expenses","Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.","0","1","17","5","1","1","1","1991-06-30 17:37:36","2005-08-02 12:51:57"),
("24","Bad Debt","Bad Debt","Any amount which is lost and is unrecoverable is recorded into the bad debt account.","0","1","17","5","1","1","1","2010-06-01 21:40:04","1974-08-11 14:31:27"),
("25","Exchange Gain or Loss","Exchange Gain or Loss","Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.","0","1","19","5","1","1","1","2012-09-27 13:11:56","1971-03-20 06:50:42"),
("26","Cost of Goods Sold","Cost of Goods Sold","An expense account which tracks the value of the goods sold.","0","1","18","5","1","1","1","2001-03-08 19:21:43","1994-08-12 01:42:09"),
("27","Prepaid Expense","Prepaid Expense","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","3","1","1","1","1","1994-06-22 08:33:41","1979-05-19 06:57:02"),
("28","Bank","Bank","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","5","1","1","1","1","1971-10-01 10:27:12","1976-05-18 05:16:49"),
("30","Agent Commission","Agent Commission","Agent Commission.","0","1","3","1","1","1","1","2008-07-14 06:32:42","1982-02-25 22:10:39"),
("31","test demo","test4521","asdasd","","1","3","1","","1","1","2017-08-12 14:09:36","2017-08-12 14:09:36"),
("32","Brac Bank update","Brac Bank update","","","1","5","1","","1","1","2017-08-12 15:50:23","2017-08-12 15:57:28"),
("34","Shahjalal Islami Bank","Shahjalal Islami Bank","","","1","5","1","","1","1","2017-08-13 13:24:20","2017-08-13 13:24:20");




CREATE TABLE `account_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `parent_account_type_id` int(10) unsigned NOT NULL,
  `required_status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_type_parent_account_type_id_foreign` (`parent_account_type_id`),
  CONSTRAINT `account_type_parent_account_type_id_foreign` FOREIGN KEY (`parent_account_type_id`) REFERENCES `parent_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO account_type VALUES
("1","Other Asset","Track special assets like goodwill and other intangible assets","1","0","2005-05-03 06:30:27","1992-03-10 16:19:06"),
("2","Accounts Receivable","Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices","1","1","2013-05-17 00:58:27","2011-06-09 01:01:23"),
("3","Other Current asset","Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds","1","0","2015-03-07 20:07:24","1983-12-16 08:32:02"),
("4","Cash","To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.","1","0","1991-05-21 11:56:08","1983-12-28 09:42:32"),
("5","Bank","To keep track of bank accounts like Savings, Checking, and Money Market accounts","1","0","1994-11-28 23:06:44","2017-04-18 11:51:23"),
("6","Fixed asset","Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture","1","0","2006-06-28 12:12:59","1977-07-20 15:02:31"),
("7","Stock","To keep track of your inventory assets.","1","0","1986-03-15 00:09:54","1978-04-19 17:03:45"),
("9","Other Current Liability","Any short term liability like:Customer Deposits - Tax Payable","2","0","2006-07-31 15:49:00","1978-11-16 02:27:21"),
("10","Credit Card","Create a trail of all your credit card transactions by creating a credit card account","2","0","2016-05-07 16:07:02","2006-11-27 12:42:12"),
("11","Long Term Liability","Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans","2","0","1976-06-23 19:30:55","1981-02-12 02:51:11"),
("12","Other Liability","Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc","2","0","1991-05-06 23:18:20","2006-09-27 21:41:35"),
("13","Accounts Payable","Accounts Payable","2","1","1973-08-25 22:43:00","2001-05-25 00:54:20"),
("14","Equity","Equity","3","0","1977-12-03 23:26:49","1983-10-14 23:01:44"),
("15","income","income","4","0","1990-01-02 01:50:31","1999-05-09 19:14:15"),
("16","Other Income","Other Income","4","0","1985-01-21 13:51:40","1996-04-06 10:46:48"),
("17","Expense","Expense","5","0","1981-01-17 01:56:34","1983-12-30 08:42:02"),
("18","Cost of Goods Sold","Cost of Goods Sold","5","0","1985-03-20 20:46:12","2003-05-23 00:34:11"),
("19","Other Expense","Other Expense","5","0","1982-08-01 18:30:07","1972-11-23 02:01:24");




CREATE TABLE `agents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_pic_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tw_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agents_branch_id_foreign` (`branch_id`),
  KEY `agents_created_by_foreign` (`created_by`),
  KEY `agents_updated_by_foreign` (`updated_by`),
  CONSTRAINT `agents_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agents_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agents_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `agreement_paper` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agreement_paper_created_by_foreign` (`created_by`),
  KEY `agreement_paper_updated_by_foreign` (`updated_by`),
  CONSTRAINT `agreement_paper_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agreement_paper_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `agreement_paper_pax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agreement_paper_id` int(10) unsigned NOT NULL,
  `recruit_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `agreement_paper_pax_agreement_paper_id_foreign` (`agreement_paper_id`),
  KEY `agreement_paper_pax_recruit_id_foreign` (`recruit_id`),
  CONSTRAINT `agreement_paper_pax_agreement_paper_id_foreign` FOREIGN KEY (`agreement_paper_id`) REFERENCES `agreement_paper` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `agreement_paper_pax_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `airlines` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `airlines_created_by_foreign` (`created_by`),
  KEY `airlines_updated_by_foreign` (`updated_by`),
  CONSTRAINT `airlines_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `airlines_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `airlinetaxs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `airline_id` int(10) unsigned NOT NULL,
  `tickettax_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `airlinetaxs_airline_id_foreign` (`airline_id`),
  KEY `airlinetaxs_tickettax_id_foreign` (`tickettax_id`),
  KEY `airlinetaxs_created_by_foreign` (`created_by`),
  KEY `airlinetaxs_updated_by_foreign` (`updated_by`),
  CONSTRAINT `airlinetaxs_airline_id_foreign` FOREIGN KEY (`airline_id`) REFERENCES `airlines` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `airlinetaxs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `airlinetaxs_tickettax_id_foreign` FOREIGN KEY (`tickettax_id`) REFERENCES `tickettaxs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `airlinetaxs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `backup` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `backup_created_by_foreign` (`created_by`),
  KEY `backup_updated_by_foreign` (`updated_by`),
  CONSTRAINT `backup_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `backup_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `backupschedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intervaldays` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `bank` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `particulars` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cheque_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_account_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `payment_mode_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_contact_id_foreign` (`contact_id`),
  KEY `bank_account_id_foreign` (`account_id`),
  KEY `bank_payment_mode_id_foreign` (`payment_mode_id`),
  CONSTRAINT `bank_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bank VALUES
("6","Deposit","41","2017-08-13","","258","","","0","9","34","3","2017-08-13 15:15:53","2017-08-13 15:15:53");




CREATE TABLE `bill` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `order_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `bill_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `due_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_rates` int(11) NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `total_tax` double NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_vendor_id_foreign` (`vendor_id`),
  KEY `bill_created_by_foreign` (`created_by`),
  KEY `bill_updated_by_foreign` (`updated_by`),
  CONSTRAINT `bill_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill VALUES
("1","151","000001","852","852","12-08-2017","12-08-2017","1","","0","","","3","1","1","2017-08-12 12:43:33","2017-08-12 12:43:33"),
("2","55","000002","852","852","2017-08-14","2017-08-19","1","","0","","","3","1","1","2017-08-12 12:46:44","2017-08-12 12:47:07");




CREATE TABLE `bill_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `rate` int(11) NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `amount` double NOT NULL,
  `bill_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_entry_bill_id_foreign` (`bill_id`),
  KEY `bill_entry_account_id_foreign` (`account_id`),
  KEY `bill_entry_tax_id_foreign` (`tax_id`),
  KEY `bill_entry_item_id_foreign` (`item_id`),
  KEY `bill_entry_created_by_foreign` (`created_by`),
  KEY `bill_entry_updated_by_foreign` (`updated_by`),
  CONSTRAINT `bill_entry_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_entry_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_entry_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill_entry VALUES
("1","2","26","1","852","1","852","1","1","1","2017-08-12 12:43:33","2017-08-12 12:43:33"),
("3","2","26","1","852","1","852","2","1","1","2017-08-12 12:47:07","2017-08-12 12:47:07");




CREATE TABLE `branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_description` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `branch_created_by_foreign` (`created_by`),
  KEY `branch_updated_by_foreign` (`updated_by`),
  CONSTRAINT `branch_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `branch_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO branch VALUES
("1","TgXngkbbY7","Rerum rerum ea amet accusantium quod. Facere reiciendis dolore fugit modi accusantium laudantium pariatur. Aut neque molestiae est sed qui saepe cum.","1","1","1985-02-02 03:06:51","2007-11-20 12:39:18"),
("2","aBf3JdPcx2","Deleniti qui inventore blanditiis voluptatem est voluptatem. Soluta vitae temporibus consequatur qui excepturi voluptatem.","1","1","1988-08-29 00:44:57","2004-07-26 03:16:55"),
("3","45NoURfeEo","Sit sit minus omnis porro quis molestiae. Dolorum praesentium quas fuga dolorem neque. Accusantium ipsum accusamus dicta illum qui ipsum quia. Necessitatibus ea excepturi repellendus velit minima exercitationem.","1","1","1972-10-21 05:41:35","1998-10-05 11:26:57"),
("4","MBgV0Y5KEo","Quas voluptatum facilis quod amet. Quidem est dolorem cupiditate nemo sit est. Et illum qui qui quod nostrum totam dignissimos earum.","1","1","2016-04-15 22:46:12","2012-08-23 21:46:28"),
("5","NRh0F5qyRc","Ipsam consequuntur facere facere optio eius omnis rem. Illum corporis eum aliquam quaerat. Dolore quia sunt in aut. Et incidunt delectus et ullam.","1","1","1991-03-16 01:07:02","2015-12-27 03:32:42"),
("6","sI6unfZ3gK","Ipsam similique dolor vel sint eum quasi occaecati. Occaecati a at a cupiditate commodi sit. Quis eveniet laudantium quo qui sunt perspiciatis.","1","1","2008-12-22 11:33:46","1979-11-20 03:39:34"),
("7","eix0pqVlYB","Illum velit veritatis voluptate. Ab facilis voluptas sed et aspernatur. Tempora doloribus cupiditate repellat odit.","1","1","2010-07-05 11:34:02","1983-04-27 05:19:35"),
("8","EJfp3UQQWo","Provident et ea recusandae alias ut aliquam eos repellat. Et non repellendus laborum similique iusto aliquam impedit. Ipsa iusto modi temporibus eligendi. Reprehenderit distinctio pariatur est et eum laudantium qui.","1","1","1980-09-10 17:58:45","2009-11-15 23:29:18"),
("9","EKABcNB7bo","Quod repudiandae natus iste consequatur. Enim aut et suscipit et. Rerum dolorem magni soluta nostrum alias temporibus eos. Ut error magni sed impedit aut at quia.","1","1","1976-06-01 17:22:59","1992-04-26 04:18:15"),
("10","Yu9PAvZgcE","Et molestiae fuga ut ipsum ea. Maiores molestias fugiat perspiciatis culpa explicabo. Velit molestiae cumque ea et.","1","1","1977-01-12 12:22:41","1988-04-09 05:10:20");




CREATE TABLE `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `salary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mealallowance` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `airtransport` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `referencename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nameAr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contactNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyAddress` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `company_created_by_foreign` (`created_by`),
  KEY `company_updated_by_foreign` (`updated_by`),
  CONSTRAINT `company_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `company_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `contact` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `profile_pic_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `skype_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone_number_3` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `billing_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `shipping_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fb_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tw_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_category_id` int(10) unsigned NOT NULL,
  `agent_id` int(10) unsigned DEFAULT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `account_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_contact_category_id_foreign` (`contact_category_id`),
  KEY `contact_agent_id_foreign` (`agent_id`),
  KEY `contact_branch_id_foreign` (`branch_id`),
  KEY `contact_created_by_foreign` (`created_by`),
  KEY `contact_updated_by_foreign` (`updated_by`),
  KEY `contact_account_id_foreign` (`account_id`),
  CONSTRAINT `contact_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_contact_category_id_foreign` FOREIGN KEY (`contact_category_id`) REFERENCES `contact_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO contact VALUES
("3","Empl","One","","Display Empoyee s","","","","","","","","","","","","","","","","","","","","1","3","","1","1","1","2017-08-12 11:52:02","2017-08-12 11:52:16",""),
("4","Vendor ","Name","","Vendor Display update","","","","","","","","","","","","","","","","","","","","1","4","","1","1","1","2017-08-12 11:52:46","2017-08-12 11:53:07",""),
("9","shahjalal","islami","","Shahjalal Islami Bank","","","","","","","","","","","","","","","","","","","","1","5","","1","1","1","2017-08-13 13:24:20","2017-08-13 13:24:20","34"),
("10","ali","azam","","ali azam","","","","","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-13 13:26:38","2017-08-13 13:26:38","");




CREATE TABLE `contact_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_category_description` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `contact_category_created_by_foreign` (`created_by`),
  KEY `contact_category_updated_by_foreign` (`updated_by`),
  CONSTRAINT `contact_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `contact_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO contact_category VALUES
("1","Customer","Customer Description","1","1","2014-08-09 07:00:37","1994-04-20 09:48:53"),
("2","Dealer","Dealer Description","1","1","2011-04-12 07:25:03","1986-10-07 10:25:21"),
("3","Employee","Employee Description","1","1","1972-07-17 14:46:57","1997-07-30 13:33:49"),
("4","Vendor","Vandor Description","1","1","1975-11-26 21:54:06","1986-09-07 08:11:45"),
("5","Bank","Bank Description","1","1","2001-05-09 06:48:55","1973-07-09 07:37:08"),
("6","Agent","Agent Description","1","1","2004-01-20 20:20:55","2011-08-24 03:55:57");




CREATE TABLE `credit_note_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `credit_note_id` int(10) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_note_entries_item_id_foreign` (`item_id`),
  KEY `credit_note_entries_credit_note_id_foreign` (`credit_note_id`),
  KEY `credit_note_entries_tax_id_foreign` (`tax_id`),
  KEY `credit_note_entries_account_id_foreign` (`account_id`),
  KEY `credit_note_entries_created_by_foreign` (`created_by`),
  KEY `credit_note_entries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `credit_note_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_note_entries VALUES
("1","1","25000","25000","0","1","1","1","16","1","1","2017-08-12 12:01:55","2017-08-12 12:01:55");




CREATE TABLE `credit_note_payments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `credit_note_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_note_payments_invoice_id_foreign` (`invoice_id`),
  KEY `credit_note_payments_credit_note_id_foreign` (`credit_note_id`),
  KEY `credit_note_payments_created_by_foreign` (`created_by`),
  KEY `credit_note_payments_updated_by_foreign` (`updated_by`),
  CONSTRAINT `credit_note_payments_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_payments_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_payments_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_payments_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `credit_note_refunds` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `payment_mode_id` int(10) unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `credit_note_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_note_refunds_credit_note_id_foreign` (`credit_note_id`),
  KEY `credit_note_refunds_payment_mode_id_foreign` (`payment_mode_id`),
  KEY `credit_note_refunds_account_id_foreign` (`account_id`),
  KEY `credit_note_refunds_created_by_foreign` (`created_by`),
  KEY `credit_note_refunds_updated_by_foreign` (`updated_by`),
  CONSTRAINT `credit_note_refunds_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_refunds_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_refunds_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_refunds_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_note_refunds_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `credit_notes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `credit_note_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `credit_note_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `shiping_charge` double NOT NULL,
  `adjustment` double NOT NULL,
  `total_credit_note` double NOT NULL,
  `available_credit` double NOT NULL,
  `customer_note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `terms_and_condition` longtext COLLATE utf8_unicode_ci NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_notes_customer_id_foreign` (`customer_id`),
  KEY `credit_notes_created_by_foreign` (`created_by`),
  KEY `credit_notes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `credit_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_notes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_notes VALUES
("1","000001","254","12-08-2017","0","0","25000","25000","","","4","1","1","2017-08-12 12:01:55","2017-08-12 12:01:55");




CREATE TABLE `document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `documentcategory_id` int(10) unsigned NOT NULL,
  `pax_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `notes` longtext COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `document_documentcategory_id_foreign` (`documentcategory_id`),
  KEY `document_created_by_foreign` (`created_by`),
  KEY `document_updated_by_foreign` (`updated_by`),
  CONSTRAINT `document_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `document_documentcategory_id_foreign` FOREIGN KEY (`documentcategory_id`) REFERENCES `documentcategory` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `document_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `documentcategory` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `categoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documentcategory_created_by_foreign` (`created_by`),
  KEY `documentcategory_updated_by_foreign` (`updated_by`),
  CONSTRAINT `documentcategory_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `documentcategory_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `email` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `to` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `details` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `email_created_by_foreign` (`created_by`),
  KEY `email_updated_by_foreign` (`updated_by`),
  CONSTRAINT `email_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `email_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `estimate_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `rate` double NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `estimate_id` int(10) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estimate_entries_tax_id_foreign` (`tax_id`),
  KEY `estimate_entries_item_id_foreign` (`item_id`),
  KEY `estimate_entries_estimate_id_foreign` (`estimate_id`),
  KEY `estimate_entries_created_by_foreign` (`created_by`),
  KEY `estimate_entries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `estimate_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimate_entries_estimate_id_foreign` FOREIGN KEY (`estimate_id`) REFERENCES `estimates` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimate_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimate_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimate_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `estimates` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `estimate_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ref` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attn_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `subject` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `heading` blob,
  `customer_id` int(10) unsigned NOT NULL,
  `terms_conditions` blob,
  `table_head` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `left_notation` blob,
  `right_notation` blob,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `tax_total` double DEFAULT NULL,
  `due_amount` double NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estimates_customer_id_foreign` (`customer_id`),
  CONSTRAINT `estimates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `excess_payment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `payment_receives_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `excess_payment_payment_receives_id_foreign` (`payment_receives_id`),
  KEY `excess_payment_invoice_id_foreign` (`invoice_id`),
  KEY `excess_payment_created_by_foreign` (`created_by`),
  KEY `excess_payment_updated_by_foreign` (`updated_by`),
  CONSTRAINT `excess_payment_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `excess_payment_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `excess_payment_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `excess_payment_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `expense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `paid_through_id` int(10) unsigned NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `tax_type` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_paid_through_id_foreign` (`paid_through_id`),
  KEY `expense_account_id_foreign` (`account_id`),
  KEY `expense_vendor_id_foreign` (`vendor_id`),
  KEY `expense_tax_id_foreign` (`tax_id`),
  KEY `expense_created_by_foreign` (`created_by`),
  KEY `expense_updated_by_foreign` (`updated_by`),
  CONSTRAINT `expense_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expense_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expense_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expense_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expense_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expense_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `expensesector` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` text COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `expensesector_created_by_foreign` (`created_by`),
  KEY `expensesector_updated_by_foreign` (`updated_by`),
  CONSTRAINT `expensesector_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `expensesector_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO expensesector VALUES
("1","258","","1","1","2017-08-13 14:56:24","2017-08-13 14:56:24");




CREATE TABLE `fingerprint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `assignedDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receivingDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paxid` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fingerprint_paxid_foreign` (`paxid`),
  KEY `fingerprint_created_by_foreign` (`created_by`),
  KEY `fingerprint_updated_by_foreign` (`updated_by`),
  CONSTRAINT `fingerprint_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fingerprint_paxid_foreign` FOREIGN KEY (`paxid`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fingerprint_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `flight` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `carrierName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `flightDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_id` int(10) unsigned DEFAULT NULL,
  `paxid` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `flight_vendor_id_foreign` (`vendor_id`),
  KEY `flight_paxid_foreign` (`paxid`),
  KEY `flight_created_by_foreign` (`created_by`),
  KEY `flight_updated_by_foreign` (`updated_by`),
  CONSTRAINT `flight_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `flight_paxid_foreign` FOREIGN KEY (`paxid`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `flight_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `flight_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `form_basis` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `companyNameEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `companyNameBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerNameEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerNameBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licenceEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licenceBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerDesignationEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ownerDesignationBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `setting_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `gamca` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submission_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivary_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `recruit_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gamca_recruit_id_foreign` (`recruit_id`),
  KEY `gamca_created_by_foreign` (`created_by`),
  KEY `gamca_updated_by_foreign` (`updated_by`),
  CONSTRAINT `gamca_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gamca_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `gamca_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `immigration_clearance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `applicationDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_person` int(11) NOT NULL,
  `person_count` int(11) NOT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stampFee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `licenseValidity` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authentication` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `unitWelfareFee` int(11) DEFAULT NULL,
  `incomeTaxType` tinyint(4) NOT NULL DEFAULT '0',
  `unitIncomeTaxNAFee` int(11) DEFAULT NULL,
  `unitIncomeTaxSAFee` int(11) DEFAULT NULL,
  `unitSmartCardFee` int(11) DEFAULT NULL,
  `payOrderDetails` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `WelfareComment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `incomeTaxComment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `SmartCardComment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `immigration_clearance_created_by_foreign` (`created_by`),
  KEY `immigration_clearance_updated_by_foreign` (`updated_by`),
  CONSTRAINT `immigration_clearance_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `immigration_clearance_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `immigration_clearance_pax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `immigration_clearance_id` int(10) unsigned NOT NULL,
  `pax_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `immigration_clearance_pax_immigration_clearance_id_foreign` (`immigration_clearance_id`),
  KEY `immigration_clearance_pax_pax_id_foreign` (`pax_id`),
  CONSTRAINT `immigration_clearance_pax_immigration_clearance_id_foreign` FOREIGN KEY (`immigration_clearance_id`) REFERENCES `immigration_clearance` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `immigration_clearance_pax_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `incomes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double NOT NULL,
  `receive_through_id` int(10) unsigned NOT NULL,
  `tax_total` double DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `tax_type` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `incomes_receive_through_id_foreign` (`receive_through_id`),
  KEY `incomes_account_id_foreign` (`account_id`),
  KEY `incomes_customer_id_foreign` (`customer_id`),
  KEY `incomes_tax_id_foreign` (`tax_id`),
  KEY `incomes_created_by_foreign` (`created_by`),
  KEY `incomes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `incomes_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_receive_through_id_foreign` FOREIGN KEY (`receive_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `incomes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `invoice_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `rate` double NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `tax_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `invoice_entries_item_id_foreign` (`item_id`),
  KEY `invoice_entries_invoice_id_foreign` (`invoice_id`),
  KEY `invoice_entries_tax_id_foreign` (`tax_id`),
  KEY `invoice_entries_account_id_foreign` (`account_id`),
  KEY `invoice_entries_created_by_foreign` (`created_by`),
  KEY `invoice_entries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `invoice_entries_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_entries_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoice_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoice_entries VALUES
("3","1","20000","0","20000","1","3","1","16","1","1","2017-08-13 13:27:16","2017-08-13 13:27:16");




CREATE TABLE `invoices` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `invoice_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `customer_note` longtext COLLATE utf8_unicode_ci,
  `tax_total` double DEFAULT NULL,
  `shipping_charge` double DEFAULT NULL,
  `adjustment` double DEFAULT NULL,
  `total_amount` double NOT NULL,
  `due_amount` double NOT NULL,
  `pr_adjustment` double DEFAULT NULL,
  `pr_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_note` longtext COLLATE utf8_unicode_ci,
  `save` tinyint(4) DEFAULT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `agents_id` int(10) unsigned DEFAULT NULL,
  `agentcommissionAmount` int(11) DEFAULT NULL,
  `commission_type` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `invoices_invoice_number_unique` (`invoice_number`),
  KEY `invoices_customer_id_foreign` (`customer_id`),
  KEY `invoices_created_by_foreign` (`created_by`),
  KEY `invoices_updated_by_foreign` (`updated_by`),
  KEY `invoices_agents_id_foreign` (`agents_id`),
  CONSTRAINT `invoices_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `invoices_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoices VALUES
("3","000001","","","13-08-2017","13-08-2017","","0","0","0","20000","18000","","","","","10","1","1","2017-08-13 13:27:16","2017-08-13 13:27:58","","","0");




CREATE TABLE `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_about` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_sales_description` longtext COLLATE utf8_unicode_ci,
  `item_sales_tax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_account` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_purchase_description` longtext COLLATE utf8_unicode_ci,
  `reorder_point` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `barcode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_purchases` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_sales` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) unsigned NOT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_item_category_id_foreign` (`item_category_id`),
  KEY `item_branch_id_foreign` (`branch_id`),
  KEY `item_created_by_foreign` (`created_by`),
  KEY `item_updated_by_foreign` (`updated_by`),
  CONSTRAINT `item_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO item VALUES
("1","EMS software","","20000","","","2","18000","","","10","","","2","","2","1","1","1","2017-08-12 12:01:08","2017-08-12 12:37:41"),
("2","525","","520","","","","852","","","","","","24","","1","1","1","1","2017-08-12 12:07:04","2017-08-12 12:47:07");




CREATE TABLE `item_category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_category_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_description` longtext COLLATE utf8_unicode_ci,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `item_category_branch_id_foreign` (`branch_id`),
  KEY `item_category_created_by_foreign` (`created_by`),
  KEY `item_category_updated_by_foreign` (`updated_by`),
  CONSTRAINT `item_category_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_category_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `item_category_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO item_category VALUES
("1","Product","Aut quibusdam et dolorem numquam. Voluptate mollitia consequatur et ipsam earum consequatur. Iusto atque eum animi corrupti dolores dicta qui.","5","1","1","2008-01-12 11:13:20","1999-03-09 04:53:20"),
("2","Service","Dolor quis aut omnis ut dicta ea nihil iusto. Eius nam id temporibus ad perspiciatis illo omnis enim. Ex vitae consequuntur fugit quod ullam incidunt.","1","1","1","2011-01-24 08:47:59","1992-12-30 03:53:10");




CREATE TABLE `journal` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8_unicode_ci,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_branch_id_foreign` (`branch_id`),
  KEY `journal_created_by_foreign` (`created_by`),
  KEY `journal_updated_by_foreign` (`updated_by`),
  CONSTRAINT `journal_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO journal VALUES
("2","2017-08-12","adad","asdasd","1","1","1","2017-08-12 14:17:40","2017-08-12 14:17:40");




CREATE TABLE `journal_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `note` longtext COLLATE utf8_unicode_ci,
  `debit_credit` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_name_id` int(10) unsigned NOT NULL,
  `jurnal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `journal_id` int(10) unsigned DEFAULT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `income_id` int(255) unsigned DEFAULT NULL,
  `payment_receives_id` int(10) unsigned DEFAULT NULL,
  `payment_receives_entries_id` int(10) unsigned DEFAULT NULL,
  `credit_note_id` int(10) unsigned DEFAULT NULL,
  `credit_note_refunds_id` int(10) unsigned DEFAULT NULL,
  `expense_id` int(10) unsigned DEFAULT NULL,
  `bill_id` int(10) unsigned DEFAULT NULL,
  `bank_id` int(10) unsigned DEFAULT NULL,
  `bill_entry_id` int(10) unsigned DEFAULT NULL,
  `payment_made_id` int(10) unsigned DEFAULT NULL,
  `payment_made_entry_id` int(10) unsigned DEFAULT NULL,
  `contact_id` int(10) unsigned DEFAULT NULL,
  `tax_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `salesComission_id` int(10) unsigned DEFAULT NULL,
  `agent_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `journal_entries_journal_id_foreign` (`journal_id`),
  KEY `journal_entries_invoice_id_foreign` (`invoice_id`),
  KEY `journal_entries_payment_receives_id_foreign` (`payment_receives_id`),
  KEY `journal_entries_payment_receives_entries_id_foreign` (`payment_receives_entries_id`),
  KEY `journal_entries_credit_note_id_foreign` (`credit_note_id`),
  KEY `journal_entries_credit_note_refunds_id_foreign` (`credit_note_refunds_id`),
  KEY `journal_entries_expense_id_foreign` (`expense_id`),
  KEY `journal_entries_bill_id_foreign` (`bill_id`),
  KEY `journal_entries_bank_id_foreign` (`bank_id`),
  KEY `journal_entries_bill_entry_id_foreign` (`bill_entry_id`),
  KEY `journal_entries_payment_made_id_foreign` (`payment_made_id`),
  KEY `journal_entries_payment_made_entry_id_foreign` (`payment_made_entry_id`),
  KEY `journal_entries_account_name_id_foreign` (`account_name_id`),
  KEY `journal_entries_contact_id_foreign` (`contact_id`),
  KEY `journal_entries_tax_id_foreign` (`tax_id`),
  KEY `journal_entries_created_by_foreign` (`created_by`),
  KEY `journal_entries_updated_by_foreign` (`updated_by`),
  KEY `journal_entries_salescomission_id_foreign` (`salesComission_id`),
  KEY `journal_entries_agent_id_foreign` (`agent_id`),
  CONSTRAINT `journal_entries_account_name_id_foreign` FOREIGN KEY (`account_name_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_agent_id_foreign` FOREIGN KEY (`agent_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_bank_id_foreign` FOREIGN KEY (`bank_id`) REFERENCES `bank` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_bill_entry_id_foreign` FOREIGN KEY (`bill_entry_id`) REFERENCES `bill_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_credit_note_refunds_id_foreign` FOREIGN KEY (`credit_note_refunds_id`) REFERENCES `credit_note_refunds` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_made_entry_id_foreign` FOREIGN KEY (`payment_made_entry_id`) REFERENCES `payment_made_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_receives_entries_id_foreign` FOREIGN KEY (`payment_receives_entries_id`) REFERENCES `payment_receives_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_salescomission_id_foreign` FOREIGN KEY (`salesComission_id`) REFERENCES `salescommisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=121 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO journal_entries VALUES
("1","","0","25000","5","11","","","","","","1","","","","","","","","4","","1","1","2017-08-12 12:01:55","2017-08-12 12:01:55","",""),
("2","","1","25000","16","11","","","","","","1","","","","","","","","4","","1","1","2017-08-12 12:01:55","2017-08-12 12:01:55","",""),
("43","","0","852","11","bill","","","","","","","","","1","","","","","3","","1","1","2017-08-12 12:43:33","2017-08-12 12:43:33","",""),
("44","","1","852","26","bill","","","","","","","","","1","","","","","3","","1","1","2017-08-12 12:43:33","2017-08-12 12:43:33","",""),
("47","","0","852","11","bill","","","","","","","","","2","","","","","3","","1","1","2017-08-12 12:47:07","2017-08-12 12:47:07","",""),
("48","","1","852","26","bill","","","","","","","","","2","","","","","3","","1","1","2017-08-12 12:47:07","2017-08-12 12:47:07","",""),
("53","","0","203","3","payment_made2","","","","","","","","","","","","1","","","","1","1","2017-08-12 12:51:52","2017-08-12 12:51:52","",""),
("54","","1","203","27","payment_made2","","","","","","","","","","","","1","","","","1","1","2017-08-12 12:51:52","2017-08-12 12:51:52","",""),
("64","fgh","0","500","3","journal","2","","","","","","","","","","","","","3","1","1","1","2017-08-12 14:17:40","2017-08-12 14:17:40","",""),
("65","asdasd","1","0","9","journal","2","","","","","","","","","","","","","","","1","1","2017-08-12 14:17:40","2017-08-12 14:17:40","",""),
("66","asdasd","0","0","9","journal","2","","","","","","","","","","","","","","","1","1","2017-08-12 14:17:40","2017-08-12 14:17:40","",""),
("113","","1","20000","5","invoice","","3","","","","","","","","","","","","10","","1","1","2017-08-13 13:27:16","2017-08-13 13:27:16","",""),
("114","","0","20000","16","invoice","","3","","","","","","","","","","","","10","","1","1","2017-08-13 13:27:16","2017-08-13 13:27:16","",""),
("115","","1","2000","34","payment_receive2","","","","4","","","","","","","","","","","","1","1","2017-08-13 00:00:00","2017-08-13 13:27:58","",""),
("116","","0","2000","27","payment_receive2","","","","4","","","","","","","","","","","","1","1","2017-08-13 13:27:58","2017-08-13 13:27:58","",""),
("117","","0","2000","11","payment_receive1","","3","","4","","","","","","","","","","","","1","1","2017-08-13 13:27:58","2017-08-13 13:27:58","",""),
("118","","1","2000","27","payment_receive1","","3","","4","","","","","","","","","","","","1","1","2017-08-13 13:27:58","2017-08-13 13:27:58","",""),
("119","","0","258","34","bank","","","","","","","","","","6","","","","9","","1","1","2017-07-14 00:00:00","2017-08-13 15:15:53","",""),
("120","","0","258","3","bank","","","","","","","","","","6","","","","9","","1","1","2017-08-13 15:15:53","2017-08-13 15:15:53","","");




CREATE TABLE `manpower` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `issuingDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `receivingDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paxid` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manpower_paxid_foreign` (`paxid`),
  KEY `manpower_created_by_foreign` (`created_by`),
  KEY `manpower_updated_by_foreign` (`updated_by`),
  CONSTRAINT `manpower_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_paxid_foreign` FOREIGN KEY (`paxid`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `medical_slip_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateOfApplication` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_slip_form_created_by_foreign` (`created_by`),
  KEY `medical_slip_form_updated_by_foreign` (`updated_by`),
  CONSTRAINT `medical_slip_form_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `medical_slip_form_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `medical_slip_form_pax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medicalslip_id` int(10) unsigned NOT NULL,
  `recruit_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medical_slip_form_pax_medicalslip_id_foreign` (`medicalslip_id`),
  KEY `medical_slip_form_pax_recruit_id_foreign` (`recruit_id`),
  CONSTRAINT `medical_slip_form_pax_medicalslip_id_foreign` FOREIGN KEY (`medicalslip_id`) REFERENCES `medical_slip_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `medical_slip_form_pax_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `medicalslip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `medical_centre` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `testdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reportdate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `medicalslip_pax_id_foreign` (`pax_id`),
  KEY `medicalslip_created_by_foreign` (`created_by`),
  KEY `medicalslip_updated_by_foreign` (`updated_by`),
  CONSTRAINT `medicalslip_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `medicalslip_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `medicalslip_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO migrations VALUES
("1","2014_10_12_000000_create_users_table","1"),
("2","2014_10_12_100000_create_password_resets_table","1"),
("3","2017_01_18_092901_create_user_activations_table","1"),
("4","2017_02_02_053156_create_branch_table","1"),
("5","2017_02_02_053157_create_contact_category_table","1"),
("6","2017_02_02_053222_create_agents_table","1"),
("7","2017_02_02_053223_create_contact_table","1"),
("8","2017_02_10_044930_create_payment_mode_table","1"),
("9","2017_02_10_044940_create_parent_account_type_table","1"),
("10","2017_02_10_045717_create_account_type_table","1"),
("11","2017_02_10_045727_create_account_table","1"),
("12","2017_02_11_053630_create_tax_table","1"),
("13","2017_02_11_053631_create_journal_table","1"),
("14","2017_02_13_181447_create_item_category_table","1"),
("15","2017_02_13_181545_create_item_table","1"),
("16","2017_02_13_181719_create_product_table","1"),
("17","2017_02_13_181753_create_product_phase_table","1"),
("18","2017_02_13_181830_create_product_phase_item_table","1"),
("19","2017_02_20_060418_create_modules_table","1"),
("20","2017_02_20_060419_create_roles_table","1"),
("21","2017_02_20_060456_create_access_level_table","1"),
("22","2017_02_20_170318_create_product_phase_item_add_table","1"),
("23","2017_03_09_071116_create_organization_profiles_table","1"),
("24","2017_04_28_174719_create_invoices_table","1"),
("25","2017_04_28_174745_create_invoice_entries_table","1"),
("26","2017_04_29_161315_create_payment_receives_table","1"),
("27","2017_04_29_161316_create_payment_receives_entries_table","1"),
("28","2017_04_29_161406_create_credit_notes_table","1"),
("29","2017_04_29_161420_create_credit_note_entries_table","1"),
("30","2017_04_29_161439_create_credit_note_payments_table","1"),
("31","2017_04_29_161458_create_credit_note_refunds_table","1"),
("32","2017_05_05_033709_create_excess_payment_table","1"),
("33","2017_06_06_230413_create_expense_table","1"),
("34","2017_06_06_230649_create_bill_table","1"),
("35","2017_06_06_230649_create_stock_table","1"),
("36","2017_06_06_230716_create_bill_entry_table","1"),
("37","2017_06_06_230904_create_payment_made_table","1"),
("38","2017_06_06_230920_create_payment_made_entry_table","1"),
("39","2017_07_02_093820_create_company_table","1"),
("40","2017_07_02_093908_create_okala_table","1"),
("41","2017_07_02_093955_create_fingerprint_table","1"),
("42","2017_07_02_101441_create_recruitingorder_table","1"),
("43","2017_07_02_101541_create_manpower_table","1"),
("44","2017_07_02_101545_create_flight_table","1"),
("45","2017_07_02_101552_create_relation_table","1"),
("46","2017_07_02_111525_create_visaentrys_table","1"),
("47","2017_07_02_112834_create_mofas_table","1"),
("48","2017_07_02_113911_create_relation_mofa_visa_table","1"),
("49","2017_07_02_114007_create_medicalSlip_table","1"),
("50","2017_07_02_114116_create_musaned_table","1"),
("51","2017_07_02_114223_create_visaStamping_table","1"),
("52","2017_07_02_120151_create_relation_Stam_table","1"),
("53","2017_07_03_102404_create_visas_table","1"),
("54","2017_07_09_053945_create_form_basis_table","1"),
("55","2017_07_09_054306_create_medical_slip_form_table","1"),
("56","2017_07_09_054337_create_medical_slip_form_pax_table","1"),
("57","2017_07_09_054343_create_recruit_customer_table","1"),
("58","2017_07_09_054400_create_medical_slip_form_pax_relation_table","1"),
("59","2017_07_09_072348_create_bank_table","1"),
("60","2017_07_09_105254_create_document_cat_table","1"),
("61","2017_07_09_105323_create_document_table","1"),
("62","2017_07_09_105359_document_category_relation_table","1"),
("63","2017_07_10_071211_add_extracolumn_to_company_table","1"),
("64","2017_07_10_071504_add_extracolumn_to_recruting_table","1"),
("65","2017_07_10_102221_create_expensesector_table","1"),
("66","2017_07_10_102313_create_recruiteexpense_table","1"),
("67","2017_07_10_102346_create_expense_pax_table","1"),
("68","2017_07_10_103128_create_expense_sector_pax_relation_table","1"),
("69","2017_07_11_044752_create_agreement_paper_table","1"),
("70","2017_07_11_044810_create_agreement_paper_pax_table","1"),
("71","2017_07_11_044830_create_agreement_paper_pax_relation_table","1"),
("72","2017_07_12_033953_create_incomes_table","1"),
("73","2017_07_13_034016_create_visaacceptance_table","1"),
("74","2017_07_13_034117_create_gamca_table","1"),
("75","2017_07_13_034123_create_visa_process_report_table","1"),
("76","2017_07_13_034137_create_visaacceptance_relation_table","1"),
("77","2017_07_15_041806_add_namear_to_company_table","1"),
("78","2017_07_15_042901_create_visaforms_table","1"),
("79","2017_07_15_043020_create_visaformbulks_table","1"),
("80","2017_07_15_043043_create_visaformagreement_table","1"),
("81","2017_07_15_043130_create_visaform_and_bulk_relation_table","1"),
("82","2017_07_15_043201_create_visaform_and_agreement_relation","1"),
("83","2017_07_15_065551_add_submissiondate_to_visaentry_table","1"),
("84","2017_07_16_063504_add_so_cloumn_to_visaform_table","1"),
("85","2017_07_16_085859_add_Qualification_cloumn_to_recruitcustomer_table","1"),
("86","2017_07_16_091948_create_immigration_clearance_table","1"),
("87","2017_07_16_092030_create_immigration_clearance_pax_table","1"),
("88","2017_07_16_092527_create_immigration_clearance_pax_relation_table","1"),
("89","2017_07_19_064337_create_TicketTaxs_table","1"),
("90","2017_07_19_070312_create_Ticketcommission_table","1"),
("91","2017_07_19_071729_create_TicketTaxsrelation_users_table","1"),
("92","2017_07_20_051731_create_note_sheet_table","1"),
("93","2017_07_20_051753_create_note_sheet_pax_table","1"),
("94","2017_07_20_051813_create_note_sheet_pax_relation_table","1"),
("95","2017_07_20_063113_create_airline_table","1"),
("96","2017_07_20_063202_create_airline_tax_table","1"),
("97","2017_07_20_063236_create_ticket_hotel_table","1"),
("98","2017_07_20_063237_create_airline_tax_relation_table","1"),
("99","2017_07_20_063255_create_ticket_order_table","1"),
("100","2017_07_20_063270_create_ticket_order_tax_table","1");
INSERT INTO migrations VALUES
("101","2017_07_20_063316_create_ticket_order_relation_table","1"),
("102","2017_07_20_085916_create_ticket_airlines_relation_table","1"),
("103","2017_07_22_060301_add_order_id_to_tikcetorder_table","1"),
("104","2017_07_22_064357_create_ticket_document_table","1"),
("105","2017_07_22_065222_create_ticket_relation_table","1"),
("106","2017_07_22_091918_create_backup_table","1"),
("107","2017_07_22_125915_add_tikestan_to_backup_table","1"),
("108","2017_07_23_072134_create_openingbalance_table","1"),
("109","2017_07_25_051426_add_column_to_invoices_table","1"),
("110","2017_07_25_101612_add_relationinvoice_to_invoices_table","1"),
("111","2017_07_25_102109_create_salesComissions_table","1"),
("112","2017_07_26_051806_add_column_tosalesComissions_table","1"),
("113","2017_07_26_064942_add_amount_column_tosalesComissions_table","1"),
("114","2017_07_26_121050_add_paidthrow_column_tosalesComissions_table","1"),
("115","2017_07_29_000713_create_table_reminders_","1"),
("116","2017_08_01_152513_create_email_table","1"),
("117","2017_08_01_152617_create_email_relation_table","1"),
("118","2017_08_01_173308_create_table_estimate","1"),
("119","2017_08_01_173337_create_table_estimate_entries","1"),
("120","2017_10_29_161460_create_journal_entries_table","1"),
("121","2017_11_27_070356_add__column_to_journal_entries_table","1"),
("122","2017_08_12_153258_add_aaccount_id_to_contact_table","2"),
("123","2017_08_13_173159_create_backupshcedule_table","3");




CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO modules VALUES
("1","Contact","contact","1977-07-30 08:13:38","1985-08-01 07:34:54"),
("2","Contact Category","contact/category","1989-08-24 00:38:53","1972-02-29 19:29:58"),
("3","Account Chart","account-chart","1995-06-19 14:10:09","2013-12-11 04:35:33"),
("4","Inventory Item","inventory","1980-02-21 14:30:30","2015-05-06 09:31:30"),
("5","Inventory Category","inventory/category","1979-04-10 21:50:52","2003-01-27 16:55:50"),
("6","Stock Management","stock-management","1990-06-10 03:58:04","2016-10-06 12:28:45"),
("7","Product Track","product-track","1973-09-10 19:50:14","1996-01-18 01:05:58"),
("8","Manual Journal","manual-journal","1984-12-26 18:52:42","1972-01-30 20:04:18"),
("9","Bill","bill","2010-02-26 11:01:47","1996-11-25 12:31:07"),
("10","Credit Note","credit-note","2004-11-30 08:40:40","2015-12-01 02:33:25"),
("11","Credit Note Refund ","credit-note/refund","1983-01-24 02:07:04","2015-10-09 06:42:56"),
("12","Expense","expense","1995-08-11 00:08:10","2009-07-21 09:09:02"),
("13","Inventory","inventory","1981-06-16 16:12:48","1983-10-05 08:48:53"),
("14","Inventory Category","inventory/category","2002-07-02 22:39:39","2000-12-23 00:55:51"),
("15","Invoice","invoice","1974-05-22 12:45:07","1994-12-28 07:14:18"),
("16","Payment Made","payment-made","2014-05-15 00:12:06","1993-04-11 01:57:41"),
("17","Payment Received","payment-received","2001-06-15 11:08:18","1975-06-06 03:14:00"),
("18","Report","report","2004-09-30 02:36:29","2005-07-01 13:17:31");




CREATE TABLE `mofas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `mofaNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `iqamaNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mofaDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mofas_pax_id_foreign` (`pax_id`),
  KEY `mofas_created_by_foreign` (`created_by`),
  KEY `mofas_updated_by_foreign` (`updated_by`),
  CONSTRAINT `mofas_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mofas_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `mofas_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `musaned` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `issue_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `musaned_pax_id_foreign` (`pax_id`),
  KEY `musaned_company_id_foreign` (`company_id`),
  KEY `musaned_created_by_foreign` (`created_by`),
  KEY `musaned_updated_by_foreign` (`updated_by`),
  CONSTRAINT `musaned_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `musaned_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `musaned_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `musaned_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `note_sheet` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `countryGender` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `applicationDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sourceIncomeTax` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `welfareFee` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payOrderNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chalanNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `infoAttestation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payOrderDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chalanDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `certificateAttestation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payOrderAmount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `chalanAmount` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `note_sheet_created_by_foreign` (`created_by`),
  KEY `note_sheet_updated_by_foreign` (`updated_by`),
  CONSTRAINT `note_sheet_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `note_sheet_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `note_sheet_pax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `brifing` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recruit_id` int(10) unsigned NOT NULL,
  `note_sheet_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `note_sheet_pax_note_sheet_id_foreign` (`note_sheet_id`),
  KEY `note_sheet_pax_recruit_id_foreign` (`recruit_id`),
  KEY `note_sheet_pax_created_by_foreign` (`created_by`),
  KEY `note_sheet_pax_updated_by_foreign` (`updated_by`),
  CONSTRAINT `note_sheet_pax_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `note_sheet_pax_note_sheet_id_foreign` FOREIGN KEY (`note_sheet_id`) REFERENCES `note_sheet` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `note_sheet_pax_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `note_sheet_pax_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `okala` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `paxid` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `okala_paxid_foreign` (`paxid`),
  KEY `okala_created_by_foreign` (`created_by`),
  KEY `okala_updated_by_foreign` (`updated_by`),
  CONSTRAINT `okala_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `okala_paxid_foreign` FOREIGN KEY (`paxid`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `okala_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `openningbalances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `openningBalanceDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `openningbalances_created_by_foreign` (`created_by`),
  KEY `openningbalances_updated_by_foreign` (`updated_by`),
  CONSTRAINT `openningbalances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `openningbalances_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `organization_profiles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `logo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `display_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `street` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `city` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `state` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `zip_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO organization_profiles VALUES
("1","logo.png","Ontik Tech","Ontik Technology","Dhanmondi Rd.No. 2","Dhaka","Dhaka","Bangladesh","1200","http://ontiktechnology.com","01xxx xxxxxx","info@ontiktechnology.com","2009-03-28 04:23:21","2009-04-06 05:57:19");




CREATE TABLE `parent_account_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO parent_account_type VALUES
("1","Assets","Assets","1982-09-06 21:28:45","1990-01-11 06:50:06"),
("2","Liability","Liability","1990-01-17 06:28:50","1973-02-28 11:29:07"),
("3","Equity","Equity","1970-05-20 16:29:12","2015-03-02 11:23:18"),
("4","income","income","1987-04-30 09:43:30","2006-12-25 00:24:49"),
("5","Expense","Expense","2002-07-01 19:29:20","2013-01-06 09:22:13");




CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `payment_made` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pm_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode_id` int(10) unsigned NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `excess_amount` double NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_made_payment_mode_id_foreign` (`payment_mode_id`),
  KEY `payment_made_account_id_foreign` (`account_id`),
  KEY `payment_made_vendor_id_foreign` (`vendor_id`),
  KEY `payment_made_created_by_foreign` (`created_by`),
  KEY `payment_made_updated_by_foreign` (`updated_by`),
  CONSTRAINT `payment_made_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_made VALUES
("1","203","2017-08-15","000001","","","1","","203","3","3","1","1","2017-08-12 12:48:48","2017-08-12 12:51:52");




CREATE TABLE `payment_made_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `payment_made_id` int(10) unsigned NOT NULL,
  `bill_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_made_entry_payment_made_id_foreign` (`payment_made_id`),
  KEY `payment_made_entry_bill_id_foreign` (`bill_id`),
  KEY `payment_made_entry_created_by_foreign` (`created_by`),
  KEY `payment_made_entry_updated_by_foreign` (`updated_by`),
  CONSTRAINT `payment_made_entry_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_entry_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_entry_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_made_entry_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `payment_mode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_mode VALUES
("1","Cash","Cash","2016-05-07 03:59:16","1995-03-08 08:03:12"),
("2","Bank Cheque","Bank Cheque","1974-09-23 20:28:08","1974-03-27 19:10:41");




CREATE TABLE `payment_receives` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `payment_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pr_number` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `invoice_show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` longtext COLLATE utf8_unicode_ci,
  `amount` double NOT NULL,
  `excess_payment` double NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `payment_mode_id` int(10) unsigned NOT NULL,
  `account_id` int(10) unsigned NOT NULL,
  `customer_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_receives_payment_mode_id_foreign` (`payment_mode_id`),
  KEY `payment_receives_account_id_foreign` (`account_id`),
  KEY `payment_receives_customer_id_foreign` (`customer_id`),
  KEY `payment_receives_created_by_foreign` (`created_by`),
  KEY `payment_receives_updated_by_foreign` (`updated_by`),
  CONSTRAINT `payment_receives_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `payment_mode` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_receives VALUES
("4","1970-01-01","000001","","454565656","on","","2000","0","","","1","34","10","1","1","2017-08-13 13:27:58","2017-08-13 13:27:58");




CREATE TABLE `payment_receives_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `amount` double NOT NULL,
  `payment_receives_id` int(10) unsigned NOT NULL,
  `invoice_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `payment_receives_entries_payment_receives_id_foreign` (`payment_receives_id`),
  KEY `payment_receives_entries_invoice_id_foreign` (`invoice_id`),
  KEY `payment_receives_entries_created_by_foreign` (`created_by`),
  KEY `payment_receives_entries_updated_by_foreign` (`updated_by`),
  CONSTRAINT `payment_receives_entries_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `payment_receives_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_receives_entries VALUES
("7","2000","4","3","1","1","2017-08-13 13:27:58","2017-08-13 13:27:58");




CREATE TABLE `product` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `total_product` int(11) DEFAULT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_branch_id_foreign` (`branch_id`),
  KEY `product_created_by_foreign` (`created_by`),
  KEY `product_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `product_phase` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `product_phase_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_phase_product_id_foreign` (`product_id`),
  KEY `product_phase_created_by_foreign` (`created_by`),
  KEY `product_phase_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_phase_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `product_phase_item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issued_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `personal_note` longtext COLLATE utf8_unicode_ci,
  `recipient_id` int(11) DEFAULT NULL,
  `issued_by` int(10) unsigned NOT NULL,
  `product_id` int(10) unsigned NOT NULL,
  `product_phase_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_phase_item_issued_by_foreign` (`issued_by`),
  KEY `product_phase_item_product_id_foreign` (`product_id`),
  KEY `product_phase_item_product_phase_id_foreign` (`product_phase_id`),
  KEY `product_phase_item_created_by_foreign` (`created_by`),
  KEY `product_phase_item_updated_by_foreign` (`updated_by`),
  CONSTRAINT `product_phase_item_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_item_issued_by_foreign` FOREIGN KEY (`issued_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_item_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_item_product_phase_id_foreign` FOREIGN KEY (`product_phase_id`) REFERENCES `product_phase` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `product_phase_item_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `product_phase_item_add` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_category_id` int(11) DEFAULT NULL,
  `item_id` int(11) DEFAULT NULL,
  `total` int(11) DEFAULT NULL,
  `product_phase_item_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `product_phase_item_add_product_phase_item_id_foreign` (`product_phase_item_id`),
  CONSTRAINT `product_phase_item_add_product_phase_item_id_foreign` FOREIGN KEY (`product_phase_item_id`) REFERENCES `product_phase_item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `recruit_customer` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateOfBirthEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfBirthBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `addressBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religionEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `religionBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardianName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardianFatherName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardianAddressEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardianAddressBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `guardianReligion` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relationWithCustomer_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relationWithCustomer_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motherName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fatherName` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `placeOfBirth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `previousNationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `presentNationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `maritalStatus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professionEn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professionBn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `professionAR` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `businessAddressEN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `businessAddressBN` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purposeOfTravel` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `durationOfStay` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrivalDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visaAdvice` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recruit_id` int(10) unsigned NOT NULL,
  `pax_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `qualification` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recruit_customer_recruit_id_foreign` (`recruit_id`),
  KEY `recruit_customer_pax_id_foreign` (`pax_id`),
  CONSTRAINT `recruit_customer_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruit_customer_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `recruiteexpense` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `expenseSectorid` int(10) unsigned NOT NULL,
  `expense_id` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recruiteexpense_expensesectorid_foreign` (`expenseSectorid`),
  KEY `recruiteexpense_expense_id_foreign` (`expense_id`),
  CONSTRAINT `recruiteexpense_expense_id_foreign` FOREIGN KEY (`expense_id`) REFERENCES `expense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruiteexpense_expensesectorid_foreign` FOREIGN KEY (`expenseSectorid`) REFERENCES `expensesector` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO recruiteexpense VALUES
("1","1","","2017-08-13 14:56:44","2017-08-13 14:56:44");




CREATE TABLE `recruiteexpensepax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recruitExpenseid` int(10) unsigned NOT NULL,
  `paxid` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `recruiteexpensepax_recruitexpenseid_foreign` (`recruitExpenseid`),
  KEY `recruiteexpensepax_paxid_foreign` (`paxid`),
  CONSTRAINT `recruiteexpensepax_paxid_foreign` FOREIGN KEY (`paxid`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruiteexpensepax_recruitexpenseid_foreign` FOREIGN KEY (`recruitExpenseid`) REFERENCES `recruiteexpense` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO recruiteexpensepax VALUES
("1","1","","2017-08-13 14:56:44","2017-08-13 14:56:44");




CREATE TABLE `recruitingorder` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `package_id` int(10) unsigned NOT NULL,
  `registerSerial_id` int(10) unsigned NOT NULL,
  `paxid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passportNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `passportDate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `passportnumberbn` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `passportissuedate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `placeofissue` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `recruitingorder_paxid_unique` (`paxid`),
  KEY `recruitingorder_customer_id_foreign` (`customer_id`),
  KEY `recruitingorder_package_id_foreign` (`package_id`),
  KEY `recruitingorder_registerserial_id_foreign` (`registerSerial_id`),
  KEY `recruitingorder_invoice_id_foreign` (`invoice_id`),
  KEY `recruitingorder_created_by_foreign` (`created_by`),
  KEY `recruitingorder_updated_by_foreign` (`updated_by`),
  CONSTRAINT `recruitingorder_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruitingorder_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruitingorder_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruitingorder_package_id_foreign` FOREIGN KEY (`package_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruitingorder_registerserial_id_foreign` FOREIGN KEY (`registerSerial_id`) REFERENCES `visaentrys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `recruitingorder_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `reminders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `reminddatetime` datetime DEFAULT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reminders_created_by_foreign` (`created_by`),
  KEY `reminders_updated_by_foreign` (`updated_by`),
  CONSTRAINT `reminders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reminders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `roles_created_by_foreign` (`created_by`),
  KEY `roles_updated_by_foreign` (`updated_by`),
  CONSTRAINT `roles_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `roles_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO roles VALUES
("1","Admin","Quia dolorum eos accusantium ut maiores itaque possimus. Et dolore sed repellendus eius. Eligendi minima sint recusandae facilis. Velit quis a provident aut repudiandae asperiores.","1","1","1995-03-08 09:50:41","2010-07-07 18:43:46"),
("2","Staff","Reprehenderit officia rerum non ea. Dolore qui aliquam voluptas. Non et omnis est temporibus qui quo voluptate earum.","1","1","2004-06-16 23:36:03","2014-04-25 03:53:48"),
("3","Employee","Eaque aliquid qui ex neque. Impedit maxime voluptas numquam ipsa ea autem. Similique quis aut atque iusto vel et optio culpa.","1","1","1972-12-15 22:53:42","1971-05-19 06:57:39");




CREATE TABLE `salescommisions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `agents_id` int(10) unsigned NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `scNumber` int(11) NOT NULL,
  `bank_info` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `show` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `CustomerNote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PersonalNote` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) NOT NULL,
  `paid_through_id` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `salescommisions_agents_id_foreign` (`agents_id`),
  KEY `salescommisions_created_by_foreign` (`created_by`),
  KEY `salescommisions_updated_by_foreign` (`updated_by`),
  KEY `salescommisions_paid_through_id_foreign` (`paid_through_id`),
  CONSTRAINT `salescommisions_agents_id_foreign` FOREIGN KEY (`agents_id`) REFERENCES `agents` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `salescommisions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `salescommisions_paid_through_id_foreign` FOREIGN KEY (`paid_through_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `salescommisions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `stock` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `total` int(11) DEFAULT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_category_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `bill_id` int(10) unsigned DEFAULT NULL,
  `credit_note_id` int(10) unsigned DEFAULT NULL,
  `branch_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `stock_item_category_id_foreign` (`item_category_id`),
  KEY `stock_item_id_foreign` (`item_id`),
  KEY `stock_bill_id_foreign` (`bill_id`),
  KEY `stock_credit_note_id_foreign` (`credit_note_id`),
  KEY `stock_branch_id_foreign` (`branch_id`),
  KEY `stock_created_by_foreign` (`created_by`),
  KEY `stock_updated_by_foreign` (`updated_by`),
  CONSTRAINT `stock_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_credit_note_id_foreign` FOREIGN KEY (`credit_note_id`) REFERENCES `credit_notes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_item_category_id_foreign` FOREIGN KEY (`item_category_id`) REFERENCES `item_category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `stock_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO stock VALUES
("1","1","12-08-2017","2","1","","1","1","1","1","2017-08-12 12:01:55","2017-08-12 12:01:55"),
("3","2","2017-08-12","1","2","","","1","1","1","2017-08-12 12:10:44","2017-08-12 12:10:44"),
("4","20","2017-08-12","1","2","","","1","1","1","2017-08-12 12:11:46","2017-08-12 12:11:46"),
("7","1","12-08-2017","1","2","1","","1","1","1","2017-08-12 12:43:33","2017-08-12 12:43:33"),
("9","1","14-08-2017","1","2","2","","1","1","1","2017-08-12 12:47:07","2017-08-12 12:47:07");




CREATE TABLE `tax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `tax_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount_percentage` int(11) DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tax_created_by_foreign` (`created_by`),
  KEY `tax_updated_by_foreign` (`updated_by`),
  CONSTRAINT `tax_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tax_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO tax VALUES
("1","0%-tax","0","1","1","2001-08-31 05:32:35","2006-04-24 13:10:07"),
("2","5%-tax","5","1","1","1987-04-18 05:53:23","1984-09-09 20:03:29"),
("3","10%-tax","10","1","1","2010-03-03 07:11:03","1992-02-21 17:59:32"),
("4","15%-tax","15","1","1","1989-04-23 21:45:08","1986-06-01 23:50:45"),
("5","20%-tax","20","1","1","2004-09-12 22:18:05","1989-10-28 06:24:59");




CREATE TABLE `ticket_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_document_order_id_foreign` (`order_id`),
  KEY `ticket_document_created_by_foreign` (`created_by`),
  KEY `ticket_document_updated_by_foreign` (`updated_by`),
  CONSTRAINT `ticket_document_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_document_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `ticketorders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_document_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `ticket_hotel` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `country` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_hotel_created_by_foreign` (`created_by`),
  KEY `ticket_hotel_updated_by_foreign` (`updated_by`),
  CONSTRAINT `ticket_hotel_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_hotel_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `ticket_order_tax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_order_id` int(10) unsigned NOT NULL,
  `ticket_tax_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_order_tax_ticket_order_id_foreign` (`ticket_order_id`),
  KEY `ticket_order_tax_ticket_tax_id_foreign` (`ticket_tax_id`),
  CONSTRAINT `ticket_order_tax_ticket_order_id_foreign` FOREIGN KEY (`ticket_order_id`) REFERENCES `ticketorders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticket_order_tax_ticket_tax_id_foreign` FOREIGN KEY (`ticket_tax_id`) REFERENCES `tickettaxs` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `ticketcommissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commissionRate` int(11) NOT NULL,
  `commissionTax` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `ticketorders` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) unsigned NOT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ticket_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pnrcreationDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recordLocator` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureflightCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureflightClass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureFrom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arriveTo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `arrivalTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightbookingClass` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightFrom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightTo` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightdepartureTime` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnflightarrivalDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issuetimeLimit` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `documentNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gdsType` int(11) DEFAULT NULL,
  `pnr` text COLLATE utf8_unicode_ci,
  `issuDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `departureSector` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `returnSector` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `adultPassenger` int(11) DEFAULT NULL,
  `childPassenger` int(11) DEFAULT NULL,
  `infantPassenger` int(11) DEFAULT NULL,
  `hotel_note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  `transactionAmount` int(11) DEFAULT NULL,
  `commissionRate` int(11) DEFAULT NULL,
  `taxOnCommission` int(11) DEFAULT NULL,
  `bill_id` int(10) unsigned DEFAULT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `ticket_hotel_id` int(10) unsigned DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `ticketorders_order_id_unique` (`order_id`),
  KEY `ticketorders_bill_id_foreign` (`bill_id`),
  KEY `ticketorders_invoice_id_foreign` (`invoice_id`),
  KEY `ticketorders_contact_id_foreign` (`contact_id`),
  KEY `ticketorders_vendor_id_foreign` (`vendor_id`),
  KEY `ticketorders_ticket_hotel_id_foreign` (`ticket_hotel_id`),
  KEY `ticketorders_created_by_foreign` (`created_by`),
  KEY `ticketorders_updated_by_foreign` (`updated_by`),
  CONSTRAINT `ticketorders_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_ticket_hotel_id_foreign` FOREIGN KEY (`ticket_hotel_id`) REFERENCES `ticket_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `tickettaxs` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `amount` int(11) NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tickettaxs_created_by_foreign` (`created_by`),
  KEY `tickettaxs_updated_by_foreign` (`updated_by`),
  CONSTRAINT `tickettaxs_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `tickettaxs_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `user_activations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_activations_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` longtext COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(1) DEFAULT '1',
  `activated` tinyint(1) NOT NULL DEFAULT '0',
  `role_id` int(10) unsigned DEFAULT NULL,
  `branch_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_branch_id_foreign` (`branch_id`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `roles` (`id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO users VALUES
("1","YcXm03fIm8","user.jpg","user.jpg","Id nobis sit qui libero. Quia repellendus consequatur suscipit delectus quia sed. Optio repudiandae ducimus ab voluptate. Voluptatem dolorem amet cum molestiae.","admin@gmail.com","$2y$10$MizwoIAXZVYolwkfp7cbT.yFiY3nVVgZnBKVhOg0XA.q7iG8tC4zG","0","1","1","1","1","1","","2007-05-03 00:47:08","2005-08-05 06:01:39");




CREATE TABLE `visa_process_report` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vls_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` text COLLATE utf8_unicode_ci,
  `recruit_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visa_process_report_recruit_id_foreign` (`recruit_id`),
  KEY `visa_process_report_created_by_foreign` (`created_by`),
  KEY `visa_process_report_updated_by_foreign` (`updated_by`),
  CONSTRAINT `visa_process_report_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visa_process_report_recruit_id_foreign` FOREIGN KEY (`recruit_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visa_process_report_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visaacceptance` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visaentry_id` int(10) unsigned NOT NULL,
  `visaadvice_status` tinyint(1) NOT NULL DEFAULT '0',
  `okala_status` tinyint(1) NOT NULL DEFAULT '0',
  `consulator_status` tinyint(1) NOT NULL DEFAULT '0',
  `powerofattorny_status` tinyint(1) NOT NULL DEFAULT '0',
  `botaka_status` tinyint(1) NOT NULL DEFAULT '0',
  `contactform_status` tinyint(1) NOT NULL DEFAULT '0',
  `visaadvice_comment` mediumtext COLLATE utf8_unicode_ci,
  `okala_comment` mediumtext COLLATE utf8_unicode_ci,
  `consulator_comment` mediumtext COLLATE utf8_unicode_ci,
  `powerofattorny_comment` mediumtext COLLATE utf8_unicode_ci,
  `botaka_comment` mediumtext COLLATE utf8_unicode_ci,
  `contactform_comment` mediumtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visaacceptance_visaentry_id_foreign` (`visaentry_id`),
  KEY `visaacceptance_created_by_foreign` (`created_by`),
  KEY `visaacceptance_updated_by_foreign` (`updated_by`),
  CONSTRAINT `visaacceptance_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaacceptance_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaacceptance_visaentry_id_foreign` FOREIGN KEY (`visaentry_id`) REFERENCES `visaentrys` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visaentrys` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `local_Reference` int(10) unsigned NOT NULL,
  `visaNumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `visaIssuedate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `company_id` int(10) unsigned DEFAULT NULL,
  `numberofVisa` int(11) NOT NULL,
  `destination` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `registerSerial` int(11) NOT NULL,
  `flagNum` int(11) DEFAULT NULL,
  `iqamaNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iqamaSector` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visaType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `submissionDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `visaentrys_registerserial_unique` (`registerSerial`),
  KEY `visaentrys_local_reference_foreign` (`local_Reference`),
  KEY `visaentrys_company_id_foreign` (`company_id`),
  KEY `visaentrys_created_by_foreign` (`created_by`),
  KEY `visaentrys_updated_by_foreign` (`updated_by`),
  CONSTRAINT `visaentrys_company_id_foreign` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaentrys_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaentrys_local_reference_foreign` FOREIGN KEY (`local_Reference`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaentrys_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visaformagreement` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visaform_id` int(10) unsigned NOT NULL,
  `agreementEn` text COLLATE utf8_unicode_ci,
  `agreementAr` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visaformagreement_visaform_id_foreign` (`visaform_id`),
  CONSTRAINT `visaformagreement_visaform_id_foreign` FOREIGN KEY (`visaform_id`) REFERENCES `visaforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visaformbulks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `visaform_id` int(10) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateofBirth` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `relationship` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visaformbulks_visaform_id_foreign` (`visaform_id`),
  CONSTRAINT `visaformbulks_visaform_id_foreign` FOREIGN KEY (`visaform_id`) REFERENCES `visaforms` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visaforms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `officeDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authorization` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `footerNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `so` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visaforms_pax_id_foreign` (`pax_id`),
  KEY `visaforms_created_by_foreign` (`created_by`),
  KEY `visaforms_updated_by_foreign` (`updated_by`),
  CONSTRAINT `visaforms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaforms_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visaforms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `visastamping` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `send_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `return_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `eapplication_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `visastamping_pax_id_foreign` (`pax_id`),
  KEY `visastamping_created_by_foreign` (`created_by`),
  KEY `visastamping_updated_by_foreign` (`updated_by`),
  CONSTRAINT `visastamping_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visastamping_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `visastamping_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



SET FOREIGN_KEY_CHECKS=1;

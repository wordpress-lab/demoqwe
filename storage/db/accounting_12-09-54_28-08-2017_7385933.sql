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
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO access_level VALUES
("1","1","1","1","1","1","1","1","1","1999-06-11 16:19:10","2017-08-16 11:11:12"),
("2","1","1","1","1","2","1","1","1","2015-02-11 12:34:16","2017-08-16 11:12:25"),
("3","1","1","1","1","3","1","1","1","2003-09-30 13:40:17","2017-08-16 11:12:25"),
("4","1","1","1","1","1","2","1","1","1984-06-04 20:37:06","2005-02-19 02:14:05"),
("5","1","1","0","0","2","2","1","1","1998-05-09 03:58:29","2014-12-12 15:01:31"),
("6","0","0","1","0","3","2","1","1","2005-08-18 11:52:02","1996-02-29 09:08:33"),
("7","1","1","1","0","1","3","1","1","2014-05-21 21:36:49","1971-06-16 19:47:19"),
("8","1","1","1","0","2","3","1","1","2001-12-24 04:33:14","1982-05-04 01:58:15"),
("9","1","1","1","0","3","3","1","1","1985-02-11 10:37:23","2016-10-17 23:32:36"),
("10","1","1","1","1","4","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:25"),
("11","1","1","1","1","5","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:25"),
("12","1","1","1","1","6","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:25"),
("13","1","1","1","1","7","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:25"),
("14","1","1","1","1","8","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:25"),
("15","1","1","1","1","9","1","1","1","2017-08-16 11:11:13","2017-08-16 11:12:26"),
("16","1","1","1","1","10","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("17","1","1","1","1","11","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("18","1","1","1","1","12","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("19","1","1","1","1","13","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("20","1","1","1","1","14","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("21","1","1","1","1","15","1","1","1","2017-08-16 11:11:14","2017-08-26 17:28:29"),
("22","1","1","1","1","16","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("23","1","1","1","1","17","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:26"),
("24","1","1","1","1","18","1","1","1","2017-08-16 11:11:14","2017-08-16 11:12:27");




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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO account VALUES
("1","Advance Tax","Advance Tax","Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.","0","1","3","1","1","1","1","2002-05-15 02:20:03","2013-08-23 19:57:20"),
("2","Employee Advance","Employee Advance","Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.","0","1","3","1","1","1","1","2005-11-05 05:09:48","2013-11-02 13:44:16"),
("3","Petty Cash","Petty Cash","It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.","0","1","4","1","1","1","1","1979-01-10 22:39:48","2001-11-16 14:15:21"),
("4","Undeposited Funds","Undeposited Funds","Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.","0","1","4","1","1","1","1","2001-02-12 05:55:29","1989-10-12 08:23:07"),
("5","Accounts Receivable","Accounts Receivable","The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.","0","1","2","1","1","1","1","1970-04-10 00:10:10","1985-12-21 08:57:01"),
("6","Inventory Asset","Inventory Asset","An account which tracks the value of goods in your inventory.","0","1","7","1","1","1","1","1971-08-31 10:37:36","2008-02-10 08:05:06"),
("7","Opening Balance Adjustments","Opening Balance Adjustments","This account will hold the difference in the debits and credits entered during the opening balance.","0","1","9","2","1","1","1","2006-07-14 01:27:44","2007-07-19 21:22:31"),
("8","Employee Reimbursements","Employee Reimbursements","This account can be used to track the reimbursements that are due to be paid out to employees.","0","1","9","2","1","1","1","2007-06-17 01:46:23","1997-07-10 12:44:15"),
("9","Tax Payable","Tax Payable","The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.","0","1","9","2","1","1","1","1971-07-06 12:20:40","1999-02-09 02:44:34"),
("10","Unearned Revenue","Unearned Revenue","A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.","0","1","9","2","1","1","1","2006-11-25 21:16:59","2006-06-15 13:46:16"),
("11","Accounts Payable","Accounts Payable","This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.","0","1","13","2","1","1","1","1989-11-28 16:15:28","1980-10-26 18:14:54"),
("12","Tag Adjustments","Tag Adjustments","This adjustment account tracks the transfers between different reporting tags.","0","1","12","2","1","1","1","2013-08-21 19:52:17","1986-11-17 18:20:44"),
("13","Drawings","Drawings","The money withdrawn from a business by its owner can be tracked with this account.","0","1","14","3","1","1","1","1985-11-15 12:11:19","2001-07-25 08:52:49"),
("14","Opening Balance Offset","Opening Balance Offset","This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.","0","1","14","3","1","1","1","1998-08-19 02:47:17","1972-06-07 06:55:03"),
("15","Owner Equity","Owner Equity","The owners rights to the assets of a company can be quantified in the owner\'s equity account.","0","1","14","3","1","1","1","2002-05-11 17:53:32","1974-09-19 18:40:06"),
("16","Sales","Sales","The income from the sales in your business is recorded under the sales account.","0","1","15","4","1","1","1","2006-12-04 12:10:58","1986-01-20 14:25:35"),
("17","General Income","General Income","A general category of account where you can record any income which cannot be recorded into any other category.","0","1","15","4","1","1","1","1986-05-15 00:56:30","2016-11-08 01:45:36"),
("18","Other Charges","Other Charges","Miscellaneous charges like adjustments made to the invoice can be recorded in this account.","0","1","15","4","1","1","1","1994-12-08 07:07:17","1970-05-11 13:25:21"),
("19","Interest Income","Interest Income","A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.","0","1","15","4","1","1","1","2000-06-12 19:41:53","1989-01-09 10:21:50"),
("20","Shipping Charge","Shipping Charge","Shipping charges made to the invoice will be recorded in this account.","0","1","15","4","1","1","1","1996-03-29 13:04:26","1971-05-27 06:44:24"),
("21","Discount","Discount","Any reduction on your selling price as a discount can be recorded into the discount account.","0","1","15","4","1","1","1","1994-01-18 15:02:29","2012-01-20 00:43:34"),
("22","Late Fee Income","Late Fee Income","Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.","0","1","15","4","1","1","1","2009-12-15 15:06:33","2006-03-22 17:46:35"),
("23","Other Expenses","Other Expenses","Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.","0","1","17","5","1","1","1","1984-05-21 17:14:16","2005-04-06 20:32:20"),
("24","Bad Debt","Bad Debt","Any amount which is lost and is unrecoverable is recorded into the bad debt account.","0","1","17","5","1","1","1","1992-02-14 22:28:58","1980-12-01 14:24:56"),
("25","Exchange Gain or Loss","Exchange Gain or Loss","Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.","0","1","19","5","1","1","1","2012-05-28 14:56:28","2000-12-15 00:05:37"),
("26","Cost of Goods Sold","Cost of Goods Sold","An expense account which tracks the value of the goods sold.","0","1","18","5","1","1","1","2006-10-28 13:28:50","2005-02-10 17:16:38"),
("27","Prepaid Expense","Prepaid Expense","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","3","1","1","1","1","2014-02-11 10:26:09","2009-08-19 03:55:05"),
("28","Bank","Bank","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","5","1","1","1","1","1976-08-14 17:06:26","1984-07-13 13:00:25"),
("30","Agent Commission","Agent Commission","Agent Commission.","0","1","3","1","1","1","1","1997-08-01 04:36:37","1978-11-15 11:44:30"),
("32","Brac Bank","Brac Bank","","","1","5","1","","1","1","2017-08-20 11:55:37","2017-08-20 11:55:37"),
("33","3985882852","","","","","17","5","","1","1","2017-08-23 11:34:54","2017-08-23 11:38:06"),
("34","test demo","test4521","","","","3","1","","1","1","2017-08-23 12:21:47","2017-08-23 12:21:47");




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
("1","Other Asset","Track special assets like goodwill and other intangible assets","1","0","1973-02-05 01:31:37","2000-04-29 00:50:30"),
("2","Accounts Receivable","Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices","1","1","2002-01-08 18:40:11","2011-12-21 00:33:02"),
("3","Other Current asset","Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds","1","0","1972-10-17 11:39:49","1991-04-29 17:19:18"),
("4","Cash","To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.","1","0","1992-10-05 12:31:09","1997-10-21 23:08:41"),
("5","Bank","To keep track of bank accounts like Savings, Checking, and Money Market accounts","1","0","1980-09-25 12:07:35","1975-10-28 10:01:34"),
("6","Fixed asset","Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture","1","0","2006-04-15 21:03:04","1974-10-31 23:55:59"),
("7","Stock","To keep track of your inventory assets.","1","0","1981-10-05 09:58:15","2014-07-31 16:22:34"),
("9","Other Current Liability","Any short term liability like:Customer Deposits - Tax Payable","2","0","1997-03-06 06:24:35","1987-07-25 04:52:11"),
("10","Credit Card","Create a trail of all your credit card transactions by creating a credit card account","2","0","1989-07-03 10:26:23","2012-11-15 14:27:54"),
("11","Long Term Liability","Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans","2","0","1984-03-07 18:32:15","2010-02-05 08:27:27"),
("12","Other Liability","Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc","2","0","1976-10-03 05:05:04","1997-10-19 09:07:14"),
("13","Accounts Payable","Accounts Payable","2","1","1987-03-27 00:48:04","1974-12-31 10:53:24"),
("14","Equity","Equity","3","0","2011-08-09 22:59:20","2011-05-09 09:04:49"),
("15","income","income","4","0","1982-09-10 03:13:25","1993-09-16 08:51:03"),
("16","Other Income","Other Income","4","0","2013-12-16 03:37:21","1994-02-27 20:53:57"),
("17","Expense","Expense","5","0","2002-03-27 14:05:59","2002-07-25 03:39:33"),
("18","Cost of Goods Sold","Cost of Goods Sold","5","0","1994-09-10 16:35:50","1991-10-25 19:26:53"),
("19","Other Expense","Other Expense","5","0","2000-10-17 13:17:50","1999-06-29 11:44:17");




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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO agents VALUES
("3","Agent ","","","agent new ","","","","88889999","","","","","","","","","","","","","","","","1","1","1","1","2017-08-23 11:57:38","2017-08-23 11:57:38");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO agreement_paper VALUES
("1","24.08.2017","dfsdf","1","1","2017-08-17 18:00:50","2017-08-17 18:00:50");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO backup VALUES
("1","db/accounting_12-25-42_26-08-2017_8773804.sql","1","1","2017-08-26 12:25:42","2017-08-26 12:25:42"),
("2","db/accounting_12-04-40_28-08-2017_10981581.sql","1","1","2017-08-28 12:04:40","2017-08-28 12:04:40");




CREATE TABLE `backupschedules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `intervaldays` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO backupschedules VALUES
("1","example@yourmail.com","2","2017-08-19 14:17:50","2017-08-19 14:17:50");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bank VALUES
("1","Deposit","asdasda","2017-08-20","asdasdd","500","","","0","13","32","3","2017-08-20 12:10:35","2017-08-20 12:10:35"),
("2","Deposit","asdasda","2017-08-23","","500","","","0","13","32","3","2017-08-23 11:41:43","2017-08-23 11:41:43");




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
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill VALUES
("2","","000001","150000","149350","2017-08-22","2017-08-22","1","","0","","","16","1","1","2017-08-22 15:01:34","2017-08-22 17:00:56"),
("3","151","000002","30","30","2017-08-22","2017-08-22","1","","0","","","14","1","1","2017-08-22 17:21:27","2017-08-22 17:21:51"),
("4","151","000003","3","0","2017-08-23","2017-08-23","1","","0","","","13","1","1","2017-08-23 11:55:47","2017-08-26 16:25:53"),
("5","","000004","150000","150000","2017-08-23","2017-08-24","1","","0","","","14","1","1","2017-08-23 12:39:01","2017-08-23 12:39:01"),
("6","","000005","150","130","2017-08-26","2017-08-26","1","","0","","","13","1","1","2017-08-26 12:03:55","2017-08-26 16:25:53"),
("7","342323","000006","8","8","2017-08-07","2017-08-26","1","","0","","","14","1","1","2017-08-26 16:04:06","2017-08-26 16:04:06"),
("8","425422","000007","325","278","2017-08-26","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:05:10","2017-08-26 16:25:53"),
("9","41524","000008","80","50","2017-08-21","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:05:50","2017-08-26 16:25:53"),
("10","05","000009","801","801","2017-08-24","2017-08-17","1","","0","","","14","1","1","2017-08-26 16:06:50","2017-08-26 16:06:50"),
("11","58774","000010","30","30","2017-08-30","2017-08-02","1","","0","","","13","1","1","2017-08-26 16:09:44","2017-08-26 16:09:44"),
("12","58774","000011","20","20","2017-08-26","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:13:29","2017-08-26 16:13:29"),
("13","58774","000011","8","8","2017-08-31","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:13:49","2017-08-26 16:13:49"),
("14","58774","000011","8","8","2017-08-31","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:15:08","2017-08-26 16:15:08"),
("15","58774","000011","8","8","2017-09-20","2017-08-26","1","","0","","","13","1","1","2017-08-26 16:16:58","2017-08-26 16:17:52"),
("16","58774","000012","3","3","2017-10-13","2017-08-16","1","","0","","","13","1","1","2017-08-26 16:59:28","2017-08-26 16:59:28"),
("17","5223","000013","2","2","2017-11-23","2017-08-24","1","","0","","","13","1","1","2017-08-26 18:05:00","2017-08-26 18:05:00"),
("18","55","000014","54","54","2017-09-18","2017-08-30","1","","0","","","14","1","1","2017-08-26 18:05:54","2017-08-26 18:05:54"),
("19","58774","000015","5","5","2017-08-23","2017-08-24","1","","0","","","14","1","1","2017-08-26 18:09:55","2017-08-26 18:09:55");




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
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill_entry VALUES
("2","1","26","1","150000","1","150000","2","1","1","2017-08-22 15:01:34","2017-08-22 15:01:34"),
("4","2","26","10","3","1","30","3","1","1","2017-08-22 17:21:51","2017-08-22 17:21:51"),
("6","2","26","1","3","1","3","4","1","1","2017-08-23 11:56:04","2017-08-23 11:56:04"),
("7","1","26","1","150000","1","150000","5","1","1","2017-08-23 12:39:01","2017-08-23 12:39:01"),
("8","2","26","1","150","1","150","6","1","1","2017-08-26 12:03:55","2017-08-26 12:03:55"),
("9","3","26","1","8","1","8","7","1","1","2017-08-26 16:04:06","2017-08-26 16:04:06"),
("10","2","26","1","325","1","325","8","1","1","2017-08-26 16:05:10","2017-08-26 16:05:10"),
("11","3","26","1","80","1","80","9","1","1","2017-08-26 16:05:50","2017-08-26 16:05:50"),
("12","3","26","1","801","1","801","10","1","1","2017-08-26 16:06:50","2017-08-26 16:06:50"),
("13","2","26","10","3","1","30","11","1","1","2017-08-26 16:09:44","2017-08-26 16:09:44"),
("14","4","26","1","20","1","20","12","1","1","2017-08-26 16:13:29","2017-08-26 16:13:29"),
("15","3","26","1","8","1","8","13","1","1","2017-08-26 16:13:49","2017-08-26 16:13:49"),
("16","3","26","1","8","1","8","14","1","1","2017-08-26 16:15:08","2017-08-26 16:15:08"),
("18","3","26","1","8","1","8","15","1","1","2017-08-26 16:17:52","2017-08-26 16:17:52"),
("19","2","26","1","3","1","3","16","1","1","2017-08-26 16:59:28","2017-08-26 16:59:28"),
("20","4","26","1","2","1","2","17","1","1","2017-08-26 18:05:01","2017-08-26 18:05:01"),
("21","4","26","1","5","1","5","19","1","1","2017-08-26 18:09:55","2017-08-26 18:09:55");




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
("1","KuTH1rdNyO","Sint aut consequatur rem tenetur consectetur sed rerum. Rerum maxime et unde laborum fuga doloremque modi. Occaecati omnis qui blanditiis et. Qui qui nobis neque officiis culpa.","1","1","2002-11-27 07:43:55","1994-11-25 09:14:34"),
("2","ytM2I4q3Id","Veniam dolorum eaque itaque sit non. Molestiae a porro est commodi dolores. Distinctio vel inventore quidem tempora totam reiciendis id. Officia ipsum repudiandae aut rem sit nihil corrupti quia.","1","1","1999-06-22 01:44:56","1972-03-17 15:51:28"),
("3","ztkulp5Fjh","Nihil illo est sit. Sit sint nemo harum dolore. Ut aliquam ipsa nisi esse repellat eaque. Quia itaque eos ratione magni voluptatem sit rem.","1","1","1971-08-15 01:28:36","1974-10-23 02:14:04"),
("4","VfViig74C7","Dolores voluptatibus praesentium eius. Voluptas nesciunt nisi quaerat vero non quia dolore quia. Enim minima praesentium eveniet fugiat magnam magnam. Quisquam aut non praesentium numquam delectus.","1","1","2015-10-31 06:22:20","2002-12-31 03:12:21"),
("5","IaWnADsVTd","Atque et fugiat aspernatur fugiat asperiores soluta. Nemo a vel tempore sint minus rerum. Ut illo beatae inventore ipsum officiis maiores. Consequuntur et ut vel fugiat.","1","1","1999-08-18 13:20:01","2009-04-07 17:36:39"),
("6","NlZk79lvvQ","Eos ab illo omnis commodi. Nemo ut voluptas qui. Dolor nesciunt ducimus distinctio. Rem voluptatem itaque expedita nulla.","1","1","1986-02-11 10:42:09","1981-10-16 12:50:43"),
("7","5Xe4IkLFCl","Ut et dolor dolor qui expedita et. Eum repellat provident molestias aut autem. Nesciunt occaecati eveniet neque dolorem.","1","1","1996-12-05 22:06:03","1984-06-16 12:33:14"),
("8","wATgEsJzU1","Consequuntur in fuga quam vero. Sapiente quia et autem est ut totam. Quod sit voluptatem cupiditate nesciunt. Rerum voluptatem officia sit sapiente nihil illo qui.","1","1","1975-12-24 10:24:39","1973-08-11 02:06:20"),
("9","iJmzsWJjxy","Corporis eius quam natus. Beatae numquam expedita vel et quibusdam voluptatem. Deleniti velit vel similique sequi.","1","1","2015-01-22 12:48:00","1973-12-03 19:24:13"),
("10","TcPkf9njj8","Pariatur totam maiores deserunt mollitia dolor dolorem. Ut dolor voluptas ut eum harum. Sit quisquam quo et illum est quam qui omnis. Non perspiciatis quaerat ratione ut.","1","1","1994-01-16 22:40:34","1971-03-29 02:18:28");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO company VALUES
("1","Saudi Company","Saudi - 321","1","1","2017-08-16 11:19:05","2017-08-16 11:19:05","15000/=","5000/=","Air Transport FREE","Abdus Sabur Mia","Saudi Company","01996704615","Madina, Saudi Arabia");




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
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO contact VALUES
("13","","","","Brac Bank","","","","154185","","","","","","","","","","","","","","","","1","5","","1","1","1","2017-08-20 11:55:37","2017-08-22 17:17:32","32"),
("14","ali","azam","","ali azam","","","","","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-20 15:06:36","2017-08-20 15:06:36",""),
("15","asdasd","asdasd","","agent display","","","","","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-20 18:09:45","2017-08-20 18:09:45",""),
("16","Vendor ","One","","Vendor Display","","","","","","","","","","","","","","","","","","","","1","4","","1","1","1","2017-08-22 15:01:20","2017-08-22 15:01:20",""),
("17","","","","r test","","","","","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-22 17:12:20","2017-08-22 17:12:20",""),
("18","","","","test","","","","52156298","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-22 17:18:06","2017-08-22 17:18:06",""),
("19","","","","demo c","","","","154185","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-08-23 11:22:38","2017-08-23 11:22:38",""),
("20","Vendor ","demo","","Vendor Display","","","","52156298","","","","","","","","","","","","","","","","1","4","","1","1","1","2017-08-23 12:04:31","2017-08-23 12:04:31","");




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
("1","Customer","Customer Description","1","1","1985-01-16 00:50:15","2011-11-29 00:40:09"),
("2","Dealer","Dealer Description","1","1","1979-10-30 06:03:29","1984-04-20 05:20:24"),
("3","Employee","Employee Description","1","1","1996-06-03 06:16:58","1975-09-12 18:34:03"),
("4","Vendor","Vandor Description","1","1","2003-06-19 10:22:31","2008-07-19 11:02:45"),
("5","Bank","Bank Description","1","1","2003-10-11 01:18:26","2004-09-07 11:13:07"),
("6","Agent","Agent Description","1","1","1985-12-16 03:13:14","2011-07-27 21:54:07");




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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_note_entries VALUES
("2","1","0","0","0","2","2","1","16","1","1","2017-08-23 11:53:17","2017-08-23 11:53:17"),
("3","1","0","0","0","2","3","1","16","1","1","2017-08-23 11:54:10","2017-08-23 11:54:10"),
("6","1","0","","0","2","1","1","16","1","1","2017-08-23 12:19:35","2017-08-23 12:19:35"),
("7","1","0","0","0","3","4","1","16","1","1","2017-08-23 12:19:53","2017-08-23 12:19:53"),
("8","1","5","5","0","2","5","1","16","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("9","10","50","500","0","4","5","1","16","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("10","1","2","2","0","4","5","1","16","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("12","1","500","","45","1","6","2","16","1","1","2017-08-23 18:45:04","2017-08-23 18:45:04");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_note_payments VALUES
("1","524","46","5","1","1","2017-08-23 18:31:56","2017-08-23 18:31:56");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_note_refunds VALUES
("1","0","1","23-08-2017","56154","3","1","1","1","2017-08-23 18:33:17","2017-08-23 18:33:17"),
("2","325.75","1","29.08.2017","45","3","6","1","1","2017-08-23 18:45:38","2017-08-23 18:46:10");




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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_notes VALUES
("1","000001","3524","2017-08-20","0","0","0","0","sadfsad","","13","1","1","2017-08-20 18:04:25","2017-08-20 18:04:25"),
("2","000002","3524","2017-08-23","0","0","0","0","asdasd","","14","1","1","2017-08-23 11:53:17","2017-08-23 11:53:17"),
("3","000003","254","2017-08-23","0","0","0","0","asdasd","","13","1","1","2017-08-23 11:54:10","2017-08-23 11:54:10"),
("4","000004","3524","2017-08-23","0","0","0","0","asdas","","13","1","1","2017-08-23 12:19:53","2017-08-23 12:19:53"),
("5","1","254","26.08.2017","10","10","527","3","asdasd","","14","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("6","000006","454","2017-09-21","25","12","325.75","0","asdas","","14","1","1","2017-08-23 18:44:33","2017-08-23 18:45:38");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO document VALUES
("1","1","1","asdf","uploads/contact/bd8454225c5c633b5304f9a2fa9a4410--profit-and-loss-templates-profit-and-loss-statement-templates283.jpg","","1","1","2017-08-16 12:26:19","2017-08-16 12:26:19"),
("2","1","1","zdfcdszf","uploads/contact/157.","","1","1","2017-08-17 17:38:37","2017-08-17 17:38:37");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO documentcategory VALUES
("1","scanned ","sdfds","1","1","2017-08-16 12:25:33","2017-08-16 12:25:33");




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO estimate_entries VALUES
("3","1","200000","0","200000","1","1","1","16","1","1","2017-08-23 11:42:03","2017-08-23 11:42:03"),
("4","1","5","0","5","2","1","1","16","1","1","2017-08-23 11:42:03","2017-08-23 11:42:03"),
("5","1","200000","0","200000","1","2","1","16","1","1","2017-08-23 11:42:35","2017-08-23 11:42:35");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO estimates VALUES
("1","EST-000003","54224","2017-08-20","2727","jhbujnm","joijkok","<p>i9uhj0iko</p>\n","14","<p>sdfdsf</p>\n","sdfsdf","<p>sdfsf</p>\n","<p>sdfsdf</p>\n","0","0","200005","0","200005","2017-08-20 17:09:59","2017-08-20 17:09:59"),
("2","EST-000003","54224","2017-08-23","dfasdasd","asdasd","asdasd","<p>asdasd</p>\n","14","<p>asdasdasdasd</p>\n","asdsadaasdasdas","<p>asdsadasd</p>\n","<p>asdasdad</p>\n","0","0","200000","0","200000","2017-08-23 11:42:35","2017-08-23 11:42:35");




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
  `expense_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO expense VALUES
("10","2017-08-25","652632","28","0","85","","2","13","1","1","","on","1","1","2017-08-27 17:32:31","2017-08-27 17:32:31","1"),
("11","2017-08-27","200","28","0","","","2","13","1","1","","on","1","1","2017-08-27 17:32:53","2017-08-27 17:32:53","2");




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
("1","Misc.","dfv","1","1","2017-08-16 12:16:21","2017-08-16 12:16:21");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO form_basis VALUES
("1","","","","","","","","","","","formbasis","2017-08-16 12:26:53","2017-08-17 17:58:17");




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






CREATE TABLE `headertemplate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headerType` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO headertemplate VALUES
("4","uploads/template/banner.png","0","2017-08-20 17:44:12","2017-08-28 12:05:41");




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
  `income_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO incomes VALUES
("11","2017-08-27","200","28","0","2332","","2","13","1","1","","on","1","1","2017-08-27 17:35:16","2017-08-27 17:35:16","1"),
("12","2017-08-27","2007","28","0","","","2","13","1","1","","on","1","1","2017-08-27 17:35:33","2017-08-27 17:35:33","2");




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
) ENGINE=InnoDB AUTO_INCREMENT=80 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoice_entries VALUES
("9","1","5","0","5","2","7","1","16","1","1","2017-08-21 14:45:26","2017-08-21 14:45:26"),
("10","1","10","0","10","3","8","1","16","1","1","2017-08-21 14:45:46","2017-08-21 14:45:46"),
("11","1","5","0","5","2","9","1","16","1","1","2017-08-21 14:48:40","2017-08-21 14:48:40"),
("18","10","2000000","0","200000","1","16","1","16","1","1","2017-08-21 14:50:45","2017-08-21 14:50:45"),
("19","10","2000000","0","200000","1","17","1","16","1","1","2017-08-21 14:51:02","2017-08-21 14:51:02"),
("22","1","200000","0","200000","1","19","1","16","1","1","2017-08-22 17:08:17","2017-08-22 17:08:17"),
("28","1","200000","0","200000","1","5","1","16","1","1","2017-08-23 11:44:16","2017-08-23 11:44:16"),
("29","1","10","0","10","3","20","1","16","1","1","2017-08-23 11:48:49","2017-08-23 11:48:49"),
("34","1","200000","0","200000","1","6","1","16","1","1","2017-08-23 11:51:46","2017-08-23 11:51:46"),
("35","1","5","0","5","2","24","1","16","1","1","2017-08-23 11:52:00","2017-08-23 11:52:00"),
("36","1","10","0","10","3","25","1","16","1","1","2017-08-23 11:52:20","2017-08-23 11:52:20"),
("37","1","10","0","10","3","27","3","16","1","1","2017-08-23 12:17:47","2017-08-23 12:17:47"),
("38","1","5","0","5","2","28","1","16","1","1","2017-08-23 12:19:13","2017-08-23 12:19:13"),
("39","1","10","0","10","3","29","1","16","1","1","2017-08-23 12:27:47","2017-08-23 12:27:47"),
("40","1","10","0","10","3","30","1","16","1","1","2017-08-23 12:31:08","2017-08-23 12:31:08"),
("41","1","10","0","10","3","23","1","16","1","1","2017-08-23 12:31:32","2017-08-23 12:31:32"),
("42","1","300","0","300","4","31","1","16","1","1","2017-08-23 12:38:15","2017-08-23 12:38:15"),
("43","1","45","0","45","4","32","1","16","1","1","2017-08-23 17:23:41","2017-08-23 17:23:41"),
("44","1","5","0","5","4","33","1","16","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15"),
("45","1","9.5","5","10","3","33","1","16","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15"),
("46","1","4.5","10","5","2","33","2","16","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15"),
("47","10","200","0","20","4","34","1","16","1","1","2017-08-23 17:35:11","2017-08-23 17:35:11"),
("48","10","100","0","10","3","34","1","16","1","1","2017-08-23 17:35:11","2017-08-23 17:35:11"),
("49","1","5","0","5","2","35","1","16","1","1","2017-08-23 17:37:32","2017-08-23 17:37:32"),
("50","1","30","0","30","2","35","1","16","1","1","2017-08-23 17:37:32","2017-08-23 17:37:32"),
("51","10","100","0","10","3","37","1","16","1","1","2017-08-23 17:38:03","2017-08-23 17:38:03"),
("52","10","475","5","50","4","39","1","16","1","1","2017-08-23 17:42:38","2017-08-23 17:42:38"),
("53","10","1900000","5","200000","1","39","2","16","1","1","2017-08-23 17:42:38","2017-08-23 17:42:38"),
("56","10","300","0","30","4","40","1","16","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41"),
("57","10","50","0","5","2","40","1","16","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41"),
("60","10","3000","0","300","4","41","3","16","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01"),
("61","10","80","20","10","3","41","2","16","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01"),
("67","10","100","0","10","3","45","1","16","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18"),
("68","10","500","0","50","4","45","1","16","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18"),
("69","1","5","0","5","2","46","1","16","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56"),
("70","10","500","0","50","4","46","1","16","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56"),
("71","1","2","0","2","4","46","1","16","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56"),
("74","10","50","0","5","2","47","1","16","1","1","2017-08-23 18:12:34","2017-08-23 18:12:34"),
("75","1","10","0","10","3","48","1","16","1","1","2017-08-26 17:06:18","2017-08-26 17:06:18"),
("76","1","5","0","5","2","50","1","16","1","1","2017-08-26 17:12:24","2017-08-26 17:12:24"),
("77","1","10","0","10","3","57","1","16","1","1","2017-08-26 18:27:52","2017-08-26 18:27:52"),
("78","1","10","0","10","3","59","1","16","1","1","2017-08-26 18:29:56","2017-08-26 18:29:56"),
("79","1","78","0","78","4","60","1","16","1","1","2017-08-26 18:31:25","2017-08-26 18:31:25");




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
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoices VALUES
("5","000001","","","2017-08-20","2017-08-20","   ","0","0","0","199980","199980","20","","","","15","1","1","2017-08-20 15:06:59","2017-08-27 16:06:17","","","0"),
("6","000002","","","2017-08-20","2017-08-20","   ","0","0","0","200000","200000","","","","1","14","1","1","2017-08-20 18:11:02","2017-08-23 11:51:46","","","0"),
("7","000003","","","21-08-2017","21-08-2017","","0","0","0","5","0","","","","","14","1","1","2017-08-21 14:45:26","2017-08-21 14:53:11","","","0"),
("8","000004","","","21-08-2017","21-08-2017","","0","0","0","10","0","0","","","","14","1","1","2017-08-21 14:45:46","2017-08-23 18:19:58","","","0"),
("9","000005","","","21-08-2017","21-08-2017","","0","0","0","5","0","0","","","","14","1","1","2017-08-21 14:48:40","2017-08-23 18:19:58","","","0"),
("16","000012","","","21-08-2017","21-08-2017","","0","0","0","2000000","1999697","0","","","","14","1","1","2017-08-21 14:50:44","2017-08-23 18:19:58","","","0"),
("17","000013","","","21-08-2017","21-08-2017","","0","0","0","2000000","1999990","","","","","14","1","1","2017-08-21 14:51:02","2017-08-21 14:53:11","","","0"),
("19","000015","","","22-08-2017","22-08-2017","","0","0","0","200000","200000","","","","1","13","1","1","2017-08-22 17:08:16","2017-08-22 17:08:16","","","0"),
("20","000016","","","2017-08-22","2017-08-22"," ","0","0","0","10","10","","","","1","14","1","1","2017-08-22 17:08:30","2017-08-23 11:48:49","","","0"),
("23","000017","","","2017-08-23","2017-08-23","   ","0","0","0","10","10","","","","1","13","1","1","2017-08-23 11:43:30","2017-08-23 12:31:32","","","0"),
("24","000018","","","23-08-2017","23-08-2017","","0","0","0","5","5","","","","","14","1","1","2017-08-23 11:52:00","2017-08-23 11:52:00","","","0"),
("25","000019","","","23-08-2017","23-08-2017","","0","0","0","10","10","","","","1","14","1","1","2017-08-23 11:52:20","2017-08-23 11:52:20","","","0"),
("27","000020","","","2017-08-24","2017-08-25","","1","0","0","11","0","","","","","16","1","1","2017-08-23 12:17:47","2017-08-23 12:17:47","","","0"),
("28","000021","","","23-08-2017","23-08-2017","","0","0","0","5","5","","","","","13","1","1","2017-08-23 12:19:13","2017-08-23 12:19:13","","","0"),
("29","000022","","","2017-08-23","2017-08-23","","0","0","0","10","0","","","","","14","1","1","2017-08-23 12:27:47","2017-08-23 12:27:47","","","0"),
("30","000023","","","2017-08-23","2017-08-23","","0","0","0","10","10","","","","","13","1","1","2017-08-23 12:31:08","2017-08-23 12:31:08","","","0"),
("31","000024","","","2017-08-23","2017-08-24","","0","0","0","300","300","","","","","14","1","1","2017-08-23 12:38:15","2017-08-23 12:38:15","","","0"),
("32","000025","","","23-08-2017","23-08-2017","","0","0","0","45","45","","","","","14","1","1","2017-08-23 17:23:41","2017-08-23 17:23:41","3","3","1"),
("33","000026","","","25.08.2017","26.08.2017","","0.225","20","10","49.225","49.225","","","","","13","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","3","3","1"),
("34","000027","","","24.08.2017","24.08.2017","","0","20","10","330","330","","","","","13","1","1","2017-08-23 17:35:11","2017-08-23 17:35:11","3","30","2"),
("35","000028","","","23-08-2017","23-08-2017","","0","10","5","50","50","","","","","14","1","1","2017-08-23 17:37:32","2017-08-23 17:37:32","3","20","2"),
("37","000029","","","23-08-2017","23-08-2017","","0","10","10","120","120","","","","","13","1","1","2017-08-23 17:38:03","2017-08-23 17:38:03","3","20","1"),
("39","000030","","","23-08-2017","23-08-2017","","95000","10","10","1995495","1995495","","","","","14","1","1","2017-08-23 17:42:38","2017-08-23 17:42:38","3","20","1"),
("40","000031","","","2017-08-09","2017-08-09"," ","0","10","10","370","370","","","","1","13","1","1","2017-08-23 17:44:25","2017-08-23 17:46:40","3","20","1"),
("41","000032","","","2018-08-23","2017-08-23"," ","304","10","20","3414","3414","","","","1","13","1","1","2017-08-23 17:53:15","2017-08-23 17:55:00","3","20","2"),
("42","000033","","","27.08.2017","27.08.2017","","200.5","10","30","4299.5","4299.5","","","","","13","1","1","2017-08-23 18:01:19","2017-08-23 18:01:19","3","10","2"),
("43","000034","","","23-08-2017","23-08-2017","","9.4","20","30","203.4","203.4","","","","","14","1","1","2017-08-23 18:01:56","2017-08-23 18:01:56","3","10","2"),
("45","000035","","","23-08-2017","23-08-2017","","0","0","0","600","600","","","","","13","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18","3","10","1"),
("46","000036","","","23-08-2017","23-08-2017","","0","10","10","527","0","","","","","14","1","1","2017-08-23 18:04:56","2017-08-23 18:31:55","3","20","2"),
("47","000037","","","2017-08-31","2017-08-23","  ","0","0","0","50","50","","","","","13","1","1","2017-08-23 18:06:52","2017-08-23 18:22:06","3","20","2"),
("48","000038","","","2017-08-11","2017-08-09","","0","0","0","10","10","","","","","13","1","1","2017-08-26 17:06:18","2017-08-26 17:06:18","","","0"),
("50","000039","","","2017-10-05","2017-08-31","","0","0","0","5","5","","","","","14","1","1","2017-08-26 17:12:24","2017-08-26 17:12:24","","","0"),
("51","000051","","","2017-08-01","2017-08-08","","0","0","0","78","0","","","","","13","1","1","2017-08-26 18:07:50","2017-08-26 18:07:50","","","0"),
("52","000052","","","2017-08-10","2017-08-24","","0","0","0","10","0","","","","","14","1","1","2017-08-26 18:08:19","2017-08-26 18:08:19","","","0"),
("53","000053","","","2017-08-09","2017-08-23","","0","0","0","10","0","","","","","14","1","1","2017-08-26 18:09:29","2017-08-26 18:09:29","","","0"),
("54","000054","","","2017-08-17","2017-08-17","","0","0","0","10","0","","","","","14","1","1","2017-08-26 18:10:23","2017-08-26 18:10:23","","","0"),
("55","000055","","","2017-08-09","2017-08-25","","0","0","0","50","0","","","","","14","1","1","2017-08-26 18:25:19","2017-08-26 18:25:19","","","0"),
("57","000056","","","2017-08-16","2017-08-24","","0","0","0","10","0","","","","","14","1","1","2017-08-26 18:27:51","2017-08-26 18:27:51","","","0"),
("59","000058","","","2017-08-24","2017-08-24","","0","0","0","10","0","","","","","14","1","1","2017-08-26 18:29:56","2017-08-26 18:29:56","","","0"),
("60","000060","","","2017-08-17","2017-08-24","","0","0","0","78","0","","","","","14","1","1","2017-08-26 18:31:24","2017-08-26 18:31:24","","","0");




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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO item VALUES
("1","DHK-SAR","","200000","","","","150000","","","","","","4","","2","1","1","1","2017-08-16 11:16:06","2017-08-23 18:45:04"),
("2","pen","","5","","","1","3","","","50","","","10027","42","1","1","1","1","2017-08-17 10:51:56","2017-08-26 17:12:24"),
("3","pencil","","10","","","2","8","","","10","","","1006","50","1","1","1","1","2017-08-17 10:52:50","2017-08-26 18:29:57"),
("4","paper","","","","","2","","","","20","","","2093","75","1","1","1","1","2017-08-23 11:24:03","2017-08-26 18:31:25");




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
("1","Product","Minima error non aut. Ullam aut suscipit ipsa aliquam nemo dolor repellendus. Deleniti cumque aut ut consectetur.","5","1","1","1977-12-13 10:55:44","2009-06-01 02:51:20"),
("2","Service","Nihil officia rerum quidem saepe. Voluptas tempore voluptatibus harum maxime nisi officiis harum. Sunt doloribus et porro voluptas impedit blanditiis. Sit placeat dicta eveniet facilis qui omnis.","3","1","1","1997-05-29 00:03:58","1998-02-09 08:16:44");




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
("1","2017-08-23","3524","fr","1","1","1","2017-08-23 11:59:08","2017-08-23 11:59:08"),
("2","2023-08-17","254"," sdfdsf","1","1","1","2017-08-23 12:00:48","2017-08-23 12:01:15");




CREATE TABLE `journal_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `note` longtext COLLATE utf8_unicode_ci,
  `debit_credit` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_name_id` int(10) unsigned NOT NULL,
  `jurnal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `pr_adjustment_id` int(255) unsigned DEFAULT NULL,
  `journal_id` int(10) unsigned DEFAULT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `income_id` int(10) unsigned DEFAULT NULL,
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
  `assign_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  KEY `journal_entries_income_id_foreign` (`income_id`),
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
  CONSTRAINT `journal_entries_income_id_foreign` FOREIGN KEY (`income_id`) REFERENCES `incomes` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_journal_id_foreign` FOREIGN KEY (`journal_id`) REFERENCES `journal` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_made_entry_id_foreign` FOREIGN KEY (`payment_made_entry_id`) REFERENCES `payment_made_entry` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_made_id_foreign` FOREIGN KEY (`payment_made_id`) REFERENCES `payment_made` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_receives_entries_id_foreign` FOREIGN KEY (`payment_receives_entries_id`) REFERENCES `payment_receives_entries` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_payment_receives_id_foreign` FOREIGN KEY (`payment_receives_id`) REFERENCES `payment_receives` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_salescomission_id_foreign` FOREIGN KEY (`salesComission_id`) REFERENCES `salescommisions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_tax_id_foreign` FOREIGN KEY (`tax_id`) REFERENCES `tax` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `journal_entries_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=506 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO journal_entries VALUES
("45","","1","52","4","payment_receive2","","","","","3","","","","","","","","","","","","1","1","2017-08-21 13:07:11","2017-08-21 13:07:11","","","2017-08-27 17:01:39"),
("46","","0","52","27","payment_receive2","","","","","3","","","","","","","","","","","","1","1","2017-08-21 13:07:11","2017-08-21 13:07:11","","","2017-08-27 17:01:39"),
("47","","0","20","18","invoice","5","","","","","","","","","","","","","","","","1","1","2017-08-21 13:07:11","2017-08-23 18:18:56","","","2017-08-27 17:01:39"),
("52","","1","5","5","invoice","","","7","","","","","","","","","","","","14","","1","1","2017-08-21 14:45:26","2017-08-21 14:45:26","","","2017-08-27 17:01:39"),
("53","","0","5","16","invoice","","","7","","","","","","","","","","","","14","","1","1","2017-08-21 14:45:26","2017-08-21 14:45:26","","","2017-08-27 17:01:39"),
("54","","1","10","5","invoice","","","8","","","","","","","","","","","","14","","1","1","2017-08-21 14:45:46","2017-08-21 14:45:46","","","2017-08-27 17:01:39"),
("55","","0","10","16","invoice","","","8","","","","","","","","","","","","14","","1","1","2017-08-21 14:45:46","2017-08-21 14:45:46","","","2017-08-27 17:01:39"),
("56","","1","500","3","payment_receive2","","","","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("57","","0","500","27","payment_receive2","","","","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("62","","0","2","11","payment_receive1","","","7","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("63","","1","2","27","payment_receive1","","","7","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("64","","0","2","11","payment_receive1","","","8","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("65","","1","2","27","payment_receive1","","","8","","4","","","","","","","","","","","","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49","","","2017-08-27 17:01:39"),
("66","","1","5","5","invoice","","","9","","","","","","","","","","","","14","","1","1","2017-08-21 14:48:40","2017-08-21 14:48:40","","","2017-08-27 17:01:39"),
("67","","0","5","16","invoice","","","9","","","","","","","","","","","","14","","1","1","2017-08-21 14:48:40","2017-08-21 14:48:40","","","2017-08-27 17:01:39"),
("92","","1","2000000","5","invoice","","","16","","","","","","","","","","","","14","","1","1","2017-08-21 14:50:45","2017-08-21 14:50:45","","","2017-08-27 17:01:39"),
("93","","0","2000000","16","invoice","","","16","","","","","","","","","","","","14","","1","1","2017-08-21 14:50:45","2017-08-21 14:50:45","","","2017-08-27 17:01:39"),
("94","","1","2000000","5","invoice","","","17","","","","","","","","","","","","14","","1","1","2017-08-21 14:51:02","2017-08-21 14:51:02","","","2017-08-27 17:01:39"),
("95","","0","2000000","16","invoice","","","17","","","","","","","","","","","","14","","1","1","2017-08-21 14:51:02","2017-08-21 14:51:02","","","2017-08-27 17:01:39"),
("100","","1","1000","4","payment_receive2","","","","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("101","","0","1000","27","payment_receive2","","","","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("106","","0","3","11","payment_receive1","","","7","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("107","","1","3","27","payment_receive1","","","7","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("108","","0","3","11","payment_receive1","","","8","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("109","","1","3","27","payment_receive1","","","8","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("110","","0","3","11","payment_receive1","","","9","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("111","","1","3","27","payment_receive1","","","9","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10","","","2017-08-27 17:01:39"),
("124","","0","10","11","payment_receive1","","","16","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11","","","2017-08-27 17:01:39"),
("125","","1","10","27","payment_receive1","","","16","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11","","","2017-08-27 17:01:39"),
("126","","0","10","11","payment_receive1","","","17","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11","","","2017-08-27 17:01:39"),
("127","","1","10","27","payment_receive1","","","17","","5","","","","","","","","","","","","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11","","","2017-08-27 17:01:39"),
("130","","0","20","28","payment_made2","","","","","","","","","","","","","1","","","","1","1","2017-08-21 17:16:47","2017-08-21 17:16:47","","","2017-08-27 17:01:39"),
("131","","1","20","27","payment_made2","","","","","","","","","","","","","1","","","","1","1","2017-08-21 17:16:47","2017-08-21 17:16:47","","","2017-08-27 17:01:39"),
("132","","0","150000","11","bill","","","","","","","","","","2","","","","","16","","1","1","2017-08-22 15:01:34","2017-08-22 15:01:34","","","2017-08-27 17:01:39"),
("133","","1","150000","26","bill","","","","","","","","","","2","","","","","16","","1","1","2017-08-22 15:01:35","2017-08-22 15:01:35","","","2017-08-27 17:01:39"),
("134","","0","150","28","payment_made2","","","","","","","","","","","","","2","","","","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01","","","2017-08-27 17:01:39"),
("135","","1","150","27","payment_made2","","","","","","","","","","","","","2","","","","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01","","","2017-08-27 17:01:39"),
("136","","1","150","11","payment_made1","","","","","","","","","","2","","","2","","","","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01","","","2017-08-27 17:01:39"),
("137","","0","150","27","payment_made1","","","","","","","","","","2","","","2","","","","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01","","","2017-08-27 17:01:39"),
("142","","0","500","28","payment_made2","","","","","","","","","","","","","3","","","","1","1","2017-08-22 17:00:56","2017-08-22 17:00:56","","","2017-08-27 17:01:39"),
("143","","1","500","27","payment_made2","","","","","","","","","","","","","3","","","","1","1","2017-08-22 17:00:56","2017-08-22 17:00:56","","","2017-08-27 17:01:39"),
("144","","1","500","11","payment_made1","","","","","","","","","","2","","","3","","","","1","1","2017-08-22 17:00:56","2017-08-22 17:00:56","","","2017-08-27 17:01:39"),
("145","","0","500","27","payment_made1","","","","","","","","","","2","","","3","","","","1","1","2017-08-22 17:00:56","2017-08-22 17:00:56","","","2017-08-27 17:01:39"),
("160","","0","30","11","bill","","","","","","","","","","3","","","","","14","","1","1","2017-08-22 17:21:51","2017-08-22 17:21:51","","","2017-08-27 17:01:39"),
("161","","1","30","26","bill","","","","","","","","","","3","","","","","14","","1","1","2017-08-22 17:21:51","2017-08-22 17:21:51","","","2017-08-27 17:01:39"),
("170","","0","500","32","bank","","","","","","","","","","","1","","","","13","","1","1","2017-08-23 11:41:27","2017-08-23 11:41:27","","","2017-08-27 17:01:39"),
("171","","1","500","3","bank","","","","","","","","","","","1","","","","13","","1","1","2017-08-23 11:41:27","2017-08-23 11:41:27","","","2017-08-27 17:01:39"),
("172","","1","500","32","bank","","","","","","","","","","","2","","","","13","","1","1","2017-08-23 11:41:43","2017-08-23 11:41:43","","","2017-08-27 17:01:39"),
("173","","0","500","3","bank","","","","","","","","","","","2","","","","13","","1","1","2017-08-23 11:41:43","2017-08-23 11:41:43","","","2017-08-27 17:01:39"),
("198","","1","5","5","invoice","","","24","","","","","","","","","","","","14","","1","1","2017-08-23 11:52:00","2017-08-23 11:52:00","","","2017-08-27 17:01:39"),
("199","","0","5","16","invoice","","","24","","","","","","","","","","","","14","","1","1","2017-08-23 11:52:00","2017-08-23 11:52:00","","","2017-08-27 17:01:39"),
("200","","1","52","4","payment_receive2","","","","","6","","","","","","","","","","","","1","1","2017-08-23 11:52:44","2017-08-23 11:52:44","","","2017-08-27 17:01:39"),
("201","","0","52","10","payment_receive2","","","","","6","","","","","","","","","","","","1","1","2017-08-23 11:52:44","2017-08-23 11:52:44","","","2017-08-27 17:01:39"),
("202","","1","52","4","payment_receive2","","","","","2","","","","","","","","","","","","1","1","2017-08-23 11:52:57","2017-08-23 11:52:57","","","2017-08-27 17:01:39"),
("203","","0","52","10","payment_receive2","","","","","2","","","","","","","","","","","","1","1","2017-08-23 11:52:57","2017-08-23 11:52:57","","","2017-08-27 17:01:39"),
("204","","0","0","5","11","","","","","","","2","","","","","","","","14","","1","1","2017-08-23 11:53:17","2017-08-23 11:53:17","","","2017-08-27 17:01:39"),
("205","","1","0","16","11","","","","","","","2","","","","","","","","14","","1","1","2017-08-23 11:53:17","2017-08-23 11:53:17","","","2017-08-27 17:01:39"),
("206","","0","0","5","11","","","","","","","3","","","","","","","","13","","1","1","2017-08-23 11:54:10","2017-08-23 11:54:10","","","2017-08-27 17:01:39"),
("207","","1","0","16","11","","","","","","","3","","","","","","","","13","","1","1","2017-08-23 11:54:10","2017-08-23 11:54:10","","","2017-08-27 17:01:39"),
("220","","0","3","11","bill","","","","","","","","","","4","","","","","13","","1","1","2017-08-23 11:56:04","2017-08-23 11:56:04","","","2017-08-27 17:01:39"),
("221","","1","3","26","bill","","","","","","","","","","4","","","","","13","","1","1","2017-08-23 11:56:04","2017-08-23 11:56:04","","","2017-08-27 17:01:39"),
("226","","0","500","3","payment_made2","","","","","","","","","","","","","4","","","","1","1","2017-08-23 11:56:47","2017-08-23 11:56:47","","","2017-08-27 17:01:39"),
("227","","1","500","27","payment_made2","","","","","","","","","","","","","4","","","","1","1","2017-08-23 11:56:47","2017-08-23 11:56:47","","","2017-08-27 17:01:39"),
("228","","0","0","3","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-23 11:58:10","2017-08-23 11:58:10","2","3","2017-08-27 17:01:39"),
("229","","1","0","11","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-23 11:58:10","2017-08-23 11:58:10","2","3","2017-08-27 17:01:39"),
("230","f","1","200","2","journal","","1","","","","","","","","","","","","","14","1","1","1","2017-08-23 11:59:08","2017-08-23 11:59:08","","","2017-08-27 17:01:39"),
("231","fd","0","200","3","journal","","1","","","","","","","","","","","","","14","1","1","1","2017-08-23 11:59:08","2017-08-23 11:59:08","","","2017-08-27 17:01:39"),
("232","fr","1","0","9","journal","","1","","","","","","","","","","","","","","","1","1","2017-08-23 11:59:08","2017-08-23 11:59:08","","","2017-08-27 17:01:39"),
("233","fr","0","0","9","journal","","1","","","","","","","","","","","","","","","1","1","2017-08-23 11:59:08","2017-08-23 11:59:08","","","2017-08-27 17:01:39"),
("240","","1","11","5","invoice","","","27","","","","","","","","","","","","16","","1","1","2017-08-23 12:17:47","2017-08-23 12:17:47","","","2017-08-27 17:01:39"),
("241","","0","1","9","invoice","","","27","","","","","","","","","","","","16","","1","1","2017-08-23 12:17:47","2017-08-23 12:17:47","","","2017-08-27 17:01:39"),
("242","","0","10","16","invoice","","","27","","","","","","","","","","","","16","","1","1","2017-08-23 12:17:47","2017-08-23 12:17:47","","","2017-08-27 17:01:39"),
("243","","1","5","5","invoice","","","28","","","","","","","","","","","","13","","1","1","2017-08-23 12:19:13","2017-08-23 12:19:13","","","2017-08-27 17:01:39"),
("244","","0","5","16","invoice","","","28","","","","","","","","","","","","13","","1","1","2017-08-23 12:19:13","2017-08-23 12:19:13","","","2017-08-27 17:01:39"),
("245","","0","0","5","11","","","","","","","1","","","","","","","","13","","1","1","2017-08-23 12:19:35","2017-08-23 12:19:35","","","2017-08-27 17:01:39"),
("246","","1","0","16","11","","","","","","","1","","","","","","","","13","","1","1","2017-08-23 12:19:36","2017-08-23 12:19:36","","","2017-08-27 17:01:39"),
("247","","0","0","5","11","","","","","","","4","","","","","","","","13","","1","1","2017-08-23 12:19:53","2017-08-23 12:19:53","","","2017-08-27 17:01:39"),
("248","","1","0","16","11","","","","","","","4","","","","","","","","13","","1","1","2017-08-23 12:19:53","2017-08-23 12:19:53","","","2017-08-27 17:01:39"),
("255","","1","10","5","invoice","","","29","","","","","","","","","","","","14","","1","1","2017-08-23 12:27:47","2017-08-23 12:27:47","","","2017-08-27 17:01:39"),
("256","","0","10","16","invoice","","","29","","","","","","","","","","","","14","","1","1","2017-08-23 00:00:22","2017-08-23 12:27:47","","","2017-08-27 17:01:39"),
("257","","1","10","5","invoice","","","30","","","","","","","","","","","","13","","1","1","2017-08-23 12:31:08","2017-08-23 12:31:08","","","2017-08-27 17:01:39"),
("258","","0","10","16","invoice","","","30","","","","","","","","","","","","13","","1","1","2017-08-23 12:31:08","2017-08-23 12:31:08","","","2017-08-27 17:01:39"),
("259","   ","1","10","5","invoice","","","30","","","","","","","","","","","","13","","1","1","2017-08-23 12:31:32","2017-08-23 12:31:32","","","2017-08-27 17:01:39"),
("260","   ","0","10","16","invoice","","","30","","","","","","","","","","","","13","","1","1","2017-08-23 12:31:32","2017-08-23 12:31:32","","","2017-08-27 17:01:39"),
("261","","1","300","5","invoice","","","31","","","","","","","","","","","","14","","1","1","2017-08-23 12:38:15","2017-08-23 12:38:15","","","2017-08-27 17:01:39"),
("262","","0","300","16","invoice","","","31","","","","","","","","","","","","14","","1","1","2017-08-23 12:38:15","2017-08-23 12:38:15","","","2017-08-27 17:01:39"),
("263","","0","150000","26","bill","","","","","","","","","","5","","","","","14","","1","1","2017-08-23 12:39:01","2017-08-23 12:39:01","","","2017-08-27 17:01:39"),
("264","","1","150000","26","bill","","","","","","","","","","5","","","","","14","","1","1","2017-08-23 12:39:01","2017-08-23 12:39:01","","","2017-08-27 17:01:39"),
("286","","1","1.3499999999999999","30","sales_commission","","","32","","","","","","","","","","","","14","","1","1","2017-08-23 17:23:41","2017-08-23 17:23:41","","3","2017-08-27 17:01:39"),
("287","","0","1.3499999999999999","11","sales_commission","","","32","","","","","","","","","","","","14","","1","1","2017-08-23 17:23:41","2017-08-23 17:23:41","","3","2017-08-27 17:01:39"),
("288","","1","45","5","invoice","","","32","","","","","","","","","","","","14","","1","1","2017-08-23 17:23:41","2017-08-23 17:23:41","","","2017-08-27 17:01:39"),
("289","","0","45","16","invoice","","","32","","","","","","","","","","","","14","","1","1","2017-08-23 17:23:42","2017-08-23 17:23:42","","","2017-08-27 17:01:39"),
("290","","1","1.47675","30","sales_commission","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","3","2017-08-27 17:01:39"),
("291","","0","1.47675","11","sales_commission","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","3","2017-08-27 17:01:39"),
("292","","1","49.225","5","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39"),
("293","","1","1","21","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39"),
("294","","0","0.225","9","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39"),
("295","","0","20","20","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39"),
("296","","0","10","18","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39"),
("297","","0","20","16","invoice","","","33","","","","","","","","","","","","13","","1","1","2017-08-23 17:30:15","2017-08-23 17:30:15","","","2017-08-27 17:01:39");
INSERT INTO journal_entries VALUES
("298","","1","30","30","sales_commission","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:11","2017-08-23 17:35:11","","3","2017-08-27 17:01:39"),
("299","","0","30","11","sales_commission","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:12","2017-08-23 17:35:12","","3","2017-08-27 17:01:39"),
("300","","1","330","5","invoice","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:12","2017-08-23 17:35:12","","","2017-08-27 17:01:39"),
("301","","0","20","20","invoice","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:12","2017-08-23 17:35:12","","","2017-08-27 17:01:39"),
("302","","0","10","18","invoice","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:12","2017-08-23 17:35:12","","","2017-08-27 17:01:39"),
("303","","0","300","16","invoice","","","34","","","","","","","","","","","","13","","1","1","2017-08-23 17:35:12","2017-08-23 17:35:12","","","2017-08-27 17:01:39"),
("310"," ","1","74","30","sales_commission","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","3","2017-08-27 17:01:39"),
("311"," ","0","74","11","sales_commission","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","3","2017-08-27 17:01:39"),
("312"," ","1","370","5","invoice","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","","2017-08-27 17:01:39"),
("313"," ","0","10","20","invoice","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","","2017-08-27 17:01:39"),
("314"," ","0","10","18","invoice","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","","2017-08-27 17:01:39"),
("315"," ","0","350","16","invoice","","","40","","","","","","","","","","","","13","","1","1","2017-08-23 17:46:41","2017-08-23 17:46:41","","","2017-08-27 17:01:39"),
("324"," ","1","20","30","sales_commission","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","3","2017-08-27 17:01:39"),
("325"," ","0","20","11","sales_commission","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","3","2017-08-27 17:01:39"),
("326"," ","1","3414","5","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("327"," ","1","20","21","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("328"," ","0","304","9","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("329"," ","0","10","20","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("330"," ","0","20","18","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("331"," ","0","3080","16","invoice","","","41","","","","","","","","","","","","13","","1","1","2017-08-23 17:55:01","2017-08-23 17:55:01","","","2017-08-27 17:01:39"),
("332","","1","60","30","sales_commission","","","45","","","","","","","","","","","","13","","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18","","3","2017-08-27 17:01:39"),
("333","","0","60","11","sales_commission","","","45","","","","","","","","","","","","13","","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18","","3","2017-08-27 17:01:39"),
("334","","1","600","5","invoice","","","45","","","","","","","","","","","","13","","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18","","","2017-08-27 17:01:39"),
("335","","0","600","16","invoice","","","45","","","","","","","","","","","","13","","1","1","2017-08-23 18:03:18","2017-08-23 18:03:18","","","2017-08-27 17:01:39"),
("336","","1","20","30","sales_commission","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","3","2017-08-27 17:01:39"),
("337","","0","20","11","sales_commission","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","3","2017-08-27 17:01:39"),
("338","","1","527","5","invoice","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","","2017-08-27 17:01:39"),
("339","","0","10","20","invoice","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","","2017-08-27 17:01:39"),
("340","","0","10","18","invoice","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","","2017-08-27 17:01:39"),
("341","","0","507","16","invoice","","","46","","","","","","","","","","","","14","","1","1","2017-08-23 18:04:56","2017-08-23 18:04:56","","","2017-08-27 17:01:39"),
("350","  ","1","20","30","sales_commission","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:12:34","2017-08-23 18:12:34","","3","2017-08-27 17:01:39"),
("351","  ","0","20","11","sales_commission","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:12:34","2017-08-23 18:12:34","","3","2017-08-27 17:01:39"),
("352","  ","1","50","5","invoice","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:12:34","2017-08-23 18:12:34","","","2017-08-27 17:01:39"),
("353","  ","0","50","16","invoice","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:12:34","2017-08-23 18:12:34","","","2017-08-27 17:01:39"),
("362","","1","200","4","payment_receive2","","","","","1","","","","","","","","","","","","1","1","2017-08-23 18:18:56","2017-08-23 18:18:56","","","2017-08-27 17:01:39"),
("363","","0","200","10","payment_receive2","","","","","1","","","","","","","","","","","","1","1","2017-08-23 18:18:56","2017-08-23 18:18:56","","","2017-08-27 17:01:39"),
("364","","0","200","11","payment_receive1","","","5","","1","","","","","","","","","","","","1","1","2017-08-23 18:18:56","2017-08-23 18:18:56","","","2017-08-27 17:01:39"),
("365","","1","200","10","payment_receive1","","","5","","1","","","","","","","","","","","","1","1","2017-08-23 18:18:56","2017-08-23 18:18:56","","","2017-08-27 17:01:39"),
("366","","1","300","3","payment_receive2","","","","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("367","","0","300","10","payment_receive2","","","","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("368","","0","5","11","payment_receive1","","","8","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("369","","1","5","10","payment_receive1","","","8","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("370","","0","2","11","payment_receive1","","","9","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("371","","1","2","10","payment_receive1","","","9","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("372","","0","293","11","payment_receive1","","","16","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("373","","1","293","10","payment_receive1","","","16","","7","","","","","","","","","","","","1","1","2017-08-23 18:19:58","2017-08-23 18:19:58","","","2017-08-27 17:01:39"),
("374","  ","1","20","30","sales_commission","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:22:06","2017-08-23 18:22:06","","3","2017-08-27 17:01:39"),
("375","  ","1","20","30","sales_commission","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:22:06","2017-08-23 18:22:06","","3","2017-08-27 17:01:39"),
("376","  ","0","20","11","sales_commission","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:22:06","2017-08-23 18:22:06","","3","2017-08-27 17:01:39"),
("377","  ","1","50","11","invoice","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:22:06","2017-08-23 18:22:06","","3","2017-08-27 17:01:39"),
("378","  ","1","50","5","invoice","","","47","","","","","","","","","","","","13","","1","1","2017-08-23 18:22:06","2017-08-23 18:22:06","","","2017-08-27 17:01:39"),
("379","","0","3","5","paymentreceive1","","","46","","2","","","","","","","","","","14","","1","1","2017-08-23 18:23:08","2017-08-23 18:23:08","","","2017-08-27 17:01:39"),
("380","","1","3","10","paymentreceive1","","","46","","2","","","","","","","","","","14","","1","1","2017-08-23 18:23:08","2017-08-23 18:23:08","","","2017-08-27 17:01:39"),
("381","","0","527","5","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("382","","1","10","20","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("383","","0","10","18","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("384","","1","5","16","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("385","","1","500","16","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("386","","1","2","16","11","","","","","","","5","","","","","","","","14","","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55","","","2017-08-27 17:01:39"),
("387","","1","0","5","12","","","","","","","1","1","","","","","","","13","","1","1","2017-08-23 18:33:17","2017-08-23 18:33:17","","","2017-08-27 17:01:39"),
("388","","0","0","3","12","","","","","","","1","1","","","","","","","13","","1","1","2017-08-23 18:33:17","2017-08-23 18:33:17","","","2017-08-27 17:01:39"),
("395","","0","325.75","5","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("396","","0","13.75","9","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("397","","0","225","21","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("398","","1","25","20","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("399","","0","12","18","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("400","","1","500","16","11","","","","","","","6","","","","","","","","14","","1","1","2017-08-23 18:45:05","2017-08-23 18:45:05","","","2017-08-27 17:01:39"),
("403","","1","325.75","5","12","","","","","","","6","2","","","","","","","14","","1","1","2017-08-23 18:46:10","2017-08-23 18:46:10","","","2017-08-27 17:01:39"),
("404","","0","325.75","3","12","","","","","","","6","2","","","","","","","14","","1","1","2017-08-23 18:46:10","2017-08-23 18:46:10","","","2017-08-27 17:01:39"),
("405","","0","150","26","bill","","","","","","","","","","6","","","","","13","","1","1","2017-08-26 12:03:55","2017-08-26 12:03:55","","","2017-08-27 17:01:39"),
("406","","1","150","26","bill","","","","","","","","","","6","","","","","13","","1","1","2017-08-26 12:03:55","2017-08-26 12:03:55","","","2017-08-27 17:01:39"),
("413","","0","8","11","bill","","","","","","","","","","7","","","","","14","","1","1","2017-08-26 16:04:06","2017-08-26 16:04:06","","","2017-08-27 17:01:39"),
("414","","1","8","26","bill","","","","","","","","","","7","","","","","14","","1","1","2017-08-26 16:04:06","2017-08-26 16:04:06","","","2017-08-27 17:01:39"),
("415","","0","325","11","bill","","","","","","","","","","8","","","","","13","","1","1","2017-08-26 16:05:10","2017-08-26 16:05:10","","","2017-08-27 17:01:39"),
("416","","1","325","26","bill","","","","","","","","","","8","","","","","13","","1","1","2017-08-26 16:05:10","2017-08-26 16:05:10","","","2017-08-27 17:01:39"),
("417","","0","80","11","bill","","","","","","","","","","9","","","","","13","","1","1","2017-08-26 16:05:50","2017-08-26 16:05:50","","","2017-08-27 17:01:39"),
("418","","1","80","26","bill","","","","","","","","","","9","","","","","13","","1","1","2017-08-26 16:05:50","2017-08-26 16:05:50","","","2017-08-27 17:01:39"),
("419","","0","801","11","bill","","","","","","","","","","10","","","","","14","","1","1","2017-08-26 16:06:50","2017-08-26 16:06:50","","","2017-08-27 17:01:39"),
("420","","1","801","26","bill","","","","","","","","","","10","","","","","14","","1","1","2017-08-26 16:06:50","2017-08-26 16:06:50","","","2017-08-27 17:01:39"),
("421","","0","30","11","bill","","","","","","","","","","11","","","","","13","","1","1","2017-08-26 16:09:44","2017-08-26 16:09:44","","","2017-08-27 17:01:39"),
("422","","1","30","26","bill","","","","","","","","","","11","","","","","13","","1","1","2017-08-26 16:09:44","2017-08-26 16:09:44","","","2017-08-27 17:01:39"),
("423","","0","8","11","bill","","","","","","","","","","14","","","","","13","","1","1","2017-08-26 16:15:08","2017-08-26 16:15:08","","","2017-08-27 17:01:39"),
("426","","0","8","11","bill","","","","","","","","","","15","","","","","13","","1","1","2017-08-26 16:17:52","2017-08-26 16:17:52","","","2017-08-27 17:01:39"),
("427","","1","8","26","bill","","","","","","","","","","15","","","","","13","","1","1","2017-08-26 16:17:52","2017-08-26 16:17:52","","","2017-08-27 17:01:39"),
("446","","0","100","3","payment_made2","","","","","","","","","","","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("447","","1","100","27","payment_made2","","","","","","","","","","","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("448","","1","3","11","payment_made1","","","","","","","","","","4","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("449","","0","3","27","payment_made1","","","","","","","","","","4","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("450","","1","20","11","payment_made1","","","","","","","","","","6","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("451","","0","20","27","payment_made1","","","","","","","","","","6","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("452","","1","47","11","payment_made1","","","","","","","","","","8","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("453","","0","47","27","payment_made1","","","","","","","","","","8","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("454","","1","30","11","payment_made1","","","","","","","","","","9","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("455","","0","30","27","payment_made1","","","","","","","","","","9","","","5","","","","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53","","","2017-08-27 17:01:39"),
("456","","0","200","28","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-26 16:48:19","2017-08-26 16:48:19","3","3","2017-08-27 17:01:39"),
("457","","1","200","11","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-26 16:48:19","2017-08-26 16:48:19","3","3","2017-08-27 17:01:39"),
("458","","0","800","3","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-26 16:48:55","2017-08-26 18:51:24","4","3","2017-08-27 17:01:39"),
("459","","1","800","11","sales_commission","","","","","","","","","","","","","","","","","1","1","2017-08-26 16:48:55","2017-08-26 18:51:24","4","3","2017-08-27 17:01:39"),
("460","","0","3","26","bill","","","","","","","","","","16","","","","","13","","1","1","2017-08-26 16:59:29","2017-08-26 16:59:29","","","2017-08-27 17:01:39"),
("461","","1","3","26","bill","","","","","","","","","","16","","","","","13","","1","1","2017-08-26 16:59:29","2017-08-26 16:59:29","","","2017-08-27 17:01:39");
INSERT INTO journal_entries VALUES
("462","","1","10","5","invoice","","","48","","","","","","","","","","","","13","","1","1","2017-08-26 17:06:18","2017-08-26 17:06:18","","","2017-08-27 17:01:39"),
("463","","0","10","16","invoice","","","48","","","","","","","","","","","","13","","1","1","2017-08-26 17:06:19","2017-08-26 17:06:19","","","2017-08-27 17:01:39"),
("464","","1","5","5","invoice","","","50","","","","","","","","","","","","14","","1","1","2017-08-26 17:12:24","2017-08-26 17:12:24","","","2017-08-27 17:01:39"),
("465","","0","5","16","invoice","","","50","","","","","","","","","","","","14","","1","1","2017-08-26 17:12:24","2017-08-26 17:12:24","","","2017-08-27 17:01:39"),
("469","","0","2","26","bill","","","","","","","","","","17","","","","","13","","1","1","2017-08-26 18:05:01","2017-08-26 18:05:01","","","2017-08-27 17:01:39"),
("470","","1","2","26","bill","","","","","","","","","","17","","","","","13","","1","1","2017-08-26 18:05:01","2017-08-26 18:05:01","","","2017-08-27 17:01:39"),
("471","","0","5","26","bill","","","","","","","","","","19","","","","","14","","1","1","2017-08-26 18:09:55","2017-08-26 18:09:55","","","2017-08-27 17:01:39"),
("472","","1","5","26","bill","","","","","","","","","","19","","","","","14","","1","1","2017-08-26 18:09:55","2017-08-26 18:09:55","","","2017-08-27 17:01:39"),
("473","","1","10","5","invoice","","","59","","","","","","","","","","","","14","","1","1","2017-08-26 18:29:56","2017-08-26 18:29:56","","","2017-08-27 17:01:39"),
("474","","0","10","16","invoice","","","59","","","","","","","","","","","","14","","1","1","2017-08-26 18:29:57","2017-08-26 18:29:57","","","2017-08-27 17:01:39"),
("475","","1","78","5","invoice","","","60","","","","","","","","","","","","14","","1","1","2017-08-26 18:31:25","2017-08-26 18:31:25","","","2017-08-27 17:01:39"),
("476","","0","78","16","invoice","","","60","","","","","","","","","","","","14","","1","1","2017-08-26 18:31:25","2017-08-26 18:31:25","","","2017-08-27 17:01:39"),
("477","   ","1","199980","5","invoice","","","5","","","","","","","","","","","","15","","1","1","2017-08-27 16:06:17","2017-08-27 16:06:17","","","2017-08-27 17:01:39"),
("478","   ","0","200000","16","invoice","","","5","","","","","","","","","","","","15","","1","1","2017-08-27 16:06:17","2017-08-27 16:06:17","","","2017-08-27 17:01:39"),
("491","","0","652632","28","expense","","","","","","","","","10","","","","","","13","","1","1","2017-08-27 17:32:31","2017-08-27 17:32:31","","","2017-08-25 00:00:00"),
("492","","1","652632","2","expense","","","","","","","","","10","","","","","","13","","1","1","2017-08-27 17:32:31","2017-08-27 17:32:31","","","2017-08-25 00:00:00"),
("493","","1","0","9","expense","","","","","","","","","10","","","","","","13","","1","1","2017-08-27 17:32:31","2017-08-27 17:32:31","","","2017-08-25 00:00:00"),
("494","","0","200","28","expense","","","","","","","","","11","","","","","","13","","1","1","2017-08-27 17:32:53","2017-08-27 17:32:53","","","2017-08-27 00:00:00"),
("495","","1","200","2","expense","","","","","","","","","11","","","","","","13","","1","1","2017-08-27 17:32:53","2017-08-27 17:32:53","","","2017-08-27 00:00:00"),
("496","","1","0","9","expense","","","","","","","","","11","","","","","","13","","1","1","2017-08-27 17:32:53","2017-08-27 17:32:53","","","2017-08-27 00:00:00"),
("500","","1","200","28","income","","","","11","","","","","","","","","","","13","","1","1","2017-08-27 17:35:16","2017-08-27 17:35:16","","","2017-08-27 00:00:00"),
("501","","0","200","2","income","","","","11","","","","","","","","","","","13","","1","1","2017-08-27 17:35:16","2017-08-27 17:35:16","","","2017-08-27 00:00:00"),
("502","","0","0","9","income","","","","11","","","","","","","","","","","13","","1","1","2017-08-27 17:35:16","2017-08-27 17:35:16","","","2017-08-27 00:00:00"),
("503","","1","2007","28","income","","","","12","","","","","","","","","","","13","","1","1","2017-08-27 17:35:33","2017-08-27 17:35:33","","","2017-08-27 00:00:00"),
("504","","0","2007","2","income","","","","12","","","","","","","","","","","13","","1","1","2017-08-27 17:35:33","2017-08-27 17:35:33","","","2017-08-27 00:00:00"),
("505","","0","0","9","income","","","","12","","","","","","","","","","","13","","1","1","2017-08-27 17:35:33","2017-08-27 17:35:33","","","2017-08-27 00:00:00");




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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO medical_slip_form VALUES
("1","16.08.2017","DHAKA","1","1","2017-08-16 12:29:02","2017-08-16 12:29:02"),
("2","17.08.2017","retget","1","1","2017-08-17 18:00:06","2017-08-17 18:00:06"),
("3","24.08.2017","qawqeq","1","1","2017-08-17 18:00:20","2017-08-17 18:00:20");




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
) ENGINE=InnoDB AUTO_INCREMENT=134 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


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
("120","2017_08_12_153258_add_aaccount_id_to_contact_table","1"),
("121","2017_08_13_173159_create_backupshcedule_table","1"),
("122","2017_10_29_161460_create_journal_entries_table","1"),
("123","2017_11_27_070356_add__column_to_journal_entries_table","1"),
("126","2017_08_20_153506_create_invoice_header_type_table","2"),
("129","2017_08_26_181345_add_etin_to_organizationprofil_table","4"),
("130","2017_08_27_094335_create_price_lists_table","5"),
("131","2017_10_30_153235_add_assigndate_to_journalentrys_table","6"),
("132","2017_08_27_170652_add_expensenumner_to_users_table","7"),
("133","2017_08_27_170737_add_income_numner_to_users_table","7");




CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO modules VALUES
("1","Contact","contact","2005-09-19 14:40:27","1979-02-02 12:44:42"),
("2","Contact Category","contact/category","1974-06-15 14:15:39","2001-08-02 20:50:00"),
("3","Account Chart","account-chart","1992-04-17 16:09:33","2011-01-27 06:24:27"),
("4","Inventory Item","inventory","1976-08-03 21:05:48","1974-05-09 15:00:58"),
("5","Inventory Category","inventory/category","2011-01-31 11:53:32","2010-09-14 17:27:32"),
("6","Stock Management","stock-management","1985-05-06 13:31:19","2014-02-07 05:49:49"),
("7","Product Track","product-track","2008-09-04 21:34:14","1993-02-22 20:33:53"),
("8","Manual Journal","manual-journal","1985-07-07 14:37:00","2009-09-01 00:09:44"),
("9","Bill","bill","1998-07-05 02:26:54","1995-07-23 07:25:42"),
("10","Credit Note","credit-note","2009-10-22 21:49:40","1986-05-07 11:39:46"),
("11","Credit Note Refund ","credit-note/refund","1984-02-19 04:13:32","1977-07-18 04:58:05"),
("12","Expense","expense","2010-07-12 12:40:13","1995-02-28 12:49:44"),
("13","Inventory","inventory","1985-07-31 19:45:23","2005-08-02 15:53:58"),
("14","Inventory Category","inventory/category","1992-04-05 19:29:29","1995-02-27 01:45:08"),
("15","Invoice","invoice","1976-04-10 19:43:15","1973-12-22 11:32:59"),
("16","Payment Made","payment-made","1990-04-29 20:10:32","1983-05-18 10:34:57"),
("17","Payment Received","payment-received","2013-08-19 12:42:59","2002-12-24 19:28:59"),
("18","Report","report","1999-07-02 12:36:04","1974-01-03 20:20:06");




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
  `etin` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vat_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO organization_profiles VALUES
("1","logo.png","Ontik Tech","Ontik Technology","Dhanmondi Rd.No. 2","Dhaka","Dhaka","Bangladesh","1200","http://ontiktechnology.com","01xxx xxxxxx","info@ontiktechnology.com","1974-02-04 11:53:17","2017-08-26 18:22:02","","");




CREATE TABLE `parent_account_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO parent_account_type VALUES
("1","Assets","Assets","1977-07-06 19:08:09","2011-04-05 18:54:48"),
("2","Liability","Liability","1995-07-09 03:30:59","1999-02-19 04:09:42"),
("3","Equity","Equity","1997-11-12 08:14:01","2003-02-17 15:08:39"),
("4","income","income","1988-10-21 19:21:55","1988-11-15 19:09:23"),
("5","Expense","Expense","2004-03-06 11:33:11","2009-12-16 12:09:11");




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_made VALUES
("1","20","2017-08-18","000001","","on","2","3524","20","28","14","1","1","2017-08-21 17:16:46","2017-08-21 17:16:46"),
("2","150","1970-01-01","000002","","on","1","","0","28","16","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01"),
("3","500","2017-08-12","000003","","on","2","","0","28","16","1","1","2017-08-22 16:50:01","2017-08-22 17:00:55"),
("4","500","2017-08-01","000004","","","1","","500","3","13","1","1","2017-08-23 11:56:37","2017-08-23 11:56:47"),
("5","100","2017-09-14","000005","","","1","","0","3","13","1","1","2017-08-26 16:23:56","2017-08-26 16:25:53");




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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_made_entry VALUES
("1","150","2","2","1","1","2017-08-22 15:02:01","2017-08-22 15:02:01"),
("3","500","3","2","1","1","2017-08-22 17:00:56","2017-08-22 17:00:56"),
("4","3","4","4","1","1","2017-08-23 11:56:38","2017-08-23 11:56:38"),
("12","3","5","4","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53"),
("13","20","5","6","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53"),
("14","47","5","8","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53"),
("15","30","5","9","1","1","2017-08-26 16:25:53","2017-08-26 16:25:53");




CREATE TABLE `payment_mode` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mode_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_mode VALUES
("1","Cash","Cash","1995-06-17 04:41:17","1978-11-26 05:34:43"),
("2","Bank Cheque","Bank Cheque","2007-04-09 20:43:02","2007-09-25 09:29:45");




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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_receives VALUES
("1","2018-08-23","000001","","fdsafsdfsdf","on","","200","0","","","2","4","14","1","1","2017-08-20 15:11:54","2017-08-23 18:18:56"),
("2","2017-08-02","000002","","","on","","52","49","","","2","4","14","1","1","2017-08-21 13:04:28","2017-08-23 18:23:08"),
("3","2017-08-02","000003","","","on","","52","22","","","1","4","14","1","1","2017-08-21 13:07:11","2017-08-21 13:07:11"),
("4","2017-08-18","000004","3524","","","","500","0","","","1","3","14","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49"),
("5","2017-08-11","000005","","","on","","1000","49","","","1","4","14","1","1","2017-08-21 14:53:10","2017-08-21 14:53:10"),
("6","2017-08-15","000006","","","on","","52","52","","","2","4","13","1","1","2017-08-23 11:52:44","2017-08-23 11:52:44"),
("7","2017-08-14","000007","","","","","300","0","","","1","3","14","1","1","2017-08-23 18:16:15","2017-08-23 18:19:57");




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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO payment_receives_entries VALUES
("2","10","3","5","1","1","2017-08-21 13:07:11","2017-08-21 13:07:11"),
("3","20","3","6","1","1","2017-08-21 13:07:11","2017-08-21 13:07:11"),
("4","46","4","5","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49"),
("5","450","4","6","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49"),
("6","2","4","7","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49"),
("7","2","4","8","1","1","2017-08-21 14:47:49","2017-08-21 14:47:49"),
("8","100","5","5","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("9","100","5","6","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("10","3","5","7","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("11","3","5","8","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("12","3","5","9","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("19","10","5","16","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("20","10","5","17","1","1","2017-08-21 14:53:11","2017-08-21 14:53:11"),
("26","200","1","5","1","1","2017-08-23 18:18:56","2017-08-23 18:18:56"),
("27","5","7","8","1","1","2017-08-23 18:19:57","2017-08-23 18:19:57"),
("28","2","7","9","1","1","2017-08-23 18:19:57","2017-08-23 18:19:57"),
("29","293","7","16","1","1","2017-08-23 18:19:57","2017-08-23 18:19:57"),
("30","3","2","46","1","1","2017-08-23 18:23:08","2017-08-23 18:23:08");




CREATE TABLE `price_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `contact_id` int(10) unsigned NOT NULL,
  `item_id` int(10) unsigned NOT NULL,
  `sales_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchase_rate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `price_lists_contact_id_foreign` (`contact_id`),
  KEY `price_lists_item_id_foreign` (`item_id`),
  KEY `price_lists_created_by_foreign` (`created_by`),
  KEY `price_lists_updated_by_foreign` (`updated_by`),
  CONSTRAINT `price_lists_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `price_lists_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `price_lists_item_id_foreign` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `price_lists_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO product VALUES
("1","paper","500","1","1","1","2017-08-23 11:32:47","2017-08-23 11:32:47"),
("2","pen","200","1","1","1","2017-08-23 11:34:22","2017-08-23 11:34:22");




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
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO product_phase VALUES
("3","52","0","2","1","1","2017-08-23 11:34:22","2017-08-23 11:34:22"),
("4","12","0","2","1","1","2017-08-23 11:34:22","2017-08-23 11:34:22"),
("7","52","0","1","1","1","2017-08-23 11:39:32","2017-08-23 11:39:32"),
("8","12","0","1","1","1","2017-08-23 11:39:32","2017-08-23 11:39:32");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO product_phase_item VALUES
("1","23.08.2017","23422","3434","","sdsds","14","1","2","3","1","1","2017-08-23 11:40:24","2017-08-23 11:40:24");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO product_phase_item_add VALUES
("1","1","4","20","1","","");




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO recruiteexpense VALUES
("3","1","","2017-08-26 17:14:05","2017-08-26 17:14:05"),
("4","1","","2017-08-26 17:14:14","2017-08-26 17:14:14"),
("5","1","","2017-08-26 17:14:30","2017-08-26 17:14:30");




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO recruitingorder VALUES
("3","14","1","5","2525"," 52552255252 ","2017-08-23","27","1","1","2017-08-23 12:07:55","2017-08-23 12:18:09","  ","2017-08-24","  "),
("4","15","2","5","25253"," 525522552523","2017-08-23","29","1","1","2017-08-23 12:27:28","2017-08-23 12:27:47"," ","2017-08-23"," "),
("5","14","2","5","2525323"," 525522552523","2017-08-23","30","1","1","2017-08-23 12:30:51","2017-08-23 12:31:08"," ","2017-08-24"," "),
("6","15","1","5","2525655"," 525522552520","2017-08-23","31","1","1","2017-08-23 12:37:48","2017-08-23 12:38:15"," ","2017-08-23"," "),
("7","13","1","5","2002","635544","2017-08-01","48","1","1","2017-08-26 17:05:28","2017-08-26 17:06:18"," 56","2017-08-02"," "),
("8","14","2","5","20028","5585858 ","2017-08-24","50","1","1","2017-08-26 17:11:54","2017-08-26 17:12:24","  ","2017-08-31","  "),
("9","13","2","5","8889"," 552552","2017-08-18","","1","1","2017-08-26 17:23:05","2017-08-26 17:23:05"," ","2017-08-17"," ");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO reminders VALUES
("1","2017-08-19 01:30:00","asdad","1","1","2017-08-19 10:18:09","2017-08-19 10:18:09");




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
("1","Admin","Occaecati similique nisi consequatur nulla consequatur labore. Quia quasi dignissimos iste inventore magnam ipsa. Quibusdam et in officiis consequatur deserunt. Iusto ipsam blanditiis ut ab rem quisquam.","1","1","2016-01-28 00:04:14","1982-10-21 03:49:33"),
("2","Staff","Et molestias corrupti eos. Accusantium fugit et quia facilis excepturi minima. Dolorem eos ut adipisci at. Corrupti repellendus ea omnis beatae exercitationem et incidunt quod.","1","1","1992-05-19 21:18:39","1987-06-04 07:09:34"),
("3","Employee","Molestiae iure nam sunt. Nobis odit qui eum reiciendis id in dolores. Alias impedit quasi ea quis atque. Totam temporibus amet officia dolores numquam.","1","1","2013-09-30 08:04:58","2013-11-08 06:38:59");




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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO salescommisions VALUES
("2","3","2017-08-23","10","","on","1","1","2017-08-23 11:58:10","2017-08-23 11:58:10","","","0","3"),
("3","3","2017-08-26","11","0022","on","1","1","2017-08-26 16:48:19","2017-08-26 16:48:19","","","200","28"),
("4","3","2018-01-01","100","","","1","1","2017-08-26 16:48:55","2017-08-26 18:51:24","","","800","3");




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
) ENGINE=InnoDB AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO stock VALUES
("2","500","2017-08-17","1","2","","","1","1","1","2017-08-17 10:52:10","2017-08-17 10:52:10"),
("3","800","2017-08-17","1","3","","","1","1","1","2017-08-17 10:53:02","2017-08-17 10:53:02"),
("4","500","","1","2","","","1","1","1","2017-08-17 10:54:29","2017-08-17 10:54:29"),
("5","9000","","1","2","","","1","1","1","2017-08-17 10:54:45","2017-08-17 10:54:45"),
("6","201","","1","3","","","1","1","1","2017-08-17 10:55:42","2017-08-17 10:55:42"),
("8","1","22-08-2017","2","1","2","","1","1","1","2017-08-22 15:01:35","2017-08-22 15:01:35"),
("10","10","22-08-2017","1","2","3","","1","1","1","2017-08-22 17:21:51","2017-08-22 17:21:51"),
("11","2000","2017-08-23","1","4","","","1","1","1","2017-08-23 11:24:29","2017-08-23 11:24:29"),
("12","20","2017-08-23","1","4","","","1","1","1","2017-08-23 11:26:02","2017-08-23 11:26:02"),
("13","20","2017-08-23","1","4","","","1","1","1","2017-08-23 11:26:59","2017-08-23 11:26:59"),
("14","20","2017-08-23","1","4","","","1","1","1","2017-08-23 11:27:18","2017-08-23 11:27:18"),
("15","20","2017-08-23","1","4","","","1","1","1","2017-08-23 11:28:13","2017-08-23 11:28:13"),
("16","1","23-08-2017","1","2","","2","1","1","1","2017-08-23 11:53:17","2017-08-23 11:53:17"),
("17","1","23-08-2017","1","2","","3","1","1","1","2017-08-23 11:54:10","2017-08-23 11:54:10"),
("21","1","23-08-2017","1","2","4","","1","1","1","2017-08-23 11:56:04","2017-08-23 11:56:04"),
("22","1","20-08-2017","1","2","","1","1","1","1","2017-08-23 12:19:35","2017-08-23 12:19:35"),
("23","1","23-08-2017","1","3","","4","1","1","1","2017-08-23 12:19:53","2017-08-23 12:19:53"),
("24","1","2017-08-23","2","1","5","","1","1","1","2017-08-23 12:39:01","2017-08-23 12:39:01"),
("25","1","26.08.2017","1","2","","5","1","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("26","10","26.08.2017","1","4","","5","1","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("27","1","26.08.2017","1","4","","5","1","1","1","2017-08-23 18:31:55","2017-08-23 18:31:55"),
("29","1","21-09-2017","2","1","","6","1","1","1","2017-08-23 18:45:04","2017-08-23 18:45:04"),
("30","1","2017-08-26","1","2","6","","1","1","1","2017-08-26 12:03:56","2017-08-26 12:03:56"),
("31","1","07-08-2017","1","3","7","","1","1","1","2017-08-26 16:04:06","2017-08-26 16:04:06"),
("32","1","26-08-2017","1","2","8","","1","1","1","2017-08-26 16:05:10","2017-08-26 16:05:10"),
("33","1","21-08-2017","1","3","9","","1","1","1","2017-08-26 16:05:50","2017-08-26 16:05:50"),
("34","1","24-08-2017","1","3","10","","1","1","1","2017-08-26 16:06:50","2017-08-26 16:06:50"),
("35","10","30-08-2017","1","2","11","","1","1","1","2017-08-26 16:09:44","2017-08-26 16:09:44"),
("37","1","20-09-2017","1","3","15","","1","1","1","2017-08-26 16:17:52","2017-08-26 16:17:52"),
("38","1","2017-10-13","1","2","16","","1","1","1","2017-08-26 16:59:29","2017-08-26 16:59:29"),
("39","1","2017-11-23","1","4","17","","1","1","1","2017-08-26 18:05:01","2017-08-26 18:05:01"),
("40","1","2017-08-23","1","4","19","","1","1","1","2017-08-26 18:09:55","2017-08-26 18:09:55");




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
("1","0%-tax","0","1","1","1972-02-05 08:08:14","2012-06-16 00:40:24"),
("2","5%-tax","5","1","1","1997-07-06 13:09:33","1980-07-10 19:13:25"),
("3","10%-tax","10","1","1","1984-07-12 00:32:14","1997-08-02 17:40:21"),
("4","15%-tax","15","1","1","1996-02-01 13:12:25","2004-06-02 19:09:19"),
("5","20%-tax","20","1","1","1988-12-31 20:16:56","2016-08-30 15:56:47");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticket_document VALUES
("1","hotel 2 doc","Image04.jpg","","4","1","1","2017-08-23 15:21:26","2017-08-23 15:21:26");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticket_hotel VALUES
("1","Hotel California","USA","California, USA","California, USA -> notes","1","1","2017-08-16 12:36:12","2017-08-16 12:36:12"),
("2","hotel 2","bd","","","1","1","2017-08-23 12:26:28","2017-08-23 12:26:28");




CREATE TABLE `ticket_order_tax` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ticket_order_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_order_tax_ticket_order_id_foreign` (`ticket_order_id`),
  CONSTRAINT `ticket_order_tax_ticket_order_id_foreign` FOREIGN KEY (`ticket_order_id`) REFERENCES `ticketorders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticket_order_tax VALUES
("6","4","sdfsdf","343","",""),
("10","5","UT","200","",""),
("11","5","ED","100","",""),
("12","5","BD","500","",""),
("13","6","BD","32323","",""),
("14","7","BD","323236","","");




CREATE TABLE `ticketcommissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commissionRate` int(11) NOT NULL,
  `commissionTax` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticketcommissions VALUES
("1","7","3","2017-08-16 12:34:44","2017-08-26 11:59:14");




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
  `fareAmount` int(11) DEFAULT NULL,
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
  CONSTRAINT `ticketorders_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_ticket_hotel_id_foreign` FOREIGN KEY (`ticket_hotel_id`) REFERENCES `ticket_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticketorders VALUES
("4","13","  ","  ","  ","  ","","  ","  ","  ","","  ","  "," ","  ","  ","  ","","  ","  "," ","","  ","  ","","745",""," "," ","0","0","0"," ","1","","7","3","19","60","1","14","1","1","2017-08-23 12:34:14","2017-08-26 18:31:24","SO-000001"),
("5","14","  ","  ","  ","  ","","  ","  ","  ","","  ","  "," ","  ","  ","  ","","  ","  "," ","","  ","  ","","","2017-08-26"," "," ","0","0","0"," ","0","0","7","3","6","","","13","1","1","2017-08-26 12:00:01","2017-08-26 12:03:55","SO-000002"),
("6","13"," "," "," "," ",""," "," "," ",""," "," ",""," "," "," ",""," "," ","",""," "," ","","",""," "," ","0","0","0"," ","0","0","7","0","17","","","13","1","1","2017-08-26 17:59:11","2017-08-26 18:05:00","SO-000003"),
("7","13"," "," "," "," ",""," "," "," ",""," "," ",""," "," "," ",""," "," ","",""," "," ","","",""," "," ","0","0","0"," ","0","0","7","0","","59","","13","1","1","2017-08-26 18:24:47","2017-08-26 18:29:56","SO-000004");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO tickettaxs VALUES
("1","BD","10","1","1","2017-08-16 12:34:13","2017-08-16 12:34:13");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO users VALUES
("1","SIqFj0YgFK","user.jpg","user.jpg","A iure exercitationem pariatur quibusdam voluptate pariatur. Ullam reiciendis ipsum molestiae molestiae. Nulla ut rerum possimus et voluptas harum in.","admin@gmail.com","$2y$10$ct/T4te7IKXb017pRNEhW.UyNKSN/poQr4xxnDA0P51Fwg3OsaKou","0","1","1","1","1","1","JI3EjYG7JCbruwWyrGtpRSEQCDzcz0MfyXui0hotZ3TyOIKwwjEZmENEcXTs","1993-06-07 03:35:40","2017-08-26 19:48:28"),
("2","ali azam","user.jpg","","","aliazam2912@gmail.co","$2y$10$YLcQ8t5VJ5/48Ugq7yFgLuhT.dcbDjEpBCNQPNR20D2Zzdunmkdz2","1","1","1","","1","1","Msx0wmsbEiXkMZfflLyqTOM5kPHJipNmMDVe7ECm8W0RyGjHwxcfWSELjFJg","2017-08-26 19:48:12","2017-08-26 19:56:24");




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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visaentrys VALUES
("5","2017-08-23","13","5282852","2017-08-23","1","20"," ","2842","0"," "," "," ","5","1","1","2017-08-23 12:07:23","2017-08-23 12:39:01",""),
("6","2017-08-25","14","5458","2017-08-24","1","54","kk","112","12"," "," "," ","16","1","1","2017-08-26 15:26:04","2017-08-26 16:59:28","");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visaformagreement VALUES
("2","2","sdfsdf","sdfsdf","2017-08-27 14:31:47","2017-08-27 14:31:47");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visaformbulks VALUES
("2","2","dsdsdd","Male","23/08/2017","dsfds","2017-08-27 14:31:47","2017-08-27 14:31:47");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visaforms VALUES
("2","3","16/08/2017","sdfsdf","sdfsd","1","1","2017-08-27 14:31:47","2017-08-27 14:31:47","3323");




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

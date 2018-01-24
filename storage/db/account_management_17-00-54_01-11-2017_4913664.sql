SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET FOREIGN_KEY_CHECKS=0;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
--
-- Database: `account_management`
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
) ENGINE=InnoDB AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO access_level VALUES
("1","1","1","1","1","1","1","1","1","1970-07-17 17:48:02","2017-10-13 15:06:33"),
("2","1","1","1","1","2","1","1","1","2016-10-04 13:35:18","2017-10-13 15:06:33"),
("3","1","1","1","1","3","1","1","1","1971-04-09 21:33:43","2017-10-13 15:06:33"),
("4","1","1","1","1","1","2","1","1","2003-12-26 04:11:35","1997-07-09 20:14:42"),
("5","1","1","0","0","2","2","1","1","1980-04-15 02:37:18","1976-02-04 18:09:16"),
("6","0","0","1","0","3","2","1","1","1979-09-08 18:31:07","1974-01-30 23:23:50"),
("7","1","1","1","0","1","3","1","1","1978-06-07 20:14:57","1989-09-10 11:08:57"),
("8","1","1","1","0","2","3","1","1","2009-12-27 03:13:19","1971-10-31 09:55:00"),
("9","1","1","1","0","3","3","1","1","2005-11-02 02:44:20","1978-02-19 05:02:26"),
("10","1","1","1","1","4","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("11","1","1","1","1","5","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("12","1","1","1","1","6","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("13","1","1","1","1","7","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("14","1","1","1","1","8","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("15","1","1","1","1","9","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("16","1","1","1","1","10","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("17","1","1","1","1","11","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("18","1","1","1","1","12","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("19","1","1","1","1","13","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("20","1","1","1","1","14","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("21","1","1","1","1","15","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("22","1","1","1","1","16","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("23","1","1","1","1","17","1","1","1","2017-10-13 15:06:33","2017-10-13 15:07:03"),
("24","1","1","1","1","18","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("25","1","1","1","1","19","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("26","1","1","1","1","20","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("27","1","1","1","1","21","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("28","1","1","1","1","22","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("29","1","1","1","1","23","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("30","1","1","1","1","24","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("31","1","1","1","1","25","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("32","1","1","1","1","26","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:03"),
("33","1","1","1","1","27","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("34","1","1","1","1","28","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("35","1","1","1","1","29","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("36","1","1","1","1","30","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("37","1","1","1","1","31","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("38","1","1","1","1","32","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("39","1","1","1","1","33","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("40","1","1","1","1","34","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("41","1","1","1","1","35","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("42","1","1","1","1","36","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("43","1","1","1","1","37","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("44","1","1","1","1","38","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("45","1","1","1","1","39","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("46","1","1","1","1","40","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("47","1","1","1","1","41","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("48","1","1","1","1","42","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("49","1","1","1","1","43","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("50","1","1","1","1","44","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:04"),
("51","1","1","1","1","45","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("52","1","1","1","1","46","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("53","1","1","1","1","47","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("54","1","1","1","1","48","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("55","1","1","1","1","49","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("56","1","1","1","1","50","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("57","1","1","1","1","51","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("58","1","1","1","1","52","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("59","1","1","1","1","53","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("60","1","1","1","1","54","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("61","1","1","1","1","55","1","1","1","2017-10-13 15:06:34","2017-10-13 15:07:05"),
("62","1","1","1","1","56","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("63","1","1","1","1","57","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("64","1","1","1","1","58","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("65","1","1","1","1","59","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("66","1","1","1","1","60","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("67","1","1","1","1","61","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("68","1","1","1","1","62","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("69","1","1","1","1","63","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("70","1","1","1","1","64","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("71","1","1","1","1","65","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("72","1","1","1","1","66","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("73","1","1","1","1","67","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("74","1","1","1","1","68","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("75","1","1","1","1","69","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("76","1","1","1","1","70","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("77","1","1","1","1","71","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("78","1","1","1","1","72","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("79","1","1","1","1","73","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:05"),
("80","1","1","1","1","74","1","1","1","2017-10-13 15:06:35","2017-10-13 15:07:06");




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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO account VALUES
("1","Advance Tax","Advance Tax","Any tax which is paid in advance is recorded into the advance tax account. This advance tax payment could be a quarterly, half yearly or yearly payment.","0","1","3","1","1","1","1","2014-03-14 08:51:58","1973-05-03 15:04:11"),
("2","Employee Advance","Employee Advance","Money paid out to an employee in advance can be tracked here till it is repaid or shown to be spent for company purposes.","0","1","3","1","1","1","1","1975-12-08 20:33:03","1981-02-23 07:59:24"),
("3","Petty Cash","Petty Cash","It is a small amount of cash that is used to pay your minor or casual expenses rather than writing a check.","0","1","4","1","1","1","1","1974-01-31 16:01:37","1976-12-20 14:47:34"),
("4","Undeposited Funds","Undeposited Funds","Record funds received by your company yet to be deposited in a bank as undeposited funds and group them as a current asset in your balance sheet.","0","1","4","1","1","1","1","1994-08-08 15:59:43","1977-08-26 20:47:00"),
("5","Accounts Receivable","Accounts Receivable","The money that customers owe you becomes the accounts receivable. A good example of this is a payment expected from an invoice sent to your customer.","0","1","2","1","1","1","1","2007-05-10 04:17:41","1994-03-28 09:02:03"),
("6","Inventory Asset","Inventory Asset","An account which tracks the value of goods in your inventory.","0","1","7","1","1","1","1","2013-07-13 09:35:56","1980-03-16 11:31:04"),
("7","Opening Balance Adjustments","Opening Balance Adjustments","This account will hold the difference in the debits and credits entered during the opening balance.","0","1","9","2","1","1","1","2003-10-28 19:29:31","2000-07-26 10:14:41"),
("8","Employee Reimbursements","Employee Reimbursements","This account can be used to track the reimbursements that are due to be paid out to employees.","0","1","9","2","1","1","1","2004-11-29 12:25:34","1974-06-29 16:41:35"),
("9","Tax Payable","Tax Payable","The amount of money which you owe to your tax authority is recorded under the tax payable account. This amount is a sum of your outstanding in taxes and the tax charged on sales.","0","1","9","2","1","1","1","1987-02-23 04:28:14","1973-09-27 03:38:57"),
("10","Unearned Revenue","Unearned Revenue","A liability account that reports amounts received in advance of providing goods or services. When the goods or services are provided, this account balance is decreased and a revenue account is increased.","0","1","9","2","1","1","1","1990-01-31 11:59:01","2016-05-10 21:43:39"),
("11","Accounts Payable","Accounts Payable","This is an account of all the money which you owe to others like a pending bill payment to a vendor,etc.","0","1","13","2","1","1","1","1976-03-18 15:26:52","2010-09-15 09:41:28"),
("12","Tag Adjustments","Tag Adjustments","This adjustment account tracks the transfers between different reporting tags.","0","1","12","2","1","1","1","1981-03-02 18:38:22","1986-10-26 23:04:36"),
("13","Drawings","Drawings","The money withdrawn from a business by its owner can be tracked with this account.","0","1","14","3","1","1","1","2013-02-23 00:00:23","1971-05-22 20:25:24"),
("14","Opening Balance Offset","Opening Balance Offset","This is an account where you can record the balance from your previous years earning or the amount set aside for some activities. It is like a buffer account for your funds.","0","1","14","3","1","1","1","2000-02-23 02:34:12","1977-03-31 08:20:54"),
("15","Owner Equity","Owner Equity","The owners rights to the assets of a company can be quantified in the owner\'s equity account.","0","1","14","3","1","1","1","1981-12-07 19:41:54","2008-09-14 22:45:27"),
("16","Sales","Sales","The income from the sales in your business is recorded under the sales account.","0","1","15","4","1","1","1","1984-07-20 18:53:42","1989-03-07 20:15:01"),
("17","General Income","General Income","A general category of account where you can record any income which cannot be recorded into any other category.","0","1","15","4","1","1","1","1980-11-07 19:58:17","1996-03-02 20:52:50"),
("18","Other Charges","Other Charges","Miscellaneous charges like adjustments made to the invoice can be recorded in this account.","0","1","15","4","1","1","1","1993-10-04 23:29:30","2015-10-23 23:13:59"),
("19","Interest Income","Interest Income","A percentage of your balances and deposits are given as interest to you by your banks and financial institutions. This interest is recorded into the interest income account.","0","1","15","4","1","1","1","1993-04-28 07:10:02","1975-12-29 09:28:02"),
("20","Shipping Charge","Shipping Charge","Shipping charges made to the invoice will be recorded in this account.","0","1","15","4","1","1","1","1981-12-30 08:59:48","2004-02-14 07:10:31"),
("21","Discount","Discount","Any reduction on your selling price as a discount can be recorded into the discount account.","0","1","15","4","1","1","1","1997-03-20 23:40:02","2009-03-29 09:28:16"),
("22","Late Fee Income","Late Fee Income","Any late fee income is recorded into the late fee income account. The late fee is levied when the payment for an invoice is not received by the due date.","0","1","15","4","1","1","1","1976-08-21 10:59:08","2009-05-02 04:28:09"),
("23","Other Expenses","Other Expenses","Any minor expense on activities unrelated to primary business operations is recorded under the other expense account.","0","1","17","5","1","1","1","1984-12-20 19:52:37","1971-01-14 20:53:24"),
("24","Bad Debt","Bad Debt","Any amount which is lost and is unrecoverable is recorded into the bad debt account.","0","1","17","5","1","1","1","1985-06-15 14:22:38","2017-06-17 16:46:19"),
("25","Exchange Gain or Loss","Exchange Gain or Loss","Changing the conversion rate can result in a gain or a loss. You can record this into the exchange gain or loss account.","0","1","19","5","1","1","1","2000-08-29 03:26:18","1975-06-21 22:07:34"),
("26","Cost of Goods Sold","Cost of Goods Sold","An expense account which tracks the value of the goods sold.","0","1","18","5","1","1","1","2017-01-25 18:11:09","2015-04-11 04:32:29"),
("27","Prepaid Expense","Prepaid Expense","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","3","1","1","1","1","1995-09-05 11:45:17","2014-09-17 01:42:05"),
("28","Bank","Bank","An asset account that reports amounts paid in advance while purchasing goods or services from a vendor.","0","1","5","1","1","1","1","1995-11-25 16:07:38","2015-06-16 23:12:04"),
("30","Agent Commission","Agent Commission","Agent Commission.","0","1","3","1","1","1","1","2015-05-04 04:39:32","1972-03-24 19:45:38");




CREATE TABLE `account_information_forms` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `machine_model_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_model_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_model_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_model_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_part_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_part_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_part_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_part_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_serial_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_serial_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_serial_no_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_serial_no_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_quantity_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_quantity_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_quantity_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_quantity_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_warranty_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_warranty_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_warranty_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_warranty_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_unit_price_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `machine_unit_price_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_unit_price_1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `optional_unit_price_2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bill_date` date DEFAULT NULL,
  `bill_amount` int(11) DEFAULT NULL,
  `business_promotion_amount` int(11) DEFAULT NULL,
  `bill_format` tinyint(4) DEFAULT NULL,
  `customer_type` tinyint(4) DEFAULT NULL,
  `price_type` tinyint(4) DEFAULT NULL,
  `billing_information_consignee` longtext COLLATE utf8_unicode_ci,
  `billing_information__different_consignee` longtext COLLATE utf8_unicode_ci,
  `payment_terms` tinyint(4) DEFAULT NULL,
  `purchaser_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaser_telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaser_email_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaser_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaser_mobile_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `purchaser_fax_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_telephone_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_email_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_designation` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_mobile_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `charge_of_payment_fax_no` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visit_customer_permises` tinyint(4) DEFAULT NULL,
  `customer_occupying_permises` date DEFAULT NULL,
  `neighbours_to_confirm_answer` tinyint(4) DEFAULT NULL,
  `permises_rent` tinyint(4) DEFAULT NULL,
  `office_setup` tinyint(4) DEFAULT NULL,
  `no_of_staff` int(11) DEFAULT NULL,
  `building_type` tinyint(4) DEFAULT NULL,
  `customer_get_contact` tinyint(4) DEFAULT NULL,
  `liase_with` tinyint(4) DEFAULT NULL,
  `confident_of_payment` tinyint(4) DEFAULT NULL,
  `receive_purchase_order` tinyint(4) DEFAULT NULL,
  `delivery_product_before` tinyint(4) DEFAULT NULL,
  `credit_days` int(11) DEFAULT NULL,
  `signature_of_executive` tinyint(4) DEFAULT NULL,
  `executive_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_of_manager` tinyint(4) DEFAULT NULL,
  `manager_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_of_account` tinyint(4) DEFAULT NULL,
  `account_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_of_admin` tinyint(4) DEFAULT NULL,
  `admin_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_of_director` tinyint(4) DEFAULT NULL,
  `director_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `signature_of_billing_officer` tinyint(4) DEFAULT NULL,
  `billing_officer_comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `account_information_forms_user_id_foreign` (`user_id`),
  KEY `account_information_forms_created_by_foreign` (`created_by`),
  KEY `account_information_forms_updated_by_foreign` (`updated_by`),
  CONSTRAINT `account_information_forms_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `account_information_forms_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `account_information_forms_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
("1","Other Asset","Track special assets like goodwill and other intangible assets","1","0","1986-02-11 14:42:37","2010-06-21 18:56:41"),
("2","Accounts Receivable","Reflects money owed to you by your customers. Zoho Books provides a default Accounts Receivable account. E.g. Unpaid Invoices","1","1","1992-11-01 05:28:18","1975-12-21 03:50:04"),
("3","Other Current asset","Any short term asset that can be converted into cash or cash equivalents easily - Prepaid expenses - Stocks and Mutual Funds","1","0","1984-09-13 15:41:48","2011-01-09 12:10:48"),
("4","Cash","To keep track of cash and other cash equivalents like petty cash, undeposited funds, etc.","1","0","2012-03-08 23:44:42","2017-06-04 07:46:31"),
("5","Bank","To keep track of bank accounts like Savings, Checking, and Money Market accounts","1","0","1992-10-30 06:43:47","2008-06-28 03:35:20"),
("6","Fixed asset","Any long term investment or an asset that cannot be converted into cash easily like:-Land and Buildings - Plant, Machinery and Equipment - Computers -Furniture","1","0","2003-05-17 01:02:34","1988-05-08 23:56:04"),
("7","Stock","To keep track of your inventory assets.","1","0","2011-12-25 19:43:52","1972-01-21 18:07:11"),
("9","Other Current Liability","Any short term liability like:Customer Deposits - Tax Payable","2","0","1980-03-04 03:18:01","1992-12-17 15:48:11"),
("10","Credit Card","Create a trail of all your credit card transactions by creating a credit card account","2","0","1989-08-21 01:22:35","2000-06-07 02:36:26"),
("11","Long Term Liability","Liabilities that mature after a minimum period of one year like Notes Payable, Debentures, and Long Term Loans","2","0","1993-11-05 08:31:33","1970-02-26 04:09:57"),
("12","Other Liability","Obligation of an entity arising from past transactions or events which would require repayment.- Tax to be paid Loan to be Repaid Accounts Payable etc","2","0","1976-04-22 17:24:19","1987-12-01 18:44:32"),
("13","Accounts Payable","Accounts Payable","2","1","2003-02-19 04:07:42","1983-06-28 17:47:23"),
("14","Equity","Equity","3","0","1983-09-26 14:56:20","1988-06-04 11:45:07"),
("15","income","income","4","0","1991-02-19 01:35:36","2004-07-06 11:46:37"),
("16","Other Income","Other Income","4","0","1982-10-15 09:15:53","2012-01-15 06:32:59"),
("17","Expense","Expense","5","0","1994-06-05 05:25:26","2014-02-20 10:23:43"),
("18","Cost of Goods Sold","Cost of Goods Sold","5","0","1997-12-30 23:23:48","2015-10-25 13:29:53"),
("19","Other Expense","Other Expense","5","0","2002-01-24 21:20:34","1981-03-02 06:09:16");




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bank_contact_id_foreign` (`contact_id`),
  KEY `bank_account_id_foreign` (`account_id`),
  KEY `bank_payment_mode_id_foreign` (`payment_mode_id`),
  KEY `bank_created_by_foreign` (`created_by`),
  KEY `bank_updated_by_foreign` (`updated_by`),
  CONSTRAINT `bank_account_id_foreign` FOREIGN KEY (`account_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_payment_mode_id_foreign` FOREIGN KEY (`payment_mode_id`) REFERENCES `account` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bank_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
  `save` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `bill_vendor_id_foreign` (`vendor_id`),
  KEY `bill_created_by_foreign` (`created_by`),
  KEY `bill_updated_by_foreign` (`updated_by`),
  CONSTRAINT `bill_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `bill_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill VALUES
("1","","000001","40","40","2017-10-15","2017-10-15","1","","0","","","1","1","1","2017-10-15 12:03:01","2017-10-15 12:03:01",""),
("2","","000002","40","40","2017-10-13","2017-10-28","1","","0","","","1","1","1","2017-10-15 12:04:27","2017-10-15 12:04:27",""),
("3","","000003","40","40","2017-10-15","2017-10-15","1","","0","","","1","1","1","2017-10-15 12:57:15","2017-10-15 12:57:15",""),
("5","","000004","40","40","2017-10-18","2017-10-18","0","","0","","","1","1","1","2017-10-18 14:52:30","2017-10-18 14:56:24",""),
("6","","000005","40","40","2017-10-18","2017-10-18","1","","0","","","1","1","1","2017-10-18 16:11:48","2017-10-18 16:11:48","");




CREATE TABLE `bill_entry` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO bill_entry VALUES
("1","1","","26","1","40","1","40","1","1","1","2017-10-15 12:03:01","2017-10-15 12:03:01"),
("2","1","","26","1","40","1","40","2","1","1","2017-10-15 12:04:28","2017-10-15 12:04:28"),
("3","1","","26","1","40","1","40","3","1","1","2017-10-15 12:57:15","2017-10-15 12:57:15"),
("5","1","check22","26","1","40","1","40","5","1","1","2017-10-18 14:56:24","2017-10-18 14:56:24"),
("6","1","check","26","1","40","1","40","6","1","1","2017-10-18 16:11:48","2017-10-18 16:11:48");




CREATE TABLE `branch` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `branch_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `branch_description` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `location` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `branch_location_unique` (`location`),
  KEY `branch_created_by_foreign` (`created_by`),
  KEY `branch_updated_by_foreign` (`updated_by`),
  CONSTRAINT `branch_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `branch_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO branch VALUES
("1","b1","Unde est dolorem velit nesciunt voluptatibus numquam. Vitae voluptatum corporis provident. Est ut tenetur ea.","1","1","1977-10-29 03:52:42","1993-09-25 12:26:58",""),
("2","b2","Dignissimos magni omnis optio sunt non ratione. Beatae tempore possimus placeat dicta. Sit sed qui molestiae at aspernatur ea consequatur.","1","1","1985-02-28 19:31:00","2009-04-04 17:37:26",""),
("3","dnrpFr1aiM","Assumenda rerum veniam molestiae qui dicta doloribus totam. Et quod enim rerum dolores eaque. Vel possimus molestiae autem dolore. Sunt molestias cum architecto autem et. Iste non amet nobis laboriosam dolor cupiditate soluta pariatur.","1","1","1986-04-25 17:51:28","2016-08-18 14:39:58",""),
("4","nBwabBKG1Z","Id itaque maxime excepturi et suscipit. Rem incidunt atque est aliquid dicta. Molestias nostrum cum et et quibusdam.","1","1","2001-05-31 02:39:50","2000-12-03 01:47:39",""),
("5","S2NkqEYnPS","Incidunt facilis laudantium est ad quo. Molestiae vitae rerum consequatur possimus ut facilis tempore voluptatem. Voluptatem et maiores qui quidem eaque sequi.","1","1","2000-04-05 06:21:08","1987-05-31 04:31:39",""),
("6","NZFONSFN1i","Laborum voluptas harum soluta minima quisquam assumenda sit. Atque sapiente facilis et odit nemo fuga deleniti. Maiores autem facilis at unde autem architecto et.","1","1","1993-01-01 10:42:13","1991-06-28 07:28:10",""),
("7","MDWiJQjExA","Aut molestias ipsam eius porro doloremque dicta. Iure quia ut asperiores magni fugiat.","1","1","1993-02-11 21:48:08","2002-12-01 14:08:55",""),
("8","iF6WeeKAaO","Tenetur odit cum et dicta. Labore unde eius quaerat consequuntur corporis. Eum quam hic iusto et consequuntur. Qui dicta beatae aut dolor similique eos.","1","1","1987-09-04 23:31:13","1971-09-20 09:55:31",""),
("9","LtaAvA3Ix0","Vel excepturi dignissimos quos ullam sed expedita. Rem ab veritatis omnis modi mollitia illo. Eveniet alias qui sed nisi cupiditate dolorum qui. Quis earum aut minima officiis pariatur enim labore.","1","1","2016-05-02 10:21:43","2016-04-13 02:23:53",""),
("10","Ix2BejpzJA","Magni voluptatibus possimus aut. Quia voluptate necessitatibus reprehenderit repellendus. Modi laudantium voluptas pariatur laborum. Aliquam non excepturi molestiae voluptatem.","1","1","1990-05-04 09:01:43","1977-03-02 09:56:00","");




CREATE TABLE `company` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `company_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cofil_id` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
("1","BD company","","","1","1","2017-10-13 15:12:50","2017-10-13 15:12:50","","","","","","","");




CREATE TABLE `completion_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `completion_id` int(10) unsigned NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `completion_files_completion_id_foreign` (`completion_id`),
  CONSTRAINT `completion_files_completion_id_foreign` FOREIGN KEY (`completion_id`) REFERENCES `completions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `completions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paxid` int(10) unsigned DEFAULT NULL,
  `date` date DEFAULT NULL,
  `smart_card_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `completions_created_by_foreign` (`created_by`),
  KEY `completions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `completions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `completions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `confirmation_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `confirmation_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confirmation_files_confirmation_id_foreign` (`confirmation_id`),
  CONSTRAINT `confirmation_files_confirmation_id_foreign` FOREIGN KEY (`confirmation_id`) REFERENCES `confirmations` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `confirmations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `flight_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `date_of_flight` date DEFAULT NULL,
  `departure_time` time DEFAULT NULL,
  `arrival_time` time DEFAULT NULL,
  `e_ticket_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vendor_name` int(10) unsigned DEFAULT NULL,
  `bill_id` int(10) unsigned DEFAULT NULL,
  `pax_id` int(10) unsigned DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `confirmations_vendor_name_foreign` (`vendor_name`),
  KEY `confirmations_bill_id_foreign` (`bill_id`),
  KEY `confirmations_pax_id_foreign` (`pax_id`),
  KEY `confirmations_created_by_foreign` (`created_by`),
  KEY `confirmations_updated_by_foreign` (`updated_by`),
  CONSTRAINT `confirmations_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `confirmations_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `confirmations_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `confirmations_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `confirmations_vendor_name_foreign` FOREIGN KEY (`vendor_name`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO contact VALUES
("1","","","","ripon","","","","123456","","","","","","","","","","","","","","","","1","1","","1","1","1","2017-10-13 15:11:16","2017-10-13 15:11:16","");




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
("1","Customer","Customer Description","1","1","1989-06-29 21:35:37","1972-11-25 04:35:15"),
("2","Dealer","Dealer Description","1","1","1989-03-10 13:43:38","1975-11-02 13:04:32"),
("3","Employee","Employee Description","1","1","1983-01-27 09:23:37","1981-07-20 08:24:58"),
("4","Vendor","Vandor Description","1","1","1995-11-18 22:59:35","1999-08-13 14:25:52"),
("5","Bank","Bank Description","1","1","1995-03-30 19:59:50","2004-05-25 16:38:53"),
("6","Agent","Agent Description","1","1","1995-06-15 13:58:15","1993-09-22 00:07:52");




CREATE TABLE `conveyance_bill_lists` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `conveyance_bill_id` int(10) unsigned NOT NULL,
  `from` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `to` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transport` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conveyance_bill_lists_conveyance_bill_id_foreign` (`conveyance_bill_id`),
  KEY `conveyance_bill_lists_created_by_foreign` (`created_by`),
  KEY `conveyance_bill_lists_updated_by_foreign` (`updated_by`),
  CONSTRAINT `conveyance_bill_lists_conveyance_bill_id_foreign` FOREIGN KEY (`conveyance_bill_id`) REFERENCES `conveyance_bills` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `conveyance_bill_lists_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `conveyance_bill_lists_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `conveyance_bills` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `checked_by` int(10) unsigned DEFAULT NULL,
  `approved_by` int(10) unsigned DEFAULT NULL,
  `approved_by_chairman` int(11) DEFAULT NULL,
  `comments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `conveyance_bills_user_id_foreign` (`user_id`),
  KEY `conveyance_bills_created_by_foreign` (`created_by`),
  KEY `conveyance_bills_updated_by_foreign` (`updated_by`),
  CONSTRAINT `conveyance_bills_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `conveyance_bills_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `conveyance_bills_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `credit_note_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` double NOT NULL,
  `rate` double NOT NULL,
  `amount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `discount` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_note_entries VALUES
("5","1","50","50","0","check2","1","1","1","16","1","1","2017-10-18 14:45:01","2017-10-18 14:45:01");




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
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `credit_notes_customer_id_foreign` (`customer_id`),
  KEY `credit_notes_created_by_foreign` (`created_by`),
  KEY `credit_notes_updated_by_foreign` (`updated_by`),
  CONSTRAINT `credit_notes_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_notes_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `credit_notes_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO credit_notes VALUES
("1","000001","123456","2017-10-18","0","0","50","50","","","1","1","1","2017-10-18 14:29:55","2017-10-18 14:29:55","");




CREATE TABLE `customer_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `customer_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `customer_file_customer_id_foreign` (`customer_id`),
  CONSTRAINT `customer_file_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `recruit_customer` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `estimates_customer_id_foreign` (`customer_id`),
  KEY `estimates_created_by_foreign` (`created_by`),
  KEY `estimates_updated_by_foreign` (`updated_by`),
  CONSTRAINT `estimates_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimates_customer_id_foreign` FOREIGN KEY (`customer_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `estimates_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
  `save` tinyint(1) DEFAULT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `finger_print_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fingerprint_id` int(10) unsigned NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `finger_print_files_fingerprint_id_foreign` (`fingerprint_id`),
  CONSTRAINT `finger_print_files_fingerprint_id_foreign` FOREIGN KEY (`fingerprint_id`) REFERENCES `fingerprint` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `fingerprint` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bmet_status` tinyint(1) DEFAULT NULL,
  `assignedDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paxid` int(10) unsigned DEFAULT NULL,
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






CREATE TABLE `fit_card` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `receive_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fit_card_pax_id_foreign` (`pax_id`),
  KEY `fit_card_created_by_foreign` (`created_by`),
  KEY `fit_card_updated_by_foreign` (`updated_by`),
  CONSTRAINT `fit_card_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fit_card_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fit_card_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `fit_card_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `fit_card_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fit_card_file_fit_card_id_foreign` (`fit_card_id`),
  CONSTRAINT `fit_card_file_fit_card_id_foreign` FOREIGN KEY (`fit_card_id`) REFERENCES `fit_card` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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






CREATE TABLE `gamca_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medical_slip_form_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gamca_file_medical_slip_form_id_foreign` (`medical_slip_form_id`),
  CONSTRAINT `gamca_file_medical_slip_form_id_foreign` FOREIGN KEY (`medical_slip_form_id`) REFERENCES `medical_slip_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO gamca_file VALUES
("1","3","aaaaaaa","59e0aa9f61921.Image03@2x301.jpg","2017-10-13 17:59:27","2017-10-13 17:59:27");




CREATE TABLE `gamca_receive_submit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `medical_slip_form_id` int(10) unsigned NOT NULL,
  `received_status` tinyint(4) DEFAULT NULL,
  `submitted_status` tinyint(4) DEFAULT NULL,
  `pax_id` tinyint(3) unsigned DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `gamca_receive_submit_medical_slip_form_id_foreign` (`medical_slip_form_id`),
  CONSTRAINT `gamca_receive_submit_medical_slip_form_id_foreign` FOREIGN KEY (`medical_slip_form_id`) REFERENCES `medical_slip_form` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO gamca_receive_submit VALUES
("5","3","1","","1","2017-10-13 18:16:49","2017-10-13 18:16:49");




CREATE TABLE `headertemplate` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `headerType` tinyint(4) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO headertemplate VALUES
("1","uploads/template/banner.png","0","2017-10-15 10:55:56","2017-10-15 11:04:24");




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
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `invoice_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `quantity` int(11) NOT NULL,
  `amount` double NOT NULL,
  `discount` double DEFAULT NULL,
  `discount_type` int(11) NOT NULL DEFAULT '0',
  `rate` double NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoice_entries VALUES
("1","2","98","2","0","50","","1","1","1","16","1","1","2017-10-15 10:54:58","2017-10-15 10:54:58"),
("2","2","98","2","0","50","","1","2","1","16","1","1","2017-10-15 12:06:05","2017-10-15 12:06:05"),
("3","1","49","2","0","50","","1","3","1","16","1","1","2017-10-15 13:07:00","2017-10-15 13:07:00"),
("18","1","100","2","1","102","check2","1","5","1","16","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59");




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO invoices VALUES
("1","000001","","","15-10-2017","15-10-2017","","14.7","10","15","137.7","137.7","","","","","1","1","1","2017-10-15 10:54:58","2017-10-15 10:54:58","","","0"),
("2","000002","","","15-10-2017","30-10-2017","","0","100","0","0","0","","","","","1","1","1","2017-10-15 12:06:05","2017-10-15 12:06:05","","","0"),
("3","000003","","","15-10-2017","30-10-2017","customer note check","4.9","15","20","88.9","88.9","","","","","1","1","1","2017-10-15 13:07:00","2017-10-15 13:07:00","","","0"),
("4","000004","","","17-10-2017","170"," ","1150","0","0","1150","1150","","","","1","1","1","1","2017-10-17 13:31:13","2017-10-19 15:15:33","","","0"),
("5","000005","","","17-10-2017","17-10-2017","              ","10","10","-2","118","118","","","","","1","1","1","2017-10-17 13:35:16","2017-10-31 15:23:59","","","0");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO item VALUES
("1","pant","","50","","","","40","","","","","","9","6","1","1","1","1","2017-10-13 15:11:50","2017-10-31 15:23:59");




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
("1","Product","Eos repudiandae accusamus perferendis. Non sequi nemo sequi et laboriosam dolor. Fuga in et corporis.","5","1","1","1977-02-08 02:33:52","2015-04-22 08:02:06"),
("2","Service","Et cum voluptates eius officiis voluptate. Cum voluptates accusantium excepturi ut vel. Dolorem rerum quam rem voluptatibus vero quo omnis.","3","1","1","2014-04-05 02:23:40","2005-06-19 03:01:31");




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `journal_entries` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `note` longtext COLLATE utf8_unicode_ci,
  `debit_credit` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `account_name_id` int(10) unsigned NOT NULL,
  `jurnal_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
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
  `pr_adjustment_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `assign_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
) ENGINE=InnoDB AUTO_INCREMENT=57 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO journal_entries VALUES
("1","","1","1","5","invoice","","1","","","","","","","","","","","","1","","","1","1","2017-10-19 10:54:58","2017-10-15 10:54:58","2017-10-21 00:00:00","",""),
("2","","1","11","21","invoice","","1","","","","","","","","","","","","1","","","2","1","2017-10-19 10:54:58","2017-10-15 10:54:58","2017-10-21 00:00:00","",""),
("3","","0","12","9","invoice","","1","","","","","","","","","","","","1","","","3","1","2017-10-19 10:54:58","2017-10-15 10:54:58","2017-10-21 00:00:00","",""),
("51","              ","1","118","5","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","",""),
("52","              ","1","2","21","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","",""),
("53","              ","0","10","9","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","",""),
("54","              ","0","10","20","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","",""),
("55","              ","1","2","18","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","",""),
("56","              ","0","102","16","invoice","","5","","","","","","","","","","","","1","","","1","1","2017-10-31 15:23:59","2017-10-31 15:23:59","2017-10-17 00:00:00","","");




CREATE TABLE `locktransactions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `locktransactions_created_by_foreign` (`created_by`),
  KEY `locktransactions_updated_by_foreign` (`updated_by`),
  CONSTRAINT `locktransactions_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `locktransactions_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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






CREATE TABLE `manpower_service` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sector` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `delivery_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `issue_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `contact_id` int(10) unsigned NOT NULL,
  `bill_id` int(10) unsigned DEFAULT NULL,
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `ticket_hotel_id` int(10) unsigned DEFAULT NULL,
  `progress_status_id` int(10) unsigned DEFAULT NULL,
  `vendor_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `order_id` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `manpower_service_order_id_unique` (`order_id`),
  KEY `manpower_service_bill_id_foreign` (`bill_id`),
  KEY `manpower_service_invoice_id_foreign` (`invoice_id`),
  KEY `manpower_service_contact_id_foreign` (`contact_id`),
  KEY `manpower_service_vendor_id_foreign` (`vendor_id`),
  KEY `manpower_service_ticket_hotel_id_foreign` (`ticket_hotel_id`),
  KEY `manpower_service_progress_status_id_foreign` (`progress_status_id`),
  KEY `manpower_service_created_by_foreign` (`created_by`),
  KEY `manpower_service_updated_by_foreign` (`updated_by`),
  CONSTRAINT `manpower_service_bill_id_foreign` FOREIGN KEY (`bill_id`) REFERENCES `bill` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_progress_status_id_foreign` FOREIGN KEY (`progress_status_id`) REFERENCES `manpower_service_progress_status` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_ticket_hotel_id_foreign` FOREIGN KEY (`ticket_hotel_id`) REFERENCES `ticket_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `manpower_service_progress_status` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manpower_service_progress_status_created_by_foreign` (`created_by`),
  KEY `manpower_service_progress_status_updated_by_foreign` (`updated_by`),
  CONSTRAINT `manpower_service_progress_status_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_progress_status_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `manpower_service_ticket_document` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_url` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `note` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `manpower_service_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `manpower_service_ticket_document_manpower_service_id_foreign` (`manpower_service_id`),
  KEY `manpower_service_ticket_document_created_by_foreign` (`created_by`),
  KEY `manpower_service_ticket_document_updated_by_foreign` (`updated_by`),
  CONSTRAINT `manpower_service_ticket_document_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_ticket_document_manpower_service_id_foreign` FOREIGN KEY (`manpower_service_id`) REFERENCES `manpower_service` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `manpower_service_ticket_document_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `medical_slip_form` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `dateOfApplication` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
("3","13.10.2017","","1","1","2017-10-13 17:59:27","2017-10-13 17:59:27");




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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO medical_slip_form_pax VALUES
("5","3","1","2017-10-13 18:16:49","2017-10-13 18:16:49");




CREATE TABLE `medicalslip` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `medical_centre_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medical_date` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `medical_report_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_visit_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=169 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO migrations VALUES
("1","2014_10_12_000000_create_users_table","1"),
("2","2014_10_12_100000_create_password_resets_table","1"),
("3","2017_01_18_092901_create_user_activations_table","1"),
("4","2017_02_02_053156_create_branch_table","1"),
("5","2017_02_02_053157_create_contact_category_table","1"),
("6","2017_02_02_053222_create_agents_table","1"),
("7","2017_02_02_053223_create_contact_table","1"),
("8","2017_02_02_053225_create_customer_file_table","1"),
("9","2017_02_10_044930_create_payment_mode_table","1"),
("10","2017_02_10_044940_create_parent_account_type_table","1"),
("11","2017_02_10_045717_create_account_type_table","1"),
("12","2017_02_10_045727_create_account_table","1"),
("13","2017_02_11_053630_create_tax_table","1"),
("14","2017_02_11_053631_create_journal_table","1"),
("15","2017_02_13_181447_create_item_category_table","1"),
("16","2017_02_13_181545_create_item_table","1"),
("17","2017_02_13_181719_create_product_table","1"),
("18","2017_02_13_181753_create_product_phase_table","1"),
("19","2017_02_13_181830_create_product_phase_item_table","1"),
("20","2017_02_20_060418_create_modules_table","1"),
("21","2017_02_20_060419_create_roles_table","1"),
("22","2017_02_20_060456_create_access_level_table","1"),
("23","2017_02_20_170318_create_product_phase_item_add_table","1"),
("24","2017_03_09_071116_create_organization_profiles_table","1"),
("25","2017_04_28_174719_create_invoices_table","1"),
("26","2017_04_28_174745_create_invoice_entries_table","1"),
("27","2017_04_29_161315_create_payment_receives_table","1"),
("28","2017_04_29_161316_create_payment_receives_entries_table","1"),
("29","2017_04_29_161406_create_credit_notes_table","1"),
("30","2017_04_29_161420_create_credit_note_entries_table","1"),
("31","2017_04_29_161439_create_credit_note_payments_table","1"),
("32","2017_04_29_161458_create_credit_note_refunds_table","1"),
("33","2017_05_05_033709_create_excess_payment_table","1"),
("34","2017_06_06_230413_create_expense_table","1"),
("35","2017_06_06_230649_create_bill_table","1"),
("36","2017_06_06_230649_create_stock_table","1"),
("37","2017_06_06_230716_create_bill_entry_table","1"),
("38","2017_06_06_230904_create_payment_made_table","1"),
("39","2017_06_06_230920_create_payment_made_entry_table","1"),
("40","2017_07_02_093820_create_company_table","1"),
("41","2017_07_02_093908_create_okala_table","1"),
("42","2017_07_02_093955_create_fingerprint_table","1"),
("43","2017_07_02_101441_create_recruitingorder_table","1"),
("44","2017_07_02_101445_create_order_file_table","1"),
("45","2017_07_02_101541_create_manpower_table","1"),
("46","2017_07_02_101545_create_flight_table","1"),
("47","2017_07_02_101552_create_relation_table","1"),
("48","2017_07_02_111525_create_visaentrys_table","1"),
("49","2017_07_02_112834_create_mofas_table","1"),
("50","2017_07_02_112844_create_mofa_file_table","1"),
("51","2017_07_02_113905_create_visa_entry_file_table","1"),
("52","2017_07_02_113911_create_relation_mofa_visa_table","1"),
("53","2017_07_02_114007_create_medicalSlip_table","1"),
("54","2017_07_02_114017_create_report_file_table","1"),
("55","2017_07_02_114116_create_musaned_table","1"),
("56","2017_07_02_114223_create_visaStamping_table","1"),
("57","2017_07_02_120151_create_relation_Stam_table","1"),
("58","2017_07_03_102404_create_visas_table","1"),
("59","2017_07_09_053945_create_form_basis_table","1"),
("60","2017_07_09_054306_create_medical_slip_form_table","1"),
("61","2017_07_09_054337_create_medical_slip_form_pax_table","1"),
("62","2017_07_09_054343_create_recruit_customer_table","1"),
("63","2017_07_09_054400_create_medical_slip_form_pax_relation_table","1"),
("64","2017_07_09_072348_create_bank_table","1"),
("65","2017_07_09_105254_create_document_cat_table","1"),
("66","2017_07_09_105323_create_document_table","1"),
("67","2017_07_09_105359_document_category_relation_table","1"),
("68","2017_07_10_071211_add_extracolumn_to_company_table","1"),
("69","2017_07_10_071504_add_extracolumn_to_recruting_table","1"),
("70","2017_07_10_102221_create_expensesector_table","1"),
("71","2017_07_10_102313_create_recruiteexpense_table","1"),
("72","2017_07_10_102346_create_expense_pax_table","1"),
("73","2017_07_10_103128_create_expense_sector_pax_relation_table","1"),
("74","2017_07_11_044752_create_agreement_paper_table","1"),
("75","2017_07_11_044810_create_agreement_paper_pax_table","1"),
("76","2017_07_11_044830_create_agreement_paper_pax_relation_table","1"),
("77","2017_07_12_033953_create_incomes_table","1"),
("78","2017_07_13_034016_create_visaacceptance_table","1"),
("79","2017_07_13_034117_create_gamca_table","1"),
("80","2017_07_13_034123_create_visa_process_report_table","1"),
("81","2017_07_13_034137_create_visaacceptance_relation_table","1"),
("82","2017_07_15_041806_add_namear_to_company_table","1"),
("83","2017_07_15_042901_create_visaforms_table","1"),
("84","2017_07_15_043020_create_visaformbulks_table","1"),
("85","2017_07_15_043043_create_visaformagreement_table","1"),
("86","2017_07_15_043130_create_visaform_and_bulk_relation_table","1"),
("87","2017_07_15_043201_create_visaform_and_agreement_relation","1"),
("88","2017_07_15_065551_add_submissiondate_to_visaentry_table","1"),
("89","2017_07_16_063504_add_so_cloumn_to_visaform_table","1"),
("90","2017_07_16_085859_add_Qualification_cloumn_to_recruitcustomer_table","1"),
("91","2017_07_16_091948_create_immigration_clearance_table","1"),
("92","2017_07_16_092030_create_immigration_clearance_pax_table","1"),
("93","2017_07_16_092527_create_immigration_clearance_pax_relation_table","1"),
("94","2017_07_19_064337_create_TicketTaxs_table","1"),
("95","2017_07_19_070312_create_Ticketcommission_table","1"),
("96","2017_07_19_071729_create_TicketTaxsrelation_users_table","1"),
("97","2017_07_20_051731_create_note_sheet_table","1"),
("98","2017_07_20_051753_create_note_sheet_pax_table","1"),
("99","2017_07_20_051813_create_note_sheet_pax_relation_table","1"),
("100","2017_07_20_063113_create_airline_table","1");
INSERT INTO migrations VALUES
("101","2017_07_20_063202_create_airline_tax_table","1"),
("102","2017_07_20_063236_create_ticket_hotel_table","1"),
("103","2017_07_20_063237_create_airline_tax_relation_table","1"),
("104","2017_07_20_063255_create_ticket_order_table","1"),
("105","2017_07_20_063270_create_ticket_order_tax_table","1"),
("106","2017_07_20_063316_create_ticket_order_relation_table","1"),
("107","2017_07_20_085916_create_ticket_airlines_relation_table","1"),
("108","2017_07_22_060301_add_order_id_to_tikcetorder_table","1"),
("109","2017_07_22_064357_create_ticket_document_table","1"),
("110","2017_07_22_065222_create_ticket_relation_table","1"),
("111","2017_07_22_091918_create_backup_table","1"),
("112","2017_07_22_125915_add_tikestan_to_backup_table","1"),
("113","2017_07_23_072134_create_openingbalance_table","1"),
("114","2017_07_25_051426_add_column_to_invoices_table","1"),
("115","2017_07_25_101612_add_relationinvoice_to_invoices_table","1"),
("116","2017_07_25_102109_create_salesComissions_table","1"),
("117","2017_07_26_051806_add_column_tosalesComissions_table","1"),
("118","2017_07_26_064942_add_amount_column_tosalesComissions_table","1"),
("119","2017_07_26_121050_add_paidthrow_column_tosalesComissions_table","1"),
("120","2017_07_29_000713_create_table_reminders_","1"),
("121","2017_08_01_152513_create_email_table","1"),
("122","2017_08_01_152617_create_email_relation_table","1"),
("123","2017_08_01_173308_create_table_estimate","1"),
("124","2017_08_01_173337_create_table_estimate_entries","1"),
("125","2017_08_12_153258_add_aaccount_id_to_contact_table","1"),
("126","2017_08_13_173159_create_backupshcedule_table","1"),
("127","2017_08_20_153506_create_invoice_header_type_table","1"),
("128","2017_08_26_181345_add_etin_to_organizationprofil_table","1"),
("129","2017_08_27_094335_create_price_lists_table","1"),
("130","2017_08_27_170652_add_expensenumner_to_users_table","1"),
("131","2017_08_27_170737_add_income_numner_to_users_table","1"),
("132","2017_09_11_111239_create_account_information_forms_table","1"),
("133","2017_09_15_144125_create_conveyance_bills_table","1"),
("134","2017_09_16_104832_create_conveyance_bill_lists_table","1"),
("135","2017_09_20_115019_create_manpower_service_table","1"),
("136","2017_09_20_130709_create_manpower_service_ticket_document_table","1"),
("137","2017_09_20_152819_create_manpower_service_progress_status_table","1"),
("138","2017_09_20_165633_create_manpower_service_relation_table","1"),
("139","2017_09_24_113740_create_module_delete","1"),
("140","2017_09_25_162241_create_reciption_categories_table","1"),
("141","2017_09_25_162312_create_reciption_logbooks_table","1"),
("142","2017_09_26_151605_add_location_to_branch_table","1"),
("143","2017_09_27_152430_add_craetedby_updated_by_to_estimates_table","1"),
("144","2017_10_03_161718_add_save_to_bill_table","1"),
("145","2017_10_04_112216_add_save_to_expense_table","1"),
("146","2017_10_08_124104_create_gamca_receive_submit_table","1"),
("147","2017_10_08_124142_create_gamca_file_table","1"),
("148","2017_10_08_124854_create_gamca_file_relation_table","1"),
("149","2017_10_09_163650_create_finger_print_files_table","1"),
("150","2017_10_10_152202_create_trainings_table","1"),
("151","2017_10_10_152220_create_training_files_table","1"),
("152","2017_10_10_171208_create_completions_table","1"),
("153","2017_10_10_171221_create_completion_files_table","1"),
("154","2017_10_10_182235_create_fit_card_table","1"),
("155","2017_10_10_182315_create_police_clearances_table","1"),
("156","2017_10_10_182328_create_police_clearance_files_table","1"),
("157","2017_10_10_182339_create_fit_card_file_table","1"),
("158","2017_10_11_120209_create_submission_table","1"),
("159","2017_10_11_120244_create_submission_file_table","1"),
("160","2017_10_11_120250_create_fit_card_relation_table","1"),
("161","2017_10_11_130916_create_confirmations_table","1"),
("162","2017_10_11_130930_create_confirmation_files_table","1"),
("163","2017_10_29_161460_create_journal_entries_table","1"),
("164","2017_10_30_153235_add_assigndate_to_journalentrys_table","1"),
("165","2017_11_27_070356_add__column_to_journal_entries_table","1"),
("166","2017_12_27_105257_add_craetedby_updated_by_to_branch_table","1"),
("167","2018_09_19_155039_add_file_url_to_users_table","1"),
("168","2019_09_27_125739_createlocktransaction_table","1");




CREATE TABLE `modules` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `module_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `module_prefix` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO modules VALUES
("1","Contact","contact","1973-04-16 13:24:06","1970-02-18 21:40:51"),
("2","Contact Category","contact/category","1980-12-15 22:30:11","2004-08-24 17:21:48"),
("3","Account Chart","account-chart","1984-11-05 09:25:32","2011-04-08 18:16:26"),
("4","Inventory Item","inventory","1976-01-01 14:37:21","2011-01-17 10:38:00"),
("5","Inventory Category","inventory/category","2008-12-23 14:08:37","2016-07-15 16:14:45"),
("6","Stock Management","stock-management","1995-11-02 14:06:00","1993-06-12 03:55:21"),
("7","Product Track","product-track","1991-08-20 18:53:28","2000-11-09 19:34:04"),
("8","Manual Journal","manual-journal","1985-07-22 15:50:23","1999-05-03 22:58:28"),
("9","Bill","bill","1978-10-09 13:33:25","1991-03-04 14:30:42"),
("10","Credit Note","credit-note","1982-09-24 19:04:00","1991-02-24 21:22:01"),
("11","Credit Note Refund ","credit-note/refund","1978-01-17 19:09:58","1979-01-27 21:42:35"),
("12","Expense","expense","1996-12-25 12:40:00","2013-09-12 13:27:43"),
("13","Inventory","inventory","1995-09-11 05:17:06","1979-07-23 07:01:26"),
("14","Inventory Category","inventory/category","1991-02-03 08:48:09","1984-12-06 01:56:04"),
("15","Invoice","invoice","2012-10-13 06:07:30","2010-03-06 10:20:41"),
("16","Payment Made","payment-made","1995-09-07 10:51:58","1989-05-13 19:07:45"),
("17","Payment Received","payment-received","2011-08-20 13:12:27","1985-12-18 08:29:44"),
("18","Report","report","2013-10-05 17:20:55","1993-04-01 23:12:54"),
("19","Price List","price-list","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("20","Bank","bank","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("21","Income","income","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("22","Estimate","estimate","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("23","Sales Commission","Commission/Sales","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("24","Ticket Dashboard","ticket/dashboard","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("25","Ticket Order","ticket/order","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("26","Ticket Document","ticket/document","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("27","Ticket Commission","ticket/settings/commissions","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("28","Ticket Hotel","ticket/hotel","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("29","Ticket IATA Bill","ticket/IATA/bill","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("30","Recruit Dashboard","recruitdashboard","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("31","Recruite Company","company","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("32","Visa","visa","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("33","Visa Bill","visas/bill","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("34","Visa Acceptance","visaacceptance","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("35","Visa Form","visaform","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("36","Recruit Order","order","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("37","Recruit Order Invoice","order/invoice","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("38","Recruit Order Account","order/accounts","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("39","Recruit Account Expense","order/recruit/expense","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("40","Recruit Account Expense Secror","order/expense/sector","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("41","Customer","customer","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("42","Customer Information","customer/information","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("43","Customer Account","customer/account","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("44","Okala","okala","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("45","Gamca","gamca","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("46","Medicalslip Report","medicalslip","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("47","Mofa","mofa","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("48","Fit Card","fitcard","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("49","Police Clearance","police-clearance","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("50","Musaned","musaned","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("51","Visa Stamp","visastamp","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("52","Finger","fingerprint","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("53","Training","training","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("54","Manpower","manpowers","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("55","Completion","completion","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("56","Submission","submission","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("57","Confirmation","confirmation","2017-10-12 18:00:00","2017-10-12 18:00:00"),
("58","Flight","flight","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("59","Document","document","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("60","Document Category","document/category","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("61","Form Basic","form_basis","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("62","Form Medicalslip","medical_slip_form","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("63","Form Agreement","agreement","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("64","Form Non Objection","noobjection","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("65","Form Visa Process","visaprocess","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("66","Form Immigration","immigration","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("67","Form Note Sheet","note_sheet","2017-08-27 12:00:00","2017-08-27 12:00:00"),
("68","Account Information Form","accountinformationform","2017-09-12 12:00:00","2017-09-12 12:00:00"),
("69","Execuitive Approval","execuitive","2017-09-12 12:00:00","2017-09-12 12:00:00"),
("70","Manager Approval ","manager","2017-09-13 12:00:00","2017-09-13 12:00:00"),
("71","Account Approval ","account","2017-09-13 12:00:00","2017-09-13 12:00:00"),
("72","Admin Approval ","admin","2017-09-13 12:00:00","2017-09-13 12:00:00"),
("73","Director Approval ","director","2017-09-13 12:00:00","2017-09-13 12:00:00"),
("74","Officer Approval ","officer","2017-09-13 12:00:00","2017-09-13 12:00:00");




CREATE TABLE `mofa_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mofa_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `mofa_file_mofa_id_foreign` (`mofa_id`),
  CONSTRAINT `mofa_file_mofa_id_foreign` FOREIGN KEY (`mofa_id`) REFERENCES `mofas` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `mofas` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pax_id` int(10) unsigned NOT NULL,
  `mofaNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `iqamaNumber` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `mofaDate` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  `profession` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `medical_submit_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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






CREATE TABLE `mudule_delete` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO mudule_delete VALUES
("1","","1","",""),
("2","","1","",""),
("3","","1","","");




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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO musaned VALUES
("1","1","2017-10-15","1","1","1","2017-10-13 18:54:29","2017-10-13 18:54:52");




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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO okala VALUES
("1","2017-10-13","","1","1","1","1","2017-10-13 17:58:58","2017-10-13 17:58:58"),
("2","2017-10-13","","1","1","1","1","2017-10-13 17:58:59","2017-10-13 17:58:59");




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






CREATE TABLE `order_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `recruit_order_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `order_file_recruit_order_id_foreign` (`recruit_order_id`),
  CONSTRAINT `order_file_recruit_order_id_foreign` FOREIGN KEY (`recruit_order_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO order_file VALUES
("1","1","e","59e0870c925e6.Image03@2x301.jpg","2017-10-13 15:27:40","2017-10-13 15:27:40");




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
("1","logo.png","Ontik Tech","Ontik Technology","Dhanmondi Rd.No. 2","Dhaka","Dhaka","Bangladesh","1200","http://ontiktechnology.com","01xxx xxxxxx","info@ontiktechnology.com","2005-11-09 01:04:45","1998-12-21 15:59:22","","");




CREATE TABLE `parent_account_type` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `account_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` longtext COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO parent_account_type VALUES
("1","Assets","Assets","1998-03-23 23:48:05","1991-02-16 12:10:13"),
("2","Liability","Liability","1982-10-20 02:37:16","2004-10-16 12:58:32"),
("3","Equity","Equity","1972-07-02 09:34:33","2001-04-06 22:58:31"),
("4","income","income","1994-01-28 23:22:54","1975-02-04 00:55:51"),
("5","Expense","Expense","1993-08-20 13:58:31","2006-12-16 16:20:30");




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
  `file_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
("1","Cash","Cash","1986-09-07 14:57:02","2007-08-29 22:10:01"),
("2","Bank Cheque","Bank Cheque","2002-08-19 10:43:04","1975-08-20 20:16:05");




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `police_clearance_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `police_clearance_id` int(10) unsigned NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `police_clearance_files_police_clearance_id_foreign` (`police_clearance_id`),
  CONSTRAINT `police_clearance_files_police_clearance_id_foreign` FOREIGN KEY (`police_clearance_id`) REFERENCES `police_clearances` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `police_clearances` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paxid` int(10) unsigned DEFAULT NULL,
  `submission_date` date DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `police_clearances_created_by_foreign` (`created_by`),
  KEY `police_clearances_updated_by_foreign` (`updated_by`),
  CONSTRAINT `police_clearances_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `police_clearances_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO police_clearances VALUES
("2","1","2017-10-13","1","1","","");




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






CREATE TABLE `reciption_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `summary` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reciption_categories_created_by_foreign` (`created_by`),
  KEY `reciption_categories_updated_by_foreign` (`updated_by`),
  CONSTRAINT `reciption_categories_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reciption_categories_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `reciption_logbooks` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `category_id` int(10) unsigned NOT NULL,
  `associated_contact` int(10) unsigned DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `organization_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_street` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_city` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_state` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_zip_code` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `location_country` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `item_name` int(10) unsigned DEFAULT NULL,
  `symptom` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `meeting_date` date DEFAULT NULL,
  `meeting_time` time DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `reciption_logbooks_category_id_foreign` (`category_id`),
  KEY `reciption_logbooks_associated_contact_foreign` (`associated_contact`),
  KEY `reciption_logbooks_item_name_foreign` (`item_name`),
  KEY `reciption_logbooks_created_by_foreign` (`created_by`),
  KEY `reciption_logbooks_updated_by_foreign` (`updated_by`),
  CONSTRAINT `reciption_logbooks_associated_contact_foreign` FOREIGN KEY (`associated_contact`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reciption_logbooks_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `reciption_categories` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `reciption_logbooks_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reciption_logbooks_item_name_foreign` FOREIGN KEY (`item_name`) REFERENCES `item` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `reciption_logbooks_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON UPDATE CASCADE
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
  `contact_number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sub_reference` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `invoice_id` int(10) unsigned DEFAULT NULL,
  `passenger_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_status` tinyint(4) DEFAULT NULL,
  `substitued_order` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO recruitingorder VALUES
("1","1","1","1","123000"," 1234 ","2017-10-13","1","","ripon ","0","ripon ","1","1","2017-10-13 15:27:40","2017-10-13 15:31:09","2017-10-13","  ");




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






CREATE TABLE `report_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `mrdical_slip_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `report_file_mrdical_slip_id_foreign` (`mrdical_slip_id`),
  CONSTRAINT `report_file_mrdical_slip_id_foreign` FOREIGN KEY (`mrdical_slip_id`) REFERENCES `medicalslip` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
("1","Admin","Et tenetur enim ut quis possimus asperiores cum cumque. Nam suscipit voluptate pariatur facilis quia aut. Reiciendis sed non veniam eligendi et voluptatum. Est non asperiores id qui.","1","1","2003-04-01 16:29:20","1992-04-06 12:07:36"),
("2","Staff","Aliquam omnis deleniti iure molestias. Omnis dignissimos aliquid iusto consequatur incidunt. Saepe occaecati aliquam aut debitis neque velit. Laudantium error vero est in similique et hic aperiam.","1","1","1975-09-18 16:26:19","2008-12-23 14:20:04"),
("3","Employee","Harum earum ex ut ea qui soluta. Possimus qui consequatur ipsum et. Et quos sint praesentium earum. Voluptatem inventore aliquam in veniam expedita.","1","1","1993-10-28 03:02:51","2001-07-28 00:02:49");




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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO stock VALUES
("1","2","","1","1","","","1","1","1","2017-10-15 10:54:29","2017-10-15 10:54:29"),
("2","1","15-10-2017","1","1","1","","1","1","1","2017-10-15 12:03:02","2017-10-15 12:03:02"),
("3","1","2017-10-13","1","1","2","","1","1","1","2017-10-15 12:04:28","2017-10-15 12:04:28"),
("4","1","2017-10-15","1","1","3","","1","1","1","2017-10-15 12:57:16","2017-10-15 12:57:16"),
("5","1","2017-10-17","1","1","","","1","1","1","2017-10-17 13:33:51","2017-10-17 13:33:51"),
("10","1","18-10-2017","1","1","","1","1","1","1","2017-10-18 14:45:01","2017-10-18 14:45:01"),
("12","1","18-10-2017","1","1","5","","1","1","1","2017-10-18 14:56:24","2017-10-18 14:56:24"),
("13","1","18-10-2017","1","1","6","","1","1","1","2017-10-18 16:11:48","2017-10-18 16:11:48");




CREATE TABLE `submission` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submission_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `expected_flight_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `owner_approval` tinyint(4) DEFAULT NULL,
  `pax_id` int(10) unsigned NOT NULL,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_pax_id_foreign` (`pax_id`),
  KEY `submission_created_by_foreign` (`created_by`),
  KEY `submission_updated_by_foreign` (`updated_by`),
  CONSTRAINT `submission_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `submission_pax_id_foreign` FOREIGN KEY (`pax_id`) REFERENCES `recruitingorder` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `submission_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `submission_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `submission_id` int(10) unsigned NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `submission_file_submission_id_foreign` (`submission_id`),
  CONSTRAINT `submission_file_submission_id_foreign` FOREIGN KEY (`submission_id`) REFERENCES `submission` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






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
("1","0%-tax","0","1","1","1972-06-09 12:35:49","2004-08-27 22:13:30"),
("2","5%-tax","5","1","1","2014-10-23 06:58:16","1971-10-26 10:21:09"),
("3","10%-tax","10","1","1","1986-03-02 03:07:56","1989-05-31 18:19:45"),
("4","15%-tax","15","1","1","2000-07-08 18:24:19","1982-03-04 04:58:54"),
("5","20%-tax","20","1","1","1975-10-25 02:59:46","2011-01-22 23:03:02");




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
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ticket_order_tax_ticket_order_id_foreign` (`ticket_order_id`),
  CONSTRAINT `ticket_order_tax_ticket_order_id_foreign` FOREIGN KEY (`ticket_order_id`) REFERENCES `ticketorders` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticket_order_tax VALUES
("1","1","wer","345","",""),
("2","2","23","345","","");




CREATE TABLE `ticketcommissions` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `commissionRate` double NOT NULL,
  `commissionTax` double NOT NULL,
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
  `fareAmount` double DEFAULT NULL,
  `commissionRate` double DEFAULT NULL,
  `taxOnCommission` double DEFAULT NULL,
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
  CONSTRAINT `ticketorders_invoice_id_foreign` FOREIGN KEY (`invoice_id`) REFERENCES `invoices` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_ticket_hotel_id_foreign` FOREIGN KEY (`ticket_hotel_id`) REFERENCES `ticket_hotel` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `ticketorders_vendor_id_foreign` FOREIGN KEY (`vendor_id`) REFERENCES `contact` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO ticketorders VALUES
("1","1"," R "," G"," 12345678901"," 123456","2017-10-15"," 12"," 12345"," 1234","2017-10-15","dhaka","bogra","01:00"," 09:00"," 123"," 12","2017-10-15","bogra"," Dhaka","01:00","2017-10-21"," 12"," 12345","","3425","2017-10-15"," 123"," 2345","","","1"," 123","1","12345","19","20","2","2","","1","1","1","2017-10-15 11:25:17","2017-10-15 12:06:05","SO-000001"),
("2","1"," C"," C"," 12345678905"," 123","2017-10-15"," 1234"," 1234"," 12345678","2017-10-15","dhaka","bogra","01:00"," 10:00"," 12345"," 2345","2017-10-15","bogra","Dhaka","01:00","2017-10-15"," 234"," 123","","123","2017-10-15"," 1234"," 1234","5","3","2"," 23","1","2345","2","2","3","3","","1","1","1","2017-10-15 12:55:19","2017-10-15 13:07:00","SO-000002");




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






CREATE TABLE `training_files` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `training_id` int(10) unsigned NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `training_files_training_id_foreign` (`training_id`),
  CONSTRAINT `training_files_training_id_foreign` FOREIGN KEY (`training_id`) REFERENCES `trainings` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;






CREATE TABLE `trainings` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `paxid` int(10) unsigned DEFAULT NULL,
  `received_date` date DEFAULT NULL,
  `number` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `center_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `comment` longtext COLLATE utf8_unicode_ci,
  `created_by` int(10) unsigned NOT NULL,
  `updated_by` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `trainings_created_by_foreign` (`created_by`),
  KEY `trainings_updated_by_foreign` (`updated_by`),
  CONSTRAINT `trainings_created_by_foreign` FOREIGN KEY (`created_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `trainings_updated_by_foreign` FOREIGN KEY (`updated_by`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
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
  `contact_id` int(10) unsigned DEFAULT NULL,
  `created_by` int(10) unsigned DEFAULT NULL,
  `updated_by` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_branch_id_foreign` (`branch_id`),
  KEY `users_contact_id_foreign` (`contact_id`),
  CONSTRAINT `users_branch_id_foreign` FOREIGN KEY (`branch_id`) REFERENCES `branch` (`id`),
  CONSTRAINT `users_contact_id_foreign` FOREIGN KEY (`contact_id`) REFERENCES `contact` (`id`) ON UPDATE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO users VALUES
("1","E2CCFk7y30","user.jpg","user.jpg","Reiciendis quos sit saepe eveniet debitis. Sit voluptate enim ea beatae id et. Commodi distinctio consectetur aut.","admin@gmail.com","$2y$10$24OVF2Bi5qwDh8/zml1jgOE9FqzqLYPJjP.s6MOgPFkowPxBrx/sy","0","1","1","1","","1","1","MqtLfNaoy6So0aRrTqqMbCzJoNVoDUd4gQiDRk6XInafQvO6TrnVNczPTcgI","1997-07-25 02:20:22","2017-10-19 19:19:09"),
("2","E2CCFk7y30","user.jpg","user.jpg","Reiciendis quos sit saepe eveniet debitis. Sit voluptate enim ea beatae id et. Commodi distinctio consectetur aut.","test@gmail.com","$2y$10$24OVF2Bi5qwDh8/zml1jgOE9FqzqLYPJjP.s6MOgPFkowPxBrx/sy","0","1","1","2","","1","1","","1997-07-25 02:20:22","2009-01-12 08:30:23"),
("3","E2CCFk7y30","user.jpg","user.jpg","Reiciendis quos sit saepe eveniet debitis. Sit voluptate enim ea beatae id et. Commodi distinctio consectetur aut.","test2@gmail.com","$2y$10$24OVF2Bi5qwDh8/zml1jgOE9FqzqLYPJjP.s6MOgPFkowPxBrx/sy","0","1","1","2","","1","1","","1997-07-25 02:20:22","2009-01-12 08:30:23");




CREATE TABLE `visa_entry_file` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visaentrys_id` int(10) unsigned NOT NULL,
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visa_entry_file VALUES
("1","r","1","59e083e767597.Image03@2x301.jpg","2017-10-13 15:14:15","2017-10-13 15:14:15");




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
  `expire_date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visa_category_id` int(11) DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visaentrys VALUES
("1","2017-10-13","1","123456","2017-10-13","1","12"," ","123","0"," "," "," ","6","","1","1","1","2017-10-13 15:14:15","2017-10-18 16:11:48","");




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
  `img_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


INSERT INTO visastamping VALUES
("1","1","","","sa","sadsa","59e72cf13f6c4.59dc4ff6b8f43.13924912_1857136947850179_5648161821483886755_n.jpg","1","1","2017-10-18 16:29:05","2017-10-18 16:29:05");




/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;



SET FOREIGN_KEY_CHECKS=1;

-- --------------------------------------------------------
-- Host:                         43.255.154.8
-- Server version:               5.6.39-cll-lve - MySQL Community Server (GPL)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table db_nfnew.adminnotification_inbox
CREATE TABLE IF NOT EXISTS `adminnotification_inbox` (
  `notification_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Notification id',
  `severity` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Problem type',
  `date_added` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create date',
  `title` varchar(255) NOT NULL COMMENT 'Title',
  `description` text COMMENT 'Description',
  `url` varchar(255) DEFAULT NULL COMMENT 'Url',
  `is_read` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Flag if notification read',
  `is_remove` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Flag if notification might be removed',
  PRIMARY KEY (`notification_id`),
  KEY `ADMINNOTIFICATION_INBOX_SEVERITY` (`severity`),
  KEY `ADMINNOTIFICATION_INBOX_IS_READ` (`is_read`),
  KEY `ADMINNOTIFICATION_INBOX_IS_REMOVE` (`is_remove`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8 COMMENT='Adminnotification Inbox';

-- Dumping data for table db_nfnew.adminnotification_inbox: ~52 rows (approximately)
/*!40000 ALTER TABLE `adminnotification_inbox` DISABLE KEYS */;
INSERT INTO `adminnotification_inbox` (`notification_id`, `severity`, `date_added`, `title`, `description`, `url`, `is_read`, `is_remove`) VALUES
	(1, 1, '2018-06-28 02:45:34', 'Magento Open Source 2.2.5 delivers important security updates along with performance and functionality enhancements – 6/27/2018', 'The latest release of Magento Open Source includes important security enhancements along with performance and functionality improvements. With these important updates we strongly recommend that you upgrade to ensure your sites maintain the highest level of security. You can review the release notes for more information about all of the enhancements. For more information about security updates included in these versions of Magento please see our Security Center: https://magento.com/security/patches/magento-2.2.5-and-2.1.14-security-update', 'https://devdocs.magento.com/guides/v2.2/release-notes/bk-release-notes.html', 1, 0),
	(2, 3, '2018-07-06 10:12:20', 'New version 2.8.1 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.1\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.1', 1, 0),
	(3, 4, '2018-07-06 10:12:20', 'FAQ: How to configure &quot;read more&quot; in your Magento 2 blog post', ' If you still don\'t know how to configure read more functionality in your magento 2 blog post, please read this article.\nOnline documentation for Magento 2 blog extension is also available on our website. http://goo.gl/XOEdpy ', 'http://magefan.com/blog/add-read-more-tag-to-blog-post-content/?from=notification1', 1, 0),
	(4, 4, '2018-07-11 04:14:32', 'We want your opinion! Take our brief Sales and Marketing survey.', 'We\'d like to invite you to take our short survey on sales channels and digital advertising tools. Your input is valuable to us and will help to inform future products.\n\nThe survey should take no more than 3 minutes to complete. \n\nTo get started, go to: \n\nhttps://www.surveymonkey.com/r/ChannelSurvey2018\n\nThank you in advance for your participation.', 'https://www.surveymonkey.com/r/ChannelSurvey2018', 1, 0),
	(5, 4, '2018-07-17 08:00:20', 'Survey: Help us improve the Admin Panel usability by taking this 5 minute survey.', 'We\'d like to invite you to take our online survey on Admin Panel Usability. Your input is valuable to us and will help to inform the user experience direction. The survey should take no more than 5 minutes to complete.\n \nTo get started, go to:\nhttps://www.surveymonkey.com/r/SUS-AdHoc-M2', 'https://www.surveymonkey.com/r/SUS-AdHoc-M2', 1, 0),
	(6, 4, '2018-06-28 16:06:36', 'Check out GDPR modules available for Magento and Magento 2 https://goo.gl/d1SgJN', '', 'https://goo.gl/d1SgJN', 1, 0),
	(7, 4, '2018-07-04 21:15:44', 'Celebrate Independence day by getting a discount for hot Magento products. That\'s also monthly update roll-up https://goo.gl/uzRU19', '', 'https://goo.gl/uzRU19', 1, 0),
	(8, 4, '2018-07-09 23:12:04', 'Magento 2 hreflang tag as part of SEO Suite module. Start using it today https://goo.gl/kZEz4m', '', 'https://goo.gl/kZEz4m', 1, 0),
	(9, 4, '2018-07-18 02:15:38', 'Try out new Magento 2 module for adding Google reCaptcha to your site https://goo.gl/YWVcSs ', '', 'https://goo.gl/YWVcSs', 1, 0),
	(10, 4, '2018-07-31 01:28:12', 'Improved checkout experience is in the air. Look to the best of Fire Checkout 1.12 and 4.3.4 https://goo.gl/9hyMw7', '', 'https://goo.gl/9hyMw7', 1, 0),
	(11, 4, '2018-08-06 23:42:38', 'Join our early access program for Magento Payments. Learn more!', 'Want to get exclusive access to an upcoming new product before it is released to the public?\n\nWant to help influence new payment features Magento is building?\n\nJoin our Early Adopter Program and play a pivotal role in the validation of one of Magento’s newest products.  You will get access to Magento Payments – the payment solution built for Magento by Magento. Magento Payments enables you to instantly accept payments from your customers, offers the right payment options and allows you to manage financial operations with minimal effort. \n \nWe will be granting access to this program to a select number of merchants - we are looking for active participation and regular feedback.\n\nIf you would like to participate and your business is based in the United States, please send an email to: payments@magento.com', 'www.magento.com', 1, 0),
	(12, 3, '2018-07-26 16:00:00', 'Size Chart v1.0.1 released', 'Unlimited size charts built based on flexible catalog rules, 6 premade standard size chart. See more.', 'https://www.mageplaza.com/magento-2-size-chart/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=released', 1, 0),
	(13, 3, '2018-07-20 16:00:00', 'Blog v2.7.0 released', 'Feature: Import data from Wordpress, Aheadworks Blog M1, Magefan Blog M2. Bugfixing and performance improvements. See more.', 'https://www.mageplaza.com/magento-2-blog-extension/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=released', 1, 0),
	(14, 4, '2018-07-10 16:00:00', 'Mageplaza Is Now A Select Magento Extension Builder ', 'It’s our honor to announce that Mageplaza has successfully formed a partnership with Magento as a Select Magento extension builder.', 'https://www.mageplaza.com/blog/mageplaza-select-magento-extension-builder.html?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=select-partner', 1, 0),
	(15, 4, '2018-08-08 21:06:52', 'We are continuing to improve the Argento. Version 1.5.0 is ready to use', '', 'https://goo.gl/DmSyVQ', 1, 0),
	(16, 4, '2018-08-15 09:49:01', 'Get new opportunities for better navigation with Magento 2 Navigation Pro 1.6 release  https://goo.gl/6V5oZp', '', 'https://goo.gl/6V5oZp', 1, 0),
	(17, 3, '2018-08-22 09:09:08', 'New version 2.8.2 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.2\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.2', 1, 0),
	(18, 4, '2018-08-23 05:14:53', 'Check Magento 2 Page Speed module to do the most improvements https://goo.gl/NYT9Nn', '', 'https://goo.gl/NYT9Nn', 1, 0),
	(19, 4, '2018-08-29 08:24:11', 'Sign-up for Magento Shipping today!', 'Looking to reduce your shipping costs? Want to expand delivery options you offer your customers? Ship internationally?\n\nYou can with Magento Shipping. Magento Shipping lets you:\n\n•	Easily connect with global shipping carriers from within the Magento Admin \n•	Reduce shipping-related costs\n•	Automate order fulfillment and logistics \n•	Drive cart conversion, customer loyalty, and revenue \n\nIt’s time to take advantage of the new Magento Shipping sign-up process. Just enter your details and you’re ready to go.\n\nThe sooner you select your plan and register, the faster you’ll turn shipping into a profit machine for your business. \n\nSign up today!\n', 'http://account.magento.com/shipping/onboarding/start?utm_medium=microsite&amp;utm_campaign=1808-PR-EM-EMEA-APAC-MSH-Self-Service-Sign-Up&amp;utm_source=rss', 1, 0),
	(20, 4, '2018-08-29 08:56:56', 'Accelerated Mobile Pages for Magento 2 is available for download https://goo.gl/p6T64B', '', 'https://goo.gl/p6T64B', 1, 0),
	(21, 4, '2018-09-08 01:51:44', 'Take advantage Argento 1.6 release for Magento 2. There\'s plenty of good features https://goo.gl/ZWx3V8', '', ' https://goo.gl/ZWx3V8', 1, 0),
	(22, 1, '2018-09-18 16:21:46', 'Magento Open Source 2.2.6 delivers important security updates along with performance and functionality enhancements – 9/18/2018', 'The latest release of Magento Open Source includes important security enhancements along with performance and functionality improvements. With these important updates we strongly recommend that you upgrade to ensure your sites maintain the highest level of security. You can review the release notes for more information about all of the enhancements. For more information about security updates included in these versions of Magento please see our Security Center: https://magento.com/security/patches/magento-2.2.6-and-2.1.15-security-update', 'https://devdocs.magento.com/guides/v2.2/release-notes/bk-release-notes.html', 1, 0),
	(23, 4, '2018-09-17 10:52:56', 'FireCheckout 1.13.0 release for Magento 2, new features count and module updates https://goo.gl/4ETZ7z', '', 'https://goo.gl/4ETZ7z', 1, 0),
	(24, 4, '2018-09-21 12:05:12', 'Fire Checkout 1.13.1 for Magento 2 is available for download https://goo.gl/Rbhfc6', '', 'https://goo.gl/Rbhfc6', 1, 0),
	(25, 4, '2018-09-28 16:15:10', 'Review the modules compatible with Magento 2.2.6 and Magento 1.9.3.10 http://bit.ly/2zDUQmk', '', 'http://bit.ly/2zDUQmk', 0, 0),
	(26, 4, '2018-10-11 03:44:06', 'Magento 2 Prolabels 1.1 with new 15 labels presets is available for download. Check out the list of new awesome features http://bit.ly/2A3F7gO ', '', 'http://bit.ly/2A3F7gO ', 0, 0),
	(27, 3, '2018-10-19 21:56:34', 'New version 2.8.3 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.3\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.3', 0, 0),
	(28, 4, '2018-10-30 11:22:42', 'Help Magento improve our product - take a brief survey ', 'We want your perspectives on Personalization and Experience Optimization. \n\nYour feedback is 100% confidential.\n\nExperience Optimization refers to A/B/n Testing, Recommendations, and Experience Targeting (dynamic content, emails, promotions, etc.)\n\nThank you!\n\nClick here\nhttps://www.surveymonkey.com/r/M2-Exp-Opt-Oct2018', 'https://www.surveymonkey.com/r/M2-Exp-Opt-Oct2018', 0, 0),
	(29, 3, '2018-09-29 01:00:00', 'September 2018: Mageplaza Extensions Releases', 'In September 2018, we released 4 brand new extension(s), and update 9 extension(s). Please read the following information to learn what we’ve worked on this month.', 'https://www.mageplaza.com/blog/releases-2018-09/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=released', 0, 0),
	(30, 3, '2018-10-29 01:00:00', 'October 2018: Mageplaza Extensions Releases', 'In October 2018, we released 3 brand new extension(s), and update 10 extension(s). Please read the following information to learn what we’ve worked on this month.', 'https://www.mageplaza.com/blog/releases-2018-10/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=released', 0, 0),
	(31, 4, '2018-10-29 17:00:00', 'Creepy Halloween Sales up to 100% off', 'This party is not for the faint-hearted. Are you brave enough to join us? If you stay, the good news is you have a chance to get from at least 10% to 100% discount on Mageplaza store.', 'https://www.mageplaza.com/halloween-2018/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=halloween', 0, 0),
	(32, 4, '2018-11-06 10:00:36', 'Get a new format for our Magento 2 modules and themes. Easy to install, easy to upgrade, easy to use http://bit.ly/2zweTSq ', '', 'http://bit.ly/2zweTSq', 0, 0),
	(33, 3, '2018-11-11 20:42:52', 'New version 2.8.4 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.4\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.4', 0, 0),
	(34, 4, '2018-11-15 08:56:34', 'New 1.12 and 1.7.1 releases for Argento. There\'s so much to use and see http://bit.ly/2OLtEpY', '', 'http://bit.ly/2OLtEpY', 0, 0),
	(35, 3, '2018-11-22 21:50:57', 'New version 2.8.5 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.5\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.5', 0, 0),
	(36, 4, '2018-11-22 21:50:57', '30% Off. Black Friday Sale. Get discount for BLOG Plus &amp; BLOG Extra Extensions. Coupon: BFRIDAY2018', ' Improve your store with #1 Magento 2 Blog extension on the market. ', 'https://magefan.com/magento2-blog-extension?from=ntf-black-friday2018&amp;edition=plus', 0, 0),
	(37, 4, '2018-11-21 09:54:27', 'Are you Black Friday ready? We are! Here is a list of special offers http://bit.ly/2Adn9Hi', '', 'http://bit.ly/2Adn9Hi', 0, 0),
	(38, 4, '2018-11-21 17:00:00', 'Holiday Shopping Season Ultimate Guidelines 2018', 'The Ultimate Guides for Holiday Shopping Season', 'https://www.mageplaza.com/blog/holiday-shopping-season/home.html?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=BFCM', 0, 0),
	(39, 4, '2018-11-22 17:00:00', 'BFCM is here, 40% OFF', 'The biggest sales of the year. 40% off on everything Nov 23-26 EST Time.', 'https://www.mageplaza.com/magento-2-extensions/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=BFCM', 0, 0),
	(40, 4, '2018-11-27 10:32:18', 'New Magento 2 Social Login extension is ready to use. Try it now http://bit.ly/2zCIR8r', '', 'http://bit.ly/2zCIR8r', 0, 0),
	(41, 4, '2018-11-27 13:30:21', 'Benefit from the Magento Ad Channels Early Access Program', 'Magento Ad Channels will simplify the set up and administration of Google Merchant Center and Google Ads, while also helping maximize Google Ads ROI to help you accelerate your business growth.\n \nAs an Early Access Program participant, you will gain:\n \n• Exclusive pre-release access to Magento Ad Channels\n• Feedback opportunities to impact features and capabilities\n \nIf you’re a Magento Open Source 2.2.2 or later user, please send an email to sales_channels@magento.com to participate.', 'https://magento.com/google-smart-shopping-campaigns-in-magento', 0, 0),
	(42, 1, '2018-11-28 14:03:20', 'Magento Open Source 2.3.0 delivers Powerful New Merchant and Developer Experience Enhancements – 11/28/2018', 'The latest release of Magento Commerce includes powerful new tools that enhance both merchant and developer experiences like multi-source inventory management to improve operations and PWA Studio to help create engaging mobile shopping experiences. Magento 2.3 also delivers important security enhancements and performance improvements. With these important updates we strongly recommend that you upgrade to ensure your sites maintain the highest level of security. You can review the release notes for more information about all of the enhancements.', 'https://devdocs.magento.com/guides/v2.3/release-notes/bk-release-notes.html', 0, 0),
	(43, 4, '2018-12-06 09:08:20', 'Time to install our modules using composer. Plus new updates for Magento 1 and Magento 2 modules http://bit.ly/2rwFhIx', '', 'http://bit.ly/2rwFhIx', 0, 0),
	(44, 4, '2018-11-29 17:00:00', 'November Updates &amp; Releases for your Mageplaza Extensions', 'In November 2018, we released 2 brand new extensions, and update 3 extensions. Please read the following information to learn what we’ve worked on this month.', 'https://www.mageplaza.com/blog/releases-2018-11/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=BFCM', 0, 0),
	(45, 4, '2018-12-11 17:00:00', 'December Updates &amp; Releases for your Mageplaza Extensions', 'In December 2018, we released 5 brand new extensions, and update 4 extensions. Please read the following information to learn what we’ve worked on this month.', 'https://www.mageplaza.com/blog/releases-2018-12/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=BFCM', 0, 0),
	(46, 4, '2018-12-11 09:31:29', 'The latest versions of our extensions are compatible with Magento 1.9.4.0, Magento 2.2.7 and 2.3.0 http://bit.ly/2UyXF0y', '', 'http://bit.ly/2UyXF0y', 0, 0),
	(47, 4, '2018-12-12 15:08:04', 'What does 2019 look like for you? Take our Retail Trends survey!', 'Let us know what\'s important to you and your business in 2019!\n\nWe invite you to take our retail trends survey which should take no more than a few minutes to complete. As always, any individual information you provide will remain strictly confidential.\n\nYou can take the survey at: \nwww.surveymonkey.com/r/GHNQTJ2\n', 'https://www.surveymonkey.com/r/GHNQTJ2', 0, 0),
	(48, 4, '2018-12-15 22:33:20', 'Embed YouTube video with Magento 2 YouTube widget extension by Magefan.', 'Simple to use, no HTML knowledge required. Includes video lazy load technique for better page speed.', 'https://magefan.com/magento2-youtube-extension?from=ntf-new', 0, 0),
	(49, 4, '2018-12-20 17:00:00', 'Xmas sale 2018 - 30% off on all extensions', 'A big chance to buy Mageplaza extensions with 30% off which you will definitely use in 2019. Be quick and save money NOW!', 'https://www.mageplaza.com/magento-2-extensions/?utm_source=notification&amp;utm_medium=rss&amp;utm_campaign=XMAS', 0, 0),
	(50, 4, '2018-12-20 16:10:29', 'Send Xmas presents to your site with the SwissUpLabs offerings. Promo period ends on December 28 http://bit.ly/2UWuDZ3', '', 'http://bit.ly/2UWuDZ3', 0, 0),
	(51, 4, '2018-12-28 06:50:25', 'How to develop better Argento in 2019? Please read and help http://bit.ly/2EUsSqw', '', 'http://bit.ly/2EUsSqw', 0, 0),
	(52, 3, '2019-01-07 21:52:01', 'New version 2.8.6 of Magefan Magento 2 Blog Extension is now available.', ' You can download the new version from Magefan Store or update it via composer. Get us in touch if you need our help with an update or you have any questions.\n                                https://magefan.com/magento2-blog-extension?version=2.8.6\n                             ', 'https://magefan.com/magento2-blog-extension?version=2.8.6', 0, 0);
/*!40000 ALTER TABLE `adminnotification_inbox` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.admin_passwords
CREATE TABLE IF NOT EXISTS `admin_passwords` (
  `password_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Password Id',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'User Id',
  `password_hash` varchar(100) DEFAULT NULL COMMENT 'Password Hash',
  `expires` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Deprecated',
  `last_updated` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Last Updated',
  PRIMARY KEY (`password_id`),
  KEY `ADMIN_PASSWORDS_USER_ID` (`user_id`),
  CONSTRAINT `ADMIN_PASSWORDS_USER_ID_ADMIN_USER_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `admin_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='Admin Passwords';

-- Dumping data for table db_nfnew.admin_passwords: ~8 rows (approximately)
/*!40000 ALTER TABLE `admin_passwords` DISABLE KEYS */;
INSERT INTO `admin_passwords` (`password_id`, `user_id`, `password_hash`, `expires`, `last_updated`) VALUES
	(1, 1, 'ce7d8d433318feceada159df06e8eb27a7646d7a074afe01767e51c356a004d1:csaCftrZfjg3VtpjqYKKfp4233TMkvcQ:1', 0, 1529691205),
	(2, 1, 'ce7d8d433318feceada159df06e8eb27a7646d7a074afe01767e51c356a004d1:csaCftrZfjg3VtpjqYKKfp4233TMkvcQ:1', 0, 1529691379),
	(3, 2, '51c6d22db29cd3f16b0f4647532cf68de5d610e7ca647a19354a5ebec356f441:pDtzMgdqlw5howpeXL3wWG6Q5hJirXvq:1', 0, 1532453288),
	(4, 1, '5cafe62579732ebf64a3361158c40431ddb7af433de54e209d042cef1b2fa47f:CkMw1KbjYuDy2urNegyM7jIJtLEZWkyV:1', 0, 1535029805),
	(5, 3, '0301565e8d6ba1d5771fc45c1c14778fc5fc155bcb35873b2a7ed7f0ea96bc21:8uDHWltMTPLTmUG3N3vlaQuXGeulKQ8v:1', 0, 1537859618),
	(6, 2, '3cf0186068aaad3ecd0289da58630b04283ac4dcca467ebd1c2b501128c1dac0:yT3Fw60Hre4EBF0Am1NC1xIe4vMDArrU:1', 0, 1539576976),
	(7, 1, '69db24971df4bf06df56d655696a901a9c701f1dc7831bc8ba9c21523b557a07:4MtxwPmNDqnBIyNpsPoHITZ6ISa6BwqD:1', 0, 1542948876),
	(8, 4, '4b334eb7d3684bdacb7c57dd26745f2d6913f81776cd8e1610e9c37620c6a0e9:dYL51mmfFkrzD3t8KOErExwxj70DYpSg:1', 0, 1543336483);
/*!40000 ALTER TABLE `admin_passwords` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.admin_system_messages
CREATE TABLE IF NOT EXISTS `admin_system_messages` (
  `identity` varchar(100) NOT NULL COMMENT 'Message id',
  `severity` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Problem type',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Create date',
  PRIMARY KEY (`identity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Admin System Messages';

-- Dumping data for table db_nfnew.admin_system_messages: ~3 rows (approximately)
/*!40000 ALTER TABLE `admin_system_messages` DISABLE KEYS */;
INSERT INTO `admin_system_messages` (`identity`, `severity`, `created_at`) VALUES
	('b5b5de0a0651791ec61cdd9636a7e87b', 2, '2018-07-06 10:12:23'),
	('da332d712f3215b9b94bfa268c398323', 2, '2018-12-13 03:46:53'),
	('zendesk_rest_connection', 1, '2018-08-07 09:27:16');
/*!40000 ALTER TABLE `admin_system_messages` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.admin_user
CREATE TABLE IF NOT EXISTS `admin_user` (
  `user_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'User ID',
  `firstname` varchar(32) DEFAULT NULL COMMENT 'User First Name',
  `lastname` varchar(32) DEFAULT NULL COMMENT 'User Last Name',
  `email` varchar(128) DEFAULT NULL COMMENT 'User Email',
  `username` varchar(40) DEFAULT NULL COMMENT 'User Login',
  `password` varchar(255) NOT NULL COMMENT 'User Password',
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'User Created Time',
  `modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'User Modified Time',
  `logdate` timestamp NULL DEFAULT NULL COMMENT 'User Last Login Time',
  `lognum` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'User Login Number',
  `reload_acl_flag` smallint(6) NOT NULL DEFAULT '0' COMMENT 'Reload ACL',
  `is_active` smallint(6) NOT NULL DEFAULT '1' COMMENT 'User Is Active',
  `extra` text COMMENT 'User Extra Data',
  `rp_token` text COMMENT 'Reset Password Link Token',
  `rp_token_created_at` timestamp NULL DEFAULT NULL COMMENT 'Reset Password Link Token Creation Date',
  `interface_locale` varchar(16) NOT NULL DEFAULT 'en_US' COMMENT 'Backend interface locale',
  `failures_num` smallint(6) DEFAULT '0' COMMENT 'Failure Number',
  `first_failure` timestamp NULL DEFAULT NULL COMMENT 'First Failure',
  `lock_expires` timestamp NULL DEFAULT NULL COMMENT 'Expiration Lock Dates',
  `refresh_token` text COMMENT 'Email connector refresh token',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `ADMIN_USER_USERNAME` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='Admin User Table';

-- Dumping data for table db_nfnew.admin_user: ~4 rows (approximately)
/*!40000 ALTER TABLE `admin_user` DISABLE KEYS */;
INSERT INTO `admin_user` (`user_id`, `firstname`, `lastname`, `email`, `username`, `password`, `created`, `modified`, `logdate`, `lognum`, `reload_acl_flag`, `is_active`, `extra`, `rp_token`, `rp_token_created_at`, `interface_locale`, `failures_num`, `first_failure`, `lock_expires`, `refresh_token`) VALUES
	(1, 'admin', 'admin', 'jack@ardentit.com.sg', 'admin', '69db24971df4bf06df56d655696a901a9c701f1dc7831bc8ba9c21523b557a07:4MtxwPmNDqnBIyNpsPoHITZ6ISa6BwqD:1', '2018-06-23 02:13:25', '2019-01-09 02:46:26', '2019-01-09 02:46:26', 247, 0, 1, '{"configState":{"vesbrand_general_settings":"0","vesbrand_brand_block":"0","vesbrand_group_page":"0","vesbrand_brand_list_page":"0","vesbrand_product_view_page":"1","dev_debug":"1","dev_front_end_development_workflow":"0","dev_restrict":"0","dev_template":"0","dev_translate_inline":"0","dev_js":"0","dev_css":"1","dev_image":"0","dev_static":"0","dev_grid":"0","shipping_origin":"1","shipping_shipping_policy":"1","cataloginventory_options":"0","cataloginventory_item_options":"1","catalog_downloadable":"0","catalog_custom_options":"0","catalog_search":"0","catalog_navigation":"1","catalog_seo":"1","catalog_price":"0","catalog_layered_navigation":"0","catalog_frontend":"0","general_locale":"1","general_store_information":"1","general_single_store_mode":"1","general_country":"0","general_region":"0","catalog_fields_masks":"0","catalog_review":"0","catalog_productalert":"0","currency_import":"1","currency_yahoofinance":"0","currency_fixerio":"0","currency_webservicex":"0","currency_options":"0","webapi_soap":"1","webapi_webapisecurity":"1","oauth_access_token_lifetime":"1","oauth_cleanup":"0","oauth_consumer":"0","oauth_authentication_lock":"0","system_cron":"1","system_smtp":"0","system_currency":"0","system_adminnotification":"0","system_backup":"0","system_full_page_cache":"0","system_media_storage_configuration":"0","mfblog_index_page":"0","mfblog_post_view":"0","mfblog_post_list":"0","mfblog_author":"0","mfblog_sidebar":"0","mfblog_product_page":"0","mfblog_permalink":"0","mfblog_social":"0","mfblog_top_menu":"0","catalog_productalert_cron":"0","catalog_placeholder":"0","catalog_recently_products":"0","catalog_product_video":"0","web_url":"0","web_seo":"0","web_unsecure":"0","web_secure":"0","web_default":"0","web_cookie":"0","web_session":"0","web_browser_capabilities":"0","mfblog_general":"0","wishlist_general":"1","wishlist_email":"1","wishlist_wishlist_link":"1","customer_account_share":"0","customer_online_customers":"1","customer_create_account":"1","customer_captcha":"1","codazon_shopbybrand_general":"1","codazon_shopbybrand_featured_brands":"1","codazon_shopbybrand_brand_search_box":"1","codazon_shopbybrand_all_brand_page":"1","codazon_shopbybrand_brand_page":"1","codazon_shopbybrand_product_view_page":"1","sales_totals_sort":"1","sales_general":"1","sales_reorder":"0","sales_identity":"1","sales_minimum_order":"1","sales_orders":"0","sales_dashboard":"0","sales_gift_options":"0","sales_msrp":"0","sales_instant_purchase":"0","payment_other_other_payment_methods":"1","payment_other_cashondelivery":"0","payment_other_banktransfer":"0","payment_other_checkmo":"1","admin_emails":"0","admin_startup":"0","admin_url":"0","admin_security":"0","admin_dashboard":"0","admin_captcha":"1","sitemap_category":"0","sitemap_product":"0","sitemap_page":"0","sitemap_generate":"0","sitemap_limit":"0","sitemap_search_engines":"0","newrelicreporting_general":"0","newrelicreporting_cron":"0","customer_password":"1","customer_account_information":"1","customer_address":"1","customer_address_templates":"1","codazon_lookbook_general":"0","codazon_lookbook_images":"0","codazon_lookbook_lookbook_category_list":"1","sales_email_order_comment":"0","sales_email_invoice":"0","sales_email_invoice_comment":"0","tax_vertex_settings":"0","tax_vertex_seller_info":"0","tax_avaiable_shipping_product_codes":"0","tax_classes":"0","tax_calculation":"1","tax_defaults":"0","tax_display":"1","tax_cart_display":"1","smtp_module":"0","smtp_general":"0","smtp_configuration_option":"1","smtp_developer":"1","brainacts_reward_points_general":"1","brainacts_reward_points_rules":"1","disable_compare_general":"1","brainacts_reward_points_extension_info":"1","payment_other_other_paypal_payment_solutions":"1","payment_other_paypal_group_all_in_one":"1","payment_other_express_checkout_other":"0","checkout_options":"0","checkout_cart":"0","checkout_cart_link":"0","checkout_sidebar":"1","checkout_payment_failed":"1","rewardpoints_general":"1","rewardpoints_earning":"1","rewardpoints_spending":"1","rewardpoints_display":"1","rewardpoints_email":"1","customer_startup":"1","payment_other_account":"1","payment_other_recommended_solutions":"1","payment_other_klarna_section":"0","payment_other_amazon_payment":"0","payment_other_free":"0","payment_other_purchaseorder":"0","payment_other_authorizenet_directpost":"0","tax_sales_display":"1","tax_weee":"1"}}', NULL, NULL, 'en_US', 0, NULL, NULL, NULL),
	(2, 'navision', 'navision', 'naturefarm@cyansys.com', 'Navision', '3cf0186068aaad3ecd0289da58630b04283ac4dcca467ebd1c2b501128c1dac0:yT3Fw60Hre4EBF0Am1NC1xIe4vMDArrU:1', '2018-07-25 01:28:08', '2018-12-06 00:21:06', '2018-12-06 00:21:06', 27, 0, 1, 'null', NULL, NULL, 'en_US', 0, NULL, NULL, NULL),
	(3, 'Jon ', 'Kang', 'jonkang@naturesfarm.com', 'jonkang', '0301565e8d6ba1d5771fc45c1c14778fc5fc155bcb35873b2a7ed7f0ea96bc21:8uDHWltMTPLTmUG3N3vlaQuXGeulKQ8v:1', '2018-09-25 00:13:38', '2018-12-06 20:39:17', '2018-12-06 20:39:17', 13, 0, 1, 'null', NULL, NULL, 'en_US', 0, NULL, NULL, NULL),
	(4, 'Uzzair', 'Baharudin', 'uzzaircode@gmail.com', 'uzzaircode', '4b334eb7d3684bdacb7c57dd26745f2d6913f81776cd8e1610e9c37620c6a0e9:dYL51mmfFkrzD3t8KOErExwxj70DYpSg:1', '2018-11-27 09:34:43', '2018-12-09 15:55:36', '2018-12-09 15:55:36', 20, 0, 1, '{"configState":{"dev_template":"0","dev_debug":"1","dev_front_end_development_workflow":"0","dev_restrict":"0","dev_translate_inline":"0","dev_js":"0","dev_css":"0","dev_image":"0","dev_static":"0","dev_grid":"0","brainacts_reward_points_general":"1","brainacts_reward_points_rules":"1","disable_compare_general":"1"}}', NULL, NULL, 'en_US', 0, NULL, NULL, NULL);
/*!40000 ALTER TABLE `admin_user` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.admin_user_session
CREATE TABLE IF NOT EXISTS `admin_user_session` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity ID',
  `session_id` varchar(128) NOT NULL COMMENT 'Session id value',
  `user_id` int(10) unsigned DEFAULT NULL COMMENT 'Admin User ID',
  `status` smallint(5) unsigned NOT NULL DEFAULT '1' COMMENT 'Current Session status',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created Time',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Update Time',
  `ip` varchar(15) NOT NULL COMMENT 'Remote user IP',
  PRIMARY KEY (`id`),
  KEY `ADMIN_USER_SESSION_SESSION_ID` (`session_id`),
  KEY `ADMIN_USER_SESSION_USER_ID` (`user_id`),
  CONSTRAINT `ADMIN_USER_SESSION_USER_ID_ADMIN_USER_USER_ID` FOREIGN KEY (`user_id`) REFERENCES `admin_user` (`user_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=305 DEFAULT CHARSET=utf8 COMMENT='Admin User sessions table';

-- Dumping data for table db_nfnew.admin_user_session: ~304 rows (approximately)
/*!40000 ALTER TABLE `admin_user_session` DISABLE KEYS */;
INSERT INTO `admin_user_session` (`id`, `session_id`, `user_id`, `status`, `created_at`, `updated_at`, `ip`) VALUES
	(1, 'crj36qjob0jjnodflt085hf15b', 1, 0, '2018-06-23 02:15:03', '2018-06-23 02:18:28', '::1'),
	(2, '6a9c1rcqboogiqkma0ogt2lrnp', 1, 2, '2018-07-05 00:06:51', '2018-07-05 00:07:08', '192.168.1.1'),
	(3, '9h8l5lccg5nbr8cu2mmddvamf2', 1, 1, '2018-07-05 00:07:08', '2018-07-05 00:24:22', '192.168.1.1'),
	(4, '2l1qa7kb9m55h8tbjskd4khrhg', 1, 2, '2018-07-06 10:12:15', '2018-07-06 10:13:14', '61.6.1.60'),
	(5, '5a56j2mbbt83aigqtj6oahna03', 1, 1, '2018-07-06 10:13:14', '2018-07-06 10:13:44', '61.6.1.60'),
	(6, '34sut5ph7guldkr71t5017mebe', 1, 2, '2018-07-06 10:48:42', '2018-07-06 10:55:01', '61.6.1.60'),
	(7, 'h4fjdqi86pk1isjd5ni3caaahk', 1, 1, '2018-07-06 10:55:01', '2018-07-06 11:04:55', '61.6.1.60'),
	(8, 'obn184ne6s41de0m3935ckd7vl', 1, 1, '2018-07-06 22:44:32', '2018-07-06 22:44:32', '113.210.122.124'),
	(9, 'r9qqcndg6phg65lambb2potse5', 1, 1, '2018-07-07 00:03:31', '2018-07-07 00:29:22', '175.139.225.220'),
	(10, '6c5sp3dce3n3d86c6kpbkari0v', 1, 1, '2018-07-07 21:33:29', '2018-07-07 21:33:29', '192.168.1.1'),
	(11, 'cb0gberdnh1d57eei8qenmqsel', 1, 2, '2018-07-11 17:31:48', '2018-07-11 17:49:52', '118.201.246.124'),
	(12, 'mglcpcod373qqcge59eiifil9a', 1, 1, '2018-07-11 17:49:52', '2018-07-11 17:52:24', '111.65.46.118'),
	(13, 'unobkreog5r627g1kfm18aum1n', 1, 1, '2018-07-25 01:23:19', '2018-07-25 01:29:12', '218.212.60.211'),
	(14, 'ncadl12jg0n5uo6vv9ine8srv4', 1, 1, '2018-07-25 11:48:34', '2018-07-25 11:50:46', '118.201.246.124'),
	(15, '4j0k0mqha1rv5tpg5n3kpsjl5o', 1, 1, '2018-07-25 20:19:39', '2018-07-25 20:28:59', '175.139.225.77'),
	(16, 'mqm5sk74gghkjihsumd8eflhps', 1, 1, '2018-07-26 23:08:25', '2018-07-26 23:22:27', '175.139.225.77'),
	(17, '86bv16lc580fkgegmf7tgilkt9', 1, 1, '2018-07-27 09:13:32', '2018-07-27 09:31:14', '61.6.50.43'),
	(18, '8r1p3k9to0usi8gl45128nhlj1', 1, 1, '2018-07-27 09:47:24', '2018-07-27 09:54:37', '61.6.50.43'),
	(19, 's5sqk93c03vt9q9rfpmd9a9gha', 1, 2, '2018-07-27 10:16:44', '2018-07-27 10:23:28', '61.6.50.43'),
	(20, 'jq8mrjldivbps4hrr70agf583n', 1, 1, '2018-07-27 10:23:28', '2018-07-27 11:16:18', '61.6.50.43'),
	(21, 'n7coqc4ok223ck1o8vhtphv49j', 1, 1, '2018-07-27 14:29:05', '2018-07-27 14:30:24', '61.6.50.43'),
	(22, '6kdm99298a86ou7kuugj2jdjn3', 1, 1, '2018-07-27 15:44:29', '2018-07-27 15:48:16', '61.6.50.43'),
	(23, 'cg4si1foet2un2qnbuhjji29b4', 1, 1, '2018-07-27 16:45:36', '2018-07-27 16:48:39', '61.6.50.43'),
	(24, '8r0d469cnoh40k406031p25aov', 1, 1, '2018-07-27 18:16:07', '2018-07-27 18:24:18', '61.6.50.43'),
	(25, 'pjt6u3fs4bfvceaess2dm1g9rv', 1, 2, '2018-07-29 11:17:47', '2018-07-29 11:25:31', '175.139.226.110'),
	(26, '6keqtrf8o5dh3d7maq2vjs0tt0', 1, 1, '2018-07-29 11:25:31', '2018-07-29 11:26:51', '175.139.226.110'),
	(27, 'fa5bcv2hat2hlc2l4ia9m6vvis', 1, 1, '2018-07-29 16:03:45', '2018-07-29 16:12:34', '175.139.226.110'),
	(28, 'out6ehkncaptl610cvf9j6o23v', 1, 1, '2018-07-29 17:21:47', '2018-07-29 17:26:58', '175.139.226.110'),
	(29, '5apjbjdelmt7h677rg1cphgo2l', 1, 1, '2018-07-29 18:01:14', '2018-07-29 23:51:49', '175.139.227.20'),
	(30, '7ol3j8ria49p1ipk1d6359mmll', 1, 1, '2018-07-30 00:01:26', '2018-07-30 00:04:42', '175.139.227.20'),
	(31, 'tptngesog2mool04thvja4nmgu', 1, 1, '2018-07-30 09:15:25', '2018-07-30 14:01:45', '61.6.50.43'),
	(32, '2autea6vrhcmkvq504mvh8m5m9', 1, 1, '2018-07-30 14:09:44', '2018-07-30 19:49:35', '61.6.50.43'),
	(33, 'nmp637dur73b81rm71nq0rqa4p', 1, 1, '2018-08-01 14:56:54', '2018-08-01 15:04:15', '61.6.50.43'),
	(34, 'csdfrn3eij67lnqev3pm8j1cd6', 1, 1, '2018-08-02 08:56:29', '2018-08-02 09:38:00', '103.18.0.18'),
	(35, 'utk8sg5b0tn3siqgmc00g2gmn9', 1, 1, '2018-08-02 16:11:44', '2018-08-02 22:37:36', '103.18.0.18'),
	(36, 'vi39fdjbcho4e6m7sjrirm321g', 1, 1, '2018-08-03 09:01:26', '2018-08-03 14:08:11', '175.139.227.20'),
	(37, 'mood0vh5fagflnue0b4n37u9s0', 1, 1, '2018-08-03 14:12:05', '2018-08-03 14:14:16', '175.139.227.20'),
	(38, 'c0q2v73pao7lar7526mnu8viq4', 1, 1, '2018-08-03 14:15:25', '2018-08-03 17:46:37', '175.139.227.20'),
	(39, 'fd78fd20icc47hoim3k7bgi073', 1, 1, '2018-08-03 17:58:30', '2018-08-03 18:05:26', '175.139.227.20'),
	(40, 'jnqkbls2hb7ejkvokuhit43a92', 1, 1, '2018-08-03 18:06:09', '2018-08-03 20:39:21', '175.139.227.20'),
	(41, 'dhftpect9sf3ukhom45a93t9a7', 1, 1, '2018-08-04 09:59:26', '2018-08-05 00:51:49', '175.139.227.20'),
	(42, 'q8vrihsp1ksja8vs48hp565ti5', 1, 1, '2018-08-05 00:55:33', '2018-08-05 02:03:57', '175.139.227.20'),
	(43, 'blaiec6ve661i4oio93u90o751', 1, 1, '2018-08-05 02:05:24', '2018-08-05 21:06:37', '175.139.227.20'),
	(44, '7f1ptgd3jpv98enokvomno17b1', 1, 1, '2018-08-06 10:54:31', '2018-08-07 09:27:07', '61.6.50.43'),
	(45, 'k7qrlotb4m6t4majr3t6k9k7p5', 1, 0, '2018-08-06 13:46:01', '2018-08-06 23:49:24', '115.133.205.141'),
	(46, 'bmallq8fr8alndatctnjs2tko6', 1, 1, '2018-08-07 00:28:43', '2018-08-07 03:31:51', '175.136.106.40'),
	(47, 'e9k96e4ebbv591r5kj1s1sqtm5', 1, 1, '2018-08-07 09:31:34', '2018-08-07 09:32:22', '61.6.50.43'),
	(48, 'c1kh617431ru0gi7blqa75btc0', 1, 1, '2018-08-07 09:34:23', '2018-08-07 20:34:35', '61.6.50.43'),
	(49, 'in3tk54dhbg56ii6152ibv66k2', 1, 1, '2018-08-07 14:08:04', '2018-08-08 00:50:27', '115.133.205.141'),
	(50, 'jrdm201db74g0io13kcl4u9cj0', 1, 1, '2018-08-07 20:36:45', '2018-08-08 00:53:13', '175.139.227.175'),
	(51, 'nrt1sou92rov3dfe9k58m5qpi6', 1, 1, '2018-08-08 01:40:11', '2018-08-08 01:40:11', '175.139.227.175'),
	(52, '43mlvbeg90mhc59ekpa6ccper0', 1, 1, '2018-08-08 01:42:02', '2018-08-09 07:17:33', '175.139.227.175'),
	(53, '9714s40ncc28l2uvlcclcacvp0', 1, 1, '2018-08-08 01:44:52', '2018-08-08 03:23:51', '175.136.106.40'),
	(54, 'o7hj9otpis40rt3ltckr6dauj4', 1, 1, '2018-08-08 02:19:32', '2018-08-08 02:20:18', '175.139.227.175'),
	(55, 'hbh45pjehfb85fcbvuqfvgl064', 1, 1, '2018-08-08 14:25:28', '2018-08-08 23:02:58', '115.133.205.141'),
	(56, '7m2mb5je2n861r4gjleof6je60', 1, 1, '2018-08-08 23:28:02', '2018-08-09 01:26:01', '175.136.106.40'),
	(57, '5ddi0b4jm49fbi5gan4ree7pq6', 1, 1, '2018-08-09 01:30:54', '2018-08-09 03:42:29', '175.136.106.40'),
	(58, '0p7mu5vmes5dtesvidrsg8o955', 1, 1, '2018-08-09 17:23:54', '2018-08-09 17:25:20', '175.139.227.175'),
	(59, 'oat96nebjkbpub0hthucj0qrj6', 1, 1, '2018-08-09 18:28:58', '2018-08-09 18:32:29', '61.6.50.43'),
	(60, 'a8j6fecgfblabgeqdhn6k5bce2', 1, 1, '2018-08-09 19:01:01', '2018-08-09 19:29:08', '61.6.50.43'),
	(61, 'lak184964tl7jkqat8otj9ngj5', 1, 1, '2018-08-09 21:46:16', '2018-08-09 22:17:11', '60.53.216.36'),
	(62, 'usuatl3efjf5tlb05o3ps3hjg3', 1, 1, '2018-08-09 23:46:02', '2018-08-10 00:14:53', '61.6.50.43'),
	(63, '2hc609ass17sur2f28porj07r5', 1, 1, '2018-08-10 09:25:58', '2018-08-10 09:53:43', '113.210.101.70'),
	(64, 'eg051jokivjht8ua54r0d0jn35', 1, 1, '2018-08-13 20:08:50', '2018-08-13 22:31:26', '115.133.205.141'),
	(65, 'fvp8caa6efld937qignugkl344', 1, 1, '2018-08-13 21:41:37', '2018-08-13 21:57:39', '61.6.50.43'),
	(66, 'bf7jndhvqqv4m8e86v0kfddfs6', 1, 1, '2018-08-21 01:46:29', '2018-08-21 01:46:29', '113.210.200.24'),
	(67, 'j403gdrcecqqf6o0rrro86me32', 1, 1, '2018-08-22 09:09:02', '2018-08-22 09:17:51', '124.82.31.122'),
	(68, '9v49ag5a7tlnp4ef2goraffqh2', 1, 1, '2018-08-22 09:21:56', '2018-08-22 09:24:40', '124.82.31.122'),
	(69, '0gis3jjoep4ah4kjquqaa8hoa2', 1, 1, '2018-08-22 09:33:02', '2018-08-22 10:30:50', '124.82.31.122'),
	(70, 'ao0396548pcjknbgv563lprjb6', 1, 1, '2018-08-22 10:37:08', '2018-08-22 10:40:03', '124.82.31.122'),
	(71, '0tjmqkeiidvjjutcktak7cg800', 1, 1, '2018-08-22 10:42:54', '2018-08-22 10:50:20', '124.82.31.122'),
	(72, 'dk89cltlopudtlovbrabot9ht5', 1, 1, '2018-08-22 10:54:08', '2018-08-22 10:57:02', '124.82.31.122'),
	(73, 'u00mnua1p7ichtgmec7jjdbk04', 1, 1, '2018-08-22 10:59:19', '2018-08-22 11:17:18', '124.82.31.122'),
	(74, 'd9d5sljau2skkhp0rjjvnfp8p0', 1, 1, '2018-08-22 21:10:31', '2018-08-22 21:33:21', '115.133.205.141'),
	(75, 'r3pvc0fn9l5qbsj46qqcfu6im5', 1, 1, '2018-08-22 22:41:27', '2018-08-22 23:47:00', '115.133.205.141'),
	(76, '2n6u9och6hcjrlp9ri9b7reom7', 1, 1, '2018-08-22 23:49:11', '2018-08-23 00:22:25', '115.133.205.141'),
	(77, 'pf9lqf7qq8apboedee3gd6pa17', 1, 1, '2018-08-23 04:10:55', '2018-08-23 04:44:19', '115.133.205.141'),
	(78, 'k01oe73r92rb3hk91ndfn5khs3', 1, 0, '2018-08-23 06:08:44', '2018-08-23 06:10:23', '113.210.186.216'),
	(79, 'ta9riafmn3012kr32rcp7esml3', 1, 1, '2018-08-23 06:10:34', '2018-08-23 06:53:19', '113.210.186.216'),
	(80, 'k9d8q2pnme3n7do929kc77tln7', 1, 1, '2018-08-23 08:02:08', '2018-08-23 08:38:52', '124.82.31.122'),
	(81, 'vtdvougq9avl268jl6fauiglt1', 1, 1, '2018-08-23 09:48:03', '2018-08-23 09:55:48', '113.210.186.216'),
	(82, 's3gpobcoaml6f8mqlq5ls54dl2', 1, 1, '2018-08-24 03:23:55', '2018-08-24 04:39:32', '115.133.205.141'),
	(83, '2fq16un6hvst88qmb8chb7h6s2', 1, 1, '2018-09-04 22:23:16', '2018-09-04 22:24:51', '60.49.37.98'),
	(84, 'h6f1784gl8mn8vroqscuhm06g4', 1, 1, '2018-09-05 01:55:21', '2018-09-05 02:08:29', '61.6.50.43'),
	(85, 'e9tg6esd0huo69oud47tgo1ob7', 1, 1, '2018-09-10 21:03:08', '2018-09-10 21:06:57', '175.143.114.188'),
	(86, 'mp1e2j8kktvks94u104mgtjmh3', 1, 1, '2018-09-24 22:47:19', '2018-09-24 22:47:19', '123.136.116.202'),
	(87, 'srart0r5qil5f8opkhtha4ro74', 1, 1, '2018-09-24 22:48:49', '2018-09-25 00:02:45', '123.136.116.202'),
	(88, 'ectoc8pr3884ic1s8v8gpmd7l5', 1, 0, '2018-09-25 00:11:59', '2018-09-25 00:15:56', '175.140.119.75'),
	(89, 'g7isl07l9veiep5bqjd5u5vjf5', 3, 0, '2018-09-25 00:16:26', '2018-09-25 00:20:47', '175.140.119.75'),
	(90, '7n8m5r9p5sslr309pbm75a1ln7', 3, 0, '2018-09-25 00:22:06', '2018-09-25 00:37:43', '175.140.119.75'),
	(91, 'o0t4pvqii39m353hdqbsp8l6r3', 3, 1, '2018-09-25 00:28:06', '2018-09-25 00:28:06', '119.75.5.174'),
	(92, 'kb41lfannt7cc9f145puiefia5', 1, 1, '2018-09-25 00:38:23', '2018-09-25 01:22:43', '175.140.119.75'),
	(93, 'bmvlr4s7b9t3kf6mj26ttn5445', 3, 1, '2018-09-25 01:26:43', '2018-09-25 01:40:35', '119.75.5.174'),
	(94, 'dni635eriu52905iovkg896m96', 1, 1, '2018-09-25 01:28:34', '2018-09-25 01:32:27', '175.140.119.75'),
	(95, '671kd2osllj119q9i3jrgr9ch6', 1, 1, '2018-09-25 02:13:31', '2018-09-25 02:25:40', '123.136.116.183'),
	(96, '6k7ussvu6kuf5v8aergef20ua7', 1, 1, '2018-09-25 02:52:55', '2018-09-25 05:34:00', '175.140.119.75'),
	(97, 'lagsq4er421ho8k7at35923pd1', 3, 1, '2018-09-25 02:54:01', '2018-09-25 03:04:52', '119.75.5.174'),
	(98, 'g6lc0mt7bav9hhhjq9ccfujv66', 1, 1, '2018-09-25 07:37:52', '2018-09-25 09:25:08', '124.82.28.95'),
	(99, 'duof641jb6907l7oi7lvtcsdc4', 1, 1, '2018-09-25 22:46:39', '2018-09-25 22:47:28', '175.140.119.75'),
	(100, '5n26emgq0alhbq0uchhncf9s36', 1, 1, '2018-09-26 20:32:45', '2018-09-26 20:39:42', '175.140.119.75'),
	(101, '4t8vbgfjfa7gu6irkgvbavb1p3', 1, 1, '2018-09-30 21:08:14', '2018-09-30 22:27:18', '175.140.119.75'),
	(102, '17cnva4diire1ufuf7uoobntq3', 1, 1, '2018-10-01 01:03:31', '2018-10-01 01:52:47', '175.140.119.75'),
	(103, 'jrk2kjvspo8ltm1n7qh65r92f0', 1, 0, '2018-10-14 21:12:59', '2018-10-14 21:16:43', '60.54.11.73'),
	(104, 'fv3069pv6ifclm7au7klbsd6o7', 2, 0, '2018-10-14 21:18:07', '2018-10-14 21:18:34', '60.54.11.73'),
	(105, 'bktmqefnhovnn30h4dfsonai97', 2, 1, '2018-10-14 21:37:44', '2018-10-14 22:18:32', '115.42.211.146'),
	(106, 'b4b7a3vf7caoso1p9suvmctb77', 1, 1, '2018-10-14 22:32:21', '2018-10-14 22:35:12', '60.54.11.73'),
	(107, 'r0hsqr5mhl9vfoso0015ii2lt3', 3, 1, '2018-10-14 23:24:37', '2018-10-14 23:33:08', '119.75.5.174'),
	(108, 'rgnbqlrah2p4159k2dotrr4ss5', 2, 1, '2018-10-14 23:31:28', '2018-10-14 23:31:28', '118.201.246.124'),
	(109, '69oq5icuevvf4kslsnmk6gt6s3', 1, 1, '2018-10-15 00:35:09', '2018-10-15 00:53:18', '60.54.11.73'),
	(110, 'omti5sv9nq7s99f3fg3u199ne3', 1, 1, '2018-10-15 18:59:31', '2018-10-15 19:00:15', '175.141.241.162'),
	(111, '1do9v003ihgt49a3qnubchu5u1', 3, 1, '2018-10-15 19:40:55', '2018-10-16 00:54:44', '119.75.5.174'),
	(112, 'fiel66avc99kt7mvo4v0k5fe97', 3, 1, '2018-10-16 00:19:48', '2018-10-16 00:19:48', '119.75.5.174'),
	(113, 'cagf7rm3mbo20msidk164ea9c1', 3, 1, '2018-10-17 01:53:51', '2018-10-17 01:54:41', '119.75.5.174'),
	(114, 'rhbj1e4o5jhnsb3725murvhl76', 3, 1, '2018-10-18 20:18:44', '2018-10-18 20:19:32', '119.75.5.174'),
	(115, 'eh3jmf2201c497bt7ksage3vt0', 1, 1, '2018-10-19 21:56:29', '2018-10-19 21:57:12', '60.54.11.73'),
	(116, 'ktq1gh6q2qdv7glc6jadgouli3', 1, 1, '2018-10-25 07:23:20', '2018-10-25 07:35:48', '175.140.30.111'),
	(117, '1k5o0r5logp1ot0ll84od24ja4', 1, 1, '2018-10-25 19:12:41', '2018-10-25 19:13:35', '175.141.242.57'),
	(118, 'fhp5vkv19cvic37mkjafjnmhg4', 1, 1, '2018-10-31 01:12:42', '2018-10-31 01:12:42', '1.53.164.1'),
	(119, 'btel4n2i1qqsqd7iesk4mjqfl4', 1, 1, '2018-10-31 22:15:06', '2018-10-31 22:15:58', '1.53.164.1'),
	(120, 'i1n8fea08k9akabcl70urr6kj5', 1, 1, '2018-10-31 22:17:45', '2018-10-31 22:23:43', '1.53.164.1'),
	(121, 'qg1lblhqjq6kd9gf40qvjsjtd4', 1, 1, '2018-11-01 00:03:09', '2018-11-01 00:03:57', '1.53.164.1'),
	(122, '3vqrr4b1f5jjsg84gq1u5a3em1', 1, 1, '2018-11-01 00:05:26', '2018-11-01 00:12:40', '1.53.164.1'),
	(123, 'pb7ii5itsfbpvfqf0d10ho7h60', 1, 1, '2018-11-01 00:29:58', '2018-11-01 00:39:13', '1.53.164.1'),
	(124, 'svr0bieaijgpt4557c4278sp06', 1, 1, '2018-11-01 00:42:32', '2018-11-01 00:42:32', '1.53.164.1'),
	(125, 'a3hgg0sth9t9v5tmchb6ktmcr3', 1, 1, '2018-11-01 00:44:28', '2018-11-01 00:46:52', '1.53.164.1'),
	(126, 'a5dnldmljid6pudidutih9cdl0', 1, 1, '2018-11-01 00:49:13', '2018-11-01 00:49:13', '1.53.164.1'),
	(127, 'b3mi1nb4qun5chdoipalde6mm1', 1, 1, '2018-11-01 00:51:18', '2018-11-01 01:24:33', '1.53.164.1'),
	(128, '8enpj92u2fjl0ong7ql54o4qp7', 1, 1, '2018-11-01 01:29:41', '2018-11-01 01:35:51', '1.53.164.1'),
	(129, '06ren8m2o0nqm949is8nnbeg82', 1, 1, '2018-11-01 01:45:43', '2018-11-01 01:47:55', '1.53.164.1'),
	(130, 'lhoe3a3m906pkogleggogja6u2', 1, 1, '2018-11-01 01:53:54', '2018-11-01 02:11:21', '1.53.164.1'),
	(131, '9cihhi5ti8cupgaqd6adqodcs0', 1, 1, '2018-11-01 02:15:42', '2018-11-01 02:31:43', '1.53.164.1'),
	(132, 'b63sb0jfqq8spv0skk1jutpeq3', 1, 1, '2018-11-01 02:36:37', '2018-11-01 02:36:37', '1.53.164.1'),
	(133, 'jcj5vces3gs6tm5f5782pdr2n1', 1, 1, '2018-11-01 02:49:13', '2018-11-01 02:49:13', '1.53.164.1'),
	(134, 'bhiik2mcf1p529u7hpfhjghsk5', 1, 1, '2018-11-01 03:00:06', '2018-11-01 03:00:57', '1.53.164.1'),
	(135, 'i13bb11uakte5hgclbrpf58hk5', 1, 1, '2018-11-01 03:06:53', '2018-11-01 03:07:52', '1.53.164.1'),
	(136, 'sl3hi04tt0cef1nudee25kjfj4', 1, 1, '2018-11-01 03:11:33', '2018-11-01 03:11:33', '1.53.164.1'),
	(137, 'ivmnvq5fvhmgrs3prkgmuag816', 1, 1, '2018-11-01 03:18:12', '2018-11-01 03:18:12', '1.53.164.1'),
	(138, 'sl6ubptq83o3bhfvvsekuv5i12', 1, 1, '2018-11-01 03:23:24', '2018-11-01 03:23:24', '1.53.164.1'),
	(139, '6l12o1g1o23cr1vchrlejr0d16', 2, 1, '2018-11-01 15:56:11', '2018-11-01 16:24:56', '194.151.205.106'),
	(140, 'ce53vnr5o85rfrrj5nlv8tgo91', 2, 1, '2018-11-01 19:08:06', '2018-11-01 19:11:24', '119.56.127.100'),
	(141, 'r2b6vhcdtebt6v6n8lbv9m23m3', 2, 1, '2018-11-01 21:32:15', '2018-11-01 21:35:10', '194.151.205.63'),
	(142, '5cuv59nq7s77in8h70ovq8llq3', 1, 1, '2018-11-01 21:42:11', '2018-11-01 22:01:44', '60.53.33.62'),
	(143, '7q2orpmoaqt8frnqj9ad5qcqi2', 1, 1, '2018-11-01 22:49:02', '2018-11-02 00:31:27', '60.53.33.62'),
	(144, 's5ev42g0ucu9f6q1pv5srjnar1', 1, 1, '2018-11-04 18:57:22', '2018-11-04 18:57:22', '60.53.33.62'),
	(145, 'hvj57c6oss7lub7oht59bc2du5', 1, 1, '2018-11-04 18:58:09', '2018-11-04 19:02:16', '60.53.33.62'),
	(146, 'lbt10kjf776s298efnogmh2l83', 1, 1, '2018-11-04 21:08:13', '2018-11-04 21:17:00', '60.53.33.62'),
	(147, 'fl1jp0aipea4vuru2o51344bp7', 2, 1, '2018-11-05 01:23:16', '2018-11-05 01:26:09', '111.65.57.206'),
	(148, '6a386jtqqg2v6qf5rrfmqeiq92', 1, 1, '2018-11-05 01:53:54', '2018-11-05 02:40:26', '1.53.164.1'),
	(149, '4puioaf194dv4rb931kj1p8tq3', 1, 1, '2018-11-05 02:42:53', '2018-11-05 03:51:11', '60.53.33.62'),
	(150, '5vjeh6cr91nnh2abk7mtb0pnn0', 1, 1, '2018-11-06 01:07:51', '2018-11-06 01:23:06', '124.82.22.73'),
	(151, 'bi11q6hr0nbfq5cefjvf9qvu30', 1, 1, '2018-11-06 01:43:13', '2018-11-06 01:43:57', '1.53.164.1'),
	(152, '1i8t59r10qjair97phj0fv5ka5', 1, 1, '2018-11-06 01:51:21', '2018-11-06 01:51:21', '1.53.164.1'),
	(153, 'ic6nlrlcokso1epc71c5al4hh0', 1, 1, '2018-11-06 01:55:49', '2018-11-06 01:56:31', '1.53.164.1'),
	(154, 'fj514mdnpgnjp3hqo9jt38kkq1', 1, 1, '2018-11-06 01:59:38', '2018-11-06 02:28:18', '124.82.22.73'),
	(155, '1tpcb48qtda7avbejs9v08rrg4', 1, 1, '2018-11-06 02:15:26', '2018-11-06 02:15:26', '1.53.164.1'),
	(156, 'ipeava85orp6om21ctqaumn445', 1, 1, '2018-11-06 02:19:36', '2018-11-06 02:24:50', '1.53.164.1'),
	(157, '4ks6pgaeqe7r28ligd5754gcq1', 1, 1, '2018-11-06 02:26:52', '2018-11-06 02:27:58', '1.53.164.1'),
	(158, '5cahib6c1rqfbbaencph60sns7', 1, 1, '2018-11-06 02:32:49', '2018-11-06 03:33:13', '124.82.22.73'),
	(159, 'lm00ltf9u9qn2iifnlvsh7hdp7', 1, 1, '2018-11-06 02:38:23', '2018-11-06 02:39:19', '1.53.164.1'),
	(160, 'm9g0jd8j917l70r64q4r8qsip7', 1, 1, '2018-11-06 19:50:26', '2018-11-06 19:54:42', '1.53.164.1'),
	(161, 'uqcv53n23om9l8r41k9u00jpv4', 1, 1, '2018-11-06 20:09:24', '2018-11-06 20:11:24', '1.53.164.1'),
	(162, 't1aau7705ggtc5af8lq7acejo5', 1, 1, '2018-11-06 20:56:13', '2018-11-06 23:03:48', '60.53.33.62'),
	(163, 'efnagaa6aege86jpjug9c2qni1', 1, 1, '2018-11-07 00:20:41', '2018-11-07 01:21:30', '60.53.33.62'),
	(164, 'hojor1oclggfbl4pjkju1okni0', 1, 1, '2018-11-07 03:54:39', '2018-11-07 04:14:38', '60.53.33.62'),
	(165, '4kobi6hl1t13nn47uqp2of9hq7', 1, 1, '2018-11-08 02:43:12', '2018-11-08 02:47:58', '124.82.16.117'),
	(166, 'co2nld9jl1mfe1c7dnilvu7hs3', 3, 1, '2018-11-08 18:41:49', '2018-11-08 18:47:11', '119.75.5.174'),
	(167, 'h6nq963cl5qh9tune441b5rgj7', 1, 1, '2018-11-11 20:42:48', '2018-11-11 21:55:16', '60.53.33.62'),
	(168, 'hr9elkoeqh23469cj82pc7u375', 1, 1, '2018-11-11 22:44:53', '2018-11-11 22:48:40', '60.53.33.62'),
	(169, 'm59voa9sdbqvu98k7vf1f34on2', 1, 1, '2018-11-12 00:37:40', '2018-11-12 03:29:04', '60.53.33.62'),
	(170, 'kt767u6cp5e5eccfvjlv0mrca0', 2, 1, '2018-11-12 10:50:58', '2018-11-12 10:50:58', '115.164.87.235'),
	(171, '89nqub7dcu2ni31iir5b05q6b3', 2, 1, '2018-11-12 20:41:16', '2018-11-12 20:59:36', '1.9.152.106'),
	(172, 'nn8a464qak8fnirpflue9jv7l1', 2, 1, '2018-11-13 08:18:46', '2018-11-13 09:00:53', '111.65.56.77'),
	(173, 'r3pleb09he2kd6nl466h0nkua2', 2, 1, '2018-11-13 09:40:59', '2018-11-13 09:40:59', '111.65.56.77'),
	(174, '58kovnd1nmhl9s08bs4rkghje3', 1, 1, '2018-11-13 21:30:42', '2018-11-13 23:06:58', '60.53.33.62'),
	(175, 'g85kltf80m899c6h2ij9k90j57', 1, 1, '2018-11-14 00:12:47', '2018-11-14 00:12:47', '60.53.33.62'),
	(176, 'pu7am8re79g8hekb1hfnl490g0', 1, 1, '2018-11-14 03:18:42', '2018-11-14 05:38:13', '60.53.33.62'),
	(177, '0lonj9ben32vet3gih932n1s43', 1, 1, '2018-11-15 20:51:15', '2018-11-15 23:22:11', '60.53.33.62'),
	(178, '0hhgu0sg6lqr4mc3qq9uf3gn03', 1, 1, '2018-11-22 21:50:52', '2018-11-22 22:47:20', '60.53.35.204'),
	(179, '4a31japu2kfd4ru7u12prc2us3', 1, 1, '2018-11-22 23:45:32', '2018-11-22 23:45:32', '60.53.35.204'),
	(180, 'gb7ps3cg6k9s49nfouvotm8te0', 1, 1, '2018-11-23 21:58:59', '2018-11-24 00:01:04', '60.53.35.204'),
	(181, 'l83c888smq7c1js5c2ir690pt5', 1, 1, '2018-11-24 00:42:18', '2018-11-24 05:01:36', '60.53.35.204'),
	(182, 'm2tcobsakkgutm1lf5ia93dr30', 1, 1, '2018-11-25 21:58:15', '2018-11-25 21:58:15', '60.53.35.204'),
	(183, '9ahma4a4pl142pg1b4eik7mh03', 1, 1, '2018-11-26 00:11:15', '2018-11-26 00:34:23', '45.63.120.250'),
	(184, '2auu8dl0o9cueakop9nnuskdl7', 1, 1, '2018-11-26 01:01:03', '2018-11-26 01:04:50', '60.53.35.204'),
	(185, 'hpdkaisq98feced6gfq27cq6a4', 1, 1, '2018-11-26 01:24:05', '2018-11-26 01:27:30', '45.63.120.250'),
	(186, 'fq74ckjilhdk3gh91s49r2dhi3', 1, 1, '2018-11-26 01:29:19', '2018-11-26 01:47:51', '45.63.120.250'),
	(187, 'apk4fo9fs4j0k4j1vagot7skm7', 1, 1, '2018-11-26 02:27:04', '2018-11-26 02:52:14', '183.80.40.31'),
	(188, 's606qlojbctmd31hc54mcphuq0', 1, 1, '2018-11-26 03:25:56', '2018-11-26 03:36:49', '60.53.35.204'),
	(189, 'gfsmif6jc47ssug95jaumj0fu3', 1, 1, '2018-11-26 20:07:29', '2018-11-26 20:21:59', '45.63.120.250'),
	(190, 'q9jmdf9pfi3o14bo7k8rkvf725', 1, 1, '2018-11-26 21:00:21', '2018-11-26 21:40:00', '60.53.35.204'),
	(191, 'n57l5v71v0v3v0i773j1rhojh7', 1, 1, '2018-11-27 02:30:45', '2018-11-27 02:30:45', '60.53.35.204'),
	(192, '3t5q59uu3nt3nkqv5tujc6e8k1', 1, 1, '2018-11-27 03:28:27', '2018-11-27 05:02:25', '60.53.35.204'),
	(193, 'l1m8gliigub033gvqrn1km44e0', 4, 1, '2018-11-27 09:35:07', '2018-11-27 09:37:44', '210.187.218.207'),
	(194, 'q2vf1427v1if8h6aaokie1neu1', 4, 1, '2018-11-27 16:08:05', '2018-11-27 16:10:10', '210.187.218.207'),
	(195, 'vuau37k6liirm9dp5nv1dnb4i1', 1, 1, '2018-11-27 23:40:46', '2018-11-27 23:42:03', '60.53.35.204'),
	(196, '06u5pme0jrpavus0koqf2q4at1', 1, 1, '2018-11-28 01:35:17', '2018-11-28 01:42:47', '60.53.35.204'),
	(197, 'dah5cu1mjvc9gmhhq3tf6n1824', 1, 1, '2018-11-28 22:24:11', '2018-11-29 02:48:01', '60.53.35.204'),
	(198, 'k5lot679udc5vvpktk45unog44', 1, 1, '2018-11-29 00:17:09', '2018-11-29 00:37:23', '183.80.40.31'),
	(199, 'ici34km1aj9q5ht55npicp7ce2', 1, 1, '2018-11-29 00:38:58', '2018-11-29 00:50:10', '183.80.40.31'),
	(200, 'fc9pm8huih7oc5feknvmn5cn83', 1, 1, '2018-11-29 21:17:57', '2018-11-29 22:04:21', '60.53.35.204'),
	(201, 'hv38oa5p79ch109qolh2eocd93', 1, 1, '2018-11-29 23:12:20', '2018-11-29 23:25:13', '60.53.35.204'),
	(202, 'nk3art7lcfg08fhdskmfoojch7', 1, 1, '2018-11-30 02:06:34', '2018-11-30 02:52:49', '60.53.35.204'),
	(203, 'vqegke48f7bhh81o3j755o5pp7', 1, 1, '2018-11-30 03:13:45', '2018-11-30 03:15:16', '183.80.40.31'),
	(204, '8ik2qp9g0r1pfid0os530upgp7', 1, 1, '2018-11-30 03:17:06', '2018-11-30 03:22:41', '183.80.40.31'),
	(205, 'db27sfmnl90slcq0nrlttgrdq1', 1, 1, '2018-11-30 03:23:56', '2018-11-30 03:24:51', '183.80.40.31'),
	(206, 'rn7uvcqccd011fq41h2oi4ud34', 4, 1, '2018-12-01 17:02:16', '2018-12-01 17:02:16', '115.164.210.140'),
	(207, 'cjitoqhdp2kcagmnbrp8nj2k35', 4, 1, '2018-12-01 17:40:23', '2018-12-01 18:49:45', '115.164.210.140'),
	(208, 'oemrunpas75haj0mleltifikl0', 4, 1, '2018-12-01 19:12:57', '2018-12-01 19:28:06', '115.164.210.140'),
	(209, 'jddd6nquh8ut56vqvb6slcg9j1', 1, 1, '2018-12-01 21:18:48', '2018-12-01 21:49:09', '175.136.106.181'),
	(210, 'fu8n6fvlhtlisbiar39pe1f7t4', 4, 1, '2018-12-02 03:28:42', '2018-12-02 03:34:12', '115.164.202.229'),
	(211, 'rucm07ags8vemargbieo17fj72', 4, 1, '2018-12-02 04:35:02', '2018-12-02 04:52:34', '115.164.202.229'),
	(212, 'k4ea9998616vjot2c4bati0fd2', 4, 1, '2018-12-02 07:50:19', '2018-12-02 07:56:37', '123.136.106.39'),
	(213, 'apjj642jlqqkfl42n3o4o476t5', 4, 1, '2018-12-02 08:00:32', '2018-12-02 08:21:25', '123.136.106.39'),
	(214, 'b25345uemnonc7c2jmhuks8j50', 4, 1, '2018-12-02 08:25:16', '2018-12-02 08:57:23', '123.136.106.39'),
	(215, 'ltdjp8porbc8qqdr03pntf71l7', 1, 1, '2018-12-02 08:32:17', '2018-12-02 09:31:26', '175.136.106.181'),
	(216, '28p8iisjogeni3tkr7ffir5k23', 4, 1, '2018-12-02 09:00:34', '2018-12-02 09:00:34', '115.164.202.229'),
	(217, 'sn7dg8q9pg84p3bitu0ng9bjk3', 4, 1, '2018-12-02 09:02:46', '2018-12-02 09:04:11', '115.164.202.229'),
	(218, 'p6vck8gn4hkhrhdc8j5ev62up3', 1, 1, '2018-12-02 20:02:15', '2018-12-02 20:14:13', '60.53.35.204'),
	(219, 'ugr7norlj2p2u44bjfdjpiq756', 3, 1, '2018-12-02 20:23:54', '2018-12-02 21:32:51', '119.75.5.174'),
	(220, 'ujp53ah0meq1cms4qlbb2kq5u0', 2, 1, '2018-12-02 20:50:50', '2018-12-02 20:54:00', '115.42.211.146'),
	(221, 'hqm694i6jsvlpm0fckqq9olg52', 2, 1, '2018-12-03 01:26:54', '2018-12-03 02:19:04', '115.42.211.146'),
	(222, 'deeqcusg1rfi5l2ncl7ktr4k46', 2, 0, '2018-12-03 02:09:15', '2018-12-03 02:20:14', '60.53.35.204'),
	(223, 'ft11l471entqgsh0q56isa0f96', 1, 1, '2018-12-03 02:20:28', '2018-12-03 04:57:20', '60.53.35.204'),
	(224, 'nlie6m9esnc14g5hpn9j90hiv2', 2, 1, '2018-12-03 03:05:52', '2018-12-03 03:34:24', '115.42.211.146'),
	(225, 'tanpoph86r31fi1lsbilm0pjs1', 2, 1, '2018-12-03 03:24:16', '2018-12-03 03:49:30', '115.42.211.146'),
	(226, 'rv2rtea754abs83paccavqfml6', 2, 1, '2018-12-03 04:25:48', '2018-12-03 04:27:47', '115.42.211.146'),
	(227, 'tja4cd53486j5uruhdj0daqab7', 1, 1, '2018-12-03 09:46:41', '2018-12-03 09:54:30', '175.136.106.181'),
	(228, 'oc0cc6aoq5dcgmbliaec6ac8j7', 1, 1, '2018-12-03 10:59:41', '2018-12-03 11:03:59', '175.136.106.181'),
	(229, 'f7umf15po24v09sbl2hob9d2h5', 2, 1, '2018-12-03 19:57:28', '2018-12-03 19:58:45', '115.42.211.146'),
	(230, '0ppbdmsv72th04s9l6miqnnen0', 1, 1, '2018-12-03 20:30:57', '2018-12-03 20:48:16', '175.136.106.181'),
	(231, '9ipj212vj8tdltb6hquf61a7g1', 2, 1, '2018-12-03 21:39:46', '2018-12-03 21:58:36', '115.42.211.146'),
	(232, 'p6qaof64sb0ug0vnfeem8lmke3', 2, 1, '2018-12-03 23:12:06', '2018-12-04 00:32:12', '115.42.211.146'),
	(233, 'hjpu18qt0qlubvfunvdt9mpmv2', 2, 1, '2018-12-03 23:46:24', '2018-12-04 00:59:52', '115.42.211.146'),
	(234, 'mejsh9pjj1pimahbb4s4h8o5q1', 2, 1, '2018-12-04 00:59:42', '2018-12-04 01:35:07', '115.42.211.146'),
	(235, 'qjq6jo6v1voaul5sh9d0qcv2n1', 2, 1, '2018-12-04 03:31:58', '2018-12-04 03:36:48', '115.42.211.146'),
	(236, '99dhpsm29cavgf5rktgcfp8ju6', 1, 1, '2018-12-04 04:57:00', '2018-12-04 04:58:30', '113.210.115.105'),
	(237, '0jefm6hq8vn5a53796fjf3ang2', 1, 1, '2018-12-04 04:59:55', '2018-12-04 05:00:58', '113.210.115.105'),
	(238, 'vpqbds832alhll1jvlgs0q1m26', 4, 1, '2018-12-04 06:04:48', '2018-12-04 06:10:16', '210.187.218.207'),
	(239, 'f7v0reo3hqieligpje8i8lqi61', 1, 1, '2018-12-04 07:58:39', '2018-12-04 07:59:21', '175.136.106.181'),
	(240, 'r1tcd24fosg3eo6ssiid9rrl56', 1, 1, '2018-12-04 08:01:54', '2018-12-04 08:01:54', '175.136.106.181'),
	(241, '0saq69urh28n3tbooh0m77ovr1', 4, 1, '2018-12-04 12:12:37', '2018-12-04 12:14:37', '210.187.218.207'),
	(242, '3c0jeefcl15rp2clqmbp67hug1', 1, 1, '2018-12-04 18:36:48', '2018-12-04 18:43:11', '175.136.106.181'),
	(243, '7ho6oos4nbttrm44oc8im68b63', 1, 1, '2018-12-04 18:45:27', '2018-12-04 18:54:18', '175.136.106.181'),
	(244, '5httl5lk0lau3kpkkr76dield3', 2, 1, '2018-12-04 21:01:41', '2018-12-04 21:04:01', '115.42.211.146'),
	(245, 'cnjossqrv0jr52huj0cm8uvg20', 2, 1, '2018-12-05 01:06:46', '2018-12-05 01:11:34', '115.42.211.146'),
	(246, 'v8gdf45ma9o3t5n979blhbujc2', 1, 1, '2018-12-05 01:30:35', '2018-12-05 02:34:10', '60.53.35.204'),
	(247, 'iehtdom46bea86idf73dliqvg0', 1, 1, '2018-12-05 03:10:23', '2018-12-05 04:43:39', '60.53.35.204'),
	(248, 'nc4cq79q0e8ese96rtvjkf6tq5', 1, 1, '2018-12-05 06:49:43', '2018-12-05 07:37:39', '175.136.106.181'),
	(249, 'd7isuu5g9d7ucb5pnbnos0a0o6', 1, 1, '2018-12-05 07:47:57', '2018-12-05 08:00:35', '175.136.106.181'),
	(250, 'uahaj8gjdtecvoql41n51rb4c0', 1, 1, '2018-12-05 08:11:38', '2018-12-05 08:18:58', '175.136.106.181'),
	(251, 'dpqd0ehfod2t2369p2anrflt96', 1, 1, '2018-12-05 08:21:18', '2018-12-05 09:11:34', '175.136.106.181'),
	(252, 'kcqek2vsnn2i8srife3oesrsf6', 1, 1, '2018-12-05 17:51:54', '2018-12-05 17:55:17', '175.136.106.181'),
	(253, 'srhgk15e4csho00dom0e78beg5', 1, 1, '2018-12-05 19:42:05', '2018-12-05 20:44:56', '60.53.35.204'),
	(254, '12259dlcmcndn8cqa6bj77jf06', 2, 1, '2018-12-05 21:04:16', '2018-12-05 21:07:45', '115.42.211.146'),
	(255, 'kk2a855of6enll5kctcmroh301', 2, 1, '2018-12-06 00:21:07', '2018-12-06 00:22:27', '115.42.211.146'),
	(256, 'cia58bj154q9fdvv1e28e3a197', 4, 1, '2018-12-06 00:23:16', '2018-12-06 00:23:16', '60.54.34.25'),
	(257, '84kgodvebcb0ldnsg9stfqvj04', 4, 1, '2018-12-06 00:25:35', '2018-12-06 00:47:42', '60.54.34.25'),
	(258, 'iutiea4o1sl3m4ibugholj4ib3', 1, 1, '2018-12-06 00:31:33', '2018-12-06 00:47:42', '60.53.35.204'),
	(259, '5uc1l2dmnjv5moppbk9p67i4e5', 1, 1, '2018-12-06 00:50:23', '2018-12-06 01:23:31', '60.53.35.204'),
	(260, 'p0uh215ggt0lp059knrj8ecab7', 4, 1, '2018-12-06 00:58:36', '2018-12-06 00:59:32', '60.54.34.25'),
	(261, 'bnseuv1nqfl41vdh9julm0fth2', 1, 1, '2018-12-06 01:25:57', '2018-12-06 01:35:36', '60.53.35.204'),
	(262, 'u569ea1hh40defssm3d6lpevh2', 1, 1, '2018-12-06 02:08:28', '2018-12-06 02:45:28', '60.53.35.204'),
	(263, 'gek599u8blms25ijtpa9mnvbs5', 1, 1, '2018-12-06 06:02:06', '2018-12-06 08:16:20', '175.136.106.181'),
	(264, 'u01gve6ejm1oeiuj4jo2n02ia2', 1, 1, '2018-12-06 08:20:24', '2018-12-06 09:23:05', '175.136.106.181'),
	(265, 'luu57q79ggi9dguo4cjh1avjc6', 4, 1, '2018-12-06 18:00:56', '2018-12-06 18:29:37', '60.54.34.25'),
	(266, 'p7iqsii8mb15rheb6mhaeua9g3', 1, 1, '2018-12-06 20:33:46', '2018-12-06 21:45:39', '60.53.35.204'),
	(267, 'cg45theoj8kqb60tp6nvuod044', 3, 1, '2018-12-06 20:39:18', '2018-12-06 20:39:18', '119.75.5.174'),
	(268, 'ru7663gscqjuhieqse8i4qju22', 1, 1, '2018-12-06 23:13:25', '2018-12-07 00:01:06', '123.16.32.226'),
	(269, 'mnl59lmrk2nma9cjj77tgjo333', 1, 1, '2018-12-06 23:14:18', '2018-12-06 23:14:18', '60.53.35.204'),
	(270, 'p4ft5d2r66gac4afc5oqv47kv7', 1, 1, '2018-12-07 00:19:35', '2018-12-07 00:29:48', '60.53.35.204'),
	(271, 'q79rrl7s9n77dpigtptppkut95', 1, 1, '2018-12-07 00:31:17', '2018-12-07 02:08:56', '123.16.32.226'),
	(272, '8e2fnpje48n1amahm3b6qp84j7', 1, 1, '2018-12-07 01:08:14', '2018-12-07 01:08:14', '60.53.35.204'),
	(273, 'eimtbsd0lqi4riij9m5u0rg0d3', 1, 1, '2018-12-08 02:20:55', '2018-12-08 03:06:00', '113.210.202.122'),
	(274, 'ja8pdh5l3cr5t8o5v79gk8cif4', 4, 1, '2018-12-09 03:47:57', '2018-12-09 04:00:52', '115.164.180.123'),
	(275, '1cspec9baej6k770ojn6hs4fq4', 4, 1, '2018-12-09 15:55:38', '2018-12-09 16:24:44', '210.187.218.207'),
	(276, 'bse4sgjc9sluec0ntm2b0jpmg1', 1, 1, '2018-12-09 23:49:37', '2018-12-10 04:13:50', '123.16.32.226'),
	(277, 'ntgfe7kntmnrojjfblp796hup4', 1, 1, '2018-12-10 08:06:55', '2018-12-10 10:13:19', '175.142.130.195'),
	(278, 'if7vjh15fm221p1nvctj3ev1u5', 1, 1, '2018-12-11 05:28:19', '2018-12-11 06:14:10', '118.69.93.132'),
	(279, 'aj8md892th97rcii9vq38fmgr4', 1, 1, '2018-12-11 21:00:06', '2018-12-11 22:34:59', '60.53.35.204'),
	(280, 'at4mrsuien0kkke2lcia0hti71', 1, 1, '2018-12-12 03:35:19', '2018-12-12 03:35:19', '123.16.32.226'),
	(281, 'ea8349ed19d45l0b05ki1dka60', 1, 1, '2018-12-12 03:40:41', '2018-12-12 04:53:15', '123.16.32.226'),
	(282, 'tgdndktaugt2fautaashoc9hm3', 1, 1, '2018-12-12 07:02:41', '2018-12-12 07:07:36', '42.118.76.60'),
	(283, 'n9a3u130v57c0u90355hg6q6b4', 1, 1, '2018-12-12 20:55:40', '2018-12-12 20:55:40', '123.16.32.226'),
	(284, 'b124r1f01uvs22lk37llvib1d2', 1, 1, '2018-12-12 20:58:37', '2018-12-12 20:58:37', '123.16.32.226'),
	(285, 'g06p6rvibk55a4j7e6mpbheus5', 1, 1, '2018-12-12 22:31:35', '2018-12-12 22:35:09', '60.53.35.204'),
	(286, '7dkb8k5ct5jobi4da8m4utcv96', 1, 1, '2018-12-13 01:51:32', '2018-12-13 02:33:17', '123.16.32.226'),
	(287, '0qdi550omgdufuv5b1iorj9rq6', 1, 1, '2018-12-13 03:40:37', '2018-12-13 04:30:24', '60.53.35.204'),
	(288, 'lbgpikeqenusjvdbg2mg3a2005', 1, 1, '2018-12-13 21:10:03', '2018-12-13 21:52:36', '60.53.35.204'),
	(289, 'kjpqfvhj7ia9ml5k8b2j837q43', 1, 1, '2018-12-13 22:51:59', '2018-12-13 22:53:47', '60.53.35.204'),
	(290, 'ii5n8rkll3gqnqaotthp878co7', 1, 1, '2018-12-14 00:38:40', '2018-12-14 00:39:33', '123.16.32.226'),
	(291, 'ou8s6r3fn885s0ppvidmk1jpe6', 1, 1, '2018-12-15 22:33:17', '2018-12-15 22:34:05', '118.69.93.129'),
	(292, '6if3jefef7qdv4a14as7htt503', 1, 1, '2018-12-16 09:58:28', '2018-12-16 10:08:23', '175.142.130.195'),
	(293, '6b7opjs4gi0u2o1s7ikr8pbbv2', 1, 1, '2018-12-16 18:12:05', '2018-12-16 18:22:21', '123.16.32.226'),
	(294, 'd1bktlfm4rj8c3srn7d3q21pn3', 1, 1, '2018-12-18 06:09:23', '2018-12-18 06:16:37', '175.142.130.195'),
	(295, '9h40d4bvkelhqq6u8kr2mdldf1', 1, 1, '2019-01-03 01:34:09', '2019-01-03 01:34:51', '60.53.35.204'),
	(296, 'sveugur62dbvds2rvm42m9sa90', 1, 1, '2019-01-03 02:21:11', '2019-01-03 02:55:42', '60.53.35.204'),
	(297, 'n8282gc21070jf2b4bp2tr3lf4', 1, 1, '2019-01-03 22:46:16', '2019-01-03 23:58:33', '60.53.35.204'),
	(298, 'gahpsm9ip5a98o8444ho1krtg2', 1, 1, '2019-01-04 00:01:32', '2019-01-04 00:21:40', '60.53.35.204'),
	(299, 'ndjcb4nmob61hd8qe51cuf1br3', 1, 1, '2019-01-04 00:29:36', '2019-01-04 00:53:03', '60.53.35.204'),
	(300, '3hv0bk4v67fj6rto4fa9c446r3', 1, 1, '2019-01-07 21:51:58', '2019-01-07 21:56:50', '113.23.96.172'),
	(301, 'i8hvq90brrcjt575c61a6qcdl3', 1, 1, '2019-01-08 02:06:13', '2019-01-08 02:41:08', '183.80.83.134'),
	(302, 'gkodqhn2inju9l6vrk2tne8q90', 1, 1, '2019-01-08 02:43:43', '2019-01-08 02:49:14', '183.80.83.134'),
	(303, '3vk5v53pvmcqvmoiaj3sa2aga5', 1, 1, '2019-01-09 01:41:42', '2019-01-09 01:53:50', '113.23.96.172'),
	(304, 'vca51cg7qgvp5cfnmucfsbtk76', 1, 1, '2019-01-09 01:59:17', '2019-01-09 02:41:23', '113.23.96.172'),
	(305, '28bncnhsuhs711emrs33l9tf85', 1, 1, '2019-01-09 02:46:26', '2019-01-09 02:46:26', '113.23.96.172');
/*!40000 ALTER TABLE `admin_user_session` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_customer
CREATE TABLE IF NOT EXISTS `amazon_customer` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `customer_id` int(10) unsigned NOT NULL COMMENT 'Customer_id',
  `amazon_id` varchar(255) NOT NULL COMMENT 'Amazon_id',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `AMAZON_CUSTOMER_CUSTOMER_ID_AMAZON_ID` (`customer_id`,`amazon_id`),
  UNIQUE KEY `AMAZON_CUSTOMER_CUSTOMER_ID` (`customer_id`),
  CONSTRAINT `AMAZON_CUSTOMER_CUSTOMER_ID_CUSTOMER_ENTITY_ENTITY_ID` FOREIGN KEY (`customer_id`) REFERENCES `customer_entity` (`entity_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_customer';

-- Dumping data for table db_nfnew.amazon_customer: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_customer` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_customer` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_pending_authorization
CREATE TABLE IF NOT EXISTS `amazon_pending_authorization` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `order_id` int(10) unsigned NOT NULL COMMENT 'Order_id',
  `payment_id` int(10) unsigned NOT NULL COMMENT 'Payment_id',
  `authorization_id` varchar(255) DEFAULT NULL COMMENT 'Authorization_id',
  `created_at` datetime NOT NULL COMMENT 'Created_at',
  `updated_at` datetime DEFAULT NULL COMMENT 'Updated_at',
  `processed` smallint(5) unsigned DEFAULT '0' COMMENT 'Initial authorization processed',
  `capture` smallint(5) unsigned DEFAULT '0' COMMENT 'Initial authorization has capture',
  `capture_id` varchar(255) DEFAULT NULL COMMENT 'Initial authorization capture id',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `UNQ_E6CCA08713FB32BB136A56837009C371` (`order_id`,`payment_id`,`authorization_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_pending_authorization';

-- Dumping data for table db_nfnew.amazon_pending_authorization: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_pending_authorization` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_pending_authorization` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_pending_capture
CREATE TABLE IF NOT EXISTS `amazon_pending_capture` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `capture_id` varchar(255) NOT NULL COMMENT 'Capture_id',
  `created_at` datetime NOT NULL COMMENT 'Created_at',
  `order_id` int(10) unsigned NOT NULL COMMENT 'order id',
  `payment_id` int(10) unsigned NOT NULL COMMENT 'payment id',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `AMAZON_PENDING_CAPTURE_ORDER_ID_PAYMENT_ID_CAPTURE_ID` (`order_id`,`payment_id`,`capture_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_pending_capture';

-- Dumping data for table db_nfnew.amazon_pending_capture: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_pending_capture` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_pending_capture` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_pending_refund
CREATE TABLE IF NOT EXISTS `amazon_pending_refund` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `refund_id` varchar(255) NOT NULL COMMENT 'Refund_id',
  `created_at` datetime NOT NULL COMMENT 'Created_at',
  `order_id` int(10) unsigned NOT NULL COMMENT 'Order_id',
  `payment_id` int(10) unsigned NOT NULL COMMENT 'Payment_id',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `AMAZON_PENDING_REFUND_ORDER_ID_PAYMENT_ID_REFUND_ID` (`order_id`,`payment_id`,`refund_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_pending_refund';

-- Dumping data for table db_nfnew.amazon_pending_refund: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_pending_refund` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_pending_refund` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_quote
CREATE TABLE IF NOT EXISTS `amazon_quote` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `quote_id` int(10) unsigned NOT NULL COMMENT 'Quote_id',
  `amazon_order_reference_id` varchar(255) NOT NULL COMMENT 'Amazon_order_reference_id',
  `sandbox_simulation_reference` varchar(255) DEFAULT NULL COMMENT 'Sandbox simulation reference',
  `confirmed` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Quote confirmed with Amazon',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `AMAZON_QUOTE_QUOTE_ID` (`quote_id`),
  CONSTRAINT `AMAZON_QUOTE_QUOTE_ID_QUOTE_ENTITY_ID` FOREIGN KEY (`quote_id`) REFERENCES `quote` (`entity_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_quote';

-- Dumping data for table db_nfnew.amazon_quote: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_quote` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_quote` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.amazon_sales_order
CREATE TABLE IF NOT EXISTS `amazon_sales_order` (
  `entity_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Entity_id',
  `order_id` int(10) unsigned NOT NULL COMMENT 'Order_id',
  `amazon_order_reference_id` varchar(255) NOT NULL COMMENT 'Amazon_order_reference_id',
  PRIMARY KEY (`entity_id`),
  UNIQUE KEY `AMAZON_SALES_ORDER_ORDER_ID` (`order_id`),
  CONSTRAINT `AMAZON_SALES_ORDER_ORDER_ID_SALES_ORDER_ENTITY_ID` FOREIGN KEY (`order_id`) REFERENCES `sales_order` (`entity_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='amazon_sales_order';

-- Dumping data for table db_nfnew.amazon_sales_order: ~0 rows (approximately)
/*!40000 ALTER TABLE `amazon_sales_order` DISABLE KEYS */;
/*!40000 ALTER TABLE `amazon_sales_order` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.authorization_role
CREATE TABLE IF NOT EXISTS `authorization_role` (
  `role_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Role ID',
  `parent_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Parent Role ID',
  `tree_level` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Role Tree Level',
  `sort_order` smallint(5) unsigned NOT NULL DEFAULT '0' COMMENT 'Role Sort Order',
  `role_type` varchar(1) NOT NULL DEFAULT '0' COMMENT 'Role Type',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'User ID',
  `user_type` varchar(16) DEFAULT NULL COMMENT 'User Type',
  `role_name` varchar(50) DEFAULT NULL COMMENT 'Role Name',
  PRIMARY KEY (`role_id`),
  KEY `AUTHORIZATION_ROLE_PARENT_ID_SORT_ORDER` (`parent_id`,`sort_order`),
  KEY `AUTHORIZATION_ROLE_TREE_LEVEL` (`tree_level`)
) ENGINE=InnoDB AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COMMENT='Admin Role Table';

-- Dumping data for table db_nfnew.authorization_role: ~11 rows (approximately)
/*!40000 ALTER TABLE `authorization_role` DISABLE KEYS */;
INSERT INTO `authorization_role` (`role_id`, `parent_id`, `tree_level`, `sort_order`, `role_type`, `user_id`, `user_type`, `role_name`) VALUES
	(2, 0, 1, 1, 'G', 0, '2', 'Administrators'),
	(6, 0, 1, 0, 'U', 3, '1', '13'),
	(8, 0, 1, 0, 'U', 5, '1', '15'),
	(9, 0, 1, 0, 'U', 6, '1', '16'),
	(10, 0, 1, 0, 'U', 7, '1', '17'),
	(20, 2, 2, 0, 'U', 1, '2', 'admin'),
	(21, 2, 2, 0, 'U', 3, '2', 'Jon '),
	(22, 2, 2, 0, 'U', 2, '2', 'navision'),
	(23, 0, 1, 0, 'U', 16, '1', '116'),
	(24, 2, 2, 0, 'U', 4, '2', 'uzzaircode'),
	(39, 0, 1, 0, 'U', 31, '1', '131');
/*!40000 ALTER TABLE `authorization_role` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.authorization_rule
CREATE TABLE IF NOT EXISTS `authorization_rule` (
  `rule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Rule ID',
  `role_id` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Role ID',
  `resource_id` varchar(255) DEFAULT NULL COMMENT 'Resource ID',
  `privileges` varchar(20) DEFAULT NULL COMMENT 'Privileges',
  `permission` varchar(10) DEFAULT NULL COMMENT 'Permission',
  PRIMARY KEY (`rule_id`),
  KEY `AUTHORIZATION_RULE_RESOURCE_ID_ROLE_ID` (`resource_id`,`role_id`),
  KEY `AUTHORIZATION_RULE_ROLE_ID_RESOURCE_ID` (`role_id`,`resource_id`),
  CONSTRAINT `AUTHORIZATION_RULE_ROLE_ID_AUTHORIZATION_ROLE_ROLE_ID` FOREIGN KEY (`role_id`) REFERENCES `authorization_role` (`role_id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=22643 DEFAULT CHARSET=utf8 COMMENT='Admin Rule Table';

-- Dumping data for table db_nfnew.authorization_rule: ~312 rows (approximately)
/*!40000 ALTER TABLE `authorization_rule` DISABLE KEYS */;
INSERT INTO `authorization_rule` (`rule_id`, `role_id`, `resource_id`, `privileges`, `permission`) VALUES
	(1152, 2, 'Magento_Backend::all', NULL, 'allow'),
	(1153, 6, 'Magento_Backend::all', NULL, 'allow'),
	(1925, 8, 'Magento_Backend::all', NULL, 'allow'),
	(1926, 9, 'Magento_Backend::all', NULL, 'allow'),
	(8701, 23, 'Magento_Backend::all', NULL, 'allow'),
	(22336, 39, 'Magento_Backend::all', NULL, 'deny'),
	(22337, 39, 'Magento_Backend::admin', NULL, 'allow'),
	(22338, 39, 'Magento_Backend::dashboard', NULL, 'deny'),
	(22339, 39, 'Magento_Backend::brand_elements', NULL, 'deny'),
	(22340, 39, 'Ves_Brand::brand', NULL, 'deny'),
	(22341, 39, 'Ves_Brand::brand_edit', NULL, 'deny'),
	(22342, 39, 'Ves_Brand::brand_save', NULL, 'deny'),
	(22343, 39, 'Ves_Brand::brand_delete', NULL, 'deny'),
	(22344, 39, 'Ves_Brand::group', NULL, 'deny'),
	(22345, 39, 'Ves_Brand::group_edit', NULL, 'deny'),
	(22346, 39, 'Ves_Brand::group_save', NULL, 'deny'),
	(22347, 39, 'Ves_Brand::group_delete', NULL, 'deny'),
	(22348, 39, 'Ves_Brand::import', NULL, 'deny'),
	(22349, 39, 'Ves_Brand::import_products', NULL, 'deny'),
	(22350, 39, 'Ves_Brand::import_save', NULL, 'deny'),
	(22351, 39, 'Magento_Backend::ves_all_elements', NULL, 'deny'),
	(22352, 39, 'Ves_All::ves_all', NULL, 'deny'),
	(22353, 39, 'Swissup_Core::swissup', NULL, 'deny'),
	(22354, 39, 'Swissup_Core::services', NULL, 'deny'),
	(22355, 39, 'Swissup_Core::installer_index', NULL, 'deny'),
	(22356, 39, 'Swissup_Core::installer_form', NULL, 'deny'),
	(22357, 39, 'Swissup_Core::installer_install', NULL, 'deny'),
	(22358, 39, 'Swissup_Core::installer_upgrade', NULL, 'deny'),
	(22359, 39, 'Swissup_Core::general', NULL, 'deny'),
	(22360, 39, 'Swissup_Easytabs::easytabs', NULL, 'deny'),
	(22361, 39, 'Swissup_Easytabs::save', NULL, 'deny'),
	(22362, 39, 'Swissup_Easytabs::delete', NULL, 'deny'),
	(22363, 39, 'Swissup_Easytabs::status', NULL, 'deny'),
	(22364, 39, 'Codazon_Options::Codazon_Options', NULL, 'deny'),
	(22365, 39, 'Codazon_Options::themes_options', NULL, 'deny'),
	(22366, 39, 'Codazon_Options::themes_install', NULL, 'deny'),
	(22367, 39, 'Codazon_Options::extensions_options', NULL, 'deny'),
	(22368, 39, 'Codazon_Options::slideshow_title', NULL, 'deny'),
	(22369, 39, 'Codazon_Slideshow::slideshow', NULL, 'deny'),
	(22370, 39, 'Codazon_MegaMenu::megamenu', NULL, 'deny'),
	(22371, 39, 'Codazon_MegaMenu::index', NULL, 'deny'),
	(22372, 39, 'Codazon_MegaMenu::edit', NULL, 'deny'),
	(22373, 39, 'Codazon_MegaMenu::save', NULL, 'deny'),
	(22374, 39, 'Codazon_MegaMenu::delete', NULL, 'deny'),
	(22375, 39, 'Codazon_MegaMenu::settings', NULL, 'deny'),
	(22376, 39, 'Magento_Analytics::analytics', NULL, 'deny'),
	(22377, 39, 'Magento_Analytics::analytics_api', NULL, 'deny'),
	(22378, 39, 'Magento_Sales::sales', NULL, 'deny'),
	(22379, 39, 'Magento_Sales::sales_operation', NULL, 'deny'),
	(22380, 39, 'Magento_Sales::sales_order', NULL, 'deny'),
	(22381, 39, 'Magento_Sales::actions', NULL, 'deny'),
	(22382, 39, 'Magento_Sales::create', NULL, 'deny'),
	(22383, 39, 'Magento_Sales::actions_view', NULL, 'deny'),
	(22384, 39, 'Magento_Sales::email', NULL, 'deny'),
	(22385, 39, 'Magento_Sales::reorder', NULL, 'deny'),
	(22386, 39, 'Magento_Sales::actions_edit', NULL, 'deny'),
	(22387, 39, 'Magento_Sales::cancel', NULL, 'deny'),
	(22388, 39, 'Magento_Sales::review_payment', NULL, 'deny'),
	(22389, 39, 'Magento_Sales::capture', NULL, 'deny'),
	(22390, 39, 'Magento_Sales::invoice', NULL, 'deny'),
	(22391, 39, 'Magento_Sales::creditmemo', NULL, 'deny'),
	(22392, 39, 'Magento_Sales::hold', NULL, 'deny'),
	(22393, 39, 'Magento_Sales::unhold', NULL, 'deny'),
	(22394, 39, 'Magento_Sales::ship', NULL, 'deny'),
	(22395, 39, 'Magento_Sales::comment', NULL, 'deny'),
	(22396, 39, 'Magento_Sales::emails', NULL, 'deny'),
	(22397, 39, 'Magento_Paypal::authorization', NULL, 'deny'),
	(22398, 39, 'Magento_Sales::sales_invoice', NULL, 'deny'),
	(22399, 39, 'Magento_Sales::shipment', NULL, 'deny'),
	(22400, 39, 'Temando_Shipping::dispatches', NULL, 'deny'),
	(22401, 39, 'Magento_Sales::sales_creditmemo', NULL, 'deny'),
	(22402, 39, 'Magento_Paypal::billing_agreement', NULL, 'deny'),
	(22403, 39, 'Magento_Paypal::billing_agreement_actions', NULL, 'deny'),
	(22404, 39, 'Magento_Paypal::billing_agreement_actions_view', NULL, 'deny'),
	(22405, 39, 'Magento_Paypal::actions_manage', NULL, 'deny'),
	(22406, 39, 'Magento_Paypal::use', NULL, 'deny'),
	(22407, 39, 'Magento_Sales::transactions', NULL, 'deny'),
	(22408, 39, 'Magento_Sales::transactions_fetch', NULL, 'deny'),
	(22409, 39, 'Magento_Catalog::catalog', NULL, 'allow'),
	(22410, 39, 'Magento_Catalog::catalog_inventory', NULL, 'allow'),
	(22411, 39, 'Magento_Catalog::products', NULL, 'allow'),
	(22412, 39, 'Magento_Catalog::categories', NULL, 'deny'),
	(22413, 39, 'Magento_Cart::cart', NULL, 'deny'),
	(22414, 39, 'Magento_Cart::manage', NULL, 'deny'),
	(22415, 39, 'Magento_Customer::customer', NULL, 'deny'),
	(22416, 39, 'Magento_Customer::manage', NULL, 'deny'),
	(22417, 39, 'Magento_Customer::online', NULL, 'deny'),
	(22418, 39, 'Mageplaza_Core::menu', NULL, 'deny'),
	(22419, 39, 'Mageplaza_Smtp::smtp', NULL, 'deny'),
	(22420, 39, 'Mageplaza_Smtp::log', NULL, 'deny'),
	(22421, 39, 'Mageplaza_Core::documentation', NULL, 'deny'),
	(22422, 39, 'Mageplaza_Core::userguide', NULL, 'deny'),
	(22423, 39, 'Mageplaza_Core::activate', NULL, 'deny'),
	(22424, 39, 'Wagento_Zendesk::zendesk', NULL, 'deny'),
	(22425, 39, 'Wagento_Zendesk::zendesk_config', NULL, 'deny'),
	(22426, 39, 'Wagento_Zendesk::zendesk_ticket', NULL, 'deny'),
	(22427, 39, 'Wagento_Zendesk::zendesk_api', NULL, 'deny'),
	(22428, 39, 'Magento_Backend::marketing', NULL, 'deny'),
	(22429, 39, 'Magento_CatalogRule::promo', NULL, 'deny'),
	(22430, 39, 'Magento_CatalogRule::promo_catalog', NULL, 'deny'),
	(22431, 39, 'Magento_SalesRule::quote', NULL, 'deny'),
	(22432, 39, 'Dotdigitalgroup_Email::automation', NULL, 'deny'),
	(22433, 39, 'Dotdigitalgroup_Email::automation_studio', NULL, 'deny'),
	(22434, 39, 'Dotdigitalgroup_Email::exclusion_rules', NULL, 'deny'),
	(22435, 39, 'Magento_Backend::marketing_communications', NULL, 'deny'),
	(22436, 39, 'Magento_Email::template', NULL, 'deny'),
	(22437, 39, 'Magento_Newsletter::template', NULL, 'deny'),
	(22438, 39, 'Magento_Newsletter::queue', NULL, 'deny'),
	(22439, 39, 'Magento_Newsletter::subscriber', NULL, 'deny'),
	(22440, 39, 'Magento_Backend::marketing_seo', NULL, 'deny'),
	(22441, 39, 'Magento_Search::search', NULL, 'deny'),
	(22442, 39, 'Magento_UrlRewrite::urlrewrite', NULL, 'deny'),
	(22443, 39, 'Magento_Search::synonyms', NULL, 'deny'),
	(22444, 39, 'Magento_Sitemap::sitemap', NULL, 'deny'),
	(22445, 39, 'Mageplaza_RewardPoints::reward_points', NULL, 'deny'),
	(22446, 39, 'Mageplaza_RewardPoints::earning_rate', NULL, 'deny'),
	(22447, 39, 'Mageplaza_RewardPoints::spending_rate', NULL, 'deny'),
	(22448, 39, 'Mageplaza_RewardPoints::transaction', NULL, 'deny'),
	(22449, 39, 'Magento_Backend::marketing_user_content', NULL, 'deny'),
	(22450, 39, 'Magento_Review::reviews_all', NULL, 'deny'),
	(22451, 39, 'Magento_Review::pending', NULL, 'deny'),
	(22452, 39, 'Magento_Backend::myaccount', NULL, 'deny'),
	(22453, 39, 'Magento_Backend::content', NULL, 'deny'),
	(22454, 39, 'Magento_Backend::content_elements', NULL, 'deny'),
	(22455, 39, 'Magento_Cms::page', NULL, 'deny'),
	(22456, 39, 'Magento_Cms::save', NULL, 'deny'),
	(22457, 39, 'Magento_Cms::page_delete', NULL, 'deny'),
	(22458, 39, 'Magento_Cms::block', NULL, 'deny'),
	(22459, 39, 'Magento_Widget::widget_instance', NULL, 'deny'),
	(22460, 39, 'Magento_Cms::media_gallery', NULL, 'deny'),
	(22461, 39, 'Magento_Backend::elements', NULL, 'deny'),
	(22462, 39, 'Codazon_Slideshow::slideshow2', NULL, 'deny'),
	(22463, 39, 'Magefan_Blog::elements', NULL, 'deny'),
	(22464, 39, 'Magefan_Blog::post', NULL, 'deny'),
	(22465, 39, 'Magefan_Blog::category', NULL, 'deny'),
	(22466, 39, 'Magefan_Blog::tag', NULL, 'deny'),
	(22467, 39, 'Magefan_Blog::comment', NULL, 'deny'),
	(22468, 39, 'Magefan_Blog::import', NULL, 'deny'),
	(22469, 39, 'Codazon_ProductLabel::productlabel_content', NULL, 'deny'),
	(22470, 39, 'Codazon_ProductLabel::productlabel', NULL, 'deny'),
	(22471, 39, 'Codazon_ProductLabel::save', NULL, 'deny'),
	(22472, 39, 'Codazon_ProductLabel::delete', NULL, 'deny'),
	(22473, 39, 'Magento_Backend::design', NULL, 'deny'),
	(22474, 39, 'Magento_Theme::theme', NULL, 'deny'),
	(22475, 39, 'Magento_Backend::schedule', NULL, 'deny'),
	(22476, 39, 'Magento_Backend::content_translation', NULL, 'deny'),
	(22477, 39, 'Magento_Reports::report', NULL, 'deny'),
	(22478, 39, 'Dotdigitalgroup_Email::reports', NULL, 'deny'),
	(22479, 39, 'Dotdigitalgroup_Email::contact', NULL, 'deny'),
	(22480, 39, 'Dotdigitalgroup_Email::order', NULL, 'deny'),
	(22481, 39, 'Dotdigitalgroup_Email::review', NULL, 'deny'),
	(22482, 39, 'Dotdigitalgroup_Email::wishlist', NULL, 'deny'),
	(22483, 39, 'Dotdigitalgroup_Email::catalog', NULL, 'deny'),
	(22484, 39, 'Dotdigitalgroup_Email::importer', NULL, 'deny'),
	(22485, 39, 'Dotdigitalgroup_Email::campaign', NULL, 'deny'),
	(22486, 39, 'Dotdigitalgroup_Email::cron', NULL, 'deny'),
	(22487, 39, 'Dotdigitalgroup_Email::dashboard', NULL, 'deny'),
	(22488, 39, 'Dotdigitalgroup_Email::automation_enrollment', NULL, 'deny'),
	(22489, 39, 'Dotdigitalgroup_Email::logviewer', NULL, 'deny'),
	(22490, 39, 'Magento_Reports::report_marketing', NULL, 'deny'),
	(22491, 39, 'Magento_Reports::shopcart', NULL, 'deny'),
	(22492, 39, 'Magento_Reports::product', NULL, 'deny'),
	(22493, 39, 'Magento_Reports::abandoned', NULL, 'deny'),
	(22494, 39, 'Magento_Reports::report_search', NULL, 'deny'),
	(22495, 39, 'Magento_Newsletter::problem', NULL, 'deny'),
	(22496, 39, 'Magento_Reports::review', NULL, 'deny'),
	(22497, 39, 'Magento_Reports::review_customer', NULL, 'deny'),
	(22498, 39, 'Magento_Reports::review_product', NULL, 'deny'),
	(22499, 39, 'Magento_Reports::salesroot', NULL, 'deny'),
	(22500, 39, 'Magento_Reports::salesroot_sales', NULL, 'deny'),
	(22501, 39, 'Magento_Reports::tax', NULL, 'deny'),
	(22502, 39, 'Magento_Reports::invoiced', NULL, 'deny'),
	(22503, 39, 'Magento_Reports::shipping', NULL, 'deny'),
	(22504, 39, 'Magento_Reports::refunded', NULL, 'deny'),
	(22505, 39, 'Magento_Reports::coupons', NULL, 'deny'),
	(22506, 39, 'Magento_Paypal::paypal_settlement_reports', NULL, 'deny'),
	(22507, 39, 'Magento_Paypal::paypal_settlement_reports_view', NULL, 'deny'),
	(22508, 39, 'Magento_Paypal::fetch', NULL, 'deny'),
	(22509, 39, 'Magento_Braintree::settlement_report', NULL, 'deny'),
	(22510, 39, 'Magento_Reports::customers', NULL, 'deny'),
	(22511, 39, 'Magento_Reports::totals', NULL, 'deny'),
	(22512, 39, 'Magento_Reports::customers_orders', NULL, 'deny'),
	(22513, 39, 'Magento_Reports::accounts', NULL, 'deny'),
	(22514, 39, 'Magento_Reports::report_products', NULL, 'deny'),
	(22515, 39, 'Magento_Reports::viewed', NULL, 'deny'),
	(22516, 39, 'Magento_Reports::bestsellers', NULL, 'deny'),
	(22517, 39, 'Magento_Reports::lowstock', NULL, 'deny'),
	(22518, 39, 'Magento_Reports::sold', NULL, 'deny'),
	(22519, 39, 'Magento_Reports::downloads', NULL, 'deny'),
	(22520, 39, 'Magento_Reports::statistics', NULL, 'deny'),
	(22521, 39, 'Magento_Reports::statistics_refresh', NULL, 'deny'),
	(22522, 39, 'Magento_Analytics::business_intelligence', NULL, 'deny'),
	(22523, 39, 'Magento_Analytics::advanced_reporting', NULL, 'deny'),
	(22524, 39, 'Magento_Analytics::bi_essentials', NULL, 'deny'),
	(22525, 39, 'Magento_Backend::stores', NULL, 'allow'),
	(22526, 39, 'Magento_Backend::stores_settings', NULL, 'allow'),
	(22527, 39, 'Magento_Backend::store', NULL, 'allow'),
	(22528, 39, 'Magento_Config::config', NULL, 'deny'),
	(22529, 39, 'BrainActs_Hub::config', NULL, 'deny'),
	(22530, 39, 'Magento_Payment::payment', NULL, 'deny'),
	(22531, 39, 'Ves_Brand::config_brand', NULL, 'deny'),
	(22532, 39, 'Ves_All::config', NULL, 'deny'),
	(22533, 39, 'Mageplaza_Smtp::configuration', NULL, 'deny'),
	(22534, 39, 'Dotdigitalgroup_Email::config', NULL, 'deny'),
	(22535, 39, 'Magento_Sales::fraud_protection', NULL, 'deny'),
	(22536, 39, 'Magento_GoogleAnalytics::google', NULL, 'deny'),
	(22537, 39, 'Magento_Newsletter::newsletter', NULL, 'deny'),
	(22538, 39, 'Magento_Contact::contact', NULL, 'deny'),
	(22539, 39, 'Magento_Downloadable::downloadable', NULL, 'deny'),
	(22540, 39, 'Magefan_Blog::config_blog', NULL, 'deny'),
	(22541, 39, 'Magento_Payment::payment_services', NULL, 'deny'),
	(22542, 39, 'Wagento_Zendesk::config_zendesk', NULL, 'deny'),
	(22543, 39, 'Magento_Catalog::config_catalog', NULL, 'deny'),
	(22544, 39, 'Magento_CatalogSearch::config_catalog_search', NULL, 'deny'),
	(22545, 39, 'Magento_CatalogInventory::cataloginventory', NULL, 'deny'),
	(22546, 39, 'Magento_Cms::config_cms', NULL, 'deny'),
	(22547, 39, 'Codazon_OneStepCheckout::config_codazon_onestepcheckout', NULL, 'deny'),
	(22548, 39, 'Magento_Shipping::config_shipping', NULL, 'deny'),
	(22549, 39, 'Magento_Shipping::carriers', NULL, 'deny'),
	(22550, 39, 'Magento_Shipping::shipping_policy', NULL, 'deny'),
	(22551, 39, 'Magento_Multishipping::config_multishipping', NULL, 'deny'),
	(22552, 39, 'Mageplaza_Core::configuration', NULL, 'deny'),
	(22553, 39, 'Mageplaza_Core::marketplace', NULL, 'deny'),
	(22554, 39, 'Magento_Config::config_general', NULL, 'deny'),
	(22555, 39, 'Magento_Config::web', NULL, 'deny'),
	(22556, 39, 'Magento_Config::config_design', NULL, 'deny'),
	(22557, 39, 'Magento_Paypal::paypal', NULL, 'deny'),
	(22558, 39, 'Mageplaza_RewardPoints::configuration', NULL, 'deny'),
	(22559, 39, 'Bss_DisableCompare::disable_compare', NULL, 'deny'),
	(22560, 39, 'Magento_Customer::config_customer', NULL, 'deny'),
	(22561, 39, 'Magento_Tax::config_tax', NULL, 'deny'),
	(22562, 39, 'Magento_Checkout::checkout', NULL, 'deny'),
	(22563, 39, 'Magento_Sales::config_sales', NULL, 'deny'),
	(22564, 39, 'Magento_Persistent::persistent', NULL, 'deny'),
	(22565, 39, 'Magento_Sales::sales_email', NULL, 'deny'),
	(22566, 39, 'Magento_Sales::sales_pdf', NULL, 'deny'),
	(22567, 39, 'Magento_Sitemap::config_sitemap', NULL, 'deny'),
	(22568, 39, 'Magento_Reports::reports', NULL, 'deny'),
	(22569, 39, 'MageWorx_SearchSuiteAutocomplete::config_searchsuiteautocomplete', NULL, 'deny'),
	(22570, 39, 'Magento_Config::config_system', NULL, 'deny'),
	(22571, 39, 'Magento_Wishlist::config_wishlist', NULL, 'deny'),
	(22572, 39, 'Magento_SalesRule::config_promo', NULL, 'deny'),
	(22573, 39, 'Magento_Config::advanced', NULL, 'deny'),
	(22574, 39, 'Magento_Config::config_admin', NULL, 'deny'),
	(22575, 39, 'Magento_Config::trans_email', NULL, 'deny'),
	(22576, 39, 'Magento_Config::dev', NULL, 'deny'),
	(22577, 39, 'Magento_Config::currency', NULL, 'deny'),
	(22578, 39, 'Magento_Rss::rss', NULL, 'deny'),
	(22579, 39, 'Magento_Config::sendfriend', NULL, 'deny'),
	(22580, 39, 'Magento_Analytics::analytics_settings', NULL, 'deny'),
	(22581, 39, 'Swissup_Core::swissup_config', NULL, 'deny'),
	(22582, 39, 'Swissup_Core::core_config', NULL, 'deny'),
	(22583, 39, 'Magento_NewRelicReporting::config_newrelicreporting', NULL, 'deny'),
	(22584, 39, 'Magento_CheckoutAgreements::checkoutagreement', NULL, 'deny'),
	(22585, 39, 'Magento_Sales::order_statuses', NULL, 'deny'),
	(22586, 39, 'Temando_Shipping::shipping', NULL, 'deny'),
	(22587, 39, 'Temando_Shipping::carriers', NULL, 'deny'),
	(22588, 39, 'Temando_Shipping::locations', NULL, 'deny'),
	(22589, 39, 'Temando_Shipping::packaging', NULL, 'deny'),
	(22590, 39, 'Magento_Tax::manage_tax', NULL, 'deny'),
	(22591, 39, 'Magento_CurrencySymbol::system_currency', NULL, 'deny'),
	(22592, 39, 'Magento_CurrencySymbol::currency_rates', NULL, 'deny'),
	(22593, 39, 'Magento_CurrencySymbol::symbols', NULL, 'deny'),
	(22594, 39, 'Magento_Backend::stores_attributes', NULL, 'deny'),
	(22595, 39, 'Magento_Catalog::attributes_attributes', NULL, 'deny'),
	(22596, 39, 'Magento_Catalog::update_attributes', NULL, 'deny'),
	(22597, 39, 'Magento_Catalog::sets', NULL, 'deny'),
	(22598, 39, 'Magento_Review::ratings', NULL, 'deny'),
	(22599, 39, 'Magento_Swatches::iframe', NULL, 'deny'),
	(22600, 39, 'Magento_Backend::stores_other_settings', NULL, 'deny'),
	(22601, 39, 'Magento_Customer::group', NULL, 'deny'),
	(22602, 39, 'Magento_Backend::system', NULL, 'deny'),
	(22603, 39, 'Magento_Backend::convert', NULL, 'deny'),
	(22604, 39, 'Magento_ImportExport::import', NULL, 'deny'),
	(22605, 39, 'Magento_ImportExport::export', NULL, 'deny'),
	(22606, 39, 'Magento_TaxImportExport::import_export', NULL, 'deny'),
	(22607, 39, 'Magento_ImportExport::history', NULL, 'deny'),
	(22608, 39, 'Magento_Backend::extensions', NULL, 'deny'),
	(22609, 39, 'Magento_Backend::local', NULL, 'deny'),
	(22610, 39, 'Magento_Backend::custom', NULL, 'deny'),
	(22611, 39, 'Magento_Integration::extensions', NULL, 'deny'),
	(22612, 39, 'Magento_Integration::integrations', NULL, 'deny'),
	(22613, 39, 'Magento_Backend::tools', NULL, 'deny'),
	(22614, 39, 'Magento_Backend::cache', NULL, 'deny'),
	(22615, 39, 'Magento_Backend::main_actions', NULL, 'deny'),
	(22616, 39, 'Magento_Backend::flush_cache_storage', NULL, 'deny'),
	(22617, 39, 'Magento_Backend::flush_magento_cache', NULL, 'deny'),
	(22618, 39, 'Magento_Backend::mass_actions', NULL, 'deny'),
	(22619, 39, 'Magento_Backend::toggling_cache_type', NULL, 'deny'),
	(22620, 39, 'Magento_Backend::refresh_cache_type', NULL, 'deny'),
	(22621, 39, 'Magento_Backend::additional_cache_management', NULL, 'deny'),
	(22622, 39, 'Magento_Backend::flush_catalog_images', NULL, 'deny'),
	(22623, 39, 'Magento_Backend::flush_js_css', NULL, 'deny'),
	(22624, 39, 'Magento_Backend::flush_static_files', NULL, 'deny'),
	(22625, 39, 'Magento_Backend::setup_wizard', NULL, 'deny'),
	(22626, 39, 'Magento_Indexer::index', NULL, 'deny'),
	(22627, 39, 'Magento_Backup::backup', NULL, 'deny'),
	(22628, 39, 'Magento_Backup::rollback', NULL, 'deny'),
	(22629, 39, 'Magento_Indexer::changeMode', NULL, 'deny'),
	(22630, 39, 'Magento_User::acl', NULL, 'deny'),
	(22631, 39, 'Magento_User::acl_users', NULL, 'deny'),
	(22632, 39, 'Magento_User::locks', NULL, 'deny'),
	(22633, 39, 'Magento_User::acl_roles', NULL, 'deny'),
	(22634, 39, 'Magento_Backend::system_other_settings', NULL, 'deny'),
	(22635, 39, 'Magento_AdminNotification::adminnotification', NULL, 'deny'),
	(22636, 39, 'Magento_AdminNotification::show_toolbar', NULL, 'deny'),
	(22637, 39, 'Magento_AdminNotification::show_list', NULL, 'deny'),
	(22638, 39, 'Magento_AdminNotification::mark_as_read', NULL, 'deny'),
	(22639, 39, 'Magento_AdminNotification::adminnotification_remove', NULL, 'deny'),
	(22640, 39, 'Magento_Variable::variable', NULL, 'deny'),
	(22641, 39, 'Magento_EncryptionKey::crypt_key', NULL, 'deny'),
	(22642, 39, 'Magento_Backend::global_search', NULL, 'deny');
/*!40000 ALTER TABLE `authorization_rule` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.brainacts_points_history
CREATE TABLE IF NOT EXISTS `brainacts_points_history` (
  `history_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'History_id',
  `customer_id` int(10) unsigned DEFAULT NULL COMMENT 'Customer_id',
  `customer_name` varchar(145) NOT NULL COMMENT 'Customer_name',
  `points` int(11) NOT NULL COMMENT 'Points',
  `rule_name` varchar(255) NOT NULL COMMENT 'Rule_name',
  `rule_earn_id` int(10) unsigned DEFAULT NULL COMMENT 'Rule_earn_id',
  `rule_spend_id` int(10) unsigned DEFAULT NULL COMMENT 'Rule_spend_id',
  `order_id` int(10) unsigned DEFAULT NULL COMMENT 'Order_id',
  `order_increment_id` varchar(50) DEFAULT NULL COMMENT 'Order_increment_id',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created_at',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated_at',
  `modifier_id` int(10) unsigned DEFAULT NULL COMMENT 'Modifier_id',
  `modifier_name` varchar(255) DEFAULT NULL COMMENT 'Modifier_name',
  `reason` text COMMENT 'Reason',
  `store_id` smallint(5) unsigned DEFAULT NULL COMMENT 'Store_id',
  `type_rule` smallint(6) NOT NULL COMMENT 'Type_rule',
  `is_deleted` smallint(6) DEFAULT '0' COMMENT 'Is_deleted',
  `is_expired` smallint(6) DEFAULT '0' COMMENT 'Is_expired',
  PRIMARY KEY (`history_id`),
  KEY `BRAINACTS_POINTS_HISTORY_CUSTOMER_ID` (`customer_id`),
  KEY `BRAINACTS_POINTS_HISTORY_STORE_ID` (`store_id`),
  KEY `BRAINACTS_POINTS_HISTORY_MODIFIER_ID` (`modifier_id`),
  CONSTRAINT `BRAINACTS_POINTS_HISTORY_CUSTOMER_ID_CUSTOMER_ENTITY_ENTITY_ID` FOREIGN KEY (`customer_id`) REFERENCES `customer_entity` (`entity_id`) ON DELETE CASCADE,
  CONSTRAINT `BRAINACTS_POINTS_HISTORY_MODIFIER_ID_ADMIN_USER_USER_ID` FOREIGN KEY (`modifier_id`) REFERENCES `admin_user` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `BRAINACTS_POINTS_HISTORY_STORE_ID_STORE_STORE_ID` FOREIGN KEY (`store_id`) REFERENCES `store` (`store_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='brainacts_points_history';

-- Dumping data for table db_nfnew.brainacts_points_history: ~0 rows (approximately)
/*!40000 ALTER TABLE `brainacts_points_history` DISABLE KEYS */;
/*!40000 ALTER TABLE `brainacts_points_history` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.brainacts_points_rule_earning
CREATE TABLE IF NOT EXISTS `brainacts_points_rule_earning` (
  `earning_rule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Earning_rule_id',
  `name` varchar(255) NOT NULL COMMENT 'Name',
  `description` text COMMENT 'Description',
  `from_date` date DEFAULT NULL COMMENT 'From_date',
  `to_date` date DEFAULT NULL COMMENT 'To_date',
  `is_active` smallint(6) NOT NULL COMMENT 'Is_active',
  `conditions_serialized` mediumtext COMMENT 'Conditions_serialized',
  `sort_order` int(11) DEFAULT NULL COMMENT 'Sort_order',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created_at',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated_at',
  `points` int(11) DEFAULT NULL COMMENT 'Points',
  `stop_rules_processing` smallint(6) DEFAULT '0' COMMENT 'Stop_rules_processing',
  `type` smallint(6) DEFAULT NULL COMMENT 'Type of Points rule',
  `spend` decimal(10,2) DEFAULT NULL COMMENT 'X Spend',
  `earn` int(11) DEFAULT NULL COMMENT 'Y Earn',
  PRIMARY KEY (`earning_rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='brainacts_points_rule_earning';

-- Dumping data for table db_nfnew.brainacts_points_rule_earning: ~0 rows (approximately)
/*!40000 ALTER TABLE `brainacts_points_rule_earning` DISABLE KEYS */;
/*!40000 ALTER TABLE `brainacts_points_rule_earning` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.brainacts_points_rule_earning_customer_group
CREATE TABLE IF NOT EXISTS `brainacts_points_rule_earning_customer_group` (
  `earning_rule_id` int(10) unsigned NOT NULL COMMENT 'Rule Id',
  `customer_group_id` int(10) unsigned NOT NULL COMMENT 'Customer Group Id',
  PRIMARY KEY (`earning_rule_id`,`customer_group_id`),
  KEY `BRAINACTS_POINTS_RULE_EARNING_CUSTOMER_GROUP_CUSTOMER_GROUP_ID` (`customer_group_id`),
  CONSTRAINT `FK_04C0EBB63740ED664CD3ECE572651E93` FOREIGN KEY (`customer_group_id`) REFERENCES `customer_group` (`customer_group_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_2354394C22F1E1CFB3744FEF86594ECC` FOREIGN KEY (`earning_rule_id`) REFERENCES `brainacts_points_rule_earning` (`earning_rule_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Rules To Customer Groups Relations';

-- Dumping data for table db_nfnew.brainacts_points_rule_earning_customer_group: ~0 rows (approximately)
/*!40000 ALTER TABLE `brainacts_points_rule_earning_customer_group` DISABLE KEYS */;
/*!40000 ALTER TABLE `brainacts_points_rule_earning_customer_group` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.brainacts_points_rule_earning_website
CREATE TABLE IF NOT EXISTS `brainacts_points_rule_earning_website` (
  `earning_rule_id` int(10) unsigned NOT NULL COMMENT 'Rule Id',
  `website_id` smallint(5) unsigned NOT NULL COMMENT 'Website Id',
  PRIMARY KEY (`earning_rule_id`,`website_id`),
  KEY `BRAINACTS_POINTS_RULE_EARNING_WEBSITE_WEBSITE_ID` (`website_id`),
  CONSTRAINT `BRAINACTS_POINTS_RULE_EARNING_WS_WS_ID_STORE_WS_WS_ID` FOREIGN KEY (`website_id`) REFERENCES `store_website` (`website_id`) ON DELETE CASCADE,
  CONSTRAINT `FK_6D9B52BFE20DEA42BE9E26AEEA907A2E` FOREIGN KEY (`earning_rule_id`) REFERENCES `brainacts_points_rule_earning` (`earning_rule_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='brainacts_points_rule_earning_website';

-- Dumping data for table db_nfnew.brainacts_points_rule_earning_website: ~0 rows (approximately)
/*!40000 ALTER TABLE `brainacts_points_rule_earning_website` DISABLE KEYS */;
/*!40000 ALTER TABLE `brainacts_points_rule_earning_website` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.brainacts_points_rule_spend
CREATE TABLE IF NOT EXISTS `brainacts_points_rule_spend` (
  `spend_rule_id` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Spend_rule_id',
  `name` varchar(255) NOT NULL COMMENT 'Name',
  `group_id` int(11) NOT NULL COMMENT 'Group_id',
  `store_id` int(11) NOT NULL COMMENT 'Store_id',
  `points` int(11) NOT NULL COMMENT 'Points',
  `amount` decimal(12,4) NOT NULL COMMENT 'Amount',
  `is_active` int(11) NOT NULL COMMENT 'Is_active',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Created_at',
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT 'Updated_at',
  PRIMARY KEY (`spend_rule_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='brainacts_points_rule_spend';

-- Dumping data for table db_nfnew.brainacts_points_rule_spend: ~0 rows (approximately)
/*!40000 ALTER TABLE `brainacts_points_rule_spend` DISABLE KEYS */;
/*!40000 ALTER TABLE `brainacts_points_rule_spend` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.cache
CREATE TABLE IF NOT EXISTS `cache` (
  `id` varchar(200) NOT NULL COMMENT 'Cache Id',
  `data` mediumblob COMMENT 'Cache Data',
  `create_time` int(11) DEFAULT NULL COMMENT 'Cache Creation Time',
  `update_time` int(11) DEFAULT NULL COMMENT 'Time of Cache Updating',
  `expire_time` int(11) DEFAULT NULL COMMENT 'Cache Expiration Time',
  PRIMARY KEY (`id`),
  KEY `CACHE_EXPIRE_TIME` (`expire_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Caches';

-- Dumping data for table db_nfnew.cache: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.cache_tag
CREATE TABLE IF NOT EXISTS `cache_tag` (
  `tag` varchar(100) NOT NULL COMMENT 'Tag',
  `cache_id` varchar(200) NOT NULL COMMENT 'Cache Id',
  PRIMARY KEY (`tag`,`cache_id`),
  KEY `CACHE_TAG_CACHE_ID` (`cache_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Tag Caches';

-- Dumping data for table db_nfnew.cache_tag: ~0 rows (approximately)
/*!40000 ALTER TABLE `cache_tag` DISABLE KEYS */;
/*!40000 ALTER TABLE `cache_tag` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.captcha_log
CREATE TABLE IF NOT EXISTS `captcha_log` (
  `type` varchar(32) NOT NULL COMMENT 'Type',
  `value` varchar(32) NOT NULL COMMENT 'Value',
  `count` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'Count',
  `updated_at` timestamp NULL DEFAULT NULL COMMENT 'Update Time',
  PRIMARY KEY (`type`,`value`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Count Login Attempts';

-- Dumping data for table db_nfnew.captcha_log: ~12 rows (approximately)
/*!40000 ALTER TABLE `captcha_log` DISABLE KEYS */;
INSERT INTO `captcha_log` (`type`, `value`, `count`, `updated_at`) VALUES
	('1', '122.11.173.23', 12, '2018-12-04 22:10:42'),
	('1', '123.16.32.226', 1, '2018-12-18 23:16:13'),
	('1', '210.187.218.207', 1, '2018-12-09 15:58:06'),
	('1', '42.118.76.61', 1, '2018-12-11 05:57:17'),
	('2', 'admn', 1, '2018-07-29 17:21:31'),
	('2', 'finance-buyer@naturesfarm.com', 1, '2018-08-13 02:48:06'),
	('2', 'helen@ardentit.com.sg', 6, '2019-01-04 00:52:15'),
	('2', 'helen@frisberry.com', 6, '2018-12-06 07:26:10'),
	('2', 'helen_cen@hotmail.com', 1, '2018-12-18 23:16:13'),
	('2', 'jack@icherrytech.com', 1, '2018-08-06 19:33:42'),
	('2', 'mptest@gmail.com', 1, '2018-12-11 05:29:51'),
	('2', 'uzzairwork@gmail.com', 2, '2018-08-08 16:20:30');
/*!40000 ALTER TABLE `captcha_log` ENABLE KEYS */;

-- Dumping structure for table db_nfnew.cataloginventory_stock
CREATE TABLE IF NOT EXISTS `cataloginventory_stock` (
  `stock_id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'Stock Id',
  `website_id` smallint(5) unsigned NOT NULL COMMENT 'Website Id',
  `stock_name` varchar(255) DEFAULT NULL COMMENT 'Stock Name',
  PRIMARY KEY (`stock_id`),
  KEY `CATALOGINVENTORY_STOCK_WEBSITE_ID` (`website_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='Cataloginventory Stock';

-- Dumping data for table db_nfnew.cataloginventory_stock: ~1 rows (approximately)
/*!40000 ALTER TABLE `cataloginventory_stock` DISABLE KEYS */;
INSERT INTO `cataloginventory_stock` (`stock_id`, `website_id`, `stock_name`) VALUES
	(1, 0, 'Default');
/*!40000 ALTER TABLE `cataloginventory_stock` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;

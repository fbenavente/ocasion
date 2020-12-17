ALTER TABLE `#__azurapagebuilder_pages` ADD `asset_id` INT(10) NOT NULL DEFAULT '0' AFTER `id`; 
ALTER TABLE `#__azurapagebuilder_pages` ADD `catid` INT(11) NOT NULL DEFAULT '0' AFTER `alias`; 
CREATE TABLE IF NOT EXISTS `#__azurapagebuilder_likes` (
  `pageID` int(11) NOT NULL,
  `like_count` int(10) unsigned NOT NULL DEFAULT '0',
  `likedUsers` mediumtext NOT NULL,
  `likedIPs` mediumtext NOT NULL,
  `option` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
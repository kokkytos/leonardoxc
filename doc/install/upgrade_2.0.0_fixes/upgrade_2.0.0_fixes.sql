
ALTER TABLE `leonardo_flights` ADD INDEX ( `takeoffID` ) ;
ALTER TABLE `leonardo_flights` ADD `grecord` SMALLINT NOT NULL , ADD `validated` SMALLINT NOT NULL ;
ALTER TABLE `leonardo_flights` CHANGE `grecord` `grecord` SMALLINT( 6 ) NOT NULL DEFAULT '0';
ALTER TABLE `leonardo_flights` CHANGE `validated` `validated` SMALLINT( 6 ) NOT NULL DEFAULT '0';



CREATE TABLE `leonardo_stats` (
  `tm` bigint(20) unsigned NOT NULL,
  `year` smallint(5) unsigned NOT NULL,
  `month` tinyint(3) unsigned NOT NULL,
  `day` tinyint(3) unsigned NOT NULL,
  `userID` bigint(20) unsigned NOT NULL,
  `sessionID` bigint(20) unsigned NOT NULL,
  `visitorID` bigint(20) unsigned NOT NULL,
  `op` char(25) NOT NULL default '',
  `flightID` bigint(20) unsigned NOT NULL,
  `executionTime` float unsigned NOT NULL,
  `os` char(20) NOT NULL default '',
  `browser` char(15) NOT NULL default '',
  `browser_version` char(10) NOT NULL default '',
  KEY `tm` (`tm`,`year`,`month`,`day`)
) ENGINE=MyISAM ;


ALTER TABLE `leonardo_flights` ADD `category` SMALLINT UNSIGNED NOT NULL DEFAULT '2' AFTER `subcat` ;
ALTER TABLE `leonardo_flights` ADD `validationMessage` TEXT NOT NULL AFTER `validated` ;




ALTER TABLE `leonardo_pilots` ADD `NACid` INT UNSIGNED NOT NULL DEFAULT '0' AFTER `countryCode` ,
ADD `NACmemberID` BIGINT UNSIGNED NOT NULL DEFAULT '0' AFTER `NACid` ;


# 2007/03/07

CREATE TABLE `leonardo_NAC_clubs` (
`NAC_ID` MEDIUMINT NOT NULL ,
`clubID` BIGINT NOT NULL ,
`clubName` VARCHAR( 255 ) NOT NULL ,
PRIMARY KEY ( `NAC_ID` , `clubID` )
) ENGINE = MYISAM ;


ALTER TABLE `leonardo_pilots` ADD `NACclubID` BIGINT NOT NULL AFTER `NACmemberID` ;

ALTER TABLE `leonardo_flights` ADD `NACclubID` BIGINT NOT NULL ;

ALTER TABLE `leonardo_pilots` CHANGE `sponsorID` `sponsor` VARCHAR( 255 ) NULL ;


# 2007/03/16

ALTER TABLE `leonardo_flights` ADD `autoScore` FLOAT NOT NULL DEFAULT '0' AFTER `FLIGHT_POINTS` ;


# 2007/04/06

CREATE TABLE `leonardo_airspace` (
`id` MEDIUMINT UNSIGNED NOT NULL AUTO_INCREMENT ,
`Name` VARCHAR( 50 ) NOT NULL ,
`Type` VARCHAR( 30 ) NOT NULL ,
`Shape` TINYINT UNSIGNED DEFAULT '0' NOT NULL ,
`Comments` VARCHAR( 255 ) NOT NULL ,
`minx` FLOAT NOT NULL ,
`miny` FLOAT NOT NULL ,
`maxx` FLOAT NOT NULL ,
`maxy` FLOAT NOT NULL ,
`Base` BLOB NOT NULL ,
`Top` BLOB NOT NULL ,
`Points` MEDIUMBLOB NOT NULL ,
`Radius` FLOAT NOT NULL ,
`Latitude` FLOAT NOT NULL ,
`Longitude` FLOAT NOT NULL ,
PRIMARY KEY ( `id` ) ,
INDEX ( `minx` , `miny` , `maxx` , `maxy` )
) TYPE = MYISAM ;

ALTER TABLE `leonardo_flights` ADD `airspaceCheck` TINYINT DEFAULT '0' NOT NULL AFTER `validationMessage` ,
ADD `airspaceCheckFinal` TINYINT DEFAULT '0' NOT NULL AFTER `airspaceCheck` ,
ADD `airspaceCheckMsg` TEXT NOT NULL AFTER `airspaceCheckFinal` ,
ADD `checkedBy` VARCHAR( 100 ) NOT NULL AFTER `airspaceCheckMsg` ;


ALTER TABLE `leonardo_airspace` CHANGE `Points` `Points` MEDIUMBLOB NOT NULL ;

ALTER TABLE `leonardo_airspace` ADD `serial` TINYINT NOT NULL DEFAULT '0' AFTER `Name` ,
ADD `disabled` TINYINT NOT NULL DEFAULT '0' AFTER `serial` ;

ALTER TABLE `leonardo_airspace` ADD INDEX ( `serial` , `disabled` ) ;

ALTER TABLE `leonardo_airspace` ADD UNIQUE (
`Name` ,
`serial`
)

ALTER TABLE `leonardo_airspace` ADD `updated` TINYINT NOT NULL DEFAULT '0' AFTER `disabled` ;



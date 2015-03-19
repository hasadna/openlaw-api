DROP TABLE IF EXISTS `wiki_pages`;
CREATE TABLE `wiki_pages` (
  `id`                     INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `knesset_new_primary_id` INT(10) UNSIGNED NOT NULL,
  `title`                  VARCHAR(64)      NOT NULL,
  `wiki_id`                INT(10) UNSIGNED NOT NULL,
  `last_updated`           INT(10) UNSIGNED NOT NULL,
  `created`                INT(10) UNSIGNED NOT NULL,
  `updated`                INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `wiki_id` (`wiki_id`),
  UNIQUE KEY `title` (`title`),
  KEY `knesset_new_primary_id` (`knesset_new_primary_id`),
  KEY `created` (`created`),
  KEY `last_updated` (`last_updated`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `knesset_old_laws`;
CREATE TABLE `knesset_old_laws` (
  `id`       INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booklet`  INT(10) UNSIGNED NOT NULL,
  `part`     INT(10) UNSIGNED NOT NULL,
  `knesset`  INT(10) UNSIGNED NOT NULL,
  `title`    VARCHAR(255)     NOT NULL,
  `accepted` INT(10) UNSIGNED NOT NULL,
  `pdf_file` VARCHAR(255)     NOT NULL,
  `origin`   TEXT             NOT NULL,
  `created`  INT(10) UNSIGNED NOT NULL,
  `updated`  INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `knesset_new_primary`;
CREATE TABLE `knesset_new_primary` (
  `id`         INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`       VARCHAR(128)     NOT NULL,
  `knesset_id` INT(10) UNSIGNED NOT NULL,
  `assignee`   VARCHAR(64)      NOT NULL,
  `link`       VARCHAR(128)     NOT NULL,
  `published`  INT(10)          NOT NULL,
  `amended`    INT(10)          NOT NULL,
  `origin`     TEXT             NOT NULL,
  `created`    INT(10) UNSIGNED NOT NULL,
  `updated`    INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `knesset_id` (`knesset_id`),
  KEY `published` (`published`),
  KEY `amended` (`amended`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `knesset_new_secondary`;
CREATE TABLE `knesset_new_secondary` (
  `id`             INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name`           VARCHAR(128)     NOT NULL,
  `knesset_id`     INT(10) UNSIGNED NOT NULL,
  `link`           VARCHAR(128)     NOT NULL,
  `booklet_type`   VARCHAR(16)      NOT NULL,
  `booklet_number` VARCHAR(16)      NOT NULL,
  `booklet_page`   VARCHAR(16)      NOT NULL,
  `published`      INT(10)          NOT NULL,
  `file_path`      VARCHAR(128)     NOT NULL,
  `knesset_number` INT(10) UNSIGNED NOT NULL,
  `bill_type`      VARCHAR(16)      NOT NULL,
  `bill_id`        VARCHAR(16)      NOT NULL,
  `origin`         TEXT             NOT NULL,
  `created`        INT(10) UNSIGNED NOT NULL,
  `updated`        INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `knesset_id` (`knesset_id`),
  KEY `published` (`published`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `knesset_new_amendments`;
CREATE TABLE `knesset_new_amendments` (
  `knesset_new_primary_id`   INT(10) UNSIGNED NOT NULL,
  `knesset_new_secondary_id` INT(10) UNSIGNED NOT NULL,
  UNIQUE KEY `knesset_new_amendments` (`knesset_new_primary_id`, `knesset_new_secondary_id`)
)
  ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

DROP TABLE IF EXISTS `justice_laws`;
CREATE TABLE `justice_laws` (
  `id`          INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `booklet`     INT(10) UNSIGNED NOT NULL,
  `published`   VARCHAR(16)      NOT NULL,
  `description` TEXT             NOT NULL,
  `pdf_file`    VARCHAR(255)     NOT NULL,
  `origin`      TEXT             NOT NULL,
  `created`     INT(10) UNSIGNED NOT NULL,
  `updated`     INT(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `published` (`published`),
  KEY `created` (`created`),
  KEY `updated` (`updated`)
);

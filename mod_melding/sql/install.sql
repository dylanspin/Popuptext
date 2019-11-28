
CREATE TABLE IF NOT EXISTS `#__melding`
(
    `id`                    int(255)      NOT NULL AUTO_INCREMENT,
    `bericht`               varchar(255)  NOT NULL,

    PRIMARY KEY (`id`)
) ENGINE = InnoDB
  DEFAULT CHARSET = utf8;

INSERT INTO `#__melding` (`bericht`) VALUES ('');

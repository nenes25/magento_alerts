<?php

/**
 * Script d'installation du module EtatPur Alerts
 *
 * @author Europe-internet <dev@europe-internet.net>
 * @version 0.1 | $Revision$
 * Last-Modified : $Date$
 * Id : $Id$
 */
$installer = $this;
$installer->startSetup();

$installer->run("CREATE TABLE IF NOT EXISTS {$this->getTable('hhennes_alert')} (
  `alert_id` int(11) NOT NULL auto_increment,
  `name` varchar(255) NOT NULL,
  `description` VARCHAR( 255 ) NOT NULL,
  `conditions` text NOT NULL,
  `email_to_send` tinyint(1) NOT NULL,
  `email_recipient` varchar(255) NULL,
  `email_subject` varchar(255) NULL,
  `email_message` text NULL,  
  `export_to_csv` tinyint(1) NOT NULL,
  `export_csv_file_name` varchar(255) NULL,
  `export_csv_file_path` varchar(255) NULL,
  `export_csv_attached_to_email` tinyint(1) NOT NULL,
  `cron_schedule` varchar(255) NOT NULL,
  `date_add` datetime default NULL,
  `active` TINYINT NOT NULL DEFAULT '1',
  PRIMARY KEY  (`alert_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COMMENT='EtatPur Alert Module' AUTO_INCREMENT=1");

$installer->endSetup();
?>

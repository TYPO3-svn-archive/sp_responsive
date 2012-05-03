# ======================================================================
# Extend table structure of table 'tt_content'
# ======================================================================
CREATE TABLE tt_content (
	tx_spresponsive_controls tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_spresponsive_autoplay tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_spresponsive_items tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_spresponsive_scalable tinyint(4) unsigned DEFAULT '1' NOT NULL,
	tx_spresponsive_fittext tinyint(4) unsigned DEFAULT '0' NOT NULL,
	tx_spresponsive_fitlevel varchar(20) DEFAULT '0.00' NOT NULL
);
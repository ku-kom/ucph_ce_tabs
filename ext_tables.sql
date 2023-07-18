--
-- Table structure for table 'tt_content'
--
CREATE TABLE tt_content (
    tx_ucph_ce_tab_item int(11) unsigned DEFAULT '0',
);

--
-- Table structure for table 'tx_ucph_ce_tab_item'
--
CREATE TABLE tx_ucph_ce_tab_item (
    tt_content int(11) unsigned DEFAULT '0',
    header varchar(255) DEFAULT '' NOT NULL,
    bodytext text,
    media int(11) unsigned DEFAULT '0'
);
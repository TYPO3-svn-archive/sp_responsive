<?php
	if (!defined ('TYPO3_MODE')) {
		die ('Access denied.');
	}

		// Add static template
	t3lib_extMgm::addStaticFile($_EXTKEY, 'Configuration/TypoScript/', 'Responsive Configuration');

		// Add new columns to table "tt_content"
	t3lib_div::loadTCA('tt_content');
	t3lib_extMgm::addTCAcolumns('tt_content', array(
		'tx_spresponsive_controls' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_controls',
			'config' => array (
				'type' => 'check',
				'default' => '0',
				'items' => array(
					array('LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:enabled', ''),
				),
			),
		),
		'tx_spresponsive_autoplay' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_autoplay',
			'config' => array (
				'type' => 'check',
				'default' => '1',
				'items' => array(
					array('LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:enabled', ''),
				),
			),
		),
		'tx_spresponsive_items' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_items',
			'config' => array (
				'type' => 'input',
				'eval' => 'int',
				'size' => '5',
				'default' => '3',
			),
		),
		'tx_spresponsive_scalable' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_scalable',
			'config' => array (
				'type' => 'check',
				'default' => '1',
				'items' => array(
					array('LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:enabled', ''),
				),
			),
		),
		'tx_spresponsive_fittext' => array(
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_fittext',
			'config' => array (
				'type' => 'check',
				'default' => '0',
				'items' => array(
					array('LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:enabled', ''),
				),
			),
		),
		'tx_spresponsive_fitlevel' => array (
			'exclude' => 1,
			'label' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tt_content.tx_spresponsive_fitlevel',
			'config' => array (
				'type' => 'input',
				'eval' => 'double2',
				'size' => '5',
				'default' => '0.00',
			),
		),
	));

		// Add field to mark images as scalable
	t3lib_extMgm::addFieldsToPalette('tt_content', 'image_settings', 'tx_spresponsive_scalable', 'after:imageborder');

		// Add fields to mark headlines as scalable
	t3lib_extMgm::addFieldsToPalette('tt_content', 'header', '--linebreak--, tx_spresponsive_fittext,tx_spresponsive_fitlevel');

		// Create new palettes
	$GLOBALS['TCA']['tt_content']['palettes']['image_settings_slider'] = array(
		'canNotCollapse' => 1,
		'showitem' => 'tx_spresponsive_autoplay, tx_spresponsive_controls',
	);

	$GLOBALS['TCA']['tt_content']['palettes']['image_settings_carousel'] = array(
		'canNotCollapse' => 1,
		'showitem' => 'tx_spresponsive_items',
	);

		// Define backend masks
	$GLOBALS['TCA']['tt_content']['types']['tx_spresponsive_imageslider'] = array(
		'showitem' => implode(',', array(
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.header;header',
			'bodytext;Text;;richtext:rte_transform[flag=rte_enabled|mode=ts_css]',
			'rte_enabled;LLL:EXT:cms/locallang_ttc.xml:rte_enabled_formlabel',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.images',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagefiles;imagefiles',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagelinks;imagelinks',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_accessibility;image_accessibility',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_settings;image_settings',
			'--palette--;LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:palette.image_settings_slider;image_settings_slider',
			'imageorient',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended',
			'tx_gridelements_container',
			'tx_gridelements_columns',
		)),
	);

	$GLOBALS['TCA']['tt_content']['types']['tx_spresponsive_carousel'] = array(
		'showitem' => implode(',', array(
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.general;general',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.header;header',
			'bodytext;Text;;richtext:rte_transform[flag=rte_enabled|mode=ts_css]',
			'rte_enabled;LLL:EXT:cms/locallang_ttc.xml:rte_enabled_formlabel',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.images',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagefiles;imagefiles',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.imagelinks;imagelinks',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_accessibility;image_accessibility',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.appearance',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.frames;frames',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.image_settings;image_settings',
			'--palette--;LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:palette.image_settings_carousel;image_settings_carousel',
			'imageorient',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.access',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.visibility;visibility',
			'--palette--;LLL:EXT:cms/locallang_ttc.xml:palette.access;access',
			'--div--;LLL:EXT:cms/locallang_ttc.xml:tabs.extended',
			'tx_gridelements_container',
			'tx_gridelements_columns',
		)),
	);

		// Add new CTypes
	t3lib_extMgm::addPlugin(array(
		'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tx_spresponsive_imageslider.title',
		'tx_spresponsive_imageslider',
		t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/Icon/Imageslider.gif'
	), 'CType');

	t3lib_extMgm::addPlugin(array(
		'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang.xml:tx_spresponsive_carousel.title',
		'tx_spresponsive_carousel',
		t3lib_extMgm::extRelPath($_EXTKEY) . 'Resources/Public/Images/Icon/Carousel.gif'
	), 'CType');

		// Add wizard icons
	t3lib_extMgm::addPageTSConfig("
		mod.wizards.newContentElement.wizardItems.common {\n
			elements {\n
				tx_spresponsive_imageslider {\n
					icon        = " . t3lib_extMgm::extRelPath($_EXTKEY) . "Resources/Public/Images/Wizard/Imageslider.gif\n
					title       = LLL:EXT:" . $_EXTKEY . "/Resources/Private/Language/locallang.xml:tx_spresponsive_imageslider.title\n
					description = LLL:EXT:" . $_EXTKEY . "/Resources/Private/Language/locallang.xml:tx_spresponsive_imageslider.description\n\n
					tt_content_defValues {\n
						CType = tx_spresponsive_imageslider\n
					}\n
				}\n
				tx_spresponsive_carousel {\n
					icon        = " . t3lib_extMgm::extRelPath($_EXTKEY) . "Resources/Public/Images/Wizard/Carousel.gif\n
					title       = LLL:EXT:" . $_EXTKEY . "/Resources/Private/Language/locallang.xml:tx_spresponsive_carousel.title\n
					description = LLL:EXT:" . $_EXTKEY . "/Resources/Private/Language/locallang.xml:tx_spresponsive_carousel.description\n\n
					tt_content_defValues {\n
						CType = tx_spresponsive_carousel\n
					}\n
				}\n
			}\n
			show := addToList(tx_spresponsive_imageslider,tx_spresponsive_carousel)\n
		}\n
	");

?>
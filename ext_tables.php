<?php
/**
 * Configuration of isan_t3geshi
 */

/* Add plugin CType */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPlugin(array(
    'I-SAN GeSHi Sourcecode',
    'isant3geshi_ce',
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'ext_icon.gif'
), 'CType');

$GLOBALS['TCA']['tt_content']['types']['isant3geshi_ce']['showitem'] =
    '
--palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.header;header,
    pi_flexform;Settings,
    --div--;Code,bodytext;Code,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
    tx_themes_variants,
    tx_themes_responsive,
    tx_themes_behaviour,
    tx_themes_enforceequalcolumnheight,
    tx_themes_columnsettings,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.access,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.visibility;visibility,
    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
    --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.extended,
    --div--;LLL:EXT:lang/locallang_tca.xlf:sys_category.tabs.category,
    categories,
    --div--;LLL:EXT:gridelements/Resources/Private/Language/locallang_db.xlf:gridElements,
    tx_gridelements_container,
    tx_gridelements_columns
';

$GLOBALS['TCA']['tt_content']['types']['isant3geshi_ce']['columnsOverrides']['bodytext'] = array(
    'defaultExtras' => "nowrap:wizards[t3editor]",
    'config' => array(
        'renderType' => 't3editor',
        'format' => 'mixed'
    )
);

$TCA['tt_content']['columns']['pi_flexform']['config']['ds'][','.'isant3geshi_ce'] = 'FILE:EXT:'.$_EXTKEY.'/Configuration/Flexform/flexform.xml';

/* Add Typoscript */
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPageTSConfig('<INCLUDE_TYPOSCRIPT: source="FILE:EXT:' . $_EXTKEY . '/Configuration/TSconfig/mod.wizards.newContentElement.pagets">');
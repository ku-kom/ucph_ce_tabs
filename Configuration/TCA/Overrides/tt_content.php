<?php

/*
 * This file is part of the package ucph_ce_tabs.
 * For the full copyright and license information, please read the
 * LICENSE file that was distributed with this source code.
 * June 2023 Nanna Ellegaard, University of Copenhagen.
 */
declare(strict_types=1);
defined('TYPO3') or die();

call_user_func(function ($extKey ='ucph_ce_tabs', $contentType ='ucph_ce_tabs') {
    // Add Content Element
    if (!is_array($GLOBALS['TCA']['tt_content']['types'][$contentType] ?? false)) {
        $GLOBALS['TCA']['tt_content']['types'][$contentType] = [];
    }
    
    // Add content element to selector list
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addTcaSelectItem(
        'tt_content',
        'CType',
        [
            'LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_be.xlf:ucph_ce_tabs_title',
            $contentType,
            'ucph-ce-tabs-icon'
        ],
        'ucph_ce_modals',
        'before'
    );
    
    // Assign Icon
    $GLOBALS['TCA']['tt_content']['ctrl']['typeicon_classes'][$contentType] = 'ucph-ce-tabs-icon';
    
    // Configure element type
    $GLOBALS['TCA']['tt_content']['types'][$contentType] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['types'][$contentType],
        [
            'showitem' => '
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.general;general,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.headers;headers,
                    tx_ucph_ce_tab_item,
                --div--;LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_be.xlf:ucph_ce_tabs_options,
                    pi_flexform;LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_be.xlf:ucph_ce_tabs_advanced,
                --div--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:tabs.appearance,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.frames;frames,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.appearanceLinks;appearanceLinks,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:language,
                    --palette--;;language,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:access,
                    --palette--;;hidden,
                    --palette--;LLL:EXT:frontend/Resources/Private/Language/locallang_ttc.xlf:palette.access;access,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:categories,
                    categories,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:notes,
                    rowDescription,
                --div--;LLL:EXT:core/Resources/Private/Language/Form/locallang_tabs.xlf:extended,
            '
        ]
    );
    
    // Register fields
    $GLOBALS['TCA']['tt_content']['columns'] = array_replace_recursive(
        $GLOBALS['TCA']['tt_content']['columns'],
        [
            'tx_ucph_ce_tab_item' => [
                'label' => 'LLL:EXT:'.$extKey.'/Resources/Private/Language/locallang_be.xlf:ucph_ce_tabs_item',
                'config' => [
                    'type' => 'inline',
                    'foreign_table' => 'tx_ucph_ce_tab_item',
                    'foreign_field' => 'tt_content',
                    'appearance' => [
                        'useSortable' => true,
                        'showSynchronizationLink' => true,
                        'showAllLocalizationLink' => true,
                        'showPossibleLocalizationRecords' => true,
                        'expandSingle' => true,
                        'enabledControls' => [
                            'localize' => true,
                        ]
                    ],
                    'behaviour' => [
                        'mode' => 'select',
                    ]
                ]
            ]
        ]
    );
    
    // Add flexForms for content element configuration
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
        '*',
        'FILE:EXT:'.$extKey.'/Configuration/FlexForms/Tab.xml',
        $contentType
    );
});

<?php

use TYPO3\CMS\Core\Imaging\IconRegistry;
use TYPO3\CMS\Core\Utility\ExtensionManagementUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

if (!defined('TYPO3')) {
    die('Access denied.');
}
call_user_func(
    function ($extKey = 'cute_mailing') {
        ExtensionManagementUtility::addTypoScriptConstants('@import "EXT:cute_mailing/Configuration/TypoScript/constants.typoscript"');
        ExtensionManagementUtility::addTypoScriptSetup('@import "EXT:cute_mailing/Configuration/TypoScript/setup.typoscript"');
        $cuteMailingSysFolder = 116;

        // Provide icon for page tree, list view, ... :
        $iconRegistry = GeneralUtility::makeInstance(IconRegistry::class);
        $iconRegistry
            ->registerIcon(
                'apps-pagetree-cute-mailing',
                TYPO3\CMS\Core\Imaging\IconProvider\SvgIconProvider::class,
                [
                    'source' => 'EXT:' . $extKey . '/Resources/Public/Icons/cute_folder_icon.svg',
                ]
            );
        // ... register other icons in the same way, see below.

        // Allow backend users to drag and drop the new page type:
        ExtensionManagementUtility::addUserTSConfig(
            'options.pageTree.doktypesToShowInNewPageDragArea := addToList(' . $cuteMailingSysFolder . ')'
        );

    }
);


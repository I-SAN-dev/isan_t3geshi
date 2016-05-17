<?php
$extensionClassesPath = \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath('isan_t3geshi') . 'Classes/';

$default = array(
    'GeSHi' => $extensionClassesPath . 'GeSHi/geshi.php',
);
return $default;
?>
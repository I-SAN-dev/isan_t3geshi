<?php
namespace Isan\IsanT3geshi\Controller;

/*  | This extension is part of the TYPO3 project. The TYPO3 project is
 *  | free software and is licensed under GNU General Public License.
 *  |
 *  | (c) 2016 Sebastian Antosch <s.antosch@i-san.de>
 */
use TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Content Element Controller
 *
 * @package Isan\isant3geshi
 */
class CeController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * Show Action which get called if a CE get rendered in frontend
     *
     * @return string output of ce in frontend
     */
    public function t3geshiAction()
    {
        /**
         * Create new GeSHi
         * @var \GeSHi $geshi
         */
        $geshi = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance(\GeSHi::class);

        /**
         * @var array() $data
         */
        $data = $this->configurationManager->getContentObject()->data;

        $source = '$foo = 45;
                    for ( $i = 1; $i < $foo; $i++ ){
                      echo "$foo\n";  --$foo;
                    }';
        $language = 'php';

        $geshi->set_source($data['bodytext']);

        $geshi->set_language($language);

        $this->view->assign('data', $data);
        $this->view->assign('geshi', $geshi->parse_code());
    }

}

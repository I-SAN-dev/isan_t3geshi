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

        /**
         * @var array() $settings
         */
        $settings = $this->settings;

        $geshi->set_source($data['bodytext']);
        $geshi->set_language($settings['codelang']);

        // Bootstrap support
        $geshi->set_header_type(GESHI_HEADER_PRE_TABLE);
        $geshi->set_overall_class('table');

        if ($settings['linenums']) {
            $geshi->enable_line_numbers(GESHI_NORMAL_LINE_NUMBERS);
        }

        if ($settings['startlinenum'] && $settings['startlinenum'] > 0) {
           $geshi->start_line_numbers_at($settings['startlinenum']);
        }

        // add stylesheet to head (better than inlinestyles)
        $geshi->enable_classes();
        $this->response->addAdditionalHeaderData('
<!-- GeSHi Syntax Highlighter Styles -->
<style type="text/css">
'.$geshi->get_stylesheet().'
</style>
        ');


        $this->view->assign('data', $data);
        $this->view->assign('geshi', $geshi->parse_code());
    }

}

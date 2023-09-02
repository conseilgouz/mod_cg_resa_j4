<?php
/**
 * @module     CG Résa
 * Version			: 2.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
 * Updated on       : September, 2021
 */

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Uri\Uri;
use ConseilGouz\Module\CGResa\Site\Helper\CGResaHelper;
use ConseilGouz\Component\CGResa\Site\Controller\ResaController;

$language = Factory::getLanguage();
$language->load($module->module);

$document = Factory::getDocument();
JHtml::_('behavior.keepalive');

$compath = ''.URI::base(true).'/media/com_cgresa';

$comparams = ResaController::getParams(); 

$document->addScript($compath."/js/errormessages.js");
$document->addScript($compath."/js/cgresa.js"); // validation 

$modulefield	= ''.URI::base(true).'/media/'.$module->module;
$document->addStyleSheet($modulefield.'/css/cgresa.css'); 
$document->addStyleSheet($modulefield.'/css/up.css'); 
$document->addStyleDeclaration($params->get('css','')); 
$document->addScript($modulefield."/js/cgresa.js"); // CSP compliance
$layout = 'default'; // default page
$task = Factory::getApplication()->input->getString('name','','post','');
if ($task != "") {
    if (CGResaHelper::check_resa_form()) {
		$layout = 'thankyou'; // default page
    }
}
require ModuleHelper::getLayoutPath('mod_cg_resa', $layout);


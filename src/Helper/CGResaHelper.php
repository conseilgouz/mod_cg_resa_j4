<?php
/**
 * @module     CG Résa
 * Version			: 2.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
 * Updated on       : September, 2021
**/
namespace ConseilGouz\Module\CGResa\Site\Helper;

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Session\Session;
use Joomla\CMS\Form\Form;
use Joomla\CMS\Language\Text;
use ConseilGouz\Component\CGResa\Site\Controller\ResaController;
class CGResaHelper
{
    static function check_resa_form() {
        Session::checkToken() or jexit(JText::_('JINVALID_TOKEN'));
		$app = Factory::getApplication(); 
		$input = $app->input; 
		$data = array();
		$data['name']  = $input->get('name');
		$data['aphone'] = $input->getString('aphone');
		$data['email'] =$input->getString('email');
		$data['date'] = $input->getString('datepick');
		$data['datepick'] = $input->getString('datepick');
		$data['time'] = $input->getString('timepick');
		$data['timepick'] = $input->getString('timepick');
		$data['size'] = $input->getInt('size');
		$data['msg'] = $input->getString('msg');
		$form = new Form('ResaForm');
		$form->loadFile(JPATH_ROOT.'/components/com_cgresa/forms/resa.xml');
        if (!$form->validate($data)) {
            $errors = $form->getErrors();
            for ($i = 0, $n = count($errors); $i < $n && $i < 3; $i++) {
                if ($errors[$i] instanceof Exception) {
			        $app->enqueueMessage($errors[$i]->getMessage(), 'notice');
				} else {
			        $app->enqueueMessage($errors[$i], 'notice');
				}
            }
            return false;
        }
        $comparams = ResaController::getParams();
        if (($comparams['captcha'] != '' && $comparams['captcha'] != '0')) {
            PluginHelper::importPlugin('captcha',$comparams['captcha']);
            $res = $app->triggerEvent('onCheckAnswer', array($input->getString($comparams['captcha'].'_response_field','','post','')));
            if (!$res[0]) { 
				$app->enqueueMessage(Text::_('COM_CG_RESA_CAPTCHA_ERR'),'error');
                return false;
            }
		}
        ResaController::send_resa($comparams,$data);
        return true;
	}
}

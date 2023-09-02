<?php
/**
 * @module     CG Résa
 * Version			: 2.0.1
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 * @copyright (c) 2021 ConseilGouz. All Rights Reserved.
 * @author ConseilGouz 
**/

defined('_JEXEC') or die;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\Form\Form;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;

HTMLHelper::_('behavior.formvalidator');
$resaForm = new Form('ResaForm');
$resaForm->loadFile(JPATH_ROOT.'/components/com_cgresa/forms/resa.xml');

//Trigger onResaFormPrepare event
PluginHelper::importPlugin('cgresa');
Factory::getApplication()->triggerEvent('onResaFormPrepare', array('mod_cg_resa_form', $document, $params));

?>
<p id="cg_resa_messages">
</p>
<form action="<?php echo Route::_('index.php', true); ?>" method="post" id="resa-form" class="form-validate">
	<div class="form-horizontal">
		<fieldset class="cgresaform">
			<?php if ($params->get('hidelegend','false') == 'false') { ?>
			<legend><?php echo $comparams['legend']; ?></legend>
			<?php } ?>
			<div id="cg_resa_messages">
			</div>
			<?php foreach ($resaForm->getFieldset() as $fieldset) {
					echo $fieldset->label;
					echo $fieldset->input;
            }?>
		<?php if($comparams['captcha'] != '' && $comparams['captcha'] != 0) {
			PluginHelper::importPlugin('captcha',$comparams['captcha'] );
            $captcha_name = $comparams['captcha'];
            $captcha_id = 'dynamic_'.$comparams['captcha'].'_1';
            $laclasse = " class='g-".$comparams['captcha']." required fg-c8 fg-cs12' ";
			$app->triggerEvent('onInit',array($captcha_id));
			$arr =	$app->triggerEvent('onDisplay',array($captcha_name,$captcha_id,$laclasse));
			echo '<div id="form-resa-captcha" class="control-group fg-row">';
			if ($comparams['captcha'] == "recaptcha") echo "<label for='".$captcha_id."' class='fg-c4 fg-cs12'>Captcha</label>";
			echo $arr[0];
			echo '</div>';
			} 
		?>
		<div class="cg_resa_privacy">
			<a id="cg_resa_privacy"><?php echo Text::_('MOD_CG_RESA_PRIVACY'); ?></a>
			<div id="cg_resa_privacy_text" class="cg_privacy_text">
				<?php echo Text::_('MOD_CG_RESA_PRIVACY_TEXT'); ?>
			</div>
		</div>
		
		</fieldset>
	</div>
	<div class="btn-toolbar fg-row">
		<button type="submit" name="Submit" id="resasubmit" class="btn btn-primary fg-c12 resasubmit validate" data-init="<?php echo Text::_('COM_CG_RESA_RESA') ?>"
		data-wait="<?php echo Text::_('COM_CGRESA_MSG_WAIT') ?>">
				<?php echo Text::_('COM_CGRESA_RESA') ?>
		</button>
	</div>
	<input type="hidden" name="task" />
	<?php echo HTMLHelper::_('form.token'); ?>
</form>
<?php  /** * @module     CG Résa * Version			: 2.0.1 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL * @copyright (c) 2021 ConseilGouz. All Rights Reserved. * @author ConseilGouz **/// no direct accessdefined('_JEXEC') or die; use Joomla\CMS\Factory;use Joomla\CMS\Language\Text;use Joomla\CMS\Uri\Uri;$app = Factory::getApplication();$input = $app->input;$date = $input->get('datepick');$time = $input->get('timepick');?><div class="cg_resa-thankyou row">    <div class="col-md-12"><img src="<?php echo URI::base(); ?>media/com_cgresa/images/tick.png" alt="Thank you" style="max-width:50px"></div>	<div class="cg_resa-thankyou-title col-md-12" style="margin-top:1em" >	<?php echo Text::sprintf('COM_CGRESA_THANKYOU',$date,$time); ?>	</div>	<div class="col-md-12" style="margin-top:1em"><a href="index.php"  rel="noopener noreferrer"><button>Retour &agrave; l'accueil</button></a></div></div>



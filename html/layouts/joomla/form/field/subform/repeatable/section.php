<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Make thing clear
 *
 * @var JForm   $form       The form instance for render the section
 * @var string  $basegroup  The base group name
 * @var string  $group      Current group name
 * @var array   $buttons    Array of the buttons that will be rendered
 */
extract($displayData);

?>

<div class="subform-repeatable-group" data-base-name="<?php echo $basegroup; ?>" data-group="<?php echo $group; ?>">
	<?php if (!empty($buttons)):?>
	<div class="btn-toolbar text-right">
		<div class="btn-group">
			<?php if (!empty($buttons['add'])):?><a class="btn btn-success"><i class="fa fa-plus"></i> </a><?php endif;?>
			<?php if (!empty($buttons['remove'])):?><a class="btn btn-danger"><i class="fa fa-minus"></i> </a><?php endif;?>
			<?php if (!empty($buttons['move'])):?><a class="btn btn-primary"><i class="fa fa-arrows"></i> </a><?php endif;?>
		</div>
	</div>
	<?php endif; ?>

<?php foreach($form->getGroup('') as $field): ?>
	<?php echo $field->renderField(); ?>
<?php endforeach; ?>
</div>

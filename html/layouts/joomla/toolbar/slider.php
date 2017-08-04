<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2016 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;

JHtml::_('behavior.core');

$doTask  = $displayData['doTask'];
$class   = $displayData['class'];
$text    = $displayData['text'];
$name    = $displayData['name'];
$onClose = $displayData['onClose'];
?>
<button onclick="<?php echo $doTask; ?>" class="btn btn-secondary btn-sm" data-toggle="collapse" data-target="#collapse-<?php echo $name; ?>"<?php echo $onClose; ?>>
	<i class="fa fa-cog"></i> <?php echo $text; ?>
</button>

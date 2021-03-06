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

$doTask = $displayData['doTask'];
$class  = $displayData['class'];
$text   = $displayData['text'];

?>
<button onclick="<?php echo $doTask; ?>" class="btn btn-secondary btn-sm">
	<i class="<?php echo $class; ?>"></i> <?php echo $text; ?>
</button>

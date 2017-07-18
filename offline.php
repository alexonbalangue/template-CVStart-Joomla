<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor-cvstart
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$sitename = $apps->get('sitename');
$this->language  = $docs->language;
$this->direction = $docs->direction;

$this->_script = $this->_scripts = array();	

unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);

require_once JPATH_ADMINISTRATOR . '/components/com_users/helpers/users.php';

$twofactormethods = UsersHelper::getTwoFactorMethods();
?>
<!DOCTYPE html>
<html lang="<?php echo $this->language; ?>" dir="<?php echo $this->direction; ?>">
[head]
	[meta charset="utf-8" /]
	[title]<?php echo $sitename.' - '.JText::_('JOFFLINE_MESSAGE'); ?>[/title]
	[begins tags='meta' more='name="viewport" content="width=device-width, initial-scale=1"' /]
	[begins tags='meta' more='name="robots" content="noindex,nofollow"' /]	
	[link rel="stylesheet" href="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/production/css/offline.min.css'; ?>" type="text/css" /]
	<?php if ($apps->get('debug_lang', '0') == '1' || $apps->get('debug', '0') == '1') : ?>
		[link rel="stylesheet" href="<?php echo $this->baseurl; ?>/media/cms/css/debug.css" type="text/css" /]
	<?php endif; ?>
	[link rel="shortcut icon" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/favicon.ico" type="image/vnd.microsoft.icon" /]
	[link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/css/bootstrap.min.css" type="text/css" /]
	[link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css" type="text/css" /]
	[link rel="stylesheet" href="<?php echo $this->baseurl; ?>/templates/<?php echo $this->template; ?>/assets/production/boostrap4-full.min.css" type="text/css" /]
	<!--<if lt IE 9>
		[script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js" /]
		[script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js" /]
	<!<endif>-->
[/head]
[begins tags="body" mdatatype="http://schema.org/WebPage" /]
<jdoc:include type="message" />
		[header class="masthead"]
			[begins tags="div" class="container" /]
				[begins tags="div" class="row" /]
					[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" /]

					<?php if ($apps->get('offline_image') && file_exists($apps->get('offline_image'))) : ?>
							<img itemprop="primaryImageOfPage" src="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/img/profile.png'; ?>" alt="demo" class="img-responsive img-circle">
									<meta itemprop="image" content="<?php echo $this->baseurl.'/templates/'.$this->template.'/assets/img/profile.png'; ?>">
					<?php endif; ?>
					
						[begins tags="div" class="intro-text" /]
							[begins tags="span" class="name" mdataprop="author" /]<?php echo htmlspecialchars($apps->get('sitename')); ?>[ends tags="span" /]
						[hr class="star-light" /]
						<?php if ($apps->get('display_offline_message', 1) == 1 && str_replace(' ', '', $apps->get('offline_message')) != '') : ?>
							[begins tags="span" class="skills" /]<?php echo $apps->get('offline_message'); ?>[ends tags="span" /]
						<?php elseif ($apps->get('display_offline_message', 1) == 2 && str_replace(' ', '', JText::_('JOFFLINE_MESSAGE')) != '') : ?>
							[begins tags="span" class="skills" /]<?php echo JText::_('JOFFLINE_MESSAGE'); ?>[ends tags="span" /]
						<?php endif; ?>	
						[br /]
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
		[/header]	
    [section id="offline" class="failed"]
        [begins tags="div" class="container" /]  
            [begins tags="div" class="row" /]  
                [begins tags="div" class="col-lg-12 text-center" /]  
                    [h2 itemprop="alternativeHealine"]Sorry, admin login only[/h2]
                    [hr class="star-primary" /]
            [ends tags="div" /]  
            [begins tags="div" class="row" /]  
                    [begins tags="div" class="row text-center" /]  
						[begins tags='form' class='form-inline' id='form-login' more='action="<?php echo JRoute::_('index.php', true); ?>" method="post"' /]  
							[begins tags="div" class="form-group" /]  
								[begins tags='label' more='for="username"' /]<?php echo JText::_('JGLOBAL_USERNAME'); ?>[ends tags="label" /]
								[input name="username" id="username" type="text" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_USERNAME'); ?>" /]
							[ends tags="div" /]  
							[begins tags="div" class="form-group" /] 
								[begins tags='label' more='for="passwd"' /]<?php echo JText::_('JGLOBAL_PASSWORD'); ?>[ends tags="label" /]
								[input type="password" name="password" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_PASSWORD'); ?>" id="passwd" /]
							[ends tags="div" /]  
							<?php if (count($twofactormethods) > 1) : ?>
								[begins tags="div" class="form-group" /] 
									[begins tags='label' more='for="secretkey"' /]<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>[ends tags="label" /]
									[input type="text" name="secretkey" class="form-control" placeholder="<?php echo JText::_('JGLOBAL_SECRETKEY'); ?>" id="secretkey" /]
								[ends tags="div" /]  
							<?php endif; ?>
							[input type="submit" name="Submit" class="btn btn-dark" value="<?php echo JText::_('JLOGIN'); ?>" /]
							[input type="hidden" name="option" value="com_users" /]
							[input type="hidden" name="task" value="user.login" /]
							[input type="hidden" name="return" value="<?php echo base64_encode(JUri::base()); ?>" /]
							<?php echo JHtml::_('form.token'); ?>
						[ends tags="form" /]
					[ends tags="div" /]  
                [ends tags="div" /]  
            [ends tags="div" /]  
        [ends tags="div" /]  
    [/section]
    [footer id="copyright" class="text-center"]
		[begins tags="div" class="footer-below" /]  
			[begins tags="div" class="container" /]  
				[begins tags="div" class="row" /]  
					[begins tags="div" class="col-lg-12 text-center" /]  
						<i class="fa fa-mobile fa-5x"></i> <i class="fa fa-tablet fa-5x"></i> <i class="fa fa-laptop fa-5x"></i> <i class="fa fa-desktop fa-5x"></i> <br>
						Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.<br>
						<span itemprop="copyrightHolder">&copy; <a href="<?php echo $this->baseurl; ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - 
						Conception by <a href="//www.AlexonBalangue.me" target="_top">www.AlexonBalangue.me</a> - Webdesigner by <a href="//www.startbootstrap.com" target="_top">www.StartBootstrap.com</a>
						<br />Toute reproduction interdite sans l'autorisation de l'auteur. 
					[ends tags="div" /]  
				[ends tags="div" /]  
			[ends tags="div" /]  
        [ends tags="div" /]  
    [/footer]
		[script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js" /] 
		[script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha.6/js/bootstrap.min.js" /] 
		[script src="<?php echo $this->baseurl; ?>/assets/production/boostrap4-full.min.js" /] 
		[script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.0/js/tether.min.js" /] 
	[ends tags="body" /]  
</html>

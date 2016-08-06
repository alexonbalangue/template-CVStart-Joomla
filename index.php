<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.coopceptor (cvstart)
 *
 * @copyright   Copyright (C) 2016 Alexon Balangue. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */


defined('_JEXEC') or die;
#if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);# Add this code For Joomla 3.3.4+
$apps             = JFactory::getApplication();
$docs             = JFactory::getDocument();
$users            = JFactory::getUser();
$this->language  = $docs->language;
$this->direction = $docs->direction;

// Getting params from template
$params = $apps->getTemplate(true)->params;

$sitename = $apps->get('sitename');
$desc_site = $apps->getCfg('MetaDesc');
//PARAMS
$Grps_html = $this->params->get('groups-html');
$hide_joomla_default = $this->params->get('Pages-js-default');
// Output as HTML5
$docs->setHtml5(true);
$option   = $apps->input->getCmd('option', '');
$view     = $apps->input->getCmd('view', '');
$layout   = $apps->input->getCmd('layout', '');
$task     = $apps->input->getCmd('task', '');
$itemid   = $apps->input->getCmd('Itemid', '');

if($task == "edit" || $layout == "form" ){ $fullWidth = 1; } else { $fullWidth = 0; }
//Remove défault JS Joomla 3.3.6/+ on front end home pages or other component


		
switch($hide_joomla_default):
	case 'home':
		$this->_script = $this->_scripts = array();	
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-more.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/mootools-core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/core.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/modal.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/system/js/caption.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-migrate.min.js']);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/jquery-noconflict.js']);
		JHtmlBootstrap::framework(false);
		unset($docs->_scripts[JURI::root(true) . '/media/jui/js/bootstrap.min.js']);
	break;
	case 'component':
		foreach ($this->_scripts as $script => $value){ if (preg_match('/media\/jui/i', $script)){ unset($this->_scripts[$script]); } }	
		JHtmlBootstrap::framework(false);
	break;
	default:
		$docs->addScriptVersion($this->baseurl . '/templates/' . $this->template . '/assets/template.js');
		// Add Stylesheets
		$docs->addStyleSheetVersion($this->baseurl . '/templates/' . $this->template . '/assets/template.css');
		// Check for a custom CSS file
		$userCss = JPATH_SITE . '/templates/' . $this->template . '/assets/user.css';
		if (file_exists($userCss) && filesize($userCss) > 0)
		{
			$docs->addStyleSheetVersion('templates/' . $this->template . '/assets/user.css');
		}
			break;
endswitch;

# Adjusting content width
if ($this->countModules('sidebar-left') && $this->countModules('sidebar-right')){
	$boostrap2_sizes = "span6";
	$boostrap3_sizes = "col-xs-12 col-sm-6 col-md-6 col-lg-6";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-6 large-6 columns";
	$metroui_sizes = "cell colspan6";
} elseif ($this->countModules('sidebar-left') && !$this->countModules('sidebar-right')){
	$boostrap2_sizes = "span9";
	$boostrap3_sizes = "col-xs-12 col-sm-9 col-md-9 col-lg-9";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-9 large-9 columns";
	$metroui_sizes = "cell colspan9";
} elseif (!$this->countModules('sidebar-left') && $this->countModules('sidebar-right')){
	$boostrap2_sizes = "span9";
	$boostrap3_sizes = "col-xs-12 col-sm-9 col-md-9 col-lg-9";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-9 large-9 columns";
	$metroui_sizes = "cell colspan9";
} else {
	$boostrap2_sizes = "span12";
	$boostrap3_sizes = "col-xs-12 col-sm-12 col-md-12 col-lg-12";
	$amp_sizes = "";
	$foundation_sizes = "small-12 medium-expand large-expand columns";
	$metroui_sizes = "cell colspan12";
}

// Logo file or site title param logoFile

if(!empty($this->params->get('logoFile'))):
	$mypersonal_photo = $this->baseurl.'/'.$this->params->get('logoFile');
else:
	$mypersonal_photo = $this->baseurl.'/templates/'.$this->template.'/assets/img/profile.png';
endif;

$Params_grpsJs = $this->params->get('groups-method');
$Params_grpsCSS = $this->params->get('groups-method');
if ($Params_grpsJs == 'production') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/production/'.$this->params->get('groups-script').'-full.min.css');
elseif ($Params_grpsJs == 'custom') : 
	$docs->addStyleSheetVersion(JUri::root(true).'/templates/'.$this->template.'/assets/custom/'.$this->params->get('groups-script').'-full.css');
endif;


$docs->addStyleSheet('https://fonts.googleapis.com/css?family=Montserrat:400,700');
//$docs->addStyleSheet('//fonts.googleapis.com/css?family=Lato:400,700,400italic,700italic');


require_once dirname(__FILE__).DIRECTORY_SEPARATOR.'html'.DIRECTORY_SEPARATOR.'renderer'.DIRECTORY_SEPARATOR.'head.php';
require_once JPATH_SITE.DIRECTORY_SEPARATOR.'media'.DIRECTORY_SEPARATOR.'mod_opensource'.DIRECTORY_SEPARATOR.'Mobile_Detect.php';
$detect = new Mobile_Detect;
$JMobileDetectHeader = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mheader" style="nones" />' : '<jdoc:include type="modules" name="banner-header" style="nones" />';
$JMobileDetectFooter = $detect->isMobile() && $detect->isTablet() ? '<jdoc:include type="modules" name="banner-mfooter" style="nones" />' : '<jdoc:include type="modules" name="banner-footer" style="nones" />';
?>

[doctype html="html" /]
<html <?php echo $params->get('ampHTML'); ?> lang="en" dir="<?php echo $this->direction; ?>">
	[head]
	<jdoc:include type="head" />
	[/head]
	<?php switch($Grps_html): case 'boostrap2-home': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]		
		[nav class="navbar navbar-inverse navbar-fixed-top navbar-shrink"]
			[begins tags='div' class='navbar-inner' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='navbar-header page-scroll' /]
						[begins tags='button' class='btn btn-navbar' more='type="button" data-toggle="collapse" data-target=".nav-collapse"' /]
							[span class="icon-bar"][/span]
							[span class="icon-bar"][/span]
							[span class="icon-bar"][/span]
						[ends tags='button' /]
						[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
					[ends tags="div" /]
					[begins tags="div" class="collapse nav-collapse" /]
						<?php if ($this->countModules('cvstart_menu')) : ?>
							<jdoc:include type="modules" name="cvstart_menu" style="none" />
						<?php endif; ?>			
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags="div" class="span12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		<?php if ($this->countModules('bs2-information')): ?>
			[section id="information"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]

							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_INFORMATION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					<jdoc:include type="modules" name="bs2-information" style="none" />
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-information" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
		<?php if ($this->countModules('bs2-portfolio')) : ?>
			[section class="success" id="portfolios"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PORTFOLIO_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-portfolio" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	          
		<?php if ($this->countModules('bs2-download')) : ?>
			[section id="download"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_DOWNLOAD_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-download" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	                    
		<?php if ($this->countModules('bs2-project')) : ?>
			[section id="project" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PROJECT_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-project" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('bs2-translator')) : ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
  		<?php if ($this->countModules('bs2-boutique')) : ?>
			[section class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_SHOPPING_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-boutique" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs2-payment')) : ?>
			[section id="payment"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('bs2-login')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span6' /]<jdoc:include type="modules" name="bs2-login" style="none" />[ends tags="div" /]
						[begins tags='div' class='span6' /]<jdoc:include type="modules" name="bs2-subscribe" style="none" />[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('bs2-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row-fluid" /] 
						<jdoc:include type="modules" name="bs2-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row-fluid"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr class="clearfix" /]
					[ends tags="div" /]
					[begins tags='div' more='class="row-fluid"' /]
						<?php if ($this->countModules('bs2-footer1')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer2')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer3')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer4')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags='div' class='span12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-phone visible-tablet' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]	
	<?php break; case 'boostrap2-component': ?>

		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]

		[nav class="navbar navbar-inverse navbar-fixed-top navbar-shrink"]
			[begins tags='div' class='navbar-inner' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='navbar-header page-scroll' /]
						[begins tags='button' class='btn btn-navbar' more='type="button" data-toggle="collapse" data-target=".nav-collapse"' /]
							[span class="icon-bar"][/span]
							[span class="icon-bar"][/span]
							[span class="icon-bar"][/span]
						[ends tags='button' /]
						[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
					[ends tags="div" /]
					[begins tags="div" class="collapse nav-collapse" /]
						<?php if ($this->countModules('cvstart_menu')) : ?>
							<jdoc:include type="modules" name="cvstart_menu" style="none" />
						<?php endif; ?>			
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags="div" class="span12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		
		[section]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row-fluid" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs2-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap2_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	                            
		<?php if ($this->countModules('bs2-translator')) : ?>
			[section id="translator" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs2-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('bs2-login')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='span6' /]<jdoc:include type="modules" name="bs2-login" style="none" />[ends tags="div" /]
						[begins tags='div' class='span6' /]<jdoc:include type="modules" name="bs2-subscribe" style="none" />[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('bs2-payment')) : ?>
			[section id="payment" class="success"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row-fluid" /] 
						<jdoc:include type="modules" name="bs2-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('bs2-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags='div' class='span12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]	
					[ends tags="div" /]	
					[begins tags="div" class="row-fluid" /] 
						<jdoc:include type="modules" name="bs2-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags="div" class="row-fluid" /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr class="clearfix" /]
					[ends tags="div" /]
					[begins tags='div' class='row-fluid' /]
						<?php if ($this->countModules('bs2-footer1')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer2')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer3')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs2-footer4')) : ?>
							[begins tags='div' class='span3 footer-col' /]<jdoc:include type="modules" name="bs2-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row-fluid' /]
						[begins tags='div' class='span12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-phone visble-tablet' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]			
	<?php break; case 'boostrap3-home': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="navbar-brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		<?php if ($this->countModules('bs3-information')): ?>
			[section id="information"]
				[begins tags='div' class='containe' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_INFORMATION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-information" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
		<?php if ($this->countModules('bs3-portfolio')) : ?>
			[section class="success" id="portfolios"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PORTFOLIO_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-portfolio" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	          
		<?php if ($this->countModules('bs3-download')) : ?>
			[section id="download"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_DOWNLOAD_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-download" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	                    
		<?php if ($this->countModules('bs3-project')) : ?>
			[section id="project" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PROJECT_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-project" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=undefined&from=';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
  		<?php if ($this->countModules('bs3-boutique')) : ?>
			[section class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_SHOPPING_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-boutique" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('bs3-payment')) : ?>
			[section id="payment"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('bs3-login')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-login" style="none" />[ends tags="div" /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-subscribe" style="none" />[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('bs3-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr class="clearfix" /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'boostrap3-component': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="navbar-brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
			[section]
				[begins tags="div" class="container-fluid" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs3-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap3_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	                            
		<?php if ($this->countModules('bs3-translator')) : ?>
			[section id="translator" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						
						<div id='MicrosoftTranslatorWidget' class='Dark' style='color:white;background-color:#555555'></div><script type='text/javascript'>setTimeout(function(){{var s=document.createElement('script');s.type='text/javascript';s.charset='UTF-8';s.src=((location && location.href && location.href.indexOf('https') == 0)?'https://ssl.microsofttranslator.com':'http://www.microsofttranslator.com')+'/ajax/v3/WidgetV3.ashx?siteData=ueOIGRSKkd965FeEGM5JtQ**&ctf=False&ui=true&settings=undefined&from=';var p=document.getElementsByTagName('head')[0]||document.documentElement;p.insertBefore(s,p.firstChild); }},0);</script>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('bs3-login')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-md-12' /]<jdoc:include type="modules" name="bs3-subscribe" style="none" />[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('bs3-payment')) : ?>
			[section id="payment" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('bs3-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]	
					[ends tags="div" /]	
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="bs3-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('bs3-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('bs3-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="bs3-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'amp-home': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		<?php if ($this->countModules('amp-information')): ?>
			[section id="information"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_INFORMATION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-information" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
		<?php if ($this->countModules('amp-portfolio')) : ?>
			[section class="success" id="portfolios"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PORTFOLIO_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-portfolio" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	          
		<?php if ($this->countModules('amp-download')) : ?>
			[section id="download"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_DOWNLOAD_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-download" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	                    
		<?php if ($this->countModules('amp-project')) : ?>
			[section id="project" class="success"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PROJECT_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-project" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('amp-translator')) : ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
  		<?php if ($this->countModules('amp-boutique')) : ?>
			[section class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_SHOPPING_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-boutique" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('amp-payment')) : ?>
			[section id="payment"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('amp-login')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="amp-login" style="none" />
						<jdoc:include type="modules" name="amp-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('amp-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('amp-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'amp-component': ?>

		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $amp_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $amp_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="amp-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $amp_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	                            
		<?php if ($this->countModules('amp-translator')) : ?>
			[section id="translator" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('amp-login')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="amp-login" style="none" />
						<jdoc:include type="modules" name="amp-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('amp-payment')) : ?>
			[section id="payment" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('amp-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]	
					[ends tags="div" /]	
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="amp-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('amp-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('amp-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="amp-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'foundation-home': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		<?php if ($this->countModules('fi-information')): ?>
			[section id="information"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_INFORMATION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-information" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
		<?php if ($this->countModules('fi-portfolio')) : ?>
			[section class="success" id="portfolios"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PORTFOLIO_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-portfolio" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	          
		<?php if ($this->countModules('fi-download')) : ?>
			[section id="download"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_DOWNLOAD_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-download" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	                    
		<?php if ($this->countModules('fi-project')) : ?>
			[section id="project" class="success"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PROJECT_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-project" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('fi-translator')) : ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
  		<?php if ($this->countModules('fi-boutique')) : ?>
			[section class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_SHOPPING_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-boutique" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('fi-payment')) : ?>
			[section id="payment"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('fi-login')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="fi-login" style="none" />
						<jdoc:include type="modules" name="fi-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('fi-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('fi-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'foundation-component': ?>
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $foundation_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $foundation_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="fi-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $foundation_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	                            
		<?php if ($this->countModules('fi-translator')) : ?>
			[section id="translator" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('fi-login')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="fi-login" style="none" />
						<jdoc:include type="modules" name="fi-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('fi-payment')) : ?>
			[section id="payment" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('fi-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]	
					[ends tags="div" /]	
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="fi-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('fi-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('fi-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="fi-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]	
	<?php break; case 'metroui-home': ?>
	
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
		<?php if ($this->countModules('mui-information')): ?>
			[section id="information"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]

							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_INFORMATION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-information" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
		<?php if ($this->countModules('mui-portfolio')) : ?>
			[section class="success" id="portfolios"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PORTFOLIO_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-portfolio" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	          
		<?php if ($this->countModules('mui-download')) : ?>
			[section id="download"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_DOWNLOAD_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-download" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	                    
		<?php if ($this->countModules('mui-project')) : ?>
			[section id="project" class="success"]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PROJECT_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-project" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('mui-translator')) : ?>
			[section id="translator"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	        
  		<?php if ($this->countModules('mui-boutique')) : ?>
			[section class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_SHOPPING_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-boutique" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	 
		<?php if ($this->countModules('mui-payment')) : ?>
			[section id="payment"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('mui-login')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="mui-login" style="none" />
						<jdoc:include type="modules" name="mui-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	   
		<?php if ($this->countModules('mui-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('mui-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'metroui-component': ?>
	
		[begins tags='body' id='page-top' class='index' mdatatype='http://schema.org/WebPage' /]
		[nav class="navbar navbar-inverse navbar-fixed-top"]
			[begins tags='div' class='container-fluid' /]
				[begins tags='div' class='navbar-header page-scroll' /]
					[begins tags='button' class='navbar-toggle' more='type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1"' /]
						[span class="sr-only"]Toggle navigation[/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
						[span class="icon-bar"][/span]
					[ends tags='button' /]
					[a class="brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[ends tags="div" /]
				[begins tags="div" class="collapse navbar-collapse" id="bs-example-navbar-collapse-1" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags="div" class="col-xs-12 col-sm-12 col-md-12 col-lg-12" mdatatype"http://schema.org/CreativeWork" /]
							[span mdataprop="primaryImageOfPage" class="sprites sprites-alexonbalangue img-circle" /]
									<meta itemprop="image" content="<?php echo $mypersonal_photo; ?>">
							[begins tags='div' more='class="intro-text"' /]
								[begins tags='h1' class='name' mdataprop='author']
									<?php echo $this->params->get('homme_femme').' '.$sitename.''; ?>
								[ends tags='h1' /]
								<meta itemprop="name" content="<?php echo $sitename; ?>">
								[hr class="star-light" /]
								<?php if($this->params->get('myskills')): ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo $this->params->get('myskills'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo $this->params->get('myskills'); ?>">
								<?php else: ?>
									[begins tags="span" class="skills" mitemprop="description"]
										<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>
									[ends tags='span' /]
									<meta itemprop="description" content="<?php echo JText::_('TPL_CVSTART_SKILLS_HOME'); ?>">
								<?php endif; ?>
							[ends tags="div" /]								
						[ends tags="div" /]
					[ends tags="div" /]
				[ends tags="div" /]
			[/header]
			[section]
				[begins tags="div" class="container" /]  
					[begins tags="div" class="row" /]
						<?php if ($this->countModules('sidebar-left')) : ?>
						[begins tags="div" class="<?php echo $metroui_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $metroui_sizes; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="mui-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $metroui_sizes; ?>" /]
							<jdoc:include type="modules" name="sidebar-right" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	                            
		<?php if ($this->countModules('mui-translator')) : ?>
			[section id="translator" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_TRANSLATOR_HOME'); ?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-translator" style="nones" />
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('mui-login')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						<jdoc:include type="modules" name="mui-login" style="none" />
						<jdoc:include type="modules" name="mui-subscribe" style="none" />
					[ends tags="div" /]
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	     
		<?php if ($this->countModules('mui-payment')) : ?>
			[section id="payment" class="success"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_PAYMENTS_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /] 
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-payment" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	    
		<?php if ($this->countModules('mui-contact')) : ?>
			[section id="contact"]
				[begins tags='div' class='container' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONTACT_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]	
					[ends tags="div" /]	
					[begins tags="div" class="row" /] 
						<jdoc:include type="modules" name="mui-contact" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /]
			[/section]	
		<?php endif; ?>	
		[footer class="text-center"]
			[begins tags='div' class='footer-above' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' more='class="row"' /]
						<?php echo $JMobileDetectFooter; ?>
						  [hr /]
					[ends tags="div" /]
					[begins tags='div' more='class="row"' /]
						<?php if ($this->countModules('mui-footer1')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer1" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer2')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer2" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer3')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer3" style="none" />[ends tags="div" /]
						<?php endif; ?>	
						<?php if ($this->countModules('mui-footer4')) : ?>
							[begins tags='div' class='col-xs-12 col-sm-6 col-md-3 col-lg-3 footer-col' /]<jdoc:include type="modules" name="mui-footer4" style="none" />[ends tags="div" /]
						<?php endif; ?>	
					[ends tags="div" /]
				[ends tags="div" /]
			[ends tags="div" /]
			[begins tags='div' class='footer-below' /]
				[begins tags='div' class='container-fluid' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' mdatatype='http://schema.org/CreativeWork' /]
						[fa name="mobile" zoom="5x" /] [fa name="tablet" zoom="5x" /] [fa name="laptop" zoom="5x" /] [fa name="desktop" zoom="5x" /][br /]
					Nous sommes 100% amis avec les moteur de recherches et multiplateformes avec n'importe quelles choix de votre navigateur internet.[br /]
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url]
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top page-scroll visible-xs visble-sm' /]
			[url class="btn btn-primary" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; default: ?>
		[begins tags="body" /]
		[header]
			<?php echo $logo; ?>
		[/header]
		[section]
			No content here, please contact the webmaster.	
		[/section]
		[footer] 
			&copy; <?php echo date("Y").' '.$sitename; ?> - 
			Conception by [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url]  
		[/footer]
	<?php break; endswitch; ?>	
		<?php if ($this->countModules('referencer')) : ?><jdoc:include type="modules" name="referencer" style="none" /><?php endif; ?>	
		<?php if ($Params_grpsJs == 'production') : ?>
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/production/'.$this->params->get('groups-script').'-full.min.js'; ?>" /] 
			
		<?php elseif ($Params_grpsJs == 'custom') : ?>	
			[script src="<?php echo JURI::root(true).'/templates/'.$this->template.'/assets/custom/'.$this->params->get('groups-script').'-full.js'; ?>" /]				
		<?php endif; ?>	
	

<?php /********[ LAWS EUROPEAN - obligation show cookie legal ]*******/ ?>
		[cookies legal="<?php echo JText::_('TPL_CVSTART_COOKIESEU_HOME'); ?>" botton="Ok" url="//www.alexonbalangue.me/information/mention-legal.html" /] 	
		<jdoc:include type="modules" name="debug" style="none" />	

	[ends tags="body" /]  
</html>

	<?php break; case 'boostrap4-home': ?>
	[nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav"]
		[begins tags='button' class='navbar-toggler navbar-toggler-right' more='type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation"' /]
            Menu [fa name='bars' /]
        [ends tags='button' /]
        [begins tags='div' class='container' /]
            [a class="navbar-brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[begins tags="div" class="collapse navbar-collapse" id="navbarMenu" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header class="masthead"]
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
						<jdoc:include type="modules" name="bs3-translator" style="none" />
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
		<?php if ($this->countModules('bs3-login-left') && $this->countModules('bs3-login-right')) : ?>
			[section id="logs" class="success"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME')?>[/h2]
							[hr class="star-light" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-login-left" style="none" />[ends tags="div" /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-login-right" style="none" />[ends tags="div" /]
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
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur.. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url][br /][br /]
							
							Le nom Joomla!® est utilisé sous license limitée de Open Source Matters, le propriétaire mondial de la marque de commerce.[br /]
							Alexon Balangue n'est ni affilié à Open Source Matters ou au projet Joomla!® ni approuvé par eux.
						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top hidden-lg-up' /]
			[url class="btn btn-primary page-scroll" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
	<?php break; case 'boostrap4-component': ?>
	[nav class="navbar fixed-top navbar-toggleable-md navbar-light" id="mainNav"]
		[begins tags='button' class='navbar-toggler navbar-toggler-right' more='type="button" data-toggle="collapse" data-target="#navbarMenu" aria-controls="navbarMenu" aria-expanded="false" aria-label="Toggle navigation"' /]
            Menu [fa name='bars' /]
        [ends tags='button' /]
        [begins tags='div' class='container' /]
            [a class="navbar-brand" href="#page-top" mdataprop="name"]<?php echo $sitename; ?>[/a]
				[begins tags="div" class="collapse navbar-collapse" id="navbarMenu" /]
					<?php if ($this->countModules('cvstart_menu')) : ?>
						<jdoc:include type="modules" name="cvstart_menu" style="none" />
					<?php endif; ?>			
				[ends tags="div" /]
			[ends tags="div" /]
		[/nav]
			[header class="masthead"]
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
						[begins tags="div" class="<?php echo $boostrap4_sizes_left; ?>" /]
							<jdoc:include type="modules" name="sidebar-left" style="nones" />
						[ends tags="div" /] 
						<?php endif; ?>
						[begins tags="div" class="<?php echo $boostrap4_sizes_body; ?>" /]
							<jdoc:include type="message" />
							<jdoc:include type="component" />
							<jdoc:include type="modules" name="bs3-breadcrumb" style="nones" />
						[ends tags="div" /] 
						<?php if ($this->countModules('sidebar-right')) : ?>
						[begins tags="div" class="<?php echo $boostrap4_sizes_right; ?>" /]
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
						
						<jdoc:include type="modules" name="bs3-translator" style="none" />
					[ends tags="div" /] 
				[ends tags="div" /] 
			[/section]	
		<?php endif; ?>	                
		<?php if ($this->countModules('bs3-login-left') && $this->countModules('bs3-login-right')) : ?>
			[section id="logs"]
				[begins tags='div' class='container text-center' /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-12 col-md-12 col-lg-12 text-center' /]
							[h2 css='itemprop="headline"']<?php echo JText::_('TPL_CVSTART_CONNEXION_HOME'); ?>[/h2]
							[hr class="star-primary" /]
						[ends tags="div" /]
					[ends tags="div" /]
					[begins tags='div' class='row' /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-login-left" style="none" />[ends tags="div" /]
						[begins tags='div' class='col-xs-12 col-sm-6 col-md-6 col-lg-6' /]<jdoc:include type="modules" name="bs3-login-right" style="none" />[ends tags="div" /]
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
							<span itemprop="copyrightHolder">&copy; <a href="<?php echo JURI::base(); ?>"><?php echo $sitename; ?></a></span> - <span itemprop="copyrightYear"><?php echo date('Y'); ?></span> - Toute reproduction interdite sans l'autorisation de l'auteur. - Conception par [url href="//www.AlexonBalangue.me" target="_top"]www.AlexonBalangue.me[/url] et WebDesigner par  [url href="//www.startboostrap.com" target="_top"]www.Startboostrap.com[/url][br /][br /]
							
							Le nom Joomla!® est utilisé sous license limitée de Open Source Matters, le propriétaire mondial de la marque de commerce.[br /]
							Alexon Balangue n'est ni affilié à Open Source Matters ou au projet Joomla!® ni approuvé par eux.

						[ends tags="div" /]	
					[ends tags="div" /]	
				[ends tags="div" /]	
			[ends tags="div" /]
		[/footer]
		[begins tags='div' class='scroll-top hidden-lg-up' /]
			[url class="btn btn-primary page-scroll" href="#page-top"][fa name="chevron-up" /][/url]
		[ends tags="div" /]
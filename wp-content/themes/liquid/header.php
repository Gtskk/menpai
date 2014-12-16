<?php echo get_option('plugin_error'); ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<title><?php wp_title('|', true, 'right'); ?></title>
    <meta charset="<?php bloginfo( 'charset' ); ?>" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
	
	<?php if(of_get_option( 'custom_favicon')!='') {?>
	<link rel="shortcut icon" href="<?php echo of_get_option( 'custom_favicon'); ?>">
	<?php } else { ?>
    <link rel="shortcut icon" href="<?php echo THEME_URI; ?>assets/images/favicon.ico">
    <?php }?>
	<?php wp_head();?>
	</head>
	<body <?php body_class(); ?>>
    <div id="wrapper">
      <header id="masthead" role="banner" itemscope="itemscope" itemtype="http://schema.org/WPHeader">
         <div class="prl-container">
         	   <?php if(of_get_option( 'custom_logo')!=''){?>	
			   <a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo of_get_option( 'custom_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
               <?php } else { ?>
           	   <a id="logo" href="<?php echo home_url(); ?>" title="<?php bloginfo('name'); ?>"><img src="<?php echo THEME_URI; ?>assets/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>	    
    		   <?php } ?>	           
               <span class="slogan"><?php bloginfo('description'); ?></span>
         </div>
         <!-- .container -->
      </header>
      <!-- #masthead -->
      
      <div id="navbar" class="navbar navbar-main" role="navigation">
         <div class="prl-container textcenter">
            <div class="navbar-btn floatleft">
               <a href="<?php echo home_url(); ?>" class="navbar-toggle navbar-toggle-default"><span class="navbar-toggle-text"><?php echo esc_html(of_get_option('nav_label'));?></span></a>
			   <a href="#" class="navbar-toggle navbar-toggle-mobile"></a>
               <?php
				if ( has_nav_menu( 'main_nav' ) ) :
					$args = array (
						'theme_location' => 'main_nav',
						'container_class' => 'prl-navbar',
						'container_id' => 'nav-vertical',
						'menu_class' => 'sf-menu sf-vertical',
						'menu_id' => 'main-nav',
						'depth' => 4,
						'fallback_cb' => false
					 );
					wp_nav_menu($args);
				 else:
				 ?>
                 <p class="menu_note"><?php printf(__('Go to <a href="%s" target="_blank">Admin Menus</a> and define your menus', 'presslayer'), admin_url().'nav-menus.php'); ?></p>
				 <?php endif; ?>
            </div>
            <div class="navbar-social floatleft">
                <?php 
				$icons = of_get_option('nav_icons');
				if($icons && is_array($icons)):
				foreach($icons as $icon){
				$icon_class = str_replace('|',' ', $icon['icon']);
				?>
				<a href="<?php echo esc_url($icon['url']);?>" title="<?php echo esc_attr($icon['title']);?>" target="_blank"><i class="<?php echo $icon_class;?> fa-lg"></i></a>
				<?php
				}
				endif;
				?>
            </div>
            <form action="<?php echo home_url(); ?>"><span class="navbar-search floatright">
			   	<a id="navbar-toggle-search" class="navbar-toggle navbar-toggle-search floatright" href="#" ></a>
                  <input name="s" type="text" placeholder="<?php _e('Search','presslayer');?> ..." class="navbar-search-input" />
            </span> </form>
            <?php if(of_get_option('contact_page')!=''){?>
        <a class="navbar-toggle navbar-toggle-mail floatright" href="<?php echo get_permalink(of_get_option('contact_page')); ?>"></a><?php }?>
            <?php if(of_get_option( 'custom_logo')!=''){?>
            <a href="<?php echo home_url(); ?>" id="logo-mobile"><img src="<?php echo of_get_option( 'custom_logo'); ?>" alt="<?php bloginfo('name'); ?>" /></a>
            <?php }else {?>
            <a href="<?php echo home_url(); ?>" id="logo-mobile"><img src="<?php echo THEME_URI; ?>assets/images/logo.png" alt="<?php bloginfo('name'); ?>" /></a>    
    		   <?php } ?>
         </div>
      </div>
      <!-- #navbar -->
      <main id="main" role="main" itemprop="mainContentOfPage" itemscope="itemscope" itemtype="http://schema.org/Blog">
      	
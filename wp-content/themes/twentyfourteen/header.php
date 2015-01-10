<?php
/**
 * The Header for our theme
 *
 * Displays all of the <head> section and everything up till <div id="main">
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=7" />
	<title><?php wp_title( '|', true, 'right' ); ?></title>
	<link href="<?php echo get_stylesheet_uri();?>" rel="stylesheet" type="text/css" />
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/flexslider.css" />
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-latest.min.js" type="text/javascript"></script>
	<script src="<?php echo get_template_directory_uri(); ?>/js/masonry.pkgd.min.js" type="text/javascript"></script>

	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery.flexslider-min.js" type="text/javascript"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$('.flexslider').flexslider({
			    animation: "slide",
			    animationLoop: true
			});
		});
	</script>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dialog.css"></link>
	<link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/css/dialog-sandra.css"></link>
	<script type="text/javascript" src="<?php echo get_template_directory_uri(); ?>/js/modernizr.custom.js"></script>
	<?php //wp_head(); ?>
	</head>

	<body<?php if(is_page(2)):?> class="app"<?php elseif(is_category(10) or is_single()):?> style="background-color:#f0f0f0;"<?php endif;?>>
		<div id="header">
		   	<div class="wrap clear">
			   	<div class="logo">
			   		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/i_03.jpg" alt=""></a>
			   	</div>

			    <?php 
			    	wp_nav_menu( array( 
			    		'theme_location' => 'primary',
			    		'container' => '',
			    		'menu_class' => 'menu' 
			    	) ); 
			    ?>
		    
		   	</div>
		</div>
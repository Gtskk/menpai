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
	<script src="<?php echo get_template_directory_uri(); ?>/js/jquery-1.8.2.min.js" type="text/javascript"></script>
	<?php //wp_head(); ?>
	</head>

	<body>
		<div id="header">
		   	<div class="wrap clear">
			   	<div class="logo">
			   		<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><img src="<?php echo get_template_directory_uri(); ?>/images/i_03.jpg" alt=""></a>
			   	</div>
		    
			   	<ul class="menu">      
			    	<li><a class="active"  href="">首页</a></li>
			    	<li><a href="">最新活动</a></li>
			    	<li><a href="">精选社群</a></li>
			    	<li><a href="">门派APP</a></li>                                 
			    </ul>

			    <?php wp_nav_menu( array( 'theme_location' => 'primary', 'menu_class' => 'nav-menu' ) ); ?>
		    
		   	</div>
		</div>
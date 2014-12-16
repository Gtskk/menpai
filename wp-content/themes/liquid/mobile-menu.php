<script type="text/javascript">
	 jQuery(function ($) {
		$('#mobile-nav').infinitypush({
			openingspeed: 300,
			closingspeed: 300,
			autoScroll	: false,
			navButton	: '.navbar-toggle-mobile'
		}).jMMenu();
	});
</script>
<nav id="mobile-nav" class="mobile-nav">
	<?php
    if ( has_nav_menu( 'mobile_nav' ) ) :
        wp_nav_menu( array (
            'theme_location' => 'mobile_nav',
            'container' => false,
            'menu_class' => 'nav-list',
            'menu_id' => 'nav-list',
            'depth' => 4,
            'fallback_cb' => false
         ));
     else:
        echo '<div class="message warning"><i class="icon-warning-sign"></i>' . __( 'Define your site main menu', 'presslayer' ) . '</div>';
     endif;
    ?>
</nav>
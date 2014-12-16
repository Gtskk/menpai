</main><!-- #main -->	
    <footer id="footer" role="contentinfo" itemscope="itemscope" itemtype="http://schema.org/WPFooter">
        <?php if(of_get_option('footer_widget')==true):?>
        <div class="footer-widget">
            <div class="prl-container">
                <div class="prl-grid">
                    <?php for($i=1;$i<=3;$i++){?>
                    <div class="prl-span-4">
                        <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar('footer_'.$i) ) : ?><?php endif; ?>
                    </div>
                    <?php } ?>
                </div><!-- .prl-grid-->
                
            </div><!-- .container-->
        </div>
        <?php endif;?>
        <div class="copyright">
            <div class="prl-container">
                <div class="floatleft">&copy; <?php echo date('Y');?> <?php _e('by','presslayer');?> <a href="<?php echo home_url();?>"><?php bloginfo('name');?></a> -  <?php bloginfo('description');?></div>
                <div class="floatright">Designed by <a href="http://presslayer.com/" target="_blank">PressLayer</a></div>
            </div>
        </div>
    </footer>
 <?php get_template_part('mobile-menu'); ?>   
</div> <!--#wrapper -->
	<?php if(of_get_option('sticky_nav') == true):?>
	<script>
	// Sticky navigation
	(function ($){	
		var nav = $('#navbar'),
			scrolled = false,
			headerHeight = $('#main').offset().top;
		$(window).scroll(function () {
			if (headerHeight < $(window).scrollTop() && !scrolled) {
				nav.stop().addClass('navbar-sticky');
				scrolled = true;
			} else if (headerHeight > $(window).scrollTop() && scrolled) {
				nav.removeClass('navbar-sticky');
				scrolled = false;    
			}
		});

	})(jQuery);	
	</script>
	<?php endif;?>
	<?php if(of_get_option('switcher')== true ) require_once( locate_template ('_switcher/index.php')); ?>
	<a href="#" id="toTop"><i class="fa fa-long-arrow-up"></i></a>
	<?php if(of_get_option('tracking_code')!='') echo stripslashes(of_get_option('tracking_code')); ?>
    <?php wp_footer();?>
</body>
</html>

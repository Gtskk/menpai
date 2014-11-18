<?php get_header(); 
$site_layout = of_get_option('site_layout');
if(rwmb_meta( 'tu_post_layout')!='default') $site_layout = rwmb_meta( 'tu_post_layout');
$sidebar = 'sidebar';
if(rwmb_meta( 'tu_sidebar')!='sidebar' && rwmb_meta( 'tu_sidebar')!='') $sidebar = rwmb_meta( 'tu_sidebar');
?>
<div class="prl-container">
    <div class="prl-grid">
        <section class="<?php if($site_layout == 'no_sidebar') echo 'prl-span-12'; else echo 'prl-span-8' ;?><?php if($site_layout == 'left_sidebar') echo ' prl-span-flip';?> single-content clearfix">
        	<?php do_action('before_post_content'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post();
				$format = get_post_format();
				get_template_part( 'content', $format );							
				if( $format == '' || $format == 'video' || $format == 'audio' || $format == 'gallery' || $format == 'aside' ) {
				get_template_part( 'content', 'bottom' ); 
				}
				?>
            <?php do_action('after_post_content'); ?>    
            <?php if(of_get_option('related_posts_box')==true) get_template_part( 'related-post' );?>
			<?php if(of_get_option('next_previous')==true):?>
            <div class="w-box w-box-padd tu-panel prev-next-posts clearfix">
                <?php previous_post_link( '%link', '<i class="fa fa-long-arrow-left"></i> ' . __('Previous post','presslayer')); ?>
                <?php next_post_link( '%link', __('Next post','presslayer').' <i class="fa fa-long-arrow-right"></i>'); ?>
            </div>
            <?php endif;?>
            <?php comments_template(); ?>	
			<?php endwhile; endif; // End main loop ?>
            
        </section>
        <?php if($site_layout != 'no_sidebar'):?>
        <aside id="sidebar" class="prl-span-4 clearfix">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?><?php endif; ?>
        </aside>
        <?php endif;?>
    </div><!--.prl-grid -->
    
</div><!-- .container-->
<?php get_footer(); ?>
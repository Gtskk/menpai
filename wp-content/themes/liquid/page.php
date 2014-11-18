<?php get_header(); 
$site_layout = of_get_option('site_layout');
if(rwmb_meta( 'tu_post_layout')!='default') $site_layout = rwmb_meta( 'tu_post_layout');
$sidebar = 'sidebar';
if(rwmb_meta( 'tu_sidebar')!='sidebar'  && rwmb_meta( 'tu_sidebar')!='' ) $sidebar = rwmb_meta( 'tu_sidebar');
if($site_layout == 'no_sidebar') $img_size = 'full-size';
else $img_size = 'blog-large';
?>
<div class="prl-container">
    <div class="prl-grid">
        <section class="<?php if($site_layout == 'no_sidebar') echo 'prl-span-12'; else echo 'prl-span-8' ;?><?php if($site_layout == 'left_sidebar') echo ' prl-span-flip';?> clearfix">
        	<?php do_action('before_papge_content'); ?>
			<?php if (have_posts()) : while (have_posts()) : the_post();  ?>
           	<?php if(rwmb_meta( 'tu_page_content_box')!='hide') echo '<div class="w-box w-box-padd tu-panel clearfix">';?>
            	<?php  
				$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full-size');
				echo tu_post_thumb('class=popup-link-image&link='.$thumb[0].'&format=image&img_size='.$img_size); ?>
				<?php if(rwmb_meta( 'tu_page_title')!='hide'){?><h1 itemprop="name"><?php the_title(); ?></h1><?php }?>
				<?php the_content();?>
            <?php if(rwmb_meta( 'tu_page_content_box')!='hide') echo '</div>';?>
			<?php endwhile; endif; // End main loop ?>
            <?php do_action('after_papge_content'); ?>
        </section>
        <?php if($site_layout != 'no_sidebar'):?>
        <aside id="sidebar" class="prl-span-4 clearfix">
            <?php if ( !function_exists('dynamic_sidebar') || !dynamic_sidebar($sidebar) ) : ?><?php endif; ?>
        </aside>
        <?php endif;?>
    </div><!--.prl-grid -->
    
</div><!-- .container-->
<?php get_footer(); ?>
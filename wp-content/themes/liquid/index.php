<?php get_header(); ?>
<?php 
$site_layout = 'right_sidebar';
if(of_get_option('site_layout')!='') $site_layout = of_get_option('site_layout');?>
<div class="prl-container">
	<?php do_action('before_index_page'); ?>
    <div class="prl-grid">
        <section class="<?php if($site_layout == 'no_sidebar') echo 'prl-span-12'; else echo 'prl-span-8' ;?><?php if($site_layout == 'left_sidebar') echo ' prl-span-flip';?> clearfix">
			<?php if (have_posts()) : ?>
            <?php /* If this is a category archive */ if (is_category()) { ?>
            <div class="prl-article w-box w-box-inner blog-heading">
                <h4 class="prl-category-title"><?php _e('Archive for the','presslayer');?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e('Category','presslayer');?></h4>
            </div>
          <?php /* If this is a tag archive */ } elseif( is_tag() ) { ?>
            <div class="prl-article w-box w-box-inner blog-heading">
                <h4 class="prl-category-title"><?php _e('Posts Tagged','presslayer');?> &#8216;<?php single_tag_title(); ?>&#8217;</h4>
            </div>
          <?php /* If this is a daily archive */ } elseif (is_day()) { ?>
            <div class="prl-article w-box w-box-inner blog-heading">
                <h4 class="prl-category-title"><?php _e('Archive for','presslayer');?> <?php the_time('F jS, Y'); ?></h4>
            </div>
          <?php /* If this is a monthly archive */ } elseif (is_month()) { ?>
          	<div class="prl-article w-box w-box-inner blog-heading">
                <h4 class="prl-category-title"><?php _e('Archive for','presslayer');?> <?php the_time('F, Y'); ?></h4>
            </div>
          <?php /* If this is a yearly archive */ } elseif (is_year()) { ?>
          	<div class="prl-article w-box w-box-inner blog-heading">
                <h4 class="prl-category-title"><?php _e('Archive for','presslayer');?> <?php the_time('Y'); ?></h4>
            </div>
          <?php /* If this is an author archive */ } elseif (is_author()) { ?>
           <div class="prl-article w-box w-box-inner blog-heading">
              <h4 class="prl-category-title"><?php _e('Author Archive','presslayer');?></h4>
           </div>
          <?php } elseif (is_search()){ ?>
          <div class="prl-article w-box w-box-inner blog-heading">
              <h4 class="prl-category-title"><?php _e('Search Results','presslayer');?></h4>
           </div>
          <?php } elseif (is_home()){ ?>
          <div class="prl-article w-box w-box-inner blog-heading">
              <h4 class="prl-category-title"><?php _e('Recent Posts','presslayer');?></h4>
           </div>
          <?php } ?>
            <?php 		
			while (have_posts()) : the_post();
				$format = get_post_format();
				echo '<div class="post-entry">';
				get_template_part( 'content', $format ); //get the post content  
				if( $format == '' || $format == 'video' || $format == 'audio' || $format == 'gallery' ) {
					get_template_part( 'content', 'bottom' ); 
				}
				echo '</div>';
			endwhile; ?>
            <?php endif; // End main loop ?>
			<?php if(function_exists('wp_pagenavi')) wp_pagenavi(); ?>
        </section>
        <?php if($site_layout != 'no_sidebar'):?>
        <aside id="sidebar" class="prl-span-4 clearfix">
            <?php get_sidebar();?>
        </aside>
        <?php endif;?>
    </div><!--.prl-grid -->
    <?php do_action('after_index_page'); ?>
</div><!-- .container-->
<?php get_footer(); ?>
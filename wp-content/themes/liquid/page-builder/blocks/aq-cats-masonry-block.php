<?php
class AQ_Cats_Masonry_Block extends AQ_Block {
	function __construct() {
		$block_options = array(
			'name' => __('Cats - Masonry', 'aqpb-l10n'),
			'size' => 'span12',
		);
		parent::__construct('aq_cats_masonry_block', $block_options);
	}
	
	function update($new_instance, $old_instance) {
		return stripslashes_deep($new_instance);
	}
	
	function form($instance) {
		global $cats_arr, $orderby_arr, $order_arr;
		$defaults = array(
			'title'   => 'Masonry',
			'cats' => 0,
			'num_excerpt' => 25,
			'post_count' => 3,
			'width' => 300,
			'custom_title' => false
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="controls half">
        	<h4><?php _e('Title (optional)','presslayer');?></h4>
            <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </div>
        
        <div class="controls half last">           
            <h4><?php _e('Show Custom Title','presslayer');?></h4>
            <label><?php echo aq_field_checkbox('custom_title', $block_id, $custom_title); ?> <?php _e('Show custom title for blog.','presslayer');?></label>
        </div>
        
        <div class="controls half">
        	<h4><?php _e('Categories','presslayer');?></h4>
            <?php echo field_multiselect('cats', $block_id, $cats_arr, $cats) ?>       
        	<p><?php _e('Leave blank to show all categories.','presslayer');?></p>
        </div>
        
        <div class="controls half last">
			<h4><?php _e('Column width','presslayer');?></h4>
			<?php echo field_select('width', $block_id, array('200' => 'Small','300'=>'Medium','450'=>'Large'), $width) ?>
		</div>
        
        <div class="controls half">
			<h4>Length of excerpt</h4>
			<?php echo aq_field_input('num_excerpt', $block_id, $num_excerpt); ?>
		</div>

        <div class="controls half last">
            <h4><?php _e('Posts count','presslayer');?></h4>
            <?php echo aq_field_input('post_count', $block_id, $post_count); ?>
            <p><?php _e('Set number of posts for each category.','presslayer');?></p>
        </div>
        
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		if(!isset($cats)) $cats = 0;
		
		if( $cats == 0 ) {
			$categories_obj = get_categories('orderby=id&order=asc');
			foreach ($categories_obj as $cat) {
				$list_cats[] =  $cat->cat_ID;
			}
			
		} else {
			$list_cats = $cats;
		}
		
		if($custom_title == true and $title!='') {?>
        <div class="prl-article w-box blog-heading">
            <div class="w-box-inner">
                <h4 class="prl-category-title"><?php echo esc_html($title);?></h4>
            </div>
        </div>
        <?php }
		
		if($list_cats!='' && is_array($list_cats)):?>
        <div class="tu-container">
		<?php
		foreach($list_cats as $cat_ID){
		?>
        	<div class="post-entry post-item post-cats">
            	<div class="post-cats-head">
            	<h3 class="widget-title"><span><a href="<?php echo get_category_link($cat_ID);?>" ><?php echo esc_html(get_cat_name($cat_ID));?></a></span></h3>
                </div>
				 <?php
				 $args = array( 'posts_per_page' => $post_count );
				 $args['cat'] =  $cat_ID;
				 
				 // Formats
				$tax_query=array();
				$tax_query = array(
								array(
									'taxonomy' => 'post_format',
									'field'    => 'slug',
									'terms'    => array('post-format-aside','post-format-link','post-format-quote'),
									'operator' => 'NOT IN'
								)
						  );
				$args['tax_query'] =  $tax_query;		  
				
				 
				 $new_query = new WP_Query($args);
				 $count = 0;
				 ?>
                 <?php while ( $new_query->have_posts() ) : $new_query->the_post();?>
				 <?php
				 if($count < 1){ 
					 global $more; $more = 0;
					 $format = get_post_format();
					 if($format!='') include(locate_template('content-'.$format.'.php'));
					 else include(locate_template('content.php'));
					 if( $format == '' || $format == 'video' || $format == 'audio' || $format == 'gallery' )  get_template_part( 'content', 'bottom' );
				 } else {?>
                     <div class="w-box small-post cleafix">
                         <span class="small-post-thumb"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url" class="small-thumb"><?php echo the_post_thumbnail(); ?></a></span>
                         <h5 itemprop="headline"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url"><?php the_title(); ?></a></h5>
                         <?php tu_post_meta('author=0&cat=0&class=no-underline');?>
                         <div class="clear"></div>
                     </div>
				 <?php 
				 }
				 $count++;
				 ?>
                 <?php endwhile; wp_reset_postdata(); ?>
			 </div><!-- .post-item -->
        <?php }?>
        
        </div><!-- .tu-container -->
        <?php endif;?>
		  <script type="text/javascript">
			jQuery(function($) {	
				var $container = $('.tu-container');
				var gutter = 20;
				var min_width = <?php echo $width;?>;
				$container.imagesLoaded( function(){
					$container.masonry({
						itemSelector : '.post-item',
						gutterWidth: gutter,
						isAnimated: true,
						columnWidth: function( containerWidth ) {
							var box_width = (((containerWidth - 2*gutter)/3) | 0) ;
							if (box_width < min_width) {box_width = (((containerWidth - gutter)/2) | 0);}
							if (box_width < min_width) {box_width = containerWidth;}
							$('.post-item').width(box_width);
							return box_width;
						}
					}); 
				});
				
			});
			
			</script>
			<?php 
			
	}
	
}

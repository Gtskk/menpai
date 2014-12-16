<?php
class AQ_Blog_Block extends AQ_Block {
	function __construct() {
		$block_options = array(
			'name' => __('Blog', 'aqpb-l10n'),
			'size' => 'span12',
		);
		parent::__construct('aq_blog_block', $block_options);
	}
	
	function update($new_instance, $old_instance) {
		return stripslashes_deep($new_instance);
	}
	
	function form($instance) {
		global $cats_arr, $orderby_arr, $order_arr;
		$defaults = array(
			'title'   => 'Masonry',
			'blog_title' => 'none',
			'cats' => 0,
			'type' => 'masonry',
			'post_formats' => '',
			'post_formats_oper' => '',
			'include' => '',
			'exclude' => '',
			'num_excerpt' => 25,
			'post_count' => 10,
			'orderby' => 'ID',
			'order_p' => 'DESC',
			'width' => 300,
			'pagination' => 'infinite_btn'
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		<div class="controls half">
        	<h4><?php _e('Title (optional)','presslayer');?></h4>
            <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </div>
        
        <div class="controls half last">           
            <h4><?php _e('Blog Title','presslayer');?></h4>
            <label><?php echo field_select('blog_title', $block_id, array('none'=>'None','title'=>'Custom title','fcat'=>'First Category','allcat'=>'All Selected Categories'), $blog_title) ?></label>
        </div>
        
        <div class="controls half">
        	<h4><?php _e('Show in Categories','presslayer');?></h4>
            <?php echo field_multiselect('cats', $block_id, $cats_arr, $cats) ?>       
        	<p><?php _e('Leave blank to show in all categories.','presslayer');?></p>
        </div>
        
        <div class="controls half last">
        	<h4><?php _e('Type','presslayer');?></h4>
            <?php echo field_select('type', $block_id, array('masonry'=>'Masonry','blog'=>'Blog'), $type) ?>       
        	<p><?php _e('Select your type for blog.','presslayer');?></p>
        </div>
        
        <?php
		$formats_arr = array(); 
		$formats = get_theme_support( 'post-formats' );
		foreach ($formats[0] as $format) {
			$formats_arr[$format] = ucwords($format);
		}
		?>
        <div class="controls half">
        	<h4><?php _e('Post Formats','presslayer');?></h4>
            <?php echo field_multiselect('post_formats', $block_id, $formats_arr, $post_formats) ?>       
        	<p><?php _e('Leave blank to show in all formats.','presslayer');?></p>
        </div>
        
        <div class="controls half last">
        	<h4><?php _e('Post Formats Operator','presslayer');?></h4>
            <?php echo field_select('post_formats_oper', $block_id, array('IN'=>'IN','NOT IN'=>'NOT IN'), $post_formats_oper) ?>       
        	<p><?php _e('Select the post formats operator.','presslayer');?></p>
        </div>
        
        <div class="controls half">
        	<h4><?php _e('Include posts','presslayer');?></h4>
            <?php echo aq_field_input('include', $block_id, $include) ?>
        	<p><?php _e('Enter post IDs, separated by commas.','presslayer');?></p>
        </div>
        <div class="controls half last">
            <h4><?php _e('Exclude posts','presslayer');?></h4>
            <?php echo aq_field_input('exclude', $block_id, $exclude) ?>
            <p><?php _e('Enter post IDs, separated by commas.','presslayer');?></p>
		</div>
        
        <div class="controls half orderby_control">
        	<h4><?php _e('Order by','presslayer');?></h4>
            <?php echo field_select('orderby', $block_id, $orderby_arr, $orderby); ?>  
        </div>
        
        <div class="controls half last order_control">
            <h4><?php _e('Order','presslayer');?></h4>
            <?php echo field_select('order_p', $block_id, $order_arr, $order_p); ?>
        </div>
        
        <script type="text/javascript">
          (function ($) {
			  $('.orderby_control').find('select.select').on('change',function() {
			  		$val = $(this).val();
					$order_select = $(this).closest('div.orderby_control').siblings('div.order_control').find('select.select');
					if( $val == 'post__in' || $val == 'rand'){
						$order_select.prop( "disabled", true ).trigger("chosen:updated");;
					}else{
						$order_select.prop( "disabled", false ).trigger("chosen:updated");;
					}
			  });
			  <?php if($orderby == 'rand' || $orderby == 'post__in'){?>
			  $order_select = $('div.order_control').find('select.select');
			  $order_select.prop( "disabled", true ).trigger("chosen:updated");
			  <?php }?>
            })(jQuery);
        </script>
        
        <div class="controls half">
            <h4><?php _e('Posts count','presslayer');?></h4>
            <?php echo aq_field_input('post_count', $block_id, $post_count); ?>
            <p><?php printf(__('Leave blank to use <a href="%s" target="_blank">"Blog pages show at most"</a>. Set "-1" to show all posts.', 'presslayer'), admin_url().'options-reading.php'); ?></p>
        </div>
        
        <div class="controls half last">
			<h4><?php _e('Length of excerpt','presslayer');?></h4>
			<?php echo aq_field_input('num_excerpt', $block_id, $num_excerpt); ?>
            <p><?php _e('Choose number of words for Post Excerpt.','presslayer');?></p>
		</div>
        
        <div class="controls half">
			<h4>Column width</h4>
			<?php echo field_select('width', $block_id, array('200' => 'Small','300'=>'Medium','450'=>'Large'), $width) ?>
		</div>
        
        <div class="controls half last">
			<h4>Pagination</h4>
			<?php echo field_select('pagination', $block_id, array('page' => 'Page (1|2|3|..)', 'infinite_btn'=>'Infinite with button', 'infinite_auto'=>'Infinite auto', 'none'=>'None'), $pagination) ?>
		</div>
        
		<?php
	}
	
	function block($instance) {
		extract($instance);
		
		if(is_front_page()){
			$current_page_num = get_query_var('page') ? get_query_var('page') : 1;
		}else{
			$current_page_num = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
		}
		
		$args = array( 'posts_per_page' => $post_count );
		
		
		// Categories
		if(isset($cats)) $args['category__in'] =  $cats;
		
		// Formats
		$tax_query=array();
		if( isset($post_formats) && $post_formats!=''){

			foreach ($post_formats as &$format)
   			$format = 'post-format-'.$format;
			$operator = $post_formats_oper;
			$tax_query = array(
							array(
								'taxonomy' => 'post_format',
								'field'    => 'slug',
								'terms'    => $post_formats,
								'operator' => ''.$operator.''
							)
					  );
			$args['tax_query'] =  $tax_query;		  
		}
		
		// Include & Exclude
		if ($include != '') {
        $include = explode(',', $include);
			$args['post__in'] = $include;
		}
		
		if($exclude!=''){
            $exclude= explode(',',$exclude);
        }
		$args['post__not_in'] = $exclude;
        $args['orderby'] = $orderby;
        $args['order'] = $order_p;
		
		//Page
		$args['paged'] = $current_page_num;
		
		//Init
		$new_query = new WP_Query($args);
		
		// Blog title	
		$blog_head = '';
		switch($blog_title){
			
			case 'title':
				if($title!='') $blog_head = esc_html($title);
			break;
			
			case 'fcat':
				$cat =  (is_array($cats)) ? $cats[0]  : intval($cats);
				if($cat > 0) $blog_head = '<a href="'.get_category_link($cat).'">'. esc_html(get_cat_name($cat)).'</a>';
			break;
			
			case 'allcat':
				if($cats!='' && is_array($cats)){
					$blog_arr = array();
					foreach ($cats as $cat){
						$blog_arr[] = '<a href="'.get_category_link($cat).'">'. esc_html(get_cat_name($cat)).'</a>';
					}
					$blog_head = implode(' - ', $blog_arr);
				}else{
					$blog_head = '';
				}

			break;
			
			default:
				$blog_head = '';
			break;
			
		}
		
		if($blog_head!=''){
		?>
        <div class="prl-article w-box w-box-inner blog-heading">
            <h4 class="prl-category-title"><?php echo $blog_head;?></h4>
        </div>
        <?php
		}
		?>
		 <div class="tu-container">
			<?php while ( $new_query->have_posts() ) : $new_query->the_post();?>
			<div class="post-entry post-item">
				 <?php 
				 global $more; $more = 0;
				 $format = get_post_format();
				 if($format!='') include(locate_template('content-'.$format.'.php'));
				 else include(locate_template('content.php'));
				 
				 if( $format == '' || $format == 'video' || $format == 'audio' || $format == 'gallery' )
				 get_template_part( 'content', 'bottom' ); 
				 ?>
                
			 </div><!-- .post-item -->
			 <?php endwhile; ?>
		  </div><!-- .tu-container -->
		 
		  <script type="text/javascript">
			jQuery(function($) {	
				var $container = $('.tu-container');
				<?php if($type=='masonry'):?>
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
				<?php endif; // type=masonry?> 
				<?php if($pagination == 'infinite_btn' || $pagination == 'infinite_auto'){?>
				$("#page-nav a").hide();
				$container.infinitescroll({
						navSelector  : '#page-nav', 
						nextSelector : '#page-nav a',
						itemSelector : '.post-item',
						loading: {
							selector: '#infscr-load',
							msgText  : '<span class="bounce1"></span><span class="bounce2"></span><span class="bounce3"></span>',   
							finishedMsg: '<?php _e('No more posts to load','presslayer');?>.'
						}
					}, 
					
					function( newElements ) {
						var $newElems = $( newElements ).css({ opacity: 0 });
						$newElems.imagesLoaded(function(){
							$newElems.animate({ opacity: 1 });
							
							//Flexslider
							$('.small-flexslider').flexslider({
								selector: ".tu_slides > li", 
								animation: "fade",
								//smoothHeight: true,
								controlNav: false,
								directionNav: true,
								slideshow: true,				
							});
							
							$container.append( $newElems ).masonry( 'reload' );
							$('#page-nav').show();
							
							// init
							$('.popup-link-video').magnificPopup({type:'iframe'});
							$('.popup-link-image').magnificPopup({
								type: 'image',
								fixedContentPos: true,
								mainClass: 'mfp-no-margins mfp-with-zoom', 
								image: {
								verticalFit: true
								},
								zoom: {
									enabled: true,
									duration: 300
								},
								gallery:{
									enabled:true
								}
							});
							
							$("body").fitVids();
							
							
							
							// init end
						});
				});
				
				<?php if($pagination == 'infinite_btn'){?>
				$("#page-nav a").show();
				// kill scroll binding
				$(window).unbind('.infscr');
			
				$("#page-nav a").on('click',function(){
					$container.infinitescroll('retrieve');
					return false;
				});
			
				// remove the paginator when we're done.
				$(document).ajaxError(function(e,xhr,opt){
				  if (xhr.status == 404) $('#page-nav a').remove();
				});

				<?php } } ?>
				
			});
			
			</script>
            
			
			<?php if($pagination == 'page'){?>
            	<?php if ( function_exists( 'wp_pagenavi' ) ) wp_pagenavi(array( 'query' => $new_query )); ?>
			<?php } else {?>
				<div id="page-nav" class="page-nav">
                <?php next_posts_link(__('Load More','presslayer'), $new_query->max_num_pages) ?>
                </div>              
                <div id="infscr-load"></div>
			<?php }?>
			<?php 
			wp_reset_postdata();
	}
	
}

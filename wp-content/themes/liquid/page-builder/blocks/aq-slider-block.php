<?php
class AQ_Slider_Block extends AQ_Block {
	
	function __construct() {
		$block_options = array(
			'name' => __('Slider', 'aqpb-l10n'),
			'size' => 'span12'
		);
		parent::__construct('aq_slider_block', $block_options);
	}
	
	function update($new_instance, $old_instance) {
		return stripslashes_deep($new_instance);
	}
	
	function form($instance) {
		global $cats_arr, $orderby_arr, $order_arr;
		
		$defaults = array(
			'cats' => 0,
			'post_formats' => '',
			'post_formats_oper'=>'',
			'include' => '',
			'exclude' => '',
			'post_count' => 5,
			'orderby' => 'ID',
			'order_p' => 'DESC',
			'slideshow' => true,
			'controlnav' => true,
			'animation' => 'fade',
			'direction' => 'horizontal',
			'slideshow_speed' => 7000,
			'animation_speed' => 600,
			'show_video' => false,
			'show_box' => true
			
		);
		$instance = wp_parse_args($instance, $defaults);
		extract($instance);
		
		?>
		
        <div class="controls half">
        	<h4><?php _e('Title (optional)','presslayer');?></h4>
            <?php echo aq_field_input('title', $block_id, $title, $size = 'full') ?>
        </div>
        
        <div class="controls half last checkbox">           
            <h4><?php _e('Show Box','presslayer');?></h4>
            <label><?php echo aq_field_checkbox('show_box', $block_id, $show_box); ?> <?php _e('Wrap slider by a white box.','presslayer');?></label>
            
        </div>
        <div class="clear"></div>
        <div class="controls">
        	<h4><?php _e('Show in Categories','presslayer');?></h4>
            <?php echo field_multiselect('cats', $block_id, $cats_arr, $cats) ?>       
        	<p><?php _e('Leave blank to show in all categories.','presslayer');?></p>
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
           jQuery(function ($) {
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
            });
        </script>
        
        <div class="controls checkbox half">
        	<h4><?php _e('Slideshow','presslayer');?></h4>
            <label><?php echo aq_field_checkbox('slideshow', $block_id, $slideshow); ?> <?php _e('Check this box to enable automatic slideshow for your slides.','presslayer');?></label>
        </div>
        
        <div class="controls checkbox half last">
            <h4><?php _e('ControlNav','presslayer');?></h4>
            <label><?php echo aq_field_checkbox('controlnav', $block_id, $controlnav); ?> <?php _e('Check this box to enable the control navigation.','presslayer');?></label>
        </div>
        
        <div class="controls checkbox half">
            <h4><?php _e('Show Video','presslayer');?></h4>
            <label><?php echo aq_field_checkbox('show_video', $block_id, $show_video); ?> <?php _e('Show video if the post has video.','presslayer');?></label>
        </div>
        
        <div class="controls half last">
            <h4><?php _e('Posts count','presslayer');?></h4>
            <?php echo aq_field_input('post_count', $block_id, $post_count); ?>
        </div>
        
        <div class="controls half">
            <h4><?php _e('Animation','presslayer');?></h4>
             <?php echo field_select('animation', $block_id, array('fade'=>'Fade','slide'=>'Slide'), $animation); ?>  
            <p><?php _e('Select your animation of choice.','presslayer');?></p>
        </div>
        
        <div class="controls half last">
            <h4><?php _e('Direction','presslayer');?></h4>
            <?php echo field_select('direction', $block_id, array('horizontal'=>'Horizontal', 'vertical'=>'Vertical'), $direction); ?>  
            <p><?php _e('Select the direction for your slides.','presslayer');?></p>
        </div>
        
        <div class="controls half">
            <h4><?php _e('SlideShow Speed','presslayer');?></h4>
            <?php echo aq_field_input('slideshow_speed', $block_id, $slideshow_speed); ?>
            <p><?php _e('Enter your preferred slideshow speed in milliseconds.','presslayer');?></p>
        </div>
        
        <div class="controls half last">
            <h4><?php _e('Animation Speed','presslayer');?></h4>
            <?php echo aq_field_input('animation_speed', $block_id, $animation_speed); ?>
            <p><?php _e('Enter your preferred animation speed in milliseconds.','presslayer');?></p>
        </div>
        
        
<?php
	} 
	
	function block($instance) {
		extract($instance);
		
		$args = array( 'posts_per_page' => $post_count );
		
		$args['meta_key'] = '_thumbnail_id';
		
		// Categories
		if(isset($cats)) $args['category__in'] =  $cats;
		
		// Formats
		$tax_query=array();
		if(isset($post_formats) && $post_formats!=''){

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

		$new_query = new WP_Query($args);
		?>
		<div class="primary-slider <?php if($show_box == true) echo 'w-box w-box-padd';?>">
            <div id="slider-<?php echo $template_id.'-'.$order;?>" class="tu_flexslider <?php if($controlnav != true ) echo 'no-controlnav';?>">
              <ul class="tu_slides" >
                <?php while ( $new_query->have_posts() ) : $new_query->the_post();?>
                <li <?php post_class(); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
                <?php 
				if($show_video == true && get_post_meta( get_the_ID(), 'pl_post_video', true )!=''){
				echo wp_oembed_get( get_post_meta( get_the_ID(), 'pl_post_video', true ) );
				}else{  
				if( has_post_thumbnail()):?>
                <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute(''); ?>"><?php echo the_post_thumbnail('blog-index-gallery');?></a>
                <?php endif;?>
                <div class="tu_flex-caption animated"><h3 itemprop="headline"><a href="<?php the_permalink(); ?>" rel="bookmark" itemprop="url" title="<?php the_title_attribute(''); ?>"><?php the_title();?></a> <?php echo get_label_format(get_the_ID());?></h3></div>
                <?php }?>
                </li>
                <?php endwhile; ?>
              </ul>
            </div>
        </div>
        
        <script type="text/javascript">
		  jQuery(function ($) {
			  $('#slider-<?php echo $template_id.'-'.$order;?>').flexslider({
                selector: ".tu_slides > li", 
				animation: "<?php echo $animation;?>",
                direction: "<?php echo $direction;?>",
				controlNav: <?php if($controlnav == true ) echo 'true'; else echo 'false';?>,
				directionNav: true,
				slideshowSpeed: <?php echo esc_attr($slideshow_speed);?>,
				animationSpeed: <?php echo esc_attr($animation_speed);?>,
				slideshow: <?php if($slideshow == true ) echo 'true'; else echo 'false';?>,				
                start: function(slider){
                    $('.tu_flex-caption').animate({"bottom": '0px', 'opacity': 1 }, 500);
                },
                before: function(slider) {
                    $('.tu_flex-caption').animate({"bottom": '-80px', 'opacity': 0 }, 500);
                },
                after: function(slider) {
                    $('.tu_flex-caption').animate({"bottom": '0px', 'opacity': 1 }, 500);
                }
              });
            });
        </script>

		<?php
		wp_reset_postdata();
	}
	
}

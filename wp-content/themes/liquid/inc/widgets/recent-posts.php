<?php
class Recent_Post_Widget extends WP_Widget {
	function __construct() {
        $widget_ops = array('classname' => 'recents-widget', 'description' => __( 'Show latest posts in picture', 'presslayer' ) );
        parent::__construct('recent_post', __( '&raquo; Recent Posts', 'presslayer' ), $widget_ops);
    }
	
	function widget($args, $instance)
	{
		global $theme;
		extract($args);
		
		$title = isset($instance['title']) ? $instance['title'] : '';
		$category = isset($instance['category']) ? $instance['category'] : '';
		$post_count = isset($instance['post_count']) ? $instance['post_count'] : '';
		
		echo $before_widget;
		?>
		
		<!-- BEGIN WIDGET -->
		<?php
		if($category > 0){
			echo $before_title.'<a href="'.get_category_link( $category ).'">'.get_the_category_by_ID( $category).'</a>'.$after_title;
		}else{
			if($title) echo $before_title.$title.$after_title;
		}
		?>
		<ul class="prl-list-line">
			<?php
			$args = array(
				'post_type' => 'post',
				'showposts' => $post_count,
				'cat' => $category
			);
			$recents = new WP_Query($args);
			while($recents->have_posts()): $recents->the_post();?>
			<li class="clearfix">
				<article class="prl-article" itemscope="itemscope" itemtype="http://schema.org/Article">
					<?php
					if( has_post_thumbnail() && get_post_meta(get_the_ID(), 'pl_post_thumb', true)!='Disable'):
					?>
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url" class="prl-thumbnail floatleft"><?php echo the_post_thumbnail(); ?></a>
					<?php endif;?>
					<a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url" class="recent-title"><?php the_title();?></a>
					<span class="recent-post-meta"><span><i class="fa fa-clock-o"></i> <?php the_time('M j, Y');?></span></span>
				</article>
			</li>
			
			<?php endwhile; wp_reset_postdata(); ?>
			
		</ul>
		<?php

		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['category'] = $new_instance['category'];
		$instance['post_count'] = $new_instance['post_count'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Recent Posts', 'category' => '', 'post_count' => 3);
		$instance = wp_parse_args((array) $instance, $defaults); ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>">Title:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" type="text" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('category'); ?>"><?php _e('Category', 'presslayer'); ?>:</label> 
				<select id="<?php echo $this->get_field_id('category'); ?>" name="<?php echo $this->get_field_name('category'); ?>" class="widefat" >
					<option value='all' <?php if ('all' == $instance['category']) echo 'selected="selected"'; ?>>All categories</option>
					<?php $categories = get_categories('hide_empty=1&depth=1&type=post'); ?>
					<?php foreach($categories as $category) { ?>
					<option value='<?php echo $category->term_id; ?>' <?php if ($category->term_id == $instance['category']) echo 'selected="selected"'; ?>><?php echo $category->cat_name; ?></option>
					<?php } ?>
				</select>
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('post_count'); ?>"><?php _e('Number of posts to show', 'presslayer'); ?>:</label>
				<input id="<?php echo $this->get_field_id('post_count'); ?>" name="<?php echo $this->get_field_name('post_count'); ?>" value="<?php echo $instance['post_count']; ?>" type="text" size="3" />
			</p>
	<?php }
}


add_action( 'widgets_init', create_function( '', "register_widget('Recent_Post_Widget');" ) );

?>
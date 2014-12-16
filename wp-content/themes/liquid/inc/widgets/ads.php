<?php
class Ads_Widget extends WP_Widget {
	
	function __construct() {
        $widget_ops = array('classname' => 'ads-widget', 'description' => __( 'Add small ads to your sidebar', 'presslayer' ) );
        parent::__construct('ads', __( '&raquo; Small ads', 'presslayer' ), $widget_ops);
    }
	
	function widget($args, $instance)
	{
		global $theme;
		extract($args);
		
		$title = isset($instance['title']) ? $instance['title'] : '';
		$ads = isset($instance['ads']) ? $instance['ads'] : '';
		
		echo $before_widget;
		?>
		<!-- BEGIN WIDGET -->
		<?php
		if($title) echo $before_title.$title.$after_title;
		?>
		
		<div class="ads-wrapper">
			<div class="ads-inner clearfix">
				<?php 
				$ads_arr = explode("\n",trim($ads));
				foreach($ads_arr as $ads){
				$item = explode("|",trim($ads));
				if(isset($item[0]) && isset($item[1]) && $item[0]!='' && $item[1]!=''){
				?>
				<a href="<?php echo $item[1]; ?>" title=""><img src="<?php echo $item[0]; ?>" alt="" /></a>
				<?php 
				}} ?>
			</div>
		</div>
		
		<?php

		echo $after_widget;
	}
	
	function update($new_instance, $old_instance)
	{
		$instance = $old_instance;
		
		$instance['title'] = $new_instance['title'];
		$instance['ads'] = $new_instance['ads'];

		return $instance;
	}

	function form($instance)
	{
		$defaults = array('title' => 'Advertising', 'ads' => THEME_URI ."assets/images/ads/ads.png|http://www.presslayer.com\n".THEME_URI."assets/images/ads/ads.png|http://www.presslayer.com\n". THEME_URI ."/assets/images/ads/ads.png|http://www.presslayer.com\n".THEME_URI."assets/images/ads/ads.png|http://www.presslayer.com\n");
		$instance = wp_parse_args((array) $instance, $defaults); ?>
			<p>
				<label for="<?php echo $this->get_field_id('title'); ?>"><?php _e('Title','presslayer');?>:</label>
				<input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" value="<?php echo $instance['title']; ?>" type="text" />
			</p>
			
			<p>
				<label for="<?php echo $this->get_field_id('ads'); ?>"><?php _e('Ads content','presslayer');?>:</label>
				<textarea class="widefat" id="<?php echo $this->get_field_id('ads'); ?>" name="<?php echo $this->get_field_name('ads'); ?>" rows="10" ><?php echo $instance['ads']; ?></textarea>
				<p class="description">Add your ads with syntax: <strong>banner-url<font color="#FF0000">|</font>link-url</strong>. Separated by new line (press Enter)</p>
			</p>
	<?php }
}

add_action( 'widgets_init', create_function( '', "register_widget('Ads_Widget');" ) );
?>
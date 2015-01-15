<?php
add_action('widgets_init', 'menpai_load_widget');

function menpai_load_widget()
{
	register_widget('Twenty_Fourteen_Ephemera_Widget');
}

class Twenty_Fourteen_Ephemera_Widget extends WP_Widget {

	/**
	 * The supported post formats.
	 *
	 * @access private
	 * @since Twenty Fourteen 1.0
	 *
	 * @var array
	 */
	private $formats = array( 'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery' );

	/**
	 * Constructor.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @return Twenty_Fourteen_Ephemera_Widget
	 */
	public function __construct() {
		parent::__construct( 'widget_twentyfourteen_ephemera', '门派APP社群信息', array(
			'classname'   => 'widget_twentyfourteen_ephemera',
			'description' => '使用此挂件来列出您最近的旁白、引用、视频、音频、图片、画廊和链接文章。',
		) );
	}

	/**
	 * Output the HTML for this widget.
	 *
	 * @access public
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $args     An array of standard parameters for widgets in this theme.
	 * @param array $instance An array of settings for this widget instance.
	 */
	public function widget( $args, $instance ) {
		$member_nums = empty( $instance['member_nums'] ) ? 0 : absint($instance['member_nums'] );
		$action_nums = empty( $instance['action_nums'] ) ? 0 : absint($instance['action_nums'] );
		$sponsor_nums = empty( $instance['sponsor_nums'] ) ? 0 : absint($instance['sponsor_nums'] );
		$sponsor_img = empty( $instance['sponsor_img'] ) ? '' : $instance['sponsor_img'];

		$title  = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		// 建立和远程数据库之间的连接
		$gmId = get_option('gmID');
		$conn = mysqli_connect('112.124.33.98', 'root', 'Root1234', 'mempai') or die('数据库连接错误');
        $query="select group_name, group_members, group_logo, count(advert_id) as sponsor_nums, group_concat(sponsor_logo) as sponsor_logos from web_data join welfare_info on web_data.row_id = welfare_info.advert_id join sponsor_info on sponsor_info.row_id = welfare_info.sponsor_id where web_data.row_id = 2";
        $result=$conn->query($query);
        $row = mysqli_fetch_assoc($result);

		if ( $row ) :

			echo $args['before_widget'];
			?>
			<h1 class="widget-title">
				<?php echo $title; ?>
			</h1>
			<ul class="prl-list-line">
				<li class="clearfix">
					<article class="prl-article" itemscope="itemscope" itemtype="http://schema.org/Article">
						<span class="recent-post-meta">会员数量：</span>
						<span><?php echo $member_nums ? $member_nums : $row['group_members'];?></span>
					</article>
				</li>
				<li class="clearfix">
					<article class="prl-article" itemscope="itemscope" itemtype="http://schema.org/Article">
						<span class="recent-post-meta">行动次数：</span>
						<span><?php echo $action_nums;?></span>
					</article>
				</li>
				<li class="clearfix">
					<article class="prl-article" itemscope="itemscope" itemtype="http://schema.org/Article">
						<span class="recent-post-meta">赞助次数：</span>
						<span><?php echo $sponsor_nums ? $sponsor_nums : $row['sponsor_nums'];?></span>
					</article>
				</li>
				<?php 
					if($row['sponsor_logos']):
					$sponsor_logos = explode(',', $row['sponsor_logos']);
				?>
				<li class="clearfix">
					<article class="prl-article" itemscope="itemscope" itemtype="http://schema.org/Article">
						<span class="recent-post-meta">赞助商LOGO：</span>
						<?php foreach($sponsor_logos as $logo):?>
						<img src="http://www.mempie.com/<?php echo $logo;?>" />
						<?php endforeach;?>
					</article>
				</li>
				<?php endif;?>
				
			</ul>
			<?php

			echo $args['after_widget'];

		endif; // End check for ephemeral posts.
	}

	/**
	 * Deal with the settings when they are saved by the admin.
	 *
	 * Here is where any validation should happen.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $new_instance New widget instance.
	 * @param array $instance     Original widget instance.
	 * @return array Updated widget instance.
	 */
	function update( $new_instance, $instance ) {
		$instance['title']  = strip_tags( $new_instance['title'] );
		$instance['member_nums'] = empty( $new_instance['member_nums'] ) ? 0 : absint($new_instance['member_nums'] );
		$instance['action_nums'] = empty( $new_instance['action_nums'] ) ? 0 : absint($new_instance['action_nums'] );
		$instance['sponsor_nums'] = empty( $new_instance['sponsor_nums'] ) ? 0 : absint($new_instance['sponsor_nums'] );
		$instance['sponsor_img'] = empty( $new_instance['sponsor_img'] ) ? '' : $new_instance['sponsor_img'];


		return $instance;
	}

	/**
	 * Display the form for this widget on the Widgets page of the Admin area.
	 *
	 * @since Twenty Fourteen 1.0
	 *
	 * @param array $instance
	 */
	function form( $instance ) {
		$title  = empty( $instance['title'] ) ? '' : esc_attr( $instance['title'] );
		$member_nums = empty( $instance['member_nums'] ) ? 0 : absint($instance['member_nums'] );
		$action_nums = empty( $instance['action_nums'] ) ? 0 : absint($instance['action_nums'] );
		$sponsor_nums = empty( $instance['sponsor_nums'] ) ? 0 : absint($instance['sponsor_nums'] );
		$sponsor_img = empty( $instance['sponsor_img'] ) ? '' : $instance['sponsor_img'];
		?>
			<p><label for="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>">标题：</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'title' ) ); ?>" class="widefat" name="<?php echo esc_attr( $this->get_field_name( 'title' ) ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'member_nums' ) ); ?>">会员数量：</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'member_nums' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'member_nums' ) ); ?>" type="text" value="<?php echo esc_attr( $member_nums ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'action_nums' ) ); ?>">行动次数：</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'action_nums' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'action_nums' ) ); ?>" type="text" value="<?php echo esc_attr( $action_nums ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'sponsor_nums' ) ); ?>">赞助次数：</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'sponsor_nums' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sponsor_nums' ) ); ?>" type="text" value="<?php echo esc_attr( $sponsor_nums ); ?>" size="3"></p>

			<p><label for="<?php echo esc_attr( $this->get_field_id( 'sponsor_img' ) ); ?>">赞助商LOGO：</label>
			<input id="<?php echo esc_attr( $this->get_field_id( 'sponsor_img' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'sponsor_img' ) ); ?>" type="text" value="<?php echo esc_attr( $sponsor_img ); ?>" size="3"></p>
		<?php
	}
}
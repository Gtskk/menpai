<?php
function tu_post_meta( $str = '' ){
	global $post;
	$author = 1; $time = 1; $cat = 1; $cmt = 1; $class = ''; 
	parse_str($str);
	?>
	<div class="prl-article-meta <?php echo esc_attr($class);?>">
		<?php if($author!=0){?>
        <span class="entry-author" itemprop="author" itemscope="itemscope" itemtype="http://schema.org/Person"><i class="fa fa-user"></i> <a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>" class="entry-author-link" itemprop="url" rel="author"><?php echo get_the_author(); ?></a></span>
		<?php }
		if($time!=0){?>
		<time class="entry-time" itemprop="datePublished" datetime="<?php the_time('Y-m-d\TH:i:sP');?>"  title="<?php the_time( _x( 'l, F j, Y, g:i a', 'post time format', 'presslayer' ) );?>"><i class="fa fa-clock-o"></i> <?php the_date();?>
		</time>
		<?php }
		
		if($cat!=0){
		$categories_list = get_the_category_list( __( ', ', 'presslayer' ) );
		if ( $categories_list) :
			printf( '<span><i class="fa fa-folder-open"></i> %1$s</span>', $categories_list ); 
		endif;
		}
		
		if($cmt!=0){?>
		<?php if (is_single() && comments_open() && get_option( 'thread_comments' )): ?>
           <span><i class="fa fa-comment-o"></i>
            <?php if(get_comments_number() < 1):?>
            <?php comments_popup_link( __('Leave a comment','presslayer'), __('1 comment','presslayer'), __('% comments','presslayer'), 'entry-comments-link', __('Comments are off','presslayer'));?>
            <?php else:?>
            <?php comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'entry-comments-link', '' );?>
            <?php endif;?>
           </span> 
        <?php else: ?>
            <?php if(get_comments_number()>0):
                echo '<span><i class="fa fa-comment-o"></i>';
                comments_popup_link( number_format_i18n( 0 ), number_format_i18n( 1 ), '%', 'entry-comments-link', '' );
                echo '</span>';
            endif;?>
        <?php endif;
        }?>
		<?php edit_post_link(__('Edit','presslayer')); ?>
	</div><!-- .prl-article-meta -->
<?php 
}

function tu_post_thumb($str = '', $link = ''){
	global $post;
	$img_size = 'blog-large'; 
	$class = '';
	$format = get_post_format( $post->ID );  
	parse_str($str);
	
	if($link == '') $link = get_permalink( $post->ID ); 
	
	if( $post->ID == '' ) return '';
	 
	if ( has_post_thumbnail()):
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), $img_size);
		
		if($format == '') $format = 'file';   
		$overlay['video'] = 'video';
		$overlay['audio'] = 'audio';
		$overlay['gallery'] = 'gallery';
		$overlay['image'] = 'image';
		$overlay['file'] = 'file';
		$overlay['map'] = 'map';
		
		$str  = '<a class="prl-thumbnail '.$class.'" href="'. esc_url($link) .'" title="'.the_title_attribute('echo=0').'" rel="bookmark" itemprop="url">';
		$str .= '<figure class="prl-overlay"><img width="'.$thumb[1].'" height="'.$thumb[2].'" src="'.$thumb[0].'" alt="'.the_title_attribute('echo=0').'">';
		$str .= '<span class="prl-overlay-area o-'.$overlay[$format].'"></span></figure></a>';
		return $str;
		
	endif;	
}

function get_label_format($post_id){ 
	$format = get_post_format( $post_id ); 
	$label_color = array();   
	$label_color['video'] = 'red';
	$label_color['audio'] = 'cyan';
	$label_color['image'] = 'cyan';
	$label_color['gallery'] = 'magenta';
	$label_color['aside'] = 'magenta';
	$label_color['link'] = 'magenta';
	$str = '';
	if($format!='' && array_key_exists($format, $label_color)){
		$str = '<span class="prl-badge '.$label_color[$format].'">'.ucwords($format).'</span>';
	}else{
		$str = '';
	}
	return $str;
}

function comment_list( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;
	switch ( $comment->comment_type ) :
		case 'pingback' :
		case 'trackback' :
	?>
	<li class="pingback">
		<strong><?php _e( 'Pingback:', 'presslayer' ); ?></strong> <?php comment_author_link(); ?> | <?php edit_comment_link( __( 'Edit', 'presslayer' ), '<span class="edit-link">', '</span>' ); ?></li>
	<?php
			break;
		default :
	?>
	<li <?php comment_class(); ?> id="comment-<?php comment_ID(); ?>">
		<article class="prl-comment">
			
			<header class="prl-comment-header">
				<span class="prl-comment-avatar"><?php echo get_avatar( $comment, 60 );?></span>
			</header>
			<div class="prl-comment-body">
				<?php if ( $comment->comment_approved == '0' ) : ?>
					<em class="comment-awaiting-moderation"><?php _e( 'Your comment is awaiting moderation.', 'presslayer' ); ?></em>
				<?php endif; ?>
				<h4 class="prl-comment-title"><?php echo get_comment_author_link() ?></h4>
				<div class="prl-comment-meta"><?php echo get_comment_date(get_option('date_format'));?> <?php _e('at','presslayer');?> <?php echo get_comment_time(get_option('time_format'));?></div>
				
				<?php comment_text(); ?>
				<?php comment_reply_link( array_merge( $args, array( 'reply_text' => __( 'Reply', 'presslayer' ), 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
				<?php edit_comment_link(__( 'Edit', 'presslayer' ), '<small>', '</small>' ); ?>
			</div>

		</article>
	</li>
	<?php
		break;
	endswitch;
}


// Custom recent comment
function recent_comment($number, $comment_length, $show_comment_time){
	global $wpdb;
	$recent_comments = "SELECT DISTINCT ID, post_title, post_password, comment_ID, comment_post_ID, comment_author, comment_author_email, comment_date_gmt, comment_approved, comment_type, comment_author_url, SUBSTRING(comment_content,1,110) AS com_excerpt FROM $wpdb->comments LEFT OUTER JOIN $wpdb->posts ON ($wpdb->comments.comment_post_ID = $wpdb->posts.ID) WHERE comment_approved = '1' AND comment_type = '' AND post_password = '' ORDER BY comment_date_gmt DESC LIMIT $number";
	$the_comments = $wpdb->get_results($recent_comments);
	$out = '<ul>';
	foreach ($the_comments as $comment) {
		$out.= '<li>'.get_avatar($comment, '50');
		$out.= '<p><cite>'.strip_tags($comment->comment_author).':</cite>';
		if($show_comment_time == 'on') $out.= ' <em>'.$comment->comment_date_gmt.'</em>';
		$out.= ' <a href="'.get_permalink($comment->ID).'#comment-'.$comment->comment_ID.'" title="'.strip_tags($comment->comment_author).' on '.$comment->post_title.'">';
		$out.= text_trim(strip_tags($comment->com_excerpt), $comment_length,'...').'</a></p>';
		
		$out .= '<div class="clear"></div></li>';	
	}
	$out.= '</ul>';
	
	return $out; 
}

// Tag cloud
function tag_cloud($count, $show_count){
	$tags = get_tags(array('orderby' => 'count', 'order' => 'DESC', 'number' => $count));
	$out = '<ul>';
	foreach ((array) $tags as $tag) {
		$out .= '<li><a href="' . get_tag_link ($tag->term_id) . '" title="'.$tag->count.' '. __('toptic','presslayer').'">' . $tag->name . '';
		if($show_count == 'on') $out .= ' ('.$tag->count.')';
		$out .= '</a></li>';
	}
	$out .= '</ul>';
	
	return $out; 
}


function social_share($post_id = NULL){
?>
<div class="prl-article-share">
	<span class="share-title"><?php _e('Share','presslayer');?></span>
    <a href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" title="Share on Facebook" class="fa fa-facebook" target="_blank" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
	<a href="http://twitter.com/home?status=<?php the_title_attribute();?> - <?php the_permalink();?>" title="Share on Twitter" class="fa fa-twitter" target="_blank" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
	<a href="https://plus.google.com/share?url=<?php the_permalink();?>" class="fa fa-google-plus" title="Share on Google" target="_blank" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
	<a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink();?>&title=<?php the_title_attribute();?>" title="Share on LinkedIn" class="fa fa-linkedin" target="_blank" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
  
   <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id($post_id, 'full-size') ); ?>&amp;description=<?php the_title_attribute(); ?>" target="_blank" title="Share on Pinterest" rel="nofollow" class="fa fa-pinterest" onclick="javascript:window.open(this.href,
  '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"></a>
	<a href="mailto:?subject=<?php the_title_attribute();?>&body=<?php the_permalink();?>" class="fa fa-envelope gray" target="_blank"></a>
	<a href="#" onclick="window.print();" id="print-page"  class="fa fa-print gray" target="_blank"></a>
</div>	
<?php 
}


function post_share($str = ''){
	$text = '';
	parse_str($str);
	?>
    <div class="entry-post-share floatleft"><a href="#" class="prl-button pl-share-btn light" title="<?php _e('Share','presslayer');?>"><i class="fa fa-share"></i> <?php echo $text;?></a>
        <div class="entry-share-icon">
            <a href="http://www.facebook.com/share.php?u=<?php the_permalink();?>" rel="nofollow" title="Share on Facebook" class="ps_facebook" onclick="javascript:window.open(this.href,
    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-facebook"></i></a>
            <a href="http://twitter.com/share?text=<?php the_title_attribute(); ?>&url=<?php the_permalink();?>" rel="nofollow" title="Share on Twitter" class="ps_twitter" onclick="javascript:window.open(this.href,
    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-twitter"></i></a>
            <a href="https://plus.google.com/share?url=<?php the_permalink();?>" target="_blank" title="Share on Google" rel="nofollow" class="ps_google_plus" onclick="javascript:window.open(this.href,
    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-google-plus"></i></a>
            
            <a href="http://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink();?>&amp;title=<?php the_title_attribute(); ?>&amp;source=<?php echo home_url(); ?>" title="Share on LinkedIn" target="_blank" rel="nofollow" class="ps_linkedin"><i class="fa fa-linkedin"></i></a>
            
            <a href="http://pinterest.com/pin/create/button/?url=<?php the_permalink();?>&amp;media=<?php echo wp_get_attachment_url( get_post_thumbnail_id(get_the_ID(), 'full-size') ); ?>&amp;description=<?php the_title_attribute(); ?>" target="_blank" title="Share on Pinterest" rel="nofollow" class="ps_pinterest" onclick="javascript:window.open(this.href,
    '', 'menubar=no,toolbar=no,resizable=yes,scrollbars=yes,height=600,width=600');return false;"><i class="fa fa-pinterest"></i></a>
        </div>
    </div>
	
<?php
}

class nested_Widget extends WP_Widget {

    function widget( $args, $instance ) {
        extract( $args, EXTR_SKIP );
        echo $before_widget;
        $this->display_widgets_front($instance);
        echo $after_widget;
      }

      function update( $new_instance, $old_instance ) {
        $updated_instance = $new_instance;
        return $updated_instance;
      }

      function form( $instance ) {
        global $wp_registered_widgets;
        $instance = wp_parse_args( $instance, array( 
          'widgets'    =>  '',
          'title'     =>  ''
        ) );
        ?>
          <input type="hidden" class="widefat" name="<?php echo $this->get_field_name('widgets') ?>" id="<?php echo $this->get_field_id('widgets') ?>" value="<?php echo htmlentities( $instance['widgets'] ) ?>" >
          <input type="hidden" name="<?php echo $this->get_field_name('title') ?>" id="<?php echo $this->get_field_id('title') ?>" value="<?php echo $instance['title'] ?>" class="widefat">
          <div class="prl-widget-extends" data-setting="#<?php echo $this->get_field_id('widgets') ?>" >
            <p class="description"><?php _e('Drag & Drop Widgets Here','presslayer') ?></p>
            <?php
              $widgets = explode(':prl-data:', $instance['widgets'] );
              if( !empty($widgets) && is_array($widgets) ){
                $number = 1;
                foreach ($widgets as $widget) {
                  if( !empty( $widget ) ) {
                    $url = rawurldecode($widget);
                    parse_str($widget,$s);
                    $this->display_widgets($s, $number);
                  }
                  $number++;
                }
              }
            ?>
          </div>
        <?php
      }

      function get_widgets( $id_base, $number ){
        global $wp_registered_widgets;

        $widget = false;
        foreach ($wp_registered_widgets as $key => $wdg) {
          if( strpos( $key, $id_base ) === 0 ) {
            if( isset($wp_registered_widgets[ $key ]['callback'][0]) && is_object($wp_registered_widgets[ $key ]['callback'][0]) ) {
              $classname = get_class( $wp_registered_widgets[ $key ]['callback'][0] );
              $widget = new $classname;
              $widget->id_base = $id_base;
              $widget->number = $number;
              break;
            }
          }
        }

        return $widget;
      }

      function display_widgets($s, $number){
        $instance = !empty($s['widget-'.$s['id_base']]) ? array_shift( $s['widget-'.$s['id_base']] ) : array();
        $widget = $this->get_widgets( $s['id_base'], $number );
      ?>  
        <?php if( $widget ) { ?>
        <div id="<?php echo esc_attr($s['widget-id']); ?>" class="widget">
          <div class="widget-top">
            <div class="widget-title-action">
              <a class="widget-action hide-if-no-js" href="#available-widgets"></a>
              <a class="widget-control-edit hide-if-js" href="<?php echo esc_url( add_query_arg( $query_arg ) ); ?>">
                <span class="edit"><?php _ex( 'Edit', 'widget' ); ?></span>
                <span class="add"><?php _ex( 'Add', 'widget' ); ?></span>
                <span class="screen-reader-text"><?php echo $widget->name; ?></span>
              </a>
            </div>
            <div class="widget-title"><h4><?php echo $widget->name; ?><span class="in-widget-title"></span></h4></div>
          </div>

          <div class="widget-inside">
            <div class="widget-content">
              <?php if( isset($s['id_base'] ) ) { 
                $widget->form($instance); 
              } else { 
                echo "\t\t<p>" . __('There are no options for this widget.','presslayer') . "</p>\n"; 
              } ?>
            </div>
            <input data-dw="true" type="hidden" name="widget-id" class="widget-id" value="<?php echo esc_attr($s['widget-id']); ?>" />
            <input data-dw="true" type="hidden" name="id_base" class="id_base" value="<?php echo esc_attr($s['id_base']); ?>" />
            <input data-dw="true" type="hidden" name="widget-width" class="widget-width" value="<?php echo esc_attr($s['widget-width']); ?>">
            <div class="widget-control-actions">
              <div class="alignleft">
                <a class="widget-control-remove" href="#remove"><?php _e('Delete','presslayer'); ?></a> |
                <a class="widget-control-close" href="#close"><?php _e('Close','presslayer'); ?></a>
              </div>
              <div class="alignright widget-control-noform">
                <?php submit_button( __( 'Save', 'presslayer' ), 'button-primary widget-control-save right', 'savewidget', false, array( 'id' => 'widget-' . esc_attr( $s['widget-id'] ) . '-savewidget' ) ); ?>
                <span class="spinner"></span>
              </div>
              <br class="clear" />
            </div>
          </div>

          <div class="widget-description"><?php echo ( $widget_description = wp_widget_description($widget_id) ) ? "$widget_description\n" : "$widget_title\n"; ?></div>
        </div>
        <?php } ?>
      <?php
      }
}

function show_slider($args = array(), $size = 'blog-index-gallery'){
	if(!is_array($args)) return '';
	global $post;
	$output = '<div id="slider-'.$post->ID.'" class="tu_flexslider no-controlnav small-flexslider">';
	$output .= '<ul class="tu_slides" >';
	foreach($args as $image_id){
		$image = wp_get_attachment_image_src( $image_id, $size);
		$image_full = wp_get_attachment_image_src( $image_id, 'full-size');
		$output .= '<li itemscope="itemscope" itemtype="http://schema.org/Article">';
		$output .= '<a href="'.$image_full[0].'" rel="bookmark" title="'.the_title_attribute('echo=0').'" class="popup-link-image">';
		$output .= '<img src="'.esc_url($image[0]).'" width="'. $image[1] .'" height="'. $image[2] .'" alt="'.the_title_attribute('echo=0').'" />';
		$output .= '</a></li>';
	}
	$output .= '</ul></div>';
	
	return $output;
}

function tuSidebar($title){
	$new_id = 'custom-'.sanitize_title($title);
	return $new_id;
}

function SetAds(){
    $ads  = of_get_option('ads');
	if($ads and is_array($ads)){
        foreach($ads as $ad){
			if($ad['hook']!=''&& $ad['content']!=''){
                $ad['content'] = stripslashes($ad['content']);
                $ad['content'] =  str_replace("'","\'",  $ad['content']);
                if(isset($ad['autop'])) $ad['content'] = wpautop($ad['content']);
				$new_func = create_function('$cf=""',' echo  \''.$ad['content'].'\' ; ');
                add_action($ad['hook'],$new_func);
            }
        }
    }
}

// Addd Featured Image column to post list
add_filter('manage_posts_columns', 'posts_columns');
add_action('manage_posts_custom_column', 'posts_custom_columns', 10, 2);
function posts_columns($defaults){
    $defaults['fi_post_thumbs'] = __('Thumbnail','presslayer');
    return $defaults;
}
function posts_custom_columns($column_name, $id){
	if($column_name === 'fi_post_thumbs'){
        echo the_post_thumbnail();
    }
}
?>
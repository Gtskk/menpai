<?php
global $post;
$categories = get_the_category();
if(!empty($categories) and is_array($categories)){
	foreach( $categories as $category) $array_ID[] = $category->cat_ID;
	$cats = implode(",", $array_ID);
}else{
	$cats = 0;
}

$args = array( 'posts_per_page' => 3 );
$args['category__in'] =  $cats;
$args['orderby'] = 'rand';
$args['post__not_in'] = array($post->ID);

 
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

if($new_query->post_count > 0):
?>
<div id="related_posts" class="related_posts w-box w-box-padd tu-panel">
    <h4><?php _e('Related Posts','presslayer'); ?></h4>
    <div class="prl-grid prl-grid-divider">
        <?php while ( $new_query->have_posts() ) : $new_query->the_post();?>
		<div class="prl-span-4 rp_item">
            <article id="post-<?php the_ID(); ?>" <?php post_class('prl-article clearfix'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
            	<?php echo tu_post_thumb('img_size=post-thumb-rel');?>
                <h5 itemprop="name"><a href="<?php the_permalink() ?>" title="<?php the_title_attribute(); ?>" class="title" rel="bookmark" itemprop="url"><?php the_title(); ?></a> <?php echo get_label_format(get_the_ID());?></h5>
            </article>
        </div>
        <?php endwhile; wp_reset_postdata(); ?>
    </div>
</div>  
<?php endif;?>  

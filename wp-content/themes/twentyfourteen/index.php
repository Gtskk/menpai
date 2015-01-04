<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme and one
 * of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query,
 * e.g., it puts together the home page when no home.php file exists.
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div style="background:url(<?php echo get_template_directory_uri(); ?>/images/ii_02.jpg) no-repeat center;height:704px;"></div>
<div id="content" class="index">
     
    <h1 class="f36">门派，一款集体主义的APP</h1>
    <h2 class="f28">YOUY WORLD, YOUR GUYS</h2>
	<?php query_posts(array('cat'=>10, 'post__in'=>get_option('sticky_posts')));if(have_posts()):?>
    <div class="flexslider">
		<ul class="slides">
		<?php while(have_posts()):the_post();?>
	        <li>
	        	<a href="<?php the_permalink();?>">
	        		<?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'post-thumbnail');
	        			$image = $thumb ? $thumb[0] : '<?php echo get_template_directory_uri(); ?>/images/i_06.jpg';
	        		?>
	        		<img src="<?php echo $image;?>" alt="j">
					<h2><?php echo get_the_date('m月d日');?> <?php echo mb_substr(get_the_title(), 0, 40);?></h2>
	        	</a>
	        </li>
	    <?php endwhile;?>
	    </ul>
    	
    </div>
	<?php endif;wp_reset_postdata();?>
     
    <h1 class="f36">
     	超过6500个南京本地社群在门派聚合
    </h1>
    <div class="banner">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/ii_05.jpg" alt="">
	</div>
     
    <?php
     	$query = new WP_Query('cat=11&post_per_page=3');
     	if($query->have_posts()):
 	?>
    <div class="col3 spec clear">
    	<?php while($query->have_posts()):$query->the_post();?>
        <ul>
            <li>
            	<?php $logos = rwmb_meta('gtskk_grouplogo', 'type=image_advanced', get_the_id());
            		foreach ($logos as $logo):
            	?>
	            <img src="<?php echo $logo['url'];?>" alt="<?php echo $logo['title'];?>">
		        <?php endforeach;?>
	            <h3><?php the_title();?>
	            	<em><?php echo rwmb_meta('gtskk_groupname', 'type=text', get_the_id());?></em>
	            </h3>
	            <p><?php echo get_the_excerpt();?></p>
	            <?php $img = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'medium');?>
				<img src="<?php echo isset($img[0]) ? $img[0] : '';?>" alt="">
            
            </li>
        </ul>
	    <?php endwhile;?>
    </div>
	<?php endif;?>
</div>

<div class="download">
    <div class="wrap">
	    <h1 class="f36">免费下载门派APP<br />
	创建属于你们的门派</h1>
	    <h2 class="f16">新一代移动社区+穿心行动管理功能+海量福利赞助</h2>
	    <a href="" class="down_btn">
	       <img src="<?php echo get_template_directory_uri(); ?>/images/ii_26.jpg" alt="">
	    </a>
    </div>
</div>

<?php
	global $wpdb;
	$code = '9789798adsf';
	$user_count = $wpdb->get_var( $wpdb->prepare( 
		"
			SELECT COUNT(id) 
			FROM mp_invite_codes 
			WHERE code = %s
		", 
		$code
		)
	);
	var_dump($user_count);
?>

<?php
get_footer();
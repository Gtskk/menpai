<?php
/**
 * The Template for displaying all single posts
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<div id="content" class="details clear">

    <div class="article">
    	<?php if (have_posts()) : while (have_posts()) : the_post();?>
    	<h1><?php the_title();?></h1>
        <h2><?php echo get_post_meta($post->ID, '副标题', true);?></h2>
        <p class="date"><?php the_date('Y/m/d');?></p>

        <?php the_content();?>

	 	<?php endwhile; endif; wp_reset_postdata();// End main loop ?>
	 	<?php
	 		$query = new WP_Query(array(
	 			'post__not_in' => array($post->ID),
	 			'posts_per_page' => 1
	 		));
	 	?>
        
        <?php if ($query->have_posts()):?>
        <div class="recommend">
            <div class="t">推荐精选</div>
          	<div>
             	<ul class="clear">
             		<?php while ($query->have_posts()) : $query->the_post();?>
                    <li>
                    	<a href="<?php the_permalink();?>">
                    		<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'thumbnail')[0];?>" alt="">
                    	</a>
                    	<a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </li>
	                <?php endwhile;?>
                    
                    <li>
                     	<a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/d_22.jpg" alt=""></a>
                    	<a href="">AA户外俱乐AA户外俱乐部及4大车友会</a>
                    </li>
                    
                    <li style="margin-right: 0;">
                     	<a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/d_24.jpg" alt=""></a>
                    	<a href="">AA户外俱乐AA户外俱乐部及4大车友会</a>
                    </li>
             	</ul>
          	</div>
    	</div>
 	</div>
	 <?php endif;?>

 	<?php wp_reset_postdata();?>

    <div class="aside">
        <div class="er">
            <div class="t">和门派一起玩出新花样</div>
            <div class="b">
                <img src="<?php echo get_template_directory_uri(); ?>/images/d_03.jpg" alt="">
                <p>扫描二维码关注门派参与更多精彩活动</p>
            </div>
        </div>
          
        <div class="new">
            <div class="t">
               	最新活动
           	</div>
            <div class="b">
                <dl>
	                <dt><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/d_10.jpg" alt=""></a></dt>
	                <dd><h4>万圣节超级派对</h4></dd>
	                <dd>2014/09/13</dd>
                </dl>
                
                <dl>
	                <dt><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/d_14.jpg" alt=""></a></dt>
	               	<dd><h4>万圣节超级派对</h4></dd>
	                <dd>2014/09/13</dd>
                </dl>
                
                <dl>
	                <dt><a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/d_17.jpg" alt=""></a></dt>
	                <dd><h4>万圣节超级派对</h4></dd>
	                <dd>2014/09/13</dd>
                </dl>
                
            </div>
      	</div>
    </div>
</div>

<?php
get_footer();
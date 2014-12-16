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

	 	<?php endwhile;wp_reset_postdata(); endif;// End main loop ?>

	 	<?php
	 		$new_query = new WP_Query(array(
                'posts_per_page' => 3,
	 			'post__not_in' => array($post->ID),
                'ignore_sticky_posts' => 1
	 		));
	 	?>
        <?php if ($new_query->have_posts()):?>
        <div class="recommend">
            <div class="t">推荐精选</div>
          	<div>
             	<ul class="clear">
             		<?php while ($new_query->have_posts()) : $new_query->the_post();?>
                    <li<?php if($new_query->current_post == 2):?> style="margin-right:0;"<?php endif;?>>
                    	<a href="<?php the_permalink();?>">
                    		<img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail')[0];?>" alt="">
                    	</a>
                    	<a href="<?php the_permalink();?>"><?php the_title();?></a>
                    </li>
	                <?php endwhile;wp_reset_postdata();?>
             	</ul>
          	</div>
    	</div>
        <?php endif;?>
 	</div>

    <div class="aside">
        <div class="er">
            <div class="t">和门派一起玩出新花样</div>
            <div class="b">
                <img src="<?php echo get_template_directory_uri(); ?>/images/d_03.jpg" alt="">
                <p>扫描二维码关注门派参与更多精彩活动</p>
            </div>
        </div>
        
        <?php
            $new_query1 = new WP_Query(array(
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'ignore_sticky_posts' => 1
            ));
            if($new_query1->have_posts()):
        ?>
        <div class="new">
            <div class="t">
               	最新活动
           	</div>
            <div class="b">
                <?php while($new_query1->have_posts()):$new_query1->the_post();?>
                <dl>
	                <dt>
                        <a href="<?php the_permalink();?>">
                            
                            <img src="<?php echo wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail')[0];?>" alt="">
                        </a>
                    </dt>
	                <dd><h4><?php the_title();?></h4></dd>
	                <dd><?php echo get_the_date('Y/m/d');?></dd>
                </dl>
                <?php endwhile;wp_reset_postdata();?>
                
            </div>
      	</div>
        <?php endif;?>
    </div>
</div>

<?php
get_footer();
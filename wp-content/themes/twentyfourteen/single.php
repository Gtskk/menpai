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
            $conn = mysqli_connect('112.124.33.98', 'root', 'Root1234', 'mempai') or die('数据库连接错误');
            $conn->set_charset('utf8');

            $stmt = $conn->query("SELECT group_name, foundation_status FROM group_info WHERE is_recommend = 1");
            $ttn = mysqli_num_rows($stmt);
            $count = 0;
        ?>
        <?php if ($stmt):?>
        <div class="recommend">
            <div class="t">推荐社群</div>
            <div>
                <ul class="clear">
                    <?php while($ro =mysqli_fetch_assoc($stmt)):$count++;?>
                    <?php $image = get_template_directory_uri().'/images/i_18.jpg';?>
                    <li<?php if($count == $ttn):?> style="margin-right:0;"<?php endif;?>>
                        <a href="<?php echo $ro['foundation_status'] ?: 'javascript:void(0);';?>">
                            <img src="<?php echo $image;?>" alt="" style="width:227px;height:147px;">
                        </a>
                        <a href="<?php the_permalink();?>"><?php echo $ro['group_name'];?></a>
                    </li>
                    <?php endwhile;?>
                </ul>
            </div>
        </div>
        <?php endif;$stmt->free();$conn->close();?>
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
            $sticky = get_option('sticky_posts');
            $new_query1 = new WP_Query(array(
                'cat' => 10,
                'posts_per_page' => 3,
                'orderby' => 'date',
                'order' => 'DESC',
                'post__in' => $sticky
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
                            <?php $ig = wp_get_attachment_image_src(get_post_thumbnail_id( get_the_ID() ), 'thumbnail');?>
                            <img src="<?php echo isset($ig[0]) ? $ig[0] : '';?>" alt="">
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
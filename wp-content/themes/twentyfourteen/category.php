<?php
/**
 * The template for displaying Category pages
 *
 * @link http://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */

get_header(); ?>

<?php if(single_cat_title('', false) == '精选社群'):?>
<div id="content" class="org">
    <h1 class="f36">超过6500个南京本地社群在门派聚合</h1>
    <h2 class="f28">YOUY WORLD, YOUR GUYS</h2>
    
    <?php
        $sticky = get_option('sticky_posts');
        $query = new WP_Query(array(
            'cat' => get_query_var('cat'),
            'posts_per_page' => 3,
            'post__in' => $sticky
        )); 
        if ($query->have_posts()):
    ?>
    <div class="flexslider">
        <ul class="slides">
        <?php while($query->have_posts()):$query->the_post();?>
            <li>
                <a href="<?php the_permalink();?>">
                    <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
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

    <?php
        $conn = mysqli_connect('112.124.33.98', 'root', 'Root1234', 'mempai') or die('数据库连接错误');
        $conn->set_charset('utf8');
        $query="select count(*) from web_data";
        $result=$conn->query($query);
        $row = mysqli_fetch_array($result);
    ?>
    
    <div class="qlist">
        <?php if($row && $total = $row[0]):?>
        <?php
            $per_page = 10;
            $pages = ceil($total/$per_page);
            $page = isset($_GET['page']) ? intval($_GET['page']) : 1;
            $init = 1;
            $page_len = 4;
            $max_p = $pages;

            $q = 'select * from web_data limit '.($page - 1)*$per_page.','.$per_page;
            $r = $conn->query($q);
        ?>
        <ul>
            <?php while($row =mysqli_fetch_assoc($r)):?>
            <li class="clear">
                <dl>
                    <dt>
                        <a href="">
                            <img src="http://www.mempie.com/<?php echo $row['group_logo'];?>" alt="<?php echo $row['group_name'];?>" width="66" height="66">
                        </a>
                    </dt>
                    <dd>
                        <?php if($row['group_user_name']):?>
                        群主 : <?php echo $row['group_user_name'];?> 
                        <?php endif;?>
                        <?php echo $row['group_cat'];?></dd>
                    <dd><strong><?php echo $row['group_name'];?></strong><?php echo $row['group_members'];?>人</dd>
                </dl>
                <p>
                <?php echo $row['group_content'];?>
                </p>
            </li>
            <?php endwhile;?>
        </ul>
        <?php endif;?>
        <?php $result->free();$conn->close();?>
    </div>
    
    
    <?php
        $page_len = ($page_len%2) ? $page_len : $page_len+1; // 页码个数
        $pageoffset = ($page_len-1)/2; // 页码个数左右偏移量

        $key = '<div class="pages">';
        if($page != 1){
            $key .= '<a href="'.get_category_link(11).'&page='.($page-1).'"><</a>';
        }
        if($pages > $page_len){
            if($page <= $pageoffset){
                $init = 1;
                $max_p = $page_len;
            }else{
                if($page+$pageoffset >= $pages+1){
                    $init = $pages-$page_len+1;
                }else{
                    $init = $page - $pageoffset;
                    $max_p = $page + $pageoffset;
                }
            }
        }
        for ($i=$init; $i < $max_p; $i++) { 
            if($i == $page){
                $key .= '<span>'.$i.'</span>';
            }else{
                $key .= '<a href="'.get_category_link(11).'&page='.$i.'">'.$i.'</a>';
            }
        }
        if($page < $pages-3){
            $key .= '...';
        }
        if($page < $pages -2){
            $key .= '<a href="'.get_category_link(11).'&page='.($pages-1).'">'.($pages-1).'</a>';
        }
            $key .= '<a href="'.get_category_link(11).'&page='.$pages.'">'.$pages.'</a>';
        if($page != $pages){
            $key .= '<a href="'.get_category_link(11).'&page='.($page+1).'">></a>';
        }
        $key .= '</div>';

        echo $key;
    ?>
    
</div>
<?php else:?>
<div id="content" class="activity">
    <h1 class="f36">门派，一款集体主义的APP</h1>
    <h2 class="f28">YOUY WORLD, YOUR GUYS</h2>
   
    <?php
        $sticky = get_option('sticky_posts');
        $query = new WP_Query(array(
            'cat' => get_query_var('cat'),
            'posts_per_page' => 3,
            'post__in' => $sticky
        )); 
        if ($query->have_posts()):
    ?>
    <div class="flexslider">
        <ul class="slides">
        <?php while($query->have_posts()):$query->the_post();?>
            <li>
                <a href="<?php the_permalink();?>">
                    <?php $thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_id()), 'full');
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

    <?php if ( have_posts() ) : ?>
    <div class="col3 clear">
        <ul id="post_container">
        <?php while ( have_posts() ) : the_post();?>
            <li class="post">
                <div class="pic">
                    <a href="<?php the_permalink();?>"><?php the_post_thumbnail(array(358, 279));?></a>
                </div>
                 
                <div class="text">
                    <h3><?php the_title();?></h3>
                    <?php the_excerpt();?>
                    <?php
                        // Show an optional term description.
                        /*$term_description = term_description();
                        if ( ! empty( $term_description ) ) :
                            printf( '<div class="taxonomy-description">%s</div>', $term_description );
                        endif;*/
                    ?>
                    <?php
                        $tags = get_the_tags();
                        $tag = '';
                        if($tags){
                            foreach ($tags as $val) {
                                $tag = $val->name;
                            }
                        }
                    ?>
                    <div class="date">
                        <?php if($tag):?>
                        <a href=""<?php if($tag == '活动精选'):?> class="g"<?php endif;?>>
                            <?php echo $tag;?>
                        </a>
                        <?php endif;?>
                        <?php echo get_the_date('Y/m/d');?>
                    </div>
                </div>
                 
                
                <div class="qun">
                    <p>参与社群：
                        <span><?php echo get_post_meta($post->ID, '参与社群', true);?></span>
                    </p>
                    <p>赞助商：
                        <span><?php echo get_post_meta($post->ID, '赞助商', true);?></span></p>
                </div>
            </li>
            
        <?php endwhile;?>
        </ul>
    </div>
    <?php 
        // Previous/next page navigation.
        twentyfourteen_paging_nav();
    ?>
    <?php endif;?>
</div>
<?php endif;?>

<?php
get_footer();

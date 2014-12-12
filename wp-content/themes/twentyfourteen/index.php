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

<div class="slide"></div>
<?php
	if ( have_posts() ) :while ( have_posts() ) : the_post();
?>
	<p><a href="<?php the_permalink();?>"><?php the_title();?></a></p>
<?php
	endwhile;
	// Previous/next post navigation.
	twentyfourteen_paging_nav();

	else :
		// If no content, include the "No posts found" template.
		get_template_part( 'content', 'none' );

	endif;
?>

<div id="content" class="index">
     
    <h1 class="f36">门派，一款集体主义的APP</h1>
    <h2 class="f28">YOUY WORLD, YOUR GUYS</h2>
    <div class="banner">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/i_06.jpg" alt="">
    </div>
     
    <h1 class="f36">
     	超过6500个南京本地社群在门派聚合
    </h1>
    <div class="banner">
    	<img src="<?php echo get_template_directory_uri(); ?>/images/ii_05.jpg" alt="">
	</div>
     
     
     <div class="col3 clear">
        <ul>
            <li>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/ii_09.jpg" alt="">
	            <h3>AK
	            	<em>南京AA户外GM</em>
	            </h3>
	            <p>人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
	你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。			</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/ii_13.jpg" alt="">
            
            </li>
        </ul>
        
        <ul>
           	<li>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/ii_09.jpg" alt="">
	            <h3>AK
	            <em>南京AA户外GM</em>
	            </h3>
	            <p>人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
	你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。</p>
				<img src="<?php echo get_template_directory_uri(); ?>/images/ii_15.jpg" alt="">
            
            </li>
        </ul>
        
        <ul style="margin-right: 0;">
            <li>
	            <img src="<?php echo get_template_directory_uri(); ?>/images/ii_09.jpg" alt="">
	            <h3>AK
	            <em>南京AA户外GM</em>
	            </h3>
	            <p>人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
	你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。</p> 
				<img src="<?php echo get_template_directory_uri(); ?>/images/ii_17.jpg" alt="">
            
            </li>
        </ul>
     </div>
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
get_footer();
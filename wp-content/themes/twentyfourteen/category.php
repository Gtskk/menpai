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

<div id="content" class="activity">
   	<h1 class="f36">门派，一款集体主义的APP</h1>
   	<h2 class="f28">YOUY WORLD, YOUR GUYS</h2>
   
    <div class="banner">
    	<a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/i_06.jpg" alt=""></a>
    </div>
	<?php if ( have_posts() ) : ?>
    <div class="col3 clear">
    	<?php while ( have_posts() ) : the_post();?>
        <ul>
           	<li>
             	<div class="pic">
             		<a href=""><img src="<?php echo get_template_directory_uri(); ?>/images/i_09.jpg" alt=""></a>
             	</div>
                 
                <div class="text">
                 	<h3><?php the_title();?></h3>
                 	<?php the_expert();?>
                 	<?php
						// Show an optional term description.
						/*$term_description = term_description();
						if ( ! empty( $term_description ) ) :
							printf( '<div class="taxonomy-description">%s</div>', $term_description );
						endif;*/
					?>
                 	<div class="date"><a href="">活动精选</a>2014/09/13</div>
                </div>
                 
                
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会</span>
    				</p>
                   	<p>赞助商：
    					<span>碧桂园凤凰城</span></p>
                </div>
           	</li>
           	<?php if(($wp_query->current_post+1)%3 == 0):?>
       	</ul>
       	<ul>
           	<?php endif;?>
        <?php endwhile;?>
            <li>
             	<div class="pic">
             		<a href="">
             			<img src="<?php echo get_template_directory_uri(); ?>/images/i_19.jpg" alt="">
             		</a>
             	</div>
                <div class="text">
                 	<h3>碧桂园凤凰城彩虹跑</h3>
                 
                 人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
    你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便......
                 	<div class="date"><a href="">活动精选</a>2014/09/13</div>
                </div>
                 
                
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会</span>
    				</p>
                   	<p>赞助商：
    				<span>碧桂园凤凰城</span></p>
                </div>
           	</li>
        </ul>
        
        <ul>
           	<li>
             	<div class="pic">
             		<a href="">
             			<img src="<?php echo get_template_directory_uri(); ?>/images/i_11.jpg" alt="">
             		</a>
             	</div>
                <div class="text">
                 	<h3>碧桂园凤凰城彩虹跑</h3>
                 
                 人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
    你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便......
                 	<div class="date"><a href="">活动精选</a>2014/09/13</div>
                </div>
                 
                
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会、福克斯车友会、梅山单车俱乐部</span>
					</p>
                   	<p>赞助商：
    					<span>碧桂园凤凰城</span>
    				</p>
                </div>
           	</li>
            <li>
             	<div class="pic">
             		<a href="">
             			<img src="<?php echo get_template_directory_uri(); ?>/images/i_20.jpg" alt="">
             		</a>
             	</div>
                <div class="text">
                 	<h3>碧桂园凤凰城彩虹跑</h3>
                 
                 人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
    你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便......
                 	<div class="date"><a href="">活动精选</a>2014/09/13</div>
                </div>
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会</span>
    				</p>
                   	<p>赞助商：
    					<span>碧桂园凤凰城</span>
    				</p>
                </div>
           	</li>
        </ul>
        
        <ul style="margin-right: 0;">
          	<li>
             	<div class="pic">
             		<a href="">
             			<img src="<?php echo get_template_directory_uri(); ?>/images/i_13.jpg" alt="">
             		</a>
             	</div>
                <div class="text">
                 	<h3>碧桂园凤凰城彩虹跑</h3>
                 
                 人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
    你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便......
                 	<div class="date"><a href="" class="g">活动精选</a>2014/09/13</div>
                </div>
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会</span></p>
                   	<p>赞助商：
    					<span>碧桂园凤凰城</span></p>
                </div>
           	</li>
            <li>
             	<div class="pic">
             		<a href="">
             			<img src="<?php echo get_template_directory_uri(); ?>/images/i_09.jpg" alt="">
             		</a>
             	</div>
                <div class="text">
                 	<h3>碧桂园凤凰城彩虹跑</h3>
                 
                 人物证言，担保方波阿宝，你发哦拜佛啊拜佛阿伯，烦恼不够个吧，拗不过哦啊我拜佛。
    你发哦你反驳啊方便，你发哦方便，国内佛，闹闹反驳啊。你发哦你反驳啊方便......
                 	<div class="date"><a href="">活动精选</a>2014/09/13</div>
                </div>
                 
                
                <div class="qun">
                   	<p>参与社群：
    					<span>DS车友会、AA户外、马自达6车友会、雅阁车友会</span></p>
                   	<p>赞助商：
    					<span>碧桂园凤凰城</span></p>
                </div>
           	</li>
        </ul>
    </div>
    <?php 
    	// Previous/next page navigation.
		twentyfourteen_paging_nav();
	?>
	<?php endif;?>
</div>

<?php
get_sidebar( 'content' );
get_sidebar();
get_footer();

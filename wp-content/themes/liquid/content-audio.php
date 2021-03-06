<article id="post-<?php the_ID(); ?>" <?php post_class('prl-article w-box w-box-padd'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
    <?php
	if(is_single() && is_main_query()){
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id( $post->ID ), 'full-size');
		echo tu_post_thumb('class=popup-link-image&link='.$thumb[0].'&format=image');
	}else{
		echo tu_post_thumb();
	}
	
	if(function_exists('rwmb_meta')){
		if( rwmb_meta( 'tu_audio_embed') !='' ){ 
			echo '<p>'.trim(rwmb_meta( 'tu_audio_embed')).'</p>';
		}
	}
	?>
    <?php
	if(function_exists('rwmb_meta')){
	if( rwmb_meta( 'tu_audio_file') !='' ){ ?>
      <p>
      <audio preload="auto" controls>
        <source src="<?php echo rwmb_meta( 'tu_audio_file');?>">
	 </audio></p>
    <?php } }?> 
    
	<?php
    // Single
    if(is_single() && is_main_query()){
    ?>
    <h1 itemprop="name"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url"><?php the_title();?></a></h1> 
    <?php tu_post_meta();?>
    <div class="entry-content clearfix" itemprop="articleBody">
        <?php
        the_content(); 
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'framework').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); ?>
        <?php the_tags( '<div class="prl-article-tags">'.__('Tags:','presslayer').' ', ' ', '</div>'); ?>
    </div>
    
    <?php	
    // Archives	
    }else{
    ?>
    <h3 class="prl-article-title" itemprop="name"><a href="<?php the_permalink();?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url"><?php the_title();?></a> <?php echo get_label_format(get_the_ID());?></h3> 
    <?php tu_post_meta('author=0');?>		
    <?php
    if(of_get_option('blog_entry_excerpt_trim')!='') $num_wds = of_get_option('blog_entry_excerpt_trim');
    else $num_wds = 35;	
    if(isset($num_excerpt) && $num_excerpt!='') $num_wds = $num_excerpt; 
    ?>
    <div class="entry-summary" itemprop="description"><?php echo wp_trim_words( get_the_excerpt() , $num_wds , '...' );?></div>
    <?php
    }
    ?>
</article>
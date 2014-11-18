<div class="prl-article-bottom clearfix">
	<?php if ( is_single() and is_main_query()){?>
    	<div class="floatleft"><?php social_share( get_the_ID() );?></div>
    <?php }else {?>
    	<a href="<?php the_permalink() ?>" rel="bookmark" title="<?php the_title_attribute(); ?>"><i class="fa fa-play-circle"></i> <?php _e('Read more','presslayer');?></a>
    <?php } ?>
    <?php if( function_exists('tu_likepostthis') and of_get_option('like_button') == true ) tu_likepostthis('floatright '); ?>
</div>
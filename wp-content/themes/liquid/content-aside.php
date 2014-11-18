<article id="post-<?php the_ID(); ?>" <?php post_class('prl-article w-box'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
    <div class="w-box-inner no-pad-bot">
        <?php 
		global $more;
		if(is_single() && is_main_query()) $more = 1;
		else $more = 0;
        the_content( __('Read more', 'presslayer') . '...' ); 
        wp_link_pages(array('before' => '<p><strong>'.__('Pages:', 'presslayer').'</strong> ', 'after' => '</p>', 'next_or_number' => 'number')); 
   		the_tags( '<div class="prl-article-tags">'.__('Tags:','presslayer').' ', ' ', '</div>'); ?>
    </div>
</article>
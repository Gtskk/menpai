<article id="post-<?php the_ID(); ?>" <?php post_class('prl-article w-box'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
    <div class="w-box-inner">
        <?php 
		$thumb = wp_get_attachment_image_src(get_post_thumbnail_id(get_the_ID()), 'full-size');
		echo tu_post_thumb('class=popup-link-image&link='.$thumb[0]);?>
    </div>
</article>
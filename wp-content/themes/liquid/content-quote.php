<article id="post-<?php the_ID(); ?>" <?php post_class('prl-article w-box'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
    <div class="w-box-inner">
    	<?php if( !is_single() ) { ?>
            <a href="<?php the_permalink(); ?>" rel="bookmark" title="<?php the_title_attribute();?>" class="entry-quote-link">
        <?php } ?>
        <div class="entry-quote">
            <h3><?php echo esc_html(rwmb_meta( 'tu_quote')); ?></h3>        
            <p class="entry-summary" itemprop="description"><?php the_title(); ?></p>
        </div>
        <?php if( !is_single() ) { ?>
            </a>
        <?php } ?>
    </div>
</article>
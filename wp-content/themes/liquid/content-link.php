<article id="post-<?php the_ID(); ?>" <?php post_class('prl-article w-box w-box-padd'); ?> itemscope="itemscope" itemtype="http://schema.org/Article">
    
        <?php $link = esc_url( rwmb_meta( 'tu_link_url')); ?>
        <h3 class="prl-article-title" itemprop="headline"><a href="<?php echo $link;?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url" target="_blank"><?php the_title();?></a></h3> 
        <p class="entry-summary" itemprop="description"><a href="<?php echo $link;?>" title="<?php the_title_attribute();?>" rel="bookmark" itemprop="url" target="_blank"><?php echo $link;?></a></p>
   
</article>
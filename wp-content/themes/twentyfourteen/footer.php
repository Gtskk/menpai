<?php
/**
 * The template for displaying the footer
 *
 * Contains footer content and the closing of the #main and #page div elements.
 *
 * @package WordPress
 * @subpackage Twenty_Fourteen
 * @since Twenty Fourteen 1.0
 */
?>

		</div><!-- #main -->

		<footer id="colophon" class="site-footer" role="contentinfo">

			<?php get_sidebar( 'footer' ); ?>

			<div class="site-info">
				<?php do_action( 'twentyfourteen_credits' ); ?>
				<a href="<?php echo esc_url( __( 'http://wordpress.org/', 'twentyfourteen' ) ); ?>"><?php printf( __( 'Proudly powered by %s', 'twentyfourteen' ), 'WordPress' ); ?></a>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #page -->

	<!-- JiaThis Button BEGIN -->
	<script type="text/javascript">
	var jiathis_config = {data_track_clickback:'true'};
	</script>
	<script type="text/javascript" src="http://v3.jiathis.com/code_mini/jiathis_r.js?move=0&amp;uid=1407898571339227" charset="utf-8"></script>
	<!-- JiaThis Button END -->

	<?php wp_footer(); ?>
</body>
</html>
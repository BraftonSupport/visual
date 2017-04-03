<?php
/**
 * The template part for displaying content
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
$options = get_option( 'yttheme_options' );
$blog = $options['blog_layout'];
$thumbnail = get_the_post_thumbnail_url();
?>
	<article id="post-<?php the_ID(); ?>">

		<a href="<?php the_permalink(); ?>"><div class="featured" style="background-image: url(<?php echo $thumbnail; ?>);"></div></a>
		
		<div class="article-body">
			<header class="entry-header">
				<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
					<span class="sticky-post"><?php _e( 'Featured', 'yttheme' ); ?></span>
				<?php endif; ?>

				<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<footer class="entry-footer">
					<span class="posted-on"><?php echo get_the_date('M j, Y'); ?></span>
					<span class="cat"><?php the_category(' '); ?></span>
					<?php if ( $options['ssbutton'] ) {
						echo social_sharing_buttons($content);
					} ?>
					<?php
						edit_post_link(
							sprintf(
								/* translators: %s: Name of current post */
								__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'yttheme' ),
								get_the_title()
							),
							'<span class="edit-link">',
							'</span>'
						);
					?>
				</footer><!-- .entry-footer -->
				<?php
					/* translators: %s: Name of current post */
					the_excerpt( sprintf(
						__( '<p>Continue reading<span class="screen-reader-text"> "%s"</span></p>', 'yttheme' ),
						get_the_title()
					) );

					wp_link_pages( array(
						'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'yttheme' ) . '</span>',
						'after'       => '</div>',
						'link_before' => '<span>',
						'link_after'  => '</span>',
						'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'yttheme' ) . ' </span>%',
						'separator'   => '<span class="screen-reader-text">, </span>',
					) );
				?>
				<a class="more" href="<?php the_permalink(); ?>">Read more</a>
			</div><!-- .entry-content -->
		</div>
		
	</article><!-- #post-## -->
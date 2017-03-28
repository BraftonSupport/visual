<?php
/**
 * The template for displaying search results pages
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */

get_header(); ?>

	<section id="primary" class="content-area site-inner">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<h1 class="page-title"><?php printf( __( 'Search Results for: %s', 'yttheme' ), '<span>' . esc_html( get_search_query() ) . '</span>' ); ?></h1>
			</header><!-- .page-header -->

			<?php
			// Start the loop.
			while ( have_posts() ) : the_post();

				?>

				<?php
				$options = get_option( 'yttheme_options' );
				$blog = $options['blog_layout'];
				$thumbnail = get_the_post_thumbnail_url();
				?>
					<article id="post-<?php the_ID(); ?>"<?php post_class($blog); if ($blog=="rich") { ?> style="background-image: url(<?php echo $thumbnail; ?>);"<?php } ?>>

						<?php if ($blog!=="rich") { ?>

							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail() ) { ?>
									<div class="featured" style="background-image: url(<?php echo $thumbnail; ?>);">
										<header class="entry-header">
											<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
												<span class="sticky-post"><?php _e( 'Featured', 'yttheme' ); ?></span>
											<?php endif; ?>

											<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										</header><!-- .entry-header -->
									</div>
								<?php } else { ?>
									<div class="featured" style="background-image: url('/wp-content/uploads/2017/01/0aa3afb3cbe3468fc6e43e50070b0810.png')">
										<header class="entry-header">
											<?php if ( is_sticky() && is_home() && ! is_paged() ) : ?>
												<span class="sticky-post"><?php _e( 'Featured', 'yttheme' ); ?></span>
											<?php endif; ?>

											<?php the_title( sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">', esc_url( get_permalink() ) ), '</a></h2>' ); ?>
										</header><!-- .entry-header -->
									</div>
								<?php } ?>
							</a>

						<?php } ?>

						<div class="entry-content">

							<footer class="entry-footer">
								<?php // yttheme_entry_meta(); ?>

								<span class="posted-on"><?php echo the_date('m/d/y'); ?></span>
								<div class="cat"><?php the_category(' '); ?></div>
								<?php if ( $options['ssbutton'] ) {
									echo social_sharing_buttons($content);
								} ?>
							</footer><!-- .entry-footer -->
							<div class="excerpt">
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
							<?php // if ( $options['ssbutton'] ) {
								//echo social_sharing_buttons($content);
							//} ?>
							</div>
						</div><!-- .entry-content -->
						
					</article><!-- #post-## -->

			<?php

			// End the loop.
			endwhile;

			// Previous/next page navigation.
			the_posts_pagination( array(
				'prev_text'          => __( 'Previous page', 'yttheme' ),
				'next_text'          => __( 'Next page', 'yttheme' ),
				'before_page_number' => '<span class="meta-nav screen-reader-text">' . __( 'Page', 'yttheme' ) . ' </span>',
			) );

		// If no content, include the "No posts found" template.
		else :
			get_template_part( 'template-parts/content', 'none' );

		endif;
		?>

		</main><!-- .site-main -->

		<?php get_sidebar(); ?>

	</section><!-- .content-area -->

<?php get_footer(); ?>

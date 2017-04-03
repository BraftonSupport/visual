<?php
/**
 * The template for displaying archive pages
 *
 * Used to display archive-type pages if nothing more specific matches a query.
 * For example, puts together date-based pages if no date.php file exists.
 *
 * If you'd like to further customize these archive views, you may create a
 * new template file for each one. For example, tag.php (Tag archives),
 * category.php (Category archives), author.php (Author archives), etc.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */

get_header(); ?>

	<div id="primary" class="content-area site-inner">
		<main id="main" class="site-main" role="main">

		<?php if ( have_posts() ) : ?>

			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->

			<div class="team-container">

				<?php
				// Start the Loop.
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
								<span class="title">
									<?php echo get_field('right_box'); ?>
								</span>								
							</footer><!-- .entry-footer -->

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

		</div>

		</main><!-- .site-main -->
<?php // get_sidebar(); ?>
	</div><!-- .content-area -->

<?php get_footer(); ?>

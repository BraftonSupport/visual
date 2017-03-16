<?php
/**
 * The template for displaying all single posts and attachments
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */

get_header(); ?>

<div id="primary" class="content-area site-inner">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the single post content template.
			//get_template_part( 'template-parts/content', 'single' );

			?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php
				$options = get_option( 'yttheme_options' );
				$blog = $options['blog_layout'];
				$thumbnail = get_the_post_thumbnail_url();
				?>

				<?php // yttheme_excerpt(); ?>

						<?php if ($blog!=="rich") { ?>

							<a href="<?php the_permalink(); ?>">
								<?php if (has_post_thumbnail() ) { ?>
									<div class="featured" style="background-image: url(<?php echo $thumbnail; ?>);"></div>
								<?php } else { ?>
									<div class="featured" style="background-image: url('/wp-content/uploads/2017/01/0aa3afb3cbe3468fc6e43e50070b0810.png')"></div>
								<?php } ?>
							</a>

						<?php } ?>

						<footer class="entry-footer">
							<?php // yttheme_entry_meta(); ?>
							<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
							<span class="posted-on"><?php echo the_date('m/d/y'); ?></span>
							<div class="cat"><?php the_category(' '); ?></div>
							<?php if ( $options['ssbutton'] ) {
								echo social_sharing_buttons($content);
								} ?>
						</footer><!-- .entry-footer -->
				<div class="entry-content">
					<?php
						the_content();

						wp_link_pages( array(
							'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'yttheme' ) . '</span>',
							'after'       => '</div>',
							'link_before' => '<span>',
							'link_after'  => '</span>',
							'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'yttheme' ) . ' </span>%',
							'separator'   => '<span class="screen-reader-text">, </span>',
						) );

						if ( '' !== get_the_author_meta( 'description' ) ) {
							get_template_part( 'template-parts/biography' );
						}
					?>
				</div><!-- .entry-content -->

			<?php if ( is_single() && $options['related_posts']=="below" ) { ?>
				<div class="latest">
					<h3>Related Posts</h3>
					<div class="post">

						<?php $categories = get_the_category();
						if ($categories) {
							foreach ($categories as $category) {
								$cat = $category->cat_ID;
								$args=array( 'cat' => $cat, 'post__not_in' => array($post->ID), 'posts_per_page'=>3 );

								$my_query = null;
								$my_query = new WP_Query($args);

								if( $my_query->have_posts() ) {
									while ($my_query->have_posts()) : $my_query->the_post();
									$url = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'full' );
									echo '<a href="' . get_the_permalink() . '" title="'.get_the_title().'">';
										echo '<div class="thumb"';
											if ( $url ) { echo 'style="background-image: url('.$url[0].')"'; }
										echo '></div>';
										echo '<h5>'.get_the_title().'<br/><span class="tiny">'.get_the_date('M j, Y').'</span></h5>';
									echo '</a>';
									endwhile;
								}
							}
						} ?>
					</div>
				</div>
			<?php } ?>

			<?php

						// If comments are open or we have at least one comment, load up the comment template.
			// if ( comments_open() || get_comments_number() ) {
			// 	comments_template();
			// }
			if ( is_singular( 'attachment' ) ) {
				// Parent post navigation.
				the_post_navigation( array(
					'prev_text' => _x( '<span class="meta-nav">Published in</span><span class="post-title">%title</span>', 'Parent post link', 'yttheme' ),
				) );
			} elseif ( is_singular( 'post' ) ) {
				// Previous/next post navigation.
				the_post_navigation( array(
					'next_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Next', 'yttheme' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Next post:', 'yttheme' ) . '</span> ' .
						'<span class="post-title">%title</span>',
					'prev_text' => '<span class="meta-nav" aria-hidden="true">' . __( 'Previous', 'yttheme' ) . '</span> ' .
						'<span class="screen-reader-text">' . __( 'Previous post:', 'yttheme' ) . '</span> ' .
						'<span class="post-title">%title</span>',
				) );
			}
			// End of the loop.
		endwhile;
		?>
		<br class="clear"/>
	</main><!-- .site-main -->
<?php get_sidebar(); ?>

</div><!-- .content-area -->

<?php get_footer(); ?>

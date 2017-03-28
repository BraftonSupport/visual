<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
$options = get_option( 'yttheme_options' );
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php yttheme_excerpt(); ?>

	<?php yttheme_post_thumbnail('full'); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		<?php yttheme_entry_meta(); ?>
				<div class="cat"><?php the_category(' '); ?></div>
				<?php if ( $options['ssbutton'] ) {
					echo social_sharing_buttons($content);
				} ?>
	</header><!-- .entry-header -->

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

	<footer class="entry-footer">
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


</article><!-- #post-## -->
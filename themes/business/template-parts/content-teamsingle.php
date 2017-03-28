<?php
/**
 * The template part for displaying single posts
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<header class="entry-header">
		<?php yttheme_post_thumbnail('full'); ?>
		<div class="meta">
			<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
			<h3><?php echo get_field('right_box'); ?></h3>
		</div>
	</header><!-- .entry-header -->

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

	<div class="entry-content">
	<?php
		$left = balanceTags(get_post_meta( get_queried_object_id(), 'left_box', true ));
		//$right = balanceTags(get_post_meta( get_queried_object_id(), 'right_box', true )); ?>
		<?php
			echo '<div>'.$left.'</div>';
			//echo '<div>'.$right.'</div>';
			//the_content();

			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'yttheme' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'yttheme' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
		?>
	</div><!-- .entry-content -->

</article><!-- #post-## -->
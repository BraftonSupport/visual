<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
$color = get_post_meta( get_queried_object_id(), 'textcolor', true );
if ( !$video ) {
	$featured = has_post_thumbnail();
	$bg = get_post_meta( get_queried_object_id(), 'bgcolor', true );
	$shadow = get_post_meta( get_queried_object_id(), 'shadow', true );
	$banner = get_post_meta( get_queried_object_id(), 'banner', true );
}
get_header(); ?>


<?php if ( $banner ) { ?>
<section>
	<div style="<?php
			if ( $bg ) { echo 'background-color: ' . $bg . ';'; }
			if ( $color ) { echo 'color: ' . $color . ';'; }
			if ( $featured ) {
				echo 'background-image: url(';
				the_post_thumbnail_url();
				echo ');';
			} 
		?>" class="background">

		<div class="overlay">
			<div class="site-inner">
				<?php // Define custom fields
				//$headline = get_field('headline');
				$tagline = get_field('tagline');
				$btntxt = get_field('go_to_button_txt');
				$btnurl = get_field('go_to_button_url'); ?>

				<?php // headline
					// display page title over banner image
					echo '<section class="static">';
					echo "<h2>";
					echo the_title();
					echo "</h2>"; ?>

				<?php // tagline
					if ($tagline) {
						echo "<p class='tagline'>";
						echo $tagline;
						echo "</p>";
					} ?>

				<?php // button
					if ($btntxt) {
						echo "<a class='button' href=";
						echo $btnurl;
						echo ">";
						echo $btntxt;
						echo "</a>";
					} ?>

				<?php if ($headline) {
					// Close the container around the static section
					echo '</section>';
				} ?>

</div></div></div><?php if ( $shadow ) { echo '<hr class="shadow"/>'; } ?></section>
<?php } ?>

<div id="primary" class="content-area site-inner">
	<main id="main" class="site-main" role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post(); ?>

			<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

				<?php if (!$banner) { ?>
					<header class="entry-header">
						<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					</header><!-- .entry-header -->
				<?php } ?>

				<div class="entry-content">
					<?php 
						if (!$banner) {
							if (has_post_thumbnail() ) { 
								echo '<div class="inline-thumb">';
								echo the_post_thumbnail(); 
								echo '</div>';
							} 
						}

						the_content();

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

				<?php
					edit_post_link(
						sprintf(
							/* translators: %s: Name of current post */
							__( 'Edit<span class="screen-reader-text"> "%s"</span>', 'yttheme' ),
							get_the_title()
						),
						'<footer class="entry-footer"><span class="edit-link">',
						'</span></footer><!-- .entry-footer -->'
					);
				?>

			</article><!-- #post-## -->

		<?php
		endwhile;
		?>

	</main><!-- .site-main -->

</div><!-- .content-area -->
<?php get_footer(); ?>

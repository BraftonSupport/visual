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
					<!--<header class="entry-header">
						<?php // the_title( '<h1 class="entry-title">', '</h1>' ); ?>
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
					<?php if (is_page('About Us') ) { ?>

						<div class="team">

							<h2><?php echo get_field('our_team_h2'); ?></h2>

							<div class="bio">
								<?php echo get_field('our_team_content'); ?>
							</div>

							<?php // queue the 3  most recent awards 

							$team_array = array('post_type' => 'team', 'posts_per_page' => -1);
							$loop = new WP_QUERY ($team_array);

							if ($loop->have_posts() ) :

							while ($loop->have_posts() ) : $loop->the_post(); 
							$thumbnail = get_the_post_thumbnail_url();

							?>

							<div class="team-member">
								<a href="<?php the_permalink(); ?>"><div class="featured" style="background-image: url(<?php echo $thumbnail; ?>);"></div></a>
								<h3><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
								<span class="title"><?php echo get_field('right_box'); ?></span>
							</div>

							<?php endwhile; endif; wp_reset_query(); ?>

						</div>

					<?php } ?>
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
	</main><!-- .site-main -->

	<aside id="secondary" class="sidebar widget-area" role="complementary">
		<?php // Sidebar fields
			$cta 		= get_field('sidebar_cta');
			$ctatxt 	= get_field('sidebar_cta_text');
			$ctaurl 	= get_field('sidebar_cta_url');
			$vidstring 	= get_field('vid_src');
			$cta2 		= get_field('sidebar_cta_2');
			$cta2txt 	= get_field('sidebar_cta_#2_text');
			$cta2url 	= get_field('sidebar_cta_#2_url');
		?>
		<?php if (is_page('Contact Us') ) { ?>	
		ugh
			<?php echo get_field('address'); ?>
		<?php } ?>
		<?php
		endwhile;
		?>
		<?php if ($cta) { ?>
			<div class="cta long" style="background-image: url('<?php echo $cta; ?>');">
				<div class="overlay">
					<a href="<?php echo $ctaurl; ?>"><h3><?php echo $ctatxt; ?></h3></a>
				</div>
			</div>
		<?php } ?>
		<?php if ($vidstring) { ?>
			<video id="sidebarvid" controls="" preload="auto">
				<source src="<?php echo $vidstring; ?>" type="video/mp4">
			</video>
		<?php } ?>
		<?php if ($cta2) { ?>
			<div class="cta" style="background-image: url('<?php echo $cta2; ?>');">
				<div class="overlay">
					<a href="<?php echo $cta2url; ?>"><h3><?php echo $cta2txt; ?></h3></a>
				</div>
			</div>
		<?php } ?>
	</aside>

</div><!-- .content-area -->

<?php $footcta = get_field('footer_cta');
	  $footurl = get_field('footer_cta_url');
	  $footbtn = get_field('footer_cta_btn'); ?>

<?php if ($footcta) { ?>
	<div class="footer-cta">
		<div class="site-inner">
			<?php echo $footcta; ?>
			<?php if ($footurl) { ?>
				<a class="button" href="<?php echo $footurl; ?>"><?php echo $footbtn; ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>

<?php get_footer(); ?>

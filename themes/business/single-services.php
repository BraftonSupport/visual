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
						$mainimg = get_field('main_image');
						if (!$banner) {
							if ($mainimg) { 
								echo '<div class="inline-thumb">';
								echo '<img src="';
								echo $mainimg;
								echo '" />';
								echo '</div>';
							} 
						}

						echo '<div class="title">';
						echo '<div class="thumb">';
						echo the_post_thumbnail(); 
						echo '</div><div class="entry-meta">';
						echo '<h1>';
						echo the_title(); 
						echo '</h1>';
						echo '<p>';
						echo get_field('description');
						echo '</p>';
						echo '</div></div>';

						echo get_field('page_content'); 

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

		<?php
		endwhile;
		?>

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


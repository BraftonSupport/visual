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

/* Template Name: FAQs */

get_header(); ?>

	<div id="primary" class="content-area site-inner">
		
		<h1><?php the_title(); ?></h1>
		<main id="main" class="site-main" role="main">

		<?php // queue the 3  most recent webinars 

			$array = array('post_type' => 'faq', 'posts_per_page' => -1);
			query_posts($array);

			if (have_posts() ) :

			while (have_posts() ) : the_post(); 

			?>

					<article id="post-<?php the_ID(); ?>" class="faq">

						<h2><?php the_title(); ?></h2>

						<div class="entry-content">

							<?php the_content(); ?>

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

		endif; wp_reset_query();
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

<?php get_footer(); ?>

<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
$options = get_option( 'yttheme_options' );

?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<?php if ( is_singular() && pings_open( get_queried_object() ) ) : ?>
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php endif; ?>
	<?php wp_head(); ?>

<?php

if ( $options['ga'] ) : ?>
	<!-- Google Analytics -->
		<script>
		  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
		  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
		  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
		  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

		  ga('create', '<?php echo $options['ga']; ?>', 'auto');
		  ga('send', 'pageview');
		</script>
	<!-- End Google Analytics -->
<?php endif; ?>

</head>

<body <?php body_class(); ?>>
	<div id="top"></div>
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'yttheme' ); ?></a>

		<header id="masthead" class="site-header <?php if ($options['stickynav']) { ?>fixed<?php } ?>" role="banner">
			<div class="site-header-main">
				<div class="site-inner container">
					<div class="site-branding">

						<?php if ( get_theme_mod( 'yttheme_logo' ) ) { ?>
							<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
								<?php
								// set the image url
								$image_url = esc_url( get_theme_mod( 'yttheme_logo' ) );
								 
								// store the image ID in a var
								$image_id = yttheme_get_image_id($image_url);
								 
								// retrieve the thumbnail size of our image
								$image_thumb = wp_get_attachment_image_src($image_id, 'medium'); ?>

								<img src='<?php echo $image_thumb[0]; ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
								<?php if ( has_site_icon() ){ ?>
									<img src='<?php echo get_site_icon_url( 32 ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-icon">
								<?php } ?>
							</a>
						<?php } else { ?>
							<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
						<?php }

						$description = get_bloginfo( 'description', 'display' );
						if ( $description || is_customize_preview() ) : ?>
							<p class="site-description"><?php echo $description; ?></p>
						<?php endif; ?>
					</div><!-- .site-branding -->

					<div class="next">

					<?php if ( is_active_sidebar( 'header' ) ) {
						dynamic_sidebar( 'header' );
					}
					//if ( $options['ssbutton'] ) {
						//echo social_sharing_buttons($content);
					//}
					?>

					<button id="menu-toggle" class="menu-toggle"><?php _e( 'Menu', 'yttheme' ); ?></button>

					
				<?php if ($options['nav'] == 'below') { echo "</div></div>"; } ?>

					<div id="site-header-menu" class="site-header-menu<?php if ($options['nav'] == 'below') { echo " below"; } ?>">

						<?php if ( has_nav_menu( 'social' ) ) : ?>
							<nav id="social-navigation" class="social-navigation<?php if ($options['nav'] == 'below') { echo " container"; } ?>" role="navigation" aria-label="<?php esc_attr_e( 'Social Links Menu', 'yttheme' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'social',
										'menu_class'     => 'social-links-menu',
										'depth'          => 1,
										'link_before'    => '<span class="screen-reader-text">',
										'link_after'     => '</span>',
									) );
								?>
							</nav><!-- .social-navigation -->
						<?php endif; ?>

						<?php if ( has_nav_menu( 'primary' ) ) : ?>
							<nav id="site-navigation" class="main-navigation<?php if ($options['nav'] == 'below') { echo " container site-inner"; } ?>" role="navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'yttheme' ); ?>">
								<?php
									wp_nav_menu( array(
										'theme_location' => 'primary',
										'menu_class'     => 'primary-menu',
									 ) );
								?>
							</nav><!-- .main-navigation -->
						<?php endif; ?>
					</div><!-- .site-header-menu -->
					<div class="header-right">
						<span class="phone"><a href="tel:2124474300"><i class="fa fa-phone"></i> 212-447-4300</a></span>
						<!--<a class="button">Search</a>
						<div id="header-search-form">
							<?php echo get_search_form(); ?>
						</div>-->
					</div>
				<?php //if ($options['nav'] == 'below') { echo '</div>'; } ?>
				<?php if ($options['nav'] == 'next') { echo '</div></div>'; } ?>
			</div><!-- .site-header-main -->
		</header>

		<?php if ($options['stickynav']) { ?>

		<div id="spacer"></div>

		<?php } ?>


	<div id="content" class="site-content">
		<?php $banner = get_post_meta( get_queried_object_id(), 'banner', true ); ?>
		<div class="breadcrumbs <?php if ($banner) { echo 'dark'; } ?>">
			<div class="site-inner">
				<?php if (!is_front_page() ) { ?>
					<?php echo the_breadcrumb(); ?>
				<?php } ?>
			</div>
		</div>
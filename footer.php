<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */
?>

	</div><!-- .site-content -->

	<footer id="colophon" class="site-footer" role="contentinfo">

		<?php if ( is_active_sidebar( 'footer' ) ) :
			echo '<div class="site-inner container';
			echo ' w';
			echo get_widgets_count( 'footer' );
			echo '">';
			dynamic_sidebar( 'footer' );
			echo '</div><br class="clear"/>';
		endif; ?>
			
		<div class="site-info"><div class="site-inner container">
			<?php // if ( get_theme_mod( 'yttheme_logo' ) ) { ?>
				<!--<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
					<img src='<?php echo esc_url( get_theme_mod( 'yttheme_logo' ) ); ?>' alt='<?php echo esc_attr( get_bloginfo( 'name', 'display' ) ); ?>' class="site-title">
				</a>-->
			<?php // } ?>

			<?php if ( has_nav_menu( 'social' ) ) : ?>
				<nav class="social-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Footer Social Links Menu', 'yttheme' ); ?>">
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

			<?php
				/**
				 * Fires before the yttheme footer text for footer customization.
				 *
				 * @since Diving Bell 1.0
				 */
				do_action( 'yttheme_credits' );
			?>
		</div><p class="copyright"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">&copy; <?php echo date('Y'); ?> <?php bloginfo( 'name' ); ?></a></p>
		</div><!-- .site-info -->
	</footer><!-- .site-footer -->
	<div id="scrollTopbutton">
		<a href="#top"><i class="fa fa-chevron-up" aria-hidden="true"></i></a>
		<a href="#colophon"><i class="fa fa-chevron-down" aria-hidden="true"></i></a>
	</div>
</div><!-- .site -->

<?php wp_footer(); ?>
</body>
</html>
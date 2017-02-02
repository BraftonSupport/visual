<?php
/**
 * Diving Bell Customizer functionality
 *
 * @package WordPress
 * @subpackage Twenty_Sixteen
 * @since Diving Bell 1.0
 */

/**
 * Sets up the WordPress core custom header and custom background features.
 *
 * @since Diving Bell 1.0
 *
 * @see yttheme_header_style()
 */
function yttheme_custom_header_and_background() {
	$color_scheme             = yttheme_get_color_scheme();
	$default_background_color = trim( $color_scheme[0], '#' );
	$default_text_color       = trim( $color_scheme[4], '#' );

	/**
	 * Filter the arguments used when adding 'custom-background' support in Diving Bell.
	 *
	 * @since Diving Bell 1.0
	 *
	 * @param array $args {
	 *     An array of custom-background support arguments.
	 *
	 *     @type string $default-color Default color of the background.
	 * }
	 */
	add_theme_support( 'custom-background', apply_filters( 'yttheme_custom_background_args', array(
		'default-color' => $default_background_color,
	) ) );

	/**
	 * Filter the arguments used when adding 'custom-header' support in Diving Bell.
	 *
	 * @since Diving Bell 1.0
	 *
	 * @param array $args {
	 *     An array of custom-header support arguments.
	 *
	 *     @type string $default-text-color Default color of the header text.
	 *     @type int      $width            Width in pixels of the custom header image. Default 1200.
	 *     @type int      $height           Height in pixels of the custom header image. Default 280.
	 *     @type bool     $flex-height      Whether to allow flexible-height header images. Default true.
	 *     @type callable $wp-head-callback Callback function used to style the header image and text
	 *                                      displayed on the blog.
	 * }
	 */
	add_theme_support( 'custom-header', apply_filters( 'yttheme_custom_header_args', array(
		'default-text-color'     => $default_text_color,
		'width'                  => 1200,
		'height'                 => 280,
		'flex-height'            => true,
		'wp-head-callback'       => 'yttheme_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'yttheme_custom_header_and_background' );

if ( ! function_exists( 'yttheme_header_style' ) ) :
/**
 * Styles the header text displayed on the site.
 *
 * Create your own yttheme_header_style() function to override in a child theme.
 *
 * @since Diving Bell 1.0
 *
 * @see yttheme_custom_header_and_background().
 */
function yttheme_header_style() {
	// If the header text option is untouched, let's bail.
	if ( display_header_text() ) {
		return;
	}

	// If the header text has been hidden.
	?>
	<style type="text/css" id="yttheme-header-css">
		.site-branding {
			margin: 0 auto 0 0;
		}

		.site-branding .site-title,
		.site-description {
			clip: rect(1px, 1px, 1px, 1px);
			position: absolute;
		}
	</style>
	<?php
}
endif; // yttheme_header_style

/**
 * Adds postMessage support for site title and description for the Customizer.
 *
 * @since Diving Bell 1.0
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function yttheme_customize_register( $wp_customize ) {
	$color_scheme = yttheme_get_color_scheme();

	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';

	// Add color scheme setting and control.
	$wp_customize->add_setting( 'color_scheme', array(
		'default'           => 'default',
		'sanitize_callback' => 'yttheme_sanitize_color_scheme',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'color_scheme', array(
		'label'    => __( 'Base Color Scheme', 'yttheme' ),
		'section'  => 'colors',
		'type'     => 'select',
		'choices'  => yttheme_get_color_scheme_choices(),
		'priority' => 1,
	) );

	// Add page background color setting and control.
	$wp_customize->add_setting( 'secondary_background_color', array(
		'default'           => $color_scheme[1],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_background_color', array(
		'label'       => __( 'Secondary Background Color', 'yttheme' ),
		'section'     => 'colors',
	) ) );

	// Remove the core header textcolor control, as it shares the main text color.
	$wp_customize->remove_control( 'header_textcolor' );

	// Add link color setting and control.
	$wp_customize->add_setting( 'link_color', array(
		'default'           => $color_scheme[2],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_color', array(
		'label'       => __( 'Link Color', 'yttheme' ),
		'section'     => 'colors',
	) ) );

	// Add link hover color setting and control.
	$wp_customize->add_setting( 'link_hover_color', array(
		'default'           => $color_scheme[3],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'link_hover_color', array(
		'label'       => __( 'Link Hover Color', 'yttheme' ),
		'section'     => 'colors',
	) ) );

	// Add main text color setting and control.
	$wp_customize->add_setting( 'main_text_color', array(
		'default'           => $color_scheme[4],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'main_text_color', array(
		'label'       => __( 'Main Text Color', 'yttheme' ),
		'section'     => 'colors',
	) ) );

	// Add secondary text color setting and control.
	$wp_customize->add_setting( 'secondary_text_color', array(
		'default'           => $color_scheme[5],
		'sanitize_callback' => 'sanitize_hex_color',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'secondary_text_color', array(
		'label'       => __( 'Secondary Text Color', 'yttheme' ),
		'section'     => 'colors',
	) ) );
}
add_action( 'customize_register', 'yttheme_customize_register', 11 );

/**
 * Registers color schemes for Diving Bell.
 *
 * Can be filtered with {@see 'yttheme_color_schemes'}.
 *
 * The order of colors in a colors array:
 * 1. Main Background Color.
 * 2. Page Background Color.
 * 3. Link Color.
 * 4. Link Hover Color.
 * 5. Main Text Color.
 * 6. Secondary Text Color.
 *
 * @since Diving Bell 1.0
 *
 * @return array An associative array of color scheme options.
 */
function yttheme_get_color_schemes() {
	/**
	 * Filter the color schemes registered for use with Diving Bell.
	 *
	 * The default schemes include 'default', 'dark', 'gray', 'red', and 'blue'.
	 *
	 * @since Diving Bell 1.0
	 *
	 * @param array $schemes {
	 *     Associative array of color schemes data.
	 *
	 *     @type array $slug {
	 *         Associative array of information for setting up the color scheme.
	 *
	 *         @type string $label  Color scheme label.
	 *         @type array  $colors HEX codes for default colors prepended with a hash symbol ('#').
	 *                              Colors are defined in the following order: Main background, page
	 *                              background, link, link hover, main text, secondary text.
	 *     }
	 * }
	 */
	return apply_filters( 'yttheme_color_schemes', array(
		'default' => array(
			'label'  => __( 'Default', 'yttheme' ),
			'colors' => array(
				'#f0f0f0',
				'#cccccc',
				'#007acc',
				'#00b1dd',
				'#1a1a1a',
				'#686868',
			),
		),
		'dark' => array(
			'label'  => __( 'Dark', 'yttheme' ),
			'colors' => array(
				'#222222',
				'#111111',
				'#845740',
				'#ce8133',
				'#bababa',
				'#999999',
			),
		),
		'gray' => array(
			'label'  => __( 'Gray', 'yttheme' ),
			'colors' => array(
				'#616a73',
				'#4d545c',
				'#9ab28d',
				'#66ddff',
				'#f5f5f5',
				'#cecece',
			),
		),
		'red' => array(
			'label'  => __( 'Red', 'yttheme' ),
			'colors' => array(
				'#dddddd',
				'#dd3838',
				'#000000',
				'#ff8c8c',
				'#770000',
				'#ffbbbb',
			),
		),
		'blue' => array(
			'label'  => __( 'Blue', 'yttheme' ),
			'colors' => array(
				'#cceeff',
				'#005791',
				'#00a9ff',
				'#87a6c1',
				'#333333',
				'#ffffff',
			),
		),
	) );
}

if ( ! function_exists( 'yttheme_get_color_scheme' ) ) :
/**
 * Retrieves the current Diving Bell color scheme.
 *
 * Create your own yttheme_get_color_scheme() function to override in a child theme.
 *
 * @since Diving Bell 1.0
 *
 * @return array An associative array of either the current or default color scheme HEX values.
 */
function yttheme_get_color_scheme() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );
	$color_schemes       = yttheme_get_color_schemes();

	if ( array_key_exists( $color_scheme_option, $color_schemes ) ) {
		return $color_schemes[ $color_scheme_option ]['colors'];
	}

	return $color_schemes['default']['colors'];
}
endif; // yttheme_get_color_scheme

if ( ! function_exists( 'yttheme_get_color_scheme_choices' ) ) :
/**
 * Retrieves an array of color scheme choices registered for Diving Bell.
 *
 * Create your own yttheme_get_color_scheme_choices() function to override
 * in a child theme.
 *
 * @since Diving Bell 1.0
 *
 * @return array Array of color schemes.
 */
function yttheme_get_color_scheme_choices() {
	$color_schemes                = yttheme_get_color_schemes();
	$color_scheme_control_options = array();

	foreach ( $color_schemes as $color_scheme => $value ) {
		$color_scheme_control_options[ $color_scheme ] = $value['label'];
	}

	return $color_scheme_control_options;
}
endif; // yttheme_get_color_scheme_choices


if ( ! function_exists( 'yttheme_sanitize_color_scheme' ) ) :
/**
 * Handles sanitization for Diving Bell color schemes.
 *
 * Create your own yttheme_sanitize_color_scheme() function to override
 * in a child theme.
 *
 * @since Diving Bell 1.0
 *
 * @param string $value Color scheme name value.
 * @return string Color scheme name.
 */
function yttheme_sanitize_color_scheme( $value ) {
	$color_schemes = yttheme_get_color_scheme_choices();

	if ( ! array_key_exists( $value, $color_schemes ) ) {
		return 'default';
	}

	return $value;
}
endif; // yttheme_sanitize_color_scheme

/**
 * Enqueues front-end CSS for color scheme.
 *
 * @since Diving Bell 1.0
 *
 * @see wp_add_inline_style()
 */
function yttheme_color_scheme_css() {
	$color_scheme_option = get_theme_mod( 'color_scheme', 'default' );

	// Don't do anything if the default color scheme is selected.
	if ( 'default' === $color_scheme_option ) {
		return;
	}

	$color_scheme = yttheme_get_color_scheme();

	// Convert main text hex color to rgba.
	$color_textcolor_rgb = yttheme_hex2rgb( $color_scheme[4] );
	$color_linkcolor_rgb = yttheme_hex2rgb( $color_scheme[2] );

	// If the rgba values are empty return early.
	if ( empty( $color_textcolor_rgb ) || empty( $color_linkcolor_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$colors = array(
		'background_color'      => $color_scheme[0],
		'secondary_background_color' => $color_scheme[1],
		'link_color'            => $color_scheme[2],
		'link_hover_color'      => $color_scheme[3],
		'main_text_color'       => $color_scheme[4],
		'secondary_text_color'  => $color_scheme[5],
		'border_color'          => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $color_textcolor_rgb ),
		'secondlink_color'      => vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.35)', $color_linkcolor_rgb ),
		'secondlink_hover_color'=> vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.75)', $color_linkcolor_rgb ),

	);

	$color_scheme_css = yttheme_get_color_scheme_css( $colors );

	wp_add_inline_style( 'yttheme-style', $color_scheme_css );
}
add_action( 'wp_enqueue_scripts', 'yttheme_color_scheme_css' );

/**
 * Binds the JS listener to make Customizer color_scheme control.
 *
 * Passes color scheme data as colorScheme global.
 *
 * @since Diving Bell 1.0
 */
function yttheme_customize_control_js() {
	wp_enqueue_script( 'color-scheme-control', get_template_directory_uri() . '/js/color-scheme-control.js', array( 'customize-controls', 'iris', 'underscore', 'wp-util' ), '20150825', true );
	wp_localize_script( 'color-scheme-control', 'colorScheme', yttheme_get_color_schemes() );
}
add_action( 'customize_controls_enqueue_scripts', 'yttheme_customize_control_js' );

/**
 * Binds JS handlers to make the Customizer preview reload changes asynchronously.
 *
 * @since Diving Bell 1.0
 */
function yttheme_customize_preview_js() {
	wp_enqueue_script( 'yttheme-customize-preview', get_template_directory_uri() . '/js/customize-preview.js', array( 'customize-preview' ), '20150825', true );
}
add_action( 'customize_preview_init', 'yttheme_customize_preview_js' );

/**
 * Returns CSS for the color schemes.
 *
 * @since Diving Bell 1.0
 *
 * @param array $colors Color scheme colors.
 * @return string Color scheme CSS.
 */

function yttheme_get_color_scheme_css( $colors ) {
	$colors = wp_parse_args( $colors, array(
		'background_color'      => '',
		'secondary_background_color' => '',
		'link_color'            => '',
		'link_hover_color'      => '',
		'main_text_color'       => '',
		'secondary_text_color'  => '',
		'border_color'          => '',
		'secondlink_color'      => '',
		'secondlink_hover_color'      => '',
	) );

	return <<<CSS
	/* Color Scheme */

	/* Background Color */
	body {
		background-color: {$colors['background_color']};
	}

	/* Secondary Background Color */
	body:not(.search-results) .entry-summary,
	.site-header-main.scrolled,
	.secondary,
	.site-footer,
	.site-header-menu.below,
	#top {
		background-color: {$colors['secondary_background_color']};
		color: {$colors['secondary_text_color']};
	}

	mark,
	ins,
	.button,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev,
	.pagination .next,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.pagination .nav-links:before,
	.pagination .nav-links:after,
	.widget_calendar tbody a,
	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus,
	.page-links a,
	.page-links a:hover,
	.page-links a:focus,
	.team .container:first-of-type .previous.button,
	.team .container:last-of-type .next.button,
	.team .container:first-of-type .previous.button:hover,
	.team .container:last-of-type .next.button:hover,
	.simple .entry-header,
	.hero .more-link {
		color: {$colors['secondary_background_color']};
	}

	/* Link Color */

	.latest h5 {
		background: {$colors['secondlink_color']};
	}
	.latest a:hover h5 {
		background: {$colors['secondlink_hover_color']};
	}

	a,
	.menu-toggle:hover,
	.menu-toggle:focus,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.post-navigation a,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.required {
		color: {$colors['link_color']};
	}

	mark,
	ins,
	.button,
	button,
	button[disabled]:hover,
	button[disabled]:focus,
	input[type="button"],
	input[type="button"][disabled]:hover,
	input[type="button"][disabled]:focus,
	input[type="reset"],
	input[type="reset"][disabled]:hover,
	input[type="reset"][disabled]:focus,
	input[type="submit"],
	input[type="submit"][disabled]:hover,
	input[type="submit"][disabled]:focus,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination .prev:hover,
	.pagination .prev:focus,
	.pagination .next:hover,
	.pagination .next:focus,
	.widget_calendar tbody a,
	.page-links a:hover,
	.page-links a:focus,
	.team .container:first-of-type .previous.button,
	.team .container:last-of-type .next.button,
	.team .container:first-of-type .previous.button:hover,
	.team .container:last-of-type .next.button:hover,
	.simple .entry-header,
	.hero .more-link {
		background-color: {$colors['link_color']};
	}

	input[type="text"]:focus,
	input[type="email"]:focus,
	input[type="url"]:focus,
	input[type="password"]:focus,
	input[type="search"]:focus,
	select:focus,
	textarea:focus,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.menu-toggle:hover,
	.menu-toggle:focus {
		border-color: {$colors['link_color']};
	}

	/* Link Hover Color */
	blockquote,
	.post-password-form label,
	a:hover,
	a:focus,
	a:active,
	.post-navigation .meta-nav,
	.image-navigation,
	.comment-navigation,
	.widget_recent_entries .post-date,
	.widget_rss .rss-date,
	.widget_rss cite,
	.author-bio,
	.entry-footer,
	.entry-footer a:hover,
	.entry-footer a:focus,
	.sticky-post,
	.taxonomy-description,
	.entry-caption,
	.comment-metadata,
	.pingback .edit-link,
	.comment-metadata a,
	.pingback .comment-edit-link,
	.comment-form label,
	.comment-notes,
	.comment-awaiting-moderation,
	.logged-in-as,
	.form-allowed-tags,
	.site-info,
	.wp-caption .wp-caption-text,
	.gallery-caption,
	.widecolumn label,
	.widecolumn .mu_register label,
	.menu-toggle:hover,
	.menu-toggle:focus,
	.main-navigation a:hover,
	.main-navigation a:focus,
	.dropdown-toggle:hover,
	.dropdown-toggle:focus,
	.post-navigation a:hover .post-title,
	.post-navigation a:focus .post-title,
	.tagcloud a:hover,
	.tagcloud a:focus,
	.site-branding .site-title a:hover,
	.site-branding .site-title a:focus,
	.entry-title a:hover,
	.entry-title a:focus,
	.comment-metadata a:hover,
	.comment-metadata a:focus,
	.pingback .comment-edit-link:hover,
	.pingback .comment-edit-link:focus,
	.comment-reply-link,
	.comment-reply-link:hover,
	.comment-reply-link:focus,
	.social-navigation a:hover:before,
	.social-navigation a:focus:before,
	.required {
		color: {$colors['link_hover_color']};
	}

	/* Main Text Color */
	body,
	button,
	input,
	textarea,
	blockquote cite,
	blockquote small,
	.main-navigation a,
	.menu-toggle,
	.dropdown-toggle,
	.widget-title a,
	.site-branding .site-title a,
	.entry-title a,
	.page-links > .page-links-title,
	.comment-author,
	.comment-reply-title small a:hover,
	.comment-reply-title small a:focus {
		color: {$colors['main_text_color']};
	}

	blockquote,
	.menu-toggle.toggled-on,
	.menu-toggle.toggled-on:hover,
	.menu-toggle.toggled-on:focus,
	.pagination,
	.page-links a,
	.comments-title,
	.comment-reply-title {
		border-color: {$colors['main_text_color']};
	}

	.button:hover,
	button:hover,
	button:focus,
	input[type="button"]:hover,
	input[type="button"]:focus,
	input[type="reset"]:hover,
	input[type="reset"]:focus,
	input[type="submit"]:hover,
	input[type="submit"]:focus,
	.pagination:before,
	.pagination:after,
	.pagination .prev,
	.pagination .next,
	.page-links a,
	.hero .more-link:hover {
		background-color: {$colors['main_text_color']};
	}

	.button:hover,
	.social-navigation a,
	.hero .more-link:hover {
		color: {$colors['secondary_text_color']};
	}

	.widget_calendar tbody a:hover,
	.widget_calendar tbody a:focus {
		background-color: {$colors['secondary_text_color']};
	}

	/* Border Color */
	fieldset,
	pre,
	abbr,
	acronym,
	table,
	th,
	td,
	input[type="text"],
	input[type="email"],
	input[type="url"],
	input[type="password"],
	input[type="search"],
	select,
	textarea,
	.main-navigation li,
	.main-navigation .primary-menu,
	.menu-toggle,
	.dropdown-toggle:after,
	.image-navigation,
	.comment-navigation,
	.tagcloud a,
	.entry-content,
	.entry-summary,
	.page-links a,
	.page-links > span,
	.comment-list article,
	.comment-list .pingback,
	.comment-list .trackback,
	.comment-reply-link,
	.no-comments,
	.widecolumn .mu_register .mu_alert {
		border-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		border-color: {$colors['border_color']};
	}

	.post-navigation {
		border-color: {$colors['border_color']};
	}

	hr,
	code {
		background-color: {$colors['main_text_color']}; /* Fallback for IE7 and IE8 */
		background-color: {$colors['border_color']};
	}

	@media screen and (min-width: 56.875em) {
		.main-navigation li:hover > a,
		.main-navigation li.focus > a {
			color: {$colors['link_color']};
		}

		.main-navigation ul ul,
		.main-navigation ul ul li {
			border-color: {$colors['border_color']};
		}

		.main-navigation ul ul:before {
			border-top-color: {$colors['border_color']};
			border-bottom-color: {$colors['border_color']};
		}

		.main-navigation ul ul li {
			background-color: {$colors['secondary_background_color']};
		}

		.main-navigation ul ul:after {
			border-top-color: {$colors['secondary_background_color']};
			border-bottom-color: {$colors['secondary_background_color']};
		}
	}

CSS;
}


/**
 * Outputs an Underscore template for generating CSS for the color scheme.
 *
 * The template generates the css dynamically for instant display in the
 * Customizer preview.
 *
 * @since Diving Bell 1.0
 */
function yttheme_color_scheme_css_template() {
	$colors = array(
		'background_color'      => '{{ data.background_color }}',
		'secondary_background_color' => '{{ data.secondary_background_color }}',
		'link_color'            => '{{ data.link_color }}',
		'link_hover_color'      => '{{ data.link_hover_color }}',
		'main_text_color'       => '{{ data.main_text_color }}',
		'secondary_text_color'  => '{{ data.secondary_text_color }}',
		'border_color'          => '{{ data.border_color }}',
		'secondlink_color'		=> '{{ data.secondlink_color }}',
	);
	?>
	<script type="text/html" id="tmpl-yttheme-color-scheme">
		<?php echo yttheme_get_color_scheme_css( $colors ); ?>
	</script>
	<?php
}
add_action( 'customize_controls_print_footer_scripts', 'yttheme_color_scheme_css_template' );

/**
 * Enqueues front-end CSS for the secondary background color.
 *
 * @since Diving Bell 1.0
 *
 * @see wp_add_inline_style()
 */
function yttheme_secondary_background_color_css() {
	$color_scheme          = yttheme_get_color_scheme();
	$default_color         = $color_scheme[1];
	$secondary_background_color = get_theme_mod( 'secondary_background_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_background_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Page Background Color */
		body:not(.search-results) .entry-summary,
		.secondary,
		.site-footer,
		.site-header-menu.below,
		#top {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'yttheme-style', sprintf( $css, $secondary_background_color ) );
}
add_action( 'wp_enqueue_scripts', 'yttheme_secondary_background_color_css', 11 );

/**
 * Enqueues front-end CSS for the link color.
 *
 * @since Diving Bell 1.0
 *
 * @see wp_add_inline_style()
 */
function yttheme_link_color_css() {
	$color_scheme    = yttheme_get_color_scheme();
	$default_color   = $color_scheme[2];
	$link_color = get_theme_mod( 'link_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_color === $default_color ) {
		return;
	}

	// Convert link hex color to rgba.
	$link_color_rgb = yttheme_hex2rgb( $link_color );

	// If the rgba values are empty return early.
	if ( empty( $link_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$secondlink_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.35)', $link_color_rgb );
	$secondlink_hover_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.75)', $link_color_rgb );

	$css = '
		.latest h5 {
		background-color: %2$s;
		}
		.latest a:hover h5 {
		background-color: %3$s;
		}

		/* Custom Link Color */
		a,
		.menu-toggle:hover,
		.menu-toggle:focus,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.required {
			color: %1$s;
		}

		mark,
		ins,
		.button,
		button,
		button[disabled]:hover,
		button[disabled]:focus,
		input[type="button"],
		input[type="button"][disabled]:hover,
		input[type="button"][disabled]:focus,
		input[type="reset"],
		input[type="reset"][disabled]:hover,
		input[type="reset"][disabled]:focus,
		input[type="submit"],
		input[type="submit"][disabled]:hover,
		input[type="submit"][disabled]:focus,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus,
		.team .container:first-of-type .previous.button,
		.team .container:last-of-type .next.button,
		.team .container:first-of-type .previous.button:hover,
		.team .container:last-of-type .next.button:hover,
		.simple .entry-header,
		.hero .more-link {
			background-color: %1$s;
		}

		input[type="text"]:focus,
		input[type="email"]:focus,
		input[type="url"]:focus,
		input[type="password"]:focus,
		input[type="search"]:focus,
		select:focus,
		textarea:focus,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.menu-toggle:hover,
		.menu-toggle:focus {
			border-color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'yttheme-style', sprintf( $css, $link_color, $secondlink_color, $secondlink_hover_color ) );
}
add_action( 'wp_enqueue_scripts', 'yttheme_link_color_css', 11 );

function yttheme_link_hover_color_css() {
	$color_scheme    = yttheme_get_color_scheme();
	$default_color   = $color_scheme[3];
	$link_hover_color = get_theme_mod( 'link_hover_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $link_hover_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Link Color */
		blockquote,
		.post-password-form label,
		a:hover,
		a:focus,
		a:active,
		.post-navigation .meta-nav,
		.image-navigation,
		.comment-navigation,
		.widget_recent_entries .post-date,
		.widget_rss .rss-date,
		.widget_rss cite,
		.site-description,
		.author-bio,
		.entry-footer,
		.sticky-post,
		.taxonomy-description,
		.entry-caption,
		.comment-metadata,
		.pingback .edit-link,
		.comment-metadata a,
		.pingback .comment-edit-link,
		.comment-form label,
		.comment-notes,
		.comment-awaiting-moderation,
		.logged-in-as,
		.form-allowed-tags,
		.site-info,
		.wp-caption .wp-caption-text,
		.gallery-caption,
		.widecolumn label,
		.widecolumn .mu_register label,
		.menu-toggle:hover,
		.menu-toggle:focus,
		.main-navigation a:hover,
		.main-navigation a:focus,
		.dropdown-toggle:hover,
		.dropdown-toggle:focus,
		.post-navigation a:hover .post-title,
		.post-navigation a:focus .post-title,
		.tagcloud a:hover,
		.tagcloud a:focus,
		.site-branding .site-title a:hover,
		.site-branding .site-title a:focus,
		.entry-title a:hover,
		.entry-title a:focus,
		.entry-footer a:hover,
		.entry-footer a:focus,
		.comment-metadata a:hover,
		.comment-metadata a:focus,
		.pingback .comment-edit-link:hover,
		.pingback .comment-edit-link:focus,
		.comment-reply-link,
		.comment-reply-link:hover,
		.comment-reply-link:focus,
		.social-navigation a:hover:before,
		.social-navigation a:focus:before,
		.required{
			color: %1$s;
		}

		mark,
		ins,
		.button:hover,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination .prev:hover,
		.pagination .prev:focus,
		.pagination .next:hover,
		.pagination .next:focus,
		.widget_calendar tbody a,
		.page-links a:hover,
		.page-links a:focus,
		.hero .more-link:hover {
			background-color: %1$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation li:hover > a,
			.main-navigation li.focus > a {
				color: %1$s;
			}
		}
	';

	wp_add_inline_style( 'yttheme-style', sprintf( $css, $link_color ) );
}
add_action( 'wp_enqueue_scripts', 'yttheme_link_color_css', 11 );

/**
 * Enqueues front-end CSS for the main text color.
 *
 * @since Diving Bell 1.0
 *
 * @see wp_add_inline_style()
 */
function yttheme_main_text_color_css() {
	$color_scheme    = yttheme_get_color_scheme();
	$default_color   = $color_scheme[4];
	$main_text_color = get_theme_mod( 'main_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $main_text_color === $default_color ) {
		return;
	}

	// Convert main text hex color to rgba.
	$main_text_color_rgb = yttheme_hex2rgb( $main_text_color );

	// If the rgba values are empty return early.
	if ( empty( $main_text_color_rgb ) ) {
		return;
	}

	// If we get this far, we have a custom color scheme.
	$border_color = vsprintf( 'rgba( %1$s, %2$s, %3$s, 0.2)', $main_text_color_rgb );

	$css = '
		/* Custom Main Text Color */
		body,
		blockquote cite,
		blockquote small,
		.main-navigation a,
		.menu-toggle,
		.dropdown-toggle,
		.post-navigation a,
		.pagination a:hover,
		.pagination a:focus,
		.widget-title a,
		.site-branding .site-title a,
		.entry-title a,
		.page-links > .page-links-title,
		.comment-author,
		.comment-reply-title small a:hover,
		.comment-reply-title small a:focus {
			color: %1$s
		}

		blockquote,
		.menu-toggle.toggled-on,
		.menu-toggle.toggled-on:hover,
		.menu-toggle.toggled-on:focus,
		.pagination,
		.page-links a,
		.comments-title,
		.comment-reply-title {
			border-color: %1$s;
		}

		.button:hover,
		button:hover,
		button:focus,
		input[type="button"]:hover,
		input[type="button"]:focus,
		input[type="reset"]:hover,
		input[type="reset"]:focus,
		input[type="submit"]:hover,
		input[type="submit"]:focus,
		.pagination:before,
		.pagination:after,
		.pagination .prev,
		.pagination .next,
		.page-links a,
		.hero .more-link:hover {
			background-color: %1$s;
		}

		/* Border Color */
		fieldset,
		pre,
		abbr,
		acronym,
		table,
		th,
		td,
		input[type="text"],
		input[type="email"],
		input[type="url"],
		input[type="password"],
		input[type="search"],
		select,
		textarea,
		.main-navigation li,
		.main-navigation .primary-menu,
		.menu-toggle,
		.dropdown-toggle:after,
		.image-navigation,
		.comment-navigation,
		.tagcloud a,
		.entry-content,
		.entry-summary,
		.post-navigation,
		.page-links a,
		.page-links > span,
		.comment-list article,
		.comment-list .pingback,
		.comment-list .trackback,
		.comment-reply-link,
		.no-comments,
		.widecolumn .mu_register .mu_alert {
			border-color: %1$s; /* Fallback for IE7 and IE8 */
			border-color: %2$s;
		}

		hr,
		code {
			background-color: %1$s; /* Fallback for IE7 and IE8 */
			background-color: %2$s;
		}

		@media screen and (min-width: 56.875em) {
			.main-navigation ul ul,
			.main-navigation ul ul li {
				border-color: %2$s;
			}

			.main-navigation ul ul:before {
				border-top-color: %2$s;
				border-bottom-color: %2$s;
			}
		}
	';

	wp_add_inline_style( 'yttheme-style', sprintf( $css, $main_text_color, $border_color ) );
}
add_action( 'wp_enqueue_scripts', 'yttheme_main_text_color_css', 11 );

/**
 * Enqueues front-end CSS for the secondary text color.
 *
 * @since Diving Bell 1.0
 *
 * @see wp_add_inline_style()
 */
function yttheme_secondary_text_color_css() {
	$color_scheme    = yttheme_get_color_scheme();
	$default_color   = $color_scheme[5];
	$secondary_text_color = get_theme_mod( 'secondary_text_color', $default_color );

	// Don't do anything if the current color is the default.
	if ( $secondary_text_color === $default_color ) {
		return;
	}

	$css = '
		/* Custom Secondary Text Color */

		/**
		 * IE8 and earlier will drop any block with CSS3 selectors.
		 * Do not combine these styles with the next block.
		 */
		body:not(.search-results) .entry-summary,
		.secondary,
		.site-footer,
		.site-header-menu.below,
		#top,
		.social-navigation a {
			color: %1$s;
		}

		.widget_calendar tbody a:hover,
		.widget_calendar tbody a:focus {
			background-color: %1$s;
		}
	';

	wp_add_inline_style( 'yttheme-style', sprintf( $css, $secondary_text_color ) );
}
add_action( 'wp_enqueue_scripts', 'yttheme_secondary_text_color_css', 11 );